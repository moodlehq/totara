<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage program
 */

/**
 * Cron job for managing program schedules
 */

require_once $CFG->dirroot.'/backup/lib.php';
require_once $CFG->dirroot.'/backup/backuplib.php';
require_once $CFG->dirroot.'/backup/restorelib.php';
require_once $CFG->dirroot.'/local/program/lib.php';

/**
 * Update programs
 *
 * @return  void
 */
function program_cron() {
    $result = true;

    // Run the tasks that should be run once a day
    $result = $result && program_daily_cron();

    return $result;
}

/**
 * Cron tasks that should only be run once a day
 *
 * @return bool Success
 */
function program_daily_cron() {
    $timenow  = time();
    $dailycron = 60 * 60 * 24; // one day
    $dailycron = 0; // testing only
    $lastdailycron = get_config(null, 'local_program_lastdailycron');

    if($lastdailycron && ($timenow - $lastdailycron <= $dailycron)) {
        // not enough time has elapsed to rerun daily cron
        mtrace("No need to run program daily cron - has already been run today.");
        return true;
    }

    if (! set_config('local_program_lastdailycron', $timenow)) {
        mtrace("Error: could not update lastdailycron timestamp for program module.");
    }

    // Check for any program completions
    program_cron_completions();

    // Check if any users are due to re-take any recurring programs
    // Note: This should be done before program_cron_user_assignments() as
    // the recurrence task removes assignments so that they can be re-assigned
    // if necessary
    program_cron_recurrence();

    // Check if any courses in recurring programs that were not completed when
    // the recurring course was switched to a newer version of the course
    // have subsequently been completed and mark them as complete in the
    // history table.
    program_cron_recurrence_history();

    // Check that program user assignments are correct
    program_cron_user_assignments();

    // Makes copies of any recurring courses as necessary
    program_cron_copy_recurring_courses();

    // Switches any expired courses with their new courses in recurring programs as necessary
    program_cron_switch_recurring_courses();

    // Sends any messages that are due to be sent
    program_cron_send_messages();

    return true;
}

/**
 * These functions are all globbed together to avoid instantiating programs
 * over and over unnecessarily
 */
function program_cron_send_messages() {

    // this will be populated with programs and keyed with the program id as
    // the programs are instantiated. This will save us having to instantiate
    // the same program more than once
    $programs = array();

    // Send alerts if any programs are due
    program_cron_programs_due($programs);

    // Send alerts if any course sets are due
    program_cron_coursesets_due($programs);

    // Send alerts if any programs are overdue
    program_cron_programs_overdue($programs);

    // Send alerts if any course sets are overdue
    program_cron_coursesets_overdue($programs);

    // Send alerts if any course sets are overdue
    program_cron_learner_followups($programs);

    // Send alerts if any programs have outstanding exceptions
    program_cron_exceptions_raised($programs);
}

/**
 * Checks if the enrolenddates in any courses in recurring programs have expired
 * and therefore need to be switched over as the new recurring course in the
 * program.
 *
 * @global object $CFG
 */
function program_cron_switch_recurring_courses() {
    global $CFG;

    $debugging = debugging();
    $now = time();

    if ($debugging) {
        mtrace('Checking if any courses in recurring programs have expired and need to be switched');
    }

    $recurring_programs = prog_get_recurring_programs();

    foreach($recurring_programs as $program) {

        $content = $program->get_content();
        $coursesets = $content->get_course_sets();

        // retrieve the recurring course set
        $courseset = $coursesets[0];

        // retrieve the recurring course
        $course = $courseset->course;

        // if the recurring course has no enrolment end date set we can't check
        // when the course is supposed to be changed over (as this is what the
        // change over date is based on for want of a better option)
        if ( ! isset($course->enrolenddate) || $course->enrolenddate==0) {
            continue;
        }

        // if the enrolment date of the recurring course is in the future then
        // we don't need to switch over yet
        if ($course->enrolenddate > $now) {
            continue;
        }

        // check that the next course has been created for this program
        if ($recurrence_rec = get_record('prog_recurrence', 'programid', $program->id, 'currentcourseid', $course->id)) {

            // check that the next course actually exists
            if ($newcourse = get_record('course', 'id', $recurrence_rec->nextcourseid)) {

                // Before we set the new course in the program, we have to first save the history
                // record of any users who have not completed the current course and notify
                // those users that the course has been changed so that they can complete
                // the course independently. The can view the record of their complete/incomplete
                // recurring program history via a link in their record of learning.

                // Query to retrieve all the users who have not completed the program
                $sql = "SELECT DISTINCT(pc.userid) AS id, pc.id AS completionid, u.*
                        FROM {$CFG->prefix}prog_completion AS pc
                        LEFT JOIN {$CFG->prefix}user AS u ON pc.userid=u.id
                        WHERE pc.programid = {$program->id}
                        AND pc.status = ".STATUS_PROGRAM_INCOMPLETE."
                        AND pc.coursesetid = 0";

                // get all the users matching the query
                if ($users = get_records_sql($sql)) {
                    foreach($users as $user) {

                        begin_sql();

                        // copy the existing completion records for the user in to the
                        // history table so that we have a record to show that the
                        // course has not been completed
                        $select = "programid={$program->id} AND userid={$user->id} AND coursesetid=0";
                        if ($completion_records_history = get_records_select('prog_completion', $select)) {

                            $backup_success = true;
                            foreach($completion_records_history as $completion_record) {

                                // we need to store the id of the course that belonged to this recurring program at the time
                                // it was added to the history table so that we can report on the course history later if necessary
                                $completion_record->recurringcourseid = $course->id;

                                if ( ! $backup_success = insert_record('prog_completion_history', $completion_record)) {
                                    rollback_sql();
                                    break;
                                }
                            }

                            if ($backup_success) {

                                // send a message to the user to let them know that the course
                                // has changed and that they haven't completed it
                                $messagedata = new stdClass();
                                $messagedata->userto = $user;
                                $messagedata->userfrom = get_admin();
                                $messagedata->subject = get_string('z:incompleterecurringprogramsubject', 'local_program');
                                $messagedata->fullmessage = get_string('z:incompleterecurringprogrammessage', 'local_program');
                                $messagedata->contexturl = $CFG->wwwroot.'/course/view.php?id='.$course->id;
                                $messagedata->contexturlname = get_string('launchcourse', 'local_program');;
                                $result = tm_alert_send($messagedata);

                                commit_sql();
                            } else {
                                rollback_sql();
                            }
                        }
                    }
                }

                // Now we can set the next course as the current course in the program
                $courseset->course = $newcourse;
                $courseset->save_set();
            }

            // delete the record from the recurrence table (otherwise the system
            // won't create a new copy of the recurring course when this one
            // expires in the future)
            delete_records('prog_recurrence', 'programid', $program->id, 'currentcourseid', $course->id);

        }
    }
}

/**
 * Checks if any courses in recurring programs are due to have new copies made
 * based on the enrolment end dates of the course. If any are found that need to
 * be copied, a backup and restore is carried out and a record is added to the
 * 'prog_recurrence' table to enable the system to know that the course has been
 * copied.
 *
 * @global object $CFG
 */
function program_cron_copy_recurring_courses() {
    global $CFG;

    $debugging = debugging();
    $now = time();

    if ($debugging) {
        mtrace('Checking if any courses in recurring programs need to be copied');
    }

    $recurring_programs = prog_get_recurring_programs();

    foreach($recurring_programs as $program) {

        $content = $program->get_content();
        $coursesets = $content->get_course_sets();

        // retrieve the recurring course set
        $courseset = $coursesets[0];

        // retrieve the recurring course
        $course = $courseset->course;

        // if the recurring course has no enrolment end date set we can't check
        // when the course is supposed to be changed over (as this is what the
        // change over date is based on for want of a better option)
        if ( ! isset($course->enrolenddate) || $course->enrolenddate==0) {
            continue;
        }

        // if the enrolment date of the recurring course is too far in the
        // future (based on the recurcreatetime value set by the program creator)
        // we don't need to create the new course yet
        if (($course->enrolenddate - $now) > $courseset->recurcreatetime) {
            continue;
        }

        // check if a course has already been created for this program. If so,
        // and the course actually exists, we don't need to do anything
        if ($recurrence_rec = get_record('prog_recurrence', 'programid', $program->id, 'currentcourseid', $course->id)) {
            if (record_exists('course', 'id', $recurrence_rec->nextcourseid)) {
                continue;
            } else {
                // this means the next course must have been deleted so we need to create a new one
                delete_records('prog_recurrence', 'programid', $program->id, 'currentcourseid', $course->id);
            }
        }

        // So if processing has reached this far it means the existing course
        // needs to be backed up and restored to a new course

        $prefs = array();
        $errorstr = null;

        // backup the course
        if($backupfile = backup_course_silently($course->id, $prefs, $errorstr)) {

            if ($debugging) {
                mtrace("Course '{$course->shortname}' with id {$course->id} successfully backed up to: $backupfile");
            }

            $datestr = userdate($course->enrolenddate, '%d/%m/%Y'); // use the enrolment end date of the current course to distinguish the next course
            $newcourseob = clone $course;
            unset($newcourseob->id);
            unset($newcourseob->modinfo);
            $newcourseob->fullname = $course->fullname.' '.$datestr;
            $newcourseob->shortname = $course->shortname.'-'.$datestr;
            $newcourseob->enrollable = false;
            $newcourseob->enrolenddate = $now + $courseset->recurcreatetime + $courseset->recurrencetime; // this should prevent the system from trying to create another new course the next time the cron is run
            $newcourseob->visible = false;

            if($newcourse = create_course($newcourseob)) {
                if($restoresuccess = import_backup_file_silently($backupfile, $newcourse->id, true, false, array())) {
                    if ($debugging) {
                        mtrace("Backup file $backupfile was successfully restored into course with id {$newcourse->id}");
                    }

                    // create a new record to enable the system to find the new course
                    // when it is time to switch the old course for the new course
                    // in the recurring program
                    $new_recurrence_rec = new stdClass();
                    $new_recurrence_rec->programid = $program->id;
                    $new_recurrence_rec->currentcourseid = $course->id;
                    $new_recurrence_rec->nextcourseid = $newcourse->id;
                    insert_record('prog_recurrence', $new_recurrence_rec);

                } else {
                    if ($debugging) {
                        mtrace("Backup file $backupfile was NOT successfully restored into course with id {$newcourse->id}");
                    }
                }
            } else {
                if ($debugging) {
                    mtrace("Backup file $backupfile was NOT successfully restored because a new course could not be created to complete the restore");
                }
            }
        } else {
            if ($debugging) {
                mtrace("Course with id {$course->id} was NOT backed up");
            }
        }
    }
}

/**
 * Determine whether or not any users have completed any programs
 *
 * @return void
 */
function program_cron_completions() {
    global $CFG;

    if (debugging()) {
        mtrace('Checking program completions');
    }

    // get all programs
    if($program_records = get_records('prog')) {

        foreach($program_records as $program_record) {

            $program = new program($program_record->id);

            // get all the users enrolled on this program
            $program_users = $program->get_program_learners();

            if(count($program_users)==0) {
                return;
            }

            // get the program content
            $program_content = $program->get_content();

            // get the program course sets in the groups that they exist in the program
            $courseset_groups = $program_content->get_courseset_groups();

            if (!empty($program_users)) {
                foreach($program_users as $user) {

                    // first check if the program is already marked as complete for this user and do nothing if it is
                    if($program->is_program_complete($user->id)) {
                        continue;
                    }

                    $courseset_group_completed = false;
                    $previous_courseset_group_completed = false;

                    // go through the course set groups to determine the user's completion status
                    foreach($courseset_groups as $courseset_group) {

                        $courseset_group_completed = false;

                        // check if the user has completed any of the course sets in the group - this constitutes completion of the group
                        foreach($courseset_group as $courseset) {

                            // first check if the course set is already marked as complete
                            if($courseset->is_courseset_complete($user->id)) {
                                $courseset_group_completed = true;
                                $previous_courseset_group_completed = true;
                                break;
                            }

                            // otherwise carry out a check to see if the course set should be marked as complete and mark it as complete if so
                            if($courseset->check_courseset_complete($user->id)) {
                                $courseset_group_completed = true;
                                $previous_courseset_group_completed = true;
                                break;
                            }
                        }

                        // if the user has not completed the course group the program is not complete
                        if( ! $courseset_group_completed) {
                            // set the timedue for the course set in this group with the shortest
                            // time allowance so that course set due reminders will be triggered
                            // at the appropriate time
                            if ($previous_courseset_group_completed) {
                                $program_content->set_courseset_group_timedue($courseset_group, $user->id);
                                $previous_courseset_group_completed = false;
                            }
                            break;
                        }
                    }

                    // $courseset_group_completed will be true if all the course groups in the program have been completed
                    if($courseset_group_completed) {
                        $completionsettings = array(
                            'status'        => STATUS_PROGRAM_COMPLETE,
                            'timecompleted' => time()
                            );
                        return $program->update_program_complete($user->id, $completionsettings);
                    }
                }
            }
        }
    }
}

/**
 * Checks that all programs have the correct user assignments and assigns or
 * unassigns as necessary or raises exceptions if issues are found
 */
function program_cron_user_assignments() {
    global $CFG;

    if (debugging()) {
        mtrace('Checking program user assignments');
    }

    // get all programs
    if($program_records = get_records('prog')) {
        foreach($program_records as $program_record) {
            $program = new program($program_record->id);
            $program->update_learner_assignments();
        }
    }
}

/**
 * Checks if any program due messages need to be sent and sends them
 *
 * @global object $CFG
 * @param array $programs An array of program objects. This is passed by reference so that it can be populated and re-used
 */
function program_cron_programs_due(&$programs) {
    global $CFG;

    if (debugging()) {
        mtrace('Checking programs that are due to be completed');
    }

    $now = time();

    // Query to retrieve all users who need to be sent program due messages
    // based on when the program is due to be completed and whether or not
    // there are any program due messages defined by the program with trigger
    // times that match the user's due dates
    $sql = "SELECT u.*, pc.programid, pc.timedue, pm.id AS messageid, pm.triggertime
            FROM {$CFG->prefix}user AS u
            INNER JOIN {$CFG->prefix}prog_completion AS pc ON u.id=pc.userid
            INNER JOIN {$CFG->prefix}prog_user_assignment AS pua ON (pc.userid=pua.userid AND pc.programid=pua.programid)
            INNER JOIN {$CFG->prefix}prog_message AS pm ON pc.programid=pm.programid
            WHERE pc.timecompleted = 0
            AND pc.coursesetid = 0
            AND pm.messagetype = ".MESSAGETYPE_PROGRAM_DUE."
            AND (pc.timedue - pm.triggertime) < ".$now."
            ORDER BY pc.programid, u.id";

    // get the records
    $rs = get_recordset_sql($sql);

    while ($user = rs_fetch_next_record($rs)) {

        if (isset($programs[$user->programid])) { // Use the existing program object if it is available
            $program = $programs[$user->programid];
        } else { // Create a new program object and store it if it has not already been instantiated
            $program = new program($user->programid);
            $programs[$user->programid] = $program;
        }

        $messagesmanager = $program->get_messagesmanager();
        $messages = $messagesmanager->get_messages();

        // send program due notifications to user and (optionally) the user's manager
        foreach($messages as $message) {
            if($message->id==$user->messageid && $message->messagetype==MESSAGETYPE_PROGRAM_DUE) {
                $message->send_message($user);
            }
        }
    }
}

/**
 * Checks if any course set due messages need to be sent and sends them
 *
 * @global object $CFG
 * @param array $programs An array of program objects. This is passed by reference so that it can be populated and re-used
 */
function program_cron_coursesets_due(&$programs) {
    global $CFG;

    if (debugging()) {
        mtrace('Checking course sets that are due to be completed');
    }

    $now = time();

    // Query to retrieve all users who need to be sent course set due messages
    // based on when the course set is due to be completed and whether or not
    // there are any course set due messages defined by the program with trigger
    // times that match the user's due dates
    $sql = "SELECT u.*, pc.programid, pc.timedue, pm.id AS messageid, pm.triggertime, pc.coursesetid
            FROM {$CFG->prefix}user AS u
            INNER JOIN {$CFG->prefix}prog_completion AS pc ON u.id=pc.userid
            INNER JOIN {$CFG->prefix}prog_user_assignment AS pua ON (pc.userid=pua.userid AND pc.programid=pua.programid)
            INNER JOIN {$CFG->prefix}prog_message AS pm ON pc.programid=pm.programid
            WHERE pc.timecompleted = 0
            AND pc.coursesetid <> 0
            AND pm.messagetype = ".MESSAGETYPE_COURSESET_DUE."
            AND (pc.timedue - pm.triggertime) < ".$now."
            ORDER BY pc.programid, u.id";

    // get the records
    $rs = get_recordset_sql($sql);

    while ($user = rs_fetch_next_record($rs)) {

        if (isset($programs[$user->programid])) { // Use the existing program object if it is available
            $program = $programs[$user->programid];
        } else { // Create a new program object and store it if it has not already been instantiated
            $program = new program($user->programid);
            $programs[$user->programid] = $program;
        }

        $messagesmanager = $program->get_messagesmanager();
        $messages = $messagesmanager->get_messages();

        // send course set due notifications to user and (optionally) the user's manager
        foreach($messages as $message) {
            if($message->id==$user->messageid && $message->messagetype==MESSAGETYPE_COURSESET_DUE) {
                $message->send_message($user, null, array('coursesetid'=>$user->coursesetid));
            }
        }
    }
}

/**
 * Checks if any program overdue messages need to be sent and sends them
 *
 * @global object $CFG
 * @param array $programs An array of program objects. This is passed by reference so that it can be populated and re-used
 */
function program_cron_programs_overdue(&$programs) {
    global $CFG;

    if (debugging()) {
        mtrace('Checking programs that are overdue');
    }

    $now = time();

    // Query to retrieve all users who need to be sent overdue messages
    // based on their program due dates and the trigger dates in any program
    // overdue messages that are defined by the program
    $sql = "SELECT u.*, pc.programid, pc.timedue, pm.id AS messageid, pm.triggertime
            FROM {$CFG->prefix}user AS u
            INNER JOIN {$CFG->prefix}prog_completion AS pc ON u.id=pc.userid
            INNER JOIN {$CFG->prefix}prog_user_assignment AS pua ON (pc.userid=pua.userid AND pc.programid=pua.programid)
            INNER JOIN {$CFG->prefix}prog_message AS pm ON pc.programid=pm.programid
            WHERE pc.timecompleted = 0
            AND pc.coursesetid = 0
            AND pm.messagetype = ".MESSAGETYPE_PROGRAM_OVERDUE."
            AND (pc.timedue + pm.triggertime) < ".$now."
            ORDER BY pc.programid, u.id";

    // get the records
    $rs = get_recordset_sql($sql);

    while ($user = rs_fetch_next_record($rs)) {

        if (isset($programs[$user->programid])) { // Use the existing program object if it is available
            $program = $programs[$user->programid];
        } else { // Create a new program object and store it if it has not already been instantiated
            $program = new program($user->programid);
            $programs[$user->programid] = $program;
        }

        $messagesmanager = $program->get_messagesmanager();
        $messages = $messagesmanager->get_messages();

        // send program overdue notifications to user and (optionally) the user's manager
        foreach($messages as $message) {
            if($message->id==$user->messageid && $message->messagetype==MESSAGETYPE_PROGRAM_OVERDUE) {
                $message->send_message($user);
            }
        }
    }
}

/**
 * Checks if any course set overdue messages need to be sent and sends them
 *
 * @global object $CFG
 * @param array $programs An array of program objects. This is passed by reference so that it can be populated and re-used
 */
function program_cron_coursesets_overdue(&$programs) {
    global $CFG;

    if (debugging()) {
        mtrace('Checking course sets that are overdue');
    }

    $now = time();

    // Query to retrieve all users who need to be sent overdue messages
    // based on their course set due dates and the trigger dates in any course set
    // overdue messages that are defined by the program
    $sql = "SELECT u.*, pc.programid, pc.timedue, pm.id AS messageid, pm.triggertime, pc.coursesetid
            FROM {$CFG->prefix}user AS u
            INNER JOIN {$CFG->prefix}prog_completion AS pc ON u.id=pc.userid
            INNER JOIN {$CFG->prefix}prog_user_assignment AS pua ON (pc.userid=pua.userid AND pc.programid=pua.programid)
            INNER JOIN {$CFG->prefix}prog_message AS pm ON pc.programid=pm.programid
            WHERE pc.timecompleted = 0
            AND pc.coursesetid <> 0
            AND pm.messagetype = ".MESSAGETYPE_COURSESET_OVERDUE."
            AND (pc.timedue + pm.triggertime) < ".$now."
            ORDER BY pc.programid, u.id";

    // get the records
    $rs = get_recordset_sql($sql);

    while ($user = rs_fetch_next_record($rs)) {

        if (isset($programs[$user->programid])) { // Use the existing program object if it is available
            $program = $programs[$user->programid];
        } else { // Create a new program object and store it if it has not already been instantiated
            $program = new program($user->programid);
            $programs[$user->programid] = $program;
        }

        $messagesmanager = $program->get_messagesmanager();
        $messages = $messagesmanager->get_messages();

        // send course set overdue notifications to user and (optionally) the user's manager
        foreach($messages as $message) {
            if($message->id==$user->messageid && $message->messagetype==MESSAGETYPE_COURSESET_OVERDUE) {
                $message->send_message($user, null, array('coursesetid'=>$user->coursesetid));
            }
        }
    }
}

/**
 * Checks if any course set overdue messages need to be sent and sends them
 *
 * @global object $CFG
 * @param array $programs An array of program objects. This is passed by reference so that it can be populated and re-used
 */
function program_cron_learner_followups(&$programs) {
    global $CFG;

    if (debugging()) {
        mtrace('Checking for any follow-up messages to be sent');
    }

    $now = time();

    // Query to retrieve all users who need to be sent follow-up messages
    // based on their course completion dates and the trigger dates in any
    // follow-up messages that are defined by the program
    $sql = "SELECT u.id, pc.programid, pc.timecompleted, pm.id AS messageid, pm.triggertime
            FROM {$CFG->prefix}user AS u
            INNER JOIN {$CFG->prefix}prog_completion AS pc ON u.id=pc.userid
            INNER JOIN {$CFG->prefix}prog_user_assignment AS pua ON (pc.userid=pua.userid AND pc.programid=pua.programid)
            INNER JOIN {$CFG->prefix}prog_message AS pm ON pc.programid=pm.programid
            WHERE pc.status = ".STATUS_PROGRAM_COMPLETE."
            AND pm.messagetype = ".MESSAGETYPE_LEARNER_FOLLOWUP."
            AND (pc.timecompleted + pm.triggertime) < ".$now."
            ORDER BY pc.programid, u.id";

    // get the records
    $rs = get_recordset_sql($sql);

    while ($user = rs_fetch_next_record($rs)) {

        if (isset($programs[$user->programid])) { // Use the existing program object if it is available
            $program = $programs[$user->programid];
        } else { // Create a new program object and store it if it has not already been instantiated
            $program = new program($user->programid);
            $programs[$user->programid] = $program;
        }

        $messagesmanager = $program->get_messagesmanager();
        $messages = $messagesmanager->get_messages();

        // send course set overdue notifications to user and (optionally) the user's manager
        foreach($messages as $message) {
            if($message->id==$user->messageid && $message->messagetype==MESSAGETYPE_LEARNER_FOLLOWUP) {
                $message->send_message($user);
            }
        }
    }
}

/**
 * Checks if any unhandled exceptions exist in any programs and send an alert to the admin
 *
 * @global object $CFG
 * @param array $programs An array of program objects. This is passed by reference so that it can be populated and re-used
 */
function program_cron_exceptions_raised(&$programs) {
    global $CFG;

    if (debugging()) {
        mtrace('Checking if any exceptions exist');
    }

    if ( ! $admin = get_admin()) {
        mtrace('Unable to determine admin user in program_cron_exceptions_raised. Not checking for exceptions.');
        return;
    }

    // Query to retrieve any programs that have unhandled exceptions
    $sql = "SELECT DISTINCT(p.id) AS id
            FROM {$CFG->prefix}prog AS p
            JOIN {$CFG->prefix}prog_exception AS pe ON p.id=pe.programid";

    if ($progsfound = get_records_sql($sql)) {

        foreach ($progsfound as $progfound) {

            if (isset($programs[$progfound->id])) { // Use the existing program object if it is available
                $program = $programs[$progfound->id];
            } else { // Create a new program object and store it if it has not already been instantiated
                $program = new program($progfound->id);
                $programs[$progfound->id] = $program;
            }

            $messagesmanager = $program->get_messagesmanager();
            $messages = $messagesmanager->get_messages();

            // send alerts for each program to the admin user
            foreach($messages as $message) {
                if($message->messagetype==MESSAGETYPE_EXCEPTION_REPORT) {
                    $message->send_message($admin);
                }
            }
        }
    }
}



/**
 * Loops through all the existing recurring programs and finds any users who
 * have completed the program and are due to re-take it. It then backs up the
 * completion history for the user and unassigns the user from the program so
 * that the user will be re-assigned the next time the cron task to assign
 * learners is run
 *
 * @global <type> $CFG
 */
function program_cron_recurrence() {
    global $CFG;

    if (debugging()) {
        mtrace('Checking program recurrence');
    }

    $recurring_programs = prog_get_recurring_programs();

    foreach($recurring_programs as $program) {

        $content = $program->get_content();
        $coursesets = $content->get_course_sets();

        // retrieve the recurring course set
        $courseset = $coursesets[0];

        // retrieve the recurring course
        $recurringcourse = $courseset->course;

        $now = time();
        $recurrencetime = $courseset->recurrencetime;
        $recurrencetime_comparison = $now - $recurrencetime;

        // Query to retrieve all the users assigned to this program (i.e. as
        // part of their required learning) who have completed the program
        // and whose completion dates are beyond the recurrence time period
        $sql = "SELECT DISTINCT(pc.userid) AS id, pc.id AS completionid, pua.id AS userassignmentid, pua.assignmentid, u.*
                FROM {$CFG->prefix}user AS u
                JOIN {$CFG->prefix}prog_completion AS pc ON u.id=pc.userid
                JOIN {$CFG->prefix}prog_user_assignment AS pua ON u.id=pua.userid
                WHERE pc.programid = {$program->id}
                AND pc.status = ".STATUS_PROGRAM_COMPLETE."
                AND pc.coursesetid = 0
                AND pc.timecompleted < ".$recurrencetime_comparison;

        // get all the users matching the query
        if($users = get_records_sql($sql)) {
            foreach($users as $user) {

                begin_sql();

                // copy the existing completion records for the user in to a
                // history table so that we have a record of past completions
                $select = "programid={$program->id} AND userid={$user->id}";
                if ($completion_records_history = get_records_select('prog_completion', $select)) {

                    $backup_success = true;
                    foreach($completion_records_history as $completion_record) {

                        // we need to store the id of the course that belonged to this recurring program at the time
                        // it was added to the history table so that we can report on the course history later if necessary
                        $completion_record->recurringcourseid = $recurringcourse->id;

                        if ( ! $backup_success = insert_record('prog_completion_history', $completion_record)) {
                            rollback_sql();
                            break;
                        }
                    }

                    $completion_delete_success = false;
                    if ($backup_success) {
                        // delete all the previous completion records for this user in this program.
                        // A new completion record will be added when the user is re-assigned when the
                        // assignments cron task runs
                        if ( ! $completion_delete_success = delete_records('prog_completion', 'programid', $program->id, 'userid', $user->id)) {
                            rollback_sql();
                        }
                    }

                    if ($completion_delete_success) {
                        // delete the user's assignment record for this program.
                        // This will be re-created and the user will be re-assigned to the program
                        // when the assignments cron task runs
                        if (delete_records('prog_user_assignment', 'programid', $program->id, 'userid', $user->id)) {
                            commit_sql();
                        } else {
                            rollback_sql();
                        }
                    }
                }
            }
        }
    }
}

/**
 * Finds any users in the 'prog_completion_history' table who have incomplete
 * recurring programs and checks if the course that belonged to the program at
 * the time when the entry was added to the table has since been completed.
 *
 */
function program_cron_recurrence_history() {

    if (debugging()) {
        mtrace('Checking program recurrence history');
    }

    if ($history_records = get_records('prog_completion_history', 'status', STATUS_PROGRAM_INCOMPLETE)) {

        foreach($history_records as $history_record) {

            if ($course = get_record('course', 'id', $history_record->recurringcourseid)) {

                // create a new completion object for this course
                $completion_info = new completion_info($course);

                // check if the course is complete
                if ($completion_info->is_course_complete($history_record->userid)) {
                    $history_record->status = STATUS_PROGRAM_COMPLETE;
                    $history_record->timecompleted = time();
                    update_record('prog_completion_history', $history_record);
                }
            }
        }
    }
}

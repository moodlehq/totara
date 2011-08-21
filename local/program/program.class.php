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

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot . '/local/program/program_content.class.php');
require_once($CFG->dirroot . '/local/program/program_courseset.class.php');
require_once($CFG->dirroot . '/local/program/program_assignments.class.php');
require_once($CFG->dirroot . '/local/program/program_messages.class.php');
require_once($CFG->dirroot . '/local/program/program_message.class.php');
require_once($CFG->dirroot . '/local/program/program_exceptions.class.php');
require_once($CFG->dirroot . '/local/program/program_exception.class.php');
require_once($CFG->dirroot . '/local/program/program_user_assignment.class.php');

define('STATUS_PROGRAM_INCOMPLETE', 0);
define('STATUS_PROGRAM_COMPLETE', 1);
define('STATUS_COURSESET_INCOMPLETE', 2);
define('STATUS_COURSESET_COMPLETE', 3);

define('TIME_SELECTOR_HOURS', 1);
define('TIME_SELECTOR_DAYS', 2);
define('TIME_SELECTOR_WEEKS', 3);
define('TIME_SELECTOR_MONTHS', 4);
define('TIME_SELECTOR_YEARS', 5);

define('DURATION_MINUTE', 60);
define('DURATION_HOUR',   60 * DURATION_MINUTE);
define('DURATION_DAY',    24 * DURATION_HOUR);
define('DURATION_WEEK',   7  * DURATION_DAY);
define('DURATION_MONTH',  30 * DURATION_DAY);
define('DURATION_YEAR',   12 * DURATION_MONTH);

define('AVAILABILITY_NOT_TO_STUDENTS',0);
define('AVAILABILITY_TO_STUDENTS', 1);

global $TIMEALLOWANCESTRINGS;

$TIMEALLOWANCESTRINGS = array(
    TIME_SELECTOR_HOURS => 'hours',
    TIME_SELECTOR_DAYS => 'days',
    TIME_SELECTOR_WEEKS => 'weeks',
    TIME_SELECTOR_MONTHS => 'months',
    TIME_SELECTOR_YEARS => 'years',
);


/**
 * Quick and light function for returning a program context
 *
 * @access  public
 * @param   $int    integer     Program id
 * @return  object  context instance
 */
function program_get_context($id) {
    // Quickly get context from program id
    return get_context_instance(CONTEXT_PROGRAM, $id);
}


class program {

    public $id, $category, $sortorder, $fullname, $shortname;
    public $idnumber, $summary, $endnote, $visible;
    public $availablefrom, $availableuntil, $availablerole;
    public $timecreated, $timemodified, $usermodified;
    public $content;

    protected $assignments, $messagesmanager;
    protected $exceptionsmanager, $context, $studentroleid;

    function __construct($id) {

        // get program db record
        $program = get_record('prog', 'id', $id);

        if(!$program) {
            throw new ProgramException(get_string('programidnotfound','local_program', $id));
        }

        // set details about this program
        $this->id = $id;
        $this->category = $program->category;
        $this->sortorder = $program->sortorder;
        $this->fullname = $program->fullname;
        $this->shortname = $program->shortname;
        $this->idnumber = $program->idnumber;
        $this->summary = $program->summary;
        $this->endnote = $program->endnote;
        $this->visible = $program->visible;
        $this->availablefrom = $program->availablefrom;
        $this->availableuntil = $program->availableuntil;
        $this->availablerole = $program->availablerole;
        $this->timecreated = $program->timecreated;
        $this->timemodified = $program->timemodified;
        $this->usermodified = $program->usermodified;

        $this->content = new prog_content($id);
        $this->assignments = new prog_assignments($id);

        $this->messagesmanager = new prog_messages_manager($id);
        $this->exceptionsmanager = new prog_exceptions_manager($id);

        $this->context = get_context_instance(CONTEXT_PROGRAM, $this->id);
        $this->studentroleid = get_field('role', 'id', 'shortname', 'student');

        if (!$this->studentroleid) {
            print_error('error:failedtofindstudentrole', 'local_program');
        }
    }

    public function get_content() {
        return $this->content;
    }

    public function get_context() {
        return $this->context;
    }

    public function get_assignments() {
        return $this->assignments;
    }

    public function get_messagesmanager() {
        return $this->messagesmanager;
    }

    public function get_exceptionsmanager() {
        return $this->exceptionsmanager;
    }

    /**
     * Deletes an entire program and all its data (content, assignments,
     * messages, exceptions)
     *
     * @return bool Success
     */
    public function delete() {

        $result = true;

        // First delete this program from any users' learning plans
        // We do this before calling begin_sql() as we need these records to be
        // fully removed from the database before we call $this->unassign_learners()
        // or the users won't be properly unassigned
        $result = $result && delete_records('dp_plan_program_assign', 'programid', $this->id);

        // Get all users who are automatically assigned, as we want to unassign them all
        // $users_to_unassign = get_records_select('role_assignments', 'roleid = '. $this->studentroleid .' AND contextid = '. $this->context->id, '', 'userid as id');
        $users_to_unassign = get_records('prog_user_assignment', 'programid', $this->id, '', 'userid as id');

        begin_sql();

        // unassign the users
        if ($users_to_unassign != false) {
            $users_to_unassign = array_keys($users_to_unassign);
            $result = $result && $this->unassign_learners($users_to_unassign);
        }


        if ($result) {
            commit_sql();
        } else {
            rollback_sql();
        }

        // delete all exceptions and exceptions data
        if($result) {
            $result = $result && $this->exceptionsmanager->delete();
        }

        // delete all messages and the log of sent messages
        if($result) {
            $result = $result && $this->messagesmanager->delete();
        }

        // delete all assignments
        if($result) {
            $result = $result && $this->assignments->delete();
        }

        // delete all content
        if($result) {
            $result = $result && $this->content->delete();
        }

        // delete the program itself
        if($result) {
            begin_sql();

            $result = $result && delete_records('prog', 'id', $this->id);

            if ($result) {
                commit_sql();
            }
            else {
                rollback_sql();
            }
        }

        return $result;
    }

    /**
     * Deletes the completion records for the program for the specified user.
     * 
     * @param int $userid
     * @param bool $deletecompleted Whether to force deletion of records for completed programs
     * @return bool Deletion success status
     */
    public function delete_completion_record($userid, $deletecompleted=false) {

        $result = true;

        if ($deletecompleted===true || ! $this->is_program_complete($userid)) {
            $result = delete_records('prog_completion', 'programid', $this->id, 'userid', $userid);
        }

        return $result;
    }

    /**
     * Checks all the assignments for the program and assigns and unassigns
     * learners to the program if they meet or don't meet the current
     * assignment criteria.
     *
     * Under certain conditions (e.g. completion date not allowing enough time
     * for a student to complete the program) users will not be assigned to the
     * program and exceptions will be raised instead.
     *
     * @return bool
     */
    public function update_learner_assignments($categories = null) {

        // Get the total time allowed for this program
        $total_time_allowed = $this->content->get_total_time_allowance();

        // Get a list of category types, such as the one for Organisations, Positions etc
        if ($categories == null) {
            $categories = prog_assignment_category::get_categories();
        }
        $user_assignments = array();

        // Loop through this programs assignments and work out which users should
        // be linked to which assignments
        $assignments = $this->assignments->get_assignments();
        if (!$assignments) {
            $assignments = get_records('prog_assignment','programid',$this->id);
        }

        // Store a list of user that are assigned on this program currently
        $assigned_users = get_records('prog_user_assignment', 'programid', $this->id, '', 'userid');
        if ($assigned_users == false) {
            $assigned_users = array();
        }

        // Stores a list of user ids that we don't want to include
        // Either due to them already being assigned or exceptions being raised
        $users_to_skip = array_keys($assigned_users);

        if (!empty($assignments)) {
            foreach ($assignments as $assignment) {

                // Get the affected users for this assignment
                $users = $categories[$assignment->assignmenttype]->get_affected_users_by_assignment($assignment);

                if (!empty($users)) {
                    // Loop through the users and populate $user_assignments
                    foreach ($users as $user) {

                        // Get the time due
                        $timedue = $this->make_timedue($user->id, $assignment);
                        if ($timedue == false) {

                            // Don't print exception for users who have had exceptions raised or who are already assigned
                            if (!in_array($user->id, $users_to_skip)) {
                                $this->exceptionsmanager->raise_exception(EXCEPTIONTYPE_COMPLETION_TIME_UNKNOWN, $user->id, $assignment->id, time());
                                $users_to_skip[] = $user->id;
                                continue;
                            }
                        }

                        if (isset($user_assignments[$user->id])) {
                            // Update this user assignment, let it handle whether the due date is earlier or not
                            $user_assignments[$user->id]->update($assignment, $timedue);
                        }
                        else {
                            // Create a user assignment - this temporarily stores the relationshp between a user and an assignment
                            $user_assignments[$user->id] = new user_assignment($user->id, $assignment, $timedue);
                        }
                    }
                }
            }

            if (!empty($user_assignments)) {
                foreach ($user_assignments as $user_assignment) {

                    if (in_array($user_assignment->userid, $users_to_skip)) {
                        continue;
                    }

                    // Get the remaining time until the duedate from now
                    $time_until_duedate = $user_assignment->timedue - time();

                    $exception_raised = false;

                    // Check if the remaining time is less than the allowed time
                    if ($time_until_duedate < $total_time_allowed) { // 2592000 seconds = 30 days
                        $this->exceptionsmanager->raise_exception(EXCEPTIONTYPE_TIME_ALLOWANCE, $user_assignment->userid, $user_assignment->assignment->id, time());
                        $exception_raised = true;
                    }
                    if ($this->assigned_to_users_non_required_learning($user_assignment->userid)) {
                        $this->exceptionsmanager->raise_exception(EXCEPTIONTYPE_ALREADY_ASSIGNED, $user_assignment->userid, $user_assignment->assignment->id, time());
                        $exception_raised = true;
                    }
                    if (!$exception_raised) {
                        $this->assign_learner($user_assignment->userid, $user_assignment->timedue, $user_assignment->assignment);
                    }
                }
            }
        }

        // Get an array of user ids, of the users who should be in this program (we've just worked out who is in this list)
        $users_who_should_be_assigned = array_keys($user_assignments);
        $users_to_unassign = false;

        if (count($users_who_should_be_assigned) > 0) {
            // Get a list of user ids that are ALREADY assigned, but shouldn't be anymore
            $users_to_unassign = get_records_select('role_assignments', 'roleid = '. $this->studentroleid .' AND contextid = '. $this->context->id .' AND userid NOT IN ('. implode(',', $users_who_should_be_assigned) .')', '', 'userid as id');
        }
        else {
            // Get all users who are assigned, as we want to unassign them all
            $users_to_unassign = get_records_select('role_assignments', 'roleid = '. $this->studentroleid .' AND contextid = '. $this->context->id, '', 'userid as id');
        }

        if ($users_to_unassign != false) {
            $users_to_unassign = array_keys($users_to_unassign);
            $this->unassign_learners($users_to_unassign);
        }

        return true;
    }

    /**
     * Assigns a user to the program. Any users assigned to a program in this
     * way will have thie program aa part of their required (mandatory) learning
     * (as opposed to part of a learning plan).
     *
     * A 'program_assigned' event is triggered to notify any listening modules.
     *
     * @global object $CFG
     * @param int $userid
     * @param int $timedue The date the the program should be completed by
     * @param object $assignment_record A record from mdl_prog_assignment
     * @return bool
     */
    public function assign_learner($userid, $timedue, $assignment_record) {
        global $CFG;

        $now = time();

        // insert or update a completion record to store the status of the user's progress on the program
        if ($pc = get_record('prog_completion', 'programid', $this->id, 'userid', $userid, 'coursesetid', 0)) {
            $pc->timedue = $timedue;
            update_record('prog_completion', $pc);
        } else {
            $pc = new stdClass();
            $pc->programid = $this->id;
            $pc->userid = $userid;
            $pc->coursesetid = 0;
            $pc->status = STATUS_PROGRAM_INCOMPLETE;
            $pc->timestarted = $now;
            $pc->timedue = $timedue;
            insert_record('prog_completion', $pc);
        }

        // insert a completion record to store the time due for the
        // shortest course set in the first group of course sets in the program
        $courseset_groups = $this->content->get_courseset_groups();
        if (count($courseset_groups)>0) {
            $this->content->set_courseset_group_timedue($courseset_groups[0], $userid);
        }

        // insert or update a user assignment record to store the details of how this user was assigned to the program
        if ($ua = get_record('prog_user_assignment', 'programid', $this->id, 'userid', $userid)) {
            $ua->assignmentid = $assignment_record->id;
            $ua->timeassigned = $now;
            update_record('prog_user_assignment', $ua);
        } else {
            $ua = new stdClass();
            $ua->programid = $this->id;
            $ua->userid = $userid;
            $ua->assignmentid = $assignment_record->id;
            $ua->timeassigned = $now;
            insert_record('prog_user_assignment', $ua);
        }

        // Assign the student role to the user in the program context as
        // long as the program is not already complete
        // This is what identifies the program as required learning.
        if($pc->status !== STATUS_PROGRAM_COMPLETE) {
            role_assign($this->studentroleid, $userid, '', $this->context->id);
        }

        // trigger this event for any listening handlers to catch
        $eventdata = new stdClass();
        $eventdata->programid = $this->id;
        $eventdata->userid = $userid;
        events_trigger('program_assigned', $eventdata);

        return true;
    }

    /**
     * Receives an array containing userids and unassigns all the users from the
     * program.
     *
     * A 'program_unassigned' event is triggered to notify any listening modules.
     *
     * @param array $userids Array containing userids
     * @return bool
     */
    public function unassign_learners($userids) {

        foreach($userids as $userid) {

            // Un-assign the student role from the user in the program context
            role_unassign($this->studentroleid, $userid, '', $this->context->id);

            // delete the users assignment records for this program
            delete_records('prog_user_assignment', 'programid', $this->id, 'userid', $userid);

            // check if this program is also part of any of the user's learning plans
            if ( ! $this->assigned_to_users_non_required_learning($userid)) {
                // delete the completion record if the program is not complete
                if ( ! $this->is_program_complete($userid)) {
                    $this->delete_completion_record($userid);
                }
            }

            // trigger this event for any listening handlers to catch
            $eventdata = new stdClass();
            $eventdata->programid = $this->id;
            $eventdata->userid = $userid;
            events_trigger('program_unassigned', $eventdata);
        }

        return true;

    }

    /**
     * Sets the time that a program is due for a learner
     *
     * @param int $userid The user's ID
     * @param int $timedue Timestamp indicating the date that the program is due to be completed by the user
     * @return bool Success
     */
    public function set_timedue($userid, $timedue) {

        if ($completion = get_record('prog_completion', 'programid', $this->id, 'userid', $userid, 'coursesetid', 0)) {
            $todb = new object();
            $todb->id = $completion->id; // addslashes to any text fields from the db
            $todb->timedue = $timedue;
            return update_record('prog_completion', $todb);
		} else {
            return false;
        }

    }

    /**
     * Calulates the date on which a program will be due for a learner when it
     * is first assigned based on the assignment record through which the user
     * is being assigned to the program.
     *
     * @global array $COMPLETION_EVENTS_CLASSNAMES
     * @param int $userid
     * @param object $assignment_record
     * @return int A timestamp
     */
    public function make_timedue($userid, $assignment_record) {

        if ($assignment_record->completionevent == COMPLETION_EVENT_NONE) {
            // Fixed time
            return $assignment_record->completiontime;
        }

        // Else it's a relative event, need to do a lookup
        global $COMPLETION_EVENTS_CLASSNAMES;

        if (!isset($COMPLETION_EVENTS_CLASSNAMES[$assignment_record->completionevent])) {
            throw new ProgramException(get_string('eventnotfound','local_program', $assignment_record->completionevent));
        }

        // See if we can retrieve the object form the cache
        if (isset($this->completion_object_cache[$assignment_record->completionevent])) {
            $event_object = $this->completion_object_cache[$assignment_record->completionevent];
        }
        else {
            // Else make it it and add to the cache for future use
            $event_object = new $COMPLETION_EVENTS_CLASSNAMES[$assignment_record->completionevent]();
            $this->completion_object_cache[$assignment_record->completionevent] = $event_object;
        }

        $basetime = $event_object->get_timestamp($userid, $assignment_record->completioninstance);

        if ($basetime == false) {
            return false;
        }

        $timedue = $basetime + $assignment_record->completiontime;

        return $timedue;
    }
    private $completion_object_cache = array();

    /**
     * Determines if the program is assigned to the speficied user's required
     * (mandatory) learning
     *
     * @global object $CFG
     * @param int $userid
     * @return bool True if the program is mandatory, false if not
     */
    public function assigned_to_users_required_learning($userid) {
        global $CFG;
        $sql = "SELECT p.id
                FROM {$CFG->prefix}prog_user_assignment AS p
                WHERE p.userid = $userid
                AND p.programid = {$this->id}";

        return record_exists_sql($sql);
    }

    /**
     * Determines if the program is assigned to the speficied user's non-required
     * learning (i.e. part of a learning plan)
     *
     * @global object $CFG
     * @param int $userid
     * @return bool True if the program is assigned to a learning plan, false if not
     */
    public function assigned_to_users_non_required_learning($userid) {
        global $CFG;
        $sql = "SELECT p.id
                FROM {$CFG->prefix}dp_plan AS p
                JOIN {$CFG->prefix}dp_plan_program_assign AS ppa ON p.id=ppa.planid
                WHERE p.userid = $userid
                AND ppa.programid = {$this->id}";

        return record_exists_sql($sql);
    }

    /**
     * Return true or false depending on whether or not the specified user has
     * completed this program
     *
     * @param int $userid
     * @return bool
     */
    public function is_program_complete($userid) {
        if($prog_completion_status = get_record('prog_completion', 'programid', $this->id, 'userid', $userid, 'coursesetid', 0)) {
            if($prog_completion_status->status == STATUS_PROGRAM_COMPLETE) {
                return true;
            }
        }
        return false;
    }

    /**
     * Return true if the user has started but not completed this program, false
     * if not
     *
     * @param int $userid
     * @return bool
     */
    public function is_program_inprogress($userid) {
        if($prog_completion_status = get_record('prog_completion', 'programid', $this->id, 'userid', $userid, 'coursesetid', 0)) {
            if($prog_completion_status->status == STATUS_PROGRAM_INCOMPLETE && $prog_completion_status->timestarted > 0) {
                return true;
            }
        }
        return false;
    }

    /**
     * Updates the completion record in the database for the specified user
     *
     * @param int $userid
     * @param array $completionsettings Contains the field values for the record
     * @return bool|int
     */
    public function update_program_complete($userid, $completionsettings) {

        $progcompleted_eventtrigger = false;

        // if the program is being marked as complete we need to trigger an
        // event to any listening modules
        if(array_key_exists('status', $completionsettings)) {
            if($completionsettings['status'] == STATUS_PROGRAM_COMPLETE) {

                // flag that we need to trigger the program_completed event
                $progcompleted_eventtrigger = true;

                // set up the event data
                $eventdata = new stdClass();
                $eventdata->program = $this;
                $eventdata->userid = $userid;
            }
        }

        if($completion = get_record('prog_completion', 'programid', $this->id, 'userid', $userid, 'coursesetid', 0)) {

            foreach($completionsettings as $key => $val) {
                $completion->$key = $val;
            }

            if($update_success = update_record('prog_completion', $completion)) {
                if($progcompleted_eventtrigger) {
                    // trigger an event to notify any listeners that this program has been completed
                    events_trigger('program_completed', $eventdata);
                }
            }

            return $update_success;

        } else {

            $now = time();

            $completion = new stdClass();
            $completion->programid = $this->id;
            $completion->userid = $userid;
            $completion->coursesetid = 0;
            $completion->status = STATUS_PROGRAM_INCOMPLETE;
            $completion->timecompleted = 0;
            $completion->timedue = 0;
            $completion->timestarted = $now;

            foreach($completionsettings as $key => $val) {
                $completion->$key = $val;
            }

            if($insert_success = insert_record('prog_completion', $completion)) {
                if($progcompleted_eventtrigger) {
                    // trigger an event to notify any listeners that this program has been completed
                    events_trigger('program_completed', $eventdata);
                }
            }

            return $insert_success;
        }
    }

    /**
     * Returns an array containing all the users who are currently registered
     * on the program. Optionally, will only return a subset of users with a
     * specific completion status
     *
     * @param int $status
     * @return array
     */
    public function get_program_learners($status=false) {
        global $CFG;

        // Query to retrive any users who are registered on the program
        $sql = "SELECT DISTINCT(pc.userid) AS id, pc.*, u.*
                FROM {$CFG->prefix}user AS u
                JOIN {$CFG->prefix}prog_completion AS pc ON u.id=pc.userid
                WHERE pc.programid = {$this->id}
                AND pc.coursesetid = 0";

        if($status) {
            $sql .= " AND pc.status = $status";
        }

        return get_records_sql($sql);
    }

    /**
     * Calculates how far through the program a specific user is and returns
     * the result as a percentage
     *
     * @param int $userid
     * @return float
     */
    public function get_progress($userid) {

        // first check if the whole program has been completed
        if($this->is_program_complete($userid)) {
            return (float)100;
        }

        $courseset_groups = $this->content->get_courseset_groups();
        $courseset_group_count = count($courseset_groups);
        $courseset_group_complete_count = 0;

        foreach($courseset_groups as $courseset_group) {
            $courseset_group_complete = false;
            foreach($courseset_group as $courseset) {
                // only one set in a group of course sets needs to be completed for the whole group to be considered complete
                if($courseset->is_courseset_complete($userid)) {
                    $courseset_group_complete = true;
                    break;
                }
            }

            if($courseset_group_complete) {
                $courseset_group_complete_count++;
            }
        }

        if ($courseset_group_count > 0) {
            return (float)($courseset_group_complete_count / $courseset_group_count) * 100;
        }
        return 0;
    }

    /**
     * Returns true or false depending on whether or not the specified user
     * can access the specified course based on whether or not the program
     * contains the course in any of its course sets and whether or not the
     * user has completed all pre-requisite groups of course sets
     *
     * @param int $userid
     * @param int $courseid
     * @return bool
     */
    public function can_enter_course($userid, $courseid) {

        $courseset_groups = $this->content->get_courseset_groups();

        $courseset_group_completed = false;

        foreach($courseset_groups as $courseset_group) {

            foreach($courseset_group as $courseset) {

                // if this set contains the course, the user can enter the course
                if($courseset->contains_course($courseid)) {

                    $completionsettings = array(
                        'status'        => STATUS_COURSESET_INCOMPLETE,
                        'timestarted'   => time()
                    );

                    // update the course set completion status
                    $courseset->update_courseset_complete($userid, $completionsettings);

                    return true;
                }

                $courseset_group_completed = $courseset_group_completed===true ? $courseset_group_completed : $courseset->is_courseset_complete($userid);
            }

            // if this course set group is not complete there is not point in
            // continuing because the user can not enter any of the courses
            // in the following course set groups
            if( ! $courseset_group_completed) {
                return false;
            }
        }
        return false;
    }

    /**
     * Return the HTML markup for displaying the view of the program. This can
     * vary depending on whether or not the viewer is enrolled on the program
     * and if the viewer is viewing someone else's program.
     *
     * @global object $CFG
     * @global object $USER
     * @param int $userid
     * @return string
     */
    public function display($userid=null) {
        global $CFG, $USER;

        $out = '';

        $viewinganothersprogram = false;
        if ($userid && $userid != $USER->id) {
            $viewinganothersprogram = true;
            if ( ! $user = get_record('user', 'id', $userid)) {
                print_error('Unable to locate the specified user for the program');
            }
            $user->fullname = fullname($user);
            $user->wwwroot = $CFG->wwwroot;
            $out .= '<p>'.get_string('viewingxusersprogram', 'local_program', $user).'</p>';
        }

        // Get the total time allowed for this program
        $total_time_allowed = $this->content->get_total_time_allowance();

        // Only display the time allowance if it is greater than zero
        if ($total_time_allowed > 0) {
            // Break the time allowed details down into human readable form
            $timeallowance = program_utilities::duration_explode($total_time_allowed);

            $out .= '<p class="timeallowed">';

            if ($viewinganothersprogram) {
                $timeallowance->fullname = $user->fullname;
                $out .= get_string('allowedtimeforprogramasmanager', 'local_program', $timeallowance);
            } else {
                if ($userid) {
                    $out .= get_string('allowedtimeforprogramaslearner', 'local_program', $timeallowance);
                } else {
                    $out .= get_string('allowedtimeforprogramviewing', 'local_program', $timeallowance);
                }
            }

            // Only display the 'request an extension' link to assigned learners
            // (i.e. those users who have this program as part of their required
            // learning)
            if (!$viewinganothersprogram && $userid && $this->assigned_to_users_required_learning($userid)) {
                $out .= ' <a href="'.$CFG->wwwroot.'/local/program/view.php?id='.$this->id.'&amp;extrequest=1">'.get_string('requestextension', 'local_program').'</a>';
            }

            $out .= '</p>';
        }

        // display the start date, due date and progress bar
        if ($userid) {
            if($prog_completion = get_record('prog_completion', 'programid', $this->id, 'userid', $userid, 'coursesetid', 0)) {
                $startdatestr = $this->display_date_as_text($prog_completion->timestarted);
                $duedatestr = empty($prog_completion->timedue) ? get_string('duedatenotset', 'local_program') : $this->display_date_as_text($prog_completion->timedue);
                $out .= '<div class="programprogress">';
                $out .= '<div class="startdate">'.get_string('startdate', 'local_program').': '.$startdatestr.'</div>';
                ;
                $out .= '<div class="duedate">'.get_string('duedate', 'local_program').': '.$duedatestr.'</div>';
                ;
                $out .= '<div class="startdate">'.get_string('progress', 'local_program').': '.$this->display_progress($userid).'</div>';
                ;
                $out .= '</div>';
            }
        }

        $out .= '<div class="summary">'.$this->summary.'</div>';

        // display the reason why this user has been assigned to the program (if it is mandatory for the user)
        if ($userid) {
            if($user_assignments = get_records_select('prog_user_assignment', "programid={$this->id} AND userid=$userid")) {
                $out .= '<div class="assignments">';
                if ($viewinganothersprogram) {
                    $out .= '<p>'.get_string('assignmentcriteriamanager', 'local_program').'</p>';
                } else {
                    $out .= '<p>'.get_string('assignmentcriterialearner', 'local_program').'</p>';
                }
                $out .= '<ul>';
                foreach($user_assignments as $user_assignment) {
                    if($assignment = get_record('prog_assignment', 'id', $user_assignment->assignmentid)) {
                        $user_assignment_ob = prog_user_assignment::factory($assignment->assignmenttype, $user_assignment->id);
                        $out .= $user_assignment_ob->display_criteria();
                    }
                }
                $out .= '</ul>';
                $out .= '</div>';
            }
        }

        $courseset_groups = $this->content->get_courseset_groups();

        // check if this is a recurring program
        if (count($courseset_groups) == 0) {
            $out .= '<p class="nocontent">No course content.</p>';
        } else if (count($courseset_groups) == 1 && ($courseset_groups[0][0]->contenttype == CONTENTTYPE_RECURRING)) {
            $out .= $courseset_groups[0][0]->display($userid);
        } else {

            // Maintain a list of previous and future courseset, for use later
            $previous = array();
            $next = array();

            // get the course sets for this program
            $coursesets = $this->content->get_course_sets();

            // set up the array of next coursesets for use  later
            foreach ($coursesets as $courseset) {
                $next[] = $courseset;
            }

            // flag to determine whether or not to display active links to
            // courses in the course set groups in the program. The first group
            // will always be accessible.
            $courseset_group_accessible = true;

            // display each course set
            foreach ($courseset_groups as $courseset_group) {

                // display eaccrse set
                foreach ($courseset_group as $courseset) {
                    $previous[] = $courseset;
                    $next = array_splice($next, 1);
                    $out .= $courseset->display($userid, $previous, $next, $courseset_group_accessible, $viewinganothersprogram);
                }

                // check if the current course set group is complete. If not,
                // set a flag to prevent access to the courses in the following
                // course sets
                foreach ($courseset_group as $courseset) {
                    // only one set in a group of course sets needs to be completed for the whole group to be considered complete
                    if ($courseset->is_courseset_complete($userid)) {
                        $courseset_group_accessible = true;
                        break;
                    }
                    $courseset_group_accessible = false;
                }
            }
        }

        // only show end note when a program is complete
        $prog_owners_id = ($userid) ? $userid : $USER->id;
        $prog_completion = get_record('prog_completion', 'programid', $this->id, 'userid', $prog_owners_id, 'coursesetid', 0);

        if ($prog_completion && $prog_completion->status == STATUS_PROGRAM_COMPLETE) {
            $out .= '<div class="programendnote">';
            $out .= '<h2>'.get_string('programends', 'local_program').'</h2>';
            $out .= '<div class="endnote">'.$this->endnote.'</div>';
            $out .= '</div>';
        }

        return $out;
    }

    /**
     * Display widget containing a program summary
     *
     * @global object $CFG
     * @return string $out
     */
    function display_summary_widget($userid=null) {
        global $CFG, $USER;

        $extraparams = '';
        if (($userid != null) && ($userid != $USER->id)) {
            $extraparams = '&amp;userid='.$userid;
        }

        $out = '';
        $out .= "<div class=\"dp-summary-widget-title\"><a href=\"{$CFG->wwwroot}/local/program/required.php?id={$this->id}{$extraparams}\">{$this->fullname} </a></div>";
        $out .= "<div class=\"dp-summary-widget-description\">{$this->summary}</div>";

        return $out;
    }

    /**
     * Display the due date for a program
     *
     * @param int $itemid
     * @param int $duedate
     * @return string
     */
    function display_duedate($duedate) {
        $out = '';

        $out .= $this->display_date_as_text($duedate);

        // highlight dates that are overdue or due soon
        $out .= $this->display_duedate_highlight_info($duedate);

        return $out;
    }

    /**
     * Display a date as text
     *
     * @param int $mydate
     * @return string
     */
    function display_date_as_text($mydate) {
        global $CFG;

        if(isset($mydate)) {
            if($CFG->ostype == 'WINDOWS') {
                return userdate($mydate, '%#d %b %Y', $CFG->timezone, false);
            } else {
                return userdate($mydate, '%e %h %Y', $CFG->timezone, false);
            }
        } else {
            return '';
        }
    }

    /**
     * Display due date for a program with task info
     *
     * @param int $duedate
     * @return string
     */
    function display_duedate_highlight_info($duedate) {
        $out = '';
        $now = time();
        if(isset($duedate)) {
            if(($duedate < $now) && ($now - $duedate < 60*60*24)) {
                $out .= '<br /><span class="plan_highlight">' . get_string('duetoday', 'local_plan') . '</span>';
            } else if($duedate < $now) {
                $out .= '<br /><span class="plan_highlight">' . get_string('overdue', 'local_plan') . '</span>';
            } else if ($duedate - $now < 60*60*24*7) {
                $days = ceil(($duedate - $now)/(60*60*24));
                $out .= '<br /><span class="plan_highlight">' . get_string('dueinxdays', 'local_plan', $days) . '</span>';
            }
        }
        return $out;
    }

    /**
     * Determines and displays the progress of this program for a specified user.
     *
     * Progress is determined by course set completion statuses.
     *
     * @access  public
     * @param int $userid
     * @return  string
     */
    public function display_progress($userid) {
        global $CFG;

        $prog_completion = get_record('prog_completion', 'programid', $this->id, 'userid', $userid, 'coursesetid', 0);

        if( ! $prog_completion) {
            $out = get_string('notenrolled', 'local_program');
            return $out;
        } else if ($prog_completion->status == STATUS_PROGRAM_COMPLETE) {
            $overall_progress = 100;
        } else {
            $overall_progress = $this->get_progress($userid);
        }

        $tooltipstr = 'DEFAULTTOOLTIP';

        // Get relevant progress bar and return for display
        return local_display_progressbar($overall_progress, 'medium', false, $tooltipstr);
    }

    /**
     * Generates the HTML to display the current number of exceptions and a link
     * to the exceptions report for the program
     *
     * @return string
     */
    public function display_exceptions_link() {

        $out = '';

        $exceptionscount = $this->exceptionsmanager->count_exceptions();

        if($exceptionscount && $exceptionscount>0) {
            $out .= '<div id="exceptionsreport">';
            $out .= '<p>';
            $out .= '<span class="exceptionscount">'.get_string('unresolvedexceptions', 'local_program', $exceptionscount).'.</span> ';
            $out .= '<span class="exceptionslink"><a href="exceptions.php?id='.$this->id.'">'.get_string('viewexceptions', 'local_program').'</a></span>';
            $out .= '</p>';
            $out .= '</div>';
        }

        return $out;
    }

    public function get_exception_count() {
        $exceptionscount = $this->exceptionsmanager->count_exceptions();

        if ($exceptionscount) {
            return $exceptionscount;
        } else {
            return false;
        }
    }

    /**
     * Generates the HTML to display the current stats of the program (live,
     * not available, etc)
     *
     * @return string
     */
    public function display_current_status() {
        global $CFG;

        $assignmentscount = $this->assignments->count_user_assignments();
        $assignmentscount = $assignmentscount ? $assignmentscount : 0;
        $statusstr = '';

        $out = '';

        // Check if this program is not available
        if ($this->availablerole == AVAILABILITY_NOT_TO_STUDENTS) {
            $statusstr = 'programnotavailable';
        }

        // Check if this program has from and until dates set, if so, encforce them
        if (!empty($this->availablefrom) && !empty($this->availableuntil)) {
            $now = time();

            // Check if the programme isn't accessible yet
            if ($this->availablefrom > $now) {
                $statusstr = 'programnotavailable';
            }

            // Check if the programme isn't accessible anymore
            if ($this->availableuntil < $now) {
                $statusstr = 'programnotavailable';
            }
        }

        if ( ! empty($statusstr)) {
            $programstatusclass = 'programstatusnotlive';
            $programstatusstring = get_string($statusstr, 'local_program');
            $programstatusimg = '';
        } else if ($this->visible) {
            $programstatusclass = 'programstatuslive';
            $programstatusstring = get_string('programlive', 'local_program');
            $programstatusimg = '<img src="'.$CFG->themewww.'/'.$CFG->theme.'/images/program_warning.gif" />';
        } else {
            $programstatusclass = 'programstatusnotlive';
            $programstatusstring = get_string('programnotlive', 'local_program');
            $programstatusimg = '';
        }

        $out .= '<div id="programstatus" class="'.$programstatusclass.'">';
        $out .= $programstatusimg;
        $out .= '<p>';
        $out .= '<span class="status">'.$programstatusstring.'.</span><br />';
        $out .= '<span class="assignmentcount">'.get_string('learnersassigned', 'local_program', $assignmentscount).'.</span>';
        $out .= '</p>';
        $out .= '</div>';
        // This js variable is added so that is available to javascript and can
        // be retrieved and displayed in the dialog when saving the content
        // (see program/program_content.js)
        $out .= '<script type="text/javascript">currentassignmentcount = '.$assignmentscount.'</script>';

        return $out;
    }

    /**
     * Determines whether this program is viewable by the logged in user, or
     * the user passed in as the first parameter. This does not care whether
     * the user is enrolled or not.
     *
     * @global object $USER
     * @param object $user
     * @return boolean
     */
    public function is_viewable($user = null) {
        if ($this->visibile) {
            return true;
        }

        if ($user == null) {
            global $USER;
            $user = $USER;
        }

        // If this user is able to view hidden programs then let it be visible
        if (has_capability('local/program:viewhiddenprograms', get_system_context(), $user->id)) {
            return true;
        }

        return false;
    }

    /**
     * Determines whether this program is accessible to the currently logged
     * in user or the passed in user. This does not care whether
     * the user is enrolled or not.
     *
     * @global object $USER
     * @param object $user
     * @return boolean
     */
    public function is_accessible($user = null) {
        if ($user == null) {
            global $USER;
            $user = $USER;
        }

        // Check if the user can see hidden programs, if so, let them have access
        if (has_capability('local/program:viewhiddenprograms', get_system_context(), $user->id)) {
            return true;
        }

        // Check if this program is not available, if it's not then deny access
        if ($this->availablerole == AVAILABILITY_NOT_TO_STUDENTS) {
            return false;
        }

        // Check if this program has from and until dates set, if so, encforce them
        if (!empty($this->availablefrom) && !empty($this->availableuntil)) {
            $now = time();

            // Check if the programme isn't accessible yet
            if ($this->availablefrom > $now) {
                return false;
            }

            // Check if the programme isn't accessible anymore
            if ($this->availableuntil < $now) {
                return false;
            }
        }

        return true;
    }

    /**
     * Prints an error if a program is not accessible
     */
    function display_access_error() {
        print_error('error:inaccessible', 'local_program');
    }

    /**
     * Generates HTML for a cancel button which is displayed on program
     * management edit screens
     *
     * @global object $CFG
     * @param str $url
     * @return str
     */
    public function get_cancel_button($url='') {
        global $CFG;
        $link = empty($url) ? $CFG->wwwroot : $url;
        return '<a href="'.$link.'" id="cancelprogramedits">'.get_string('cancelprogrammanagement', 'local_program').'</a><br />';
    }
}

/**
 * Class providing various utility functions for use by programs but which can
 * be used independently of and without instantiating a program object
 */
class program_utilities {

    /**
     * Given an integer and a time period (e.g. a day = 60*60*24) this function
     * calculates the length covered by the period and returns returns it as a
     * timestamp
     *
     * E.g. if $num = 4 and $period = 1 (hours) then the timestamp returned
     * would be the equivalent of 4 hours.
     *
     * @param int $num The number of units of the time pariod to calculate
     * @param int $period An integer denoting the time period (hours, days, weeks, etc)
     * @return int A timestamp
     */
    public static function duration_implode($num, $period) {

        $duration = 0;

        if($period == TIME_SELECTOR_YEARS) {
            $duration = $num * DURATION_YEAR;
        } else if($period == TIME_SELECTOR_MONTHS) {
            $duration = $num * DURATION_MONTH;
        } else if($period == TIME_SELECTOR_WEEKS) {
            $duration = $num * DURATION_WEEK;
        } else if($period == TIME_SELECTOR_DAYS) {
            $duration = $num * DURATION_DAY;
        } else if($period == TIME_SELECTOR_HOURS) {
            $duration = $num * DURATION_HOUR;
        } else {
            $duration = 0;
        }

        return $duration;
    }

    /**
     * Given a timestamp representing a duration, this function factors the
     * timestamp out into a time period (e.g. an hour, a day, a week, etc)
     * and the number of units of the time period.
     *
     * This is mainly for use in forms which provide 2 fields for specifying
     * a duration.
     *
     * @global array $TIMEALLOWANCESTRINGS
     * @param int $duration
     * @return object Containing $num and $period properties
     */
    public static function duration_explode($duration) {
        global $TIMEALLOWANCESTRINGS;

        $ob = new stdClass();

        if($duration % DURATION_YEAR == 0) {
            $ob->num = $duration / DURATION_YEAR;
            $ob->period = TIME_SELECTOR_YEARS;
        } else if($duration % DURATION_MONTH == 0) {
            $ob->num = $duration / DURATION_MONTH;
            $ob->period = TIME_SELECTOR_MONTHS;
        } else if($duration % DURATION_WEEK == 0) {
            $ob->num = $duration / DURATION_WEEK;
            $ob->period = TIME_SELECTOR_WEEKS;
        } else if($duration % DURATION_DAY == 0) {
            $ob->num = $duration / DURATION_DAY;
            $ob->period = TIME_SELECTOR_DAYS;
        } else if($duration % DURATION_HOUR == 0) {
            $ob->num = $duration / DURATION_HOUR;
            $ob->period = TIME_SELECTOR_HOURS;
        } else {
            $ob->num = 0;
            $ob->period = 0;
        }

        if(array_key_exists($ob->period, $TIMEALLOWANCESTRINGS)) {
            $ob->periodstr = strtolower($TIMEALLOWANCESTRINGS[$ob->period]);
        } else {
            $ob->periodstr = '';
        }

        return $ob;

    }


    /**
     * Prints or returns the html for the time allowance fields
     *
     * @param <type> $prefix
     * @param <type> $periodvalue
     * @param <type> $numbervalue
     * @param <type> $return
     * @return <type>
     */
    public static function print_duration_selector($prefix, $periodelementname, $periodvalue, $numberelementname, $numbervalue, $return=false, $includehours=true) {
        global $TIMEALLOWANCESTRINGS;

        $timeallowances = array();
        if ($includehours) {
            $timeallowances[TIME_SELECTOR_HOURS] = get_string('hours', 'local_program');
        }
        $timeallowances[TIME_SELECTOR_DAYS] = get_string('days', 'local_program');
        $timeallowances[TIME_SELECTOR_WEEKS] = get_string('weeks', 'local_program');
        $timeallowances[TIME_SELECTOR_MONTHS] = get_string('months', 'local_program');

        $m_name = $prefix.$periodelementname;
        $m_id = $prefix.$periodelementname;
        $m_selected = $periodvalue;
        $m_nothing = '';
        $m_nothingvalue = '';
        $m_script = '';
        $m_return = true;
        $m_disabled = false;
        $m_tabindex = 0;

        $out = '';
        $out .= '<input type="text" name="'.$prefix.$numberelementname.'" id="'.$prefix.$numberelementname.'" value="'.$numbervalue.'" size="4" maxlength="3">';
        $out .= choose_from_menu($timeallowances, $m_name, $m_selected, $m_nothing, $m_script, $m_nothingvalue, $m_return, $m_disabled, $m_tabindex, $m_id);

        if($return) {
            return $out;
        } else {
            echo $out;
        }
    }

    public static function get_standard_time_allowance_options() {
        $timeallowances = array(
            TIME_SELECTOR_DAYS => get_string('days', 'local_program'),
            TIME_SELECTOR_WEEKS => get_string('weeks', 'local_program'),
            TIME_SELECTOR_MONTHS => get_string('months', 'local_program'),
        );
        return $timeallowances;
    }

}

class ProgramException extends Exception {

}

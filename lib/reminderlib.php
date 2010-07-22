<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**
 * Reminder functionality
 *
 * @package   Totara
 * @copyright 2010 Catalyst IT Ltd
 * @author    Aaron Barnes <aaronb@catalyst.net.nz>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once($CFG->libdir.'/data_object.php');
require_once($CFG->libdir.'/completionlib.php');


/**
 * Return an array of all reminders set for a course
 *
 * @access  public
 * @param   $courseid   int
 * @return  array
 */
function get_course_reminders($courseid) {

    // Get all reminder objects
    $where = array(
        'courseid'  => $courseid,
        'deleted'   => 0
    );

    $reminders = reminder::fetch_all($where);

    // Make sure we always return an array
    if ($reminders) {
        return $reminders;
    }
    else {
        return array();
    }
}


/**
 * Reminder object, defines what the reminder
 * is tracking, it's title, etc.
 *
 * No much use by itself, but is required to
 * associate reminder_message's with
 *
 * @access  public
 */
class reminder extends data_object {

    /**
     * DB table
     * @var string  $table
     */
    public $table = 'reminder';

    /**
     * Array of required table fields, must start with 'id'.
     * @var array   $required_fields
     */
    public $required_fields = array('id', 'courseid', 'title', 'type',
        'timecreated', 'timemodified', 'modifierid', 'config', 'deleted');

    /**
     * The course this reminder is associated with
     * @access  public
     * @var     int
     */
    public $courseid;

    /**
     * Reminder title, for configuration display purposes
     * @access  public
     * @var     string
     */
    public $title;

    /**
     * Reminder message type - needs to be supported in code
     * @access  public
     * @var     string
     */
    public $type;

    /**
     * Time the reminder was created
     * @access  public
     * @var     int
     */
    public $timecreated;

    /**
     * Time the reminder or it's messages were last modified
     * @access  public
     * @var     int
     */
    public $timemodified;

    /**
     * ID of the last user to modifiy the reminder or messages
     * @access  public
     * @var     int
     */
    public $modifierid;

    /**
     * Config data, used by the code handling the reminder's "type"
     * @access  public
     * @var     mixed
     */
    public $config;

    /**
     * Deleted flag
     * @access  public
     * @var     int
     */
    public $deleted;


    /**
     * Finds and returns all data_object instances based on params.
     *
     * @param array $params associative arrays varname=>value
     * @return array array of data_object insatnces or false if none found.
     */
    public static function fetch_all($params) {
        return self::fetch_all_helper(
            'reminder',
            'reminder',
            $params
        );
    }


    /**
     * Get all associated reminder_message objects
     *
     * @access  public
     * @return  array
     */
    public function get_messages() {
        // Get any non-deleted messages
        $messages = reminder_message::fetch_all(
            array(
                'reminderid'    => $this->id,
                'deleted'       => 0
            )
        );

        // Make sure we always return an array
        if ($messages) {
            return $messages;
        }
        else {
            return array();
        }
    }


    /**
     * Return an object containing all the reminder and
     * message data in a format that suits the reminder_edit_form
     * definition
     *
     * @access  public
     * @return  object
     */
    public function get_form_data() {

        $formdata = clone $this;

        // Get tracked activity/course
        if (!empty($this->config)) {
            $config = unserialize($this->config);
            $formdata->tracking = $config['tracking'];
        }

        // Get an existing reminder messages
        foreach (array('invitation', 'reminder', 'escalation') as $mtype) {

            // Generate property names
            $nosend = "{$mtype}dontsend";
            $p = "{$mtype}period";
            $sm = "{$mtype}skipmanager";
            $s = "{$mtype}subject";
            $m = "{$mtype}message";

            $message = new reminder_message(
                array(
                    'reminderid'    => $this->id,
                    'deleted'       => 0,
                    'type'          => $mtype
                )
            );

            $formdata->$p = $message->period;
            $formdata->$sm = $message->copyto;
            $formdata->$s = $message->subject;
            $formdata->$m = $message->message;

            // If the message doesn't exist, and this is
            // a saved reminder - mark it as nosend
            if ($this->id && !$message->id) {
                $formdata->$nosend = 1;
            }
        }

        return $formdata;
    }
}


/**
 * Reminder_message object, defines the reminder
 * period, and email contents
 *
 * @access  public
 */
class reminder_message extends data_object {

    /**
     * DB table
     * @var string  $table
     */
    public $table = 'reminder_message';

    /**
     * Array of required table fields, must start with 'id'.
     * @var array   $required_fields
     */
    public $required_fields = array('id', 'reminderid', 'type', 'period',
        'subject', 'message', 'copyto', 'deleted');

    /**
     * Reminder record this message is associated with
     * @access  public
     * @var     int
     */
    public $reminderid;

    /**
     * Reminder message type - needs to be supported in code
     * @access  public
     * @var     string
     */
    public $type;

    /**
     * # of days after the tracked event occurs the message
     * needs to be sent
     * @access  public
     * @var     int
     */
    public $period;

    /**
     * Email message subject
     *
     * Will be run through reminder_email_substitutions()
     * @access  public
     * @var     string
     */
    public $subject;

    /**
     * Email message content
     *
     * Will be run through reminder_email_substitutions()
     * @access  public
     * @var     string
     */
    public $message;

    /**
     * Toggle where the email is copied to the users manager
     *
     * Badly named at the moment, as the only time the email
     * is copied is when the message is of type "escalation" and
     * $copyto is set to 0
     *
     * @TODO FIX COL NAME
     *
     * @access  public
     * @var     int
     */
    public $copyto;

    /**
     * Deleted flag
     * @access  public
     * @var     int
     */
    public $deleted;


    /**
     * Finds and returns a data_object instance based on params.
     * @static abstract
     *
     * @param array $params associative arrays varname=>value
     * @return object data_object instance or false if none found.
     */
    public static function fetch($params) {
        return self::fetch_helper(
            'reminder_message',
            'reminder_message',
            $params
        );
    }


    /**
     * Finds and returns all data_object instances based on params.
     *
     * @param array $params associative arrays varname=>value
     * @return array array of data_object insatnces or false if none found.
     */
    public static function fetch_all($params) {
        return self::fetch_all_helper(
            'reminder_message',
            'reminder_message',
            $params
        );
    }
}


/**
 * Cron function for sending out reminder messages, runs every cron iteration
 *
 * Loops through reminders, checking if the trigger event has required period
 * fore each of the messages has passed, then sends emails out recording
 * success in the reminder_sent table
 *
 * Called from admin/cron.php
 *
 * @access  public
 */
function reminder_cron() {
    global $CFG;

    // Get reminders
    $reminders = reminder::fetch_all(
        array(
            'deleted'   => 0
        )
    );

    // Loop through reminders
    foreach ($reminders as $reminder) {

        // Get messages
        $messages = $reminder->get_messages();

        switch ($reminder->type) {
            case 'completion':

                // Check completion is still enabled in this course
                $course = get_record('course', 'id', $reminder->courseid);
                $completion = new completion_info($course);

                if (!$completion->is_enabled()) {
                    mtrace('Completion no longer enabled in course: '.$course->id.', skipping');
                    continue;
                }

                mtrace('Processing reminder "'.$reminder->title.'" for course "'.$course->fullname.'" ('.$course->id.')');

                // Get the tracked activity/course
                $config = unserialize($reminder->config);

                // Check if we are tracking the course
                if ($config['tracking'] == 0) {
                    $tsql = "
                        INNER JOIN
                            {$CFG->prefix}course_completions cc
                         ON cc.course = {$course->id}
                        AND cc.userid = u.id
                    ";
                }
                // Otherwise get the activity
                else {

                    // Load moduleinstance
                    $cm = get_record('course_modules', 'id', $config['tracking']);
                    $module = get_field('modules', 'name', 'id', $cm->module);

                    $tsql = "
                        INNER JOIN
                            {$CFG->prefix}course_completion_criteria cr
                         ON cr.course = {$course->id}
                        AND cr.criteriatype = ".COMPLETION_CRITERIA_TYPE_ACTIVITY."
                        AND cr.module = '{$module}'
                        AND cr.moduleinstance = {$config['tracking']}
                        INNER JOIN
                            {$CFG->prefix}course_completion_crit_compl cc
                         ON cc.course = {$course->id}
                        AND cc.userid = u.id
                        AND cc.criteriaid = cr.id
                    ";
                }

                // Process each message
                foreach ($messages as $message) {

                    // # of seconds after completion (for timestamp comparison)
                    if ($message->period) {
                        $periodsecs = (int) $message->period * 24 * 60 * 60;
                    }
                    else {
                        $periodsecs = 0;
                    }

                    $now = time();

                    // Get anyone that needs a reminder sent
                    // and hasn't had one already
                    $sql = "
                        SELECT
                            u.*,
                            cc.timecompleted
                        FROM
                            {$CFG->prefix}user u
                        {$tsql}
                        LEFT JOIN
                            {$CFG->prefix}reminder_sent rs
                            ON rs.userid = u.id
                        AND rs.reminderid = {$reminder->id}
                        AND rs.messageid = {$message->id}
                        WHERE
                            rs.id IS NULL
                        AND (cc.timecompleted + {$periodsecs}) >= {$reminder->timecreated}
                        AND (cc.timecompleted + {$periodsecs}) < {$now}
                    ";

                    // Check if any users found
                    if (!$rs = get_recordset_sql($sql)) {
                        return;
                    }

                    // Get manager location
                    static $managerfield;
                    if (!$managerfield) {
                        $managerfield = get_field('user_info_field', 'id', 'shortname', 'managerid');
                    }

                    // Get deadline
                    $message->deadline = get_field(
                        'reminder_message',
                        'period',
                        'reminderid', $reminder->id,
                        'type', 'escalation',
                        'deleted', 0
                    );

                    // Message sent counts
                    $msent = 0;
                    $mfail = 0;

                    // Loop through results and send emails
                    while ($user = rs_fetch_next_record($rs)) {

                        // Check that even with weekends accounted for, the period
                        // has still passed
                        if (!reminder_check_businessdays($user->timecompleted, $message->period)) {
                            continue;
                        }

                        // Load user's manager (or grab from cache)
                        $managerid = get_field('user_info_data', 'data', 'userid', $user->id, 'fieldid', $managerfield);

                        // If no manager, skip
                        if (!$managerid) {
                            $manager = false;
                        }
                        else {
                            static $managers;
                            if (!isset($managers[$managerid])) {
                                $managers[$managerid] = get_record('user', 'id', $managerid);
                            }

                            $manager = $managers[$managerid];
                        }

                        // Generate email content
                        $user->manager = $manager;
                        $content = reminder_email_substitutions($message->message, $user, $course, $message, $reminder);
                        $subject = reminder_email_substitutions($message->subject, $user, $course, $message, $reminder);

                        // Send email
                        if (email_to_user($user, '', $subject, $content, '')) {

                            $sent = new stdClass();
                            $sent->reminderid = $reminder->id;
                            $sent->messageid = $message->id;
                            $sent->userid = $user->id;
                            $sent->timesent = time();

                            // Record in database
                            if (!insert_record('reminder_sent', $sent)) {
                                mtrace('ERROR: Failed to insert reminder_sent record for userid '.$user->id);
                                ++$mfail;
                            }
                            else {
                                ++$msent;
                            }
                        }
                        else {
                            ++$mfail;
                            mtrace('Could not send email to '.$user->email);
                        }

                        // Check if we need to send to their manager also
                        if ($message->type === 'escalation' && empty($message->copyto)) {

                            // Send email
                            $manager->manager = $manager;
                            if (email_to_user($manager, '', $subject, $content, '')) {
                                ++$msent;
                            }
                            else {
                                ++$mfail;
                                mtrace('Could not send email to '.$user->email.'\'s manager '.$manager->email);
                            }
                        }
                    }

                    // Show stats for message
                    mtrace($msent.' "'.$message->type.'" type messages sent');
                    if ($mfail) {
                        mtrace($mfail.' "'.$message->type.'" type messages failed');
                    }
                }

                break;

            default:
                mtrace('Unsupported reminder type: '.$reminder->type);
        }
    }
}


/**
 * Make placeholder substitutions to a string (for make=ing emails dynamic)
 *
 * @access  private
 * @param   $content    string  String to make substitutions to
 * @param   $user       object  Recipients details
 * @param   $course     object  The reminder's course
 * @param   $message    object  The reminder message object
 * @param   $reminder   object  The reminder object
 * @return  string
 */
function reminder_email_substitutions($content, $user, $course, $message, $reminder) {
    global $CFG;

    // Generate substitution array
    $place = array();
    $subs = array();

    // User details
    $place[] = get_string('placeholder:firstname', 'reminders');
    $subs[] = $user->firstname;
    $place[] = get_string('placeholder:lastname', 'reminders');
    $subs[] = $user->lastname;

    // Course details
    $place[] = get_string('placeholder:coursepageurl', 'reminders');
    $subs[] = "{$CFG->wwwroot}/course/view.php?id={$course->id}";
    $place[] = get_string('placeholder:coursename', 'reminders');
    $subs[] = $course->fullname;

    // Manager name
    $place[] = get_string('placeholder:managername', 'reminders');
    $subs[] = $user->manager ? fullname($user->manager) : get_string('nomanagermessage', 'reminders');

    // Day counts
    $place[] = get_string('placeholder:dayssincecompletion', 'reminders');
    $subs[] = $message->period;
    $place[] = get_string('placeholder:daysuntildeadline', 'reminders');
    $subs[] = $message->deadline;

    // Make substitutions
    $content = str_replace($place, $subs, $content);

    return $content;
}


/**
 * Check that required time has still passed even if ignoring weekends
 *
 * @TODO create some simpletests
 * @access  private
 * @param   $timestamp  int Event timestamp
 * @param   $period     int Number of days since
 * @return  boolean
 */
function reminder_check_businessdays($timestamp, $period) {
    // If no period, then it's instantaneous and has already passed
    if (!$period) {
        return true;
    }

    // Loop through each day and if not a weekend, add it to the timestamp
    for ($reminderday = 0; $reminderday < $period + 1; $reminderday++ ) {

        // Add 24 hours to the timestamp
        $timestamp += (24 * 3600);

        // Saturdays and Sundays are not included in the
        // reminder period as entered by the user, extend
        // that period by 1
        $reminderdaycheck = userdate($reminderdaytime, '%u');
        if ($reminderdaycheck > 5) {
            $period++;
        }

        // If the timestamp move into the future after ignoring weekends,
        // return false
        if ($timestamp >= time()) {
            return false;
        }
    }

    // Timestamp must still be in the past
    return true;
}

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
 * Course completion status for a particular user/course
 *
 * @package   moodlecore
 * @copyright 2009 Catalyst IT Ltd
 * @author    Aaron Barnes <aaronb@catalyst.net.nz>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once($CFG->libdir.'/data_object.php');
require_once($CFG->libdir.'/completionlib.php');
require_once($CFG->dirroot.'/blocks/totara_stats/locallib.php');
require_once($CFG->dirroot.'/local/plan/lib.php');

/**
 * Course completion status constants
 *
 * For translating database recorded integers to strings and back
 */
define('COMPLETION_STATUS_NOTYETSTARTED',   10);
define('COMPLETION_STATUS_INPROGRESS',      25);
define('COMPLETION_STATUS_COMPLETE',        50);
define('COMPLETION_STATUS_COMPLETEVIARPL',  75);

global $COMPLETION_STATUS;
$COMPLETION_STATUS = array(
    COMPLETION_STATUS_NOTYETSTARTED => 'notyetstarted',
    COMPLETION_STATUS_INPROGRESS => 'inprogress',
    COMPLETION_STATUS_COMPLETE => 'complete',
    COMPLETION_STATUS_COMPLETEVIARPL => 'completeviarpl',
);


/**
 * Course completion status for a particular user/course
 */
class completion_completion extends data_object {

    /**
     * DB Table
     * @var string $table
     */
    public $table = 'course_completions';

    /**
     * Array of required table fields, must start with 'id'.
     * @var array $required_fields
     */
    public $required_fields = array('id', 'userid', 'course', 'organisationid', 'positionid',
        'deleted', 'timenotified', 'timeenrolled', 'timestarted', 'timecompleted', 'rpl', 'reaggregate', 'status');

    /**
     * Array of optional table fields
     * @var array $optional_fields
     */
    public $optional_fields = array('name' => '');

    /**
     * User ID
     * @access  public
     * @var     int
     */
    public $userid;

    /**
     * Course ID
     * @access  public
     * @var     int
     */
    public $course;

    /**
     * ID of the user's organisation when they achieved this course completion
     *
     * This is taken from their primary position assignment (if any)
     * @access  public
     * @var     int
     */
    public $organisationid;

    /**
     * ID of the user's position when they achieved this course completion
     *
     * This is taken from their primary position assignment (if any)
     * @access  public
     * @var     int
     */
    public $positionid;

    /**
     * Set to 1 if this record has been deleted
     * @access  public
     * @var     int
     */
    public $deleted;

    /**
     * Record of prior learning, leave blank if none
     * @access  public
     * @var     string
     */
    public $rpl;

    /**
     * Timestamp the interested parties were notified
     * of this user's completion
     * @access  public
     * @var     int
     */
    public $timenotified;

    /**
     * Time of course enrolment
     * @see     completion_completion::mark_enrolled()
     * @access  public
     * @var     int
     */
    public $timeenrolled;

    /**
     * Time the user started their course completion
     * @see     completion_completion::mark_inprogress()
     * @access  public
     * @var     int
     */
    public $timestarted;

    /**
     * Timestamp of course completion
     * @see     completion_completion::mark_complete()
     * @access  public
     * @var     int
     */
    public $timecompleted;

    /**
     * Flag to trigger cron aggregation (timestamp)
     * @access  public
     * @var     int
     */
    public $reaggregate;

    /**
     * Course name (optional field)
     * @access  public
     * @var     string
     */
    public $name;

    /**
     * Status constant
     * @access  public
     * @var     int
     */
    public $status;


    /**
     * Finds and returns a data_object instance based on params.
     * @static static
     *
     * @param array $params associative arrays varname=>value
     * @return object data_object instance or false if none found.
     */
    public static function fetch($params) {
        $params['deleted'] = null;
        return self::fetch_helper('course_completions', __CLASS__, $params);
    }


    /**
     * Return user's status
     *
     * Uses the following properties to calculate:
     *  - $timeenrolled
     *  - $timestarted
     *  - $timecompleted
     *  - $rpl
     *
     * @static static
     *
     * @param   object  $completion  Object with at least the described columns
     * @return  str     Completion status lang string key
     */
    public static function get_status($completion) {
        // Check if a completion record was supplied
        if (!is_object($completion)) {
            error('Incorrect data supplied to calculate Completion status');
        }

        // Check we have the required data, if not the user is probably not
        // participation in the course
        if (empty($completion->timeenrolled) &&
            empty($completion->timestarted) &&
            empty($completion->timecompleted))
        {
            return '';
        }

        // Check if complete
        if ($completion->timecompleted) {

            // Check for RPL
            if (isset($completion->rpl) && strlen($completion->rpl)) {
                return 'completeviarpl';
            }
            else {
                return 'complete';
            }
        }

        // Check if in progress
        elseif ($completion->timestarted) {
            return 'inprogress';
        }

        // Otherwise not yet started
        elseif ($completion->timeenrolled) {
            return 'notyetstarted';
        }

        // Otherwise they are not participating in this course
        else {
            return '';
        }
    }


    /**
     * Return status of this completion
     * @access  public
     * @return  boolean
     */
    public function is_complete() {
        return (bool) $this->timecompleted;
    }

    /**
     * Mark this user as started (or enrolled) in this course
     *
     * If the user is already marked as started, no change will occur
     *
     * @access  public
     * @param   integer $timeenrolled Time enrolled (optional)
     * @return  void
     */
    public function mark_enrolled($timeenrolled = null) {

        if (!$this->timeenrolled) {

            if (!$timeenrolled) {
                $timeenrolled = time();
            }

            $this->timeenrolled = $timeenrolled;

        }

        if (!$this->_save()) {
            return false;
        }

        totara_stats_add_event(time(), $this->userid, STATS_EVENT_COURSE_STARTED, '', $this->course);
    }

    /**
     * Mark this user as inprogress in this course
     *
     * If the user is already marked as inprogress,
     * the time will not be changed
     *
     * @access  public
     * @param   integer $timestarted Time started (optional)
     * @return  void
     */
    public function mark_inprogress($timestarted = null) {

        $timenow = time();

        // Set reaggregate flag
        $this->reaggregate = $timenow;

        if (!$this->timestarted) {

            if (!$timestarted) {
                $timestarted = $timenow;
            }

            $this->timestarted = $timestarted;

        }

        $wasenrolled = $this->timeenrolled;

        if (!$this->_save()) {
            return false;
        }

        if (!$wasenrolled) {
            totara_stats_add_event($timenow, $this->userid, STATS_EVENT_COURSE_STARTED, '', $this->course);
        }
    }

    /**
     * Mark this user complete in this course
     *
     * This generally happens when the required completion criteria
     * in the course are complete.
     *
     * @access  public
     * @param   integer $timecomplete Time completed (optional)
     * @return  void
     */
    public function mark_complete($timecomplete = null) {
        global $CFG;

        // Never change a completion time
        if (!$this->timecompleted) {

            // Use current time if nothing supplied
            if (!$timecomplete) {
                $timecomplete = time();
            }

            // Set time complete
            $this->timecompleted = $timecomplete;
        }

        // Get user's positionid and organisationid if not already set
        if ($this->positionid === null) {
            require_once("{$CFG->dirroot}/hierarchy/prefix/position/lib.php");

            // Attempt to load user's position assignment
            $pa = new position_assignment(array('userid' => $this->userid, 'type' => POSITION_TYPE_PRIMARY));

            // If no position assignment present, set values to 0
            if (!$pa->id) {
                $this->positionid = 0;
                $this->organisationid = 0;
            }
            else {
                $this->positionid = $pa->positionid ? $pa->positionid : 0;
                $this->organisationid = $pa->organisationid ? $pa->organisationid : 0;
            }
        }

        // Save record
        if (!$this->_save()) {
            return false;
        }

        totara_stats_add_event(time(), $this->userid, STATS_EVENT_COURSE_COMPLETE, '', $this->course);

        //Auto plan completion hook
        dp_plan_item_updated($this->userid, 'course', $this->course);
    }

    /**
     * Save course completion status
     *
     * This method creates a course_completions record if none exists
     * @access  private
     * @return  bool
     */
    private function _save() {

        if (!$this->timeenrolled) {
            // Get users timenrolled
            // Can't find a more efficient way of doing this without alter get_users_by_capability()
            $context = get_context_instance(CONTEXT_COURSE, $this->course);
            $this->timeenrolled = get_field('role_assignments', 'timestart', 'contextid', $context->id, 'userid', $this->userid);
        }


        // Update status column
        $status = completion_completion::get_status($this);
        if ($status) {
            $status = constant('COMPLETION_STATUS_'.strtoupper($status));
        }

        $this->status = $status;

        // Save record
        if ($this->id) {
            // Attempt to update, and return the results
            return $this->update();
        } else {
            // Make sure reaggregate field is not null
            if (!$this->reaggregate) {
                $this->reaggregate = 0;
            }

            // Make sure timestarted is not null
            if (!$this->timestarted) {
                $this->timestarted = 0;
            }

            // Attempt to insert, and return the results
            return $this->insert();
        }
    }
}


/**
 * Role assigned event handler for creating a user's completion record when
 * enroling in a course
 *
 * @global  $CFG
 * @access  public
 * @param   object  $eventdata  Matches the row from mdl_role_assignments
 * @return  true
 */
function completion_eventhandler_role_assigned($eventdata) {

    // Get course context
    $context = get_context_instance_by_id($eventdata->contextid);

    // Check if this is during installation
    if ($context->instanceid == 0) {
        return true;
    }

    // Check if this is a course context role assignment
    if ($context->contextlevel != CONTEXT_COURSE) {
        return true;
    }

    // Load course
    if (!$course = get_record('course', 'id', $context->instanceid)) {
        debugging('Could not load course id '.$context->instanceid);
        return true;
    }

    // Create completion object
    $completion_info = new completion_info($course);

    // Check completion is enabled for this site and course
    if (!$completion_info->is_enabled()) {
        return true;
    }

    // If completion not set to start on enrollment, do nothing
    if (empty($course->completionstartonenrol)) {
        return true;
    }

    // Check if this user is not in a tracked role in the course
    if (!$completion_info->is_tracked_user($eventdata->userid)) {
        return true;
    }

    // Create completion record
    $data = array(
        'userid'    => $eventdata->userid,
        'course'    => $course->id
    );
    $completion = new completion_completion($data);

    // Completion start on enrollment needs timestarted set
    $completion->timeenrolled = $eventdata->timestart;
    $completion->timestarted = $completion->timeenrolled;

    // Update record
    $completion->mark_enrolled();

    return true;
}


/**
 * Scan a course (or the entire site) for tracked users who
 * do not have completion records in courses with completion
 * enabled and completionstartonenrol set
 *
 * @access  public
 * @param   int     $courseid   (optional)
 * @return  void
 */
function completion_mark_users_started($courseid = null) {
    global $CFG;

    $roles = '';
    if (!empty($CFG->progresstrackedroles)) {
        $roles = 'AND ra.roleid IN ('.$CFG->progresstrackedroles.')';
    }

    // Save calls to time()
    $time = time();

    // Course where clause
    $cwhere = '';
    if ($courseid !== null) {
        $cwhere = 'AND c.id = '.(int)$courseid;
    }

    // Generate SQL
    $sql = "
        SELECT DISTINCT
            c.id AS course,
            ra.userid AS userid,
            crc.id AS completionid,
            MIN(ra.timestart) AS timestarted
        FROM
            {$CFG->prefix}course c
        INNER JOIN
            {$CFG->prefix}context con
        ON con.instanceid = c.id
        INNER JOIN
            {$CFG->prefix}role_assignments ra
        ON ra.contextid = con.id
        LEFT JOIN
            {$CFG->prefix}course_completions crc
        ON crc.course = c.id
        AND crc.userid = ra.userid
        WHERE
            con.contextlevel = ".CONTEXT_COURSE."
        AND c.enablecompletion = 1
        AND c.completionstartonenrol = 1
        AND crc.timeenrolled IS NULL
        AND (ra.timeend = 0 OR ra.timeend > {$time})
        {$cwhere}
        {$roles}
        GROUP BY
            c.id,
            ra.userid,
            crc.id
        ORDER BY
            course,
            userid
    ";

    // Check if result is empty
    if (!$rs = get_recordset_sql($sql)) {
        return;
    }

    // Grab records for current user/course
    while ($record = rs_fetch_next_record($rs)) {
        $completion = new completion_completion();
        $completion->userid = $record->userid;
        $completion->course = $record->course;
        $completion->timeenrolled = $record->timestarted;

        if ($record->completionid) {
            $completion->id = $record->completionid;
        }

        // Completion start on enrollment needs timestarted set
        $completion->timestarted = $completion->timeenrolled;

        // Update record
        $completion->mark_enrolled();
    }

    $rs->close();
}

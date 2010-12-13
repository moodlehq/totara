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
require_once($CFG->dirroot.'/blocks/totara_stats/locallib.php');


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
    public $required_fields = array('id', 'userid', 'course', 'deleted', 'timenotified',
        'timeenrolled', 'timestarted', 'timecompleted', 'rpl', 'reaggregate');

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
        // participationg in the course
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

        totara_stats_add_event(time(), $this->userid, STATS_EVENT_COURSE_STARTED, '', $this->course);

        $this->_save();
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

        if (!$this->timeenrolled) {
            totara_stats_add_event(time(), $this->userid, STATS_EVENT_COURSE_STARTED, '', $this->course);
        }

        $this->_save();
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

        // Never change a completion time
        if (!$this->timecompleted) {

            // Use current time if nothing supplied
            if (!$timecomplete) {
                $timecomplete = time();
            }

            // Set time complete
            $this->timecompleted = $timecomplete;
        }

        //
        totara_stats_add_event(time(), $this->userid, STATS_EVENT_COURSE_COMPLETE, '', $this->course);

        // Save record
        $this->_save();
    }

    /**
     * Save course completion status
     *
     * This method creates a course_completions record if none exists
     * @access  public
     * @return  void
     */
    private function _save() {

        if (!$this->timeenrolled) {
            // Get users timenrolled
            // Can't find a more efficient way of doing this without alter get_users_by_capability()
            $context = get_context_instance(CONTEXT_COURSE, $this->course);
            $this->timeenrolled = get_field('role_assignments', 'timestart', 'contextid', $context->id, 'userid', $this->userid);
        }

        // Save record
        if ($this->id) {
            $this->update();
        } else {
            // Make sure reaggregate field is not null
            if (!$this->reaggregate) {
                $this->reaggregate = 0;
            }

            // Make sure timestarted is not null
            if (!$this->timestarted) {
                $this->timestarted = 0;
            }

            $this->insert();
        }
    }
}

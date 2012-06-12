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
 * @package core_completion
 * @category completion
 * @copyright 2009 Catalyst IT Ltd
 * @author Aaron Barnes <aaronb@catalyst.net.nz>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

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
defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir.'/completion/data_object.php');

class completion_completion extends data_object {

    /* @var string $table Database table name that stores completion information */
    public $table = 'course_completions';

    /* @var array $required_fields Array of required table fields, must start with 'id'. */
    public $required_fields = array('id', 'userid', 'course', 'deleted', 'timenotified',
        'timeenrolled', 'timestarted', 'timecompleted', 'reaggregate', 'status');

    /* @var int $userid User ID */
    public $userid;

    /* @var int $course Course ID */
    public $course;

    /* @var int $deleted set to 1 if this record has been deleted */
    public $deleted;

    /* @var int Timestamp the interested parties were notified of this user's completion. */
    public $timenotified;

    /* @var int Time of course enrolment {@link completion_completion::mark_enrolled()} */
    public $timeenrolled;

    /* @var int Time the user started their course completion {@link completion_completion::mark_inprogress()} */
    public $timestarted;

    /* @var int Timestamp of course completion {@link completion_completion::mark_complete()} */
    public $timecompleted;

    /* @var int Flag to trigger cron aggregation (timestamp) */
    public $reaggregate;

    /* @var int Completion status constant */
    public $status;


    /**
     * Finds and returns a data_object instance based on params.
     *
     * @param array $params associative arrays varname = >value
     * @return data_object instance of data_object or false if none found.
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
            throw new coding_exception('Incorrect data supplied to calculate Completion status');
        }

        // Check we have the required data, if not the user is probably not
        // participating in the course
        if (empty($completion->timeenrolled) &&
            empty($completion->timestarted) &&
            empty($completion->timecompleted))
        {
            return '';
        }

        // Check if complete
        if ($completion->timecompleted) {
            return 'complete';
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
     *
     * @return bool
     */
    public function is_complete() {
        return (bool) $this->timecompleted;
    }

    /**
     * Mark this user as started (or enrolled) in this course
     *
     * If the user is already marked as started, no change will occur
     *
     * @param integer $timeenrolled Time enrolled (optional)
     */
    public function mark_enrolled($timeenrolled = null) {

        if ($this->timeenrolled === null) {

            if ($timeenrolled === null) {
                $timeenrolled = time();
            }

            $this->timeenrolled = $timeenrolled;
        }

        return $this->_save();
    }

    /**
     * Mark this user as inprogress in this course
     *
     * If the user is already marked as inprogress, the time will not be changed
     *
     * @param integer $timestarted Time started (optional)
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

        return $this->_save();
    }

    /**
     * Mark this user complete in this course
     *
     * This generally happens when the required completion criteria
     * in the course are complete.
     *
     * @param integer $timecomplete Time completed (optional)
     * @return void
     */
    public function mark_complete($timecomplete = null) {

        // Never change a completion time
        if ($this->timecompleted) {
            return;
        }

        // Use current time if nothing supplied
        if (!$timecomplete) {
            $timecomplete = time();
        }

        // Set time complete
        $this->timecompleted = $timecomplete;

        // Save record
        return $this->_save();
    }

    /**
     * Save course completion status
     *
     * This method creates a course_completions record if none exists
     * @access  private
     * @return  bool
     */
    private function _save() {
        if ($this->timeenrolled === null) {
            $this->timeenrolled = 0;
        }

        // Update status column
        $status = completion_completion::get_status($this);
        if ($status) {
            $status = constant('COMPLETION_STATUS_'.strtoupper($status));
        }

        $this->status = $status;

        // Save record
        if ($this->id) {
            return $this->update();
        } else {
            // We should always be reaggregating when new course_completions
            // records are created as they might have already completed some
            // criteria before enrolling
            if (!$this->reaggregate) {
                $this->reaggregate = time();
            }

            // Make sure timestarted is not null
            if (!$this->timestarted) {
                $this->timestarted = 0;
            }

            return $this->insert();
        }
    }
}

/* TODO: Stub function to be fixed when completion is updated in Moodle core (2.3 ?) */
function completion_eventhander_role_assigned($eventdata) {
    return true;
}

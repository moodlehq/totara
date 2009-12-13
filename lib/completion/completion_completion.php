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
    public $required_fields = array('id', 'userid', 'course', 'deleted', 'timenotified', 'timeenroled', 'timecompleted', 'rpl');

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
     * @access  public
     * @var     int
     */
    public $timeenroled;

    /**
     * Timestamp of course completion
     * @see     completion_completion::mark_complete()
     * @access  public
     * @var     int
     */
    public $timecompleted;


    /**
     * Finds and returns a data_object instance based on params.
     * @static abstract
     *
     * @param array $params associative arrays varname=>value
     * @return object data_object instance or false if none found.
     */
    public static function fetch($params) {
        $params['deleted'] = null;
        return self::fetch_helper('course_completions', __CLASS__, $params);
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
     * Mark this user complete in this course
     *
     * This generally happens when the required completion criteria
     * in the course are complete.
     *
     * This method creates a course_completions record
     * @access  public
     * @return  void
     */
    public function mark_complete() {

        $this->timecompleted = time();

        // Get users timenroled
        // Can't find a more efficient way of doing this without alter get_users_by_capability()
        $context = get_context_instance(CONTEXT_COURSE, $this->course);
        $this->timeenroled = get_field('role_assignments', 'timestart', 'contextid', $context->id, 'userid', $this->userid);

        // Save record
        if ($this->id) {
            $this->update();
        } else {
            $this->insert();
        }
    }
}

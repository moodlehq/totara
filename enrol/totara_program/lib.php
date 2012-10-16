<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
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
 * @author Ciaran Irvine <ciaran.irvine@totaralms.com>
 * @package enrol
 * @subpackage totara_program
 */

defined('MOODLE_INTERNAL') || die();

class enrol_totara_program_plugin extends enrol_plugin {

    /**
     * Returns link to page which may be used to add new instance of enrolment plugin in course.
     * @param int $courseid
     * @return moodle_url page url
     */
    public function get_newinstance_link($courseid) {
        global $DB;

        $context = context_course::instance($courseid);

        if (!has_capability('moodle/course:enrolconfig', $context) or !has_capability('enrol/guest:config', $context)) {
            return NULL;
        }

        if ($DB->record_exists('enrol', array('courseid' => $courseid, 'enrol' => 'totara_program'))) {
            return NULL;
        }

        return new moodle_url('/enrol/totara_program/addinstance.php', array('sesskey' => sesskey(), 'id' => $courseid));
    }

    /**
     * Add new instance of enrol plugin with default settings.
     * @param object $course
     * @return int id of new instance, null if can not be created
     */
    public function add_default_instance($course) {
        $fields = array('enrolperiod' => $this->get_config('enrolperiod', 0), 'roleid' => $this->get_config('roleid', 0));
        return $this->add_instance($course, $fields);
    }

    /**
     * Add new instance of enrol_totara_program plugin.
     * @param object $course
     * @param array instance fields
     * @return int id of new instance, or id of existing instance
     */
    public function add_instance($course, array $fields = NULL) {

        $instance = $this->get_instance_for_course($course->id);
        if (!$instance) {
            return parent::add_instance($course);
        } else {
            return $instance->id;
        }
    }

    /**
     * Get the name of the enrolment plugin
     *
     * @return string
     */
    public function get_name() {
        return 'totara_program';
    }

    /**
     * Users are able to be un-enroled from a course
     *
     * @return bool
     */
    public function allow_unenrol($instance) {
        return true;
    }

    /**
     * Get the instance of this plugin attached to a course if any
     * @param int $courseid id of course
     * @return object|bool $instance or false if not found
     */
    public function get_instance_for_course($courseid) {
        global $DB;
        return $DB->get_record('enrol', array('enrol' => 'totara_program', 'courseid' => $courseid));
    }

    /**
     * Attempt to automatically enrol current user in course without any interaction,
     * calling code has to make sure the plugin and instance are active.
     *
     * This should return either a timestamp in the future or false.
     *
     * @param stdClass $instance course enrol instance
     * @return bool|int false means not enrolled, integer means timeend
     */
    public function try_autoenrol($instance) {
        global $CFG, $OUTPUT, $USER, $DB;

        if ($course = $DB->get_record('course', array('id' => $instance->courseid))) {
            //because of use of constants and program class functions, best to leave the prog_can_enter_course function where it is
            require_once($CFG->dirroot . '/totara/program/lib.php');
            $result = prog_can_enter_course($USER, $course);

            if ($result->enroled) {
                //if we just enrolled them, set a notification
                if ($result->notify) {
                    $a = new stdClass();
                    $a->course = $course->fullname;
                    $a->program = $result->program;
                    totara_set_notification($OUTPUT->container(get_string('nowenrolled', 'enrol_totara_program', $a), 'plan_box'), null, array('class' => 'notifysuccess'));
                }
                //return 0 sets enrolment with no time limit
                return 0;
            }
        }
        return false;
    }

    /**
     * Gets an array of the user enrolment actions
     *
     * @param course_enrolment_manager $manager
     * @param stdClass $ue A user enrolment object
     * @return array An array of user_enrolment_actions
     */
    public function get_user_enrolment_actions(course_enrolment_manager $manager, $ue) {
        $actions = array();
        $context = $manager->get_context();
        $instance = $ue->enrolmentinstance;
        $params = $manager->get_moodlepage()->url->params();
        $params['ue'] = $ue->id;
        if ($this->allow_unenrol($instance) && has_capability("enrol/totara_program:unenrol", $context)) {
            $url = new moodle_url('/enrol/unenroluser.php', $params);
            $actions[] = new user_enrolment_action(new pix_icon('t/delete', ''), get_string('unenrol', 'enrol'), $url, array('class'=>'unenrollink', 'rel'=>$ue->id));
        }
        return $actions;
    }
}

/**
 * Indicates API features that the enrol plugin supports.
 *
 * @param string $feature
 * @return mixed True if yes (some features may use other values)
 */
function enrol_totara_program_supports($feature) {
    switch($feature) {
        case ENROL_RESTORE_TYPE:
            return ENROL_RESTORE_EXACT;

        default:
            return null;
    }
}

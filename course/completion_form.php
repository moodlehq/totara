<?php

///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT                                                   //
//                                                                       //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//          http://moodle.com                                            //
//                                                                       //
// Copyright (C) 1999 onwards Martin Dougiamas  http://dougiamas.com     //
//                                                                       //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

require_once($CFG->libdir.'/formslib.php');

class course_completion_form extends moodleform {

    function definition() {
        global $USER, $CFG;

        $courseconfig = get_config('moodlecourse');
        $mform    =& $this->_form;

        $course   = $this->_customdata['course'];
        $completion = new completion_info($course);

        $params = array(
            'course'  => $course->id
        );


/// form definition
//--------------------------------------------------------------------------------

        // Check if there is existing criteria completions
        if ($completion->is_course_locked()) {
            $mform->addElement('header', '', get_string('completionsettingslocked', 'completion'));
            $mform->addElement('static', '', '', get_string('err_settingslocked', 'completion'));
            $mform->addElement('submit', 'settingsunlock', get_string('unlockcompletiondelete', 'completion'));
        }

        // Get array of all available aggregation methods
        $aggregation_methods = $completion->get_aggregation_methods();

        // Overall criteria aggregation
        $mform->addElement('header', 'overallcriteria', get_string('overallcriteriaaggregation', 'completion'));
        $mform->addElement('select', 'overall_aggregation', get_string('aggregationmethod', 'completion'), $aggregation_methods);
        $mform->setDefault('overall_aggregation', $completion->get_aggregation_method());

        // Manual self completion
        $mform->addElement('header', 'manualselfcompletion', get_string('manualselfcompletion', 'completion'));
        $criteria = new completion_criteria_self($params);
        $criteria->config_form_display($mform);

        // Role completion criteria
        $mform->addElement('header', 'roles', get_string('manualcompletionby', 'completion'));

        $roles = get_roles_with_capability('moodle/course:markcomplete', CAP_ALLOW, get_context_instance(CONTEXT_COURSE, $course->id));

        if (!empty($roles)) {
            $mform->addElement('select', 'role_aggregation', get_string('aggregationmethod', 'completion'), $aggregation_methods);
            $mform->setDefault('role_aggregation', $completion->get_aggregation_method(COMPLETION_CRITERIA_TYPE_ROLE));

            foreach ($roles as $role) {
                $params_a = array('role' => $role->id);
                $criteria = new completion_criteria_role(array_merge($params, $params_a));
                $criteria->config_form_display($mform, $role);
            }
        } else {
            $mform->addElement('static', 'noroles', '', get_string('err_noroles', 'completion'));
        }

        // Activity completion criteria
        $mform->addElement('header', 'activitiescompleted', get_string('activitiescompleted', 'completion'));

        $activities = $completion->get_activities();
        if (!empty($activities)) {
            if (count($activities) > 1) {
                $mform->addElement('select', 'activity_aggregation', get_string('aggregationmethod', 'completion'), $aggregation_methods);
                $mform->setDefault('activity_aggregation', $completion->get_aggregation_method(COMPLETION_CRITERIA_TYPE_ACTIVITY));
            }

            foreach ($activities as $activity) {
                $params_a = array('moduleinstance' => $activity->id);
                $criteria = new completion_criteria_activity(array_merge($params, $params_a));
                $criteria->config_form_display($mform, $activity);
            }
        } else {
            $mform->addElement('static', 'noactivities', '', get_string('err_noactivities', 'completion'));
        }

        // Completion on date
        $mform->addElement('header', 'date', get_string('date'));
        $criteria = new completion_criteria_date($params);
        $criteria->config_form_display($mform);

        // Completion after enrolment duration
        $mform->addElement('header', 'duration', get_string('durationafterenrolment', 'completion'));
        $criteria = new completion_criteria_duration($params);
        $criteria->config_form_display($mform);

        // Completion on course grade
        $mform->addElement('header', 'grade', get_string('grade'));

        $course_grade = get_field('grade_items', 'gradepass', 'courseid', $course->id, 'itemtype', 'course');
        $criteria = new completion_criteria_grade($params);

        // Only display criteria enable if the course has a pass grade, or criteria already is setup
        if ($course_grade > 0 || $criteria->id) {
            $criteria->config_form_display($mform, $course_grade);
        } else {
            $mform->addElement('static', 'nograde', '', get_string('err_nograde', 'completion'));
        }

        // Completion on unenrolment
        $mform->addElement('header', 'unenrolment', get_string('unenrolment', 'completion'));
        $criteria = new completion_criteria_unenrol($params);
        $criteria->config_form_display($mform);


//--------------------------------------------------------------------------------
        $this->add_action_buttons();
//--------------------------------------------------------------------------------
        $mform->addElement('hidden', 'id', $course->id);
        $mform->setType('id', PARAM_INT);

        // If the criteria are locked, freeze values and submit button
        if ($completion->is_course_locked()) {
            $except = array('settingsunlock');
            $mform->hardFreezeAllVisibleExcept($except);
            $mform->addElement('cancel');
        }
    }


/// perform some extra moodle validation
    function validation($data, $files) {
        global $CFG;

        $errors = parent::validation($data, $files);

        return $errors;
    }
}
?>

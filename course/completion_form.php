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
        global $USER, $CFG, $js_enabled;

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
        $mform->setHelpButton('overallcriteria', array('completionoverallcriteria', get_string('overallcriteriaaggregation', 'completion')), true);

        $mform->addElement('select', 'overall_aggregation', get_string('aggregationmethod', 'completion'), $aggregation_methods);
        $mform->setDefault('overall_aggregation', $completion->get_aggregation_method());
        $mform->setHelpButton('overall_aggregation', array('completionaggregationmethod', get_string('aggregationmethod', 'completion')), true);

        // Course prerequisite completion criteria
        $mform->addElement('header', 'courseprerequisites', get_string('courseprerequisites', 'completion'));
        $mform->setHelpButton('courseprerequisites', array('completioncourseprerequisites', get_string('courseprerequisites', 'completion')), true);

        // Show noscript version if js off
        if (!$js_enabled) {
            // Get applicable courses
            $courses = get_records_sql(
                "
                    SELECT DISTINCT
                        c.id,
                        c.category,
                        c.fullname,
                        cc.id AS selected
                    FROM
                        {$CFG->prefix}course c
                    LEFT JOIN
                        {$CFG->prefix}course_completion_criteria cc
                     ON cc.courseinstance = c.id
                    AND cc.course = {$course->id}
                    INNER JOIN
                        {$CFG->prefix}course_completion_criteria ccc
                     ON ccc.course = c.id
                    WHERE
                        c.enablecompletion = ".COMPLETION_ENABLED."
                    AND c.id <> {$course->id}
                "
            );

            if (!empty($courses)) {
                if (count($courses) > 1) {
                    $mform->addElement('select', 'course_aggregation', get_string('aggregationmethod', 'completion'), $aggregation_methods);
                    $mform->setDefault('course_aggregation', $completion->get_aggregation_method(COMPLETION_CRITERIA_TYPE_COURSE));
                    $mform->setHelpButton('course_aggregation', array('completioncourseaggregationmethod', get_string('aggregationmethod', 'completion')), true);
                }

                // Get category list
                $list = array();
                $parents = array();
                make_categories_list($list, $parents);

                // Get course list for select box
                $selectbox = array();
                $selected = array();
                foreach ($courses as $c) {
                    $selectbox[$c->id] = $list[$c->category] . ' / ' . s($c->fullname);

                    // If already selected
                    if ($c->selected) {
                        $selected[] = $c->id;
                    }
                }

                // Show multiselect box
                $mform->addElement('select', 'criteria_course', get_string('coursesavailable', 'completion'), $selectbox, array('multiple' => 'multiple', 'size' => 6));

                // Select current criteria
                $mform->setDefault('criteria_course', $selected);

                // Explain list
                $mform->addElement('static', 'criteria_courses_explaination', '', get_string('coursesavailableexplaination', 'completion'));

                // Show js version
                $mform->addElement('static', 'showjsversion', '', '<small><a href="completion.php?id='.$course->id.'">'.get_string('usealternateselector', 'completion').'</a></small>');
            } else {
                $mform->addElement('static', 'nocourses', '', get_string('err_nocourses', 'completion'));
            }

        // If js turned on
        } else {
            // Get current prerequisites
            $courses = get_records_sql(
                "
                    SELECT DISTINCT
                        c.id,
                        c.category,
                        c.fullname
                    FROM
                        {$CFG->prefix}course c
                    INNER JOIN
                        {$CFG->prefix}course_completion_criteria cc
                     ON cc.courseinstance = c.id
                    AND cc.course = {$course->id}
                    WHERE
                        c.enablecompletion = ".COMPLETION_ENABLED."
                    AND c.id <> {$course->id}
                "
            );

            $mform->addElement('select', 'course_aggregation', get_string('aggregationmethod', 'completion'), $aggregation_methods);
            $mform->setDefault('course_aggregation', $completion->get_aggregation_method(COMPLETION_CRITERIA_TYPE_COURSE));
            $mform->setHelpButton('course_aggregation', array('completioncourseaggregationmethod', get_string('aggregationmethod', 'completion')), true);

            if (!empty($courses)) {
                foreach ($courses as $c) {
                    $mform->addelement('checkbox', "criteria_course[{$c->id}]", s($c->fullname));
                    $mform->setdefault('criteria_course['.$c->id.']', 1);
                }
            } else {
                $mform->addElement('static', 'nocoursesselected', '', '<span class="nocoursesselected"></span>'.get_string('err_nocoursesselected', 'completion'));
            }

            // Add new prerequisite button
            $mform->addElement('button', 'add_criteria_course', get_string('addcourseprerequisite', 'completion'));

            // Show non-js version
            $mform->addElement('static', 'shownonjsversion', '', '<small><a href="completion.php?id='.$course->id.'&js=0">'.get_string('usealternateselector', 'completion').'</a></small>');
        }

        // Manual self completion
        $mform->addElement('header', 'manualselfcompletion', get_string('manualselfcompletion', 'completion'));
        $mform->setHelpButton('manualselfcompletion', array('completionmanualselfcompletion', get_string('manualselfcompletion', 'completion')), true);
        $criteria = new completion_criteria_self($params);
        $criteria->config_form_display($mform);

        // Role completion criteria
        $mform->addElement('header', 'roles', get_string('manualcompletionby', 'completion'));
        $mform->setHelpButton('roles', array('completionmanualcompletionby', get_string('manualcompletionby', 'completion')), true);

        $roles = get_roles_with_capability('moodle/local:markcomplete', CAP_ALLOW, get_context_instance(CONTEXT_COURSE, $course->id));

        if (!empty($roles)) {
            $mform->addElement('select', 'role_aggregation', get_string('aggregationmethod', 'completion'), $aggregation_methods);
            $mform->setDefault('role_aggregation', $completion->get_aggregation_method(COMPLETION_CRITERIA_TYPE_ROLE));
            $mform->setHelpButton('role_aggregation', array('completionmanualcompletionbyaggregationmethod', get_string('aggregationmethod', 'completion')), true);

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
        $mform->setHelpButton('activitiescompleted', array('completionactivitiescompleted', get_string('activitiescompleted', 'completion')), true);

        $activities = $completion->get_activities();
        if (!empty($activities)) {
            if (count($activities) > 1) {
                $mform->addElement('select', 'activity_aggregation', get_string('aggregationmethod', 'completion'), $aggregation_methods);
                $mform->setDefault('activity_aggregation', $completion->get_aggregation_method(COMPLETION_CRITERIA_TYPE_ACTIVITY));
                $mform->setHelpButton('activity_aggregation', array('completionactivitiescompletedaggregationmethod', get_string('aggregationmethod', 'completion')), true);
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
        $mform->setHelpButton('date', array('completiondate', get_string('date')), true);
        $criteria = new completion_criteria_date($params);
        $criteria->config_form_display($mform);

        // Completion after enrolment duration
        $mform->addElement('header', 'duration', get_string('durationafterenrolment', 'completion'));
        $mform->setHelpButton('duration', array('completionduration', get_string('durationafterenrolment', 'completion')), true);
        $criteria = new completion_criteria_duration($params);
        $criteria->config_form_display($mform);

        // Completion on course grade
        $mform->addElement('header', 'grade', get_string('grade'));
        $mform->setHelpButton('grade', array('completiongrade', get_string('grade')), true);

        // Grade enable and pasing grade
        $course_grade = get_field('grade_items', 'gradepass', 'courseid', $course->id, 'itemtype', 'course');
        $criteria = new completion_criteria_grade($params);
        $criteria->config_form_display($mform, $course_grade);

        // Completion on unenrolment
        $mform->addElement('header', 'unenrolment', get_string('unenrolment', 'completion'));
        $mform->setHelpButton('unenrolment', array('completionunenrolment', get_string('completion')), true);
        $criteria = new completion_criteria_unenrol($params);
        $criteria->config_form_display($mform);

        // Do some cheeky stuff here to handle dynamically generated checkboxes
        // (they need to appear in the form definition for the data to come through)
        if ($js_enabled && !empty($_POST['criteria_course']) && is_array($_POST['criteria_course'])) {

            foreach ($_POST['criteria_course'] as $key => $value) {
                if ($mform->elementExists("criteria_course[{$key}]")) {
                    continue;
                }
                $mform->addelement('hidden', "criteria_course[{$key}]", $key);
                $mform->setType("criteria_course[{$key}]", PARAM_INT);
            }
        }


//--------------------------------------------------------------------------------
        $this->add_action_buttons();
//--------------------------------------------------------------------------------
        $mform->addElement('hidden', 'id', $course->id);
        $mform->setType('id', PARAM_INT);

        // Remember js setting
        $mform->addElement('hidden', 'js', $js_enabled);
        $mform->setType('js', PARAM_BOOL);

        // If the criteria are locked, freeze values and submit button
        if ($completion->is_course_locked()) {
            $except = array('settingsunlock');
            $mform->hardFreezeAllVisibleExcept($except);
            $mform->disabledif('add_criteria_course', 1);
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

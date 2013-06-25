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

// Edit course completion settings

require_once('../config.php');
require_once('lib.php');
require_once($CFG->libdir.'/completionlib.php');
require_once($CFG->dirroot.'/completion/criteria/completion_criteria_self.php');
require_once($CFG->dirroot.'/completion/criteria/completion_criteria_date.php');
require_once($CFG->dirroot.'/completion/criteria/completion_criteria_activity.php');
require_once($CFG->dirroot.'/completion/criteria/completion_criteria_duration.php');
require_once($CFG->dirroot.'/completion/criteria/completion_criteria_grade.php');
require_once($CFG->dirroot.'/completion/criteria/completion_criteria_role.php');
require_once($CFG->dirroot.'/completion/criteria/completion_criteria_course.php');
require_once $CFG->libdir.'/gradelib.php';
require_once('completion_form.php');

$id = required_param('id', PARAM_INT);       // course id

/// basic access control checks
if ($id) { // editing course
    if ($id == SITEID) {
        // Don't allow editing of  'site course' using this form.
        print_error('cannoteditsiteform');
    }

    $course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);
    require_login($course);
    $coursecontext = context_course::instance($course->id);
    require_capability('moodle/course:update', $coursecontext);

} else {
    require_login();
    print_error('needcourseid');
}

// Form unlocked override
$unlocked = optional_param('unlocked', false, PARAM_BOOL);
// Check permissions
$unlocked = $unlocked && completion_can_unlock_data($course->id);


// Load completion object
$completion = new completion_info($course);


/// Set up the page
$streditcompletionsettings = get_string("editcoursecompletionsettings", 'completion');
$PAGE->set_course($course);
$PAGE->set_url('/course/completion.php', array('id' => $course->id));
//$PAGE->navbar->add($streditcompletionsettings);
$PAGE->set_title($course->shortname);
$PAGE->set_heading($course->fullname);
$PAGE->set_pagelayout('standard');

/// first create the form
$form = new course_completion_form('completion.php?id='.$id, compact('course', 'unlocked'));

/// set data
$currentdata = array('criteria_course_value' => array());

// grab all course criteria and add to data array
// as they are a special case
foreach ($completion->get_criteria(COMPLETION_CRITERIA_TYPE_COURSE) as $criterion) {
    $currentdata['criteria_course_value'][] = $criterion->courseinstance;
}

$form->set_data($currentdata);


// now override defaults if course already exists
if ($form->is_cancelled()) {
    redirect(new moodle_url('/course/view.php', array('id' => $course->id)));
} else if ($data = $form->get_data()) {


/// process criteria unlocking if requested
    if (!empty($data->settingsunlockdelete) && completion_can_unlock_data($course->id)) {

        add_to_log($course->id, 'course', 'completion data reset', 'completion.php?id='.$course->id);

        $completion->delete_course_completion_data();

        // Return to form (now unlocked)
        redirect(new moodle_url('/course/completion.php', array('id' => $course->id)));
    }

    if (!empty($data->settingsunlock) && completion_can_unlock_data($course->id)) {

        add_to_log($course->id, 'course', 'completion unlocked without reset', 'completion.php?id='.$course->id);

        // Return to form (now unlocked)
        redirect("{$CFG->wwwroot}/course/completion.php?id={$course->id}&unlocked=1");
    }

/// process data if submitted
    // Delete old data if required
    if (completion_can_unlock_data($course->id) && !$unlocked) {
        $completion->delete_course_completion_data();
    }

    // Loop through each criteria type and run update_config
    $transaction = $DB->start_delegated_transaction();

    global $COMPLETION_CRITERIA_TYPES;
    foreach ($COMPLETION_CRITERIA_TYPES as $type) {
        $class = 'completion_criteria_'.$type;
        if (!$class::update_config($data)) {
            print_error('error:databaseupdatefailed', 'completion', new moodleurl('/course/view.php', array('id' => $course->id)));
            die();
        }
    }

    $transaction->allow_commit();

    // Handle aggregation methods
    // Overall aggregation
    $aggdata = array(
        'course'        => $data->id,
        'criteriatype'  => null
    );
    $aggregation = new completion_aggregation($aggdata);
    $aggregation->setMethod($data->overall_aggregation);
    $aggregation->save();

    // Activity aggregation
    if (empty($data->activity_aggregation)) {
        $data->activity_aggregation = 0;
    }

    $aggdata['criteriatype'] = COMPLETION_CRITERIA_TYPE_ACTIVITY;
    $aggregation = new completion_aggregation($aggdata);
    $aggregation->setMethod($data->activity_aggregation);
    $aggregation->save();

    // Course aggregation
    if (empty($data->course_aggregation)) {
        $data->course_aggregation = 0;
    }

    $aggdata['criteriatype'] = COMPLETION_CRITERIA_TYPE_COURSE;
    $aggregation = new completion_aggregation($aggdata);
    $aggregation->setMethod($data->course_aggregation);
    $aggregation->save();

    // Role aggregation
    if (empty($data->role_aggregation)) {
        $data->role_aggregation = 0;
    }

    $aggdata['criteriatype'] = COMPLETION_CRITERIA_TYPE_ROLE;
    $aggregation = new completion_aggregation($aggdata);
    $aggregation->setMethod($data->role_aggregation);
    $aggregation->save();

    // Update course total passing grade
    if (!empty($data->criteria_grade)) {
        if ($grade_item = grade_category::fetch_course_category($course->id)->grade_item) {
            $grade_item->gradepass = $data->criteria_grade_value;
            if (method_exists($grade_item, 'update')) {
                $grade_item->update('course/completion.php');
            }
        }
    }

    add_to_log($course->id, 'course', 'completion updated', 'completion.php?id='.$course->id);

    $url = new moodle_url('/course/view.php', array('id' => $course->id));
    redirect($url);
}


/// Print the form


echo $OUTPUT->header();
echo $OUTPUT->heading($streditcompletionsettings);

$form->display();

echo $OUTPUT->footer();

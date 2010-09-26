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
require_once($CFG->libdir.'/completion/completion_criteria_self.php');
require_once($CFG->libdir.'/completion/completion_criteria_date.php');
require_once($CFG->libdir.'/completion/completion_criteria_unenrol.php');
require_once($CFG->libdir.'/completion/completion_criteria_activity.php');
require_once($CFG->libdir.'/completion/completion_criteria_duration.php');
require_once($CFG->libdir.'/completion/completion_criteria_grade.php');
require_once($CFG->libdir.'/completion/completion_criteria_role.php');
require_once($CFG->libdir.'/completion/completion_criteria_course.php');
require_once $CFG->libdir.'/gradelib.php';
require_once('completion_form.php');

// Get paramaters
$id = required_param('id', PARAM_INT);                  // course id
$js_enabled = optional_param('js', true, PARAM_BOOL);    // js enabled

/// basic access control checks
if ($id) { // editing course

    if($id == SITEID){
        // don't allow editing of  'site course' using this from
        print_error('cannoteditsiteform');
    }

    if (!$course = get_record('course', 'id', $id)) {
        print_error('invalidcourseid');
    }
    require_login($course->id);
    require_capability('moodle/course:update', get_context_instance(CONTEXT_COURSE, $course->id));

} else {
    require_login();
    print_error('needcourseid');
}

/// first create the form
$form = new course_completion_form('completion.php?id='.$id, compact('course'));

// now override defaults if course already exists
if ($form->is_cancelled()){
    redirect($CFG->wwwroot.'/course/view.php?id='.$course->id);

} else if ($data = $form->get_data()) {

    $completion = new completion_info($course);

/// process criteria unlocking if requested
    if (!empty($data->settingsunlock)) {

        $completion->delete_course_completion_data();

        add_to_log($course->id, 'course', 'completion unlocked', 'completion.php?id='.$course->id);

        // Return to form (now unlocked)
        redirect($CFG->wwwroot."/course/completion.php?id=$course->id");
    }

/// process data if submitted
    // Delete old criteria
    $completion->clear_criteria();

    // Loop through each criteria type and run update_config
    global $COMPLETION_CRITERIA_TYPES;
    foreach ($COMPLETION_CRITERIA_TYPES as $type) {
        $class = 'completion_criteria_'.$type;
        $criterion = new $class();
        $criterion->update_config($data);
    }

    // Handle aggregation methods
    // Overall aggregation
    $aggregation = new completion_aggregation();
    $aggregation->course = $data->id;
    $aggregation->criteriatype = null;
    $aggregation->setMethod($data->overall_aggregation);
    $aggregation->insert();

    // Activity aggregation
    if (empty($data->activity_aggregation)) {
        $data->activity_aggregation = 0;
    }

    $aggregation = new completion_aggregation();
    $aggregation->course = $data->id;
    $aggregation->criteriatype = COMPLETION_CRITERIA_TYPE_ACTIVITY;
    $aggregation->setMethod($data->activity_aggregation);
    $aggregation->insert();

    // Course aggregation
    if (empty($data->course_aggregation)) {
        $data->course_aggregation = 0;
    }

    $aggregation = new completion_aggregation();
    $aggregation->course = $data->id;
    $aggregation->criteriatype = COMPLETION_CRITERIA_TYPE_COURSE;
    $aggregation->setMethod($data->course_aggregation);
    $aggregation->insert();

    // Role aggregation
    if (empty($data->role_aggregation)) {
        $data->role_aggregation = 0;
    }

    $aggregation = new completion_aggregation();
    $aggregation->course = $data->id;
    $aggregation->criteriatype = COMPLETION_CRITERIA_TYPE_ROLE;
    $aggregation->setMethod($data->role_aggregation);
    $aggregation->insert();

    // Update course total passing grade
    if (!empty($data->criteria_grade)) {
        $grade_item = grade_category::fetch_course_category($course->id)->get_grade_item();
        $grade_item->gradepass = $data->criteria_grade_value;
        $grade_item->update('course/completion.php');
    }

    add_to_log($course->id, 'course', 'completion updated', 'completion.php?id='.$course->id);

    redirect($CFG->wwwroot."/course/view.php?id=$course->id");
}


/// Print the form

// If js enabled, setup custom javascript
if ($js_enabled) {
    require_once($CFG->dirroot.'/local/js/lib/setup.php');

    local_js(array(
        TOTARA_JS_DIALOG,
        TOTARA_JS_TREEVIEW
    ));

    require_js(array(
        $CFG->wwwroot.'/local/js/completion.prerequisite.js.php?id='.$course->id,
    ));
}

$streditcompletionsettings = get_string("editcoursecompletionsettings", 'completion');
$navlinks = array();

$navlinks[] = array('name' => $streditcompletionsettings,
                    'link' => null,
                    'type' => 'misc');
$title = $streditcompletionsettings;
$fullname = $course->fullname;

$navigation = build_navigation($navlinks);
print_header($title, $fullname, $navigation, $form->focus());
print_heading($streditcompletionsettings);

$form->display();

print_footer($course);

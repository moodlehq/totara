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

require_once('../config.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->libdir.'/completionlib.php');
require_once($CFG->dirroot.'/local/dialogs/dialog_content_courses.class.php');


///
/// Setup / loading data
///

// Course id
$id = required_param('id', PARAM_INT);

// Category id
$categoryid = optional_param('parentid', 'cat0', PARAM_ALPHANUM);

// Strip cat from begining of categoryid
$categoryid = (int) substr($categoryid, 3);

// Basic access control checks
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


///
/// Load data
///

// Load courses in category
$sql = "
    SELECT
        c.id,
        c.fullname
    FROM
        {$CFG->prefix}course c
    LEFT JOIN
        {$CFG->prefix}course_completion_criteria cc
     ON cc.courseinstance = c.id
    AND cc.course = {$id}
    INNER JOIN
        {$CFG->prefix}course_completion_criteria ccc
     ON ccc.course = c.id
    WHERE
        c.enablecompletion = ".COMPLETION_ENABLED."
    AND c.id <> {$id}
    AND c.category = {$categoryid}
    AND cc.id IS NULL
    ORDER BY
        c.sortorder ASC
";

$courses = get_records_sql($sql);

if (!$courses) {
    $courses = array();
}

///
/// Setup dialog
///

// Load dialog content generator
$dialog = new totara_dialog_content_courses($categoryid);

// Setup search
$dialog->search_code = '/course/completion_prerequisite_search.php';

// Add data
$dialog->courses = $courses;

// Display page
echo $dialog->generate_markup();

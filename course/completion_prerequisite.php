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
require_once($CFG->dirroot.'/local/js/lib/setup.php');
require_once('HTML/AJAX/JSON.php');


///
/// Setup / loading data
///

// Course id
$id = required_param('id', PARAM_INT);

// Category id
$categoryid = optional_param('category', 0, PARAM_INT);

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
/// Load category list
///
if (!$categoryid) {

    // Load all categories
    $categories = array();
    $parents = array();
    make_categories_list($categories, $parents);

?>
<div class="selectposition">

<p>
    Locate course:
</p>

<ul class="filetree treeview">
<?php

    echo build_category_treeview($categories, $parents, 'Loading courses...');

?>
</ul>
</div>
<?php

    die();
}


///
/// Return courses in category
///

// Load category
if (!$category = get_record('course_categories', 'id', $categoryid)) {
    error('Category ID was incorrect');
}

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
    AND c.category = {$category->id}
    AND cc.id IS NULL
    ORDER BY
        c.sortorder ASC
";

$courses = get_records_sql($sql);

if ($courses) {
    $len = count($courses);
    $i = 0;
    foreach ($courses as $course) {
        $i++;

        echo '<li id="course_'.$course->id.'"';

        if ($i == $len) {
            echo ' class="last"';
        }

        echo '>';
        echo '<span class="clickable">'.format_string($course->fullname).'</span></li>';
    }
}
else {
    echo '<li class="last">'.get_string('nocourses').'</li>';
}

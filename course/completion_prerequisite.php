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

<h2><?php echo get_string('addcourseprerequisite', 'completion') ?></h2>

<p>
    Locate course:
</p>

<ul id="categories" class="filetree">
<?php

    $len = count($categories);
    $i = 0;
    $parent = array();

    // Add empty category to end of array to trigger
    // closing nested lists
    $categories[] = null;

    foreach ($categories as $id => $category) {
        $i++;

        // If an actual category
        if ($category !== null) {
            if (!isset($parents[$i])) {
                $this_parent = array();
            } else {
                $this_parents = array_reverse($parents[$i]);
                $this_parent = $parents[$i];
            }
        // If placeholder category at end
        } else {
            $this_parent = array();
        }

        if ($this_parent == $parent) {
            if ($i > 1) {
                echo '<li class="loading"><span>Loading courses...</span></li></ul></li>';
            }
        } else {
            // If there are less parents now
            $diff = count($parent) - count($this_parent);

            if ($diff) {
                echo str_repeat('</li><li><span>Loading courses...</span></li></ul>', $diff + 1);
            }

            $parent = $this_parent;
        }

        if ($category !== null) {
            // Grab category name
            $rpos = strrpos($category, ' / ');
            if ($rpos) {
                $category = substr($category, $rpos + 3);
            }
            echo '<li class="closed" id="cat_list_'.$id.'"><span class="folder">'.$category.'</span><ul>'.PHP_EOL;
        }
    }

?>
</ul>
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

// Return courses as JSON
echo json_encode($courses);

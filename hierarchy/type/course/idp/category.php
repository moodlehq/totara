<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/course/lib.php');


///
/// Setup / loading data
///

// category id
$id = required_param('id', PARAM_INT);
$rev = optional_param('rev', false, PARAM_INT);

// Check perms
require_login();

// Load category
if (!$category = get_record('course_categories', 'id', $id)) {
    error('Category ID was incorrect');
}

// Load courses in category
$courses = get_courses($category->id, "c.sortorder ASC", 'c.id, c.fullname');

if ($courses) {
    $registeredcourses = get_records('idp_revision_course', 'revision', $rev, '', 'course');
    $len = count($courses);
    $i = 0;
    foreach ($courses as $course) {
        $i++;

        echo '<li id="course_'.$course->id.'"';

        if ($i == $len) {
            echo ' class="last"';
        }

        echo '>';
        if (isset($registeredcourses[$course->id])) {
            $spanclass = 'unclickable';
            $addbutton = '';
        } else {
            $spanclass = 'clickable';
            //TODO: add tooltip (title) getstring
            $addbutton = '<img src="'.$CFG->pixpath.'/t/add.gif" class="addbutton" width="15px" height="15px" />';
        }
        echo '<span class="'.$spanclass.'" id="course_'.$course->id.'">';
        echo '<table><tr>';
        echo '<td class="list-item-name">'.format_string($course->fullname).'</td>';
        echo '<td class="list-item-action">'.$addbutton.'</td>';
        echo '</tr></table>';
        echo '</span></li>';
    }
}
else {
    echo '<li class="last">'.get_string('nocourses').'</li>';
}

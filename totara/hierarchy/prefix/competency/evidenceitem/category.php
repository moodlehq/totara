<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/course/lib.php');


///
/// Setup / loading data
///

// category id
$id = required_param('id', PARAM_INT);

// Check perms
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competency/edit.php');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

// Load category
if (!$category = get_record('course_categories', 'id', $id)) {
    error('Category ID was incorrect');
}

// Load courses in category
$courses = get_courses($category->id, "c.sortorder ASC", 'c.id, c.fullname');

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

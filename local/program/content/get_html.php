<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->dirroot.'/local/program/lib.php');
require_once($CFG->dirroot.'/lib/pear/HTML/AJAX/JSON.php');

require_login();

$id = required_param('id', PARAM_INT); // The program id
$htmltype = required_param('htmltype', PARAM_TEXT); // The type of html to return

$program = new program($id);

// Permissions check
if (!has_capability('local/program:configurecontent', $program->get_context())) {
    exit;
}

$programcontent = $program->get_content();

if($htmltype == 'multicourseset') { // if a new mulitcourse set is being added

    $courseids_str = required_param('courseids', PARAM_TEXT); // the ids of the courses to be added to the new set
    $sortorder = required_param('sortorder', PARAM_INT); // the sort order of the new set
    $setprefixes = required_param('setprefixes', PARAM_TEXT); // the prefixes of the existing course sets

    $html = '';

    // retrieve the courses to be added to this course set
    $courseids = explode(':', $courseids_str);

    // create a new course set object containing the courses
    $newcourseset = new multi_course_set($id);
    $newcourseset->sortorder = $sortorder;
    $newcourseset->completiontype = COMPLETIONTYPE_ALL;
    $newcourseset->courses = array();
    $newcourseset->islastset = true;
    $newcourseset->label = get_string('legend:courseset', 'local_program', $sortorder);

    foreach($courseids as $courseid) {
        if($course = get_record('course', 'id', $courseid)) {
            $newcourseset->courses[] = $course;
        }
    }

    // retrieve the html for the new set
    $html .= $newcourseset->print_set_minimal(true);

    $coursesetprefix = $newcourseset->get_set_prefix();
    $setprefixesstr = empty($setprefixes) ? $coursesetprefix : $setprefixes.','.$coursesetprefix;

    $data = array(
	'html'          => $html,
        'setprefixes'   => $setprefixesstr
    );

    echo json_encode($data);

} else if($htmltype == 'competencyset') {

    $competencyid = required_param('competencyid', PARAM_INT);
    $sortorder = required_param('sortorder', PARAM_INT);
    $setprefixes = required_param('setprefixes', PARAM_TEXT); // the prefixes of the existing course sets

    $html = '';

    $newcourseset = new competency_course_set($id);
    $newcourseset->competencyid = $competencyid;
    $newcourseset->sortorder = $sortorder;
    $newcourseset->completiontype = $newcourseset->get_completion_type();
    $newcourseset->islastset = true;
    $newcourseset->label = get_string('legend:courseset', 'local_program', $sortorder);

    $html .= $newcourseset->print_set_minimal(true);

    $coursesetprefix = $newcourseset->get_set_prefix();
    $setprefixesstr = empty($setprefixes) ? $coursesetprefix : $setprefixes.','.$coursesetprefix;

    $data = array(
	'html'          => $html,
        'setprefixes'   => $setprefixesstr
    );

    echo json_encode($data);

} else if($htmltype == 'recurringset') {

    $courseid = required_param('courseid', PARAM_INT);

    $newcourseset = new recurring_course_set($id);
    $newcourseset->sortorder = 1;
    $newcourseset->isfirstset = true;
    $newcourseset->islastset = true;
    $newcourseset->label = get_string('legend:recurringcourseset', 'local_program');

    if($course = get_record('course', 'id', $courseid)) {
        $newcourseset->course = $course;
    }

    $html = $newcourseset->print_set_minimal(true);

    $coursesetprefix = $newcourseset->get_set_prefix();
    $setprefixesstr = empty($setprefixes) ? $coursesetprefix : $setprefixes.','.$coursesetprefix;

    $data = array(
	'html'          => $html,
        'setprefixes'   => $setprefixesstr
    );

    echo json_encode($data);

} else if($htmltype == 'amendcourses') {

    $courseids_str = required_param('courseids', PARAM_SEQUENCE); // the selected course ids
    $coursesetid = required_param('coursesetid', PARAM_INT);
    $sortorder = required_param('sortorder', PARAM_INT);
    $completiontype = required_param('completiontype', PARAM_INT);
    $coursesetprefix = required_param('coursesetprefix', PARAM_TEXT); // the prefix of the course set

    $courseids = explode(',', $courseids_str); // an array containing the selected course ids

    $setob = get_record('prog_courseset', 'id', $coursesetid);

    $newcourseset = new multi_course_set($id, $setob, $coursesetprefix);
    $newcourseset->sortorder = $sortorder;
    $newcourseset->completiontype = $completiontype;

    // work out if we need to mark any courses as deleted
    if( ! empty($newcourseset->courses)) {
        foreach($newcourseset->courses as $course) {
            if( ! in_array($course->id, $courseids)) {
                $newcourseset->courses_deleted_ids[] = $course->id;
            }
        }
    }

    // reset the courses array
    $newcourseset->courses = array();

    // add the selected courses to the course set object
    foreach($courseids as $courseid) {
        if($courseid && $course = get_record('course', 'id', $courseid)) {
            $newcourseset->courses[] = $course;
        }
    }

    $courselisthtml = $newcourseset->print_courses(true);
    $deletedcourseshtml = $newcourseset->print_deleted_courses(true);

    $data = array(
	'courselisthtml'	    => $courselisthtml,
	'deletedcourseshtml'	    => $deletedcourseshtml
    );

    echo json_encode($data);

}

<?php

require_once '../../config.php';
require_once 'lib.php';

$id = required_param('id', PARAM_INT); // Course Module ID

if (!$course = get_record('course', 'id', $id)) {
    print_error('error:coursemisconfigured', 'facetoface');
}

require_course_login($course);
$context = get_context_instance(CONTEXT_COURSE, $course->id);
require_capability('mod/facetoface:view', $context);

add_to_log($course->id, 'facetoface', 'view all', "index.php?id=$course->id");

$strfacetofaces = get_string('modulenameplural', 'facetoface');
$strfacetoface = get_string('modulename', 'facetoface');
$strfacetofacename = get_string('facetofacename', 'facetoface');
$strweek = get_string('week');
$strtopic = get_string('topic');
$strcourse = get_string('course');
$strname = get_string('name');

$pagetitle = format_string($strfacetofaces);
$navlinks[] = array('name' => $pagetitle, 'link' => '', 'type' => 'title');
$navigation = build_navigation($navlinks);
print_header_simple($pagetitle, '', $navigation, '', '', true, '', navmenu($course));

if (!$facetofaces = get_all_instances_in_course('facetoface', $course)) {
    notice(get_string('nofacetofaces', 'facetoface'), "../../course/view.php?id=$course->id");
    die;
}

$timenow = time();

if ($course->format == 'weeks' && has_capability('mod/facetoface:viewattendees', $context)) {
    $table->head  = array ($strweek, $strfacetofacename, get_string('sign-ups', 'facetoface'));
    $table->align = array ('center', 'left', 'center');
}
elseif ($course->format == 'weeks') {
    $table->head  = array ($strweek, $strfacetofacename);
    $table->align = array ('center', 'left', 'center', 'center');
}
elseif ($course->format == 'topics' && has_capability('mod/facetoface:viewattendees', $context)) {
    $table->head  = array ($strcourse, $strfacetofacename, get_string('sign-ups', 'facetoface'));
    $table->align = array ('center', 'left', 'center');
}
elseif ($course->format == 'topics') {
    $table->head  = array ($strcourse, $strfacetofacename);
    $table->align = array ('center', 'left', 'center', 'center');
}
else {
    $table->head  = array ($strfacetofacename);
    $table->align = array ('left', 'left');
}

$currentsection = '';

foreach ($facetofaces as $facetoface) {

    $submitted = get_string('no');

    if (!$facetoface->visible) {
        //Show dimmed if the mod is hidden
        $link = "<a class=\"dimmed\" href=\"view.php?f=$facetoface->id\">$facetoface->name</a>";
    }
    else {
        //Show normal if the mod is visible
        $link = "<a href=\"view.php?f=$facetoface->id\">$facetoface->name</a>";
    }

    $printsection = '';
    if ($facetoface->section !== $currentsection) {
        if ($facetoface->section) {
            $printsection = $facetoface->section;
        }
        $currentsection = $facetoface->section;
    }

    $totalsignupcount = 0;
    if ($sessions = facetoface_get_sessions($facetoface->id)) {
        foreach($sessions as $session) {
            if (!facetoface_has_session_started($session, $timenow)) {
                $signupcount = facetoface_get_num_attendees($session->id);
                $totalsignupcount += $signupcount;
            }
        }
    }
        
    $courselink = '<a title="'.$course->shortname.'" href="'.$CFG->wwwroot.'/course/view.php?id='.$course->id.'">'.$course->shortname.'</a>';
    if ($course->format == 'weeks' or $course->format == 'topics') {
        if (has_capability('mod/facetoface:viewattendees', $context)) {
            $table->data[] = array ($courselink, $link, $totalsignupcount);
        }
        else {
            $table->data[] = array ($courselink, $link);
        }
    }
    else {
        $table->data[] = array ($link, $submitted);
    }
}

echo "<br />";

print_table($table);
print_footer($course);

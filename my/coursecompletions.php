<?php

require_once('../config.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once($CFG->dirroot.'/local/reportheading/lib.php');

$id = optional_param('id', null, PARAM_INT); // which user to show
$format = optional_param('format','', PARAM_TEXT); // export format

// default to current user
if(empty($id)) {
    $id = $USER->id;
}

if (! $user = get_record('user', 'id', $id)) {
    error('User not found');
}

// users can only view their own and their staff's pages
if ($USER->id != $id && !mitms_is_manager($id)) {
    error('You cannot view this page');
}
if ($USER->id != $id) {
    $strheading = get_string('coursecompletionsfor','local').fullname($user, true);
} else {
    $strheading = get_string('mycoursecompletions', 'local');
}

$shortname = 'course_completions';
$embed->source = 'course_completion';
$embed->fullname = $strheading;
$embed->filters = array(); // hide filter block
$embed->columns = array(
    array(
        'type' => 'course',
        'value' => 'courselink',
        'heading' => 'Course',
    ),
    array(
        'type' => 'course_completion',
        'value' => 'status',
        'heading' => 'Status',
    ),
    array(
        'type' => 'course_completion',
        'value' => 'completeddate',
        'heading' => 'Date Completed',
    ),
    array(
        'type' => 'course_completion',
        'value' => 'organisation',
        'heading' => 'Completed At',
    ),
    array(
        'type' => 'course_completion',
        'value' => 'position',
        'heading' => 'Completed As',
    ),
);
// no restrictions
// limited to single user by embedded params
$embed->contentmode = 0;

$embed->embeddedparams = array(
    'userid' => $id,
);

$report = new reportbuilder(null, $shortname, $embed);

if($format!='') {
    $report->export_data($format);
    die;
}

$fullname = $report->fullname;
$pagetitle = format_string(get_string('report','local').': '.$fullname);
$navlinks[] = array('name' => $fullname, 'link'=> '', 'type'=>'title');

$navigation = build_navigation($navlinks);

print_header_simple($strheading, $strheading, $navigation, '', null, true, null);

echo '<h1>'.$strheading.'</h1>';

// add heading block
$heading = new reportheading($id);
print $heading->display();

$countfiltered = $report->get_filtered_count();
$countall = $report->get_full_count();

// tab bar
$currenttab = "course_completions";
include('learning_tabs.php');

// display heading including filtering stats
print_heading("$strheading: $countall results found");

$report->display_search();

if($countfiltered>0) {
    $report->display_table();
    print $report->edit_button();
    // export button
    $report->export_select();
}

print_footer();

?>

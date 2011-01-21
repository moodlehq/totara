<?php

require_once('../config.php');

require_once($CFG->dirroot.'/local/reportbuilder/lib.php');

$userid = optional_param('userid', $USER->id, PARAM_INT); // which user to show
$format = optional_param('format','', PARAM_TEXT); // export format

if (! $user = get_record('user', 'id', $userid)) {
    error('User not found');
}

// users can only view their own and their staff's pages
if ($USER->id != $userid && !totara_is_manager($userid)) {
    error('You cannot view this page');
}
if ($USER->id != $userid) {
    $strheading = get_string('bookingsfor','local').fullname($user, true);
} else {
    $strheading = get_string('mybookings', 'local');
}

$shortname = 'bookings';
$data = array(
    'userid' => $userid,
);
$report = reportbuilder_get_embedded_report($shortname, $data);

if($format!='') {
    $report->export_data($format);
    die;
}
$report->include_js();

$fullname = $report->fullname;
$pagetitle = format_string(get_string('report','local').': '.$fullname);
$navlinks[] = array('name' => get_string('mylearning', 'local'), 'link' => $CFG->wwwroot . '/my/learning.php', 'type' => 'title');
$navlinks[] = array('name' => $fullname, 'link'=> '', 'type'=>'title');

$navigation = build_navigation($navlinks);

print_header_simple($pagetitle, '', $navigation, '', null, true, null);

$currenttab = "futurebookings";
include('booking_tabs.php');

$countfiltered = $report->get_filtered_count();
$countall = $report->get_full_count();

$heading = $strheading . ': ' .
    $report->print_result_count_string($countfiltered, $countall);
print_heading($heading);

print $report->print_description();

$report->display_search();

print "<br />";

if($countfiltered>0) {
    print $report->showhide_button();
    $report->display_table();
    print $report->edit_button();
    // export button
    $report->export_select();
}

print_footer();

?>

<?php

require_once('../config.php');

require_once($CFG->dirroot.'/local/reportbuilder/lib.php');

$format = optional_param('format','', PARAM_TEXT); // export format


$strheading = get_string('searchcourses', 'local');
$shortname = 'findcourses';

$report = reportbuilder_get_embedded_report($shortname);

if($format!='') {
    $report->export_data($format);
    die;
}
$report->include_js();

$fullname = $report->fullname;
$pagetitle = format_string(get_string('report','local').': '.$fullname);
$navlinks[] = array('name' => $fullname, 'link' => "{$CFG->wwwroot}" . "/course/find.php", 'type' => 'title');
$navlinks[] = array('name' => get_string('search'), 'link' => null, 'type' => 'title');

$navigation = build_navigation($navlinks);

print_header_simple($pagetitle, '', $navigation, '', null, true, null);

$countfiltered = $report->get_filtered_count();
$countall = $report->get_full_count();

$heading = $strheading . ': ' .
    $report->print_result_count_string($countfiltered, $countall);
print_heading($heading);

print $report->print_description();

$report->display_search();

// print saved search buttons if appropriate
print '<table align="right" border="0"><tr><td>';
print $report->save_button();
print '</td><td>';
print $report->view_saved_menu();
print '</td></tr></table>';
print "<br /><br />";

if($countfiltered>0) {
    print $report->showhide_button();
    $report->display_table();
    print $report->edit_button();
    // export button
    $report->export_select();
}

print_footer();

?>

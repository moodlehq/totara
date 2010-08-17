<?php

/**
 * Page for displaying user generated reports
 *
 * @copyright Catalyst IT Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');

$format    = optional_param('format', '', PARAM_TEXT);
$id = required_param('id',PARAM_INT);
$sid = optional_param('sid', '0', PARAM_INT);
$debug = optional_param('debug', 0, PARAM_INT);

// new report object
$report = new reportbuilder($id, null, false, $sid);
if(!$report->is_capable($id)) {
    error(get_string('nopermission','local_reportbuilder'));
}

if($report->embeddedurl !== null) {
    // redirect to embedded url
    redirect($report->embeddedurl);
}

if($format!='') {
    $report->export_data($format);
    die;
}
$report->include_js();

// display results as graph if report uses the graphical_feedback_questions source
$graph = (substr($report->source, 0, strlen('graphical_feedback_questions')) ==
    'graphical_feedback_questions');


$countfiltered = $report->get_filtered_count();
// save a query if no filters set
$countall = ($report->get_sql_filter() == '') ? $countfiltered : $report->get_full_count();

$fullname = $report->fullname;
$pagetitle = format_string(get_string('report','local_reportbuilder').': '.$fullname);
$navlinks[] = array('name' => get_string('myreports','local_reportbuilder'), 'link'=> $CFG->wwwroot . '/my/reports.php', 'type'=>'title');
$navlinks[] = array('name' => $fullname, 'link'=> '', 'type'=>'title');

$navigation = build_navigation($navlinks);

print_header_simple($pagetitle, '', $navigation, '', null, true, $report->edit_button());

// display heading including filtering stats
if($graph) {
    print_heading($fullname);
} else {
    print_heading("$fullname: ".get_string('showing','local_reportbuilder')." $countfiltered / $countall");
}

if($debug) {
    $report->debug($debug);
}

// print report description if set
print $report->print_description();

// print filters
$report->display_search();

// print saved search buttons if appropriate
print '<table align="right" border="0"><tr><td>';
print $report->save_button();
print '</td><td>';
print $report->view_saved_menu();
print '</td></tr></table>';
print "<br /><br />";

// show results
if($countfiltered>0) {
    if($graph) {
        print $report->print_feedback_results();
    } else {
        print $report->showhide_button();
        $report->display_table();
    }
    // export button
    $report->export_select();
} else {
    print_box_start();
    print get_string('noresultsfound','local_reportbuilder');
    print_box_end();
}


print_footer();


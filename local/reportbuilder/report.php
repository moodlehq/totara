<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 * 
 * This program is free software; you can redistribute it and/or modify  
 * it under the terms of the GNU General Public License as published by  
 * the Free Software Foundation; either version 2 of the License, or     
 * (at your option) any later version.                                   
 *                                                                       
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder 
 */

/**
 * Page for displaying user generated reports
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');

$format    = optional_param('format', '', PARAM_TEXT);
$id = required_param('id',PARAM_INT);
$sid = optional_param('sid', '0', PARAM_INT);
$debug = optional_param('debug', 0, PARAM_INT);

require_login();


// new report object
$report = new reportbuilder($id, null, false, $sid);
if(!$report->is_capable($id)) {
    error(get_string('nopermission','local_reportbuilder'));
}


if($report->embeddedurl !== null) {
    // redirect to embedded url
    redirect($CFG->wwwroot . $report->embeddedurl);
}

if($format!='') {
    add_to_log(SITEID, 'reportbuilder', 'export report', 'report.php?id='.$id, $report->fullname);
    $report->export_data($format);
    die;
}

add_to_log(SITEID, 'reportbuilder', 'view report', 'report.php?id='.$id, $report->fullname);

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
    print_heading("$fullname: ".
        $report->print_result_count_string($countfiltered, $countall));
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


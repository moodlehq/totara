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
 * @author Ben Lobo <ben@benlobo.co.uk>
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage plan
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once($CFG->dirroot.'/local/plan/lib.php');

require_login();

global $SESSION,$USER;

$programid  = required_param('programid', PARAM_INT);                       // which program to show
$userid     = optional_param('userid', null, PARAM_INT);                  // which user to show
$format     = optional_param('format','',PARAM_TEXT); //export format

// instantiate the program instance
$program = new program($programid);

// default to current user
if(empty($userid)) {
    $userid = $USER->id;
}

if (! $user = get_record('user', 'id', $userid)) {
    error(get_string('error:usernotfound', 'local_plan'));
}

$context = get_context_instance(CONTEXT_SYSTEM);
// users can only view their own and their staff's pages
// or if they are an admin
if ($USER->id != $userid && !totara_is_manager($userid) && !has_capability('moodle/site:doanything',$context)) {
    error(get_string('error:cannotviewpage', 'local_plan'));
}

if ($USER->id != $userid) {
    $a = new stdClass();
    $a->username = fullname($user, true);
    $a->progname = format_string($program->fullname);
    $strheading = get_string('recurringprogramhistoryfor', 'local_program', $a);
} else {
    $strheading = get_string('recurringprogramhistory', 'local_program', format_string($program->fullname));
}
// get subheading name for display
$strsubheading = get_string('recurringprograms', 'local_program');

$shortname = 'plan_programs_recurring';
$data = array(
    'userid' => $userid,
);

$report = reportbuilder_get_embedded_report($shortname, $data);

$query_string = !empty($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : '';
$log_url = 'record/programs_recurring.php'.$query_string;

if($format!='') {
    add_to_log(SITEID, 'plan', 'record export', $log_url, $report->fullname);
    $report->export_data($format);
die;
}

add_to_log(SITEID, 'plan', 'record view', $log_url, $report->fullname);

$report->include_js();

///
/// Display the page
///

$navlinks = array();
$navlinks[] = array('name' => get_string('mylearning', 'local'), 'link' => $CFG->wwwroot . '/my/learning.php', 'type' => 'title');
$navlinks[] = array('name' => $strheading, 'link' => $CFG->wwwroot . '/local/plan/record/programs.php', 'type' => 'misc');
$navlinks[] = array('name' => $strsubheading, 'link' => null, 'type' => 'misc');

print_header($strheading, $strheading, build_navigation($navlinks));

$ownplan = $USER->id == $userid;

$usertype = ($ownplan) ? 'learner' : 'manager';

echo dp_display_plans_menu($userid, 0, $usertype, 'courses', 'none');

print_container_start(false, '', 'dp-plan-content');

echo '<h1>'.$strheading.'</h1>';

$userstr = (isset($userid)) ? 'userid='.$userid.'&amp;' : '';

//$currenttab = 'programs';
//require_once($CFG->dirroot . '/local/plan/record/tabs.php');

// display table here
$fullname = $report->fullname;
$countfiltered = $report->get_filtered_count();
$countall = $report->get_full_count();

$heading = $report->print_result_count_string($countfiltered, $countall);
print_heading($heading);

print $report->print_description();

$report->display_search();

if($countfiltered>0) {
    print $report->showhide_button();
    $report->display_table();
    print $report->edit_button();
    // export button
    $report->export_select();
}

print_container_end();

print_footer();

?>

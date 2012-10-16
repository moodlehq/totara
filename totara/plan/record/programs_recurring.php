<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
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
require_once($CFG->dirroot.'/totara/reportbuilder/lib.php');
require_once($CFG->dirroot.'/totara/plan/lib.php');

require_login();

global $SESSION,$USER;

$programid  = optional_param('programid', 0, PARAM_INT);                       // which program to show
$userid     = optional_param('userid', null, PARAM_INT);                  // which user to show
$format = optional_param('format','', PARAM_TEXT); // export format
$rolstatus = optional_param('status', 'all', PARAM_ALPHANUM);
// instantiate the program instance
if ($programid) {
    try {
        $program = new program($programid);
    } catch (ProgramException $e) {
        print_error('error:invalidid', 'totara_program');
    }
} else {
    // show all recurring programs if no id given
    // needed to fix link from manage report page
    $program = new stdClass();
    $program->fullname = '';
}

// default to current user
if (empty($userid)) {
    $userid = $USER->id;
}

if (!$user = $DB->get_record('user', array('id' => $userid))) {
    print_error('error:usernotfound', 'totara_plan');
}

$context = context_system::instance();
// users can only view their own and their staff's pages
// or if they are an admin
if ($USER->id != $userid && !totara_is_manager($userid) && !has_capability('totara/plan:accessanyplan',$context)) {
    print_error('error:cannotviewpage', 'totara_plan');
}

$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/totara/plan/record/programs_recurring.php',
    array('userid' => $userid, 'status' => $rolstatus)));
$PAGE->set_pagelayout('noblocks');

$renderer = $PAGE->get_renderer('totara_reportbuilder');

if ($USER->id != $userid) {
    $a = new stdClass();
    $a->username = fullname($user, true);
    $a->progname = format_string($program->fullname);
    $strheading = get_string('recurringprogramhistoryfor', 'totara_program', $a);
} else {
    $strheading = get_string('recurringprogramhistory', 'totara_program', format_string($program->fullname));
}
// get subheading name for display
$strsubheading = get_string('recurringprograms', 'totara_program');

$shortname = 'plan_programs_recurring';
$data = array(
    'userid' => $userid,
);

$report = reportbuilder_get_embedded_report($shortname, $data);

$query_string = !empty($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : '';
$log_url = 'record/programs_recurring.php'.$query_string;

if ($format != '') {
    add_to_log(SITEID, 'plan', 'record export', $log_url, $report->fullname);
    $report->export_data($format);
    die;
}

add_to_log(SITEID, 'plan', 'record view', $log_url, $report->fullname);

$report->include_js();

///
/// Display the page
///
$PAGE->navbar->add(get_string('mylearning', 'totara_core'), new moodle_url('/my/'));
$PAGE->navbar->add($strheading, new moodle_url('/totara/plan/record/programs.php'));
$PAGE->navbar->add($strsubheading);
$PAGE->set_title($strheading);
$PAGE->set_button($report->edit_button());
$PAGE->set_heading($strheading);

$ownplan = $USER->id == $userid;

$usertype = ($ownplan) ? 'learner' : 'manager';
$menuitem = ($ownplan) ? 'recordoflearning' : 'myteam';
$PAGE->set_totara_menu_selected($menuitem);

echo $OUTPUT->header();

echo dp_display_plans_menu($userid, 0, $usertype, 'courses', 'none');

echo $OUTPUT->container_start('', 'dp-plan-content');

echo $OUTPUT->heading($strheading, 1);

$userstr = (isset($userid)) ? 'userid='.$userid.'&amp;' : '';

$currenttab = 'programs';
require_once($CFG->dirroot . '/totara/plan/record/tabs.php');

// display table here
$fullname = $report->fullname;
$countfiltered = $report->get_filtered_count();
$countall = $report->get_full_count();

$heading = $renderer->print_result_count_string($countfiltered, $countall);
echo $OUTPUT->heading($heading);

echo $renderer->print_description($report->description, $report->_id);

$report->display_search();

if ($countfiltered > 0) {
    echo $renderer->showhide_button($report->_id, $report->shortname);
    $report->display_table();
    // export button
    $renderer->export_select($report->_id);
}

echo $OUTPUT->container_end();
echo $OUTPUT->footer();
?>

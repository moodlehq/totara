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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @package totara
 * @subpackage my
 */

/*
 * Displays information for the current user's team
 *
 */

require_once(dirname(dirname(__FILE__)).'/config.php');
require_once($CFG->libdir.'/blocklib.php');
require_once($CFG->libdir.'/tablelib.php');
require_once($CFG->dirroot.'/tag/lib.php');
require_once($CFG->dirroot.'/totara/reportbuilder/lib.php');
require_once($CFG->dirroot.'/totara/plan/lib.php');

require_login();
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('noblocks');
$PAGE->set_url(new moodle_url('/my/teammembers.php'));

global $SESSION,$USER;

$format = optional_param('format', '', PARAM_TEXT); // export format

/**
 * Define the "Team Members" embedded report
 */
$strheading = get_string('teammembers', 'totara_core');

$shortname = 'team_members';
if (!$report = reportbuilder_get_embedded_report($shortname)) {
    print_error('error:couldnotgenerateembeddedreport', 'totara_reportbuilder');
}

$query_string = !empty($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : '';
$log_url = 'bookings.php'.$query_string;

if ($format != '') {
    add_to_log(SITEID, 'my', 'teammembers export', $log_url, $report->fullname);
    $report->export_data($format);
    die;
}

add_to_log(SITEID, 'my', 'teammembers report view', 'teammembers.php');

$report->include_js();

/**
 * End of defining the report
 */

$PAGE->set_totara_menu_selected('myteam');
$PAGE->set_button($report->edit_button());
$PAGE->set_title($strheading);
$PAGE->set_heading($strheading);
$PAGE->navbar->add(get_string('mylearning', 'totara_core'), new moodle_url('/my/'));
$PAGE->navbar->add($strheading);
$renderer = $PAGE->get_renderer('totara_reportbuilder');
echo $OUTPUT->header();

// Plan menu
echo dp_display_plans_menu(0,0,'manager', null, null, false);

// Plan page content
echo $OUTPUT->container_start('', 'dp-plan-content');

$countfiltered = $report->get_filtered_count();
$countall = $report->get_full_count();

$heading = $strheading . ': ' . $renderer->print_result_count_string($countfiltered, $countall);
echo $OUTPUT->heading($heading);

echo $renderer->print_description($report->description, $report->_id);

echo html_writer::tag('p', get_string('teammembers_text', 'totara_core'));
$report->display_search();

echo html_writer::empty_tag('br');

if ($countfiltered>0) {
    $report->display_table();
    print $report->edit_button();
    // export button
    $renderer->export_select($report->_id);
}

echo $OUTPUT->container_end();
echo $OUTPUT->footer();

?>

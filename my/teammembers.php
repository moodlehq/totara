<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2013 Totara Learning Solutions LTD
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

/* Displays information for the current user's team */

require_once(dirname(dirname(__FILE__)).'/config.php');
require_once($CFG->libdir.'/blocklib.php');
require_once($CFG->libdir.'/tablelib.php');
require_once($CFG->dirroot.'/tag/lib.php');
require_once($CFG->dirroot.'/totara/reportbuilder/lib.php');
require_once($CFG->dirroot.'/totara/plan/lib.php');

require_login();
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');
$PAGE->set_pagetype('my-teammembers');
$PAGE->blocks->add_region('content');
$PAGE->set_url(new moodle_url('/my/teammembers.php'));

global $SESSION, $USER;

$edit = optional_param('edit', -1, PARAM_BOOL);
$format = optional_param('format', '', PARAM_TEXT); // Export format.

/* Define the "Team Members" embedded report */
$strheading = get_string('teammembers', 'totara_core');

$shortname = 'team_members';
if (!$report = reportbuilder_get_embedded_report($shortname)) {
    print_error('error:couldnotgenerateembeddedreport', 'totara_reportbuilder');
}

$querystring = !empty($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : '';
$logurl = 'bookings.php'.$querystring;

if ($format != '') {
    add_to_log(SITEID, 'my', 'teammembers export', $logurl, $report->fullname);
    // If found 'namewithlinks' column, delete function that inserts links inside the column 'name'.
    $namewithlinkscol = totara_search_for_value($report->columns, 'value', EQUAL, 'namewithlinks');
    if (!empty($namewithlinkscol)) {
        $namewithlinkscol = reset($namewithlinkscol);
        $namewithlinkscol->displayfunc = '';
    }
    $report->export_data($format);
    die;
}

add_to_log(SITEID, 'my', 'teammembers report view', 'teammembers.php');

$report->include_js();

/* End of defining the report */

$PAGE->set_totara_menu_selected('myteam');
$PAGE->set_button($report->edit_button());
$PAGE->set_title($strheading);
$PAGE->set_heading($strheading);
$PAGE->navbar->add(get_string('myteam', 'totara_core'));
$PAGE->navbar->add($strheading);

if (!isset($USER->editing)) {
    $USER->editing = 0;
}
if ($PAGE->user_allowed_editing()) {
    if ($edit == 1 && confirm_sesskey()) {
        $USER->editing = 1;
        $url = new moodle_url($PAGE->url, array('notifyeditingon' => 1));
        redirect($url);
    } else if ($edit == 0 && confirm_sesskey()) {
        $USER->editing = 0;
        redirect($PAGE->url);
    }
} else {
    $USER->editing = 0;
}

$renderer = $PAGE->get_renderer('totara_reportbuilder');
echo $OUTPUT->header();

// Plan page content.
echo $OUTPUT->container_start('', 'my-teammembers-content');

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
    // Export button.
    $renderer->export_select($report->_id);
}

echo $OUTPUT->blocks_for_region('content');
echo $OUTPUT->container_end();
echo $OUTPUT->footer();

?>

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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @package totara
 * @subpackage my
 */

require_once(dirname(dirname(__FILE__)).'/config.php');
require_once($CFG->dirroot.'/totara/reportbuilder/lib.php');

require_login();

$userid = optional_param('userid', $USER->id, PARAM_INT); // which user to show
$format = optional_param('format','', PARAM_TEXT); // export format

$PAGE->set_context(context_system::instance());
$PAGE->set_url(new moodle_url('/my/bookings.php', array('userid' => $userid, 'format' => $format)));
$PAGE->set_totara_menu_selected('mybookings');
$PAGE->set_pagelayout('noblocks');

if (!$user = $DB->get_record('user', array('id' => $userid))) {
    print_error('error:usernotfound', 'totara_core');
}

// users can only view their own and their staff's pages
if ($USER->id != $userid && !totara_is_manager($userid)) {
    print_error('error:cannotviewthispage', 'totara_core');
}

$renderer = $PAGE->get_renderer('totara_reportbuilder');

if ($USER->id != $userid) {
    $strheading = get_string('bookingsfor', 'totara_core').fullname($user, true);
} else {
    $strheading = get_string('myfuturebookings', 'totara_core');
}

$shortname = 'bookings';
$data = array(
    'userid' => $userid,
);
if (!$report = reportbuilder_get_embedded_report($shortname, $data)) {
    print_error('error:couldnotgenerateembeddedreport', 'totara_reportbuilder');
}

$query_string = !empty($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : '';
$log_url = 'bookings.php'.$query_string;

if ($format != '') {
    add_to_log(SITEID, 'my', 'bookings export', $log_url, $report->fullname);
    $report->export_data($format);
    die;
}

add_to_log(SITEID, 'my', 'bookings view', $log_url, $report->fullname);

$report->include_js();

$fullname = $report->fullname;
$pagetitle = format_string(get_string('report', 'totara_core').': '.$fullname);

$PAGE->set_title($pagetitle);
$PAGE->set_button($report->edit_button());
$PAGE->set_heading('');
$PAGE->navbar->add(get_string('mylearning', 'totara_core'), new moodle_url('/my/'));
$PAGE->navbar->add($strheading);
echo $OUTPUT->header();

$currenttab = "futurebookings";
include('booking_tabs.php');

$countfiltered = $report->get_filtered_count();
$countall = $report->get_full_count();

$heading = $strheading . ': ' .
    $renderer->print_result_count_string($countfiltered, $countall);
echo $OUTPUT->heading($heading);

print $renderer->print_description($report->description, $report->_id);

$report->display_search();

echo html_writer::empty_tag('br');

if ($countfiltered > 0) {
    print $renderer->showhide_button($report->_id, $report->shortname);
    $report->display_table();
    // export button
    $renderer->export_select($report->_id);
}

echo $OUTPUT->footer();

?>

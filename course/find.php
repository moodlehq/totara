<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2012 Totara Learning Solutions LTD
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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder
 */

require_once(dirname(dirname(__FILE__)).'/config.php');
require_once($CFG->dirroot.'/totara/reportbuilder/lib.php');

$format = optional_param('format','', PARAM_TEXT); // export format

$PAGE->set_context(get_system_context());
if ($CFG->forcelogin) {
    require_login();
}

$renderer = $PAGE->get_renderer('totara_reportbuilder');

$strheading = get_string('searchcourses', 'totara_core');
$shortname = 'findcourses';

if (!$report = reportbuilder_get_embedded_report($shortname)) {
    print_error('error:couldnotgenerateembeddedreport', 'local_reportbuilder');
}

if ($format != '') {
    add_to_log(SITEID, 'reportbuilder', 'export report', 'report.php?id=' . $report->_id,
        $report->fullname);
    $report->export_data($format);
    die;
}

add_to_log(SITEID, 'reportbuilder', 'view report', 'report.php?id='. $report->_id,
    $report->fullname);

$report->include_js();

$fullname = format_string($report->fullname);
$pagetitle = format_string(get_string('report','totara_core').': '.$fullname);

$PAGE->set_title($pagetitle);
$PAGE->set_button($report->edit_button());
$PAGE->set_heading('');
$PAGE->set_url('/course/find.php');
$PAGE->navbar->add($fullname, new moodle_url("{$CFG->wwwroot}/course/find.php"));
$PAGE->navbar->add(get_string('search'));
echo $OUTPUT->header();

$countfiltered = $report->get_filtered_count();
$countall = $report->get_full_count();

$heading = $strheading . ': ' .
    $renderer->print_result_count_string($countfiltered, $countall);
echo $OUTPUT->heading($heading);

echo $renderer->print_description($report->description, $report->_id);

$report->display_search();

// print saved search buttons if appropriate
echo html_writer::start_tag('table', array('align' => 'right', 'border' => '0'));
echo html_writer::start_tag('tr');
echo html_writer::tag('td', $renderer->save_button($report->_id));
echo html_writer::tag('td', $report->view_saved_menu());
echo html_writer::end_tag('tr');
echo html_writer::end_tag('table');
echo html_writer::empty_tag('br');
echo html_writer::empty_tag('br');

if ($countfiltered > 0) {
    print $renderer->showhide_button($report->_id, $report->shortname);
    $report->display_table();
    // export button
    $renderer->export_select($report->_id);
}

echo $OUTPUT->footer();

?>

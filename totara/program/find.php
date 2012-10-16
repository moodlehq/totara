<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
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
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage program
 */

require_once('../../config.php');
require_once($CFG->dirroot.'/totara/reportbuilder/lib.php');

$format = optional_param('format','', PARAM_TEXT); // export format

$PAGE->set_context(context_system::instance());
$PAGE->set_totara_menu_selected('program');
$PAGE->set_pagelayout('noblocks');
if ($CFG->forcelogin) {
    require_login();
}

$renderer = $PAGE->get_renderer('totara_reportbuilder');
$strheading = get_string('searchprograms', 'totara_program');
$shortname = 'findprograms';

if (!$report = reportbuilder_get_embedded_report($shortname)) {
    print_error('error:couldnotgenerateembeddedreport', 'totara_reportbuilder');
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
$pagetitle = format_string(get_string('report', 'totara_core').': '.$fullname);

$PAGE->set_url('/totara/program/find.php');
$PAGE->set_pagelayout('admin');
$PAGE->navbar->add($fullname, new moodle_url('/totara/program/find.php'));
$PAGE->navbar->add(get_string('search'));
$PAGE->set_title($pagetitle);
$PAGE->set_button($report->edit_button());
$PAGE->set_heading('');
echo $OUTPUT->header();

$countfiltered = $report->get_filtered_count();
$countall = $report->get_full_count();

$heading = $strheading . ': ' .
    $renderer->print_result_count_string($countfiltered, $countall);
echo $OUTPUT->heading($heading);

print $renderer->print_description($report->description, $report->_id);

$report->display_search();

// print saved search buttons if appropriate
$table = new html_table();
$cells = array();
$cells[] = new html_table_cell($renderer->save_button($report->_id));
$cells[] = new html_table_cell($report->view_saved_menu());
$table->data[] = new html_table_row($cells);
echo html_writer::table($table);
echo html_writer::empty_tag('br'). html_writer::empty_tag('br');

if ($countfiltered>0) {
    print $renderer->showhide_button($report->_id, $report->shortname);
    $report->display_table();
    // export button
    $renderer->export_select($report->_id);
}

echo $OUTPUT->footer();

?>

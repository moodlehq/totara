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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @package tool
 * @subpackage totara_sync
 */

require_once('../../../../config.php');
require_once($CFG->dirroot . '/totara/reportbuilder/lib.php');

$debug  = optional_param('debug', false, PARAM_BOOL);
$format = optional_param('format', '', PARAM_TEXT); // export format

$context = context_system::instance();
require_capability('tool/totara_sync:manage', $context);
$PAGE->set_context($context);

if ($CFG->forcelogin) {
    require_login();
}

$renderer = $PAGE->get_renderer('totara_reportbuilder');
$strheading = get_string('synclog', 'tool_totara_sync');
$shortname = 'totarasynclog';

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
$pagetitle = format_string(get_string('report', 'totara_core') . ': ' . $fullname);

$PAGE->set_url('/admin/tool/totara_sync/admin/synclog.php');
$PAGE->set_pagelayout('admin');
$PAGE->navbar->add(get_string('view'));
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

if ($countfiltered > 0) {
    $report->display_table();

    // export button
    $renderer->export_select($report->_id);
}

echo $OUTPUT->footer();

?>

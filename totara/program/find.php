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
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage program
 */

require_once('../../config.php');

require_once($CFG->dirroot.'/totara/reportbuilder/lib.php');

$format = optional_param('format','', PARAM_TEXT); // export format

require_login();

$renderer = $PAGE->get_renderer('totara_reportbuilder');

$strheading = get_string('searchprograms', 'local_program');
$shortname = 'findprograms';

$report = reportbuilder_get_embedded_report($shortname);

if ($format != '') {
    add_to_log(SITEID, 'reportbuilder', 'export report', 'report.php?id=' . $report->_id,
        $report->fullname);
    $report->export_data($format);
    die;
}

add_to_log(SITEID, 'reportbuilder', 'view report', 'report.php?id='. $report->_id,
    $report->fullname);

$report->include_js();

$fullname = $report->fullname;
$pagetitle = format_string(get_string('report','local').': '.$fullname);
$navlinks[] = array('name' => $fullname, 'link' => "{$CFG->wwwroot}" . "/totara/program/find.php", 'type' => 'title');
$navlinks[] = array('name' => get_string('search'), 'link' => null, 'type' => 'title');

$navigation = build_navigation($navlinks);

print_header_simple($pagetitle, '', $navigation, '', null, true, null);

$countfiltered = $report->get_filtered_count();
$countall = $report->get_full_count();

$heading = $strheading . ': ' .
    $renderer->print_result_count_string($countfiltered, $countall);
print_heading($heading);

print $renderer->print_description($report->description, $report->_id);

$report->display_search();

// print saved search buttons if appropriate
print '<table align="right" border="0"><tr><td>';
print $renderer->save_button($report->_id);
print '</td><td>';
print $report->view_saved_menu();
print '</td></tr></table>';
print "<br /><br />";

if ($countfiltered > 0) {
    print $renderer->showhide_button($report->_id, $report->shortname);
    $report->display_table();
    print $report->edit_button();
    // export button
    $renderer->export_select($report->_id);
}

print_footer();

?>

<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
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
 * @author Aaron Wells <aaronw@catalyst.net.nz>
 * @package totara
 * @subpackage cohort
 */
/**
 * This page displays the report of "orphaned users", who are not contained in any cohort
 */
require('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/cohort/lib.php');
require_once($CFG->dirroot.'/totara/reportbuilder/lib.php');

admin_externalpage_setup('cohorts');

$context = context_system::instance();
require_capability('moodle/cohort:view', $context);

$report = reportbuilder_get_embedded_report('cohort_orphaned_users');
// Handle a request for export
$format     = optional_param('format', '', PARAM_TEXT); // export format
if($format!='') {
//    add_to_log(SITEID, 'plan', 'record export', $log_url, $report->fullname);
    $report->export_data($format);
    die;
}

$strcohorts = get_string('cohorts', 'totara_cohort');
echo $OUTPUT->header();

$debug = optional_param('debug', false, PARAM_BOOL);
if($debug) {
    $report->debug($debug);
}
echo $OUTPUT->heading(get_string('orphanedusers', 'totara_cohort'));
echo $OUTPUT->container(get_string('orphanhelptext', 'totara_cohort'));

$report->display_search();

$report->display_table();

$output = $PAGE->get_renderer('totara_reportbuilder');
$output->export_select($report->_id);

echo $OUTPUT->footer();
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
// SCANMSG: TODO Re-add once plans merged
//require_once($CFG->dirroot.'/totara/plan/lib.php');

require_login();

global $SESSION,$USER;


/**
 * Define the "Team Members" embedded report
 */
$strheading = get_string('teammembers', 'totara_core');

$shortname = 'team_members';
if (!$report = reportbuilder_get_embedded_report($shortname)) {
    print_error('error:couldnotgenerateembeddedreport', 'totara_reportbuilder');
}

add_to_log(SITEID, 'my', 'teammembers report view', 'teammembers.php');

/**
 * End of defining the report
 */

// SCANMSG TODO implement setup of dashlet blocks

// see which reports exist in db and add columns for them to table
// these reports should have the "userid" url parameter enabled to allow
// viewing of individual reports
$staff_records = $DB->get_field('report_builder', 'id', array('shortname' => 'staff_learning_records'));
$staff_f2f = $DB->get_field('report_builder', 'id', array('shortname' => 'staff_facetoface_sessions'));

$PAGE->set_context(context_system::instance());
$PAGE->set_pagetype('Totara');
$PAGE->set_url(new moodle_url('/my/teammembers.php'));
$PAGE->set_title($strheading);
$PAGE->set_heading($strheading);
echo $OUTPUT->header();

// Plan menu
// SCANMSG: TODO Re-add once plans merged
//echo dp_display_plans_menu(0,0,'manager', null, null, false);

// Plan page content
echo $OUTPUT->container_start('', 'dp-plan-content');

echo html_writer::tag('p', get_string('teammembers_text', 'totara_core'));

$report->include_js();
$report->display_table();

echo $OUTPUT->container_end();
echo $OUTPUT->footer();

?>

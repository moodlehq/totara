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
 * @author Piers Harding <piers@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder 
 */
require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('../lib.php');

require_login();

/// Setup / loading data
$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$id = required_param('id', PARAM_INT); //ID
$confirm = optional_param('confirm', '', PARAM_INT); // Delete confirmation hash

if (!$report = get_record('report_builder_schedule', 'id', $id)) {
    error(get_string('error:invalidreportscheduleid','local_reportbuilder'));
}

$reportname = get_field('report_builder', 'fullname', 'id', $report->reportid);

/// Display page
print_header(' ', ' ', null);

$returnurl = "{$CFG->wwwroot}/my/reports.php";
$deleteurl = "{$CFG->wwwroot}/local/reportbuilder/deletescheduled.php?id={$report->id}&amp;confirm=1&amp;sesskey={$USER->sesskey}";

if (!$confirm) {
    $strdelete = get_string('deletecheckschedulereport', 'local_reportbuilder');
    notice_yesno(
        "{$strdelete}<br /><br />".format_string($reportname),
        $deleteurl,
        $returnurl
    );

    print_footer();
    exit;
}

// Delete report builder schedule
if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

add_to_log(SITEID, 'scheduledreport', 'delete', "local/reportbuilder/scheduled.php?id=$report->id", "$reportname (ID $report->id)");

delete_records('report_builder_schedule', 'id', $report->id);

echo '<p>'.get_string('deletedscheduledreport', 'local_reportbuilder', format_string($reportname)).'</p>';
print_continue($returnurl);
print_footer();

<?php
require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('../lib.php');

/// Setup / loading data
$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$id = required_param('id', PARAM_INT);
// Delete confirmation hash
$confirm = optional_param('confirm', '', PARAM_INT);

// Setup page and check permissions
admin_externalpage_setup('managereports');

if (!$report = get_record('report_builder_schedule', 'id', $id)) {
    error(get_string('error:invalidreportscheduleid','local_reportbuilder'));
}

$reportname = get_field('report_builder', 'fullname', 'id', $report->reportid);

/// Display page
admin_externalpage_print_header();

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

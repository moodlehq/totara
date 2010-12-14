<?php

/**
 * Page for setting up scheduled reports
 *
 * @copyright Catalyst IT Limited
 * @author Alastair Munro
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once($CFG->dirroot.'/local/reportbuilder/scheduled_forms.php');

$reportid = optional_param('reportid', PARAM_INT); //report that a schedule is being added for
$id = optional_param('id', 0, PARAM_INT); //id if editing schedule

//admin_externalpage_setup('managereports');

$myreportsurl = $CFG->wwwroot . '/my/reports.php';
$returnurl = $CFG->wwwroot . '/local/reportbuilder/scheduled.php';

$PAGE = page_create_object('Totara', $USER->id);

if($id == 0){
    $report = new object();
    $report->id = 0;
    $report->reportid = $reportid;
    $report->frequency = null;
    $report->schedule = null;
}
else{
    if(!$report = get_record('report_builder_schedule', 'id', $id)){
        error(get_string('error:invalidreportscheduleid', 'local_reportbuilder'));
    }
}

// form definition
$mform =& new scheduled_reports_new_form(
    null,
    array(
        'id' => $id,
        'reportid' => $report->reportid,
        'frequency' => $report->frequency,
        'schedule' => $report->schedule
    )
);

$mform->set_data($report);

if($mform->is_cancelled()){
    redirect($myreportsurl);
}
if($fromform = $mform->get_data()){
    if(empty($fromform->submitbutton)) {
        totara_set_notification(get_string('error:unknownbuttonclicked','local_reportbuilder'), $returnurl);
    }

    if($fromform->id){
        if($newid = add_scheduled_report($fromform)) {
            totara_set_notification(get_string('updatescheduledreport','local_reportbuilder'), $myreportsurl, array('style' => 'notifysuccess'));
        }
        else {
            totara_set_notification(get_string('error:updatescheduledreport','local_reportbuilder'), $returnurl);
        }
    }
    else {
        if($newid = add_scheduled_report($fromform)) {
            totara_set_notification(get_string('addedscheduledreport','local_reportbuilder'), $myreportsurl, array('style' => 'notifysuccess'));
        }
        else {
            totara_set_notification(get_string('error:addscheduledreport','local_reportbuilder'), $returnurl);
        }
    }
}

if($id==0) {
    $pagename = 'addscheduledreport';
} else {
    $pagename = 'editscheduledreport';
}

$navlinks[] = array('name' => get_string('myreports','local_reportbuilder'), 'link'=> $CFG->wwwroot . '/my/reports.php', 'type'=>'title');
$navlinks[] = array('name' => get_string($pagename, 'local_reportbuilder'), 'link'=> '', 'type'=>'title');

$PAGE->print_header(get_string($pagename, 'local_reportbuilder'), $navlinks);

print "<table id=\"reportbuilder-navbuttons\"><tr><td>";
print_single_button($CFG->wwwroot.'/my/reports.php#scheduled', null, get_string('allscheduledreports','local_reportbuilder'));
print "</td></tr></table>";

print_heading(get_string($pagename, 'local_reportbuilder'));

$mform->display();

print_footer();

function add_scheduled_report($fromform){
    global $USER, $REPORT_BUILDER_EXPORT_OPTIONS, $REPORT_BUILDER_SCHEDULE_OPTIONS;

    $REPORT_BUILDER_SCHEDULE_CODES = array_flip($REPORT_BUILDER_SCHEDULE_OPTIONS);
    begin_sql();

    if(isset($fromform->reportid) && isset($fromform->format) && isset($fromform->frequency)) {
        $todb = new object();
        if($id = $fromform->id){
            $todb->id = $id;
        }

        $todb->reportid = $fromform->reportid;
        $todb->savedsearchid = $fromform->savedsearchid;
        $todb->userid = $USER->id;
        $todb->format = $fromform->format;
        $todb->frequency = $fromform->frequency;
        switch($REPORT_BUILDER_SCHEDULE_CODES[$fromform->frequency]){
            case 'daily':
                $todb->schedule = $fromform->daily;
                break;
            case 'weekly':
                $todb->schedule = $fromform->weekly;
                break;
            case 'monthly':
                $todb->schedule = $fromform->monthly;
                break;
        }

        if(!$id){
            if(!$newid = insert_record('report_builder_schedule', $todb)) {
                rollback_sql();
                return false;
            }
        }
        else {
            $todb->nextreport = null;

            if(!$newid = update_record('report_builder_schedule', $todb)) {
                rollback_sql();
                return false;
            }
        }
        commit_sql();
        return $newid;
    }
    return false;
}
?>

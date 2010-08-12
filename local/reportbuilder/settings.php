<?php // $Id$
require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once($CFG->dirroot.'/local/reportbuilder/report_forms.php');

global $USER;
$id = required_param('id',PARAM_INT); // report builder id
$notice = optional_param('notice', 0, PARAM_INT); // notice flag

admin_externalpage_setup('managereports');

$returnurl = $CFG->wwwroot."/local/reportbuilder/settings.php?id=$id";

$report = new reportbuilder($id);

// form definition
$mform =& new report_builder_edit_form(null, compact('id','report'));

// form results check
if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot.'/local/reportbuilder/index.php');
}
if ($fromform = $mform->get_data()) {

    if(empty($fromform->submitbutton)) {
        redirect($returnurl . '&amp;notice=' .
            REPORT_BUILDER_UNKNOWN_BUTTON_CLICKED);
    }

    $todb = new object();
    $todb->id = $id;
    $todb->fullname = addslashes($fromform->fullname);
    $todb->hidden = $fromform->hidden;
    $todb->description = addslashes($fromform->description);
    if(update_record('report_builder',$todb)) {
        redirect($returnurl . '&amp;notice=' .
            REPORT_BUILDER_GENERAL_CONFIRM_UPDATE);
    } else {
        redirect($returnurl . '&amp;notice=' .
            REPORT_BUILDER_GENERAL_FAILED_UPDATE);
    }
}

admin_externalpage_print_header();

print "<table id=\"reportbuilder-navbuttons\"><tr><td>";
print_single_button($CFG->wwwroot.'/local/reportbuilder/index.php', null, get_string('allreports','local'));
print "</td><td>";
print $report->view_button();
print "</td></tr></table>";

print_heading(get_string('editreport','local',$report->fullname));

$currenttab = 'general';
include_once('tabs.php');

if($notice) {
    switch($notice) {
    case REPORT_BUILDER_UNKNOWN_BUTTON_CLICKED:
        notify(get_string('error:unknownbuttonclicked','local'));
        break;
    case REPORT_BUILDER_GENERAL_CONFIRM_UPDATE:
        notify(get_string('reportupdated', 'local'), 'notifysuccess');
        break;
    case REPORT_BUILDER_GENERAL_FAILED_UPDATE:
        notify(get_string('error:couldnotupdatereport','local'));
        break;
    }
}

// display the form
$mform->display();

admin_externalpage_print_footer();


?>

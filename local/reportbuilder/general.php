<?php // $Id$

/**
 * Page containing general report settings
 *
 * @copyright Catalyst IT Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once($CFG->dirroot.'/local/reportbuilder/report_forms.php');

global $USER;
$id = required_param('id',PARAM_INT); // report builder id

admin_externalpage_setup('managereports');

$returnurl = $CFG->wwwroot."/local/reportbuilder/general.php?id=$id";

$report = new reportbuilder($id);

// form definition
$mform = new report_builder_edit_form(null, compact('id','report'));

// form results check
if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot.'/local/reportbuilder/index.php');
}
if ($fromform = $mform->get_data()) {

    if(empty($fromform->submitbutton)) {
        totara_set_notification(get_string('error:unknownbuttonclicked','local_reportbuilder'), $returnurl);
    }

    $todb = new object();
    $todb->id = $id;
    $todb->fullname = addslashes($fromform->fullname);
    $todb->hidden = $fromform->hidden;
    $todb->description = addslashes($fromform->description);
    if((int)$fromform->recordsperpage > 5000) {
        $rpp = 5000;
    } else if ((int)$fromform->recordsperpage < 1) {
        $rpp = 1;
    } else {
        $rpp = (int)$fromform->recordsperpage;
    }
    $todb->recordsperpage = $rpp;
    if(update_record('report_builder',$todb)) {
        totara_set_notification(get_string('reportupdated', 'local_reportbuilder'), $returnurl, array('style' => 'notifysuccess'));
    } else {
        totara_set_notification(get_string('error:couldnotupdatereport','local_reportbuilder'), $returnurl);
    }
}

admin_externalpage_print_header();

print "<table id=\"reportbuilder-navbuttons\"><tr><td>";
print_single_button($CFG->wwwroot.'/local/reportbuilder/index.php', null, get_string('allreports','local_reportbuilder'));
print "</td><td>";
print $report->view_button();
print "</td></tr></table>";

print_heading(get_string('editreport','local_reportbuilder',$report->fullname));

$currenttab = 'general';
include_once('tabs.php');

// display the form
$mform->display();

admin_externalpage_print_footer();


?>

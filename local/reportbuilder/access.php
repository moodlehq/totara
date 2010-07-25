<?php // $Id$
require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once($CFG->dirroot.'/local/reportbuilder/report_forms.php');

global $USER;
$id = required_param('id',PARAM_INT); // report builder id

admin_externalpage_setup('reportbuilder');
$returnurl = $CFG->wwwroot."/local/reportbuilder/access.php?id=$id";

$report = new reportbuilder($id);


// form definition
$mform =& new report_builder_edit_access_form(null, compact('id','report'));

// form results check
if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot.'/local/reportbuilder/index.php');
}
if ($fromform = $mform->get_data()) {

    if(empty($fromform->submitbutton)) {
        print_error('error:unknownbuttonclicked', 'local', $returnurl);
    }

    if(update_access($id, $fromform)) {
        redirect($returnurl);
    } else {
        redirect($returnurl, get_string('error:couldnotupdatereport','local'));
    }
}

admin_externalpage_print_header();

print "<table id=\"reportbuilder-navbuttons\"><tr><td>";
print_single_button($CFG->wwwroot.'/local/reportbuilder/index.php', null, get_string('allreports','local'));
print "</td><td>";
print $report->view_button();
print "</td></tr></table>";

print_heading(get_string('editreport','local',$report->fullname));

$currenttab = 'access';
include_once('tabs.php');

// display the form
$mform->display();

admin_externalpage_print_footer();


function update_access($reportid, $fromform) {

    begin_sql();

    // first check if there are any access restrictions at all
    $accessenabled = isset($fromform->accessenabled) ? $fromform->accessenabled : 0;
    // update access enabled setting
    $todb = new object();
    $todb->id = $reportid;
    $todb->accessmode = $accessenabled;
    if(!update_record('report_builder', $todb)) {
        rollback_sql();
        return false;
    }

    // loop round classes, only considering classes that extend rb_base_access
    foreach(get_declared_classes() as $class) {
        if(is_subclass_of($class, 'rb_base_access')) {
            $obj = new $class();
            if(!$obj->form_process($reportid, $fromform)) {
                rollback_sql();
                return false;
            }
        }
    }

    commit_sql();
    return true;
}

?>

<?php // $Id$
require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once($CFG->dirroot.'/local/reportbuilder/report_forms.php');

global $USER;
$id = required_param('id',PARAM_INT); // report builder id

admin_externalpage_setup('reportbuilder');
$returnurl = $CFG->wwwroot."/local/reportbuilder/access.php?id=$id";

$shortname = get_field('report_builder','shortname','id',$id);
$report = new reportbuilder($shortname);


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

    if(update_access($id, $fromform->accessenabled, $fromform->role)) {
        redirect($returnurl);
    } else {
        redirect($returnurl, get_string('error:couldnotupdatereport','local'));
    }
}

admin_externalpage_print_header();

print_heading(get_string('editreport','local',$report->fullname));

print "<table id=\"reportbuilder-navbuttons\"><tr><td>";
print_single_button($CFG->wwwroot.'/local/reportbuilder/index.php', null, get_string('allreports','local'));
print "</td><td>";
print_single_button($CFG->wwwroot.'/local/reportbuilder/report.php', array('id'=>$id), get_string('viewreport','local'));
print "</td></tr></table>";

$currenttab = 'access';
include_once('tabs.php');

// display the form
$mform->display();

admin_externalpage_print_footer();


function update_access($reportid, $accessenabled, $newroles) {

    // is this report set to access all?
    if(get_record('report_builder_access', 'reportid', $reportid, 'accesstype', 'all')) {

        if(!$accessenabled) {
            // remove if no longer set
            if(!delete_records('report_builder_access', 'reportid', $reportid, 'accesstype', 'all')) {
                return false;
            }
        }
    } else {
        if($accessenabled) {
            // add if set now but not before
            $todb = new object();
            $todb->reportid = $reportid;
            $todb->accesstype = 'all';
            $todb->typeid = 0;
            if(!insert_record('report_builder_access', $todb)) {
                return false;
            }
        }
    }

    // get existing settings into an array
    $oldroles = array();
    if($data = get_records_select('report_builder_access',"reportid=$reportid AND accesstype='role'")) {
        foreach($data as $item) {
            $oldroles[$item->typeid] = 1;
        }
    }

    foreach($newroles as $roleid => $set) {
        if(array_key_exists($roleid, $oldroles)) {
            if($set == 0) {
                // remove if no longer set
                if(!delete_records('report_builder_access','reportid', $reportid, 'accesstype', 'role', 'typeid', $roleid)) {
                    return false;
                }
            }
        } else {
            if($set == 1) {
                // add if set now but not before
                $todb = new object();
                $todb->reportid = $reportid;
                $todb->accesstype = 'role';
                $todb->typeid = $roleid;
                if(!insert_record('report_builder_access', $todb)) {
                    return false;
                }
            }
        }
    }
    return true;
}

?>

<?php // $Id$
require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once($CFG->dirroot.'/local/reportbuilder/report_forms.php');

global $USER;
$id = required_param('id',PARAM_INT); // report builder id
$d = optional_param('d', null, PARAM_TEXT); // delete
$m = optional_param('m', null, PARAM_TEXT); // move
$fid = optional_param('fid',null,PARAM_INT); //filter id
$cid = optional_param('cid',null,PARAM_INT); //column id
$confirm = optional_param('confirm', 0, PARAM_INT); // confirm delete

admin_externalpage_setup('managereports');

$returnurl = $CFG->wwwroot."/local/reportbuilder/settings.php?id=$id";

$report = new reportbuilder($id);

// delete fields or columns
if ($d and (isset($cid) || isset($fid)) and $confirm ) {
    if(!confirm_sesskey()) {
        print_error('confirmsesskeybad','error');
    }

    if(isset($cid)) {
        if($report->delete_column($cid)) {
            redirect($returnurl);
        } else {
            redirect($returnurl, 'Column could not be deleted');
        }
    }

    if(isset($fid)) {
        if($report->delete_filter($fid)) {
            redirect($returnurl);
        } else {
            redirect($returnurl, 'Field could not be deleted');
        }
    }
}



// confirm deletion of field or column
if ($d && (isset($cid) || isset($fid))) {

    admin_externalpage_print_header();

    if(isset($cid)) {
        notice_yesno('Are you sure you want to delete this column?',"settings.php?d=1&amp;id=$id&amp;cid=$cid&amp;confirm=1&amp;sesskey=$USER->sesskey", $returnurl);
    }

    if(isset($fid)) {
        notice_yesno('Are you sure you want to delete this filter?',"settings.php?d=1&amp;id=$id&amp;fid=$fid&amp;confirm=1&amp;sesskey=$USER->sesskey", $returnurl);
    }

    admin_externalpage_print_footer();
    die;
}

// move column
if($m && isset($cid)) {
    if($report->move_column($cid, $m)) {
        redirect($returnurl);
    } else {
        redirect($returnurl, 'Column could not be moved');
    }
}

// move filter
if($m && isset($fid)) {
    if($report->move_filter($fid, $m)) {
        redirect($returnurl);
    } else {
        redirect($returnurl, 'Filter could not be moved');
    }
}


// form definition
$mform =& new report_builder_edit_form(null, compact('id','report'));

// form results check
if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot.'/local/reportbuilder/index.php');
}
if ($fromform = $mform->get_data()) {

    if(empty($fromform->submitbutton)) {
        print_error('error:unknownbuttonclicked', 'local', $returnurl);
    }

    $todb = new object();
    $todb->id = $id;
    $todb->fullname = addslashes($fromform->fullname);
    $todb->hidden = $fromform->hidden;
    $todb->description = addslashes($fromform->description);
    if(update_record('report_builder',$todb)) {
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

$currenttab = 'general';
include_once('tabs.php');

// display the form
$mform->display();

admin_externalpage_print_footer();


?>

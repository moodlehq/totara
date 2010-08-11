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
$confirm = optional_param('confirm', 0, PARAM_INT); // confirm delete

admin_externalpage_setup('managereports');

$returnurl = $CFG->wwwroot."/local/reportbuilder/filters.php?id=$id";

$report = new reportbuilder($id);

// delete fields or columns
if ($d and $confirm ) {
    if(!confirm_sesskey()) {
        print_error('confirmsesskeybad','error');
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
if ($d) {

    admin_externalpage_print_header();

    if(isset($fid)) {
        notice_yesno('Are you sure you want to delete this filter?',"filters.php?d=1&amp;id=$id&amp;fid=$fid&amp;confirm=1&amp;sesskey=$USER->sesskey", $returnurl);
    }

    admin_externalpage_print_footer();
    die;
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
$mform =& new report_builder_edit_filters_form(null, compact('id','report'));

// form results check
if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot.'/local/reportbuilder/index.php');
}
if ($fromform = $mform->get_data()) {

    if(empty($fromform->submitbutton)) {
        print_error('error:unknownbuttonclicked', 'local', $returnurl);
    }

    if(build_filters($id, $fromform)) {
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

$currenttab = 'filters';
include_once('tabs.php');

// display the form
$mform->display();

admin_externalpage_print_footer();

function build_filters($id, $fromform) {
    begin_sql();

    if ($oldfilters = get_records('report_builder_filters', 'reportid', $id)) {
        // see if existing filters have changed
        foreach($oldfilters as $fid => $oldfilter) {
            $filtername = "filter{$fid}";
            $advancedname = "advanced{$fid}";
            // update db only if filter has changed
            if(isset($fromform->$filtername) &&
                ($fromform->$filtername != $oldfilter->type.'-'.$oldfilter->value ||
                $fromform->$filtername != $oldfilter->advanced)) {
                $todb = new object();
                $todb->id = $fid;
                $parts = explode('-', $fromform->$filtername);
                $thisadv = isset($fromform->$advancedname) ? 1 : 0;
                $todb->type = $parts[0];
                $todb->value = $parts[1];
                $todb->advanced = $thisadv;
                if(!update_record('report_builder_filters', $todb)) {
                    rollback_sql();
                    return false;
                }
            }
        }
    }

    // add any new filters
    if(isset($fromform->newfilter) && $fromform->newfilter != '0') {
        $todb = new object();
        $todb->reportid = $id;
        $parts = explode('-',$fromform->newfilter);
        $thisadv = isset($fromform->newadvanced) ? 1 : 0;
        $todb->type = $parts[0];
        $todb->value = $parts[1];
        $todb->advanced = $thisadv;
        $sortorder = get_field('report_builder_filters', 'MAX(sortorder) + 1', 'reportid', $id);
        if(!$sortorder) {
            $sortorder = 1;
        }
        $todb->sortorder = $sortorder;
        if(!insert_record('report_builder_filters', $todb)) {
            rollback_sql();
            return false;
        }
    }

    commit_sql();
    return true;
}

?>

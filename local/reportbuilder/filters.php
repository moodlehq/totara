<?php // $Id$
require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once($CFG->dirroot.'/local/reportbuilder/report_forms.php');

global $USER;
$id = required_param('id',PARAM_INT); // report builder id
$d = optional_param('d', null, PARAM_TEXT); // delete
$m = optional_param('m', null, PARAM_TEXT); // move
$fid = optional_param('fid',null,PARAM_INT); //filter id
$confirm = optional_param('confirm', 0, PARAM_INT); // confirm delete
$notice = optional_param('notice', 0, PARAM_INT); // notice flag

admin_externalpage_setup('managereports');

$returnurl = $CFG->wwwroot."/local/reportbuilder/filters.php?id=$id";

$report = new reportbuilder($id);

// delete fields or columns
if ($d and $confirm ) {
    if(!confirm_sesskey()) {
        redirect($returnurl . '&amp;notice=' .
            REPORT_BUILDER_FAILED_DELETE_SESSKEY);
    }

    if(isset($fid)) {
        if($report->delete_filter($fid)) {
            redirect($returnurl . '&amp;notice=' .
                REPORT_BUILDER_FILTERS_CONFIRM_DELETE);
        } else {
            redirect($returnurl . '&amp;notice=' .
                REPORT_BUILDER_FILTERS_FAILED_DELETE);
            //'Field could not be deleted');
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
        redirect($returnurl . '&amp;notice=' .
            REPORT_BUILDER_FILTERS_CONFIRM_MOVE);
    } else {
        redirect($returnurl . '&amp;notice=' .
            REPORT_BUILDER_FILTERS_FAILED_MOVE);
        //, 'Filter could not be moved');
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
        redirect($returnurl . '&amp;notice=' .
            REPORT_BUILDER_FILTERS_CONFIRM_UPDATE);
    } else {
        redirect($returnurl . '&amp;notice=' .
            REPORT_BUILDER_FILTERS_FAILED_UPDATE);
        //, get_string('error:couldnotupdatereport','local'));
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

if($notice) {
    switch($notice) {
    case REPORT_BUILDER_FILTERS_CONFIRM_DELETE:
        notify(get_string('filter_deleted','local'),'notifysuccess');
        break;
    case REPORT_BUILDER_FAILED_DELETE_SESSKEY:
        notify(get_string('error:bad_sesskey','local'));
        break;
    case REPORT_BUILDER_FILTERS_FAILED_DELETE:
        notify(get_string('error:filter_not_deleted','local'));
        break;
    case REPORT_BUILDER_FILTERS_CONFIRM_MOVE:
        notify(get_string('filter_moved','local'),'notifysuccess');
        break;
    case REPORT_BUILDER_FILTERS_FAILED_MOVE:
        notify(get_string('error:filter_not_moved','local'));
        break;
    case REPORT_BUILDER_FILTERS_CONFIRM_UPDATE:
        notify(get_string('filters_updated','local'),'notifysuccess');
        break;
    case REPORT_BUILDER_FILTERS_FAILED_UPDATE:
        get_string('error:filters_not_updated','local');
        break;
    }
}

// display the form
$mform->display();

admin_externalpage_print_footer();

/**
 * Update the report filters table with data from the submitted form
 *
 * @param integer $id Report ID to update
 * @param object $fromform Moodle form object containing the new filter data
 *
 * @return boolean True if the filters could be updated successfully
 */
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

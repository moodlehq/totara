<?php // $Id$
require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once($CFG->dirroot.'/local/reportbuilder/report_forms.php');

global $USER;
$id = required_param('id',PARAM_INT); // report builder id
$d = optional_param('d', null, PARAM_TEXT); // delete
$m = optional_param('m', null, PARAM_TEXT); // move
$cid = optional_param('cid',null,PARAM_INT); //column id
$confirm = optional_param('confirm', 0, PARAM_INT); // confirm delete

admin_externalpage_setup('reportbuilder');
$returnurl = $CFG->wwwroot."/local/reportbuilder/columns.php?id=$id";

$report = new reportbuilder($id);

// delete column
if ($d and $confirm ) {
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
}

// confirm deletion column
if ($d) {

    admin_externalpage_print_header();

    if(isset($cid)) {
        notice_yesno('Are you sure you want to delete this column?',"columns.php?d=1&amp;id=$id&amp;cid=$cid&amp;confirm=1&amp;sesskey=$USER->sesskey", $returnurl);
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

// form definition
$mform =& new report_builder_edit_columns_form(null, compact('id','report'));

// form results check
if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot.'/local/reportbuilder/index.php');
}
if ($fromform = $mform->get_data()) {

    if(empty($fromform->submitbutton)) {
        print_error('error:unknownbuttonclicked', 'local', $returnurl);
    }

    if(build_columns($id, $fromform)) {
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

$currenttab = 'columns';
include_once('tabs.php');

// display the form
$mform->display();

admin_externalpage_print_footer();



function build_columns($id, $fromform) {
    begin_sql();

    if ($oldcolumns = get_records('report_builder_columns', 'reportid', $id)) {
        // see if existing columns have changed
        foreach($oldcolumns as $cid => $oldcolumn) {
            $columnname = "column{$cid}";
            $headingname = "heading{$cid}";
            // update db only if column has changed
            if(isset($fromform->$columnname) &&
                ($fromform->$columnname != $oldcolumn->type.'-'.$oldcolumn->value ||
                $fromform->$headingname != $oldcolumn->heading)) {
                $todb = new object();
                $todb->id = $cid;
                $parts = explode('-', $fromform->$columnname);
                $todb->type = $parts[0];
                $todb->value = $parts[1];
                $todb->heading = $fromform->$headingname;
                if(!update_record('report_builder_columns', $todb)) {
                    rollback_sql();
                    return false;
                }
            }
        }
    }

    // add any new columns
    if(isset($fromform->newcolumns) && $fromform->newcolumns != '0') {
        $todb = new object();
        $todb->reportid = $id;
        $parts = explode('-',$fromform->newcolumns);
        $todb->type = $parts[0];
        $todb->value = $parts[1];
        $todb->heading = $fromform->newheading;
        $sortorder = get_field('report_builder_columns', 'MAX(sortorder) + 1', 'reportid', $id);
        if(!$sortorder) {
            $sortorder = 1;
        }
        $todb->sortorder = $sortorder;
        if(!insert_record('report_builder_columns', $todb)) {
            rollback_sql();
            return false;
        }
    }

    commit_sql();
    return true;
}


?>

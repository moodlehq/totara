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

$shortname = get_field('report_builder','shortname','id',$id);
$report = new reportbuilder($shortname);

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

    $todb = new object();
    $todb->id = $id;
    $result = build_columns($fromform);
    $todb->columns = serialize($result);
    begin_sql();
    if(update_record('report_builder',$todb)) {
        commit_sql();
        redirect($returnurl);
    } else {
        rollback_sql();
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

$currenttab = 'columns';
include_once('tabs.php');

// display the form
$mform->display();

admin_externalpage_print_footer();

function build_columns($fromform) {
    // build the results
    // first recreated existing columns
    $i = 0;
    $col = "column$i";
    $head = "heading$i";
    $ret = array();
    while(isset($fromform->$col)) {
        $parts = explode('-',$fromform->$col);
        $ret[$i] = array(
            'type' => $parts[0],
            'value' => $parts[1],
            'heading' => $fromform->$head,
        );

        $i++;
        $col = "column$i";
        $head = "heading$i";
    }

    // add the new column if set
    if(isset($fromform->newcolumns) && $fromform->newcolumns != '0') {
        $parts = explode('-',$fromform->newcolumns);
        $ret[$i] = array(
            'type' => $parts[0],
            'value' => $parts[1],
            'heading' => $fromform->newheading,
        );
    }

    return $ret;
}


?>

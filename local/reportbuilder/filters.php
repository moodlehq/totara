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

admin_externalpage_setup('reportbuilder');
$returnurl = $CFG->wwwroot."/local/reportbuilder/filters.php?id=$id";

$shortname = get_field('report_builder','shortname','id',$id);
$report = new reportbuilder($shortname);

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

    $todb = new object();
    $todb->id = $id;
    $result = build_filters($fromform);
    $todb->filters = serialize($result);
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

print "<table id=\"reportbuilder-navbuttons\"><tr><td>";
print_single_button($CFG->wwwroot.'/local/reportbuilder/index.php', null, get_string('allreports','local'));
print "</td><td>";
print_single_button($CFG->wwwroot.'/local/reportbuilder/report.php', array('id'=>$id), get_string('viewreport','local'));
print "</td></tr></table>";

print_heading(get_string('editreport','local',$report->fullname));

$currenttab = 'filters';
include_once('tabs.php');

// display the form
$mform->display();

admin_externalpage_print_footer();

function build_filters($fromform) {
    // build the results
    // first recreate existing filters
    $i = 0;
    $filt = "filter$i";
    $adv = "advanced$i";
    $ret = array();
    while(isset($fromform->$filt)) {
        $parts = explode('-',$fromform->$filt);
        $thisadv = (isset($fromform->$adv)) ? 1 : 0;
        $ret[$i] = array(
            'type' => $parts[0],
            'value' => $parts[1],
            'advanced' => $thisadv,
        );

        $i++;
        $filt = "filter$i";
        $adv = "advanced$i";
    }

    // add the new filter if set
    if(isset($fromform->newfilter) && $fromform->newfilter != '0') {
        $parts = explode('-',$fromform->newfilter);
        $thisadv = (isset($fromform->newadvanced)) ? 1 : 0;
        $ret[$i] = array(
            'type' => $parts[0],
            'value' => $parts[1],
            'advanced' => $thisadv,
        );
    }
    return $ret;

}


?>

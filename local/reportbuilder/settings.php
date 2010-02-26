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

admin_externalpage_setup('reportbuilder');
$returnurl = $CFG->wwwroot."/local/reportbuilder/settings.php?id=$id";

$shortname = get_field('report_builder','shortname','id',$id);
$report = new reportbuilder($shortname);

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
    $result = build_columns($fromform);
    $todb->columns = serialize($result);
    $result = build_filters($fromform);
    $todb->filters = serialize($result);
    $result = build_restrictions($fromform);
    $todb->restriction = serialize($result);
    $todb->shortname = $fromform->shortname;
    $todb->fullname = $fromform->fullname;
    $todb->hidden = $fromform->hidden;
    if(update_record('report_builder',$todb)) {
        redirect($returnurl, get_string('reportupdated','local'));
    } else {
        redirect($returnurl, get_string('error:couldnotupdatereport','local'));
    }
}

admin_externalpage_print_header();

print_heading(get_string('editreport','local',$report->_fullname));

print "<table id=\"reportbuilder-navbuttons\"><tr><td>";
print_single_button($CFG->wwwroot.'/local/reportbuilder/index.php', null, get_string('allreports','local'));
print "</td><td>";
print_single_button($CFG->wwwroot.'/local/reportbuilder/report.php', array('id'=>$id), get_string('viewreport','local'));
print "</td></tr></table>";

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

function build_restrictions($fromform) {
    $source = $fromform->source;
    $options = get_source_data($source,'restrictionoptions');
    $i = 0;
    $rest = "restriction$i";
    $ret = array();
    while(isset($fromform->$rest)) {
        if($fromform->$rest != '0') {
            if(isset($options) && is_array($options)) {
                foreach($options as $option) {
                    if($option['name'] == $fromform->$rest) {
                        $ret[] = $fromform->$rest;
                    }
                }
            }
        }
        $i++;
        $rest = "restriction$i";
    }
    return $ret;
}



?>

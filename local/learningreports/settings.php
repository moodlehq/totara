<?php // $Id$
require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/learningreports/learningreportslib.php');
require_once('learning_reports_forms.php');

$id = required_param('id',PARAM_INT); // learning report id
//TODO
//$d = optional_param('d', 0, PARAM_INT); // delete
//$confirm = optional_param('confirm','false', PARAM_BOOL); // confirm delete

$shortname = get_field('learning_report','shortname','id',$id);
$report = new learningreport($shortname);
//get_record('learning_report','id',$id);

admin_externalpage_setup('learningreports');
$returnurl = $CFG->wwwroot."/local/learningreports/settings.php?id=$id";
// form definition
$mform =& new learning_reports_edit_form(null, compact('id','report'));

// TODO
/*
if ($d and $confirm) {
    if(!confirm_sesskey()) {
        print_error('confirmsesskeybad','error');
    }

    if(delete_record('learning_reports','id',$id)) {
        redirect($returnurl, 'Record Deleted');
    } else {
        redirect($returnurl, 'Record could not be deleted');
    }
}
 */
// form results check
if ($mform->is_cancelled()) {
    redirect($returnurl);
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

    if(update_record('learning_report',$todb)) {
        redirect($returnurl, get_string('reportupdated','local'));
    } else {
        redirect($returnurl, get_string('error:couldnotupdatereport','local'));
    }
}

admin_externalpage_print_header();

print_heading(get_string('editlearningreport','local',$report->_fullname));

// TODO
/*
if ($d) {
    notice_yesno('Are you sure?',"settings.php?id=$id&amp;d=1&amp;confirm=1&amp;sesskey=$USER->sesskey", $returnurl);
    print_footer();
    die;
}
 */

// display the form
$mform->display();

admin_externalpage_print_footer();


function build_columns($fromform) {
    // build the results
    // first recreated existing columns
    $i = 0;
    $col = "column$i";
    $head = "heading$i";
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

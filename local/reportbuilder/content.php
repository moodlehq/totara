<?php // $Id$
require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once($CFG->dirroot.'/local/reportbuilder/report_forms.php');

global $USER;
$id = required_param('id',PARAM_INT); // report builder id

admin_externalpage_setup('reportbuilder');
$returnurl = $CFG->wwwroot."/local/reportbuilder/content.php?id=$id";

$shortname = get_field('report_builder','shortname','id',$id);
$report = new reportbuilder($shortname);

// form definition
$mform =& new report_builder_edit_content_form(null, compact('id','report'));

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
    $result = build_restrictions($fromform);
    $todb->restriction = serialize($result);
    if(update_record('report_builder',$todb)) {
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

$currenttab = 'content';
include_once('tabs.php');

// display the form
$mform->display();

admin_externalpage_print_footer();

function build_restrictions($fromform) {
    $source = $fromform->source;
    $options = reportbuilder::get_source_data('restrictionoptions',$source);
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

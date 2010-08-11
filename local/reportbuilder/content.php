<?php // $Id$
require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once($CFG->dirroot.'/local/reportbuilder/report_forms.php');

global $USER;
$id = required_param('id',PARAM_INT); // report builder id

admin_externalpage_setup('managereports');

$returnurl = $CFG->wwwroot."/local/reportbuilder/content.php?id=$id";

$report = new reportbuilder($id);

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

    if(update_content($id, $report, $fromform)) {
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

$currenttab = 'content';
include_once('tabs.php');

// display the form
$mform->display();

admin_externalpage_print_footer();

function update_content($id, $report, $fromform) {
    begin_sql();

    // first check if there are any content restrictions at all
    $contentenabled = isset($fromform->contentenabled) ? $fromform->contentenabled : 0;

    // update content enabled setting
    $todb = new object();
    $todb->id = $id;
    $todb->contentmode = $contentenabled;
    if(!update_record('report_builder', $todb)) {
        rollback_sql();
        return false;
    }

    $contentoptions = isset($report->contentoptions) ?
        $report->contentoptions : array();

    // pass form data to content class for processing
    foreach($contentoptions as $option) {
        $classname = 'rb_' . $option->classname . '_content';
        if(class_exists($classname)) {
            $obj = new $classname();
            if(!$obj->form_process($id, $fromform)) {
                rollback_sql();
                return false;
            }
        }
    }

    commit_sql();
    return true;
}


?>

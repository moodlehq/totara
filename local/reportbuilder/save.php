<?php

/**
 * Page containing save search form
 *
 * @copyright Catalyst IT Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once('report_forms.php');

$id = optional_param('id',null,PARAM_INT); // id for report to save
$returnurl = $CFG->wwwroot.'/local/reportbuilder/report.php?id='.$id;

$report = new reportbuilder($id);
if(!$report->is_capable($id)) {
    error(get_string('nopermission','local'));
}

$mform =& new report_builder_save_form(null, compact('id','report'));

// form results check
if ($mform->is_cancelled()) {
    redirect($returnurl);
}
if ($fromform = $mform->get_data()) {
    if(empty($fromform->submitbutton)) {
        print_error('error:unknownbuttonclicked', 'local', $returnurl);
    }
    // handle form submission
    $todb = new object();
    $todb->reportid = $fromform->id;
    $todb->userid = $fromform->userid;
    $todb->search = $fromform->search;
    $todb->name = $fromform->name;
    $todb->public = $fromform->public;
    if(insert_record('report_builder_saved', $todb)) {
        redirect($CFG->wwwroot.'/local/reportbuilder/savedsearches.php?id='.$id);
    } else {
        redirect($returnurl, get_string('error:couldnotsavesearch','local'));
    }
}

$fullname = $report->fullname;
$pagetitle = format_string(get_string('savesearch','local').': '.$fullname);
$navlinks[] = array('name' => get_string('report','local'), 'link'=> '', 'type'=>'title');
$navlinks[] = array('name' => $fullname, 'link'=> '', 'type'=>'title');
$navlinks[] = array('name' => get_string('savesearch','local'), 'link'=> '', 'type'=>'title');

$navigation = build_navigation($navlinks);
print_header_simple($pagetitle, '', $navigation, '', null, true);


$mform->display();

print_footer();


?>

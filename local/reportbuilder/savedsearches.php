<?php

/**
 * Page containing list of saved searches for this report
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

define('REPORT_BUILDER_SAVED_SEARCHES_CONFIRM_DELETE', 1);
define('REPORT_BUILDER_SAVED_SEARCHES_FAILED_DELETE', 2);

$id = optional_param('id',null,PARAM_INT); // id for report
$sid = optional_param('sid',null,PARAM_INT); // id for saved search
$d = optional_param('d',false, PARAM_BOOL); // delete saved search?
$confirm = optional_param('confirm', false, PARAM_BOOL); // confirm delete
$notice = optional_param('notice', 0, PARAM_INT); // notice flag

$returnurl = $CFG->wwwroot.'/local/reportbuilder/savedsearches.php?id='.$id;

$report = new reportbuilder($id);
if(!$report->is_capable($id)) {
    error(get_string('nopermission','local'));
}

if($d && $confirm) {
    // delete an existing saved search
    if(!confirm_sesskey()) {
        print_error('confirmsesskeybad','error');
    }
    if(delete_records('report_builder_saved', 'id', $sid)) {
        redirect($returnurl . '&amp;notice=' .
            REPORT_BUILDER_SAVED_SEARCHES_CONFIRM_DELETE);
    } else {
        redirect($returnurl . '&amp;notice=' .
            REPORT_BUILDER_SAVED_SEARCHES_FAILED_DELETE);
    }
} else if($d) {
    $fullname = $report->fullname;
    $pagetitle = format_string(get_string('savesearch','local').': '.$fullname);
    $navlinks[] = array('name' => get_string('report','local'), 'link'=> '', 'type'=>'title');
    $navlinks[] = array('name' => $fullname, 'link'=> '', 'type'=>'title');
    $navlinks[] = array('name' => get_string('savedsearches','local'), 'link'=> '', 'type'=>'title');

    $navigation = build_navigation($navlinks);
    print_header_simple($pagetitle, '', $navigation, '', null, true, $report->edit_button());

    print_heading(get_string('savedsearches','local'));
    // prompt to delete
    notice_yesno(get_string('savedsearchconfirmdelete','local'),
        "savedsearches.php?id={$id}&amp;sid={$sid}&amp;d=1&amp;confirm=1&amp;" .
        "sesskey={$USER->sesskey}", $returnurl);

    print_footer();
    die;
}



$fullname = $report->fullname;
$pagetitle = format_string(get_string('savesearch','local').': '.$fullname);
$navlinks[] = array('name' => get_string('report','local'), 'link'=> '', 'type'=>'title');
$navlinks[] = array('name' => $fullname, 'link'=> '', 'type'=>'title');
$navlinks[] = array('name' => get_string('savedsearches','local'), 'link'=> '', 'type'=>'title');

$navigation = build_navigation($navlinks);
print_header_simple($pagetitle, '', $navigation, '', null, true, $report->edit_button());

print $report->view_button();
print_heading(get_string('savedsearches','local'));

if($notice) {
    switch($notice) {
    case REPORT_BUILDER_SAVED_SEARCHES_CONFIRM_DELETE:
        notify(get_string('savedsearchdeleted','local'),'notifysuccess');
        break;
    case REPORT_BUILDER_SAVED_SEARCHES_FAILED_DELETE:
        notify(get_string('error:savedsearchnotdeleted','local'));
        break;
    }
}

if($searches = get_records_select('report_builder_saved', 'userid='.$USER->id.' AND reportid='.$id, 'name')) {
    $tableheader = array(get_string('name','local'),
                         get_string('options','local'));
    $data = array();

    foreach($searches as $search) {
        $row = array();
        $strdelete = get_string('delete','local');

        $row[] = '<a href="' . $CFG->wwwroot . '/local/reportbuilder/report.php?id=' . $id .
            '&amp;sid='.$search->id.'">' . $search->name . '</a>';

        $delete = '<a href="' . $CFG->wwwroot .
            '/local/reportbuilder/savedsearches.php?d=1&amp;id=' . $id . '&amp;sid=' .
            $search->id . '" title="' . $strdelete . '">' .
            '<img src="' . $CFG->pixpath . '/t/delete.gif" alt="' .
            $strdelete . '"></a>';
        $row[] = $delete;
        $data[] = $row;
    }
    $table = new object();
    $table->summary = '';
    $table->head = $tableheader;
    $table->data = $data;
    print_table($table);

} else {
    print_error('error:nosavedsearches','local');
}

print_footer();


?>

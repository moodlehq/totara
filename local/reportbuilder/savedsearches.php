<?php
require_once('../../config.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once('report_forms.php');

$id = optional_param('id',null,PARAM_INT); // id for report to save
$returnurl = $CFG->wwwroot.'/local/reportbuilder/report.php?id='.$id;

$report = new reportbuilder($id);
if(!$report->is_capable($id)) {
    error(get_string('nopermission','local'));
}

$fullname = $report->fullname;
$pagetitle = format_string(get_string('savesearch','local').': '.$fullname);
$navlinks[] = array('name' => get_string('report','local'), 'link'=> '', 'type'=>'title');
$navlinks[] = array('name' => $fullname, 'link'=> '', 'type'=>'title');
$navlinks[] = array('name' => get_string('savedsearches','local'), 'link'=> '', 'type'=>'title');

$navigation = build_navigation($navlinks);
print_header_simple($pagetitle, '', $navigation, '', null, true, $report->edit_button());

if($searches = get_records_select('report_builder_saved', 'userid='.$USER->id.' AND reportid='.$id, 'name')) {
    print '<table><tr><th>Search name</th><th>Options</th>';
    foreach($searches as $search) {
        print '<tr><td><a href="'.$CFG->wwwroot.'/local/reportbuilder/report.php?id='.$id.'&amp;sid='.$search->id.'">' .
            $search->name . '</a></td>';
        print '</td>';
        print '<td>Delete</td></tr>';

    }
    print '</table>';
} else {
    print_error('error:nosavedsearches','local');
}

print_footer();


?>

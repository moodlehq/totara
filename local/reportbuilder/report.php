<?php

require_once('../../config.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');

$format    = optional_param('format', '', PARAM_TEXT);
$id = required_param('id',PARAM_INT);

$shortname = get_field('report_builder','shortname','id',$id);

// new report object
$report = new reportbuilder($shortname);

if(!$report->is_capable()) {
    error(get_string('nopermission','local'));
}

if($format!='') {
    $report->export_data($format);
    die;
}

$countfiltered = $report->get_filtered_count();
$countall = $report->get_full_count();
$fullname = $report->_fullname;
$pagetitle = format_string(get_string('report','local').': '.$fullname);
$navlinks[] = array('name' => get_string('report','local'), 'link'=> '', 'type'=>'title');
$navlinks[] = array('name' => $fullname, 'link'=> '', 'type'=>'title');

$navigation = build_navigation($navlinks);

print_header_simple($pagetitle, '', $navigation, '', null, true, print_edit_button($id));

// display heading including filtering stats
print_heading("$fullname: ".get_string('showing','local')." $countfiltered / $countall");

// print filters
$report->display_search();

print "<br />";

// show results
if($countfiltered>0) {
    $report->display_table();
    // export button
    $report->export_button();
} else {
    print get_string('noresultsfound','local');
}


print_footer();


function print_edit_button($id) {
    global $CFG;
    $context = get_context_instance(CONTEXT_SYSTEM);
    // TODO what capability should be required here?
    if(has_capability('moodle/local:admin',$context)) {
        return print_single_button($CFG->wwwroot.'/local/reportbuilder/settings.php', array('id'=>$id), get_string('editthisreport','local'), 'get', '_self', true);
    } else {
        return '';
    }
}

<?php
require_once('../../config.php');
require_once($CFG->dirroot.'/local/learningreports/learningreportslib.php');
require_once($CFG->dirroot.'/local/learningreports/download_form.php');

$id = required_param('id',PARAM_INT);
$format = optional_param('format',null,PARAM_TEXT);

$download = new download_form();

if($fromform = $download->get_data()) {
    // print download links instead of table
    $pagetitle = format_string(get_string('download','local'));
    $navlinks[] = array('name' => get_string('learningreports','local'), 'link'=> '', 'type'=>'title');

    $navigation = build_navigation($navlinks);
    print_header_simple($pagetitle, '', $navigation, '', '', true);

    // display heading including filtering stats
    print_heading("Export");
    print_box_start();

    echo '<ul>';
    echo '<li><a href="download.php?id='.$id.'&amp;format=csv">Export in text format</a></li>';
    echo '<li><a href="download.php?id='.$id.'&amp;format=ods">Export in ODS format</a></li>';
    echo '<li><a href="download.php?id='.$id.'&amp;format=xls">Export in Excel format</a></li>';
    echo '</ul>';

    print_box_end();
    print_footer();

    die;


}

if ($format) {
    // send export data instead of table
    $shortname = get_field('learning_report','shortname','id',$id);
    $report = new learningreport($shortname);
    if(!$report->is_capable()) {
        error('You cannot view this page');
    }
    $report->export_data($format);
    die;
}

error('There was a problem downloading the file');

<?php

require_once('../../config.php');
require_once('learningreportslib.php');
require_once($CFG->dirroot.'/local/learningreports/download_form.php');
/*
require_once($CFG->dirroot.'/admin/learningrecords/reportlib.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/tablelib.php');
require_once($CFG->dirroot.'/admin/learningrecords/filters/lib.php');
require_once($CFG->dirroot.'/local/mitms.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');
require_once($CFG->dirroot.'/local/reportlib.php');
require_once('query_snippets.php');
 */
/*
define('DEFAULT_PAGE_SIZE', 40);
define('SHOW_ALL_PAGE_SIZE', 5000);

$spage     = optional_param('spage', 0, PARAM_INT);                    // which page to show
$perpage   = optional_param('perpage', DEFAULT_PAGE_SIZE, PARAM_INT);
$ssort     = optional_param('ssort');
 */
$format    = optional_param('format', '', PARAM_TEXT);

// new report object
$report = new learningreport('course_comp_site');

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
    echo '<li><a href="report.php?format=csv">Export in text format</a></li>';
    echo '<li><a href="report.php?format=ods">Export in ODS format</a></li>';
    echo '<li><a href="report.php?format=xls">Export in Excel format</a></li>';
    echo '</ul>';

    print_box_end();
    print_footer();

    die;


}
if ($format) {
    // send export data instead of table
    $report->export_data($format);
    die;
}

//$sql = $report->build_query(false,true);
//$data = $report->fetch_data($sql, 0, 10);

$countfiltered = $report->get_filtered_count();
$countall = $report->get_full_count();
$fullname = $report->_fullname;
$pagetitle = format_string(get_string('learningreports','local').': '.$fullname);
$navlinks[] = array('name' => get_string('learningreports','local'), 'link'=> '', 'type'=>'title');
$navlinks[] = array('name' => $fullname, 'link'=> '', 'type'=>'title');

$navigation = build_navigation($navlinks);
print_header_simple($pagetitle, '', $navigation, '', '', true);

// display heading including filtering stats
print_heading("$fullname: Showing $countfiltered / $countall");

// print filters
$report->display_add();
$report->display_active();

// show results
if($countfiltered>0) {
    $report->display_table();
    // export button
    $download->display();
} else {
    print "No results found. Try removing one or more filters.";
}


print_footer();
/*

// generate the table column headers
foreach($columns as $column) {
    $type = $column['type'];
    $value = $column['value'];
    // don't print a column if heading is blank
    if(isset($column['heading']) && $column['heading'] != '') {
        $tablecolumns[] = "{$type}_{$value}"; // used for sorting
        $tableheaders[] = $column['heading'];
    }
}

// build the table
$table = new flexible_table($tableid);
$table->define_columns($tablecolumns);
$table->define_headers($tableheaders);
$table->column_style('edit','width','80px');
$table->set_attribute('cellspacing', '0');
$table->set_attribute('id', $tableid);
$table->set_attribute('class', 'logtable generalbox');
$table->set_control_variables(array(
            TABLE_VAR_SORT    => 'ssort',
            TABLE_VAR_HIDE    => 'shide',
            TABLE_VAR_SHOW    => 'sshow',
            TABLE_VAR_IFIRST  => 'sifirst',
            TABLE_VAR_ILAST   => 'silast',
            TABLE_VAR_PAGE    => 'spage'
        ));
$table->sortable(true,'user_fullname'); // sort by name by default
$table->setup();
$table->initialbars(true);
$table->pagesize($perpage, $countfiltered);

// get the ORDER BY SQL fragment from table
$sort = $table->get_sql_sort();
if($sort!='') {
    $order = "ORDER BY $sort";
} else {
    $order = '';
}

// action to export data
$download = new download_form();
if($fromform = $download->get_data()) {
    // save query to session vars
    $SESSION->query = $sql.$where.$order;
    $SESSION->columns = $columns;
    $SESSION->count = $countfiltered;
    $SESSION->download_cols = strip_tags_deep($tableheaders);
    // send to download page
    redirect($CFG->wwwroot.'/admin/learningrecords/download.php');
}

// Get Data for Table
$data = fetch_data($sql.$where.$order, $columns,
    $table->get_page_start(), $table->get_page_size());


// add data to flexible table
foreach ($data as $row) {
    $table->add_data($row);
}
 */

// Begin Page output

// check permissions
/*
$context = get_context_instance(CONTEXT_SYSTEM);
if(!has_capability('moodle/local:viewlocalreports',$context) and
   !has_capability('moodle/local:viewstaffreports',$context)) {
    print_error('nopermissions');
    die;
}
 */
/*
$pagetitle = format_string(get_string('learningreports','local'));
$navlinks[] = array('name' => get_string('learningreports','local'), 'link'=> '', 'type'=>'title');
$navigation = build_navigation($navlinks);
print_header_simple($pagetitle, '', $navigation, '', '', true);
 */
// display heading including filtering stats
//print_heading("{$report_title}: Showing $countfiltered / $countall");


/*
// print the current query
if ($debug) {
    print $sql.$where.$order;
}

// show filter form elements
$filtering->display_add();
$filtering->display_active();

// display table and export form if there are results
if($countfiltered>0) {
    $table->print_html();
    $download->display();
} else {
    // lang string
    print "No results found. Try removing one or more filters.";
}
 */
//print_footer();




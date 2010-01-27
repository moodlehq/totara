<?php

require_once('../../../config.php');
require_once($CFG->dirroot.'/admin/report/learningrecords/reportlib.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/tablelib.php');
require_once($CFG->dirroot.'/admin/report/learningrecords/filters/lib.php');
require_once($CFG->dirroot.'/local/mitms.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');
require_once($CFG->dirroot.'/local/reportlib.php');
require_once($CFG->dirroot.'/admin/report/learningrecords/download_form.php');
require_once('query_snippets.php');

define('DEFAULT_PAGE_SIZE', 40);
define('SHOW_ALL_PAGE_SIZE', 5000);

@raise_memory_limit('256M');
@set_time_limit(0);

$spage     = optional_param('spage', 0, PARAM_INT);                    // which page to show
$perpage   = optional_param('perpage', DEFAULT_PAGE_SIZE, PARAM_INT);
$ssort     = optional_param('ssort');

// build filter to get where clause
$filtering = new filtering($source, $fieldinfo, $snippets);
$extrasql = $filtering->get_sql_filter();
if($extrasql && $extrasql!='') {
    $where = "WHERE $extrasql";
} else {
    $where = '';
}

// build sql query
// note that this function looks at session var set by filtering
// so needs to be *after* filtering defined
$sql = build_query($columns, $source, $snippets);

// count results without filtering
$countsql = build_query($columns, $source, $snippets, true);
$countall = count_records_sql($countsql);
// count results with filtering if there is any
if($where=='') {
    $countfiltered = $countall;
} else {
    $countfiltered = count_records_sql($countsql.$where);
}

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
    redirect($CFG->wwwroot.'/admin/report/learningrecords/download.php');
}

// Get Data for Table
$data = fetch_data($sql.$where.$order, $columns,
    $table->get_page_start(), $table->get_page_size());


// add data to flexible table
foreach ($data as $row) {
    $table->add_data($row);
}


// Begin Page output
admin_externalpage_setup('reportlearningrecords');
admin_externalpage_print_header();

// display heading including filtering stats
print_heading("{$report_title}: Showing $countfiltered / $countall");

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

admin_externalpage_print_footer();




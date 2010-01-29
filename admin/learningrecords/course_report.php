<?php

////////// DEFINED PARAMETERS /////////////
require_once('../../config.php');
$report = get_record('learning_report','shortname','new');
$source = $report->source;
$columns = unserialize($report->columns);
$fieldinfo = unserialize($report->filters);
$report_title = $report->fullname;
$tableid = 'report-table-'.$report->shortname;

// display SQL query
$debug = false;


/////////////////////////////////////

require_once('report_base.php');


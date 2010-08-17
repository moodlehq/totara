<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

require_once '../../config.php';
require_once '../../local/oauth/fusionlib.php';
require_once 'lib.php';

$id         = required_param('id', PARAM_INT); // report id
$sid        = optional_param('sid', NULL, PARAM_INT); // report search id

if($id != null) {
    // look for existing report by id
    $report = get_record('report_builder', 'id', $id);
} else if ($shortname != null) {
    // look for existing report by shortname
    $report = get_record('report_builder', 'shortname', $shortname);
} else {
    // either id or shortname is required
    error(get_string('noshortnameorid','local'));
}
$rep =  new reportbuilder($id, null, false, $sid) ;

if(!$rep->is_capable($id)) {
    error(get_string('nopermission','local'));
}

// check OAuth
$oauth = new local_oauth_fusion();
// parameters to preserve
$preserve = array(
                   'id' => $id,
                   'sid' => $sid,
            );
if (!$oauth->authenticate($preserve)) {
    print_error(get_string('authfailed', 'local_oauth'));
}

$columns = $rep->columns;
$shortname = $rep->shortname;
$count = $rep->get_filtered_count();
$query = $rep->build_query(false, true);

// need to create flexible table object to get sort order
// from session var
$table = new flexible_table($shortname);
$sort = $table->get_sql_sort($shortname);

// array of filters that have been applied
// for including in report where possible
$restrictions = $rep->get_restriction_descriptions();
$query .= ($sort!='') ? " ORDER BY $sort" : '';

$fields = array();
foreach($columns as $column) {
    // check that column should be included
    if($column->display_column(true)) {
        $type = 'STRING';
        if ($column->displayfunc == 'nice_date') {
            $type = 'DATETIME';
        }
        else if($column->displayfunc == 'number') {
            $type = 'NUMBER';
        }
        $fields[clean_column_name(strip_tags($column->heading))] = $type;
    }
}
$tablename = preg_replace('/\s/', '_', clean_filename(trim($shortname)));
try {
$tables = $oauth->show_tables();
}
catch (local_oauth_exception $e) {
    // clean it down
    $oauth->wipe_auth();

    // try again
    $oauth = new local_oauth_fusion();
    if (!$oauth->authenticate($preserve)) {
        print_error(get_string('authfailed', 'local_oauth'));
    }

   // print_error(get_string('authfailed', 'local_oauth').$e->getMessage());
}
if (!$oauth->table_exists($tablename)) {
    $result = $oauth->create_table($tablename, $fields);
}
$tables = $oauth->show_tables();

// switch off the timeout as this could easily be long running
@set_time_limit(0);

// process the output
$blocksize = 500;
$numfields = count($fields);
// break the data into blocks as single array gets too big
global $data_len;
for($k=0;$k<=floor($count/$blocksize);$k++) {
    $start = $k*$blocksize;
    $data = $rep->fetch_data($query, $start, $blocksize, true, true);
    $i = 0;
    $rows = array();
    foreach ($data AS $row) {
        $row = array();
        for($j=0; $j<$numfields; $j++) {
            if(isset($data[$i][$j])) {
                $row[] = addslashes(htmlspecialchars_decode($data[$i][$j]));
            } else {
                $row[] = '';
            }
        }
        $data_len = 0;
        array_map(function ($i) {
            global $data_len;
            $data_len += strlen($i);
            }, $row);
        $rows[]= $row;
        $i++;
    }
    // echo "data size now: $data_len\n";
    $result = $oauth->insert_rows($tablename, $rows);

}
$result = $oauth->insert_rows($tablename, $rows);

// all done - go and have a look at the table
$table = $oauth->table_by_name($tablename, true);
$table_id = $table['table id'];
redirect('http://tables.googlelabs.com/DataSource?dsrcid='.$table_id);
exit;


function clean_column_name($name) {
    $name = preg_replace('/[^a-zA-Z0-9\_ ]/', ' ', $name);
    $name = preg_replace('/\s+/', ' ', $name);
    $name = preg_replace('/\s/', '_', $name);
    return $name;
}


?>

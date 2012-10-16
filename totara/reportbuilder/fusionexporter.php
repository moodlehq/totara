<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Piers Harding <piers@catalyst.net.nz>
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage reportbuilder
 */
global $DB;

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once('lib.php');

require_login();

$id         = required_param('id', PARAM_INT); // report id
$sid        = optional_param('sid', NULL, PARAM_INT); // report search id

if ($id != null) {
    // look for existing report by id
    $report = $DB->get_record('report_builder', array('id' => $id));
} else {
    // id is required
    print_error('invalidreportid', 'local_reportbuilder');
}
$rep =  new reportbuilder($id, null, false, $sid) ;

if (!$rep->is_capable($id)) {
    print_error('nopermission', 'totara_reportbuilder');
}

// temporarily disable awaiting repository/gdrive integration
print_error('error:fusion_oauthnotsupported', 'totara_reportbuilder');

// check OAuth
$oauth = new local_oauth_fusion();
// parameters to preserve
$preserve = array(
                   'id' => $id,
                   'sid' => $sid,
            );
try {
    if (!$oauth->authenticate($preserve)) {
        print_error(get_string('oauthfailed', 'totara_oauth'));
    }
    $oauth->show_tables();
}
catch (local_oauth_exception $e) {
    // clean it down
    $oauth->wipe_auth();
    // try again
    $oauth = new local_oauth_fusion();
    if (!$oauth->authenticate($preserve)) {
        print_error(get_string('oauthfailed', 'totara_oauth'));
    }
}

$columns = $rep->columns;
$shortname = $rep->shortname;
$count = $rep->get_filtered_count();
list($query, $params) = $rep->build_query(false, true);
$query .= flexible_table::get_sort_for_table($shortname);

// array of filters that have been applied
// for including in report where possible
$restrictions = $rep->get_restriction_descriptions();

$fields = array();
foreach ($columns as $column) {
    // check that column should be included
    if ($column->display_column(true)) {
        $type = 'STRING';
        if ($column->displayfunc == 'nice_date') {
            $type = 'DATETIME';
        }
        else if ($column->displayfunc == 'number') {
            $type = 'NUMBER';
        }
        $fields[clean_column_name(strip_tags($column->heading))] = $type;
    }
}
$tablename = preg_replace('/\s/', '_', clean_filename(trim($shortname))).' '.date("Y-m-d H:i:s", strtotime('+0 days'));
try {
    $tables = $oauth->show_tables();
}
catch (local_oauth_exception $e) {
    // clean it down
    $oauth->wipe_auth();

    // try again
    $oauth = new local_oauth_fusion();
    if (!$oauth->authenticate($preserve)) {
        print_error(get_string('oauthfailed', 'totara_oauth'));
    }

}
if (!$oauth->table_exists($tablename)) {
    $result = $oauth->create_table($tablename, $fields);
}
$tables = $oauth->show_tables();

// switch off the timeout as this could easily be long running
@set_time_limit(0);

// process the output
$numfields = count($fields);
// break the data into blocks as single array gets too big
global $data_len;

if ($records = $DB->get_recordset_sql($query, $params)) {
    $rows = array();
    foreach ($records as $record) {
        $record_data = $rep->process_data_row($record, true, true);
        $row = array();
        for($j=0; $j<$numfields; $j++) {
            if (isset($record_data[$j])) {
                $row[] = htmlspecialchars_decode($record_data[$j]);
            } else {
                $row[] = '';
            }
        }
        $rows[]= $row;
    }
    $result = $oauth->insert_rows($tablename, $rows);
    $records->close();
}

// all done - go and have a look at the table
$table = $oauth->table_by_name($tablename, true);
$table_id = $table['table id'];
redirect('https://www.google.com/fusiontables/DataSource?dsrcid=' . $table_id);
exit;


function clean_column_name($name) {
    $name = preg_replace('/[^a-zA-Z0-9\_ ]/', ' ', $name);
    $name = preg_replace('/\s+/', ' ', $name);
    $name = preg_replace('/\s/', '_', $name);
    return $name;
}


?>

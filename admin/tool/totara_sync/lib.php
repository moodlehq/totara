<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @package totara
 * @subpackage totara_sync
 */

defined('MOODLE_INTERNAL') || die;

define('TOTARA_SYNC_DBROWS', 10000);
define('FILE_ACCESS_DIRECTORY', 0);
define('FILE_ACCESS_UPLOAD', 1);

/**
* Run the cron for syncing Totara elements with external sources
*
* This can be run separately from the main cron via run_cron.php
*
* @access public
* @return void
*/
function tool_totara_sync_cron() {
    global $CFG;

    // Get enabled sync element objects
    $elements = totara_sync_get_elements($onlyenabled=true);

    foreach ($elements as $element) {
        try {
            if (!method_exists($element, 'sync')) {
                // Skip if no sync() method exists
                continue;
            }

            // Finally, start element syncing
            $element->sync();
        } catch (totara_sync_exception $e) {
            $msg = $e->getMessage();
            $msg .= !empty($e->debuginfo) ? " - {$e->debuginfo}" : '';
            totara_sync_log($e->tsync_element, $msg, $e->tsync_logtype, $e->tsync_action);
            $element->get_source()->drop_temp_table();
            continue;
        } catch (Exception $e) {
            totara_sync_log($element->get_name(), $e->getMessage(), 'error', 'unknown');
            $element->get_source()->drop_temp_table();
            continue;
        }

        $element->get_source()->drop_temp_table();
    }

    return true;
}

/**
 * Method for adding sync log messages
 *
 * @param string $element element name
 * @param string $info the log message
 * @param string $type the log message type
 * @param string $action the action which caused the log message
 */
function totara_sync_log($element, $info, $type='info', $action='') {
    global $DB;

    $todb = new stdClass;
    $todb->element = $element;
    $todb->logtype = $type;
    $todb->action = $action;
    $todb->info = $info;
    $todb->time = time();

    return $DB->insert_record('totara_sync_log', $todb);
}

/**
 * Get the sync file paths for all elements
 *
 * @return array of filepaths
 */
function totara_sync_get_element_files() {
    global $CFG;

    // Get all available sync element files
    $edir = $CFG->dirroot.'/admin/tool/totara_sync/elements/';
    $pattern = '/(.*?)\.php$/';
    $files = preg_grep($pattern, scandir($edir));
    $filepaths = array();
    foreach ($files as $key => $val) {
        $filepaths[] = $edir . $val;
    }
    return $filepaths;
}

/**
 * Get sync elements
 *
 * @param boolean $onlyenabled only return enabled elements
 *
 * @return array of element objects
 */
function totara_sync_get_elements($onlyenabled=false) {
    global $CFG;

    $efiles = totara_sync_get_element_files();

    $elements = array();
    foreach ($efiles as $filepath) {
        $element = basename($filepath, '.php');
        if ($onlyenabled) {
            if (!get_config('totara_sync', 'element_'.$element.'_enabled')) {
                continue;
            }
        }

        require_once($filepath);

        $elementclass = 'totara_sync_element_'.$element;
        if (!class_exists($elementclass)) {
            // Skip if the class does not exist
            continue;
        }

        $elements[$element] = new $elementclass;
    }

    return $elements;
}

/**
 * Get a specified element object
 *
 * @param string $element the element name
 *
 * @return stdClass the element object
 */
function totara_sync_get_element($element) {
    $elements = totara_sync_get_elements();

    if (!in_array($element, array_keys($elements))) {
        return false;
    }

    return $elements[$element];
}

function totara_sync_make_dirs($dirpath) {
    global $CFG;

    $dirarray = explode('/', $dirpath);
    $currdir = '';
    foreach ($dirarray as $dir) {
        $currdir = $currdir.$dir.'/';
        if (!file_exists($currdir)) {
            if (!mkdir($currdir, $CFG->directorypermissions)) {
                return false;
            }
        }
    }

    return true;
}

/**
 * Perform bulk inserts into specified table
 *
 * @param string $table table name
 * @param array $datarows an array of row arrays
 *
 * @return boolean
 */
function totara_sync_bulk_insert($table, $datarows) {
    global $CFG, $DB;

    if (empty($datarows)) {
        return true;
    }

    $length = 5000;
    $chunked_datarows = array_chunk($datarows, $length);

    unset($datarows);

    foreach ($chunked_datarows as $key=>$chunk) {
        $sql = "INSERT INTO {{$table}} ("
            .implode(',',array_keys($chunk[0]))
            . ') VALUES ';

        $all_values= array();
        $sql_rows = array();
        foreach ($chunk as $row){
            $sql_rows[]= "(". str_repeat("?,", (count(array_keys($chunk[0])) - 1)) ."?)";
            $all_values = array_merge($all_values, array_values($row));
        }
        unset($row);
        $sql .= implode(',', $sql_rows);
        unset ($sql_rows);

        // Execute insert SQL
        if (!$DB->execute($sql, array_values($all_values))) {
            return false;
        }
        unset ($sql);
        unset($all_values);
        unset($chunked_datarows[$key]);
        unset($chunk);
    }

    unset($chunked_datarows);

    return true;
}

class totara_sync_exception extends moodle_exception {
    public $tsync_element;
    public $tsync_action;
    public $tsync_logtype;

    /**
     * Constructor
     * @param string $errorcode The name of the string from error.php to print
     * @param object $a Extra words and phrases that might be required in the error string
     * @param string $debuginfo optional debugging information
     * @param string $logtype optional totara sync log type
     */
    public function __construct($element, $action, $errorcode, $a = null, $debuginfo = null, $logtype = 'error') {
        $this->tsync_element = $element;
        $this->tsync_action = $action;
        $this->tsync_logtype = $logtype;

        parent::__construct($errorcode, 'tool_totara_sync', $link='', $a, $debuginfo);
    }
}

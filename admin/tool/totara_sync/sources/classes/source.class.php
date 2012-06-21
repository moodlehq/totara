<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
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

require_once($CFG->dirroot.'/admin/tool/totara_sync/lib.php');

abstract class totara_sync_source {
    protected $config;

    public $temptable;

    abstract function has_config();

    /**
     * Hook for adding source plugin-specific config form elements
     */
    abstract function config_form(&$mform);

    /**
     * Hook for saving source plugin-specific data
     */
    abstract function config_save($data);

    /**
     * Implementation of data import to the sync table
     *
     * @return sync table name, e.g mdl_totara_sync_org
     */
    abstract function get_sync_table();

    /**
     * Returns the name of the element this source applies to
     */
    abstract function get_element_name();

    /**
     * Returns whether the source uses files (e.g CSV) for syncing or not (e.g LDAP)
     *
     * @return boolean
     */
    abstract function uses_files();

    /**
     * Returns the source file location (used if uses_files returns true)
     *
     * @return string
     */
    abstract function get_filepath();


    /**
     * Remember to call parent::__construct() in child classes
     */
    function __construct() {
        $this->config = get_config($this->get_name());
        $this->filesdir = rtrim(get_config('totara_sync', 'filesdir'), '/');
    }

    /**
     * Gets the class name of the element source
     *
     * @return string the child class name
     */
    function get_name() {
        return get_class($this);
    }

    /**
     * Method for setting source plugin config settings
     */
    function set_config($name, $value) {
        return set_config($name, $value, $this->get_name());
    }

    /**
     * Add source sync log entries to the sync database with this method
     */
    function addlog($info, $type='info', $action='') {
        totara_sync_log($this->get_element_name(), $info, $type, $action);
    }

    /**
     * drop the tempoary table
     *
     * @param string $tablename
     * @return boolean
     */
    public static function drop_temp_table($tablename) {
        global $DB;
        $dbman = $DB->get_manager(); // We are going to use database_manager services

        $table = new xmldb_table($tablename);
        if ($dbman->table_exists($table)) {
            return $dbman->drop_temp_table($table); // And drop it
        }
        return false;
    }
}


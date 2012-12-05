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

require_once($CFG->dirroot.'/admin/tool/totara_sync/lib.php');

abstract class totara_sync_source {
    protected $config;

    /**
     * The temp table name to be used for holding data from external source
     * Set this in the child class constructor
     */
    public $temptablename;

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
     * @return sync table name (without prefix), e.g totara_sync_org
     * @throws totara_sync_exception if error
     */
    abstract function get_sync_table();

    /**
     * Define and create temp table necessary for element syncing
     */
    abstract function prepare_temp_table($clone = false);

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

        // Ensure child class specified temptablename
        if (!isset($this->temptablename)) {
            throw totara_sync_exception($this->get_element_name, 'setup', 'error',
                'Programming error - source class for ' . $this->get_name() .
                ' needs to specify temptablename in constructor');
        }
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
     * drop the temporary source table (if applicable)
     *
     * @return true
     * @throws dml_exception if error
     */
    function drop_temp_table() {
        global $DB;

        if (empty($this->temptablename)) {
            // no temptable
            return true;
        }

        $dbman = $DB->get_manager(); // We are going to use database_manager services

        $table = new xmldb_table($this->temptablename);
        if ($dbman->table_exists($table)) {
            $dbman->drop_temp_table($table); // And drop it
        }

        // drop any clones
        $table = new xmldb_table($this->temptablename . '_clone');
        if ($dbman->table_exists($table)) {
            $dbman->drop_temp_table($table); // And drop it
        }

        return true;
    }

    /**
     * Create clone of temp table because MySQL cannot reference temp
     * table twice in a query
     *
     * @return mixed Returns false if failed or the name of temporary table if successful
     */
    function get_sync_table_clone() {
        global $DB;

        try {
            $temptable_clone = $this->prepare_temp_table(true);
        } catch (dml_exception $e) {
            throw new totara_sync_exception($this->get_element_name(), 'importdata',
                'temptableprepfail', $e->getMessage());
        }

        // Can't reuse $this->import_data($temptable) because the CSV file gets renamed,
        // so it fails when calling again
        //to be cross-database compliant especially for MSSQL we need to use the $temptable column names
        $fields = $temptable_clone->getFields();
        $fieldnames = array();
        foreach ($fields as $field) {
            if ($field->name != 'id') {
                $fieldnames[] = $field->name;
            }
        }
        $fieldlist = implode(",", $fieldnames);
        $sql = "INSERT INTO {{$temptable_clone->name}} ($fieldlist) SELECT $fieldlist FROM {{$this->temptablename}}";
        $DB->execute($sql);

        return $temptable_clone->name;
    }
}


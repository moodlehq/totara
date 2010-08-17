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

/**
 * OAuth library
 * @package   localoauth
 * @copyright 2010 Moodle Pty Ltd (http://moodle.com)
 * @author    Piers Harding
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require_once($CFG->dirroot.'/local/oauth/lib.php');

class local_oauth_fusion_exception extends Exception { };

class local_oauth_fusion extends local_oauth {

    private $scope = 'http://tables.googlelabs.com/api/query';
    private $site_name = 'google.com';

    public function __construct() {
        parent::__construct($this->site_name);
    }

    /**
     * clean down the auth storage
     * @return nothing
     */
    public function wipe_auth() {
        parent::wipe_auth($this->site_name);
    }

    /**
     * Add a site into the site directory
     * @param array $oauth_params parameters to pass with token request
     * @return bool success/fail
     */
    public function authenticate( $preserve = null) {
        //return parent::authenticate(array('scope' => $this->scope, 'hd' => 'default'), $preserve);
        return parent::authenticate(array('scope' => $this->scope), $preserve);
    }

    /**
     * Add a site into the site directory
     * @return array of tables - table id/name
     */
    public function show_tables() {
        return $this->getCSVTable($this->scope, array('sql' => "SHOW TABLES"));
    }

    /**
     * Add a site into the site directory
     * @return array of tables - table id/name
     */
    public function table_exists($name) {
        $tables = $this->getCSVTable($this->scope, array('sql' => "SHOW TABLES"));
        foreach ($tables as $table) {
            if ($table['name'] == $name) {
                return true;
            }
        }
        return false;
    }

    /**
     * Add a site into the site directory
     * @return array of tables - table id/name
     */
    public function desc_table($id) {
        return $this->getCSVTable($this->scope, array('sql' => "DESCRIBE ".$id));
    }

    /**
     * Add a site into the site directory
     * @return array of tables - table id/name
     */
    public function table_by_name($name, $hdr=false) {
        $tables = $this->getCSVTable($this->scope, array('sql' => "SHOW TABLES"));
        foreach ($tables as $table) {
            if ($table['name'] == $name) {
                if ($hdr) {
                    return $table;
                }
                else {
                    return $this->desc_table($table['table id']);
                }
            }
        }
        return false;
    }

    /**
     * Add a site into the site directory
     * @return array of tables - table id/name
     */
    public function create_table($tablename, $fields) {
        $columns = array();
        foreach ($fields as $name => $type) {
            $columns[]= "$name: $type";
        }
        $table_def = "CREATE TABLE ".$tablename." (".implode(", ", $columns).")";
        $response = $this->postRequest($this->scope, array('sql' => $table_def));
        if ($response->status != 200) {
            throw new local_oauth_exception($response->message . ' - ' . $table_def);
        }
        return  $response->body;
    }


    /**
     * Add a site into the site directory
     * @return array of tables - table id/name
     */
    public function insert_rows($tablename, $rows) {

        $table = $this->table_by_name($tablename, true);
        $table_id = $table['table id'];
        $desc = $this->desc_table($table_id);
        $fields = array();
        foreach ($desc as $column) {
            $fields[]= "'".$column['name']."'";
        }

        $lines = array();
        foreach ($rows as $row) {
            $values = array();
            foreach ($row as $value) {
                $values[]= "'$value'";
            }
            $lines[]= "INSERT INTO ".$table_id." (".implode(', ', $fields).") VALUES (".implode(", ", $values).") ";
        }
        $sql = " ".implode("; ", $lines)."; ";
        $response = $this->postRequest($this->scope, array('sql' => $sql));

        if ($response->status != 200) {
            throw new local_oauth_exception($response->message.' - '.$sql);
        }
        return  $response->body;
    }

}

<?php // $Id$

///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT                                                   //
//                                                                       //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//          http://moodle.com                                            //
//                                                                       //
// Copyright (C) 1999 onwards Martin Dougiamas  http://dougiamas.com     //
//                                                                       //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

/**
 * position/lib.php
 *
 * Library to construct position hierarchies
 * @copyright Catalyst IT Limited
 * @author Jonathan Newman
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package MITMS
 */
require_once($CFG->dirroot.'/hierarchy/lib.php');


define('POSITION_TYPE_PRIMARY',         1);
define('POSITION_TYPE_SECONDARY',       2);
define('POSITION_TYPE_ASPIRATIONAL',    3);

$POSITION_TYPES = array(
    POSITION_TYPE_PRIMARY       => 'primary',
    POSITION_TYPE_SECONDARY     => 'secondary',
    POSITION_TYPE_ASPIRATIONAL  => 'aspirational'
);

$POSITION_CODES = array_flip($POSITION_TYPES);


/**
 * Oject that holds methods and attributes for position operations.
 * @abstract
 */
class position extends hierarchy {

    /**
     * The base table prefix for the class
     */
    var $prefix = 'position';
    var $extrafield = null;

}


/**
 * Position assignments
 */
class position_assignment extends data_object {

    /**
     * DB Table
     * @var string $table
     */
    public $table = 'position_assignment';

    /**
     * Array of required table fields, must start with 'id'.
     * @var array $required_fields
     */
    public $required_fields = array(
        'id',
        'userid',
        'type',
        'fullname',
        'shortname',
        'description',
        'positionid',
        'organisationid',
        'managerid',
        'reportstoid',
        'timecreated',
        'timemodified',
        'usermodified',
        'timevalidfrom',
        'timevalidto'
    );

    public $userid;
    public $type;
    public $fullname;
    public $shortname;
    public $description;
    public $positionid;
    public $organisationid;
    public $managerid;
    public $reportstoid;
    public $timecreated;
    public $timemodified;
    public $usermodified;
    public $timevalidfrom;
    public $timevalidto;

    /**
     * Finds and returns a data_object instance based on params.
     * @static abstract
     *
     * @param array $params associative arrays varname=>value
     * @return object data_object instance or false if none found.
     */
    public function fetch($params) {
        return self::fetch_helper($this->table, get_class($this), $params);
    }

    public function save() {
        global $USER;

        // Get time (expensive on vservers)
        $time = time();

        $this->timecreated = $time;
        $this->timemodified = $time;
        $this->usermodified = $USER->id;

        if (!$this->fullname) {
            $this->fullname = '';
        }

        if (!$this->shortname) {
            $this->shortname = '';
        }

        if (!$this->positionid) {
            return false;
        }

        if (!$this->organisationid) {
            $this->organisationid = null;
        }

        if (!$this->reportstoid) {
            $this->reportstoid = null;
        }

        if (!$this->timevalidfrom) {
            $this->timevalidfrom = null;
        }

        if (!$this->timevalidto) {
            $this->timevalidto = null;
        }

        // Check if updating or inserting new
        if ($this->id) {
            $this->update();
        }
        else {
            $this->insert();
        }

        return true;
    }
}

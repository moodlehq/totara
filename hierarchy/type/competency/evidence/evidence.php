<?php

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
 * @copyright Catalyst IT Limited
 * @author Aaron Barnes
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package MITMS
 */
require_once($CFG->libdir.'/data_object.php');

/**
 * Competency evidence
 */
class competency_evidence extends data_object {

    /**
     * Database table
     * @var string
     */
    public $table = 'competency_evidence';

    /**
     * Database required fields
     * @var array
     */
    public $required_fields = array(
        'id', 'userid', 'competencyid', 'positionid', 'organisationid',
        'assessorid', 'assessorname', 'assessortype', 'proficiency',
        'timecreated', 'timemodified', 'reaggregate'
    );

    public $timecreated;

    /**
     * Finds and returns a data_object instance based on params.
     *
     * @param array $params associative arrays varname=>value
     * @return object data_object instance or false if none found.
     */
    public static function fetch($params) {
        return self::fetch_helper('competency_evidence', __CLASS__, $params);
    }

    /**
     * Trigger a reaggregation of evidence items
     *
     * @return  void
     */
    public function trigger_reaggregation() {
        return $this->_save();
    }

    /**
     * Update the user's proficiency
     *
     * @param   $proficiency    int
     * @return  void
     */
    public function update_proficiency($proficiency) {
        $this->proficiency = $proficiency;

        return $this->_save();
    }

    /**
     * Save an evidence record
     *
     * @return  void
     */
    private function _save() {
        $now = time();

        // Set up some stuff
        if (!$this->timecreated) {
            $this->timecreated = $now;
        }

        $this->timemodified = $now;
        $this->reaggregate = $now;

        // Update database
        if (!$this->id) {
            if (!$this->insert()) {
                error('Could not insert new evidence item evidence');
            }
        }
        else {
            if (!$this->update()) {
                error('Could not update evidence item evidence');
            }
        }
    }
}

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
 * @package totara
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
    public $table = 'comp_evidence';

    /**
     * Database required fields
     * @var array
     */
    public $required_fields = array(
        'id', 'userid', 'competencyid', 'positionid', 'organisationid',
        'assessorid', 'assessorname', 'assessmenttype', 'proficiency',
        'timecreated', 'timemodified', 'reaggregate'
    );

    public $userid;
    public $competencyid;
    public $positionid;
    public $organisationid;
    public $assessorid;
    public $assessorname;
    public $assessmenttype;
    public $proficiency;
    public $timecreated;
    public $timemodified;
    public $reaggregate;

    /**
     * Finds and returns a data_object instance based on params.
     *
     * @param array $params associative arrays varname=>value
     * @return object data_object instance or false if none found.
     */
    public static function fetch($params) {
        return self::fetch_helper('comp_evidence', __CLASS__, $params);
    }

    /**
     * Trigger a reaggregation of this evidence item
     *
     * @return  void
     */
    public function trigger_reaggregation() {
        $this->reaggregate = time();

        return $this->_save();
    }

    /**
     * Update the user's proficiency for this evidence item
     *
     * @param   $proficiency    int
     * @return  void
     */
    public function update_proficiency($proficiency) {
        $this->proficiency = $proficiency;

        // Save new proficiency value
        $this->_save();

        // Trigger reaggregation of parent records as
        // obviously their child evidence items have changed
        $this->_trigger_parent_reaggregation();
    }

    /**
     * Save an evidence record (create or update as neccessary)
     *
     * Also, create any parent records if they do not exist.
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

    /**
     * Trigger reaggregation of any parent competencies
     *
     * @return  void
     */
    private function _trigger_parent_reaggregation() {

        // Check if this competency has a parent
        $competency = get_record('comp', 'id', $this->competencyid);

        if (!$competency->parentid) {
            return;
        }

        $pevidence = new competency_evidence(
            array(
                'competencyid'  => $competency->parentid,
                'userid'        => $this->userid
            )
        );

        // Save parent's competency evidence. This will create the record
        // if it doesn't exist, and recursively call parent reaggregation
        $pevidence->trigger_reaggregation();
    }
}

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
 * @package Totara
 */
require_once($CFG->libdir.'/data_object.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/evidence/evidence.php');

/**
 * Competency evidence item evidence
 */
class competency_evidence_item_evidence extends data_object {

    /**
     * Database table
     * @var string
     */
    public $table = 'comp_evidence_items_evidence';

    /**
     * Database required fields
     * @var array
     */
    public $required_fields = array(
        'id', 'userid', 'competencyid', 'itemid', 'status', 'proficiencymeasured', 'timecreated', 'timemodified'
    );

    /**
     * Add this evidence to a competency
     *
     * @return  void
     */
    public function save() {
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

        // Create competency evidence record (if does not already exist)
        $data = array(
            'competencyid'      => $this->competencyid,
            'userid'            => $this->userid
        );

        $competency = new competency_evidence($data);
        $competency->trigger_reaggregation();
    }
}

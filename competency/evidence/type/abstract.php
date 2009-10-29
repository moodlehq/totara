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
 * An abstract object that holds methods and attributes common to all
 * competency evidence type objects
 * @abstract
 */
abstract class competency_evidence_type extends data_object {

    /**
     * Database table
     * @var string
     */
    public $table = 'competency_evidence_items';

    /**
     * Evidence item type, to be defined in child classes
     * @var string
     */
    public $itemtype;

    /**
     * Database required fields
     * @var array
     */
    public $required_fields = array(
        'id', 'competencyid', 'itemtype', 'itemmodule', 'iteminstance', 'timecreated', 'timemodified', 'usermodified'
    );

    /**
     * Add this evidence to a competency
     *
     * @param   $competency Competency object
     * @return  void
     */
    public function add($competency) {
        global $USER;

        $now = time();

        // Set up some stuff
        $this->competencyid = $competency->id;
        $this->timecreated = $now;
        $this->timemodified = $now;
        $this->usermodified = $USER->id;

        // Insert into database
        if (!parent::insert()) {
            error('Could not insert new evidence item');
        }

        // Update evidence count
        // Get latest count
        $count = get_field('competency_evidence_items', 'COUNT(*)', 'competencyid', $competency->id);
        $competency->evidencecount = (int) $count;

        if (!update_record('competency', $competency)) {
            error('Could not update competency evidence count');
        }
    }

    /**
     * Return evidence name and link
     * Defined by child classes
     *
     * @return  string
     */
    abstract public function get_name();

    /**
     * Get human readable type name
     * 
     * @return  string
     */
    public function get_activity_type() {
        return $this->itemmodule;
    }

    /**
     * Return evidence item type and link
     * Defined by child classes
     *
     * @return  string
     */
    abstract public function get_type();

    /**
     * Get human readable type name
     * 
     * @return  string
     */
    public function get_type_name() {
        return get_string('evidence'.$this->itemtype, 'competency');
    }

    /**
     * Create and return new class appropriate to evidence type
     *
     * @param   $data   object|int  Database record or record pkey
     * @return  object  comptency_evidence_type_*
     */
    public static function factory($data) {
        global $CFG;

        // If supplied an ID, load record
        if (is_numeric($data)) {
            $data = get_record('competency_evidence_items', 'id', $data);
        }

        // Load class file
        require_once($CFG->dirroot.'/competency/evidence/type/'.$data->itemtype.'.php');
        $class = 'competency_evidence_type_'.$data->itemtype;

        // Create new and return
        return new $class($data, false);
    }   
}

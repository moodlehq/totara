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

/**
 * Competency evidence type constants
 * Primarily for storing evidence type in the database
 */
define('COMPETENCY_EVIDENCE_TYPE_ACTIVITY_COMPLETION',  'activitycompletion');
define('COMPETENCY_EVIDENCE_TYPE_COURSE_COMPLETION',    'coursecompletion');
define('COMPETENCY_EVIDENCE_TYPE_COURSE_GRADE',         'coursegrade');

/**
 * Competency evidence type constant to class name mapping
 */
global $COMPETENCY_EVIDENCE_TYPES;
$COMPETENCY_EVIDENCE_TYPES = array(
    COMPETENCY_EVIDENCE_TYPE_ACTIVITY_COMPLETION    => 'activitycompletion',
    COMPETENCY_EVIDENCE_TYPE_COURSE_COMPLETION      => 'coursecompletion',
    COMPETENCY_EVIDENCE_TYPE_COURSE_GRADE           => 'coursegrade',
);

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
    public $table = 'comp_evidence_items';

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
     * Create and return new class appropriate to evidence type
     *
     * @param   $data   object|int  Database record or record pkey
     * @return  object  comptency_evidence_type_*
     */
    public static function factory($data) {
        global $CFG, $COMPETENCY_EVIDENCE_TYPES;

        // If supplied an ID, load record
        if (is_numeric($data)) {
            $data = get_record('comp_evidence_items', 'id', $data);
        }

        // Check this competency evidence type is installed
        if (!isset($data->itemtype) || !isset($COMPETENCY_EVIDENCE_TYPES[$data->itemtype])) {
            error('invalidevidencetype', 'competency');
        }

        // Load class file
        require_once($CFG->dirroot.'/hierarchy/type/competency/evidenceitem/type/'.$data->itemtype.'.php');
        $class = 'competency_evidence_type_'.$data->itemtype;

        // Create new and return
        return new $class($data, false);
    }

    /**
     * Add this evidence to a competency
     *
     * @param   $competency Competency object
     * @return  mixed The ID of the newly created evidence record, or false if the record is a duplicate
     */
    public function add($competency) {
        global $USER;

        // Don't allow duplicate evidence items
        $wherestr = "competencyid={$competency->id}";
        $wherestr .= " and itemtype='" . ( isset($this->itemtype) ? $this->itemtype : '' ) . "'";
        $wherestr .= " and itemmodule='" . ( isset($this->itemmodule) ? $this->itemmodule : '' ) . "'";
        $wherestr .= " and iteminstance={$this->iteminstance}";
        if ( count_records_select('comp_evidence_items',$wherestr) ){
            return false;
        }

        $now = time();

        // Set up some stuff
        $this->competencyid = $competency->id;
        $this->timecreated = $now;
        $this->timemodified = $now;
        $this->usermodified = $USER->id;

        // Insert into database
        $newid = parent::insert();
        if (!$newid) {
            error('Could not insert new evidence item');
        }

        // Update evidence count
        // Get latest count
        $count = get_field('comp_evidence_items', 'COUNT(*)', 'competencyid', $competency->id);
        $competency->evidencecount = (int) $count;

        if (!update_record('comp', $competency)) {
            error('Could not update competency evidence count');
        }
        return $newid;
    }

    /**
     * Delete this evidence item from a competency
     *
     * @param   $competency Competency object
     * @return  void
     */
    public function delete($competency) {

        // Delete evidence item from database
        if (!parent::delete()) {
            error('Could not delete evidence item');
        }

        // Delete any evidence items evidence
        delete_records('comp_evidence_items_evidence', 'itemid', $this->id);

        // Update evidence count
        // Get latest count
        $count = get_field('comp_evidence_items', 'COUNT(*)', 'competencyid', $competency->id);
        $competency->evidencecount = (int) $count;

        if (!update_record('comp', $competency)) {
            error('Could not update competency evidence count');
        }
    }

    /**
     * Get human readable type name
     *
     * @return  string
     */
    public function get_type_name() {
        return get_string('evidence'.$this->itemtype, 'competency');
    }

    /**
     * Get human activity type
     *
     * @return  string
     */
    public function get_activity_type() {
        return $this->itemmodule;
    }

    /**
     * Return evidence name and link
     * Defined by child classes
     *
     * @return  string
     */
    abstract public function get_name();

    /**
     * Return evidence item type and link
     * Defined by child classes
     *
     * @return  string
     */
    abstract public function get_type();
}

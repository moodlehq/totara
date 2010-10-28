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

require_once($CFG->libdir.'/data_object.php');


/**
 * An abstract object that holds methods and attributes common to all grade_* objects defined here.
 * @abstract
 */
abstract class grade_object extends data_object {
    /**
     * Array of required table fields, must start with 'id'.
     * @var array $required_fields
     */
    var $required_fields = array('id', 'timecreated', 'timemodified');

    /**
     * The first time this grade_object was created.
     * @var int $timecreated
     */
    var $timecreated;

    /**
     * The last time this grade_object was modified.
     * @var int $timemodified
     */
    var $timemodified;

    /**
     * Updates this object in the Database, based on its object variables. ID must be set.
     * @param string $source from where was the object updated (mod/forum, manual, etc.)
     * @return boolean success
     */
    function update($source=null) {
        global $USER, $CFG;

        if (empty($this->id)) {
            debugging('Can not update grade object, no id!');
            return false;
        }

        $data = $this->get_record_data();

        if (!update_record($this->table, addslashes_recursive($data))) {
            return false;
        }

        if (empty($CFG->disablegradehistory)) {
            unset($data->timecreated);
            $data->action       = GRADE_HISTORY_UPDATE;
            $data->oldid        = $this->id;
            $data->source       = $source;
            $data->timemodified = time();
            $data->loggeduser   = $USER->id;
            insert_record($this->table.'_history', addslashes_recursive($data));
        }

        $this->notify_changed(false);
        return true;
    }

    /**
     * Deletes this object from the database.
     * @param string $source from where was the object deleted (mod/forum, manual, etc.)
     * @return boolean success
     */
    function delete($source=null) {
        global $USER, $CFG;

        if (empty($this->id)) {
            debugging('Can not delete grade object, no id!');
            return false;
        }

        $data = $this->get_record_data();

        if (delete_records($this->table, 'id', $this->id)) {
            if (empty($CFG->disablegradehistory)) {
                unset($data->id);
                unset($data->timecreated);
                $data->action       = GRADE_HISTORY_DELETE;
                $data->oldid        = $this->id;
                $data->source       = $source;
                $data->timemodified = time();
                $data->loggeduser   = $USER->id;
                insert_record($this->table.'_history', addslashes_recursive($data));
            }
            $this->notify_changed(true);
            return true;

        } else {
            return false;
        }
    }

    /**
     * Records this object in the Database, sets its id to the returned value, and returns that value.
     * If successful this function also fetches the new object data from database and stores it
     * in object properties.
     * @param string $source from where was the object inserted (mod/forum, manual, etc.)
     * @return int PK ID if successful, false otherwise
     */
    function insert($source=null) {
        global $USER, $CFG;

        if (!empty($this->id)) {
            debugging("Grade object already exists!");
            return false;
        }

        $data = $this->get_record_data();

        if (!$this->id = insert_record($this->table, addslashes_recursive($data))) {
            debugging("Could not insert object into db");
            return false;
        }

        // set all object properties from real db data
        $this->update_from_db();

        $data = $this->get_record_data();

        if (empty($CFG->disablegradehistory)) {
            unset($data->timecreated);
            $data->action       = GRADE_HISTORY_INSERT;
            $data->oldid        = $this->id;
            $data->source       = $source;
            $data->timemodified = time();
            $data->loggeduser   = $USER->id;
            insert_record($this->table.'_history', addslashes_recursive($data));
        }

        $this->notify_changed(false);
        return $this->id;
    }
}
?>

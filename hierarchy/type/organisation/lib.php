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
 * organisations/lib.php
 *
 * Library to construct organisation hierarchies
 * @copyright Catalyst IT Limited
 * @author Jonathan Newman
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package MITMS
 */
require_once($CFG->dirroot.'/hierarchy/lib.php');

/**
 * Oject that holds methods and attributes for organisation operations.
 * @abstract
 */
class organisation extends hierarchy {

    /**
     * The base table prefix for the class
     */
    var $prefix = 'organisation';
    var $shortprefix = 'org';
    var $extrafield = null;

    /**
     * Delete an organisation and everything to do with it.
     *
     * @param int $id
     * @param boolean $usetransaction
     * @return boolean
     */
    function delete_framework_item($id, $usetransaction = true) {
        global $CFG;
        global $USER;

        if ( $usetransaction ){
            begin_sql();
        }

        // First call the deleter for the parent class
        if ( parent::delete_framework_item($id, false) ){
            $result = true;

            $result = $result && execute_sql(
                    'update '.$CFG->prefix . hierarchy::get_short_prefix('competency') . '_evidence'
                        . ' set organisationid = NULL'
                        . ' where organisationid = ' . $id
                    ,false
            );
            $result = $result && execute_sql(
                    'update '.$CFG->prefix . 'course_completions'
                        . ' set organisationid = NULL'
                        . ' where organisationid = ' . $id
                    ,false
            );
            $result = $result && execute_sql(
                    'update '.$CFG->prefix . hierarchy::get_short_prefix('position').'_assignment'
                        . ' set organisationid = NULL'
                        . ' where organisationid = ' . $id
                    ,false
            );
            $result = $result && execute_sql(
                    'update '.$CFG->prefix . hierarchy::get_short_prefix('position').'_assignment_history'
                        . ' set organisationid = NULL'
                        . ' where organisationid = ' . $id
                    ,false
            );
            if ( $result ){
                if ( $usetransaction ){
                    commit_sql();
                }
                return true;
            } else {
                if ( $usetransaction ){
                    rollback_sql();
                }
                return false;
            }
        } else {
            if ($usetransaction){
                rollback_sql();
            }
            return false;
        }
    }
}

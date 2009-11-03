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
 * competency/lib.php
 *
 * Library to construct competency hierarchies
 * @copyright Catalyst IT Limited
 * @author Jonathan Newman
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package MITMS
 */
require_once($CFG->libdir.'/hierarchylib.php');

/**
 * Competency aggregation methods
 *
 * These are mapped to lang strings in the competency lang file
 * with the key as a suffix e.g. for ALL, 'aggregationmethod1'
 */
$COMP_AGGREGATION = array(
    'ALL'       => 1,
    'ANY'       => 2,
    'UNIT'      => 3,
    'FRACTION'  => 4,
    'SUM'       => 5,
    'AVERAGE'   => 6,
);

/**
 * Oject that holds methods and attributes for competency operations.
 * @abstract
 */
class competency extends hierarchy {

    /**
     * The base table prefix for the class
     */
    var $prefix = 'competency';

    /**
     * Get template
     * @param int Template id
     * @return object|false
     */
    function get_template($id) {
        return get_record($this->prefix.'_template', 'id', $id);
    }

    /**
     * Get templates
     * @return array|false
     */
    function get_templates() {
        return get_records($this->prefix.'_template', 'frameworkid', $this->frameworkid, 'fullname');
    }

    /**
     * Hide the competency template
     * @var int - the template id to hide
     * @return void
     */
    function hide_template($id) {
        $template = $this->get_template($id);
        if ($template) {
            $visible = 0;
            if (!set_field($this->prefix.'_template', 'visible', $visible, 'id', $template->id)) {
                notify('Could not update that '.$this->prefix.' template!');
            }
        }
    }

    /**
     * Show the competency template
     * @var int - the template id to show
     * @return void
     */
    function show_template($id) {
        $template = $this->get_template($id);
        if ($template) {
            $visible = 1;
            if (!set_field($this->prefix.'_template', 'visible', $visible, 'id', $template->id)) {
                notify('Could not update that '.$this->prefix.' template!');
            }
        }
    }

    /**
     * Delete template and associated data
     * @var int - the template id to delete
     * @return  void
     */
    function delete_template($id) {
        // Delete this item
        delete_records($this->prefix.'_template', 'id', $id);
    }

    /**
     * Get competencies assigned to a template
     * @param int $id Template id
     * @return array|false
     */
    function get_assigned_to_template($id) {
        global $CFG;

        return get_records_sql(
            "
            SELECT
                c.id AS id,
                d.fullname AS depth,
                c.fullname AS competency
            FROM
                {$CFG->prefix}competency_template_assignment a
            LEFT JOIN
                {$CFG->prefix}competency_template t
             ON t.id = a.templateid
            LEFT JOIN
                {$CFG->prefix}competency c
             ON a.instanceid = c.id
            LEFT JOIN
                {$CFG->prefix}competency_depth d
             ON c.depthid = d.id
            WHERE
                t.id = {$id}
            "
        );
    }
}

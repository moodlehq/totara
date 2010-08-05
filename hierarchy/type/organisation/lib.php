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
 * @package Totara
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
     * Run any code before printing header
     * @param $page string Unique identifier for page
     * @return void
     */
    function hierarchy_page_setup($page = '') {
        global $CFG;

        if ($page !== 'item/view') {
            return;
        }

        // Setup custom javascript
        require_once($CFG->dirroot.'/local/js/lib/setup.php');

        // Setup lightbox
        local_js(array(
            MBE_JS_DIALOG,
            MBE_JS_TREEVIEW,
            MBE_JS_DATEPICKER
        ));

        require_js(array(
            $CFG->wwwroot.'/local/js/organisation.item.js.php',
        ));
    }

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

    /**
     * Print any extra markup to display on the hierarchy view item page
     * @param $item object Organisation being viewed
     * @return void
     */
    function display_extra_view_info($item) {
        global $CFG, $can_edit, $editingon;

        if ($editingon) {
            $str_edit = get_string('edit');
            $str_remove = get_string('remove');
        }

        // Display assigned competencies
        $items = $this->get_assigned_competencies($item);
        $addurl = $CFG->wwwroot.'/hierarchy/type/organisation/assigncompetency/find.php?assignto='.$item->id;
        $displaytitle = 'assignedcompetencies';
        $displaytype = 'competency';
        $displaydepth = true;
        require $CFG->dirroot.'/hierarchy/type/organisation/view-hierarchy-items.html';

        // Display assigned competencies
        $items = $this->get_assigned_competency_templates($item);
        $addurl = $CFG->wwwroot.'/hierarchy/type/organisation/assigncompetencytemplate/find.php?assignto='.$item->id;
        $displaytitle = 'assignedcompetencytemplates';
        $displaytype = 'competency';
        $displaydepth = false;
        require $CFG->dirroot.'/hierarchy/type/organisation/view-hierarchy-items.html';
    }

    function get_assigned_competencies($item) {
        global $CFG;

        if (is_object($item)) {
            $itemid = $item->id;
        } else if (is_numeric($item)) {
            $itemid = $item;
        } else {
            $itemid = 0;
        }

        return get_records_sql(
            "
                SELECT
                    c.*,
                    cf.id AS fid,
                    cf.fullname AS framework,
                    cd.fullname AS depth,
                    oc.id AS aid
                FROM
                    {$CFG->prefix}org_competencies oc
                INNER JOIN
                    {$CFG->prefix}comp c
                 ON oc.competencyid = c.id
                INNER JOIN
                    {$CFG->prefix}comp_framework cf
                 ON c.frameworkid = cf.id
                INNER JOIN
                    {$CFG->prefix}comp_depth cd
                 ON c.depthid = cd.id
                WHERE
                    oc.templateid IS NULL
                AND oc.organisationid = {$itemid}
            "
        );
    }

    function get_assigned_competency_templates($item) {
        global $CFG;

        if (is_object($item)) {
            $itemid = $item->id;
        } elseif (is_numeric($item)) {
            $itemid = $item;
        }

        return get_records_sql(
            "
                SELECT
                    c.*,
                    cf.id AS fid,
                    cf.fullname AS framework,
                    oc.id AS aid
                FROM
                    {$CFG->prefix}org_competencies oc
                INNER JOIN
                    {$CFG->prefix}comp_template c
                 ON oc.templateid = c.id
                INNER JOIN
                    {$CFG->prefix}comp_framework cf
                 ON c.frameworkid = cf.id
                WHERE
                    oc.competencyid IS NULL
                AND oc.organisationid = {$itemid}
            "
        );
    }
}

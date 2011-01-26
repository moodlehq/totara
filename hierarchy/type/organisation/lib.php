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
 * @package totara
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
    function hierarchy_page_setup($page = '', $item) {
        global $CFG;

        if ($page !== 'item/view') {
            return;
        }

        // Setup custom javascript
        require_once($CFG->dirroot.'/local/js/lib/setup.php');

        // Setup lightbox
        local_js(array(
            TOTARA_JS_DIALOG,
            TOTARA_JS_TREEVIEW,
            TOTARA_JS_DATEPICKER
        ));

        require_js(array(
            $CFG->wwwroot.'/local/js/organisation.item.js.php?id='.$item->id.'&frameworkid='.$item->frameworkid,
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

        $comptype = optional_param('comptype', 'competencies', PARAM_TEXT);
        if(!$fid = optional_param('framework', 0, PARAM_INT)){
            $fid = 0;
        }

        if ($editingon) {
            $str_edit = get_string('edit');
            $str_remove = get_string('remove');
        }

        print_heading(get_string('assignedcompetencies', 'competency'));

        echo $this->print_comp_framework_picker($item->id, $fid);

        if($comptype=='competencies') {
            // Display assigned competencies
            $items = $this->get_assigned_competencies($item, $fid);
            $addurl = $CFG->wwwroot.'/hierarchy/type/organisation/assigncompetency/find.php?assignto='.$item->id;
            $displaytitle = 'assignedcompetencies';
            $displaytype = 'competency';
            $displaydepth = true;
        } elseif($comptype == 'comptemplates') {
            // Display assigned competencies
            $items = $this->get_assigned_competency_templates($item, $fid);
            $addurl = $CFG->wwwroot.'/hierarchy/type/organisation/assigncompetencytemplate/find.php?assignto='.$item->id;
            $displaytitle = 'assignedcompetencytemplates';
            $displaydepth = false;
        }
        $displaytype = 'competency';
        require $CFG->dirroot.'/hierarchy/type/organisation/view-hierarchy-items.html';
    }

    function get_assigned_competencies($item, $frameworkid=0) {
        global $CFG;

        if (is_object($item)) {
            $itemid = $item->id;
        } else if (is_numeric($item)) {
            $itemid = $item;
        } else {
            $itemid = 0;
        }

        $sql = "SELECT
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
            ";
        if (!empty($frameworkid)) {
            $sql .= " AND c.frameworkid = {$frameworkid}";
        }

        return get_records_sql($sql);
    }

    function get_assigned_competency_templates($item, $frameworkid=0) {
        global $CFG;

        if (is_object($item)) {
            $itemid = $item->id;
        } elseif (is_numeric($item)) {
            $itemid = $item;
        }

        $sql = "SELECT
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
            ";

        if (!empty($frameworkid)) {
            $sql .= " AND c.frameworkid = {$frameworkid}";
        }

        return get_records_sql($sql);
    }

    function print_comp_framework_picker($organisationid, $currentfw) {
        global $CFG;

        $edit = optional_param('edit', 'off', PARAM_TEXT);

        $frameworks = get_records('comp_framework', '', '', 'sortorder');

        $assignedcounts = get_records_sql_menu("SELECT comp.frameworkid, COUNT(*)
            FROM {$CFG->prefix}org_competencies orgcomp
            INNER JOIN {$CFG->prefix}comp comp ON orgcomp.competencyid=comp.id
            WHERE orgcomp.organisationid={$organisationid} GROUP BY comp.frameworkid");

        ob_start();

        echo '<div class="frameworkpicker">';
        if (!empty($frameworks)) {
            $fwoptions = array();
            foreach ($frameworks as $fw) {
                $count = isset($assignedcounts[$fw->id]) ? $assignedcounts[$fw->id] : 0;
                $fwoptions[$fw->id] = $fw->fullname . " ({$count})";
            }
            $fwoptions = count($fwoptions) > 1 ? array(0 => get_string('all')) + $fwoptions : $fwoptions;
            echo '<div style="text-align: right">';
            popup_form($CFG->wwwroot.'/hierarchy/item/view.php?id='.$organisationid.'&amp;edit='.$edit.'&amp;type=organisation&amp;framework=', $fwoptions, 'switchframework', $currentfw, '', '', '', false, 'self', get_string('filterframework', 'hierarchy'));
            echo '</div>';
        } else {
            echo get_string('noframeworks', 'competency');
        }
        echo '</div>';

        $out = ob_get_contents();
        ob_end_clean();

        return $out;
   }

}

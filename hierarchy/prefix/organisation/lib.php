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
require_once($CFG->dirroot.'/local/utils.php');

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
    protected $extrafields = null;

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
     * Delete all data associated with the organisations
     *
     * This method is protected because it deletes the organisations, but doesn't update the
     * sortorder of the other framework items (or use transactions).
     * Use {@link hierarchy::delete_framework_item()} to recursively delete an item and
     * all its children
     *
     * @param array $items Array of IDs to be deleted
     *
     * @return boolean True if items and associated data were successfully deleted
     */
    protected function _delete_framework_items($items) {
        global $CFG;

        // First call the deleter for the parent class
        if (!parent::_delete_framework_items($items)) {
            return false;
        }

        // nullify all references to these organisations in comp_evidence table
        $sql = 'UPDATE ' . $CFG->prefix . hierarchy::get_short_prefix('competency') .
            "_evidence
            SET organisationid = NULL
            WHERE organisationid IN (" . implode(',', $items) . ')';
        if (!execute_sql($sql, false)) {
            return false;
        }

        // nullify all references to these organisations in course_completions table
        $sql = "UPDATE {$CFG->prefix}course_completions
            SET organisationid = NULL
            WHERE organisationid IN (" . implode(',', $items). ')';
        if (!execute_sql($sql, false)) {
            return false;
        }

        // nullify all references to these organisations in pos_assignment table
        $sql = "UPDATE " . $CFG->prefix . hierarchy::get_short_prefix('position') .
            "_assignment
            SET organisationid = NULL
            WHERE organisationid IN (" . implode(',', $items). ')';
        if (!execute_sql($sql, false)) {
            return false;
        }

        // nullify all references to these organisations in pos_assignment_history table
        $sql = "UPDATE " . $CFG->prefix . hierarchy::get_short_prefix('position') .
            "_assignment_history
            SET organisationid = NULL
            WHERE organisationid IN (" . implode(',', $items). ')';
        if (!execute_sql($sql, false)) {
            return false;
        }

        return true;
    }


    /**
     * Print any extra markup to display on the hierarchy view item page
     * @param $item object Organisation being viewed
     * @return void
     */
    function display_extra_view_info($item, $frameworkid=0) {
        global $CFG;

        $sitecontext = get_context_instance(CONTEXT_SYSTEM);
        $can_edit = has_capability('moodle/local:updateorganisation', $sitecontext);
        $comptype = optional_param('comptype', 'competencies', PARAM_TEXT);

        if ($can_edit) {
            $str_edit = get_string('edit');
            $str_remove = get_string('remove');
        }

        echo '<div class="list-assignedcompetencies">';
        print_heading(get_string('assignedcompetencies', 'competency'));
        echo $this->print_comp_framework_picker($item->id, $frameworkid);

        if($comptype=='competencies') {
            // Display assigned competencies
            $items = $this->get_assigned_competencies($item, $frameworkid);
            $addurl = $CFG->wwwroot.'/hierarchy/prefix/organisation/assigncompetency/find.php?assignto='.$item->id;
            $displaytitle = 'assignedcompetencies';
            $displayprefix = 'competency';
            $displayclass = true;
        } elseif($comptype == 'comptemplates') {
            // Display assigned competencies
            $items = $this->get_assigned_competency_templates($item, $frameworkid);
            $addurl = $CFG->wwwroot.'/hierarchy/prefix/organisation/assigncompetencytemplate/find.php?assignto='.$item->id;
            $displaytitle = 'assignedcompetencytemplates';
            $displayclass = false;
        }
        $displayprefix = 'competency';
        require $CFG->dirroot.'/hierarchy/prefix/organisation/view-hierarchy-items.html';
        echo '</div>';
    }

    /**
     * Returns an array of assigned competencies that are assigned to the organisation
     * @param $item object|int Organisation being viewed
     * @param $frameworkid int If set only return competencies for this framework
     * @param $excluded_ids array an optional set of ids of competencies to exclude
     * @return array List of assigned competencies
     */
    function get_assigned_competencies($item, $frameworkid=0, $excluded_ids=false) {
        global $CFG;
        if (is_object($item)) {
            $itemid = $item->id;
        } else if (is_numeric($item)) {
            $itemid = $item;
        } else {
            return false;
        }
        $sql = "SELECT
                    c.*,
                    cf.id AS fid,
                    cf.fullname AS framework,
                    ct.fullname AS type,
                    oc.id AS aid,
                    oc.linktype as linktype
                FROM
                    {$CFG->prefix}org_competencies oc
                INNER JOIN
                    {$CFG->prefix}comp c
                 ON oc.competencyid = c.id
                INNER JOIN
                    {$CFG->prefix}comp_framework cf
                 ON c.frameworkid = cf.id
                LEFT JOIN
                    {$CFG->prefix}comp_type ct
                 ON c.typeid = ct.id
                WHERE
                    oc.templateid IS NULL
                AND oc.organisationid = {$itemid}
            ";
        if (!empty($frameworkid)) {
            $sql .= " AND c.frameworkid = {$frameworkid}";
        }
        if (is_array($excluded_ids) && !empty($excluded_ids)) {
            $ids = implode(',', $excluded_ids);
            $sql .= " AND c.id NOT IN({$ids})";
        }

        $sql .= " ORDER BY c.fullname";

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
            popup_form($CFG->wwwroot.'/hierarchy/item/view.php?id='.$organisationid.'&amp;edit='.$edit.'&amp;prefix=organisation&amp;framework=', $fwoptions, 'switchframework', $currentfw, '', '', '', false, 'self', get_string('filterframework', 'hierarchy'));
            echo '</div>';
        } else {
            echo get_string('noframeworks', 'competency');
        }
        echo '</div>';

        $out = ob_get_contents();
        ob_end_clean();

        return $out;
   }


    /**
     * Returns various stats about an item, used for listed what will be deleted
     *
     * @param integer $id ID of the item to get stats for
     * @return array Associative array containing stats
     */
    public function get_item_stats($id) {
        if (!$data = parent::get_item_stats($id)) {
            return false;
        }

        // should always include at least one item (itself)
        if(!$children = $this->get_item_descendants($id)) {
            return false;
        }

        $ids = array_keys($children);

        // number of organisation assignment records
        $data['org_assignment'] = count_records_select('pos_assignment',
            sql_sequence('organisationid', $ids));

        // number of assigned competencies
        $data['assigned_comps'] = count_records_select('org_competencies',
            sql_sequence('organisationid', $ids));

        return $data;
    }


    /**
     * Given some stats about an item, return a formatted delete message
     *
     * @param array $stats Associative array of item stats
     * @return string Formatted delete message
     */
    public function output_delete_message($stats) {
        $message = parent::output_delete_message($stats);

        if ($stats['org_assignment'] > 0) {
            $message .= get_string('deleteincludexposassignments', 'organisation', $stats['org_assignment']) . '<br />';
        }

        if ($stats['assigned_comps'] > 0) {
            $message .= get_string('deleteincludexlinkedcompetencies', 'organisation', $stats['assigned_comps']). '<br />';
        }

        return $message;
    }

}

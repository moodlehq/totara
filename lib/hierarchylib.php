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
 * hierarchylib.php
 *
 * Library to construct hierarchies such as competencies, positions, etc
 * @copyright Catalyst IT Limited
 * @author Jonathan Newman 
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package MITMS
 */

/**
 * An abstract object that holds methods and attributes common to all hierarchy objects.
 * @abstract
 */
class hierarchy {

    /** 
     * The base table prefix for the hierarchy
     * @var int $timecreated
     */
    var $prefix;
    var $frameworkid;

    /**
     * Get framework
     * @return boolean success
     */
    function get_framework($id=0) {
        // If no framework id supplied, use default
        if ($id == 0) {
            if (!$framework = get_record($this->prefix.'_framework', 'isdefault', 1)) {
                error('Default competency framework does not exist');
            }
        } else {
            if (!$framework = get_record($this->prefix.'_framework', 'id', $id)) {
                error('Competency framework does not exist');
            }
        }
        $this->frameworkid = $framework->id; // specify the frameworki d
        return $framework;
    }

    /**
     * Get framework
     * @return boolean success
     */
    function get_frameworks() {
        return get_records('competency_framework', 'visible', 1); 
    }

    /**
     * Get depths for a framework
     * @return boolean success
     */
    function get_depths() {
        return get_records($this->prefix.'_depth', 'frameworkid', $this->frameworkid, 'id');
    }

    /**
     * Get depths for a framework
     * @return boolean success
     */
    function get_items() {
        return get_records($this->prefix, 'frameworkid', $this->frameworkid, 'sortorder');
    }

    /**
    * Get editing button
    * @param signed int edit - is editing on or off?
    * @return button or ''
    */
    function get_editing_button($edit=-1){
        global $USER;
        if ($edit !== -1) {
            $USER->{$this->prefix.'editing'} = $edit;
        }
        // Work out the appropriate action.
        if (empty($USER->{$this->prefix.'editing'})) {
            $label = get_string('turneditingon');
            $edit = 'on';
        } else {
            $label = get_string('turneditingoff');
            $edit = 'off';
        }

        // Generate the button HTML.
        $options = array('frameworkid' => $this->frameworkid, 'edit' => $edit);
        return print_single_button($_SERVER['PHP_SELF'], $options, $label, 'get', '', true);
    }

    /**
     * Display pulldown menu of frameworks
     * @return boolean success
     */
    function display_framework_selector() {
        global $CFG;

        $frameworks = $this->get_frameworks();

        if (count($frameworks) > 1) {
            $fwoptions = array();

            foreach ($frameworks as $fw) {
                $fwoptions[$fw->id] = $fw->fullname;
            }   

            echo '<div class="frameworkpicker">';
            popup_form($CFG->wwwroot.'/competencies/index.php?frameworkid=', $fwoptions, 'switchframework', $this->frameworkid, '');
            echo '</div>';
        }   
    }
    
    /**
     * Display add item button
     * @return boolean success
     */
    function display_add_item_button($spage=0) {
        global $CFG;
        $options = array('frameworkid' => $this->frameworkid, 'spage' => $spage);
        print_single_button($CFG->wwwroot.'/competencies/edit.php', $options, get_string('addnewcompetency', 'competencies'), 'get');
    }

    /**
     * Display add depth button
     * @return boolean success
     */
    function display_add_depth_button($spage=0) {
        global $CFG;
        $options = array('frameworkid' => $this->frameworkid, 'spage' => $spage);
        print_single_button($CFG->wwwroot.'/competencies/depth/edit.php', $options, get_string('adddepthlevel', 'competencies'), 'get');
    }

    /**
     * Ensure the framework sortorder has no gaps and isn't at 0
     * @return boolean success
     */
    function validate_sortorder() {
        return true;
    }

    /**
     * Get the sortorder range for the framework
     * @return boolean success
     */
    function get_sortorder_offset() {
        global $CFG;
        $max = get_record_sql('SELECT MAX(sortorder) AS max, 1
                FROM ' . $CFG->prefix . $this->prefix .' WHERE frameworkid=' . $this->frameworkid);
        return $max->max + 1000;
    }

    /**
     * Get the hierarchy item
     * @var int $id the id to move
     * @return boolean success
     */
    function get_item($id) {
        return get_record($this->prefix, 'id', $id);
    }

    /**
     * Move the item in the sortorder
     * @var int - the item id to move
     * @var boolean $up - up if true, down if false
     * @return boolean success
     */
    function move_item($id, $up) {
        $move = NULL;
        $swap = NULL;
        $this->validate_sortorder();
        $sortoffset = $this->get_sortorder_offset();
        $move = get_record($this->prefix, 'id', $id);
        if ($up) {
            $swap = get_record($this->prefix, 'frameworkid',  $this->frameworkid, 'sortorder', $move->sortorder - 1); 
        } else {
            $swap = get_record($this->prefix, 'frameworkid',  $this->frameworkid, 'sortorder', $move->sortorder + 1); 
        }
        if ($move && $swap) {
            begin_sql();
            if (!(    set_field($this->prefix, 'sortorder', $sortoffset, 'id', $swap->id)
                   && set_field($this->prefix, 'sortorder', $swap->sortorder, 'id', $move->id)
                   && set_field($this->prefix, 'sortorder', $move->sortorder, 'id', $swap->id)
                )) {
                notify('Could not update that '.$this->prefix.'!');
            }   
            commit_sql();
        }
    }

    /**
     * Hide the hierarchy item
     * @var int - the item id to hide
     * @return void
     */
    function hide_item($id) {
        $item = $this->get_item($id);
        if ($item) {
            $visible = 0;
            if (!set_field($this->prefix, 'visible', $visible, 'id', $item->id)) {
                notify('Could not update that '.$this->prefix.'!');
            }   
        }
    }

    /**
     * Show the hierarchy item
     * @var int - the item id to show
     * @return void
     */
    function show_item($id) {
        $item = $this->get_item($id);
        if ($item) {
            $visible = 1;
            if (!set_field($this->prefix, 'visible', $visible, 'id', $item->id)) {
                notify('Could not update that '.$this->prefix.'!');
            }   
        }
    }

    /**
     * Recursively called function for deleting items and their children
     * @var int - the item id to delete
     * @return  void
     */
    function delete_framework_item($id) {

        // Delete all child items
        $children = get_records($this->prefix, 'parentid', $id);

        if ($children) {
            // Call this function recursively
            foreach ($children as $child) {
                $this->delete_framework_item($child);
            }   
        }   

        // Finally delete this item
        delete_records($this->prefix, 'id', $id);
    }

    /**
     * Delete a framework and its contents
     * @return  void
     */
    function delete_framework() {

        // Get all competencies in the framework
        $competencies = $this->get_competencies();

        foreach ($competencies as $competency) {
            // Delete all info data for a competency
            delete_records($this->prefix.'_depth_info_data', 'competencyid', $competency->id);
        }

        // Get all depths in the framework
        $depths = $this->get_depths();

        foreach ($depths as $depth) {

            // Delete all info fields in a depth
            delete_records($this->prefix.'_depth_info_field', 'depthid', $depth->id);

            // Delete all info categories in a depth
            delete_records($this->prefix.'_depth_info_category', 'depthid', $depth->id);
        }

        // Delete all depths in the framework
        delete_records($this->prefix.'_depth', 'frameworkid', $this->frameworkid);

        // Delete all competencies in the framework
        delete_records($this->prefix, 'frameworkid', $this->frameworkid);

        // Finally delete this framework
        delete_records($this->prefix.'_framework', 'id', $this->frameworkid);
    }

}

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
 * hierarchy/lib.php
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
     * The base prefix for the hierarchy
     * @var string
     */
    var $prefix;

    /**
     * Shortened version of the base prefix for table names. In order to meet the
     * Oracle 30-character limit, this should be no more than 4 characters.
     * @var string
     */
    var $shortprefix;

    const PREFIX = '';
    const SHORT_PREFIX = '';

    /**
     * The current framework id
     * @var int
     */
    var $frameworkid;

    /**
     * Get framework
     *
     * @param $noframeworkok boolean (optional) No framework is ok
     * @return boolean success
     */
    function get_framework($id = 0, $noframeworkok = false) {
        // If no framework id supplied, use first in sortorder
        if ($id == 0) {
                // Get frameworks
                $frameworks = get_records_select($this->shortprefix.'_framework', '1 = 1 ORDER BY sortorder ASC');

                if (!$frameworks) {
                    if ($noframeworkok) {
                        return false;
                    }
                    else {
                        error('No '.$this->prefix.' frameworks exist');
                    }
                }

                // Get first
                $framework = array_shift($frameworks);

        } else {
            if (!$framework = get_record($this->shortprefix.'_framework', 'id', $id)) {
                error('The '.$this->prefix.' framework does not exist');
            }
        }
        $this->frameworkid = $framework->id; // specify the framework id
        return $framework;
    }

    /**
     * Get depth by id
     * @return object|false
     */
    function get_depth_by_id($id) {
        return get_record($this->shortprefix.'_depth', 'id', $id);
    }

    /**
     * Get framework
     * @var array $extra_data optional - specifying extra info to be fetched and returned
     * @return array|false
     * @uses $CFG when extra_data specified 
     */
    function get_frameworks($extra_data=array()) {
        if (!count($extra_data)) {
            return get_records($this->shortprefix.'_framework', '', '', 'sortorder, fullname');
        }

        global $CFG;

        $sql = "SELECT f.* ";
        if (isset($extra_data['depth_count'])) {
            $sql .= ",(SELECT COALESCE(MAX(depthlevel), 0) FROM {$CFG->prefix}{$this->shortprefix}_depth d1 
                        WHERE d1.frameworkid = f.id) AS depth_count "; 
        }
        if (isset($extra_data['custom_field_count'])) {
            $sql .= ",(SELECT COUNT(*) FROM {$CFG->prefix}{$this->shortprefix}_depth d2 
                        JOIN {$CFG->prefix}{$this->shortprefix}_depth_info_field if ON d2.id = if.depthid 
                        WHERE d2.frameworkid=f.id) AS custom_field_count ";
        }
        if (isset($extra_data['item_count'])) {
            $sql .= ",(SELECT COUNT(*) FROM {$CFG->prefix}{$this->shortprefix} ic
                        WHERE ic.frameworkid=f.id) AS item_count ";
        }
        $sql .= "FROM {$CFG->prefix}{$this->shortprefix}_framework f 
                 ORDER BY f.fullname";

        return get_records_sql($sql);

    }

    /**
     * Get depths for a framework
     * @var array $extra_data optional - specifying extra info to be fetched and returned
     * @return array|false
     * @uses $CFG when extra_data specified 
     */
    function get_depths($extra_data=array()) {
        if (!count($extra_data)) {
           return get_records($this->shortprefix.'_depth', 'frameworkid', $this->frameworkid, 'depthlevel');
        }

        global $CFG;

        $sql = "SELECT d.* ";
        if (isset($extra_data['custom_field_count'])) {
            $sql .= ", (SELECT COUNT(*) FROM {$CFG->prefix}{$this->shortprefix}_depth_info_field if
                        WHERE if.depthid = d.id) AS custom_field_count ";
        }
        if (isset($extra_data['item_count'])) {
            $sql .= ", (SELECT COUNT(*) FROM {$CFG->prefix}{$this->shortprefix} ic
                 WHERE ic.depthid = d.id) AS item_count";
        }
        $sql .= " FROM {$CFG->prefix}{$this->shortprefix}_depth d
                  WHERE d.frameworkid = {$this->frameworkid}
                  ORDER BY d.depthlevel";
        return get_records_sql($sql);
    }

    function get_custom_field_categories($depthid) {
        global $CFG;

        $sql = "SELECT c.*,
                (SELECT COUNT(*) FROM {$CFG->prefix}{$this->shortprefix}_depth_info_field f 
                    WHERE f.categoryid = c.id) AS custom_field_count
                FROM {$CFG->prefix}{$this->shortprefix}_depth_info_category c 
                WHERE c.depthid = {$depthid}
                ORDER BY c.name";

        return get_records_sql($sql);
    }

    function get_custom_field_category_by_id($id) {
        return get_record($this->shortprefix.'_depth_info_category', 'id', $id);
    }

    /**
     * Get the hierarchy item
     * @var int $id the id to move
     * @return object|false
     */
    function get_item($id) {
        return get_record($this->shortprefix, 'id', $id);
    }

    /**
     * Get items in a framework
     * @return array|false
     */
    function get_items() {
        return get_records($this->shortprefix, 'frameworkid', $this->frameworkid, 'sortorder, fullname');
    }

    /**
     * Get items in a framework by parent
     * @param int $parentid
     * @return array|false
     */
    function get_items_by_parent($parentid=false) {
        if ($parentid) {
            // Parentid supplied, do not specify frameworkid as
            // sometimes it is not set correctly. And a parentid
            // is enough to get the right results
            return get_records_select($this->shortprefix, "parentid = {$parentid}", 'frameworkid, sortorder, fullname');
        }
        else {
            // If no parentid, grab the root node of this framework
            return $this->get_all_root_items();
        }
    }

    /*
     * Returns all items at the root level (parentid=0) for the current framework (obtained
     * from $this->frameworkid)
     * If no framework is specified, returns root items across all frameworks
     * This behaviour can also be forced by setting $all = true
     *
     * @param int $fwid Framework ID or null for all frameworks
     * @param boolean $all If true return root items for all frameworks even if $this->frameworkid is set
     * @return array|false
     */
    function get_all_root_items($all=false) {
        if(empty($this->frameworkid) || $all) {
            // all root level items across frameworks
            return get_records($this->shortprefix, 'parentid', 0, 'frameworkid, sortorder, fullname');
        } else {
            // root level items for current framework only
            $fwid = $this->frameworkid;
            return get_records_select($this->shortprefix, "parentid = 0 AND frameworkid = $fwid", 'sortorder, fullname');
        }
    }

    /**
     * Get descendants of an item
     * @param int $id
     * @return array|false
     */
    function get_item_descendants($id) {
        global $CFG;
        $path = get_field($this->shortprefix, 'path', 'id', $id);
        if ($path) {
            $paths = explode('/', substr($path, 1));
            $sql = "SELECT id, fullname, parentid, path, sortorder
                    FROM {$CFG->prefix}{$this->shortprefix}
                    WHERE path LIKE '{$path}%' ORDER BY path";
            return get_records_sql($sql);
        } else {
            error('No path found for '.$this->prefix.' id '.$id);
        }
    }

    /**
     * Given an item id, returns the adjacent item at the same depth level
     * @param object $item An item object to find the peer for. Must include id,
     *                     frameworkid, sortorder, parentid and depthid
     * @param boolean $above If true returns the item above, otherwise the item below
     * @return int|false Returns the ID of the peer or false if there isn't one
     *                   in the direction specified
     **/
    function get_item_adjacent_peer($item, $above=true) {
        global $CFG;
        // check that item has required properties
        if( !isset($item->depthid) ||
            !isset($item->sortorder) || !isset($item->id)) {
            return false;
        }
        // try and use item's fwid if not set by hierarchy
        if(isset($this->frameworkid)) {
            $frameworkid = $this->frameworkid;
        } else if (isset($item->frameworkid)) {
            $frameworkid = $item->frameworkid;
        } else {
            return false;
        }

        $depthid = $item->depthid;
        $sortorder = $item->sortorder;
        $parentid = $item->parentid;
        $id = $item->id;

        // are we looking above or below for a peer?
        $sqlop = $above ? '<' : '>';
        $sqlsort = $above ? 'DESC' : 'ASC';

        $sql = "SELECT id FROM {$CFG->prefix}{$this->shortprefix}
            WHERE frameworkid = $frameworkid AND
            depthid = $depthid AND
            parentid = $parentid AND
            sortorder $sqlop $sortorder
            ORDER BY sortorder $sqlsort";
        // only return first match
        $dest = get_record_sql($sql, true);
        if($dest) {
            return $dest->id;
        } else {
            // no peer in that direction
            return false;
        }
    }

    /**
     * Returns an object that can be used to
     * build a select form element based on the hierarchy
     *
     * Called recursively to get full hierarchy
     * @param array &$list Array used to build and return results. Passed by reference
     * @param integer $id ID of node to start from or null for all
     * @param boolean $showchildren If true select will include an additional option to
     *                          include item and all its children
     * @param boolean $shortname If true use shortname in select, otherwise fullname
     * @param string $path Current path for select, used recursively
     * @param array $records Records to be passed as function is recursively called. Generated the first
     *                       time it is called so no need to set this. Used to save db calls
     * @return Nothing returned, output obtained via reference to &$list
     */
    function make_hierarchy_list(&$list, $id = NULL, $showchildren=false, $shortname=false, $path = "", $records=null) {
        // initialize the array if needed
        if(!is_array($list)) {
            $list = array();
        }
        if(empty($id)) {
            // start at top level
            $id = 0;
        }

        if(empty($records)) {
            // must be first time through function, get the records, and pass to
            // future uses to save db calls
            $records = get_records($this->shortprefix,'','','path','id,fullname,shortname,parentid,sortorder,path');
        }

        if($id == 0) {
            $children = $this->get_all_root_items(true);
        } else {
            $item = $records[$id];
            $name = ($shortname) ? $item->shortname : $item->fullname ;
            if($path) {
                $path = $path.' / '.$name;
            } else {
                $path = $name;
            }
            // add item
            $list[$item->id] = $path;
            if($showchildren === true) {
                // if children wanted and there are some
                // show a second option with children
                // does the same as:
                //$descendants = $this->get_item_descendants($id);
                // but without the db calls
                $descendants = array();
                foreach($records as $key => $record) {
                    if(substr($record->path,0,strlen($item->path)) == $item->path) {
                    //print "{$record->path} child of {$item->path}<br>";
                        $descendants[$key] = $record;
                    }
                }
                if(count($descendants)>1) {
                    // add comma separated list of all children too
                    $idstr = implode(',',array_keys($descendants));
                    $list[$idstr] = $path." (and all children)";
                }
            }
            // does the same as:
            // $children = $this->get_items_by_parent($id);
            // but without the db calls
            $children = array();
            foreach($records as $key => $record) {
                if($record->parentid == $id) {
                    $children[$key] = $record;
                }
            }
        }

        // now deal with children of this item
        if($children) {
            foreach($children as $child) {
                $this->make_hierarchy_list($list, $child->id, $showchildren, $shortname, $path, $records);
            }
        }
    }
    /**
     * Get items in a lineage
     * @param int $id
     * @return array|false
     * NOTE: does not check that lineage items are in same framework
     *       as $id specified or as hierarchy object this method is called from
     */
    function get_item_lineage($id) {
        global $CFG;
        $path = get_field($this->shortprefix, 'path', 'id', $id);
        if ($path) {
            $paths = explode('/', substr($path, 1));
            $sql = "SELECT o.id, o.fullname, o.parentid, od.depthlevel
                    FROM {$CFG->prefix}{$this->shortprefix} o
                    JOIN {$CFG->prefix}{$this->shortprefix}_depth od
                      ON o.depthid=od.id
                    WHERE o.id IN (".implode(",", $paths).")";
            return get_records_sql($sql);
        } else {
            error('No path found for '.$this->prefix.' id '.$id);
        }
    }

    /**
    * Get editing button
    * @param signed int edit - is editing on or off?
    * @return button or ''
    */
    function get_editing_button($edit=-1, $options=array()){
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
        $options['edit'] = $edit;
        $options['type'] = $this->prefix;
        return print_single_button($_SERVER['PHP_SELF'], $options, $label, 'get', '', true);
    }

    /**
     * Display pulldown menu of frameworks
     * @param string $page Page to redirect to
     * @param boolean $simple optional Display simple selector
     * @return boolean success
     */
    function display_framework_selector($page = 'index.php', $simple = false) {
        global $CFG;

        $frameworks = $this->get_frameworks();

        if (count($frameworks) <= 1) {
            return;
        }

        if (!$simple) {

            $fwoptions = array();

            echo '<div class="frameworkpicker">';

            foreach ($frameworks as $fw) {
                $fwoptions[$fw->id] = $fw->fullname;
            }

            popup_form($CFG->wwwroot.'/hierarchy/'.$page.'?type='.$this->prefix.'&frameworkid=', $fwoptions, 'switchframework', $this->frameworkid, '', '', '', false, 'self', get_string('switchframework', 'hierarchy'));

            echo '</div>';

        }
        else {

            $options = array();
            foreach ($frameworks as $fw) {
                $options[$fw->id] = $fw->fullname;
            }

            echo display_dialog_selector($options, $this->frameworkid, 'simpleframeworkpicker');
        }
    }

    /**
     * Display add item button
     * @return boolean success
     */
    function display_add_item_button($spage=0) {
        global $CFG;
        $options = array('type' => $this->prefix, 'frameworkid' => $this->frameworkid, 'spage' => $spage);
        print_single_button($CFG->wwwroot.'/hierarchy/item/edit.php', $options, get_string('addnew'.$this->prefix, $this->prefix), 'get');
    }

    /**
     * Display add depth button
     * @return boolean success
     */
    function display_add_depth_button($spage=0) {
        global $CFG;
        $options = array('type' => $this->prefix, 'frameworkid' => $this->frameworkid, 'spage' => $spage);
        print_single_button($CFG->wwwroot.'/hierarchy/depth/edit.php', $options, get_string('adddepthlevel', $this->prefix), 'get');
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
    function get_item_sortorder_offset() {
        global $CFG;
        $max = get_record_sql('SELECT MAX(sortorder) AS max, 1
                FROM ' . $CFG->prefix . $this->shortprefix .' WHERE frameworkid=' . $this->frameworkid);
        return $max->max + 1000;
    }

    /**
     * Move the item and its subtree in the sortorder
     * @var int - the item id to move
     * @var boolean $up - up if true, down if false
     * @return boolean success
     */
    function move_item($id, $up) {
        $source = get_record($this->shortprefix, 'id', $id);
        // get nearest neighbour in direction of move
        $destid = $this->get_item_adjacent_peer($source, $up);
        if(!$destid) {
            // source not a valid record or no peer in that direction
            notify(get_string('error:couldnotmoveitemnopeer','hierarchy',$this->prefix));
            return false;
        }

        // how many members in each tree?
        $sourcetree = $this->get_item_descendants($source->id);
        $desttree = $this->get_item_descendants($destid);
        $sourcecount = count($sourcetree);
        $destcount = count($desttree);

        $status = true;
        begin_sql();

        // update the sort orders
        foreach($sourcetree as $item) {
            $id = $item->id;
            $sortorder = $item->sortorder;
            $newso = $up ? $sortorder - $destcount : $sortorder + $destcount;
            if($newso < 0) {
                // something must be wrong with sort orders, abort
                rollback_sql();
                notify(get_string('error:badsortorder','hierarchy',$this->prefix));
                return false;
            } else {
                $status = $status && set_field($this->shortprefix, 'sortorder', $newso, 'id', $id);
            }
        }
        foreach($desttree as $item) {
            $id = $item->id;
            $sortorder = $item->sortorder;
            $newso = $up ? $sortorder + $sourcecount : $sortorder - $sourcecount;
            if($newso < 0) {
                // something must be wrong with sort orders, abort
                rollback_sql();
                notify(get_string('error:badsortorder','hierarchy',$this->prefix));
                return false;
            } else {
                $status = $status && set_field($this->shortprefix, 'sortorder', $newso, 'id', $id);
            }
        }

        // only commit if all changes worked
        if($status) {
            commit_sql();
            return true;
        } else {
            rollback_sql();
            notify(get_string('error:couldnotmoveitem','hierarchy',$this->prefix));
            return false;
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
            if (!set_field($this->shortprefix, 'visible', $visible, 'id', $item->id)) {
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
            if (!set_field($this->shortprefix, 'visible', $visible, 'id', $item->id)) {
                notify('Could not update that '.$this->prefix.'!');
            }
        }
    }

    /**
     * Hide the hierarchy item
     * @var int - the item id to hide
     * @return void
     */
    function hide_framework($id) {
        $framework = $this->get_framework($id);
        if ($framework) {
            $visible = 0;
            if (!set_field($this->shortprefix.'_framework', 'visible', $visible, 'id', $framework->id)) {
                notify('Could not update that '.$this->prefix.' framework!');
            }
        }
    }

    /**
     * Show the hierarchy item
     * @var int - the item id to show
     * @return void
     */
    function show_framework($id) {
        $framework = $this->get_framework($id);
        if ($framework) {
            $visible = 1;
            if (!set_field($this->shortprefix.'_framework', 'visible', $visible, 'id', $framework->id)) {
                notify('Could not update that '.$this->prefix.' framework!');
            }
        }
    }

    /**
     * Get the sortorder range for the framework
     * @return boolean success
     */
    function get_framework_sortorder_offset() {
        global $CFG;
        $max = get_record_sql('SELECT MAX(sortorder) AS max, 1
                FROM ' . $CFG->prefix . $this->shortprefix .'_framework');
        return $max->max + 1000;
    }

    /**
     * Move the framework in the sortorder
     * @var int - the framework id to move
     * @var boolean $up - up if true, down if false
     * @return boolean success
     */
    function move_framework($id, $up) {
        global $CFG;
        $move = NULL;
        $swap = NULL;
        $this->validate_sortorder();
        $sortoffset = $this->get_framework_sortorder_offset();
        $move = get_record($this->shortprefix.'_framework', 'id', $id);
        if ($up) {
            $swap = get_record_sql(
                    "SELECT *
                    FROM {$CFG->prefix}{$this->shortprefix}_framework
                    WHERE sortorder < {$move->sortorder}
                    ORDER BY sortorder DESC", true
            );
        } else {
            $swap = get_record_sql(
                    "SELECT *
                    FROM {$CFG->prefix}{$this->shortprefix}_framework
                    WHERE sortorder > {$move->sortorder}
                    ORDER BY sortorder ASC", true
            );
        }
        begin_sql();
        if ($move && $swap) {
            if (!(    set_field($this->shortprefix.'_framework', 'sortorder', $sortoffset, 'id', $swap->id)
                   && set_field($this->shortprefix.'_framework', 'sortorder', $swap->sortorder, 'id', $move->id)
                   && set_field($this->shortprefix.'_framework', 'sortorder', $move->sortorder, 'id', $swap->id)
                )) {
                notify('Could not update that '.$this->prefix.' framework!');
            }
            commit_sql();
            return true;
        }
        rollback_sql();
        return false;
    }

    /**
     * Recursively called function for deleting items and their children
     * @var int $id the item id to delete
     * @var boolean $transaction whether or not to wrap the DB calls in a transaction
     * @return boolean success or failure
     */
    function delete_framework_item($id, $usetransaction = true) {

        if ( $usetransaction ){
            begin_sql();
        }

        // Delete all child items
        $children = get_records($this->shortprefix, 'parentid', $id);

        if ($children) {
            // Call this function recursively
            foreach ($children as $child) {
                if ( !$this->delete_framework_item($child->id, false) ){
                    if ( $usetransaction ){
                        rollback_sql();
                    }
                    return false;
                }
            }
        }

        // delete any custom field data for this item
        if(delete_records($this->shortprefix.'_depth_info_data', $this->prefix.'id', $id)) {
            // Finally delete this item
            if(delete_records($this->shortprefix, 'id', $id)) {
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
            if ( $usetransaction ){
                rollback_sql();
            }
            return false;
        }
    }

    /**
     * Delete a framework and its contents
     * @return  void
     */
    function delete_framework() {
        global $CFG;

        // Get all items in the framework
        $items = $this->get_items();

        if ($items) {
            foreach ($items as $item) {
                // Delete all info data for each framework item
                delete_records($this->shortprefix.'_depth_info_data', $this->prefix.'id', $item->id);
            }
        }

        // Get all depths in the framework
        $depths = $this->get_depths();

        if ($depths) {
            foreach ($depths as $depth) {
                $this->delete_depth_metadata($depth->id);
            }
        }

        // Delete all depths in the framework
        delete_records($this->shortprefix.'_depth', 'frameworkid', $this->frameworkid);

        // Delete all items in the framework
        delete_records($this->shortprefix, 'frameworkid', $this->frameworkid);

        // Finally delete this framework
        delete_records($this->shortprefix.'_framework', 'id', $this->frameworkid);

        // Rewrite the sort order to account for the missing framework
        $sortorder = 1;
        $records = get_records_sql("SELECT id FROM {$CFG->prefix}{$this->shortprefix}_framework ORDER BY sortorder ASC");
        if (is_array($records)) {
            foreach( $records as $rec ){
                set_field( "{$this->shortprefix}_framework", 'sortorder', $sortorder, 'id', $rec->id );
                $sortorder++;
            }
        }
    }

    /**
     * Returns whether there are items at this depth level
     *
     * @param int $id
     * @return mixed A hierarchy error string index if it's not safe to delet, boolean true if it is safe
     */
    function is_safe_to_delete_depth($id) {

        if ( !get_record($this->shortprefix.'_depth', 'id', $id) ){
            return 'deletedepthnosuchdepth';
        }

        if ( count_records($this->shortprefix, 'depthid', $id) > 0 ){
            return 'deletedepthhaschildren';
        }

        if ( $id && $id != $this->get_max_depth() ){
            return 'deletedepthnotdeepest';
        }

        return true;
    }

    /**
     * Delete a depth level. Will fail if there are deeper depth levels for
     * the framework, or if there are items at this depth level in the framework
     *
     * @param int $id id of depth level to delete
     * @return mixed Boolean true if successful, a hierarchy error index string if not
     */
    function delete_depth($id) {

        $safe_or_not = $this->is_safe_to_delete_depth($id);
        if ( $safe_or_not === true ){
            $this->delete_depth_metadata($id);
            delete_records($this->shortprefix.'_depth', 'id', $id);
        }
        return $safe_or_not;
    }

    /**
     * Delete the metadata associated with a depth level (separated into a
     * separate function so that it can be called when all depths are deleted
     * with a whole framework, or when a single depth level is deleted
     * individually)
     *
     * @param int $id id of depth level with metadata to delete
     * @return void
     */
    function delete_depth_metadata($id) {
        // Delete all info fields in a depth
        delete_records($this->shortprefix.'_depth_info_field', 'depthid', $id);

        // Delete all info categories in a depth
        delete_records($this->shortprefix.'_depth_info_category', 'depthid', $id);

    }


    /**
     * Run any code before printing admin page header
     * @param $page string Unique identifier for admin page
     * @return void
     */
    function hierarchy_page_setup($page) {}

    /**
     * Print any extra markup to display on the hierarchy view item page
     * @param $item object Item being viewed
     * @return void
     */
    function display_extra_view_info($item) {}

    /**
     * Return hierarchy type specific data about an item
     *
     * The returned array should have the structure:
     * array(
     *  0 => array('title' => $title, 'value' => $value),
     *  1 => ...
     * )
     *
     * @param $item object Item being viewed
     * @param $cols array optional Array of columns and their raw data to be returned
     * @return array
     */
    function get_item_data($item, $cols = NULL) {

        // Item's depth
        $depth = $this->get_depth_by_id($item->depthid);

        // Cols to loop through
        if (!is_array($cols)) {
            $cols = array('fullname', 'shortname', 'idnumber', 'description');
        }

        // Data to return
        $data = array();

        foreach ($cols as $datatype) {
            $data[] = array(
                'title' => get_string($datatype.'view', $this->prefix, $depth->fullname),
                'value' => $item->$datatype
            );
        }

        return $data;
    }

    /**
     * Return the deepest depth in this framework
     *
     * @return int|null
     */
    function get_max_depth() {

        // Get depths
        $depths = $this->get_depths();

        if (!$depths) {
            return null;
        }

        // Get max depth level
        end($depths);
        $max_depth = current($depths)->id;

        return $max_depth;
    }

    /**
     * Get all items that are parents
     * (Use in hierarchy treeviews to know if an item is a parent of others, and
     * therefore has children)
     *
     * @return  array
     */
    function get_all_parents() {
        global $CFG;

        $parents = get_records_sql(
            "
            SELECT DISTINCT
                parentid AS id
            FROM
                {$CFG->prefix}{$this->shortprefix}
            WHERE
                parentid != 0
            "
        );
        if($parents) {
            return $parents;
        } else {
            return array();
        }
    }

    /**
     * Returns the short prefix for the given type name. Note that it will error
     * out if the typename is for a non-existent hierarchy type.
     * 
     * @param string $typename
     * @return string
     */
    static function get_short_prefix($typename){
        global $CFG;
        $cleantypename = clean_param($typename, PARAM_ALPHA);
        require_once($CFG->dirroot . '/hierarchy/type/' . $cleantypename . '/lib.php');
        $instance = new $typename();
        return $instance->shortprefix;
    }
}

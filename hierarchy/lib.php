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
 * @package totara
 */

require_once(dirname(dirname(__FILE__)) . '/local/utils.php');
require_once(dirname(dirname(__FILE__)) . '/customfield/fieldlib.php');

/**
 * Toggles the use of shortnames in addition to fullnames in hierarchy
 * forms. When true, hierarchies will include a shortname field in the
 * framework, item and type forms.
 */
define('HIERARCHY_DISPLAY_SHORTNAMES', false);

/**
 * Export option codes
 *
 * Bitwise flags, so new ones should be double highest value
 */
define('HIERARCHY_EXPORT_EXCEL', 1);
define('HIERARCHY_EXPORT_CSV', 2);
define('HIERARCHY_EXPORT_ODS', 4);

global $HIERARCHY_EXPORT_OPTIONS;
$HIERARCHY_EXPORT_OPTIONS = array(
    'xls' => HIERARCHY_EXPORT_EXCEL,
    'csv' => HIERARCHY_EXPORT_CSV,
    'ods' => HIERARCHY_EXPORT_ODS,
);

/**
 * Hierarchy item adjacent peer
 *
 * References either the item above or below the current item
 */
define('HIERARCHY_ITEM_ABOVE', 1);
define('HIERARCHY_ITEM_BELOW', -1);

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
     * Get a framework
     *
     * @param integer $id (optional) ID of the framework to return. If not set returns the default (first) framework
     * @param $showhidden (optional) When returning the default framework, exclude hidden frameworks
     *                               Note: if a hidden framework is specified by id it will still be returned
     * @param $noframeworkok boolean (optional) If false, throw an error if no ID is supplied and there is no default framework
     *                                          If true, the function returns false but no error is generated
     * @return object|false The framework object. On failure returns false or throws an error
     */
    function get_framework($id = 0, $showhidden = false, $noframeworkok = false) {
        global $CFG;

        // If no framework id supplied, use first in sortorder
        if ($id == 0) {
            $visible_sql = $showhidden ? '' : ' WHERE visible = 1';
            $sql = "SELECT * FROM {$CFG->prefix}{$this->shortprefix}_framework
                {$visible_sql}
                ORDER BY sortorder ASC";
            if (!$framework = get_record_sql($sql, true)) {
                if ($noframeworkok) {
                    return false;
                } else {
                    print_error('noframeworks', $this->prefix);
                }
            }
        } else {
            if (!$framework = get_record($this->shortprefix.'_framework', 'id', $id)) {
                print_error('frameworkdoesntexist', 'hierarchy', '', $this->prefix);
            }
        }

        $this->frameworkid = $framework->id; // specify the framework id
        return $framework;
    }

    /**
     * Get type by id
     * @return object|false
     */
    function get_type_by_id($id) {
        return get_record($this->shortprefix.'_type', 'id', $id);
    }

    /**
     * Get framework
     * @param array $extra_data optional - specifying extra info to be fetched and returned
     * @param bool $showhidden optional - specifying whether or not to include hidden frameworks
     * @return array|false
     * @uses $CFG when extra_data specified
     */
    function get_frameworks($extra_data=array(), $showhidden=false) {
        if (!count($extra_data) && !$showhidden) {
            return get_records($this->shortprefix.'_framework', 'visible', '1', 'sortorder, fullname');
        } else if (!count($extra_data)) {
            return get_records($this->shortprefix.'_framework', '', '', 'sortorder, fullname');
        }

        global $CFG;

        $sql = "SELECT f.* ";
        if (isset($extra_data['depth_count'])) {
            $sql .= ",(SELECT COALESCE(MAX(depthlevel), 0) FROM {$CFG->prefix}{$this->shortprefix} item
                        WHERE item.frameworkid = f.id) AS depth_count ";
        }
        if (isset($extra_data['item_count'])) {
            $sql .= ",(SELECT COUNT(*) FROM {$CFG->prefix}{$this->shortprefix} ic
                        WHERE ic.frameworkid=f.id) AS item_count ";
        }
        $sql .= "FROM {$CFG->prefix}{$this->shortprefix}_framework f ";
        if (!$showhidden) {
            $sql .= "WHERE f.visible=1 ";
        }
        $sql .= "ORDER BY f.sortorder, f.fullname";

        return get_records_sql($sql);

    }

    /**
     * Get types for a hierarchy
     * @var array $extra_data optional - specifying extra info to be fetched and returned
     * @return array|false
     * @uses $CFG when extra_data specified
     */
    function get_types($extra_data=array()) {
        if (!count($extra_data)) {
           return get_records($this->shortprefix.'_type', '', '', 'fullname');
        }

        global $CFG;

        $sql = "SELECT c.* ";
        if (isset($extra_data['custom_field_count'])) {
            $sql .= ", (SELECT COUNT(*) FROM {$CFG->prefix}{$this->shortprefix}_type_info_field cif
                        WHERE cif.typeid = c.id) AS custom_field_count ";
        }
        if (isset($extra_data['item_count'])) {
            $sql .= ", (SELECT COUNT(*) FROM {$CFG->prefix}{$this->shortprefix} ic
                 WHERE ic.typeid = c.id) AS item_count";
        }
        $sql .= " FROM {$CFG->prefix}{$this->shortprefix}_type c
                  ORDER BY c.fullname";
        return get_records_sql($sql);
    }


    function get_custom_fields($itemid) {
        global $CFG;
        $prefix = $this->prefix;

        $sql = "SELECT c.*, f.*
                FROM {$CFG->prefix}{$this->shortprefix}_type_info_data c
                INNER JOIN {$CFG->prefix}{$this->shortprefix}_type_info_field f ON c.fieldid = f.id
                WHERE c.{$prefix}id = {$itemid}
                ORDER BY f.sortorder";

        $customfields = get_records_sql($sql);

        return is_array($customfields) ? $customfields : array();
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
        return get_records($this->shortprefix, 'frameworkid', $this->frameworkid, 'sortthread, fullname');
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
            return get_records_select($this->shortprefix, "parentid = {$parentid} AND visible = 1", 'frameworkid, sortthread, fullname');
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
        if (empty($this->frameworkid) || $all) {
            // all root level items across frameworks
            return get_records_select($this->shortprefix, "parentid = 0 AND visible = 1", 'frameworkid, sortthread, fullname');
        } else {
            // root level items for current framework only
            $fwid = $this->frameworkid;
            return get_records_select($this->shortprefix, "parentid = 0 AND frameworkid = $fwid AND visible = 1", 'sortthread, fullname');
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
            // the WHERE clause must be like this to avoid /1% matching /10
            $sql = "SELECT id, fullname, parentid, path, sortthread
                    FROM {$CFG->prefix}{$this->shortprefix}
                    WHERE path = '{$path}' OR path LIKE '{$path}/%'
                    ORDER BY path";
            return get_records_sql($sql);
        } else {
            print_error('nopathfoundforid', 'hierarchy', '', (object)array('prefix'=>$this->prefix, 'id'=>$id));
        }
    }

    /**
     * Given an item id, returns the adjacent item at the same depth level
     * @param object $item An item object to find the peer for. Must include id,
     *                     frameworkid, sortthread, parentid and depthlevel
     * @param integer $direction Which direction to look for a peer, relative to $item.
     *                           Use constant HIERARCHY_ITEM_ABOVE or HIERARCHY_ITEM_BELOW
     * @return int|false Returns the ID of the peer or false if there isn't one
     *                   in the direction specified
     **/
    function get_hierarchy_item_adjacent_peer($item, $direction = HIERARCHY_ITEM_ABOVE) {
        global $CFG;
        // check that item has required properties
        if ( !isset($item->depthlevel) ||
            !isset($item->sortthread) || !isset($item->id)) {
            return false;
        }
        // try and use item's fwid if not set by hierarchy
        if (isset($this->frameworkid)) {
            $frameworkid = $this->frameworkid;
        } else if (isset($item->frameworkid)) {
            $frameworkid = $item->frameworkid;
        } else {
            return false;
        }

        $depthlevel = $item->depthlevel;
        $sortthread = $item->sortthread;
        $parentid = $item->parentid;
        $id = $item->id;

        // are we looking above or below for a peer?
        $sqlop = ($direction == HIERARCHY_ITEM_ABOVE) ? '<' : '>';
        $sqlsort = ($direction == HIERARCHY_ITEM_ABOVE) ? 'DESC' : 'ASC';

        $sql = "SELECT id FROM {$CFG->prefix}{$this->shortprefix}
            WHERE frameworkid = $frameworkid AND
            depthlevel = $depthlevel AND
            parentid = $parentid AND
            sortthread $sqlop '$sortthread'
            ORDER BY sortthread $sqlsort";
        // only return first match
        $dest = get_record_sql($sql, true);
        if ($dest) {
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
        if (!is_array($list)) {
            $list = array();
        }
        if (empty($id)) {
            // start at top level
            $id = 0;
        }

        if (empty($records)) {
            // must be first time through function, get the records, and pass to
            // future uses to save db calls
            $records = get_records($this->shortprefix,'visible','1','path','id,fullname,shortname,parentid,sortthread,path');
        }

        if ($id == 0) {
            $children = $this->get_all_root_items(true);
        } else {
            $item = $records[$id];
            $name = ($shortname) ? $item->shortname : $item->fullname ;
            if ($path) {
                $path = $path.' / '.$name;
            } else {
                $path = $name;
            }
            // add item
            $list[$item->id] = $path;
            if ($showchildren === true) {
                // if children wanted and there are some
                // show a second option with children
                // does the same as:
                //$descendants = $this->get_item_descendants($id);
                // but without the db calls
                $descendants = array();
                foreach ($records as $key => $record) {
                    if (substr($record->path,0,strlen($item->path)) == $item->path) {
                    //print "{$record->path} child of {$item->path}<br>";
                        $descendants[$key] = $record;
                    }
                }
                if (count($descendants)>1) {
                    // add comma separated list of all children too
                    $idstr = implode(',',array_keys($descendants));
                    $list[$idstr] = $path." (and all children)";
                }
            }
            // does the same as:
            // $children = $this->get_items_by_parent($id);
            // but without the db calls
            $children = array();
            foreach ($records as $key => $record) {
                if ($record->parentid == $id) {
                    $children[$key] = $record;
                }
            }
        }

        // now deal with children of this item
        if ($children) {
            foreach ($children as $child) {
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
            $sql = "SELECT o.id, o.fullname, o.parentid, o.depthlevel
                    FROM {$CFG->prefix}{$this->shortprefix} o
                    WHERE o.id IN (".implode(",", $paths).")";
            return get_records_sql($sql);
        } else {
            print_error('nopathfoundforid', 'hierarchy', '', (object)array('prefix'=>$this->prefix, 'id'=>$id));
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
        $options['prefix'] = $this->prefix;
        return print_single_button(qualified_me(), $options, $label, 'get', '', true);
    }

    /**
     * Display pulldown menu of frameworks
     * @param string $page Page to redirect to
     * @param boolean $simple optional Display simple selector
     * @param boolean $return optional Return instead of print
     * @param boolean $showhidden optional Include hidden frameworks in picker
     * @return boolean success
     */
    function display_framework_selector($page = 'index.php', $simple = false, $return = false, $showhidden = false) {
        global $CFG;

        $frameworks = $this->get_frameworks(array(), $showhidden);

        if (count($frameworks) <= 1) {
            return;
        }

        if (!$simple) {

            $fwoptions = array();

            echo '<div class="frameworkpicker">';

            foreach ($frameworks as $fw) {
                $fwoptions[$fw->id] = $fw->fullname;
            }

            popup_form($CFG->wwwroot.'/hierarchy/'.$page.'?prefix='.$this->prefix.'&amp;frameworkid=', $fwoptions, 'switchframework', $this->frameworkid, '', '', '', false, 'self', get_string('switchframework', 'hierarchy'));

            echo '</div>';

        }
        else {

            $options = array();
            foreach ($frameworks as $fw) {
                $options[$fw->id] = $fw->fullname;
            }

            $markup = display_dialog_selector($options, $this->frameworkid, 'simpleframeworkpicker');
            if ($return) {
                return $markup;
            }

            echo $markup;
        }
    }

    /**
     * Display add item button
     * @return boolean success
     */
    function display_add_item_button($page=0) {
        global $CFG;
        $options = array('prefix' => $this->prefix, 'frameworkid' => $this->frameworkid, 'page' => $page);
        print_single_button($CFG->wwwroot.'/hierarchy/item/edit.php', $options, get_string('addnew'.$this->prefix, $this->prefix), 'get');
    }

    /**
     * Display add mulitple items button
     * @return boolean success
     */
    function display_add_multiple_items_button($page=0) {
        global $CFG;
        $options = array('prefix' => $this->prefix, 'frameworkid' => $this->frameworkid, 'page' => $page);
        print_single_button($CFG->wwwroot.'/hierarchy/item/bulkadd.php', $options, get_string('addmultiplenew'.$this->prefix, $this->prefix), 'get');
    }

    /**
     * Displays a set of action buttons
     */
    function display_action_buttons($can_add_item, $page=0) {
        global $CFG;

        print_container_start(false, null, 'hierarchy-buttons');

        // Add buttons
        if ($can_add_item) {
            $this->display_add_item_button($page);
        }
        print_container_end();
    }

    /**
     * Displays a bulk actions selector
     */
    function display_bulk_actions_picker($can_add_item, $can_edit_item, $can_delete_item, $can_manage_type, $page=0) {
        global $CFG;


        $options = array();
        if ($can_add_item) {
            $options['item/bulkadd.php?prefix='.$this->prefix.'&amp;frameworkid='.$this->frameworkid.'&amp;page='.$page] = get_string('add');
        }
        if ($can_delete_item) {
            $options['item/bulkactions.php?action=delete&amp;prefix='.$this->prefix.'&amp;frameworkid='.$this->frameworkid] = get_string('delete');
        }
        if ($can_edit_item) {
            $options['item/bulkactions.php?action=move&amp;prefix='.$this->prefix.'&amp;frameworkid='.$this->frameworkid] = get_string('move');
        }
        if ($can_manage_type) {
            $options['type/index.php?prefix='.$this->prefix] = get_string('reclassifyitems' ,'hierarchy');
        }

        if (count($options) > 0) {
            print_container_start(false, 'hierarchy-bulk-actions-picker');
            popup_form($CFG->wwwroot.'/hierarchy/', $options, 'bulkactions', '', get_string('bulkactions', 'hierarchy'), '', '', false, 'self', '');
            print_container_end();
        }
    }

    /**
     * Display add type button
     * @return boolean success
     */
    function display_add_type_button($page=0) {
        global $CFG;
        $options = array('prefix' => $this->prefix, 'frameworkid' => $this->frameworkid, 'page' => $page);
        print_single_button($CFG->wwwroot.'/hierarchy/type/edit.php', $options, get_string('addtype', $this->prefix), 'get');
    }


    /**
     * Swap the order of two items
     *
     * The items must be in the same framework and have the same parent. The
     * children of any items will be moved with them
     *
     * This method will fail if no item exists in the direction specified. Use
     * {@link get_hierarchy_item_adjacent_peer()} to check first
     *
     * @var int - the item id to move
     * @param integer $swapwith Which item to swap with, relative the the item id given.
     *                          Use constant HIERARCHY_ITEM_ABOVE or HIERARCHY_ITEM_BELOW
     * @var boolean $up - Direction to move: up if true, down if false
     *
     * @return boolean True if the reordering succeeds
     */
    function reorder_hierarchy_item($id, $swapwith) {
        if (!$source = get_record($this->shortprefix, 'id', $id)) {
            return false;
        }

        // get nearest neighbour in direction of move
        $destid = $this->get_hierarchy_item_adjacent_peer($source, $swapwith);
        if (!$destid) {
            // source not a valid record or no peer in that direction
            notify(get_string('error:couldnotmoveitemnopeer','hierarchy',$this->prefix));
            return false;
        }

        // update the sortthreads
        return $this->swap_item_sortthreads($id, $destid);
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
     * Delete a framework item and all its children and associated data
     *
     * The exact data being deleted will depend on what sort of hierarchy it is
     * See {@link _delete_hierarchy_items()} in the child class for details
     *
     * @param integer $id the item id to delete
     * @param boolean $triggerevent If true, this command will trigger a "{$prefix}_added" event handler
     *
     * @return boolean success or failure
     */
    public function delete_hierarchy_item($id, $triggerevent = true) {
        global $CFG;

        if (!record_exists($this->shortprefix, 'id', $id)) {
            error('Attempting to delete nonexistent item ' . $id);
        }

        // get array of items to delete (the item specified *and* all its children)
        $delete_list = $this->get_item_descendants($id);
        // make a copy for triggering events
        $deleted_list = $delete_list;

        // make sure we know the item's framework id
        $frameworkid = isset($this->frameworkid) ? $this->frameworkid :
            get_field($this->shortprefix, 'frameworkid', 'id', $id);

        begin_sql();

        // iterate through 1000 items at a time, because oracle can't use
        // more than 1000 items in an sql IN clause
        while ($delete_items = totara_pop_n($delete_list, 1000)) {
            $delete_ids = array_keys($delete_items);
            if (!$this->_delete_hierarchy_items($delete_ids)) {
                rollback_sql();
                return false;
            }
        }

        commit_sql();

        // Raise an event for each item deleted to let other parts of the system know
        if ($triggerevent) {
            foreach ($deleted_list as $deleted_item) {
                events_trigger("{$this->prefix}_deleted", $deleted_item);
            }
        }

        return true;
    }


    /**
     * Delete all data associated with the framework items provided
     *
     * This method is protected because it deletes the items, but doesn't use transactions.
     * Use {@link hierarchy::delete_hierarchy_item()} to recursively delete an item and
     * all its children. This method is extended or overridden in the lib file for each
     * hierarchy prefix to remove specific data for that hierarchy prefix.
     *
     * @param array $items Array of IDs to be deleted
     *
     * @return boolean True if items and associated data were successfully deleted
     */
    protected function _delete_hierarchy_items($items) {
        // delete the actual items
        $item_sql = 'id IN (' . implode(',', $items) . ') ';
        if (!delete_records_select($this->shortprefix, $item_sql)) {
            return false;
        }

        // delete custom field data associated with the items
        $data_sql = $this->prefix . 'id IN (' . implode(',', $items) . ') ';
        if (!delete_records_select($this->shortprefix.'_type_info_data', $data_sql)) {
            return false;
        }

        return true;
    }


    /**
     * Delete a framework and its contents
     * @return  boolean
     */
    function delete_framework() {
        global $CFG;

        // Get all items in the framework
        $items = $this->get_items();

        begin_sql();

        if ($items) {
            foreach ($items as $item) {
                // Delete all top level items (which also deletes their children), and their info data
                if ($item->parentid == 0) {
                    if (!$this->delete_hierarchy_item($item->id)) {
                        rollback_sql();
                        return false;
                    }
                }
            }
        }

        // Finally delete this framework
        if (!delete_records($this->shortprefix.'_framework', 'id', $this->frameworkid)) {
            rollback_sql();
            return false;
        }

        // Rewrite the sort order to account for the missing framework
        $sortorder = 1;
        $records = get_records_sql("SELECT id FROM {$CFG->prefix}{$this->shortprefix}_framework ORDER BY sortorder ASC");
        if (is_array($records)) {
            foreach ( $records as $rec ){
                if (!set_field( "{$this->shortprefix}_framework", 'sortorder', $sortorder, 'id', $rec->id )) {
                    rollback_sql();
                    return false;
                }
                $sortorder++;
            }
        }

        commit_sql();
        return true;
    }


    /**
     * Delete a type.
     *
     * @param int $id id of type to delete
     * @return mixed Boolean true if successful, false otherwise
     */
    function delete_type($id) {
        global $CFG;

        begin_sql();

        // remove any custom fields data
        if (!$this->delete_type_metadata($id)) {
            rollback_sql();
            return false;
        }

        // unassign this type from all items (set to unclassified)
        $sql = "UPDATE {$CFG->prefix}{$this->shortprefix}
            SET typeid = 0
            WHERE typeid = {$id}";
        if (!execute_sql($sql, false)) {
            rollback_sql();
            return false;
        }

        // finally delete the type itself
        if (!delete_records($this->shortprefix.'_type', 'id', $id)) {
            rollback_sql();
            return false;
        }

        commit_sql();
        return true;
    }


    /**
     * Delete the metadata associated with a type (separated into a
     * separate function so that it can be called when all types are deleted
     *
     * @param int $id id of type with metadata to delete
     * @return void
     */
    function delete_type_metadata($id) {
        $result = true;
        // delete all custom field data using fields in this type
        if ($fields = get_records($this->shortprefix.'_type_info_field', 'typeid', $id)) {
            $fields = array_keys($fields);
            $result = $result && delete_records_select($this->shortprefix.'_type_info_data', 'fieldid IN (' . implode(',', $fields) . ')');
        }
        // Delete all info fields in a type
        $result = $result && delete_records($this->shortprefix.'_type_info_field', 'typeid', $id);

        return $result;
    }


    /**
     * Run any code before printing admin page header
     * @param $page string Unique identifier for admin page
     * @return void
     */
    function hierarchy_page_setup($page, $item) {}

    /**
     * Print any extra markup to display on the hierarchy view item page
     * @param $item object Item being viewed
     * @return void
     */
    function display_extra_view_info($item) {}

    /**
     * Return hierarchy prefix specific data about an item
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

        // Cols to loop through
        if (!is_array($cols)) {
            $cols = array('fullname', 'shortname', 'idnumber', 'description');
        }

        // Data to return
        $data = array();

        foreach ($cols as $datatype) {
            $data[] = array(
                'title' => get_string($datatype.'view', $this->prefix),
                'value' => $item->$datatype
            );
        }

        // Item's type
        $itemtype = $this->get_type_by_id($item->typeid);
        $typename = ($itemtype) ? $itemtype->fullname : get_string('unclassified', 'hierarchy');
        $data[] = array(
            'title' => get_string('type', 'hierarchy'),
            'value' => $typename,
        );

        return $data;
    }

    /**
     * Return the deepest depth in this framework
     *
     * @return int|false
     */
    function get_max_depth() {

        return get_field($this->shortprefix, 'MAX(depthlevel)', 'frameworkid', $this->frameworkid);
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
        if ($parents) {
            return $parents;
        } else {
            return array();
        }
    }

    /**
     * Returns the short prefix for the given prefix name. Note that it will error
     * out if the prefixname is for a non-existent hierarchy prefix.
     * 
     * @param string $prefixname
     * @return string
     */
    static function get_short_prefix($prefixname){
        global $CFG;
        $cleanprefixname = clean_param($prefixname, PARAM_ALPHA);
        $libpath = $CFG->dirroot.'/hierarchy/prefix/'.$cleanprefixname.'/lib.php';
        if (!file_exists($libpath)) {
            print_error('error:hierarchyprefixnotfound', 'hierarchy', $cleanprefixname);
        }
        require_once($libpath);
        $instance = new $cleanprefixname();
        return $instance->shortprefix;
    }


    /**
     * Helper function for loading a hierarchy library and
     * return an instance
     *
     * @access  public
     * @param   $prefix   string  Hierarchy prefix
     * @return  $object Instance of the hierarchy prefix object
     */
    static function load_hierarchy($prefix) {
        global $CFG;

        // $prefix could be user input so sanitize
        $prefix = clean_param($prefix, PARAM_ALPHA);

        // Check file exists
        $libpath = $CFG->dirroot.'/hierarchy/prefix/'.$prefix.'/lib.php';
        if (!file_exists($libpath)) {
            print_error('error:hierarchyprefixnotfound', 'hierarchy', $prefix);
        }

        // Load library
        require_once $libpath;

        // Check class exists
        if (!class_exists($prefix)) {
            print_error('error:hierarchyprefixnotfound', 'hierarchy', $prefix);
        }

        return new $prefix();
    }


    /**
     * Returns the html to print a row of the hierarchy index table
     *
     * @param object $record A hierarchy item record
     * @param boolean $include_custom_fields Whether to display custom field info too (optional)
     * @param boolean $indicate_depth Whether to indent to show the hierarchy or not (optional)
     * @param array $cfields Array of custom fields associated with this hierarchy (optional)
     * @param array $types Array of type information (optional)
     * @return string HTML to display the item as a row in the hierarchy index table
     */
    function display_hierarchy_item($record, $include_custom_fields=false, $indicate_depth=true, $cfields=array(), $types=array()) {
        global $CFG;
        $out = '';

        // never indent more than 10 levels as we only have 10 levels of CSS styles
        // and the table format would break anyway if indented too much
        $itemdepth = ($indicate_depth) ? 'depth' . min(10, $record->depthlevel) : 'depth1';
        // @todo get based on item type or better still, don't use inline styles :-(
        $itemicon = $CFG->pixpath . '/i/item.gif';
        $cssclass = !$record->visible ? 'dimmed' : '';

        $out .= '<div class="hierarchyitem ' . $itemdepth .
            '" style="background-image: url(\'' . $itemicon . '\');">';
        $out .= '<a href="' . $CFG->wwwroot . '/hierarchy/item/view.php?prefix=' . $this->prefix .
            '&amp;id=' . $record->id . '" class="' . $cssclass . '">' . format_string($record->fullname) . '</a>';
        if ($include_custom_fields) {
            $out .= '<br />';
            // print description if available
            if ($record->description) {
                $out .= '<div class="itemdescription ' . $cssclass . '"><strong>' .
                    get_string('description') . ': </strong>' .
                    format_string($record->description) . '</div>';
            }
            // print type, unless unclassified
            if ($record->typeid !=0 && is_array($types) && array_key_exists($record->typeid, $types)) {
                $out .= '<div class="itemtype ' . $cssclass . '"><strong>' .
                    get_string('type', 'hierarchy') . ':</strong> ' .
                    format_string($types[$record->typeid]->fullname) . '</div>';
            }

            $out .= $this->display_hierarchy_item_custom_field_data($record, $cfields);
        }
        $out .= '</div>';
        return $out;
    }


    /**
     * Returns the HTML to display the action icons for a hierarchy item on the index
     *
     * @param object $record A hierarchy item record
     * @param boolean $canedit Edit and show/hide buttons only shown if user can edit
     * @param boolean $candelete Delete button only shown if user can delete
     * @param boolean $canmove Move button only shown if user can move (and edit)
     * @param string $extraparam Additional string to append to action URLs (optional)
     *
     * @return string HTML to display action icons
     */
    function display_hierarchy_item_actions($record, $canedit=true, $candelete=true, $canmove=true, $extraparams='') {
        global $CFG;
        $buttons = array();
        $str_edit = get_string('edit');
        $str_hide = get_string('hide');
        $str_show = get_string('show');
        $str_moveup = get_string('moveup');
        $str_movedown = get_string('movedown');
        $str_delete = get_string('delete');
        $str_spacer       = "<img src=\"{$CFG->wwwroot}/pix/spacer.gif\" class=\"iconsmall\" alt=\"\" /> ";
        $prefix = $this->prefix;
        $extraparams = !empty($extraparams) ? '&amp;' . $extraparams : '';

        if ($canedit) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/item/edit.php?prefix={$prefix}&amp;frameworkid={$record->frameworkid}&amp;id={$record->id}{$extraparams}\" title=\"$str_edit\">".
                "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";

            if ($record->visible) {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/index.php?prefix={$prefix}&amp;&amp;frameworkid={$record->frameworkid}&amp;hide={$record->id}{$extraparams}&amp;sesskey=".sesskey()."\" title=\"$str_hide\">".
                    "<img src=\"{$CFG->pixpath}/t/hide.gif\" class=\"iconsmall\" alt=\"$str_hide\" /></a>";
            } else {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/index.php?prefix={$prefix}&amp;frameworkid={$record->frameworkid}&amp;show={$record->id}{$extraparams}&amp;sesskey=".sesskey()."\" title=\"$str_show\">".
                    "<img src=\"{$CFG->pixpath}/t/show.gif\" class=\"iconsmall\" alt=\"$str_show\" /></a>";
            }

            if ($canmove) {
                if ($this->get_hierarchy_item_adjacent_peer($record, HIERARCHY_ITEM_ABOVE)) {
                    $buttons[] = "<a href=\"index.php?prefix={$prefix}&amp;moveup={$record->id}&amp;frameworkid={$record->frameworkid}{$extraparams}&amp;sesskey=".sesskey()."\" title=\"$str_moveup\">".
                        "<img src=\"{$CFG->pixpath}/t/up.gif\" class=\"iconsmall\" alt=\"$str_moveup\" /></a> ";
                } else {
                    $buttons[] = $str_spacer;
                }
                if ($this->get_hierarchy_item_adjacent_peer($record, HIERARCHY_ITEM_BELOW)) {
                    $buttons[] = "<a href=\"index.php?prefix={$prefix}&amp;movedown=".$record->id."&amp;frameworkid={$record->frameworkid}{$extraparams}&amp;sesskey=".sesskey()."\" title=\"$str_movedown\">".
                        "<img src=\"{$CFG->pixpath}/t/down.gif\" class=\"iconsmall\" alt=\"$str_movedown\" /></a> ";
                } else {
                    $buttons[] = $str_spacer;
                }
            }
        }
        if ($candelete) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/item/delete.php?prefix={$prefix}&amp;frameworkid={$record->frameworkid}&amp;id={$record->id}{$extraparams}\" title=\"$str_delete\">".
                "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_delete\" /></a>";
        }
        return implode($buttons, ' ');
    }

    /**
     * Return the HTML needed to display custom field information
     * @param object $record A hierarchy record containing item and custom field information
     *                       The record must contain the hierarchy item's typeid field and
     *                       also custom field data stored in fields called cf_[FIELDID]
     * @param array $cfields Array of custom fields associated with this hierarchy
     *                       Key is fieldid, value is custom field object
     *                       Used to determine which field to display for this item
     *
     * @return HTML to display the custom field data
     */
    function display_hierarchy_item_custom_field_data($record, $cfields) {
        global $CFG;
        $out = '';
        $cssclass = !$record->visible ? 'dimmed' : '';

        if(!is_array($cfields)) {
            return false;
        }

        foreach ($cfields as $cf) {
            $cf_type = "customfield_{$cf->datatype}";
            require_once($CFG->dirroot.'/customfield/field/'.$cf->datatype.'/field.class.php');
            if ($record->typeid != $cf->typeid) {
                // custom field not in this item's type
                continue;
            }
            // don't display hidden fields
            if ($cf->hidden) {
                continue;
            }
            $property = "cf_{$cf->id}";
            // only show if there's data
            if ($record->$property) {
                $out .= '<div class="customfield ' . $cssclass . '"><strong>' . format_string($cf->fullname) . ':</strong> ' . call_user_func(array($cf_type, 'display_item_data'), $record->$property) . '</div>';
            }
        }

        return $out;
    }

    /**
     * Returns names of any extra fields that may be contained in a hierarchy
     * @return array array of extra fields
     */
    function get_extrafields() {
        return $this->extrafields;
    }

    /**
     * Displays the specified extrafield
     * @param object $item hierarchy item record
     * @param string $extrafield name of the extrafield to display
     * @return string html to display the hierarchy item
     */
    function display_hierarchy_item_extrafield($item, $extrafield) {
        global $CFG;
        return "<a href=\"{$CFG->wwwroot}/hierarchy/item/view.php?prefix={$this->prefix}&amp;id={$item->id}\">{$item->$extrafield}</a>";
    }

    /**
     * Add several new items to a particular hierarchy parent
     *
     * The $items_to_add array must contain a set of objects that are suitable for
     * inserting into the hierarchy items table. Hierarchy related data (such as
     * depthlevel, parentid and path) will be added when the record is created
     *
     * @param integer $parentid ID of the item to append the new children to
     * @param array $items_to_add Array of objects suitable for inserting
     * @param integer $frameworkid ID of the framework to add the items to (optional if set in hierarchy object)
     * @param boolean $escapeitems If true, the objects in the $items_to_add array will be escaped before being passed to
     *                            insert_record(). If passing data from a form that has already been escaped,
     *                            this should be set to false. If passing in a raw object from a get_records()
     *                            call, this should be true (the default)
     * @param boolean $triggerevent If true, this command will trigger a "{$prefix}_added" event handler for each new item
     */
    function add_multiple_hierarchy_items($parentid, $items_to_add, $frameworkid = null, $escapeitems = true, $triggerevent = true) {
        global $USER;
        $now = time();

        // we need the framework id to be set
        if (!isset($frameworkid)) {
            // try and get it from current hierarchy
            if (isset($this->frameworkid)) {
                $frameworkid = $this->frameworkid;
            } else {
                return false;
            }
        }

        if(!is_array($items_to_add)) {
            // items must be an array of objects
            return false;
        }

        begin_sql();

        $new_ids = array();
        foreach ($items_to_add as $item) {
            if (!isset($item->visible)) {
                // default to visible if not set
                $item->visible = 1;
            }
            $item->timemodified = $now;
            $item->usermodified = $USER->id;

            if ($newitem = $this->add_hierarchy_item($item, $parentid, $frameworkid, $escapeitems, false, $triggerevent)) {
                $new_ids[] = $newitem->id;
            } else {
                // fail if any new items fail to be added
                rollback_sql();
                return false;
            }
        }

        commit_sql();

        // everything worked -return the IDs
        return $new_ids;

    }


    /**
     * Add a new hierarchy item to an existing framework
     *
     * Given an object to insert and a parent id, create a new hierarchy item
     * and attach it to the appropriate location in the hierarchy
     *
     * @param object $item The item to insert. This should contain all data describing the object *except*
     *                     the information related to its location in the hierarchy:
     *                      - depthlevel
     *                      - path
     *                      - frameworkid
     *                      - sortthread
     *                      - parentid
     *                      - timecreated
     * @param integer $parentid The ID of the parent to attach to, or 0 for top level
     * @param integer $frameworkid ID of the parent's framework (optional, unless parentid == 0)
     * @param boolean $escapeitem If true, the $item object will be escaped before being passed to
     *                            insert_record(). If passing data from a form that has already been escaped,
     *                            this should be set to false. If passing in a raw object from a get_records()
     *                            call, this should be true (the default)
     * @param boolean $usetransaction If true this function will use transactions (optional, default: true)
     * @param boolean $triggerevent If true, this command will trigger a "{$prefix}_added" event handler
     *
     * @return object|false A copy of the new item, or false if it could not be added
     */
    function add_hierarchy_item($item, $parentid, $frameworkid = null, $escapeitem = true, $usetransaction = true, $triggerevent = true) {
        // figure out the framework if not provided
        if (!isset($frameworkid)) {
            // try and use hierarchy's frameworkid, if not look it up based on parent
            if (isset($this->frameworkid)) {
                $frameworkid = $this->frameworkid;
            } else if ($parentid != 0) {
                if (!$frameworkid = get_field($this->shortprefix, 'frameworkid', 'id', $parentid)) {
                    // can't determine parent's framework
                    return false;
                }
            } else {
                // we can't work out the framework based on parentid for parentid=0
                return false;
            }
        }

        // calculate where the new item fits into the hierarchy
        // handle top level items differently
        if ($parentid == 0) {
            $depthlevel = 1;
            $parentpath = '';
        } else {
            // parent item must exist
            if (!$parent = get_record($this->shortprefix, 'id', $parentid)) {
                return false;
            }
            $depthlevel = $parent->depthlevel + 1;
            $parentpath = $parent->path;
        }

        // fail if can't successfully determine the sort position
        if (!$sortthread = $this->get_next_child_sortthread($parentid, $frameworkid)) {
            return false;
        }

        // set the hierarchy specific data for the new item
        $item->frameworkid = $frameworkid;
        $item->depthlevel = $depthlevel;
        $item->parentid = $parentid;
        $item->path = $parentpath; // we'll add the item's ID to the end of this later
        $item->timecreated = time();
        $item->sortthread = $sortthread;
        if ($escapeitem) {
            $item = addslashes_recursive($item);
        }

        if ($usetransaction) {
            begin_sql();
        }

        if (!$newid = insert_record($this->shortprefix, $item)) {
            if ($usetransaction) {
                rollback_sql();
            }
            return false;
        }

        // Can't set the full path till we know the id!
        if (!set_field($this->shortprefix, 'path', $item->path . '/' . $newid, 'id', $newid)) {
            if ($usetransaction) {
                rollback_sql();
            }
            return false;
        }

        // load the new item from the db
        if (!$newitem = get_record($this->shortprefix, 'id', $newid)) {
            if ($usetransaction) {
                rollback_sql();
            }
            return false;
        }

        if ($usetransaction) {
            commit_sql();
        }

        // trigger an event if required
        if ($triggerevent) {
            events_trigger("{$this->prefix}_added", $newitem);
        }

        return $newitem;

    }


    /**
     * Update an existing hierarchy item
     *
     * This can include moving to a new location in the hierarchy or changing some of its data values.
     * This method will not update an item's custom field data
     *
     * @param integer $itemid ID of the item to update
     * @param object $newitem An object containing details to be updated
     *                        Only a parentid is required to update the items location, other data such as
     *                        depthlevel, sortthread, path, etc will be handled internally
     * @param boolean $escapeitem If true, the $newitem object will be escaped before being passed to
     *                            update_record(). If passing data from a form that has already been escaped,
     *                            this should be set to false. If passing in a raw object from a get_records()
     *                            call, this should be true (the default)
     * @param boolean $usetransaction If true this function will use transactions (optional, default: true)
     * @param boolean $triggerevent If true, this command will trigger a "{$prefix}_added" event handler.
     *
     * @return object|false The updated item, or false if it could not be updated
     */
    function update_hierarchy_item($itemid, $newitem, $escapeitem = true, $usetransaction = true, $triggerevent = true) {
        global $USER;

        // the itemid must be a valid item
        if (!$olditem = get_record($this->shortprefix, 'id', $itemid)) {
            return false;
        }

        if ($newitem->parentid != $olditem->parentid) {
            // the item is being moved. First update without changing the parent, then move afterwards
            $oldparentid = $olditem->parentid;
            $newparentid = $newitem->parentid;
            $newitem->parentid = $oldparentid;
        }

        $newitem->id = $itemid;
        $newitem->timemodified = time();
        $newitem->usermodified = $USER->id;

        if ($escapeitem) {
            // add slashes if required
            $newitem = addslashes_recursive($newitem);
        }

        if ($usetransaction) {
            begin_sql();
        }

        if (!update_record($this->shortprefix, $newitem)) {
            if ($usetransaction) {
                rollback_sql();
            }
            return false;
        }

        if (isset($newparentid)) {
            // item is also being moved

            // get a new copy of the updatd item from the db
            $updateditem = get_record($this->shortprefix, 'id', $itemid);

            // move it
            if (!$this->move_hierarchy_item($updateditem, $newparentid, false)) {
                if ($usetransaction) {
                    rollback_sql();
                }
                return false;
            }
        }

        // get a new copy of the updated item from the db
        if (!$updateditem = get_record($this->shortprefix, 'id', $itemid)) {
            if ($usetransaction) {
                rollback_sql();
            }
            return false;
        }

        if ($usetransaction) {
            commit_sql();
        }

        // Raise an event to let other parts of the system know
        if ($triggerevent) {
            events_trigger("{$this->prefix}_updated", $updateditem);
        }

        return $updateditem;

    }


    /**
     * Move an item within a hierarchy framework
     *
     * Given an item and a new parent ID, attach the item as a child of the parent.
     * Any children of the original item will move with it. This script handles updating:
     * - parent ID of moved item
     * - path of moved item and all descendants
     * - depthlevel of moved item and all descendants
     * - sortthread of all moved items
     *
     * @param object $item The item to move
     * @param integer $newparentid ID of the item to attach it to
     * @param boolean $usetransaction If true this function will use transactions (optional, default: true)
     */
    function move_hierarchy_item($item, $newparentid, $usetransaction=true) {
        global $CFG;

        if (!is_object($item)) {
            return false;
        }

        if ($item->parentid == 0) {
            // create a 'fake' old parent item for items at the top level
            $oldparent = new object();
            $oldparent->id = 0;
            $oldparent->path = '';
            $oldparent->depthlevel = 0;
        } else {
            $oldparent = get_record($this->shortprefix, 'id', $item->parentid);
            if (!$oldparent) {
                // can't find the current parent item
                return false;
            }
        }

        if ($newparentid == 0) {
            // create a 'fake' new parent item for attaching to the top level
            $newparent = new object();
            $newparent->id = 0;
            $newparent->path = '';
            $newparent->depthlevel = 0;
            $newparent->frameworkid = $item->frameworkid;
        } else {
            $newparent = get_record($this->shortprefix, 'id', $newparentid);
            if (!$newparent) {
                // can't find the new parent item
                return false;
            }

            if ($this->is_child_of($newparent, $item->id)) {
                // you can't move an item into its own child
                return false;
            }
        }
        if ($newparent->frameworkid != $item->frameworkid) {
            // can't move to a different framework
            return false;
        }

        if (!$newsortthread = $this->get_next_child_sortthread($newparentid, $item->frameworkid)) {
            // unable to calculate the new sortthread
            return false;
        }
        $oldsortthread = $item->sortthread;

        if ($usetransaction) {
            begin_sql();
        }

        // update the sort thread
        $this->move_sortthread($oldsortthread, $newsortthread, $item->frameworkid);

        // update the item's parent ID
        $todb = new object();
        $todb->id = $item->id;
        $todb->parentid = $newparentid;
        if (!update_record($this->shortprefix, $todb)) {
            if ($usetransaction) {
                rollback_sql();
            }
            return false;
        }

        // update the depthlevel of the item and its descendants
        // figure out how much the level will change after move
        $depthdiff = ($newparent->depthlevel + 1) - $item->depthlevel;
        // update the depthlevel of all affected items
        // the WHERE clause must be like this to avoid /1% matching /10
        $sql = "UPDATE {$CFG->prefix}{$this->shortprefix}
            SET depthlevel=depthlevel + {$depthdiff}
            WHERE (path = '{$item->path}' OR path LIKE '{$item->path}/%')
            AND frameworkid = {$item->frameworkid}";
        if (!execute_sql($sql, false)) {
            if ($usetransaction) {
                rollback_sql();
            }
            return false;
        }


        // update the path of the item and its descendants
        // we need to:
        // - remove the 'old parent' segment of the path from the beginning of the path
        // - add the 'new parent' segment of the path instead
        // - do this for all items that start with the item's path
        // unfortunately this is a bit messy to do in the SQL in a single statement
        // in a cross platform way...
        // the WHERE clause must be like this to avoid /1% matching /10
        $sql = "UPDATE {$CFG->prefix}{$this->shortprefix}
            SET path=" . sql_concat("'{$newparent->path}'", sql_substr() . "(path, " . sql_length("'{$oldparent->path}'") . " + 1)") . "
            WHERE (path = '{$item->path}' OR path LIKE '{$item->path}/%')
            AND frameworkid = {$item->frameworkid}";
        if (!execute_sql($sql, false)) {
            if ($usetransaction) {
                rollback_sql();
            }
            return false;
        }

        if ($usetransaction) {
            commit_sql();
        }
        return true;
    }

    /**
     * Return items from this hierarchy that aren't assigned to a type
     *
     * @param boolean $countonly If true, only return how many items are unclassified
     *
     * @return array|integer|false Array of items, or the number of items, or false on failure
     */
    function get_unclassified_items($countonly=false) {
        $select = "typeid IS NULL OR typeid = 0";
        if ($countonly) {
            return count_records_select($this->shortprefix, $select);
        } else {
            return get_records_select($this->shortprefix, $select);
        }
    }


    /**
     * Return the HTML to display a framework search form
     *
     * To get placeholder text to appear include the following in the source page:
     *
     * require_once($CFG->dirroot.'/local/js/lib/setup.php');
     * local_js(array(TOTARA_JS_PLACEHOLDER));
     *
     * @param string $query An existing query to populate the search box with
     * @param string $placeholdertext Placeholder text to appear when the box is empty (optional)
     *
     * @return string The HTML to print the form
     *
     */
    function display_search_box($query, $placeholdertext=null) {
        if(empty($placeholdertext)) {
            $placeholdertext = get_string('search');
        }
        $out = '';
        $out .= '<form id="hierarchy-search-form" action="" method="get">';
        $out .= '<input type="hidden" name="prefix" value="' . $this->prefix . '" />';
        $out .= '<input type="hidden" name="frameworkid" value="' . $this->frameworkid . '" />';
        $out .= '<input id="hierarchy-search-text-field" class="search-box" placeholder="' . $placeholdertext . '" type="text" name="query" value="' . stripslashes($query) . '" />';
        $out .= '<input type="submit" name="submit" value="' . get_string('go') . '" />';
        $out .= '</form>';

        return $out;
    }

    /**
     * Return the HTML to display a button for showing or hiding hierarchy item details
     *
     * @param integer $displaymode If the page is currently hiding custom fields (1) or showing them (0)
     * @param string $query Any active search query
     * @param integer $page Page number so we return to the same place
     *
     * @return string The HTML to display the button
     */
    function display_showhide_detail_button($displaymode, $query='', $page=0) {
        global $CFG;
        $newdisplaymode = ($displaymode) ? 0 : 1;
        $buttontext = ($displaymode) ? get_string('showdetails', 'hierarchy') :
            get_string('hidedetails', 'hierarchy');
        $params = array(
            'prefix' => $this->prefix,
            'frameworkid' => $this->frameworkid,
            'query' => $query,
            'page' => $page,
            'setdisplay' => $newdisplaymode,
        );
        return '<div class="showhide-button">' . print_single_button($CFG->wwwroot . '/hierarchy/index.php', $params,
            $buttontext, 'get', '_self', true). '</div>';

    }


    /**
     * Override in child class to add extra form elements in the add/edit form for items of
     * a particular prefix
     */
    function add_additional_item_form_fields(&$mform) {
        return;
    }



    /** Prints select box and Export button to export current report.
     *
     * A select is shown if the global settings allow exporting in
     * multiple formats. If only one format specified, prints a button.
     * If no formats are set in global settings, no export options are shown
     *
     * for this to work page must contain:
     * if($format!=''){$report->export_data($format);die;}
     * before header printed
     *
     * @return No return value but prints export select form
     */
    function export_select() {
        global $CFG;
        require_once($CFG->dirroot.'/hierarchy/export_form.php');
        $export = new hierarchy_export_form(qualified_me(), null, 'post', '', array('class' => 'hierarchy-export-form'));
        $export->display();
    }

    /**
     * Exports the data from the current results, maintaining
     * sort order and active filters but removing pagination
     *
     * @param string $format Format for the export ods/csv/xls
     * @return No return but initiates save dialog
     */
    function export_data($format) {
        global $CFG;

        $query = optional_param('query', '', PARAM_TEXT);
        $searchactive = (strlen(trim($query)) > 0);
        $framework   = $this->get_framework($this->frameworkid, true);
        $showcustomfields = ($framework->hidecustomfields != 1);

        $select = "SELECT hierarchy.id, hierarchy.fullname as hierarchyname, type.fullname as typename, hierarchy.depthlevel";
        $count = "SELECT COUNT(hierarchy.id)";
        $from   = " FROM {$CFG->prefix}{$this->shortprefix} hierarchy LEFT JOIN {$CFG->prefix}{$this->shortprefix}_type type ON hierarchy.typeid = type.id";
        $where  = " WHERE frameworkid={$this->frameworkid}";
        $order  = " ORDER BY sortthread";

        if ($searchactive) {
            $headings = array('hierarchyname' => get_string('name'), 'typename' => get_string('type','hierarchy'));
        } else {
            $headings = array('typename' => get_string('type', 'hierarchy'));
        }
        //Add custom field data to select only if customfields are being shown
        if ($showcustomfields) {
            if ($custom_fields = get_records($this->shortprefix.'_type_info_field')) {
                foreach ($custom_fields as $field) {
                    $headings["cf_{$field->id}"] = $field->fullname;
                    $select .= ", cf_{$field->id}.data as cf_{$field->id}";
                    $from .= " LEFT JOIN {$CFG->prefix}{$this->shortprefix}_type_info_data cf_{$field->id} ON hierarchy.id = cf_{$field->id}.{$this->prefix}id AND cf_{$field->id}.fieldid = {$field->id}";
                }
            }
        }

        // If search is active add search conditions to query
        if ($searchactive) {
            // extract quoted strings from query
            $keywords = local_search_parse_keywords($query);
            // match search terms against the following fields
            $dbfields = array('hierarchy.fullname', 'hierarchy.shortname', 'hierarchy.description', 'hierarchy.idnumber');
            // Make sure custom fields are being displayed before searching them
            if ($showcustomfields && is_array($custom_fields)) {
                foreach ($custom_fields as $cf) {
                    $dbfields[] = "cf_{$cf->id}.data";
                }
            }
            $where .= ' AND (' . local_search_get_keyword_where_clause($keywords, $dbfields). ')';
        }


        $shortname = $this->prefix;
        $sql = $select.$from.$where.$order;

        $maxdepth = get_field_sql("SELECT max(depthlevel) FROM {$CFG->prefix}{$this->shortprefix} WHERE frameworkid={$this->frameworkid}");

        // need to create flexible table object to get sort order
        // from session var
        $table = new flexible_table($shortname);

        switch($format) {
            case 'ods':
                $this->download_ods($headings, $sql, $maxdepth, null, $searchactive);
            case 'xls':
                $this->download_xls($headings, $sql, $maxdepth, null, $searchactive);
            case 'csv':
                $this->download_csv($headings, $sql, $maxdepth, null, $searchactive);
        }
        die;
    }


    /** Download current table in ODS format
     * @param array $fields Array of column headings
     * @param string $query SQL query to run to get results
     * @param integer $count Number of filtered records in query
     * @return Returns the ODS file
     */
    function download_ods($fields, $query, $maxdepth, $file=null, $searchactive=false) {
        global $CFG;
        require_once("$CFG->libdir/odslib.class.php");
        $shortname = $this->prefix;
        $filename = clean_filename($shortname.'_hierarchy.ods');

        if (!$file) {
            header("Content-Type: application/download\n");
            header("Content-Disposition: attachment; filename=$filename");
            header("Expires: 0");
            header("Cache-Control: must-revalidate,post-check=0,pre-check=0");
            header("Pragma: public");
        }

        if ($file) {
            $workbook = new MoodleODSWorkbook($file, true);
        }
        else{
            $workbook = new MoodleODSWorkbook('-');
            $workbook->send($filename);
        }

        $worksheet = array();

        $worksheet[0] =& $workbook->add_worksheet('');
        $row = 0;
        $col = 0;

        if (!$searchactive) {
            for ($depth = 1 ; $depth <= $maxdepth ; $depth++) {
                $worksheet[0]->write($row, $col, get_string('depth', 'hierarchy', $depth));
                $col++;
            }
        }

        foreach ($fields as $fieldid => $fieldname) {
            $worksheet[0]->write($row, $col, $fieldname);
            $col++;
        }
        $row++;

        $numfields = count($fields);

        //Use recordset to keep memory use down
        $data = get_recordset_sql($query);
        if ($data) {
            while ($datarow = rs_fetch_next_record($data)) {
                $curcol = 0;
                if(!$searchactive) {
                    $curcol = $maxdepth;
                    $worksheet[0]->write($row, $datarow->depthlevel-1, htmlspecialchars_decode($datarow->hierarchyname));
                }
                foreach ($fields as $fieldid => $fieldname) {
                    $worksheet[0]->write($row, $curcol++, htmlspecialchars_decode($datarow->$fieldid));
                }
                $row++;
            }
        }

        $workbook->close();
        if(!$file){
            die;
        }
    }


    /** Download current table in XLS format
     * @param array $fields Array of column headings
     * @param string $query SQL query to run to get results
     * @param integer $maxdepth Number of the deepest depth in this hierarchy
     * @return Returns the Excel file
     */
    function download_xls($fields, $query, $maxdepth, $file=null, $searchactive=false) {
        global $CFG;

        require_once("$CFG->libdir/excellib.class.php");

        $shortname = $this->prefix;
        $filename = clean_filename($shortname.'_report.xls');

        if (!$file) {
            header("Content-Type: application/download\n");
            header("Content-Disposition: attachment; filename=$filename");
            header("Expires: 0");
            header("Cache-Control: must-revalidate,post-check=0,pre-check=0");
            header("Pragma: public");

            $workbook = new MoodleExcelWorkbook('-');
            $workbook->send($filename);
        }
        else {
            $workbook = new MoodleExcelWorkbook($file);
        }

        $worksheet = array();

        $worksheet[0] =& $workbook->add_worksheet('');
        $row = 0;
        $col = 0;

        if (!$searchactive) {
            for ($depth = 1 ; $depth <= $maxdepth ; $depth++) {
                $worksheet[0]->write($row, $col, get_string('depth', 'hierarchy', $depth));
                $col++;
            }
        }

        foreach ($fields as $fieldname) {
            $worksheet[0]->write($row, $col, $fieldname);
            $col++;
        }
        $row++;

        $numfields = count($fields);

        //Use recordset to keep memory use down
        $data = get_recordset_sql($query);
        if ($data) {
            while ($datarow = rs_fetch_next_record($data)) {
                $curcol = 0;
                if (!$searchactive) {
                    $curcol = $maxdepth;
                    $worksheet[0]->write($row, $datarow->depthlevel-1, htmlspecialchars_decode($datarow->hierarchyname));
                }
                foreach ($fields as $fieldid => $fieldname) {
                    $worksheet[0]->write($row, $curcol++, htmlspecialchars_decode($datarow->$fieldid));
                }
                $row++;
            }
        }

        $workbook->close();
        if (!$file) {
            die;
        }
    }


    /** Download current table in CSV format
     * @param array $fields Array of column headings
     * @param string $query SQL query to run to get results
     * @param integer $maxdepth Number of the deepest depth in this hierarchy
     * @return Returns the CSV file
     */
    function download_csv($fields, $query, $maxdepth, $file=null, $searchactive=false) {
        global $CFG;
        $shortname = $this->prefix;
        $filename = clean_filename($shortname.'_report.csv');
        $csv = '';

        if (!$file) {
            header("Content-Type: application/download\n");
            header("Content-Disposition: attachment; filename=$filename");
            header("Expires: 0");
            header("Cache-Control: must-revalidate,post-check=0,pre-check=0");
            header("Pragma: public");
        }

        $delimiter = get_string('listsep');
        $encdelim  = '&#'.ord($delimiter).';';
        $row = array();

        if (!$searchactive) {
            $headers = array();
            for ($depth = 1 ; $depth <= $maxdepth ; $depth++) {
                $headers[] = get_string('depth', 'hierarchy' ,$depth);
            }
        }

        foreach ($fields as $fieldname) {
            $headers[] = str_replace($delimiter, $encdelim, $fieldname);
        }

        $csv .= implode($delimiter, $headers)."\n";

        //Use recordset to keep memory use down
        $data = get_recordset_sql($query);
        if ($data) {
            while ($datarow = rs_fetch_next_record($data)) {
                $row = array();
                if (!$searchactive) {
                    $depthstring = str_repeat(',', $datarow->depthlevel-1);
                    $depthstring .= str_replace($delimiter, $encdelim, $datarow->hierarchyname);
                    $depthstring .= str_repeat(',', $maxdepth - ($datarow->depthlevel - 1));
                }
                foreach ($fields as $fieldid => $fieldname) {
                    if ($fieldid == 'hierarchyname' && !$searchactive) {
                        continue;
                    } else if ($datarow->$fieldid) {
                        $row[] = htmlspecialchars_decode(str_replace($delimiter, $encdelim, $datarow->$fieldid));
                    } else {
                        $row[] = '';
                    }
                }
                if (!$searchactive) {
                    $csv .= $depthstring . implode($delimiter, $row)."\n";
                } else {
                    $csv .= implode($delimiter, $row)."\n";
                }
            }
        }

        if ($file) {
            $fp = fopen ($file, "w");
            fwrite($fp, $csv);
            fclose($fp);
        } else {
            echo $csv;
            die;
        }
    }


    /**
     * Returns various stats about an item, used for listed what will be deleted
     *
     * Overridden in child classes to add more specific info
     *
     * @param integer $id ID of the item to get stats for
     * @return array Associative array containing stats
     */
    public function get_item_stats($id) {

        // should always include at least one item (itself)
        if(!$children = $this->get_item_descendants($id)) {
            return false;
        }

        $data = array();

        $data['itemname'] = $children[$id]->fullname;

        // number of children (exclude item itself)
        $data['children'] = count($children) - 1;

        $ids = array_keys($children);

        // number of custom field data records
        $data['cf_data'] = count_records_select($this->shortprefix .
            '_type_info_data', sql_sequence($this->prefix.'id', $ids));

        return $data;
    }


    /**
     * Given some stats about an item, return a formatted delete message
     *
     * Overridden in child classes to add more specific info
     *
     * @param array $stats Associative array of item stats
     * @return string Formatted delete message
     */
    public function output_delete_message($stats) {
        $message = '';

        $a = new object();
        $a->childcount = $stats['children'];
        $a->children_string = $stats['children'] == 1 ? get_string('child', 'hierarchy') : get_string('children', 'hierarchy');

        if (isset($stats['itemcount'])) {
            $langstr = 'deletemulticheckwithchildren';
            $a->num = $stats['itemcount'];
        } else if ($stats['children'] > 0) {
            $langstr = 'deletecheckwithchildren';
            $a->itemname = $stats['itemname'];
        } else {
            $langstr = 'deletecheck';
            $a = $stats['itemname'];
        }
        $message .= get_string($langstr, $this->prefix, $a) . '<br />';

        if ($stats['cf_data'] > 0) {
            $message .= get_string('deleteincludexcustomfields', $this->prefix, $stats['cf_data']) . '<br />';
        }

        return $message;
    }


    /**
     * Returns a delete message to prompt the user when deleting one or more items
     *
     * @param integer|array ID or array of IDs to be deleted
     *
     * @return string Human-readable delete prompt text for the items given
     */
    public function get_delete_message($ids) {
        if (is_array($ids)) {
            // aggregate stats for multiple items
            $itemstats = array();
            foreach ($ids as $id) {
                $itemstats[] = $this->get_item_stats($id);
            }
            foreach ($itemstats as $item) {
                foreach ($item as $key => $value) {
                    if ($key == 'itemname') {
                        if (isset($stats['itemcount'])) {
                            $stats['itemcount'] += 1;
                        } else {
                            $stats['itemcount'] = 1;
                        }
                    } else {
                        if (isset($stats[$key])) {
                            $stats[$key] += $value;
                        } else {
                            $stats[$key] = $value;
                        }
                    }
                }
            }
        } else {
            // stats for a single item
            $stats = $this->get_item_stats($ids);
        }

        // output the stats
        return $this->output_delete_message($stats);
    }


    /**
     * Returns a move message to prompt the user when moving one or more items
     *
     * @param integer|array ID or array of IDs to be deleted
     *
     * @return string Human-readable move prompt text for the items given
     */
    public function get_move_message($ids, $parentid) {
        if (is_array($ids) && count($ids) != 1) {
            $itemstr = get_string($this->prefix.'plural', $this->prefix);
            $num = count($ids);
        } else {
            $itemstr = get_string($this->prefix, $this->prefix);
            $num = 1;
        }

        $parentname = ($parentid == 0) ? get_string('top', 'hierarchy') :
            format_string(get_field($this->shortprefix, 'fullname', 'id', $parentid));

        $a = new object();
        $a->num = $num;
        $a->items = strtolower($itemstr);
        $a->parentname = $parentname;

        return get_string('confirmmoveitems', 'hierarchy', $a);
    }


    /**
     * Returns a list of items where none of the items are children of any of the others
     *
     * In cases where $ids contains both a parent and a child, the parent is retained.
     *
     * This method will also remove any duplicate IDs
     *
     * @param array $ids Array of item IDs
     * @return array Array of item IDs
     */
    public function get_items_excluding_children($ids) {
        $out = array();
        $items = get_recordset_select($this->shortprefix, sql_sequence('id', $ids), 'id', 'id,depthlevel,path');
        if ($items) {
            // group records by their depthlevel
            $items_by_depth = totara_group_records($items, 'depthlevel');
            // sort ascending
            ksort($items_by_depth);

            $firstdepth = true;
            foreach ($items_by_depth as $depth => $items) {
                foreach ($items as $item) {
                    // add all the first level items without further checks
                    if ($firstdepth && !in_array($item->id, $out)) {
                        $out[] = $item->id;
                    }

                    // exclude any duplicates, or items who's parents are already added
                    if (!$this->is_child_of($item, $out) && !in_array($item->id, $out)) {
                        $out[] = $item->id;
                    }
                }
               $firstdepth = false;
            }
        }
        sort($out);
        return $out;
    }

    /**
     * Returns true if $item is a child of any of the item IDs given
     *
     * @param object $item An item object (must contain a path property)
     * @param integer|array $ids ID or array of IDs to check against the item
     *
     * @return boolean True if $item is a child of any of $ids
     */
    public function is_child_of($item, $ids) {
        if (!isset($item->path)) {
            return false;
        }

        $ids = (is_array($ids)) ? $ids : array($ids);

        $parents = explode('/', substr($item->path, 1));

        // remove the items ID
        $itemid = array_pop($parents);

        foreach ($parents as $parent) {
            if (in_array($parent, $ids)) {
                return true;
            }
        }
        return false;

    }

    /**
     * Generate a list of possible parents as an associative array
     *
     * The output is suitable for creating a pulldown for moving an item to a new
     * parent
     *
     * @param array $items An array of items, as produced by {@link get_items()}
     * @param integer|object $item The current item or its ID (optional)
     *                     If provided then the pulldown will exclude items that
     *                     the item can't be moved to (e.g. its own children)
     * @param boolean $inctop If true include the 'top' level (optional - default true)
     * @return array Returns an associative array of item names keyed on ID
     *               or an empty array if no items found
     */
    public function get_parent_list($items, $item = null, $inctop = true) {

        $out = array();

        // fetch the record if only an ID is provided
        if (isset($item) && is_int($item)) {
            $item = $this->get_item($item);
        }

        if ($inctop) {
            // Add 'top' as the first option
            $out[0] = get_string('top', 'hierarchy');
        }

        if (is_array($items)) {
            // Cache breadcrumbs
            $breadcrumbs = array();

            foreach ($items as $parent) {

                // An item cannot be its own parent
                if (isset($item) && $parent->id == $item->id) {
                    continue;
                }

                // An item cannot be moved inside one of its own children
                if (isset($item) && isset($item->path) && substr($parent->path, 0, strlen($item->path.'/')) == $item->path.'/') {
                    continue;
                }

                // Grab parents and append this title
                $breadcrumbs = array_slice($breadcrumbs, 0, ($parent->depthlevel - 1));
                $breadcrumbs[] = $parent->fullname;

                // Make display text
                $display = implode(' / ', $breadcrumbs);
                $out[$parent->id] = $display;
            }
        }

        return $out;
    }

    /**
     * Redirect old URLs to the correct page
     *
     * Prior to version 1.1, 'type' was used to reference the hierarchy subclass (e.g. 'competency', 'organisation')
     * This was changed to 'prefix' in 1.1 to be more consistent with usage in the class, and to free up 'type' to
     * refer to the type of item in a hierarchy.
     *
     * This method provides backward compatibility by looking for 'old' URLs and silently redirects them to the correct page
     *
     * It should be called at the top of any page which used to rely on ?type=[prefix] in the URL (after includes, but before
     * anything else)
     */
    static public function support_old_url_syntax() {
        $prefix = optional_param('prefix', null, PARAM_SAFEDIR);
        $type = optional_param('type', null, PARAM_SAFEDIR);

        // only redirect if type is set but prefix is not
        if (isset($type) && !isset($prefix)) {
            $murl = new moodle_url(qualified_me());
            $murl->remove_params('type');
            $murl->param('prefix', $type);

            $referrer = isset($_SERVER['HTTP_REFERRER']) ? $_SERVER['HTTP_REFERRER'] : 'none';
            error_log('Visit to ' . qualified_me() . ' redirected to ' . $murl->out() . ' referrer: ' . $referrer);

            redirect($murl->out());
        }
    }

    /*
     * Protected methods for manipulating item sortthreads
     */

    /**
     * Returns the next available sortthread for a new child of the item provided
     *
     * This will work for a parentid of 0 (e.g. new top level item), but the frameworkid
     * must be provided, either explicitly as the second argument or loaded into the hierarchy
     * via $this->get_framework()
     *
     * @param integer $parentid ID of the parent you want to create a new child for
     * @param integer $frameworkid ID of the parent's framework (optional, unless parentid == 0)
     *
     * @return string sortthread for a new child of $parentid or false if it couldn't be calculated
     *
     */
    protected function get_next_child_sortthread($parentid, $frameworkid = null) {
        global $CFG;
        // figure out the framework if not provided
        if (!isset($frameworkid)) {
            // try and use hierarchy's frameworkid, if not look it up based on parent
            if (isset($this->frameworkid)) {
                $frameworkid = $this->frameworkid;
            } else if ($parentid != 0) {
                if (!$frameworkid = get_field($this->shortprefix, 'frameworkid', 'id', $parentid)) {
                    // can't determine parent's framework
                    return false;
                }
            } else {
                // we can't work out the framework based on parentid for parentid=0
                return false;
            }
        }

        $maxthread = get_record_sql("
            SELECT MAX(sortthread) AS sortthread
            FROM {$CFG->prefix}{$this->shortprefix}
            WHERE parentid = {$parentid}
            AND frameworkid = {$frameworkid}");
        if (!$maxthread || strlen($maxthread->sortthread) == 0) {
            if ($parentid == 0) {
                // first top level item
                return totara_int2vancode(1);
            } else {
                // parent has no children yet
                return get_field($this->shortprefix, 'sortthread', 'id', $parentid, 'frameworkid', $frameworkid) . '.' . totara_int2vancode(1);
            }
        }
        return $this->increment_sortthread($maxthread->sortthread);

    }

    /**
     * Alter the sortthread of an item and all its children to point to a new location
     *
     * Required when moving or swapping hierarchy items
     *
     * As an example, given the items with sortthreads of:
     *
     * 1.2
     * 1.2.1
     * 1.2.1.1
     * 1.2.1.2
     * 1.2.2
     *
     * Running this:
     *
     * move_sortthread('1.2', '4.5.6', $fwid) would update them to:
     *
     * 4.5.6
     * 4.5.6.1
     * 4.5.6.1.1
     * 4.5.6.1.2
     * 4.5.6.2
     *
     * @param string $oldsortthread The sortthread of the item to move
     * @param string $newsortthread The new sortthread to apply to the item
     * @param integer $frameworkid The framework ID containing the items to move
     *
     * @return boolean True if the sortthreads were successfully updated
     */
    protected function move_sortthread($oldsortthread, $newsortthread, $frameworkid) {
        global $CFG;

        $length_sql = sql_length("'$oldsortthread'");
        $substr_sql = sql_substr() . "(sortthread, {$length_sql} + 1)";
        $sql = "UPDATE {$CFG->prefix}{$this->shortprefix}
            SET sortthread = " . sql_concat("'{$newsortthread}'", $substr_sql) . "
            WHERE frameworkid = {$frameworkid}
            AND sortthread='{$oldsortthread}' OR sortthread LIKE '{$oldsortthread}.%'";

        return execute_sql($sql, false);

    }


    /**
     * Swap the order of two hierarchy items (and all of their children)
     *
     * This is designed to swap two items with the same parent only, since no other changes
     * made to the structure of the hierarchy (e.g. depthlevel and parentid are unchanged).
     *
     * If you want to swap items at different levels, use {@link move_hierarchy_item()} instead
     *
     * Because of the way move_sortthread() is implemented, this method switches
     * one items sortthread to a temporary location. This is done with a transaction
     * to prevent data corruption - if the temporary state manages to get left over
     * then this function will stop functioning and return false
     *
     * @param integer $itemid1 The first item to swap
     * @param integer $itemid2 The second item to swap
     *
     * @return boolean True if sortthreads are successfully swapped
     */
    protected function swap_item_sortthreads($itemid1, $itemid2) {

        // get the item details
        if (!$items = get_records_select($this->shortprefix, "id IN ($itemid1, $itemid2)")) {
            return false;
        }

        // both items must exist
        if (!isset($items[$itemid1]) || !isset($items[$itemid2])) {
            return false;
        }

        // items must belong to the same framework and have the same parent
        if ($items[$itemid1]->frameworkid != $items[$itemid2]->frameworkid ||
            $items[$itemid1]->parentid != $items[$itemid2]->parentid) {
            return false;
        }

        $frameworkid = $items[$itemid1]->frameworkid;
        $sortthread1 = $items[$itemid1]->sortthread;
        $sortthread2 = $items[$itemid2]->sortthread;

        // this indicates that a swap failed half way through, which shouldn't happen
        // if transactions are used below
        if (record_exists_select($this->shortprefix,
            "frameworkid = $frameworkid AND sortthread LIKE '%swaptemp%'")) {

            return false;
        }

        begin_sql();
        $status = true;

        // need an placeholder when moving things round
        $status = $status && $this->move_sortthread($sortthread1, 'swaptemp', $frameworkid);
        $status = $status && $this->move_sortthread($sortthread2, $sortthread1, $frameworkid);
        $status = $status && $this->move_sortthread('swaptemp', $sortthread2, $frameworkid);

        if (!$status) {
            rollback_sql();
            return false;
        }

        commit_sql();
        return true;
    }


    /**
     * Increment the last section of a sortthread vancode
     *
     * Examples:
     * 01 -> 02
     * 01.01 -> 01.02
     * 04.03 -> 04.04
     * 01.02.03 -> 01.02.04
     *
     * @param string $sortthread The sort thread to increment
     * @param integer $inc Amount to increment by (default 1)
     *
     * @return boolean True if increment successful
     */
    protected function increment_sortthread($sortthread, $inc = 1) {
        if (!$lastdot = strrpos($sortthread, '.')) {
            // root level, just increment the whole thing
            return totara_increment_vancode($sortthread, $inc);
        }
        $start = substr($sortthread, 0, $lastdot + 1);
        $last = substr($sortthread, $lastdot + 1);

        // increment the last vancode in the sequence
        return $start . totara_increment_vancode($last, $inc);
    }

}

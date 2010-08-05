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
 * hierarchy/type/position/lib.php
 *
 * Library to construct position hierarchies
 * @copyright Catalyst IT Limited
 * @author Jonathan Newman
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package Totara
 */
require_once($CFG->dirroot.'/hierarchy/lib.php');


// DO NOT COMMENT OUT IF UNUSED
define('POSITION_TYPE_PRIMARY',         1);
define('POSITION_TYPE_SECONDARY',       2);
define('POSITION_TYPE_ASPIRATIONAL',    3);

// List available position types
// (Commented out unused types here)
$POSITION_TYPES = array(
    POSITION_TYPE_PRIMARY       => 'primary',
    POSITION_TYPE_SECONDARY     => 'secondary',
    POSITION_TYPE_ASPIRATIONAL  => 'aspirational'
);

$POSITION_CODES = array_flip($POSITION_TYPES);


/**
 * Oject that holds methods and attributes for position operations.
 * @abstract
 */
class position extends hierarchy {

    /**
     * The base table prefix for the class
     */
    var $prefix = 'position';
    var $shortprefix = 'pos';
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
            $CFG->wwwroot.'/local/js/position.item.js.php',
        ));
    }

    /**
     * Print any extra markup to display on the hierarchy view item page
     * @param $item object Position being viewed
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
        $addurl = $CFG->wwwroot.'/hierarchy/type/position/assigncompetency/find.php?assignto='.$item->id;
        $displaytitle = 'assignedcompetencies';
        $displaytype = 'competency';
        $displaydepth = true;
        require $CFG->dirroot.'/hierarchy/type/position/view-hierarchy-items.html';

        // Display assigned competencies
        $items = $this->get_assigned_competency_templates($item);
        $addurl = $CFG->wwwroot.'/hierarchy/type/position/assigncompetencytemplate/find.php?assignto='.$item->id;
        $displaytitle = 'assignedcompetencytemplates';
        $displaytype = 'competency';
        $displaydepth = false;
        require $CFG->dirroot.'/hierarchy/type/position/view-hierarchy-items.html';
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
                    pc.id AS aid
                FROM
                    {$CFG->prefix}pos_competencies pc
                INNER JOIN
                    {$CFG->prefix}comp c
                 ON pc.competencyid = c.id
                INNER JOIN
                    {$CFG->prefix}comp_framework cf
                 ON c.frameworkid = cf.id
                INNER JOIN
                    {$CFG->prefix}comp_depth cd
                 ON c.depthid = cd.id
                WHERE
                    pc.templateid IS NULL
                AND pc.positionid = {$itemid}
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
                    pc.id AS aid
                FROM
                    {$CFG->prefix}pos_competencies pc
                INNER JOIN
                    {$CFG->prefix}comp_template c
                 ON pc.templateid = c.id
                INNER JOIN
                    {$CFG->prefix}comp_framework cf
                 ON c.frameworkid = cf.id
                WHERE
                    pc.competencyid IS NULL
                AND pc.positionid = {$itemid}
            "
        );
    }

    /**
     * Returns array of positions assigned to a user,
     * indexed by assignment type
     *
     * @param   $user   object  User object
     * @return  array|false
     */
    function get_user_positions($user) {
        global $CFG;

        return get_records_sql(
            "
                SELECT
                    pa.type,
                    p.*
                FROM
                    {$CFG->prefix}pos p
                INNER JOIN
                    {$CFG->prefix}pos_assignment pa
                 ON p.id = pa.positionid
                WHERE
                    pa.userid = {$user->id}
                ORDER BY
                   pa.type ASC
            "
        );
    }

    /**
     * Return markup for user's assigned positions picker
     *
     * @param   $user       object  User object
     * @param   $selected   int     Id of currently selected position
     * @return  $html
     */
    function user_positions_picker($user, $selected) {
        global $POSITION_TYPES;

        // Get user's positions
        $positions = $this->get_user_positions($user);

        if (!$positions || count($positions) < 2) {
            return '';
        }

        // Format options
        $options = array();
        foreach ($positions as $type => $pos) {
            $text = get_string('type'.$POSITION_TYPES[$type], 'position').': '.$pos->fullname;
            $options[$pos->id] = $text;
        }

        return display_dialog_selector($options, $selected, 'simpleframeworkpicker');
    }

    /**
     * Delete a position and everything to do with it.
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

            // Null out the positionid column in these tables
            $result = $result && execute_sql(
                    'update '.$CFG->prefix . hierarchy::get_short_prefix('competency').'_evidence'
                        . ' set positionid = NULL'
                        . ' where positionid = ' . $id
                    ,false
            );
            $result = $result && execute_sql(
                    'update '.$CFG->prefix . 'course_completions'
                        . ' set positionid = NULL'
                        . ' where positionid = ' . $id
                    ,false
            );

            // Delete the records from these tables
            $result = $result && delete_records($this->shortprefix.'_assignment','positionid',$id);
            $result = $result && delete_records($this->shortprefix.'_assignment_history','positionid',$id);
            $result = $result && delete_records($this->shortprefix.'_competencies','positionid',$id);
            $result = $result && delete_records($this->shortprefix.'_relations','id1',$id);
            $result = $result && delete_records($this->shortprefix.'_relations','id2',$id);

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


/**
 * Position assignments
 */
class position_assignment extends data_object {

    /**
     * DB Table
     * @var string $table
     */
    public $table = 'pos_assignment';

    /**
     * Array of required table fields, must start with 'id'.
     * @var array $required_fields
     */
    public $required_fields = array(
        'id',
        'userid',
        'type',
        'fullname',
        'shortname',
        'description',
        'positionid',
        'organisationid',
        'managerid',
        'reportstoid',
        'timecreated',
        'timemodified',
        'usermodified',
        'timevalidfrom',
        'timevalidto'
    );

    public $userid;
    public $type;
    public $fullname;
    public $shortname;
    public $description;
    public $positionid;
    public $organisationid;
    public $managerid;
    public $reportstoid;
    public $timecreated;
    public $timemodified;
    public $usermodified;
    public $timevalidfrom;
    public $timevalidto;

    /**
     * Finds and returns a data_object instance based on params.
     * @static abstract
     *
     * @param array $params associative arrays varname=>value
     * @return object data_object instance or false if none found.
     */
    public function fetch($params) {
        return self::fetch_helper($this->table, get_class($this), $params);
    }

    public function save() {
        global $USER;

        // Get time (expensive on vservers)
        $time = time();

        $this->timecreated = $time;
        $this->timemodified = $time;
        $this->usermodified = $USER->id;

        if (!$this->fullname) {
            $this->fullname = '';
        }

        if (!$this->shortname) {
            $this->shortname = '';
        }

        if (!$this->positionid) {
            return false;
        }

        if (!$this->organisationid) {
            $this->organisationid = null;
        }

        if (!$this->reportstoid) {
            $this->reportstoid = null;
        }

        if (!$this->timevalidfrom) {
            $this->timevalidfrom = null;
        }

        if (!$this->timevalidto) {
            $this->timevalidto = null;
        }

        // Check if updating or inserting new
        if ($this->id) {
            $this->update();
        }
        else {
            $this->insert();
        }

        return true;
    }
}

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
 * hierarchy/prefix/position/lib.php
 *
 * Library to construct position hierarchies
 * @copyright Catalyst IT Limited
 * @author Jonathan Newman
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 */
require_once($CFG->dirroot.'/hierarchy/lib.php');
require_once($CFG->dirroot.'/local/utils.php');


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
            $CFG->wwwroot.'/local/js/position.item.js.php?id='.$item->id.'&frameworkid='.$item->frameworkid,
        ));
    }

    /**
     * Print any extra markup to display on the hierarchy view item page
     * @param $item object Position being viewed
     * @return void
     */
    function display_extra_view_info($item, $frameworkid=0) {
        global $CFG;

        $sitecontext = get_context_instance(CONTEXT_SYSTEM);
        $can_edit = has_capability('moodle/local:updateposition', $sitecontext);
        $comptype = optional_param('comptype', 'competencies', PARAM_TEXT);

        if ($can_edit) {
            $str_edit = get_string('edit');
            $str_remove = get_string('remove');
        }

        echo '<div class="list-assignedcompetencies">';
        print_heading(get_string('assignedcompetencies', 'competency'));

        echo $this->print_comp_framework_picker($item->id, $frameworkid);

        if ($comptype=='competencies') {
            // Display assigned competencies
            $items = $this->get_assigned_competencies($item, $frameworkid);
            $addurl = $CFG->wwwroot.'/hierarchy/prefix/position/assigncompetency/find.php?assignto='.$item->id;
            $displaytitle = 'assignedcompetencies';
            $displayprefix = 'competency';
        } elseif($comptype == 'comptemplates') {
            // Display assigned competencies
            $items = $this->get_assigned_competency_templates($item, $frameworkid);
            $addurl = $CFG->wwwroot.'/hierarchy/prefix/position/assigncompetencytemplate/find.php?assignto='.$item->id;
            $displaytitle = 'assignedcompetencytemplates';
        }
        $displayprefix = 'competency';
        require $CFG->dirroot.'/hierarchy/prefix/position/view-hierarchy-items.html';
        echo '</div>';
    }

    /**
     * Returns a list of competencies that are assigned to a position
     * @param $item object|int Position being viewed
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
                    pc.id AS aid
                FROM
                    {$CFG->prefix}pos_competencies pc
                INNER JOIN
                    {$CFG->prefix}comp c
                 ON pc.competencyid = c.id
                INNER JOIN
                    {$CFG->prefix}comp_framework cf
                 ON c.frameworkid = cf.id
                LEFT JOIN
                    {$CFG->prefix}comp_type ct
                 ON c.typeid = ct.id
                WHERE
                    pc.templateid IS NULL
                AND pc.positionid = {$itemid}";

        if (!empty($frameworkid)) {
            $sql .= " AND c.frameworkid = {$frameworkid}";
        }
        if (is_array($excluded_ids) && !empty($excluded_ids)) {
            $ids = implode(',', $excluded_ids);
            $sql .= " AND c.id NOT IN({$ids})";
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
                AND pc.positionid = {$itemid}";

        if (!empty($frameworkid)) {
            $sql .= " AND c.frameworkid = {$frameworkid}";
        }

        return get_records_sql($sql);
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
     * Delete all data associated with the positions
     *
     * This method is protected because it deletes the positions, but doesn't update the
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

        // nullify all references to these positions in comp_evidence table
        $sql = 'UPDATE ' . $CFG->prefix . hierarchy::get_short_prefix('competency') .
            "_evidence
            SET positionid = NULL
            WHERE positionid IN (" . implode(',', $items) . ')';
        if (!execute_sql($sql, false)) {
            return false;
        }

        // nullify all references to these positions in course_completions table
        $sql = "UPDATE {$CFG->prefix}course_completions
            SET positionid = NULL
            WHERE positionid IN (" . implode(',', $items). ')';
        if (!execute_sql($sql, false)) {
            return false;
        }

        // delete rows from all these other tables:
        $db_data = array(
            $this->shortprefix.'_assignment' => 'positionid',
            $this->shortprefix.'_assignment' => 'positionid',
            $this->shortprefix.'_assignment_history' => 'positionid',
            $this->shortprefix.'_competencies' => 'positionid',
            $this->shortprefix.'_relations' => 'id1',
            $this->shortprefix.'_relations' => 'id2',
        );
        foreach ($db_data as $table => $field) {
            $select = "$field IN (" . implode(',', $items) . ')';
            if (!delete_records_select($table, $select)) {
                return false;
            }
        }

        return true;

    }


    function print_comp_framework_picker($positionid, $currentfw) {
        global $CFG;

        $edit = optional_param('edit', 'off', PARAM_TEXT);

        $frameworks = get_records('comp_framework', '', '', 'sortorder');

        $assignedcounts = get_records_sql_menu("SELECT comp.frameworkid, COUNT(*)
                                                FROM {$CFG->prefix}pos_competencies poscomp
                                                INNER JOIN {$CFG->prefix}comp comp
                                                ON poscomp.competencyid=comp.id
                                                WHERE poscomp.positionid={$positionid}
                                                GROUP BY comp.frameworkid");

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
            popup_form($CFG->wwwroot.'/hierarchy/item/view.php?id='.$positionid.'&amp;edit='.$edit.'&amp;prefix=position&amp;framework=', $fwoptions, 'switchframework', $currentfw, '', '', '', false, 'self', get_string('filterframework', 'hierarchy'));
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
        if (!$children = $this->get_item_descendants($id)) {
            return false;
        }

        $ids = array_keys($children);

        // number of organisation assignment records
        $data['pos_assignment'] = count_records_select('pos_assignment',
            sql_sequence('positionid', $ids));

        // number of assigned competencies
        $data['assigned_comps'] = count_records_select('pos_competencies',
            sql_sequence('positionid', $ids));

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

        if ($stats['pos_assignment'] > 0) {
            $message .= get_string('deleteincludexposassignments', 'position', $stats['pos_assignment']) . '<br />';
        }

        if ($stats['assigned_comps'] > 0) {
            $message .= get_string('deleteincludexlinkedcompetencies', 'position', $stats['assigned_comps']). '<br />';
        }

        return $message;
    }
}  // class


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

    /**
     * Unique fields to be used in where clauses
     * when the ID is not known
     *
     * @access  public
     * @var     array       $unique fields
    */
    public $unique_fields = array('userid', 'type');

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
            $this->timecreated = $time;
            $this->insert();
        }

        return true;
    }
}

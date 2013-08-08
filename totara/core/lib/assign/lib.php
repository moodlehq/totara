<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2013 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Ciaran Irvine <ciaran.irvine@totaralms.com>
 * @package totara
 * @subpackage core
 */

/**
 * base assignment classes totara_assign_core and totara_assign_core_groups
 * will mostly be extended by child classes in each totara module, but is generic and functional
 * enough to still be useful for simple assignment cases
 *
 * Both expect at least one assign/groups/*.class.php grouping class to exist
 */
require_once($CFG->dirroot.'/totara/reportbuilder/lib.php');

class totara_assign_core {
    /**
     * Reference to the module.
     *
     * @access  public
     * @var     string
     */
    protected static $module = 'core';

    /**
     * Id of the module instance - appraisalid, programid, planid etc.
     *
     * @access  public
     * @var     int
     */
    protected $moduleinstanceid;

    /**
     * The actual module instance - appraisal, program, plan etc.
     *
     * @access  public
     * @var     object
     */
    protected $moduleinstance;

    /**
     * Basepath to the module assign directory where the modules assignment classes will live.
     *
     * @access  public
     * @var     string
     */
    protected $basepath;

    public function __construct($module, $moduleinstance) {
        global $CFG;
        $this->moduleinstanceid = $moduleinstance->id;
        $this->moduleinstance = $moduleinstance;
        self::$module = $module;
        $this->basepath = $CFG->dirroot . "/totara/{$module}/lib/assign/";
    }

    /**
     * Given a grouptype string, create an instance from the appropriate classfile.
     * Returns a grouptype object which can be used to manage assignedgroups of that type.
     * @access  public
     * @param string $grouptype
     * @return appropriate assignment grouptype object
     */
    public function load_grouptype($grouptype) {
        $module = self::$module;
        $classname = "totara_assign_{$module}_grouptype_{$grouptype}";
        $classfile = $this->basepath . "groups/{$grouptype}.class.php";

        // Check class file exists.
        if (!file_exists($classfile)) {
            print_error('error:assignmentprefixnotfound', 'totara_core', '', $grouptype);
        }

        // Load class file.
        require_once($classfile);

        // Check class exists.
        if (!class_exists($classname)) {
            print_error('error:assignmentprefixnotfound', 'totara_core', '', $grouptype);
        }

        // Instantiate and return an object of that class.
        return new $classname($this);
    }

    /**
     * Loop through code folder to find grouptype classes.
     * Override in child class to limit assignable grouptypes. // Todo ???
     *  e.g. return array('pos', 'org', 'cohort');
     * @access  public
     * @return  array of prefixes
     */
    public static function get_assignable_grouptypes() {
        global $CFG;

        static $grouptypes = array();
        if (!empty($grouptypes)) {
            return $grouptypes;
        }

        // Loop through code folder to find grouptype classes.
        $module = self::$module;
        // Loop through code folder to find group classes.
        $basepath = $CFG->dirroot . "/totara/{$module}/lib/assign/";
        if (is_dir($basepath . 'groups')) {
            $classfiles = glob($basepath . 'groups/*.class.php');
            if (is_array($classfiles)) {
                foreach ($classfiles as $filename) {
                    // Add them all to an array.
                    $grouptypes[] = str_replace('.class.php', '', basename($filename));
                }
            }
        }
        return $grouptypes;
    }

    /**
     * Get array of grouptype prefixes and displaynames
     * @access  public
     * @return  array('pos' => 'Position', 'org' => 'Organisation', 'cohort' => 'Audience')
     */
    public function get_assignable_grouptype_names() {
        $return = array();
        foreach (self::get_assignable_grouptypes() as $grouptype) {
            $grouptypeobj = self::load_grouptype($grouptype);
            $return[$grouptype] = $grouptypeobj->get_grouptype_displayname();
        }
        return $return;
    }

    /**
     * Delete an assigned group
     * @access  public
     * @param $grouptype string grouptype prefix e.g. 'org'
     * @param $deleteid int id of the actual assigned group record
     * @return void
     */
    public function delete_assigned_group($grouptype, $deleteid) {
        if (!in_array($grouptype, self::get_assignable_grouptypes())) {
            print_error('error:assigncannotdeletegrouptypex', 'totara_core', $grouptype);
        }
        if ($this->is_locked()) {
            print_error('error:assignmentmoduleinstancelocked', 'totara_core');
        }
        $grouptypeobj = self::load_grouptype($grouptype);
        $grouptypeobj->delete($deleteid);
    }

    /**
     * Delete all of this module's assigned groups and clear out user_assignment table
     * @access public
     * @return void
     */
    public function delete() {
        if ($this->is_locked()) {
            print_error('error:assignmentmoduleinstancelocked', 'totara_core');
        }

        // Clear module user assignment table
        $this->delete_user_assignments();

        // Delete each assigned group
        $assignedgroups = $this->get_current_assigned_groups();
        foreach ($assignedgroups as $assignedgroup) {
            $this->delete_assigned_group($assignedgroup->grouptype, $assignedgroup->assignedgroupid);
        }
    }

    /**
     * Delete records from the user_assignment table
     * @access public
     * @return void
     */
    public function delete_user_assignments() {
        global $DB;

        if ($this->is_locked()) {
            print_error('error:assignmentmoduleinstancelocked', 'totara_core');
        }

        // Clear module user assign table
        $tablename = self::$module . "_user_assignment";
        $modulekey = self::$module . "id";
        $moduleinstanceid = $this->moduleinstanceid;
        $DB->delete_records($tablename, array($modulekey => $moduleinstanceid));
    }

    /**
     * Query child classes to get back combined array of objects of all currently assigned groups.
     * Array should be passed to module renderer to do the actual display.
     * @access  public
     * @return array of objects
     */
    public function get_current_assigned_groups() {
        global $DB;

        $sqlallassignedgroups = '';
        foreach (self::get_assignable_grouptypes() as $grouptype) {
            // Instantiate a group object.
            $grouptypeobj = self::load_grouptype($grouptype);
            $groupunion = (empty($sqlallassignedgroups)) ? "" : " UNION ";
            $sqlallassignedgroups .= $groupunion . $grouptypeobj->get_current_assigned_groups_sql($this->moduleinstanceid);
        }
        $assignedgroups = $DB->get_records_sql($sqlallassignedgroups, array());

        foreach ($assignedgroups as $assignedgroup) {
            $grouptypeobj = self::load_grouptype($assignedgroup->grouptype);
            $includedids = $grouptypeobj->get_groupassignment_ids($assignedgroup->sourceid, $assignedgroup->includechildren);
            $assignedgroup->groupusers = $grouptypeobj->get_assigned_user_count($includedids);
        }
        return $assignedgroups;
    }

    /**
     * Get all users currently assigned, either from the user assignemt table (if saved) or else calculated from groups.
     * If not saved, query child classes to get back list of all users and how they are assigned - users may
     * turn up under multiple grouptypes and groups.
     * Searches through grouptype classes until item is active, then searches in module_user_assignment ????
     * @access public
     * @param $limitfrom int
     * @param $limitnum int
     * @param $search string
     * @param $count boolean return a count integer
     * @return array of objects or count int
     */
    public function get_current_users($limitfrom=null, $limitnum=null, $search=null, $count=false) {
        global $DB;

        $module = self::$module;
        $likeparam = '%' . $DB->sql_like_escape($search) . '%';

        $params = array();

        if ($this->assignments_are_stored()) {
            // Return stored assignments.

            // Select.
            if ($count) {
                $sql = "SELECT COUNT(ua.userid) AS count";
            } else {
                $sql = "SELECT u.id, u.firstname, u.lastname, ua.assignedvia";
            }

            // From.
            $sql .=  " FROM {{$module}_user_assignment} ua";
            if (!$count || !empty($search)) {
                $sql .= " INNER JOIN {user} u
                              ON u.id = ua.userid";
            }

            // Where.
            $sql .= " WHERE {$module}id = ?";

            // From, where.
            $params[] = $this->moduleinstanceid;
            if (!empty($search)) {
                $sql .= " AND (" . $DB->sql_like('u.firstname', '?', false, false) .
                        " OR " . $DB->sql_like('u.lastname', '?', false, false) . ")";
                $params[] = $likeparam;
                $params[] = $likeparam;
            }
        } else {
            // Query children for all users in currently assigned groups.
            $sqlallusers = '';
            $assignedgroups = $this->get_current_assigned_groups();

            // If there are no assigned groups then there can't be any assigned users.
            if (empty($assignedgroups)) {
                return ($count) ? 0 : array();
            }

            // Create a union select statement to get all users.
            foreach ($assignedgroups as $assignedgroup) {
                $grouptypeobj = self::load_grouptype($assignedgroup->grouptype);
                $includedids = $grouptypeobj->get_groupassignment_ids($assignedgroup->sourceid, $assignedgroup->includechildren);
                $usrunion = (empty($sqlallusers)) ? "" : " UNION";
                $sqlparts = $grouptypeobj->get_current_assigned_users_sql($assignedgroup->sourceid,
                        $includedids, $assignedgroup->includechildren, $search);
                $sqlallusers .= $usrunion . " " . $sqlparts['sql'];
                $params = array_merge($params, $sqlparts['params']);
            }

            // Select, from.
            if ($count) {
                $sql = "SELECT COUNT(DISTINCT(ua.userid)) AS count
                          FROM ({$sqlallusers}) ua";
            } else {
                $sql = "SELECT u.id, u.firstname, u.lastname, " . sql_group_concat('ua.assignedvia') . " AS assignedvia
                          FROM ({$sqlallusers}) ua";
            }
            if (!$count || !empty($search)) {
                $sql .= " JOIN {user} u
                            ON ua.userid = u.id";
            }

            // Where.
            if (!empty($search)) {
                $sql .= " WHERE (" . $DB->sql_like('u.firstname', '?', false, false) .
                        " OR " . $DB->sql_like('u.lastname', '?', false, false) . ")";
                $params[] = $likeparam;
                $params[] = $likeparam;
            }

            // Group by.
            $sql .= ($count) ? "" : " GROUP BY u.id, u.firstname, u.lastname";
        }

        // Order by.
        $sql .= ($count) ? "" : " ORDER BY u.firstname, u.lastname";

        // Execute.
        if ($count) {
            return $DB->count_records_sql($sql, $params);
        } else {
            return $DB->get_records_sql($sql, $params, $limitfrom, $limitnum);
        }
    }

    /**
     * Get the users according to the current state of the assigned groups and store to module_user_assignment
     * @access public
     * @return void
     */
    public function store_user_assignments() {
        global $DB;

        if ($this->is_locked()) {
            print_error('error:assignmentmoduleinstancelocked', 'totara_core');
        }

        $allusers = $this->get_current_users();

        // Users that appear in multiple assigned groups will appear multiple times - we only care about the first one.
        $datarows = array();
        $module = self::$module;
        $modulekey = "{$module}id";
        $moduleinstanceid = $this->moduleinstanceid;
        foreach ($allusers as $user) {
            $datarows[$user->id] = array($modulekey => $moduleinstanceid,
                                         'userid' => $user->id,
                                         'assignedvia' => $user->assignedvia);
        }

        // Clear out the user assignment table first to prevent duplicates.
        $tablename = "{$module}_user_assignment";
        $DB->delete_records($tablename, array($modulekey => $moduleinstanceid));

        // Save to user_assignment table.
        $this->bulk_insert_user_assignments($tablename, $datarows);
    }

    /**
     * Perform bulk inserts into specified table
     * @param string $table table name
     * @param array $datarows an array of row arrays
     * @return boolean
     */
    private function bulk_insert_user_assignments($table, $datarows) {
        global $DB;

        if (empty($datarows)) {
            return true;
        }

        $length = 1000;
        $chunked_datarows = array_chunk($datarows, $length);

        unset($datarows);

        foreach ($chunked_datarows as $key => $chunk) {
            $sql = "INSERT INTO {{$table}} ("
                . implode(',', array_keys($chunk[0]))
                . ') VALUES ';

            $all_values= array();
            $sql_rows = array();
            foreach ($chunk as $row) {
                $sql_rows[]= "(". str_repeat("?,", (count(array_keys($chunk[0])) - 1)) ."?)";
                $all_values = array_merge($all_values, array_values($row));
            }
            unset($row);
            $sql .= implode(',', $sql_rows);
            unset ($sql_rows);

            // Execute insert SQL.
            if (!$DB->execute($sql, array_values($all_values))) {
                return false;
            }
            unset ($sql);
            unset($all_values);
            unset($chunked_datarows[$key]);
            unset($chunk);
        }

        unset($chunked_datarows);

        return true;
    }

    /**
     * Duplicate the assign onto the new moduleinstance.
     * @param $newmoduleinstance object The module instance to assign the new assign to.
     */
    public function duplicate($targetmoduleinstance) {
        // Find the class of this instance (may be subclassed).
        $mymoduleinstanceclass = get_class($this);

        /* Note: There's no need to load the subclass file now as it must have been loaded to call
         * the subclass's duplicate method. */

        // Create a new instance of the same class, calling the subclass's contructor (if defined).
        /* Note: If the subclass has a constructor that requires more parameters than just a module
         * type and an assign instance then the subclass must also subclass duplicate. */
        $newassign = new $mymoduleinstanceclass(self::$module, $targetmoduleinstance);

        // Iterate over each group.
        $assignedgroups = $this->get_current_assigned_groups();
        foreach ($assignedgroups as $assignedgroup) {
            $grouptypeobj = self::load_grouptype($assignedgroup->grouptype);
            $grouptypeobj->duplicate($assignedgroup, $newassign);
        }
    }

    /**
     * Get functions to return class properties
     * @access  public
     * @return mixed
     */
    public function get_assign_module() {
        return self::$module;
    }

    public function get_assign_moduleinstanceid() {
        return $this->moduleinstanceid;
    }

    public function get_assign_moduleinstance() {
        return $this->moduleinstance;
    }

    /**
     * Can optionally be implemented by children.
     * Prevents add and remove when locked.
     */
    public function is_locked() {
        return false;
    }

    /**
     * Should be overridden by subclasses to determine if the users have been stored in the module's user_assignment table.
     *
     * @return bool whether or not users have been stored in the user_assignments table.
     */
    public function assignments_are_stored() {
        return false;
    }

}


abstract class totara_assign_core_grouptype {

    // The module class object.
    protected $assignment;

    protected $params = array(
        'equal' => 0,
        'includechildren' => 0,
        'listofvalues' => 1,
    );

    abstract public function generate_item_selector($hidden=array(), $groupinstanceid=false);
    abstract public function handle_item_selector($data);

    public function __construct($assignobject) {
        // Store the whole assignment object from totara_assign or child class of totara_assign.
        $this->assignment = $assignobject;
    }

    public function validate_item_selector() {
        // Over-ride in child classes that need to perform validation on submitted dialog info.
        return true;
    }

    /**
     * Loads and returns the child assignment class object
     * @param object $assignobject base assignment class
     * @return object child class
     */
    public static function load_grouptype($assignobject) {
        $classname = "totara_assign_{$assignobject->module}_group_{$assignobject->grouptype}";
        // Check group class file exists.
        $classfile = $assignobject->basepath . "groups/{$assignobject->grouptype}.class.php";
        if (!file_exists($classfile)) {
            print_error('error:assignmentprefixnotfound', 'totara_core', '', $assignobject->grouptype);
        }
        // Load class file.
        require_once($classfile);
        // Check class exists.
        if (!class_exists($classname)) {
            print_error('error:assignmentprefixnotfound', 'totara_core', '', $assignobject->grouptype);
        }
        // Instantiate and return an object of that class.
        return new $classname($assignobject);
    }

    /**
     * Stub function to be implemented by children.
     * @return object child class
     */
    public function get_current_assigned_groups() {
        return array();
    }

    /**
     * Stub function to be implemented by children.
     */
    public function duplicate($assignedgroup, $newassign) {
    }
}

require_once($CFG->dirroot.'/totara/core/dialogs/dialog_content_hierarchy.class.php');
require_once($CFG->dirroot.'/totara/hierarchy/lib.php');

/**
 * Cohort multi-picker dialog class.
 */

class totara_assign_ui_picker_cohort extends totara_dialog_content {
    public $handlertype = 'treeview';
    public $params = array(
        'equal' => 1,
        'listofvalues' => 1,
        'includechildren' => 0
    );

    /**
     * Helper function to override the parameter defaults
     * @param   $newparams    array parameters to be overridden
     * @return  void
     */
    public function set_parameters($newparams = array()) {
        if (!is_array($newparams)) {
            print_error('error:assignmentbadparameters', 'totara_core', null, null);
            die();
        }
        foreach ($newparams as $key => $val) {
            $this->params[$key] = $val;
        }
    }

    /**
     * Returns markup to be used in the selected pane of a multi-select dialog
     *
     * @param   $elements    array elements to be created in the pane
     * @return  $html
     */
    public function populate_selected_items_pane($elements) {
        $html = '';
        return $html .= parent::populate_selected_items_pane($elements);
    }

    /**
     * Generates the content of the dialog
     * @param   $hidden array of extra hidden parameters
     * @param   $selectedids Items that have already been selected to be grayed out in the picker
     * @return  void
     */
    public function generate_item_selector($hidden = array(), $selectedids = array()) {
        global $DB;

        // Show search tab instead of browse.
        $search = optional_param('search', false, PARAM_BOOL); // TODO is this needed?

        // Get cohorts.
        $sql = "SELECT c.id,
                CASE WHEN c.idnumber IS NULL OR c.idnumber = '' OR c.idnumber = '0'
                    THEN c.name
                    ELSE " . $DB->sql_concat("c.name", "' ('", "c.idnumber", "')'") .
                "END AS fullname
            FROM {cohort} c
            ORDER BY c.name, c.idnumber";
        $items = $DB->get_records_sql($sql, array());

        // Set up dialog.
        $dialog = $this;
        if (!empty($hidden)) {
            $this->set_parameters($hidden);
        }
        $dialog->type = totara_dialog_content::TYPE_CHOICE_MULTI;
        $dialog->items = $items;
        $dialog->selected_title = 'itemstoadd';
        $dialog->searchtype = 'cohort';

        $alreadyselected = array();
        if (!empty($selectedids)) {
            list($insql, $inparams) = $DB->get_in_or_equal($selectedids);
            $sql = "SELECT c.id, c.name
                  FROM {cohort} c
                 WHERE c.id $insql";
            $alreadyselected = $DB->get_records_sql($sql, $inparams);
        }

        $dialog->disabled_items = $alreadyselected;
        $dialog->unremovable_items = $alreadyselected;
        $dialog->urlparams = $this->params;
        // Display.
        $markup = $dialog->generate_markup();
        echo $markup;
    }

    /**
     * Duplicate the group onto the new assign.
     */
    public function duplicate($newassign) {
        // Find the class of this instance (may be subclassed).
        $mygroupclass = get_class($this);

        // Create a new instance of the same class, calling the subclass's contructor (if defined).
        /* If the subclass has a constructor that requires more parameters than just an assign
         * instance then the subclass must also subclass duplicate. */
        new $mygroupclass($newassign);
    }

}

/**
 * Hierarchy multi-picker dialog class.
 */
class totara_assign_ui_picker_hierarchy extends totara_dialog_content_hierarchy_multi {
    public $params = array(
        'equal' => 0,
        'includechildren' => 0,
        'listofvalues' => 1,
    );
    public $handlertype = 'treeview';
    public $prefix;
    public $shortprefix;

    public function __construct($prefix, $frameworkid = 0, $showhidden = false) {
        $this->prefix = $prefix;
        $this->shortprefix = hierarchy::get_short_prefix($prefix);
        parent::__construct($this->prefix, $frameworkid, $showhidden);
    }

    /**
     * Helper function to override the parameter defaults
     * @param   $newparams    array parameters to be overridden
     * @return  void
     */
    public function set_parameters($newparams = array()) {
        if (!is_array($newparams)) {
            print_error('error:assignmentbadparameters', 'totara_core', null, null);
            die();
        }
        foreach ($newparams as $key => $val) {
            $this->params[$key] = $val;
        }
    }

    /**
     * Returns markup to be used in the selected pane of a multi-select dialog
     *
     * @param   $elements    array elements to be created in the pane
     * @return  $html
     */
    public function populate_selected_items_pane($elements, $overridden = false) {

        if (!$overridden) {
            $childmenu = array();
            $childmenu[0] = get_string('includechildrenno', 'totara_cohort');
            $childmenu[1] = get_string('includechildrenyes', 'totara_cohort');
            $selected = isset($this->params['includechildren']) ? $this->params['includechildren'] : '';
            $html = html_writer::select($childmenu, 'includechildren', $selected, array(),
                array('id' => 'id_includechildren', 'class' => 'assigngrouptreeviewsubmitfield'));
        } else {
            $html = '';
        }

        return $html . parent::populate_selected_items_pane($elements);
    }

    /**
     * Generates the content of the dialog
     * @param   $hidden array of extra hidden parameters
     * @param   $selectedids Items that have already been selected to be grayed out in the picker
     * @return  void
     */
    public function generate_item_selector($hidden = array(), $selectedids = array()) {
        global $DB;
        // TODO unused variables.

        // Parent id.
        $parentid = optional_param('parentid', 0, PARAM_INT);

        // Framework id.
        $frameworkid = optional_param('frameworkid', 0, PARAM_INT);

        // Only return generated tree html.
        $treeonly = optional_param('treeonly', false, PARAM_BOOL);

        // Should we show hidden frameworks?
        $showhidden = optional_param('showhidden', false, PARAM_BOOL);

        // Show search tab instead of browse.
        $search = optional_param('search', false, PARAM_BOOL);

        // Setup page.
        $hierarchy = $this->shortprefix;
        $alreadyselected = array();
        if (!empty($selectedids)) {
            list($insql, $inparams) = $DB->get_in_or_equal($selectedids);
            $sql = "SELECT hier.id, hier.fullname
                  FROM {{$hierarchy}} hier
                 WHERE hier.id $insql";
            $alreadyselected = $DB->get_records_sql($sql, $inparams);
        }

        // Load dialog content generator.
        $dialog = $this;

        // Toggle treeview only display.
        $dialog->show_treeview_only = $treeonly;

        // Load items to display.
        $dialog->load_items($parentid);

        if (!empty($hidden)) {
            $dialog->urlparams = $hidden;
        }

        // Set disabled/selected items.
        $dialog->disabled_items = $alreadyselected;
        if (isset($this->includechildren)) {
            $dialog->includechildren = $this->includechildren;
        }

        // Set title.
        $dialog->select_title = '';
        $dialog->selected_title = '';

        // Display.
        $markup = $dialog->generate_markup();
        // Hack to get around the hack that prevents deleting items via dialogs.
        $hackedmarkup = str_replace('<td class="selected" ', '<td class="selected selected-shown" ', $markup);
        echo $hackedmarkup;
    }
}

/**
 * Initialises Javascript for dialogs and (optionally) a paginated datatable
 * @param   $module string The Totara module
 * @param   $itemid int id of the object the dialogs will be assigning groups to
 * @param   $datatable boolean Whether to start up the Javascript for a datatable
 * @return  void
 */
function totara_setup_assigndialogs($module, $itemid, $datatable = false) {
    global $CFG, $PAGE;
    // Setup custom javascript.
    $jselements = array(
        TOTARA_JS_DIALOG,
        TOTARA_JS_TREEVIEW,
        TOTARA_JS_UI);
    if ($datatable) {
        $jselements[] = TOTARA_JS_DATATABLES;
    }
    local_js(
        $jselements
    );
    $PAGE->requires->strings_for_js(array('assigngroup'), 'totara_' . $module);
    $jsmodule = array(
        'name' => 'totara_assigngroups',
        'fullpath' => '/totara/core/lib/assign/assigngroup_dialog.js',
        'requires' => array('json'));
    $args = array('args' => '{"module":"'.$module.'","sesskey":"'.sesskey().'"}');
    $PAGE->requires->js_init_call('M.totara_assigngroupdialog.init', $args, false, $jsmodule);

    if ($datatable) {
        $PAGE->requires->js_init_code('
                $(document).ready(function() {
                    var oTable = $("#datatable").dataTable( {
                    "bProcessing": true,
                    "bServerSide": true,
                    "sPaginationType": "full_numbers",
                    "sAjaxSource": "'.$CFG->wwwroot.'/totara/'.$module.'/lib/assign/ajax.php",
                    "fnServerParams": function ( aoData ) {
                            aoData.push( { "name": "module", "value": "'.$module.'" } );
                            aoData.push( { "name": "itemid", "value": "'.$itemid.'" } );
                    },
                    "oLanguage" : {
                        "sEmptyTable":     "'.get_string('datatable:sEmptyTable', 'totara_core').'",
                        "sInfo":           "'.get_string('datatable:sInfo', 'totara_core').'",
                        "sInfoEmpty":      "'.get_string('datatable:sInfoEmpty', 'totara_core').'",
                        "sInfoFiltered":   "'.get_string('datatable:sInfoFiltered', 'totara_core').'",
                        "sInfoPostFix":    "'.get_string('datatable:sInfoPostFix', 'totara_core').'",
                        "sInfoThousands":  "'.get_string('datatable:sInfoThousands', 'totara_core').'",
                        "sLengthMenu":     "'.get_string('datatable:sLengthMenu', 'totara_core').'",
                        "sLoadingRecords": "'.get_string('datatable:sLoadingRecords', 'totara_core').'",
                        "sProcessing":     "'.get_string('datatable:sProcessing', 'totara_core').'",
                        "sSearch":         "'.get_string('datatable:sSearch', 'totara_core').'",
                        "sZeroRecords":    "'.get_string('datatable:sZeroRecords', 'totara_core').'",
                        "oPaginate": {
                            "sFirst":    "'.get_string('datatable:oPaginate:sFirst', 'totara_core').'",
                            "sLast":     "'.get_string('datatable:oPaginate:sLast', 'totara_core').'",
                            "sNext":     "'.get_string('datatable:oPaginate:sNext', 'totara_core').'",
                            "sPrevious": "'.get_string('datatable:oPaginate:sPrevious', 'totara_core').'"
                        }
                    }
                } );
                oTable.fnSetFilteringDelay(3000);
            });
        ');
    }
}

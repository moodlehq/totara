<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
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
 * @author Jake Salmon <jake.salmon@kineo.com>
 * @package totara
 * @subpackage management
 */


require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot.'/local/dialogs/dialog_content.class.php');

class totara_dialog_content_manager extends totara_dialog_content {

    /**
     * If you are making access checks seperately, you can disable
     * the internal checks by setting this to true
     *
     * @access  public
     * @var     boolean
     */
    public $skip_access_checks = true;


    /**
     * Enable search tab content
     *
     * @access  public
     * @var     bool
     */
    public $search_code = false;


    /**
     * Construct
     */
    public function __construct() {

        // Make some capability checks
        if (!$this->skip_access_checks) {
            require_login();
            //require_capability("moodle/local:view{$type}", get_system_context());
        }

    $this->type = self::TYPE_CHOICE_MULTI;
    }

    /**
     * Load hierarchy items to display
     *
     * @access  public
     * @param   $parentid   int
     */
    public function load_items($parentid) {
        $this->items = $this->get_items_by_parent($parentid);

        // If we are loading non-root nodes, tell the dialog_content class not to
        // return markup for the whole dialog
        if ($parentid > 0) {
            $this->show_treeview_only = true;
        }

        // Also fill parents array
        $this->parent_items = $this->get_all_parents();
    }


    /**
     * Should we show the treeview root?
     *
     * @access  protected
     * @return  boolean
     */
    protected function _show_treeview_root() {
        return !$this->show_treeview_only;
    }

    /**
     * Generate search interface for hierarchy search
     *
     * @access  public
     * @return  string
     */
    public function generate_search_interface() {
        global $CFG;

        return 'Search not implemented';
    }



    function get_items() {
        return get_records('manager', '', '', 'sortorder, id');
    }

    /**
     * Get items in a framework by parent
     * @param int $parentid
     * @return array|false
     */
    function get_items_by_parent($parentid=false) {
        global $CFG;

        if ($parentid) {
            // Parentid supplied, do not specify frameworkid as
            // sometimes it is not set correctly. And a parentid
            // is enough to get the right results
        //return get_records('manager', 'parentid', $parentid, 'sortorder, id');
        return get_records_sql("
        SELECT u.id, " . sql_fullname() . " as fullname
        FROM {$CFG->prefix}manager m
        INNER JOIN {$CFG->prefix}user u on u.id = m.userid
        WHERE m.parentid = $parentid
        ORDER BY sortorder, id
        ");
        }
        else {
            // If no parentid, grab the root node of this framework
            return $this->get_all_root_items();
        }
    }


    function get_all_root_items($all=false) {
        global $CFG;

        //return get_records('manager', 'parentid', 0, 'sortorder, id');
        return get_records_sql("
            SELECT u.id, " . sql_fullname() . " as fullname
            FROM {$CFG->prefix}manager m
            INNER JOIN {$CFG->prefix}user u on u.id = m.userid
            WHERE m.parentid = 0
            ORDER BY sortorder, id
            ");
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

        //$parents = get_records_select('manager', 'parentid != 0', 'sortorder, id');
        $parents = get_records_sql("
            SELECT DISTINCT
            parentid AS id
            FROM {$CFG->prefix}manager
            WHERE parentid != 0
            ");

        if($parents) {
            return $parents;
        } else {
            return array();
        }
    }
}


function local_management_install() {
    global $CFG;

    set_config('local_management_cron', 60);

    return true;
}

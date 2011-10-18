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
require_once($CFG->dirroot.'/hierarchy/prefix/position/lib.php');

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
        global $CFG;
        $primarytype = POSITION_TYPE_PRIMARY;
        return get_records_sql("
            SELECT DISTINCT pa.managerid AS sortorder, pa.managerid AS id, u.lastname
            FROM {$CFG->prefix}pos_assignment pa
            LEFT JOIN {$CFG->prefix}user u
            ON pa.managerid = u.id
            WHERE pa.type = {$primarytype}
            ORDER BY u.lastname"
        );
    }

    /**
     * Get items in a framework by parent
     * @param int $parentid
     * @return array|false
     */
    function get_items_by_parent($parentid=false) {
        global $CFG;

        if ($parentid) {
            $primarytype = POSITION_TYPE_PRIMARY;
            // returns users who *are* managers, who's manager is user $parentid
            return get_records_sql("
                SELECT u.id, " . sql_fullname() . " as fullname
                FROM (
                    SELECT DISTINCT managerid AS id
                    FROM {$CFG->prefix}pos_assignment
                    WHERE type = $primarytype
                ) managers
                INNER JOIN {$CFG->prefix}pos_assignment pa on managers.id = pa.userid
                INNER JOIN {$CFG->prefix}user u on u.id = pa.userid
                WHERE pa.managerid = $parentid
                AND pa.type = $primarytype
                ORDER BY u.lastname, u.id
            ");
        }
        else {
            // If no parentid, grab the root node of this framework
            return $this->get_all_root_items();
        }
    }


    function get_all_root_items($all=false) {
        global $CFG;

        $primarytype = POSITION_TYPE_PRIMARY;
        // returns users who *are* managers, but don't *have* a manager
        return get_records_sql("
            SELECT u.id, " . sql_fullname() . " as fullname
            FROM (
                SELECT DISTINCT managerid AS id
                FROM {$CFG->prefix}pos_assignment
                WHERE type = $primarytype
            ) managers
            INNER JOIN {$CFG->prefix}pos_assignment pa on managers.id = pa.userid
            INNER JOIN {$CFG->prefix}user u on u.id = pa.userid
            WHERE pa.managerid IS NULL OR pa.managerid = 0
            AND pa.type = $primarytype
            ORDER BY u.lastname, u.id
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
        $primarytype = POSITION_TYPE_PRIMARY;

        // returns users who *are* managers, who also have staff who *are* managers
        $parents = get_records_sql("
            SELECT DISTINCT managers.id
            FROM (
                SELECT DISTINCT managerid AS id
                FROM {$CFG->prefix}pos_assignment
                WHERE type = $primarytype
            ) managers
            INNER JOIN {$CFG->prefix}pos_assignment staff on managers.id = staff.managerid
            INNER JOIN {$CFG->prefix}pos_assignment pa ON staff.userid = pa.managerid AND pa.type = 1
            ");

        if ($parents) {
            return $parents;
        } else {
            return array();
        }
    }
}

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
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage totara_core/dialogs
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/totara/core/dialogs/dialog_content.class.php');
require_once($CFG->dirroot.'/totara/hierarchy/lib.php');

class totara_dialog_content_goals extends totara_dialog_content {

    /**
     * Hierarchy object instance
     *
     * @access  public
     * @var     object
     */
    public $hierarchy;

    /**
     * Supplied framework id, not necessarily the one used however
     *
     * @access  public
     * @var     object
     */
    public $frameworkid;

    /**
     * Flag to disable learning plan picker
     *
     * @access  public
     * @var     boolean
     */
    public $display_picker = true;

    /**
     * If you are making access checks seperately, you can disable
     * the internal checks by setting this to true
     *
     * @access  public
     * @var     boolean
     */
    public $skip_access_checks = false;

    /**
     * Switching frameworks
     *
     * @access  public
     * @var     boolean
     */
    public $switch_frameworks = false;

    /**
     * Show hidden frameworks
     *
     * @access public
     * @var    boolean
     */
    public $showhidden = false;


    public function __construct($frameworkid = -1, $showhidden = false) {

        // Make some capability checks
        if (!$this->skip_access_checks) {
            require_login();
            require_capability("totara/plan:accessplan", context_system::instance());
        }

        // Save supplied frameworkid
        $this->frameworkid = $frameworkid;

        // Load hierarchy instance
        $this->hierarchy = hierarchy::load_hierarchy('goal');

        $this->type = self::TYPE_CHOICE_MULTI;

        // Set lang file
        $this->lang_file = 'totara_hierarchy';
        $this->string_nothingtodisplay = "goalerror:dialognotreeitems";

        // Load framework
        $this->set_framework($frameworkid);

        // Check if switching frameworks
        $this->switch_frameworks = optional_param('switchframework', false, PARAM_BOOL);
    }


    /**
     * Set framework hierarchy
     *
     * @access  public
     * @param   $frameworkid    int
     */
    public function set_framework($frameworkid) {
        if ($frameworkid >= 0) {
            $this->framework = $this->hierarchy->get_framework($frameworkid, $this->showhidden, true);
        } else {
            $this->framework = null;
        }
    }


    /**
     * Load plan items to display
     *
     * @access  public
     * @param   $parentid   int
     */
    public function load_items() {
        global $DB, $USER;

        $parentid = 0;

        if ($this->framework) {
            /*$sql = 'SELECT g.id, g.fullname FROM {goal_user_assignment} gua
                JOIN {goal} g ON
                gua.goalid = g.id
                WHERE
                gua.userid = ?';*/

            $this->items = $this->hierarchy->get_items_by_parent($parentid);

            // If we are loading non-root nodes, tell the dialog_content class not to
            // return markup for the whole dialog
            if ($parentid > 0) {
                $this->show_treeview_only = true;
            }

            // Also fill parents array
            $this->parent_items = $this->hierarchy->get_all_parents();
        } else {
            $items = array();

            // Personal goals
            $items = $DB->get_records_sql('SELECT id, name as fullname FROM {goal_personal} WHERE userid = ?', array($USER->id));

            // Put prefix infront of personal goal to distinguish between them
            // and company goals
            foreach ($items as $item) {
                $item->id = 'personal_' . $item->id;
            }

            $this->items = $items;
        }
    }


    protected function _prepend_markup() {
        global $DB, $USER;

        if (!$this->display_picker) {
            return '';
        }

        $hierarchy = hierarchy::load_hierarchy('goal');

        $goal_frameworks = $hierarchy->get_frameworks();

        $select_options = array();
        $select_options[-1] = get_string('personalgoals', 'totara_hierarchy');

        foreach ($goal_frameworks as $id => $framework) {
            $select_options[$id] = $framework->fullname;
        }

        return display_dialog_selector($select_options, '-1', 'simpleframeworkpicker');
    }


    /**
     * Should we show the treeview root?
     *
     * @access  protected
     * @return  boolean
     */
    protected function _show_treeview_root() {
        return !$this->show_treeview_only || $this->switch_frameworks;
    }
}

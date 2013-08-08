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
require_once($CFG->dirroot.'/totara/plan/development_plan.class.php');

class totara_dialog_content_plan extends totara_dialog_content {
    public $planid;

    public $plan;

    public $type;

    public $userid;

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
     * Show hidden frameworks
     *
     * @access public
     * @var    boolean
     */
    public $showhidden = false;



    public function __construct($component, $planid = 0, $showhidden = false, $userid = 0) {

        // Make some capability checks
        if (!$this->skip_access_checks) {
            require_login();
            require_capability("totara/plan:accessplan", context_system::instance());
        }

        // Save supplied planid
        $this->planid = $planid;

        $this->userid = $userid;

        $this->component = $component;

        $this->type = self::TYPE_CHOICE_MULTI;

        // Set lang file
        $this->lang_file = 'totara_hierarchy';
        $this->string_nothingtodisplay = "error:dialognotreeitems";

        // Load plan
        $this->set_plan($planid);

        if (empty($this->plan)) {
            echo '<p>' . get_string('noplansavailable', 'totara_plan') . '</p>';
            die();
        }

        // Check if switching frameworks
        $this->switch_plans = optional_param('switchplan', false, PARAM_BOOL);
    }


    /**
     * Set framework hierarchy
     *
     * @access  public
     * @param   $frameworkid    int
     */
    public function set_plan($planid) {
        $this->plan = new development_plan($planid);
    }


    /**
     * Load plan items to display
     *
     * @access  public
     * @param   $parentid   int
     */
    public function load_items() {
        $this->items = $this->plan->get_component($this->component)->get_assigned_items();
    }


    /**
     * Prepend custom markup before treeview
     *
     * @access  protected
     * @return  string
     */
    protected function _prepend_markup() {
        global $DB, $USER;

        if (!$this->display_picker) {
            return '';
        }

        $userid = isset($this->userid) ? $this->userid : $USER->id;

        list($sql, $params) = $DB->get_in_or_equal(array(DP_PLAN_STATUS_APPROVED, DP_PLAN_STATUS_COMPLETE));
        $params[] = $userid;
        $plans = $DB->get_records_select_menu('dp_plan', 'status ' . $sql . 'AND userid = ?', $params, '', 'id,name');

        return display_dialog_selector($plans, '', 'planselector');
    }


    /**
     * Should we show the treeview root?
     *
     * @access  protected
     * @return  boolean
     */
    protected function _show_treeview_root() {
        return !$this->show_treeview_only || $this->switch_plans;
    }
}

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

require_once($CFG->dirroot.'/totara/core/dialogs/dialog_content_plan.class.php');
require_once($CFG->dirroot.'/totara/plan/development_plan.class.php');

class totara_dialog_content_plan_evidence extends totara_dialog_content_plan {

    public function __construct($component, $planid = 0, $showhidden = false) {

        // Make some capability checks
        if (!$this->skip_access_checks) {
            require_login();
            require_capability("totara/plan:accessplan", context_system::instance());
        }

        // Save supplied planid
        $this->planid = $planid;

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
     * Load plan items to display
     *
     * @access  public
     * @param   $parentid   int
     */
    public function load_items() {
        global $DB;

        $sql = 'SELECT pe.id, pe.name FROM {dp_plan_evidence} pe
                JOIN {dp_plan_evidence_relation} per ON
                    pe.id = per.evidenceid
                WHERE per.planid = ?';

        $this->items = $DB->get_records_sql($sql, array($this->plan->id));
    }
}

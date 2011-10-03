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
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage plan
 */

require_once("{$CFG->libdir}/formslib.php");
require_once("{$CFG->dirroot}/local/plan/development_plan.class.php");

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

class plan_reactivate_form extends moodleform {
    function definition() {
        global $CFG, $USER;

        $mform =& $this->_form;

        if (isset($this->_customdata['plan'])) {
            $plan = $this->_customdata['plan'];
        }

        $planid = $this->_customdata['id'];
        $plan = new development_plan($planid);

        $mform->addElement('hidden', 'id', $planid);
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'reactivate', true);
        $mform->setType('reactivate', PARAM_BOOL);
        $mform->addElement('hidden', 'sesskey', sesskey());
        $mform->setType('sesskey', PARAM_ALPHA);
        $mform->addElement('hidden', 'confirm', true);
        $mform->setType('confim', PARAM_BOOL);
        $mform->addElement('hidden', 'referer', $this->_customdata['referer']);
        $mform->setType('referer', PARAM_LOCALURL);


        $sql = "SELECT * FROM {$CFG->prefix}dp_plan_history WHERE planid={$planid} ORDER BY timemodified DESC";
        if (!$history = get_record_sql($sql, true)) {
            error(get_string('error:planhistory', 'local_plan'));
        }

        $mform->addElement('static', 'reactivatecheck', null, get_string('checkplanreactivate', 'local_plan', $plan->name));

        if ($history->reason == DP_PLAN_REASON_AUTO_COMPLETE_DATE) {
            $mform->addElement('hidden', 'validate_date', true);

            $mform->addElement('static', 'instructions', null, 'This plan was completed because the end date elapsed, please enter a new end date.');

            $mform->addElement('text', 'enddate', get_string('completiondate', 'local_plan'));
            $mform->addRule('enddate', get_string('err_required', 'form'), 'required', '', 'client', false, false);
            $mform->setDefault('enddate', userdate(time(), '%d/%m/%Y', $CFG->timezone, false));
        }

        $this->add_action_buttons(true, get_string('reactivate', 'local_plan'));
    }

    function validation($data) {
        $mform =& $this->_form;
        $result = array();

        if (!empty($data['validate_date'])) {
            // Validate date
            $datenow = time();
            $enddate = isset($data['enddate']) ? $data['enddate'] : '';

            $datepattern = '/^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[0-2])\/(\d{4})$/';
            if (preg_match($datepattern, $enddate, $matches) == 0) {
                $errstr = get_string('error:dateformat','local_plan');
                $result['enddate'] = $errstr;
                unset($errstr);
            } elseif ($datenow > dp_convert_userdate($enddate) && $enddate !== false ) {
                // Enforce start date before finish date
                $errstr = get_string('error:reactivatedatebeforenow','local_plan');
                $result['enddate'] = $errstr;
                unset($errstr);
            }
        }

        return $result;
    }
}

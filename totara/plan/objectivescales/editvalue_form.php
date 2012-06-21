<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2012 Totara Learning Solutions LTD
 * Copyright (C) 1999 onwards Martin Dougiamas
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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage plan
 */

require_once($CFG->dirroot.'/lib/formslib.php');

class dp_objective_scale_value_edit_form extends moodleform {

    // Define the form
    function definition() {
        global $TEXTAREA_OPTIONS;

        $mform =& $this->_form;
        $scaleid = $this->_customdata['scaleid'];
        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'objscaleid');
        $mform->setType('objscaleid', PARAM_INT);
        $mform->addElement('hidden', 'sortorder');
        $mform->setType('sortorder', PARAM_INT);

        /// Print the required moodle fields first
        $mform->addElement('header', 'moodle', get_string('general'));

        $mform->addElement('static', 'scalename', get_string('objectivescale', 'totara_plan'));
        $mform->addHelpButton('scalename', 'objectivescaleassign', 'totara_plan', '', true);

        $mform->addElement('text', 'name', get_string('objectivescalevaluename', 'totara_plan'), 'maxlength="100" size="20"');
        $mform->addHelpButton('name', 'objectivescalevaluename', 'totara_plan', '', true);
        $mform->addRule('name', get_string('missingobjectivescalevaluename', 'totara_plan'), 'required', null, 'client');
        $mform->setType('name', PARAM_MULTILANG);

        $mform->addElement('text', 'idnumber', get_string('objectivescalevalueidnumber', 'totara_plan'), 'maxlength="100"  size="10"');
        $mform->addHelpButton('idnumber', 'objectivescalevalueidnumber', 'totara_plan', '', true);
        $mform->setType('idnumber', PARAM_RAW);

        $mform->addElement('text', 'numericscore', get_string('objectivescalevaluenumeric', 'totara_plan'), 'maxlength="100"  size="10"');
        $mform->addHelpButton('numericscore', 'objectivescalevaluenumeric', 'totara_plan', '', true);
        $mform->setType('numericscore', PARAM_RAW);

        $note = (dp_objective_scale_is_used($scaleid)) ? html_writer::tag('span', get_string('achievedvaluefrozen', 'totara_plan'), array('class' => "notifyproblem")) : '';
        $mform->addElement('advcheckbox', 'achieved', get_string('achieved', 'totara_plan'), $note);
        $mform->addHelpButton('achieved', 'objectivescalevalueachieved', 'totara_plan', '', true);
        if (dp_objective_scale_is_used($scaleid)) {
            $mform->hardFreeze('achieved');
        }

        $mform->addElement('editor', 'description_editor', get_string('description'), null, $TEXTAREA_OPTIONS);
        $mform->setType('description_editor', PARAM_RAW);

        $this->add_action_buttons();
    }

    function validation($valuenew) {

        $err = array();
        $valuenew = (object)$valuenew;

        // Check the numericscore field was either empty or a number
        if (strlen($valuenew->numericscore)) {
            // Is a number
            if (is_numeric($valuenew->numericscore)) {
                $valuenew->numericscore = (float)$valuenew->numericscore;
            } else {
                $err['numericscore'] = get_string('invalidnumeric', 'totara_plan');
                return $err;
            }
        } else {
            $valuenew->numericscore = null;
        }

        return true;
    }
}

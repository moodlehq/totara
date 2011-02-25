<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
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
 * @author Alastair Munro <alastair@catalyst.net.nz>
 * @package totara
 * @subpackage plan 
 */

require_once($CFG->dirroot.'/lib/formslib.php');

class dp_priority_scale_value_edit_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;

        $mform =& $this->_form;

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'priorityscaleid');
        $mform->setType('priorityscaleid', PARAM_INT);
        $mform->addElement('hidden', 'sortorder');
        $mform->setType('sortorder', PARAM_INT);

        /// Print the required moodle fields first
        $mform->addElement('header', 'moodle', get_string('general'));

        $mform->addElement('static', 'scalename', get_string('priorityscale', 'local_plan'));
        $mform->setHelpButton('scalename', array('priorityscaleassign', get_string('priorityscale', 'local_plan'), 'local_plan'), true);

        $mform->addElement('text', 'name', get_string('priorityscalevaluename', 'local_plan'), 'maxlength="100" size="20"');
        $mform->setHelpButton('name', array('priorityscalevaluename', get_string('priorityscalevaluename', 'local_plan'), 'local_plan'), true);
        $mform->addRule('name', get_string('missingpriorityscalevaluename', 'local_plan'), 'required', null, 'client');
        $mform->setType('name', PARAM_MULTILANG);

        $mform->addElement('text', 'idnumber', get_string('priorityscalevalueidnumber', 'local_plan'), 'maxlength="100"  size="10"');
        $mform->setHelpButton('idnumber', array('priorityscalevalueidnumber', get_string('priorityscalevalueidnumber', 'local_plan'), 'local_plan'), true);
        $mform->setType('idnumber', PARAM_RAW);

        $mform->addElement('text', 'numericscore', get_string('priorityscalevaluenumericalvalue', 'local_plan'), 'maxlength="100"  size="10"');
        $mform->setHelpButton('numericscore', array('priorityscalevaluenumeric', get_string('priorityscalevaluenumericalvalue', 'local_plan'), 'local_plan'), true);
        $mform->setType('numericscore', PARAM_RAW);

        $mform->addElement('htmleditor', 'description', get_string('description'));
        $mform->setHelpButton('description', array('text', get_string('helptext')), true);
        $mform->setType('description', PARAM_RAW);

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
                $err['numericscore'] = get_string('invalidnumeric', 'local_plan');
                return $err;
            }
        } else {
            $valuenew->numericscore = null;
        }

        return true;
    }
}

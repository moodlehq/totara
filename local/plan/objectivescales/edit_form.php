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

require_once $CFG->libdir.'/formslib.php';

class edit_objective_form extends moodleform {
    function definition() {
        global $CFG;
        $mform =& $this->_form;

        // visible elements
        $mform->addElement('header', 'general', get_string('objective', 'local_plan'));

        $mform->addElement('text', 'name', get_string('name'), 'size="40"');
        $mform->setHelpButton('name', array('objectivescalename', get_string('name'), 'local_plan'));
        $mform->addRule('name', get_string('required'), 'required', null, 'client');
        $mform->setType('name', PARAM_TEXT);

        // If it's a new objective, give them the option to define objective values.
        if ( $this->_customdata['objectiveid'] == 0 ){
            $mform->addElement('static', 'objectivevaluesexplain', '', get_string('explainobjscalevals', 'local_plan'));
            $mform->addElement('textarea', 'objectivevalues', get_string('objectivevalues', 'local_plan'), 'rows="5" cols="30"');
            $mform->setHelpButton('objectivevalues', array('objectivescalevalues', get_string('objective', 'local_plan'), 'local_plan'));
            $mform->setType('objectivevalues', PARAM_TEXT);
        } else {
            $mform->addELement('html', '<div class="fitem"><div class="fitemtitle">&nbsp;</div><div class="felement">'.get_string('linktoobjectivevalues','local_plan',clean_param($this->_customdata['objectiveid'], PARAM_INT))."</div></div>\n");
        }

        $mform->addElement('htmleditor', 'description', get_string('description'));

        // hidden params
        $mform->addElement('hidden', 'id', 0);
        $mform->setType('id', PARAM_INT);

//-------------------------------------------------------------------------------
        // buttons
        $this->add_action_buttons();
    }
}

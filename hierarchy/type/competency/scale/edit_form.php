<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


require_once $CFG->libdir.'/formslib.php';

class edit_scale_form extends moodleform {
    function definition() {
        global $CFG;
        $mform =& $this->_form;

        // visible elements
        $mform->addElement('header', 'general', get_string('scale'));

        $mform->addElement('text', 'name', get_string('name'), 'size="40"');
        $mform->setHelpButton('name', array('competency/scale/scalename', get_string('name')));
        $mform->addRule('name', get_string('required'), 'required', null, 'client');
        $mform->setType('name', PARAM_TEXT);

        // If it's a new scale, give them the option to define scale values.
        if ( $this->_customdata['scaleid'] == 0 ){
            $mform->addElement('textarea', 'scalevalues', 'Scale values');
            $mform->setHelpButton('scalevalues', array('competency/scale/scalevalues', get_string('scale')));
            $mform->setType('scalevalues', PARAM_TEXT);
        } else {
            $mform->addELement('html', '<div class="fitem"><div class="fitemtitle">&nbsp;</div><div class="felement">'.get_string('linktoscalevalues','competency',clean_param($this->_customdata['scaleid'], PARAM_INT))."</div></div>\n");
        }

        $mform->addElement('htmleditor', 'description', get_string('description'));

        // hidden params
        $mform->addElement('hidden', 'id', 0);
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'type', 'competency');
        $mform->setType('type', PARAM_TEXT);

//-------------------------------------------------------------------------------
        // buttons
        $this->add_action_buttons();
    }
}

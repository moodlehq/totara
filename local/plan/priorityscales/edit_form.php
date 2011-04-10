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

class edit_priority_form extends moodleform {
    function definition() {
        global $CFG;
        $mform =& $this->_form;

        // visible elements
        $mform->addElement('header', 'general', get_string('priority', 'local_plan'));

        $mform->addElement('text', 'name', get_string('name'), 'size="40"');
        $mform->setHelpButton('name', array('priorityscalename', get_string('name'), 'local_plan'));
        $mform->addRule('name', get_string('required'), 'required', null, 'client');
        $mform->setType('name', PARAM_TEXT);

        // If it's a new priority, give them the option to define priority values.
        if ( $this->_customdata['priorityid'] == 0 ){
            $mform->addElement('static', 'priorityvaluesexplain', '', get_string('explainpriorityscalevals', 'local_plan'));
            $mform->addElement('textarea', 'priorityvalues', get_string('priorityvalues', 'local_plan'), 'rows="5" cols="30"');
            $mform->addRule('priorityvalues', get_string('required'), 'required', null, 'server');
            $mform->setHelpButton('priorityvalues', array('priorityscalevalues', get_string('priority', 'local_plan'), 'local_plan'));
            $mform->setType('priorityvalues', PARAM_TEXT);
        } else {
            $mform->addElement('html', '<div class="fitem"><div class="fitemtitle">&nbsp;</div><div class="felement">'.get_string('linktopriorityvalues','local_plan',clean_param($this->_customdata['priorityid'], PARAM_INT))."</div></div>\n");
        }

        $mform->addElement('htmleditor', 'description', get_string('description'));

        // hidden params
        $mform->addElement('hidden', 'id', 0);
        $mform->setType('id', PARAM_INT);

//-------------------------------------------------------------------------------
        // buttons
        $this->add_action_buttons();
    }


    function validation($valuenew) {
        $err = array();
        $valuenew = (object) $valuenew;

        // make sure at least one priority scale value is defined
        if(isset($valuenew->priorityvalues) && trim($valuenew->priorityvalues) == '') {
            $err['priorityvalues'] = get_string('required');
        }

        if(count($err) > 0) {
            return $err;
        }

        return true;
    }

}

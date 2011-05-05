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
 * @author Piers Harding <piers@catalyst.net.nz>
 * @package totara
 * @subpackage totara_msg 
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/lib/formslib.php');

class totara_msg_settings_form extends moodleform {

    // Define the form
    function definition () {
        global $CFG, $COURSE, $POSITION_TYPES;

        $mform =& $this->_form;
        $userid = $this->_customdata['user'];

        // Add some extra hidden fields
        $mform->addElement('hidden', 'id', $userid);
        $mform->setType('id', PARAM_INT);

        $mform->addElement('header', 'general', get_string('emailnotifications', 'local_totara_msg'));

        $mform->addElement('advcheckbox', 'totara_msg_send_alrt_emails', get_string('sendalertemails', 'local_totara_msg'));
        $mform->setType('totara_msg_send_alrt_emails', PARAM_BOOL);

        $mform->addElement('advcheckbox', 'totara_msg_send_task_emails', get_string('sendtaskemails', 'local_totara_msg'));
        $mform->setType('totara_msg_send_task_emails', PARAM_BOOL);

        $renderer =& $mform->defaultRenderer();
        $elementtemplate = '<div><span class="emailnotifycheckbox">{element}</span><label>{label}</label></div>';
        $renderer->setElementTemplate($elementtemplate, 'totara_msg_send_alrt_emails');
        $renderer->setElementTemplate($elementtemplate, 'totara_msg_send_task_emails');

        $mform->addElement('html', '<br />');

        $mform->addElement('submit', 'submitbutton', get_string('update'));
        $renderer->setElementTemplate($elementtemplate, 'submitbutton');
    }
}

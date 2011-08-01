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
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage program
 */

require_once("{$CFG->libdir}/formslib.php");
require_once($CFG->dirroot.'/local/icon/program_icon.class.php');

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

class program_edit_form extends moodleform {

    function definition() {
        global $CFG, $USER;

        $mform =& $this->_form;
        $action = $this->_customdata['action'];
        $category = $this->_customdata['category'];

        if (isset($this->_customdata['program'])) {
            $program = $this->_customdata['program'];
        } else {
            $program = false;
        }

        $systemcontext = get_context_instance(CONTEXT_SYSTEM);
        $categorycontext = get_context_instance(CONTEXT_COURSECAT, $category->id);

        if($program) {
            $programcontext = get_context_instance(CONTEXT_PROGRAM, $program->id);
        }

        // Add some hidden fields
        if ($action != 'add') {
            $mform->addElement('hidden', 'id');
            $mform->setType('id', PARAM_INT);
        }

        $mform->addElement('hidden', 'action', $action);
        $mform->setType('action', PARAM_TEXT);

        if ($action == 'delete') {
            // Only show delete confirmation
            $mform->addElement('html', get_string('checkprogramdelete', 'local_program', $program->fullname));
            $buttonarray = array();
            $buttonarray[] = $mform->createElement('submit', 'deleteyes', get_string('yes'));
            $buttonarray[] = $mform->createElement('submit', 'deleteno', get_string('no'));
            $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
            $mform->closeHeaderBefore('buttonar');

            return;
        }

/// form definition with new program defaults
//--------------------------------------------------------------------------------
        $mform->addElement('header','programdetails', get_string('programdetails', 'local_program'));

        $mform->addElement('html', '<p class="instructions">'.get_string('instructions:programdetails', 'local_program').'<p>');

        // Must have create program capability in both categories in order to move program
        if (has_capability('local/program:createprogram', $categorycontext)) {
            $displaylist = array();
            $parentlist = array();
            make_categories_list($displaylist, $parentlist, 'local/program:createprogram');
            $mform->addElement('select', 'category', get_string('category', 'local_program'), $displaylist);
            $mform->setType('category', PARAM_INT);
        } else {
            $mform->addElement('hidden', 'category', null);
            $mform->setType('category', PARAM_INT);
        }

        if ($action=='view') {
            $mform->hardFreeze('category');
        } else if ($program and !has_capability('moodle/course:changecategory', $categorycontext)) {
        // Use the course permissions to decide if a user can change a program's category (as programs are treated like courses in this respect)
            $mform->hardFreeze('category');
            $mform->setConstant('category', $category->id);
        } else {
            $mform->setHelpButton('category', array('programcategory', get_string('category', 'local_program'), 'local_program'));
            $mform->setDefault('category', $category->id);
        }

        if ($action=='view') {
        $mform->addElement('static', 'visibledisplay', get_string('visible', 'local_program'), $program->visible ? get_string('yes') : get_string('no'));
        } else {
            $mform->addElement('advcheckbox','visible', get_string('visible', 'local_program'), null, null, array(0,1));
            $mform->setHelpButton('visible', array('programvisibility', get_string('visible', 'local_program'), 'local_program'), true);
            $mform->setDefault('visible', true);
            $mform->setType('visible', PARAM_BOOL);
        }

        $mform->addElement('text','fullname', get_string('fullname', 'local_program'),'maxlength="254" size="50"');
        if ($action=='view') {
            $mform->hardFreeze('fullname');
        } else {
            $mform->setHelpButton('fullname', array('programfullname', get_string('fullname', 'local_program'), 'local_program'), true);
            $mform->setDefault('fullname', get_string('defaultprogramfullname', 'local_program'));
            $mform->addRule('fullname', get_string('missingfullname'), 'required', null, 'client');
            $mform->setType('fullname', PARAM_MULTILANG);
        }

        $mform->addElement('text','shortname', get_string('shortname', 'local_program'),'maxlength="100" size="20"');
        if ($action=='view') {
            $mform->hardFreeze('shortname');
        } else {
            $mform->setHelpButton('shortname', array('programshortname', get_string('shortname', 'local_program'), 'local_program'), true);
            $mform->setDefault('shortname', get_string('defaultprogramshortname', 'local_program'));
            $mform->addRule('shortname', get_string('missingshortname', 'local_program'), 'required', null, 'client');
            $mform->setType('shortname', PARAM_MULTILANG);
        }

        $mform->addElement('text','idnumber', get_string('idnumberprogram', 'local_program'),'maxlength="100"  size="10"');
        if ($action=='view') {
            $mform->hardFreeze('idnumber');
        } else {
            $mform->setHelpButton('idnumber', array('programidnumber', get_string('idnumberprogram', 'local_program'), 'local_program'), true);
            $mform->setType('idnumber', PARAM_MULTILANG);
        }

        $availabilityoptions = array(
            AVAILABILITY_TO_STUDENTS => get_string('availabletostudents', 'local_program'),
            AVAILABILITY_NOT_TO_STUDENTS => get_string('availabletostudentsnot', 'local_program'),
        );
        $mform->addElement('select', 'availablerole', get_string('availability', 'local_program'), $availabilityoptions);
        if ($action=='view') {
            $mform->hardFreeze('availablerole');
        } else {
            $mform->setHelpButton('availablerole', array('programavailability', get_string('availability', 'local_program'), 'local_program'), true);
            $mform->setDefault('availablerole', AVAILABILITY_TO_STUDENTS);
            $mform->setType('availablerole', PARAM_INT);
        }

        $mform->addElement('text', 'availablefromselector', get_string('availablefrom', 'local_program'));
        if ($action=='view') {
            $mform->hardFreeze('availablefromselector');
        } else {
            $mform->setHelpButton('availablefromselector', array('programavailability', get_string('availablefrom', 'local_program'), 'local_program'), true);
            $mform->setType('availablefromselector', PARAM_MULTILANG);
        }

        $mform->addElement('hidden', 'availablefrom');
        $mform->setType('availablefrom', PARAM_INT);

        $mform->addElement('text', 'availableuntilselector', get_string('availableuntil', 'local_program'));
        if ($action=='view') {
            $mform->hardFreeze('availableuntilselector');
        } else {
            $mform->setHelpButton('availableuntilselector', array('programavailability', get_string('availableuntil', 'local_program'), 'local_program'), true);
            $mform->setType('availableuntilselector', PARAM_MULTILANG);
        }

        $mform->addElement('hidden', 'availableuntil');
        $mform->setType('availableuntil', PARAM_INT);

        $mform->addElement('htmleditor','summary', get_string('description', 'local_program'), array('rows'=> '10', 'cols'=>'65'));
        if ($action=='view') {
            $mform->hardFreeze('summary');
        } else {
            $mform->setHelpButton('summary', array('text', get_string('helptext')), true);
            $mform->setType('summary', PARAM_CLEAN);
        }

        $mform->addElement('htmleditor','endnote', get_string('endnote', 'local_program'), array('rows'=> '10', 'cols'=>'65'));
        if ($action=='view') {
            $mform->hardFreeze('endnote');
        } else {
            $mform->setHelpButton('endnote', array('text', get_string('helptext')), true);
            $mform->setType('endnote', PARAM_CLEAN);
        }

        $program_icon = new program_icon();

        $mform->addElement('header', 'iconheader', get_string('programicon', 'local_program'));
        if ($action=='add' || $action=='edit') {
            // Program Icons
            $program_icon->add_to_form($program, $mform);
            // END Program Icons
        } else if ($action=='view') {
            $mform->addElement('static', 'currenticon', get_string('currenticon', 'local_program'), $program_icon->display($program));
        }

        if($action == 'add') {
            $buttonarray = array();
            $buttonarray[] = $mform->createElement('submit', 'savechanges', get_string('savechanges'), 'class="savechanges-overview program-savechanges"');
            $buttonarray[] = $mform->createElement('cancel', 'cancel', get_string('cancel', 'local_program'), 'class="cancel"');
            $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
            $mform->closeHeaderBefore('buttonar');
        } else if($action == 'edit') {
            $buttonarray = array();
            $buttonarray[] = $mform->createElement('submit', 'savechanges', get_string('savechanges'), 'class="savechanges-overview program-savechanges"');
            $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
            $mform->closeHeaderBefore('buttonar');
        } else {
            $buttonarray = array();
            $buttonarray[] = $mform->createElement('submit', 'edit', get_string('editprogramdetails', 'local_program'));
            $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
            $mform->closeHeaderBefore('buttonar');
        }

    }

    function validation($data, $files) {

        $mform = $this->_form;
        $errors = array();

        if (isset($data['availablefromselector'])) {
            $availablefrom = $data['availablefromselector'];
            if ( ! empty($availablefrom) && ! prog_date_to_time($availablefrom)) {
                $errors['availablefromselector'] = get_string('error:invaliddate', 'local_program');
            }
        }

        if (isset($data['availableuntilselector'])) {
            $availableuntil = $data['availableuntilselector'];
            if ( ! empty($availableuntil) &&  ! prog_date_to_time($availableuntil)) {
                $errors['availableuntilselector'] = get_string('error:invaliddate', 'local_program');
            }
        }

        if (isset($availablefrom) && isset($availableuntil)) {
            if ($availablefrom > $availableuntil) {
                $errors['availableuntilselector'] = get_string('error:availibileuntilearlierthanfrom', 'local_program');
            }
        }

        return $errors;
    }

}

// Define a form class to display the program content in a non-editable form
class program_content_nonedit_form extends moodleform {

    function definition() {
        global $CFG, $USER;

        $mform =& $this->_form;

        $program = $this->_customdata['program'];
        $content = $program->get_content();
        $coursesets = $content->get_course_sets();

/// form definition
//--------------------------------------------------------------------------------

       $mform->addElement('header','programcontent', get_string('programcontent', 'local_program'));

       if(count($coursesets)) {
            foreach($coursesets as $courseset) {

                $elementname = $courseset->get_set_prefix();
                $formlabel = $courseset->display_form_label();
                $formelement = $courseset->display_form_element();

                $mform->addElement('static', $elementname, $formlabel, $formelement);

            }
        } else {
            $mform->addElement('static', 'progcontent', '', get_string('noprogramcontent', 'local_program'));
        }

	// Get the total time allowed for this program
	$total_time_allowed = $content->get_total_time_allowance();

        // Only display the time allowance if it is greater than zero
        if ($total_time_allowed > 0) {
            // Break the time allowed details down into human readable form
            $timeallowance = program_utilities::duration_explode($total_time_allowed);

            $timeallowedstr = '<p class="timeallowed">';
            $timeallowedstr .= get_string('allowtimeforprogram', 'local_program', $timeallowance);
            $timeallowedstr .= '</p>';
            $mform->addElement('static', 'timeallowance', '', $timeallowedstr);
        }
    }


    /**
     * Display static form and edit button
     *
     * @access  public
     * @return  void
     */
    public function display() {
        parent::display();

        $program = $this->_customdata['program'];

        // Check capabilities
        if (has_capability('local/program:configurecontent', $program->get_context())) {
            print_single_button(
                $this->_form->getAttribute('action'),
                array('id' => $program->id),
                get_string('editprogramcontent', 'local_program')
            );
        }
    }
}

// Define a form class to display the program assignments
class program_assignments_nonedit_form extends moodleform {

    function definition() {
        global $CFG, $USER;

        $mform =& $this->_form;

        $program = $this->_customdata['program'];
        $assignments = $program->get_assignments();

/// form definition
//--------------------------------------------------------------------------------

        $mform->addElement('header','programassignments', get_string('programassignments', 'local_program'));

        $elementname = 'assignments';
        $formlabel = $assignments->display_form_label();
        $formelement = $assignments->display_form_element();

        $mform->addElement('static', $elementname, $formlabel, $formelement);
    }


    /**
     * Display static form and edit button
     *
     * @access  public
     * @return  void
     */
    public function display() {
        parent::display();

        $program = $this->_customdata['program'];

        // Check capabilities
        if (has_capability('local/program:configureassignments', $program->get_context())) {
            print_single_button(
                $this->_form->getAttribute('action'),
                array('id' => $program->id),
                get_string('editprogramassignments', 'local_program')
            );
        }
    }
}

// Define a form class to display the program messages
class program_messages_nonedit_form extends moodleform {

    function definition() {
        global $CFG, $USER;

        $mform =& $this->_form;

        $program = $this->_customdata['program'];
        $messagesmanager = $program->get_messagesmanager();

/// form definition
//--------------------------------------------------------------------------------

        $mform->addElement('header','programmessages', get_string('programmessages', 'local_program'));

        $elementname = 'messages';
        $formlabel = $messagesmanager->display_form_label();
        $formelement = $messagesmanager->display_form_element();

        $mform->addElement('static', $elementname, $formlabel, $formelement);
    }


    /**
     * Display static form and edit button
     *
     * @access  public
     * @return  void
     */
    public function display() {
        parent::display();

        $program = $this->_customdata['program'];

        // Check capabilities
        if (has_capability('local/program:configuremessages', $program->get_context())) {
            print_single_button(
                $this->_form->getAttribute('action'),
                array('id' => $program->id),
                get_string('editprogrammessages', 'local_program')
            );
        }
    }
}

// Define a form class to display the program messages
class program_delete_form extends moodleform {

    function definition() {
        global $CFG, $USER;

        $mform =& $this->_form;

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $mform->addElement('hidden', 'action', 'delete');
        $mform->setType('action', PARAM_TEXT);

/// form definition
//--------------------------------------------------------------------------------

        $buttonarray = array();
        $buttonarray[] = $mform->createElement('submit', 'delete', get_string('deleteprogrambutton', 'local_program'));
        $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);

    }

}

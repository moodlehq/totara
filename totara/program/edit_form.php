<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
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
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage program
 */

require_once("{$CFG->libdir}/formslib.php");

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

class program_edit_form extends moodleform {

    function definition() {
        global $CFG, $USER, $OUTPUT;

        $mform =& $this->_form;
        $action = $this->_customdata['action'];
        $category = $this->_customdata['category'];
        $editoroptions = $this->_customdata['editoroptions'];
        $program = (isset($this->_customdata['program'])) ? $this->_customdata['program'] : false;
        $nojs = (isset($this->_customdata['nojs'])) ? $this->_customdata['nojs'] : 0 ;

        $systemcontext = context_system::instance();
        $categorycontext = context_coursecat::instance($category->id);

        if ($program) {
            $programcontext = context_program::instance($program->id);
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
            $mform->addElement('html', get_string('checkprogramdelete', 'totara_program', $program->fullname));
            $buttonarray = array();
            $buttonarray[] = $mform->createElement('submit', 'deleteyes', get_string('yes'));
            $buttonarray[] = $mform->createElement('submit', 'deleteno', get_string('no'));
            $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
            $mform->closeHeaderBefore('buttonar');
            return;
        }

/// form definition with new program defaults
//--------------------------------------------------------------------------------
        $mform->addElement('header','programdetails', get_string('programdetails', 'totara_program'));

        if ($action == 'edit') {
            $mform->addElement('html', html_writer::start_tag('p', array('class' => 'instructions')) . get_string('instructions:programdetails', 'totara_program') . html_writer::end_tag('p'));
        }

        // Must have create program capability in both categories in order to move program
        if (has_capability('totara/program:createprogram', $categorycontext)) {
            $displaylist = array();
            $parentlist = array();
            $attributes = array();
            $attributes['class'] = 'totara-limited-width';
            $attributes['onchange'] = 'if (document.all) { this.className=\'totara-limited-width\';}';
            $attributes['onmousedown'] = 'if (document.all) this.className=\'totara-expanded-width\';';
            $attributes['onblur'] = 'if (document.all) this.className=\'totara-limited-width\';';
            make_categories_list($displaylist, $parentlist, 'totara/program:createprogram');
            $mform->addElement('select', 'category', get_string('category', 'totara_program'), $displaylist, $attributes);
            $mform->setType('category', PARAM_INT);
        } else {
            $mform->addElement('hidden', 'category', null);
            $mform->setType('category', PARAM_INT);
        }

        if ($action == 'view') {
            $mform->hardFreeze('category');
        } else if ($program and !has_capability('moodle/course:changecategory', $categorycontext)) {
        // Use the course permissions to decide if a user can change a program's category (as programs are treated like courses in this respect)
            $mform->hardFreeze('category');
            $mform->setConstant('category', $category->id);
        } else {
            $mform->addHelpButton('category', 'programcategory', 'totara_program');
            $mform->setDefault('category', $category->id);
        }

        if ($action == 'view') {
            $mform->addElement('static', 'visibledisplay', get_string('visible', 'totara_program'), $program->visible ? get_string('yes') : get_string('no'));
        } else {
            $mform->addElement('advcheckbox','visible', get_string('visible', 'totara_program'), null, null, array(0,1));
            $mform->addHelpButton('visible', 'programvisibility', 'totara_program');
            $mform->setDefault('visible', true);
            $mform->setType('visible', PARAM_BOOL);
        }

        $mform->addElement('text','fullname', get_string('fullname', 'totara_program'),'maxlength="254" size="50"');
        if ($action == 'view') {
            $mform->hardFreeze('fullname');
        } else {
            $mform->addHelpButton('fullname', 'programfullname', 'totara_program');
            $mform->setDefault('fullname', get_string('defaultprogramfullname', 'totara_program'));
            $mform->addRule('fullname', get_string('missingfullname'), 'required', null, 'client');
            $mform->setType('fullname', PARAM_MULTILANG);
        }

        $mform->addElement('text','shortname', get_string('shortname', 'totara_program'),'maxlength="100" size="20"');
        if ($action=='view') {
            $mform->hardFreeze('shortname');
        } else {
            $mform->addHelpButton('shortname', 'programshortname', 'totara_program');
            $mform->setDefault('shortname', get_string('defaultprogramshortname', 'totara_program'));
            $mform->addRule('shortname', get_string('missingshortname', 'totara_program'), 'required', null, 'client');
            $mform->setType('shortname', PARAM_MULTILANG);
        }

        $mform->addElement('text','idnumber', get_string('idnumberprogram', 'totara_program'),'maxlength="100"  size="10"');
        if ($action == 'view') {
            $mform->hardFreeze('idnumber');
        } else {
            $mform->addHelpButton('idnumber', 'programidnumber', 'totara_program');
            $mform->setType('idnumber', PARAM_MULTILANG);
        }

        $availabilityoptions = array(
            AVAILABILITY_TO_STUDENTS => get_string('availabletostudents', 'totara_program'),
            AVAILABILITY_NOT_TO_STUDENTS => get_string('availabletostudentsnot', 'totara_program'),
        );
        $mform->addElement('select', 'available', get_string('availability', 'totara_program'), $availabilityoptions);
        if ($action == 'view') {
            $mform->hardFreeze('available');
        } else {
            $mform->addHelpButton('available', 'programavailability', 'totara_program');
            $mform->setDefault('available', AVAILABILITY_TO_STUDENTS);
            $mform->setType('available', PARAM_INT);
        }

        $mform->addElement('text', 'availablefromselector', get_string('availablefrom', 'totara_program'), array('placeholder' => get_string('datepickerplaceholder', 'totara_core')));
        if ($action == 'view') {
            $mform->hardFreeze('availablefromselector');
        } else {
            $mform->addHelpButton('availablefromselector', 'programavailability', 'totara_program');
            $mform->setType('availablefromselector', PARAM_MULTILANG);
        }

        $mform->addElement('hidden', 'availablefrom');
        $mform->setType('availablefrom', PARAM_INT);

        $mform->addElement('text', 'availableuntilselector', get_string('availableuntil', 'totara_program'), array('placeholder' => get_string('datepickerplaceholder', 'totara_core')));
        if ($action == 'view') {
            $mform->hardFreeze('availableuntilselector');
        } else {
            $mform->addHelpButton('availableuntilselector', 'programavailability', 'totara_program');
            $mform->setType('availableuntilselector', PARAM_MULTILANG);
        }

        $mform->addElement('hidden', 'availableuntil');
        $mform->setType('availableuntil', PARAM_INT);

        $mform->addElement('editor', 'summary_editor', get_string('description', 'totara_program'), null, $editoroptions);
        if ($action == 'view') {
            $mform->hardFreeze('summary_editor');
        } else {
            $mform->addHelpButton('summary_editor', 'summary', 'totara_program');
            $mform->setType('summary_editor', PARAM_CLEANHTML);
        }

        $mform->addElement('editor', 'endnote_editor', get_string('endnote', 'totara_program'), null, $editoroptions);
        if ($action == 'view') {
            $mform->hardFreeze('endnote_editor');
        } else {
            $mform->addHelpButton('endnote_editor', 'endnote', 'totara_program');
            $mform->setType('endnote_editor', PARAM_CLEANHTML);
        }


        //replacement for old totara/core/icon classes
        $programicon = ($program && !empty($program->icon)) ? $program->icon : 'default';
        totara_add_icon_picker($mform, $action, 'program', $programicon, $nojs);

        if ($action == 'add') {
            $buttonarray = array();
            $buttonarray[] = $mform->createElement('submit', 'savechanges', get_string('savechanges'), 'class="savechanges-overview program-savechanges"');
            $buttonarray[] = $mform->createElement('cancel', 'cancel', get_string('cancel', 'totara_program'), 'class="program-cancel"');
            $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
            $mform->closeHeaderBefore('buttonar');
        } else if ($action == 'edit') {
            $buttonarray = array();
            $buttonarray[] = $mform->createElement('submit', 'savechanges', get_string('savechanges'), 'class="savechanges-overview program-savechanges"');
            $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
            $mform->closeHeaderBefore('buttonar');
        }

    }

    function validation($data, $files) {

        $mform = $this->_form;
        $errors = array();
        $dateparseformat = get_string('datepickerparseformat', 'totara_core');
        if (!empty($data['availablefromselector'])) {
            $availablefrom = $data['availablefromselector'];
            if (!empty($availablefrom) && !totara_date_parse_from_format($dateparseformat, $availablefrom)) {
                $errors['availablefromselector'] = get_string('error:invaliddate', 'totara_program');
            }
        }

        if (!empty($data['availableuntilselector'])) {
            $availableuntil = $data['availableuntilselector'];
            if (!empty($availableuntil) &&  !totara_date_parse_from_format($dateparseformat, $availableuntil)) {
                $errors['availableuntilselector'] = get_string('error:invaliddate', 'totara_program');
            }
        }

        if (!empty($availablefrom) && !empty($availableuntil)) {
            if (totara_date_parse_from_format($dateparseformat, $availablefrom) > totara_date_parse_from_format($dateparseformat, $availableuntil)) {
                $errors['availableuntilselector'] = get_string('error:availibileuntilearlierthanfrom', 'totara_program');
            }
        }

        return $errors;
    }

    /**
     * Display static form and edit button
     *
     * @access  public
     * @return  void
     */
    public function display() {
        global $OUTPUT;

        parent::display();

        $program = (isset($this->_customdata['program'])) ? $this->_customdata['program'] : false;
        $action = $this->_customdata['action'];

        // if $action is 'view' and $program is not false then we are viewing an existing program
        // Check user has capability to edit program
        if ($action == 'view' && $program && has_capability('totara/program:configuredetails', $program->get_context())) {
            echo $OUTPUT->single_button(new moodle_url('/totara/program/edit.php', array('id' => $program->id, 'action' => 'edit')), get_string('editprogramdetails', 'totara_program'), 'get');
        }
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

       $mform->addElement('header','programcontent', get_string('programcontent', 'totara_program'));

       if (count($coursesets)) {
            foreach ($coursesets as $courseset) {

                $elementname = $courseset->get_set_prefix();
                $formlabel = $courseset->display_form_label();
                $formelement = $courseset->display_form_element();

                $mform->addElement('static', $elementname, $formlabel, $formelement);

            }
        } else {
            $mform->addElement('static', 'progcontent', '', get_string('noprogramcontent', 'totara_program'));
        }

    // Get the total time allowed for this program
    $total_time_allowed = $content->get_total_time_allowance();

        // Only display the time allowance if it is greater than zero
        if ($total_time_allowed > 0) {
            // Break the time allowed details down into human readable form
            $timeallowance = program_utilities::duration_explode($total_time_allowed);

            $timeallowedstr = html_writer::start_tag('p', array('class' => 'timeallowed'));
            $timeallowedstr .= get_string('allowtimeforprogram', 'totara_program', $timeallowance);
            $timeallowedstr .= html_writer::end_tag('p');
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
        global $OUTPUT;

        parent::display();

        $program = $this->_customdata['program'];

        // Check capabilities
        if (has_capability('totara/program:configurecontent', $program->get_context())) {
            echo $OUTPUT->single_button(new moodle_url($this->_form->getAttribute('action'), array('id' => $program->id)), get_string('editprogramcontent', 'totara_program'), 'get');
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

        $mform->addElement('header','programassignments', get_string('programassignments', 'totara_program'));

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
        global $OUTPUT;
        parent::display();

        $program = $this->_customdata['program'];

        // Check capabilities
        if (has_capability('totara/program:configureassignments', $program->get_context())) {
            echo $OUTPUT->single_button(new moodle_url($this->_form->getAttribute('action'), array('id' => $program->id)), get_string('editprogramassignments', 'totara_program'), 'get');
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

        $mform->addElement('header','programmessages', get_string('programmessages', 'totara_program'));

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
        global $OUTPUT;

        parent::display();

        $program = $this->_customdata['program'];

        // Check capabilities
        if (has_capability('totara/program:configuremessages', $program->get_context())) {
            echo $OUTPUT->single_button(new moodle_url($this->_form->getAttribute('action'), array('id' => $program->id)), get_string('editprogrammessages', 'totara_program'), 'get');
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
        $buttonarray[] = $mform->createElement('submit', 'delete', get_string('deleteprogrambutton', 'totara_program'));
        $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);

    }

}

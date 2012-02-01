<?php

require_once($CFG->dirroot.'/lib/formslib.php');

class type_edit_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;

        $mform =& $this->_form;

        $strgeneral  = get_string('general');
        $prefix   = $this->_customdata['prefix'];
        $page  = $this->_customdata['page'];
        $type = $this->_customdata['type'];

        require_once($CFG->dirroot.'/local/icon/'.$prefix.'_type_icon.class.php');

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'prefix', $prefix);
        $mform->setType('prefix', PARAM_ALPHA);
        $mform->addElement('hidden', 'frameworkid');
        $mform->setType('frameworkid', PARAM_INT);
        $mform->addElement('hidden', 'page', $page);
        $mform->setType('page', PARAM_INT);

        /// Print the required moodle fields first
        $mform->addElement('header', 'moodle', $strgeneral);

        $mform->addElement('text', 'fullname', get_string('fullnametype', $prefix), 'maxlength="254" size="50"');
        $mform->addElement('text', 'idnumber', get_string('idnumber'), 'maxlength="100"  size="10"');
        $mform->setHelpButton('fullname', array('typefullname', get_string('fullnametype', $prefix)), true);
        $mform->addRule('fullname', get_string('missingnametype', $prefix), 'required', null, 'client');
        $mform->setType('fullname', PARAM_MULTILANG);

        if (HIERARCHY_DISPLAY_SHORTNAMES) {
            $mform->addElement('text', 'shortname', get_string('shortnametype', $prefix), 'maxlength="100" size="20"');
            $mform->setHelpButton('shortname', array('typeshortname', get_string('shortnametype', $prefix)), true);
            $mform->addRule('shortname', get_string('missingshortnametype', $prefix), 'required', null, 'client');
            $mform->setType('shortname', PARAM_MULTILANG);
        }

        $mform->addElement('htmleditor', 'description', get_string('description'));
        $mform->setHelpButton('description', array('text', get_string('helptext')), true);
        $mform->setType('description', PARAM_CLEAN);

        $typename = $prefix.'_type_icon';
        $type_icon = new $typename();
        $type_icon->add_to_form($type, $mform);

        $this->add_action_buttons();
    }
}

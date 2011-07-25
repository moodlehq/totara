<?php

require_once($CFG->dirroot.'/lib/formslib.php');

class competencytemplate_edit_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;

        $mform =& $this->_form;

        $strgeneral  = get_string('general');

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'visible');
        $mform->setType('visible', PARAM_INT);
        $mform->addElement('hidden', 'frameworkid');
        $mform->setType('frameworkid', PARAM_INT);

        /// Print the required moodle fields first
        $mform->addElement('header', 'moodle', $strgeneral);
        $mform->setHelpButton('moodle', array('competencytemplategeneral', $strgeneral), true);

        $mform->addElement('text', 'fullname', get_string('fullnametemplate', 'competency'), 'maxlength="254" size="50"');
        $mform->setHelpButton('fullname', array('competencytemplatefullname', get_string('fullnametemplate', 'competency')), true);
        $mform->addRule('fullname', get_string('missingfullnametemplate', 'competency'), 'required', null, 'client');
        $mform->setType('fullname', PARAM_MULTILANG);

        $mform->addElement('text', 'shortname', get_string('shortnametemplate', 'competency'), 'maxlength="100" size="20"');
        $mform->setHelpButton('shortname', array('competencytemplateshortname', get_string('shortnametemplate', 'competency')), true);
        $mform->addRule('shortname', get_string('missingshortnametemplate', 'competency'), 'required', null, 'client');
        $mform->setType('shortname', PARAM_MULTILANG);

        $mform->addElement('htmleditor', 'description', get_string('description'));
        $mform->setHelpButton('description', array('text', get_string('helptext')), true);
        $mform->setType('description', PARAM_CLEAN);

        $this->add_action_buttons();
    }
}

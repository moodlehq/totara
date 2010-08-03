<?php

require_once($CFG->dirroot.'/lib/formslib.php');

class framework_edit_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;

        $mform =& $this->_form;
        $type  = $this->_customdata['type'];

        $strgeneral  = get_string('general');

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'visible');
        $mform->setType('visible', PARAM_INT);
        $mform->addElement('hidden', 'sortorder');
        $mform->setType('sortorder', PARAM_INT);
        $mform->addElement('hidden', 'hidecustomfields');
        $mform->setType('hidecustomfields', PARAM_INT);
        $mform->addElement('hidden', 'showitemfullname');
        $mform->setType('showitemfullname', PARAM_INT);
        $mform->addElement('hidden', 'showdepthfullname');
        $mform->setType('showdepthfullname', PARAM_INT);
        $mform->addElement('hidden', 'type', $type);
        $mform->setType('type', PARAM_SAFEDIR);

        /// Print the required moodle fields first
        $mform->addElement('header', 'moodle', $strgeneral);
        $mform->setHelpButton('moodle', array($type.'frameworkgeneral', $strgeneral), true);

        $mform->addElement('text', 'fullname', get_string('fullnameframework', $type), 'maxlength="254" size="50"');
        $mform->setHelpButton('fullname', array($type.'frameworkfullname', get_string('fullnameframework', $type)), true);
        $mform->addRule('fullname', get_string('missingfullnameframework', $type), 'required', null, 'client');
        $mform->setType('fullname', PARAM_MULTILANG);

        $mform->addElement('text', 'shortname', get_string('shortnameframework', $type), 'maxlength="100" size="20"');
        $mform->setHelpButton('shortname', array($type.'frameworkshortname', get_string('shortnameframework', $type)), true);
        $mform->addRule('shortname', get_string('missingshortnameframework', $type), 'required', null, 'client');
        $mform->setType('shortname', PARAM_MULTILANG);

        $mform->addElement('text', 'idnumber', get_string('idnumberframework', $type), 'maxlength="100"  size="10"');
        $mform->setHelpButton('idnumber', array($type.'frameworkidnumber', get_string('idnumberframework', $type)), true);
        $mform->setType('idnumber', PARAM_CLEAN);

        $mform->addElement('htmleditor', 'description', get_string('description'));
        $mform->setHelpButton('description', array('text', get_string('helptext')), true);
        $mform->setType('description', PARAM_CLEAN);

        $this->add_action_buttons();
    }
}

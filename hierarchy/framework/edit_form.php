<?php

require_once($CFG->dirroot.'/lib/formslib.php');

class framework_edit_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;

        $mform =& $this->_form;
        $prefix  = $this->_customdata['prefix'];

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
        $mform->addElement('hidden', 'prefix', $prefix);
        $mform->setType('prefix', PARAM_ALPHA);

        $mform->addElement('text', 'fullname', get_string('name'), 'maxlength="254" size="50"');
        $mform->addRule('fullname', get_string('missingnameframework', $prefix), 'required', null, 'client');
        $mform->setType('fullname', PARAM_MULTILANG);

        if (HIERARCHY_DISPLAY_SHORTNAMES) {
            $mform->addElement('text', 'shortname', get_string('shortnameframework', $prefix), 'maxlength="100" size="20"');
            $mform->setHelpButton('shortname', array($prefix.'frameworkshortname', get_string('shortnameframework', $prefix)), true);
            $mform->addRule('shortname', get_string('missingshortnameframework', $prefix), 'required', null, 'client');
            $mform->setType('shortname', PARAM_MULTILANG);
        }

        $mform->addElement('text', 'idnumber', get_string('idnumberframework', $prefix), 'maxlength="100"  size="10"');
        $mform->setHelpButton('idnumber', array($prefix.'frameworkidnumber', get_string('idnumberframework', $prefix)), true);
        $mform->setType('idnumber', PARAM_CLEAN);

        $mform->addElement('htmleditor', 'description', get_string('description'));
        $mform->setHelpButton('description', array($prefix.'frameworkdescription', get_string('description')), true);
        $mform->setType('description', PARAM_CLEAN);

        $this->add_action_buttons();
    }
}

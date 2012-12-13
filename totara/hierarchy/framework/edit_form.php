<?php

require_once($CFG->dirroot.'/lib/formslib.php');

class framework_edit_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG, $TEXTAREA_OPTIONS;

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
        $mform->addRule('fullname', get_string($prefix.'missingnameframework', 'totara_hierarchy'), 'required', null, 'client');
        $mform->setType('fullname', PARAM_MULTILANG);

        if (HIERARCHY_DISPLAY_SHORTNAMES) {
            $mform->addElement('text', 'shortname', get_string('shortnameframework', 'totara_hierarchy'), 'maxlength="100" size="20"');
            $mform->addHelpButton('shortname', $prefix.'frameworkshortname', 'totara_hierarchy');
            $mform->addRule('shortname', get_string('missingshortnameframework', 'totara_hierarchy'), 'required', null, 'client');
            $mform->setType('shortname', PARAM_MULTILANG);
        }

        $mform->addElement('text', 'idnumber', get_string($prefix.'frameworkidnumber', 'totara_hierarchy'), 'maxlength="100"  size="10"');
        $mform->addHelpButton('idnumber', $prefix.'frameworkidnumber', 'totara_hierarchy');
        $mform->setType('idnumber', PARAM_TEXT);

        $mform->addElement('editor', 'description_editor', get_string($prefix.'frameworkdescription', 'totara_hierarchy'), null, $TEXTAREA_OPTIONS);
        $mform->addHelpButton('description_editor', $prefix.'frameworkdescription', 'totara_hierarchy');
        $mform->setType('description_editor', PARAM_CLEANHTML);

        $this->add_action_buttons();
    }
}

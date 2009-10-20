<?php

require_once($CFG->dirroot.'/lib/formslib.php');

class depth_edit_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;

        $mform =& $this->_form;

        $strgeneral  = get_string('general');
        $prefix = $this->_customdata['prefix'];
        $spage = $this->_customdata['spage'];

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->addElement('hidden', 'frameworkid');
        $mform->addElement('hidden', 'spage', $spage);

        /// Print the required moodle fields first
        $mform->addElement('header', 'moodle', $strgeneral);

        $mform->addElement('text', 'depthlevel', get_string('depthlevel', $prefix));
        $mform->setHelpButton('depthlevel', array('depthlevel', get_string('depthlevel', $prefix)), true);
        $mform->hardFreeze('depthlevel');

        $mform->addElement('text', 'fullname', get_string('fullnamedepth', $prefix), 'maxlength="254" size="50"');
        $mform->setHelpButton('fullname', array('depthlevelfullname', get_string('fullnamedepth', $prefix)), true);
        $mform->addRule('fullname', get_string('missingfullnamedepth', $prefix), 'required', null, 'client');
        $mform->setType('fullname', PARAM_MULTILANG);

        $mform->addElement('text', 'shortname', get_string('shortnamedepth', $prefix), 'maxlength="100" size="20"');
        $mform->setHelpButton('shortname', array('depthlevelshortname', get_string('shortnamedepth', $prefix)), true);
        $mform->addRule('shortname', get_string('missingshortnamedepth', $prefix), 'required', null, 'client');
        $mform->setType('shortname', PARAM_MULTILANG);

        $mform->addElement('htmleditor', 'description', get_string('description'), array('rows'=> '10', 'cols'=>'65'));
        $mform->setHelpButton('description', array('text', get_string('helptext')), true);
        $mform->setType('description', PARAM_RAW);

        $this->add_action_buttons();
    }
}

<?php

require_once($CFG->dirroot.'/lib/formslib.php');

class depth_edit_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;

        $mform =& $this->_form;

        $strgeneral  = get_string('general');
        $type   = $this->_customdata['type'];
        $spage  = $this->_customdata['spage'];

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->addElement('hidden', 'type', $type);
        $mform->addElement('hidden', 'frameworkid');
        $mform->addElement('hidden', 'spage', $spage);

        /// Print the required moodle fields first
        $mform->addElement('header', 'moodle', $strgeneral);

        $mform->addElement('text', 'depthlevel', get_string('depthlevel', $type));
        $mform->setHelpButton('depthlevel', array('depthlevel', get_string('depthlevel', $type)), true);
        $mform->hardFreeze('depthlevel');

        $mform->addElement('text', 'fullname', get_string('fullnamedepth', $type), 'maxlength="254" size="50"');
        $mform->setHelpButton('fullname', array('depthlevelfullname', get_string('fullnamedepth', $type)), true);
        $mform->addRule('fullname', get_string('missingfullnamedepth', $type), 'required', null, 'client');
        $mform->setType('fullname', PARAM_MULTILANG);

        $mform->addElement('text', 'shortname', get_string('shortnamedepth', $type), 'maxlength="100" size="20"');
        $mform->setHelpButton('shortname', array('depthlevelshortname', get_string('shortnamedepth', $type)), true);
        $mform->addRule('shortname', get_string('missingshortnamedepth', $type), 'required', null, 'client');
        $mform->setType('shortname', PARAM_MULTILANG);

        $mform->addElement('htmleditor', 'description', get_string('description'), array('rows'=> '10', 'cols'=>'65'));
        $mform->setHelpButton('description', array('text', get_string('helptext')), true);
        $mform->setType('description', PARAM_RAW);

        $this->add_action_buttons();
    }
}

<?php

require_once($CFG->dirroot.'/lib/formslib.php');

class competencydepth_edit_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;

        $mform =& $this->_form;

        $strgeneral  = get_string('general');

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->addElement('hidden', 'frameworkid');

        /// Print the required moodle fields first
        $mform->addElement('header', 'moodle', $strgeneral);

        $mform->addElement('text', 'depthlevel', get_string('depthlevel', 'competencies'));
        $mform->setHelpButton('depthlevel', array('depthlevel', get_string('depthlevel', 'competencies')), true);
        $mform->hardFreeze('depthlevel');

        $mform->addElement('text', 'fullname', get_string('fullnamedepth', 'competencies'), 'maxlength="254" size="50"');
        $mform->setHelpButton('fullname', array('competencyfullname', get_string('fullnamedepth', 'competencies')), true);
        $mform->addRule('fullname', get_string('missingfullnamedepth', 'competencies'), 'required', null, 'client');
        $mform->setType('fullname', PARAM_MULTILANG);

        $mform->addElement('text', 'shortname', get_string('shortnamedepth', 'competencies'), 'maxlength="100" size="20"');
        $mform->setHelpButton('shortname', array('competencyshortname', get_string('shortnamedepth', 'competencies')), true);
        $mform->addRule('shortname', get_string('missingshortnamedepth', 'competencies'), 'required', null, 'client');
        $mform->setType('shortname', PARAM_MULTILANG);

        $mform->addElement('htmleditor', 'description', get_string('description'), array('rows'=> '10', 'cols'=>'65'));
        $mform->setHelpButton('description', array('text', get_string('helptext')), true);
        $mform->setType('description', PARAM_RAW);

        $this->add_action_buttons();
    }
}

<?php

require_once($CFG->dirroot.'/lib/formslib.php');

class competency_edit_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;

        $mform =& $this->_form;

        $strgeneral  = get_string('general');

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');

        /// Print the required moodle fields first
        $mform->addElement('header', 'moodle', $strgeneral);

        $mform->addElement('text', 'fullname', get_string('fullname', 'competencies'), 'maxlength="254" size="50"');
        $mform->setHelpButton('fullname', array('competencyfullname', get_string('fullname', 'competencies')), true);
        $mform->addRule('fullname', get_string('missingfullname', 'competencies'), 'required', null, 'client');
        $mform->setType('fullname', PARAM_MULTILANG);

        $mform->addElement('text', 'shortname', get_string('shortname', 'competencies'), 'maxlength="100" size="20"');
        $mform->setHelpButton('shortname', array('competencyshortname', get_string('shortname', 'competencies')), true);
        $mform->addRule('shortname', get_string('missingshortname', 'competencies'), 'required', null, 'client');
        $mform->setType('shortname', PARAM_MULTILANG);

        $mform->addElement('text', 'idnumber', get_string('idnumber', 'competencies'), 'maxlength="100"  size="10"');
        $mform->setHelpButton('idnumber', array('competencyidnumber', get_string('idnumber', 'competencies')), true);
        $mform->setType('idnumber', PARAM_RAW);

        $mform->addElement('htmleditor', 'description', get_string('description'), array('rows'=> '10', 'cols'=>'65'));
        $mform->setHelpButton('description', array('text', get_string('helptext')), true);
        $mform->setType('description', PARAM_RAW);

        $this->add_action_buttons();
    }
}

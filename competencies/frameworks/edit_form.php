<?php

require_once($CFG->dirroot.'/lib/formslib.php');

class competencyframework_edit_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;

        $mform =& $this->_form;

        $strgeneral  = get_string('general');

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->addElement('hidden', 'visible');
        $mform->addElement('hidden', 'sortorder');
        $mform->addElement('hidden', 'isdefault');

        /// Print the required moodle fields first
        $mform->addElement('header', 'moodle', $strgeneral);

        $mform->addElement('text', 'fullname', get_string('fullnameframework', 'competencies'), 'maxlength="254" size="50"');
        $mform->setHelpButton('fullname', array('competencyframeworkfullname', get_string('fullnameframework', 'competencies')), true);
        $mform->addRule('fullname', get_string('missingfullnameframework', 'competencies'), 'required', null, 'client');
        $mform->setType('fullname', PARAM_MULTILANG);

        $mform->addElement('text', 'shortname', get_string('shortnameframework', 'competencies'), 'maxlength="100" size="20"');
        $mform->setHelpButton('shortname', array('competencyframeworkshortname', get_string('shortnameframework', 'competencies')), true);
        $mform->addRule('shortname', get_string('missingshortnameframework', 'competencies'), 'required', null, 'client');
        $mform->setType('shortname', PARAM_MULTILANG);

        $mform->addElement('text', 'idnumber', get_string('idnumberframework', 'competencies'), 'maxlength="100"  size="10"');
        $mform->setHelpButton('idnumber', array('competencyframeworkidnumber', get_string('idnumberframework', 'competencies')), true);
        $mform->setType('idnumber', PARAM_RAW);

        $mform->addElement('htmleditor', 'description', get_string('description'), array('rows'=> '10', 'cols'=>'65'));
        $mform->setHelpButton('description', array('text', get_string('helptext')), true);
        $mform->setType('description', PARAM_RAW);

        $this->add_action_buttons();
    }
}

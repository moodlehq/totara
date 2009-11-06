<?php

require_once($CFG->dirroot.'/lib/formslib.php');

class competencyscalevalue_edit_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;

        $mform =& $this->_form;

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->addElement('hidden', 'scaleid');
        $mform->addElement('hidden', 'sortorder');

        /// Print the required moodle fields first
        $mform->addElement('header', 'moodle', get_string('general'));

        $mform->addElement('static', 'scalename', get_string('competencyscale', 'competency'));

        $mform->addElement('text', 'name', get_string('scalevaluename', 'competency'), 'maxlength="100" size="20"');
        $mform->setHelpButton('name', array('competencyscalevaluename', get_string('scalevaluename', 'competency')), true);
        $mform->addRule('name', get_string('missingscalevaluename', 'competency'), 'required', null, 'client');
        $mform->setType('name', PARAM_MULTILANG);

        $mform->addElement('text', 'idnumber', get_string('scalevalueidnumber', 'competency'), 'maxlength="100"  size="10"');
        $mform->setHelpButton('idnumber', array('competencyscalevalueidnumber', get_string('scalevalueidnumber', 'competency')), true);
        $mform->setType('idnumber', PARAM_RAW);

        $mform->addElement('text', 'numeric', get_string('scalevaluenumericalvalue', 'competency'), 'maxlength="100"  size="10"');
        $mform->setHelpButton('numeric', array('competencyscalevaluenumeric', get_string('scalevaluenumericalvalue', 'competency')), true);
        $mform->setType('numeric', PARAM_RAW);

        $mform->addElement('htmleditor', 'description', get_string('description'), array('rows'=> '10', 'cols'=>'65'));
        $mform->setHelpButton('description', array('text', get_string('helptext')), true);
        $mform->setType('description', PARAM_RAW);

        $this->add_action_buttons();
    }

    function validation($valuenew) {

        $err = array();
        $valuenew = (object)$valuenew;

        // Check the numeric field was either empty or a number
        if (strlen($valuenew->numeric)) {
            // Is a number
            if (is_numeric($valuenew->numeric)) {
                $valuenew->numeric = (float)$valuenew->numeric;
            } else {
                $err['numeric'] = get_string('invalidnumeric', 'competency');
                return $err;
            }
        } else {
            $valuenew->numeric = null;
        }

        return true;
    }
}

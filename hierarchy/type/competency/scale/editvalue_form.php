<?php

require_once($CFG->dirroot.'/lib/formslib.php');

class competencyscalevalue_edit_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;

        $mform =& $this->_form;

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'scaleid');
        $mform->setType('scaleid', PARAM_INT);
        $mform->addElement('hidden', 'sortorder');
        $mform->setType('sortorder', PARAM_INT);
        $mform->addElement('hidden', 'type', 'competency');
        $mform->setType('type', PARAM_TEXT);

        /// Print the required moodle fields first
        $mform->addElement('header', 'moodle', get_string('general'));

        $mform->addElement('static', 'scalename', get_string('competencyscale', 'competency'));
        $mform->setHelpButton('scalename', array('competencyscaleassign', get_string('competencyscale', 'competency')), true);

        $mform->addElement('text', 'name', get_string('scalevaluename', 'competency'), 'maxlength="100" size="20"');
        $mform->setHelpButton('name', array('competencyscalevaluename', get_string('scalevaluename', 'competency')), true);
        $mform->addRule('name', get_string('missingscalevaluename', 'competency'), 'required', null, 'client');
        $mform->setType('name', PARAM_MULTILANG);

        $mform->addElement('text', 'idnumber', get_string('scalevalueidnumber', 'competency'), 'maxlength="100"  size="10"');
        $mform->setHelpButton('idnumber', array('competencyscalevalueidnumber', get_string('scalevalueidnumber', 'competency')), true);
        $mform->setType('idnumber', PARAM_CLEAN);

        $mform->addElement('text', 'numericscore', get_string('scalevaluenumericalvalue', 'competency'), 'maxlength="100"  size="10"');
        $mform->setHelpButton('numericscore', array('competencyscalevaluenumeric', get_string('scalevaluenumericalvalue', 'competency')), true);
        $mform->setType('numericscore', PARAM_CLEAN);

        $mform->addElement('htmleditor', 'description', get_string('description'));
        $mform->setHelpButton('description', array('text', get_string('helptext')), true);
        $mform->setType('description', PARAM_CLEAN);

        $this->add_action_buttons();
    }

    function validation($valuenew) {

        $err = array();
        $valuenew = (object)$valuenew;

        // Check the numericscore field was either empty or a number
        if (strlen($valuenew->numericscore)) {
            // Is a number
            if (is_numeric($valuenew->numericscore)) {
                $valuenew->numericscore = (float)$valuenew->numericscore;
            } else {
                $err['numericscore'] = get_string('invalidnumeric', 'competency');
                return $err;
            }
        } else {
            $valuenew->numericscore = null;
        }

        return true;
    }
}

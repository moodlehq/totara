<?php

require_once($CFG->dirroot.'/lib/formslib.php');

class competencyscalevalue_edit_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;

        $mform =& $this->_form;
        $scaleid = $this->_customdata['scaleid'];
        $id = $this->_customdata['id'];

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

        if (competency_scale_is_used($scaleid)) {
           $note = '<span class="notifyproblem">'.get_string('proficientvaluefrozen', 'competency') . '</span>';
           $freeze = true;
        } else if ($id != 0 && competency_scale_only_proficient_value($scaleid) == $id) {

           $note = '<span class="notifyproblem">'.get_string('proficientvaluefrozenonlyprof', 'competency') . '</span>';
            $freeze = true;
        } else {
            $note = '';
            $freeze = false;
        }
        $mform->addElement('advcheckbox', 'proficient', get_string('proficientvalue', 'competency'), $note);
        $mform->setHelpButton('proficient', array('competency/scale/proficient', get_string('proficientvalue', 'competency'), 'moodle'), true);
        if($freeze) {
            $mform->hardFreeze('proficient');
        }

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
            }
        } else {
            $valuenew->numericscore = null;
        }

        // Check that we're not removing the last proficient value from this scale
        if ($valuenew->proficient == 0) {
            if(!record_exists_select('comp_scale_values', "scaleid={$valuenew->scaleid} AND proficient=1 AND id != {$valuenew->id}")) {
                $err['proficient'] = get_string('error:onescalevaluemustbeproficient', 'competency');
            }
        }

        if(count($err) > 0) {
            return $err;
        }

        return true;
    }
}

<?php

require_once($CFG->dirroot.'/lib/formslib.php');

class framework_edit_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;

        $mform =& $this->_form;

        $strgeneral  = get_string('general');

        /// Load competency scales
        $scales = array();
        $scales_raw = competency_scales_available();

        if ($scales_raw) {
            foreach ($scales_raw as $scale) {
                $scales[$scale->id] = $scale->name;
            }
        }

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'visible');
        $mform->setType('visible', PARAM_INT);
        $mform->addElement('hidden', 'sortorder');
        $mform->setType('sortorder', PARAM_INT);
        $mform->addElement('hidden', 'hidecustomfields');
        $mform->setType('hidecustomfields', PARAM_INT);
        $mform->addElement('hidden', 'showitemfullname');
        $mform->setType('showitemfullname', PARAM_INT);
        $mform->addElement('hidden', 'showdepthfullname');
        $mform->setType('showdepthfullname', PARAM_INT);
        $mform->addElement('hidden', 'type', 'competency');
        $mform->setType('type', PARAM_SAFEDIR);

        /// Print the required moodle fields first
        $mform->addElement('header', 'moodle', $strgeneral);
        $mform->setHelpButton('moodle', array('competencyframeworkgeneral', $strgeneral), true);

        $mform->addElement('text', 'fullname', get_string('fullnameframework', 'competency'), 'maxlength="254" size="50"');
        $mform->setHelpButton('fullname', array('competencyframeworkfullname', get_string('fullnameframework', 'competency')), true);
        $mform->addRule('fullname', get_string('missingfullnameframework', 'competency'), 'required', null, 'client');
        $mform->setType('fullname', PARAM_MULTILANG);

        $mform->addElement('text', 'shortname', get_string('shortnameframework', 'competency'), 'maxlength="100" size="20"');
        $mform->setHelpButton('shortname', array('competencyframeworkshortname', get_string('shortnameframework', 'competency')), true);
        $mform->addRule('shortname', get_string('missingshortnameframework', 'competency'), 'required', null, 'client');
        $mform->setType('shortname', PARAM_MULTILANG);

        $mform->addElement('text', 'idnumber', get_string('idnumberframework', 'competency'), 'maxlength="100"  size="10"');
        $mform->setHelpButton('idnumber', array('competencyframeworkidnumber', get_string('idnumberframework', 'competency')), true);
        $mform->setType('idnumber', PARAM_CLEAN);

        $mform->addElement('htmleditor', 'description', get_string('description'));
        $mform->setHelpButton('description', array('text', get_string('helptext')), true);
        $mform->setType('description', PARAM_CLEAN);

        $mform->addElement('select', 'scale', get_string('scale'), $scales);
        $mform->setHelpButton('scale', array('competencyframeworkscale', get_string('scale')), true);
        $mform->addRule('scale', get_string('missingscale', 'competency'), 'required', null, 'client');

        // Don't allow reassigning the scale, if the framework has at least one competency
        if ( isset($this->_customdata['frameworkid']) && count_records('comp','frameworkid',$this->_customdata['frameworkid'])){
            $mform->getElement('scale')->freeze();
        }

        $this->add_action_buttons();
    }
}

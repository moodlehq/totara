<?php

/**
 * This file defines de main lplan configuration form
 * It uses the standard core Moodle (>1.8) formslib. For
 * more info about them, please visit:
 * 
 * http://docs.moodle.org/en/Development:lib/formslib.php
 */

require_once ('moodleform_mod.php');

class mod_lplan_mod_form extends moodleform_mod {

	function definition() {

		global $COURSE;
		$mform    =& $this->_form;

        $mform->addElement('header', 'general', get_string('general', 'form'));

        // Plan name
        $mform->addElement('text', 'name', get_string('lpname', 'idp'), array('size'=>'64'));
		$mform->setType('name', PARAM_TEXT);
		$mform->addRule('name', null, 'required', null, 'client');

        // Enable/disable favourites and search
        $mform->addElement('checkbox', 'enablefavourites', get_string('enablefavourites', 'idp'));
        $mform->addElement('checkbox', 'enablesearch', get_string('enablesearch', 'idp'));

        // Disclaimer
        $mform->addElement('htmleditor', 'disclaimer', get_string('disclaimer', 'idp'), 'wrap="virtual" rows="20" cols="50"');
        $mform->setType('name', PARAM_RAW);

        $this->standard_coursemodule_elements();
        $this->add_action_buttons();
	}
}

?>

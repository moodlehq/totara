<?php

require_once($CFG->libdir.'/formslib.php');

class competency_global_settings_form extends moodleform
{
    function definition() {
        $mform =& $this->_form;
        $mform->addElement('checkbox', 'competencyuseresourcelevelevidence', get_string('useresourcelevelevidence', 'competency'));
        $mform->setDefault('competencyuseresourcelevelevidence', 0);

        $this->add_action_buttons(false);
    }
}

?>

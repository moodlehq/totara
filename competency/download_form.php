<?php //$Id$

require_once($CFG->libdir.'/formslib.php');

class competency_download_form extends moodleform {

    function definition() {
        $mform =& $this->_form;

        $mform->addElement('submit', 'downloadbutton', get_string('download','competency'));

    }
}



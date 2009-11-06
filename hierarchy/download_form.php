<?php //$Id$

require_once($CFG->libdir.'/formslib.php');

class hierarchy_download_form extends moodleform {

    function definition() {
        $mform =& $this->_form;
        $datasent = $this->_customdata;

        $mform->addElement('hidden', 'type', $datasent['type']);

        $mform->addElement('submit', 'downloadbutton', get_string('download', 'admin'));

    }
}



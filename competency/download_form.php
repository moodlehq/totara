<?php //$Id$

require_once($CFG->libdir.'/formslib.php');

class competency_download_form extends moodleform {

    function definition() {
        $mform =& $this->_form;

        //$mform->addElement('header', 'download', 'Download competencies');
        $mform->addElement('submit', 'download', 'Download');

    }
}



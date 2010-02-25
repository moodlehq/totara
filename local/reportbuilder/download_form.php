<?php //$Id$

require_once($CFG->libdir.'/formslib.php');

class download_form extends moodleform {

    function definition() {
        $mform =& $this->_form;
        $reportid = $this->_customdata['reportid'];
        //TODO use lang string for button text
        $mform->addElement('submit', 'downloadbutton', get_string('export','local'));
        $mform->addElement('hidden', 'id', $reportid);

    }
}



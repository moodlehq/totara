<?php //$Id$

require_once($CFG->libdir.'/formslib.php');

class download_form extends moodleform {

    function definition() {
        $mform =& $this->_form;
        $reportid = $this->_customdata['reportid'];
        //TODO use lang string for button text
        $mform->addElement('submit', 'downloadbutton', 'Export');
        $mform->addElement('hidden', 'id', $reportid);

    }
}



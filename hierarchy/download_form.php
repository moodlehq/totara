<?php //$Id$

require_once($CFG->libdir.'/formslib.php');

class hierarchy_download_form extends moodleform {

    function definition() {
        $mform =& $this->_form;
        $datasent = $this->_customdata;
        $frameworkid = $this->_customdata['frameworkid'];
        $mform->addElement('hidden', 'type', $datasent['type']);
        $mform->setType('type', PARAM_SAFEDIR);

        $mform->addElement('hidden', 'frameworkid', $frameworkid);
        $mform->setType('frameworkid', PARAM_INT);
        $mform->addElement('submit', 'downloadbutton', get_string('export', 'hierarchy'));

    }
}



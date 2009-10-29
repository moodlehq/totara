<?php //$Id$

require_once($CFG->libdir.'/formslib.php');

class competency_show_options_form extends moodleform {

    function definition() {
        $mform =& $this->_form;

        $mform->addElement('header', 'displayoptions', get_string('displayoptions','competency'));

        $mform->addElement('checkbox', 'hidecustomfields', get_string('hidecustomfields', 'competency'));
        $mform->setType('hidecustomfields', PARAM_BOOL);

        $mform->addElement('checkbox', 'showitemfullname', get_string('showitemfullname', 'competency'));
        $mform->setType('showitemfullname', PARAM_BOOL);

        $mform->addElement('checkbox', 'showdepthfullname', get_string('showdepthfullname', 'competency'));
        $mform->setType('showdepthfullname', PARAM_BOOL);

        $mform->addElement('hidden', 'frameworkid', $this->_customdata['framework']->id);
        $mform->setType('frameworkid', PARAM_INT);

        $mform->addElement('hidden', 'spage', $this->_customdata['spage']);
        $mform->setType('spage', PARAM_INT);

        $mform->addElement('submit', 'submitbutton', get_string('savechanges'));
    }
}



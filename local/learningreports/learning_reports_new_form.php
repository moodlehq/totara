<?php

require_once "$CFG->dirroot/lib/formslib.php";

class learning_reports_new_form extends moodleform {

    function definition()
    {
        $mform =& $this->_form;

        $mform->addElement('header', 'general', get_string('newreport', 'local'));

        $mform->addElement('text', 'fullname', get_string('reportname', 'local'), 'maxlength="255"');
        $mform->setType('fullname', PARAM_TEXT);

        $mform->addElement('text', 'shortname', get_string('reportshortname', 'local'), 'maxlength="255"');
        $mform->setType('shortname', PARAM_TEXT);

        $sources = array(0 => 'Select a source...','course_completion'=>'Course Completion','competency_evidence'=>'Competency Evidence');

        $mform->addElement('select','source', get_string('source','local'), $sources);

        $restrictions = array(0 => 'Select a restriction...', 1=>'None');
        $mform->addElement('select','restriction', get_string('restriction','local'), $restrictions);

        $this->add_action_buttons();
    }
}

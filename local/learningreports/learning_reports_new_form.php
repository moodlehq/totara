<?php

require_once "$CFG->dirroot/lib/formslib.php";

class learning_reports_new_form extends moodleform {

    function definition() {

        $mform =& $this->_form;

        $mform->addElement('header', 'general', get_string('newreport', 'local'));
        $sources = learningreports_get_options_from_dir('sources');
        if(count($sources)>0) {

            $mform->addElement('text', 'fullname', get_string('reportname', 'local'), 'maxlength="255"');
            $mform->setType('fullname', PARAM_TEXT);

            $mform->addElement('text', 'shortname', get_string('reportshortname', 'local'), 'maxlength="255"');
            $mform->setType('shortname', PARAM_TEXT);

            $pick = array(0 => 'Select a source...');
            $select = array_merge($pick, $sources);
            $mform->addElement('select','source', get_string('source','local'), $select);
            $mform->addRule('source', get_string('error:mustselectsource','local'), 'nonzero');

            $restrictions = learningreports_get_options_from_dir('restrictions');
            if(count($restrictions)>0) {
                $pick = array(0 => 'Select a restriction...');
                $select = array_merge($pick, $restrictions);
                $mform->addElement('select','restriction', get_string('restriction','local'), $select);
            } else {
                $mform->addElement('static','restriction', get_string('restriction','local'), get_string('error:norestrictions','local'));
            }
            $this->add_action_buttons();

        } else {
            $mform->addElement('html', get_string('error:nosources','local'));
        }
    }
}

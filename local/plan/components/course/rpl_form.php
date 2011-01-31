<?php

require_once "$CFG->dirroot/lib/formslib.php";

class totara_course_rpl_form extends moodleform {

    function definition() {
        $mform =& $this->_form;
        $id = $this->_customdata['id'];
        $course = $this->_customdata['courseid'];
        $user = $this->_customdata['userid'];
        $rpltext = $this->_customdata['rpltext'];
        $rplid = $this->_customdata['rplid'];

        //hidden elements
        $mform->addElement('hidden', 'id', $id);
        $mform->addElement('hidden', 'courseid', $course);
        $mform->addElement('hidden', 'userid', $user);
        if($rplid){
            $mform->addElement('hidden', 'rplid', $rplid);
        }

        $mform->addElement('header', 'rpl_general', get_string('coursecompletion','local_plan'));

        $mform->addElement('text', 'rpl', get_string('rpl', 'local_plan'), array('maxsize'=>'255', 'size'=>'50'));
        if($rpltext) {
            $mform->setDefault('rpl', $rpltext);
        }

        $this->add_action_buttons();
    }
}

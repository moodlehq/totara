<?php

require_once "$CFG->dirroot/lib/formslib.php";

class totara_course_rpl_form extends moodleform {

    function definition() {
        $mform =& $this->_form;
        $id = $this->_customdata['id'];
        $course = $this->_customdata['courseid'];
        $user = $this->_customdata['userid'];

        //hidden elements
        $mform->addElement('hidden', 'id', $id);
        $mform->addElement('hidden', 'course', $course);
        $mform->addElement('hidden', 'user', $user);
        $mform->addElement('hidden', 'type', 'course');

        $mform->addElement('header', 'rpl_general', get_string('general'));

        $mform->addElement('text', 'rpl', get_string('rpl', 'local_plan'), array('maxsize'=>'255', 'size'=>'50'));

        $this->add_action_buttons();
    }
}

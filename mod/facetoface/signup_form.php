<?php

require_once "$CFG->dirroot/lib/formslib.php";

class mod_facetoface_signup_form extends moodleform {

    function definition()
    {
        $mform =& $this->_form;
        $manageremail = $this->_customdata['manageremail'];
        $showdiscountcode = $this->_customdata['showdiscountcode'];

        $mform->addElement('hidden', 's', $this->_customdata['s']);
        $mform->addElement('hidden', 'backtoallsessions', $this->_customdata['backtoallsessions']);

        if ($manageremail === false) {
            $mform->addElement('hidden', 'manageremail', '');
        }
        else {
            $mform->addElement('html', get_string('manageremailinstructionconfirm', 'facetoface')); // instructions

            $mform->addElement('text', 'manageremail', get_string('manageremail', 'facetoface'), 'size="35"');
            $mform->addRule('manageremail', null, 'required', null, 'client');
            $mform->addRule('manageremail', null, 'email', null, 'client');
            $mform->setType('manageremail', PARAM_TEXT);
        }

        if ($showdiscountcode) {
            $mform->addElement('text', 'discountcode', get_string('discountcode', 'facetoface'), 'size="6"');
            $mform->addRule('discountcode', null, 'required', null, 'client');
            $mform->setType('discountcode', PARAM_TEXT);
        }
        else {
            $mform->addElement('hidden', 'discountcode', '');
        }

        $options = array(MDL_F2F_BOTH => get_string('notificationboth', 'facetoface'),
                         MDL_F2F_TEXT => get_string('notificationemail', 'facetoface'),
                         MDL_F2F_ICAL => get_string('notificationical', 'facetoface'),
                         );
        $mform->addElement('select', 'notificationtype', get_string('notificationtype', 'facetoface'), $options);
        $mform->addHelpButton('notificationtype', 'notificationtype', 'facetoface');
        $mform->addRule('notificationtype', null, 'required', null, 'client');
        $mform->setDefault('notificationtype', 0);

        $this->add_action_buttons(true, get_string('signup', 'facetoface'));
    }

    function validation($data, $files)
    {
        $errors = parent::validation($data, $files);

        $manageremail = $data['manageremail'];
        if (!empty($manageremail)) {
            if (!facetoface_check_manageremail($manageremail)) {
                $errors['manageremail'] = facetoface_get_manageremailformat();
            }
        }

        return $errors;
    }
}

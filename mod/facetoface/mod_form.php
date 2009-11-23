<?php

require_once "$CFG->dirroot/course/moodleform_mod.php";

class mod_facetoface_mod_form extends moodleform_mod {

    function definition()
    {
        global $CFG;

        $mform =& $this->_form;

        // GENERAL
        $mform->addElement('header', 'general', get_string('general', 'form'));

        $mform->addElement('text', 'name', get_string('name'), array('size'=>'64'));
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEAN);
        }
        $mform->addRule('name', null, 'required', null, 'client');

        $mform->addElement('text', 'thirdparty', get_string('thirdpartyemailaddress', 'facetoface'), array('size'=>'64'));
        $mform->setType('name', PARAM_NOTAGS);
        $mform->setHelpButton('thirdparty', array('thirdpartyemailaddress', get_string('thirdpartyemailaddress', 'facetoface'), 'facetoface'));

        $mform->addElement('checkbox', 'thirdpartywaitlist', get_string('thirdpartywaitlist', 'facetoface'));
        $mform->setHelpButton('thirdpartywaitlist', array('thirdpartywaitlist', get_string('thirdpartywaitlist', 'facetoface'), 'facetoface'));

        $display = array();
        for ($i=0; $i<=18; $i += 2) {
            $display[] = $i;
        }
        $mform->addElement('select', 'display', get_string('sessionsoncoursepage', 'facetoface'), $display);
        $mform->setDefault('display', 3); // 3th element is 6
        $mform->setHelpButton('display', array('sessionsoncoursepage', get_string('sessionsoncoursepage', 'facetoface'), 'facetoface'));

        // CONFIRMATION MESSAGE
        $mform->addElement('header', 'confirmation', get_string('confirmationmessage', 'facetoface'));
        $mform->setHelpButton('confirmation', array('confirmationmessage', get_string('confirmationmessage', 'facetoface'), 'facetoface'));

        $mform->addElement('text', 'confirmationsubject', get_string('email:subject', 'facetoface'), array('size'=>'55'));
        $mform->setType('confirmationsubject', PARAM_TEXT);
        $mform->setDefault('confirmationsubject', get_string('setting:defaultconfirmationsubjectdefault', 'facetoface'));

        $mform->addElement('textarea', 'confirmationmessage', get_string('email:message', 'facetoface'), 'wrap="virtual" rows="15" cols="70"');
        $mform->setDefault('confirmationmessage', get_string('setting:defaultconfirmationmessagedefault', 'facetoface'));

        $mform->addElement('checkbox', 'emailmanagerconfirmation', get_string('emailmanager', 'facetoface'));

        $mform->addElement('textarea', 'confirmationinstrmngr', get_string('email:instrmngr', 'facetoface'), 'wrap="virtual" rows="4" cols="70"');
        $mform->disabledIf('confirmationinstrmngr', 'emailmanagerconfirmation');
        $mform->setDefault('confirmationinstrmngr', get_string('setting:defaultconfirmationinstrmngrdefault', 'facetoface'));

        // REMINDER MESSAGE
        $mform->addElement('header', 'reminder', get_string('remindermessage', 'facetoface'));
        $mform->setHelpButton('reminder', array('remindermessage', get_string('remindermessage', 'facetoface'), 'facetoface'));

        $mform->addElement('text', 'remindersubject', get_string('email:subject', 'facetoface'), array('size'=>'55'));
        $mform->setType('remindersubject', PARAM_TEXT);
        $mform->setDefault('remindersubject', get_string('setting:defaultremindersubjectdefault', 'facetoface'));

        $mform->addElement('textarea', 'remindermessage', get_string('email:message', 'facetoface'), 'wrap="virtual" rows="15" cols="70"');
        $mform->setDefault('remindermessage', get_string('setting:defaultremindermessagedefault', 'facetoface'));

        $mform->addElement('checkbox', 'emailmanagerreminder', get_string('emailmanager', 'facetoface'));

        $mform->addElement('textarea', 'reminderinstrmngr', get_string('email:instrmngr', 'facetoface'), 'wrap="virtual" rows="4" cols="70"');
        $mform->disabledIf('reminderinstrmngr', 'emailmanagerreminder');
        $mform->setDefault('reminderinstrmngr', get_string('setting:defaultreminderinstrmngrdefault', 'facetoface'));

        $reminderperiod = array();
        for ($i=1; $i<=20; $i += 1) {
            $reminderperiod[] = $i;
        }
        $mform->addElement('select', 'reminderperiod', get_string('reminderperiod', 'facetoface'), $reminderperiod);
        $mform->setDefault('reminderperiod', 1); // element at position 1 is 2
        $mform->setHelpButton('reminderperiod', array('reminderperiod', get_string('reminderperiod', 'facetoface'), 'facetoface'));

        // WAITLISTED MESSAGE
        $mform->addElement('header', 'waitlisted', get_string('waitlistedmessage', 'facetoface'));
        $mform->setHelpButton('waitlisted', array('waitlistedmessage', get_string('waitlistedmessage', 'facetoface'), 'facetoface'));

        $mform->addElement('text', 'waitlistedsubject', get_string('email:subject', 'facetoface'), array('size'=>'55'));
        $mform->setType('waitlistedsubject', PARAM_TEXT);
        $mform->setDefault('waitlistedsubject', get_string('setting:defaultwaitlistedsubjectdefault', 'facetoface'));

        $mform->addElement('textarea', 'waitlistedmessage', get_string('email:message', 'facetoface'), 'wrap="virtual" rows="15" cols="70"');
        $mform->setDefault('waitlistedmessage', get_string('setting:defaultwaitlistedmessagedefault', 'facetoface'));

        // CANCELLATION MESSAGE
        $mform->addElement('header', 'cancellation', get_string('cancellationmessage', 'facetoface'));
        $mform->setHelpButton('cancellation', array('cancellationmessage', get_string('cancellationmessage', 'facetoface'), 'facetoface'));

        $mform->addElement('text', 'cancellationsubject', get_string('email:subject', 'facetoface'), array('size'=>'55'));
        $mform->setType('cancellationsubject', PARAM_TEXT);
        $mform->setDefault('cancellationsubject', get_string('setting:defaultcancellationsubjectdefault', 'facetoface'));

        $mform->addElement('textarea', 'cancellationmessage', get_string('email:message', 'facetoface'), 'wrap="virtual" rows="15" cols="70"');
        $mform->setDefault('cancellationmessage', get_string('setting:defaultcancellationmessagedefault', 'facetoface'));

        $mform->addElement('checkbox', 'emailmanagercancellation', get_string('emailmanager', 'facetoface'));

        $mform->addElement('textarea', 'cancellationinstrmngr', get_string('email:instrmngr', 'facetoface'), 'wrap="virtual" rows="4" cols="70"');
        $mform->disabledIf('cancellationinstrmngr', 'emailmanagercancellation');
        $mform->setDefault('cancellationinstrmngr', get_string('setting:defaultcancellationinstrmngrdefault', 'facetoface'));

        $features = new stdClass;
        $features->groups = false;
        $features->groupings = false;
        $features->groupmembersonly = false;
        $features->outcomes = false;
        $features->gradecat = false;
        $features->idnumber = true;
        $this->standard_coursemodule_elements($features);

        $this->add_action_buttons();
    }

    function data_preprocessing(&$default_values)
    {
        // Fix manager emails
        if (empty($default_values['confirmationinstrmngr'])) {
            $default_values['confirmationinstrmngr'] = null;
        }
        else {
            $default_values['emailmanagerconfirmation'] = 1;
        }

        if (empty($default_values['reminderinstrmngr'])) {
            $default_values['reminderinstrmngr'] = null;
        }
        else {
            $default_values['emailmanagerreminder'] = 1;
        }

        if (empty($default_values['cancellationinstrmngr'])) {
            $default_values['cancellationinstrmngr'] = null;
        }
        else {
            $default_values['emailmanagercancellation'] = 1;
        }
    }
}
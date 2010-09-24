<?php

require_once($CFG->libdir.'/formslib.php');

class reminder_edit_form extends moodleform {

    function definition() {
        global $USER, $CFG;

        $mform    =& $this->_form;

        $course   = $this->_customdata['course'];
        $reminder = $this->_customdata['reminder'];

        $mform->addElement('hidden', 'id', null);
        $mform->setType('id', PARAM_INT);

        $mform->addElement('hidden', 'courseid', null);
        $mform->setType('courseid', PARAM_INT);
        $mform->setDefault('courseid', $course->id);

        // Get activities with completion enabled
        $completion = new completion_info($course);
        $activities = $completion->get_activities();

        $choices = array();
        $choices[0] = get_string('coursecompletion', 'reminders');
        foreach ($activities as $a) {
            $choices[$a->id] = get_string('modulename', $a->modname).' - '.$a->name;
        }

        // Get feedback activities in the course
        $mods = get_coursemodules_in_course('feedback', $course->id);
        $rchoices = array();
        if ($mods) {
            foreach ($mods as $mod) {
                $rchoices[$mod->id] = $mod->name;
            }
        } else {
            print_error('nofeedbackactivities', 'reminders', $CFG->wwwroot.'/course/view.php?id='.$course->id);
        }

/// form definition
//--------------------------------------------------------------------------------
        $mform->addElement('header', 'general', get_string('reminder', 'reminders'));

        $mform->addElement('text', 'title', get_string('title', 'reminders'));
        $mform->setHelpButton('title', array('remindertitle', get_string('title', 'reminders')), true);
        $mform->addRule('title', get_string('missingtitle', 'reminders'), 'required', null, 'client');

        $mform->addElement('select', 'tracking', get_string('completiontotrack', 'reminders'), $choices);
        $mform->setHelpButton('tracking', array('remindercompltotrack', get_string('completiontotrack', 'reminders')), true);
        $mform->addRule('tracking', get_string('missingfullname'), 'required', null, 'client');
        $mform->setType('tracking', PARAM_INT);

        $mform->addElement('select', 'requirement', get_string('requirement', 'reminders'), $rchoices);
        $mform->setHelpButton('requirement', array('reminderrequirement', get_string('requirement', 'reminders')), true);
        $mform->addRule('requirement', get_string('missingfullname'), 'required', null, 'client');
        $mform->setType('requirement', PARAM_INT);

//--------------------------------------------------------------------------------
        $mform->addElement('header', 'invitation', get_string('invitation', 'reminders'));

        $options = range(3, 30);
        array_unshift($options, get_string('nextday', 'reminders'));
        array_unshift($options, get_string('sameday', 'reminders'));
        $mform->addElement('select', 'invitationperiod', get_string('period', 'reminders'), $options);
        $mform->setHelpButton('invitationperiod', array('reminderperioduntilreminder', get_string('period', 'reminders')), true);
        $mform->setDefault('invitationperiod', 0);

        $mform->addElement('text', 'invitationsubject', get_string('subject', 'reminders'), 'maxlength="254" size="80"');
        $mform->setHelpButton('invitationsubject', array('remindersubject', get_string('subject', 'reminders')), true);
        $mform->setDefault('invitationsubject', get_string('invitationsubjectdefault', 'reminders'));
        $mform->setType('invitationsubject', PARAM_MULTILANG);

        $mform->addElement('textarea', 'invitationmessage', get_string('message', 'reminders'), 'rows="15" cols="70"');
        $mform->setHelpButton('invitationmessage', array('remindermessage', get_string('message', 'reminders')), true) ;
        $mform->setDefault('invitationmessage', get_string('invitationmessagedefault', 'reminders'));
        $mform->setType('invitationmessage', PARAM_MULTILANG);

//--------------------------------------------------------------------------------
        $mform->addElement('header', 'reminder', get_string('reminder', 'reminders'));

        $mform->addElement('select', 'reminderperiod', get_string('period', 'reminders'), $options);
        $mform->setHelpButton('reminderperiod', array('reminderperioduntilreminder', get_string('period', 'reminders')), true);
        $mform->setDefault('reminderperiod', 1);

        $mform->addElement('text', 'remindersubject', get_string('subject', 'reminders'), 'maxlength="254" size="80"');
        $mform->setHelpButton('remindersubject', array('remindersubject', get_string('subject', 'reminders')), true);
        $mform->setDefault('remindersubject', get_string('remindersubjectdefault', 'reminders'));
        $mform->setType('remindersubject', PARAM_MULTILANG);

        $mform->addElement('textarea', 'remindermessage', get_string('message', 'reminders'), 'rows="15" cols="70"');
        $mform->setHelpButton('remindermessage', array('remindermessage', get_string('message', 'reminders')), true) ;
        $mform->setDefault('remindermessage', get_string('remindermessagedefault', 'reminders'));
        $mform->setType('remindermessage', PARAM_MULTILANG);

//--------------------------------------------------------------------------------
        $mform->addElement('header', 'escalation', get_string('escalation', 'reminders'));

        $mform->addElement('checkbox', 'escalationdontsend', get_string('dontsend', 'reminders'));
        $mform->setDefault('escalationdontsend', 0);

        $mform->addElement('checkbox', 'escalationskipmanager', get_string('skipmanager', 'reminders'));
        $mform->setDefault('escalationskipmanager', 0);
        $mform->disabledIf('escalationskipmanager', 'escalationdontsend', 'checked');

        $mform->addElement('select', 'escalationperiod', get_string('period', 'reminders'), $options);
        $mform->setHelpButton('escalationperiod', array('reminderperioduntilreminder', get_string('period', 'reminders')), true);
        $mform->setDefault('escalationperiod', 1);
        $mform->disabledIf('escalationperiod', 'escalationdontsend', 'checked');

        $mform->addElement('text', 'escalationsubject', get_string('subject', 'reminders'), 'maxlength="254" size="80"');
        $mform->setHelpButton('escalationsubject', array('remindersubject', get_string('subject', 'reminders')), true);
        $mform->setDefault('escalationsubject', get_string('escalationsubjectdefault', 'reminders'));
        $mform->setType('escalationsubject', PARAM_MULTILANG);
        $mform->disabledIf('escalationsubject', 'escalationdontsend', 'checked');

        $mform->addElement('textarea', 'escalationmessage', get_string('message', 'reminders'), 'rows="15" cols="70"');
        $mform->setHelpButton('escalationmessage', array('remindermessage', get_string('message', 'reminders')), true) ;
        $mform->setDefault('escalationmessage', get_string('escalationmessagedefault', 'reminders'));
        $mform->setType('escalationmessage', PARAM_MULTILANG);
        $mform->disabledIf('escalationmessage', 'escalationdontsend', 'checked');

//--------------------------------------------------------------------------------
        $this->add_action_buttons();

//--------------------------------------------------------------------------------
    }

    function definition_after_data() {

        $mform    =& $this->_form;

        if (!$mform->getElementValue('id')) {
            $mform->setDefault('id', -1);
        }
    }
}

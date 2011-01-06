
<?php
require_once($CFG->dirroot.'/lib/formslib.php');

class totara_msg_settings_form extends moodleform {

    // Define the form
    function definition () {
        global $CFG, $COURSE, $POSITION_TYPES;

        $mform =& $this->_form;
        $userid = $this->_customdata['user'];

        // Add some extra hidden fields
        $mform->addElement('hidden', 'id', $userid);
        $mform->setType('id', PARAM_INT);

        $mform->addElement('header', 'general', get_string('settings'));

        $mform->addElement('checkbox', 'totara_msg_send_ntfy_emails', get_string('sendnotificationemails', 'local_totara_msg'));
        $mform->setType('totara_msg_send_ntfy_emails', PARAM_BOOL);
        //$mform->setHelpButton('totara_msg_send_ntfy_emails', array('userpositionfullname', get_string('titlefullname', 'position')), true);

        $mform->addElement('checkbox', 'totara_msg_send_rmdr_emails', get_string('sendreminderemails', 'local_totara_msg'));
        $mform->setType('totara_msg_send_rmdr_emails', PARAM_BOOL);
        //$mform->setHelpButton('totara_msg_send_rmdr_emails', array('userpositionfullname', get_string('titlefullname', 'position')), true);

        $this->add_action_buttons(true, get_string('update'));
    }
}

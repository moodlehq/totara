<?php //$Id$

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once $CFG->libdir.'/formslib.php';

class login_change_password_form extends moodleform {

    function definition() {
        global $USER, $CFG;

        $mform =& $this->_form;

        $mform->addElement('header', '', get_string('changepassword'), '');

        // visible elements
        $mform->addElement('static', 'username', get_string('username'), $USER->username);

        if (!empty($CFG->passwordpolicy)){
            $mform->addElement('static', 'passwordpolicyinfo', '', print_password_policy());
        }
        $mform->addElement('password', 'password', get_string('oldpassword'));
        $mform->addRule('password', get_string('required'), 'required', null, 'client');
        $mform->setType('password', PARAM_RAW);

        $mform->addElement('password', 'newpassword1', get_string('newpassword'));
        $mform->addRule('newpassword1', get_string('required'), 'required', null, 'client');
        $mform->setType('newpassword1', PARAM_RAW);

        $mform->addElement('password', 'newpassword2', get_string('newpassword').' ('.get_String('again').')');
        $mform->addRule('newpassword2', get_string('required'), 'required', null, 'client');
        $mform->setType('newpassword2', PARAM_RAW);


        // hidden optional params
        $mform->addElement('hidden', 'id', 0);
        $mform->setType('id', PARAM_INT);

        // buttons
        if (get_user_preferences('auth_forcepasswordchange')) {
            $this->add_action_buttons(false);
        } else {
            $this->add_action_buttons(true);
        }
    }

/// perform extra password change validation
    function validation($data, $files) {
        global $USER;
        $errors = parent::validation($data, $files);

        update_login_count();

        // ignore submitted username
        if (!$user = authenticate_user_login(addslashes($USER->username), $data['password'])) {
            $errors['password'] = get_string('invalidlogin');
            return $errors;
        }

        reset_login_count();

        if ($data['newpassword1'] <> $data['newpassword2']) {
            $errors['newpassword1'] = get_string('passwordsdiffer');
            $errors['newpassword2'] = get_string('passwordsdiffer');
            return $errors;
        }

        if ($this->old_password_reused($data['newpassword1'])) {
            $errors['newpassword1'] = get_string('passwordreused');
            $errors['newpassword2'] = get_string('passwordreused');
        }

        if ($data['password'] == $data['newpassword1']){
            $errors['newpassword1'] = get_string('mustchangepassword');
            $errors['newpassword2'] = get_string('mustchangepassword');
            return $errors;
        }

        $errmsg = '';//prevents eclipse warnings
        if (!check_password_policy($data['newpassword1'], $errmsg)) {
            $errors['newpassword1'] = $errmsg;
            $errors['newpassword2'] = $errmsg;
            return $errors;
        }

        return $errors;
    }

    // Check if a specified password has been previously used by this user;
    function old_password_reused($password) {
        global $CFG, $USER;
        $limit = empty($CFG->passwordreuselimit) ? 0: $CFG->passwordreuselimit;
        if (empty($limit)) {
            //Checking against zero old passwords - non-match by definition
            return false;
        }
        $oldpasswordssql = 'SELECT * FROM ' . $CFG->prefix . 'oldpassword ' .
                'WHERE uid = ' . $USER->id . ' ' .
                'ORDER BY id desc ' .
                'LIMIT ' . $limit;
        $oldpasswords = get_records_sql($oldpasswordssql);
        if (!$oldpasswords) {
            $oldpasswords = array();
        }
        foreach ($oldpasswords as $oldpassword) {
            if (md5($password . $CFG->passwordsaltmain) == $oldpassword->hash) {
                // User tried to use a password they had previously set with the current salt
                return true;
            }
            if (md5($password) == $oldpassword->hash) {
                // User tried to use a password they had previously set when there was no salt
                return true;
            }
            $altcount = 0;
            while(1) {
                //Check at least 20 alt password salts
                $altcount++;
                $varname = 'passwordsaltalt' . $altcount;
                if ($altcount > 20 && empty($CFG->{$varname})) {
                    break;
                }
                if (empty($CFG->{$varname})) {
                    continue;
                }
                if (md5($password . $CFG->{$varname}) == $oldpassword->hash) {
                    // User tried to use a password they had used on a previous salt;
                    return true;
                }
            }
        }
        return false;
    }

}
?>

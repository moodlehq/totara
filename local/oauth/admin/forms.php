<?php
///////////////////////////////////////////////////////////////////////////
//                                                                       //
// This file is part of Moodle - http://moodle.org/                      //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//                                                                       //
// Moodle is free software: you can redistribute it and/or modify        //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation, either version 3 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// Moodle is distributed in the hope that it will be useful,             //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details.                          //
//                                                                       //
// You should have received a copy of the GNU General Public License     //
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.       //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

/**
 * Administration forms of OAuth
 * @package   localoauth
 * @copyright 2010 Moodle Pty Ltd (http://moodle.com)
 * @author    Piers Harding
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->dirroot.'/lib/formslib.php');
require_once($CFG->dirroot.'/local/oauth/lib.php');

/**
 * This form displays oauth settings
 */
class oauth_settings_form extends moodleform {

    public function definition() {
        global $CFG, $SITE, $USER;

        $enabled = get_config('local_oauth', 'oauthenabled');

        $strrequired = get_string('required');
        $mform =& $this->_form;
        $mform->addElement('header', 'moodle', get_string('settings', 'local_oauth'));

        $mform->addElement('checkbox', 'enabled', get_string('enabled', 'local_oauth'),'');
        $mform->setDefault('enabled', $enabled);

        $this->add_action_buttons(false, get_string('update'));

    }

    function validation($data, $files) {
        global $CFG;

        $errors = array();

        return $errors;
    }

}

class oauth_registration_form extends moodleform {

    public function definition() {
        global $CFG, $SITE, $USER;

        $strrequired = get_string('required');
        $mform =& $this->_form;
        $mform->addElement('header', 'moodle', get_string('registration', 'local_oauth'));

        $mform->addElement('text', 'name' , get_string('sitename', 'local_oauth'), array('size' => 40, 'maxlength' => 256));
        $mform->setHelpButton('name', array('name', get_string('sitename', 'local_oauth'), 'local_oauth'));
        $mform->addElement('text', 'consumer_key' , get_string('consumer_key', 'local_oauth'), array('size' => 40, 'maxlength' => 256));
        $mform->setHelpButton('consumer_key', array('name', get_string('consumer_key', 'local_oauth'), 'local_oauth'));
        $mform->addElement('text', 'consumer_secret' , get_string('consumer_secret', 'local_oauth'), array('size' => 60, 'maxlength' => 256));
        $mform->setHelpButton('consumer_secret', array('name', get_string('consumer_secret', 'local_oauth'), 'local_oauth'));
        $mform->addElement('text', 'request_token_url' , get_string('siterequest', 'local_oauth'), array('size' => 100, 'maxlength' => 256));
//        $mform->setType('request_token_url', PARAM_URL);
        $mform->setHelpButton('request_token_url', array('name', get_string('siterequest', 'local_oauth'), 'local_oauth'));
        $mform->addElement('text', 'authorize_token_url' , get_string('siteauthorize', 'local_oauth'), array('size' => 100, 'maxlength' => 256));
//        $mform->setType('authorize_token_url', PARAM_URL);
        $mform->setHelpButton('authorize_token_url', array('name', get_string('siteauthorize', 'local_oauth'), 'local_oauth'));
        $mform->addElement('text', 'access_token_url' , get_string('siteaccess', 'local_oauth'), array('size' => 100, 'maxlength' => 256));
//        $mform->setType('access_token_url', PARAM_URL);
        $mform->setHelpButton('access_token_url', array('name', get_string('siteaccess', 'local_oauth'), 'local_oauth'));

        if (empty($this->_customdata)) {
            $mform->addElement('hidden', 'add', 1);
            $this->add_action_buttons(false, get_string('add'));
        }
        else {
            $mform->addElement('hidden', 'update', 1);
            $mform->addElement('hidden', 'id',   $this->_customdata['id']);
            $mform->setDefault('name', $this->_customdata['name']);
            $mform->setDefault('consumer_key', $this->_customdata['consumer_key']);
            $mform->setDefault('consumer_secret', $this->_customdata['consumer_secret']);
            $mform->setDefault('request_token_url', $this->_customdata['request_token_url']);
            $mform->setDefault('authorize_token_url', $this->_customdata['authorize_token_url']);
            $mform->setDefault('access_token_url', $this->_customdata['access_token_url']);
            $this->add_action_buttons(true, get_string('update'));
        }
    }

    function validation($data, $files) {
        global $CFG;
        $errors = parent::validation($data, $files);

        if (empty($data['name'])) {
            $errors['name'] = get_string('error_noname', 'local_oauth');
        }

        if (empty($data['consumer_key'])) {
            $errors['consumer_key'] = get_string('error_nokey', 'local_oauth');
        }

        if (empty($data['consumer_secret'])) {
            $errors['consumer_secret'] = get_string('error_nosecret', 'local_oauth');
        }

        $url = clean_param($data['request_token_url'], PARAM_URL);
        if (empty($url)) {
            $errors['request_token_url'] = get_string('error_norequesturl', 'local_oauth');
        }

        $url = clean_param($data['authorize_token_url'], PARAM_URL);
        if (empty($url)) {
            $errors['authorize_token_url'] = get_string('error_noauthorizeurl', 'local_oauth');
        }

        $url = clean_param($data['access_token_url'], PARAM_URL);
        if (empty($url)) {
            $errors['access_token_url'] = get_string('error_noaccessurl', 'local_oauth');
        }

        return $errors;
    }

}

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
 * On this page administrator can change oauth settings
 * @package   localoauth
 * @copyright 2010 Moodle Pty Ltd (http://moodle.com)
 * @author    Piers Harding
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/oauth/admin/forms.php');

admin_externalpage_setup('oauthsettings');

$oauthsettingsform = new oauth_settings_form();

$fromform = $oauthsettingsform->get_data();

//echo $OUTPUT->header();
admin_externalpage_print_header();
//        print_heading($strupgradinglogs);

if (!empty($fromform)) {

    //Save settings
    set_config('oauthenabled', $fromform->enabled ,'local_oauth');

    //display confirmation
    //echo $OUTPUT->notification(get_string('settingsupdated', 'local_oauth'), 'notifysuccess');
    notify(get_string('settingsupdated', 'local_oauth'), 'notifysuccess');
}

$oauthsettingsform->display();
//echo $OUTPUT->footer();
admin_externalpage_print_footer();


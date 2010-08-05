<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This is a one-line short description of the file
 *
 * You can have a rather longer description of the file as well,
 * if you like, and it can span multiple lines.
 *
 * @package   mod-workshop
 * @copyright 2009 David Mudrak <david.mudrak@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/// Replace workshop with the name of your module and remove this line

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');

global $PAGE, $OUTPUT, $SESSION;


add_to_log(SITEID, 'local_oauth', 'trigger oauth authentication', "", '');

//$PAGE->set_url('/local/oauth/authenticate.php', array());
//$PAGE->set_title(get_string('oauth', 'local_oauth'));
//$PAGE->set_heading(get_string('authentication', 'local_oauth'));

$enabled = get_config('local_oauth', 'oauthenabled');

// must have a return to URL
if (empty($SESSION->wantsurl)) {
//    echo $OUTPUT->header();
//    echo $OUTPUT->heading(get_string('authentication', 'local_oauth'), 2);
    print_heading(get_string('authentication', 'local_oauth'));
    print_error(get_string('noreturnto', 'local_oauth'));
    print_footer();
}

if (!$enabled) {
/// Output starts here
//    echo $OUTPUT->header();
//    echo $OUTPUT->heading(get_string('authentication', 'local_oauth'), 2);
    print_heading(get_string('authentication', 'local_oauth'));
    print_error(get_string('oauthdisabled', 'local_oauth'));
    print_footer();
}

// get the current state
$id = required_param('id', PARAM_INT); // site id
if (!$site = local_oauth_registration::get_site($id)) {
//    echo $OUTPUT->header();
//    echo $OUTPUT->heading(get_string('authentication', 'local_oauth'), 2);
    print_heading(get_string('authentication', 'local_oauth'));
    print_error(get_string('oauthinvalidid', 'local_oauth'));
    print_footer();
}

// is site enabled
if (!$site->enabled) {
//    echo $OUTPUT->header();
//    echo $OUTPUT->heading(get_string('authentication', 'local_oauth'), 2);
    print_heading(get_string('authentication', 'local_oauth'));
    print_error(get_string('sitedisabled', 'local_oauth'));
    print_footer();
}

// find the SP to Authenticate with
if (empty($SESSION->local_oauth[$site->name])) {
//    echo $OUTPUT->header();
//    echo $OUTPUT->heading(get_string('authentication', 'local_oauth'), 2);
    print_heading(get_string('authentication', 'local_oauth'));
    print_error(get_string('norequest', 'local_oauth'));
    print_footer();
}

$oauth = new local_oauth($site->name);

if ($oauth->authenticate()) {
//echo "here6";
    // return to wantsurl
    $wantsurl = $oauth->getReturn();
//echo "here7: $wantsurl";
    redirect($wantsurl);
}



// stash access token details - then send back to requesting service in Moodle




// If there is a failure then we get here

/// Output starts here
//echo $OUTPUT->header();
//echo $OUTPUT->heading(get_string('authentication', 'local_oauth'), 2);

print_heading(get_string('authentication', 'local_oauth'));
print_error(get_string('authenticationfailed', 'local_oauth'));
print_footer();


/// Finish the page
//echo $OUTPUT->footer();

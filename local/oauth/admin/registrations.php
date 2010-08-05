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
 * Administrator can manage registrations on this page.
 * Trust, Prioritise, Delete, Hide...
 * @package   localoauth
 * @copyright 2010 Moodle Pty Ltd (http://moodle.com)
 * @author    Piers Harding
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define('MOODLE_URL_2', 1);

require('../../../config.php');

require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/oauth/admin/forms.php');
require_once($CFG->dirroot.'/local/oauth/lib.php');
require_once($CFG->dirroot .'/local/libs/outputlib.php');       // Functions for generating output
require_once('../renderer.php');
//global $PAGE;
//global $OUTPUT;

// Put $OUTPUT in place, so errors can be displayed.
//$OUTPUT = new bootstrap_renderer();
//$PAGE = new moodle_page();
$renderer = new local_oauth_renderer();



admin_externalpage_setup('oauthregistrations');
$reg = new local_oauth_registration();


/// Check if the page has been called with edit argument
$edit  = optional_param('edit', -1, PARAM_INTEGER);
$add  = optional_param('add', -1, PARAM_INTEGER);
$update  = optional_param('update', -1, PARAM_INTEGER);
$delete  = optional_param('delete', -1, PARAM_INTEGER);
$confirm  = optional_param('confirm', false, PARAM_INTEGER);
$enabled  = optional_param('enabled', -1, PARAM_INTEGER);
$cancel  = optional_param('cancel', '', PARAM_RAW);

//$renderer = $PAGE->get_renderer('local_oauth');


$msgtype = 'notifysuccess';
$contenthtml = "";
$oauthregistrationform = null;
$msg = null;

// enable/disable the site
if ($enabled != -1 and confirm_sesskey()) {
    $id  = optional_param('id', '', PARAM_INTEGER);
    $site = $reg->get_site($id);
    if (!empty($site)) {
        $site->enabled = $enabled;
        $reg->update_site($site);
    }
    $sites = $reg->get_sites(null, false); //return list of all sites
    $contenthtml = $renderer->site_list($sites, true);
}
// just present the update page
else if ($edit != -1 and confirm_sesskey()) {
    // do edit screen
    $id  = optional_param('edit', '', PARAM_INTEGER);
    $site = $reg->get_site($id);
    //$fromform = $oauthregistrationform->get_data();
    if (!empty($site)) {
        $oauthregistrationform = new oauth_registration_form(null, (array)$site);
    }
}
// do the actual update
else if ($update != -1 and confirm_sesskey()) {
    // do edit screen
    $id  = optional_param('id', '', PARAM_INTEGER);
    $site = $reg->get_site($id);
    $oauthregistrationform = new oauth_registration_form();
    $fromform = $oauthregistrationform->get_data();
    //if (!empty($site) && !empty($fromform) && !$fromform->cancel) {
    if (!empty($site) && empty($cancel)) {
        $oauthregistrationform = new oauth_registration_form(null, (array)$site);
        foreach (array('name', 'consumer_key', 'consumer_secret', 'request_token_url', 'authorize_token_url', 'access_token_url') as $fld) {
            $site->$fld = $fromform->$fld;
        }
        $reg->update_site($site);
        $msg =  get_string('siteupdated','local_oauth', $site->name);
    }
    else {
        $sites = $reg->get_sites(null, false); //return list of all sites
        $contenthtml = $renderer->site_list($sites, true);
    }
}
// create a new site
else if ($add != -1 and confirm_sesskey()) {
    // do edit screen
    $oauthregistrationform = new oauth_registration_form();
    $fromform = $oauthregistrationform->get_data();
    if (!empty($fromform)) {
        if (local_oauth_registration::get_site_by_name($fromform->name)) {
            $msg =  get_string('siteaddduplicate','local_oauth', $fromform->name);
            $msgtype = 'notifyproblem';
        }
        else {
            $reg->add_site($fromform);
            $msg =  get_string('siteadded','local_oauth', $fromform->name);
        }
    }
    else {
        $msg =  get_string('siteadderrors','local_oauth');
        $msgtype = 'notifyproblem';
    }
    $sites = $reg->get_sites(null, false); //return list of all sites
    $contenthtml = $renderer->site_list($sites, true);
}
/// Check if the page has been called with delete argument
else if ($delete != -1 and $confirm and confirm_sesskey()) {
    $reg->delete_site($delete);
    $sites = $reg->get_sites(null, false); //return list of all sites
    $contenthtml = $renderer->site_list($sites, true);
}
//we want to display delete confirmation page
else if ($delete != -1 and !$confirm) {
    $site = $reg->get_site($delete);
    $contenthtml = $renderer->delete_confirmation($site);
}
//all other cases we go back to site list page (no need confirmation)
else {
    $sites = $reg->get_sites(null, false); //return list of all sites
    $contenthtml = $renderer->site_list($sites, true);
}

// create an empty form if we don't have one yet
if (!$oauthregistrationform) {
    $oauthregistrationform = new oauth_registration_form();
}

// now out with it
//echo $OUTPUT->header();
admin_externalpage_print_header();
//echo $OUTPUT->heading(get_string('manageregistrations', 'local_oauth'), 3, 'main');
print_heading(get_string('manageregistrations', 'local_oauth'), 3, 'main');
//display confirmation
if ($msg) {
//    echo $OUTPUT->notification($msg, $msgtype);
    notify($msg, $msgtype);
}

echo $contenthtml;
if (!($delete != -1 and !$confirm)) {
    $oauthregistrationform->display();
}
//echo $OUTPUT->footer();
admin_externalpage_print_footer();

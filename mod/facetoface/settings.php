<?php
global $CFG, $USER,$DB;
require_once "$CFG->dirroot/mod/facetoface/lib.php";

$settings->add(new admin_setting_configtext('facetoface_fromaddress', get_string('setting:fromaddress_caption', 'facetoface'),get_string('setting:fromaddress', 'facetoface'), get_string('setting:fromaddressdefault', 'facetoface'), "/^((?:[\w\.\-])+\@(?:(?:[a-zA-Z\d\-])+\.)+(?:[a-zA-Z\d]{2,4}))$/",30));

// Load roles
$choices = array();
if ($roles = $DB->get_records('role')) {
    foreach ($roles as $role) {
        $choices[$role->id] = format_string($role->name);
    }
}

$settings->add(new admin_setting_configmultiselect('facetoface_session_roles', get_string('setting:sessionroles_caption', 'facetoface'), get_string('setting:sessionroles', 'facetoface'), array(), $choices));


$settings->add(new admin_setting_heading('facetoface_manageremail_header', get_string('manageremailheading', 'facetoface'), ''));

$settings->add(new admin_setting_configcheckbox('facetoface_addchangemanageremail', get_string('setting:addchangemanageremail_caption', 'facetoface'),get_string('setting:addchangemanageremail', 'facetoface'), 0));

$settings->add(new admin_setting_configtext('facetoface_manageraddressformat', get_string('setting:manageraddressformat_caption', 'facetoface'),get_string('setting:manageraddressformat', 'facetoface'), get_string('setting:manageraddressformatdefault', 'facetoface'), PARAM_TEXT));

$settings->add(new admin_setting_configtext('facetoface_manageraddressformatreadable', get_string('setting:manageraddressformatreadable_caption', 'facetoface'),get_string('setting:manageraddressformatreadable', 'facetoface'), get_string('setting:manageraddressformatreadabledefault', 'facetoface'), PARAM_NOTAGS));


$settings->add(new admin_setting_heading('facetoface_cost_header', get_string('costheading', 'facetoface'), ''));

$settings->add(new admin_setting_configcheckbox('facetoface_hidecost', get_string('setting:hidecost_caption', 'facetoface'),get_string('setting:hidecost', 'facetoface'), 0));

$settings->add(new admin_setting_configcheckbox('facetoface_hidediscount', get_string('setting:hidediscount_caption', 'facetoface'),get_string('setting:hidediscount', 'facetoface'), 0));


$settings->add(new admin_setting_heading('facetoface_icalendar_header', get_string('icalendarheading', 'facetoface'), ''));

$settings->add(new admin_setting_configcheckbox('facetoface_oneemailperday', get_string('setting:oneemailperday_caption', 'facetoface'),get_string('setting:oneemailperday', 'facetoface'), 0));

$settings->add(new admin_setting_configcheckbox('facetoface_disableicalcancel', get_string('setting:disableicalcancel_caption', 'facetoface'),get_string('setting:disableicalcancel', 'facetoface'), 0));


// List of existing custom fields
$html = facetoface_list_of_customfields();
$html .= html_writer::start_tag('p');
$url = new moodle_url('/mod/facetoface/customfield.php', array('id' => 0));
$html .= html_writer::link($url, get_string('addnewfieldlink', 'facetoface'));
$html .= html_writer::end_tag('p');

$settings->add(new admin_setting_heading('facetoface_customfields_header', get_string('customfieldsheading', 'facetoface'), $html));

// List of existing site notices
$html = facetoface_list_of_sitenotices();
$html .= html_writer::start_tag('p');
$url = new moodle_url('/mod/facetoface/sitenotice.php', array('id' => 0));
$html .= html_writer::link($url, get_string('addnewnoticelink', 'facetoface'));
$html .= html_writer::end_tag('p');

$settings->add(new admin_setting_heading('facetoface_sitenotices_header', get_string('sitenoticesheading', 'facetoface'), $html));

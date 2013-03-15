<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2013 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @author Aaron Barnes <aaron.barnes@totaralms.com>
 * @author Francois Marier <francois@catalyst.net.nz>
 * @package modules
 * @subpackage facetoface
 */
defined('MOODLE_INTERNAL') || die();

require_once "$CFG->dirroot/mod/facetoface/lib.php";

$settings->add(new admin_setting_configtext('facetoface_fromaddress', get_string('setting:fromaddress_caption', 'facetoface'),get_string('setting:fromaddress', 'facetoface'), get_string('setting:fromaddressdefault', 'facetoface'), "/^((?:[\w\.\-])+\@(?:(?:[a-zA-Z\d\-])+\.)+(?:[a-zA-Z\d]{2,4}))$/",30));

// Load roles
$systemcontext = context_system::instance();
$choices = array();
if ($roles = role_fix_names(get_all_roles(), $systemcontext, ROLENAME_ORIGINAL)) {
    foreach ($roles as $role) {
        $choices[$role->id] = format_string($role->localname);
    }
}

$settings->add(new admin_setting_configmultiselect('facetoface_session_roles', get_string('setting:sessionroles_caption', 'facetoface'), get_string('setting:sessionroles', 'facetoface'), array(), $choices));

$settings->add(new admin_setting_configcheckbox('facetoface_allowschedulingconflicts', get_string('setting:allowschedulingconflicts_caption', 'facetoface'), get_string('setting:allowschedulingconflicts', 'facetoface'), 0));

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

// Link to notification templates
$html = html_writer::start_tag('p');
$url = new moodle_url('/mod/facetoface/notification/template/');
$html .= html_writer::link($url, get_string('managenotificationtemplates', 'facetoface'));
$html .= html_writer::end_tag('p');

$settings->add(new admin_setting_heading('facetoface_notification_template', get_string('notificationtemplates', 'facetoface'), $html));

// Link to rooms
$html = html_writer::start_tag('p');
$url = new moodle_url('/mod/facetoface/room/manage.php');
$html .= html_writer::link($url, get_string('managerooms', 'facetoface'));
$html .= html_writer::end_tag('p');

$settings->add(new admin_setting_heading('facetoface_rooms', get_string('rooms', 'facetoface'), $html));

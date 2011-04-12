<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
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
 * @author Piers Harding <piers@catalyst.net.nz>
 * @package totara
 * @subpackage totara_msg 
 */

// Display user position information
require_once('../../config.php');
require_once($CFG->dirroot.'/local/totara_msg/edit_form.php');

// Get input parameters
$user       = required_param('id', PARAM_INT);               // user id
$courseid   = required_param('course', PARAM_INT);           // course id

// Load some basic data
if (!$course = get_record('course', 'id', $courseid)) {
    error("Course id is incorrect.");
}

if (!$user = get_record('user', 'id', $user)) {
    error("User ID is incorrect");
}


// Check permissions
$personalcontext = get_context_instance(CONTEXT_USER, $user->id);
$coursecontext = get_context_instance(CONTEXT_COURSE, $course->id);

// Check logged in user can view this profile
require_login($course);

$canview = false;
if (!empty($USER->id) && ($user->id == $USER->id)) {
    // Can view own profile
    $canview = true;
}
elseif (has_capability('moodle/user:viewdetails', $coursecontext)) {
    $canview = true;
}
elseif (has_capability('moodle/user:viewdetails', $personalcontext)) {
    $canview = true;
}

if (!$canview) {
    print_error('cannotviewprofile');
}

// Is user deleted?
if ($user->deleted) {
    print_header();
    print_heading(get_string('userdeleted'));
    print_footer();
    die;
}

// Log
add_to_log($course->id, "user", "message settings view", "edit.php?id=$user->id&amp;course=$course->id", "$user->id");

/// Print tabs at top
/// This same call is made in:
///     /user/view.php
///     /user/edit.php
///     /course/user.php
$showpositions = 1;
$showmessages = 1;
$showroles = 1;
$currenttab = 'messages';
$currenturl = "{$CFG->wwwroot}/local/totara_msg/edit.php?id={$user->id}&course={$course->id}";

$navlinks = array();
$strparticipants = get_string('participants');

if ($course->id != SITEID && has_capability('moodle/course:viewparticipants', $coursecontext)) {
    $navlinks[] = array('name' => $strparticipants, 'link' => "{$CFG->wwwroot}/user/index.php?id={$course->id}", 'type' => 'misc');
}

$fullname = fullname($user, true);

$navlinks[] = array('name' => $fullname, 'link' => "{$CFG->wwwroot}/user/view.php?id={$user->id}&amp;course={$course->id}", 'type' => 'misc');
$navlinks[] = array('name' => get_string('messagesettings', 'local_totara_msg'), 'link' => null, 'type' => 'misc');
$navigation = build_navigation($navlinks);


// Form
$form = new totara_msg_settings_form($currenturl, array('user'=>$user->id));

if ($form->is_cancelled()){
    // Do nothing
} elseif ($data = $form->get_data()) {
    set_user_preference('totara_msg_send_alrt_emails', $data->totara_msg_send_alrt_emails ? 1 : 0, $user->id);
    set_user_preference('totara_msg_send_task_emails', $data->totara_msg_send_task_emails ? 1 : 0, $user->id);
    // Display success message
    totara_set_notification(get_string('settingssaved','local_totara_msg'), $currenturl, array('style' => 'notifysuccess'));
}

$current_settings = new stdClass;
$current_settings->totara_msg_send_alrt_emails = get_user_preferences('totara_msg_send_alrt_emails', 1, $user->id);
$current_settings->totara_msg_send_task_emails = get_user_preferences('totara_msg_send_task_emails', 1, $user->id);

$form->set_data($current_settings);

print_header("{$course->fullname}: {$fullname}: ".get_string('messagesettings', 'local_totara_msg'), $course->fullname, $navigation);

include($CFG->dirroot.'/user/tabs.php');

$form->display();

print_footer($course);

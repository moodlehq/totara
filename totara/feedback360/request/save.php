<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2013 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
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
 * @author David Curry <david.curry@totaralms.com>
 * @package totara
 * @subpackage totara_feedback360
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->dirroot . '/totara/feedback360/lib.php');

$userform = required_param('userform', PARAM_INT);
$system = required_param('add', PARAM_SEQUENCE);
$emails = require_param('emails', PARAM_SEQUENCE);
$duedate = required_param('date', PARAM_INT);

// Setup page
require_login();

// Check user has permission to request feedback.
require_capability('totara/feedback360:requestfeedback360', context_system::instance());

$renderer = $PAGE->get_renderer('totara_feedback360');

// Update user_assignment time due.
$user_assignment = get_record('feedback360_user_assignment', array('id' => $userform));
$user_assignment->duedate = $duedate;
$DB->update_record('feedback360_user_assignment', $user_assignment);

// Create database objects and send notifications for added system users.
$user_list = explode(',', $system);
feedback360_responder::update_system_assignments($userform, $user_list, $duedate);

// Create database objects and send emails for added external users.
$email_list = explode(',', $emails);
feedback360_responder::update_external_assignments($userform, $email_list, $duedate);

// Redirect to the myfeedback page, with a success notification.
$success_str = get_string('successfullyrequestedfeedback', 'totara_feedback360');
$redirectto = new moodle_url('/totara/feedback360/index.php');
totara_set_notification($success_str, $redirectto, array('class' => 'notifysuccess'));

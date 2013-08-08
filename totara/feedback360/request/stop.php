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

// This page cancels and unreplied feedback.
$userformid = required_param('userformid', PARAM_INT);
$confirmation = optional_param('confirm', null, PARAM_ALPHANUM);

// Check user has permission to request feedback.
require_capability('totara/feedback360:requestfeedback360', context_system::instance());

if (!$userform = $DB->get_record('feedback360_user_assignment', array('id' => $userformid))) {
    print_error('userassignmentnotfound', 'totara_feedback360');
}

$usercontext = context_system::instance();
$cancelstr = get_string('cancelrequest', 'totara_feedback360');
$ret_url = new moodle_url('/totara/feedback360/index.php');

// Set up the page.
$PAGE->set_url(new moodle_url('/totara/feedback360/request/stop.php', array('userformid' => $userformid)));
$PAGE->set_context($usercontext);
$PAGE->set_pagelayout('admin');
$PAGE->set_totara_menu_selected('myfeedback');
$PAGE->set_title($cancelstr);
$PAGE->set_heading($cancelstr);
$PAGE->navbar->add(get_string('feedback360', 'totara_feedback360'), new moodle_url('/totara/feedback360/index.php'));
$PAGE->navbar->add($cancelstr);

if (!empty($confirmation)) {
    $valid = sha1($userform->feedback360id . ':' . $userform->userid . ':' . $userform->assignedvia . ':' . $userform->timedue);
    if ($confirmation == $valid) {
        $success = get_string('cancelrequestsuccess', 'totara_feedback360');

        feedback360::cancel_user_assignment($userformid);
        totara_set_notification($success, $ret_url, array('class' => 'notifysuccess'));
    } else {
        print_error('validationfailed', 'totara_feedback360');
    }
}


// Confirmation setup.
echo $OUTPUT->header();

$strdelete = get_string('cancelrequestconfirm', 'totara_feedback360');

$sql = "SELECT *
        FROM {feedback360_resp_assignment}
        WHERE feedback360userassignmentid = :uaid
        AND timecompleted > 0";
if ($DB->record_exists_sql($sql, array('uaid' => $userformid))) {
    $strdelete .= get_string('cancelrequestcontinued', 'totara_feedback360');
}

$confirm = sha1($userform->feedback360id . ':' . $userform->userid . ':'
              . $userform->assignedvia . ':' . $userform->timedue);
$del_params = array('userformid' => $userformid, 'confirm' => $confirm);
$del_url = new moodle_url('/totara/feedback360/request/stop.php', $del_params);
echo $OUTPUT->confirm($strdelete, $del_url, $ret_url);

echo $OUTPUT->footer();

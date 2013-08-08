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

// The feedback360userassignmentid and user id used to identify the record.
$userform = required_param('userform', PARAM_INT);
$userid = required_param('userid', PARAM_INT);
$email = optional_param('email', '', PARAM_EMAIL);

// Confirmation hash.
$del = optional_param('del', '', PARAM_ALPHANUM);

// Set up some variables.
$sitecontext = context_system::instance();
$strdelrequest = get_string('removerequest', 'totara_feedback360');
$resp_params = array('feedback360userassignmentid' => $userform, 'userid' => $userid);
$resp_assignment = $DB->get_record('feedback360_resp_assignment', $resp_params);

// Check user has permission to request feedback.
require_capability('totara/feedback360:requestfeedback360', $sitecontext);

// Set up the page.
$PAGE->set_url(new moodle_url('/totara/hierarchy/prefix/goal/assign/remove.php'), $urlparams);
$PAGE->set_context($sitecontext);
$PAGE->set_pagelayout('admin');
$PAGE->set_totara_menu_selected('myappraisals');
$PAGE->set_title($strdelrequest);
$PAGE->set_heading($strdelrequest);

if ($delete) {
    // Delete.
    if ($delete != md5($type->timeassigned)) {
        print_error('error:requestdeletefailure', 'totara_feedback360');
    }

    require_sesskey();

    $delete_params = array($type->field => $modid);

    if ($type->companygoal) {
        $delete_params['goalid'] = $goalid;
    } else {
        $delete_params['id'] = $goalid;
    }

    if ($assigntype != GOAL_ASSIGNMENT_INDIVIDUAL) {
        // If it's not an individual assignment delete/transfer user assignments.
        $assignment = $DB->get_field($type->table, 'id', $delete_params);
        goal::delete_user_assignments($assigntype, $assignment);
    }

    // Then delete the assignment.
    $DB->delete_records($type->table, $delete_params);

    add_to_log(SITEID, 'goal', 'delete goal assignment', "item/view.php?id={$goalid}&amp;prefix=goal", $strassig);
    totara_set_notification(get_string('goaldeletedassignment', 'totara_hierarchy'), $returnurl, array('class' => 'notifysuccess'));
} else {
    // Display confirmation page.
    echo $OUTPUT->header();
    $delete_params = array('userform' => $userform, 'userid' => $userid, 'del' => md5($resp_assignment->timeassigned), 'sesskey' => sesskey());
    $deleteurl = new moodle_url('/totara/feedback360/request/delete.php', $delete_params);
    $returnurl = new moodle_url('/totara/feedback360/index.php');
    $username = fullname($DB->get_record('user', array('id' => $userid)));

    echo $OUTPUT->confirm(get_string('removerequestconfirmation', 'totara_feedback360', $username), $deleteurl, $returnurl);

    echo $OUTPUT->footer();
}

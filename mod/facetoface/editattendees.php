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
 * @author Francois Marier <francois@catalyst.net.nz>
 * @author Aaron Barnes <aaronb@catalyst.net.nz>
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage reportbuilder
 */

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once($CFG->dirroot.'/mod/facetoface/lib.php');
require_once($CFG->dirroot.'/totara/core/searchlib.php');

define('MAX_USERS_PER_PAGE', 5000);

$s              = required_param('s', PARAM_INT); // facetoface session ID
$add            = optional_param('add', 0, PARAM_BOOL);
$remove         = optional_param('remove', 0, PARAM_BOOL);
$showall        = optional_param('showall', 0, PARAM_BOOL);
$searchtext     = optional_param('searchtext', '', PARAM_CLEAN); // search string
$suppressemail  = optional_param('suppressemail', false, PARAM_BOOL); // send email notifications
$previoussearch = optional_param('previoussearch', 0, PARAM_BOOL);
$clear          = optional_param('clear', false, PARAM_BOOL); // new add/edit session, clear previous results
$onlycontent    = optional_param('onlycontent', false, PARAM_BOOL); // return content of attendees page
$attendees      = optional_param('attendees', '', PARAM_SEQUENCE);
$save           = optional_param('save', false, PARAM_BOOL);

if (!$session = facetoface_get_session($s)) {
    print_error('error:incorrectcoursemodulesession', 'facetoface');
}
if (!$facetoface = $DB->get_record('facetoface', array('id' => $session->facetoface))) {
    print_error('error:incorrectfacetofaceid', 'facetoface');
}
if (!$course = $DB->get_record('course', array('id' => $facetoface->course))) {
    print_error('error:coursemisconfigured', 'facetoface');
}
if (!$cm = get_coursemodule_from_instance('facetoface', $facetoface->id, $course->id)) {
    print_error('error:incorrectcoursemodule', 'facetoface');
}


// Check essential permissions
require_course_login($course);
$context = context_course::instance($course->id);
require_capability('mod/facetoface:viewattendees', $context);

// Get some language strings
$strsearch = get_string('search');
$strshowall = get_string('showall', 'moodle', '');
$strsearchresults = get_string('searchresults');
$strfacetofaces = get_string('modulenameplural', 'facetoface');
$strfacetoface = get_string('modulename', 'facetoface');


// Setup attendees array
if ($clear) {
    $attendees = facetoface_get_attendees($session->id);
} else {
    if ($attendees) {
        $attendee_array = explode(',', $attendees);
        list($attendeesin, $params) = $DB->get_in_or_equal($attendee_array);
        $attendees = $DB->get_records_sql("SELECT * FROM {user} WHERE id {$attendeesin}", $params);
    }
}

if (!$attendees) {
    $attendees = array();
}

//get users waiting approval to add to the "already attending" list as we do not want to add them again
$waitingapproval = facetoface_get_requests($session->id);

// If we are finished editing, save
if ($save && $onlycontent) {

    if (empty($_SESSION['f2f-bulk-results'])) {
        if (empty($_SESSION['f2f-bulk-results'])) {
            $_SESSION['f2f-bulk-results'] = array();
        }
    }

    $_SESSION['f2f-bulk-results'][$session->id] = array(array(), array());

    $added  = array();
    $errors = array();

    // Original booked attendees plus those awaiting approval
    $original = facetoface_get_attendees($session->id);
    foreach ($waitingapproval as $waiting) {
        if (!isset($original[$waiting->id])) {
            $original[$waiting->id] = $waiting;
        }
    }

    // Add new
    foreach ($attendees as $attendee) {
        // If not in original list, add
        if (!isset($original[$attendee->id])) {

            require_capability('mod/facetoface:addattendees', $context);

            $result = facetoface_user_import($session, $attendee->id, $suppressemail);
            if ($result['result'] !== true) {
                $errors[] = $result;
            } else {
                $result['result'] = get_string('addedsuccessfully', 'facetoface');
                $added[] = $result;
            }
        } else {
            unset($original[$attendee->id]);
        }
    }

    // Remove old
    if ($original) {
        foreach ($original as $orig) {
            require_capability('mod/facetoface:removeattendees', $context);

            if (facetoface_user_cancel($session, $orig->id, true, $cancelerr)) {
                // Notify the user of the cancellation if the session hasn't started yet
                $timenow = time();
                if (!$suppressemail and !facetoface_has_session_started($session, $timenow)) {
                    facetoface_send_cancellation_notice($facetoface, $session, $orig->id);
                }

                $result = array();
                $result['id'] = $orig->id;
                $result['name'] = fullname($orig);
                $result['result'] = get_string('removedsuccessfully', 'facetoface');
                $added[] = $result;
            } else {
                $result = array();
                $result['id'] = $orig->id;
                $result['name'] = fullname($orig);
                $result['result'] = $cancelerr;
                $errors[] = $result;
            }
        }

        // Update attendees
        facetoface_update_attendees($session);
    }

    if (!empty($added) || !empty($errors)) {
        $result_message = facetoface_generate_bulk_result_notice(array($added, $errors), 'addedit');
    }

    $_SESSION['f2f-bulk-results'][$session->id][0] = $added;
    $_SESSION['f2f-bulk-results'][$session->id][1] = $errors;

    require($CFG->dirroot . '/mod/facetoface/attendees.php');
    die();
}

//add the waiting-approval users - we don't want to add them again
foreach ($waitingapproval as $waiting) {
    if (!isset($attendees[$waiting->id])) {
        $attendees[$waiting->id] = $waiting;
    }
}
// Handle the POST actions sent to the page
if ($frm = data_submitted()) {
    // Add button
    if ($add and !empty($frm->addselect) and confirm_sesskey()) {
        foreach ($frm->addselect as $adduser) {
            if (!$adduser = clean_param($adduser, PARAM_INT)) {
                continue; // invalid userid
            }

            $adduser = $DB->get_record('user', array('id' => $adduser));
            if ($adduser) {
                $attendees[$adduser->id] = $adduser;
            }
        }
    } else if ($remove and !empty($frm->removeselect) and confirm_sesskey()) { // Remove button
        foreach ($frm->removeselect as $removeuser) {
            if (!$removeuser = clean_param($removeuser, PARAM_INT)) {
                continue; // invalid userid
            }

            if (isset($attendees[$removeuser])) {
                unset($attendees[$removeuser]);
            }
        }

    } else if ($showall) { // "Show All" button
        $searchtext = '';
        $previoussearch = 0;
    }
}

// Main page
$attendeescount = count($attendees);

$where = "username <> 'guest' AND deleted = 0 AND confirmed = 1";
$params = array();

// Apply search terms
$searchtext = trim($searchtext);
if ($searchtext !== '') {   // Search for a subset of remaining users
    $fullname  = $DB->sql_fullname();
    $fields = array($fullname, 'email', 'idnumber', 'username');
    $keywords = totara_search_parse_keywords($searchtext);
    list($searchwhere, $searchparams) = totara_search_get_keyword_where_clause($keywords, $fields);

    $where .= ' AND ' . $searchwhere;
    $params = array_merge($params, $searchparams);
}

// All non-signed up system users
if ($attendees) {
    list($attendee_sql, $attendee_params) = $DB->get_in_or_equal(array_keys($attendees), SQL_PARAMS_QM, 'param', false);
    $where .= ' AND id ' . $attendee_sql;
    $params = array_merge($params, $attendee_params);
}

$availableusers = $DB->get_recordset_sql("SELECT id, firstname, lastname, email
                                       FROM {user}
                                      WHERE {$where}
                                      ORDER BY lastname ASC, firstname ASC
", $params);

$usercount = $DB->count_records_select('user', $where, $params);

// Prints a form to add/remove users from the session
include('editattendees.html');

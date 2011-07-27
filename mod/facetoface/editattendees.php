<?php

require_once '../../config.php';
require_once 'lib.php';

define('MAX_USERS_PER_PAGE', 5000);

$s              = required_param('s', PARAM_INT); // facetoface session ID
$add            = optional_param('add', 0, PARAM_BOOL);
$remove         = optional_param('remove', 0, PARAM_BOOL);
$showall        = optional_param('showall', 0, PARAM_BOOL);
$searchtext     = optional_param('searchtext', '', PARAM_CLEAN); // search string
$suppressemail  = optional_param('suppressemail', false, PARAM_BOOL); // send email notifications
$previoussearch = optional_param('previoussearch', 0, PARAM_BOOL);
$backtoallsessions = optional_param('backtoallsessions', 0, PARAM_INT); // facetoface activity to go back to

if (!$session = facetoface_get_session($s)) {
    print_error('error:incorrectcoursemodulesession', 'facetoface');
}
if (!$facetoface = get_record('facetoface', 'id', $session->facetoface)) {
    print_error('error:incorrectfacetofaceid', 'facetoface');
}
if (!$course = get_record('course', 'id', $facetoface->course)) {
    print_error('error:coursemisconfigured', 'facetoface');
}
if (!$cm = get_coursemodule_from_instance('facetoface', $facetoface->id, $course->id)) {
    print_error('error:incorrectcoursemodule', 'facetoface');
}

/// Check essential permissions
require_course_login($course);
$context = get_context_instance(CONTEXT_COURSE, $course->id);
require_capability('mod/facetoface:viewattendees', $context);

/// Get some language strings
$strsearch = get_string('search');
$strshowall = get_string('showall');
$strsearchresults = get_string('searchresults');
$strfacetofaces = get_string('modulenameplural', 'facetoface');
$strfacetoface = get_string('modulename', 'facetoface');

$errors = array();

/// Handle the POST actions sent to the page
if ($frm = data_submitted()) {

    // Add button
    if ($add and !empty($frm->addselect) and confirm_sesskey()) {
        require_capability('mod/facetoface:addattendees', $context);

        foreach ($frm->addselect as $adduser) {
            if (!$adduser = clean_param($adduser, PARAM_INT)) {
                continue; // invalid userid
            }

            // Make sure that the user is enroled in the course
            if (!has_capability('moodle/course:view', $context, $adduser)) {
                $user = get_record('user', 'id', $adduser);

                if (!enrol_into_course($course, $user, 'manual')) {
                    $errors[] = get_string('error:enrolmentfailed', 'facetoface', fullname($user));
                    $errors[] = get_string('error:addattendee', 'facetoface', fullname($user));
                    continue; // don't sign the user up
                }
            }

            if (facetoface_get_user_submissions($facetoface->id, $adduser)) {
                $erruser = get_record('user', 'id', $adduser, '','','','', 'id, firstname, lastname');
                $errors[] = get_string('error:addalreadysignedupattendee', 'facetoface', fullname($erruser));
            }
            else {
                if (!facetoface_session_has_capacity($session, $context)) {
                    $errors[] = get_string('full', 'facetoface');
                    break; // no point in trying to add other people
                }

                // Check if we are waitlisting or booking
                if ($session->datetimeknown) {
                    $status = MDL_F2F_STATUS_BOOKED;
                } else {
                    $status = MDL_F2F_STATUS_WAITLISTED;
                }

                if (!facetoface_user_signup($session, $facetoface, $course, '', MDL_F2F_BOTH,
                                                $status, $adduser, !$suppressemail)) {
                    $erruser = get_record('user', 'id', $adduser, '','','','', 'id, firstname, lastname');
                    $errors[] = get_string('error:addattendee', 'facetoface', fullname($erruser));
                }
            }
        }
    }
    // Remove button
    else if ($remove and !empty($frm->removeselect) and confirm_sesskey()) {
        require_capability('mod/facetoface:removeattendees', $context);

        foreach ($frm->removeselect as $removeuser) {
            if (!$removeuser = clean_param($removeuser, PARAM_INT)) {
                continue; // invalid userid
            }

            if (facetoface_user_cancel($session, $removeuser, true, $cancelerr)) {
                // Notify the user of the cancellation if the session hasn't started yet
                $timenow = time();
                if (!$suppressemail and !facetoface_has_session_started($session, $timenow)) {
                    facetoface_send_cancellation_notice($facetoface, $session, $removeuser);
                }
            }
            else {
                $errors[] = $cancelerr;
                $erruser = get_record('user', 'id', $removeuser, '','','','', 'id, firstname, lastname');
                $errors[] = get_string('error:removeattendee', 'facetoface', fullname($erruser));
            }
        }

        // Update attendees
        facetoface_update_attendees($session);
    }
    // "Show All" button
    elseif ($showall) {
        $searchtext = '';
        $previoussearch = 0;
    }
}

/// Main page
$pagetitle = format_string($facetoface->name);
$navlinks[] = array('name' => $strfacetofaces, 'link' => "index.php?id=$course->id", 'type' => 'title');
$navlinks[] = array('name' => $pagetitle, 'link' => "view.php?f=$facetoface->id", 'type' => 'activityinstance');
$navlinks[] = array('name' => get_string('attendees', 'facetoface'), 'link' => "attendees.php?s=$session->id&amp;backtoallsessions=$backtoallsessions", 'type' => 'activityinstance');
$navlinks[] = array('name' => get_string('addremoveattendees', 'facetoface'), 'link' => '', 'type' => 'title');
$navigation = build_navigation($navlinks);
print_header_simple($pagetitle, '', $navigation, '', '', true,
                    update_module_button($cm->id, $course->id, $strfacetoface), navmenu($course, $cm));

print_box_start();
print_heading(get_string('addremoveattendees', 'facetoface'), 'center');

/// Get the list of currently signed-up users
$existingusers = facetoface_get_attendees($session->id);
$existingcount = $existingusers ? count($existingusers) : 0;

$select  = "username <> 'guest' AND deleted = 0 AND confirmed = 1";

/// Apply search terms
$searchtext = trim($searchtext);
if ($searchtext !== '') {   // Search for a subset of remaining users
    $LIKE      = sql_ilike();
    $FULLNAME  = sql_fullname();

    $selectsql = " AND ($FULLNAME $LIKE '%$searchtext%' OR
                            email $LIKE '%$searchtext%' OR
                         idnumber $LIKE '%$searchtext%' OR
                         username $LIKE '%$searchtext%') ";
    $select  .= $selectsql;
}

/// All non-signed up system users
$availableusers = get_recordset_sql('SELECT id, firstname, lastname, email
                                       FROM '.$CFG->prefix.'user
                                      WHERE '.$select.'
                                        AND id NOT IN
                                          (
                                            SELECT u.id
                                              FROM '.$CFG->prefix.'facetoface_signups s
                                              JOIN '.$CFG->prefix.'facetoface_signups_status ss ON s.id = ss.signupid
                                              JOIN '.$CFG->prefix.'user u ON u.id=s.userid
                                             WHERE s.sessionid='.$session->id.'
                                               AND ss.statuscode >= '.MDL_F2F_STATUS_BOOKED.'
                                               AND ss.superceded = 0
                                          )
                                          ORDER BY lastname ASC, firstname ASC');

$usercount = count_records_select('user', $select) - $existingcount;


// Get all signed up non-attendees
$nonattendees = 0;
$nonattendees_rs = get_recordset_sql(
    "
        SELECT
            u.id,
            u.firstname,
            u.lastname,
            u.email,
            ss.statuscode
        FROM
            {$CFG->prefix}facetoface_sessions s
        JOIN
            {$CFG->prefix}facetoface_signups su
         ON s.id = su.sessionid
        JOIN
            {$CFG->prefix}facetoface_signups_status ss
         ON su.id = ss.signupid
        JOIN
            {$CFG->prefix}user u
         ON u.id = su.userid
        WHERE
            s.id = {$session->id}
        AND ss.superceded != 1
        AND ss.statuscode = ".MDL_F2F_STATUS_REQUESTED."
        ORDER BY
            u.lastname, u.firstname
    "
);

$table = new object();
$table->head = array(get_string('name'), get_string('email'), get_string('status'));
$table->align = array('left');
$table->size = array('50%');
$table->width = '70%';

while ($user = rs_fetch_next_record($nonattendees_rs)) {
    $data = array();
    $data[] = fullname($user);
    $data[] = $user->email;
    $data[] = get_string('status_'.facetoface_get_status($user->statuscode), 'facetoface');

    $table->data[] = $data;
    $nonattendees++;
}


/// Prints a form to add/remove users from the session
include('editattendees.html');

if (!empty($errors)) {
    $msg = '<p>';
    foreach ($errors as $e) {
        $msg .= $e.'<br />';
    }
    $msg .= '</p>';
    print_simple_box_start('center');
    notify($msg);
    print_simple_box_end();
}

// Bottom of the page links
print '<p style="text-align: center">';
$url = $CFG->wwwroot.'/mod/facetoface/attendees.php?s='.$session->id.'&amp;backtoallsessions='.$backtoallsessions;
print '<a href="'.$url.'">'.get_string('goback', 'facetoface').'</a></p>';

print_box_end();
print_footer($course);

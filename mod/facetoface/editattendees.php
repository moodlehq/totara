<?php
require_once '../../config.php';
require_once 'lib.php';

global $DB, $THEME;

define('MAX_USERS_PER_PAGE', 5000);

$s              = required_param('s', PARAM_INT); // facetoface session ID
$add            = optional_param('add', 0, PARAM_BOOL);
$remove         = optional_param('remove', 0, PARAM_BOOL);
$showall        = optional_param('showall', 0, PARAM_BOOL);
$searchtext     = optional_param('searchtext', '', PARAM_TEXT); // search string
$suppressemail  = optional_param('suppressemail', false, PARAM_BOOL); // send email notifications
$previoussearch = optional_param('previoussearch', 0, PARAM_BOOL);
$backtoallsessions = optional_param('backtoallsessions', 0, PARAM_INT); // facetoface activity to go back to

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

/// Check essential permissions
require_course_login($course);
$context = context_course::instance($course->id);
require_capability('mod/facetoface:viewattendees', $context);

/// Get some language strings
$strsearch = get_string('search');
$strshowall = get_string('showall');
$strsearchresults = get_string('searchresults');
$strfacetofaces = get_string('modulenameplural', 'facetoface');
$strfacetoface = get_string('modulename', 'facetoface');

$errors = array();
// Get the user_selector we will need.
$potentialuserselector = new facetoface_candidate_selector('addselect', array('sessionid'=>$session->id));
$existinguserselector = new facetoface_existing_selector('removeselect', array('sessionid'=>$session->id));

// Process incoming user assignments
if (optional_param('add', false, PARAM_BOOL) && confirm_sesskey()) {
    require_capability('mod/facetoface:addattendees', $context);
    $userstoassign = $potentialuserselector->get_selected_users();
    if (!empty($userstoassign)) {
        foreach ($userstoassign as $adduser) {
            if (!$adduser = clean_param($adduser->id, PARAM_INT)) {
                continue; // invalid userid
            }
            // Make sure that the user is enroled in the course
            if (!has_capability('moodle/course:view', $context, $adduser)) {
                $user = $DB->get_record('user', array('id' => $adduser));
                if (!enrol_try_internal_enrol($course->id, $user->id)) {
                    $errors[] = get_string('error:enrolmentfailed', 'facetoface', fullname($user));
                    $errors[] = get_string('error:addattendee', 'facetoface', fullname($user));
                    continue; // don't sign the user up
                }
            }

            if (facetoface_get_user_submissions($facetoface->id, $adduser)) {
                $erruser = $DB->get_record('user', array('id' => $adduser),'id, firstname, lastname');
                $errors[] = get_string('error:addalreadysignedupattendee', 'facetoface', fullname($erruser));
            } else {
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
                    $erruser = $DB->get_record('user', array('id' => $adduser),'id, firstname, lastname');
                    $errors[] = get_string('error:addattendee', 'facetoface', fullname($erruser));
                }
            }
        }
        $potentialuserselector->invalidate_selected_users();
        $existinguserselector->invalidate_selected_users();
    }
}

// Process removing user assignments from session
if (optional_param('remove', false, PARAM_BOOL) && confirm_sesskey()) {
    require_capability('mod/facetoface:removeattendees', $context);
    $userstoremove = $existinguserselector->get_selected_users();
    if (!empty($userstoremove)) {
        foreach ($userstoremove as $removeuser) {
            if (!$removeuser = clean_param($removeuser->id, PARAM_INT)) {
                continue; // invalid userid
            }

            if (facetoface_user_cancel($session, $removeuser, true, $cancelerr)) {
                // Notify the user of the cancellation if the session hasn't started yet
                $timenow = time();
                if (!$suppressemail and !facetoface_has_session_started($session, $timenow)) {
                    facetoface_send_cancellation_notice($facetoface, $session, $removeuser);
                }
            } else {
                $errors[] = $cancelerr;
                $erruser = $DB->get_record('user', array('id' => $removeuser),'id, firstname, lastname');
                $errors[] = get_string('error:removeattendee', 'facetoface', fullname($erruser));
            }
        }
        $potentialuserselector->invalidate_selected_users();
        $existinguserselector->invalidate_selected_users();
        // Update attendees
        facetoface_update_attendees($session);
    }
}

/// Main page
$pagetitle = format_string($facetoface->name);

$PAGE->set_cm($cm);
$PAGE->set_url('/mod/facetoface/editattendees.php', array('s' => $s, 'backtoallsessions' => $backtoallsessions));

$PAGE->set_title($pagetitle);
$PAGE->set_heading($course->fullname);
echo $OUTPUT->header();


echo $OUTPUT->box_start();
echo $OUTPUT->heading(get_string('addremoveattendees', 'facetoface'));

//create user_selector form
$out = html_writer::start_tag('form', array('id' => 'assignform', 'method' => 'post', 'action' => $PAGE->url));
$out .= html_writer::start_tag('div');
$out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "previoussearch", 'value' => $previoussearch));
$out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "backtoallsessions", 'value' => $backtoallsessions));
$out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "sesskey", 'value' => sesskey()));

$table = new html_table();
$table->attributes['class'] = "generaltable generalbox boxaligncenter";
$cells = array();
$content = html_writer::start_tag('p') . html_writer::tag('label', get_string('attendees', 'facetoface'), array('for' => 'removeselect')) . html_writer::end_tag('p');
$content .= $existinguserselector->display(true);
$cell = new html_table_cell($content);
$cell->attributes['id'] = 'existingcell';
$cells[] = $cell;
$content = html_writer::tag('div', html_writer::empty_tag('input', array('type' => 'submit', 'id' => 'add', 'name' => 'add', 'title' => get_string('add'), 'value' => $OUTPUT->larrow().' '.get_string('add'))), array('id' => 'addcontrols'));
$content .= html_writer::tag('div', html_writer::empty_tag('input', array('type' => 'submit', 'id' => 'remove', 'name' => 'remove', 'title' => get_string('remove'), 'value' => $OUTPUT->rarrow().' '.get_string('remove'))), array('id' => 'removecontrols'));
$cell = new html_table_cell($content);
$cell->attributes['id'] = 'buttonscell';
$cells[] = $cell;
$content = html_writer::start_tag('p') . html_writer::tag('label', get_string('potentialattendees', 'facetoface'), array('for' => 'addselect')) . html_writer::end_tag('p');
$content .= $potentialuserselector->display(true);
$cell = new html_table_cell($content);
$cell->attributes['id'] = 'potentialcell';
$cells[] = $cell;
$table->data[] = new html_table_row($cells);
$content = html_writer::checkbox('suppressemail', 1, $suppressemail, get_string('suppressemail', 'facetoface'), array('id' => 'suppressemail'));
$content .= $OUTPUT->help_icon('suppressemail', 'facetoface');
$cell = new html_table_cell($content);
$cell->attributes['id'] = 'backcell';
$cell->attributes['colspan'] = '3';
$table->data[] = new html_table_row(array($cell));

$out .=  html_writer::table($table);

    // Get all signed up non-attendees
    $nonattendees = 0;
    $nonattendees_rs = $DB->get_recordset_sql(
         "SELECT
                u.id,
                u.firstname,
                u.lastname,
                u.email,
                ss.statuscode
            FROM
                {facetoface_sessions} s
            JOIN
                {facetoface_signups} su
             ON s.id = su.sessionid
            JOIN
                {facetoface_signups_status} ss
             ON su.id = ss.signupid
            JOIN
                {user} u
             ON u.id = su.userid
            WHERE
                s.id = ?
            AND ss.superceded != 1
            AND ss.statuscode = ?
            ORDER BY
                u.lastname, u.firstname", array($session->id, MDL_F2F_STATUS_REQUESTED)
    );

    $table = new html_table();
    $table->head = array(get_string('name'), get_string('email'), get_string('status'));
    foreach ($nonattendees_rs as $user) {
        $data = array();
        $data[] = new html_table_cell(fullname($user));
        $data[] = new html_table_cell($user->email);
        $data[] = new html_table_cell(get_string('status_'.facetoface_get_status($user->statuscode), 'facetoface'));
        $row = new html_table_row($data);
        $table->data[] = $row;
        $nonattendees++;
    }
    $nonattendees_rs->close();
    if ($nonattendees) {
        $out .= html_writer::empty_tag('br');
        $out .=  $OUTPUT->heading(get_string('unapprovedrequests', 'facetoface').' ('.$nonattendees.')');
        $out .=  html_writer::table($table);
    }

    $out .= html_writer::end_tag('div') . html_writer::end_tag('form');
    echo $out;

if (!empty($errors)) {
    $msg = html_writer::start_tag('p');
    foreach ($errors as $e) {
        $msg .= $e . html_writer::empty_tag('br');
    }
    $msg .= html_writer::end_tag('p');
    echo $OUTPUT->box_start('center');
    echo $OUTPUT->notification($msg);
    echo $OUTPUT->box_end();
}

// Bottom of the page links
echo html_writer::start_tag('p');
$url = new moodle_url('/mod/facetoface/attendees.php', array('s' => $session->id, 'backtoallsessions' => $backtoallsessions));
echo html_writer::link($url, get_string('goback', 'facetoface'));
echo html_writer::end_tag('p');
echo $OUTPUT->box_end();
echo $OUTPUT->footer($course);

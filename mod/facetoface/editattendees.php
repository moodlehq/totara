<?php

require_once('../../config.php');
require_once('lib.php');

define("MAX_USERS_PER_PAGE", 5000);

$s              = required_param('s', PARAM_INT); // facetoface session ID
$add            = optional_param('add', 0, PARAM_BOOL);
$remove         = optional_param('remove', 0, PARAM_BOOL);
$showall        = optional_param('showall', 0, PARAM_BOOL);
$searchtext     = optional_param('searchtext', '', PARAM_RAW); // search string
$suppressemail  = optional_param('suppressemail', false, PARAM_BOOL); // send email notifications
$previoussearch = optional_param('previoussearch', 0, PARAM_BOOL);

if (!$session = facetoface_get_session($s)) {
    error(get_string('error:incorrectcoursemodulesession', 'facetoface'));
}
if (!$facetoface = get_record('facetoface', 'id', $session->facetoface)) {
    error(get_string('error:incorrectfacetofaceid', 'facetoface'));
}
if (!$course = get_record('course', 'id', $facetoface->course)) {
    error(get_string('error:coursemisconfigured', 'facetoface'));
}
if (!$cm = get_coursemodule_from_instance('facetoface', $facetoface->id, $course->id)) {
    error(get_string('error:incorrectcoursemodule', 'facetoface'));
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
        require_capability('mod/facetoface:editattendees', $context);

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
            elseif (!facetoface_user_signup($session, $facetoface, $course, '', MDL_F2F_BOTH,
                                            $adduser, !$suppressemail, false)) {
                $erruser = get_record('user', 'id', $adduser, '','','','', 'id, firstname, lastname');
                $errors[] = get_string('error:addattendee', 'facetoface', fullname($erruser));
            }
        }
    }
    // Remove button
    else if ($remove and !empty($frm->removeselect) and confirm_sesskey()) {
        require_capability('mod/facetoface:editattendees', $context);

        foreach ($frm->removeselect as $removeuser) {
            if (!$removeuser = clean_param($removeuser, PARAM_INT)) {
                continue; // invalid userid
            }

            if (facetoface_user_cancel($session, $removeuser)) {
                // Notify the user of the cancellation if the session hasn't started yet
                $timenow = time();
                if (!$suppressemail and !facetoface_has_session_started($session, $timenow)) {
                    facetoface_send_cancellation_notice($facetoface, $session, $removeuser);
                }
            }
            else {
                $erruser = get_record('user', 'id', $removeuser, '','','','', 'id, firstname, lastname');
                $errors[] = get_string('error:removeattendee', 'facetoface', fullname($erruser));
            }
        }
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
$navlinks[] = array('name' => get_string('attendees', 'facetoface'), 'link' => "attendees.php?s=$session->id", 'type' => 'activityinstance');
$navlinks[] = array('name' => get_string('addremoveattendees', 'facetoface'), 'link' => '', 'type' => 'title');
$navigation = build_navigation($navlinks);
print_header_simple($pagetitle, '', $navigation, '', '', true,
                    update_module_button($cm->id, $course->id, $strfacetoface), navmenu($course, $cm));

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

    $selectsql = " AND ($FULLNAME $LIKE '%$searchtext%' OR email $LIKE '%$searchtext%') ";
    $select  .= $selectsql;
}

/// All non-signed up system users
$availableusers = get_recordset_sql('SELECT id, firstname, lastname, email
                                       FROM '.$CFG->prefix.'user
                                      WHERE '.$select.'
                                        AND id NOT IN
                                          (
                                            SELECT u.id
                                              FROM '.$CFG->prefix.'facetoface_submissions s
                                              JOIN '.$CFG->prefix.'user u ON u.id=s.userid
                                             WHERE s.sessionid='.$session->id.'
                                               AND s.timecancelled = 0
                                          )
                                          ORDER BY lastname ASC, firstname ASC');

$usercount = count_records_select('user', $select) - $existingcount;

/// Prints a form to add/remove users from the session
print_simple_box_start('center');
include('editattendees.html');
print_simple_box_end();

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
$url = $CFG->wwwroot.'/mod/facetoface/attendees.php?s='.$session->id;
print '<a href="'.$url.'">'.get_string('goback', 'facetoface').'</a></p>';

print_footer($course);

?>

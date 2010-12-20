<?php

require_once '../../config.php';
require_once 'lib.php';
require_once 'signup_form.php';

$s = required_param('s', PARAM_INT); // facetoface session ID
$backtoallsessions = optional_param('backtoallsessions', 0, PARAM_INT);

if (!$session = facetoface_get_session($s)) {
    print_error('error:incorrectcoursemodulesession', 'facetoface');
}
if (!$facetoface = get_record('facetoface', 'id', $session->facetoface)) {
    print_error('error:incorrectfacetofaceid', 'facetoface');
}
if (!$course = get_record('course', 'id', $facetoface->course)) {
    print_error('error:coursemisconfigured', 'facetoface');
}
if (!$cm = get_coursemodule_from_instance("facetoface", $facetoface->id, $course->id)) {
    print_error('error:incorrectcoursemoduleid', 'facetoface');
}

require_course_login($course);
$context = get_context_instance(CONTEXT_COURSE, $course->id);
require_capability('mod/facetoface:view', $context);

$returnurl = "$CFG->wwwroot/course/view.php?id=$course->id";
if ($backtoallsessions) {
    $returnurl = "$CFG->wwwroot/mod/facetoface/view.php?f=$backtoallsessions";
}

$pagetitle = format_string($facetoface->name);
$navlinks[] = array('name' => get_string('modulenameplural', 'facetoface'), 'link' => "index.php?id=$course->id", 'type' => 'title');
$navlinks[] = array('name' => $pagetitle, 'link' => '', 'type' => 'activityinstance');
$navigation = build_navigation($navlinks);

// Guests can't signup for a session, so offer them a choice of logging in or going back.
if (isguestuser()) {
    $loginurl = $CFG->wwwroot.'/login/index.php';
    if (!empty($CFG->loginhttps)) {
        $loginurl = str_replace('http:','https:', $loginurl);
    }

    print_header_simple($pagetitle, '', $navigation, '', '', true,
                    update_module_button($cm->id, $course->id, get_string('modulename', 'facetoface')));
    notice_yesno('<p>' . get_string('guestsno', 'facetoface') . "</p>\n\n</p>" .
        get_string('liketologin') . '</p>', $loginurl, get_referer(false));
    print_footer();
    exit();
}

require_capability('mod/facetoface:signup', $context);

$manageremail = false;
if (get_config(NULL, 'facetoface_addchangemanageremail')) {
    $manageremail = facetoface_get_manageremail($USER->id);
}

$showdiscountcode = ($session->discountcost > 0);

$mform = new mod_facetoface_signup_form(null, compact('s', 'backtoallsessions', 'manageremail', 'showdiscountcode'));
if ($mform->is_cancelled()){
    redirect($returnurl);
}

if ($fromform = $mform->get_data()) { // Form submitted

    if (empty($fromform->submitbutton)) {
        print_error('error:unknownbuttonclicked', 'facetoface', $returnurl);
    }

    // User can not update Manager's email (depreciated functionality)
    if (!empty($fromform->manageremail)) {
        add_to_log($course->id, 'facetoface', 'update manageremail (FAILED)', "signup.php?s=$session->id", $facetoface->id, $cm->id);
    }

    // Get signup type
    if (!$session->datetimeknown) {
        $statuscode = MDL_F2F_STATUS_WAITLISTED;
    } elseif (facetoface_get_num_attendees($session->id) < $session->capacity) {
        // Save available
        $statuscode = MDL_F2F_STATUS_BOOKED;
    } else {
        $statuscode = MDL_F2F_STATUS_WAITLISTED;
    }

    if (!facetoface_session_has_capacity($session, $context) && (!$session->allowoverbook)) {
        print_error('sessionisfull', 'facetoface', $returnurl);
    }
    elseif (facetoface_get_user_submissions($facetoface->id, $USER->id)) {
        print_error('alreadysignedup', 'facetoface', $returnurl);
    }
    elseif (facetoface_manager_needed($facetoface) && !facetoface_get_manageremail($USER->id)){
        print_error('error:manageremailaddressmissing', 'facetoface', $returnurl);
    }
    elseif ($submissionid = facetoface_user_signup($session, $facetoface, $course, $fromform->discountcode, $fromform->notificationtype, $statuscode)) {
        add_to_log($course->id, 'facetoface','signup',"signup.php?s=$session->id", $session->id, $cm->id);

        $message = get_string('bookingcompleted', 'facetoface');
        if ($session->datetimeknown && $facetoface->confirmationinstrmngr) {
            $message .= '<br /><br />'.get_string('confirmationsentmgr', 'facetoface');
        }
        else {
            $message .= '<br /><br />'.get_string('confirmationsent', 'facetoface');
        }

        $timemessage = 4;
        redirect($returnurl, $message, $timemessage);
    }
    else {
        add_to_log($course->id, 'facetoface','signup (FAILED)',"signup.php?s=$session->id", $session->id, $cm->id);
        print_error('error:problemsigningup', 'facetoface', $returnurl);
    }

    redirect($returnurl);
}
elseif ($manageremail !== false) {
    // Set values for the form
    $toform = new object();
    $toform->manageremail = $manageremail;
    $mform->set_data($toform);
}

print_header_simple($pagetitle, '', $navigation, '', '', true,
                    update_module_button($cm->id, $course->id, get_string('modulename', 'facetoface')));

$heading = get_string('signupfor', 'facetoface', $facetoface->name);

$viewattendees = has_capability('mod/facetoface:viewattendees', $context);
$signedup = facetoface_check_signup($facetoface->id);

if ($signedup and $signedup != $session->id) {
    print_error('error:signedupinothersession', 'facetoface', $returnurl);
}

print_box_start();
print_heading($heading, 'center');

if (!$signedup && !facetoface_session_has_capacity($session, $context) && (!$session->allowoverbook)) {
    print_error('sessionisfull', 'facetoface', $returnurl);
    print_box_end();
    print_footer($course);
    exit;
}

facetoface_print_session($session, $viewattendees);

if ($signedup) {
    if(!($session->datetimeknown && facetoface_has_session_started($session, time()))) {
        // Cancellation link
        echo '<a href="'.$CFG->wwwroot.'/mod/facetoface/cancelsignup.php?s='.$session->id.'&amp;backtoallsessions='.$backtoallsessions.'" title="'.get_string('cancelbooking','facetoface').'">'.get_string('cancelbooking', 'facetoface').'</a>';
        echo ' &ndash; ';
    }
    // See attendees link
    if ($viewattendees) {
        echo '<a href="'.$CFG->wwwroot.'/mod/facetoface/attendees.php?s='.$session->id.'&amp;backtoallsessions='.$backtoallsessions.'" title="'.get_string('seeattendees', 'facetoface').'">'.get_string('seeattendees', 'facetoface').'</a>';
    }

    echo '<br/><a href="'.$returnurl.'" title="'.get_string('goback', 'facetoface').'">'.get_string('goback', 'facetoface').'</a>';
}
// Don't allow signup to proceed if a manager is required
elseif (facetoface_manager_needed($facetoface) && !facetoface_get_manageremail($USER->id)){
    // Check to see if the user has a managers email set
    echo '<p><strong>'.get_string('error:manageremailaddressmissing', 'facetoface').'</strong></p>';
    echo '<br/><a href="'.$returnurl.'" title="'.get_string('goback', 'facetoface').'">'.get_string('goback', 'facetoface').'</a>';
}
else {
    // Signup form
    $mform->display();
}

print_box_end();
print_footer($course);

<?php

require_once '../../config.php';
require_once 'lib.php';
require_once 'cancelsignup_form.php';

$s  = required_param('s', PARAM_INT); // facetoface session ID
$confirm           = optional_param('confirm', false, PARAM_BOOL);
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

$mform = new mod_facetoface_cancelsignup_form(null, compact('s', 'backtoallsessions'));
if ($mform->is_cancelled()){
    redirect($returnurl);
}

if ($fromform = $mform->get_data()) { // Form submitted

    if (empty($fromform->submitbutton)) {
        print_error('error:unknownbuttonclicked', 'facetoface', $returnurl);
    }

    $timemessage = 4;

    $errorstr = '';
    if (facetoface_user_cancel($session, false, false, $errorstr, $fromform->cancelreason)) {
        add_to_log($course->id, 'facetoface', 'cancel booking', "cancelsignup.php?s=$session->id", $facetoface->id, $cm->id);

        $message = get_string('bookingcancelled', 'facetoface');

        if ($session->datetimeknown) {
            $error = facetoface_send_cancellation_notice($facetoface, $session, $USER->id);
            if (empty($error)) {
                if ($session->datetimeknown && $facetoface->cancellationinstrmngr) {
                    $message .= '<br /><br />'.get_string('cancellationsentmgr', 'facetoface');
                }
                else {
                    $message .= '<br /><br />'.get_string('cancellationsent', 'facetoface');
                }
            }
            else {
                error($error);
            }
        }

        redirect($returnurl, $message, $timemessage);
    }
    else {
        add_to_log($course->id, 'facetoface', "cancel booking (FAILED)", "cancelsignup.php?s=$session->id", $facetoface->id, $cm->id);
        redirect($returnurl, $errorstr, $timemessage);
    }

    redirect($returnurl);
}

$pagetitle = format_string($facetoface->name);
$navlinks[] = array('name' => get_string('modulenameplural', 'facetoface'), 'link' => "index.php?id=$course->id", 'type' => 'title');
$navlinks[] = array('name' => $pagetitle, 'link' => '', 'type' => 'activityinstance');
$navigation = build_navigation($navlinks);
print_header_simple($pagetitle, '', $navigation, '', '', true,
                    update_module_button($cm->id, $course->id, get_string('modulename', 'facetoface')));

$heading = get_string('cancelbookingfor', 'facetoface', $facetoface->name);

$viewattendees = has_capability('mod/facetoface:viewattendees', $context);
$signedup = facetoface_check_signup($facetoface->id);

print_box_start();
print_heading($heading, 'center');

if ($signedup) {
    facetoface_print_session($session, $viewattendees);
    $mform->display();
}
else {
    print_error('notsignedup', 'facetoface', $returnurl);
}

print_box_end();
print_footer($course);

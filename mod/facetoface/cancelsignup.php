<?php

require_once '../../config.php';
require_once 'lib.php';
require_once 'cancelsignup_form.php';

global $DB;

$s  = required_param('s', PARAM_INT); // facetoface session ID
$confirm           = optional_param('confirm', false, PARAM_BOOL);
$backtoallsessions = optional_param('backtoallsessions', 0, PARAM_INT);

if (!$session = facetoface_get_session($s)) {
    print_error('error:incorrectcoursemodulesession', 'facetoface');
}
if (!$facetoface = $DB->get_record('facetoface', array('id' => $session->facetoface))) {
    print_error('error:incorrectfacetofaceid', 'facetoface');
}
if (!$course = $DB->get_record('course', array('id' => $facetoface->course))) {
    print_error('error:coursemisconfigured', 'facetoface');
}
if (!$cm = get_coursemodule_from_instance("facetoface", $facetoface->id, $course->id)) {
    print_error('error:incorrectcoursemoduleid', 'facetoface');
}

require_course_login($course);
$context = context_course::instance($course->id);
require_capability('mod/facetoface:view', $context);

$returnurl = "$CFG->wwwroot/course/view.php?id=$course->id";
if ($backtoallsessions) {
    $returnurl = "$CFG->wwwroot/mod/facetoface/view.php?f=$backtoallsessions";
}

$mform = new mod_facetoface_cancelsignup_form(null, compact('s', 'backtoallsessions'));
if ($mform->is_cancelled()) {
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
                    $message .= html_writer::empty_tag('br') . html_writer::empty_tag('br') . get_string('cancellationsentmgr', 'facetoface');
                }
                else {
                    $message .= html_writer::empty_tag('br') . html_writer::empty_tag('br') . get_string('cancellationsent', 'facetoface');
                }
            } else {
                print_error($error, 'facetoface');
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

$PAGE->set_cm($cm);
$PAGE->set_url('/mod/facetoface/cancelsignup.php', array('s' => $s, 'backtoallsessions' => $backtoallsessions, 'confirm' => $confirm));

$PAGE->set_title($pagetitle);
$PAGE->set_heading($course->fullname);

echo $OUTPUT->header();

$heading = get_string('cancelbookingfor', 'facetoface', $facetoface->name);

$viewattendees = has_capability('mod/facetoface:viewattendees', $context);
$signedup = facetoface_check_signup($facetoface->id);

echo $OUTPUT->box_start();
echo $OUTPUT->heading($heading);

if ($signedup) {
    facetoface_print_session($session, $viewattendees);
    $mform->display();
}
else {
    print_error('notsignedup', 'facetoface', $returnurl);
}

echo $OUTPUT->box_end();
echo $OUTPUT->footer($course);

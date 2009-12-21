<?php

// Displays booking history for the current user

require_once '../../config.php';
require_once('lib.php');

require_login();

$sid        = required_param('session', PARAM_INT);
$userid     = optional_param('userid', $USER->id, PARAM_INT);

// get all the required records
if (!$user = get_record('user','id',$userid)) {
    print_error('error:invaliduserid', 'block_facetoface');
}
if (!$session = facetoface_get_session($sid)) {
    print_error('error:invalidsessionid', 'block_facetoface');
}
if(!$facetoface = get_record('facetoface','id', $session->facetoface)) {
    print_error('error:invalidfacetofaceid', 'block_facetoface');
}
if (!$course = get_record('course','id',$facetoface->course)) {
    print_error('error:invalidcourseid', 'block_facetoface');
}

if ($userid != $USER->id) {
    $contextuser = get_context_instance(CONTEXT_USER, $userid);
    if (!has_capability('block/facetoface:viewbookings', $contextuser)) {
        $contextcourse = get_context_instance(CONTEXT_COURSE, $course->id);
        require_capability('mod/facetoface:viewattendees', $contextcourse);
    }
}

$pagetitle = format_string(get_string('bookinghistory', 'block_facetoface'));
$navlinks[] = array('name' => $pagetitle, 'link' => '', 'type' => 'activityinstance');
$navigation = build_navigation($navlinks);
print_header_simple($pagetitle, '', $navigation);
print_box_start();

// Get signups from the DB
$bookings = get_records_sql("SELECT su.timecreated, su.timecancelled as status, su.grade, su.timegraded, su.cancelreason,
                                   c.id as courseid, c.fullname AS coursename,
                                   f.name, f.id as facetofaceid, s.id as sessionid,
                                   d.id, d.timestart, d.timefinish
                              FROM {$CFG->prefix}facetoface_sessions_dates d
                              JOIN {$CFG->prefix}facetoface_sessions s ON s.id = d.sessionid
                              JOIN {$CFG->prefix}facetoface f ON f.id = s.facetoface
                              JOIN {$CFG->prefix}facetoface_submissions su ON su.sessionid = s.id
                              JOIN {$CFG->prefix}course c ON f.course = c.id
                              WHERE su.userid = $user->id AND su.sessionid = $session->id AND f.id = $session->facetoface
                              ORDER BY su.timecreated ASC");

// Get session times
$sessiontimes = facetoface_get_session_dates($session->id);

if ($user->id != $USER->id) {
    $fullname = '<a href="'.$CFG->wwwroot.'/user/view.php?id='.$user->id.'&amp;course='.$course->id.'">'.fullname($user).'</a>';
    $heading = get_string('bookinghistoryfor', 'block_facetoface', $fullname);
    print_heading($heading, 'center');
} else {
    echo "<br />";
}

print_heading(get_string('sessiondetails', 'block_facetoface'), 'center');

// print the session information
$cm = get_coursemodule_from_instance('facetoface', $facetoface->id, $course->id);
$contextmodule = get_context_instance(CONTEXT_MODULE, $cm->id);
$viewattendees = has_capability('mod/facetoface:viewattendees', $contextmodule);
facetoface_print_session($session, $viewattendees);

// print the booking history
if ($bookings and count($bookings) > 0) {

    $table = new object();
    $table->summary = get_string('sessionsdetailstablesummary', 'facetoface');
    $table->width = '50%';

    foreach ($bookings as $booking) {
        if (isset($booking->status) and $booking->status == 0) {
            $table->data[] = array(get_string('enrolled', 'block_facetoface'), userdate($booking->timecreated, get_string('strftimedatetime')));
        } else {
            // if the booking status is cancelled print out the original enrollment date (timecreated) too
            $table->data[] = array(get_string('enrolled', 'block_facetoface'),userdate($booking->timecreated, get_string('strftimedatetime')));
            $table->data[] = array(get_string('cancelled', 'block_facetoface'),userdate($booking->status, get_string('strftimedatetime')), $booking->cancelreason);
        }
    }

    // if the grade is 100 mark the user as 'attended'
    if ($grade = facetoface_get_grade($user->id, $course->id, $facetoface->id) and $grade->grade == 100) {
        // just use the first session time of the multi-session facetoface
        if ($sessiontimes and count($sessiontimes) > 0) {
            $firstsession = current(array_values($sessiontimes));
        }
        $table->data[] = array(get_string('attended', 'block_facetoface'),userdate($firstsession->timestart, get_string('strftimedate'))) ;
    }

} else {
    // no booking history available
    $table = new object();
    $table->summary = get_string('sessionsdetailstablesummary', 'facetoface');
    $table->width = '50%';
    $table->align = array('center');

    if ($user->id != $USER->id) {
       $table->data[] = array(get_string('nobookinghistoryfor','block_facetoface',fullname($user)));
    } else {
       $table->data[] = array(get_string('nobookinghistory','block_facetoface'));
    }
}

print_heading(get_string('bookinghistory', 'block_facetoface'), 'center');
print_table($table);

print_box_end();
print_footer();

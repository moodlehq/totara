<?php

require_once '../../config.php';
require_once 'lib.php';

$id = optional_param('id', 0, PARAM_INT); // Course Module ID
$f  = optional_param('f', 0, PARAM_INT); // facetoface activity ID
$s  = optional_param('s', 0, PARAM_INT); // facetoface session ID
$takeattendance    = optional_param('takeattendance', false, PARAM_BOOL); // take attendance
$cancelform        = optional_param('cancelform', false, PARAM_BOOL); // cancel request
$backtoallsessions = optional_param('backtoallsessions', 0, PARAM_INT); // facetoface activity to go back to

if ($id) {
    if (!$cm = get_record('course_modules', 'id', $id)) {
        print_error('error:incorrectcoursemoduleid', 'facetoface');
    }
    if (!$course = get_record('course', 'id', $cm->course)) {
        print_error('error:coursemisconfigured', 'facetoface');
    }
    if (!$facetoface = get_record('facetoface', 'id', $cm->instance)) {
        print_error('error:incorrectcoursemodule', 'facetoface');
    }
}
elseif ($s) {
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
}
else {
    if (!$facetoface = get_record('facetoface', 'id', $f)) {
        print_error('error:incorrectfacetofaceid', 'facetoface');
    }
    if (!$course = get_record('course', 'id', $facetoface->course)) {
        print_error('error:coursemisconfigured', 'facetoface');
    }
    if (!$cm = get_coursemodule_from_instance('facetoface', $facetoface->id, $course->id)) {
        print_error('error:incorrectcoursemodule', 'facetoface');
    }
 }

require_course_login($course);
$context = get_context_instance(CONTEXT_COURSE, $course->id);
require_capability('mod/facetoface:viewattendees', $context);

if ($form = data_submitted()) {
    if (!confirm_sesskey()) {
        print_error('confirmsesskeybad', 'error');
    }

    require_capability('mod/facetoface:takeattendance', $context);

    if ($cancelform) {
        redirect("attendees.php?s=$s&amp;backtoallsessions=$backtoallsessions");
    }
    elseif (facetoface_take_attendance($form)) {
        add_to_log($course->id, 'facetoface', 'take attendance', "view.php?id=$cm->id", $facetoface->id, $cm->id);
    }
    else {
        add_to_log($course->id, 'facetoface', 'take attendance (FAILED)', "view.php?id=$cm->id", $facetoface->id, $cm->id);
    }
}

$pagetitle = format_string($facetoface->name);
$navlinks[] = array('name' => get_string('modulenameplural', 'facetoface'), 'link' => "index.php?id=$course->id", 'type' => 'title');
$navlinks[] = array('name' => $pagetitle, 'link' => "view.php?f=$facetoface->id", 'type' => 'activityinstance');
$navlinks[] = array('name' => get_string('attendees', 'facetoface'), 'link' => '', 'type' => 'title');
$navigation = build_navigation($navlinks);
print_header_simple($pagetitle, '', $navigation, '', '', true,
                    update_module_button($cm->id, $course->id, get_string('modulename', 'facetoface')), navmenu($course, $cm));

if ($takeattendance && !has_capability('mod/facetoface:takeattendance', $context)) {
    $takeattendance = 0;
}

$heading = '';
if ($takeattendance) {
    $heading = get_string('takeattendance', 'facetoface');
}
else {
    add_to_log($course->id, 'facetoface', 'view attendees', "view.php?id=$cm->id", $facetoface->id, $cm->id);
    $heading = get_string('attendees', 'facetoface');
}
$heading .= ' - ' . format_string($facetoface->name);

print_box_start();
print_heading($heading, 'center');

if ($takeattendance) {
    echo '<form action="attendees.php?s='.$s.'" method="post">';
    echo '<p>'. get_string('attendanceinstructions', 'facetoface');
    echo '<input type="hidden" name="sesskey" value="'.$USER->sesskey.'" />';
    echo '<input type="hidden" name="s" value="'.$s.'" />';
    echo '<input type="hidden" name="backtoallsessions" value="'.$backtoallsessions.'" /></p>';
}
else {
    facetoface_print_session($session, true);
}

$table = new object();
$table->head = array(get_string('name'));
$table->summary = get_string('attendeestablesummary', 'facetoface');
$table->align = array('left');
$table->size = array('100%');
$table->width = '50%';

if ($takeattendance) {
    $table->head[] = get_string('attendedsession', 'facetoface');
    $table->align[] = array('center');
}
else {
    if (!get_config(NULL, 'facetoface_hidecost')) {
        $table->head[] = get_string('cost', 'facetoface');
        $table->align[] = array('center');
        if (!get_config(NULL, 'facetoface_hidediscount')) {
            $table->head[] = get_string('discountcode', 'facetoface');
            $table->align[] = array('center');
        }
    }
    $table->head[] = get_string('attendance', 'facetoface');
    $table->align[] = array('center');
}

// TODO temporary change to show booking status on attendance page
// Need to be done properly:
// - What options should be available in pulldown?
// - Should other attendees be able to see full status code?
// - move attendance_options somewhere more sensible
// - add grading and notes?
$attendance_options = array(1 => 'Requested', 2 => 'User Cancelled', 3 => 'Session Cancelled', 4 => 'Approved', 
    5=> 'Waitlisted', 6 => 'Booked', 7 => 'No show', 8 =>'Partially Attended', 9 => 'Fully Attended');

if ($attendees = facetoface_get_attendees($session->id)) {
    foreach($attendees as $attendee) {
        $data = array();
        $data[] = "<a href=\"$CFG->wwwroot/user/view.php?id={$attendee->id}&amp;course={$course->id}\">". format_string(fullname($attendee)).'</a>';

        if ($takeattendance) {
            $optionid = 'submissionid_'.$attendee->submissionid;
            $status = $attendee->statuscode;
            $select = choose_from_menu($attendance_options, $optionid, $status, 'choose', '', '0', true);
            $data[] = $select;
        }
        else {
            if (!get_config(NULL, 'facetoface_hidecost')) {
                $data[] = facetoface_cost($attendee->id, $session->id, $session);
                if (!get_config(NULL, 'facetoface_hidediscount')) {
                    $data[] = $attendee->discountcode;
                }
            }
            $status = $attendee->statuscode;
            $data[] = $attendance_options[$status];
        }
        $table->data[] = $data;
    }
}
else {
    $table->data = array(array(get_string('nosignedupusers', 'facetoface')));
}

print_table($table);

if ($takeattendance) {
    echo '<p>';
    echo '<input type="submit" value="'.get_string('saveattendance', 'facetoface').'" />';
    echo '&nbsp;<input type="submit" name="cancelform" value="'.get_string('cancel').'" />';
    echo '</p></form>';
}
else {
    // Actions
    print '<p>';
    if (has_capability('mod/facetoface:takeattendance', $context)) {
        if (!$takeattendance and !empty($attendees)) {
            // Take attendance
            echo '<a href="attendees.php?s='.$session->id.'&amp;takeattendance=1&amp;backtoallsessions='.$backtoallsessions.'">'.get_string('takeattendance', 'facetoface').'</a> - ';
        }
    }
    if (has_capability('mod/facetoface:addattendees', $context) ||
        has_capability('mod/facetoface:removeattendees', $context)) {
        // Add/remove attendees
        echo '<a href="editattendees.php?s='.$session->id.'&amp;backtoallsessions='.$backtoallsessions.'">'.get_string('addremoveattendees', 'facetoface').'</a> - ';
    }

    // Go back
    $url = "$CFG->wwwroot/course/view.php?id=$course->id";
    if ($backtoallsessions) {
        $url = "view.php?f={$facetoface->id}&amp;backtoallsessions=$backtoallsessions";
    }
    print '<a href="'.$url.'">'.get_string('goback', 'facetoface').'</a></p>';
}

// View cancellations
if (!$takeattendance and has_capability('mod/facetoface:viewcancellations', $context) and
    ($attendees = facetoface_get_cancellations($session->id))) {

    echo '<br />';
    print_heading(get_string('cancellations', 'facetoface'), 'center');

    $table = new object();
    $table->summary = get_string('cancellationstablesummary', 'facetoface');
    $table->head = array(get_string('name'), get_string('timesignedup', 'facetoface'),
                         get_string('timecancelled', 'facetoface'), get_string('cancelreason', 'facetoface'));
    $table->align = array('left', 'center', 'center');

    foreach($attendees as $attendee) {
        $data = array();
        $data[] = "<a href=\"$CFG->wwwroot/user/view.php?id={$attendee->id}&amp;course={$course->id}\">". format_string(fullname($attendee)).'</a>';
        $data[] = userdate($attendee->timecreated, get_string('strftimedatetime'));
        $data[] = userdate($attendee->timecancelled, get_string('strftimedatetime'));
        $data[] = format_string($attendee->cancelreason);
        $table->data[] = $data;
    }
    print_table($table);
}

print_box_end();
print_footer($course);

function facetoface_get_cancellations($sessionid)
{
    global $CFG;

    $fullname = sql_fullname('u.firstname', 'u.lastname');

    // TODO get original time signed up from signups_status history and include in this query as timecreated
    $sql = "SELECT su.id AS signupid, u.id, u.firstname, u.lastname,
                   ss.timecreated as timecancelled, ss.note as cancelreason
              FROM {$CFG->prefix}facetoface_signups su
              JOIN {$CFG->prefix}facetoface_signups_status ss ON su.id=ss.signupid
              JOIN {$CFG->prefix}user u ON u.id = su.userid
             WHERE su.sessionid = $sessionid AND ss.superceded != 1 AND ss.statuscode IN (2,3)
          ORDER BY $fullname, ss.timecreated";
    return get_records_sql($sql);
}

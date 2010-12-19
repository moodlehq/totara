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
// Handle submitted data
if ($form = data_submitted()) {
    if (!confirm_sesskey()) {
        print_error('confirmsesskeybad', 'error');
    }

    require_capability('mod/facetoface:takeattendance', $context);

    if ($cancelform) {
        redirect("attendees.php?s=$s&amp;backtoallsessions=$backtoallsessions");
    }
    elseif (!empty($form->requests)) {
        // Approve requests
        if (facetoface_approve_requests($form)) {
            add_to_log($course->id, 'facetoface', 'approve requests', "view.php?id=$cm->id", $facetoface->id, $cm->id);
        }
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

// Check the session has already started
if ($takeattendance && $session->datetimeknown && !facetoface_has_session_started($session, time())) {
    error('Can not take attendance for a session that has not yet started', 'attendees.php?s='.$session->id);
    exit();
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
    $table->head[] = get_string('currentstatus', 'facetoface');
    $table->align[] = array('center');
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

$status_options = array();
foreach ($MDL_F2F_STATUS as $key => $value) {
    if ($key <= MDL_F2F_STATUS_BOOKED) {
        continue;
    }

    $status_options[$key] = get_string('status_'.$value, 'facetoface');
}

if ($attendees = facetoface_get_attendees($session->id)) {
    foreach($attendees as $attendee) {
        $data = array();
        $data[] = "<a href=\"$CFG->wwwroot/user/view.php?id={$attendee->id}&amp;course={$course->id}\">". format_string(fullname($attendee)).'</a>';

        if ($takeattendance) {
            // Show current status
            $data[] = get_string('status_'.facetoface_get_status($attendee->statuscode), 'facetoface');

            $optionid = 'submissionid_'.$attendee->submissionid;
            $status = $attendee->statuscode;
            $select = choose_from_menu($status_options, $optionid, $status, 'choose', '', '0', true);
            $data[] = $select;
        }
        else {
            if (!get_config(NULL, 'facetoface_hidecost')) {
                $data[] = facetoface_cost($attendee->id, $session->id, $session);
                if (!get_config(NULL, 'facetoface_hidediscount')) {
                    $data[] = $attendee->discountcode;
                }
            }
            $data[] = str_replace(' ', '&nbsp;', get_string('status_'.facetoface_get_status($attendee->statuscode), 'facetoface'));
        }
        $table->data[] = $data;
    }

    print_table($table);
}
else {
    print_heading(get_string('nosignedupusers', 'facetoface'));
}

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
        if (!$takeattendance && !empty($attendees) && $session->datetimeknown && facetoface_has_session_started($session, time())) {
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

// View unapproved requests
if (!$takeattendance && ($attendees = facetoface_get_requests($session->id))) {

    echo '<br id="unapproved" />';
    print_heading(get_string('unapprovedrequests', 'facetoface'), 'center');

    echo '<form action="attendees.php?s='.$s.'" method="post">';
    echo '<input type="hidden" name="sesskey" value="'.$USER->sesskey.'" />';
    echo '<input type="hidden" name="s" value="'.$s.'" />';
    echo '<input type="hidden" name="backtoallsessions" value="'.$backtoallsessions.'" /></p>';

    $table = new object();
    $table->summary = get_string('requeststablesummary', 'facetoface');
    $table->head = array(get_string('name'), get_string('timerequested', 'facetoface'),
                         get_string('decidelater', 'facetoface'), get_string('decline', 'facetoface'), get_string('approve', 'facetoface'));
    $table->align = array('left', 'center', 'center', 'center', 'center');

    $cantakeattendance = has_capability('mod/facetoface:takeattendance', $context);
    foreach($attendees as $attendee) {

        // Check the logged in user has permissions to see the user
        if (!$cantakeattendance) {
            if (facetoface_get_manageremail($attendee->id) !== $USER->email) {
                continue;
            }
        }

        $data = array();
        $data[] = "<a href=\"{$CFG->wwwroot}/user/view.php?id={$attendee->id}&amp;course={$course->id}\">". format_string(fullname($attendee)).'</a>';
        $data[] = userdate($attendee->timerequested, get_string('strftimedatetime'));
        $data[] = '<input type="radio" name="requests['.$attendee->id.']" value="0" checked="checked" />';
        $data[] = '<input type="radio" name="requests['.$attendee->id.']" value="1" />';
        $data[] = '<input type="radio" name="requests['.$attendee->id.']" value="2" />';
        $table->data[] = $data;
    }

    if (empty($table->data)) {
        $table->data[] = array(get_string('noactionableunapprovedrequests', 'facetoface'), '', '');
    }

    print_table($table);

    echo '<p><input type="submit" value="Update requests" /></p>';
    echo '</form>';
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
        $data[] = userdate($attendee->timesignedup, get_string('strftimedatetime'));
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

    // Nasty SQL follows:
    // Load currently cancelled users,
    // include most recent booked/waitlisted time also
    $sql = "
            SELECT
                su.id AS signupid,
                u.id,
                u.firstname,
                u.lastname,
                MAX(ss.timecreated) AS timesignedup,
                c.timecreated AS timecancelled,
                c.note AS cancelreason
            FROM
                {$CFG->prefix}facetoface_signups su
            JOIN
                {$CFG->prefix}user u
             ON u.id = su.userid
            JOIN
                {$CFG->prefix}facetoface_signups_status c
             ON su.id = c.signupid
            AND c.statuscode = ".MDL_F2F_STATUS_USER_CANCELLED."
            AND c.superceded = 0
            LEFT JOIN
                {$CFG->prefix}facetoface_signups_status ss
             ON su.id = ss.signupid
             AND ss.statuscode IN (
                 ".MDL_F2F_STATUS_BOOKED.",
                 ".MDL_F2F_STATUS_WAITLISTED.",
                 ".MDL_F2F_STATUS_REQUESTED."
             )
            AND ss.superceded = 1
            WHERE
                su.sessionid = {$sessionid}
            GROUP BY
                su.id,
                u.id,
                u.firstname,
                u.lastname,
                c.timecreated,
                c.note
            ORDER BY
                {$fullname},
                c.timecreated
    ";
    return get_records_sql($sql);
}

function facetoface_get_requests($sessionid)
{
    global $CFG;

    $fullname = sql_fullname('u.firstname', 'u.lastname');

    $sql = "SELECT su.id AS signupid, u.id, u.firstname, u.lastname,
                   ss.timecreated AS timerequested
              FROM {$CFG->prefix}facetoface_signups su
              JOIN {$CFG->prefix}facetoface_signups_status ss ON su.id=ss.signupid
              JOIN {$CFG->prefix}user u ON u.id = su.userid
             WHERE su.sessionid = $sessionid AND ss.superceded != 1 AND ss.statuscode = ".MDL_F2F_STATUS_REQUESTED."
          ORDER BY $fullname, ss.timecreated";
    return get_records_sql($sql);
}

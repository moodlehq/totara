<?php

/**
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
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
 * @package totara
 * @subpackage facetoface
 */

require_once dirname(dirname(dirname(__FILE__))).'/config.php';
require_once $CFG->dirroot.'/mod/facetoface/lib.php';

global $DB;

/**
 * Load and validate base data
 */
// Face-to-face session ID
$s  = required_param('s', PARAM_INT);

// Take attendance
$takeattendance    = optional_param('takeattendance', false, PARAM_BOOL);
// Cancel request
$cancelform        = optional_param('cancelform', false, PARAM_BOOL);
// Face-to-face activity to return to
$backtoallsessions = optional_param('backtoallsessions', 0, PARAM_INT);

// Load data
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

// Load attendees
$attendees = facetoface_get_attendees($session->id);

// Load cancellations
$cancellations = facetoface_get_cancellations($session->id);


/**
 * Capability checks to see if the current user can view this page
 *
 * This page is a bit of a special case in this respect as there are four uses for this page.
 *
 * 1) Viewing attendee list
 *   - Requires mod/facetoface:viewattendees capability in the course
 *
 * 2) Viewing cancellation list
 *   - Requires mod/facetoface:viewcancellations capability in the course
 *
 * 3) Taking attendance
 *   - Requires mod/facetoface:takeattendance capabilities in the course
 *
 */

$context = context_course::instance($course->id);
$contextmodule = context_module::instance($cm->id);
require_course_login($course);

// Actions the user can perform
$can_view_attendees = has_capability('mod/facetoface:viewattendees', $context);
$can_take_attendance = has_capability('mod/facetoface:takeattendance', $context);
$can_view_cancellations = has_capability('mod/facetoface:viewcancellations', $context);
$can_view_session = $can_view_attendees || $can_take_attendance || $can_view_cancellations;
$can_approve_requests = false;

$requests = array();
$declines = array();

// If a user can take attendance, they can approve staff's booking requests
if ($can_take_attendance) {
    $requests = facetoface_get_requests($session->id);
    // Check if the user is manager with staff
} else if ($staff = totara_get_staff()) {
    // Lets check to see what state their staff are in

    // Check if any staff have requests awaiting approval
    $get_requests = facetoface_get_requests($session->id);
    if ($get_requests) {
        $requests = array_intersect_key($get_requests, array_flip($staff));

        if ($requests) {
            $can_view_session = true;
        }
    }

    // Check if any staff are attending
    if ($attendees && !$can_view_attendees) {
        $attendees = array_intersect_key($attendees, array_flip($staff));

        if ($attendees) {
            $can_view_session = true;
            $can_view_attendees = true;
        }
    }

    // Check if any staff have cancelled
    if ($cancellations && !$can_view_cancellations) {
        $cancellations = array_intersect_key($cancellations, array_flip($staff));

        if ($cancellations) {
            $can_view_session = true;
            $can_view_cancellations = true;
        }
    }

    // Check if any staff have declined
    $get_declines = facetoface_get_declines($session->id);
    if ($get_declines) {
        $declines = array_intersect_key($get_declines, array_flip($staff));

        if ($declines) {
            $can_view_session = true;
            $can_approve_requests = true;
        }
    }
}

// If requests found (but not in the middle of taking attendance), show requests table
if ($requests && !$takeattendance) {
    $can_approve_requests = true;
}

// Check the user is allowed to view this page
if (!$can_view_attendees && !$can_take_attendance && !$can_approve_requests && !$can_view_cancellations) {
    print_error('nopermissions', '', "{$CFG->wwwroot}/mod/facetoface/view.php?id={$cm->id}", get_string('view'));
}

// Check user has permissions to take attendance
if ($takeattendance && !$can_take_attendance) {
    print_error('nopermissions', '', '', get_capability_string('mod/facetoface:takeattendance'));
}


/**
 * Handle submitted data
 */
if ($form = data_submitted()) {
    if (!confirm_sesskey()) {
        print_error('confirmsesskeybad', 'error');
    }

    $return = "{$CFG->wwwroot}/mod/facetoface/attendees.php?s={$s}&backtoallsessions={$backtoallsessions}";

    if ($cancelform) {
        redirect($return);
    }
    elseif (!empty($form->requests)) {
        // Approve requests
        if ($can_approve_requests && facetoface_approve_requests($form)) {
            add_to_log($course->id, 'facetoface', 'approve requests', "view.php?id=$cm->id", $facetoface->id, $cm->id);
        }

        redirect($return);
    }
    elseif ($takeattendance) {
        if (facetoface_take_attendance($form)) {
            add_to_log($course->id, 'facetoface', 'take attendance', "view.php?id=$cm->id", $facetoface->id, $cm->id);
        } else {
            add_to_log($course->id, 'facetoface', 'take attendance (FAILED)', "view.php?id=$cm->id", $face->id, $cm->id);
        }
        redirect($return.'&takeattendance=1');
    }
}


/**
 * Print page header
 */
add_to_log($course->id, 'facetoface', 'view attendees', "view.php?id=$cm->id", $facetoface->id, $cm->id);

$pagetitle = format_string($facetoface->name);

$PAGE->set_url('/mod/facetoface/attendees.php', array('s' => $s));
$PAGE->set_context($context);
$PAGE->set_cm($cm);

$PAGE->set_title($pagetitle);
$PAGE->set_heading($course->fullname);

echo $OUTPUT->header();


/**
 * Print page content
 */
// If taking attendance, make sure the session has already started
if ($takeattendance && $session->datetimeknown && !facetoface_has_session_started($session, time())) {
    $link = "{$CFG->wwwroot}/mod/facetoface/attendees.php?s={$session->id}";
    print_error('error:canttakeattendanceforunstartedsession', 'facetoface', $link);
}

echo $OUTPUT->box_start();
echo $OUTPUT->heading(format_string($facetoface->name));

if ($can_view_session) {
    echo facetoface_print_session($session, true);
}


/**
 * Print attendees (if user able to view)
 */
if ($can_view_attendees || $can_take_attendance) {
    if ($takeattendance) {
        $heading = get_string('takeattendance', 'facetoface');
    } else {
        $heading = get_string('attendees', 'facetoface');
    }

    echo $OUTPUT->heading($heading);

    if (empty($attendees)) {
        echo $OUTPUT->notification(get_string('nosignedupusers', 'facetoface'));
    }
    else {
        if ($takeattendance) {
            $attendees_url = new moodle_url('attendees.php', array('s' => $s, 'takeattendance' => '1'));
            echo html_writer::start_tag('form', array('action' => $attendees_url, 'method' => 'post'));
            echo html_writer::tag('p', get_string('attendanceinstructions', 'facetoface'));
            echo html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 'sesskey', 'value' => $USER->sesskey));
            echo html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 's', 'value' => $s));
            echo html_writer::empty_tag('input', array('type' => 'hidden', ' name' => 'backtoallsessions', 'value' => $backtoallsessions)) . '</p>';

            // Prepare status options array
            $status_options = array();
            foreach ($MDL_F2F_STATUS as $key => $value) {
                if ($key <= MDL_F2F_STATUS_BOOKED) {
                    continue;
                }

                $status_options[$key] = get_string('status_'.$value, 'facetoface');
            }
        }

        $table = new html_table();
        $table->head = array(get_string('name'));
        $table->summary = get_string('attendeestablesummary', 'facetoface');
        $table->align = array('left');
        $table->size = array('100%');

        if ($takeattendance) {
            $table->head[] = get_string('currentstatus', 'facetoface');
            $table->align[] = 'center';
            $table->head[] = get_string('attendedsession', 'facetoface');
            $table->align[] = 'center';
        }
        else {
            if (!get_config(null, 'facetoface_hidecost')) {
                $table->head[] = get_string('cost', 'facetoface');
                $table->align[] = 'center';
                if (!get_config(null, 'facetoface_hidediscount')) {
                    $table->head[] = get_string('discountcode', 'facetoface');
                    $table->align[] = 'center';
                }
            }

            $table->head[] = get_string('attendance', 'facetoface');
            $table->align[] = 'center';
        }

        foreach ($attendees as $attendee) {
            $data = array();
            $attendee_url = new moodle_url('/user/view.php', array('id' => $attendee->id, 'course' => $course->id));
            $data[] = html_writer::link($attendee_url, format_string(fullname($attendee)));

            if ($takeattendance) {
                // Show current status
                $data[] = get_string('status_'.facetoface_get_status($attendee->statuscode), 'facetoface');

                $optionid = 'submissionid_'.$attendee->submissionid;
                $status = $attendee->statuscode;
                $select = html_writer::select($status_options, $optionid, $status);
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

        echo html_writer::table($table);

        if ($takeattendance) {
            echo html_writer::start_tag('p');
            echo html_writer::empty_tag('input', array('type' => 'submit', 'value' => get_string('saveattendance', 'facetoface')));
            echo '&nbsp;' . html_writer::empty_tag('input', array('type' => 'submit', 'name' => 'cancelform', 'value' => get_string('cancel')));
            echo html_writer::end_tag('p') . html_writer::end_tag('form');
        }
        else {
            // Actions
            print html_writer::start_tag('p');
            if ($can_take_attendance && $session->datetimeknown && facetoface_has_session_started($session, time())) {
                // Take attendance
                $attendance_url = new moodle_url('attendees.php', array('s' => $session->id, 'takeattendance' => '1', 'backtoallsessions' => $backtoallsessions));
                echo html_writer::link($attendance_url, get_string('takeattendance', 'facetoface')) . ' - ';
            }
        }
    }

    if (!$takeattendance) {
        if (has_capability('mod/facetoface:addattendees', $context) ||
            has_capability('mod/facetoface:removeattendees', $context)) {
            // Add/remove attendees
            $editattendees_link = new moodle_url('editattendees.php', array('s' => $session->id, 'backtoallsessions' => $backtoallsessions));
            echo html_writer::link($editattendees_link, get_string('addremoveattendees', 'facetoface')) . ' - ';
        }
    }
}

// Go back
$url = new moodle_url('/course/view.php', array('id' => $course->id));
if ($backtoallsessions) {
    $url = new moodle_url('/mod/facetoface/view.php', array('f' => $facetoface->id, 'backtoallsessions' => $backtoallsessions));
}
echo html_writer::link($url, get_string('goback', 'facetoface')) . html_writer::end_tag('p');


/**
 * Print unapproved requests (if user able to view)
 */
if ($can_approve_requests) {
    echo html_writer::empty_tag('br', array('id' => 'unapproved'));
    if (!$requests) {
        echo $OUTPUT->notification(get_string('noactionableunapprovedrequests', 'facetoface'));
    }
    else {
        $can_book_user = (facetoface_session_has_capacity($session, $contextmodule) || $session->allowoverbook);

        $OUTPUT->heading(get_string('unapprovedrequests', 'facetoface'));

        if (!$can_book_user) {
            echo html_writer::tag('p', get_string('cannotapproveatcapacity', 'facetoface'));
        }


        $action = new moodle_url('attendees.php', array('s' => $s));
        echo html_writer::start_tag('form', array('action' => $action->out(), 'method' => 'post'));
        echo html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 'sesskey', 'value' => $USER->sesskey));
        echo html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 's', 'value' => $s));
        echo html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 'backtoallsessions', 'value' => $backtoallsessions)) . html_writer::end_tag('p');

        $table = new html_table();
        $table->summary = get_string('requeststablesummary', 'facetoface');
        $table->head = array(get_string('name'), get_string('timerequested', 'facetoface'),
                            get_string('decidelater', 'facetoface'), get_string('decline', 'facetoface'), get_string('approve', 'facetoface'));
        $table->align = array('left', 'center', 'center', 'center', 'center');

        foreach ($requests as $attendee) {
            $data = array();
            $attendee_link = new moodle_url('/user/view.php', array('id' => $attendee->id, 'course' => $course->id));
            $data[] = html_writer::link($attendee_link, format_string(fullname($attendee)));
            $data[] = userdate($attendee->timerequested, get_string('strftimedatetime'));
            $data[] = html_writer::empty_tag('input', array('type' => 'radio', 'name' => 'requests['.$attendee->id.']', 'value' => '0', 'checked' => 'checked'));
            $data[] = html_writer::empty_tag('input', array('type' => 'radio', 'name' => 'requests['.$attendee->id.']', 'value' => '1'));
            $disabled = ($can_book_user) ? array() : array('disabled' => 'disabled');
            $data[] = html_writer::empty_tag('input', array_merge(array('type' => 'radio', 'name' => 'requests['.$attendee->id.']', 'value' => '2'), $disabled));
            $table->data[] = $data;
        }

        echo html_writer::table($table);

        echo html_writer::tag('p', html_writer::empty_tag('input', array('type' => 'submit', 'value' => get_string('updaterequests', 'facetoface'))));
        echo html_writer::end_tag('form');
    }
}


/**
 * Print cancellations (if user able to view)
 */
if (!$takeattendance && $can_view_cancellations && $cancellations) {

    echo html_writer::empty_tag('br');
    echo $OUTPUT->heading(get_string('cancellations', 'facetoface'));

    $table = new html_table();
    $table->summary = get_string('cancellationstablesummary', 'facetoface');
    $table->head = array(get_string('name'), get_string('timesignedup', 'facetoface'),
                         get_string('timecancelled', 'facetoface'), get_string('cancelreason', 'facetoface'));
    $table->align = array('left', 'center', 'center');

    foreach ($cancellations as $attendee) {
        $data = array();
        $attendee_link = new moodle_url('/user/view.php', array('id' => $attendee->id, 'course' => $course->id));
        $data[] = html_writer::link($attendee_link, format_string(fullname($attendee)));
        $data[] = userdate($attendee->timesignedup, get_string('strftimedatetime'));
        $data[] = userdate($attendee->timecancelled, get_string('strftimedatetime'));
        $data[] = format_string($attendee->cancelreason);
        $table->data[] = $data;
    }
    echo html_writer::table($table);
}

/**
 * Print page footer
 */
echo $OUTPUT->box_end();
echo $OUTPUT->footer($course);

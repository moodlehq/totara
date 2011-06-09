<?php

/**
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
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
if (!$facetoface = get_record('facetoface', 'id', $session->facetoface)) {
    print_error('error:incorrectfacetofaceid', 'facetoface');
}
if (!$course = get_record('course', 'id', $facetoface->course)) {
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
 * 4) A manager approving his staff's booking requests
 *   - Manager does not neccesarily have any capabilities in this course
 *   - Show only attendees who are also the manager's staff
 *   - Show only staff awaiting approval
 *   - Show any staff who have cancelled
 *   - Shouldn't throw an error if there are previously declined attendees
 */
require_login();

$context = get_context_instance(CONTEXT_COURSE, $course->id);

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
} elseif ($staff = totara_get_staff()) {
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

    $return = "{$CFG->wwwroot}/mod/facetoface/attendees.php?s={$s}&amp;backtoallsessions={$backtoallsessions}";

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
            add_to_log($course->id, 'facetoface', 'take attendance (FAILED)', "view.php?id=$cm->id", $facetoface->id, $cm->id);
        }
        redirect($return.'&amp;takeattendance=1');
    }
}


/**
 * Print page header
 */
add_to_log($course->id, 'facetoface', 'view attendees', "view.php?id=$cm->id", $facetoface->id, $cm->id);

$pagetitle = format_string($facetoface->name);

$link = "{$CFG->wwwroot}/mod/facetoface/index.php?id={$course->id}";
$navlinks[] = array('name' => get_string('modulenameplural', 'facetoface'), 'link' => $link, 'type' => 'title');
$link = "{$CFG->wwwroot}/mod/facetoface/view.php?id={$facetoface->id}";
$navlinks[] = array('name' => $pagetitle, 'link' => $link, 'type' => 'activityinstance');
$navlinks[] = array('name' => get_string('attendees', 'facetoface'), 'link' => '', 'type' => 'title');

$navigation = build_navigation($navlinks);
$button = update_module_button($cm->id, $course->id, get_string('modulename', 'facetoface'));

print_header_simple($pagetitle, '', $navigation, '', '', true, $button, navmenu($course, $cm));


/**
 * Print page content
 */
// If taking attendance, make sure the session has already started
if ($takeattendance && $session->datetimeknown && !facetoface_has_session_started($session, time())) {
    $link = "{$CFG->wwwroot}/mod/facetoface/attendees.php?s={$session->id}";
    print_error('error:canttakeattendanceforunstartedsession', 'facetoface', $link);
}

print_box_start();
print_heading(format_string($facetoface->name), 'center');

if ($can_view_session) {
    facetoface_print_session($session, true);
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

    print_heading($heading, 'center');

    if (empty($attendees)) {
        notify(get_string('nosignedupusers', 'facetoface'));
    }
    else {
        if ($takeattendance) {
            echo '<form action="attendees.php?s='.$s.'&amp;takeattendance=1" method="post">';
            echo '<p>'. get_string('attendanceinstructions', 'facetoface');
            echo '<input type="hidden" name="sesskey" value="'.$USER->sesskey.'" />';
            echo '<input type="hidden" name="s" value="'.$s.'" />';
            echo '<input type="hidden" name="backtoallsessions" value="'.$backtoallsessions.'" /></p>';

            // Prepare status options array
            $status_options = array();
            foreach ($MDL_F2F_STATUS as $key => $value) {
                if ($key <= MDL_F2F_STATUS_BOOKED) {
                    continue;
                }

                $status_options[$key] = get_string('status_'.$value, 'facetoface');
            }
        }

        $table = new object();
        $table->head = array(get_string('name'));
        $table->summary = get_string('attendeestablesummary', 'facetoface');
        $table->align = array('left');
        $table->size = array('100%');
        $table->width = '50%';

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

        if ($takeattendance) {
            echo '<p>';
            echo '<input type="submit" value="'.get_string('saveattendance', 'facetoface').'" />';
            echo '&nbsp;<input type="submit" name="cancelform" value="'.get_string('cancel').'" />';
            echo '</p></form>';
        }
        else {
            // Actions
            print '<p>';
            if ($can_take_attendance && $session->datetimeknown && facetoface_has_session_started($session, time())) {
                // Take attendance
                echo '<a href="attendees.php?s='.$session->id.'&amp;takeattendance=1&amp;backtoallsessions='.$backtoallsessions.'">'.get_string('takeattendance', 'facetoface').'</a> - ';
            }
        }
    }

    if (!$takeattendance) {
        if (has_capability('mod/facetoface:addattendees', $context) ||
            has_capability('mod/facetoface:removeattendees', $context)) {
            // Add/remove attendees
            echo '<a href="editattendees.php?s='.$session->id.'&amp;backtoallsessions='.$backtoallsessions.'">'.get_string('addremoveattendees', 'facetoface').'</a> - ';
        }
    }
}

// Go back
$url = "{$CFG->wwwroot}/course/view.php?id={$course->id}";
if ($backtoallsessions) {
    $url = "{$CFG->wwwroot}/mod/facetoface/view.php?f={$facetoface->id}&amp;backtoallsessions=$backtoallsessions";
}
print '<a href="'.$url.'">'.get_string('goback', 'facetoface').'</a></p>';


/**
 * Print unapproved requests (if user able to view)
 */
if ($can_approve_requests) {
    echo '<br id="unapproved" />';

    if (!$requests) {
        notify(get_string('noactionableunapprovedrequests', 'facetoface'));
    }
    else {
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

        foreach ($requests as $attendee) {

            $data = array();
            $data[] = "<a href=\"{$CFG->wwwroot}/user/view.php?id={$attendee->id}&amp;course={$course->id}\">". format_string(fullname($attendee)).'</a>';
            $data[] = userdate($attendee->timerequested, get_string('strftimedatetime'));
            $data[] = '<input type="radio" name="requests['.$attendee->id.']" value="0" checked="checked" />';
            $data[] = '<input type="radio" name="requests['.$attendee->id.']" value="1" />';
            $data[] = '<input type="radio" name="requests['.$attendee->id.']" value="2" />';
            $table->data[] = $data;
        }

        print_table($table);

        echo '<p><input type="submit" value="Update requests" /></p>';
        echo '</form>';
    }
}


/**
 * Print cancellations (if user able to view)
 */
if (!$takeattendance && $can_view_cancellations && $cancellations) {

    echo '<br />';
    print_heading(get_string('cancellations', 'facetoface'), 'center');

    $table = new object();
    $table->summary = get_string('cancellationstablesummary', 'facetoface');
    $table->head = array(get_string('name'), get_string('timesignedup', 'facetoface'),
                         get_string('timecancelled', 'facetoface'), get_string('cancelreason', 'facetoface'));
    $table->align = array('left', 'center', 'center');

    foreach ($cancellations as $attendee) {
        $data = array();
        $data[] = "<a href=\"$CFG->wwwroot/user/view.php?id={$attendee->id}&amp;course={$course->id}\">". format_string(fullname($attendee)).'</a>';
        $data[] = userdate($attendee->timesignedup, get_string('strftimedatetime'));
        $data[] = userdate($attendee->timecancelled, get_string('strftimedatetime'));
        $data[] = format_string($attendee->cancelreason);
        $table->data[] = $data;
    }
    print_table($table);
}


/**
 * Print page footer
 */
print_box_end();
print_footer($course);

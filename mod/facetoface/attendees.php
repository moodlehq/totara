<?php
/**
 * Copyright (C) 2010 - 2013 Totara Learning Solutions LTD
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
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage facetoface
 */

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once($CFG->dirroot.'/mod/facetoface/lib.php');
require_once($CFG->dirroot.'/mod/facetoface/attendees_message_form.php');
require_once($CFG->dirroot . '/totara/core/js/lib/setup.php');

global $DB;

/**
 * Load and validate base data
 */
// Face-to-face session ID
$s = required_param('s', PARAM_INT);
// Take attendance
$takeattendance    = optional_param('takeattendance', false, PARAM_BOOL);
// Cancel request
$cancelform        = optional_param('cancelform', false, PARAM_BOOL);
// Action being performed
$action            = optional_param('action', 'attendees', PARAM_ALPHA);
// Only return content
$onlycontent        = optional_param('onlycontent', false, PARAM_BOOL);
// export download
$download = optional_param('download', '', PARAM_ALPHA);

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

// Setup urls
$baseurl = new moodle_url('/mod/facetoface/attendees.php', array('s' => $session->id));

// Load attendees
$attendees = facetoface_get_attendees($session->id);

// Load cancellations
$cancellations = facetoface_get_cancellations($session->id);

// Load waitlisted
$waitlisted = facetoface_get_attendees($session->id, array(MDL_F2F_STATUS_WAITLISTED));

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
// Allowed actions are actions the user has permissions to do
$allowed_actions = array();
// Available actions are actions that have a point. e.g. view the cancellations page whhen there are no cancellations is not an "available" action, but it maybe be an "allowed" action
$available_actions = array();

$context = context_course::instance($course->id);
$contextmodule = context_module::instance($cm->id);
if (!$onlycontent) { // Need to check this for security issues
    require_course_login($course, false, $cm);
}

$PAGE->set_context($contextmodule);

// Actions the user can perform
$has_attendees = facetoface_get_num_attendees($s);

if (has_capability('mod/facetoface:viewattendees', $context)) {
    $allowed_actions[] = 'attendees';
    $allowed_actions[] = 'waitlist';
    $available_actions[] = 'attendees';

    if (facetoface_get_users_by_status($s, MDL_F2F_STATUS_WAITLISTED)) {
        $available_actions[] = 'waitlist';
    }
}

if (has_capability('mod/facetoface:viewcancellations', $context)) {
    $allowed_actions[] = 'cancellations';

    if (facetoface_get_users_by_status($s, MDL_F2F_STATUS_USER_CANCELLED)) {
        $available_actions[] = 'cancellations';
    }
}

if (has_capability('mod/facetoface:takeattendance', $context)) {
    $allowed_actions[] = 'takeattendance';
    $allowed_actions[] = 'messageusers';

    if ($has_attendees && $session->datetimeknown && facetoface_has_session_started($session, time())) {
        $available_actions[] = 'takeattendance';
    }

    if (in_array('attendees', $available_actions) || in_array('cancellations', $available_actions) || in_array('waitlist', $available_actions)) {
        $available_actions[] = 'messageusers';
    }

    // If a user can take attendance, they can approve staff's booking requests
    if ($facetoface->approvalreqd) {
        $allowed_actions[] = 'approvalrequired';
    }
}

$can_view_session = !empty($allowed_actions);

$requests = array();
$declines = array();

// If a user can take attendance, they can approve staff's booking requests
if (in_array('approvalrequired', $allowed_actions)) {
    $requests = facetoface_get_requests($session->id);
    if ($requests) {
        $available_actions[] = 'approvalrequired';
    }
    // Check if the user is manager with staff
} else if ($facetoface->approvalreqd && $staff = totara_get_staff()) {
    // Lets check to see what state their staff are in

    // Check if any staff have requests awaiting approval
    $get_requests = facetoface_get_requests($session->id);
    if ($get_requests) {
        $requests = array_intersect_key($get_requests, array_flip($staff));

        if ($requests) {
            $can_view_session = true;
            $allowed_actions[] = 'approvalrequired';
            $available_actions[] = 'approvalrequired';
        }
    }

    // Check if any staff are attending
    if ($attendees && !in_array('attendees', $allowed_actions)) {
        $attendees = array_intersect_key($attendees, array_flip($staff));

        if ($attendees) {
            $can_view_session = true;
            $allowed_actions[] = 'attendees';
            $available_actions[] = 'attendees';
        }
    }

    // Check if any staff have cancelled
    if ($cancellations && !in_array('cancellations', $allowed_actions)) {
        $cancellations = array_intersect_key($cancellations, array_flip($staff));

        if ($cancellations) {
            $can_view_session = true;
            $allowed_actions[] = 'cancellations';
            $available_actions[] = 'cancellations';
        }
    }

    // Check if any staff have declined
    $get_declines = facetoface_get_declines($session->id);
    if ($get_declines) {
        $declines = array_intersect_key($get_declines, array_flip($staff));

        if ($declines) {
            $can_view_session = true;
            $allowed_actions[] = 'approvalrequired';
            $available_actions[] = 'approvalrequired';
        }
    }
}

/***************************************************************************
 * Handle actions
 */
$show_table = false;
$heading_message = '';
$params = array('sessionid' => $s);
$cols = array();
$actions = array();
if ($action == 'attendees') {
    $heading = get_string('attendees', 'facetoface');

    // Check if any dates are set
    if (!$session->datetimeknown) {
        $heading_message = get_string('sessionnoattendeesaswaitlist', 'facetoface');
    }

    // Get list of actions
    $actions = array(
        'addremove'     => get_string('addremoveattendees', 'facetoface'),
        'bulkaddfile'   => get_string('bulkaddattendeesfromfile', 'facetoface'),
        'bulkaddinput'  => get_string('bulkaddattendeesfrominput', 'facetoface')
    );

    if ($has_attendees) {
        $actions['exportxls'] = get_string('exportxls', 'totara_reportbuilder');
        $actions['exportods'] = get_string('exportods', 'totara_reportbuilder');
        $actions['exportcsv'] = get_string('exportcsv', 'totara_reportbuilder');
    };

    $params['statusgte'] = MDL_F2F_STATUS_BOOKED;
    $cols = array(
        array('user', 'idnumber'),
        array('user', 'namelink'),
        array('user', 'email'),
        array('user', 'position'),
        //array('session', 'discountcode'),
        array('status', 'statuscode'),
    );

    $show_table = true;
}

if ($action == 'waitlist') {
    $heading = get_string('wait-list', 'facetoface');

    $params['status'] = MDL_F2F_STATUS_WAITLISTED;
    $cols = array(
        array('user', 'namelink'),
        array('user', 'email'),
    );

    $show_table = true;
}

if ($action == 'cancellations') {
    $heading = get_string('cancellations', 'facetoface');

    // Get list of actions
    $actions = array(
        'exportxls'     => get_string('exportxls', 'totara_reportbuilder'),
        'exportods'     => get_string('exportods', 'totara_reportbuilder'),
        'exportcsv'     => get_string('exportcsv', 'totara_reportbuilder')
    );

    $params['status'] = MDL_F2F_STATUS_USER_CANCELLED;
    $cols = array(
        array('user', 'idnumber'),
        array('user', 'namelink'),
        array('session', 'cancellationdate'),
        array('session', 'cancellationreason'),
    );

    $show_table = true;
}

if ($action == 'takeattendance') {
    $heading = get_string('takeattendance', 'facetoface');

    // Get list of actions
    $actions = array(
        'exportxls'                 => get_string('exportxls', 'totara_reportbuilder'),
        'exportods'                 => get_string('exportods', 'totara_reportbuilder'),
        'exportcsv'                 => get_string('exportcsv', 'totara_reportbuilder')
    );

    $params['statusgte'] = MDL_F2F_STATUS_BOOKED;
    $cols = array(
        array('status', 'select'),
        array('user', 'namelink'),
        array('status', 'set'),
    );

    $show_table = true;
}

/**
 * Handle submitted data
 */
if ($form = data_submitted()) {
    if (!confirm_sesskey()) {
        print_error('confirmsesskeybad', 'error');
    }

    $return = new moodle_url('/mod/facetoface/attendees.php', array('s' => $s));

    if ($cancelform) {
        redirect($return);
        die();
    }

    // Approve requests
    if ($action == 'approvalrequired' && !empty($form->requests)) {
        if (facetoface_approve_requests($form)) {
            add_to_log($course->id, 'facetoface', 'approve requests', "view.php?id=$cm->id", $facetoface->id, $cm->id);
        }

        redirect($return);
        die();
    }

    // Take attendance
    if ($action == 'takeattendance' && $takeattendance) {
        if (facetoface_take_attendance($form)) {
            add_to_log($course->id, 'facetoface', 'take attendance', "view.php?id=$cm->id", $facetoface->id, $cm->id);
        } else {
            add_to_log($course->id, 'facetoface', 'take attendance (FAILED)', "view.php?id=$cm->id", $face->id, $cm->id);
        }
        redirect($return);
        die();
    }

    // Send messages
    if ($action == 'messageusers') {
        $formurl = clone($baseurl);
        $formurl->param('action', 'messageusers');

        $mform = new mod_facetoface_attendees_message_form($formurl, array('s' => $s));

        // Check form validates
        if ($mform->is_cancelled()) {
            redirect($baseurl);
        } else if ($data = $mform->get_data()) {
            // Get recipients list
            $recipients = array();
            if (!empty($data->recipient_group)) {
                foreach ($data->recipient_group as $key => $value) {
                    if (!$value) {
                        continue;
                    }

                    $recipients = $recipients + facetoface_get_users_by_status($s, $key, 'u.id, u.*');
                }
            }

            // Get indivdual recipients
            if (empty($recipients) && !empty($data->recipients_selected)) {
                // Strip , prefix
                $data->recipients_selected = substr($data->recipients_selected, 1);
                list($insql, $params) = $DB->get_in_or_equal($data->recipients_selected);
                $recipients = $DB->get_records_sql('SELECT * FROM {user} WHERE id ' . $insql, $params);
                if (!$recipients) {
                    $recipients = array();
                }
            }

            // Send messages
            $fromaddress = get_config(NULL, 'facetoface_fromaddress');
            if (!$fromaddress) {
                $fromaddress = '';
            }

            $emailcount = 0;
            $emailerrors = 0;
            foreach ($recipients as $recipient) {
                $body = $data->body['text'];
                $bodyplain = html_to_text($body['text']);

                if (email_to_user($recipient, $fromaddress, $data->subject, $bodyplain, $body) === true) {
                    $emailcount += 1;

                    // Check if we are sending to managers and if user has a manager assigned
                    if (empty($data->cc_managers) || !$manager = totara_get_manager($recipient->id)) {
                        continue;
                    }

                    // Append to message
                    $body = get_string('messagesenttostaffmember', 'facetoface', fullname($recipient))."\n\n".$data->body;
                    $bodyplain = html_to_text($body);

                    if (email_to_user($manager, $fromaddress, $data->subject, $bodyplain, $body) === true) {
                        $emailcount += 1;
                    }
                } else {
                    $emailerrors += 1;
                }
            }

            if ($emailcount) {
                if (!empty($data->cc_managers)) {
                    $message = get_string('xmessagessenttoattendeesandmanagers', 'facetoface', $emailcount);
                } else {
                    $message = get_string('xmessagessenttoattendees', 'facetoface', $emailcount);
                }

                totara_set_notification($message, $return, array('class' => 'notifysuccess'));
            }

            if ($emailerrors) {
                $message = get_string('xmessagesfailed', 'facetoface', $emailerrors);
                totara_set_notification($message);
            }

            redirect($return);
            die();
        }
    }
}


/**
 * Print page header
 */
if (!$onlycontent) {
    local_js(
        array(
            TOTARA_JS_DIALOG,
            TOTARA_JS_TREEVIEW
        )
    );

    $PAGE->requires->string_for_js('save', 'admin');
    $PAGE->requires->string_for_js('cancel', 'moodle');
    $PAGE->requires->strings_for_js(array('uploadfile', 'addremoveattendees', 'approvalreqd','bulkaddattendeesfrominput', 'submitcsvtext', 'bulkaddattendeesresults', 'bulkaddattendeesfromfile', 'bulkaddattendeesresults'), 'facetoface');

    $json_action = json_encode($action);
    $args = array('args' => '{"sessionid":'.$session->id.','.
        '"action":'.$json_action.','.
        '"sesskey":"'.sesskey().'",'.
        '"approvalreqd":"'.$facetoface->approvalreqd.'"}');

    $jsmodule = array(
        'name' => 'totara_f2f_attendees',
        'fullpath' => '/mod/facetoface/attendees.js',
        'requires' => array('json', 'totara_core'));

    if ($action == 'messageusers') {
        $PAGE->requires->strings_for_js(array('editmessagerecipientsindividually', 'existingrecipients', 'potentialrecipients'), 'facetoface');
        $PAGE->requires->string_for_js('update', 'moodle');

        $jsmodule = array(
            'name' => 'totara_f2f_attendees_message',
            'fullpath' => '/mod/facetoface/attendees_messaging.js',
            'requires' => array('json', 'totara_core'));

        $PAGE->requires->js_init_call('M.totara_f2f_attendees_messaging.init', $args, false, $jsmodule);
    } else {
        $jsmodule = array(
            'name' => 'totara_f2f_attendees',
            'fullpath' => '/mod/facetoface/attendees.js',
            'requires' => array('json', 'totara_core'));

        $PAGE->requires->js_init_call('M.totara_f2f_attendees.init', $args, false, $jsmodule);
    }

    add_to_log($course->id, 'facetoface', 'view attendees', "view.php?id=$cm->id", $facetoface->id, $cm->id);

    $pagetitle = format_string($facetoface->name);

    $PAGE->set_url('/mod/facetoface/attendees.php', array('s' => $s));
    $PAGE->set_cm($cm);
    $PAGE->set_pagelayout('standard');

    $PAGE->set_title($pagetitle);
    $PAGE->set_heading($course->fullname);

    echo $OUTPUT->header();
}

/**
 * Print page content
 */
// If taking attendance, make sure the session has already started
if ($takeattendance && $session->datetimeknown && !facetoface_has_session_started($session, time())) {
    $link = "{$CFG->wwwroot}/mod/facetoface/attendees.php?s={$session->id}";
    print_error('error:canttakeattendanceforunstartedsession', 'facetoface', $link);
}

if (!$onlycontent && !$download) {
    echo $OUTPUT->box_start();
    echo $OUTPUT->heading(format_string($facetoface->name));

    if ($can_view_session) {
        echo facetoface_print_session($session, true);
    }
}

if (!$onlycontent && !$download) {
    include('attendee_tabs.php'); // If needed include tabs

    echo $OUTPUT->container_start('f2f-attendees-table');
}


/**
 * Print attendees (if user able to view)
 */
$requests = facetoface_get_requests($session->id);
if ($show_table) {
    // Get list of attendees / cancellations

    if ($action == 'cancellations') {
        $rows = $cancellations;
    } else if ($action == 'waitlist') {
        $rows = $waitlisted;
    } else {
        $rows = $attendees;
    }

    if (!$download) {
        echo $OUTPUT->heading($heading);
    }

    if (empty($rows)) {
        if ($facetoface->approvalreqd) {
            echo $OUTPUT->notification(get_string('nosignedupusersnumrequests', 'facetoface', count($requests)));
        } else {
            echo $OUTPUT->notification(get_string('nosignedupusers', 'facetoface'));
        }
    } else {
        if ($action == 'takeattendance') {

            $attendees_url = new moodle_url('attendees.php', array('s' => $s, 'takeattendance' => '1', 'action' => 'takeattendance'));
            echo html_writer::start_tag('form', array('action' => $attendees_url, 'method' => 'post'));
            echo html_writer::tag('p', get_string('attendanceinstructions', 'facetoface'));
            echo html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 'sesskey', 'value' => $USER->sesskey));
            echo html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 's', 'value' => $s));

            // Prepare status options array
            $status_options = array();
            foreach ($MDL_F2F_STATUS as $key => $value) {
                if ($key <= MDL_F2F_STATUS_BOOKED) {
                    continue;
                }

                $status_options[$key] = get_string('status_'.$value, 'facetoface');
            }
        }

        $table = new flexible_table('facetoface-attendees');
        $baseurl = new moodle_url('/mod/facetoface/attendees.php', array('s' => $session->id, 'sesskey' => sesskey(), 'onlycontent' => true));
        if ($action) {
            $baseurl->param('action', $action);
        }
        $table->define_baseurl($baseurl);
        $table->set_attribute('class', 'generalbox mod-facetoface-attendees');

        $exportfilename = isset($action) ? $action : 'attendees';

        $headers = array();
        $columns = array();
        $export_rows = array();

        $headers[] = get_string('name');
        $columns[] = 'name';

        if ($action == 'takeattendance') {
            $headers[] = get_string('currentstatus', 'facetoface');
            $columns[] = 'currentstatus';
            $headers[] = get_string('attendedsession', 'facetoface');
            $columns[] = 'attendedsession';
        } else if ($action == 'cancellations') {
            $headers[] = get_string('timesignedup', 'facetoface');
            $columns[] = 'timesignedup';
            $headers[] = get_string('timecancelled', 'facetoface');
            $columns[] = 'timecancelled';
            $headers[] = get_string('cancelreason', 'facetoface');
            $columns[] = 'cancellationreason';
        } else {
            if (!get_config(null, 'facetoface_hidecost')) {
                $headers[] = get_string('cost', 'facetoface');
                $columns[] = 'cost';
                if (!get_config(null, 'facetoface_hidediscount')) {
                    $headers[] = get_string('discountcode', 'facetoface');
                    $columns[] = 'discountcode';
                }
            }

            $headers[] = get_string('attendance', 'facetoface');
            $columns[] = 'attendance';
        }
        if (!$download) {
            $table->define_columns($columns);
            $table->define_headers($headers);
            $table->setup();
        }

        foreach ($rows as $attendee) {
            $data = array();
            $attendee_url = new moodle_url('/user/view.php', array('id' => $attendee->id, 'course' => $course->id));
            if ($download) {
                $data[] = format_string(fullname($attendee));
            } else {
                $data[] = html_writer::link($attendee_url, format_string(fullname($attendee)));
            }

            if ($action == 'takeattendance') {
                // Show current status
                $data[] = get_string('status_'.facetoface_get_status($attendee->statuscode), 'facetoface');

                if ($download) {
                    $data[] = '';
                } else {
                    $optionid = 'submissionid_'.$attendee->submissionid;
                    $status = $attendee->statuscode;
                    $select = html_writer::select($status_options, $optionid, $status);
                    $data[] = $select;
                }
            } else if ($action == 'cancellations') {
                $data[] = userdate($attendee->timesignedup, get_string('strftimedatetime'));
                $data[] = userdate($attendee->timecancelled, get_string('strftimedatetime'));
                $data[] = isset($attendee->cancelreason) ? format_string($attendee->cancelreason) : get_string('none');
            } else {
                if (!get_config(NULL, 'facetoface_hidecost')) {
                    $data[] = facetoface_cost($attendee->id, $session->id, $session);
                    if (!get_config(NULL, 'facetoface_hidediscount')) {
                        $data[] = $attendee->discountcode;
                    }
                }
                $data[] = str_replace(' ', '&nbsp;', get_string('status_'.facetoface_get_status($attendee->statuscode), 'facetoface'));
            }
            if (!$download) {
                $table->add_data($data);
            } else {
                $export_rows[] = $data;
            }
        }
        if (!$download) {
            $table->finish_output();
        } else {
            switch ($download) {
                case 'ods':
                    facetoface_download_ods($headers, $export_rows, $exportfilename);
                    break;
                case 'xls':
                    facetoface_download_xls($headers, $export_rows, $exportfilename);
                    break;
                case 'csv':
                    facetoface_download_csv($headers, $export_rows, $exportfilename);
                    break;
            }
        }
    }

    if ($action == 'takeattendance') {
        echo html_writer::start_tag('p');
        echo html_writer::empty_tag('input', array('type' => 'submit', 'value' => get_string('saveattendance', 'facetoface')));
        echo '&nbsp;' . html_writer::empty_tag('input', array('type' => 'submit', 'name' => 'cancelform', 'value' => get_string('cancel')));
        echo html_writer::end_tag('p') . html_writer::end_tag('form');
    }

    echo $OUTPUT->container_start('actions last');
    if ($actions) {
        // Action selector
        echo html_writer::select($actions, 'f2f-actions', '', array('' => get_string('action')));
    }
    echo $OUTPUT->container_end();

    if (isset($result_message)) {
        echo $result_message;
    }
}

if ($action == 'messageusers') {
    $OUTPUT->heading(get_string('messageusers', 'facetoface'));

    $formurl = clone($baseurl);
    $formurl->param('action', 'messageusers');

    $mform = new mod_facetoface_attendees_message_form($formurl, array('s' => $s));
    $mform->display();
}

// Go back
$url = new moodle_url('/mod/facetoface/view.php', array('f' => $facetoface->id));
echo html_writer::link($url, get_string('goback', 'facetoface')) . html_writer::end_tag('p');


/**
 * Print unapproved requests (if user able to view)
 */
if ($action == 'approvalrequired') {
    echo html_writer::empty_tag('br', array('id' => 'unapproved'));

    $actionurl = clone($baseurl);

    echo html_writer::start_tag('form', array('action' => $actionurl, 'method' => 'post'));
    echo html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 'sesskey', 'value' => $USER->sesskey));
    echo html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 's', 'value' => $s));
    echo html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 'action', 'value' => 'approvalrequired'));

    unset($actionurl);

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
        $data[] = html_writer::empty_tag('input', array_merge(array('type' => 'radio', 'name' => 'requests['.$attendee->id.']', 'value' => '2')));
        $table->data[] = $data;
    }

    echo html_writer::table($table);
    echo html_writer::tag('p', html_writer::empty_tag('input', array('type' => 'submit', 'value' => get_string('updaterequests', 'facetoface'))));
    echo html_writer::end_tag('form');
}

/**
 * Print page footer
 */
if (!$onlycontent) {
    echo $OUTPUT->container_end();
    echo $OUTPUT->box_end();
    echo $OUTPUT->footer($course);
}

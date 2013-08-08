<?php
/*
 * This file is part of Totara LMS
 *
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
 * @author David Curry <david.curry@totaralms.com>
 * @package totara
 * @subpackage totara_feedback360
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot . '/totara/feedback360/feedback360_forms.php');
require_once($CFG->dirroot . '/totara/feedback360/lib.php');
require_once($CFG->dirroot . '/totara/message/messagelib.php');

$userid = required_param('userid', PARAM_INT);
$action = required_param('action', PARAM_ALPHA);

$context = context_system::instance();
$strrequestfeedback = get_string('requestfeedback360', 'totara_feedback360');

// Set up the page.
$PAGE->set_url(new moodle_url('/totara/feedback360/index.php'));
$PAGE->set_context($context);
$PAGE->set_totara_menu_selected('feedback360');
$PAGE->set_title($strrequestfeedback);
$PAGE->set_heading($strrequestfeedback);
$PAGE->set_focuscontrol('');
$PAGE->set_cacheable(true);
$PAGE->navbar->add(get_string('feedback360', 'totara_feedback360'), new moodle_url('/totara/feedback360/index.php'));
$PAGE->navbar->add($strrequestfeedback);

// Check user has permission to request feedback.
require_capability('totara/feedback360:requestfeedback360', $context);

// Set up the javascript for the page.
require_once($CFG->dirroot.'/totara/core/js/lib/setup.php');

// Setup lightbox.
local_js(array(
    TOTARA_JS_DIALOG,
    TOTARA_JS_TREEVIEW
));

$PAGE->requires->js('/totara/feedback360/js/preview.js', false);

// Set up the forms based off of the action.
if ($action == 'form') {
    $available_forms = feedback360::get_available_forms($USER->id);

    if (count($available_forms) == 0) {
        print_error('noavailableforms', 'totara_feedback360');
    } elseif (count($available_forms) == 1) {
        $form = array_pop($available_forms);
        redirect("{$CFG->wwwroot}/totara/feedback360/request.php?userid={$userid}&action=users&formid={$form->assigid}");
    } else {
        $mform = new request_select_form();
    }
} else if ($action == 'users') {
    $formid = required_param('formid', PARAM_INT); // Note: formid is actually feedback360_user_assignment.id.
    $update = optional_param('update', 0, PARAM_INT);

    $params = array('feedback360userassignmentid' => $formid);

    $userassignment = $DB->get_record('feedback360_user_assignment', array('id' => $formid));
    $respassignments = $DB->get_records('feedback360_resp_assignment', array('feedback360userassignmentid' => $formid));
    $feedback360 = $DB->get_record('feedback360', array('id' => $userassignment->feedback360id));

    if ($feedback360->status != feedback360::STATUS_ACTIVE) {
        print_error('error:feedbacknotactive', 'totara_feedback360');
    }

    $data = array();
    $data['formid'] = $formid;
    $data['emailexisting'] = array();
    $data['systemexisting'] = array();
    $data['feedbackid'] = $feedback360->id;
    $data['feedbackname'] = format_string($feedback360->name);
    $data['duedate'] = $userassignment->timedue;
    $data['update'] = $update;

    // Incase we are editing get all existing user_resp.
    foreach ($respassignments as $respassignment) {
        if (!empty($respassignment->feedback360emailassignmentid)) {
            $email = $DB->get_field('feedback360_email_assignment', 'email', array('id' => $respassignment->feedback360emailassignmentid));
            $data['emailexisting'][$respassignment->feedback360emailassignmentid] = $email;
        } else {
            $user = $DB->get_record('user', array('id' => $respassignment->userid));
            $data['systemexisting'][$respassignment->userid] = $user;
        }
    }

    $existing = !empty($data['systemexisting']) ? implode(',', array_keys($data['systemexisting'])) : '';
    $args = array('args'=>'{"userid":' . $userid . ','
                         . '"formid":' . $formid . ','
                         . '"existing":"{' . $existing .'}",'
                         . '"sesskey":"' . sesskey() . '"}'
                 );

    $PAGE->requires->strings_for_js(array('addsystemusers'), 'totara_feedback360');

    // Include position user js modules.
    $jsmodule = array('name' => 'totara_requestfeedback',
                      'fullpath' => '/totara/feedback360/js/request.js',
                      'requires' => array('json')
                     );
    $PAGE->requires->js('/totara/feedback360/js/delete.js', false);
    $PAGE->requires->js_init_call('M.totara_requestfeedback.init', $args, false, $jsmodule);

    $mform = new request_select_users();
    $mform->set_data($data);
} else if ($action == 'confirm') {
    $systemnew = required_param('systemnew', PARAM_SEQUENCE);
    $systemcancel = required_param('systemcancel', PARAM_SEQUENCE);
    $systemkeep = required_param('systemkeep', PARAM_SEQUENCE);
    $emailnew = required_param('emailnew', PARAM_TEXT);
    $emailcancel = required_param('emailcancel', PARAM_TEXT);
    $emailkeep = required_param('emailkeep', PARAM_TEXT);
    $formid = required_param('formid', PARAM_INT);
    $newduedate = required_param('duedate', PARAM_INT);
    $oldduedate = required_param('oldduedate', PARAM_INT);
    $mform = new request_confirmation();

    $data = array();
    $data['systemnew'] = $systemnew;
    $data['systemkeep'] = $systemkeep;
    $data['systemcancel'] = $systemcancel;
    $data['emailnew'] = $emailnew;
    $data['emailcancel'] = $emailcancel;
    $data['emailkeep'] = $emailkeep;
    $data['formid'] = $formid;
    $data['oldduedate'] = $oldduedate;
    $data['newduedate'] = $newduedate;
    $data['strings'] = '';

    $mform->set_data($data);
} else {
    print_error('error:unrecognisedaction', 'totara_feedback360', null, $action);
}

// Handle forms being submitted.
if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot . '/totara/feedback360/index.php');
} else if ($data = $mform->get_data()) {
    if ($action == 'form') {
        $params = array('userid' => $userid, 'action' => 'users', 'formid' => $data->formid);
        $url = $CFG->wwwroot . '/totara/feedback360/request.php';
        redirect(new moodle_url($url, $params));
    } else if ($action == 'users') {
        $duedate = totara_date_parse_from_format(get_string('datepickerparseformat', 'totara_core'), $data->duedateselector);

        $newsystem = array();
        if (!empty($data->systemnew)) {
            $newsystem = explode(',', $data->systemnew);
        }

        $cancelsystem = array();
        $keepsystem = array();
        if (!empty($data->systemold)) {
            $oldsystem = explode(',', $data->systemold);
            foreach ($oldsystem as $olduser) {
                if (in_array($olduser, $newsystem)) {
                    $keepsystem[] = $olduser;
                    $newsystem = array_diff($newsystem, array($olduser));
                } else {
                    $cancelsystem[] = $olduser;
                }
            }
        }

        // Include the list of all external emails.
        $newemail = array();
        if (!empty($data->emailnew)) {
            $newemail = explode("\r\n", $data->emailnew);
        }

        // Show cancellations.
        $cancelemail = array();
        $keepemail = array();
        if (!empty($data->emailcancel)) {
            $cancelemail = explode(',', $data->emailcancel);
        }
        if (!empty($data->emailold)) {
            $oldemail = explode(',', $data->emailold);
            foreach ($oldemail as $email) {
                if (!in_array($email, $cancelemail)) {
                    $keepemail[] = $email;
                }
            }
        }

        $oldduedate = 0;
        if (!empty($data->oldduedate)) {
            $oldduedate = $data->oldduedate;
        }

        $newduedate = 0;
        if (!empty($data->duedate)) {
            $newduedate = $data->duedate;
        }

        $params = array('userid' => $data->userid,
                        'action' => 'confirm',
                        'formid' => $data->formid,
                        'systemnew' => implode(',', $newsystem),
                        'systemkeep' => implode(',', $keepsystem),
                        'systemcancel' => implode(',', $cancelsystem),
                        'emailnew' => implode(',', $newemail),
                        'emailkeep' => implode(',', $keepemail),
                        'emailcancel' => implode(',', $cancelemail),
                        'duedate' => $duedate,
                        'oldduedate' => $data->oldduedate,
                       );

        $url = $CFG->wwwroot . '/totara/feedback360/request.php';
        redirect(new moodle_url($url, $params));
    } else if ($action == 'confirm') {
        // Update the timedue in the user_assignment.
        feedback360_responder::update_timedue($data->duedate, $data->formid);

        if ($data->duenotifications) {
            // Set up some variables for use lower down in the send update notification loops.
            $stringmanager = get_string_manager();
            $userfrom = $DB->get_record('user', array('id' => $data->userid));
            $user_assignment = $DB->get_record('feedback360_user_assignment', array('id' => $data->formid));
            $feedback360 = $DB->get_record('feedback360', array('id' => $user_assignment->feedback360id));

            $strvars = new stdClass();
            $strvars->userfrom = fullname($userfrom);
            $strvars->feedbackname = $feedback360->name;
            $strvars->timedue = userdate($data->duedate, get_string('strftimedatetime'));
        }

        // Create new resp_assignments for all users selected in the system.
        $systemnew = !empty($data->systemnew) ? explode(',', $data->systemnew) : array();
        $systemkeep = !empty($data->systemkeep) ? explode(',', $data->systemkeep) : array();
        $systemcancel = !empty($data->systemcancel) ? explode(',', $data->systemcancel) : array();
        feedback360_responder::update_system_assignments($systemnew, $systemcancel, $data->formid, $data->duedate);

        if ($data->duenotifications && !empty($systemkeep)) {
            // Send an alert with an updated duedate to everyone in systemkeep.
            $event = new stdClass();
            $event->userfrom = $userfrom;
            $event->icon = 'feedback360-update';

            foreach ($systemkeep as $userid) {
                $userto = $DB->get_record('user', array('id' => $userid));

                $event->userto = $userto;
                $event->subject = $stringmanager->get_string('updatesubject', 'totara_feedback360', $strvars, $userto->lang);
                $event->fullmessage = $stringmanager->get_string('updatealert', 'totara_feedback360', $strvars, $userto->lang);
                $event->fullmessagehtml = $stringmanager->get_string('updatealert', 'totara_feedback360', $strvars, $userto->lang);
                tm_alert_send($event);
            }
        }

        // Create new email and resp assignments for emails given.
        $emailnew = !empty($data->emailnew) ? explode(',', $data->emailnew) : array();
        $emailkeep = !empty($data->emailkeep) ? explode(',', $data->emailkeep) : array();
        $emailcancel = !empty($data->emailcancel) ? explode(',', $data->emailcancel) : array();
        feedback360_responder::update_external_assignments($emailnew, $emailcancel, $data->formid, $data->duedate);

        if ($data->duenotifications && !empty($emailkeep)) {
            // Send an email with an updated duedate to everyone in emailkeep.
            $emailsubject = get_string('updatesubject', 'totara_feedback360', $strvars);
            $email_str = get_string('updateemail', 'totara_feedback360', $strvars);

            foreach ($emailkeep as $email) {
                feedback360::email_external_address($email, $userfrom, $emailsubject, $email_str, $email_str);
            }
        }

        // Redirect to the myfeedback360 page with a success notification.
        $successstr = get_string('requestcreatedsuccessfully', 'totara_feedback360');
        $returnurl = new moodle_url('/totara/feedback360/index.php');
        totara_set_notification($successstr, $returnurl, array('class' => 'notifysuccess'));
    } else {
        print_error('error:unrecognisedaction', 'totara_feedback360', null, $action);
    }
}

echo $OUTPUT->header();

$mform->display();

echo $OUTPUT->footer();

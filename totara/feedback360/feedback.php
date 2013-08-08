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
 * @author Valerii Kuznetsov <valerii.kuznetsov@totaralms.com>
 * @package totara_feedback360
 */

/**
 * View answer on feedback360
 */
require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot . '/totara/core/js/lib/setup.php');
require_once($CFG->dirroot . '/totara/feedback360/lib.php');
require_once($CFG->dirroot . '/totara/feedback360/feedback360_forms.php');

$preview = optional_param('preview', 0, PARAM_INT);
$viewanswer = optional_param('myfeedback', 0, PARAM_INT);
$returnurl = new moodle_url('/totara/feedback360/index.php');

$token = optional_param('token', '', PARAM_ALPHANUM);
$isexternaluser = ($token != '');

if (!$isexternaluser) {
    require_login();
    if (isguestuser()) {
        $SESSION->wantsurl = qualified_me();
        redirect(get_login_url());
    }
}
// Get response assignment object.
if ($isexternaluser) {
    // Get the user's email address from the token.
    $email = $DB->get_field('feedback360_email_assignment', 'email', array('token' => $token));
    if ($USER->id != $CFG->siteguest) {
        $USER = guest_user();
    }
    $respassignment = feedback360_responder::by_email($email, $token);
    $returnurl = new moodle_url('/totara/feedback360/feedback.php', array('token' => $token));
} else if ($preview) {
    $feedback360id = required_param('feedback360id', PARAM_INT);

    $systemcontext = context_system::instance();
    $canmanage = has_capability('totara/feedback360:managefeedback360', $systemcontext);
    $assigned = feedback360::has_user_assignment($USER->id, $feedback360id);

    if (!$canmanage && !$assigned) {
        print_error('error:previewpermissions', 'totara_feedback360');
    }

    $respassignment = feedback360_responder::by_preview($feedback360id);
} else if ($viewanswer) {
    $responseid = required_param('responseid', PARAM_INT);
    $respassignment = new feedback360_responder($responseid);

    if ($respassignment->subjectid != $USER->id) {
        // If you arent the owner of the feedback request.
        if (totara_is_manager($respassignment->subjectid)) {
            // Or their manager.
            $capability_context = context_user::instance($respassignment->subjectid);
            require_capability('totara/feedback360:viewstaffreceivedfeedback360', $capability_context);
        } else if (!is_siteadmin()) {
            // Or a site admin then you shouldnt see this page.
            throw new feedback360_exception('error:accessdenied');
        }
    }
} else {
    $feedback360id = required_param('feedback360id', PARAM_INT);
    $subjectid = required_param('userid', PARAM_INT);
    $userid = $USER->id;
    $respassignment = feedback360_responder::by_user($userid, $feedback360id, $subjectid);
}

if (!$respassignment) {
    totara_set_notification(get_string('feedback360notfound', 'totara_feedback360'),
            new moodle_url('/totara/feedback360/index.php'), array('class' => 'notifyproblem'));
}

$feedback360 = new feedback360($respassignment->feedback360id);
$PAGE->set_context(null);

$backurl = null;
if ($viewanswer) {
    $backurl = new moodle_url('/totara/feedback360/request/view.php',
            array('userassignment' => $respassignment->feedback360userassignmentid));
}
$form = new feedback360_answer_form(null, array('feedback360' => $feedback360, 'resp' => $respassignment, 'preview' => $preview,
        'backurl' => $backurl));

// Process form submission.
if ($form->is_submitted() && !$respassignment->is_completed()) {
    if ($form->is_cancelled()) {
        redirect($returnurl);
    }

    $formisvalid = $form->is_validated(); // Load the form data.
    $answers = $form->get_submitted_data();
    if ($answers->action == 'saveprogress' || ($answers->action == 'submit' && $formisvalid)) {
        // Save.
        $feedback360->save_answers($answers, $respassignment);
        $message = get_string('progresssaved', 'totara_feedback360');
        if ($answers->action == 'submit') {
            // Mark as answered.
            $respassignment->complete();
            $message = get_string('feedbacksubmitted', 'totara_feedback360');
        }
        totara_set_notification($message, $returnurl, array('class' => 'notifysuccess'));
    }
} else if (!$preview) {
    $form->set_data($feedback360->get_answers($respassignment));
}

// JS support
local_js();
$jsmodule = array(
    'name' => 'totara_feedback360_feedback',
    'fullpath' => '/totara/feedback360/js/feedback.js',
    'requires' => array('json'));
$PAGE->requires->js_init_call('M.totara_feedback360_feedback.init', array($form->_form->getAttribute('id')),
        false, $jsmodule);

$pageurl = new moodle_url('/totara/feedback360/index.php');
$heading = get_string('myfeedback', 'totara_feedback360');
$renderer = $PAGE->get_renderer('totara_feedback360');

$PAGE->set_totara_menu_selected('appraisals');
$PAGE->set_url($pageurl);
if ($preview || $isexternaluser) {
    $PAGE->set_pagelayout('popup');
} else {
    $PAGE->set_pagelayout('noblocks');
}
$PAGE->navbar->add(get_string('feedback360', 'totara_feedback360'), new moodle_url('/totara/feedback360/index.php'));
$PAGE->navbar->add(get_string('givefeedback', 'totara_feedback360'));
$PAGE->set_title($heading);
$PAGE->set_heading($heading);
echo $OUTPUT->header();

if ($preview) {
    echo $renderer->display_preview_feedback_header($respassignment);
} else {
    echo $renderer->display_feedback_header($respassignment);
}
$form->display();

echo $OUTPUT->footer();

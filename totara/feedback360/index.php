<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2013 Totara Learning Solutions LTD
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
require_once($CFG->dirroot . '/totara/feedback360/lib.php');

// Set up page.
require_login();

$userid = optional_param('userid', $USER->id, PARAM_INT);
$context = context_system::instance();
$usercontext = context_user::instance($userid);
$strmyfeedback = get_string('myfeedback', 'totara_feedback360');

// Some permissions checks.
if ($userid == $USER->id) {
    // You are viewing your own feedback.
    require_capability('totara/feedback360:viewownfeedback360', $context);
} else if (!is_siteadmin()) {
    // Skip this check if you are a site admin.
    if (!totara_is_manager($userid)) {
        print_error('error:accessdenied', 'totara_feedback360');
    }

    // You are a manager view a staff members feedback.
    require_capability('totara/feedback360:viewstaffreceivedfeedback360', $usercontext);
}

$PAGE->set_url(new moodle_url('/totara/feedback360/index.php'));
$PAGE->set_context($context);
$PAGE->set_pagelayout('admin');
$PAGE->set_totara_menu_selected('feedback360');
$PAGE->set_title($strmyfeedback);
$PAGE->set_heading($strmyfeedback);
$PAGE->set_focuscontrol('');
$PAGE->set_cacheable(true);
$PAGE->navbar->add(get_string('feedback360', 'totara_feedback360'), new moodle_url('/totara/feedback360/index.php'));
$PAGE->navbar->add(get_string('myfeedback', 'totara_feedback360'));

$renderer = $PAGE->get_renderer('totara_feedback360');
$available_forms = feedback360::get_available_forms($userid);
$num_avail_forms = count($available_forms);

// Title.
$header = html_writer::start_tag('div', array('class' => 'myfeedback_header'));
$header .= $OUTPUT->heading($strmyfeedback);
if ($num_avail_forms > 0) {
    $header .= $renderer->request_feedback360_button($userid);
}
$header .= html_writer::end_tag('div');

// Feedback about user and request feedback button.
if ($userid == $USER->id) {
    $user_title = get_string('feedback360aboutyou', 'totara_feedback360');
} else {
    $user = $DB->get_record('user', array('id' => $userid));
    $fullname = fullname($user);
    $user_title = get_string('feedback360aboutuser', 'totara_feedback360', $fullname);
}

$user_feedback = html_writer::start_tag('div', array('class' => 'user_feedback'));
$user_feedback .= $OUTPUT->heading($user_title, 3);
$user_feedback .= $renderer->myfeedback_user_table($userid);
$user_feedback .= html_writer::end_tag('div');

// Give feedback about others.
$colleagues_title = get_string('feedback360aboutcolleagues', 'totara_feedback360');

$colleagues_feedback = html_writer::start_tag('div', array('class' => 'colleagues_feedback'));
$colleagues_feedback .= $OUTPUT->heading($colleagues_title, 3);
$colleagues_feedback .= $renderer->myfeedback_colleagues_table($userid);
$colleagues_feedback .= html_writer::end_tag('div');

// Display everything.
echo $OUTPUT->header();

echo $header;
echo html_writer::empty_tag('br');
echo $user_feedback;
echo html_writer::empty_tag('br');
echo $colleagues_feedback;

echo $OUTPUT->footer();

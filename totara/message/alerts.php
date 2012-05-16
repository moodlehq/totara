<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
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
 * @author Piers Harding <piers@catalyst.net.nz>
 * @package totara
 * @subpackage message
 */

/**
 * Displays collaborative features for the current user
 */

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once($CFG->dirroot.'/totara/reportbuilder/lib.php');

// initialise jquery requirements
require_once($CFG->dirroot.'/totara/core/js/lib/setup.php');

require_login();

global $SESSION,$USER;

$format = optional_param('format', '',PARAM_TEXT); //export format

// default to current user
$id = $USER->id;

$context = context_system::instance();
$PAGE->set_context($context);
// users can only view their own and their staff's pages
// or if they are an admin
if (($USER->id != $id && !totara_is_manager($id) && !has_capability('totara/message:viewallmessages',$context)) || !confirm_sesskey()) {
    print_error('youcannotview', 'totara_message');
}
$strheading = get_string('alerts', 'totara_message');

$shortname = 'alerts';
$data = array(
    'userid' => $id,
);
if (!$report = reportbuilder_get_embedded_report($shortname, $data)) {
    print_error('error:couldnotgenerateembeddedreport', 'totara_reportbuilder');
}

$report->defaultsortcolumn = 'message_values_sent';
$report->defaultsortorder = 3;

if ($format!='') {
    add_to_log(SITEID, 'reportbuilder', 'export report', 'report.php?id='. $report->_id,
        $report->fullname);

    $report->export_data($format);
    die;
}

add_to_log(SITEID, 'reportbuilder', 'view report', 'report.php?id='. $report->_id,
    $report->fullname);

$report->include_js();
$PAGE->requires->js_init_call('M.totara_message.init');

///
/// Display the page
///
$referer = get_referer();
if (strstr($referer, 'my/team.php')) {
    $backlink = "{$CFG->wwwroot}/my/team.php";
    $PAGE->navbar->add(get_string('myteam', 'totara_core').' '.get_string('dashboard', 'totara_dashboard'), new moodle_url('/my/team.php'));
}
if (strstr($referer, 'my/learning.php')) {
    $backlink = "{$CFG->wwwroot}/my/learning.php";
    $PAGE->navbar->add(get_string('mylearning', 'totara_core').' '.get_string('dashboard', 'totara_dashboard'), new moodle_url('/my/learning.php'));
}
$PAGE->navbar->add($strheading);

$PAGE->set_title($strheading);
$PAGE->set_heading($strheading);

echo $OUTPUT->header();
echo $OUTPUT->heading($strheading, 1);
if (!empty($backlink)) {
    new moodle_url($backlink, array('gi' => $guideinstance->giid));
    echo html_writer::tag('p', html_writer::link($backlink, "<< ".get_string('backtodashboard', 'totara_dashboard')));
}

// display table here
$fullname = $report->fullname;
$countfiltered = $report->get_filtered_count();
$countall = $report->get_full_count();

// display heading including filtering stats
if ($countfiltered == $countall) {
    echo $OUTPUT->heading("$countall".get_string("records"));
} else {
    echo $OUTPUT->heading("$countfiltered/$countall".get_string("recordsshown", "totara_plan"));
}

if (empty($report->description)) {
    $report->description = get_string('alert_description', 'totara_message');
}

print $report->print_description();

$report->display_search();

if ($countfiltered > 0) {
    print $report->showhide_button();
    print html_writer::start_tag('form', array('id' => 'totara_messages', 'name' => 'totara_messages', 'action' => new moodle_url('/totara/message/action.php'),  'method' => 'post'));
    $report->display_table();
    print totara_message_action_button('dismiss');
    print totara_message_action_button('accept');
    print totara_message_action_button('reject');

    $out = $OUTPUT->box_start('generalbox', 'totara_message_actions');
    $out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 'returnto', 'value' => $FULLME));
    $out .= html_writer::start_tag('center');
    $tab = new html_table();
    $tab->align = array('left', 'left');
    $tab->size = array('50%', '50%');
    $tab->set_attribute('class', 'fullwidth');
    $dismisslink = html_writer::empty_tag('input', array('type' => 'submit', 'name' => 'dismiss', 'id' => 'totara-dismiss', 'disabled' => 'true', 'value' => get_string('dismiss', 'totara_message'), 'style' => 'display:none;')).
                   html_writer::tag('noscript', get_string('noscript', 'totara_message'));
    $tab->data[]  = new html_table_row(array(get_string('withselected', 'totara_message'), $dismisslink));
    $out .= html_writer::table($tab);
    $out .= html_writer::end_tag('center');
    $out .= $OUTPUT->box_end();
    print $out;
    print html_writer::end_tag('form');
    // export button
    $report->export_select();
    print totara_message_checkbox_all_none();
}

echo $OUTPUT->footer();

$PAGE->requires->js_init_call('M.totara_message.dismiss_input_toggle');

?>

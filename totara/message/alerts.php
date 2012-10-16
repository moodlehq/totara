<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
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
$PAGE->set_url('/totara/message/alerts.php');
$PAGE->set_pagelayout('noblocks');
// users can only view their own and their staff's pages
// or if they are an admin
if (($USER->id != $id && !totara_is_manager($id) && !has_capability('totara/message:viewallmessages',$context))) {
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
$PAGE->navbar->add(get_string('mylearning', 'totara_core'), new moodle_url('/my/'));
$PAGE->navbar->add($strheading);

$PAGE->set_title($strheading);
$PAGE->set_button($report->edit_button());
$PAGE->set_heading($strheading);

$output = $PAGE->get_renderer('totara_reportbuilder');

echo $output->header();
echo $output->heading($strheading, 1);
echo html_writer::tag('p', html_writer::link("{$CFG->wwwroot}/my/", "<< " . get_string('mylearning', 'totara_core')));

// display table here
$fullname = $report->fullname;
$countfiltered = $report->get_filtered_count();
$countall = $report->get_full_count();

// display heading including filtering stats
if ($countfiltered == $countall) {
    echo $output->heading("$countall ".get_string('records', 'totara_reportbuilder'));
} else {
    echo $output->heading("$countfiltered/$countall".get_string("recordsshown", "totara_plan"));
}

if (empty($report->description)) {
    $report->description = get_string('alert_description', 'totara_message');
}

echo $output->print_description($report->description, $report->_id);

$report->display_search();

$PAGE->requires->string_for_js('reviewitems', 'block_totara_alerts');
$PAGE->requires->js_init_call('M.totara_message.dismiss_input_toggle');

if ($countfiltered > 0) {
    echo $output->showhide_button($report->_id, $report->shortname);
    echo html_writer::start_tag('form', array('id' => 'totara_messages', 'name' => 'totara_messages', 'action' => new moodle_url('/totara/message/action.php'),  'method' => 'post'));
    $report->display_table();
    echo totara_message_action_button('dismiss');
    echo totara_message_action_button('accept');
    echo totara_message_action_button('reject');

    $out = $output->box_start('generalbox', 'totara_message_actions');
    $out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 'returnto', 'value' => $FULLME));
    $out .= html_writer::start_tag('center');
    $tab = new html_table();
    $tab->align = array('left', 'left');
    $tab->size = array('50%', '50%');
    $tab->attributes = array('class', 'fullwidth');
    $dismisslink = html_writer::empty_tag('input', array('type' => 'submit', 'name' => 'dismiss', 'id' => 'totara-dismiss', 'disabled' => 'true', 'value' => get_string('dismiss', 'totara_message'), 'style' => 'display:none;')).
                   html_writer::tag('noscript', get_string('noscript', 'totara_message'));
    $tab->data[]  = new html_table_row(array(get_string('withselected', 'totara_message'), $dismisslink));
    $out .= html_writer::table($tab);
    $out .= html_writer::end_tag('center');
    $out .= $output->box_end();
    print $out;
    print html_writer::end_tag('form');
    // export button
    $output->export_select($report->_id);
    print totara_message_checkbox_all_none();
}

echo $output->footer();

?>

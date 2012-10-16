<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2012 Totara Learning Solutions LTD
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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage reportbuilder
 */

/**
 * Page containing list of saved searches for this report
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot . '/totara/reportbuilder/lib.php');
require_once('report_forms.php');

require_login();

$id = optional_param('id', null, PARAM_INT); // id for report
$sid = optional_param('sid', null, PARAM_INT); // id for saved search
$d = optional_param('d', false, PARAM_BOOL); // delete saved search?
$confirm = optional_param('confirm', false, PARAM_BOOL); // confirm delete
$returnurl = $CFG->wwwroot . '/totara/reportbuilder/savedsearches.php?id=' . $id;

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/totara/reportbuilder/savedsearches.php', array('id' => $id, 'sid' => $sid));
$PAGE->set_totara_menu_selected('myreports');

$output = $PAGE->get_renderer('totara_reportbuilder');

$report = new reportbuilder($id);
if (!$report->is_capable($id)) {
    print_error('nopermission', 'totara_reportbuilder');
}

if ($d && $confirm) {
    // delete an existing saved search
    if (!confirm_sesskey()) {
        totara_set_notification(get_string('error:bad_sesskey', 'totara_reportbuilder'), $returnurl);
    }

    $transaction = $DB->start_delegated_transaction();

    $DB->delete_records('report_builder_saved', array('id' => $sid));
    $sql = "UPDATE {report_builder_schedule} SET savedsearchid = ? WHERE savedsearchid = ?";
    $params = array(0, $sid);
    $DB->execute($sql, $params);

    $transaction->allow_commit();

    totara_set_notification(get_string('savedsearchdeleted', 'totara_reportbuilder'), $returnurl, array('class' => 'notifysuccess'));

} else if ($d) {
    $fullname = $report->fullname;
    $pagetitle = format_string(get_string('savesearch', 'totara_reportbuilder') . ': ' . $fullname);

    $PAGE->set_title($pagetitle);
    $PAGE->set_button($report->edit_button());
    $PAGE->navbar->add(get_string('report', 'totara_reportbuilder'));
    $PAGE->navbar->add($fullname);
    $PAGE->navbar->add(get_string('savedsearches', 'totara_reportbuilder'));
    echo $output->header();

    echo $output->heading(get_string('savedsearches', 'totara_reportbuilder'), 1);
    //is this saved search being used in any scheduled reports?
    if ($scheduled = $DB->get_records('report_builder_schedule', array('savedsearchid' => $sid))) {
        //display a message and list of scheduled reports using this saved search
        ob_start();
        totara_print_scheduled_reports(false, false, array("rbs.savedsearchid = ?", array($sid)));
        $out = ob_get_contents();
        ob_end_clean();

        $messageend = get_string('savedsearchinscheduleddelete', 'totara_reportbuilder', $out) . str_repeat(html_writer::empty_tag('br'), 2);
    } else {
        $messageend = '';
    }

    $messageend .= get_string('savedsearchconfirmdelete', 'totara_reportbuilder');
    // prompt to delete
    echo $output->confirm($messageend, "savedsearches.php?id={$id}&amp;sid={$sid}&amp;d=1&amp;confirm=1&amp;" .
        "sesskey={$USER->sesskey}", $returnurl);

    echo $output->footer();
    exit;
}

$fullname = $report->fullname;
$pagetitle = format_string(get_string('savesearch', 'totara_reportbuilder') . ': ' . $fullname);

$PAGE->set_title($pagetitle);
$PAGE->set_button($report->edit_button());
$PAGE->navbar->add(get_string('report', 'totara_reportbuilder'));
$PAGE->navbar->add($fullname);
$PAGE->navbar->add(get_string('savedsearches', 'totara_reportbuilder'));
echo $output->header();

echo $output->view_report_link($report->report_url());
echo $output->heading(get_string('savedsearches', 'totara_reportbuilder'));

$searches = $DB->get_records('report_builder_saved', array('userid' => $USER->id, 'reportid' => $id), 'name');
if (!empty($searches)) {
    echo $output->saved_searches_table($searches);
} else {
    echo html_writer::tag('p', get_string('error:nosavedsearches', 'totara_reportbuilder'));
}

echo $output->footer();


?>

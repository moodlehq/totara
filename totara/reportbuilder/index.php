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
 * Page containing list of available reports and new report form
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot . '/totara/reportbuilder/lib.php');
require_once($CFG->dirroot . '/totara/reportbuilder/report_forms.php');

$id = optional_param('id', null, PARAM_INT); // id for delete report
$d = optional_param('d', false, PARAM_BOOL); // delete record?
$em = optional_param('em', false, PARAM_BOOL); // embedded report?
$confirm = optional_param('confirm', false, PARAM_BOOL); // confirm delete

admin_externalpage_setup('rbmanagereports');

$output = $PAGE->get_renderer('totara_reportbuilder');

global $USER;

$returnurl = $CFG->wwwroot . '/totara/reportbuilder/index.php';
$type = $em ? 'reload' : 'delete';

// delete an existing report
if ($d && $confirm) {
    if (!confirm_sesskey()) {
        totara_set_notification(get_string('error:bad_sesskey', 'totara_reportbuilder'), $returnurl);
    }
    if (delete_report($id)) {
        add_to_log(SITEID, 'reportbuilder', $type . ' report', 'index.php', 'Report ID=' . $id);
        totara_set_notification(get_string($type . 'report', 'totara_reportbuilder'), $returnurl, array('class' => 'notifysuccess'));

    } else {
        totara_set_notification(get_string('no' . $type . 'report', 'totara_reportbuilder'), $returnurl);
    }
} else if ($d) {
    echo $output->header();
    echo $output->heading(get_string('reportbuilder', 'totara_reportbuilder'));
    if ($em) {
        $continueurl = new moodle_url('/totara/reportbuilder/index.php', array('id' => $id, 'd' => '1', 'em' => $em,
            'confirm' => '1', 'sesskey' => $USER->sesskey));
        echo $output->confirm(get_string('reportconfirm'.$type, 'totara_reportbuilder'), $continueurl, $returnurl);
    } else {
        $continueurl = new moodle_url('/totara/reportbuilder/index.php', array('id' => $id, 'd' => '1', 'em' => $em,
            'confirm' => '1', 'sesskey' => $USER->sesskey));
        echo $output->confirm(get_string('reportconfirm'.$type, 'totara_reportbuilder'), $continueurl, $returnurl);
    }
    echo $output->footer();
    exit;
}

// form definition
$mform = new report_builder_new_form();

// form results check
if ($mform->is_cancelled()) {
    redirect($returnurl);
}
if ($fromform = $mform->get_data()) {

    if (empty($fromform->submitbutton)) {
        totara_set_notification(
            get_string('error:unknownbuttonclicked', 'totara_reportbuilder'),
            $returnurl);
    }
    // create new record here
    $todb = new stdClass();
    $todb->fullname = $fromform->fullname;
    $todb->shortname = reportbuilder::create_shortname($fromform->fullname);
    $todb->source = ($fromform->source != '0') ? $fromform->source : null;
    $todb->hidden = $fromform->hidden;
    $todb->recordsperpage = 40;
    $todb->contentmode = REPORT_BUILDER_CONTENT_MODE_NONE;
    $todb->accessmode = REPORT_BUILDER_ACCESS_MODE_ANY; // default to limited access
    $todb->embedded = 0;

    try {
        $transaction = $DB->start_delegated_transaction();

        $newid = $DB->insert_record('report_builder', $todb);
        add_to_log(SITEID, 'reportbuilder', 'new report', 'report.php?id=' . $newid, $fromform->fullname . ' (ID=' . $newid . ')');

        // by default we'll require a role but not set any, which will restrict report access to
        // the site administrators only
        $todb = new stdClass();
        $todb->reportid = $newid;
        $todb->type = 'role_access';
        $todb->name = 'enable';
        $todb->value = 1;
        $DB->insert_record('report_builder_settings', $todb);

        // restrict access to new report to site managers (and implicitly admins)
        // (if role doesn't exist report will not be visible to anyone)
        if ($managerroleid = $DB->get_field('role', 'id', array('shortname' => 'manager'))) {
            $todb = new stdClass();
            $todb->reportid = $newid;
            $todb->type = 'role_access';
            $todb->name = 'activeroles';
            $todb->value = $managerroleid;
            $DB->insert_record('report_builder_settings', $todb);
        }

        // create columns for new report based on default columns
        $src = reportbuilder::get_source_object($fromform->source);
        if (isset($src->defaultcolumns) && is_array($src->defaultcolumns)) {
            $defaultcolumns = $src->defaultcolumns;
            $so = 1;
            foreach ($defaultcolumns as $option) {
                $heading = isset($option['heading']) ? $option['heading'] :
                    null;
                $hidden = isset($option['hidden']) ? $option['hidden'] : 0;
                $column = $src->new_column_from_option($option['type'],
                    $option['value'], $heading, $hidden);
                $todb = new stdClass();
                $todb->reportid = $newid;
                $todb->type = $column->type;
                $todb->value = $column->value;
                $todb->heading = $column->heading;
                $todb->hidden = $column->hidden;
                $todb->sortorder = $so;
                $todb->customheading = 0; // initially no columns are customised
                $DB->insert_record('report_builder_columns', $todb);
                $so++;
            }
        }
        // create filters for new report based on default filters
        $src = reportbuilder::get_source_object($fromform->source);
        if (isset($src->defaultfilters) && is_array($src->defaultfilters)) {
            $defaultfilters = $src->defaultfilters;
            $so = 1;
            foreach ($defaultfilters as $option) {
                $todb = new stdClass();
                $todb->reportid = $newid;
                $todb->type = $option['type'];
                $todb->value = $option['value'];
                $todb->advanced = isset($option['advanced']) ? $option['advanced'] : 0;
                $todb->sortorder = $so;
                $DB->insert_record('report_builder_filters', $todb);
                $so++;
            }
        }
        $transaction->allow_commit();
        redirect($CFG->wwwroot . '/totara/reportbuilder/general.php?id='.$newid);
    } catch (ReportBuilderException $e) {
        $transaction->rollback($e);
        trigger_error($e->getMessage(), E_USER_WARNING);
    } catch (Exception $e) {
        $transaction->rollback($e);
        redirect($returnurl, get_string('error:couldnotcreatenewreport', 'totara_reportbuilder'));
    }
}

echo $output->header();

//  User-generated (non-embedded) reports
echo $output->heading(get_string('usergeneratedreports', 'totara_reportbuilder'));
$reports = $DB->get_records('report_builder', array('embedded' => 0), 'fullname');
echo $output->user_generated_reports_table($reports);

// Embedded reports
echo $output->heading(get_string('embeddedreports', 'totara_reportbuilder'));
$embeds = reportbuilder_get_all_embedded_reports();
$embedded_ids = $DB->get_records_menu('report_builder', array('embedded' => 1), 'id', 'id, shortname');
foreach ($embeds as $embed) {
    // ensure db record exists and add id to object
    $embed->id = reportbuilder_get_embedded_id_from_shortname($embed->shortname, $embedded_ids);
}
echo $output->embedded_reports_table($embeds);

// display mform
$mform->display();

echo $output->footer();


// page specific functions

/**
 * Deletes a report and any associated data
 *
 * @param integer $id ID of the report to delete
 *
 * @return boolean True if report was successfully deleted
 */
function delete_report($id) {
    global $DB;

    if (!$id) {
        return false;
    }

    $transaction = $DB->start_delegated_transaction();

    // delete the report
    $DB->delete_records('report_builder', array('id' => $id));
    // delete any columns
    $DB->delete_records('report_builder_columns', array('reportid' => $id));
    // delete any filters
    $DB->delete_records('report_builder_filters', array('reportid' => $id));
    // delete any content and access settings
    $DB->delete_records('report_builder_settings', array('reportid' => $id));
    // delete any saved searches
    $DB->delete_records('report_builder_saved', array('reportid' => $id));

    // all okay commit changes
    $transaction->allow_commit();

    return true;
}


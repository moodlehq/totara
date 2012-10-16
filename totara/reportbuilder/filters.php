<?php // $Id$
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
require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->dirroot . '/totara/reportbuilder/lib.php');
require_once($CFG->dirroot . '/totara/reportbuilder/report_forms.php');
require_once($CFG->dirroot . '/totara/core/js/lib/setup.php');

$id = required_param('id', PARAM_INT); // report builder id
$d = optional_param('d', null, PARAM_TEXT); // delete
$m = optional_param('m', null, PARAM_TEXT); // move
$fid = optional_param('fid', null, PARAM_INT); //filter id
$confirm = optional_param('confirm', 0, PARAM_INT); // confirm delete

admin_externalpage_setup('rbmanagereports');

$output = $PAGE->get_renderer('totara_reportbuilder');

$returnurl = new moodle_url('/totara/reportbuilder/filters.php', array('id' => $id));

$report = new reportbuilder($id);

// include jquery
local_js();
$PAGE->requires->strings_for_js(array('saving', 'confirmfilterdelete', 'delete', 'moveup', 'movedown', 'add'), 'totara_reportbuilder');
$args = array('args' => '{"user_sesskey":"'.$USER->sesskey.'", "rb_reportid":'.$id.'}');
$jsmodule = array(
    'name' => 'totara_reportbuilderfilters',
    'fullpath' => '/totara/reportbuilder/filters.js',
    'requires' => array('json'));
$PAGE->requires->js_init_call('M.totara_reportbuilderfilters.init', $args, false, $jsmodule);


// delete fields or columns
if ($d and $confirm) {
    if (!confirm_sesskey()) {
        totara_set_notification(get_string('error:bad_sesskey', 'totara_reportbuilder'), $returnurl);
    }

    if (isset($fid)) {
        if ($report->delete_filter($fid)) {
            add_to_log(SITEID, 'reportbuilder', 'update report', 'filters.php?id='. $id,
                'Delete Filter: Report ID=' . $id . ', Filter ID=' . $fid);
            totara_set_notification(get_string('filter_deleted', 'totara_reportbuilder'), $returnurl, array('class' => 'notifysuccess'));
        } else {
            totara_set_notification(get_string('error:filter_not_deleted', 'totara_reportbuilder'), $returnurl);
        }
    }
}


// confirm deletion of field or column
if ($d) {
    echo $output->header();

    if (isset($fid)) {
        $confirmurl = new moodle_url('/totara/reportbuilder/filters.php',
            array('d' => '1', 'id' => $id, 'fid' => $fid, 'confirm' => '1', 'sesskey' => $USER->sesskey));
        echo $output->confirm(get_string('confirmfilterdelete', 'totara_reportbuilder'), $confirmurl, $returnurl);
    }

    echo $output->footer();
    exit;
}

// move filter
if ($m && isset($fid)) {
    if ($report->move_filter($fid, $m)) {
        add_to_log(SITEID, 'reportbuilder', 'update report', 'filters.php?id='. $id,
            'Moved Filter: Report ID=' . $id . ', Filter ID=' . $fid);
        totara_set_notification(get_string('filter_moved', 'totara_reportbuilder'), $returnurl, array('class' => 'notifysuccess'));
    } else {
        totara_set_notification(get_string('error:filter_not_moved', 'totara_reportbuilder'), $returnurl);
    }
}

// form definition
$mform = new report_builder_edit_filters_form(null, compact('id', 'report'));

// form results check
if ($mform->is_cancelled()) {
    redirect(new moodle_url('/totara/reportbuilder/index.php'));
}
if ($fromform = $mform->get_data()) {

    if (empty($fromform->submitbutton)) {
        print_error('error:unknownbuttonclicked', 'totara_reportbuilder', $returnurl);
    }

    if (build_filters($id, $fromform)) {
        add_to_log(SITEID, 'reportbuilder', 'update report', 'filters.php?id='. $id,
            'Filter Settings: Report ID=' . $id);
        totara_set_notification(get_string('filters_updated', 'totara_reportbuilder'), $returnurl, array('class' => 'notifysuccess'));
    } else {
        totara_set_notification(get_string('error:filters_not_updated', 'totara_reportbuilder'), $returnurl);
    }

}

echo $output->header();

echo $output->container_start('reportbuilder-navlinks');
echo $output->view_all_reports_link() . ' | ';
echo $output->view_report_link($report->report_url());
echo $output->container_end();

echo $output->heading(get_string('editreport', 'totara_reportbuilder', format_string($report->fullname)));

$currenttab = 'filters';
include_once('tabs.php');

// display the form
$mform->display();

// include JS vars
$headings = array();
foreach ($report->src->filteroptions as $option) {
    $key = $option->type . '-' . $option->value;
    $headings[$key] = $option->label;
}
$js = "var rb_reportid = {$id}; var rb_filter_headings = " . json_encode($headings) . ';';
echo html_writer::script($js);

echo $output->footer();

/**
 * Update the report filters table with data from the submitted form
 *
 * @param integer $id Report ID to update
 * @param object $fromform Moodle form object containing the new filter data
 *
 * @return boolean True if the filters could be updated successfully
 */
function build_filters($id, $fromform) {
    global $DB;

    $transaction = $DB->start_delegated_transaction();
    $oldfilters = $DB->get_records('report_builder_filters', array('reportid' => $id));
    // see if existing filters have changed
    foreach ($oldfilters as $fid => $oldfilter) {
        $filtername = "filter{$fid}";
        $advancedname = "advanced{$fid}";
        // update db only if filter has changed
        if (isset($fromform->$filtername) &&
            ($fromform->$filtername != $oldfilter->type.'-'.$oldfilter->value ||
            $fromform->$filtername != $oldfilter->advanced)) {
            $todb = new stdClass();
            $todb->id = $fid;
            $parts = explode('-', $fromform->$filtername);
            $thisadv = isset($fromform->$advancedname) ? 1 : 0;
            $todb->type = $parts[0];
            $todb->value = $parts[1];
            $todb->advanced = $thisadv;
            $DB->update_record('report_builder_filters', $todb);
        }
    }
    // add any new filters
    if (isset($fromform->newfilter) && $fromform->newfilter != '0') {
        $todb = new stdClass();
        $todb->reportid = $id;
        $parts = explode('-', $fromform->newfilter);
        $thisadv = isset($fromform->newadvanced) ? 1 : 0;
        $todb->type = $parts[0];
        $todb->value = $parts[1];
        $todb->advanced = $thisadv;
        $sortorder = $DB->get_field('report_builder_filters', 'MAX(sortorder) + 1', array('reportid' => $id));
        if (!$sortorder) {
            $sortorder = 1;
        }
        $todb->sortorder = $sortorder;
        $DB->insert_record('report_builder_filters', $todb);
    }
    $transaction->allow_commit();
    return true;
}

?>

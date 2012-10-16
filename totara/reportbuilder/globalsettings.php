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
require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->dirroot . '/totara/reportbuilder/lib.php');
require_once($CFG->dirroot . '/totara/reportbuilder/report_forms.php');

admin_externalpage_setup('rbglobalsettings');

$returnurl = $CFG->wwwroot . "/totara/reportbuilder/globalsettings.php";
$output = $PAGE->get_renderer('totara_reportbuilder');

// form definition
$mform = new report_builder_global_settings_form();

// form results check
if ($mform->is_cancelled()) {
    redirect($returnurl);
}
if ($fromform = $mform->get_data()) {

    if (empty($fromform->submitbutton)) {
        totara_set_notification(get_string('error:unknownbuttonclicked', 'totara_reportbuilder'), $returnurl);
    }

    update_global_settings($fromform);

    totara_set_notification(get_string('globalsettingsupdated', 'totara_reportbuilder'), $returnurl, array('class' => 'notifysuccess'));
}

echo $output->header();

echo $output->container_start('reportbuilder-navlinks');
echo $output->view_all_reports_link();
echo $output->container_end();

echo $output->heading(get_string('reportbuilderglobalsettings', 'totara_reportbuilder'));

// display the form
$mform->display();

echo $output->footer();

/**
 * Update global report builder settings
 *
 * @param object $fromform Moodle form object containing global setting changes to apply
 *
 * @return True if settings could be successfully updated
 */
function update_global_settings($fromform) {
    global $REPORT_BUILDER_EXPORT_OPTIONS;

    $exportoptions = 0;
    foreach ($REPORT_BUILDER_EXPORT_OPTIONS as $option => $code) {
        $checkboxname = 'export' . $option;
        if (isset($fromform->$checkboxname) && $fromform->$checkboxname == 1) {
            $exportoptions += $code;
        }
    }
    set_config('exportoptions', $exportoptions, 'reportbuilder');

    $financialyear = 'financialyear';
    $newconfig = $fromform->$financialyear;
    set_config('financialyear', date("dm", mktime(0, 0, 0, $newconfig["F"], $newconfig["d"], 0)), 'reportbuilder');

    return true;
}
?>

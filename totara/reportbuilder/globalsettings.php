<?php // $Id$
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
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
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder 
 */
require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once($CFG->dirroot.'/local/reportbuilder/report_forms.php');

global $USER;

admin_externalpage_setup('globalreportsettings');

$returnurl = $CFG->wwwroot."/local/reportbuilder/globalsettings.php";

// form definition
$mform = new report_builder_global_settings_form();

// form results check
if ($mform->is_cancelled()) {
    redirect($returnurl);
}
if ($fromform = $mform->get_data()) {

    if(empty($fromform->submitbutton)) {
        totara_set_notification(get_string('error:unknownbuttonclicked','local_reportbuilder'), $returnurl);
    }

    if(update_global_settings($fromform)) {
        totara_set_notification(get_string('globalsettingsupdated', 'local_reportbuilder'), $returnurl, array('style' => 'notifysuccess'));
    } else {
        totara_set_notification(get_string('error:couldnotupdateglobalsettings','local_reportbuilder'), $returnurl);
    }
}

admin_externalpage_print_header();

print_container_start(true, 'reportbuilder-navbuttons');
print_single_button($CFG->wwwroot.'/local/reportbuilder/index.php', null, get_string('allreports','local_reportbuilder'));
print_container_end();

print_heading(get_string('reportbuilderglobalsettings','local_reportbuilder'));

// display the form
$mform->display();

admin_externalpage_print_footer();

/**
 * Update global report builder settings
 *
 * @param object $fromform Moodle form object containing global setting changes to apply
 *
 * @return boolean True if settings could be successfully updated
 */
function update_global_settings($fromform) {
    global $REPORT_BUILDER_EXPORT_OPTIONS;

    $exportoptions = 0;
    foreach($REPORT_BUILDER_EXPORT_OPTIONS as $option => $code) {
        $checkboxname = 'export' . $option;
        if(isset($fromform->$checkboxname) && $fromform->$checkboxname == 1) {
            $exportoptions += $code;
        }
    }
    return set_config('exportoptions', $exportoptions, 'reportbuilder');
}
?>

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
 * @author Piers Harding <piers@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder 
 */
require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once($CFG->dirroot.'/local/reportbuilder/report_forms.php');

global $USER;
$id = required_param('id',PARAM_INT); // report builder id

admin_externalpage_setup('managereports');

$returnurl = $CFG->wwwroot."/local/reportbuilder/access.php?id=$id";

$report = new reportbuilder($id);


// form definition
$mform = new report_builder_edit_access_form(null, compact('id','report'));

// form results check
if ($mform->is_cancelled()) {
    redirect($returnurl);
}
if ($fromform = $mform->get_data()) {

    if(empty($fromform->submitbutton)) {
        totara_set_notification(get_string('error:unknownbuttonclicked','local_reportbuilder'), $returnurl);
    }

    if(update_access($id, $fromform)) {
        add_to_log(SITEID, 'reportbuilder', 'update report', 'access.php?id='. $id,
            'Access Settings: Report ID=' . $id);
        totara_set_notification(get_string('reportupdated', 'local_reportbuilder'), $returnurl, array('style' => 'notifysuccess'));
    } else {
        totara_set_notification(get_string('error:couldnotupdatereport','local_reportbuilder'), $returnurl);
    }
}

admin_externalpage_print_header();

print_container_start(true, 'reportbuilder-navbuttons');
print_single_button($CFG->wwwroot.'/local/reportbuilder/index.php', null, get_string('allreports','local_reportbuilder'));
print $report->view_button();
print_container_end();

print_heading(get_string('editreport','local_reportbuilder',$report->fullname));

$currenttab = 'access';
include_once('tabs.php');

// display the form
$mform->display();

admin_externalpage_print_footer();


/**
 * Update the report settings table with new access settings
 *
 * @param integer $reportid ID of the report to update
 * @param object $fromform Moodle form object containing new access settings
 *
 * @return boolean True if the settings could be successfully updated
 */
function update_access($reportid, $fromform) {

    begin_sql();

    // first check if there are any access restrictions at all
    $accessenabled = isset($fromform->accessenabled) ? $fromform->accessenabled : REPORT_BUILDER_ACCESS_MODE_NONE;
    // update access enabled setting
    $todb = new object();
    $todb->id = $reportid;
    $todb->accessmode = $accessenabled;
    if(!update_record('report_builder', $todb)) {
        rollback_sql();
        return false;
    }

    // loop round classes, only considering classes that extend rb_base_access
    foreach(get_declared_classes() as $class) {
        if(is_subclass_of($class, 'rb_base_access')) {
            $obj = new $class();
            if(!$obj->form_process($reportid, $fromform)) {
                rollback_sql();
                return false;
            }
        }
    }

    commit_sql();
    return true;
}

?>

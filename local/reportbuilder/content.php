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

$returnurl = $CFG->wwwroot."/local/reportbuilder/content.php?id=$id";

$report = new reportbuilder($id);

// form definition
$mform = new report_builder_edit_content_form(null, compact('id','report'));

// form results check
if ($mform->is_cancelled()) {
    redirect($returnurl);
}
if ($fromform = $mform->get_data()) {

    if(empty($fromform->submitbutton)) {
        totara_set_notification(get_string('error:unknownbuttonclicked','local_reportbuilder'), $returnurl);
    }

    if(update_content($id, $report, $fromform)) {
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

$currenttab = 'content';
include_once('tabs.php');

// display the form
$mform->display();

admin_externalpage_print_footer();


/**
 * Update the report content settings with data from the submitted form
 *
 * @param integer $id Report ID to update
 * @param object $report Report builder object that is being updated
 * @param object $fromform Moodle form object containing the new content data
 *
 * @return boolean True if the content settings could be updated successfully
 */
function update_content($id, $report, $fromform) {
    begin_sql();

    // first check if there are any content restrictions at all
    $contentenabled = isset($fromform->contentenabled) ? $fromform->contentenabled : REPORT_BUILDER_CONTENT_MODE_NONE;

    // update content enabled setting
    $todb = new object();
    $todb->id = $id;
    $todb->contentmode = $contentenabled;
    if(!update_record('report_builder', $todb)) {
        rollback_sql();
        return false;
    }

    $contentoptions = isset($report->contentoptions) ?
        $report->contentoptions : array();

    // pass form data to content class for processing
    foreach($contentoptions as $option) {
        $classname = 'rb_' . $option->classname . '_content';
        if(class_exists($classname)) {
            $obj = new $classname();
            if(!$obj->form_process($id, $fromform)) {
                rollback_sql();
                return false;
            }
        }
    }

    commit_sql();
    return true;
}


?>

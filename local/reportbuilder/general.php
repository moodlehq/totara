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

/**
 * Page containing general report settings
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once($CFG->dirroot.'/local/reportbuilder/report_forms.php');

global $USER;
$id = required_param('id',PARAM_INT); // report builder id

admin_externalpage_setup('managereports');

$returnurl = $CFG->wwwroot."/local/reportbuilder/general.php?id=$id";

$report = new reportbuilder($id);

// form definition
$mform = new report_builder_edit_form(null, compact('id','report'));

// form results check
if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot.'/local/reportbuilder/index.php');
}
if ($fromform = $mform->get_data()) {

    if(empty($fromform->submitbutton)) {
        totara_set_notification(get_string('error:unknownbuttonclicked','local_reportbuilder'), $returnurl);
    }

    $todb = new object();
    $todb->id = $id;
    $todb->fullname = addslashes($fromform->fullname);
    $todb->hidden = $fromform->hidden;
    $todb->description = addslashes($fromform->description);
    if((int)$fromform->recordsperpage > 5000) {
        $rpp = 5000;
    } else if ((int)$fromform->recordsperpage < 1) {
        $rpp = 1;
    } else {
        $rpp = (int)$fromform->recordsperpage;
    }
    $todb->recordsperpage = $rpp;
    if(update_record('report_builder',$todb)) {
        add_to_log(SITEID, 'reportbuilder', 'update report', 'general.php?id='. $id,
            'General Settings: Report ID=' . $id);
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

print_heading(get_string('editreport','local_reportbuilder', format_string($report->fullname)));

$currenttab = 'general';
include_once('tabs.php');

// display the form
$mform->display();

admin_externalpage_print_footer();


?>

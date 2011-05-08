<?php
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
 * Page containing save search form
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once('report_forms.php');

require_login();

$id = optional_param('id',null,PARAM_INT); // id for report to save
$returnurl = $CFG->wwwroot.'/local/reportbuilder/report.php?id='.$id;

$report = new reportbuilder($id);
if(!$report->is_capable($id)) {
    error(get_string('nopermission','local_reportbuilder'));
}

$mform = new report_builder_save_form(null, compact('id','report'));

// form results check
if ($mform->is_cancelled()) {
    redirect($returnurl);
}
if ($fromform = $mform->get_data()) {
    if(empty($fromform->submitbutton)) {
        print_error('error:unknownbuttonclicked', 'local_reportbuilder', $returnurl);
    }
    // handle form submission
    $todb = new object();
    $todb->reportid = $fromform->id;
    $todb->userid = $fromform->userid;
    $todb->search = $fromform->search;
    $todb->name = $fromform->name;
    $todb->public = $fromform->public;
    if(insert_record('report_builder_saved', $todb)) {
        redirect($CFG->wwwroot.'/local/reportbuilder/savedsearches.php?id='.$id);
    } else {
        redirect($returnurl, get_string('error:couldnotsavesearch','local_reportbuilder'));
    }
}

$fullname = $report->fullname;
$pagetitle = format_string(get_string('savesearch','local_reportbuilder').': '.$fullname);
$navlinks[] = array('name' => get_string('report','local_reportbuilder'), 'link'=> '', 'type'=>'title');
$navlinks[] = array('name' => $fullname, 'link'=> '', 'type'=>'title');
$navlinks[] = array('name' => get_string('savesearch','local_reportbuilder'), 'link'=> '', 'type'=>'title');

$navigation = build_navigation($navlinks);
print_header_simple($pagetitle, '', $navigation, '', null, true);


$mform->display();

print_footer();


?>

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
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage program
 */

/**
 * Program view page
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once 'HTML/QuickForm/Renderer/QuickHtml.php';
require_once($CFG->libdir.'/adminlib.php');
require_once('lib.php');
require_once($CFG->dirroot . '/local/js/lib/setup.php');
require_once('edit_content_form.php');

$id = required_param('id', PARAM_INT); // program id

admin_externalpage_setup('manageprograms', '', array('id' => $id), $CFG->wwwroot.'/local/program/edit_content.php');

$program = new program($id);

//Javascript include
local_js(array(
    TOTARA_JS_DIALOG,
    TOTARA_JS_TREEVIEW
));

// Additional permissions check
if (!has_capability('local/program:configurecontent', $program->get_context())) {
    print_error('error:nopermissions', 'local_program');
}

$programcontent = $program->get_content();

$currenturl = qualified_me();
$currenturl_noquerystring = strip_querystring($currenturl);
$viewurl = $currenturl_noquerystring."?id={$id}";
$overviewurl = $CFG->wwwroot."/local/program/edit.php?id={$id}&action=view";

// if the form has been submitted we need to make sure that the program object
// contains all the submitted data before the form is created and validated as
// the form is defined based on the status of the program object. Nothing is
// saved to the database at this point and the submitted data is only used to
// populate the $program obect.
// This process MUST only READ data from the database and MUST NOT WRITE
// anything as nothing has been checked or validated yet.
if($rawdata = data_submitted()) {

    if( ! $programcontent->setup_content($rawdata)) {
        print_error('error:unabletosetupprogcontent', 'local_program');
    }

    if(isset($rawdata->addcontent)) {
        if( ! $programcontent->add_set($rawdata->contenttype)) {
            notify(get_string('error:unabletoaddset', 'local_program'));
        }
    } else if(isset($rawdata->update)) {
        $programcontent->update_content();
        notify(get_string('contentupdatednotsaved', 'local_program'));
    } else if ($setnumber = $programcontent->check_set_action('delete', $rawdata)) {
        if( ! $programcontent->delete_set($setnumber)) {
            notify(get_string('error:deleteset', 'local_program'));
        }
    } else if ($setnumber = $programcontent->check_set_action('update', $rawdata)) {
        $programcontent->update_set($setnumber);
    } else if ($setnumber = $programcontent->check_set_action('moveup', $rawdata)) {
        $programcontent->move_set_up($setnumber);
    } else if ($setnumber = $programcontent->check_set_action('movedown', $rawdata)) {
        $programcontent->move_set_down($setnumber);
    } else if ($setnumber = $programcontent->check_set_action('addcourse', $rawdata)) {
        if( ! $programcontent->add_course($setnumber, $rawdata)) {
            notify(get_string('error:setunabletoaddcourse', 'local_program'));
        }
    } else if ($setnumber = $programcontent->check_set_action('addcompetency', $rawdata)) {
        if( ! $programcontent->add_competency($setnumber, $rawdata)) {
            notify(get_string('error:setunableaddcompetency', 'local_program'));
        }
    } else if ($action = $programcontent->check_set_action('deletecourse', $rawdata)) {
        if( ! $programcontent->delete_course($action->setnumber, $action->courseid, $rawdata)) {
            notify(get_string('error:setunabletodeletecourse', 'local_program', $action->setnumber));
        }
    } else {
        //$programcontent->update_content();
    }

}

$contenteditform = new program_content_edit_form($currenturl, array('program'=>$program), 'post', '', array('name'=>'form_prog_content'));

// this removes the 'mform' class which is set be default on the form and which
// causes problems with the styling
$contenteditform->_form->updateAttributes(array('class'=>''));

if ($contenteditform->is_cancelled()) {
    totara_set_notification(get_string('programupdatecancelled', 'local_program'), $overviewurl, array('style' => 'notifysuccess'));
}

// if the form has not been submitted, fill in the saved values and defaults
if( ! $rawdata) {
    $contenteditform->set_data($programcontent->formdataobject);
}

// This is where we validate and check the submitted data before saving it
if($data = $contenteditform->get_data()) {

    if(isset($data->savechanges)) {

        // first set up the program content with the validated and checked submitted data
        if( ! $programcontent->setup_content($data)) {
            print_error('error:setupprogcontent', 'local_program');
        }

        // Save program content
        if ( ! $programcontent->save_content()) {
            totara_set_notification(get_string('programupdatefail', 'local_program'), $editurl);
        } else {

            // log this request
            add_to_log(SITEID, 'program', 'update content', "edit_content.php?id={$program->id}", $program->fullname);

            if(isset($data->savechanges)) {
                totara_set_notification(get_string('programcontentsaved', 'local_program'), 'edit_content.php?id='.$id, array('style' => 'notifysuccess'));
            }
        }
    }

}

// log this request
add_to_log(SITEID, 'program', 'view content', "edit_content.php?id={$program->id}", $program->fullname);

$category_breadcrumbs = get_category_breadcrumbs($program->category);

///
/// Display
///

$heading = $program->fullname;
$pagetitle = format_string(get_string('program', 'local_program').': '.$heading);
$navlinks = array();
$navlinks[] = array('name' => get_string('manageprograms', 'admin'), 'link'=> $CFG->wwwroot . '/course/categorylist.php?viewtype=program', 'type'=>'title');
$navlinks = array_merge($navlinks, $category_breadcrumbs);
$navlinks[] = array('name' => $program->shortname, 'link'=> $viewurl, 'type'=>'title');
$navlinks[] = array('name' => get_string('editprogramcontent', 'local_program'), 'link'=> '', 'type'=>'title');

//Javascript includes
require_js(array(
    $CFG->wwwroot.'/local/program/content/program_content.js.php?id='.$program->id,
));

admin_externalpage_print_header('', $navlinks);

print_container_start(false, 'program content', 'edit-program-content');

print_heading($heading);
echo $program->display_current_status();

$exceptions = $program->get_exception_count();
$currenttab = 'content';
require('tabs.php');

// display the curent status and a link to the exceptions report if there are any exceptions

// Display the form
$contenteditform->display();

print_container_end();

echo $program->get_cancel_button();

admin_externalpage_print_footer();


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
require_once('edit_messages_form.php');

$id = required_param('id', PARAM_INT); // program id

admin_externalpage_setup('manageprograms', '', array('id' => $id), $CFG->wwwroot.'/local/program/edit_messages.php');

$program = new program($id);

////Javascript include
//local_js(array(
//    TOTARA_JS_DATEPICKER
//));

//Javascript include
local_js(array(
    TOTARA_JS_DIALOG,
    //TOTARA_JS_TREEVIEW
));

// Additional permissions check
if (!has_capability('local/program:configuremessages', $program->get_context())) {
    print_error('error:nopermissions', 'local_program');
}

$programmessagemanager = $program->get_messagesmanager();

$currenturl = qualified_me();
$currenturl_noquerystring = strip_querystring($currenturl);
$viewurl = $currenturl_noquerystring."?id={$id}";
$overviewurl = $CFG->wwwroot."/local/program/edit.php?id={$id}&action=view";

// if the form has been submitted we need to make sure that the program object
// contains all the submitted data before the form is created and validated as
// the form is defined based on the status of the program object. This MUST
// only READ data from the database and MUST NOT WRITE anything as nothing has
// been checked or validated yet.
if($rawdata = data_submitted()) {

    if( ! $programmessagemanager->setup_messages($rawdata)) {
        print_error('Unable to set up program messages.');
    }

    if(isset($rawdata->addmessage)) {
        if( ! $programmessagemanager->add_message($rawdata->messagetype)) {
            notify('Unable to add new message. Message type not recognised.');
        }
    } else if(isset($rawdata->update)) {
        $programmessagemanager->update_messages();
        notify('Program messages updated (not yet saved)');
    } else if ($messagenumber = $programmessagemanager->check_message_action('delete', $rawdata)) {
        if( ! $programmessagemanager->delete_message($messagenumber)) {
            notify('Unable to delete message. Message not found.');
        }
    } else if ($messagenumber = $programmessagemanager->check_message_action('update', $rawdata)) {
        $programmessagemanager->update_messages();
    } else if ($messagenumber = $programmessagemanager->check_message_action('moveup', $rawdata)) {
        $programmessagemanager->move_message_up($messagenumber);
    } else if ($messagenumber = $programmessagemanager->check_message_action('movedown', $rawdata)) {
        $programmessagemanager->move_message_down($messagenumber);
    }

}

$messageseditform = new program_messages_edit_form($currenturl, array('program'=>$program), 'post', '', array('name'=>'form_prog_messages'));

// this removes the 'mform' class which is set be default on the form and which
// causes problems with the styling
$messageseditform->_form->updateAttributes(array('class'=>''));

if ($messageseditform->is_cancelled()) {
    totara_set_notification(get_string('programupdatecancelled', 'local_program'), $overviewurl, array('style' => 'notifysuccess'));
}

// if the form has not been submitted, fill in the saved values and defaults
if( ! $rawdata) {
    $messageseditform->set_data($programmessagemanager->formdataobject);
}

// This is where we validate and check the submitted data before saving it
if($data = $messageseditform->get_data()) {

    if(isset($data->savechanges)) {

        // first set up the messages manager using the checked and validated form data
        if( ! $programmessagemanager->setup_messages($data)) {
            print_error('Unable to set up program messages.');
        }

        // log this request
        add_to_log(SITEID, 'program', 'update messages', "edit_messages.php?id={$program->id}", $program->fullname);

        // then save the messages
        if( ! $programmessagemanager->save_messages($data)) {
            totara_set_notification(get_string('programupdatefail', 'local_program'), $editurl);
        } else {
            totara_set_notification(get_string('programmessagessaved', 'local_program'), 'edit_messages.php?id='.$id, array('style' => 'notifysuccess'));
        }
    }

}

// log this request
add_to_log(SITEID, 'program', 'view messages', "edit_messages.php?id={$program->id}", $program->fullname);

///
/// Display
///

$category_breadcrumbs = get_category_breadcrumbs($program->category);

$heading = format_string($program->fullname);
$pagetitle = format_string(get_string('program', 'local_program').': '.$heading);
$navlinks = array();
$navlinks[] = array('name' => get_string('manageprograms', 'admin'), 'link'=> $CFG->wwwroot . '/course/categorylist.php?viewtype=program', 'type'=>'title');
$navlinks = array_merge($navlinks, $category_breadcrumbs);
$navlinks[] = array('name' => format_string($program->shortname), 'link'=> $viewurl, 'type'=>'title');
$navlinks[] = array('name' => get_string('editprogrammessages', 'local_program'), 'link'=> '', 'type'=>'title');

//Javascript includes
require_js(array(
    $CFG->wwwroot.'/local/program/messages/program_messages.js.php?id='.$program->id,
));

admin_externalpage_print_header('', $navlinks);

print_container_start(false, 'program messages', 'program-messages');

print_heading($heading);

// Display the current status
echo $program->display_current_status();
$exceptions = $program->get_exception_count();
$currenttab = 'messages';
require('tabs.php');


// Display the form
$messageseditform->display();

echo $program->get_cancel_button();

print_container_end();

admin_externalpage_print_footer();

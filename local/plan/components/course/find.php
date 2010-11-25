<?php

///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT                                                   //
//                                                                       //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//          http://moodle.com                                            //
//                                                                       //
// Copyright (C) 1999 onwards Martin Dougiamas  http://dougiamas.com     //
//                                                                       //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

require_once('../../../../config.php');
require_once($CFG->dirroot.'/local/dialogs/dialog_content_courses.class.php');
require_once($CFG->dirroot.'/local/plan/lib.php');


///
/// Setup / loading data
///

// Plan id
$id = required_param('id', PARAM_INT);

// Category id
$categoryid = optional_param('parentid', 'cat0', PARAM_ALPHANUM);

// Strip cat from begining of categoryid
$categoryid = (int) substr($categoryid, 3);


///
/// Load plan
///
require_capability('local/plan:accessplan', get_system_context());

$plan = new development_plan($id);
$component = $plan->get_component('course');
$selected = $component->get_assigned_items();

// Access control check
if (!$permission = $component->can_update_items()) {
    print_error('error:cannotupdatecourses', 'local_plan');
}


///
/// Setup dialog
///

// Load dialog content generator
$dialog = new totara_dialog_content_courses($categoryid);

// Set type to multiple
$dialog->type = $dialog::TYPE_CHOICE_MULTI;
$dialog->selected_title = 'currentlyselected';

// Setup search
$dialog->search_code = '/course/completion_prerequisite_search.php';

// Add data
$dialog->load_courses();

// Set selected items
$dialog->selected_items = $selected;

// Display page
echo $dialog->generate_markup();

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
require_once($CFG->dirroot.'/local/dialogs/dialog_content_hierarchy.class.php');
require_once($CFG->dirroot.'/local/plan/lib.php');


///
/// Setup / loading data
///

// Plan id
$id = required_param('id', PARAM_INT);

// Parent id
$parentid = optional_param('parentid', 0, PARAM_INT);

// Framework id
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);

// Only return generated tree html
$treeonly = optional_param('treeonly', false, PARAM_BOOL);


///
/// Load plan
///
require_capability('local/plan:accessplan', get_system_context());

$plan = new development_plan($id);
$component = $plan->get_component('competency');
$selected = $component->get_assigned_items();

// Access control check
if (!$permission = $component->can_update_items()) {
    print_error('error:cannotupdatecompetencies', 'local_plan');
}


///
/// Setup dialog
///

// Load dialog content generator
$dialog = new totara_dialog_content_hierarchy_multi('competency', $frameworkid);

// Toggle treeview only display
$dialog->show_treeview_only = $treeonly;

// Load items to display
$dialog->load_items($parentid);

// Set disabled/selected items
$dialog->selected_items = $selected;

// Set title
$dialog->selected_title = 'currentlyselected';

// Display
echo $dialog->generate_markup();

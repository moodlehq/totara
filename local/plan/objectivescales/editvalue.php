<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 * Copyright (C) 1999 onwards Martin Dougiamas
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
 * @author Alastair Munro <alastair@catalyst.net.nz>
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @package totara
 * @subpackage plan
 */

require_once('../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('editvalue_form.php');
require_once('lib.php');


///
/// Setup / loading data
///

$id = optional_param('id', 0, PARAM_INT); // Scale value id; 0 if inserting
$objectivescaleid = optional_param('objscaleid', 0, PARAM_INT); // Objective scale id

// Make sure we have at least one or the other
if (!$id && !$objectivescaleid) {
    error(get_string('error:incorrectparameters', 'local_plan'));
}

// Page setup and check permissions
admin_externalpage_setup('objectivescales');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

if ($id == 0) {
    // Creating new scale value
    require_capability('local/plan:manageobjectivescales', $sitecontext);

    $value = new stdClass();
    $value->id = 0;
    $value->objscaleid = $objectivescaleid;
    $value->sortorder = get_field('dp_objective_scale_value', 'MAX(sortorder) + 1', 'objscaleid', $value->objscaleid);
    if (!$value->sortorder) {
        $value->sortorder = 1;
    }

} else {
    // Editing scale value
    require_capability('local/plan:manageobjectivescales', $sitecontext);

    if (!$value = get_record('dp_objective_scale_value', 'id', $id)) {
        error(get_string('error:objectivescalevalueidincorrect', 'local_plan'));
    }
}
if (!$scale = get_record('dp_objective_scale', 'id', $value->objscaleid)) {
    error(get_string('error:objectivescaleidincorrect','local_plan'));
}

$scale_used = dp_objective_scale_is_used($scale->id);

// Save objective scale name for display in the form
$value->scalename = format_string($scale->name);

// check scale isn't being used when adding new scale values
if($value->id == 0 && $scale_used) {
    error('You cannot add a scale value to a scale that is in use.');
}


///
/// Display page
///

// Create form
$valueform = new dp_objective_scale_value_edit_form(null, array('scaleid' => $scale->id));
$valueform->set_data($value);

// cancelled
if ($valueform->is_cancelled()) {

    redirect("$CFG->wwwroot/local/plan/objectivescales/view.php?id={$value->objscaleid}");

// Update data
} else if ($valuenew = $valueform->get_data()) {

    $valuenew->timemodified = time();
    $valuenew->usermodified = $USER->id;

    if (!strlen($valuenew->numericscore)) {
        $valuenew->numericscore = null;
    }

    // Save
    // New objective scale value
    if ($valuenew->id == 0) {
        unset($valuenew->id);

        if ($valuenew->id = insert_record('dp_objective_scale_value', $valuenew)) {
            add_to_log(SITEID, 'objectives', 'scale value added', "view.php?id={$valuenew->objscaleid}");

            totara_set_notification(get_string('objectivescalevalueadded', 'local_plan', format_string(stripslashes($valuenew->name))), "$CFG->wwwroot/local/plan/objectivescales/view.php?id={$valuenew->objscaleid}", array('style' => 'notifysuccess'));
        } else {
            error(get_string('error:createobjectivevalue', 'local_plan'));
        }

    // Updating objective scale value
    } else {
        if (update_record('dp_objective_scale_value', $valuenew)) {
            // Log
            add_to_log(SITEID, 'objectives', 'scale value updated', "view.php?id={$valuenew->objscaleid}");

            totara_set_notification(get_string('objectivescalevalueupdated', 'local_plan', format_string(stripslashes($valuenew->name))), "$CFG->wwwroot/local/plan/objectivescales/view.php?id={$valuenew->objscaleid}", array('style' => 'notifysuccess'));
        } else {
            error(get_string('error:updateobjectivescalevalue', 'local_plan'));
        }
    }
}

// Display page header
admin_externalpage_print_header();

if ($id == 0) {
    print_heading(get_string('addnewobjectivevalue', 'local_plan'));
} else {
    print_heading(get_string('editobjectivevalue', 'local_plan'));
}

// Display warning if scale is in use
if($scale_used) {
    print_container(get_string('objectivescaleinuse', 'local_plan'), true, 'notifysuccess');
}

$valueform->display();

/// and proper footer
print_footer();

<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2013 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
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
 * @author David Curry <david.curry@totaralms.com>
 * @package totara
 * @subpackage totara_hierarchy
 */

require_once(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . '/config.php');
require_once($CFG->dirroot . '/totara/hierarchy/prefix/goal/item/edit_form.php');
require_once($CFG->dirroot . '/totara/hierarchy/prefix/goal/lib.php');

$userid = optional_param('user', $USER->id, PARAM_INT);
$goalid = optional_param('goal', 0, PARAM_INT);

require_login();

$strmygoals = get_string('mygoals', 'totara_hierarchy');
$pageurl = new moodle_url('/totara/hierarchy/prefix/goal/item/edit_personal.php', array('user' => $userid));

$context = context_user::instance($userid);

// Set up the page.
$PAGE->set_url($pageurl);
$PAGE->set_context($context);
$PAGE->set_pagelayout('admin');
$PAGE->set_totara_menu_selected('mygoals');
$PAGE->set_title($strmygoals);
$PAGE->set_heading($strmygoals);

// You must have some form of managegoals permission to see this page.
$cap_admin = has_capability('totara/hierarchy:managegoalassignments', context_system::instance());
$cap_manager = totara_is_manager($userid) && has_capability('totara/hierarchy:managestaffpersonalgoal', $context);
$cap_self = ($USER->id == $userid) && has_capability('totara/hierarchy:manageownpersonalgoal', $context);

if (!($cap_admin || $cap_manager || $cap_self)) {
    print_error('error:createpersonalgoal', 'totara_hierarchy');
}

if (!empty($goalid)) {
    $item_data = $DB->get_record('goal_personal', array('id' => $goalid));
} else {
    $item_data = new stdClass();
}

$item_data->user = $userid;

$mform = new goal_edit_personal_form();

// Handle the form.
if ($mform->is_cancelled()) {
    // Cancelled.
    redirect("{$CFG->wwwroot}/totara/hierarchy/prefix/goal/mygoals.php?id={$userid}");
} else if ($itemnew = $mform->get_data()) {
    // Update data.
    $todb = new stdClass();
    $todb->userid = $itemnew->user;
    $todb->scaleid = $itemnew->scaleid;
    $todb->name = $itemnew->name;
    $todb->usermodified = $USER->id;
    $todb->timemodified = time();
    if (isset($itemnew->targetdateselector)) {
        if (empty($itemnew->targetdateselector)) {
            $todb->targetdate = 0;
        } else {
            $todb->targetdate = totara_date_parse_from_format(get_string('datepickerparseformat', 'totara_core'), $itemnew->targetdateselector);
        }
        unset($itemnew->targetdateselector);
    }


    $existingrecord = null;
    if (!empty($itemnew->id)) {
        $existingrecord = $DB->get_record('goal_personal', array('id' => $itemnew->id));
    }

    if (isset($existingrecord)) {
        // Handle updates.

        // Set the existing goal id.
        $todb->id = $itemnew->id;

        // If the scale changes then set the current scale value to default.
        if ($todb->scaleid != $existingrecord->scaleid) {
            $todb->scalevalueid = $DB->get_field('goal_scale', 'defaultid', array('id' => $todb->scaleid));
        }

        // Update the record.
        $DB->update_record('goal_personal', $todb);

        $itemnew = file_postupdate_standard_editor($itemnew, 'description', $TEXTAREA_OPTIONS, $context,
            'totara_hierarchy', 'goal', $itemnew->id);
        $DB->set_field('goal_personal', 'description', $itemnew->description, array('id' => $itemnew->id));

        $log_action = 'update';
    } else {
        // Handle creating a new goal.

        // Set the assignment type self/manager/admin.
        if ($USER->id == $todb->userid && $cap_self) {
            // They are assigning it to themselves.
            $todb->assigntype = GOAL_ASSIGNMENT_SELF;
        } else if (totara_is_manager($todb->userid) && $cap_manager) {
            // They are assigning it to their team.
            $todb->assigntype = GOAL_ASSIGNMENT_MANAGER;
        } else if ($cap_admin) {
            // Last option, they are an admin assigning it to someone.
            $todb->assigntype = GOAL_ASSIGNMENT_ADMIN;
        } else {
            print_error('error:createpersonalgoal', 'totara_hierarchy');
        }

        // Set the user/time created.
        $todb->usercreated = $USER->id;
        $todb->timecreated = time();

        // Set the current scale value to default.
        $todb->scalevalueid = $DB->get_field('goal_scale', 'defaultid', array('id' => $todb->scaleid));

        // Insert the record.
        $todb->id = $DB->insert_record('goal_personal', $todb);

        // Fix the description field and redirect.
        $itemnew = file_postupdate_standard_editor($itemnew, 'description', $TEXTAREA_OPTIONS, $TEXTAREA_OPTIONS['context'],
            'totara_hierarchy', 'goal', $todb->id);
        $DB->set_field('goal_personal', 'description', $itemnew->description, array('id' => $todb->id));

        $log_action = 'create';
    }


    // Add the action to the site logs.
    add_to_log(SITEID, 'goal', $log_action . ' personal goal', "edit_personal.php?user={$userid}", $todb->name, 0, $todb->userid);

    redirect("{$CFG->wwwroot}/totara/hierarchy/prefix/goal/mygoals.php?id={$todb->userid}");
}


// Display the page and form.
echo $OUTPUT->header();

$mform->set_data($item_data);
$mform->display();

echo $OUTPUT->footer();


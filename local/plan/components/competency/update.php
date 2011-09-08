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
 * @author Aaron Barnes <aaronb@catalyst.net.nz>
 * @package totara
 * @subpackage plan
 */

require_once('../../../../config.php');
require_once($CFG->dirroot.'/local/plan/lib.php');

require_login();

///
/// Setup / loading data
///

// Plan id
$id = required_param('id', PARAM_INT);
$linkedcourses = optional_param('linkedcourses', array(), PARAM_INT);
$mandatorycourses = optional_param('mandatory', array(), PARAM_INT);

// Updated course lists
$idlist = optional_param('update', null, PARAM_SEQUENCE);
if ($idlist == null) {
    $idlist = array();
}
else {
    $idlist = explode(',', $idlist);
}

$plan = new development_plan($id);
$componentname = 'competency';
$component = $plan->get_component($componentname);

// Basic access control checks
if (!$component->can_update_items()) {
    print_error('error:cannotupdateitems', 'local_plan');
}

$status = true;
begin_sql();
$component->update_assigned_items($idlist);

// now assign the linked courses
if (count($linkedcourses) != 0) {
    foreach ($linkedcourses as $compid => $courses) {
        foreach ($courses as $course => $unused) {

            // add course if it's not already in this plan
            // @todo what if course is assigned but not approved?
            if (!$plan->get_component('course')->is_item_assigned($course)) {
                // Last "false" is because it was assigned automatically
                $plan->get_component('course')->assign_new_item($course, true, false);
            }

            // Now we need to grab the assignment ID
            $assignmentid = get_field('dp_plan_course_assign', 'id', 'planid', $plan->id, 'courseid', $course);

            if (!$assignmentid) {
                // something went wrong trying to assign the course
                // don't attempt to create a relation
                $status = false;
                continue;
            }

            // Get the competency assignment ID from the competency
            $compassignid = get_field('dp_plan_competency_assign', 'id', 'competencyid', $compid, 'planid', $plan->id);

            if (!$compassignid) {
                $status = false;
                continue;
            }

            // Check if this is mandatory
            if (!empty($mandatorycourses[$compid][$course])) {
                $mandatory = 'course';
            } else {
                $mandatory = '';
            }

            // Create relation
            $plan->add_component_relation('competency', $compassignid, 'course', $assignmentid, $mandatory);
        }
    }
}

// Only make dialog changes if everything worked
if ($status) {
    commit_sql();
} else {
    rollback_sql();
}

echo $component->display_list();
echo $plan->display_plan_message_box();

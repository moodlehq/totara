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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @package totara
 * @subpackage plan
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot . '/local/plan/lib.php');

require_login();

$planuser = optional_param('userid', $USER->id, PARAM_INT); // show plans for this user


//
/// Permission checks
//
if (!dp_can_view_users_plans($planuser)) {
    print_error('error:nopermissions', 'local_plan');
}

// Check if we are viewing these plans as a manager or a learner
if ($planuser != $USER->id) {
    $role = 'manager';
} else {
    $role = 'learner';
}

if (!$template = dp_get_first_template()) {
    print_error('notemplatesetup', 'local_plan');
}

$canaddplan = (dp_get_template_permission($template->id, 'plan', 'create', $role) == DP_PERMISSION_ALLOW);



//
// Display plan list
//
$heading = get_string('learningplans', 'local_plan');
$pagetitle = format_string(get_string('learningplans','local_plan'));
$navlinks = array();

dp_get_plan_base_navlinks($navlinks, $planuser);

$navigation = build_navigation($navlinks);
print_header($heading, $pagetitle, $navigation);

// Plan menu
echo dp_display_plans_menu($planuser,0,$role);

// Plan page content
print_container_start(false, '', 'dp-plan-content');

if($planuser != $USER->id) {
    echo dp_display_user_message_box($planuser);
}

print_heading($heading);

print_container_start(false, '', 'dp-plans-description');
if($planuser == $USER->id) {
    $planinstructions = '<div class="instructional_text">' . get_string('planinstructions', 'local_plan');
    add_to_log(SITEID, 'plan', 'view all', "index.php?userid={$planuser}");
} else {
    $user = get_record('user', 'id', $planuser);
    $userfullname = fullname($user);
    $planinstructions = '<div class="instructional_text">' . get_string('planinstructionsuser', 'local_plan', $userfullname);
    add_to_log(SITEID, 'plan', 'view all', "index.php?userid={$planuser}", $userfullname);
}
if($canaddplan) {
    $planinstructions .= get_string('planinstructions_add', 'local_plan');
}
$planinstructions .= '</div>';

echo $planinstructions;

if ($canaddplan) {
    echo dp_display_add_plan_icon($planuser);
}
echo '<div style="clear:both;"></div>';
print_container_end();

print_container_start(false, '', 'dp-plans-list-active-plans');
echo dp_display_plans($planuser, array(DP_PLAN_STATUS_APPROVED), array('enddate', 'status'), get_string('activeplans', 'local_plan'));
print_container_end();

print_container_start(false, '', 'dp-plans-list-unapproved-plans');
echo dp_display_plans($planuser, array(DP_PLAN_STATUS_UNAPPROVED), array('status'), get_string('unapprovedplans', 'local_plan'));
print_container_end();

print_container_start(false, '', 'dp-plans-list-completed-plans');
echo dp_display_plans($planuser, DP_PLAN_STATUS_COMPLETE, array('completed'), get_string('completedplans', 'local_plan'));
print_container_end();

print_container_end();

print_footer();

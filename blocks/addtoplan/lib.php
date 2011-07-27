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
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage plan
 */
require_once($CFG->dirroot.'/local/plan/lib.php');

function get_addtoplan_block_content($courseid, $userid) {
    global $CFG, $USER;

    $plans = dp_get_plans($userid, array(DP_PLAN_STATUS_UNAPPROVED, DP_PLAN_STATUS_APPROVED));
    if (!is_array($plans)) {
        $plans = array();
    } else {
        $plans = array_keys($plans);
    }

    $course_include = $CFG->dirroot . '/local/plan/components/course/course.class.php';
    if (file_exists($course_include)) {
        require_once($course_include);
    } else {
        return '';
    }

    // Get plans that contain course to exclude them from the list
    $plans_with_course = call_user_func("dp_course_component::get_plans_containing_item", $courseid, $userid);

    if ($plans_with_course) {
        if ($exclude_plans = array_values($plans_with_course)) {
            $plans = (array_diff($plans, $exclude_plans));
        }
    }

    $html = '<div id="block_addtoplan_text">';

    if (!empty($plans)) {
        $html .= '<p>'.get_string('addtoplanhint', 'block_addtoplan').'</p>';
        $html .= '<div class="buttons plan-add-item-button-wrapper" id="block_addtoplan_button">';
        $html .= '<div class="singlebutton dp-plan-assign-button">';
        $html .= '<div>'."\n";
        $html .= '<form>';
        $html .= '<select id="block_addtoplan_selector">';
        foreach ($plans as $planid) {
            $plan = new development_plan($planid);
            $html .= '<option value="' . $plan->id . '">' . $plan->name . '</option>';
        }
        $html .= '</select>';
        $html .= '<input type="submit" class="plan-add-item-button" id="show-course-dialog" value="'.get_string('add', 'block_addtoplan').'" />';
        $html .= '</form>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
    }

    // Display list of plans
    if (!empty($exclude_plans) && is_array($exclude_plans)) {
        // Get correct string
        $planstring = '';
        $planstring .= (empty($plans) ? 'course' : 'coursealready');
        $planstring .= 'inplan';
        $planstring .= (count($exclude_plans) == 1 ? '' : 's');

        $html .= '<p><strong>'.get_string($planstring, 'block_addtoplan').'</strong></p>';
        $html .= '<ul>';
        foreach ($exclude_plans as $planid) {
            $plan = new development_plan($planid);
            $html .= '<li>' . $plan->name . '</li>';
        }
        $html .= '</ul>';
    }
    $html .= '</div>';

    return $html;
}
?>

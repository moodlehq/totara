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
 * @author Peter Bulmer <peterb@catalyst.net.nz>
 * @author Aaron Wells <aaronw@catalyst.net.nz>
 * @package totara
 * @subpackage plan
 */

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');
require_once($CFG->dirroot . '/local/plan/lib.php');
require_once($CFG->dirroot . '/local/plan/components/objective/edit_form.php');
require_once($CFG->dirroot . '/local/js/lib/setup.php');

$id = required_param('id', PARAM_INT); // plan id
$caid = required_param('itemid', PARAM_INT); // objective assignment id

require_login();
$plan = new development_plan($id);

//Permissions check
$systemcontext = get_system_context();
if(!has_capability('local/plan:accessanyplan', $systemcontext) && ($plan->get_setting('view') < DP_PERMISSION_ALLOW)) {
        print_error('error:nopermissions', 'local_plan');
}

$plancompleted = $plan->status == DP_PLAN_STATUS_COMPLETE;
$componentname = 'objective';
$component = $plan->get_component($componentname);
$objectivename = get_string($componentname, 'local_plan');
$coursename = get_string('courseplural', 'local_plan');

/// Javascript stuff
// If we are showing dialog
if ($component->can_update_items()) {
    // Setup lightbox
    local_js(array(
        TOTARA_JS_DIALOG,
        TOTARA_JS_TREEVIEW
    ));

    // Get course picker
    require_js(array(
        $CFG->wwwroot.'/local/plan/components/objective/find-course.js.php'
    ));
}

$mform = $component->objective_form($caid, 'view');
if ($data = $mform->get_data()){
    if (isset($data->edit)){
        redirect("{$CFG->wwwroot}/local/plan/components/objective/edit.php?id={$id}&itemid={$caid}");
    } elseif (isset($data->delete)){
        redirect("{$CFG->wwwroot}/local/plan/components/objective/edit.php?id={$id}&itemid={$caid}&d=1");
    }
}
//$mform = new moodleform();

$fullname = $plan->name;
$pagetitle = format_string(get_string('learningplan','local_plan').': '.$fullname);
$navlinks = array();
dp_get_plan_base_navlinks($navlinks, $plan->userid);
$navlinks[] = array('name' => $fullname, 'link'=> $CFG->wwwroot . '/local/plan/view.php?id='.$id, 'type'=>'title');
$navlinks[] = array('name' => get_string($component->component, 'local_plan'), 'link' => $component->get_url(), 'type' => 'title');
$navlinks[] = array('name' => get_string('viewitem','local_plan'), 'link' => '', 'type' => 'title');

$navigation = build_navigation($navlinks);

$plan->print_header($componentname, $navlinks, false);

print $component->display_back_to_index_link();
$component->display_objective_detail($caid, true);


if ( $plan->get_component('course')->get_setting('enabled') ){
    print '<br />';
    print '<h3>' . get_string('linkedx', 'local_plan', $coursename) . '</h3>';
    if ( !$plancompleted ){
        print $component->display_course_picker($caid);
    }
    print '<div id="dp-objective-courses-container">';
    if($linkedcourses =
        $component->get_linked_components($caid, 'course')) {
        print $plan->get_component('course')->display_linked_courses($linkedcourses);
    } else {
        print '<p class="noitems-assigncourse">' . get_string('nolinkedx', 'local_plan', strtolower($coursename)). '</p>';
    }
    print '</div>';

}

print_container_end();

print_footer();


?>

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
 * @author Aaron Wells <aaronw@catalyst.net.nz>
 * @author Aaron Barnes <aaronb@catalyst.net.nz>
 * @package totara
 * @subpackage plan
 */

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');
require_once($CFG->dirroot.'/local/plan/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');

require_login();

$id = required_param('id', PARAM_INT); // plan id
$caid = required_param('itemid', PARAM_INT); // course assignment id

$plan = new development_plan($id);
$systemcontext = get_context_instance(CONTEXT_SYSTEM);

//Permissions check
$systemcontext = get_system_context();
if(!has_capability('local/plan:accessanyplan', $systemcontext) && ($plan->get_setting('view') < DP_PERMISSION_ALLOW)) {
        print_error('error:nopermissions', 'local_plan');
}

$plancompleted = $plan->status == DP_PLAN_STATUS_COMPLETE;
$componentname = 'course';
$component = $plan->get_component($componentname);
$currenturl = $CFG->wwwroot . '/local/plan/components/course/view.php?id='.$id.'&amp;itemid='.$caid;
$competenciesenabled = $plan->get_component('competency')->get_setting('enabled');
$competencyname = get_string('competencyplural', 'local_plan');
$objectivesenabled = $plan->get_component('objective')->get_setting('enabled');
$objectivename = get_string('objectiveplural', 'local_plan');

$fullname = $plan->name;
$pagetitle = format_string(get_string('learningplan','local_plan').': '.$fullname);

$navlinks = array();
dp_get_plan_base_navlinks($navlinks, $plan->userid);
$navlinks[] = array('name' => $fullname, 'link'=> $CFG->wwwroot . '/local/plan/view.php?id='.$id, 'type'=>'title');
$navlinks[] = array('name' => get_string($component->component, 'local_plan'), 'link' => $component->get_url(), 'type' => 'title');
$navlinks[] = array('name' => get_string('viewitem','local_plan'), 'link' => '', 'type' => 'title');

/// Javascript stuff
// If we are showing dialog
if ($component->can_update_items()) {
    // Setup lightbox
    local_js(array(
        TOTARA_JS_DIALOG,
        TOTARA_JS_TREEVIEW
    ));

    // Get competency picker
    require_js(array(
        $CFG->wwwroot.'/local/plan/components/course/find-competency.js.php'
    ));
}

$navigation = build_navigation($navlinks);

$plan->print_header($componentname, $navlinks, false);

print $component->display_back_to_index_link();

print $component->display_course_detail($caid);

if($competenciesenabled) {
    print '<br />';
    print '<h3>' . get_string('linkedx', 'local_plan', $competencyname) . '</h3>';
    print '<div id="dp-course-competencies-container">';
    if($linkedcomps = $component->get_linked_components($caid, 'competency')) {
        print $plan->get_component('competency')->display_linked_competencies($linkedcomps);
    } else {
        print '<p class="noitems-assigncompetencies">' . get_string('nolinkedx', 'local_plan', strtolower($competencyname)). '</p>';
    }
    print '</div>';

    if (!$plancompleted) {
        print $component->display_competency_picker($caid);
    }
}

if ($objectivesenabled){
    print '<br />';
    print '<h3>' . get_string('linkedx', 'local_plan', $objectivename) . '</h3>';

    if ($linkedobjectives = $component->get_linked_components( $caid, 'objective')) {
        print $plan->get_component('objective')->display_linked_objectives($linkedobjectives);
    } else {
        print '<p>'.get_string('nolinkedx', 'local_plan', strtolower($objectivename)).'</p>';
    }
}

// Comments
require_once($CFG->dirroot.'/local/comment/lib.php');
comment::init();
$options = new stdClass;
$options->area    = 'plan-course-item';
$options->context = $systemcontext;
$options->itemid  = $caid;
$options->showcount = true;
$options->component = 'local_plan';
$options->autostart = true;
$options->notoggle = true;
$comment = new comment($options);
echo $comment->output(true);
print_container_end();

print_footer();


?>

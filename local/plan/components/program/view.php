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
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage plan
 */

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');
require_once($CFG->dirroot . '/local/plan/lib.php');

require_login();

$id = required_param('id', PARAM_INT); // plan id
$progassid = required_param('itemid', PARAM_INT); // program assignment id

$plan = new development_plan($id);
$systemcontext = get_context_instance(CONTEXT_SYSTEM);

//Permissions check
$systemcontext = get_system_context();
if(!has_capability('local/plan:accessanyplan', $systemcontext) && ($plan->get_setting('view') < DP_PERMISSION_ALLOW)) {
        print_error('error:nopermissions', 'local_plan');
}

$componentname = 'program';
$component = $plan->get_component($componentname);
$currenturl = $CFG->wwwroot . '/local/plan/components/program/view.php?id='.$id.'&amp;itemid='.$progassid;

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

print $component->display_program_detail($progassid);


// Comments
require_once($CFG->dirroot.'/local/comment/lib.php');
comment::init();
$options = new stdClass;
$options->area    = 'plan-program-item';
$options->context = $systemcontext;
$options->itemid  = $progassid;
$options->showcount = true;
$options->component = 'local_plan';
$options->autostart = true;
$options->notoggle = true;
$comment = new comment($options);
echo $comment->output(true);

print_container_end();

print_footer();


?>

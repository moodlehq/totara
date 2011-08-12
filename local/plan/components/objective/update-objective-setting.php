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
 * @author Aaron Wells <aaronw@catalyst.net.nz>
 * @author Aaron Barnes <aaron.barnes@totaralms.com>
 * @package totara
 * @subpackage plan
 */

header("Content-Type:text/plain");
require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/config.php');
require_once($CFG->dirroot.'/hierarchy/prefix/position/lib.php');
require_once($CFG->dirroot.'/hierarchy/prefix/competency/evidence/lib.php');
require_once($CFG->dirroot.'/local/plan/development_plan.class.php');


// Get information
$objectiveid    = required_param('objectiveid', PARAM_INT);
$proficiency    = required_param('prof', PARAM_INT);
$planid         = required_param('planid', PARAM_INT);

// Permissions check
require_login();

// Check permission to access the plan
$plan = new development_plan($planid);
$userid = $plan->userid;
$component = $plan->get_component('objective');

if (!$component->get_setting('setpriority') == DP_PERMISSION_ALLOW) {
    echo "NO PERMS";
}

// Log it
add_to_log(SITEID, 'plan', 'objective proficiency updated', "update-objective-setting.php?objectiveid={$objectiveid}&prof={$proficiency}&planid={$planid}", 'ajax');

// Check proficiency scale value exists
$scalevalue = get_record('dp_objective_scale_value', 'id', $proficiency);
if (empty($scalevalue)) {
    error(get_string('error:priorityscalevalueidincorrect','local_plan'));
}

// Update the objective proficiency
$details = new object();
$details->id = $objectiveid;
$details->scalevalueid = $proficiency;
if (!update_record('dp_plan_objective', $details)) {
    echo "FAIL";
    die();
}

// Update stats block

$count = count_records('block_totara_stats', 'userid', $userid, 'eventtype', STATS_EVENT_OBJ_ACHIEVED, 'data2', $objectiveid);

// Checks objective can only be achieved once.
if ($scalevalue->achieved == 1 && $count < 1) {
    totara_stats_add_event(time(), $userid, STATS_EVENT_OBJ_ACHIEVED, '', $objectiveid);
// Checks objective exists for removal
} else if ($scalevalue->achieved == 0 && $count > 0) {
    totara_stats_remove_event($userid, STATS_EVENT_OBJ_ACHIEVED, $objectiveid);
}

dp_plan_check_plan_complete(array($planid));
echo "OK";

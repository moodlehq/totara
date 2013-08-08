<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2013 Totara Learning Solutions LTD
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
 * @subpackage totara_plan
 */

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');
require_once($CFG->dirroot . '/totara/hierarchy/prefix/goal/lib.php');

// Permissions.
require_sesskey();

$type = required_param('type', PARAM_ALPHA);
$scalevalueid = required_param('scv', PARAM_INT);
$userid = required_param('uid', PARAM_INT);
$nojs = optional_param('nojs', false, PARAM_BOOL);

$systemcontext = context_system::instance();

// Check if they have admin permissions.
if (!has_capability("totara/hierarchy:managegoalassignments", $systemcontext) && !empty($userid)) {
    $usercontext = context_user::instance($userid);
    // Check if they have manager permissions.
    if (!(totara_is_manager($userid) && has_capability("totara/hierarchy:managestaff{$type}goal", $usercontext))) {
        // Check if they have self management permissions.
        if (!($userid == $USER->id && has_capability("totara/hierarchy:manageown{$type}goal", $usercontext))) {
            // Something is wrong!
            echo get_string('error:updatescalevalue', 'totara_hierarchy');
        }
    }
}

switch ($type) {
    case 'company':
        $goalid = required_param('gid', PARAM_INT);

        $update_params = array($scalevalueid, $userid, $goalid);
        $update_sql = "UPDATE {goal_record}
               SET scalevalueid = ?
               WHERE userid = ?
               AND goalid = ?";
        break;
    case 'personal':
        $assignmentid = required_param('gaid', PARAM_INT);

        // Easy update for one record.
        $update_params = array($scalevalueid, $assignmentid);
        $update_sql = "UPDATE {goal_personal}
               SET scalevalueid = ?
               WHERE id = ?";
        break;
}

$return = new moodle_url('/totara/hierarchy/prefix/goal/mygoals.php', array('id' => $userid));

if ($DB->execute($update_sql, $update_params)) {
    if ($nojs) {
        $message = get_string('updatescalevaluesuccess', 'totara_hierarchy');
        totara_set_notification($message, $return, array('class' => 'notifysuccess'));
    }
    echo "OK";
} else {
    if ($nojs) {
        $message = get_string('updatescalevaluefailure', 'totara_hierarchy');
        totara_set_notification($message, $return, array('class' => 'notifyproblem'));
    }
    echo get_string('error:updatingscalevalue', 'totara_hierarchy');
}

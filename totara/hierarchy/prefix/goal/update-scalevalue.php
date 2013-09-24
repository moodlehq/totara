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

$scope = required_param('scope', PARAM_INT);
$scalevalueid = required_param('scalevalueid', PARAM_INT);
$userid = required_param('userid', PARAM_INT);
$nojs = optional_param('nojs', false, PARAM_BOOL);

// Check if they have admin permissions.
if (!goal::can_update_goals($userid, $scope)) {
    echo get_string('error:updatescalevalue', 'totara_hierarchy');
}

$todb = new stdClass();
$todb->id = required_param('goalitemid', PARAM_INT);
$todb->scalevalueid = $scalevalueid;
$result = goal::update_goal_item($todb, $scope);

$return = new moodle_url('/totara/hierarchy/prefix/goal/mygoals.php', array('userid' => $userid));

if ($result) {
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

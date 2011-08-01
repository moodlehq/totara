<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 * Copyright (C) 1999 onwards Martin Dougiamas
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


// 1. Get information
$competencyid = required_param('c', PARAM_INT);
$prof = required_param('p', PARAM_INT);
// Include $planid and $userid to limit the possibility of errors
$planid = required_param('pl', PARAM_INT);
$userid = required_param('u', PARAM_INT);

// Permissions check
require_login();

// Check permission to access the plan
$plan = new development_plan($planid);

$componentname = 'competency';
$component = $plan->get_component($componentname);

$result = hierarchy_can_add_competency_evidence($plan, $component, $userid, $competencyid);

if ($result !== true) {
    die(get_string($result[0],$result[1]));
}

// Log it
add_to_log(SITEID, 'plan', 'competency proficiency updated', "update-competency-setting.php?c={$competencyid}&p={$prof}&pl={$planid}&u={$userid}", 'ajax');

// Update the competency evidence
$details = new object();

// Get user's current primary position and organisation (if any)
$posrec = get_record('pos_assignment', 'userid', $userid, 'type', POSITION_TYPE_PRIMARY, '','','id, positionid, organisationid');
if ($posrec) {
    $details->positionid = $posrec->positionid;
    $details->organisationid = $posrec->organisationid;
    unset($posrec);
}

$details->assessorname = addslashes(fullname($USER));
$details->assessorid = $USER->id;

$result = hierarchy_add_competency_evidence($competencyid, $userid, $prof, $component, $details);

if ($result) {
    echo "OK";
} else {
    echo "FAIL";
}

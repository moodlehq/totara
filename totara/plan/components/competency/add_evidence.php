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
 * @author Alastair Munro <alastair@catalyst.net.nz>
 * @package totara
 * @subpackage plan
 */

require_once('../../../../config.php');
require_once($CFG->dirroot.'/hierarchy/prefix/position/lib.php');
require_once($CFG->dirroot.'/hierarchy/prefix/competency/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');
require_once($CFG->dirroot.'/local/plan/lib.php');
require_once('add_evidence_form.php');
require_once($CFG->dirroot.'/hierarchy/prefix/competency/evidence/evidence.php');
require_once($CFG->dirroot.'/hierarchy/prefix/competency/evidence/lib.php');

///
/// Setup / loading data
///

$userid = required_param('userid', PARAM_INT);
$id = required_param('id', PARAM_INT);
$proficiency = optional_param('proficiency', null, PARAM_INT);
$competencyid = optional_param('competencyid', 0, PARAM_INT);
$positionid = optional_param('positionid', 0, PARAM_INT);
$organisationid = optional_param('organisationid', 0, PARAM_INT);
$returnurl = optional_param('returnurl', '', PARAM_LOCALURL);

$nojs = optional_param('nojs', 0, PARAM_INT);

require_login();
$plan = new development_plan($id);
$componentname = 'competency';
$component = $plan->get_component($componentname);

//Permissions check
$result = hierarchy_can_add_competency_evidence($plan, $component, $userid, $competencyid);
if ($result !== true) {
    error($result[0], $result[1]);
}

if($evidence_record = get_record('comp_evidence', 'userid', $userid, 'competencyid', $competencyid)) {
    $evidenceid = $evidence_record->id;
    $evidence_record->evidenceid = $evidence_record->id;
    $evidence_record->id = null;
} else {
    $evidenceid = null;
}

$fullname = $plan->name;

if($u = get_record('user','id',$userid)) {
    $toform = new object();
    $toform->user = fullname($u);
} else {
    error('error:usernotfound','local');
}

// Check permissions
$componentname = 'competency';
$component = $plan->get_component($componentname);
if($component->get_setting('setproficiency') != DP_PERMISSION_ALLOW) {
    error(get_string('error:competencystatuspermission', 'local_plan'));
}

if (!$returnurl) {
    $returnurl = $component->get_url();
}

$mform = new totara_competency_evidence_form(null, compact('id','evidenceid','competencyid','positionid',
    'organisationid','userid','user','s','nojs','returnurl'));
$mform->set_data($evidence_record);

if ($mform->is_cancelled()) {
    redirect($returnurl);
}
if($fromform = $mform->get_data()) { // Form submitted
    if (empty($fromform->submitbutton)) {
        print_error('error:unknownbuttonclicked', 'local', $returnurl);
    }

    // Setup data
    $details = new object();
    if ($fromform->positionid != 0) {
        $details->positionid = $fromform->positionid;
    }
    if ($fromform->organisationid != 0) {
        $details->organisationid = $fromform->organisationid;
    }
    if ($fromform->assessorid != 0) {
        $details->assessorid = $fromform->assessorid;
    }
    $details->assessorname = $fromform->assessorname;
    $details->assessmenttype = $fromform->assessmenttype;

    // Add evidence
    $result = hierarchy_add_competency_evidence($fromform->competencyid, $fromform->userid, $proficiency, $component, $details);

    if ($result) {
        redirect($returnurl);
    } else {
        redirect($returnurl, get_string('recordnotcreated','local'));
    }

} else {
    $mform->set_data($toform);
}

///
/// Display page
///

$prefix = 'competency';
$hierarchy = new $prefix();
$hierarchy->hierarchy_page_setup('item/add');

$fullname = get_string('addcompetencyevidence', 'local');
$pagetitle = format_string($fullname);
$navlinks = array();
dp_get_plan_base_navlinks($navlinks, $plan->userid);
$navlinks[] = array('name' => $fullname, 'link'=> $CFG->wwwroot . '/local/plan/view.php?id='.$plan->id, 'type'=>'title');
$navigation = build_navigation($navlinks);


print_header_simple($pagetitle, '', $navigation, '', null, true, null);

// Plan menu
echo dp_display_plans_menu($plan->userid,$plan->id,$plan->role);

// Plan page content
print_container_start(false, '', 'dp-plan-content');

print $plan->display_plan_message_box();

print_heading($fullname);
print $plan->display_tabs($prefix);

$mform->display();

print_container_end();
print_footer();


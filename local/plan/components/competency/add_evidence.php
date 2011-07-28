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

//Permissions check
$systemcontext = get_system_context();
if(!has_capability('local/plan:accessanyplan', $systemcontext) && ($plan->get_setting('view') < DP_PERMISSION_ALLOW)) {
        print_error('error:nopermissions', 'local_plan');
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

    $todb = new competency_evidence(
        array(
            'competencyid'  => $fromform->competencyid,
            'userid'        => $fromform->userid,
            'id'            => isset($fromform->evidenceid) ? $fromform->evidenceid : null
        )
    );

    $todb->positionid = $fromform->positionid != 0 ? $fromform->positionid : null;
    $todb->organisationid = $fromform->organisationid != 0 ? $fromform->organisationid : null;
    $todb->assessorid = $fromform->assessorid != 0 ? $fromform->assessorid : null;
    $todb->assessorname = $fromform->assessorname;
    $todb->assessmenttype = $fromform->assessmenttype;
    $todb->manual = 1;
    $todb->reaggregate = time();

    // proficiency not obtained by get_data() because form element is populated
    // via javascript after page load. Get via optional POST parameter instead.
    if (!$proficiency) {
        print_error('error:noproficiencysupplied', 'local', $returnurl);
    }

    $todb->update_proficiency($proficiency);
    // update stats block
    $currentuser = $fromform->userid;
    $event = STATS_EVENT_COMP_ACHIEVED;
    $data2 = $fromform->competencyid;
    $time = $todb->reaggregate;
    $count = count_records('block_totara_stats', 'userid', $currentuser, 'eventtype', $event, 'data2', $data2);
    $isproficient = get_field('comp_scale_values', 'proficient', 'id', $proficiency);

    // check the proficiency is set to "proficient" and check for duplicate data
    if ($isproficient && $count == 0) {
        totara_stats_add_event($time, $currentuser, $event, '', $data2);
        //Send Alert
        $alert_detail = new object();
        $alert_detail->itemname = get_field('comp', 'fullname', 'id', $data2);
        $alert_detail->text = get_string('competencycompleted', 'local_plan');
        $component->send_component_complete_alert($alert_detail);

        //Auto plan completion hook
        dp_plan_item_updated($currentuser, 'competency', $data2);
    }
    // check record exists for removal and is set to "not proficient"
    else if ($isproficient == 0 && $count > 0) {
        totara_stats_remove_event($currentuser, $event, $data2);
    }

    if ($todb->id) {
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


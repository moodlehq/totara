<?php

require_once('../../../../config.php');
require_once($CFG->dirroot.'/hierarchy/type/position/lib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');
require_once($CFG->dirroot.'/local/plan/lib.php');
require_once('add_evidence_form.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/evidence/evidence.php');
///
/// Setup / loading data
///

$userid = required_param('userid', PARAM_INT);
$id = required_param('id', PARAM_INT);
$proficiency = optional_param('proficiency', null, PARAM_INT);
$competencyid = optional_param('competencyid', 0, PARAM_INT);
$positionid = optional_param('positionid', 0, PARAM_INT);
$organisationid = optional_param('organisationid', 0, PARAM_INT);

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
    error(get_string('error:competencyobjectivepermission', 'local_plan'));
}

$returnurl = $component->get_url();

$mform = new totara_competency_evidence_form(null, compact('id','evidenceid','competencyid','positionid',
    'organisationid','userid','user','s','nojs'));
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
    $isproficient = get_record('comp_scale', 'proficient', $proficiency);

    // check the proficiency is set to "proficient" and check for duplicate data
    if ($isproficient && $count == 0) {
        totara_stats_add_event($time, $currentuser, $event, '', $data2);
    }
    // check record exists for removal and is set to "not proficient"
    else if (empty($isproficient) && $count > 0) {
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

$type = 'competency';
$hierarchy = new $type();
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
print $plan->display_tabs($type);

$mform->display();

print_container_end();
print_footer();


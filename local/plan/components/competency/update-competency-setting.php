<?php
header("Content-Type:text/plain");
require_once('../../../../config.php');
require_once($CFG->dirroot.'/hierarchy/type/position/lib.php');
// 1. Get information
$competencyid = required_param('c', PARAM_INT);
$prof = required_param('p', PARAM_INT);
// Include $planid and $userid to limit the possibility of errors
$planid = required_param('pl', PARAM_INT);
$userid = required_param('u', PARAM_INT);

//Permissions check
require_login();

// Check permission to access the plan
require_once($CFG->dirroot.'/local/plan/development_plan.class.php');
$plan = new development_plan($planid);
$systemcontext = get_system_context();
if (!has_capability('local/plan:accessanyplan', $systemcontext) && ($plan->get_setting('view') < DP_PERMISSION_ALLOW)) {
    die(get_string('error:nopermissions', 'local_plan'));
}

// Check permission to update the competency's proficiency
$componentname = 'competency';
$component = $plan->get_component($componentname);
if (false) $component = new dp_competency_component();
if ($component->get_setting('setproficiency') != DP_PERMISSION_ALLOW) {
    die(get_string('error:competencystatuspermission', 'local_plan'));
}

// Validate whether the plan belongs to the specified user
if (!$plan->userid == $userid) {
    die(get_string('error:usernotfound','local_plan'));
}

// Validate whether this competency is even in the plan
$compassign = get_record('dp_plan_competency_assign', 'planid', $planid, 'competencyid', $competencyid, '', '', 'id, approved');
if (!$compassign) {
    die(get_string('error:competencynotfound','local_plan'));
}

// Check whether the plan's competencies can still be updated
if (!$component->can_update_competency_evidence($compassign)) {
    die(get_string('error:cannotupdatecompetencies','local_plan'));
}

// Permissions OK!

// Log it!
//add_to_log(...)

// Update the competency
require_once($CFG->dirroot.'/hierarchy/type/competency/evidence/evidence.php');
$todb = new competency_evidence(
    array(
        'competencyid'  => $competencyid,
        'userid'        => $userid
    )
);

// Get user's current primary position and organisation (if any)
$posrec = get_record('pos_assignment', 'userid', $userid, 'type', POSITION_TYPE_PRIMARY, '','','id, positionid, organisationid');
if ($posrec) {
    $todb->positionid = $posrec->positionid;
    $todb->organisationid = $posrec->organisationid;
    unset($posrec);
} else {
    $todb->positionid = null;
    $todb->organisationid = null;
}

$todb->assessorid = $USER->id;
$todb->assessorname = addslashes(fullname($USER));
$todb->manual = 1;
$todb->reaggregate = time();

$todb->update_proficiency($prof);
echo "OK";

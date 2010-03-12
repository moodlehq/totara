<?php
/**
 * This page is called to remove a competency from an IDP
 * todo: make this work via ajax instead (in addition to?) a redirect
 */

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/plan/lib.php');

// Competency ID
$competencyid = required_param('id', PARAM_INT);
// Revision id
$revisionid = required_param('revision', PARAM_INT);

$plan = get_plan_for_revision($revisionid)->id;
if ( !$plan ){
    error('Plan ID is incorrect');
}

// Users can only edit their own IDP
if ( $plan->userid != $USER->id ){
    error(get_string('error:revisionnotvisible', 'idp'));
}

$dbresult = delete_records('idp_revision_competency', 'revision', $revisionid, 'competency', $competencyid);
if ( $dbresult ){
    redirect($CFG->wwwroot.'/plan/revision.php?id='.$plan->id);
} else {
    print_error('error:removalfailed','idp');
}
?>
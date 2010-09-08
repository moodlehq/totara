<?php
/**
 * This page is called to remove a course from an IDP
 * todo: make this work via ajax instead (in addition to?) a redirect
 */

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/idp/lib.php');

// Course ID
$courseid = required_param('id', PARAM_INT);
// Revision id
$revisionid = required_param('revision', PARAM_INT);

$plan = get_plan_for_revision($revisionid);
if ( !$plan ){
    error('Plan ID is incorrect');
}

// Users can only edit their own IDP
require_capability('moodle/local:idpeditownplan', get_context_instance(CONTEXT_SYSTEM));
if ( $plan->userid != $USER->id ){
    error(get_string('error:revisionnotvisible', 'idp'));
}


// Delete the course and update the modification time for the parent revision
begin_sql();
$dbresult = (boolean) delete_records('idp_revision_course', 'revision', $revisionid, 'course', $courseid);
$dbresult = $dbresult && update_modification_time($revisionid);
if ($dbresult ){
    commit_sql();
    redirect($CFG->wwwroot.'/idp/revision.php?id='.$plan->id.'&type=courses');
} else {
    rollback_sql();
    print_error('error:removalfailed','idp');
}

add_to_log(SITEID, 'idp', 'delete IDP course', "revision.php?id={$plan->id}", $courseid);

?>

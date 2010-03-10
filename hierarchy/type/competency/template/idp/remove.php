<?php
/**
 * This page is called to remove a competency template from an IDP
 */

require_once('../../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/plan/lib.php');

///
/// Setup / loading data
///

// Competency Template ID
$competencytemplateid = required_param('id', PARAM_INT);

// Revision id
$revisionid = required_param('revision', PARAM_INT);

$planid = get_plan_for_revision($revisionid)->id;

// Setup page
// todo: Review permissions for this page
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/hierarchy/competency/template/idp/remove.php');

$dbresult = delete_records('idp_revision_competencytemplate', 'revision', $revisionid, 'competencytemplate', $competencytemplateid);

if ( $dbresult ){
    redirect($CFG->wwwroot.'/plan/revision.php?id='.$planid);
} else {
    print_error('error:removalfailed','idp');
}
?>
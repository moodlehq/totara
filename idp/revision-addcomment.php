<?php
/**
 * idp/revision-addcomment.php
 *
 * This page handles requests to add a comment to an IDP, with or without AJAX
 *
 * @copyright Catalyst IT Limited
 * @author Aaron Wells
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package Totara
 */
require_once('../config.php');
require_once('lib.php');

$js_enabled = optional_param('js', true, PARAM_BOOL);    // js enabled

require_login();

$revisionid = required_param('rev', PARAM_INT); // Revision ID
$comment = required_param('comment', PARAM_CLEANHTML); // comment

if (!$plan = get_plan_for_revision($revisionid)){
    error('Revision ID is incorrect.');
}

$contextsite = get_context_instance(CONTEXT_SYSTEM);
$contextuser = get_context_instance(CONTEXT_USER, $plan->userid);

if ($USER->id == $plan->userid) {
    require_capability('moodle/local:idpaddowncomment', $contextsite);
} else {
    require_capability('moodle/local:idpaddcomment', $contextuser);
}

// Get the requested revision
$currevision = get_revision($plan->id, $revisionid);

if ($USER->id != $plan->userid and 'notsubmitted' == $currevision->status) {
    // Plans which are not yet submitted, are only visible to the plan's author
    error(get_string('error:revisionnotvisible', 'idp'));
}

if ( 'notsubmitted' == $currevision->status ){
    // Can't comment on a plan that's not yet submitted
    error(get_string('error:revisioncantbecommented', 'idp'));
}

add_to_log(SITEID, 'idp', 'comment on plan', "revision.php?id=$plan->id&rev=$revisionid", $plan->id);

add_comment($revisionid, $comment);

redirect($CFG->wwwroot.'/idp/revision.php?id='.$plan->id.'&rev='.$revisionid);
?>

<?php
/**
 * This page asks for a message before rejecting a submitted Learning Plan.
 **/

require_once('../config.php');
require_once('lib.php');

require_login();

$rev = required_param('rev', PARAM_INT); // Revision ID
$confirm = optional_param('confirm', false, PARAM_BOOL);
$comments = optional_param('comments', '', PARAM_NOTAGS); // Reason for rejection

if (!$revision = get_revision(0, $rev)) {
    error('Revision ID is incorrect');
}

if (!$plan = get_record('idp', 'id', $revision->idp)) {
    error('Plan ID is incorrect');
}

require_login();

$contextsite = get_context_instance(CONTEXT_SYSTEM);
$contextuser = get_context_instance(CONTEXT_USER, $plan->userid);

require_capability('moodle/local:idpviewplan', $contextuser);
require_capability('moodle/local:idpapproveplan', $contextuser);

add_to_log(SITEID, 'idp', 'reject plan', "revision.php?id=$plan->id", $plan->id);

$stridps = get_string('idps', 'idp');

$navlinks = array();
$navlinks[] = array('name' => $stridps, 'link' => $CFG->wwwroot."/idp/index.php", 'type' => 'home');
$navlinks[] = array('name' => format_string($plan->name), 'link' => "revision.php?id={$revision->idp}&amp;rev=$revision->id", 'type' => 'home');
$navlinks[] = array('name' => get_string('rejectplan', 'idp'), 'link' => 'idp', 'type' => 'home');

$navigation = build_navigation($navlinks);

$pagetitle = get_string('rejecting', 'idp').' '.format_string($plan->name);

if ($confirm) {
    if (empty($comments)) {
        error(get_string('error:norejectreason', 'idp'), $CFG->wwwroot.'/idp/reject.php?rev='.$rev);
    }
    elseif (reject_revision($revision->id, $comments)) {
        redirect($CFG->wwwroot."/idp/index.php?userid={$plan->userid}");
    }
    else {
        error(get_string('rejectionerror', 'idp'));
    }
}
else {

    // Preview page
    print_header_simple($pagetitle, '', $navigation, '', '', true);

    print '<h1>'.get_string('rejecttitle', 'idp', $plan->name)."</h1>\n";
    
    print '<p>'.get_string('rejectexplanation', 'idp')."</p>\n";

    // Submit button
    print '<form method="get" action="reject.php"><div>';
    print '<input type="hidden" name="rev" value="'.$rev.'" />';
    print '<input type="hidden" name="confirm" value="1" />';
    print '<textarea rows="2" cols="100" name="comments">';
    print '</textarea></div><div>';
    print '<input type="submit" value="'.get_string('confirmrejectbutton', 'idp').'" />';
    print '</div></form>';

    // Cancel button
    print '<form method="get" action="revision.php"><div>';
    print '<input type="hidden" name="rev" value="'.$rev.'" />';
    print '<input type="hidden" name="id" value="'.$plan->id.'" />';
    print '<input type="submit" value="'.get_string('cancel', 'idp').'" />';
    print '</div></form>';

    print_footer();
}

?>

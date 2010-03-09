<?php
/**
 * This page asks for confirmation before withdrawing a submitted Learning Plan.
 **/

require_once('../config.php');
require_once('lib.php');

require_login();

$rev = required_param('rev', PARAM_INT); // Revision ID
$confirm = optional_param('confirm', false, PARAM_BOOL);

if (!$revision = get_revision(0, $rev)) {
    error('Revision ID is incorrect');
}

if (!$plan = get_record('idp', 'id', $revision->idp)) {
    error('Plan ID is incorrect');
}

require_login();

$contextsite = get_context_instance(CONTEXT_SYSTEM);
$contextuser = get_context_instance(CONTEXT_USER, $plan->userid);

add_to_log(SITEID, 'idp', 'withdraw plan', "revision.php?id=$plan->id", $plan->id);

if ($USER->id == $plan->userid) {
    require_capability('moodle/local:submitownplan', $contextsite);
} else {
    error(get_string('onlycreatorwithdraw', 'idp'));
}

$stridps = get_string('idps', 'idp');

$navlinks = array();
$navlinks[] = array('name' => $stridps, 'link' => $CFG->wwwroot."/plan/index.php", 'type' => 'home');
$navlinks[] = array('name' => format_string($plan->name), 'link' => "revision.php?id={$revision->idp}&amp;rev=$revision->id", 'type' => 'home');
$navlinks[] = array('name' => get_string('withdrawplan', 'idp'), 'link' => '', 'type' => 'home');

$navigation = build_navigation($navlinks);

$pagetitle = get_string('withdrawing', 'idp').' '.format_string($plan->name);

if ($confirm) {
    if ($newid = withdraw_revision($revision->id)) {
        redirect($CFG->wwwroot.'/plan/revision.php?id='.$revision->idp.'&amp;rev='.$newid);
    }
    else {
        error(get_string('withdrawerror', 'idp'));
    }
}
else {

    // Preview page
    print_header_simple($pagetitle, '', $navigation, '', '', true);

    print '<h1>'.get_string('withdrawtitle', 'idp', $plan->name)."</h1>\n";
    
    print '<p>'.get_string('withdrawexplanation1', 'idp')."</p>\n";
    print '<p>'.get_string('withdrawexplanation2', 'idp')."</p>\n";

    // Cancel button
    print '<table cellpadding="5" summary="Two buttons side by side"><tr><td>';
    print '<form method="get" action="revision.php"><div>';
    print '<input type="hidden" name="rev" value="'.$rev.'" />';
    print '<input type="hidden" name="id" value="'.$plan->id.'" />';
    print '<input type="submit" value="'.get_string('backtoeditbutton', 'idp').'" />';
    print '</div></form>';

    // Submit button
    print '</td><td>';
    print '<form method="get" action="withdraw.php"><div>';
    print '<input type="hidden" name="rev" value="'.$rev.'" />';
    print '<input type="hidden" name="confirm" value="1" />';
    print '<input type="submit" value="'.get_string('confirmwithdrawbutton', 'idp').'" />';
    print '</div></form>';
    print "</td></tr></table>\n";

    print_footer();
}

?>

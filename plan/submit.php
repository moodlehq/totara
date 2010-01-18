<?php
/**
 * This page asks for confirmation before submitting an IDP.
 **/

require_once('../config.php');
require_once('lib.php');

require_login();

$rev = required_param('rev', PARAM_INT); // Revision ID
$confirm = optional_param('confirm', false, PARAM_BOOL);
$print = optional_param('print', 0, PARAM_INT); // Print-friendly view

if ($print) {
    $CFG->theme = 'MITMS_print'; // for this page only
}

if (!$revision = get_revision(0, $rev)) {
    error('Revision ID is incorrect');
}

if (!$plan = get_record('idp', 'id', $revision->idp)) {
    error('Plan ID is incorrect');
}

$contextsite = get_context_instance(CONTEXT_SYSTEM);
$contextuser = get_context_instance(CONTEXT_USER, $plan->userid);

add_to_log(SITEID, 'idp', 'submit plan', "revision.php?id=$plan->id", $plan->id);

if ($USER->id == $plan->userid) {
    require_capability('moodle/local:viewownplan', $contextsite);
    require_capability('moodle/local:submitownplan', $contextsite);
} else {
    error(get_string('onlycreatorsubmit', 'idp'));
}

$stridps = get_string('idps', 'idp');

$navlinks = array();
$navlinks[] = array('name' => $stridps, 'link' => $CFG->wwwroot."/plan/index.php", 'type' => 'home');
$navlinks[] = array('name' => format_string($plan->name), 'link' => "revision.php?id={$revision->idp}&amp;rev=$revision->id", 'type' => 'home');
$navlinks[] = array('name' => get_string('submitting', 'idp'), 'link' => '', 'type' => 'home');

$navigation = build_navigation($navlinks);

$pagetitle = get_string('submitting', 'idp').' '.format_string($plan->name);

if ($confirm) {
    if (submit_revision($revision->id)) {
        redirect($CFG->wwwroot.'/plan/index.php');
    }
    else {
        error(get_string('submissionerror', 'idp'));
    }
}
else {
    // Hack to add print stylesheet
    $meta = '<link rel="stylesheet" type="text/css" media="print" href="'.$CFG->themewww.'/MITMS_print/user_styles.css" />'."\n";

    // Preview page
    print_header_simple($pagetitle, '', $navigation, '', $meta, true);

    print '<h1>'.get_string('previewtitle', 'idp', $plan->name)."</h1>\n";

    print '<p class="explanation">'.get_string('submitexplanation1', 'idp').'</p>';

    // Border around the preview area
    print '<div id="previewcontainer">';

    print_revision_preview($revision, $plan, false);

    print '</div>';

    print '<p class="explanation">'.get_string('submitexplanation2', 'idp').'</p>';

    // Cancel button
    print '<table cellpadding="5" summary="Two buttons side by side"><tr><td>';
    print '<form method="get" action="revision.php"><div>';
    print '<input type="hidden" name="rev" value="'.$rev.'" />';
    print '<input type="hidden" name="id" value="'.$plan->id.'" />';
    print '<input type="submit" value="'.get_string('backtoeditbutton', 'idp').'" />';
    print '</div></form>';

    // Submit button
    print '</td><td>';
    print '<form method="get" action="submit.php"><div>';
    print '<input type="hidden" name="rev" value="'.$rev.'" />';
    print '<input type="hidden" name="confirm" value="1" />';
    print '<input type="submit" value="'.get_string('confirmsubmitbutton', 'idp').'" />';
    print '</div></form>';
    print "</td></tr></table>\n";

    print_footer();
}

?>

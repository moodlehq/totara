<?php
/**
 * This page asks for confirmation before approve a Learning Plan.
 **/

require_once('../config.php');
require_once('lib.php');

require_login();

$rev = required_param('rev', PARAM_INT); // Revision ID
$confirm = optional_param('confirm', false, PARAM_BOOL); // 1 when the user has confirmed
$onbehalfof = optional_param('onbehalfof', false, PARAM_INT); // User ID
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

require_capability('moodle/local:idpviewplan', $contextuser);
require_capability('moodle/local:idpapproveplan', $contextuser);

add_to_log(SITEID, 'idp', 'approve plan', "approve.php?rev=$rev&amp;confirm=$confirm", $plan->id);

$stridps = get_string('idps', 'idp');

$navlinks = array();
$navlinks[] = array('name' => $stridps, 'link' => $CFG->wwwroot."/idp/index.php", 'type' => 'home');
$navlinks[] = array('name' => format_string($plan->name), 'link' => "revision.php?id={$revision->idp}&amp;rev=$revision->id", 'type' => 'home');
$navlinks[] = array('name' => get_string('approving', 'idp'), 'link' => '', 'type' => 'home');

$navigation = build_navigation($navlinks);

$pagetitle = get_string('approving', 'idp').' '.format_string($plan->name);

if ($confirm) {
    if (approve_revision($revision, $onbehalfof)) {
        redirect($CFG->wwwroot.'/idp/index.php?userid='.$plan->userid);
    }
    else {
        error(get_string('approvalerror', 'idp'));
    }
}
else {
    // Hack to add print stylesheet
    $meta = '<link rel="stylesheet" type="text/css" media="print" href="'.$CFG->themewww.'/MITMS_print/user_styles.css" />'."\n";

    // Preview page
    print_header_simple($pagetitle, '', $navigation, '', $meta, true);

    print '<h1>'.get_string('approvingtitle', 'idp', $plan->name)."</h1>\n";

    print '<p class="explanation">'.get_string('approvingexplanation1', 'idp').'</p>';

    // Border around the preview area
    print '<div id="previewcontainer">';

    $revision->owner = get_user_light($plan->userid);

    print_revision_preview($revision, $plan, true);

    print '</div>';

    print '<p>'.get_string('approvingexplanation2', 'idp').'</p>';

    // Get people we can approve on behalf of
    $otherapprovers = array();
    if (has_capability('moodle/local:idpapproveplanonbehalf', $contextuser)) {
        $otherapprovers = get_approvers($contextuser);
    }

    // Submit form
    print '<table cellpadding="5" summary="Two buttons side by side"><tr><td valign="bottom">';
    // Cancel button
    print '<form method="get" action="revision.php"><div>';
    print '<input type="hidden" name="rev" value="'.$rev.'" />';
    print '<input type="hidden" name="id" value="'.$plan->id.'" />';
    print '<input type="submit" value="'.get_string('cancel', 'idp').'" />';
    print '</div></form>';
    print '</td><td valign="bottom">';

    print '<form method="get" action="approve.php"><div>';

    // "On behalf of" radio buttons
    if (count($otherapprovers) > 0) {
        print get_string('onbehalfofexplanation', 'idp')."<br /><br />\n";

        $checked = ' checked="checked"';
        foreach ($otherapprovers as $userid) {
            print_spacer(1, 30, false);
            print '<input'.$checked.' type="radio" name="onbehalfof" value="'.$userid.'" /> '.format_user_link($userid)."<br />\n";
            $checked = ''; // Only the first item is checked by default
        }
        print "<br />\n";
    }

    // Submit button
    print '<input type="hidden" name="rev" value="'.$rev.'" />';
    print '<input type="hidden" name="confirm" value="1" />';
    print '<input type="submit" value="'.get_string('approveplan', 'idp').'" />';
    print '</div></form>';
    print "</td></tr></table>\n";

    print_footer();
}

?>

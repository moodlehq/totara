<?php
/**
 * This page prints out a given plan revision
 **/

require_once('../config.php');
require_once('lib.php');

require_js(array('yui_yahoo', 'yui_event', 'yui_connection', 'yui_json'));
require_login();

$id = required_param('id', PARAM_INT); // Plan ID
$rev = optional_param('rev', 0, PARAM_INT); // Revision ID
$lp = optional_param('lp', 0, PARAM_INT); // Activity ID
$print = optional_param('print', 0, PARAM_INT); // Print-friendly view

if ($print) {
    $CFG->theme = 'MITMS_print'; // for this page only
}

if (0 == $id) {
    error(get_string('error:idcannotbezero', 'local'));
}

if (!$plan = get_record('idp', 'id', $id)) {
    error('Plan ID is incorrect');
}

$contextsite = get_context_instance(CONTEXT_SYSTEM);
$contextuser = get_context_instance(CONTEXT_USER, $plan->userid);

if ($USER->id == $plan->userid) {
    require_capability('moodle/local:viewownplan', $contextsite);
} else {
    require_capability('moodle/local:viewplan', $contextuser);
}

// Get the requested revision (default: the last one)
$currevision = get_revision($plan->id, $rev);

if ($USER->id != $plan->userid and 'notsubmitted' == $currevision->status) {
    // Plans which are not yet submitted, are only visible to the plan's author
    error(get_string('error:revisionnotvisible', 'idp'));
}

$currevision->owner = get_record('user', 'id', $plan->userid, '', '', '', '', 'id,firstname,lastname,idnumber');
add_to_log(SITEID, 'idp', 'view plan', "revision.php?id=$plan->id", $plan->id);


$stridps = get_string('idps', 'idp');

$pagetitle = format_string($plan->name);

$navlinks = array();
$navlinks[] = array('name' => $stridps, 'link' => "index.php", 'type' => 'home');
$navlinks[] = array('name' => $pagetitle, 'link' => '', 'type' => 'home');

$navigation = build_navigation($navlinks);

$CFG->stylesheets[] = array(
        'media' =>  'print',
        'href'  =>  $CFG->themewww . '/MITMS_print/user_styles.css',
    );
print_header_simple($pagetitle, '', $navigation, '', '', true);

if ($currevision) {
    // Whether or not to see the editable view
    $editable = false;
    $cansubmit = false;
    if (is_my_plan($currevision->id) and has_capability('moodle/local:editownplan', $contextsite)) {
        $cansubmit = true;
        if ('notsubmitted' == $currevision->status or 'inrevision' == $currevision->status) {
            $editable = true;
        }
    }
    $editable = $editable && !$print;

    // Whether or not the current user can approve this plan
    $canapprove = false;
    if (!$cansubmit && has_capability('moodle/local:approveplan', $contextuser)) {
        $canapprove = true;
    }

    if ($editable) {
        print '<h1>'.get_string('revisionedittitle', 'idp', $plan->name).'</h1>';
    } else {
        print '<h1>'.get_string('revisionviewtitle', 'idp', $plan->name).'</h1>';
    }

    if ($canapprove) {
        print_revision_manager($currevision, $plan, array(
            'cansubmit'  => $cansubmit,
            'canapprove' => $canapprove,
        ));
    } else {
        print_revision_trainee($currevision, $plan, array(
            'editable'  => $editable,
            'cansubmit' => $cansubmit,
        ));
    }

    if ($cansubmit) {

        if ($editable) {
            // Save and continue later
            print '<table cellpadding="10" summary="Two buttons side by side"><tr><td>';
            print '<form method="get" action="index.php"><div>';
            print '<input type="submit" value="'.get_string('savecontinuelaterbutton', 'idp').'" />';
            print '</div></form>';

            // Submit button
            print '</td><td>';
            print '<form method="get" action="submit.php"><div style="text-align: center">';
            print '<input type="hidden" name="rev" value="'.$currevision->id.'" />';
            print '<input type="submit" value="'.get_string('submitplan', 'idp').'" />';
            print '</div></form>';
            print "</td></tr></table>\n";
        }
        elseif ('approved' == $currevision->status or 'overdue' == $currevision->status) {
            // Evaluate button
            print '<form method="get" action="evaluation.php"><p style="text-align: center">';
            print '<input type="hidden" name="id" value="'.$plan->id.'" />';
            print '<input type="hidden" name="rev" value="'.$currevision->id.'" />';
            print '<input type="submit" value="'.get_string('evaluateplan', 'idp').'" />';
            print "</p></form>\n";
        }
    }

    print '<p id="backtotop" style="text-align: center"><a href="#top">'.get_string('backtotoplink', 'idp').'</a></p>';

} else {
    print '<p><i>'.get_string('norevisions', 'idp')."</i></p>\n";
}

print collapse_groups_script();
print '<script type="text/javascript" src="revision.js"></script>'."\n";
print '<script type="text/javascript" src="search.js"></script>'."\n";
print_footer();

?>

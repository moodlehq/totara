<?php
/**
 * This page prints out a given plan revision
 **/

require_once('../config.php');
require_once('lib.php');

$js_enabled = optional_param('js', true, PARAM_BOOL);    // js enabled

require_login();

$id = required_param('id', PARAM_INT); // Plan ID
$rev = optional_param('rev', 0, PARAM_INT); // Revision ID
$lp = optional_param('lp', 0, PARAM_INT); // Activity ID
$print = optional_param('print', 0, PARAM_INT); // Print-friendly view

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

// If js enabled, setup custom javascript
if ($js_enabled) {

    require_once($CFG->dirroot.'/local/js/setup.php');
    setup_lightbox(array(MBE_JS_TREEVIEW, MBE_JS_ADVANCED));
    require_js(array(
        $CFG->wwwroot.'/local/js/idp.competency.js',
        $CFG->wwwroot.'/local/js/idp.competencytemplate.js',
        $CFG->wwwroot.'/local/js/idp.course.js',
    ));

}

$stridps = get_string('idps', 'idp');

$pagetitle = format_string($plan->name);

$navlinks = array();
$navlinks[] = array('name' => $stridps, 'link' => "index.php", 'type' => 'home');
$navlinks[] = array('name' => $pagetitle, 'link' => '', 'type' => 'home');

$navigation = build_navigation($navlinks);

// Hack to add print stylesheet
$meta = '<link rel="stylesheet" type="text/css" media="print" href="'.$CFG->themewww.'/MITMS_print/user_styles.css" />'."\n";

print_header_simple($pagetitle, '', $navigation, '', $meta, true);

if ($currevision) {
    // Whether or not to see the can_edit view
    $can_edit = false;
    $can_submit = false;
    if (is_my_plan($currevision->id) and has_capability('moodle/local:editownplan', $contextsite)) {
        $can_submit = true;
        if ('notsubmitted' == $currevision->status or 'inrevision' == $currevision->status) {
            $can_edit = true;
        }
    }
    $can_edit = $can_edit && !$print;

    // Whether or not the current user can approve this plan
    $can_approve = false;
    if (!$can_submit && has_capability('moodle/local:approveplan', $contextuser)) {
        $can_approve = true;
    }

    if ($can_edit) {
        print '<h1>'.get_string('revisionedittitle', 'idp', $plan->name).'</h1>';
    } else {
        print '<h1>'.get_string('revisionviewtitle', 'idp', $plan->name).'</h1>';
    }

    if ($can_approve) {
        print_revision_manager($currevision, $plan, array(
            'can_submit' => $can_submit,
            'can_edit'   => $can_edit,
            'can_approve' => $can_approve,
        ));
    } else {
        print_revision_trainee($currevision, $plan, array(
            'can_edit'  => $can_edit,
            'can_submit' => $can_submit,
        ));
    }

    if ($can_submit) {

        if ($can_edit) {

            print '<table cellpadding="10" summary="Three buttons side by side"><tr><td>';

            // Save and continue later
            print '</td><td>';
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
?>

<script type="text/javascript">
<!-- //
var idp_revision_id = <?php echo $id ?>
// -->
</script>
<?php
print collapse_groups_script();
print '<script type="text/javascript" src="revision.js"></script>'."\n";
print '<script type="text/javascript" src="search.js"></script>'."\n";
print_footer();

?>

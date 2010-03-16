<?php
/**
 * This page is for trainee's self-evaluation of Learning Plans
 **/

require_once('../config.php');
require_once('lib.php');

require_js(array('yui_yahoo', 'yui_event', 'yui_connection', 'yui_json'));
require_login();

$id = required_param('id', PARAM_INT); // Plan ID
$rev = optional_param('rev', 0, PARAM_INT); // Revision ID
$submit = optional_param('submit', false, PARAM_BOOL); // Set to true when the form is submitted
$extracomment = optional_param('extracomment', '', PARAM_TEXT);

if (0 == $id) {
    error(get_string('error:idcannotbezero', 'local'));
}

if (!$plan = get_record('idp', 'id', $id)) {
    error('Plan ID is incorrect');
}

require_login();

$contextsite = get_context_instance(CONTEXT_SYSTEM);
$contextuser = get_context_instance(CONTEXT_USER, $plan->userid);

$errorurl = $CFG->wwwroot . "/idp/revision.php?id=$plan->id";
if ($USER->id == $plan->userid) {
    require_capability('moodle/local:editownplan', $contextsite);
} else {
    error(get_string('error:cannotevaluateplan', 'idp'), $errorurl);
}

// Get the requested revision (default: the last one)
$currevision = get_revision($plan->id, $rev);
$currevision->owner = get_record('user', 'id', $plan->userid, '', '', '', '', 'id,firstname,lastname,idnumber');

if ('completed' == $currevision->status) {
    error(get_string('error:planalreadyevaluated', 'idp'), $errorurl);
}

if ($submit) {
    add_to_log(SITEID, 'idp', 'submit evaluation', "revision.php?id=$plan->id&amp;rev=$currevision->id", $plan->id);

    $grades = data_submitted();

    $returnurl = $CFG->wwwroot.'/moodle/local/revision.php?id='.$plan->id.'&amp;rev='.$currevision->id;
    if (idp_submit_evaluation($currevision, $grades, $extracomment)) {
        redirect($returnurl);
    }
    else {
        error(get_string('error:evaluationsubmissionerror', 'idp'), $returnurl);
    }
}
add_to_log(SITEID, 'idp', 'evaluate plan', "revision.php?id=$plan->id", $plan->id);

$stridps = get_string('idps', 'idp');

$pagetitle = format_string($plan->name);

$navlinks = array();
$navlinks[] = array('name' => $stridps, 'link' => $CFG->wwwroot."/idp/index.php", 'type' => 'home');
$navlinks[] = array('name' => $pagetitle, 'link' => '', 'type' => 'home');

$navigation = build_navigation($navlinks);

print_header_simple($pagetitle, '', $navigation, '', '', true);

if ($currevision) {
    print '<h1>'.get_string('evaluationtitle', 'idp', $plan->name).'</h1>';

    print '<h2>'.get_string('personaldetailsheading', 'idp').'</h2>';
    print_revision_details($currevision, true, false, false, false);

    print '<form method="post" action="evaluation.php"><div>';
    print '<input type="hidden" name="id" value="'.$plan->id.'" />';
    print '<input type="hidden" name="rev" value="'.$currevision->id.'" />';
    print '<input type="hidden" name="submit" value="1" /></div>';

    $usercurriculum = get_field('user', 'curriculum', 'id', $plan->userid);
    if (empty($usercurriculum)) {
        print '<p style="border-style: dashed; border-color: #FF0000"><i><b>'.get_string('error:nousercurriculum', 'idp').'</b></i></p>';
    }
    else {
        print_curriculum_evaluation($usercurriculum, $currevision->id);
    }
    print_curriculum_evaluation('Q', $currevision->id);

    print '<h2>'.get_string('extracommentsheading', 'idp').'</h2>';
    print '<blockquote><p><textarea name="extracomment" rows="4" cols="80"></textarea></p></blockquote>';

    // Submit button
    print '<p><input type="submit" value="'.get_string('submitevaluation', 'idp').'" /></p>';
    print '</form>';

    // Cancel button
    print '<form method="get" action="revision.php"><p>';
    print '<input type="hidden" name="id" value="'.$plan->id.'" />';
    print '<input type="submit" value="'.get_string('cancel').'" />';
    print '</p></form>';

} else {
    print '<p><i>'.get_string('norevisions', 'idp')."</i></p>\n";
}

print collapse_groups_script();
print '<script type="text/javascript" src="evaluation.js"></script>'."\n";

print_footer();

// Print the table and the simple curriculum browser
function print_curriculum_evaluation($curriculumcode, $revisionid) {

    print '<h2>'.get_string("curriculum_{$curriculumcode}_title", 'idp').'</h2>';
    print '<blockquote>';

    print '<div id="objectivelist'.$curriculumcode.'">';
    print curriculum_evaluations($curriculumcode, $revisionid);
    print '</div>';

    $divid = "additionalobj$curriculumcode";
    print '<h2>'.get_string('additionalobjectives').'</h2>';
//    print collapsing_tree_node("caption_$divid", $divid, get_string('additionalobjectives', 'idp'),
//                               0, '', false, 'curriculum');
    print '<div id="'.$divid.'" style="display: none">';
    print can_edit_curriculum_browser($curriculumcode, $revisionid, false, 50);
    print '</div>';

    print '</blockquote>';
}

?>

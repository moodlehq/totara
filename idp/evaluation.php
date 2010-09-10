<?php
/**
 * This page is for trainee's self-evaluation of Learning Plans
 **/

require_once('../config.php');
require_once('lib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');

require_js(array('yui_yahoo', 'yui_event', 'yui_connection', 'yui_json'));
require_login();

$id = required_param('id', PARAM_INT); // Plan ID
$rev = optional_param('rev', 0, PARAM_INT); // Revision ID
$submit = optional_param('submit', false, PARAM_BOOL); // Set to true when the form is submitted
$extracomment = optional_param('extracomment', '', PARAM_TEXT);

if (0 == $id) {
    error(get_string('error:idcannotbezero', 'idp'));
}

if (!$plan = get_record('idp', 'id', $id)) {
    error('Plan ID is incorrect');
}

require_login();

$contextsite = get_context_instance(CONTEXT_SYSTEM);
$contextuser = get_context_instance(CONTEXT_USER, $plan->userid);

$errorurl = $CFG->wwwroot . "/idp/revision.php?id=$plan->id";


if(!has_capability('moodle/local:idpuserevaluate', $contextuser)){
    // User must have permission to edit own plans in order to submit an evaluation
    require_capability('moodle/local:idpeditownplan', $contextsite);

    // Only the owner of a plan can evaluate it
    if ($USER->id != $plan->userid) {
        error(get_string('error:cannotevaluateplan', 'idp'), $errorurl);
    }
}

// Get the requested revision (default: the last one)
$currevision = get_revision($plan->id, $rev);
$currevision->owner = get_record('user', 'id', $plan->userid, '', '', '', '', 'id,firstname,lastname,idnumber');

if ('completed' == $currevision->status) {
    error(get_string('error:planalreadyevaluated', 'idp'), $errorurl);
}
if ($currevision->status != 'approved' && $currevision->status != 'overdue'){
    error(get_string('error:plannotapproved', 'idp'), $errorurl);
}

if ($submit) {
    add_to_log(SITEID, 'idp', 'submit evaluation', "revision.php?id=$plan->id&amp;rev=$currevision->id", $plan->id);

    $compevals = optional_param('compeval',array(),PARAM_INT);

    $successurl = "{$CFG->wwwroot}/idp/revision.php?id={$plan->id}";
    $backurl = "{$CFG->wwwroot}/idp/evaluation.php?id={$id}";
    if (idp_submit_evaluation($currevision, $compevals, $extracomment)) {
        redirect($successurl);
    }
    else {
        error(get_string('error:evaluationsubmissionerror', 'idp'), $backurl);
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

    print_idp_evaluation($currevision->id);

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

/**
 * Print the evaluation table for this IDP revision
 * @global object $CFG
 * @param int $revisionid
 */
function print_idp_evaluation($revisionid) {
    global $CFG;

    $fullcompetencylist = get_all_revision_competencies($revisionid);
    if ( !$fullcompetencylist ){
        return false;
    }
    $frameworklist = get_all_competency_frameworks($fullcompetencylist);
    foreach( $frameworklist as $framework ){
        print '<h2>Framework: '.s($framework->fullname).'</h2>';
        print '<blockquote>';

        print '<div id="objectivelist'.$framework->id.'">';
        //unction framework_evaluations($revisionid, $framework, $scale, $competencylist) {
        print framework_evaluations($revisionid, $framework);
        print '</div>';

// TODO: Let people add stuff to the plan while submitting their evaluation?
//        $divid = "additionalobj$frameworkid";
//    //    print '<h2>'.get_string('additionalobjectives').'</h2>';
//        print collapsing_tree_node("caption_$divid", $divid, get_string('additionalobjectives', 'idp'),
//                                   0, '', false, 'curriculum');

//        print '<div id="'.$divid.'" style="display: none">';
//        print can_edit_curriculum_browser($curriculumcode, $revisionid, false, 50);
//        print '</div>';

        print '</blockquote>';
    }

}

?>

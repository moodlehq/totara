<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/hierarchy/type/position/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');
require_once($CFG->dirroot.'/idp/lib.php');

// Page title
$pagetitle = 'assigncompetencies';

///
/// Setup / loading data
///

// Revision id
$revisionid = required_param('id', PARAM_INT);

// Parent id
$parentid = optional_param('parentid', 0, PARAM_INT);

// Position id (a bit hackey, we are using the framework picker unmodified)
$positionid = optional_param('frameworkid', 0, PARAM_INT);

// Framework id
$frameworkid = optional_param('realframeworkid', 0, PARAM_INT);

// Only return generated tree html
$treeonly = optional_param('treeonly', false, PARAM_BOOL);

// No javascript parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_TEXT);
$s = optional_param('s', '', PARAM_TEXT);

// string of params needed in non-js url strings
$urlparams = 'id='.$revisionid.'&amp;frameworkid='.$positionid.'&amp;nojs='.$nojs.'&amp;returnurl='.urlencode($returnurl).'&amp;s='.$s;

// Load plan this revision relates to
if (!$plan = get_plan_for_revision($revisionid)) {
    error('Revision plan could not be found');
}

// Load user this plan relates to
$owner = get_record('user', 'id', $plan->userid);

///
/// Permissions checks
///
require_login();
$usercontext = get_context_instance(CONTEXT_USER, $owner->id);
$systemcontext = get_context_instance(CONTEXT_SYSTEM);
if(!has_capability('moodle/local:idpaddcompetencyfrompos', $usercontext) && !(has_capability('moodle/local:idpaddcompetencyfrompos', $systemcontext && $owner->id == $USER->id))){
    error(get_string('error:permissionsaddcomptoidpfrompos', 'idp'));
}

// Setup hierarchy objects
$hierarchy = new competency();
$position = new position();

// Load plan this revision relates to
$plan = get_plan_for_revision($revisionid);
if (!$plan) {
    error('Revision plan could not be found');
}

// Load user this plan relates to
$owner = get_record('user', 'id', $plan->userid);

// Load that user's positions
if (!$positions = $position->get_user_positions($owner)) {
    error('User has no positions assigned');
}

// Get current position
if ($positionid) {
    foreach ($positions as $pos) {
        if ($pos->id == $positionid) {
            $cur_position = $pos;
            break;
        }
    }
}

if (!isset($cur_position)) {
    // Get primary
    $cur_position = reset($positions);
}

// Load competencies to display
$competencies = $position->get_assigned_competencies($cur_position, $frameworkid);
$assignedsql = "SELECT c.id, c.fullname
                FROM {$CFG->prefix}idp_revision_competency rc
                INNER JOIN {$CFG->prefix}comp c ON rc.competency = c.id
                WHERE rc.revision = {$revisionid} AND c.frameworkid = {$frameworkid}";
$assignedcomps = get_records_sql($assignedsql);
if( !is_array($assignedcomps) ){
    $assignedcomps = array();
};

///
/// Display page
///


if(!$nojs) {
    if ($treeonly) {
        echo build_treeview(
            $competencies,
            get_string('nocompetenciesassignedtoposition', 'position'),
            $hierarchy,
            $assignedcomps
        );
        exit;
    }

    // If parent id is not supplied, we must be displaying the main page
    if (!$parentid) {
        echo '<div class="selectcompetencies">'.PHP_EOL;
        echo '<h2>'.get_string($pagetitle, $hierarchy->prefix).'</h2>';
        echo '<div class="selected"><p>';
        echo get_string('selectedcompetencies', $hierarchy->prefix);
        echo populate_selected_items_pane($assignedcomps);
        echo '</p></div>';
        echo '<p>'.get_string('locatecompetency', $hierarchy->prefix).':</p>';
        echo $position->user_positions_picker($owner, $cur_position->id);
        if (empty($frameworkid)) {
            $hierarchy->display_framework_selector('', true);
        }
        echo '<ul class="treeview filetree">';
    }

    echo build_treeview(
        $competencies,
        get_string('nocompetenciesassignedtoposition', 'position'),
        null,
        $assignedcomps
    );

} else {
    // none JS version of page
    admin_externalpage_print_header();
    echo '<h2>'.get_string('addcompetenciestoplan', 'idp').'</h2>';
    echo '<p><a href="'.$returnurl.'">'.get_string('cancelwithoutassigning','hierarchy').'</a></p>';


    if(empty($positionid) || $positionid == 0) {
        echo build_nojs_positionpicker(
            $CFG->wwwroot.'/hierarchy/type/competency/idp/find-position.php',
            array(
                'returnurl' => $returnurl,
                's' => $s,
                'nojs' => 1,
                'id' => $revisionid,
            )
        );
    } else {
        echo  '<p>'.get_string('clicktoassign', $hierarchy->prefix).'</p>';
        echo '</div><div class="nojsselect">';
        echo build_nojs_treeview(
            $competencies,
            get_string('nocompetenciesassignedtoposition', 'position'),
            $CFG->wwwroot.'/hierarchy/type/competency/idp/save.php',
            array(
                'rowcount' => 0,
                's' => $s,
                'returnurl' => $returnurl,
                'nojs' => 1,
                'frameworkid' => $positionid,
                'id' => $revisionid,
            ),
            $CFG->wwwroot.'/hierarchy/type/competency/idp/find-position.php?'.$urlparams,
            array(),
            $assignedcomps
        );
        echo '</div>';
    }
    print_footer();

}

<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/hierarchy/type/position/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');
require_once($CFG->dirroot.'/idp/lib.php');


///
/// Setup / loading data
///

// Revision id
$revisionid = required_param('id', PARAM_INT);

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

// Setup hierarchy objects
$competency = new competency();
$position = new position();

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
if(!has_capability('moodle/local:idpaddcompetencytemplatefrompos', $usercontext) && !(has_capability('moodle/local:idpaddcompetencytemplatefrompos', $systemcontext && $owner->id == $USER->id))){
    error(get_string('error:permissionsaddcomptemplatefrompos','idp'));
}

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

// Load competency templates to display
$templates = $position->get_assigned_competency_templates($cur_position, $frameworkid);
if (!$currentlyassigned = idp_get_user_competencytemplates($plan->userid, $revisionid, $frameworkid)) {
    $currentlyassigned = array();
}

///
/// Display page
///

if(!$nojs) {

    if ($treeonly) {
        echo build_treeview(
            $templates,
            get_string('nounassignedcompetencytemplates', 'position'),
            null,
            $currentlyassigned
        );
        exit;
    }
?>

<div class="selectcompetencytemplates">


<h2><?php echo get_string('addcompetencytemplatestoplan', 'idp') ?></h2>

<div class="selected">
    <p>
        <?php 
            echo get_string('selecteditems', 'hierarchy'); 
            echo populate_selected_items_pane($currentlyassigned);
        ?>
    </p>
</div>

<p>
    <?php echo get_string('locatecompetencytemplate', 'competency') ?>:
    <br>
    <?php echo $position->user_positions_picker($owner, $cur_position->id); ?>
</p>

<ul class="treeview filetree">

<?php

echo build_treeview(
    $templates,
    get_string('nounassignedcompetencytemplates', 'position'),
    null,
    $currentlyassigned
);

?>
</ul></div>

<?php
} else {
    // none JS version of page
    admin_externalpage_print_header();
    echo '<h2>'.get_string('addcompetencytemplatestoplan', 'idp').'</h2>';
    echo '<p><a href="'.$returnurl.'">'.get_string('cancelwithoutassigning','hierarchy').'</a></p>';


    if(empty($positionid) || $positionid == 0) {
        echo build_nojs_positionpicker(
            $CFG->wwwroot.'/hierarchy/type/competency/idp/find-position-template.php',
            array(
                'returnurl' => $returnurl,
                's' => $s,
                'nojs' => 1,
                'id' => $revisionid,
            )
        );
    } else {
        echo  '<p>'.get_string('clicktoassign', $competency->prefix).'</p>';
        echo '</div><div class="nojsselect">';
        echo build_nojs_treeview(
            $templates,
            get_string('nounassignedcompetencytemplates', 'position'),
            $CFG->wwwroot.'/hierarchy/type/competency/idp/save-template.php',
            array(
                'rowcount' => 0,
                's' => $s,
                'returnurl' => $returnurl,
                'nojs' => 1,
                'frameworkid' => $positionid,
                'id' => $revisionid,
            ),
            $CFG->wwwroot.'/hierarchy/type/competency/idp/find-position-template.php?'.$urlparams,
            array(),
            $currentlyassigned
        );
        echo '</div>';
    }
    print_footer();

}


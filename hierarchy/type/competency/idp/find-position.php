<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/hierarchy/type/position/lib.php');
require_once($CFG->dirroot.'/local/js/setup.php');
require_once($CFG->dirroot.'/plan/lib.php');


///
/// Setup / loading data
///

// Revision id
$revisionid = required_param('id', PARAM_INT);

// Parent id
$parentid = optional_param('parentid', 0, PARAM_INT);

// Position id (a bit hackey, we are using the framework picker unmodified)
$positionid = optional_param('frameworkid', 0, PARAM_INT);


///
/// Permissions checks
///

admin_externalpage_setup('competencymanage');

// Check permissions
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

// Setup hierarchy objects
$competency = new competency();
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
$competencies = $position->get_assigned_competencies($cur_position);

///
/// Display page
///

?>

<div class="selectcompetencies">

<?php echo $position->user_positions_picker($owner, $cur_position->id); ?>

<h2><?php echo get_string('addcompetenciestoplan', 'idp') ?></h2>

<div class="selected">
    <p>
        <?php echo get_string('dragheretoassign', 'competency') ?>
    </p>
</div>

<p>
    <?php echo get_string('locatecompetency', 'competency') ?>:
</p>

<ul class="treeview filetree">

<?php

echo build_treeview(
    $competencies,
    get_string('nocompetenciesassignedtoposition', 'position')
);

?>
</ul></div>

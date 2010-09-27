<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/hierarchy/type/position/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');

// Page title
$pagetitle = 'assigncompetencies';

///
/// Params
///

// Assign to id
$assignto = required_param('assignto', PARAM_INT);

// Parent id
$parentid = optional_param('parentid', 0, PARAM_INT);

// Framework id
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);

// Only return generated tree html
$treeonly = optional_param('treeonly', false, PARAM_BOOL);

// No javascript parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_TEXT);
$s = optional_param('s', '', PARAM_TEXT);

// string of params needed in non-js url strings
$urlparams = 'assignto='.$assignto.'&amp;frameworkid='.$frameworkid.'&amp;nojs='.$nojs.'&amp;returnurl='.urlencode($returnurl).'&amp;s='.$s;

///
/// Permissions checks
///

// Setup page
admin_externalpage_setup('positionmanage');

// Check permissions
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updateposition', $sitecontext);

// Setup hierarchy objects
$hierarchy = new competency();
$position = new position();     // Used to determine the currently-assigned competencies

// Load framework
if (!$framework = $hierarchy->get_framework($frameworkid)) {
    error('Competency framework could not be found');
}

// Load competencies to display
$competencies = $hierarchy->get_items_by_parent($parentid);
$currentlyassigned = $position->get_assigned_competencies($assignto, $frameworkid);
if (!is_array($currentlyassigned)) {
    $currentlyassigned = array();
}

///
/// Display page
///

if (!$nojs) {
    if ($treeonly) {
        echo build_treeview(
            $competencies,
            get_string('nounassignedcompetencies', 'position'),
            $hierarchy,
            $currentlyassigned
        );
        exit;
    }

    // If parent id is not supplied, we must be displaying the main page
    if (!$parentid) {
        echo '<div class="selectcompetencies">'.PHP_EOL;
        echo '<div class="selected"><p>';
        echo get_string('selectedcompetencies', $hierarchy->prefix);
        echo populate_selected_items_pane($currentlyassigned);
        echo '</p></div>';
        echo '<p>'.get_string('locatecompetency', $hierarchy->prefix).':</p>';
        if (empty($frameworkid)) {
            $hierarchy->display_framework_selector('', true);
        }
        echo '<ul class="treeview filetree">';
    }

    echo build_treeview(
        $competencies,
        get_string('nounassignedcompetencies', 'position'),
        $hierarchy,
        $currentlyassigned
    );

    // If no parent id, close div
    if (!$parentid) {
        echo '</ul></div>';
    }

} else {
    // none JS version of page
    admin_externalpage_print_header();
    echo '<h2>'.get_string('assigncompetency', 'competency').'</h2>';

    echo '<p><a href="'.$returnurl.'">'.get_string('cancelwithoutassigning','hierarchy').'</a></p>';

    if(empty($frameworkid) || $frameworkid == 0) {

        echo build_nojs_frameworkpicker(
            $hierarchy,
            $CFG->wwwroot.'/hierarchy/type/position/assigncompetency/find.php',
            array(
                'returnurl' => $returnurl,
                's' => $s,
                'nojs' => 1,
                'assignto' => $assignto,
                'frameworkid' => $frameworkid,
            )
        );

    } else {
        ?>
<div id="nojsinstructions">
<?php
        echo build_nojs_breadcrumbs($hierarchy,
            $parentid,
            $CFG->wwwroot.'/hierarchy/type/position/assigncompetency/find.php',
            array(
                'assignto' => $assignto,
                'returnurl' => $returnurl,
                's' => $s,
                'nojs' => $nojs,
                'frameworkid' => $frameworkid,
            )
        );

?>
<p>
<?php echo  get_string('clicktoassign', $hierarchy->prefix).' '.
            get_string('clicktoviewchildren', $hierarchy->prefix) ?>
</p>
</div>
<div class="nojsselect">
<?php
         echo build_nojs_treeview(
            $competencies,
            get_string('nochildcompetenciesfound', 'competency'),
            $CFG->wwwroot.'/hierarchy/type/position/assigncompetency/assign.php',
            array(
                's' => $s,
                'returnurl' => $returnurl,
                'nojs' => 1,
                'frameworkid' => $frameworkid,
                'assignto' => $assignto,
            ),
            $CFG->wwwroot.'/hierarchy/type/position/assigncompetency/find.php?'.$urlparams,
            $hierarchy->get_all_parents()
        );

?>
</div>
<?php
    }

    print_footer();


}

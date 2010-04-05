<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');

// Page title
$pagetitle = 'assigncompetencytemplates';

///
/// Params
///

// Assign to id
$assignto = required_param('assignto', PARAM_INT);

// Framework id
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);

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

// Setup hierarchy object
$hierarchy = new competency();

// Load framework
if (!$framework = $hierarchy->get_framework($frameworkid)) {
    error('Competency framework could not be found');
}

// Load competency templates to display
$items = $hierarchy->get_templates();

// Load currently assigned competency templates
// TODO

///
/// Display page
///

if(!$nojs) {

    echo '<div class="selectcompetencies">';
    $hierarchy->display_framework_selector('', true);
    echo '<h2>'.get_string($pagetitle, $hierarchy->prefix).'</h2>';
    echo '<div class="selected">';
    echo '<p>'.get_string('dragheretoassign', $hierarchy->prefix).'</p>';
    echo '</div>';
    echo '<p>'.get_string('locatecompetency', $hierarchy->prefix).':</p>';
    echo '<ul class="treeview filetree">';
    echo build_treeview(
        $items,
        get_string('nounassignedcompetencytemplates', 'position')
    );
    echo '</ul></div>';

} else {
    // none JS version of page
    admin_externalpage_print_header();
    echo '<h2>'.get_string('assigncompetencytemplate', 'competency').'</h2>';

    echo '<p><a href="'.$returnurl.'">'.get_string('cancelwithoutassigning','hierarchy').'</a></p>';

    if(empty($frameworkid) || $frameworkid == 0) {

        echo build_nojs_frameworkpicker(
            $hierarchy,
            $CFG->wwwroot.'/hierarchy/type/position/assigncompetencytemplate/find.php',
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
<p>
<?php echo  get_string('clicktoassigntemplate', $hierarchy->prefix).' ' ?>
</p>
</div>
<div class="nojsselect">
<?php
         echo build_nojs_treeview(
            $items,
            get_string('nounassignedcompetencytemplates', 'position'),
            $CFG->wwwroot.'/hierarchy/type/position/assigncompetencytemplate/assign.php',
            array(
                's' => $s,
                'returnurl' => $returnurl,
                'nojs' => 1,
                'frameworkid' => $frameworkid,
                'assignto' => $assignto,
            ),
            $CFG->wwwroot.'/hierarchy/type/position/assigncompetencytemplate/find.php?'.$urlparams,
            $hierarchy->get_all_parents()
        );

?>
</div>
<?php
    }

    print_footer();

}

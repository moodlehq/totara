<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');
require_once($CFG->dirroot.'/idp/lib.php');


///
/// Setup / loading data
///

// Revision id
$revisionid = optional_param('id', 0, PARAM_INT);

// Framework id
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);

// Only return generated tree html
$treeonly = optional_param('treeonly', false, PARAM_BOOL);

// Only return generated tree html
$treeonly = optional_param('treeonly', false, PARAM_BOOL);

// No javascript parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_TEXT);
$s = optional_param('s', '', PARAM_TEXT);

// string of params needed in non-js url strings
$urlparams = 'id='.$revisionid.'&amp;frameworkid='.$frameworkid.'&amp;nojs='.$nojs.'&amp;returnurl='.urlencode($returnurl).'&amp;s='.$s;

admin_externalpage_setup('competencymanage');

// Check permissions
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:idpaddcompetencytemplate', $sitecontext);

// Setup hierarchy object
$hierarchy = new competency();

// Load plan this revision relates to
if (!$plan = get_plan_for_revision($revisionid)) {
    error('Revision plan could not be found');
}

// Load framework
if (!$framework = $hierarchy->get_framework($frameworkid, true)) {
    $templates = array();
    $currentlyassigned = array();
} else {

    // Load competency templates to display
    $templates = $hierarchy->get_templates();
    if (!$currentlyassigned = idp_get_user_competencytemplates($plan->userid, $revisionid, $frameworkid)) {
        $currentlyassigned = array();
    }
}


///
/// Display page
///

if(!$nojs) {

    if ($treeonly) {
        echo build_treeview(
            $templates,
            get_string( ($framework?'notemplateinframework':'notemplate'), 'competency'),
            null,
            $currentlyassigned
        );
        exit;
    }
?>

<div class="selectcompetencies">


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
    <?php echo get_string('locatecompetency', $hierarchy->prefix) ?>:
    <br>
    <?php
    if (empty($frameworkid)) {
        $hierarchy->display_framework_selector('', true); 
    }
    ?>
</p>

<ul class="treeview filetree">
<?php

echo build_treeview(
    $templates,
    get_string( ($framework?'notemplateinframework':'notemplate'), 'competency'),
    null,
    $currentlyassigned
);

echo '</ul></div>';

} else {
    // none JS version of page
    admin_externalpage_print_header();
    echo '<h2>'.get_string('addcompetencytemplatestoplan', 'idp').'</h2>';
    echo '<p><a href="'.$returnurl.'">'.get_string('cancelwithoutassigning','hierarchy').'</a></p>';

    if( $framework && ( empty($frameworkid) || $frameworkid == 0 )) {
        echo build_nojs_frameworkpicker(
            $hierarchy,
            $CFG->wwwroot.'/hierarchy/type/competency/idp/find-template.php',
            array(
                'returnurl' => $returnurl,
                's' => $s,
                'nojs' => 1,
                'id' => $revisionid,
            )
        );
    } else {

        echo  '<p>'.get_string('clicktoassigntemplate', $hierarchy->prefix);
        echo '</div><div class="nojsselect">';
        echo build_nojs_treeview(
            $templates,
            get_string(($framework?'notemplateinframework':'notemplate'), 'competency'),
            $CFG->wwwroot.'/hierarchy/type/competency/idp/save-template.php',
            array(
                'rowcount' => 0,
                's' => $s,
                'returnurl' => $returnurl,
                'nojs' => 1,
                'frameworkid' => $frameworkid,
                'id' => $revisionid,
            ),
            $CFG->wwwroot.'/hierarchy/type/competency/idp/find-template.php?'.$urlparams,
            array(),
            $currentlyassigned
        );
        echo '</div>';
    }
    print_footer();
}

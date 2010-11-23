<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/dialogs/dialog_content_hierarchy.class.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');


///
/// Setup / loading data
///

$id = required_param('id', PARAM_INT);

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
$urlparams = 'id='.$id.'&amp;frameworkid='.$frameworkid.'&amp;nojs='.$nojs.'&amp;returnurl='.urlencode($returnurl).'&amp;s='.$s;



// Setup page
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competency/course/add.php');

///
/// Display page
///

if(!$nojs) {
    /*
    // build Javascript Treeview
    if ($treeonly) {
        echo build_treeview($competencies, get_string('nochildcompetencies', 'competency'), $hierarchy);
        exit;
    }

    // If parent id is not supplied, we must be displaying the main page
    if (!$parentid) {
        echo '<div class="selectcompetencies">';
        echo '<div id="available-evidence" class="selected">';
        echo '</div>';
        echo '<p><strong>' . get_string('locatecompetency', $hierarchy->prefix) . '</strong></p>';
        $hierarchy->display_framework_selector('', true);
        echo '<ul class="filetree treeview">';
    }

    echo build_treeview($competencies, get_string('nochildcompetencies', 'competency'), $hierarchy);

    // If no parent id, close list
    if (!$parentid) {
        echo '</ul></div>';
    }
     */

    // Load dialog content generator
    $dialog = new totara_dialog_content_hierarchy_multi('competency', $frameworkid);

    // Toggle treeview only display
    $dialog->show_treeview_only = $treeonly;

    // Load items to display
    $dialog->load_items($parentid);

    // Set selected id
    $dialog->selected_id = 'available-evidence';

    // Display
    echo $dialog->generate_markup();


} else {
    // Check permissions
    $sitecontext = get_context_instance(CONTEXT_SYSTEM);
    require_capability('moodle/local:updatecompetency', $sitecontext);

    // Setup hierarchy object
    $hierarchy = new competency();

    // If parentid, load correct framework
    if ($parentid) {
        $parent = $hierarchy->get_item($parentid);
        $frameworkid = $parent->frameworkid;
    }

    // Load framework
    if (!$framework = $hierarchy->get_framework($frameworkid)) {
        error('Competency framework could not be found');
    }

    // Load competencies to display
    $competencies = $hierarchy->get_items_by_parent($parentid);

    // none JS version of page
    admin_externalpage_print_header();
    echo '<h2>'.get_string('assigncompetency', $hierarchy->prefix).'</h2>';

    echo '<p><a href="'.$returnurl.'">'.get_string('cancelwithoutassigning','hierarchy').'</a></p>';

    if(empty($frameworkid) || $frameworkid == 0) {

        echo build_nojs_frameworkpicker(
            $hierarchy,
            $CFG->wwwroot.'/hierarchy/type/competency/course/add.php',
            array(
                'returnurl' => $returnurl,
                's' => $s,
                'nojs' => 1,
                'id' => $id,
                'frameworkid' => $frameworkid,
            )
        );

    } else {
        ?>
<div id="nojsinstructions">
<?php
        echo build_nojs_breadcrumbs($hierarchy,
            $parentid,
            $CFG->wwwroot.'/hierarchy/type/competency/course/add.php',
            array(
                'id' => $id,
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
            $CFG->wwwroot.'/hierarchy/type/competency/course/evidence.php',
            array(
                's' => $s,
                'returnurl' => $returnurl,
                'nojs' => 1,
                'frameworkid' => $frameworkid,
                'id' => $id,
            ),
            $CFG->wwwroot.'/hierarchy/type/competency/course/add.php?'.$urlparams,
            $hierarchy->get_all_parents()
        );

?>
</div>
<?php
    }

    print_footer();

}

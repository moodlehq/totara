<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');

///
/// Setup / loading data
///

// Parent id
$parentid = optional_param('parentid', 0, PARAM_INT);

// Framework id
$defaultframeworkid = get_field_sql("SELECT id FROM {$CFG->prefix}comp_framework ORDER BY sortorder ASC");
$frameworkid = optional_param('frameworkid', $defaultframeworkid, PARAM_INT);

// competency evidence id - may be 0 for new competency evidence
$id = optional_param('id', 0, PARAM_INT);

// Only return generated tree html
$treeonly = optional_param('treeonly', false, PARAM_BOOL);

// No javascript parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_TEXT);
$s = optional_param('s', '', PARAM_TEXT);

// string of params needed in non-js url strings
$urlparams = 'id='.$id.'&amp;frameworkid='.$frameworkid.'&amp;nojs='.$nojs.'&amp;returnurl='.urlencode($returnurl).'&amp;s='.$s;

// Setup page
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competency/evidence/add.php');

// Check permissions
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

// Setup hierarchy object
$hierarchy = new competency();

// Load framework
if (!$framework = $hierarchy->get_framework($frameworkid)) {
    error('Competency framework could not be found');
}

// Load competencies to display
$competencies = $hierarchy->get_items_by_parent($parentid);

///
/// Display page
///

if(!$nojs) {
    // build Javascript Treeview

    if ($treeonly) {
        echo build_treeview(
            $competencies,
            get_string('nocompetenciesinframework', 'competency'),
            $hierarchy
        );
        exit;
    }

    // If parent id is not supplied, we must be displaying the main page
    if (!$parentid) {
        echo '<div class="selectcompetency">'.PHP_EOL;
        echo '<h2>'.get_string('addnewcompetency', $hierarchy->prefix).PHP_EOL;
        echo dialog_display_currently_selected(get_string('currentlyselected', $hierarchy->prefix));
        echo '</h2>'.PHP_EOL;
        $hierarchy->display_framework_selector('', true);
        echo '<ul class="treeview filetree picker">'.PHP_EOL;
    }

    echo build_treeview(
        $competencies,
        get_string('nocompetenciesinframework', 'competency'),
        $hierarchy
    );

    // If no parent id, close list
    if (!$parentid) {
        echo '</ul></div>'.PHP_EOL;
    }

} else {
    // none JS version of page
    admin_externalpage_print_header();
    echo '<h2>'.get_string('assigncompetency', $hierarchy->prefix).'</h2>';

    echo '<p><a href="'.$returnurl.'">'.get_string('cancelwithoutassigning','hierarchy').'</a></p>';

    if(empty($frameworkid) || $frameworkid == 0) {

        echo build_nojs_frameworkpicker(
            $hierarchy,
            $CFG->wwwroot.'/hierarchy/type/competency/assign/find.php',
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
            $CFG->wwwroot.'/hierarchy/type/competency/assign/find.php',
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
            $CFG->wwwroot.'/hierarchy/type/competency/assign/save.php',
            array(
                's' => $s,
                'returnurl' => $returnurl,
                'nojs' => 1,
                'frameworkid' => $frameworkid,
                'id' => $id,
            ),
            $CFG->wwwroot.'/hierarchy/type/competency/assign/find.php?'.$urlparams,
            $hierarchy->get_all_parents()
        );

?>
</div>
<?php
    }

    print_footer();

}

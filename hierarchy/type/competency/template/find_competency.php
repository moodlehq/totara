<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');


///
/// Setup / loading data
///

// Template id
$id = required_param('templateid', PARAM_INT);

// Parent competency
$parentid = optional_param('parentid', 0, PARAM_INT);

// No javascript parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_TEXT);
$s = optional_param('s', '', PARAM_TEXT);

// string of params needed in non-js url strings
$urlparams = 'templateid='.$id.'&amp;nojs='.$nojs.'&amp;returnurl='.urlencode($returnurl).'&amp;s='.$s;

// Setup page
admin_externalpage_setup('competencyframeworkmanage', '', array(), '', $CFG->wwwroot.'/competency/template/assign_competency.php');

// Check permissions
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetencytemplate', $sitecontext);

// Setup hierarchy object
$hierarchy = new competency();

// Load template
if (!$template = $hierarchy->get_template($id)) {
    error('Template ID was incorrect');
}

// Load framework
if (!$framework = $hierarchy->get_framework($template->frameworkid)) {
    error('Competency framework could not be found');
}

// Load competencies to display
$competencies = $hierarchy->get_items_by_parent($parentid);
if (!$competenciesintemplate = $hierarchy->get_assigned_to_template($id)) {
    $competenciesintemplate = array();
}

///
/// Display page
///

if(!$nojs) {
    // If parent id is not supplied, we must be displaying the main page
    if (!$parentid) {

        echo '<div class="selectcompetencies">';
        echo '<h2>' . get_string('assignnewcompetency', $hierarchy->prefix) . '</h2>';
        echo '<div class="selected"><p>';
        echo get_string('selectedcompetencies', $hierarchy->prefix);
        echo populate_selected_items_pane($competenciesintemplate);
        echo '</p></div>';
        echo '<p>' . get_string('locatecompetency', $hierarchy->prefix) . ':</p>';
        echo '<ul class="treeview filetree">';
    }

    echo build_treeview(
        $competencies,
        get_string('nochildcompetenciesfound', 'competency'),
        $hierarchy,
        $competenciesintemplate
    );

    // If no parent id, close list
    if (!$parentid) {
        echo '</ul></div>';
    }

} else {
    // none JS version of page
    admin_externalpage_print_header();
    echo '<h2>'.get_string('assigncompetency', $hierarchy->prefix).'</h2>';

    echo '<p><a href="'.$returnurl.'">'.get_string('cancelwithoutassigning','hierarchy').'</a></p>';

    ?>
<div id="nojsinstructions">
<?php
    echo build_nojs_breadcrumbs($hierarchy,
        $parentid,
        $CFG->wwwroot.'/hierarchy/type/competency/template/find_competency.php',
        array(
            'templateid' => $id,
            'returnurl' => $returnurl,
            's' => $s,
            'nojs' => $nojs,
        ),
        false
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
        $CFG->wwwroot.'/hierarchy/type/competency/template/save_competency.php',
        array(
            's' => $s,
            'returnurl' => $returnurl,
            'nojs' => 1,
            'templateid' => $id,
        ),
        $CFG->wwwroot.'/hierarchy/type/competency/template/find_competency.php?'.$urlparams,
        $hierarchy->get_all_parents(),
        $competenciesintemplate
    );

?>
</div>
<?php

    print_footer();


}

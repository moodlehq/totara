<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/dialogs/dialog_content_hierarchy.class.php');

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

// Setup hierarchy object
$hierarchy = new competency();

// Load template
if (!$template = $hierarchy->get_template($id)) {
    error('Template ID was incorrect');
}

// Load competencies to display
if (!$competenciesintemplate = $hierarchy->get_assigned_to_template($id)) {
    $competenciesintemplate = array();
}

///
/// Display page
///

if(!$nojs) {
    // Load dialog content generator
    $dialog = new totara_dialog_content_hierarchy_multi('competency', $template->frameworkid);

    // Load items to display
    $dialog->load_items($parentid);

    // Set disabled items
    $dialog->disabled_items = $competenciesintemplate;

    // Set title
    $dialog->selected_title = 'selectedcompetencies';

    // Disable framework picker
    $dialog->disable_picker = true;

    // Display
    echo $dialog->generate_markup();

} else {
    // none JS version of page
    // Check permissions
    $sitecontext = get_context_instance(CONTEXT_SYSTEM);
    require_capability('moodle/local:updatecompetencytemplate', $sitecontext);

    // Load framework
    if (!$framework = $hierarchy->get_framework($template->frameworkid)) {
        error('Competency framework could not be found');
    }
    $competencies = $hierarchy->get_items_by_parent($parentid);

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

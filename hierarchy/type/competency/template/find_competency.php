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

// Setup page
admin_externalpage_setup('competencytemplatemanage', '', array(), '', $CFG->wwwroot.'/competency/template/assign_competency.php');

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


///
/// Display page
///

// If parent id is not supplied, we must be displaying the main page
if (!$parentid) {

?>

<div class="selectcompetencies">

<h2><?php echo get_string('assignnewcompetency', $hierarchy->prefix) ?></h2>

<div class="selected">
    <p>
        <?php echo get_string('dragheretoassign', $hierarchy->prefix) ?>
    </p>
</div>

<p>
    <?php echo get_string('locatecompetency', $hierarchy->prefix) ?>:
</p>

<ul class="treeview filetree">
<?php
}

echo build_treeview(
    $competencies,
    get_string('nochildcompetenciesfound', 'competency'),
    $hierarchy
);

// If no parent id, close list
if (!$parentid) {
    echo '</ul></div>';
}

<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');


///
/// Setup / loading data
///

// Revision id
$revisionid = required_param('id', PARAM_INT);

// Parent id
$parentid = optional_param('parentid', 0, PARAM_INT);

// Framework id
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);


///
/// Permissions checks
///

admin_externalpage_setup('competencymanage');

// Check permissions
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:idpaddcompetency', $sitecontext);

// Setup hierarchy object
$hierarchy = new competency();

// Load framework
if (!$framework = $hierarchy->get_framework($frameworkid)) {
    error('Competency framework could not be found');
}

// Load competencies to display
$competencies = $hierarchy->get_items_by_parent($parentid);

// Get IDs of all items that are parents
// (to see if we should link to children)
if(!$parents = get_records_sql("
    SELECT DISTINCT parentid AS id
    FROM {$CFG->prefix}{$hierarchy->prefix}
    WHERE parentid != 0")) {
    // default to empty array if none found
    $parents = array();
}

///
/// Display page
///

// If parent id is not supplied, we must be displaying the main page
if (!$parentid) {

?>

<div class="selectcompetencies">

<?php $hierarchy->display_framework_selector('', true); ?>

<h2><?php echo get_string('addcompetenciestoplan', 'idp') ?></h2>

<div class="selected">
    <p>
        <?php echo get_string('dragheretoassign', $hierarchy->prefix) ?>
    </p>
</div>

<p>
    <?php echo get_string('locatecompetency', $hierarchy->prefix) ?>:
</p>

<?php
}

// If this is the root node
if (!$parentid) {
    echo '<ul class="treeview filetree">';
}

echo build_treeview(
    $competencies,
    get_string('nocompetenciesinframework', 'competency'),
    $parents
);

// If no parent id, close div
if (!$parentid) {
    echo '</ul></div>';
}

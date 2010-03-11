<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/local/js/setup.php');


///
/// Setup / loading data
///

// Framework id
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);

admin_externalpage_setup('competencymanage');

// Check permissions
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

// Setup hierarchy object
$hierarchy = new competency();

// Load framework
if (!$framework = $hierarchy->get_framework($frameworkid)) {
    error('Competency framework could not be found');
}

// Load competency templates to display
$templates = $hierarchy->get_templates();

///
/// Display page
///

?>

<div class="selectcompetencies">

<?php $hierarchy->display_framework_selector('', true); ?>

<h2><?php echo get_string('addcompetencytemplatestoplan', 'idp') ?></h2>

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

echo build_treeview(
    $templates,
    get_string('notemplateinframework', 'competency')
);

echo '</ul></div>';

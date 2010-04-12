<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');


///
/// Setup / loading data
///

// Revision id
$revisionid = optional_param('id', 0, PARAM_INT);

// Framework id
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);

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

// Load framework
if (!$framework = $hierarchy->get_framework($frameworkid)) {
    error('Competency framework could not be found');
}

// Load competency templates to display
$templates = $hierarchy->get_templates();
$assignedtemplates = get_records('idp_revision_competencytemplate', 'revision', $revisionid, '', 'competencytemplate');
if( !is_array($assignedtemplates) ){
    $assignedtemplates = array();
};

///
/// Display page
///

if(!$nojs) {
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
    get_string('notemplates', 'competency'),
    null,
    $assignedtemplates
);

echo '</ul></div>';

} else {
    // none JS version of page
    admin_externalpage_print_header();
    echo '<h2>'.get_string('addcompetencytemplatestoplan', 'idp').'</h2>';
    echo '<p><a href="'.$returnurl.'">'.get_string('cancelwithoutassigning','hierarchy').'</a></p>';


    if(empty($frameworkid) || $frameworkid == 0) {
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
            get_string('nounassignedcompetencytemplates', 'position'),
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
            $assignedtemplates
        );
        echo '</div>';
    }
    print_footer();
}

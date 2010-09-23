<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/related/lib.php');


///
/// Setup / loading data
///

// Competency id
$compid = required_param('id', PARAM_INT);

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
$urlparams = 'id='.$compid.'&amp;frameworkid='.$frameworkid.'&amp;nojs='.$nojs.'&amp;returnurl='.urlencode($returnurl).'&amp;s='.$s;

// Setup page
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competency/related/add.php');

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
$alreadyrelated = comp_relation_get_relations($compid);
$alreadyselected = $alreadyrelated ? get_records_select('comp', 'id IN ('.implode(',', $alreadyrelated).')',
                                                        '', 'id, fullname') : array();
$alreadyrelated[$compid] = $compid;

///
/// Display page
///


if(!$nojs) {
    if ($treeonly) {
        echo build_treeview(
            $competencies,
            get_string('nochildcompetenciesfound', 'competency'),
            $hierarchy,
            $alreadyrelated
        );
        exit;
    }
    // build Javascript Treeview

    // If parent id is not supplied, we must be displaying the main page
    if (!$parentid) {

        echo '<div class="selectcompetencies">';
        echo '<h2>' . get_string('assignrelatedcompetencies', $hierarchy->prefix) . '</h2>';
        echo '<div class="selected">';
        echo '<p>' . get_string('selectedcompetencies', $hierarchy->prefix) . '</p>';
        echo populate_selected_items_pane($alreadyselected);
        echo '</div>';
        echo '<p>' . get_string('locatecompetency', $hierarchy->prefix).':'.'</p>';
        $hierarchy->display_framework_selector('', true);
        echo '<ul class="treeview filetree">';
    }

    echo build_treeview(
        $competencies,
        get_string('nochildcompetenciesfound', 'competency'),
        $hierarchy,
        $alreadyrelated
    );

    // If no parent id, close div
    if (!$parentid) {
        echo '</ul></div>';
    }

} else {
    // none JS version of page
    admin_externalpage_print_header();
    echo '<h2>'.get_string('assignrelatedcompetencies', $hierarchy->prefix).'</h2>';

    echo '<p><a href="'.$returnurl.'">'.get_string('cancelwithoutassigning','hierarchy').'</a></p>';

    if(empty($frameworkid) || $frameworkid == 0) {

        echo build_nojs_frameworkpicker(
            $hierarchy,
            $CFG->wwwroot.'/hierarchy/type/competency/related/find.php',
            array(
                'returnurl' => $returnurl,
                's' => $s,
                'nojs' => 1,
                'id' => $compid,
            )
        );

    } else {
        ?>
<div id="nojsinstructions">
<?php
        echo build_nojs_breadcrumbs($hierarchy,
            $parentid,
            $CFG->wwwroot.'/hierarchy/type/competency/related/find.php',
            array(
                'id' => $compid,
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
            $CFG->wwwroot.'/hierarchy/type/competency/related/save.php',
            array(
                's' => $s,
                'returnurl' => $returnurl,
                'nojs' => 1,
                'frameworkid' => $frameworkid,
                'id' => $compid,
            ),
            $CFG->wwwroot.'/hierarchy/type/competency/related/find.php?'.$urlparams,
            $hierarchy->get_all_parents(),
            $alreadyrelated
        );

?>
</div>
<?php
    }

    print_footer();
}





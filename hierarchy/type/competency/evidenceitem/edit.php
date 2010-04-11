<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');


///
/// Setup / loading data
///

// competency id
$id = required_param('id', PARAM_INT);
$type = optional_param('type', -1, PARAM_INT);

// Check perms
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competency/edit.php');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

if (!$competency = get_record('competency', 'id', $id)) {
    error('Competency ID was incorrect');
}


///
/// Display page
///


// Load categories by parent id
$categories = array();
$parents = array();
make_categories_list($categories, $parents);

?>

<h2><?php echo get_string('assignnewevidenceitem', 'competency') ?></h2>

<div id="available-evidence" class="selected">
</div>

<p>
    Locate course:
</p>

<ul class="filetree treeview">
<?php

    echo build_category_treeview($categories, $parents, 'Loading courses...');

?>
</ul>

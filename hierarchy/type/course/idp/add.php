<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');


///
/// Setup / loading data
///

// Competency id
$id = required_param('id', PARAM_INT);

require_login();

// Load all categories
$categories = array();
$parents = array();
make_categories_list($categories, $parents);

///
/// Display page
///

?>

<div class="selectcourses">

<h2><?php echo get_string('addcoursestoplan', 'idp') ?></h2>

<p>
    <?php echo get_string('locatecourse', 'idp') ?>:
</p>

<ul class="filetree treeview picker">
<?php

    echo build_category_treeview($categories, $parents, 'Loading courses...');

?>
</ul>
</div>

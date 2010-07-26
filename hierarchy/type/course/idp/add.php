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

// No javascript parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_TEXT);
$s = optional_param('s', '', PARAM_TEXT);

$category = optional_param('category', 0, PARAM_INT);

admin_externalpage_setup('competencymanage');
require_login();

// Load all categories
$categories = array();
$parents = array();
make_categories_list($categories, $parents);

///
/// Display page
///

if($nojs) {
    // none JS version
    admin_externalpage_print_header();
    echo '<h2>' . get_string('assignnewevidenceitem', 'competency') . '</h2>';
    echo '<p><a href="'.$returnurl.'">'.get_string('cancelwithoutassigning','hierarchy').'</a></p>';
    echo '<p>'. get_string('selectcategoryandcourse','competency'). '</p>';
    echo '<form action="'.me().' method="get">';
    choose_from_menu($categories, 'category', $category);
    echo '<input type="hidden" name="id" value="' . $id . '">';
    echo '<input type="hidden" name="nojs" value="' . $nojs . '">';
    echo '<input type="hidden" name="returnurl" value="' . $returnurl . '">';
    echo '<input type="hidden" name="s" value="' . $s . '">';
    echo '<input type="submit" name="submit" value="'.get_string('go').'">';
    echo '</form>';

    if($category != 0) {
        if($courses = get_records('course', 'category', $category, 'sortorder')) {
            echo '<ul>';
            foreach($courses as $course) {
                echo '<li><a href="'.$CFG->wwwroot.'/hierarchy/type/course/idp/save.php?id='.$id.'&amp;rowcount=0&amp;add='.$course->id.'&amp;nojs='.$nojs.'&amp;s='.$s.'&amp;returnurl='.urlencode($returnurl).'">' . $course->fullname . '</a></li>';
            }
            echo '</ul>';
        } else {
            print '<p>'. get_string('nocoursesincat','competency').'</p>';
        }
    }
    print_footer();
} else {
    // JS version
    echo '<div class="selectcourses">';
    echo '<h2>' . get_string('addcoursestoplan', 'idp') . '</h2>';
    echo '<p>' . get_string('locatecourse', 'idp') . '</p>';
    echo '<ul class="filetree treeview picker">';
    echo build_category_treeview($categories, $parents, 'Loading courses...');
    echo '</ul>';
    echo '</div>';
}

<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/dialogs/dialog_content_courses.class.php');

require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');


///
/// Setup / loading data
///

// competency id
$id = required_param('id', PARAM_INT);
$type = optional_param('type', -1, PARAM_INT);
$category = optional_param('category', 0, PARAM_INT);

// No javascript parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_TEXT);
$s = optional_param('s', '', PARAM_TEXT);

// Check perms
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competency/edit.php');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

if (!$competency = get_record('comp', 'id', $id)) {
    error('Competency ID was incorrect');
}


///
/// Display page
///


if($nojs) {
    // None JS version

    // Load categories by parent id
    $categories = array();
    $parents = array();
    make_categories_list($categories, $parents);

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
                echo '<li><a href="'.$CFG->wwwroot.'/hierarchy/type/competency/evidenceitem/course.php?id='.$course->id.'&amp;competency='.$id.'&amp;nojs='.$nojs.'&amp;s='.$s.'&amp;returnurl='.urlencode($returnurl).'">' . $course->fullname . '</a></li>';
            }
            echo '</ul>';
        } else {
            print '<p>'. get_string('nocoursesincat','competency').'</p>';
        }
    }
    print_footer();
} else {

    // Use parentid instead of category
    $parentid = optional_param('parentid', 'cat0', PARAM_ALPHANUM);

    // Strip cat from begining of parentid
    $parentid = (int) substr($parentid, 3);

    // Load dialog content generator
    $dialog = new totara_dialog_content_courses($parentid);

    // Turn on multi-select
    $dialog->type = totara_dialog_content::TYPE_CHOICE_MULTI;

    // Setup search
    $dialog->search_code = '/hierarchy/type/competency/evidenceitem/search.php';

    // Set selected pane's id
    $dialog->selected_id = 'available-evidence';

    // Display page
    echo $dialog->generate_markup();
}

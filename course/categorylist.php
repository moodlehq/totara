<?php // $Id$
      // Displays the top level category or all courses

    require_once("../config.php");
    require_once("lib.php");
    require_once($CFG->dirroot."/local/program/lib.php"); // required to display lists of programs
    require_once($CFG->dirroot.'/local/icon/coursecategory_icon.class.php');

    $categoryedit = optional_param('categoryedit', -1, PARAM_BOOL);
    $viewtype = optional_param('viewtype', '', PARAM_TEXT);

    // Set the view type as a session value so that either courses or programs
    // are displayed by default
    if ($viewtype == 'program') {
        $SESSION->viewtype = 'program';
    } else if ($viewtype == 'course' || empty($SESSION->viewtype)) {
        $SESSION->viewtype = 'course';
    }

    if ($CFG->forcelogin) {
        require_login();
    }

    if (!$site = get_site()) {
        error('Site isn\'t defined!');
    }

    $context = get_context_instance(CONTEXT_SYSTEM);

    $doanything = has_capability('moodle/site:doanything', $context);

    // save editing state
    if ($categoryedit !== -1) {
        $USER->categoryedit = $categoryedit;
    }

    // show we show the editing on/off button?
    $editbutton = has_any_capability(array('moodle/category:manage', 'moodle/course:create'), $context) ?
        totara_print_edit_button('categoryedit') : '';

    // determine how to display this page
    $adminediting = !empty($USER->categoryedit);

    $category_icon = new coursecategory_icon();

/// Print headings
    $numcategories = count_records('course_categories');

    $stradministration = get_string('administration');
    $strcategories = get_string('categories');
    $strcategory = get_string('category');
    $strcourses = get_string('courses');

    $navlinks = array();
    if ($adminediting) {
        if ($SESSION->viewtype == 'course') {
            $navlinks[] = array('name' => get_string('managecourses'), 'link' => null, 'type' => 'misc');
        } else {
            $navlinks[] = array('name' => get_string('manageprograms', 'admin'), 'link' => null, 'type' => 'misc');
        }
    } else {
        if ($SESSION->viewtype == 'course') {
            $navlinks[] = array('name' => get_string('findcourses', 'local'), 'link' => null, 'type' => 'misc');
        } else {
            $navlinks[] = array('name' => get_string('findprograms', 'local_program'), 'link' => null, 'type' => 'misc');
        }

    }

    $navigation = build_navigation($navlinks);

    if ($adminediting) {
        // Integrate into the admin tree only if the user can edit categories at the top level,
        // otherwise the admin block does not appear to this user, and you get an error.
        require_once($CFG->libdir.'/adminlib.php');
        $adminpage = ($SESSION->viewtype == 'course') ? 'managecourses' : 'manageprograms';
        admin_externalpage_setup($adminpage, $editbutton, array(), $CFG->wwwroot . '/course/category.php');
        admin_externalpage_print_header('', $navlinks);
    } else {
        print_header("$site->shortname", "$site->fullname: $strcourses", $navigation, '', '', true, $editbutton);
    }

    if ($SESSION->viewtype == 'course') {
        $strheading = get_string('courses');
        $stralllink = get_string('viewallcourses');
        $strnoitems = get_string('therearenocoursestodisplay');
    } else {
        $strheading = get_string('programs', 'local_program');
        $stralllink = get_string('viewallprograms', 'local_program');
        $strnoitems = get_string('therearenoprogramstodisplay', 'local_program');
    }

    print_heading($strheading, '', 1);

    if ($adminediting && has_capability('moodle/category:manage', $context)) {
        echo '<div class="buttons">';

        if ($SESSION->viewtype == 'course' &&
            has_capability('moodle/course:create', $context)) {

        /// Print button to create a new course (no specific category)
            print_single_button('edit.php', array('category' => $CFG->defaultrequestcategory), get_string('addnewcourse'), 'get');
        }

        if ($SESSION->viewtype == 'program' &&
            has_capability('local/program:createprogram', $context)) {
        /// Print button to create a new program
            print_single_button($CFG->wwwroot.'/local/program/add.php', array('category' => $CFG->defaultrequestcategory), get_string('addnewprogram', 'local_program'), 'get');
        }

        echo '</div>';
    }

    print_totara_search('', false, $SESSION->viewtype, 0);

    $topcats = get_records('course_categories', 'parent', 0);

    $secondarycats = get_records_select('course_categories', 'parent IN ('.implode(',', array_keys($topcats)).')');

    $top_item_counts = get_category_item_count(array_keys($topcats), ($SESSION->viewtype != 'program'));
    if ($secondarycats) {
        $secondary_item_counts = get_category_item_count(array_keys($secondarycats), ($SESSION->viewtype != 'program'));
    } else {
        $secondary_item_counts = 0;
    }


/// Print out all the top-level categories
    if ($topcats) {
        // use 3 columns if there's space, 2 on admin pages
        $numcols = $adminediting ? 2 : 3;

        $table = new flexible_table('toplevel_categories');
        $columns = array();
        $headers = array();
        for ($i = 1; $i <= $numcols; $i++) {
            $columns[] = 'column'.$i;
            $headers[] = '';
        }
        $colwidth = floor(100 / $numcols) . '%';
        $table->define_columns($columns);
        $table->define_headers($headers);
        $table->set_attribute('class', 'nostripes boxaligncenter fullwidth categorylisting');
        $table->column_style_all('width', $colwidth);
        $table->setup();
        $tablerow = array();
        foreach ($topcats as $topcat) {
            if ($topcat->visible || $doanything || has_capability('moodle/category:viewhiddencategories', $context)) {
                if (count($tablerow) == $numcols) {
                    $table->add_data($tablerow);
                    $tablerow = array();
                }

                $catlinkcss = $topcat->visible ? '' : 'class="dimmed" ';
                $item_count = array_key_exists($topcat->id, $top_item_counts) ? $top_item_counts[$topcat->id] : 0;

                // don't show empty sub-categories unless viewing as admin
                if (!$adminediting && $item_count == 0) {
                    continue;
                }

                $tablerow[] = '<h3><a '.$catlinkcss.' href="category.php?id='.$topcat->id.'">'.
                    $category_icon->display($topcat, 'small') .format_string($topcat->name).' ('.$item_count.')</a></h3>' .
                        print_main_subcategories($topcat->id, $secondarycats, $secondary_item_counts, $adminediting);
            }
        }
        // output the last row
        if (count($tablerow) > 0) {
            $table->add_data($tablerow);
        }
        if (!empty($table->data)) {
            echo '<p><a href="'. $CFG->wwwroot . '/course/search.php?category=0&amp;viewtype='.$SESSION->viewtype.'&amp;search=">'.$stralllink.'</a></p>';
            print_heading(get_string('browsebycategory'), '', 3);
            $table->print_html();
        } else {
            echo '<p>' . $strnoitems . '</p>';

        }
    }

    echo '<div class="buttons">';
    // @todo decide what to do with this button

    if (!empty($CFG->enablecourserequests) && $category->id == $CFG->enablecourserequests) {
        print_course_request_buttons(get_context_instance(CONTEXT_SYSTEM));
    }
    echo '</div>';

    print_footer();

?>

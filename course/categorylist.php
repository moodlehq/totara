<?php // $Id$
      // Displays the top level category or all courses

    require_once("../config.php");
    require_once("lib.php");
    require_once($CFG->dirroot."/totara/program/lib.php"); // required to display lists of programs
    require_once($CFG->dirroot.'/totara/coursecatalog/lib.php');
    require_once($CFG->libdir.'/totaratablelib.php');

    $categoryedit = optional_param('categoryedit', -1, PARAM_BOOL);
    $viewtype = optional_param('viewtype', 'course', PARAM_TEXT);

    // Set the view type as a session value so that either courses or programs
    // are displayed by default
    if ($viewtype == 'program') {
        $SESSION->viewtype = 'program';
        $PAGE->set_totara_menu_selected('program');
    } else if ($viewtype == 'course' || empty($SESSION->viewtype)) {
        $SESSION->viewtype = 'course';
        $PAGE->set_totara_menu_selected('course');
    }

    if ($CFG->forcelogin) {
        require_login();
    }

    if (!$site = get_site()) {
        redirect(new moodle_url('/admin/index.php'));
    }

    $systemcontext = context_system::instance();
    $category = isset($CFG->defaultrequestcategory) ? $CFG->defaultrequestcategory : SITEID;
    $catcontext = context_coursecat::instance($category);
    $PAGE->set_url(new moodle_url('/course/categorylist.php'));
    $PAGE->set_context($systemcontext);
    $PAGE->set_pagelayout('admin');

    // save editing state
    if ($categoryedit !== -1) {
        $USER->categoryedit = $categoryedit;
    }
    $editingon = !empty($USER->categoryedit);

    // determine how to display this page
    $canmanagesitecourses = has_any_capability(array('moodle/course:create', 'moodle/course:update'), $systemcontext);
    $canmanagesiteprograms = has_any_capability(array('totara/program:createprogram', 'totara/program:configureprogram'), $systemcontext);

    $canmanagethesecourses = has_any_capability(array('moodle/course:create', 'moodle/course:update'), $catcontext);
    $canmanagetheseprograms = has_any_capability(array('totara/program:createprogram', 'totara/program:configureprogram'), $catcontext);

    $canedit = (($SESSION->viewtype == 'course' && $canmanagethesecourses) ||
                ($SESSION->viewtype == 'program' && $canmanagetheseprograms));
    $isediting = ($editingon && $canedit);

    $isadmin = (($SESSION->viewtype == 'course' && $canmanagesitecourses) ||
                 ($SESSION->viewtype == 'program' && $canmanagesiteprograms));
    $isadminediting = ($editingon && $isadmin);

    // should we show the editing on/off button?
    $editbutton = $canedit ? totara_print_edit_button('categoryedit') : '';

/// Print headings
    $numcategories = $DB->count_records('course_categories');

    $stradministration = get_string('administration');
    $strcategories = get_string('categories');
    $strcategory = get_string('category');
    $strcourses = get_string('courses');

    if ($isadminediting) {
        if ($SESSION->viewtype == 'course') {
            $PAGE->navbar->add(get_string('managecourses'));
        }
        else {
            $PAGE->navbar->add(get_string('manageprograms', 'admin'));
        }
    } else {
        if ($SESSION->viewtype == 'course') {
            $PAGE->navbar->add(get_string('findcourses', 'totara_core'));
        }
        else {
            $PAGE->navbar->add(get_string('findprograms', 'totara_program'));
        }

    }

    if ($isadminediting) {
        // Integrate into the admin tree only if the user can edit categories at the top level,
        // otherwise the admin block does not appear to this user, and you get an error.
        require_once($CFG->libdir.'/adminlib.php');
        $adminpage = ($SESSION->viewtype == 'course') ? 'managecourses' : 'manageprograms';
        admin_externalpage_setup($adminpage, $editbutton, array(), new moodle_url('/course/categorylist.php'));
        echo $OUTPUT->header();
    } else {
        $PAGE->set_title("$site->shortname");
        $PAGE->set_heading("$site->fullname: $strcourses");
        $PAGE->set_focuscontrol('');
        $PAGE->set_cacheable(true);
        $PAGE->set_button($editbutton);
        echo $OUTPUT->header();
    }

    if ($SESSION->viewtype == 'course') {
        $strheading = get_string('courses');
        $stralllink = get_string('viewallcourses');
        $strnoitems = get_string('therearenocoursestodisplay', 'totara_coursecatalog');
    }
    else {
        $strheading = get_string('programs', 'totara_program');
        $stralllink = get_string('viewallprograms', 'totara_program');
        $strnoitems = get_string('therearenoprogramstodisplay', 'totara_program');
    }

    echo $OUTPUT->heading($strheading, 1);

    $buttoncontainer = null;
    if ($isediting) {
        $buttoncontainer = $OUTPUT->container_start();
        if ($SESSION->viewtype == 'course' &&
            has_capability('moodle/course:create', $catcontext)) {
            // Print button to create a new course (no specific category)
            $buttoncontainer .= $OUTPUT->single_button(new moodle_url('/course/edit.php', array('category' => $CFG->defaultrequestcategory)), get_string('addnewcourse'), 'get');
        }
        if ($SESSION->viewtype == 'program' &&
            has_capability('totara/program:createprogram', $catcontext)) {
            // Print button to create a new program
            $buttoncontainer .= $OUTPUT->single_button(new moodle_url('/totara/program/add.php', array('category' => $CFG->defaultrequestcategory)), get_string('addnewprogram', 'totara_program'), 'get');
        }
        $buttoncontainer .= $OUTPUT->container_end();
    }


    $topcats = $DB->get_records('course_categories', array('parent' => 0), 'sortorder');

    list($insql, $dbparams) = $DB->get_in_or_equal(array_keys($topcats));
    $secondarycats = $DB->get_records_select('course_categories', "parent $insql", $dbparams, 'sortorder');

    $top_item_counts = totara_get_category_item_count(array_keys($topcats), ($SESSION->viewtype != 'program'));
    if ($secondarycats) {
        $secondary_item_counts = totara_get_category_item_count(array_keys($secondarycats), ($SESSION->viewtype != 'program'));
    }
    else {
        $secondary_item_counts = 0;
    }

    /// Print out all the top-level categories
    if ($topcats) {
        $viscats = array();
        foreach ($topcats as $topcat) {
            if ($topcat->visible || has_capability('moodle/category:viewhiddencategories', $systemcontext)) {
                $viscats[] = $topcat;
            }
        }

        if (count($viscats) == 0) {
            echo html_writer::tag('p', $strnoitems);
        } else {
            echo $OUTPUT->heading(get_string('browsebycategory', 'totara_coursecatalog'), 3);

            require_once($CFG->dirroot.'/lib/tablelib.php');
            // use 3 columns if there's space, 2 on admin pages
            $numcols = $isadminediting ? 2 : 3;
            $table = new totara_table('toplevel_categories');
            $columns = array();
            $headers = array();
            for ($i = 1; $i <= $numcols; $i++) {
                $columns[] = 'column'.$i;
                $headers[] = null;
            }
            $colwidth = floor(100 / $numcols) . '%';
            $table->define_columns($columns);
            $table->define_headers($headers);
            $table->set_attribute('class', 'nostripes boxaligncenter fullwidth categorylisting');
            $table->column_style_all('width', $colwidth);
            $table->define_baseurl(new moodle_url(me(), array('viewtype' => $viewtype, 'categoryedit' => $categoryedit)));
            $table->add_toolbar_content(print_totara_search('', false, $SESSION->viewtype, 0), 'left' , 'top', 0);
            if (!empty($buttoncontainer)) {
                $table->add_toolbar_content($buttoncontainer, 'right', 'top', 0);
            }
            $table->add_toolbar_content(html_writer::tag('p', html_writer::link(new moodle_url('/course/search.php', array('category' => '0', 'viewtype' => $SESSION->viewtype, 'search' => '')), $stralllink)), 'left', 'top', 1);
            $table->setup();
            $tablerow = array();
            foreach ($viscats as $topcat) {
                if (count($tablerow) == $numcols) {
                    $table->add_data($tablerow);
                    $tablerow = array();
                }

                $catlinkcss = $topcat->visible ? '' : 'dimmed';
                $item_count = array_key_exists($topcat->id, $top_item_counts) ? $top_item_counts[$topcat->id] : 0;

                // don't show empty sub-categories unless viewing as admin or user has capabilities at the level of the empty category
                if (!$isediting && $item_count == 0) {
                    $emptycatcontext = context_coursecat::instance($topcat->id);
                    $hasemptycat_coursecap = has_any_capability(array('moodle/course:create', 'moodle/course:update'), $emptycatcontext);
                    $hasemptycat_progcap = has_any_capability(array('totara/program:createprogram', 'totara/program:configureprogram'), $emptycatcontext);
                    if (!$hasemptycat_coursecap && !$hasemptycat_progcap) {
                        continue;
                    }
                }

                $url = new moodle_url('/course/category.php', array('id' => $topcat->id, 'viewtype' => $viewtype));
                $text = format_string($topcat->name).' ('.$item_count.')';
                $tablerow[] = $OUTPUT->heading(html_writer::link($url, $text, array('class' => $catlinkcss)), 3) .
                        totara_print_main_subcategories($topcat->id, $secondarycats, $secondary_item_counts, $isadminediting, $SESSION->viewtype);
            }
            // output the last row
            if (count($tablerow) > 0) {
                $table->add_data($tablerow);
            }
            $table->finish_output();
        }
    }

    echo $OUTPUT->container_start("buttons");
    // @todo decide what to do with this button

    if (!empty($CFG->enablecourserequests)) {
        print_course_request_buttons($systemcontext);
    }
    echo $OUTPUT->container_end();

    echo $OUTPUT->footer();

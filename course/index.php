<?php // $Id$
      // For most people, just lists the course categories
      // Allows the admin to create, delete and rename course categories

    require_once("../config.php");
    require_once("lib.php");
    require_once($CFG->dirroot."/local/program/lib.php"); // required to display lists of programs
    require_once($CFG->dirroot."/local/js/lib/setup.php");

    $categoryedit = optional_param('categoryedit', -1,PARAM_BOOL);
    $delete   = optional_param('delete',0,PARAM_INT);
    $hide     = optional_param('hide',0,PARAM_INT);
    $show     = optional_param('show',0,PARAM_INT);
    $move     = optional_param('move',0,PARAM_INT);
    $moveto   = optional_param('moveto',-1,PARAM_INT);
    $moveup   = optional_param('moveup',0,PARAM_INT);
    $movedown = optional_param('movedown',0,PARAM_INT);
    $viewtype = optional_param('viewtype','',PARAM_TEXT);

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

    require_js(array(
        $CFG->wwwroot.'/local/js/lib/jquery-1.3.2.min.js',
        $CFG->wwwroot.'/local/js/lib/jquery-ui-1.7.2.custom.min.js', // for color animation
        $CFG->wwwroot.'/course/highlight_category.js'
    ));

    $systemcontext = get_context_instance(CONTEXT_SYSTEM);

    // save editing state
    if ($categoryedit !== -1) {
        $USER->categoryedit = $categoryedit;
    }

    // show we show the editing on/off button?
    $editbutton = has_any_capability(array('moodle/category:manage', 'moodle/course:create'), $systemcontext) ?
        totara_print_edit_button('categoryedit') : '';

    // determine how to display this page
    $adminediting = !empty($USER->categoryedit);


    $stradministration = get_string('administration');
    $strcategories = get_string('categories');
    $strcategory = get_string('category');
    $strcourses = get_string('courses');
    $stredit = get_string('edit');
    $strdelete = get_string('delete');
    $straction = get_string('action');

    add_to_log(SITEID, "course", "view all", "index.php");
/// Unless it's an editing admin, just print the regular listing of courses/categories
    if (!$adminediting) {

    /// Print form for creating new categories
        $countcategories = count_records('course_categories');

        if ($countcategories > 1 || ($countcategories == 1 && count_records('course') > 200)) {
            $strfind = get_string('findcourses', 'local');
            $strcategories = get_string('browsecategories', 'local');
            $strbrowse = get_string('browse', 'local');

            $navlinks = array();
            $navlinks[] = array('name' => $strfind, 'link' => "{$CFG->wwwroot}" . "/course/find.php", 'type' => 'title');
            $navlinks[] = array('name' => $strbrowse,'link'=>'','type'=>'misc');
            $navigation = build_navigation($navlinks);

            print_header("$site->shortname: $strcategories", $strcourses, $navigation, '', '', true, $editbutton);

            print_totara_search('', false, 'category', 0);

            print_heading($strcategories);
            echo skip_main_destination();

        /// Print links to page view type
            prog_print_viewtype_selector('courseindex', $SESSION->viewtype);

            print_box_start('categorybox');

            if($SESSION->viewtype=='program') {
                prog_print_whole_category_list();
            } else {
                print_whole_category_list();
            }

            print_box_end();
        } else {
            $strfulllistofcourses = get_string('fulllistofcourses');
            print_header("$site->shortname: $strfulllistofcourses", $strfulllistofcourses,
                    build_navigation(array(array('name'=>$strfulllistofcourses, 'link'=>'','type'=>'misc'))),
                         '', '', true, $editbutton);
            echo skip_main_destination();

        /// Print links to page view type
            prog_print_viewtype_selector('courseindex', $SESSION->viewtype);

            print_totara_search('', false, 'category', 0);

            print_box_start('courseboxes');

            if($SESSION->viewtype=='program') {
                prog_print_programs(0);
            } else {
                print_courses(0);
            }

            print_box_end();
        }

        echo '<div class="buttons">';
        if (has_capability('moodle/course:create', $systemcontext)) {
        /// Print link to create a new course
        /// Get the 1st available category
            $options = array('category' => $CFG->defaultrequestcategory);
            print_single_button('edit.php', $options, get_string('addnewcourse'), 'get');
        }
        if (has_capability('local/program:createprogram', $systemcontext)) {
        /// Print button to create a new program
            $options = array('category' => $CFG->defaultrequestcategory);
            print_single_button($CFG->wwwroot.'/local/program/add.php', $options, get_string('addnewprogram', 'local_program'), 'get');
        }
        print_course_request_buttons($systemcontext);
        echo '</div>';
        print_footer();
        exit;
    }
/// Everything else is editing on mode.

/// Delete a category.
    if (!empty($delete) and confirm_sesskey()) {
        if (!$deletecat = get_record('course_categories', 'id', $delete)) {
            error('Incorrect category id', 'index.php');
        }
        $context = get_context_instance(CONTEXT_COURSECAT, $delete);
        require_capability('moodle/category:manage', $context);
        require_capability('moodle/category:manage', get_category_or_system_context($deletecat->parent));

        $heading = get_string('deletecategory', '', format_string($deletecat->name));
        require_once('delete_category_form.php');
        $mform = new delete_category_form(null, $deletecat);
        $mform->set_data(array('delete'=>$delete));

        if ($mform->is_cancelled()) {
            redirect('index.php');

        } else if (!$data= $mform->get_data(false)) {
            require_once($CFG->libdir . '/questionlib.php');
            print_category_edit_header($editbutton);
            print_heading($heading);
            $mform->display();
            admin_externalpage_print_footer();
            exit();
        }

        print_category_edit_header($editbutton);
        print_heading($heading);

        if ($data->fulldelete) {
            category_delete_full($deletecat, true);
        } else {
            category_delete_move($deletecat, $data->newparent, true);
        }

        // If we deleted $CFG->defaultrequestcategory, make it point somewhere else.
        if ($delete == $CFG->defaultrequestcategory) {
            set_config('defaultrequestcategory', get_field('course_categories', 'MIN(id)', 'parent', 0));
        }

        print_continue('index.php');

        admin_externalpage_print_footer();
        die;
    }

/// Print headings
    print_category_edit_header($editbutton);

    echo '<div class="buttons">';
    // Print button for creating new categories
    if (has_capability('moodle/category:manage', $systemcontext)) {
        $options = array();
        $options['parent'] = 0;
        print_single_button('editcategory.php', $options, get_string('addnewcategory'), 'get');
    }
    echo '</div>';

    print_totara_search('', false, 'category', 0);
    print_heading(get_string('managecategories'));

    echo '<br />';

/// Create a default category if necessary
    if (!$categories = get_categories()) {    /// No category yet!
        // Try and make one
        unset($tempcat);
        $tempcat->name = get_string('miscellaneous');
        if (!$tempcat->id = insert_record('course_categories', $tempcat)) {
            error('Serious error: Could not create a default category!');
        }
        $tempcat->context = get_context_instance(CONTEXT_COURSECAT, $tempcat->id);
        mark_context_dirty('/'.SYSCONTEXTID);
        fix_course_sortorder(); // Required to build course_categories.depth and .path.
    }

/// Move a category to a new parent if required
    if (!empty($move) and ($moveto >= 0) and confirm_sesskey()) {
        if ($cattomove = get_record('course_categories', 'id', $move)) {
            require_capability('moodle/category:manage', get_category_or_system_context($cattomove->parent));
            if ($cattomove->parent != $moveto) {
                $newparent = get_record('course_categories', 'id', $moveto);
                require_capability('moodle/category:manage', get_category_or_system_context($moveto));
                if (!move_category($cattomove, $newparent)) {
                    notify('Could not update that category!');
                }
            }
        }
    }

/// Hide or show a category
    if ((!empty($hide) or !empty($show)) and confirm_sesskey()) {
        if (!empty($hide)) {
            $tempcat = get_record('course_categories', 'id', $hide);
            $visible = 0;
        } else {
            $tempcat = get_record('course_categories', 'id', $show);
            $visible = 1;
        }
        require_capability('moodle/category:manage', get_category_or_system_context($tempcat->parent));
        if ($tempcat) {
            if (! set_field('course_categories', 'visible', $visible, 'id', $tempcat->id)) {
                notify('Could not update that category!');
            }
            if (! set_field('course', 'visible', $visible, 'category', $tempcat->id)) {
                notify('Could not hide/show any courses in this category !');
            }
        }
    }

/// Move a category up or down
    if ((!empty($moveup) or !empty($movedown)) and confirm_sesskey()) {
        $swapcategory = NULL;
        $movecategory = NULL;

        if (!empty($moveup)) {
            require_capability('moodle/category:manage', get_context_instance(CONTEXT_COURSECAT, $moveup));
            if ($movecategory = get_record('course_categories', 'id', $moveup)) {
                $categories = get_categories($movecategory->parent);

                foreach ($categories as $category) {
                    if ($category->id == $movecategory->id) {
                        break;
                    }
                    $swapcategory = $category;
                }
                unset($category);
            }
        }
        if (!empty($movedown)) {
            require_capability('moodle/category:manage', get_context_instance(CONTEXT_COURSECAT, $movedown));
            if ($movecategory = get_record('course_categories', 'id', $movedown)) {
                $categories = get_categories($movecategory->parent);

                $choosenext = false;
                foreach ($categories as $category) {
                    if ($choosenext) {
                        $swapcategory = $category;
                        break;
                    }
                    if ($category->id == $movecategory->id) {
                        $choosenext = true;
                    }
                }
                unset($category);
            }
        }
        if ($swapcategory and $movecategory) {        // Renumber everything for robustness
            $count=0;
            foreach ($categories as $category) {
                $count++;
                if ($category->id == $swapcategory->id) {
                    $category = $movecategory;
                } else if ($category->id == $movecategory->id) {
                    $category = $swapcategory;
                }
                if (! set_field('course_categories', 'sortorder', $count, 'id', $category->id)) {
                    notify('Could not update that category!');
                }
            }
            unset($category);
        }
    }

/// Find any orphan courses that don't yet have a valid category and set to default
    fix_coursecategory_orphans();

/// Should be a no-op 99% of the cases
    fix_course_sortorder();
    prog_fix_program_sortorder();

    // @todo move this to Manage courses page
    print_course_request_buttons($systemcontext);
    echo '</div>';

/// Print out the categories with all the knobs
    $strname = get_string('name');
    $strcourses = get_string('courses');
    $strprograms = get_string('programs', 'local_program');
    $stredit = get_string('edit');

    $displaylist = array();
    $parentlist = array();

    $displaylist[0] = get_string('top');
    make_categories_list($displaylist, $parentlist);

    $columns = array('categories', 'courses', 'programs');
    $headers = array($strname, $strcourses, $strprograms);
    if ($adminediting) {
        $columns[] = 'actions';
        $headers[] = get_string('actions');
    }

    $table = new flexible_table('course_categories');
    $table->define_columns($columns);
    $table->define_headers($headers);
    $table->set_attribute('class', 'generalbox editcourse boxaligncenter fullwidth');
    $table->setup();
    $table->column_style('courses', 'text-align','center');
    $table->column_style('programs', 'text-align','center');

    build_category_edit($table, NULL, $displaylist, $parentlist);

    $table->print_html();

    echo '<div class="buttons">';
    // @todo move this to Manage courses page
    print_course_request_buttons($systemcontext);
    echo '</div>';

    admin_externalpage_print_footer();


function build_category_edit(&$table, $category, $displaylist, $parentslist, $depth=-1, $up=false, $down=false) {
/// Recursive function to print all the categories ready for editing

    global $CFG, $USER;

    static $str = NULL;

    $highlightid       = optional_param('highlightid', 0, PARAM_INT);

    if (is_null($str)) {
        $str = new stdClass;
        $str->edit     = get_string('edit');
        $str->delete   = get_string('delete');
        $str->moveup   = get_string('moveup');
        $str->movedown = get_string('movedown');
        $str->edit     = get_string('editthiscategory');
        $str->hide     = get_string('hide');
        $str->show     = get_string('show');
        $str->roles    = get_string('assignroles', 'role');
        $str->spacer = '<img src="'.$CFG->wwwroot.'/pix/spacer.gif" class="iconsmall" alt="" /> ';
    }

    if (!empty($category)) {

        if (!isset($category->context)) {
            $category->context = get_context_instance(CONTEXT_COURSECAT, $category->id);
        }

        $tablerow = array();

        $cat_name = '';
        for ($i=0; $i<$depth;$i++) {
            $cat_name .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }
        $linkcss = $category->visible ? '' : ' class="dimmed" ';
        $textcss = $category->visible ? '' : ' class="dimmed_text" ';
        $cat_name .= '<a name="category'.$category->id.'"></a>';
        $cat_name .= '<span class="category image">'.local_coursecategory_icon_tag($category, 'small').'</span>';
        $cat_name .= '<span '.$textcss.'>'.format_string($category->name).'</span>';

        if ($highlightid == $category->id) {
            $tablerow[] = '<div class="itemhighlight">' . $cat_name . '</div>';
        } else {
            $tablerow[] = $cat_name;
        }

        $tablerow[] = '<a '.$linkcss.' href="'.$CFG->wwwroot.'/course/category.php?id='.$category->id.'&amp;viewtype=course">'.$category->coursecount.'</a>';

        $tablerow[] = '<a '.$linkcss.' href="'.$CFG->wwwroot.'/course/category.php?id='.$category->id.'&amp;viewtype=program">'.$category->programcount.'</a>';

        $actions = '';

        if (has_capability('moodle/category:manage', $category->context)) {
            $actions .= '<a title="'.$str->edit.'" href="editcategory.php?id='.$category->id.'"><img'.
                 ' src="'.$CFG->pixpath.'/t/edit.gif" class="iconsmall" alt="'.$str->edit.'" /></a> ';

            $actions .= '<a title="'.$str->roles.'" href="'.$CFG->wwwroot.'/admin/roles/assign.php?contextid='.
                $category->context->id.'"><img src="'.$CFG->pixpath.'/i/roles.gif" class="iconsmall" alt="'.$str->roles.
                '" /></a>';

            $actions .= '<a title="'.$str->delete.'" href="index.php?delete='.$category->id.'&amp;sesskey='.sesskey().'"><img'.
                 ' src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$str->delete.'" /></a> ';

            if (!empty($category->visible)) {
                $actions .= '<a title="'.$str->hide.'" href="index.php?hide='.$category->id.'&amp;sesskey='.sesskey().'"><img'.
                     ' src="'.$CFG->pixpath.'/t/hide.gif" class="iconsmall" alt="'.$str->hide.'" /></a> ';
            } else {
                $actions .= '<a title="'.$str->show.'" href="index.php?show='.$category->id.'&amp;sesskey='.sesskey().'"><img'.
                     ' src="'.$CFG->pixpath.'/t/show.gif" class="iconsmall" alt="'.$str->show.'" /></a> ';
            }

            if ($up) {
                $actions .= '<a title="'.$str->moveup.'" href="index.php?moveup='.$category->id.'&amp;sesskey='.sesskey().'"><img'.
                     ' src="'.$CFG->pixpath.'/t/up.gif" class="iconsmall" alt="'.$str->moveup.'" /></a> ';
            } else {
                $actions .= $str->spacer;
            }
            if ($down) {
                $actions .= '<a title="'.$str->movedown.'" href="index.php?movedown='.$category->id.'&amp;sesskey='.sesskey().'"><img'.
                     ' src="'.$CFG->pixpath.'/t/down.gif" class="iconsmall" alt="'.$str->movedown.'" /></a> ';
            } else {
                $actions .= $str->spacer;
            }
        }
        $tablerow[] = $actions;

        $table->add_data($tablerow);
    } else {
        $category->id = '0';
    }

    if ($categories = get_categories($category->id)) {   // Print all the children recursively
        $countcats = count($categories);
        $count = 0;
        $first = true;
        $last = false;
        foreach ($categories as $cat) {
            $count++;
            if ($count == $countcats) {
                $last = true;
            }
            $up = $first ? false : true;
            $down = $last ? false : true;
            $first = false;

            build_category_edit($table, $cat, $displaylist, $parentslist, $depth+1, $up, $down);
        }
    }
}

function print_category_edit_header($editbutton = '') {
    global $CFG;
    global $SITE;

    require_once($CFG->libdir.'/adminlib.php');
    admin_externalpage_setup('managecategories', $editbutton);
    admin_externalpage_print_header();
}
?>

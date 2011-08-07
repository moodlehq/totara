<?php // $Id$
      // Displays the top level category or all courses
      // In editing mode, allows the admin to edit a category,
      // and rearrange courses

    require_once("../config.php");
    require_once("lib.php");
    require_once($CFG->dirroot."/local/program/lib.php"); // required to display lists of programs
    require_once($CFG->dirroot.'/local/icon/course_icon.class.php');
    require_once($CFG->dirroot.'/local/icon/coursecategory_icon.class.php');
    require_once($CFG->dirroot.'/local/icon/program_icon.class.php');

    $id = required_param('id', PARAM_INT);          // Category id
    $page = optional_param('page', 0, PARAM_INT);     // which page to show
    $perpage = optional_param('perpage', $CFG->coursesperpage, PARAM_INT); // how many per page
    $categoryedit = optional_param('categoryedit', -1, PARAM_BOOL);
    $hide = optional_param('hide', 0, PARAM_INT);
    $show = optional_param('show', 0, PARAM_INT);
    $moveup = optional_param('moveup', 0, PARAM_INT);
    $movedown = optional_param('movedown', 0, PARAM_INT);
    $moveto = optional_param('moveto', 0, PARAM_INT);
    $resort = optional_param('resort', 0, PARAM_BOOL);
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

    if (empty($id)) {
        redirect($CFG->wwwroot.'/course/categorylist.php');
    }

    if (!$context = get_context_instance(CONTEXT_COURSECAT, $id)) {
        error("Category not known!");
    }

    if (!$category = get_record("course_categories", "id", $id)) {
        error("Category not known!");
    }
    if (!$category->visible) {
        require_capability('moodle/category:viewhiddencategories', $context);
    }

    $doanything = has_capability('moodle/site:doanything', get_context_instance(CONTEXT_SYSTEM));

    // save editing state
    if ($categoryedit !== -1) {
        $USER->categoryedit = $categoryedit;
    }

    // show we show the editing on/off button?
    $navbaritem = has_any_capability(array('moodle/category:manage', 'moodle/course:create'), $context) ?
        totara_print_edit_button('categoryedit', array('id' => $category->id, 'viewtype' => $SESSION->viewtype)) : '';

    // determine how to display this page
    $editingon = !empty($USER->categoryedit);

    // Process any category actions.
    if (has_capability('moodle/category:manage', $context)) {
        /// Resort the category if requested
        if ($resort and confirm_sesskey()) {
            if ($courses = get_courses($category->id, "fullname ASC", 'c.id,c.fullname,c.sortorder')) {
                // move it off the range

                $sortorderresult = get_record_sql('SELECT MIN(sortorder) AS min, 1
                                         FROM ' . $CFG->prefix . 'course WHERE category=' . $category->id);
                $sortordermin = $sortorderresult->min;

                $sortorderresult = get_record_sql('SELECT MAX(sortorder) AS max, 1
                                         FROM ' . $CFG->prefix . 'course WHERE category=' . $category->id);
                $sortorder = $sortordermax = $sortorderresult->max + 100;

                //place the courses above the maximum existing sortorder to avoid duplicate index errors
                //after they've been sorted we'll shift them down again
                begin_sql();
                foreach ($courses as $course) {
                    set_field('course', 'sortorder', $sortorder, 'id', $course->id);
                    $sortorder++;
                }
                commit_sql();

                //shift course sortorder back down the amount we moved them up
                execute_sql('UPDATE '. $CFG->prefix .'course SET sortorder = sortorder-'.($sortordermax-$sortordermin).
                        ' WHERE category='.$category->id, false);

                fix_course_sortorder($category->id);
                prog_fix_program_sortorder($category->id);
            }
        }
    }

    if(!empty($CFG->allowcategorythemes) && isset($category->theme)) {
        // specifying theme here saves us some dbqs
        theme_setup($category->theme);
    }

    $course_icon = new course_icon();
    $category_icon = new coursecategory_icon();
    $program_icon = new program_icon();

/// Print headings
    $numcategories = count_records('course_categories');

    $stradministration = get_string('administration');
    $strcategories = get_string('categories');
    $strcategory = get_string('category');
    $strcourses = get_string('courses');

    // determine how to display this page
    $adminediting = !empty($USER->categoryedit);


    $category_breadcrumbs = get_category_breadcrumbs($category->id);

    $navlinks = array();
    if ($adminediting) {
        if ($SESSION->viewtype == 'course') {
            $navlinks[] = array('name' => get_string('managecourses'), 'link' => 'categorylist.php?viewtype=course', 'type' => 'misc');
            $navlinks = array_merge($navlinks, $category_breadcrumbs);
        } else {
            $navlinks[] = array('name' => get_string('manageprograms', 'admin'), 'link' => 'categorylist.php?viewtype=program', 'type' => 'misc');
            $navlinks = array_merge($navlinks, $category_breadcrumbs);
        }
    } else {
        if ($SESSION->viewtype == 'course') {
            $navlinks[] = array('name' => get_string('findcourses', 'local'), 'link' => 'categorylist.php?viewtype=course', 'type'=>'misc');
            $navlinks = array_merge($navlinks, $category_breadcrumbs);
        } else {
            $navlinks[] = array('name' => get_string('findprograms', 'local_program'), 'link' => 'categorylist.php?viewtype=program', 'type'=>'misc');
            $navlinks = array_merge($navlinks, $category_breadcrumbs);
        }
    }

    $navigation = build_navigation($navlinks);

    if ($editingon) {
        // Integrate into the admin tree only if the user can edit categories at the top level,
        // otherwise the admin block does not appear to this user, and you get an error.
        require_once($CFG->libdir.'/adminlib.php');
        $adminpage = ($SESSION->viewtype == 'course') ? 'managecourses' : 'manageprograms';
        admin_externalpage_setup($adminpage, $navbaritem, array('id' => $id,
                'page' => $page, 'perpage' => $perpage), $CFG->wwwroot . '/course/category.php');
        admin_externalpage_print_header('', $navlinks);
    } else {
        print_header_simple("$site->shortname: $category->name", "$site->fullname: $strcourses", $navigation, '', '', true, $navbaritem);
    }

    echo '<div class="toplinks"><a href="' . $CFG->wwwroot . '/course/category.php?id='.$category->parent.'">' . get_string('backtoparent') . '</a>';

    /// Print link to roles
    if (has_capability('moodle/role:assign', $context)) {
        echo '<div class="rolelink"><a href="'.$CFG->wwwroot.'/'.$CFG->admin.'/roles/assign.php?contextid='.
         $context->id.'">'.get_string('assignroles','role').'</a></div>';
    }

    echo '</div>';

    // @todo include parent name ?

    if ($editingon && has_capability('moodle/category:manage', $context)) {
        echo '<div class="buttons">';

        if ($SESSION->viewtype == 'course' &&
            has_capability('moodle/course:create', $context)) {

                /// Print button to create a new course
                unset($options);
                $options['category'] = $category->id;
                print_single_button('edit.php', $options, get_string('addnewcourse'), 'get');
            }

        if ($SESSION->viewtype == 'program' &&
            has_capability('local/program:createprogram', $context)) {
                /// Print button to create a new program
                unset($options);
                $options['category'] = $category->id;
                print_single_button($CFG->wwwroot.'/local/program/add.php', $options, get_string('addnewprogram', 'local_program'), 'get');
            }

        echo '</div>';
    }
    print_totara_search('', false, $SESSION->viewtype, $id);
    print_heading(format_string($category->name), '', 1);

    /// Print current category description
    if (!$editingon && $category->description) {
        print_box_start();
        $options = new stdClass();
        $options->noclean = true;
        $options->para = false;
        echo format_text($category->description, FORMAT_MOODLE, $options); // for multilang filter
        print_box_end();
    }

/// Process any course actions.
    if ($editingon) {

        if($SESSION->viewtype=='course') {

        /// Move a specified course to a new category
            if (!empty($moveto) and $data = data_submitted() and confirm_sesskey()) {   // Some courses are being moved
                // user must have category update in both cats to perform this
                require_capability('moodle/category:manage', $context);
                require_capability('moodle/category:manage', get_context_instance(CONTEXT_COURSECAT, $moveto));

                if (!$destcategory = get_record('course_categories', 'id', $data->moveto)) {
                    error('Error finding the category');
                }

                $courses = array();
                foreach ($data as $key => $value) {
                    if (preg_match('/^c\d+$/', $key)) {
                        $courseid = substr($key, 1);
                        array_push($courses, $courseid);

                        // check this course's category
                        if ($movingcourse = get_record('course', 'id', $courseid)) {
                            if ($movingcourse->category != $id ) {
                                error('The course doesn\'t belong to this category');
                            }
                        } else {
                            error('Error finding the course');
                        }
                    }
                }
                move_courses($courses, $data->moveto);
            }

        /// Hide or show a course
            if ((!empty($hide) or !empty($show)) and confirm_sesskey()) {
                if (!empty($hide)) {
                    $course = get_record('course', 'id', $hide);
                    $visible = 0;
                } else {
                    $course = get_record('course', 'id', $show);
                    $visible = 1;
                }

                if ($course) {
                    $coursecontext = get_context_instance(CONTEXT_COURSE, $course->id);
                    require_capability('moodle/course:visibility', $coursecontext);
                    if (!set_field('course', 'visible', $visible, 'id', $course->id)) {
                        notify('Could not update that course!');
                    }
                }
            }

        /// Move a course up or down
            if ((!empty($moveup) or !empty($movedown)) and confirm_sesskey()) {
                require_capability('moodle/category:manage', $context);
                $movecourse = NULL;
                $swapcourse = NULL;

                // ensure the course order has no gaps and isn't at 0
                fix_course_sortorder($category->id);

                // we are going to need to know the range
                $max = get_record_sql('SELECT MAX(sortorder) AS max, 1
                        FROM ' . $CFG->prefix . 'course WHERE category=' . $category->id);
                $max = $max->max + 100;

                if (!empty($moveup)) {
                    $movecourse = get_record('course', 'id', $moveup);
                    $swapcourse = get_record('course', 'category',  $category->id,
                            'sortorder', $movecourse->sortorder - 1);
                } else {
                    $movecourse = get_record('course', 'id', $movedown);
                    $swapcourse = get_record('course', 'category',  $category->id,
                            'sortorder', $movecourse->sortorder + 1);
                }
                if ($swapcourse and $movecourse) {
                    // check course's category
                    if ($movecourse->category != $id) {
                        error('The course doesn\'t belong to this category');
                    }
                    // Renumber everything for robustness
                    begin_sql();
                    if (!(    set_field('course', 'sortorder', $max, 'id', $swapcourse->id)
                           && set_field('course', 'sortorder', $swapcourse->sortorder, 'id', $movecourse->id)
                           && set_field('course', 'sortorder', $movecourse->sortorder, 'id', $swapcourse->id)
                        )) {
                        notify('Could not update that course!');
                    }
                    commit_sql();
                }

            }

        } else if($SESSION->viewtype=='program') {

        /// Move a specified program to a new category
            if (!empty($moveto) and $data = data_submitted() and confirm_sesskey()) {   // Some programs are being moved
                // user must have category update in both cats to perform this
                require_capability('moodle/category:manage', $context);
                require_capability('moodle/category:manage', get_context_instance(CONTEXT_COURSECAT, $moveto));

                if (!$destcategory = get_record('course_categories', 'id', $data->moveto)) {
                    error('Error finding the category');
                }

                $programs = array();
                foreach ($data as $key => $value) {
                    if (preg_match('/^p\d+$/', $key)) {
                        $programid = substr($key, 1);
                        array_push($programs, $programid);

                        // check this program's category
                        if ($movingprogram = get_record('prog', 'id', $programid)) {
                            if ($movingprogram->category != $id ) {
                                error('The program doesn\'t belong to this category');
                            }
                        } else {
                            error('Error finding the program');
                        }
                    }
                }
                prog_move_programs($programs, $data->moveto);
            }

        /// Hide or show a program
            if ((!empty($hide) or !empty($show)) and confirm_sesskey()) {
                if (!empty($hide)) {
                    $program = get_record('prog', 'id', $hide);
                    $visible = 0;
                } else {
                    $program = get_record('prog', 'id', $show);
                    $visible = 1;
                }

                if ($program) {
                    $programcontext = get_context_instance(CONTEXT_PROGRAM, $program->id);
                    require_capability('local/program:configureprogram', $programcontext);
                    if (!set_field('prog', 'visible', $visible, 'id', $program->id)) {
                        notify('Could not update that program!');
                    }
                }
            }

        /// Move a program up or down
            if ((!empty($moveup) or !empty($movedown)) and confirm_sesskey()) {
                require_capability('moodle/category:manage', $context);
                $moveprogram = NULL;
                $swapprogram = NULL;

                // ensure the course order has no gaps and isn't at 0
                prog_fix_program_sortorder($category->id);

                // we are going to need to know the range
                $max = get_record_sql('SELECT MAX(sortorder) AS max, 1
                        FROM ' . $CFG->prefix . 'prog WHERE category=' . $category->id);
                $max = $max->max + 100;

                if (!empty($moveup)) {
                    $moveprogram = get_record('prog', 'id', $moveup);
                    $swapprogram = get_record('prog', 'category',  $category->id,
                            'sortorder', $moveprogram->sortorder - 1);
                } else {
                    $moveprogram = get_record('prog', 'id', $movedown);
                    $swapprogram = get_record('prog', 'category',  $category->id,
                            'sortorder', $moveprogram->sortorder + 1);
                }
                if ($swapprogram and $moveprogram) {
                    // check program's category
                    if ($moveprogram->category != $id) {
                        error('The program doesn\'t belong to this category');
                    }
                    // Renumber everything for robustness
                    begin_sql();
                    if (!(    set_field('prog', 'sortorder', $max, 'id', $swapprogram->id)
                           && set_field('prog', 'sortorder', $swapprogram->sortorder, 'id', $moveprogram->id)
                           && set_field('prog', 'sortorder', $moveprogram->sortorder, 'id', $swapprogram->id)
                        )) {
                        notify('Could not update that program!');
                    }
                    commit_sql();
                }

            }

        }


    } // End of editing stuff


    /// Print out all the sub-categories
    if ($subcategories = get_records('course_categories', 'parent', $category->id, 'sortorder ASC')) {

        $subcats = get_fieldset_select('course_categories', 'id', 'parent=' . $category->id);
        $item_counts = get_category_item_count($subcats, ($SESSION->viewtype != 'program'));

        $table = new flexible_table('sub_categories');
        $table->define_columns(array('col1', 'col2', 'col3'));
        $table->define_headers(array('', '', ''));
        $table->set_attribute('class', 'nostripes boxaligncenter fullwidth');
        $table->column_style_all('width', '33%');
        $table->setup();
        $tablerow = array();
        foreach ($subcategories as $subcategory) {
            if ($subcategory->visible || $doanything ||
                has_capability('moodle/category:viewhiddencategories', $context)) {

                if (count($tablerow) == 3) {
                    $table->add_data($tablerow);
                    $tablerow = array();
                }

                $catlinkcss = $subcategory->visible ? '' : 'class="dimmed" ';
                $item_count = array_key_exists($subcategory->id, $item_counts) ? $item_counts[$subcategory->id] : 0;

                // don't show empty sub-categories unless viewing as admin
                if (!$editingon && $item_count == 0) {
                    continue;
                }

                $tablerow[] = '<a '.$catlinkcss.' href="category.php?id='.$subcategory->id.'">'.
                     $category_icon->display($subcategory, 'small') .format_string($subcategory->name).' ('.$item_count.')</a>';
            }
        }
        // add the last row
        if (count($tablerow) > 0) {
            $table->add_data($tablerow);
        }

        // only show sub-categories section if there are some
        if (!empty($table->data)) {
            print_heading(get_string('subcategories'), '', 3);
            $table->print_html();
        }
    }


/// Print out all the courses
    if($SESSION->viewtype=='course') {

        $courses = get_courses_page($category->id, 'c.sortorder ASC',
                'c.id,c.sortorder,c.shortname,c.fullname,c.summary,c.visible,c.teacher,c.guest,c.password',
                $totalcount, $page*$perpage, $perpage);

        $numcourses = count($courses);

        // just using this to get the total program count
        $progs = prog_get_programs_page($category->id, 'sortorder ASC',
                'p.id, p.visible', $totalprogcount, 0, 1);
        if ($totalprogcount) {
            echo '<p class="course-prog-alt-view"><a href="'. $CFG->wwwroot . '/course/category.php?id='.$category->id.'&amp;viewtype=program">'.get_string('orviewprograms', 'local_program', $totalprogcount).'</a></p>';
        }

        print_heading(get_string('coursesinthiscategory', 'moodle', $totalcount), '', 3);

        if (!$courses) {
            echo '<p>' . get_string("nocoursesyet") . '</p>';

        } else if ($numcourses <= COURSE_MAX_SUMMARIES_PER_PAGE and !$page and !$editingon) {
            print_box_start('courseboxes');
            print_courses($category);
            print_box_end();

        } else {
            print_paging_bar($totalcount, $page, $perpage, "category.php?id=$category->id&amp;perpage=$perpage&amp;");

            $strcourses = get_string('courses');
            $strselect = get_string('select');
            $stredit = get_string('edit');
            $strdelete = get_string('delete');
            $strbackup = get_string('backup');
            $strrestore = get_string('restore');
            $strmoveup = get_string('moveup');
            $strmovedown = get_string('movedown');
            $strupdate = get_string('update');
            $strhide = get_string('hide');
            $strshow = get_string('show');
            $strsummary = get_string('summary');
            $strsettings = get_string('settings');
            $strassignteachers = get_string('assignteachers');
            $strallowguests = get_string('allowguests');
            $strrequireskey = get_string('requireskey');


            echo '<form id="movecourses" action="category.php" method="post"><div>';
            echo '<input type="hidden" name="sesskey" value="'.sesskey().'" />';
            echo '<table border="0" cellspacing="2" cellpadding="4" class="generalbox boxaligncenter"><tr>';
            echo '<th class="header" scope="col">'.$strcourses.'</th>';
            if ($editingon) {
                echo '<th class="header" scope="col">'.$stredit.'</th>';
                echo '<th class="header" scope="col">'.$strselect.'</th>';
            } else {
                echo '<th class="header" scope="col">&nbsp;</th>';
            }
            echo '</tr>';


            $count = 0;
            $abletomovecourses = false;  // for now

            // Checking if we are at the first or at the last page, to allow courses to
            // be moved up and down beyond the paging border
            if ($totalcount > $perpage) {
                $atfirstpage = ($page == 0);
                if ($perpage > 0) {
                    $atlastpage = (($page + 1) == ceil($totalcount / $perpage));
                } else {
                    $atlastpage = true;
                }
            } else {
                $atfirstpage = true;
                $atlastpage = true;
            }

            $spacer = '<img src="'.$CFG->wwwroot.'/pix/spacer.gif" class="iconsmall" alt="" /> ';
            foreach ($courses as $acourse) {
                if (isset($acourse->context)) {
                    $coursecontext = $acourse->context;
                } else {
                    $coursecontext = get_context_instance(CONTEXT_COURSE, $acourse->id);
                }

                $count++;
                $up = ($count > 1 || !$atfirstpage);
                $down = ($count < $numcourses || !$atlastpage);

                $linkcss = $acourse->visible ? '' : ' class="dimmed" ';
                echo '<tr>';
                echo '<td>'. $course_icon->display($acourse, 'small'). '<a '.$linkcss.' href="view.php?id='.$acourse->id.'">'. format_string($acourse->fullname) .'</a></td>';
                if ($editingon) {
                    echo '<td>';
                    if (has_capability('moodle/course:update', $coursecontext)) {
                        echo '<a title="'.$strsettings.'" href="'.$CFG->wwwroot.'/course/edit.php?id='.$acourse->id.'">'.
                                '<img src="'.$CFG->pixpath.'/t/edit.gif" class="iconsmall" alt="'.$stredit.'" /></a> ';
                    } else {
                        echo $spacer;
                    }

                    // role assignment link
                    if (has_capability('moodle/role:assign', $coursecontext)) {
                        echo '<a title="'.get_string('assignroles', 'role').'" href="'.$CFG->wwwroot.'/'.$CFG->admin.'/roles/assign.php?contextid='.$coursecontext->id.'">'.
                                '<img src="'.$CFG->pixpath.'/i/roles.gif" class="iconsmall" alt="'.get_string('assignroles', 'role').'" /></a> ';
                    } else {
                        echo $spacer;
                    }

                    if (can_delete_course($acourse->id)) {
                        echo '<a title="'.$strdelete.'" href="delete.php?id='.$acourse->id.'">'.
                                '<img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$strdelete.'" /></a> ';
                    } else {
                        echo $spacer;
                    }

                    // MDL-8885, users with no capability to view hidden courses, should not be able to lock themselves out
                    if (has_capability('moodle/course:visibility', $coursecontext) && has_capability('moodle/course:viewhiddencourses', $coursecontext)) {
                        if (!empty($acourse->visible)) {
                            echo '<a title="'.$strhide.'" href="category.php?id='.$category->id.'&amp;page='.$page.
                                '&amp;perpage='.$perpage.'&amp;hide='.$acourse->id.'&amp;sesskey='.$USER->sesskey.'">'.
                                '<img src="'.$CFG->pixpath.'/t/hide.gif" class="iconsmall" alt="'.$strhide.'" /></a> ';
                        } else {
                            echo '<a title="'.$strshow.'" href="category.php?id='.$category->id.'&amp;page='.$page.
                                '&amp;perpage='.$perpage.'&amp;show='.$acourse->id.'&amp;sesskey='.$USER->sesskey.'">'.
                                '<img src="'.$CFG->pixpath.'/t/show.gif" class="iconsmall" alt="'.$strshow.'" /></a> ';
                        }
                    } else {
                        echo $spacer;
                    }

                    if (has_capability('moodle/site:backup', $coursecontext)) {
                        echo '<a title="'.$strbackup.'" href="../backup/backup.php?id='.$acourse->id.'">'.
                                '<img src="'.$CFG->pixpath.'/t/backup.gif" class="iconsmall" alt="'.$strbackup.'" /></a> ';
                    } else {
                        echo $spacer;
                    }

                    if (has_capability('moodle/site:restore', $coursecontext)) {
                        echo '<a title="'.$strrestore.'" href="../files/index.php?id='.$acourse->id.
                             '&amp;wdir=/backupdata">'.
                             '<img src="'.$CFG->pixpath.'/t/restore.gif" class="iconsmall" alt="'.$strrestore.'" /></a> ';
                    } else {
                        echo $spacer;
                    }

                    if (has_capability('moodle/category:manage', $context)) {
                        if ($up) {
                            echo '<a title="'.$strmoveup.'" href="category.php?id='.$category->id.'&amp;page='.$page.
                                 '&amp;perpage='.$perpage.'&amp;moveup='.$acourse->id.'&amp;sesskey='.$USER->sesskey.'">'.
                                 '<img src="'.$CFG->pixpath.'/t/up.gif" class="iconsmall" alt="'.$strmoveup.'" /></a> ';
                        } else {
                            echo $spacer;
                        }

                        if ($down) {
                            echo '<a title="'.$strmovedown.'" href="category.php?id='.$category->id.'&amp;page='.$page.
                                 '&amp;perpage='.$perpage.'&amp;movedown='.$acourse->id.'&amp;sesskey='.$USER->sesskey.'">'.
                                 '<img src="'.$CFG->pixpath.'/t/down.gif" class="iconsmall" alt="'.$strmovedown.'" /></a> ';
                        } else {
                            echo $spacer;
                        }
                        $abletomovecourses = true;
                    } else {
                        echo $spacer, $spacer;
                    }

                    echo '</td>';
                    echo '<td align="center">';
                    echo '<input type="checkbox" name="c'.$acourse->id.'" />';
                    echo '</td>';
                } else {
                    echo '<td align="right">';
                    if (!empty($acourse->guest)) {
                        echo '<a href="view.php?id='.$acourse->id.'"><img title="'.
                             $strallowguests.'" class="icon" src="'.
                             $CFG->pixpath.'/i/guest.gif" alt="'.$strallowguests.'" /></a>';
                    }
                    if (!empty($acourse->password)) {
                        echo '<a href="view.php?id='.$acourse->id.'"><img title="'.
                             $strrequireskey.'" class="icon" src="'.
                             $CFG->pixpath.'/i/key.gif" alt="'.$strrequireskey.'" /></a>';
                    }
                    if (!empty($acourse->summary)) {
                        link_to_popup_window ("/course/info.php?id=$acourse->id", "courseinfo",
                                              '<img alt="'.get_string('info').'" class="icon" src="'.$CFG->pixpath.'/i/info.gif" />',
                                               400, 500, $strsummary);
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }

            if ($abletomovecourses) {
                $movetocategories = array();
                $notused = array();
                make_categories_list($movetocategories, $notused, 'moodle/category:manage');
                $movetocategories[$category->id] = get_string('moveselectedcoursesto');
                echo '<tr><td colspan="3" align="right">';
                choose_from_menu($movetocategories, 'moveto', $category->id, '', "javascript:submitFormById('movecourses')");
                echo '<input type="hidden" name="id" value="'.$category->id.'" />';
                echo '</td></tr>';
            }

            echo '</table>';
            echo '</div></form>';
            echo '<br />';
        }

/// Print out all the programs
    } else if ($SESSION->viewtype=='program') {

        $programs = prog_get_programs_page($category->id, 'sortorder ASC',
                'p.id,p.sortorder,p.shortname,p.fullname,p.summary,p.visible',
                $totalcount, $page*$perpage, $perpage);

        $numprograms = count($programs);

        ///

        // just using this to get the total course count
        $courses = get_courses_page($category->id, 'c.sortorder ASC',
                'c.id,c.visible',
                $totalcoursecount, 0, 1);

        if ($totalcoursecount) {
            echo '<p class="course-prog-alt-view"><a href="'. $CFG->wwwroot . '/course/category.php?id='.$category->id.'&amp;viewtype=course">'.get_string('orviewcourses', 'moodle', $totalcoursecount).'</a></p>';
        }

        print_heading(get_string('programsinthiscategory', 'local_program', $totalcount), '', 3);

        ///
        if (!$programs) {
            echo '<p>' . get_string('noprogramsyet', 'local_program') . '</p>';

        } else if ($numprograms <= COURSE_MAX_SUMMARIES_PER_PAGE and !$page and !$editingon) {
            print_box_start('courseboxes');
            prog_print_programs($category);
            print_box_end();

        } else {
            print_paging_bar($totalcount, $page, $perpage, "category.php?id=$category->id&amp;perpage=$perpage&amp;");

            $strprograms = get_string('programs', 'local_program');
            $strselect = get_string('select');
            $stredit = get_string('edit');
            $strdelete = get_string('delete');
            $strbackup = get_string('backup');
            $strrestore = get_string('restore');
            $strmoveup = get_string('moveup');
            $strmovedown = get_string('movedown');
            $strupdate = get_string('update');
            $strhide = get_string('hide');
            $strshow = get_string('show');
            $strsummary = get_string('summary');
            $strsettings = get_string('settings');

            echo '<form id="moveprograms" action="category.php" method="post"><div>';
            echo '<input type="hidden" name="sesskey" value="'.sesskey().'" />';
            echo '<input type="hidden" name="viewtype" value="program" />';
            echo '<table border="0" cellspacing="2" cellpadding="4" class="generalbox boxaligncenter"><tr>';
            echo '<th class="header" scope="col">'.$strprograms.'</th>';
            if ($editingon) {
                echo '<th class="header" scope="col">'.$stredit.'</th>';
                echo '<th class="header" scope="col">'.$strselect.'</th>';
            } else {
                echo '<th class="header" scope="col">&nbsp;</th>';
            }
            echo '</tr>';

            $count = 0;
            $abletomoveprograms = false;  // for now

            // Checking if we are at the first or at the last page, to allow programs to
            // be moved up and down beyond the paging border
            if ($totalcount > $perpage) {
                $atfirstpage = ($page == 0);
                if ($perpage > 0) {
                    $atlastpage = (($page + 1) == ceil($totalcount / $perpage));
                } else {
                    $atlastpage = true;
                }
            } else {
                $atfirstpage = true;
                $atlastpage = true;
            }

            $spacer = '<img src="'.$CFG->wwwroot.'/pix/spacer.gif" class="iconsmall" alt="" /> ';
            foreach ($programs as $aprogram) {
                if (isset($aprogram->context)) {
                    $programcontext = $aprogram->context;
                } else {
                    $programcontext = get_context_instance(CONTEXT_PROGRAM, $aprogram->id);
                }

                $count++;
                $up = ($count > 1 || !$atfirstpage);
                $down = ($count < $numprograms || !$atlastpage);

                $linkcss = $aprogram->visible ? '' : ' class="dimmed" ';
                echo '<tr>';
                echo '<td>'. $program_icon->display($aprogram, 'small'). '<a '.$linkcss.' href="'.$CFG->wwwroot.'/local/program/view.php?id='.$aprogram->id.'">'. format_string($aprogram->fullname) .'</a></td>';
                if ($editingon) {
                    echo '<td>';
                    if (has_capability('local/program:configureprogram', $programcontext)) {
                        echo '<a title="'.$strsettings.'" href="'.$CFG->wwwroot.'/local/program/edit.php?id='.$aprogram->id.'">'.
                                '<img src="'.$CFG->pixpath.'/t/edit.gif" class="iconsmall" alt="'.$stredit.'" /></a> ';
                    } else {
                        echo $spacer;
                    }

                    if (has_capability('local/program:configureprogram', $programcontext)) {
                        echo '<a title="'.$strdelete.'" href="'.$CFG->wwwroot.'/local/program/edit.php?id='.$aprogram->id.'&amp;action=delete">'.
                                '<img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$strdelete.'" /></a> ';
                    } else {
                        echo $spacer;
                    }

                    // users with no capability to view hidden programs should not be able to lock themselves out
                    if (has_capability('local/program:configureprogram', $programcontext) && has_capability('local/program:viewhiddenprograms', $programcontext)) {
                        if (!empty($aprogram->visible)) {
                            echo '<a title="'.$strhide.'" href="category.php?id='.$category->id.'&amp;page='.$page.
                                '&amp;perpage='.$perpage.'&amp;hide='.$aprogram->id.'&amp;sesskey='.$USER->sesskey.'&amp;viewtype=program">'.
                                '<img src="'.$CFG->pixpath.'/t/hide.gif" class="iconsmall" alt="'.$strhide.'" /></a> ';
                        } else {
                            echo '<a title="'.$strshow.'" href="category.php?id='.$category->id.'&amp;page='.$page.
                                '&amp;perpage='.$perpage.'&amp;show='.$aprogram->id.'&amp;sesskey='.$USER->sesskey.'&amp;viewtype=program">'.
                                '<img src="'.$CFG->pixpath.'/t/show.gif" class="iconsmall" alt="'.$strshow.'" /></a> ';
                        }
                    } else {
                        echo $spacer;
                    }

                    if (has_capability('moodle/category:manage', $context)) {
                        if ($up) {
                            echo '<a title="'.$strmoveup.'" href="category.php?id='.$category->id.'&amp;page='.$page.
                                 '&amp;perpage='.$perpage.'&amp;moveup='.$aprogram->id.'&amp;sesskey='.$USER->sesskey.'&amp;viewtype=program">'.
                                 '<img src="'.$CFG->pixpath.'/t/up.gif" class="iconsmall" alt="'.$strmoveup.'" /></a> ';
                        } else {
                            echo $spacer;
                        }

                        if ($down) {
                            echo '<a title="'.$strmovedown.'" href="category.php?id='.$category->id.'&amp;page='.$page.
                                 '&amp;perpage='.$perpage.'&amp;movedown='.$aprogram->id.'&amp;sesskey='.$USER->sesskey.'&amp;viewtype=program">'.
                                 '<img src="'.$CFG->pixpath.'/t/down.gif" class="iconsmall" alt="'.$strmovedown.'" /></a> ';
                        } else {
                            echo $spacer;
                        }
                        $abletomoveprograms = true;
                    } else {
                        echo $spacer, $spacer;
                    }

                    echo '</td>';
                    echo '<td align="center">';
                    echo '<input type="checkbox" name="p'.$aprogram->id.'" />';
                    echo '</td>';
                } else {
                    echo '<td align="right">';

                    if (!empty($aprogram->summary)) {
                        link_to_popup_window ("/local/program/info.php?id=$aprogram->id", "programinfo",
                                              '<img alt="'.get_string('info').'" class="icon" src="'.$CFG->pixpath.'/i/info.gif" />',
                                               400, 500, $strsummary);
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }

            if ($abletomoveprograms) {
                $movetocategories = array();
                $notused = array();
                make_categories_list($movetocategories, $notused, 'moodle/category:manage');
                $movetocategories[$category->id] = get_string('moveselectedprogramsto', 'local_program');
                echo '<tr><td colspan="3" align="right">';
                choose_from_menu($movetocategories, 'moveto', $category->id, '', "javascript:submitFormById('moveprograms')");
                echo '<input type="hidden" name="id" value="'.$category->id.'" />';
                echo '</td></tr>';
            }

            echo '</table>';
            echo '</div></form>';
            echo '<br />';
        }

    } // End of print list of programs

    if ($editingon) {
        echo '<div class="buttons">';
        // @todo decide what to do with these buttons
        if ($SESSION->viewtype=='course' and has_capability('moodle/category:manage', $context) and $numcourses > 1) {
        /// Print button to re-sort courses by name
            unset($options);
            $options['id'] = $category->id;
            $options['resort'] = 'name';
            $options['sesskey'] = $USER->sesskey;
            print_single_button('category.php', $options, get_string('resortcoursesbyname'), 'get');
        }

        if (!empty($CFG->enablecourserequests) && $category->id == $CFG->enablecourserequests) {
            print_course_request_buttons(get_context_instance(CONTEXT_SYSTEM));
        }
        echo '</div>';
    }

    print_footer();

?>

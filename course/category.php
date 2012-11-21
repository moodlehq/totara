<?php
      // Displays the top level category or all courses
      // In editing mode, allows the admin to edit a category,
      // and rearrange courses

    require_once("../config.php");
    require_once("lib.php");
    require_once($CFG->dirroot.'/totara/coursecatalog/lib.php');
    require_once($CFG->dirroot.'/totara/program/lib.php');
    require_once($CFG->libdir.'/textlib.class.php');

    $id = required_param('id', PARAM_INT); // Category id
    $page = optional_param('page', 0, PARAM_INT); // which page to show
    $categoryedit = optional_param('categoryedit', -1, PARAM_BOOL);
    $hide = optional_param('hide', 0, PARAM_INT);
    $show = optional_param('show', 0, PARAM_INT);
    $moveup = optional_param('moveup', 0, PARAM_INT);
    $movedown = optional_param('movedown', 0, PARAM_INT);
    $moveto = optional_param('moveto', 0, PARAM_INT);
    $resort = optional_param('resort', 0, PARAM_BOOL);
    $viewtype = optional_param('viewtype', 'course', PARAM_TEXT);

    // MDL-27824 - This is a temporary fix until we have the proper
    // way to check/initialize $CFG value.
    // @todo MDL-35138 remove this temporary solution
    if (!empty($CFG->coursesperpage)) {
        $defaultperpage =  $CFG->coursesperpage;
    } else {
        $defaultperpage = 20;
    }
    $perpage = optional_param('perpage', $defaultperpage, PARAM_INT); // how many per page

    $site = get_site();

    if (empty($id)) {
        redirect($CFG->wwwroot.'/course/categorylist.php?viewtype='.$viewtype);
    }

    // Set the view type as a session value so that either courses or programs
    // are displayed by default
    if ($viewtype == 'program') {
        $SESSION->viewtype = 'program';
        $PAGE->set_totara_menu_selected('program');
    } else if ($viewtype == 'course' || empty($SESSION->viewtype)) {
        $SESSION->viewtype = 'course';
        $PAGE->set_totara_menu_selected('course');
    }

    $PAGE->set_category_by_id($id);
    $urlparams = array('id' => $id);
    if ($page) {
        $urlparams['page'] = $page;
    }
    if ($perpage) {
        $urlparams['perpage'] = $perpage;
    }
    $PAGE->set_url(new moodle_url('/course/category.php', array('id' => $id)));
    navigation_node::override_active_url($PAGE->url);
    $context = context_coursecat::instance($id);
    $category = $PAGE->category;

    // save editing state
    if ($categoryedit !== -1) {
        $USER->categoryedit = $categoryedit;
    }
    $editingon = !empty($USER->categoryedit);

    $systemcontext = context_system::instance();

    $canmanagesitecourses = has_any_capability(array('moodle/course:create', 'moodle/course:update'), $systemcontext);
    $canmanagesiteprograms = has_any_capability(array('totara/program:createprogram', 'totara/program:configureprogram'), $systemcontext);

    $canmanagethesecourses = has_any_capability(array('moodle/course:create', 'moodle/course:update'), $context);
    $canmanagetheseprograms = has_any_capability(array('totara/program:createprogram', 'totara/program:configureprogram'), $context);

    $canmanagecategories = has_capability('moodle/category:manage', $context);
    $canedit = (($SESSION->viewtype == 'course' && $canmanagethesecourses) ||
         ($SESSION->viewtype == 'program' && $canmanagetheseprograms));

    $isediting = ($editingon && $canedit);

    $isadmin = (($SESSION->viewtype == 'course' && $canmanagesitecourses) ||
         ($SESSION->viewtype == 'program' && $canmanagesiteprograms));

    // should we show the editing on/off button?
    $editbutton = $canedit ? totara_print_edit_button('categoryedit', array('id' => $category->id, 'viewtype' => $SESSION->viewtype)) : '';

    // Process any category actions.
    if ($canmanagecategories) {
        /// Resort the category if requested
        if ($resort and confirm_sesskey()) {
            if ($courses = get_courses($category->id, '', 'c.id,c.fullname,c.sortorder')) {
                collatorlib::asort_objects_by_property($courses, 'fullname');

                // move it off the range
                $sortorderresult = $DB->get_record_sql('SELECT MIN(sortorder) AS min, 1
                                                          FROM {course} WHERE category = ?', array($category->id));
                $sortordermin = $sortorderresult->min;
                $sortorderresult = $DB->get_record_sql('SELECT MAX(sortorder) AS max, 1
                                                          FROM {course} WHERE category = ?', array($category->id));
                $sortorder = $sortordermax = $sortorderresult->max + 100;

                //place the courses above the maximum existing sortorder to avoid duplicate index errors
                //after they've been sorted we'll shift them down again
                $transaction = $DB->start_delegated_transaction();
                foreach ($courses as $course) {
                    $DB->set_field('course', 'sortorder', $sortorder, array('id' => $course->id));
                    $sortorder++;
                }
                $transaction->allow_commit();

                //shift course sortorder back down the amount we moved them up
                $DB->execute('UPDATE {course}
                                 SET sortorder = sortorder - ?
                               WHERE category = ?', array(($sortordermax-$sortordermin), $category->id));
                fix_course_sortorder($category->id);
                prog_fix_program_sortorder($category->id);
            }
        }
    }

    // Process any course actions.
    if ($isediting) {
        if ($SESSION->viewtype=='course') {
            /// Move a specified course to a new category
            if (!empty($moveto) and $data = data_submitted() and confirm_sesskey()) {   // Some courses are being moved
                // user must have category update in both cats to perform this
                require_capability('moodle/category:manage', $context);
                require_capability('moodle/category:manage', context_coursecat::instance($moveto));

                if (!$destcategory = $DB->get_record('course_categories', array('id' => $data->moveto))) {
                    print_error('cannotfindcategory', '', '', $data->moveto);
                }

                $courses = array();
                foreach ($data as $key => $value) {
                    if (preg_match('/^c\d+$/', $key)) {
                        $courseid = substr($key, 1);
                        array_push($courses, $courseid);

                        // check this course's category
                        if ($movingcourse = $DB->get_record('course', array('id'=>$courseid))) {
                            if ($movingcourse->category != $id ) {
                                print_error('coursedoesnotbelongtocategory');
                            }
                        } else {
                            print_error('cannotfindcourse');
                        }
                    }
                }
                move_courses($courses, $data->moveto);
            }

            /// Hide or show a course
            if ((!empty($hide) or !empty($show)) and confirm_sesskey()) {
                if (!empty($hide)) {
                    $course = $DB->get_record('course', array('id' => $hide));
                    $visible = 0;
                } else {
                    $course = $DB->get_record('course', array('id' => $show));
                    $visible = 1;
                }

                if ($course) {
                    $coursecontext = context_course::instance($course->id);
                    require_capability('moodle/course:visibility', $coursecontext);
                    $DB->set_field('course', 'visible', $visible, array('id' => $course->id));
                    $DB->set_field('course', 'visibleold', $visible, array('id' => $course->id)); // we set the old flag when user manually changes visibility of course
                }
            }


            /// Move a course up or down
            if ((!empty($moveup) or !empty($movedown)) and confirm_sesskey()) {
                require_capability('moodle/category:manage', $context);

                // Ensure the course order has continuous ordering
                fix_course_sortorder();
                $swapcourse = NULL;

                if (!empty($moveup)) {
                    if ($movecourse = $DB->get_record('course', array('id' => $moveup))) {
                        $swapcourse = $DB->get_record('course', array('sortorder' => $movecourse->sortorder - 1));
                    }
                } else {
                    if ($movecourse = $DB->get_record('course', array('id' => $movedown))) {
                        $swapcourse = $DB->get_record('course', array('sortorder' => $movecourse->sortorder + 1));
                    }
                }
                if ($swapcourse and $movecourse) {
                    // check course's category
                    if ($movecourse->category != $id) {
                        print_error('coursedoesnotbelongtocategory');
                    }
                    $DB->set_field('course', 'sortorder', $swapcourse->sortorder, array('id' => $movecourse->id));
                    $DB->set_field('course', 'sortorder', $movecourse->sortorder, array('id' => $swapcourse->id));
                }
            }

        } else if ($SESSION->viewtype=='program') {
            /// Move a specified program to a new category
            if (!empty($moveto) and $data = data_submitted() and confirm_sesskey()) {
                // Some programs are being moved
                // user must have category update in both cats to perform this
                require_capability('moodle/category:manage', $context);
                require_capability('moodle/category:manage', context_coursecat::instance($moveto));
                if (!$destcategory = $DB->get_record('course_categories', array('id' => $data->moveto))) {
                    print_error('errorfindingcategory', 'totara_core');
                }

                $programs = array();
                foreach ($data as $key => $value) {
                    if (preg_match('/^p\d+$/', $key)) {
                        $programid = substr($key, 1);
                        array_push($programs, $programid);
                        // check this program's category
                        if ($movingprogram = $DB->get_record('prog', array('id' => $programid))) {
                            if ($movingprogram->category != $id ) {
                                print_error('programdoesntbelongcat', 'totara_core');
                            }
                        } else {
                            print_error('errorfindingprogram', 'totara_core');
                        }
                    }
                }
                prog_move_programs($programs, $data->moveto);
            }

            /// Hide or show a program
            if ((!empty($hide) or !empty($show)) and confirm_sesskey()) {
                if (!empty($hide)) {
                    $program = $DB->get_record('prog', array('id' => $hide));
                    $visible = 0;
                } else {
                    $program = $DB->get_record('prog', array('id' => $show));
                    $visible = 1;
                }

                if ($program) {
                    $programcontext = context_program::instance($program->id);
                    require_capability('totara/program:configureprogram', $programcontext);
                    if (!$DB->set_field('prog', 'visible', $visible, array('id' => $program->id))) {
                        $OUTPUT->notification(get_string('programupdatefail', 'totara_program'));
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
                $max = $DB->get_record_sql('SELECT MAX(sortorder) AS max, 1
                                              FROM {prog}
                                             WHERE category = ?', array($category->id));
                $max = $max->max + 100;
                if (!empty($moveup)) {
                    $moveprogram = $DB->get_record('prog', array('id' => $moveup));
                    $swapprogram = $DB->get_record('prog', array('category' => $category->id, 'sortorder' => ($moveprogram->sortorder - 1)));
                } else {
                    $moveprogram = $DB->get_record('prog', array('id' => $movedown));
                    $swapprogram = $DB->get_record('prog', array('category' => $category->id, 'sortorder' => ($moveprogram->sortorder + 1)));
                }
                if ($swapprogram and $moveprogram) {
                    // check program's category
                    if ($moveprogram->category != $id) {
                        print_error('programdoesntbelongcat', 'totara_core');
                    }
                    // Renumber everything for robustness
                    $transaction = $DB->start_delegated_transaction();
                    if (!($DB->set_field('prog', 'sortorder', $max, array('id' => $swapprogram->id))
                    && $DB->set_field('prog', 'sortorder', $swapprogram->sortorder, array('id' => $moveprogram->id))
                    && $DB->set_field('prog', 'sortorder', $moveprogram->sortorder, array('id'=> $swapprogram->id))
                    )) {
                        $OUTPUT->notification(get_string('programupdatefail', 'totara_program'));
                    }
                    $transaction->allow_commit();
                }

            }

        } //end if viewtype is course or program

    } // End of editing stuff

    // Print headings
    $numcategories = $DB->count_records('course_categories');

    $stradministration = get_string('administration');
    $strcategories = get_string('categories');
    $strcategory = get_string('category');
    $strcourses = get_string('courses');

    $buttoncontainer = null;

    if ($editingon && can_edit_in_category($id)) {
        $buttoncontainer = $OUTPUT->container_start();
        if ($SESSION->viewtype == 'course' && has_capability('moodle/course:create', $context)) {
            /// Print button to create a new course
            $options = array();
            $options['category'] = $category->id;
            $options['returnto'] = 'category';
            $options['viewtype'] = 'course';
            $buttoncontainer .= $OUTPUT->single_button(new moodle_url('/course/edit.php', $options), get_string('addnewcourse'), 'get');
        }
        if ($SESSION->viewtype == 'program' && has_capability('totara/program:createprogram', $context)) {
            /// Print button to create a new program
            $options = array();
            $options['category'] = $category->id;
            $options['returnto'] = 'category';
            $options['viewtype'] = 'program';
            $buttoncontainer .= $OUTPUT->single_button(new moodle_url('/totara/program/add.php', $options), get_string('addnewprogram', 'totara_program'), 'get');
        }
        $buttoncontainer .= $OUTPUT->container_end();
        // Integrate into the admin tree only if the user can edit categories at the top level,
        // otherwise the admin block does not appear to this user, and you get an error.
        if (has_capability('moodle/category:manage', $context)) {
            require_once($CFG->libdir . '/adminlib.php');
            admin_externalpage_setup('managecategories', $editbutton, $urlparams, $CFG->wwwroot . '/course/category.php');
            $PAGE->set_context($context);   // Ensure that we are actually showing blocks etc for the cat context
            $settingsnode = $PAGE->settingsnav->find_active_node();
            if ($settingsnode) {
                $settingsnode->make_inactive();
                $settingsnode->force_open();
                $PAGE->navbar->add($settingsnode->text, $settingsnode->action);
            }
        } else {
            //cannot manage categories but may have course or program create/update capabilities
            $PAGE->set_title("$site->shortname: $category->name");
            $PAGE->set_heading($site->fullname);
            $PAGE->set_context($context);
            $PAGE->set_button($editbutton);
            $PAGE->set_pagelayout('coursecategory');
        }
        echo $OUTPUT->header();
    } else {
        $PAGE->set_title("$site->shortname: $category->name");
        $PAGE->set_heading($site->fullname);
        $PAGE->set_button($editbutton);
        $PAGE->set_pagelayout('coursecategory');
        echo $OUTPUT->header();
    }

    echo $OUTPUT->container(html_writer::link(new moodle_url('/course/category.php', array('id' => $category->parent, 'viewtype' => $SESSION->viewtype)), get_string('backtoparent','totara_coursecatalog')), 'toplinks');
    /// Print current category description
    if (!$isediting && $category->description) {
        echo $OUTPUT->box_start();
        $options = new stdClass;
        $options->noclean = true;
        $options->para = false;
        $options->overflowdiv = true;
        if (!isset($category->descriptionformat)) {
            $category->descriptionformat = FORMAT_MOODLE;
        }
        $text = file_rewrite_pluginfile_urls($category->description, 'pluginfile.php', $context->id, 'coursecat', 'description', null);
        echo format_text($text, $category->descriptionformat, $options);
        echo $OUTPUT->box_end();
    }

    //print a 'toolbar' table with search and editing options
    $stralllink = get_string('viewall' . $viewtype . 's', 'totara_coursecatalog');
    echo '<table border="0" class="generalbox totaratable fullwidth boxaligncenter">';
    $toolbar = array('top' => array());
    $toolbar['top'][0] = array();
    $toolbar['top'][0]['left'] = array(print_totara_search('', false, $SESSION->viewtype, 0));
    if ($buttoncontainer) {
        $toolbar['top'][0]['right'] = array($buttoncontainer);
    }
    $toolbar['top'][1]['left'] = array(html_writer::link(new moodle_url('/course/search.php', array('category' => '0', 'viewtype' => $SESSION->viewtype, 'search' => '')), $stralllink));
    $renderer = $PAGE->get_renderer('totara_core');
    $renderer->print_toolbars('top', 2, $toolbar['top']);
    echo '</table>';

    // Print out all the sub-categories
    if ($subcategories = $DB->get_records('course_categories', array('parent' => $category->id), 'sortorder ASC')) {
        $subcats = $DB->get_fieldset_select('course_categories', 'id', 'parent = ?', array($category->id));
        $item_counts = totara_get_category_item_count($subcats, ($SESSION->viewtype != 'program'));
        $table = new html_table();
        $table->attributes = array('class' => "fullwidth invisiblepadded");
        $tablerow = new html_table_row();
        $tablerow->cells = array();
        foreach ($subcategories as $subcategory) {
            if ($subcategory->visible || has_capability('moodle/category:viewhiddencategories', $context)) {

                $catlinkcss = $subcategory->visible ? '' : 'class="dimmed" ';
                $item_count = array_key_exists($subcategory->id, $item_counts) ? $item_counts[$subcategory->id] : 0;
                // don't show empty sub-categories unless viewing as admin
                if (!$isediting && $item_count == 0) {
                    continue;
                }
                $cell = new html_table_cell();
                $cell->style = 'width: 33%;';
                $cell->text = '<a '.$catlinkcss.' href="category.php?viewtype='.$viewtype.'&id='.$subcategory->id.'">'.
                format_string($subcategory->name, true, array('context' => context_coursecat::instance($subcategory->id))).' ('.$item_count.')</a>';

                if (count($tablerow->cells) < 3) {
                    // add another cell to this row
                    $tablerow->cells[] = $cell;
                } else {
                    // otherwise push the data and start a new row
                    $table->data[] = $tablerow;
                    $tablerow = new html_table_row();
                    $tablerow->cells = array($cell);
                }
            }
        }
        // push the last row
        if (count($tablerow->cells) > 0) {
            $table->data[] = $tablerow;
        }

        // only display table if there is data in it
        if (count($table->data) > 0) {
            // display table
            echo $OUTPUT->heading(get_string('subcategories', 'moodle'), 3);
            echo html_writer::table($table);
        }

    }

    // Need to have these before heading so it displays correctly
    // just using this to get the total program count
    if ($SESSION->viewtype == 'course') {
        $progs = prog_get_programs_page($category->id, 'sortorder ASC',
            'p.id, p.visible', $totalprogcount, 0, 1);
        if ($totalprogcount) {
            echo '<p class="course-prog-alt-view"><a href="'. $CFG->wwwroot . '/course/category.php?id='.$category->id.'&amp;viewtype=program">'.get_string('orviewprograms', 'totara_coursecatalog', $totalprogcount).'</a></p>';
        }
    } else if ($SESSION->viewtype == 'program') {
        // just using this to get the total course count
        $courses = get_courses_page($category->id, 'c.sortorder ASC',
            'c.id,c.visible',
            $totalcoursecount, 0, 1);

        if ($totalcoursecount) {
            echo '<p class="course-prog-alt-view"><a href="'. $CFG->wwwroot . '/course/category.php?id='.$category->id.'&amp;viewtype=course">'.get_string('orviewcourses', 'totara_coursecatalog', $totalcoursecount).'</a></p>';
        }
    }

    echo $OUTPUT->heading($category->name);

    $numcourses = 0;
    /// Print out all the courses
    if ($SESSION->viewtype=='course') {
        $courses = get_courses_page($category->id, 'c.sortorder ASC',
                'c.id,c.sortorder,c.shortname,c.fullname,c.summary,c.visible, c.icon',
                $totalcount, $page*$perpage, $perpage);
        $numcourses = count($courses);
        $abletomovecourses = has_capability('moodle/category:manage', $context);

        if (!$courses) {
            if (empty($subcategorieswereshown)) {
                echo $OUTPUT->heading(get_string("nocoursesyet"));
            }
        } else if ($numcourses <= COURSE_MAX_SUMMARIES_PER_PAGE and !$page and !$isediting) {
            echo $OUTPUT->box_start('courseboxes');
            print_courses($category);
            echo $OUTPUT->box_end();
        } else {
            echo $OUTPUT->paging_bar($totalcount, $page, $perpage, "/course/category.php?id=$category->id&perpage=$perpage");

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

            echo '<form id="movecourses" action="category.php" method="post"><div>';
            echo '<input type="hidden" name="sesskey" value="'.sesskey().'" />';
            echo '<table border="0" cellspacing="2" cellpadding="4" class="generalbox boxaligncenter"><tr>';

            echo '<th class="header" scope="col">'.$strcourses.'</th>';
            if ($isediting) {
                echo '<th class="header" scope="col">'.$stredit.'</th>';
                if ($abletomovecourses) {
                    echo '<th class="header" scope="col">'.$strselect.'</th>';
                }
            } else {
                echo '<th class="header" scope="col">&nbsp;</th>';
            }
            echo '</tr>';

            $count = 0;

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

            foreach ($courses as $acourse) {
                $coursecontext = context_course::instance($acourse->id);
                $count++;
                $up = ($count > 1 || !$atfirstpage);
                $down = ($count < $numcourses || !$atlastpage);

                $courseicon = (empty($acourse->icon)) ? 'default' : $acourse->icon;
                $linkcss = $acourse->visible ? '' : ' class="dimmed" ';
                echo '<tr>';
                $coursename = get_course_display_name_for_list($acourse);
                $replace = array('-' => ' ');
                $iconname = strtr($courseicon, $replace);
                $iconname = ucwords($iconname);
                echo '<td>'. $OUTPUT->pix_icon('courseicons/' . $courseicon, $iconname, 'totara_core', array('class' => 'course_icon')) . '<a '.$linkcss.' href="view.php?id='.$acourse->id.'">'. format_string($coursename) .'</a></td>';
                if ($isediting) {
                    echo '<td>';
                    if (has_capability('moodle/course:update', $coursecontext)) {
                        echo $OUTPUT->action_icon(new moodle_url('/course/edit.php',
                                array('id' => $acourse->id, 'category' => $id, 'returnto' => 'category')),
                                new pix_icon('t/edit', $strsettings));
                    }

                    // role assignment link
                    if (has_capability('moodle/course:enrolreview', $coursecontext)) {
                        echo $OUTPUT->action_icon(new moodle_url('/enrol/users.php', array('id' => $acourse->id)),
                                new pix_icon('i/users', get_string('enrolledusers', 'enrol')));
                    }

                    if (can_delete_course($acourse->id)) {
                        echo $OUTPUT->action_icon(new moodle_url('/course/delete.php', array('id' => $acourse->id)),
                                new pix_icon('t/delete', $strdelete));
                    }

                    // MDL-8885, users with no capability to view hidden courses, should not be able to lock themselves out
                    if (has_capability('moodle/course:visibility', $coursecontext) && has_capability('moodle/course:viewhiddencourses', $coursecontext)) {
                        if (!empty($acourse->visible)) {
                            echo $OUTPUT->action_icon(new moodle_url('/course/category.php',
                                    array('id' => $category->id, 'page' => $page, 'perpage' => $perpage,
                                            'hide' => $acourse->id, 'sesskey' => sesskey())),
                                    new pix_icon('t/hide', $strhide));
                        } else {
                            echo $OUTPUT->action_icon(new moodle_url('/course/category.php',
                                    array('id' => $category->id, 'page' => $page, 'perpage' => $perpage,
                                            'show' => $acourse->id, 'sesskey' => sesskey())),
                                    new pix_icon('t/show', $strshow));
                        }
                    }

                    if (has_capability('moodle/backup:backupcourse', $coursecontext)) {
                        echo $OUTPUT->action_icon(new moodle_url('/backup/backup.php', array('id' => $acourse->id)),
                                new pix_icon('t/backup', $strbackup));
                    }

                    if (has_capability('moodle/restore:restorecourse', $coursecontext)) {
                        echo $OUTPUT->action_icon(new moodle_url('/backup/restorefile.php', array('contextid' => $coursecontext->id)),
                                new pix_icon('t/restore', $strrestore));
                    }

                    if ($canmanagesitecourses || $abletomovecourses) {
                        if ($up) {
                            echo $OUTPUT->action_icon(new moodle_url('/course/category.php',
                                    array('id' => $category->id, 'page' => $page, 'perpage' => $perpage,
                                            'moveup' => $acourse->id, 'sesskey' => sesskey())),
                                    new pix_icon('t/up', $strmoveup));
                        }

                        if ($down) {
                            echo $OUTPUT->action_icon(new moodle_url('/course/category.php',
                                    array('id' => $category->id, 'page' => $page, 'perpage' => $perpage,
                                            'movedown' => $acourse->id, 'sesskey' => sesskey())),
                                    new pix_icon('t/down', $strmovedown));
                        }
                    }

                    echo '</td>';

                    if ($abletomovecourses) {
                        echo '<td align="center">';
                        echo '<input type="checkbox" name="c'.$acourse->id.'" />';
                        echo '</td>';
                    }

                } else {
                    echo '<td align="right">';
                    // print enrol info
                    if ($icons = enrol_get_course_info_icons($acourse)) {
                        foreach ($icons as $pix_icon) {
                            echo $OUTPUT->render($pix_icon);
                        }
                    }
                    if (!empty($acourse->summary)) {
                        $link = new moodle_url("/course/info.php?id=$acourse->id");
                        echo $OUTPUT->action_link($link, '<img alt="'.get_string('info').'" class="icon" src="'.$OUTPUT->pix_url('i/info') . '" />',
                            new popup_action('click', $link, 'courseinfo'), array('title'=>$strsummary));
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
                $attributes = array();
                $attributes['class'] = 'totara-limited-width';
                $attributes['onchange'] = 'if (document.all) { this.className=\'totara-limited-width\';}';
                $attributes['onmousedown'] = 'if (document.all) this.className=\'totara-expanded-width\';';
                $attributes['onblur'] = 'if (document.all) this.className=\'totara-limited-width\';';
                $attributes['id'] = 'movetoid';
                echo html_writer::select($movetocategories, "moveto", $category->id, null, $attributes);
                $PAGE->requires->js_init_call('M.util.init_select_autosubmit', array('movecourses', 'movetoid', false));
                echo '<input type="hidden" name="id" value="'.$category->id.'" />';
                echo '</td></tr>';
            }

            echo '</table>';
            echo '</div></form>';
            echo '<br />';
        }
    } else if ($SESSION->viewtype=='program') {

        $programs = prog_get_programs_page($category->id, 'sortorder ASC',
                'p.id,p.sortorder,p.shortname,p.fullname,p.summary,p.visible, p.icon',
                $totalcount, $page*$perpage, $perpage);
        $numcourses = count($programs);


        $OUTPUT->heading(get_string('programsinthiscategory', 'totara_program', $totalcount), 3);


        if (!$programs) {
            echo '<p>' . get_string('noprogramsyet', 'totara_program') . '</p>';

        } else if ($numcourses <= COURSE_MAX_SUMMARIES_PER_PAGE and !$page and !$isediting) {
            $OUTPUT->box_start('courseboxes');
            prog_print_programs($category);
            $OUTPUT->box_end();
        } else {
            $pagingbar = new paging_bar($totalcount, $page, $perpage, "category.php?viewtype=$viewtype&amp;id={$category->id}&amp;perpage=$perpage&amp;");
            $pagingbar->pagevar = 'page';
            echo $OUTPUT->render($pagingbar);

            $strprograms = get_string('programs', 'totara_program');
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
            $stralllink = get_string('viewallprograms', 'totara_program');

            echo '<form id="moveprograms" action="category.php" method="post"><div>';
            echo '<input type="hidden" name="sesskey" value="'.sesskey().'" />';
            echo '<input type="hidden" name="viewtype" value="program" />';
            echo '<table border="0" cellspacing="2" cellpadding="4" class="generalbox totaratable boxaligncenter"><tr>';

            echo '<th class="header" scope="col">'.$strprograms.'</th>';
            if ($isediting) {
                echo '<th class="header" scope="col">'.$stredit.'</th>';
                if ($canmanagecategories) {
                    echo '<th class="header" scope="col">'.$strselect.'</th>';
                }
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
                    $programcontext = context_program::instance($aprogram->id);
                }
                $canconfigureprogram = has_capability('totara/program:configureprogram', $programcontext);
                $count++;
                $up = ($count > 1 || !$atfirstpage);
                $down = ($count < $numcourses || !$atlastpage);

                $linkcss = $aprogram->visible ? '' : ' class="dimmed" ';
                echo '<tr>';
                $replace = array('-' => ' ');
                $aprogram->icon = !empty($aprogram->icon) ? $aprogram->icon : 'default';
                $iconname = strtr($aprogram->icon, $replace);
                $iconname = ucwords($iconname);
                echo '<td>'. $OUTPUT->pix_icon('programicons/' . $aprogram->icon, $iconname, 'totara_core', array('class' => 'program_icon')) . '<a '.$linkcss.' href="'.$CFG->wwwroot.'/totara/program/view.php?id='.$aprogram->id.'">'. format_string($aprogram->fullname) .'</a></td>';
                if ($isediting) {
                    echo '<td>';
                    if ($canconfigureprogram) {
                        echo $OUTPUT->action_icon(new moodle_url('/totara/program/edit.php',
                                    array('id' => $aprogram->id, 'category' => $id, 'returnto' => 'category')),
                                    new pix_icon('t/edit', $stredit));
                    } else {
                        echo $spacer;
                    }

                    if (has_capability('totara/program:deleteprogram', $programcontext)) {
                        echo $OUTPUT->action_icon(new moodle_url('/totara/program/edit.php',
                                array('id' => $aprogram->id, 'action' => 'delete', 'category' => $id)),
                                new pix_icon('t/delete', $strdelete));
                    } else {
                        echo $spacer;
                    }

                    // users with no capability to view hidden programs should not be able to lock themselves out
                    if ($canconfigureprogram && has_capability('totara/program:viewhiddenprograms', $programcontext)) {
                        if (!empty($aprogram->visible)) {
                            echo $OUTPUT->action_icon(new moodle_url('/course/category.php',
                                    array('id' => $category->id, 'page' => $page, 'perpage' => $perpage, 'hide' => $aprogram->id, 'sesskey' => $USER->sesskey, 'viewtype' => 'program')),
                                    new pix_icon('t/hide', $strhide));
                        } else {
                            echo $OUTPUT->action_icon(new moodle_url('/course/category.php',
                                    array('id' => $category->id, 'page' => $page, 'perpage' => $perpage, 'show' => $aprogram->id, 'sesskey' => $USER->sesskey, 'viewtype' => 'program')),
                                    new pix_icon('t/hide', $strshow));
                        }
                    } else {
                        echo $spacer;
                    }

                    if ($canmanagecategories) {
                        if ($up) {
                            echo $OUTPUT->action_icon(new moodle_url('/course/category.php',
                                    array('id' => $category->id, 'page' => $page, 'perpage' => $perpage, 'moveup' => $aprogram->id, 'sesskey' => $USER->sesskey, 'viewtype' => 'program')),
                                    new pix_icon('t/up', $strmoveup));
                        } else {
                            echo $spacer;
                        }

                        if ($down) {
                            echo $OUTPUT->action_icon(new moodle_url('/course/category.php',
                                    array('id' => $category->id, 'page' => $page, 'perpage' => $perpage, 'movedown' => $aprogram->id, 'sesskey' => $USER->sesskey, 'viewtype' => 'program')),
                                    new pix_icon('t/down', $strmovedown));
                        } else {
                            echo $spacer;
                        }
                        $abletomoveprograms = true;
                    } else {
                        echo $spacer, $spacer;
                    }

                    if ($canmanagecategories) {
                        echo '</td>';
                        echo '<td align="center">';
                        echo '<input type="checkbox" name="p'.$aprogram->id.'" />';
                        echo '</td>';
                    }
                } else {
                    echo '<td align="right">';

                    if (!empty($aprogram->summary)) {
                        echo $OUTPUT->action_icon(new moodle_url('/totara/program/info.php', array('id' => $aprogram->id)),
                                                $OUTPUT->pix_icon('i/info', get_string('info')));
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }

            if ($abletomoveprograms) {
                $movetocategories = array();
                $notused = array();
                make_categories_list($movetocategories, $notused, 'moodle/category:manage');
                $movetocategories[$category->id] = get_string('moveselectedprogramsto', 'totara_program');
                echo '<tr><td colspan="3" >';
                $attributes = array();
                $attributes['class'] = 'totara-limited-width';
                $attributes['onchange'] = 'if (document.all) { this.className=\'totara-limited-width\';}';
                $attributes['onmousedown'] = 'if (document.all) this.className=\'totara-expanded-width\';';
                $attributes['onblur'] = 'if (document.all) this.className=\'totara-limited-width\';';
                $attributes['id'] = 'movetoid';
                echo html_writer::select($movetocategories, "moveto", $category->id, null, $attributes);
                $PAGE->requires->js_init_call('M.util.init_select_autosubmit', array('movecourses', 'movetoid', false));
                echo '<input type="hidden" name="id" value="'.$category->id.'" />';
                echo '</td></tr>';
            }

            echo '</table>';
            echo '</div></form>';
            echo '<br />';
        }

    } // End of print list of programs


    if ($isediting) {
        echo '<div class="buttons">';
        if ($SESSION->viewtype=='course' && $canmanagecategories && $numcourses > 1) {
            // Print button to re-sort courses by name
            unset($options);
            $options['id'] = $category->id;
            $options['resort'] = 'name';
            $options['sesskey'] = sesskey();
            echo $OUTPUT->single_button(new moodle_url('category.php', $options), get_string('resortcoursesbyname'), 'get');
        }

        if (!empty($CFG->enablecourserequests) && $category->id == $CFG->defaultrequestcategory) {
            print_course_request_buttons(context_system::instance());
        }
        echo '</div>';
    }

    echo $OUTPUT->footer();


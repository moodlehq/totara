<?php // $Id$

/// Displays external information about a course
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("{$CFG->dirroot}/course/lib.php");
require_once("{$CFG->dirroot}/local/program/lib.php");
require_once($CFG->dirroot.'/local/icon/course_icon.class.php');
require_once($CFG->dirroot.'/local/icon/program_icon.class.php');


/**
 * Get parameters
 */
$search    = optional_param('search', '', PARAM_RAW);  // search words
$page      = optional_param('page', 0, PARAM_INT);     // which page to show
$perpage   = optional_param('perpage', 10, PARAM_INT); // how many per page
$moveto    = optional_param('moveto', 0, PARAM_INT);   // move to category
$edit      = optional_param('categoryedit', -1, PARAM_BOOL);
$hide      = optional_param('hide', 0, PARAM_INT);
$show      = optional_param('show', 0, PARAM_INT);
$blocklist = optional_param('blocklist', 0, PARAM_INT);
$modulelist= optional_param('modulelist', '', PARAM_ALPHAEXT);
$viewtype  = optional_param('viewtype', '', PARAM_TEXT);
$category  = optional_param('category', -1, PARAM_INT);


/**
 * Which view type are we using?
 */
// Acceptable viewtypes
$viewtypes = array('course', 'program', 'category');
# "All" to possibly be enabled at a later date

// If no viewtype supplied, but one set in session - use that
if (!$viewtype && !empty($SESSION->viewtype)) {
    $viewtype = $SESSION->viewtype;
} else {
    // Otherwise use what was supplied (defaulting to 'all')
    if (!in_array($viewtype, $viewtypes)) {
        $viewtype = 'course';
    }

    $SESSION->viewtype = $viewtype;
}


/**
 * Clean search terms
 */
$search = trim(strip_tags($search)); // trim & clean raw searched string

if ($search) {
    $searchterms = explode(" ", $search);    // Search for words independently
    foreach ($searchterms as $key => $searchterm) {
        if (strlen($searchterm) < 2) {
            unset($searchterms[$key]);
        }
    }
    $search = trim(implode(" ", $searchterms));
} else {
    $searchterms = array();
    $search = '';
}


/**
 * Setup
 */
$site = get_site();

if ($CFG->forcelogin) {
    require_login();
}

$systemcontext = get_context_instance(CONTEXT_SYSTEM);
if ($category > 0) {
    $categorycontext = get_context_instance(CONTEXT_COURSECAT, $category);
} else {
    $categorycontext = $systemcontext;
}

// Save editing state
if ($edit !== -1) {
    $USER->categoryedit = $edit;
}

// Determine how to display this page
$adminediting = !empty($USER->categoryedit);

/**
 * Editing functions
 */
if ($viewtype == 'course') {
    if (has_capability('moodle/course:visibility', get_context_instance(CONTEXT_SYSTEM))) {
    /// Hide or show a course
        if ($hide or $show and confirm_sesskey()) {
            if ($hide) {
                $course = get_record("course", "id", $hide);
                $visible = 0;
            } else {
                $course = get_record("course", "id", $show);
                $visible = 1;
            }
            if ($course) {
                if (! set_field("course", "visible", $visible, "id", $course->id)) {
                    notify("Could not update that course!");
                }
            }
        }
    }
} else if ($viewtype == 'program') {
    /// Hide or show a program
    if ($hide or $show and confirm_sesskey()) {
        if ($hide) {
            $program = get_record("prog", "id", $hide);
            $visible = 0;
        } else {
            $program = get_record("prog", "id", $show);
            $visible = 1;
        }
        if ($program) {
            // Check caps
            if (has_capability('local/program:configureprogram', program_get_context($program->id))) {
                if (! set_field("prog", "visible", $visible, "id", $program->id)) {
                    notify("Could not update that program!");
                }
            }
        }
    }
} else if ($viewtype == 'category') {
    if (has_capability('moodle/category:manage', $categorycontext)) {
    /// Hide or show a course
        if ($hide or $show and confirm_sesskey()) {
            if ($hide) {
                $cat = get_record("course_categories", "id", $hide);
                $visible = 0;
            } else {
                $cat = get_record("course_categories", "id", $show);
                $visible = 1;
            }
            if ($cat) {
                if (! set_field("course_categories", "visible", $visible, "id", $cat->id)) {
                    notify("Could not update that category!");
                }
            }
        }
    }
}

if (has_capability('moodle/course:create', get_context_instance(CONTEXT_SYSTEM)) && $perpage != 99999) {
    $perpage = 30;
}


/**
 * Lang strings
 */
$displaylist = array();
$parentlist = array();
make_categories_list($displaylist, $parentlist);

$strcourses = get_string("courses");
$strsearch = get_string("search");
$strparent = get_string("parentcategory");
$strcategory = get_string("category");
$strselect   = get_string("select");
$strselectall = get_string("selectall");
$strdeselectall = get_string("deselectall");
$stredit = get_string("edit");
$strfrontpage = get_string('frontpage', 'admin');
$strnocourses = get_string('nocourses');

if ($category > 0) {
    $categoryname = $displaylist[$category];
    $strsearchresults = get_string('searchresultsinx', 'moodle', $categoryname);
} else {
    $strsearchresults = get_string('searchresults');
}


/**
 * If moving a course or program to a new category
 */
if ($viewtype == 'course') {
    if (!empty($moveto) and $data = data_submitted() and confirm_sesskey()) {   // Some courses are being moved
        if (! $destcategory = get_record("course_categories", "id", $data->moveto)) {
            error("Error finding the category");
        }

        $courses = array();
        foreach ( $data as $key => $value ) {
            if (preg_match('/^c\d+$/', $key)) {
                array_push($courses, substr($key, 1));
            }
        }
        move_courses($courses, $data->moveto);
    }
} else if ($viewtype == 'program') {
    if (!empty($moveto) and $data = data_submitted() and confirm_sesskey()) {   // Some courses are being moved
        if (! $destcategory = get_record("course_categories", "id", $data->moveto)) {
            error("Error finding the category");
        }

        $programs = array();
        foreach ( $data as $key => $value ) {
            if (preg_match('/^c\d+$/', $key)) {
                array_push($programs, substr($key, 1));
            }
        }
        prog_move_programs($programs, $data->moveto);
    }
}


/**
 * Perform search
 */
/**
 * Total result count
 */
$totalcount = array('courses' => 0, 'programs' => 0, 'categories' => 0);
$totalcountall = 0;

/**
 * Results (grouped by type)
 */
$results = array('courses' => array(), 'programs' => array(), 'categories' => array());

/**
 * Get course results
 *
 * Options are:
 * - by block
 * - by module
 * - by category
 */
if (in_array($viewtype, array('course', 'all'))) {

    // get list of courses containing blocks if required
    if (!empty($blocklist) and confirm_sesskey()) {
        $blockid = $blocklist;
        if (!$blocks = get_records('block_instance', 'blockid', $blockid)) {
            error( "Could not read data for blockid=$blockid" );
        }

        // run through blocks and get (unique) courses
        foreach ($blocks as $block) {
            $courseid = $block->pageid;
            // MDL-11167, blocks can be placed on mymoodle, or the blogs page
            // and it should not show up on course search page
            if ($courseid==0 || $block->pagetype != 'course-view') {
                continue;
            }
            if (!$course = get_record('course', 'id', $courseid)) {
                error( "Could not read data for courseid=$courseid" );
            }
            $results['courses'][$courseid] = $course;
        }
        $totalcount['courses'] += count($results['courses']);
    }
    // get list of courses containing modules if required
    elseif (!empty($modulelist) and confirm_sesskey()) {
        $modulename = $modulelist;

        $sql =  "SELECT DISTINCT c.id FROM {$CFG->prefix}".$modulelist." module, {$CFG->prefix}course c"
            ." WHERE module.course=c.id";

        $courseids = get_records_sql($sql);

        if (!empty($courseids)) {
            $firstcourse = $page*$perpage;
            $lastcourse = $page*$perpage + $perpage -1;
            $i = 0;
            foreach ($courseids as $courseid) {
                if ($i>= $firstcourse && $i<=$lastcourse) {
                    $results['courses'][$courseid->id] = get_record('course', 'id', $courseid->id);
                }
                $i++;
            }
            $totalcount['courses'] += count($courseids);
        }
    }
    else {
        // Generate where clause for only retrieving courses in child categories
        if ($category < 1) {
            $coursewhere = '';
        } else {
            // Get category context path
            $catcontext = get_context_instance(CONTEXT_COURSECAT, $category);
            $coursewhere = "ctx.path LIKE '{$catcontext->path}/%'";
        }

        $coursecount = 0;
        $results['courses'] = get_courses_search($searchterms, "fullname ASC",
            $page, $perpage, $coursecount, $coursewhere);

        $totalcount['courses'] += $coursecount;
    }
}

/**
 * Get program search results
 *
 * Options are:
 * - by category
 */
if (in_array($viewtype, array('program', 'all'))) {
    // Generate where clause for only retrieving courses in child categories
    if ($category < 1) {
        $programwhere = '';
    } else {
        // Get category context path
        $catcontext = get_context_instance(CONTEXT_COURSECAT, $category);
        $programwhere = "ctx.path LIKE '{$catcontext->path}/%'";
    }

    $programcount = 0;
    $results['programs'] = prog_get_programs_search($searchterms, "fullname ASC", $page, $perpage, $programcount, $programwhere);

    $totalcount['programs'] += $programcount;
}

/**
 * Get category search results
 *
 * Options are:
 * - by category
 */
if (in_array($viewtype, array('category', 'all'))) {
    $categorycount = 0;
    $results['categories'] = get_categories_search($searchterms, "name ASC", $page, $perpage, $categorycount);

    $totalcount['categories'] += $categorycount;
}


/**
 * Generate editing form
 */
$encodedsearch = urlencode(stripslashes($search));
$editparams = array(
    'search'    => $encodedsearch,
    'page'      => $page,
    'perpage'   => $perpage,
    'viewtype'  => $viewtype,
    'category'  => $category
);

$editingform = '';
if (in_array($viewtype, array('course', 'category')) && has_any_capability(array('moodle/category:manage', 'moodle/course:create'), $systemcontext)) {
    $editingform = totara_print_edit_button('categoryedit', $editparams);
}
if (($viewtype == 'program') && has_capability('local/program:createprogram', $categorycontext)) {
    $editingform = totara_print_edit_button('categoryedit', $editparams);
}


/**
 * Setup admin page if required
 */
if ($editingform && $adminediting) {
    // Integrate into the admin tree only if the user can edit categories at the top level,
    // otherwise the admin block does not appear to this user, and you get an error.
    require_once("{$CFG->libdir}/adminlib.php");

    switch ($viewtype) {
        case 'program':
            $adminpage = 'manageprograms';
            break;

        case 'category':
            $adminpage = 'managecategories';
            break;

        case 'course':
        default:
            $adminpage = 'managecourses';
    }

    admin_externalpage_setup($adminpage, $editingform, array(), "{$CFG->wwwroot}/course/category.php");
}


/**
 * Generate breadcrumbs
 */
$navlinks = array();

// Type link
if ($viewtype == 'category') {

    $typeurl = "{$CFG->wwwroot}/course/index.php";
    $navlinks[] = array('name' => get_string($viewtype.'s'), 'link' => $typeurl, 'type' => 'misc');

} else if ($viewtype !== 'all') {

    if ($category > 0) {
        $typeurl = "{$CFG->wwwroot}/course/category.php?viewtype=".$viewtype."&id=".$category;
    } else {
        $typeurl = "{$CFG->wwwroot}/course/categorylist.php?viewtype=".$viewtype;
    }
    if ($viewtype == 'course') {
        $strfind = get_string('findcourses', 'local');
    } else {
        $strfind = get_string('findprograms', 'local_program');
    }
    $navlinks[] = array('name' => $strfind, 'link' => $typeurl, 'type' => 'misc');
}

// Terms link
if (strlen($search)) {
    $searchurl = "{$CFG->wwwroot}/course/search.php?viewtype=".$viewtype;
    if ($category >= 0) {
        $searchurl .= "&category=".$category;
    }
    $navlinks[] = array('name' => $strsearch, 'link' => $searchurl, 'type' => 'misc');

    $terms = "'".s($search, true)."'";
} else {
    $terms = get_string('showall'.$viewtype.'s');
}
$navlinks[] = array('name' => $terms, 'link' => null, 'type' => 'misc');
$navigation = build_navigation($navlinks);


/**
 * Print header and navigation
 */
if ($adminediting) {
    admin_externalpage_print_header();
} else {
    print_header("$site->fullname: $strsearchresults", $site->fullname, $navigation, "", "", "", $editingform);
}

// Generate browse link
$browselink = '';
if (in_array($viewtype, array('course', 'program'))) {
    $cssclass = '';

    if (!strlen($search)) {
        $cssclass = 'class="search_alternate"';
    }

    if ($category == -1) {
        $browselink .= '<a '.$cssclass.' href="'.$CFG->wwwroot.'/course/categorylist.php?viewtype='.$viewtype.'">';
        $browselink .= "&laquo; ";
        $browselink .= get_string('browsebycategory');
        $browselink .= '</a>';
    } else {
        $browselink .= '<a '.$cssclass.' href="'.$CFG->wwwroot.'/course/category.php?viewtype='.$viewtype.'&id='.$category.'">';
        $browselink .= "&laquo; ";
        if ($category == 0) {
            $browselink .= get_string('backtoall'.$viewtype.'s');
        } else {
            $categoryname = $displaylist[$category];
            $browselink .= get_string('backtocategoryx', 'moodle', $categoryname);
        }
        $browselink .= '</a>';
    }
} else if ($viewtype == 'category') {
    $browselink .= '<a href="'.$CFG->wwwroot.'/course/index.php">&laquo; '.get_string('browseallcategories').'</a>';
}

// Print browse link if showing search results
if (strlen($search)) {
    echo $browselink;
}

if ($adminediting && has_capability('moodle/category:manage', $categorycontext)) {
    echo '<div class="buttons">';

    if ($viewtype == 'course' &&
        has_capability('moodle/course:create', $categorycontext)) {

    /// Print button to create a new course (no specific category)
        print_single_button('edit.php', array('category' => $category), get_string('addnewcourse'), 'get');
    }

    if ($viewtype == 'program' &&
        has_capability('local/program:createprogram', $categorycontext)) {
    /// Print button to create a new program
        print_single_button($CFG->wwwroot.'/local/program/add.php', array('category' => $category), get_string('addnewprogram', 'local_program'), 'get');
    }

    echo '</div>';
}

print_totara_search($search, false, $viewtype, $category);

if (strlen($search)) {
    print_heading($strsearchresults);
} else {
    if ($viewtype == 'course') {
        print_heading(get_string('viewallcourses'));
    } else if ($viewtype == 'program') {
        print_heading(get_string('viewallprograms', 'local_program'));
    } else {
        print_heading(get_string('viewallcategories'));
    }
}

/**
 * Finally, display results
 */
// Print link to program search results
if (in_array($viewtype, array('course', 'all'))) {
    if (strlen($search)) {
        $programsearch = "{$CFG->wwwroot}/course/search.php?viewtype=program&search={$encodedsearch}";
        if ($category >= 0) {
            $programsearch .= "&category={$category}";
        }
        echo "<a class=\"search_alternate\" href=\"{$programsearch}\">".get_string('performsearchonprograms')."</a>";
    } else {
        echo $browselink;
    }
}

if ($results['courses']) {

    ///add the module parameter to the paging bar if they exists
    $modulelink = "";
    if (!empty($modulelist) and confirm_sesskey()) {
        $modulelink = "&amp;modulelist=".$modulelist."&amp;sesskey=".$USER->sesskey;
    }

    // If search by term, show count of matches
    if (strlen($search)) {
        $langdata = new object();
        $langdata->count = $totalcount['courses'];
        $langdata->terms = $search;
        if ($langdata->count > 1) {
            print_heading(get_string('searchcoursesmatchesplural', 'moodle', $langdata), '', 3);
        } else {
            print_heading(get_string('searchcoursesmatchessingle', 'moodle', $langdata), '', 3);
        }
    } else {
        echo '<div class="clearfix"></div>';
    }

    print_navigation_bar($totalcount['courses'], $page, $perpage, $encodedsearch, $modulelink);

    if (!$adminediting) {
    /// Show browse view.
        print_spacer(5,5);
        foreach ($results['courses'] as $course) {
            $course->summary .= "<br /><p class=\"category\">";
            $course->summary .= "$strcategory: <a href=\"category.php?viewtype=course&id=$course->category\">";
            $course->summary .= $displaylist[$course->category];
            $course->summary .= "</a></p>";
            print_course($course, $search);
        }
    } else {
    /// Show editing UI.
        echo "<form id=\"movecourses\" action=\"search.php\" method=\"post\">\n";
        echo "<div><input type=\"hidden\" name=\"sesskey\" value=\"$USER->sesskey\" />\n";
        echo "<input type=\"hidden\" name=\"search\" value=\"".s($search, true)."\" />\n";
        echo "<input type=\"hidden\" name=\"page\" value=\"$page\" />\n";
        echo "<input type=\"hidden\" name=\"perpage\" value=\"$perpage\" /></div>\n";
        echo "<table border=\"0\" cellspacing=\"2\" cellpadding=\"4\" class=\"flexible generalbox editcourse boxaligncenter\">\n<tr>\n";
        echo "<th scope=\"col\" class=\"header c0\">$strcourses</th>\n";
        echo "<th scope=\"col\" class=\"header c1\">$strcategory</th>\n";
        echo "<th scope=\"col\" class=\"header c2\">$strselect</th>\n";
        echo "<th scope=\"col\" class=\"header c3\">$stredit</th></tr>\n";

        $i = 0;

        $course_icon = new course_icon();

        foreach ($results['courses'] as $course) {
            ++$i;
            $rowclass = $i % 2 ? 'r0' : 'r1';

            if (isset($course->context)) {
                $coursecontext = $course->context;
            } else {
                $coursecontext = get_context_instance(CONTEXT_COURSE, $course->id);
            }

            $linkcss = $course->visible ? "" : " class=\"dimmed\" ";

            // are we displaying the front page (courseid=1)?
            if ($course->id == 1) {
                echo "<tr class=\"{$rowclass}\">\n";
                echo "<td><a href=\"$CFG->wwwroot\">$strfrontpage</a></td>\n";

                // can't do anything else with the front page
                echo "  <td>&nbsp;</td>\n"; // category place
                echo "  <td>&nbsp;</td>\n"; // select place
                echo "  <td>&nbsp;</td>\n"; // edit place
                echo "</tr>\n";
                continue;
            }

            echo "<tr class=\"{$rowclass}\">\n";
            echo "<td class=\"cell c0\">";
            echo $course_icon->display($course, 'small');
            echo "<a $linkcss href=\"view.php?id=$course->id\">"
                . highlight($search, format_string($course->fullname)) . "</a></td>\n";
            echo "<td class=\"cell c1\">";
            echo "<a href=\"{$CFG->wwwroot}/course/category.php?viewtype=course&id={$course->category}\">";
            echo $displaylist[$course->category];
            echo "</a>";
            echo "</td>\n";
            echo "<td class=\"cell c2\">\n";

            // this is ok since this will get inherited from course category context
            // if it is set
            if (has_capability('moodle/category:manage', $coursecontext)) {
                echo "<input type=\"checkbox\" name=\"c$course->id\" />\n";
            } else {
                echo "<input type=\"checkbox\" name=\"c$course->id\" disabled=\"disabled\" />\n";
            }

            echo "</td>\n";
            echo "<td class=\"cell c3\">\n";
            $pixpath = $CFG->pixpath;

            // checks whether user can update course settings
            if (has_capability('moodle/course:update', $coursecontext)) {
                echo "<a title=\"".get_string("settings")."\" href=\"$CFG->wwwroot/course/edit.php?id=$course->id\">\n<img".
                    " src=\"$pixpath/t/edit.gif\" class=\"iconsmall\" alt=\"".get_string("settings")."\" /></a>\n ";
            }

            // checks whether user can do role assignment
            if (has_capability('moodle/role:assign', $coursecontext)) {
                echo'<a title="'.get_string('assignroles', 'role').'" href="'.$CFG->wwwroot.'/'.$CFG->admin.'/roles/assign.php?contextid='.$coursecontext->id.'">';
                echo '<img src="'.$CFG->pixpath.'/i/roles.gif" class="iconsmall" alt="'.get_string('assignroles', 'role').'" /></a> ' . "\n";
            }

            // checks whether user can delete course
            if (has_capability('moodle/course:delete', $coursecontext)) {
                echo "<a title=\"".get_string("delete")."\" href=\"delete.php?id=$course->id\">\n<img".
                    " src=\"$pixpath/t/delete.gif\" class=\"iconsmall\" alt=\"".get_string("delete")."\" /></a>\n ";
            }

            // checks whether user can change visibility
            if (has_capability('moodle/course:visibility', $coursecontext)) {
                if (!empty($course->visible)) {
                    echo "<a title=\"".get_string("hide")."\" href=\"search.php?search=$encodedsearch&amp;perpage=$perpage&amp;page=$page&amp;hide=$course->id&amp;sesskey=$USER->sesskey\">\n<img".
                        " src=\"$pixpath/t/hide.gif\" class=\"iconsmall\" alt=\"".get_string("hide")."\" /></a>\n ";
                } else {
                    echo "<a title=\"".get_string("show")."\" href=\"search.php?search=$encodedsearch&amp;perpage=$perpage&amp;page=$page&amp;show=$course->id&amp;sesskey=$USER->sesskey\">\n<img".
                        " src=\"$pixpath/t/show.gif\" class=\"iconsmall\" alt=\"".get_string("show")."\" /></a>\n ";
                }
            }

            // checks whether user can do site backup
            if (has_capability('moodle/site:backup', $coursecontext)) {
                echo "<a title=\"".get_string("backup")."\" href=\"../backup/backup.php?id=$course->id\">\n<img".
                    " src=\"$pixpath/t/backup.gif\" class=\"iconsmall\" alt=\"".get_string("backup")."\" /></a>\n ";
            }

            // checks whether user can do restore
            if (has_capability('moodle/site:restore', $coursecontext)) {
                echo "<a title=\"".get_string("restore")."\" href=\"../files/index.php?id=$course->id&amp;wdir=/backupdata\">\n<img".
                    " src=\"$pixpath/t/restore.gif\" class=\"iconsmall\" alt=\"".get_string("restore")."\" /></a>\n ";
            }

            echo "</td>\n</tr>\n";
        }
        echo "<tr>\n<td colspan=\"4\" style=\"text-align:center\">\n";
        echo "<br />";
        echo "<input type=\"button\" onclick=\"checkall()\" value=\"$strselectall\" />\n";
        echo "<input type=\"button\" onclick=\"uncheckall()\" value=\"$strdeselectall\" />\n";
        choose_from_menu ($displaylist, "moveto", "", get_string("moveselectedcoursesto"), "javascript: getElementById('movecourses').submit()");
        echo "</td>\n</tr>\n";
        echo "</table>\n</form>";

    }

    print_navigation_bar($totalcount['courses'], $page, $perpage, $encodedsearch, $modulelink);

} else if (in_array($viewtype, array('course', 'all'))) {
    if (!empty($search)) {
        print_heading(get_string("nocoursesfound", "", s($search, true)));
        print_string("searchhelp");
    }
    else {
        print_heading($strnocourses);
    }
}

// Print link to course search results
if (in_array($viewtype, array('program', 'all'))) {
    if (strlen($search)) {
        $programsearch = "{$CFG->wwwroot}/course/search.php?viewtype=course&search={$encodedsearch}";
        if ($category >= 0) {
            $programsearch .= "&category={$category}";
        }
        echo "<a class=\"search_alternate\" href=\"{$programsearch}\">".get_string('performsearchoncourses')."</a>";
    } else {
        echo $browselink;
    }
}

if ($results['programs']) {

    // If search by term, show count of matches
    if (strlen($search)) {
        $langdata = new object();
        $langdata->count = $totalcount['programs'];
        $langdata->terms = $search;
        if ($langdata->count > 1) {
            print_heading(get_string('searchprogramsmatchesplural', 'moodle', $langdata), '', 3);
        } else {
            print_heading(get_string('searchprogramsmatchessingle', 'moodle', $langdata), '', 3);
        }
    } else {
        echo '<div class="clearfix"></div>';
    }

    print_navigation_bar($totalcount['programs'], $page, $perpage, $encodedsearch, '');

    if (!$adminediting) {
    /// Show browse view.
        print_spacer(5,5);
        foreach ($results['programs'] as $program) {
            $program->summary .= "<br /><p class=\"category\">";
            $program->summary .= "$strcategory: <a href=\"category.php?viewtype=program&id=$program->category\">";
            $program->summary .= $displaylist[$program->category];
            $program->summary .= "</a></p>";
            prog_print_program($program, $search);
        }
    } else {
    /// Show editing UI.
        echo "<form id=\"movecourses\" action=\"search.php\" method=\"post\">\n";
        echo "<div><input type=\"hidden\" name=\"sesskey\" value=\"$USER->sesskey\" />\n";
        echo "<input type=\"hidden\" name=\"search\" value=\"".s($search, true)."\" />\n";
        echo "<input type=\"hidden\" name=\"page\" value=\"$page\" />\n";
        echo "<input type=\"hidden\" name=\"perpage\" value=\"$perpage\" /></div>\n";
        echo "<table border=\"0\" cellspacing=\"2\" cellpadding=\"4\" class=\"flexible generalbox editcourse boxaligncenter\">\n<tr>\n";
        echo "<th scope=\"col\" class=\"header c0\">$strcourses</th>\n";
        echo "<th scope=\"col\" class=\"header c1\">$strcategory</th>\n";
        echo "<th scope=\"col\" class=\"header c2\">$strselect</th>\n";
        echo "<th scope=\"col\" class=\"header c3\">$stredit</th></tr>\n";

        $i = 0;

        $program_icon = new program_icon();

        foreach ($results['programs'] as $program) {
            ++$i;
            $rowclass = $i % 2 ? 'r0' : 'r1';

            if (isset($program->context)) {
                $programcontext = $program->context;
            } else {
                $programcontext = get_context_instance(CONTEXT_PROGRAM, $program->id);
            }

            $linkcss = $program->visible ? "" : " class=\"dimmed\" ";

            echo "<tr class=\"{$rowclass}\">\n";
            echo "<td class=\"cell c0\">";
            echo $program_icon->display($program, 'small');
            echo "<a $linkcss href=\"{$CFG->wwwroot}/local/program/view.php?id=$program->id\">"
                . highlight($search, format_string($program->fullname)) . "</a></td>\n";
            echo "<td class=\"cell c1\">";
            echo "<a href=\"{$CFG->wwwroot}/course/category.php?viewtype=program&id={$program->category}\">";
            echo $displaylist[$program->category];
            echo "</a>";
            echo "</td>\n";
            echo "<td class=\"cell c2\">\n";

            // this is ok since this will get inherited from course category context
            // if it is set
            if (has_capability('moodle/category:manage', $programcontext)) {
                echo "<input type=\"checkbox\" name=\"c$program->id\" />\n";
            } else {
                echo "<input type=\"checkbox\" name=\"c$program->id\" disabled=\"disabled\" />\n";
            }

            echo "</td>\n";
            echo "<td class=\"cell c3\">\n";
            $pixpath = $CFG->pixpath;

            // checks whether user can update program settings
            if (has_capability('local/program:configureprogram', $programcontext)) {
                echo "<a title=\"".get_string("settings")."\" href=\"$CFG->wwwroot/local/program/edit.php?id=$program->id\">\n<img".
                    " src=\"$pixpath/t/edit.gif\" class=\"iconsmall\" alt=\"".get_string("settings")."\" /></a>\n ";
            }

            // checks whether user can delete course
            if (has_capability('local/program:configureprogram', $programcontext)) {
                echo "<a title=\"".get_string("delete")."\" href=\"$CFG->wwwroot/local/program/edit.php?id=$program->id&action=delete\">\n<img".
                    " src=\"$pixpath/t/delete.gif\" class=\"iconsmall\" alt=\"".get_string("delete")."\" /></a>\n ";
            }

            // checks whether user can change visibility
            if (has_capability('local/program:configureprogram', $programcontext)) {
                if (!empty($program->visible)) {
                    echo "<a title=\"".get_string("hide")."\" href=\"";
                    echo "search.php?viewtype=$viewtype&search=$encodedsearch&amp;perpage=$perpage&amp;page=$page&amp;hide=$program->id&amp;sesskey=$USER->sesskey\">\n";
                    echo "<img src=\"$pixpath/t/hide.gif\" class=\"iconsmall\" alt=\"".get_string("hide")."\" /></a>\n ";
                } else {
                    echo "<a title=\"".get_string("show")."\" href=\"";
                    echo "search.php?viewtype=$viewtype&search=$encodedsearch&amp;perpage=$perpage&amp;page=$page&amp;show=$program->id&amp;sesskey=$USER->sesskey\">\n";
                    echo "<img src=\"$pixpath/t/show.gif\" class=\"iconsmall\" alt=\"".get_string("show")."\" /></a>\n ";
                }
            }

            echo "</td>\n</tr>\n";
        }
        echo "<tr>\n<td colspan=\"4\" style=\"text-align:center\">\n";
        echo "<br />";
        echo "<input type=\"button\" onclick=\"checkall()\" value=\"$strselectall\" />\n";
        echo "<input type=\"button\" onclick=\"uncheckall()\" value=\"$strdeselectall\" />\n";
        choose_from_menu ($displaylist, "moveto", "", get_string("moveselectedprogramsto",'local_program'), "javascript: getElementById('movecourses').submit()");
        echo "</td>\n</tr>\n";
        echo "</table>\n</form>";
    }
    print_navigation_bar($totalcount['programs'], $page, $perpage, $encodedsearch, '');

} else if (in_array($viewtype, array('program', 'all'))) {
    if (!empty($search)) {
        print_heading(get_string("noprogramsfound", "", s($search, true)));
        print_string("searchhelp");
    }
    else {
        print_heading($strnoprograms);
    }
}

if ($results['categories']) {

    // If search by term, show count of matches
    if (strlen($search)) {
        $langdata = new object();
        $langdata->count = $totalcount['categories'];
        $langdata->terms = $search;
        if ($langdata->count > 1) {
            print_heading(get_string('searchcategoriesmatchesplural', 'moodle', $langdata), '', 3);
        } else {
            print_heading(get_string('searchcategoriesmatchessingle', 'moodle', $langdata), '', 3);
        }
    } else {
        echo '<div class="clearfix"></div>';
    }

    print_navigation_bar($totalcount['categories'], $page, $perpage, $encodedsearch, '');

    if (!$adminediting) {
    /// Show browse view.
        print_spacer(5,5);
        foreach ($results['categories'] as $cat) {
            if (isset($category->parent) && $category->parent) {
                $category->description .= "<br /><p class=\"category\">";
                $category->description .= "$strparent: <a href=\"{$CFG->wwwroot}/course/index.php?highlightid={$cat->parent}#category{$cat->parent}\">";
                $category->description .= $displaylist[$cat->parent];
                $category->description .= "</a></p>";
            }
            print_category($cat, $search);
        }
    } else {
    /// Show editing UI.
        echo "<form id=\"movecategories\" action=\"search.php\" method=\"post\">\n";
        echo "<div><input type=\"hidden\" name=\"sesskey\" value=\"$USER->sesskey\" />\n";
        echo "<input type=\"hidden\" name=\"search\" value=\"".s($search, true)."\" />\n";
        echo "<input type=\"hidden\" name=\"page\" value=\"$page\" />\n";
        echo "<input type=\"hidden\" name=\"perpage\" value=\"$perpage\" /></div>\n";
        echo "<table border=\"0\" cellspacing=\"2\" cellpadding=\"4\" class=\"flexible generalbox editcourse boxaligncenter\">\n<tr>\n";
        echo "<th scope=\"col\" class=\"header c0\">$strcategory</th>\n";
        echo "<th scope=\"col\" class=\"header c1\">$strparent</th>\n";
        echo "<th scope=\"col\" class=\"header c3\">$stredit</th></tr>\n";

        $i = 0;

        $str = new stdClass;
        $str->edit     = get_string('edit');
        $str->delete   = get_string('delete');
        $str->edit     = get_string('editthiscategory');
        $str->roles    = get_string('assignroles', 'role');
        $str->spacer = '<img src="'.$CFG->wwwroot.'/pix/spacer.gif" class="iconsmall" alt="" /> ';

        foreach ($results['categories'] as $cat) {
            ++$i;
            $rowclass = $i % 2 ? 'r0' : 'r1';

            $categorycontext = get_context_instance(CONTEXT_COURSECAT, $cat->id);

            $linkcss = $cat->visible ? "" : " class=\"dimmed\" ";

            echo "<tr class=\"{$rowclass}\">\n";
            echo "<td class=\"cell c0\">";
            echo local_coursecategory_icon_tag($cat, 'small');
            echo "<a $linkcss href=\"{$CFG->wwwroot}/course/index.php?highlightid={$cat->id}#category{$cat->id}\">"
                . highlight($search, format_string($cat->name)) . "</a></td>\n";
            echo "<td class=\"cell c1\">";
            if ($cat->parent > 0) {
                echo "<a href=\"{$CFG->wwwroot}/course/index.php?highlightid={$cat->parent}#category{$cat->parent}\">";
                echo $displaylist[$cat->parent];
                echo "</a>";
            }
            echo "</td>\n";
            echo "<td class=\"cell c2\">\n";

            $actions = '';

            if (has_capability('moodle/category:manage', $categorycontext)) {
                $actions .= '<a title="'.$str->edit.'" href="editcategory.php?id='.$cat->id.'"><img'.
                    ' src="'.$CFG->pixpath.'/t/edit.gif" class="iconsmall" alt="'.$str->edit.'" /></a> ';

                $actions .= '<a title="'.$str->roles.'" href="'.$CFG->wwwroot.'/admin/roles/assign.php?contextid='.
                    $cat->context->id.'"><img src="'.$CFG->pixpath.'/i/roles.gif" class="iconsmall" alt="'.$str->roles.
                    '" /></a>';

                $actions .= '<a title="'.$str->delete.'" href="index.php?delete='.$cat->id.'&amp;sesskey='.sesskey().'"><img'.
                    ' src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$str->delete.'" /></a> ';

                if (!empty($cat->visible)) {
                    echo "<a title=\"".get_string("hide")."\" href=\"";
                    echo "search.php?viewtype=$viewtype&search=$encodedsearch&amp;perpage=$perpage&amp;page=$page&amp;hide=$cat->id&amp;sesskey=$USER->sesskey\">\n";
                    echo "<img src=\"$CFG->pixpath/t/hide.gif\" class=\"iconsmall\" alt=\"".get_string("hide")."\" /></a>\n ";
                } else {
                    echo "<a title=\"".get_string("show")."\" href=\"";
                    echo "search.php?viewtype=$viewtype&search=$encodedsearch&amp;perpage=$perpage&amp;page=$page&amp;show=$cat->id&amp;sesskey=$USER->sesskey\">\n";
                    echo "<img src=\"$CFG->pixpath/t/show.gif\" class=\"iconsmall\" alt=\"".get_string("show")."\" /></a>\n ";
                }
            }

            echo $actions;

            echo "</td>\n</tr>\n";
        }
    }
    print_navigation_bar($totalcount['categories'], $page, $perpage, $encodedsearch, '');

} else if (in_array($viewtype, array('category', 'all'))) {
    if (!empty($search)) {
        print_heading(get_string("nocategoriesfound", "", s($search, true)));
        print_string("searchhelp");
    }
    else {
        print_heading($strnoprograms);
    }
}

if ($adminediting) {
    admin_externalpage_print_footer();
} else {
    print_footer();
}


/**
 * Print a list navigation bar
 * Display page numbers, and a link for displaying all entries
 * @param integer $totalcount - number of entry to display
 * @param integer $page - page number
 * @param integer $perpage - number of entry per page
 * @param string $encodedsearch
 * @param string $modulelink - module name
 */
function print_navigation_bar($totalcount, $page, $perpage, $encodedsearch, $modulelink) {
    print_paging_bar($totalcount, $page, $perpage, "search.php?search=$encodedsearch".$modulelink."&amp;perpage=$perpage&amp;",'page',($perpage == 99999));

    // display
    if ($perpage != 99999 && $totalcount > $perpage) {
        echo "<center><p>";
        echo "<a href=\"search.php?search=$encodedsearch".$modulelink."&amp;perpage=99999\">".get_string("showall", "", $totalcount)."</a>";
        echo "</p></center>";
    }
}

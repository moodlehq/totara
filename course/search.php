<?php // $Id$

/// Displays external information about a course
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("{$CFG->dirroot}/course/lib.php");
require_once("{$CFG->dirroot}/totara/program/lib.php");


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
if ($viewtype == 'course') {
    $PAGE->set_totara_menu_selected('course');
} else if ($viewtype == 'program') {
    $PAGE->set_totara_menu_selected('program');
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

$systemcontext = context_system::instance();
if ($category > 0) {
    $categorycontext = context_coursecat::instance($category);
} else if (isset($CFG->defaultrequestcategory)) {
    $categorycontext = context_coursecat::instance($CFG->defaultrequestcategory);
} else {
    $categorycontext = $systemcontext;
}
$PAGE->set_context($systemcontext);
$PAGE->set_url('/course/search.php', array('viewtype' => $viewtype, 'category' => $category, 'search' => $search));
// Save editing state
if ($edit !== -1) {
    $USER->categoryedit = $edit;
}
$editingon = !empty($USER->categoryedit);

// Determine how to display this page
$canmanagesitecourses = has_any_capability(array('moodle/course:create', 'moodle/course:update'), $systemcontext);
$canmanagesiteprograms = has_any_capability(array('totara/program:createprogram', 'totara/program:configureprogram'), $systemcontext);
$canmanagesitecategories = has_capability('moodle/category:manage', $systemcontext);

$canmanagethesecourses = has_any_capability(array('moodle/course:create', 'moodle/course:update'), $categorycontext);
$canmanagetheseprograms = has_any_capability(array('totara/program:createprogram', 'totara/program:configureprogram'), $categorycontext);
$canmanagethesecategories = has_capability('moodle/category:manage', $categorycontext);

$canedit = (($SESSION->viewtype == 'course' && $canmanagethesecourses) ||
            ($SESSION->viewtype == 'program' && $canmanagetheseprograms) ||
            ($SESSION->viewtype == 'category' && $canmanagethesecategories));
$isediting = ($editingon && $canedit);

$isadmin = (($SESSION->viewtype == 'course' && $canmanagesitecourses) ||
            ($SESSION->viewtype == 'program' && $canmanagesiteprograms) ||
            ($SESSION->viewtype == 'category' && $canmanagesitecategories));
$isadminediting = ($editingon && $isadmin);

// should we show the editing on/off button?
$params = array('viewtype' => $SESSION->viewtype, 'search' => $search, 'category' => $category);
$editbutton = $canedit ? totara_print_edit_button('categoryedit', $params) : '';

/**
 * Editing functions
 */
if ($viewtype == 'course') {
    if (has_capability('moodle/course:visibility', context_system::instance())) {
    /// Hide or show a course
        if ($hide or $show and confirm_sesskey()) {
            if ($hide) {
                $course = $DB->get_record("course", array("id" => $hide));
                $visible = 0;
            } else {
                $course = $DB->get_record("course", array("id" => $show));
                $visible = 1;
            }
            if ($course) {
                if (! $DB->set_field("course", "visible", $visible, array("id" => $course->id))) {
                    echo $OUTPUT->notification("Could not update that course!");
                }
            }
        }
    }
} else if ($viewtype == 'program') {
    /// Hide or show a program
    if ($hide or $show and confirm_sesskey()) {
        if ($hide) {
            $program = $DB->get_record("prog", array("id" => $hide));
            $visible = 0;
        } else {
            $program = $DB->get_record("prog", array("id" => $show));
            $visible = 1;
        }
        if ($program) {
            // Check caps
            if (has_capability('totara/program:configureprogram', program_get_context($program->id))) {
                if (!$DB->set_field("prog", "visible", $visible, array("id" => $program->id))) {
                    echo $OUTPUT->notification("Could not update that program!");
                }
            }
        }
    }
} else if ($viewtype == 'category') {
    if ($canmanagethesecategories) {
    /// Hide or show a course
        if ($hide or $show and confirm_sesskey()) {
            if ($hide) {
                $cat = $DB->get_record("course_categories", array("id" => $hide));
                $visible = 0;
            } else {
                $cat = $DB->get_record("course_categories", array("id" => $show));
                $visible = 1;
            }
            if ($cat) {
                if (! $DB->set_field("course_categories", "visible", $visible, array("id" => $cat->id))) {
                    echo $OUTPUT->notification("Could not update that category!");
                }
            }
        }
    }
}

if ($perpage != 99999) {
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
$strnoprograms = get_string('noprograms', 'totara_program');

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
        if (! $destcategory = $DB->get_record("course_categories", array("id" => $data->moveto))) {
            print_error('errorfindingcategory', 'totara_core');
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
        if (! $destcategory = $DB->get_record("course_categories", array("id" => $data->moveto))) {
            print_error('errorfindingcategory', 'totara_core');
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
        $blockname = $DB->get_field('block', 'name', array('id' => $blocklist));

        $courseids = array();
        $courseids = $DB->get_records_sql("
                SELECT id FROM {course} WHERE id IN (
                    SELECT DISTINCT ctx.instanceid
                    FROM {context} ctx
                    JOIN {block_instances} bi ON bi.parentcontextid = ctx.id
                    WHERE ctx.contextlevel = " . CONTEXT_COURSE . " AND bi.blockname = ?)",
                array($blockname));

        if (!empty($courseids)) {
            $firstcourse = $page * $perpage;
            $lastcourse = $page * $perpage + $perpage - 1;
            $i = 0;
            foreach ($courseids as $courseid) {
                if ($i >= $firstcourse && $i <= $lastcourse) {
                    $results['courses'][$courseid->id] = $DB->get_record('course', array('id' => $courseid->id));
                }
                $i++;
            }
            $totalcount['courses'] += count($courseids);
        }
    }
    // get list of courses containing modules if required
    elseif (!empty($modulelist) and confirm_sesskey()) {
        $sql =  "SELECT DISTINCT c.id FROM {".$modulelist."} module, {course} c"
            ." WHERE module.course=c.id";

        $courseids = $DB->get_records_sql($sql);

        if (!empty($courseids)) {
            $firstcourse = $page*$perpage;
            $lastcourse = $page*$perpage + $perpage -1;
            $i = 0;
            foreach ($courseids as $courseid) {
                if ($i>= $firstcourse && $i<=$lastcourse) {
                    $results['courses'][$courseid->id] = $DB->get_record('course', array('id' => $courseid->id));
                }
                $i++;
            }
            $totalcount['courses'] += count($courseids);
        }
    } else {

        $coursecount = 0;
        $results['courses'] = get_courses_search($searchterms, "fullname ASC",
            $page, $perpage, $coursecount, true);

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
        $whereparams = array();
    } else {
        // Get category context path
        $catcontext = context_coursecat::instance($category);
        $programwhere = $DB->sql_like('ctx.path', '?');
        $whereparams = array("{$catcontext->path}/%");
    }

    $programcount = 0;
    $results['programs'] = prog_get_programs_search($searchterms, "fullname ASC", $page, $perpage, $programcount, $programwhere, $whereparams);

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

/**
 * Setup admin page if required
 */
if ($isadminediting) {
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

    admin_externalpage_setup($adminpage, $editbutton, array(), new moodle_url('/course/search.php'));
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
        $strfind = get_string('findcourses', 'totara_core');
    } else {
        $strfind = get_string('findprograms', 'totara_program');
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
    $terms = get_string('showall'.$viewtype.'s', 'totara_coursecatalog');
}
$navlinks[] = array('name' => $terms, 'link' => null, 'type' => 'misc');
$navigation = build_navigation($navlinks);


/**
 * Print header and navigation
 */
if ($isadminediting) {
    echo $OUTPUT->header();
} else {
    $PAGE->set_title("$site->fullname: $strsearchresults");
    $PAGE->set_heading($site->fullname);
    /* SCANMSG: may be additional work required for $navigation variable */
    $PAGE->set_focuscontrol("");
    $PAGE->set_cacheable("");
    $PAGE->set_button($editbutton);
    echo $OUTPUT->header();
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
        $browselink .= get_string('browsebycategory', 'totara_coursecatalog');
        $browselink .= '</a>';
    } else {
        $browselink .= '<a '.$cssclass.' href="'.$CFG->wwwroot.'/course/category.php?viewtype='.$viewtype.'&id='.$category.'">';
        $browselink .= "&laquo; ";
        if ($category == 0) {
            $browselink .= get_string('backtoall'.$viewtype, 'totara_coursecatalog');
        } else {
            $categoryname = $displaylist[$category];
            $browselink .= get_string('backtocategoryx', 'totara_coursecatalog', $categoryname);
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

$buttoncontainer = null;
if ($isediting) {
    $newcat = ($category > 0) ? $category : $CFG->defaultrequestcategory;
    $buttoncontainer = $OUTPUT->container_start();
    if ($viewtype == 'course' && has_capability('moodle/course:create', $categorycontext)) {
        /// Print button to create a new course
        $buttoncontainer .= $OUTPUT->single_button(new moodle_url('edit.php', array('category' => $newcat)), get_string('addnewcourse'), 'get');
    }

    if ($viewtype == 'program' && has_capability('totara/program:createprogram', $categorycontext)) {
        /// Print button to create a new program
        $buttoncontainer .= $OUTPUT->single_button(new moodle_url($CFG->wwwroot.'/totara/program/add.php', array('category' => $newcat)), get_string('addnewprogram', 'totara_program'), 'get');
    }
    $buttoncontainer .= $OUTPUT->container_end();
}

if (strlen($search)) {
    echo $OUTPUT->heading($strsearchresults);
} else {
    if ($viewtype == 'course') {
        echo $OUTPUT->heading(get_string('viewallcourses'));
    } else if ($viewtype == 'program') {
        echo $OUTPUT->heading(get_string('viewallprograms', 'totara_program'));
    } else {
        echo $OUTPUT->heading(get_string('viewallcategories'));
    }
}

// Print link to program search results
if (in_array($viewtype, array('course', 'all'))) {
    if (strlen($search)) {
        $programsearch = "{$CFG->wwwroot}/course/search.php?viewtype=program&search={$encodedsearch}";
        if ($category >= 0) {
            $programsearch .= "&category={$category}";
        }
        echo "<a class=\"search_alternate\" href=\"{$programsearch}\">".get_string('performsearchonprograms', 'totara_coursecatalog')."</a>";
    } else {
        echo $browselink;
    }
}
// Print link to course search results
if (in_array($viewtype, array('program', 'all'))) {
    if (strlen($search)) {
        $programsearch = "{$CFG->wwwroot}/course/search.php?viewtype=course&search={$encodedsearch}";
        if ($category >= 0) {
            $programsearch .= "&category={$category}";
        }
        echo "<a class=\"search_alternate\" href=\"{$programsearch}\">".get_string('performsearchoncourses', 'totara_coursecatalog')."</a>";
    } else {
        echo $browselink;
    }
}

//print a 'toolbar' table with search and editing options
$stralllink = get_string('viewall'.$viewtype.'s', 'totara_coursecatalog');
$toolbar = array('top' => array());
$toolbar['top'][0] = array();
$toolbar['top'][0]['left'] = array(print_totara_search('', false, $viewtype, 0));
if ($buttoncontainer) {
    $toolbar['top'][0]['right'] = array($buttoncontainer);
}
$toolbar['top'][1]['left'] = array(html_writer::link(new moodle_url('/course/search.php', array('category' => '0', 'viewtype' => $SESSION->viewtype, 'search' => '')), $stralllink));
echo '<table border="0" class="generalbox totaratable fullwidth boxaligncenter">';
$renderer = $PAGE->get_renderer('totara_core');
$renderer->print_toolbars('top', 2, $toolbar['top']);
echo '</table>';
/**
 * Finally, display results
 */


if ($results['courses']) {

    ///add the module parameter to the paging bar if they exists
    $modulelink = "";
    if (!empty($modulelist) and confirm_sesskey()) {
        $modulelink = "&amp;modulelist=".$modulelist."&amp;sesskey=".$USER->sesskey;
    }

    // If search by term, show count of matches
    if (strlen($search)) {
        $langdata = new stdClass();
        $langdata->count = $totalcount['courses'];
        $langdata->terms = $search;
        if ($langdata->count > 1) {
            echo $OUTPUT->heading(get_string('searchcoursesmatchesplural', 'totara_coursecatalog', $langdata), 3);
        } else {
            echo $OUTPUT->heading(get_string('searchcoursesmatchessingle', 'totara_coursecatalog', $langdata), 3);
        }
    } else {
        echo '<div class="clearfix"></div>';
    }

    print_navigation_bar($totalcount['courses'], $page, $perpage, $encodedsearch, $modulelink);

    if (!$isediting) {
        // Show browse view.
        echo $OUTPUT->spacer(array('height' => 5, 'width' => 5));
        foreach ($results['courses'] as $course) {
            $course->summary .= "<br /><p class=\"category\">";
            $course->summary .= "$strcategory: <a href=\"category.php?viewtype=course&id=$course->category\">";
            $course->summary .= $displaylist[$course->category];
            $course->summary .= "</a></p>";
            print_course($course, $search);
        }
    } else {
        // Show editing UI.
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

        foreach ($results['courses'] as $course) {
            ++$i;
            $rowclass = $i % 2 ? 'r0' : 'r1';
            $course->icon = (empty($course->icon)) ? 'default' : $course->icon;
            if (isset($course->context)) {
                $coursecontext = $course->context;
            } else {
                $coursecontext = context_course::instance($course->id);
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
            echo "<td class=\"cell c0 centrevertical\">";
            echo $OUTPUT->pix_icon('courseicons/'. $course->icon, '', 'totara_core', array('class' => 'course_icon'));
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
                echo "<input type=\"checkbox\" name=\"c{$course->id}\" />\n";
            } else {
                echo "<input type=\"checkbox\" name=\"c{$course->id}\" disabled=\"disabled\" />\n";
            }

            echo "</td>\n";
            echo "<td class=\"cell c3\">\n";

            // checks whether user can update course settings
            if (has_capability('moodle/course:update', $coursecontext)) {
                echo $OUTPUT->action_icon(new moodle_url('/course/edit.php',
                                    array('id' => $course->id)),
                                    new pix_icon('t/edit', get_string("settings")));
            }

            // checks whether user can do role assignment
            if (has_capability('moodle/role:assign', $coursecontext)) {
                echo $OUTPUT->action_icon(new moodle_url('/'.$CFG->admin.'/roles/assign.php', array('contextid' => $coursecontext->id)),
                                        new pix_icon('i/roles', get_string('assignroles', 'role')));
            }

            // checks whether user can delete course
            if (has_capability('moodle/course:delete', $coursecontext)) {
                echo $OUTPUT->action_icon(new moodle_url('/course/delete.php', array('id' => $course->id)),
                                        new pix_icon('t/delete', get_string("delete")));
            }

            // MDL-8885, users with no capability to view hidden courses, should not be able to lock themselves out
            if (has_capability('moodle/course:visibility', $coursecontext) && has_capability('moodle/course:viewhiddencourses', $coursecontext)) {
                if (!empty($course->visible)) {
                    echo $OUTPUT->action_icon(new moodle_url('/course/search.php',
                    array('search' => $encodedsearch, 'page' => $page, 'perpage' => $perpage,
                        'hide' => $course->id, 'sesskey' => sesskey(), 'viewtype' => 'course')),
                    new pix_icon('t/hide', get_string("hide")));
                } else {
                    echo $OUTPUT->action_icon(new moodle_url('/course/search.php',
                    array('search' => $encodedsearch, 'page' => $page, 'perpage' => $perpage,
                        'show' => $course->id, 'sesskey' => sesskey(), 'viewtype' => 'course')),
                    new pix_icon('t/show', get_string("show")));
                }
            }

            // checks whether user can do course backup
            if (has_capability('moodle/backup:backupcourse', $coursecontext)) {
                echo $OUTPUT->action_icon(new moodle_url('/backup/backup.php', array('id' => $course->id)),
                        new pix_icon('t/backup', get_string("backup")));
            }

            // checks whether user can do course restore
            if (has_capability('moodle/restore:restorecourse', $coursecontext)) {
                echo $OUTPUT->action_icon(new moodle_url('/backup/restorefile.php', array('contextid' => $coursecontext->id)),
                        new pix_icon('t/restore', get_string("restore")));
            }

            echo "</td>\n</tr>\n";
        }
        echo "<tr>\n<td colspan=\"4\" >\n";
        echo "<br />";
        echo "<input type=\"button\" onclick=\"checkall()\" value=\"$strselectall\" />\n";
        echo "<input type=\"button\" onclick=\"checknone()\" value=\"$strdeselectall\" />\n";

        $attributes = array();
        $attributes['class'] = 'totara-limited-width';
        $attributes['onchange'] = 'if (document.all) { this.className=\'totara-limited-width\';} getElementById(\'movecourses\').submit();';
        $attributes['onmousedown'] = 'if (document.all) this.className=\'totara-expanded-width\';';
        $attributes['onblur'] = 'if (document.all) this.className=\'totara-limited-width\';';
        echo html_writer::select($displaylist, "moveto", "", array(null => get_string("moveselectedcoursesto")), $attributes);

        echo "</td>\n</tr>\n";
        echo "</table>\n</form>";

    }

    print_navigation_bar($totalcount['courses'], $page, $perpage, $encodedsearch, $modulelink);

} else if (in_array($viewtype, array('course', 'all'))) {
    if (!empty($search)) {
        echo $OUTPUT->heading(get_string("nocoursesfound", "", s($search, true)));
        print_string("searchhelp");
    }
    else {
        echo $OUTPUT->heading($strnocourses);
    }
}

if ($results['programs']) {

    // If search by term, show count of matches
    if (strlen($search)) {
        $langdata = new stdClass();
        $langdata->count = $totalcount['programs'];
        $langdata->terms = $search;
        if ($langdata->count > 1) {
            echo $OUTPUT->heading(get_string('searchprogramsmatchesplural', 'totara_coursecatalog', $langdata), 3);
        } else {
            echo $OUTPUT->heading(get_string('searchprogramsmatchessingle', 'totara_coursecatalog', $langdata), 3);
        }
    } else {
        echo '<div class="clearfix"></div>';
    }

    print_navigation_bar($totalcount['programs'], $page, $perpage, $encodedsearch, '');

    if (!$isediting) {
        // Show browse view.
        echo $OUTPUT->spacer(array('height' => 5, 'width' => 5));
        foreach ($results['programs'] as $program) {
            $program->summary .= "<br /><p class=\"category\">";
            $program->summary .= "$strcategory: <a href=\"category.php?viewtype=program&id=$program->category\">";
            $program->summary .= $displaylist[$program->category];
            $program->summary .= "</a></p>";
            prog_print_program($program, $search);
        }
    } else {
        // Show editing UI.
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

        foreach ($results['programs'] as $program) {
            ++$i;
            $rowclass = $i % 2 ? 'r0' : 'r1';
            $program->icon = (empty($program->icon)) ? 'default' : $program->icon;
            if (isset($program->context)) {
                $programcontext = $program->context;
            } else {
                $programcontext = context_program::instance($program->id);
            }

            $linkcss = $program->visible ? "" : " class=\"dimmed\" ";

            echo "<tr class=\"{$rowclass}\">\n";
            echo "<td class=\"cell c0\">";
            echo $OUTPUT->pix_icon('programicons/'. $program->icon, '', 'totara_core', array('class' => 'program_icon'));
            echo "<a $linkcss href=\"{$CFG->wwwroot}/totara/program/view.php?id=$program->id\">"
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

            $canconfigureprogram = has_capability('totara/program:configureprogram', $programcontext);
            // checks whether user can update program settings
            if ($canconfigureprogram) {
                echo $OUTPUT->action_icon(new moodle_url('/totara/program/edit.php',
                        array('id' => $program->id)),
                        new pix_icon('t/edit', get_string("settings")));
            }

            // checks whether user can delete program
            if (has_capability('totara/program:deleteprogram', $programcontext)) {
                echo $OUTPUT->action_icon(new moodle_url('/totara/program/edit.php',
                        array('id' => $program->id, 'action' => 'delete')),
                        new pix_icon('t/delete', get_string("delete")));
            }

            // users with no capability to view hidden programs should not be able to lock themselves out
            if ($canconfigureprogram && has_capability('totara/program:viewhiddenprograms', $programcontext)) {
                if (!empty($aprogram->visible)) {
                    echo $OUTPUT->action_icon(new moodle_url('/course/search.php',
                            array('search' => $encodedsearch, 'page' => $page, 'perpage' => $perpage, 'hide' => $program->id, 'sesskey' => $USER->sesskey, 'viewtype' => 'program')),
                            new pix_icon('t/hide', get_string("hide")));
                } else {
                    echo $OUTPUT->action_icon(new moodle_url('/course/search.php',
                            array('search' => $encodedsearch, 'page' => $page, 'perpage' => $perpage, 'show' => $program->id, 'sesskey' => $USER->sesskey, 'viewtype' => 'program')),
                            new pix_icon('t/hide', get_string("show")));
                }
            }

            echo "</td>\n</tr>\n";
        }
        echo "<tr>\n<td colspan=\"4\" >\n";
        echo "<br />";
        echo "<input type=\"button\" onclick=\"checkall()\" value=\"$strselectall\" />\n";
        echo "<input type=\"button\" onclick=\"checknone()\" value=\"$strdeselectall\" />\n";

        $attributes = array();
        $attributes['class'] = 'totara-limited-width';
        $attributes['onchange'] = 'if (document.all) { this.className=\'totara-limited-width\';} getElementById(\'movecourses\').submit();';
        $attributes['onmousedown'] = 'if (document.all) this.className=\'totara-expanded-width\';';
        $attributes['onblur'] = 'if (document.all) this.className=\'totara-limited-width\';';
        echo html_writer::select($displaylist, "moveto", "", array(null => get_string('moveselectedprogramsto', 'totara_program')), $attributes);

        echo "</td>\n</tr>\n";
        echo "</table>\n</form>";
    }
    print_navigation_bar($totalcount['programs'], $page, $perpage, $encodedsearch, '');

} else if (in_array($viewtype, array('program', 'all'))) {
    if (!empty($search)) {
        echo $OUTPUT->heading(get_string("noprogramsfound", "totara_coursecatalog", s($search, true)));
        print_string("searchhelp");
    }
    else {
        echo $OUTPUT->heading($strnoprograms);
    }
}

if ($results['categories']) {

    // If search by term, show count of matches
    if (strlen($search)) {
        $langdata = new stdClass();
        $langdata->count = $totalcount['categories'];
        $langdata->terms = $search;
        if ($langdata->count > 1) {
            echo $OUTPUT->heading(get_string('searchcategoriesmatchesplural', 'moodle', $langdata), 3);
        } else {
            echo $OUTPUT->heading(get_string('searchcategoriesmatchessingle', 'moodle', $langdata), 3);
        }
    } else {
        echo '<div class="clearfix"></div>';
    }

    print_navigation_bar($totalcount['categories'], $page, $perpage, $encodedsearch, '');

    if (!$isediting) {
        // Show browse view.
        echo $OUTPUT->spacer(array('height' => 5, 'width' => 5));
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
        // Show editing UI.
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

            $categorycontext = context_coursecat::instance($cat->id);

            $linkcss = $cat->visible ? "" : " class=\"dimmed\" ";

            echo "<tr class=\"{$rowclass}\">\n";
            echo "<td class=\"cell c0\">";
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

            if ($canmanagethesecategories) {
                $actions .= '<a title="'.$str->edit.'" href="editcategory.php?id='.$cat->id.'"><img'.
                    ' src="'.$OUTPUT->pix_url('/t/edit') . '" class="iconsmall" alt="'.$str->edit.'" /></a> ';

                $actions .= '<a title="'.$str->roles.'" href="'.$CFG->wwwroot.'/admin/roles/assign.php?contextid='.
                    $cat->context->id.'"><img src="'.$OUTPUT->pix_url('/i/roles') . '" class="iconsmall" alt="'.$str->roles.
                    '" /></a>';

                $actions .= '<a title="'.$str->delete.'" href="index.php?delete='.$cat->id.'&amp;sesskey='.sesskey().'"><img'.
                    ' src="'.$OUTPUT->pix_url('/t/delete') . '" class="iconsmall" alt="'.$str->delete.'" /></a> ';

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
        echo "</table>";
    }
    print_navigation_bar($totalcount['categories'], $page, $perpage, $encodedsearch, '');

} else if (in_array($viewtype, array('category', 'all'))) {
    if (!empty($search)) {
        echo $OUTPUT->heading(get_string("nocategoriesfound", "", s($search, true)));
        print_string("searchhelp");
    }
    else {
        echo $OUTPUT->heading($strnoprograms);
    }
}

echo $OUTPUT->footer();

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
    global $OUTPUT;
    $url = "search.php?search=$encodedsearch".$modulelink."&amp;perpage=$perpage&amp;";
    $pagingbar = new paging_bar($totalcount, $page, $perpage, $url);
    $pagingbar->pagevar = 'page';
    echo $OUTPUT->render($pagingbar);

    // display
    if ($perpage != 99999 && $totalcount > $perpage) {
        echo "<center><p>";
        echo "<a href=\"search.php?search=$encodedsearch".$modulelink."&amp;perpage=99999\">".get_string("showall", "", $totalcount)."</a>";
        echo "</p></center>";
    }
}

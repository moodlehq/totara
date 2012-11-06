<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage program
 */

require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/lib/datalib.php');
require_once($CFG->dirroot . '/lib/ddllib.php');
require_once($CFG->dirroot . '/totara/program/program.class.php');

/**
 * Can logged in user view user's required learning
 *
 * @access  public
 * @param   int     $learnerid   Learner's id
 * @return  boolean
 */
function prog_can_view_users_required_learning($learnerid) {
    global $USER;

    if (!isloggedin()) {
        return false;
    }

    $systemcontext = context_system::instance();

    // If the user can view any programs
    if (has_capability('totara/program:accessanyprogram', $systemcontext)) {
        return true;
    }

    // If the user cannot view any programs
    if (!has_capability('totara/program:viewprogram', $systemcontext)) {
        return false;
    }

    // If this is the current user's own required learning
    if ($learnerid == $USER->id) {
        return true;
    }

    // If this user is their manager
    if (totara_is_manager($learnerid)) {
        return true;
    }

    return false;
}

/**
 * Return a list of a user's required programs or a count
 *
 * @global object $DB
 * @param int $userid
 * @param string $sort The order in which to sort the programs
 * @param int $limitfrom return a subset of records, starting at this point (optional, required if $limitnum is set).
 * @param int $limitnum return a subset comprising this many records (optional, required if $limitfrom is set).
 * @param bool $returncount Whether to return a count of the number of records found or the records themselves
 * @param bool $showhidden Whether to include hidden programs in records returned
 * @return array|int
 */
function prog_get_required_programs($userid, $sort='', $limitfrom='', $limitnum='', $returncount=false, $showhidden=false) {
    global $DB;

    // Construct sql query
    $count = 'SELECT COUNT(*) ';
    $select = 'SELECT p.*, p.fullname AS progname, pc.timedue AS duedate ';
    list($insql, $params) = $DB->get_in_or_equal(array(PROGRAM_EXCEPTION_RAISED, PROGRAM_EXCEPTION_DISMISSED), SQL_PARAMS_QM, 'param', false);
    $from = "FROM {prog} p
            INNER JOIN {prog_completion} pc ON p.id = pc.programid AND pc.coursesetid = 0
            INNER JOIN (SELECT DISTINCT userid, programid FROM {prog_user_assignment}
            WHERE exceptionstatus {$insql}) pua
            ON (pc.programid = pua.programid AND pc.userid = pua.userid)";

    $where = "WHERE pc.userid = ?
            AND pc.status <> ?";
    $params[] = $userid;
    $params[] = STATUS_PROGRAM_COMPLETE;
    if (!$showhidden) {
        $where .= " AND p.visible = ?";
        $params[] = 1;
    }

    if ($returncount) {
        return $DB->count_records_sql($count.$from.$where, $params);
    } else {
        return $DB->get_records_sql($select.$from.$where.$sort, $params, $limitfrom, $limitnum);
    }
}

/**
 * Return markup for displaying a table of a specified user's required programs
 * (i.e. programs that have been automatically assigned to the user)
 *
 * This includes hidden programs but excludes unavailable programs
 *
 * @access  public
 * @param   int     $userid     Program assignee
 * @return  string
 */
function prog_display_required_programs($userid) {
    global $CFG, $OUTPUT;

    $count = prog_get_required_programs($userid, '', '', '', true, true);

    // Set up table
    $tablename = 'progs-list';
    $tableheaders = array(get_string('programname', 'totara_program'));
    $tablecols = array('progname');

    // Due date
    $tableheaders[] = get_string('duedate', 'totara_program');
    $tablecols[] = 'duedate';

    // Progress
    $tableheaders[] = get_string('progress', 'totara_program');
    $tablecols[] = 'progress';

    $baseurl = $CFG->wwwroot . '/totara/program/required.php?userid='.$userid;

    $table = new flexible_table($tablename);
    $table->define_headers($tableheaders);
    $table->define_columns($tablecols);
    $table->define_baseurl($baseurl);
    $table->set_attribute('class', 'fullwidth');
    $table->set_control_variables(array(
        TABLE_VAR_SORT    => 'tsort',
    ));
    $table->sortable(true);
    $table->no_sorting('progress');

    $table->setup();
    $table->pagesize(15, $count);
    $sort = $table->get_sql_sort();
    $sort = empty($sort) ? '' : ' ORDER BY '.$sort;

    // Add table data
    $programs = prog_get_required_programs($userid, $sort, $table->get_page_start(), $table->get_page_size(), false, true);

    if (!$programs) {
        return '';
    }
    $rowcount = 0;
    foreach ($programs as $p) {
        $program = new program($p->id);
        if (!$program->is_accessible()) {
            continue;
        }
        $row = array();
        $row[] = $program->display_summary_widget($userid);
        $row[] = $program->display_duedate($p->duedate);
        $row[] = $program->display_progress($userid);
        $table->add_data($row);
        $rowcount++;
    }

    unset($programs);

    if ($rowcount > 0) {
        //2.2 flexible_table class no longer supports $table->data and echos directly on each call to add_data
        ob_start();
        $table->finish_html();
        $out = ob_get_contents();
        ob_end_clean();
        return $out;
    } else {
        return '';
    }
}

/**
 * Display the user message box
 *
 * @access public
 * @param  int    $programuser the id of the user
 * @return string $out      the display code
 */
function prog_display_user_message_box($programuser) {
    global $CFG, $PAGE, $DB;
    $user = $DB->get_record('user', array('id' => $programuser));
    if (!$user) {
        return false;
    }
    $userpic = new user_picture();
    $userpic->user = $user;
    $userpic->courseid = 1;

    $a = new stdClass();
    $a->name = fullname($user);
    $a->userid = $programuser;
    $a->site = $CFG->wwwroot;

    $renderer = $PAGE->get_renderer('totara_program');
    $out = $renderer->display_user_message_box($userpic, $a);
    return $out;
}

/**
 * Add lowest levels of breadcrumbs to program
 *
 * @return void
 */
function prog_add_base_navlinks() {
    global $PAGE;

    $PAGE->navbar->add(get_string('browsecategories', 'totara_program'), new moodle_url('/course/index.php', array('viewtype' => 'program')));
}

/**
 * Add lowest levels of breadcrumbs to required learning
 *
 * Exact links added depends on if the require learning being viewed belongs
 * to the current user or not.
 *
 * @param array &$navlinks The navlinks array to update (passed by reference)
 * @param integer $userid ID of the required learning's owner
 *
 * @return boolean True if it is the user's own required learning
 */
function prog_add_required_learning_base_navlinks($userid) {
    global $USER, $PAGE, $DB;

    // the user is viewing their own learning
    if ($userid == $USER->id) {
        $PAGE->navbar->add(get_string('mylearning', 'totara_core'), '/my/');
        $PAGE->navbar->add(get_string('requiredlearning', 'totara_program'), new moodle_url('/totara/program/required.php'));
        return true;
    }

    // the user is viewing someone else's learning
    $user = $DB->get_record('user', array('id' => $userid));
    if ($user) {
        $PAGE->navbar->add(get_string('myteam', 'totara_core'), new moodle_url('/my/teammembers.php'));
        $PAGE->navbar->add(get_string('xsrequiredlearning', 'totara_program', fullname($user)), new moodle_url('/totara/program/required.php', array('userid' => $userid)));
    } else {
        $PAGE->navbar->add(get_string('unknownusersrequiredlearning', 'totara_program'), new moodle_url('/totara/program/required.php', array('userid' => $userid)));
    }

    return true;
}

/**
 * Returns list of programs, for whole site, or category
 * (This is the counterpart to get_courses in /lib/datalib.php)
 */
function prog_get_programs($categoryid="all", $sort="p.sortorder ASC", $fields="p.*") {

    global $USER, $DB;

    $params = array(CONTEXT_PROGRAM);
    if ($categoryid != "all" && is_numeric($categoryid)) {
        $categoryselect = "WHERE p.category = ?";
        $params[] = $categoryid;
    } else {
        $categoryselect = "";
    }

    if (empty($sort)) {
        $sortstatement = "";
    } else {
        $sortstatement = "ORDER BY $sort";
    }

    $visibleprograms = array();

    // pull out all programs matching the cat
    $programs = $DB->get_records_sql("SELECT $fields,
                                    ctx.id AS ctxid, ctx.path AS ctxpath,
                                    ctx.depth AS ctxdepth, ctx.contextlevel AS ctxlevel
                                    FROM {prog} p
                                    JOIN {context} ctx
                                      ON (p.id = ctx.instanceid
                                          AND ctx.contextlevel = ?)
                                    $categoryselect
                                    $sortstatement", $params);

    // loop through them
    foreach ($programs as $program) {
        if (isset($program->visible) && $program->visible <= 0) {
            // for hidden programs, require visibility check
            if (has_capability('totara/program:viewhiddenprograms', program_get_context($program->id))) {
                $visibleprograms[] = $program;
            }
        } else {
            $visibleprograms[] = $program;
        }
    }

    return $visibleprograms;

}

/**
 * Returns list of courses and programs, for whole site, or category
 * (This is the counterpart to get_courses_page in /lib/datalib.php)
 *
 * Similar to prog_get_programs, but allows paging
 *
 */
function prog_get_programs_page($categoryid="all", $sort="sortorder ASC",
                          $fields="p.id,p.sortorder,p.shortname,p.fullname,p.summary,p.visible",
                          &$totalcount, $limitfrom="", $limitnum="") {

    global $DB;

    $params = array(CONTEXT_PROGRAM);
    $categoryselect = "";
    if ($categoryid != "all" && is_numeric($categoryid)) {
        $categoryselect = " WHERE p.category = ? ";
        $params[] = $categoryid;
    }

    // pull out all programs matching the cat
    $visibleprograms = array();

    $progselect = "SELECT $fields, 'program' AS listtype,
                          ctx.id AS ctxid, ctx.path AS ctxpath,
                          ctx.depth AS ctxdepth, ctx.contextlevel AS ctxlevel
                   FROM {prog} p
                   JOIN {context} ctx
                     ON (p.id = ctx.instanceid AND ctx.contextlevel = ?)";

    $select = $progselect.$categoryselect.' ORDER BY '.$sort;

    $rs = $DB->get_recordset_sql($select, $params);

    $totalcount = 0;

    if (!$limitfrom) {
        $limitfrom = 0;
    }

    // iteration will have to be done inside loop to keep track of the limitfrom and limitnum
    foreach ($rs as $program) {
        if ($program->visible <= 0) {
            // for hidden programs, require visibility check
            if (has_capability('totara/program:viewhiddenprograms', program_get_context($program->id))) {
                $totalcount++;
                if ($totalcount > $limitfrom && (!$limitnum or count($visibleprograms) < $limitnum)) {
                    $visibleprograms [] = $program;
                }
            }
        } else {
            $totalcount++;
            if ($totalcount > $limitfrom && (!$limitnum or count($visibleprograms) < $limitnum)) {
                $visibleprograms [] = $program;
            }
        }
    }

    $rs->close();

    return $visibleprograms;
}

/**
 * Efficiently moves many programs around while maintaining
 * sortorder in order.
 * (This is the counterpart to move_courses in /course/lib.php)
 *
 * $programids is an array of program ids
 *
 **/
function prog_move_programs ($programids, $categoryid) {

    global $DB, $OUTPUT;

    if (!empty($programids)) {

            $programids = array_reverse($programids);

            foreach ($programids as $programid) {

                if (!$program  = $DB->get_record("prog", array("id" => $programid))) {
                    echo $OUTPUT->notification(get_string('error:findingprogram', 'totara_program'));
                } else {
                    // figure out a sortorder that we can use in the destination category
                    $sortorder = $DB->get_field_sql('SELECT MIN(sortorder)-1 AS min
                                                    FROM {prog} WHERE category = ?', array($categoryid));
                    if (is_null($sortorder) || $sortorder === false) {
                        // the category is empty
                        // rather than let the db default to 0
                        // set it to > 100 and avoid extra work in fix_program_sortorder()
                        $sortorder = 200;
                    } else if ($sortorder < 10) {
                        prog_fix_program_sortorder($categoryid);
                    }

                    $program->category  = $categoryid;
                    $program->sortorder = $sortorder;

                    if (!$DB->update_record('prog', $program)) {
                        echo $OUTPUT->notification(get_string('error:prognotmoved', 'totara_program'));
                    }

                    $context   = context_program::instance($program->id);
                    $newparent = context_coursecat::instance($program->category);
                    context_moved($context, $newparent);
                }
            }
            prog_fix_program_sortorder();
        }
    return true;
}

/**
 * (This is the counterpart to print_courses in /course/lib.php)
 *
 * @global <type> $CFG
 * @param <type> $category
 */
function prog_print_programs($category) {
/// Category is 0 (for all programs) or an object

    global $OUTPUT, $USER;

    $fields = "p.id,p.sortorder,p.shortname,p.fullname,p.summary,p.visible";

    if (!is_object($category) && $category==0) {
        $categories = get_child_categories(0);  // Parent = 0   ie top-level categories only
        if (is_array($categories) && count($categories) == 1) {
            $category = array_shift($categories);
            $programs = prog_get_programs($category->id, 'p.sortorder ASC', $fields);
        } else {
            $programs = prog_get_programs('all', 'p.sortorder ASC', $fields);
        }
        unset($categories);
    } else {
        $programs = prog_get_programs($category->id, 'p.sortorder ASC', $fields);
    }

    if ($programs) {
        foreach ($programs as $program) {
            $prog = new program($program->id);
            if (!$prog->is_accessible($USER)) {
                continue;
            }
            if ($program->visible == 1
                || has_capability('totara/program:viewhiddenprograms', program_get_context($program->id))) {
                prog_print_program($program);
            }
        }
    } else {
        echo $OUTPUT->heading(get_string("noprogramsyet", 'totara_program'));
        $context = context_system::instance();
        if (has_capability('totara/program:createprogram', $context)) {
            $options = array();
            $options['category'] = $category->id;
            echo html_writer::start_tag('div', array('class' => 'addprogrambutton'));
            echo $OUTPUT->single_button(new moodle_url('/totara/program/add.php', $options), get_string("addnewprogram", 'totara_program'), 'get');
            echo html_writer::end_tag('div');
        }
    }
}

/**
 * This recursive function makes sure that the program order is consecutive
 * (This is the counterpart to fix_course_sortorder in /lib/datalib.php)
 *
 * $n is the starting point, offered only for compatilibity -- will be ignored!
 * $safe (bool) prevents it from assuming category-sortorder is unique, used to upgrade
 * safely from 1.4 to 1.5
 *
 * @global <type> $CFG
 * @param <type> $categoryid
 * @param <type> $n
 * @param <type> $safe
 * @param <type> $depth
 * @param <type> $path
 * @return <type>
 */
function prog_fix_program_sortorder($categoryid=0, $n=0, $safe=0, $depth=0, $path='') {

    global $DB;

    $count = 0;

    $catgap    = 1000; // "standard" category gap
    $tolerance = 200;  // how "close" categories can get

    if ($categoryid > 0){
        // update depth and path
        $cat   = $DB->get_record('course_categories', array('id' => $categoryid));
        if ($cat->parent == 0) {
            $depth = 0;
            $path  = '';
        } else if ($depth == 0 ) { // doesn't make sense; get from DB
            // this is only called if the $depth parameter looks dodgy
            $parent = $DB->get_record('course_categories', array('id' => $cat->parent));
            $path  = $parent->path;
            $depth = $parent->depth;
        }
        $path  = $path . '/' . $categoryid;
        $depth = $depth + 1;

        if ($cat->path !== $path) {
            $DB->set_field('course_categories', 'path', $path, array('id' => $categoryid));
        }
        if ($cat->depth != $depth) {
            $DB->set_field('course_categories', 'depth', $depth, array('id' => $categoryid));
        }
    }

    // get some basic info about programs in the category
    $info = $DB->get_record_sql('SELECT MIN(sortorder) AS min,
                                        MAX(sortorder) AS max,
                                        COUNT(sortorder)  AS count
                                   FROM {prog}
                                  WHERE category = ?', array($categoryid));
    if (is_object($info)) { // no courses?
        $max   = $info->max;
        $count = $info->count;
        $min   = $info->min;
        unset($info);
    }

    if ($categoryid > 0 && $n == 0) { // only passed category so don't shift it
        $n = $min;
    }

    // $hasgap flag indicates whether there's a gap in the sequence
    $hasgap    = false;
    if ($max-$min+1 != $count) {
        $hasgap = true;
    }

    // $mustshift indicates whether the sequence must be shifted to
    // meet its range
    $mustshift = false;
    if ($min < $n-$tolerance || $min > $n+$tolerance+$catgap ) {
        $mustshift = true;
    }

    // actually sort only if there are programs,
    // and we meet one ofthe triggers:
    //  - safe flag
    //  - they are not in a continuos block
    //  - they are too close to the 'bottom'
    if ($count && ( $safe || $hasgap || $mustshift ) ) {
        // special, optimized case where all we need is to shift
        if ($mustshift && !$safe && !$hasgap) {
            $shift = $n + $catgap - $min;
            if ($shift < $count) {
                $shift = $count + $catgap;
            }

            $DB->execute("UPDATE {prog}
                         SET sortorder = sortorder + ?
                         WHERE category = ?", array($shift, $categoryid));
            $n = $n + $catgap + $count;

        } else { // do it slowly
            $n = $n + $catgap;
            // if the new sequence overlaps the current sequence, lack of transactions
            // will stop us -- shift things aside for a moment...
            if ($safe || ($n >= $min && $n+$count+1 < $min && $DB->get_dbfamily() === 'mysql')) {
                $shift = $max + $n + 1000;
                $DB->execute("UPDATE {prog}
                         SET sortorder = sortorder+$shift
                         WHERE category = ?". array($categoryid));
            }

            $programs = prog_get_programs($categoryid, 'p.sortorder ASC', 'p.id,p.sortorder');

            $transaction = $DB->start_delegated_transaction();

            $tx = true; // transaction sanity
            foreach ($programs as $program) {
                if ($tx && $program->sortorder != $n ) { // save db traffic
                    $tx = $tx && $DB->set_field('prog', 'sortorder', $n, array('id' => $program->id));
                }
                $n++;
            }
            if ($tx) {
                $transaction->allow_commit();
            } else {
                if (!$safe) {
                    // if we failed when called with !safe, try
                    // to recover calling self with safe=true
                    return prog_fix_program_sortorder($categoryid, $n, true, $depth, $path);
                }
            }
        }
    }
    $DB->set_field('course_categories', 'programcount', $count, array('id' => $categoryid));

    // $n could need updating
    $max = $DB->get_field_sql("SELECT MAX(sortorder) from {prog} WHERE category = ?", array($categoryid));
    if ($max > $n) {
        $n = $max;
    }

    if ($categories = get_categories($categoryid)) {
        foreach ($categories as $category) {
            $n = prog_fix_program_sortorder($category->id, $n, $safe, $depth, $path);
        }
    }

    return $n+1;
}

/**
 * Print a description of a program, suitable for browsing in a list.
 * (This is the counterpart to print_course in /course/lib.php)
 *
 * @param object $program the program object.
 * @param string $highlightterms (optional) some search terms that should be highlighted in the display.
 */
function prog_print_program($program, $highlightterms = '') {
    global $PAGE;
    $prog = new program($program->id);

    $accessible = false;
    if ($prog->is_accessible()) {
        $accessible = true;
    }

    if (isset($program->context)) {
        $context = $program->context;
    } else {
        $context = context_program::instance($program->id);
    }

    //object for all info required by renderer
    $data = new stdClass();

    $data->accessible = $accessible;
    $data->visible = $program->visible;
    $data->icon = (empty($prog->icon)) ? 'default' : $prog->icon;
    $data->progid = $program->id;
    $data->fullname = $program->fullname;
    $data->summary = $program->summary;
    $data->highlightterms = $highlightterms;

    $renderer = $PAGE->get_renderer('totara_program');
    echo $renderer->print_program($data);
}

/**
 * Recursive function to print out all the categories in a nice format
 * with or without programs included
 * (This is the counterpart to print_whole_category_list in /course/lib.php)
 *
 * @global <type> $CFG
 * @param <type> $category
 * @param <type> $displaylist
 * @param <type> $parentslist
 * @param <type> $depth
 * @param <type> $showprograms
 * @return <type>
 */
function prog_print_whole_category_list($category=NULL, $displaylist=NULL, $parentslist=NULL, $depth=-1, $showprograms = true) {

    global $CFG;

    // maxcategorydepth == 0 meant no limit
    if (!empty($CFG->maxcategorydepth) && $depth >= $CFG->maxcategorydepth) {
        return;
    }

    if (!$displaylist) {
        make_categories_list($displaylist, $parentslist);
    }

    if ($category) {
        if ($category->visible or has_capability('moodle/category:viewhiddencategories', context_system::instance())) {
            echo prog_print_category_info($category, $depth, $showprograms);
        } else {
            return;  // Don't bother printing children of invisible categories
        }

    } else {
        $category->id = "0";
    }

    if ($categories = get_child_categories($category->id)) {   // Print all the children recursively
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

            prog_print_whole_category_list($cat, $displaylist, $parentslist, $depth + 1, $showprograms);
        }
    }
}

/**
 * Prints the category info in indented fashion
 * This function is only used by prog_print_whole_category_list() above
 * (This is the counterpart to print_category_info in /course/lib.php)
 *
 * @global <type> $CFG
 * @staticvar <type> $strallowguests
 * @staticvar <type> $strrequireskey
 * @staticvar <type> $strsummary
 * @staticvar <type> $coursecount
 * @param <type> $category
 * @param <type> $depth
 * @param <type> $showprograms
 */
function prog_print_category_info($category, $depth, $showprograms = false) {
    global $CFG, $DB, $PAGE;

    static $programcount = null;
    if (null === $programcount) {
        // only need to check this once
        $programcount = $DB->count_records('prog') <= FRONTPAGECOURSELIMIT;
    }

    $programs = prog_get_programs($category->id, 'p.sortorder ASC',
                'p.id,p.sortorder,p.visible,p.fullname,p.shortname,p.summary,p.icon');

    // does the depth exceed maxcategorydepth
    // maxcategorydepth == 0 or unset meant no limit
    $limit = ($CFG->maxcategorydepth == 0) || (!(isset($CFG->maxcategorydepth) && ($depth >= $CFG->maxcategorydepth-1)));

    $renderer = $PAGE->get_renderer('totara_program');
    return $renderer->prog_print_category_info($category, $programs, $depth, $limit, $showprograms, $programcount);
}

/**
 * Print links to page view type
 *
 * @param string $pagetype The type of page the tabs are being displayed on
 * @param string $viewtype Should be either 'program' or 'course'
 * @param array $options
 */
function prog_print_viewtype_selector($pagetype, $viewtype, $options=null) {
    global $CFG;

    switch($pagetype) {
        case 'categoryindex':
            $courselink = $CFG->wwwroot.'/course/category.php?id='.$options->id.'&amp;viewtype=course';
            $programlink = $CFG->wwwroot.'/course/category.php?id='.$options->id.'&amp;viewtype=program';
        break;

        case 'courseindex':
            $courselink = $CFG->wwwroot.'/course/index.php?viewtype=course';
            $programlink = $CFG->wwwroot.'/course/index.php?viewtype=program';
        break;
    }

    if ($viewtype=='course') {
        $currenttab = 'courses';
    } else {
        $currenttab = 'programs';
    }

    $row = array();
    $row[] = new tabobject('courses', $courselink, get_string('courses', 'totara_program'));
    $row[] = new tabobject('programs', $programlink, get_string('programs', 'totara_program'));

    $tabs = array($row);

    echo html_writer::start_tag('div', array('id' => 'viewtypepicker'));
    print_tabs($tabs, $currenttab);
    echo html_writer::end_tag('div');

}

/**
 * Checks whether or not a user should have access to a course that belongs to a
 * program in the user's required learning. If so, the user will be automatically
 * enrolled onto the course as a student.
 *
 * @global object $CFG
 * @param object $user
 * @param object $course
 * @return object $result containing properties:
 *         'enroled' (boolean: whether user is enroled on the course)
 *         'notify' (boolean: whether a new enrolment has been made so notify user)
 *         'program' (string: name of program they have obtained access through)
 */
function prog_can_enter_course($user, $course) {
    global $DB;

    $result = new stdClass();
    $result->enroled = false;
    $result->notify = false;
    $result->program = null;

    $studentrole = get_archetype_roles('student');
    if (empty($studentrole)) {
        return $result;
    }
    $studentrole = reset($studentrole);

    // Get programs containing this course that this user is assigned to, either via learning plans or required learning
    $get_programs = "
        SELECT p.id
          FROM {prog} p
         WHERE p.id IN
             (
                SELECT DISTINCT pc.programid
                  FROM {dp_plan_program_assign} pc
            INNER JOIN {dp_plan} pln ON pln.id = pc.planid
             LEFT JOIN {prog_courseset} pcs ON pc.programid = pcs.programid
             LEFT JOIN {prog_courseset_course} pcsc ON pcs.id = pcsc.coursesetid AND pcsc.courseid = ?
                 WHERE pc.approved >= ?
                   AND pln.userid = ?
                   AND pln.status = ?
             )
            OR p.id IN
             (
                SELECT DISTINCT pua.programid
                  FROM {prog_user_assignment} pua
             LEFT JOIN {prog_completion} pc
                    ON pua.programid = pc.programid AND pua.userid = pc.userid
             LEFT JOIN {prog_courseset} pcs ON pua.programid = pcs.programid
             LEFT JOIN {prog_courseset_course} pcsc ON pcs.id = pcsc.coursesetid AND pcsc.courseid = ?
                 WHERE pua.userid = ?
                   AND pc.coursesetid = ?
                   AND (pc.timedue = ?
                        OR pc.status <> ? )
             )
    ";
    $params = array($course->id, DP_APPROVAL_APPROVED, $user->id, DP_PLAN_STATUS_APPROVED, $course->id, $user->id, 0, COMPLETION_TIME_NOT_SET, STATUS_PROGRAM_COMPLETE);
    $program_records = $DB->get_records_sql($get_programs, $params);

    if (!empty($program_records)) {
        //get program enrolment plugin class
        $program_plugin = enrol_get_plugin('totara_program');
        foreach ($program_records as $program_record) {
            $program = new program($program_record->id);
            if ($program->is_accessible() && $program->can_enter_course($user->id, $course->id)) {
                //check if program enrolment plugin is enabled on this course
                //should be added when coursesets are created but just in case we'll double-check
                $instance = $program_plugin->get_instance_for_course($course->id);
                if (!$instance) {
                    //add it
                    $instanceid = $program_plugin->add_instance($course);
                    $instance = $DB->get_record('enrol', array('id' => $instanceid));
                }
                //check if user is already enroled under the program plugin
                if (!$ue = $DB->get_record('user_enrolments', array('enrolid' => $instance->id, 'userid' => $user->id))) {
                    //enrol them
                    $program_plugin->enrol_user($instance, $user->id, $studentrole->id);
                    $result->enroled = true;
                    $result->notify = true;
                    $result->program = $program->fullname;
                } else {
                    //already enroled
                    $result->enroled = true;
                }
                return $result;
            }
        }
    }
    return $result;
}


/**
 * A list of programs that match a search
 *
 * @uses $DB, $USER
 * @param array $searchterms ?
 * @param string $sort ?
 * @param int $page ?
 * @param int $recordsperpage ?
 * @param int $totalcount Passed in by reference. ?
 * @param string $whereclause Addition where clause
 * @param array $whereparams Parameters needed for $whereclause
 * @return object {@link $COURSE} records
 */
// TODO: Fix this function to work in Moodle 2 way
// See lib/datalib.php -> get_courses_search for example
function prog_get_programs_search($searchterms, $sort='fullname ASC', $page=0, $recordsperpage=50, &$totalcount, $whereclause, $whereparams) {
    global $DB, $USER;

    $REGEXP    = $DB->sql_regex(true);
    $NOTREGEXP = $DB->sql_regex(false);

    $fullnamesearch = '';
    $summarysearch = '';
    $idnumbersearch = '';
    $shortnamesearch = '';

    $fullnamesearchparams = array();
    $summarysearchparams = array();
    $idnumbersearchparams = array();
    $shortnamesearchparams = array();
    $params = array();

    foreach ($searchterms as $searchterm) {
        if ($fullnamesearch) {
            $fullnamesearch .= ' AND ';
        }
        if ($summarysearch) {
            $summarysearch .= ' AND ';
        }
        if ($idnumbersearch) {
            $idnumbersearch .= ' AND ';
        }
        if ($shortnamesearch) {
            $shortnamesearch .= ' AND ';
        }

        if (substr($searchterm,0,1) == '+') {
            $searchterm      = substr($searchterm,1);
            $summarysearch  .= " p.summary $REGEXP '(^|[^a-zA-Z0-9])$searchterm([^a-zA-Z0-9]|$)' ";
            $fullnamesearch .= " p.fullname $REGEXP '(^|[^a-zA-Z0-9])$searchterm([^a-zA-Z0-9]|$)' ";
            $idnumbersearch  .= " p.idnumber $REGEXP '(^|[^a-zA-Z0-9])$searchterm([^a-zA-Z0-9]|$)' ";
            $shortnamesearch  .= " p.shortname $REGEXP '(^|[^a-zA-Z0-9])$searchterm([^a-zA-Z0-9]|$)' ";
        } else if (substr($searchterm,0,1) == "-") {
            $searchterm      = substr($searchterm,1);
            $summarysearch  .= " p.summary $NOTREGEXP '(^|[^a-zA-Z0-9])$searchterm([^a-zA-Z0-9]|$)' ";
            $fullnamesearch .= " p.fullname $NOTREGEXP '(^|[^a-zA-Z0-9])$searchterm([^a-zA-Z0-9]|$)' ";
            $idnumbersearch .= " p.idnumber $NOTREGEXP '(^|[^a-zA-Z0-9])$searchterm([^a-zA-Z0-9]|$)' ";
            $shortnamesearch .= " p.shortname $NOTREGEXP '(^|[^a-zA-Z0-9])$searchterm([^a-zA-Z0-9]|$)' ";
        } else {
            $summarysearch .= $DB->sql_like('summary', '?', false, true, false) . ' ';
            $summarysearchparams[] = '%' . $searchterm . '%';

            $fullnamesearch .= $DB->sql_like('fullname', '?', false, true, false) . ' ';
            $fullnamesearchparams[] = '%' . $searchterm . '%';

            $idnumbersearch .= $DB->sql_like('idnumber', '?', false, true, false) . ' ';
            $idnumbersearchparams[] = '%' . $searchterm . '%';

            $shortnamesearch .= $DB->sql_like('shortname', '?', false, true, false) . ' ';
            $shortnamesearchparams[] = '%' . $searchterm . '%';
        }
    }

    // If search terms supplied, include in where
    if (count($searchterms)) {
        $where = "
            WHERE (( $fullnamesearch ) OR ( $summarysearch ) OR ( $idnumbersearch ) OR ( $shortnamesearch ))
            AND category > 0
        ";
        $params = array_merge($params, $fullnamesearchparams, $summarysearchparams, $idnumbersearchparams, $shortnamesearchparams);
    } else {
        // Otherwise return everything
        $where = " WHERE category > 0 ";
    }

    // Add any additional sql supplied to where clause
    if ($whereclause) {
        $where .= " AND {$whereclause}";
        $params = array_merge($params, $whereparams);
    }

    $sql = "SELECT p.*,
                   ctx.id AS ctxid, ctx.path AS ctxpath,
                   ctx.depth AS ctxdepth, ctx.contextlevel AS ctxlevel
            FROM {prog} p
            JOIN {context} ctx
             ON (p.id = ctx.instanceid AND ctx.contextlevel = ".CONTEXT_PROGRAM.")
            $where
            ORDER BY " . $sort;

    $programs = array();

    // Tiki pagination
    $limitfrom = $page * $recordsperpage;
    $limitto   = $limitfrom + $recordsperpage;
    $c = 0; // counts how many visible programs we've seen

    $rs = $DB->get_recordset_sql($sql, $params);

    foreach ($rs as $program) {
        if (!is_siteadmin($USER->id)) {
            // Check if this program is not available, if it's not then deny access
            if ($program->available == 0) {
                continue;
            }

            if (isset($USER->timezone)) {
                $now = usertime(time(),$USER->timezone);
            } else {
                $now = usertime(time());
            }

            // Check if the programme isn't accessible yet
            if ($program->availablefrom > 0 && $program->availablefrom > $now) {
                continue;
            }

            // Check if the programme isn't accessible anymore
            if ($program->availableuntil > 0 && $program->availableuntil < $now) {
                continue;
            }
        }

        if ($program->visible || has_capability('totara/program:viewhiddenprograms', program_get_context($program->id))) {
            // Don't exit this loop till the end
            // we need to count all the visible courses
            // to update $totalcount
            if ($c >= $limitfrom && $c < $limitto) {
                $programs[] = $program;
            }
            $c++;
        }
    }

    $rs->close();

    // our caller expects 2 bits of data - our return
    // array, and an updated $totalcount
    $totalcount = $c;
    return $programs;
}

/**
 * Handler function called when a program_assigned event is triggered
 *
 * @param object $eventdata Must contain a 'programid' int and a 'userid' int
 * @return bool Success status
 */
function prog_eventhandler_program_assigned($eventdata) {
    global $DB;
    $programid = $eventdata->programid;
    $userid = $eventdata->userid;

    try {
        $program = new program($programid);
    } catch (ProgramException $e) {
        return true;
    }

    $messagesmanager = $program->get_messagesmanager();
    $messages = $messagesmanager->get_messages();
    $completed = $program->is_program_complete($userid);
    // send notifications to user and (optionally) the user's manager
    foreach ($messages as $message) {
        if ($message->messagetype == MESSAGETYPE_ENROLMENT) {
            if (($user = $DB->get_record('user', array('id' => $userid))) && !$completed) {
                $message->send_message($user);
            }
        }
    }
    return true;
}

/**
 * Handler function called when a program_unassigned event is triggered
 *
 * @param object $eventdata Must contain a 'programid' int and a 'userid' int
 * @return bool Success status
 */
function prog_eventhandler_program_unassigned($eventdata) {
    global $DB;
    $programid = $eventdata->programid;
    $userid = $eventdata->userid;

    try {
        $program = new program($programid);
    } catch (ProgramException $e) {
        return true;
    }

    $messagesmanager = $program->get_messagesmanager();
    $messages = $messagesmanager->get_messages();

    // send notifications to user and (optionally) the user's manager
    foreach ($messages as $message) {
        if ($message->messagetype == MESSAGETYPE_UNENROLMENT) {
            if ($user = $DB->get_record('user', array('id' => $userid))) {
                $message->send_message($user);
            }
        }
    }
    return true;
}

/**
 * Handler function called when a program_completed event is triggered
 *
 * @param object $eventdata Must contain a 'program' instance object and a 'userid' int
 * @return bool Success status
 */
function prog_eventhandler_program_completed($eventdata) {
    global $CFG, $DB;
    require_once($CFG->dirroot.'/totara/plan/lib.php');

    $program = $eventdata->program;
    $userid = $eventdata->userid;

    $messagesmanager = $program->get_messagesmanager();
    $messages = $messagesmanager->get_messages();

    // send notification to user
    foreach ($messages as $message) {
        if ($message->messagetype == MESSAGETYPE_PROGRAM_COMPLETED) {
            if ($user = $DB->get_record('user', array('id' => $userid))) {
                $message->send_message($user);
            }
        }
    }

    // auto plan completion hook
    dp_plan_item_updated($userid, 'program', $program->id);

    return true;
}

/**
 * Handler function called when a courseset_completed event is triggered
 *
 * @param object $eventdata Must contain a 'courseset' instance object and a 'userid' int
 * @return bool Success status
 */
function prog_eventhandler_courseset_completed($eventdata) {
    global $DB;
    $program = new program($eventdata->courseset->programid);
    $userid = $eventdata->userid;

    $messagesmanager = $program->get_messagesmanager();
    $messages = $messagesmanager->get_messages();

    // send notification to user
    foreach ($messages as $message) {
        if ($message->messagetype == MESSAGETYPE_COURSESET_COMPLETED) {
            if ($user = $DB->get_record('user', array('id' => $userid))) {
                $message->send_message($user, null, array('coursesetid'=>$eventdata->courseset->id));
            }
        }
    }

    return true;
}

function prog_store_position_assignment($assignment) {
    global $DB;
    $position_assignment_history = $DB->get_record('prog_pos_assignment', array('userid' => $assignment->userid, 'type' => $assignment->type));
    if (!$position_assignment_history) {
        $position_assignment_history = new stdClass();
        $position_assignment_history->userid = $assignment->userid;
        $position_assignment_history->positionid = $assignment->positionid;
        $position_assignment_history->type = $assignment->type;
        $position_assignment_history->timeassigned = time();
        $DB->insert_record('prog_pos_assignment', $position_assignment_history);
    }
    else if ($position_assignment_history->positionid != $assignment->positionid) {
        $position_assignment_history->positionid = $assignment->positionid;
        $position_assignment_history->timeassigned = time();
        $DB->update_record('prog_pos_assignment', $position_assignment_history);
    }
}

/**
 * Retrieves any recurring programs and returns them in an array or an empty
 * array
 *
 * @return array
 */
function prog_get_recurring_programs() {
    global $DB;
    $recurring_programs = array();

    // get all programs
    $program_records = $DB->get_records('prog');
    foreach ($program_records as $program_record) {
        $program = new program($program_record->id);
        $content = $program->get_content();
        $coursesets = $content->get_course_sets();

        if ((count($coursesets) == 1) && ($coursesets[0]->is_recurring())) {
            $recurring_programs[] = $program;
        }
    }

    return $recurring_programs;
}

function prog_get_tab_link($userid) {
    global $CFG, $DB;
    $dbman = $DB->get_manager();
    $progtable = new xmldb_table('prog');
    if ($dbman->table_exists($progtable)) {

        $requiredlearningcount = prog_get_required_programs($userid, '', '', '', true, true);
        if ($requiredlearningcount == 1) {
            $program = reset(prog_get_required_programs($userid, '', '', '', false, true));
            $prog = new program($program->id);
            if (!$prog->is_accessible()) {
                return false;
            }
            return $CFG->wwwroot . '/totara/program/required.php?id=' . $program->id;
        } else if ($requiredlearningcount > 1) {
            return $CFG->wwwroot . '/totara/program/required.php';
        }
    }

    return false;
}


/*
 *  This function is to cope with program assignments set up
 *   with completion deadlines 'from first login' where the
 *   user had not yet logged in.
 *  Triggered from events_trigger('user_firstaccess',$user);
 *  Also used by program_hourly_cron
 *
 *  @return boolean True if all the update_learner_assignments() succeeded or there was nothing to do
 */
function prog_assignments_firstlogin($user) {
    global $DB;

    $status = true;

    // future assignments for this user that can now be processed
    // (because this user has logged in)
    // we are looking for:
    // - future assignments for this user
    // - that relate to a "first login" assignment
    $rs = $DB->get_recordset_sql(
        "SELECT pfua.* FROM
            {prog_future_user_assignment} pfua
        LEFT JOIN
            {prog_assignment} pa
            ON pfua.assignmentid = pa.id
        WHERE
            pfua.userid = ?
            AND pa.completionevent = ?"
    , array($user->id, COMPLETION_EVENT_FIRST_LOGIN));
    // group the future assignments by 'programid'
    $pending_by_program = totara_group_records($rs, 'programid');

    if ($pending_by_program) {
        foreach ($pending_by_program as $programid => $assignments) {

            // update each program
            $program = new program($programid);
            if ($program->update_learner_assignments()) {
                // if the update succeeded, delete the future assignments related to this program
                $future_assignments_to_delete = array();
                foreach ($assignments as $assignment) {
                    $future_assignments_to_delete[] = $assignment->id;
                }
                if (!empty($future_assignments_to_delete)) {
                    list($deleteids_sql, $deleteids_params) = $DB->get_in_or_equal($future_assignments_to_delete);
                    $DB->delete_records_select('prog_future_user_assignment', "id {$deleteids_sql}", $deleteids_params);
                }
            } else {
                $status = false;
            }
        }
    }

    return $status;
}


/**
 * Processes extension request to grant or deny them given
 * an array of exceptions and the action to take
 *
 * @param array $extensions list of extension ids and actions in the form array(id => action)
 * @return array Contains count of extensions processed and number of failures
 */
function prog_process_extensions($extensions) {
    global $CFG, $DB, $USER;

    if (!empty($extensions)) {
        $update_fail_count = 0;
        $update_extension_count = 0;

        foreach ($extensions as $id => $action) {
            if ($action == 0) {
                continue;
            }

            $update_extension_count++;

            if (!$extension = $DB->get_record('prog_extension', array('id' => $id))) {
                print_error('error:couldnotloadextension', 'totara_program');
            }

            if (!totara_is_manager($extension->userid)) {
                print_error('error:notusersmanager', 'totara_program');
            }

            if ($action == PROG_EXTENSION_DENY) {

                $userto = $DB->get_record('user', array('id' => $extension->userid));
                //ensure the message is actually coming from $user's manager, default to support
                $userfrom = totara_is_manager($extension->userid, $USER->id) ? $USER : generate_email_supportuser();

                $messagedata = new stdClass();
                $messagedata->userto           = $userto;
                $messagedata->userfrom         = $userfrom;
                $messagedata->subject          = get_string('extensiondenied', 'totara_program');;
                $messagedata->contexturl       = $CFG->wwwroot.'/totara/program/required.php?id='.$extension->programid;
                $messagedata->contexturlname   = get_string('launchprogram', 'totara_program');
                $messagedata->fullmessage      = get_string('extensiondeniedmessage', 'totara_program');

                $eventdata = new stdClass();
                $eventdata->message = $messagedata;

                if ($result = tm_alert_send($messagedata)) {

                    $extension_todb = new stdClass();
                    $extension_todb->id = $extension->id;
                    $extension_todb->status = PROG_EXTENSION_DENY;

                    if (!$DB->update_record('prog_extension', $extension_todb)) {
                        $update_fail_count++;
                    }
                } else {
                    print_error('error:failedsendextensiondenyalert', 'totara_program');
                }
            } elseif ($action == PROG_EXTENSION_GRANT) {
                // Load the program for this extension
                $extension_program = new program($extension->programid);

                if ($prog_completion = $DB->get_record('prog_completion', array('programid' => $extension_program->id, 'userid' => $extension->userid, 'coursesetid' => 0))) {
                    $duedate = empty($prog_completion->timedue) ? 0 : $prog_completion->timedue;

                    if ($extension->extensiondate < $duedate) {
                        $update_fail_count++;
                        continue;
                    }
                }

                $now = time();
                if ($extension->extensiondate < $now) {
                    $update_fail_count++;
                    continue;
                }

                // Try to update due date for program using extension date
                if (!$extension_program->set_timedue($extension->userid, $extension->extensiondate)) {
                    $update_fail_count++;
                    continue;
                } else {
                    $userto = $DB->get_record('user', array('id' => $extension->userid));
                    if (!$userto) {
                        print_error('error:failedtofinduser', 'totara_program', $extension->userid);
                    }

                    //ensure the message is actually coming from $user's manager, default to support
                    $userfrom = totara_is_manager($extension->userid, $USER->id) ? $USER : generate_email_supportuser();

                    $messagedata = new stdClass();
                    $messagedata->userto           = $userto;
                    $messagedata->userfrom         = $userfrom;
                    $messagedata->subject          = get_string('extensiongranted', 'totara_program');
                    $messagedata->contexturl       = $CFG->wwwroot.'/totara/program/required.php?id='.$extension->programid;
                    $messagedata->contexturlname   = get_string('launchprogram', 'totara_program');
                    $messagedata->fullmessage      = get_string('extensiongrantedmessage', 'totara_program', userdate($extension->extensiondate, get_string('strftimedate', 'langconfig'), $CFG->timezone));

                    if ($result = tm_alert_send($messagedata)) {

                        $extension_todb = new stdClass();
                        $extension_todb->id = $extension->id;
                        $extension_todb->status = PROG_EXTENSION_GRANT;

                        if (!$DB->update_record('prog_extension', $extension_todb)) {
                            $update_fail_count++;
                        }
                    } else {
                        print_error('error:failedsendextensiongrantalert','totara_program');
                    }
                 }
            }
        }
        return array('total' => $update_extension_count, 'failcount' => $update_fail_count, 'updatefailcount' => $update_fail_count);
    }
    return array();
}


/**
 * Run the program cron
 */
function totara_program_cron() {
    global $CFG;
    require_once($CFG->dirroot . '/totara/program/cron.php');
    program_cron();
}

/**
 * Returns an array of course objects for all the courses which
 * are part of any program.
 *
 * If an array of courseids are provided, the query is restricted
 * to only check for those courses
 *
 * @param array $courses Array of courseids to check for (optional) Defaults to all courses
 * @return array Array of course objects
 */
function prog_get_courses_associated_with_programs($courses = null) {
    global $DB;

    $limitcourses = (isset($courses) && is_array($courses) && count($courses) > 0);

    // restrict by list of courses provided
    if ($limitcourses) {
        list($insql, $inparams) = $DB->get_in_or_equal($courses);
        $insql = " AND c.id $insql";
    } else {
        $insql = '';
        $inparams = array();
    }

    // get courses mentioned in the courseset_course tab, and also any courses
    // linked to competencies used in any courseset
    // always exclude the site course and optionally restrict to a selected list of courses

    //mssql fails because of the 'ntext not comparable' issue
    //so we have to use a subquery to perform union
    $subquery = "SELECT c.id FROM {prog_courseset_course} pcc
                INNER JOIN {course} c ON c.id = pcc.courseid
                WHERE c.id <> ? $insql
            UNION
                SELECT c.id FROM {course} c
                JOIN {comp_evidence_items} cei ON c.id = cei.iteminstance
                AND cei.itemtype = ?
                WHERE cei.competencyid IN
                    (SELECT DISTINCT competencyid FROM {prog_courseset} WHERE competencyid <> 0)
                AND c.id <> ? $insql";
    $sql = "SELECT * FROM {course} WHERE id IN ($subquery)";

    // build up the params array
    $params = array(SITEID);
    $params = array_merge($params, $inparams);
    $params[] = 'coursecompletion';
    $params[] = SITEID;
    $params = array_merge($params, $inparams);

    return $DB->get_records_sql($sql, $params);
}

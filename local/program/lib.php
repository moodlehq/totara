<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
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
require_once($CFG->dirroot . '/local/program/program.class.php');


/**
 * This function is called automatically when the program module is installed.
 *
 * @return bool Success
 */
function local_program_install() {
    global $CFG;

    // Check if the 'programcount' field has been added to the 'course_categories'
    // table and add it if not
    $table = new XMLDBTable('course_categories');
    $field = new XMLDBField('programcount');
    $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'theme');

    if (!field_exists($table, $field)) {
        // Launch add field programcount
        add_field($table, $field);
    }

    // Set a config value to ensure that the program cron tasks are included
    // in the cron schedule
    if ( ! isset($CFG->local_program_cron)) {
        // hack to get cron working via admin/cron.php
        set_config('local_program_cron', 60);
    }

    prog_setup_initial_plan_settings();

    return true;
}

/**
 * This function is called as part of the local_postinst() function defined in
 * /local/lib.php which is run automatically after all other installation has
 * taken place when Moodle or Totara is installed for the first time (i.e new
 * install or upgrade from Moodle).
 *
 * @return bool Success
 */
function local_program_initial_install() {

    prog_setup_initial_plan_settings();

    return true;

}

/**
 * This function is called both when Moodle/Totara is first installed or when
 * the program module is installed into an existing Totara instance.
 *
 * The function adds default settings for the program component of the learning
 * plans framework.
 */
function prog_setup_initial_plan_settings() {

    // retrieve all the existing templates (if any exist)
    $templates = get_records('dp_template', '', '', 'id', 'id');

    // Create program settings for existing templates so they don't break
    // but disable programs by default in existing templates
    if ( is_array($templates) ){
        foreach( $templates as $t ){
            begin_sql();
            if($settings = get_record('dp_component_settings', 'templateid', $t->id, 'component', 'program')) {
                $settings->enabled=0;
                $settings->sortorder = 1 + count_records('dp_component_settings', 'templateid', $t->id);
                update_record('dp_component_settings', $settings);
            } else {
                $settings = new stdClass();
                $settings->templateid=$t->id;
                $settings->component='program';
                $settings->enabled=0;
                $settings->sortorder = 1 + count_records('dp_component_settings', 'templateid', $t->id);
                insert_record('dp_component_settings', $settings);
            }
            commit_sql();
        }
    }

    // Fill in permissions and settings for programs in existing templates
    if ( is_array($templates) ){
        $roles = array('learner','manager');
        $actions=array('updateprogram','setpriority','setduedate');

        foreach( $templates as $t ){
            begin_sql();
            $perm = new stdClass();
            $perm->templateid = $t->id;
            foreach( $roles as $r ){
                foreach( $actions as $a ){

                    if ($r=='learner' && $a=='updateprogram') {
                        $permissionvalue = DP_PERMISSION_REQUEST;
                    } else if ($r=='manager' && $a=='updateprogram') {
                        $permissionvalue = DP_PERMISSION_APPROVE;
                    } else {
                        $permissionvalue = DP_PERMISSION_ALLOW;
                    }

                    if ($rec = get_record_select('dp_permissions', "templateid={$perm->templateid} AND role='$r' AND component='program' AND action='$a'")) {
                        $rec->value=$permissionvalue;
                        update_record('dp_permissions', $rec);
                    } else {
                        $perm->role = $r;
                        $perm->action = $a;
                        $perm->value=$permissionvalue;
                        $perm->component = 'program';
                        insert_record('dp_permissions', $perm);
                    }
                }
            }

            $defaultduedatemode = DP_DUEDATES_OPTIONAL;
            $defaultprioritymode = DP_PRIORITY_NONE;
            $defaultpriorityscaleid = 1;

            if($progset = get_record_select('dp_program_settings', "templateid={$t->id}")) {
                $progset->duedatemode=$defaultduedatemode;
                $progset->prioritymode=$defaultprioritymode;
                $progset->priorityscale=$defaultpriorityscaleid;
                update_record('dp_program_settings', $progset);
            } else {
                $progset = new stdClass();
                $progset->templateid = $t->id;
                $progset->duedatemode=$defaultduedatemode;
                $progset->prioritymode=$defaultprioritymode;
                $progset->priorityscale=$defaultpriorityscaleid;
                insert_record('dp_program_settings', $progset);
            }

            commit_sql();
        }
    }
}


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

    $systemcontext = get_system_context();

    // If the user can view any programs
    if (has_capability('local/program:accessanyprogram', $systemcontext)) {
        return true;
    }

    // If the user cannot view any programs
    if (!has_capability('local/program:viewprogram', $systemcontext)) {
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
 * @global object $CFG
 * @param int $userid
 * @param string $sort The order in which to sort the programs
 * @param int $limitfrom return a subset of records, starting at this point (optional, required if $limitnum is set).
 * @param int $limitnum return a subset comprising this many records (optional, required if $limitfrom is set).
 * @param bool $returncount Whether to return a count of the number of records found or the records themselves
 * @return array|int
 */
function prog_get_required_programs($userid, $sort='', $limitfrom='', $limitnum='', $returncount=false) {
    global $CFG;

    // Construct sql query
    $count = 'SELECT COUNT(*) ';
    $select = 'SELECT DISTINCT(p.id) AS notid, p.*, p.fullname AS progname, pc.timedue AS duedate ';

    $from = "FROM {$CFG->prefix}prog AS p
            INNER JOIN {$CFG->prefix}prog_completion AS pc ON p.id = pc.programid
            INNER JOIN {$CFG->prefix}prog_user_assignment AS pua ON (pc.programid=pua.programid AND pc.userid=pua.userid) ";

    $where = "WHERE pc.coursesetid = 0
        AND pc.userid = $userid
        AND p.visible = 1
        AND pc.status <> ".STATUS_PROGRAM_COMPLETE;

    if($returncount) {
        return count_records_sql($count.$from.$where);
    } else {
        return get_records_sql($select.$from.$where.$sort, $limitfrom, $limitnum);
    }

}

/**
 * Return markup for displaying a table of a specified user's required programs
 * (i.e. programs that have been automatically assigned to the user)
 *
 * @access  public
 * @param   int     $userid     Program assignee
 * @return  string
 */
function prog_display_programs($userid) {
    global $CFG;

    $count = prog_get_required_programs($userid, '', '', '', true);

    // Set up table
    $tablename = 'progs-list';
    $tableheaders = array(get_string('programname', 'local_program'));
    $tablecols = array('progname');

    // Due date
    $tableheaders[] = get_string('duedate', 'local_program');;
    $tablecols[] = 'duedate';

    // Progress
    $tableheaders[] = get_string('progress', 'local_program');;
    $tablecols[] = 'progress';

    $baseurl = $CFG->wwwroot . '/local/program/required.php?userid='.$userid;

    $table = new flexible_table($tablename);
    $table->define_headers($tableheaders);
    $table->define_columns($tablecols);
    $table->define_baseurl($baseurl);
    $table->set_attribute('class', 'logtable generalbox');
    $table->set_attribute('width', '100%');
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
    $programs = prog_get_required_programs($userid, $sort, $table->get_page_start(), $table->get_page_size());

    if (!$programs) {
        return '';
    }

    foreach ($programs as $p) {
        $program = new program($p->id);
        $row = array();
        $row[] = $program->display_summary_widget($userid);
        $row[] = $program->display_duedate($p->duedate);
        $row[] = $program->display_progress($userid);
        $table->add_data($row);
    }

    unset($programs);

    if(!empty($table->data)) {
        ob_start();
        $table->print_html();
        $out = ob_get_contents();
        ob_end_clean();
    } else {
        $out = '';
    }

    return $out;
}

/**
 * Display the user message box
 *
 * @access public
 * @param  int    $programuser the id of the user
 * @return string $out      the display code
 */
function prog_display_user_message_box($programuser) {
    global $CFG;
    $user = get_record('user', 'id', $programuser);
    if(!$user) {
        return false;
    }

    $out = '<div class="plan_box plan_box_plain">';
    $out .= '<table border="0" width="100%"><tr><td width="50">';
    $out .= print_user_picture($user, 1, null, 0, true);
    $out .= '</td><td>';
    $a = new object();
    $a->name = fullname($user);
    $a->userid = $programuser;
    $a->site = $CFG->wwwroot;
    $out .= get_string('youareviewingxsrequiredlearning', 'local_program', $a);
    $out .= '</td></tr></table></div>';
    return $out;
}

/**
 * Add lowest levels of breadcrumbs to program
 *
 * @param array &$navlinks The navlinks array to update (passed by reference)
 * @return void
 */
function prog_get_base_navlinks(&$navlinks) {
    global $CFG, $USER;

    $navlinks[] = array('name' => get_string('browsecategories', 'local_program'), 'link' => $CFG->wwwroot.'/course/index.php?viewtype=program', 'type' => 'title');

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
function prog_get_required_learning_base_navlinks(&$navlinks, $userid) {
    global $CFG, $USER;
    // the user is viewing their own learning
    if($userid == $USER->id) {
        $navlinks[] = array('name' => get_string('mylearning', 'local'), 'link' => $CFG->wwwroot . '/my/learning.php', 'type' => 'title');
        $navlinks[] = array('name' => get_string('requiredlearning','local_program'), 'link'=> $CFG->wwwroot . '/local/program/required.php', 'type'=>'title');
        return true;
    }

    // the user is viewing someone else's learning
    $user = get_record('user', 'id', $userid);
    if($user) {
        $navlinks[] = array('name' => get_string('myteam','local'), 'link'=> $CFG->wwwroot . '/my/team.php', 'type'=>'title');
        $navlinks[] = array('name' => get_string('teammembers','local'), 'link'=> $CFG->wwwroot . '/my/teammembers.php', 'type'=>'title');
        $navlinks[] = array('name' => get_string('xsrequiredlearning','local_program', fullname($user)), 'link'=> $CFG->wwwroot . '/local/program/required.php?userid='.$userid, 'type'=>'title');
    } else {
        $navlinks[] = array('name' => get_string('unknownusersrequiredlearning','local_program'), 'link'=> $CFG->wwwroot . '/local/program/required.php?userid='.$userid, 'type'=>'title');
    }
}

/**
 * Returns list of programs, for whole site, or category
 * (This is the counterpart to get_courses in /lib/datalib.php)
 */
function prog_get_programs($categoryid="all", $sort="p.sortorder ASC", $fields="p.*") {

    global $USER, $CFG;

    if ($categoryid != "all" && is_numeric($categoryid)) {
        $categoryselect = "WHERE p.category = '$categoryid'";
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
    if ($programs = get_records_sql("SELECT $fields,
                                    ctx.id AS ctxid, ctx.path AS ctxpath,
                                    ctx.depth AS ctxdepth, ctx.contextlevel AS ctxlevel
                                    FROM {$CFG->prefix}prog p
                                    JOIN {$CFG->prefix}context ctx
                                      ON (p.id = ctx.instanceid
                                          AND ctx.contextlevel=".CONTEXT_PROGRAM.")
                                    $categoryselect
                                    $sortstatement")) {

        // loop throught them
        foreach ($programs as $program) {
            $program = make_context_subobj($program);
            if (isset($program->visible) && $program->visible <= 0) {
                // for hidden programs, require visibility check
                if (has_capability('local/program:viewhiddenprograms', $program->context)) {
                    $visibleprograms [] = $program;
                }
            } else {
                $visibleprograms [] = $program;
            }
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

    global $USER, $CFG;

    $categoryselect = "";
    if ($categoryid != "all" && is_numeric($categoryid)) {
        $categoryselect = " WHERE p.category = '$categoryid' ";
    }

    // pull out all programs matching the cat
    $visibleprograms = array();

    $progselect = "SELECT $fields, 'program' AS listtype,
                          ctx.id AS ctxid, ctx.path AS ctxpath,
                          ctx.depth AS ctxdepth, ctx.contextlevel AS ctxlevel
                   FROM {$CFG->prefix}prog p
                   JOIN {$CFG->prefix}context ctx
                     ON (p.id = ctx.instanceid AND ctx.contextlevel=".CONTEXT_PROGRAM.")";

    $select = $progselect.$categoryselect.' ORDER BY '.$sort;

    if (!($rs = get_recordset_sql($select))) {
        return $visibleprograms;
    }

    $totalcount = 0;

    if (!$limitfrom) {
        $limitfrom = 0;
    }

    // iteration will have to be done inside loop to keep track of the limitfrom and limitnum
    while ($program = rs_fetch_next_record($rs)) {
        $program = make_context_subobj($program);
        if ($program->visible <= 0) {
            // for hidden programs, require visibility check
            if (has_capability('local/program:viewhiddenprograms', $program->context)) {
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
    rs_close($rs);
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

    global $CFG;

    if (!empty($programids)) {

            $programids = array_reverse($programids);

            foreach ($programids as $programid) {

                if (! $program  = get_record("prog", "id", $programid)) {
                    notify("Error finding program $programid");
                } else {
                    // figure out a sortorder that we can use in the destination category
                    $sortorder = get_field_sql('SELECT MIN(sortorder)-1 AS min
                                                    FROM ' . $CFG->prefix . 'prog WHERE category=' . $categoryid);
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

                    if (!update_record('prog', addslashes_recursive($program))) {
                        notify("An error occurred - program not moved!");
                    }

                    $context   = get_context_instance(CONTEXT_PROGRAM, $program->id);
                    $newparent = get_context_instance(CONTEXT_COURSECAT, $program->category);
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

    global $CFG;

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
            if ($program->visible == 1
                || has_capability('local/program:viewhiddenprograms',$program->context)) {
                prog_print_program($program);
            }
        }
    } else {
        print_heading(get_string("noprogramsyet",'local_program'));
        $context = get_context_instance(CONTEXT_SYSTEM);
        if (has_capability('local/program:createprogram', $context)) {
            $options = array();
            $options['category'] = $category->id;
            echo '<div class="addprogrambutton">';
            print_single_button($CFG->wwwroot.'/local/program/add.php', $options, get_string("addnewprogram",'local_program'));
            echo '</div>';
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

    global $CFG;

    $count = 0;

    $catgap    = 1000; // "standard" category gap
    $tolerance = 200;  // how "close" categories can get

    if ($categoryid > 0){
        // update depth and path
        $cat   = get_record('course_categories', 'id', $categoryid);
        if ($cat->parent == 0) {
            $depth = 0;
            $path  = '';
        } else if ($depth == 0 ) { // doesn't make sense; get from DB
            // this is only called if the $depth parameter looks dodgy
            $parent = get_record('course_categories', 'id', $cat->parent);
            $path  = $parent->path;
            $depth = $parent->depth;
        }
        $path  = $path . '/' . $categoryid;
        $depth = $depth + 1;

        if ($cat->path !== $path) {
            set_field('course_categories', 'path',  addslashes($path),  'id', $categoryid);
        }
        if ($cat->depth != $depth) {
            set_field('course_categories', 'depth', $depth, 'id', $categoryid);
        }
    }

    // get some basic info about programs in the category
    $info = get_record_sql('SELECT MIN(sortorder) AS min,
                                   MAX(sortorder) AS max,
                                   COUNT(sortorder)  AS count
                            FROM ' . $CFG->prefix . 'prog
                            WHERE category=' . $categoryid);
    if (is_object($info)) { // no courses?
        $max   = $info->max;
        $count = $info->count;
        $min   = $info->min;
        unset($info);
    }

    if ($categoryid > 0 && $n==0) { // only passed category so don't shift it
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
        if ( $mustshift && !$safe && !$hasgap) {
            $shift = $n + $catgap - $min;
            if ($shift < $count) {
                $shift = $count + $catgap;
            }

            execute_sql("UPDATE {$CFG->prefix}prog
                         SET sortorder=sortorder+$shift
                         WHERE category=$categoryid", 0);
            $n = $n + $catgap + $count;

        } else { // do it slowly
            $n = $n + $catgap;
            // if the new sequence overlaps the current sequence, lack of transactions
            // will stop us -- shift things aside for a moment...
            if ($safe || ($n >= $min && $n+$count+1 < $min && $CFG->dbfamily==='mysql')) {
                $shift = $max + $n + 1000;
                execute_sql("UPDATE {$CFG->prefix}prog
                         SET sortorder=sortorder+$shift
                         WHERE category=$categoryid", 0);
            }

            $programs = prog_get_programs($categoryid, 'p.sortorder ASC', 'p.id,p.sortorder');
            begin_sql();
            $tx = true; // transaction sanity
            foreach ($programs as $program) {
                if ($tx && $program->sortorder != $n ) { // save db traffic
                    $tx = $tx && set_field('prog', 'sortorder', $n,
                                           'id', $program->id);
                }
                $n++;
            }
            if ($tx) {
                commit_sql();
            } else {
                rollback_sql();
                if (!$safe) {
                    // if we failed when called with !safe, try
                    // to recover calling self with safe=true
                    return prog_fix_program_sortorder($categoryid, $n, true, $depth, $path);
                }
            }
        }
    }
    set_field('course_categories', 'programcount', $count, 'id', $categoryid);

    // $n could need updating
    $max = get_field_sql("SELECT MAX(sortorder) from {$CFG->prefix}prog WHERE category=$categoryid");
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
    global $CFG, $USER;

    require_once($CFG->dirroot.'/local/icon/program_icon.class.php');

    if (isset($program->context)) {
        $context = $program->context;
    } else {
        $context = get_context_instance(CONTEXT_PROGRAM, $program->id);
    }

    $program_icon = new program_icon();

    $linkcss = $program->visible ? '' : ' class="dimmed" ';

    echo '<div class="coursebox programbox clearfix">';
    echo '<div class="info">';
    echo '<div class="name"> '. $program_icon->display($program, 'small'). '<a title="'.get_string('viewprogram', 'local_program').'"'.
         $linkcss.' href="'.$CFG->wwwroot.'/local/program/view.php?id='.$program->id.'">'.
         highlight($highlightterms, format_string($program->fullname)).'</a>';
    echo '</div>';

    echo '</div>';

    echo '<div class="summary">';
    $options = NULL;
    $options->noclean = true;
    $options->para = false;
    echo highlight($highlightterms, format_text($program->summary, FORMAT_MOODLE, $options,  $program->id));
    echo '</div></div>';
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
        if ($category->visible or has_capability('moodle/category:viewhiddencategories', get_context_instance(CONTEXT_SYSTEM))) {
            prog_print_category_info($category, $depth, $showprograms);
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
    global $CFG;
    static $strallowguests, $strrequireskey, $strsummary;

    require_once($CFG->dirroot.'/local/icon/program_icon.class.php');

    if (empty($strsummary)) {
        $strallowguests = get_string('allowguests');
        $strrequireskey = get_string('requireskey');
        $strsummary = get_string('summary');
    }

    $catlinkcss = $category->visible ? '' : ' class="dimmed" ';

    static $programcount = null;
    if (null === $programcount) {
        // only need to check this once
        $programcount = count_records('prog') <= FRONTPAGECOURSELIMIT;
    }

    if ($showprograms and $programcount) {
        $catimage = '<img src="'.$CFG->pixpath.'/i/course.gif" alt="" />';
    } else {
        $catimage = "&nbsp;";
    }

    echo "\n\n".'<table class="categorylist">';

    $programs = prog_get_programs($category->id, 'p.sortorder ASC',
            'p.id,p.sortorder,p.visible,p.fullname,p.shortname,p.summary,p.icon');

    if ($showprograms and $programcount) {

        echo '<tr>';

        if ($depth) {
            $indent = $depth*30;
            $rows = count($programs) + 1;
            echo '<td class="category indentation" rowspan="'.$rows.'" valign="top">';
            print_spacer(10, $indent);
            echo '</td>';
        }

        echo '<td valign="top" class="category image">&nbsp;</td>';
        echo '<td class="category name">';
        echo '<a '.$catlinkcss.' href="'.$CFG->wwwroot.'/course/category.php?id='.$category->id.'">'. format_string($category->name).'</a>';
        echo '</td>';
        echo '<td class="category info">&nbsp;</td>';
        echo '</tr>';

        // does the depth exceed maxcategorydepth
        // maxcategorydepth == 0 or unset meant no limit

        $limit = !(isset($CFG->maxcategorydepth) && ($depth >= $CFG->maxcategorydepth-1));

        if ($programs && ($limit || $CFG->maxcategorydepth == 0)) {
            $program_icon = new program_icon();

            foreach ($programs as $program) {
                $linkcss = $program->visible ? '' : ' class="dimmed" ';
                echo '<tr><td valign="top">&nbsp;';
                echo '</td><td valign="top" class="course name">';
                echo $program_icon->display($program, 'small');
                echo ' <a '.$linkcss.' href="'.$CFG->wwwroot.'/local/program/view.php?id='.$program->id.'">'. format_string($program->fullname).'</a>';
                echo '</td><td align="right" valign="top" class="course info">';

                if ($program->summary) {
                    link_to_popup_window ('/local/program/info.php?id='.$program->id, 'courseinfo',
                                          '<img alt="'.$strsummary.'" src="'.$CFG->pixpath.'/i/info.gif" />',
                                           400, 500, $strsummary);
                } else {
                    echo '<img alt="" style="width:18px;height:16px;" src="'.$CFG->pixpath.'/spacer.gif" />';
                }
                echo '</td></tr>';
            }
        }
    } else {

        echo '<tr>';

        if ($depth) {
            $indent = $depth*20;
            echo '<td class="category indentation" valign="top">';
            print_spacer(10, $indent);
            echo '</td>';
        }

        echo '<td valign="top" class="category name">';
        echo '<a '.$catlinkcss.' href="'.$CFG->wwwroot.'/course/category.php?id='.$category->id.'">'. format_string($category->name).'</a>';
        echo '</td>';
        echo '<td valign="top" class="category number">';
        if (count($programs)) {
           echo count($programs);
        }
        echo '</td></tr>';
    }
    echo '</table>';
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
    $row[] = new tabobject('courses', $courselink, get_string('courses', 'local_program'));
    $row[] = new tabobject('programs', $programlink, get_string('programs', 'local_program'));

    $tabs = array($row);

    echo '<div id="viewtypepicker">';
    print_tabs($tabs, $currenttab);
    echo '</div>';

}

/**
 * Checks whether or not a user should have access to a course that belongs to a
 * program in the user's required learning. If so, the user will be automatically
 * enrolled onto the course as a student.
 *
 * @global object $CFG
 * @param int $userid
 * @param int $courseid
 * @param object $coursecontext
 * @return void
 */
function prog_can_enter_course($userid, $courseid, $coursecontext) {
    global $CFG;

    $studentroleid = get_field('role', 'id', 'shortname', 'student');
    if (!$studentroleid) {
	print_error('error:failedtofindstudentrole', 'local_program');
    }
    //$context = get_context_instance(CONTEXT_COURSE, $courseid);

    // check if the user has already been assigned the student role in this course
    if(user_has_role_assignment($userid, $studentroleid, $coursecontext->id)) {
        return;
    }

    if($program_records = prog_get_required_programs($userid)) {
        foreach($program_records as $program_record) {
            $program = new program($program_record->id);
            if($program->can_enter_course($userid, $courseid)) {
                role_assign($studentroleid, $userid, 0, $coursecontext->id);
                return;
            }
        }
    }
    return;
}


/**
 * A list of programs that match a search
 *
 * @uses $CFG
 * @param array $searchterms ?
 * @param string $sort ?
 * @param int $page ?
 * @param int $recordsperpage ?
 * @param int $totalcount Passed in by reference. ?
 * @param string $whereclause Addition where clause
 * @return object {@link $COURSE} records
 */
function prog_get_programs_search($searchterms, $sort='fullname ASC', $page=0, $recordsperpage=50, &$totalcount, $whereclause) {
    global $CFG;

    //to allow case-insensitive search for postgesql
    if ($CFG->dbfamily == 'postgres') {
        $LIKE = 'ILIKE';
        $NOTLIKE = 'NOT ILIKE';   // case-insensitive
        $REGEXP = '~*';
        $NOTREGEXP = '!~*';
    } else {
        $LIKE = 'LIKE';
        $NOTLIKE = 'NOT LIKE';
        $REGEXP = 'REGEXP';
        $NOTREGEXP = 'NOT REGEXP';
    }

    $fullnamesearch = '';
    $summarysearch = '';
    $idnumbersearch = '';
    $shortnamesearch = '';

    foreach ($searchterms as $searchterm) {

        $NOT = ''; /// Initially we aren't going to perform NOT LIKE searches, only MSSQL and Oracle
                   /// will use it to simulate the "-" operator with LIKE clause

    /// Under Oracle and MSSQL, trim the + and - operators and perform
    /// simpler LIKE (or NOT LIKE) queries
        if ($CFG->dbfamily == 'oracle' || $CFG->dbfamily == 'mssql') {
            if (substr($searchterm, 0, 1) == '-') {
                $NOT = ' NOT ';
            }
            $searchterm = trim($searchterm, '+-');
        }

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
            $summarysearch .= ' summary '. $NOT . $LIKE .' \'%'. $searchterm .'%\' ';
            $fullnamesearch .= ' fullname '. $NOT . $LIKE .' \'%'. $searchterm .'%\' ';
            $idnumbersearch .= ' idnumber '. $NOT . $LIKE .' \'%'. $searchterm .'%\' ';
            $shortnamesearch .= ' shortname '. $NOT . $LIKE .' \'%'. $searchterm .'%\' ';
        }
    }

    // If search terms supplied, include in where
    if (count($searchterms)) {
        $where = "
            WHERE (( $fullnamesearch ) OR ( $summarysearch ) OR ( $idnumbersearch ) OR ( $shortnamesearch ))
            AND category > 0
        ";
    } else {
        // Otherwise return everything
        $where = " WHERE category > 0 ";
    }

    // Add any additional sql supplied to where clause
    if ($whereclause) {
        $where .= " AND {$whereclause}";
    }

    $sql = "SELECT p.*,
                   ctx.id AS ctxid, ctx.path AS ctxpath,
                   ctx.depth AS ctxdepth, ctx.contextlevel AS ctxlevel
            FROM {$CFG->prefix}prog p
            JOIN {$CFG->prefix}context ctx
             ON (p.id = ctx.instanceid AND ctx.contextlevel=".CONTEXT_PROGRAM.")
            $where
            ORDER BY " . $sort;

    $programs = array();

    // Tiki pagination
    $limitfrom = $page * $recordsperpage;
    $limitto   = $limitfrom + $recordsperpage;
    $c = 0; // counts how many visible programs we've seen

    if ($rs = get_recordset_sql($sql)) {

        while ($program = rs_fetch_next_record($rs)) {
            $program = make_context_subobj($program);
            if ($program->visible || has_capability('local/program:viewhiddenprograms', $program->context)) {
                // Don't exit this loop till the end
                // we need to count all the visible courses
                // to update $totalcount
                if ($c >= $limitfrom && $c < $limitto) {
                    $programs[] = $program;
                }
                $c++;
            }
        }
    }

    // our caller expects 2 bits of data - our return
    // array, and an updated $totalcount
    $totalcount = $c;
    return $programs;
}

function prog_print_program_search($value="", $return=false, $format="plain") {
    global $CFG;
    static $count = 0;

    $count++;

    $id = 'coursesearch';

    if ($count > 1) {
        $id .= $count;
    }

    $strsearchcourses= get_string("searchprograms", 'local_program');

    if ($format == 'plain') {
        $output  = '<form id="'.$id.'" action="'.$CFG->wwwroot.'/course/search.php" method="get">';
        $output .= '<fieldset class="coursesearchbox invisiblefieldset">';
        $output .= '<label for="coursesearchbox">'.$strsearchcourses.': </label>';
        $output .= '<input type="text" id="coursesearchbox" size="30" name="search" value="'.s($value, true).'" />';
        $output .= '<input type="submit" value="'.get_string('go').'" />';
        $output .= '</fieldset></form>';
    } else if ($format == 'short') {
        $output  = '<form id="'.$id.'" action="'.$CFG->wwwroot.'/course/search.php" method="get">';
        $output .= '<fieldset class="coursesearchbox invisiblefieldset">';
        $output .= '<label for="shortsearchbox">'.$strsearchcourses.': </label>';
        $output .= '<input type="text" id="shortsearchbox" size="12" name="search" alt="'.s($strsearchcourses).'" value="'.s($value, true).'" />';
        $output .= '<input type="submit" value="'.get_string('go').'" />';
        $output .= '</fieldset></form>';
    } else if ($format == 'navbar') {
        $output  = '<form id="coursesearchnavbar" action="'.$CFG->wwwroot.'/course/search.php" method="get">';
        $output .= '<fieldset class="coursesearchbox invisiblefieldset">';
        $output .= '<label for="navsearchbox">'.$strsearchcourses.': </label>';
        $output .= '<input type="text" id="navsearchbox" size="20" name="search" alt="'.s($strsearchcourses).'" value="'.s($value, true).'" />';
        $output .= '<input type="submit" value="'.get_string('go').'" />';
        $output .= '</fieldset></form>';
    }

    if ($return) {
        return $output;
    }
    echo $output;
}

function prog_date_to_time($date) {

    $datearray = explode('/', trim($date));

    if (count($datearray)<3) {
        return false;
    } else {
        try {
            list($day, $month, $year) = explode('/', $date);    $date = $month.'/'.$day.'/'.$year;
            $date = $month.'/'.$day.'/'.$year;
            return strtotime($date);
        } catch(Exception $e) {
            return false;
        }
    }
}

function prog_time_to_date($time) {
    return trim(userdate($time,'%d/%m/%Y'));
}

/**
 * Handler function called when an extension_granted event is triggered
 *
 * @param object $eventdata Must contain a 'message' object which has the message data
 * @return bool Success status
 */
function prog_eventhandler_extension_granted($eventdata) {
    return prog_message::send_generic_alert($eventdata->message);
}

/**
 * Handler function called when an extension_denied event is triggered
 *
 * @param object $eventdata Must contain a 'message' object which has the message data
 * @return bool Success status
 */
function prog_eventhandler_extension_denied($eventdata) {
    return prog_message::send_generic_alert($eventdata->message);
}

/**
 * Handler function called when a program_assigned event is triggered
 *
 * @param object $eventdata Must contain a 'programid' int and a 'userid' int
 * @return bool Success status
 */
function prog_eventhandler_program_assigned($eventdata) {

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
    foreach($messages as $message) {
        if($message->messagetype==MESSAGETYPE_ENROLMENT) {
            if($user = get_record('user', 'id', $userid)) {
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
    foreach($messages as $message) {
        if($message->messagetype==MESSAGETYPE_UNENROLMENT) {
            if($user = get_record('user', 'id', $userid)) {
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
    global $CFG;
    require_once($CFG->dirroot.'/local/plan/lib.php');

    $program = $eventdata->program;
    $userid = $eventdata->userid;

    $messagesmanager = $program->get_messagesmanager();
    $messages = $messagesmanager->get_messages();

    // send notification to user
    foreach($messages as $message) {
        if($message->messagetype==MESSAGETYPE_PROGRAM_COMPLETED) {
            if($user = get_record('user', 'id', $userid)) {
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

    $program = new program($eventdata->courseset->programid);
    $userid = $eventdata->userid;

    $messagesmanager = $program->get_messagesmanager();
    $messages = $messagesmanager->get_messages();

    // send notification to user
    foreach($messages as $message) {
        if($message->messagetype==MESSAGETYPE_COURSESET_COMPLETED) {
            if($user = get_record('user', 'id', $userid)) {
                $message->send_message($user, null, array('coursesetid'=>$eventdata->courseset->id));
            }
        }
    }

    return true;
}

function prog_store_position_assignment($assignment) {
    $position_assignment_history = get_record('prog_pos_assignment','userid',$assignment->userid,'type',$assignment->type);
    if (!$position_assignment_history) {
        $position_assignment_history = new stdClass();
        $position_assignment_history->userid = $assignment->userid;
        $position_assignment_history->positionid = $assignment->positionid;
        $position_assignment_history->type = $assignment->type;
        $position_assignment_history->timeassigned = time();
        insert_record('prog_pos_assignment', $position_assignment_history);
    }
    else if ($position_assignment_history->positionid != $assignment->positionid) {
        $position_assignment_history->positionid = $assignment->positionid;
        $position_assignment_history->timeassigned = time();
        update_record('prog_pos_assignment', $position_assignment_history);
    }
}

/**
 * Retrieves any recurring programs and returns them in an array or an empty
 * array
 *
 * @return array
 */
function prog_get_recurring_programs() {

    $recurring_programs = array();

    // get all programs
    if($program_records = get_records('prog')) {
        foreach($program_records as $program_record) {
            $program = new program($program_record->id);
            $content = $program->get_content();
            $coursesets = $content->get_course_sets();

            if ((count($coursesets)==1) && ($coursesets[0]->is_recurring())) {
                $recurring_programs[] = $program;
            }
        }
    }

    return $recurring_programs;

}

function prog_get_tab_link($userid) {
    global $CFG;

    $progtable = new XMLDBTable('prog');
    if (table_exists($progtable)) {

        $requiredlearningcount = prog_get_required_programs($userid, '', '', '', true);
        if ($requiredlearningcount == 1) {
            $program = reset(prog_get_required_programs($userid));
            return $CFG->wwwroot . '/local/program/required.php?id=' . $program->id;
        } else if ($requiredlearningcount > 1) {
            return $CFG->wwwroot . '/local/program/required.php';
        }
    }

    return false;
}

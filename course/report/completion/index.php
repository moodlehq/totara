<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**
 * Course completion progress report
 *
 * @package   moodlecore
 * @copyright 2009 Catalyst IT Ltd
 * @author    Aaron Barnes <aaronb@catalyst.net.nz>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once('../../../config.php');
require_once($CFG->libdir.'/completionlib.php');


/**
 * Configuration
 */
define('COMPLETION_REPORT_PAGE',        20);
define('COMPLETION_REPORT_RPL',         true);
define('COMPLETION_REPORT_COL_TITLES',  true);


/**
 * Setup page, check permissions
 */

// Get course
$course = get_record('course', 'id', required_param('course', PARAM_INT));
if(!$course) {
    print_error('invalidcourseid');
}

// Non-js edit
$edituser = optional_param('edituser', 0, PARAM_INT);

// Sort (default lastname, optionally firstname)
$sort = optional_param('sort','',PARAM_ALPHA);
$firstnamesort = $sort == 'firstname';

// CSV format
$format = optional_param('format','',PARAM_ALPHA);
$excel = $format == 'excelcsv';
$csv = $format == 'csv' || $excel;

// Paging
$start   = optional_param('start', 0, PARAM_INT);
$sifirst = optional_param('sifirst', 'all', PARAM_ALPHA);
$silast  = optional_param('silast', 'all', PARAM_ALPHA);

// Whether to show idnumber
$idnumbers = $CFG->grade_report_showuseridnumber;

// Function for quoting csv cell values
function csv_quote($value) {
    global $excel;
    if($excel) {
        $tl=textlib_get_instance();
        return $tl->convert('"'.str_replace('"',"'",$value).'"','UTF-8','UTF-16LE');
    } else {
        return '"'.str_replace('"',"'",$value).'"';
    }
}


///
/// Display RPL stuff
///
function show_rpl($type, $user, $rpl, $describe, $fulldescribe) {
    global $CFG, $edituser, $course, $sort, $start;

    if (!COMPLETION_REPORT_RPL) {
        return;
    }

    // If editing a user
    if ($edituser == $user->id) {
        // Show edit form
        print '<form action="save_rpl.php?type='.$type.'&course='.$course->id.'&sort='.$sort.'&start='.$start.'&redirect=1" method="post">';
        print '<input type="hidden" name="user" value="'.$user->id.'" />';
        print '<input type="text" name="rpl" value="'.htmlentities($rpl).'" maxlength="255" />';
        print '<input type="submit" name="saverpl" value="Save" /></form> ';
        print '<a href="index.php?course='.$course->id.'&sort='.$sort.'&start='.$start.'">Cancel</a>';
    } else {
        // Show RPL status icon
        $rplicon = strlen($rpl) ? 'completion-rpl-y' : 'completion-rpl-n';
        print '<a href="index.php?course='.$course->id.'&sort='.$sort.'&start='.$start.'&edituser='.$user->id.'#user-'.$user->id.'" class="rpledit"><img src="'.$CFG->wwwroot.'/theme/totara/pix/i/'.$rplicon.'.gif'.
            '" alt="'.$describe.'" class="icon" title="'.$fulldescribe.'" /></a>';

        // Show status text
        if (strlen($rpl)) {
            print '<a href="#" class="rplshow" title="Show RPL">...</a>';
        }

        // Rrpl value
        print '<span class="rplvalue">'.htmlentities($rpl).'</span>';
    }
}


// Check permissions
require_login($course);

$context=get_context_instance(CONTEXT_COURSE, $course->id);
require_capability('coursereport/completion:view', $context);

// Get group mode
$group = groups_get_course_group($course, true); // Supposed to verify group
if($group === 0 && $course->groupmode == SEPARATEGROUPS) {
    require_capability('moodle/site:accessallgroups',$context);
}


/**
 * Load data
 */

// Get criteria for course
$completion = new completion_info($course);

if (!$completion->has_criteria()) {
    print_error('err_nocriteria', 'completion', $CFG->wwwroot.'/course/report.php?id='.$course->id);
}

// Get criteria and put in correct order
$criteria = array();

foreach ($completion->get_criteria(COMPLETION_CRITERIA_TYPE_COURSE) as $criterion) {
    $criteria[] = $criterion;
}

foreach ($completion->get_criteria(COMPLETION_CRITERIA_TYPE_ACTIVITY) as $criterion) {
    $criteria[] = $criterion;
}

foreach ($completion->get_criteria() as $criterion) {
    if (!in_array($criterion->criteriatype, array(
            COMPLETION_CRITERIA_TYPE_COURSE, COMPLETION_CRITERIA_TYPE_ACTIVITY))) {
        $criteria[] = $criterion;
    }
}

// Can logged in user mark users as complete?
// (if the logged in user has a role defined in the role criteria)
$allow_marking = false;
$allow_marking_criteria = null;

if (!$csv) {
    // Get role criteria
    $rcriteria = $completion->get_criteria(COMPLETION_CRITERIA_TYPE_ROLE);

    if (!empty($rcriteria)) {

        foreach ($rcriteria as $rcriterion) {
            $users = get_role_users($rcriterion->role, $context, true);

            // If logged in user has this role, allow marking complete
            if ($users && in_array($USER->id, array_keys($users))) {
                $allow_marking = true;
                $allow_marking_criteria = $rcriterion->id;
                break;
            }
        }
    }
}

// Generate where clause
$where = array();
$ilike = sql_ilike();

if ($sifirst !== 'all') {
    $where[] = "u.firstname $ilike '$sifirst%'";
}

if ($silast !== 'all') {
    $where[] = "u.lastname $ilike '$silast%'";
}

// Get user match count
$total = $completion->get_num_tracked_users(implode(' AND ', $where), $group);

// Total user count
$grandtotal = $completion->get_num_tracked_users('', $group);

// If no users in this course what-so-ever
if (!$grandtotal) {
    print_box_start('errorbox errorboxcontent boxaligncenter boxwidthnormal');
    print '<p class="nousers">'.get_string('err_nousers','completion').'</p>';
    print '<p><a href="'.$CFG->wwwroot.'/course/report.php?id='.$course->id.'">'.get_string('continue').'</a></p>';
    print_box_end();
    print_footer($course);
    exit;
}

// Get user data
$progress = array();

if ($total) {
    $progress = $completion->get_progress_all(
        implode(' AND ', $where),
        $group,
        $firstnamesort ? 'u.firstname ASC' : 'u.lastname ASC',
        $csv ? 0 : COMPLETION_REPORT_PAGE,
        $csv ? 0 : $start
    );
}


/**
 * Setup page header
 */
if ($csv) {
    header('Content-Disposition: attachment; filename=progress.'.
        preg_replace('/[^a-z0-9-]/','_',strtolower($course->shortname)).'.csv');
    // Unicode byte-order mark for Excel
    if($excel) {
        header('Content-Type: text/csv; charset=UTF-16LE');
        print chr(0xFF).chr(0xFE);
        $sep="\t".chr(0);
        $line="\n".chr(0);
    } else {
        header('Content-Type: text/csv; charset=UTF-8');
        $sep=",";
        $line="\n";
    }

} else {
    // Navigation and header
    $strreports = get_string("reports");
    $strcompletion = get_string('completionreport','completion');
    $navlinks = array();
    $navlinks[] = array('name' => $strreports, 'link' => "../../report.php?id=$course->id", 'type' => 'misc');
    $navlinks[] = array('name' => $strcompletion, 'link' => null, 'type' => 'misc');
    print_header($strcompletion, $course->fullname, build_navigation($navlinks));

    require_js(
        array(
            'yui_yahoo',
            'yui_dom',
            'yui_element',
            'yui_event',
            'yui_connection',
            $CFG->wwwroot.'/course/report/completion/textrotate.js',
            $CFG->wwwroot.'/local/js/lib/jquery-1.3.2.min.js',
            $CFG->wwwroot.'/local/js/completion.report.js.php?id='.$course->id,
        )
    );

    // Handle groups (if enabled)
    groups_print_course_menu($course, $CFG->wwwroot.'/course/report/completion/?course='.$course->id);
}

// Build link for paging
$link = $CFG->wwwroot.'/course/report/completion/?course='.$course->id;
if (strlen($sort)) {
    $link .= '&amp;sort='.$sort;
}
$link .= '&amp;start=';

// Build the the page by Initial bar
$initials = array('first', 'last');
$alphabet = explode(',', get_string('alphabet'));

$pagingbar = '';
foreach ($initials as $initial) {
    $var = 'si'.$initial;

    $pagingbar .= ' <div class="initialbar '.$initial.'initial">';
    $pagingbar .= get_string($initial.'name').':&nbsp;';

    if ($$var == 'all') {
        $pagingbar .= '<strong>'.get_string('all').'</strong> ';
    }
    else {
        $pagingbar .= '<a href="'.$link.'">'.get_string('all').'</a> ';
    }

    foreach ($alphabet as $letter) {
        if ($$var === $letter) {
            $pagingbar .= '<strong>'.$letter.'</strong> ';
        }
        else {
            $pagingbar .= '<a href="'.$link.'&amp;'.$var.'='.$letter.'">'.$letter.'</a> ';
        }
    }

    $pagingbar .= '</div>';
}

// Do we need a paging bar?
if($total > COMPLETION_REPORT_PAGE) {

    // Paging bar
    $pagingbar .= '<div class="paging">';
    $pagingbar .= get_string('page').': ';

    // Display previous link
    if ($start > 0) {
        $pstart = max($start - COMPLETION_REPORT_PAGE, 0);
        $pagingbar .= '(<a class="previous" href="'.$link.$pstart.'">'.get_string('previous').'</a>)&nbsp;';
    }

    // Create page links
    $curstart = 0;
    $curpage = 0;
    while ($curstart < $total) {
        $curpage++;

        if ($curstart == $start) {
            $pagingbar .= '&nbsp;'.$curpage.'&nbsp;';
        }
        else {
            $pagingbar .= '&nbsp;<a href="'.$link.$curstart.'">'.$curpage.'</a>&nbsp;';
        }

        $curstart += COMPLETION_REPORT_PAGE;
    }

    // Display next link
    $nstart = $start + COMPLETION_REPORT_PAGE;
    if ($nstart < $total) {
        $pagingbar .= '&nbsp;(<a class="next" href="'.$link.$nstart.'">'.get_string('next').'</a>)';
    }

    $pagingbar .= '</div>';
}


/**
 * Draw table header
 */

// Start of table
if(!$csv) {
    print '<br class="clearer"/>'; // ugh

    $total_header = ($total == $grandtotal) ? $total : "{$total}/{$grandtotal}";
    print_heading(get_string('allparticipants').": {$total_header}", '', 3);

    print $pagingbar;

    if (!$total) {
        print_heading(get_string('nothingtodisplay'));
        print_footer($course);
        exit;
    }

    print '<table id="completion-progress" class="generaltable flexible boxaligncenter completionreport" style="text-align: left" cellpadding="5" border="1">';

    // Print criteria group names
    print PHP_EOL.'<tr style="vertical-align: top">';
    print '<th scope="row" class="rowheader">'.get_string('criteriagroup', 'completion').'</th>';

    $current_group = false;
    $col_count = 0;
    for ($i = 0; $i <= count($criteria); $i++) {

        if (isset($criteria[$i])) {
            $criterion = $criteria[$i];

            if ($current_group && $criterion->criteriatype === $current_group->criteriatype) {
                ++$col_count;
                continue;
            }
        }

        // Print header cell
        if ($col_count) {
            print '<th scope="col" colspan="'.$col_count.'" class="colheader criteriagroup">'.$current_group->get_type_title().'</th>';
        }

        if (isset($criteria[$i])) {
            // Move to next criteria type
            $current_group = $criterion;
            $col_count = 1;
        }
    }

    // Overall course completion status
    print '<th style="text-align: center;">'.get_string('course').'</th>';

    print '</tr>';

    // Print aggregation methods
    print PHP_EOL.'<tr style="vertical-align: top">';
    print '<th scope="row" class="rowheader">'.get_string('aggregationmethod', 'completion').'</th>';

    $current_group = false;
    $col_count = 0;
    for ($i = 0; $i <= count($criteria); $i++) {

        if (isset($criteria[$i])) {
            $criterion = $criteria[$i];

            if ($current_group && $criterion->criteriatype === $current_group->criteriatype) {
                ++$col_count;
                continue;
            }
        }

        // Print header cell
        if ($col_count) {
            $has_agg = array(
                COMPLETION_CRITERIA_TYPE_COURSE,
                COMPLETION_CRITERIA_TYPE_ACTIVITY,
                COMPLETION_CRITERIA_TYPE_ROLE,
            );

            if (in_array($current_group->criteriatype, $has_agg)) {
                // Try load a aggregation method
                $method = $completion->get_aggregation_method($current_group->criteriatype);

                $method = $method == 1 ? 'All' : 'Any';

            } else {
                $method = '-';
            }

            print '<th scope="col" colspan="'.$col_count.'" class="colheader aggheader">'.$method.'</th>';
        }

        if (isset($criteria[$i])) {
            // Move to next criteria type
            $current_group = $criterion;
            $col_count = 1;
        }
    }

    // Overall course aggregation method
    print '<th scope="col" class="colheader aggheader aggcriteriacourse">';

    // Get course aggregation
    $method = $completion->get_aggregation_method();

    // Print
    if (COMPLETION_REPORT_RPL) {
        if ($method == 1) {
            print 'RPL for course or<br /> all criteria groups';
        } else {
            print 'RPL for course or<br /> any criteria group';
        }
    } else {
        print $method == 1 ? 'All' : 'Any';
    }
    print '</th>';

    print '</tr>';


    // Print criteria titles
    if (COMPLETION_REPORT_COL_TITLES) {

        print PHP_EOL.'<tr>';
        print '<th scope="row" class="rowheader">'.get_string('criteria', 'completion').'</th>';

        foreach ($criteria as $criterion) {
            // Get criteria details
            $details = $criterion->get_title_detailed();
            print '<th scope="col" class="colheader criterianame">';
            print '<span class="completion-criterianame">'.$details.'</span>';

            if ($criterion->module == 'facetoface' && COMPLETION_REPORT_RPL) {
                print '<span class="completion-rplheader completion-criterianame">'.get_string('recognitionofpriorlearning', 'completion').'</span>';
            }

            print '</th>';
        }

        // Overall course completion status
        print '<th scope="col" class="colheader criterianame">';

        print '<span class="completion-criterianame">'.get_string('coursecomplete', 'completion').'</span>';
        if (COMPLETION_REPORT_RPL) {
            print '<span class="completion-rplheader completion-criterianame">'.get_string('recognitionofpriorlearning', 'completion').'</span>';
        }

        print '</th></tr>';
    }

    // Print user heading and icons
    print '<tr>';

    // User heading / sort option
    print '<th scope="col" class="completion-sortchoice" style="clear: both;">';
    if($firstnamesort) {
        print
            get_string('firstname').' / <a href="./?course='.$course->id.'">'.
            get_string('lastname').'</a>';
    } else {
        print '<a href="./?course='.$course->id.'&amp;sort=firstname">'.
            get_string('firstname').'</a> / '.
            get_string('lastname');
    }
    print '</th>';


    // Print user id number column
    if($idnumbers) {
        print '<th>'.get_string('idnumber').'</th>';
    }

    ///
    /// Print criteria icons
    ///
    foreach ($criteria as $criterion) {

        // Generate icon details
        $icon = '';
        $iconlink = '';
        $icontitle = ''; // Required if $iconlink set
        $iconalt = ''; // Required
        switch ($criterion->criteriatype) {

            case COMPLETION_CRITERIA_TYPE_ACTIVITY:
                // Load activity
                $activity = $criterion->get_mod_instance();

                // Display icon
                $icon = $CFG->modpixpath.'/'.$criterion->module.'/icon.gif';
                $iconlink = $CFG->wwwroot.'/mod/'.$criterion->module.'/view.php?id='.$criterion->moduleinstance;
                $icontitle = $activity->name;
                $iconalt = get_string('modulename', $criterion->module);
                break;

            case COMPLETION_CRITERIA_TYPE_COURSE:
                // Load course
                $crs = get_record('course', 'id', $criterion->courseinstance);

                // Display icon
                $iconlink = $CFG->wwwroot.'/course/view.php?id='.$criterion->courseinstance;
                $icontitle = $crs->fullname;
                $iconalt = $crs->shortname;
                break;

            case COMPLETION_CRITERIA_TYPE_ROLE:
                // Load role
                $role = get_record('role', 'id', $criterion->role);

                // Display icon
                $iconalt = $role->name;
                break;
        }

        // Print icon and cell
        print '<th class="criteriaicon">';

        // Create icon if not supplied
        if (!$icon) {
            $icon = $CFG->pixpath.'/i/'.$COMPLETION_CRITERIA_TYPES[$criterion->criteriatype].'.gif';
        }

        print ($iconlink ? '<a href="'.$iconlink.'" title="'.$icontitle.'">' : '');
        print '<img src="'.$icon.'" class="icon" alt="'.$iconalt.'" '.(!$iconlink ? 'title="'.$iconalt.'"' : '').' />';
        print ($iconlink ? '</a>' : '');

        if ($criterion->module == 'facetoface' && COMPLETION_REPORT_RPL) {
            print '<img src="'.$CFG->pixpath.'/i/course.gif" class="icon" alt="RPL" title="Activity RPL" />';
            print '<a href="#" class="rplexpand rpl-'.$criterion->id.'" title="Show RPLs"><img src="'.$CFG->pixpath.'/i/one.gif" class="icon" alt="+"/></a>';
        }

        print '</th>';
    }

    // Overall course completion status
    print '<th class="criteriaicon">';
    print '<img src="'.$CFG->pixpath.'/i/course.gif" class="icon" alt="Course" title="Course Complete" />';

    if (COMPLETION_REPORT_RPL) {
        print '<img src="'.$CFG->pixpath.'/i/course.gif" class="icon" alt="RPL" title="Course RPL" />';
        print '<a href="#" class="rplexpand rpl-course" title="Show RPLs"><img src="'.$CFG->pixpath.'/i/one.gif" class="icon" alt="+"/></a>';
    }

    print '</th>';

    print '</tr>';


} else {
    // TODO
    if($idnumbers) {
        print $sep;
    }
}


///
/// Display a row for each user
///
foreach ($progress as $user) {

    // User name
    if($csv) {
        print csv_quote(fullname($user));
        if($idnumbers) {
            print $sep.csv_quote($user->idnumber);
        }
    } else {
        print PHP_EOL.'<tr id="user-'.$user->id.'">';

        print '<th scope="row"><a href="'.$CFG->wwwroot.'/user/view.php?id='.
            $user->id.'&amp;course='.$course->id.'">'.fullname($user).'</a></th>';
        if($idnumbers) {
            print '<td>'.htmlspecialchars($user->idnumber).'</td>';
        }
    }

    // Progress for each course completion criteria
    foreach ($criteria as $criterion) {

        // Handle activity completion differently
        if ($criterion->criteriatype == COMPLETION_CRITERIA_TYPE_ACTIVITY) {

            // Load activity
            $mod = $criterion->get_mod_instance();
            $activity = get_record('course_modules', 'id', $criterion->moduleinstance);
            $activity->name = $mod->name;


            // Get progress information and state
            if(array_key_exists($activity->id,$user->progress)) {
                $thisprogress=$user->progress[$activity->id];
                $state=$thisprogress->completionstate;
                $date=userdate($thisprogress->timemodified);
            } else {
                $state=COMPLETION_INCOMPLETE;
                $date='';
            }

            $criteria_completion = $completion->get_user_completion($user->id, $criterion);

            // Work out how it corresponds to an icon
            switch($state) {
                case COMPLETION_INCOMPLETE : $completiontype='n'; break;
                case COMPLETION_COMPLETE : $completiontype='y'; break;
                case COMPLETION_COMPLETE_PASS : $completiontype='pass'; break;
                case COMPLETION_COMPLETE_FAIL : $completiontype='fail'; break;
            }

            $completionicon='completion-'.
                ($activity->completion==COMPLETION_TRACKING_AUTOMATIC ? 'auto' : 'manual').
                '-'.$completiontype;

            $describe=get_string('completion-alt-auto-'.$completiontype,'completion');
            $a=new StdClass;
            $a->state=$describe;
            $a->date=$date;
            $a->user=fullname($user);
            $a->activity=strip_tags($activity->name);
            $fulldescribe=get_string('progress-title','completion',$a);

            if($csv) {
                print $sep.csv_quote($describe).$sep.csv_quote($date);
            } else {
                print '<td class="completion-progresscell rpl-'.$criterion->id.'">';

                print '<img src="'.$CFG->pixpath.'/i/'.$completionicon.'.gif'.
                      '" alt="'.$describe.'" class="icon" title="'.$fulldescribe.'" />';

                // Decide if we need to display an RPL
                if ($criterion->module == 'facetoface') {
                    show_rpl($criterion->id, $user, $criteria_completion->rpl, $describe, $fulldescribe);
                }

                print '</td>';
            }

            continue;
        }

        // Handle all other criteria
        $criteria_completion = $completion->get_user_completion($user->id, $criterion);
        $is_complete = $criteria_completion->is_complete();

        $completiontype = $is_complete ? 'y' : 'n';
        $completionicon = 'completion-auto-'.$completiontype;

        $describe = get_string('completion-alt-auto-'.$completiontype, 'completion');

        $a = new Object();
        $a->state    = $describe;
        $a->date     = $is_complete ? userdate($criteria_completion->timecompleted) : '';
        $a->user     = fullname($user);
        $a->activity = strip_tags($criterion->get_title());
        $fulldescribe = get_string('progress-title', 'completion', $a);

        if ($csv) {
            print $sep.csv_quote($describe);
        } else {

            if ($allow_marking_criteria === $criterion->id) {
                $describe = get_string('completion-alt-auto-'.$completiontype,'completion');

                print '<td class="completion-progresscell">'.
                    '<a href="'.$CFG->wwwroot.'/course/togglecompletion.php?user='.$user->id.'&course='.$course->id.'&rolec='.$allow_marking_criteria.'">'.
                    '<img src="'.$CFG->pixpath.'/i/completion-manual-'.($is_complete ? 'y' : 'n').'.gif'.
                    '" alt="'.$describe.'" class="icon" title="Mark as complete" /></a></td>';
            } else {
                print '<td class="completion-progresscell">'.
                    '<img src="'.$CFG->pixpath.'/i/'.$completionicon.'.gif'.
                    '" alt="'.$describe.'" class="icon" title="'.$fulldescribe.'" /></td>';
            }
        }
    }

    // Handle overall course completion

    // Load course completion
    $params = array(
        'userid'    => $user->id,
        'course'    => $course->id
    );

    $ccompletion = new completion_completion($params);
    $completiontype =  $ccompletion->is_complete() ? 'y' : 'n';

    $describe = get_string('completion-alt-auto-'.$completiontype, 'completion');

    $a = new StdClass;
    $a->state    = $describe;
    $a->date     = '';
    $a->user     = fullname($user);
    $a->activity = strip_tags(get_string('coursecomplete', 'completion'));
    $fulldescribe = get_string('progress-title', 'completion', $a);

    if ($csv) {
        print $sep.csv_quote($describe);
    } else {

        print '<td class="completion-progresscell rpl-course">';

        // Display course completion status icon
        print '<img src="'.$CFG->pixpath.'/i/completion-auto-'.$completiontype.'.gif'.
               '" alt="'.$describe.'" class="icon" title="'.$fulldescribe.'" />';

        show_rpl('course', $user, $ccompletion->rpl, $describe, $fulldescribe);

        print '</td>';
    }

    if($csv) {
        print $line;
    } else {
        print '</tr>';
    }
}

if($csv) {
    exit;
}
print '</table>';
print $pagingbar;

print '<ul class="progress-actions"><li><a href="index.php?course='.$course->id.
    '&amp;format=csv">'.get_string('csvdownload','completion').'</a></li>
    <li><a href="index.php?course='.$course->id.'&amp;format=excelcsv">'.
    get_string('excelcsvdownload','completion').'</a></li></ul>';

print_footer($course);

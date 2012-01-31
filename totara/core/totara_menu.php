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
 * @author Jonathan Newman <jonathan.newman@catalyst.net.nz>
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @author Aaron Barnes <aaronb@catalyst.net.nz>
 * @author Alastair Munro <alastair@catalyst.net.nz>
 * @package totara
 * @subpackage local
 */

require_once($CFG->dirroot . '/theme/totara/helpers.php');
require_once($CFG->dirroot . '/local/plan/lib.php');

// multi-dimensional array containing nested list
// of tab names
$navstructure = array(
    'home' => array(
        'profile',
    ),
    'mylearning' => array(
        'learnerdashboard',
        'learningplans',
        'mybookings',
        'recordoflearning',
        'requiredlearning',
    ),
    'myteam' => array(
        'managerdashboard',
        'teammembers',
    ),
    'myreports' => array(),
    'findcourses' => array(
        'courses',
        'programs',
    ),
    'calendar' => array(),
);

// define partial urls which match particular tabs
// partial matches against the start of the URL accepted
// so '/course/' will match any page in the course directory
// for multiple matches, use an array
$navmatches = array(
    'home' => '/index.php',
    'profile' => '/user/view.php',
    'learnerdashboard' => '/my/learning.php',
    'learningplans' => '/local/plan/',
    'mybookings' => array(
        '/my/bookings.php',
        '/my/pastbookings.php',
    ),
    'recordoflearning' => '/local/plan/record/',
    'requiredlearning' => array(
        '/local/program/required.php',
        '/local/program/view.php',
     ),
    'managerdashboard' => '/my/team.php',
    'teammembers' => '/my/teammembers.php',
    'myreports' => '/my/reports.php',
    'courses' => array(
        '/course/categorylist.php?viewtype=course',
        '/course/search.php?viewtype=course'
    ),
    'programs'=> array(
        '/course/categorylist.php?viewtype=program',
        '/course/search.php?viewtype=program'
    ),
    'calendar' => array(
        '/blocks/facetoface/calendar.php',
        '/calendar/',
    ),
);

// Figure out which tabs should be selected for this page
list($primary_selected, $secondary_selected) =
   totara_get_selected_navs($navstructure, $navmatches);

// add special-case overrides here

// match the homepage if url is empty
$page_url = substr(qualified_me(), strlen($CFG->wwwroot));
if($page_url == '/') {
    $primary_selected = 'home';
    $secondary_selected = null;
}

// if we are viewing a learning plan, bookings,
// or record of learning, see if we are viewing our
// own or someone else's
$userid = optional_param('userid', null, PARAM_INT);
if(in_array($secondary_selected, array(
    'learningplans', 'mybookings', 'recordoflearning', 'requiredlearning'))) {
    if(isset($userid) && $userid != $USER->id) {
        $primary_selected = 'myteam';
        $secondary_selected = null;
    }
}

// look up the plan's user to see if they are
// viewing one of their own plans or not
if($secondary_selected == 'learningplans') {
    $planid = optional_param('id', null, PARAM_INT);
    if($planid) {
        $userid = get_field('dp_plan', 'userid', 'id', $planid);
        if($userid && $userid != $USER->id) {
            $primary_selected = 'myteam';
            $secondary_selected = null;
        }
    }
}

if ((substr(me(), 0, 23)) == '/local/program/view.php') {
    $primary_selected = 'findcourses';
    $secondary_selecte = 'programs';
}

if ((substr(me(), 8, 16)) == 'categorylist.php') {
    $primary_selected = 'findcourses';
}

if ((substr(me(), 8, 12)) == 'category.php') {
    $primary_selected = 'findcourses';
}

// Make sure correct tabs are selected when managing/viewing courses and programs
global $SESSION;
if ($primary_selected == 'findcourses') {
    if(isset($SESSION->viewtype) && $SESSION->viewtype == 'course') {
        $secondary_selected = 'courses';
    } else {
        $secondary_selected = 'programs';
    }
}


$sitecontext = get_context_instance(CONTEXT_SYSTEM);
$canviewdashboards  = has_capability('local/dashboard:view', $sitecontext, $USER->id);
$canviewlearningplans = dp_can_view_users_plans($USER->id);

$u = !empty($userid) ? $userid : $USER->id;

$requiredlearninglink = prog_get_tab_link($u);

// get an array of class string snippets to be applied to each tab element
$selected = totara_get_nav_select_classes($navstructure, $primary_selected, $secondary_selected);

if($header){
?>


<div class="header-search">
<form id="coursesearch" action="<?php echo $CFG->wwwroot ?>/course/search.php" method="get">
  <fieldset class="coursesearchbox invisiblefieldset">
    <input type="hidden" name="viewtype" value="course" />
    <input type="text" id="coursesearchbox" size="30" name="search" value="" />
    <input id="coursesubmit" type="submit" value="Go" />
  </fieldset>
</form>
</div>
<?php
}
?>

<ul>
    <li class="first<?php echo $selected['home']; ?> menu1">
    <div><a href="<?php echo $CFG->wwwroot.'/index.php' ?>"><?php echo get_string('home') ?></a>
            <?php
            if($selected['home']) {
                $text ='<ul><li class="first last' .
                    $selected['profile'] . '"><a href="' . $CFG->wwwroot .
                    '/user/view.php?id=' . $USER->id . '">' .
                    get_string('myprofile', 'local') . '</a></li></ul>';
                echo $text;
            }
            ?>
        </div>
    </li>


    <li class="<?php echo $selected['mylearning']; ?> menu2">
        <div>
            <?php
                // Get default mylearning sub tab
                if ($canviewdashboards) {
                    $defaultmylearning = $CFG->wwwroot.'/my/learning.php';
                }
                else if ($canviewlearningplans) {
                    $defaultmylearning = $CFG->wwwroot.'/local/plan/index.php';
                }
                else {
                    $defaultmylearning = $CFG->wwwroot.'/my/bookings.php';
                }
            ?>
            <a href="<?php echo $defaultmylearning; ?>"><?php echo get_string('mylearning', 'local') ?></a>
            <?php
            if ($selected['mylearning']) {
                $text ='<ul>';

                if ($canviewdashboards) {
                    $text .= '<li class="first' . $selected['learnerdashboard'] .
                        '"><a href="' . $CFG->wwwroot . '/my/learning.php">' .
                        get_string('dashboard', 'local_dashboard').'</a></li>';
                }

                if ($canviewlearningplans) {
                    $text .='<li class="' . $selected['learningplans'] .
                        '"><a href="' . $CFG->wwwroot . '/local/plan/index.php">' .
                        get_string('learningplans', 'local').'</a></li>';
                }

                $text .='<li class="' . $selected['mybookings'] .
                    '"><a href="' . $CFG->wwwroot . '/my/bookings.php">' .
                    get_string('mybookings', 'local').'</a></li>';
                $text .='<li class="' . $selected['recordoflearning'] .
                    '"><a href="' . $CFG->wwwroot .
                    '/local/plan/record/courses.php">' .
                    get_string('recordoflearning', 'local').'</a></li>';

                if ($requiredlearninglink) {
                    $text .='<li class="last' . $selected['requiredlearning'] .
                        '"><a href="' . $requiredlearninglink . '">' .
                        get_string('requiredlearning', 'local_program').'</a></li>';
                    $text .= '</ul>';
                }

                echo $text;
            }
            ?>
        </div>
    </li>


    <?php if($staff = totara_get_staff()) { ?>
    <li class="<?php echo $selected['myteam']; ?> menu3">
        <div>
            <a href="<?php echo ($canviewdashboards ? $CFG->wwwroot.'/my/team.php' : $CFG->wwwroot.'/my/teammembers.php') ?>"><?php echo get_string('myteam', 'local') ?></a>
            <?php
            if($selected['myteam']) {
                $text ='<ul>';
                if($canviewdashboards) {
                    $text .= '<li class="first' . $selected['managerdashboard'] .
                        '"><a href="' . $CFG->wwwroot . '/my/team.php">' .
                        get_string('dashboard', 'local_dashboard') . '</a></li>';
                }

                $text .='<li class="last' . $selected['teammembers'] .
                    '"><a href="' . $CFG->wwwroot . '/my/teammembers.php">' .
                    get_string('teammembers', 'local') . '</a></li></ul>';
                echo $text;
            }
            ?>
        </div>
    </li>
    <?php } ?>

    <li class="<?php echo $selected['myreports']; ?> menu4">
        <div>
            <a href="<?php echo $CFG->wwwroot.'/my/reports.php' ?>"><?php echo get_string('myreports', 'local') ?></a>
        </div>
    </li>


    <li class="<?php echo $selected['findcourses']; ?> menu5">
        <div>
        <a href="<?php echo $CFG->wwwroot.'/course/categorylist.php?viewtype=course' ?>"><?php echo get_string('findcourses', 'local') ?></a>
            <?php
            if($selected['findcourses']) {
                $text ='<ul><li class="first' . $selected['courses'] .
                    '"><a href="' . $CFG->wwwroot . '/course/categorylist.php?viewtype=course">' .
                    get_string('courses') . '</a></li>';
                $text .='<li class="last' . $selected['programs'] .
                    '"><a href="' . $CFG->wwwroot . '/course/categorylist.php?viewtype=program">' .
                    get_string('programs', 'local_program') . '</a></li>';
                $text .= '</ul>';
                echo $text;
            }
            ?>
        </div>
    </li>


    <li class="last<?php echo $selected['calendar']; ?> menu6">
        <div>
        <a href="<?php echo $CFG->wwwroot.'/calendar/view.php?view=month' ?>"><?php echo get_string('calendar', 'local') ?></a>
        </div>
    </li>
</ul>


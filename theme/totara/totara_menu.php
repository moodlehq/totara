<?php

require_once($CFG->dirroot . '/theme/totara/helpers.php');

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
    ),
    'myteam' => array(
        'managerdashboard',
        'teammembers',
    ),
    'myreports' => array(),
    'findcourses' => array(
        'searchcourses',
        'browsecourses',
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
    'managerdashboard' => '/my/team.php',
    'teammembers' => '/my/teammembers.php',
    'myreports' => '/my/reports.php',
    'searchcourses' => '/course/find.php',
    'browsecourses' => '/course/index.php',
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
if(me() == '/') {
    $primary_selected = 'home';
    $secondary_selected = null;
}

// if we are viewing a learning plan, bookings,
// or record of learning, see if we are viewing our
// own or someone else's
$userid = optional_param('userid', null, PARAM_INT);
if(in_array($secondary_selected, array(
    'learningplans', 'mybookings', 'recordoflearning'))) {
    if(isset($userid) && $userid != $USER->id) {
        $primary_selected = 'myteam';
        $secondary_selected = null;
    }
}

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
$canviewdashboards  = has_capability('local/dashboard:view', $sitecontext, $USER->id);

// get an array of class string snippets to be applied to each tab element
$selected = totara_get_nav_select_classes($navstructure, $primary_selected, $secondary_selected);
?>
<div id="header-search">
<form id="coursesearch" action="<?php echo $CFG->wwwroot ?>/course/search.php" method="get">
  <fieldset class="coursesearchbox invisiblefieldset">
    <input type="text" id="coursesearchbox" size="30" name="search" value="" />
    <input id="coursesubmit" type="submit" value="Go" />
  </fieldset>
</form>
</div>

<ul>
    <li id="menu1" class="first<?php echo $selected['home']; ?>">
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


    <li id="menu2" class="<?php echo $selected['mylearning']; ?>">
        <div><a href="<?php echo ($canviewdashboards ? $CFG->wwwroot.'/my/learning.php' : $CFG->wwwroot.'/local/plan/index.php') ?>"><?php echo get_string('mylearning', 'local') ?></a>
            <?php
            if($selected['mylearning']) {
                $text ='<ul>';

                if($canviewdashboards) {
                    $text .= '<li class="first' . $selected['learnerdashboard'] .
                        '"><a href="' . $CFG->wwwroot . '/my/learning.php">' .
                        get_string('dashboard', 'local_dashboard').'</a></li>';
                }

                $text .='<li class="' . $selected['learningplans'] .
                    '"><a href="' . $CFG->wwwroot . '/local/plan/index.php">' .
                    get_string('learningplans', 'local').'</a></li>';
                $text .='<li class="' . $selected['mybookings'] .
                    '"><a href="' . $CFG->wwwroot . '/my/bookings.php">' .
                    get_string('mybookings', 'local').'</a></li>';
                $text .='<li class="last' . $selected['recordoflearning'] .
                    '"><a href="' . $CFG->wwwroot .
                    '/local/plan/record/courses.php">' .
                    get_string('recordoflearning', 'local').'</a></li>';
                $text .= '</ul>';
                echo $text;
            }
            ?>
        </div>
    </li>


    <?php if($staff = totara_get_staff()) { ?>
    <li id="menu3" class="<?php echo $selected['myteam']; ?>">
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

    <li id="menu4" class="<?php echo $selected['myreports']; ?>">
        <div>
            <a href="<?php echo $CFG->wwwroot.'/my/reports.php' ?>"><?php echo get_string('myreports', 'local') ?></a>
        </div>
    </li>


    <li id="menu5" class="<?php echo $selected['findcourses']; ?>">
        <div>
        <a href="<?php echo $CFG->wwwroot.'/course/find.php' ?>"><?php echo get_string('findcourses', 'local') ?></a>
            <?php
            if($selected['findcourses']) {
                $text ='<ul><li class="first' . $selected['searchcourses'] .
                    '"><a href="' . $CFG->wwwroot . '/course/find.php">' .
                    get_string('searchcourses', 'local') . '</a></li>';
                $text .= '<li class="last' .  $selected['browsecourses'] .
                    '"><a href="' . $CFG->wwwroot . '/course/index.php">' .
                    get_string('browsecategories', 'local') . '</a></li>';
                $text .= '</ul>';
                echo $text;
            }
            ?>
        </div>
    </li>


    <li id="menu6" class="last<?php echo $selected['calendar']; ?>">
        <div>
            <a href="<?php echo $CFG->wwwroot.'/blocks/facetoface/calendar.php' ?>">Calendar</a>
        </div>
    </li>
</ul>


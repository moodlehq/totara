<?php

// Displays sessions for which the current user is a "teacher" (can see attendees' list)
// as well as the ones where the user is signed up (i.e. a "student")

require_once '../../config.php';
require_once('lib.php');

require_login();

$timenow = time();
$timelater = $timenow + 3 * WEEKSECS;

$startyear  = optional_param('startyear',  strftime('%Y', $timenow), PARAM_INT);
$startmonth = optional_param('startmonth', strftime('%m', $timenow), PARAM_INT);
$startday   = optional_param('startday',   strftime('%d', $timenow), PARAM_INT);
$endyear    = optional_param('endyear',    strftime('%Y', $timelater), PARAM_INT);
$endmonth   = optional_param('endmonth',   strftime('%m', $timelater), PARAM_INT);
$endday     = optional_param('endday',     strftime('%d', $timelater), PARAM_INT);

$action = optional_param('action',          '', PARAM_ALPHA); // one of: '', export
$format = optional_param('format',       'ods', PARAM_ALPHA); // one of: ods, xls

$userid = optional_param('userid', $USER->id, PARAM_INT);
if (!$user = get_record('user', 'id', $userid)) {
    print_error('error:invaliduserid', 'block_facetoface', 'mysignups.php');
}

if ($userid != $USER->id) {
    $contextuser = get_context_instance(CONTEXT_USER, $userid);
    require_capability('block/facetoface:viewbookings', $contextuser);
}

$search = optional_param('search', '', PARAM_TEXT); // search string

$startdate = make_timestamp($startyear, $startmonth, $startday);
$enddate = make_timestamp($endyear, $endmonth, $endday);

$urlparams = "startyear=$startyear&amp;startmonth=$startmonth&amp;startday=$startday&amp;";
$urlparams .= "endyear=$endyear&amp;endmonth=$endmonth&amp;endday=$endday&amp;userid=$userid";

// Process actions if any
if ('export' == $action) {
    export_spreadsheet($dates, $format, true);
    exit;
}

$signups = '';
$users = '';

if ($search) {
    $users = get_users_search($search);
} else {
    // Get all Face-to-face signups from the DB
    $signups = get_records_sql("SELECT d.id, c.id as courseid, c.fullname AS coursename, f.name,
                                       f.id as facetofaceid, s.id as sessionid,
                                       d.timestart, d.timefinish, su.userid, su.timecancelled as status
                                  FROM {$CFG->prefix}facetoface_sessions_dates d
                                  JOIN {$CFG->prefix}facetoface_sessions s ON s.id = d.sessionid
                                  JOIN {$CFG->prefix}facetoface f ON f.id = s.facetoface
                                  JOIN {$CFG->prefix}facetoface_submissions su ON su.sessionid = s.id
                                  JOIN {$CFG->prefix}course c ON f.course = c.id
                                 WHERE d.timestart >= $startdate AND d.timefinish <= $enddate AND
                                       su.userid = $user->id");
    add_location_info($signups);
}
// format the session and dates to only show one booking where they span multiple dates
// i.e. multiple days startdate = firstday, finishdate = last day
$groupeddates = array();
if ($signups and count($signups > 0)) {
    $groupeddates = group_session_dates($signups);
}

// out of the results separate out the future sessions
$futuresessions = future_session_dates($groupeddates);
$nbfuture = 0;
if ($futuresessions and count($futuresessions) > 0) {
    $nbfuture = count($futuresessions);
}

// and the past sessions
$pastsessions = past_session_dates($groupeddates);
$nbpast = 0;
if ($pastsessions and count($pastsessions) > 0) {
    $nbpast = count($pastsessions);
}

$pagetitle = format_string(get_string('facetoface', 'facetoface') . ' ' . get_string('bookings', 'block_facetoface'));
$navlinks[] = array('name' => $pagetitle, 'link' => '', 'type' => 'activityinstance');
$navigation = build_navigation($navlinks);
print_header_simple($pagetitle, '', $navigation);
print_box_start();

// show tabs
$currenttab = 'attending';
include_once('tabs.php');

if (empty($users)) {

    // Date range form
    print '<form method="get" action=""><p>';
    print get_string('daterange', 'block_facetoface') . ' ';
    print_date_selector('startday', 'startmonth', 'startyear', $startdate);
    print ' to ';
    print_date_selector('endday', 'endmonth', 'endyear', $enddate);
    print ' <input type="hidden" value="'.$userid.'" name="userid" />';
    print ' <input type="submit" value="'.get_string('apply', 'block_facetoface').'" /></p></form>';

    // Show sign-ups
    if ($userid != $USER->id) {
        print_heading(get_string('futurebookingsfor', 'block_facetoface', fullname($user)));
    } else {
        print_heading(get_string('futurebookings', 'block_facetoface'));
    }
    if ($nbfuture > 0) {
        print_dates($futuresessions, false, false, true);
    }
    else{
        print '<p>'.get_string('signedupinzero', 'block_facetoface').'</p>';
    }

    // Show past bookings
    if ($userid != $USER->id) {
        print_heading(get_string('pastbookingsfor', 'block_facetoface', fullname($user)));
    } else {
        print_heading(get_string('pastbookings', 'block_facetoface'));
    }
    if ($nbpast > 0) {
        print_dates($pastsessions, false, true);
    }
    else{
        print '<p>'.get_string('signedupinzero', 'block_facetoface').'</p>';
    }
} else if ($users) {
    if (count($users) > 0) {
        print_heading(get_string('searchedusers','block_facetoface', count($users)));
        foreach ($users as $u) {
            print '<a href="'.$CFG->wwwroot.'/blocks/facetoface/mysignups.php?'.$urlparams.'&amp;userid='.$u->id.'">'.fullname($u).'</a><br />';
        }
    }
}

print_heading(get_string('searchusers', 'block_facetoface'));

echo '<form class="learnersearch" id="searchquery" method="post" action="'.$CFG->wwwroot.'/blocks/facetoface/mysignups.php">';
echo '<div class="usersearch">';
print '<input type="hidden" name="startyear" value="'.$startyear.'" />';
print '<input type="hidden" name="startmonth" value="'.$startmonth.'" />';
print '<input type="hidden" name="startday" value="'.$startday.'" />';
print '<input type="hidden" name="endyear" value="'.$endyear.'" />';
print '<input type="hidden" name="endmonth" value="'.$endmonth.'" />';
print '<input type="hidden" name="endday" value="'.$endday.'" />';
echo '<input class="searchform" type="text" name="search" size="35" maxlength="255" value="'.$search.'"/>';
echo '<input type="submit" value="Search" />';
echo '</div>';
echo '</form>';

print_box_end();
print_footer();

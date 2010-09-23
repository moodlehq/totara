<?php

require_once '../../config.php';
require_once "$CFG->dirroot/calendar/lib.php";
require_once "$CFG->dirroot/mod/facetoface/lib.php";

require_js('yui_dom-event');
require_js('yui_container');

define('MAX_EVENTS_PER_DAY', 5);
define('MAX_WAITLISTED_SESSIONS', 7);

$timenow = time();

$currenttab = optional_param('tab', 'm', PARAM_ALPHA);
$day        = optional_param('cal_d', strftime('%d', $timenow), PARAM_INT);
$month      = optional_param('cal_m', strftime('%m', $timenow), PARAM_INT);
$year       = optional_param('cal_y', strftime('%Y', $timenow), PARAM_INT);

require_login();

$baseparams = "cal_d=$day&amp;cal_m=$month&amp;cal_y=$year";

$sessionids = array(); // will get the list of sessions to display in the bottom box
$events = array();

// Grab filter parameters
$activefilters = array();
$customfields = facetoface_get_session_customfields();
foreach ($customfields as $field) {
    if (empty($field->isfilter)) {
        continue;
    }

    $fieldname = "field_$field->shortname";
    $currentvalue = optional_param($fieldname, '', PARAM_TEXT);
    if (!empty($currentvalue)) {
        $activefilters[$field->id] = $currentvalue;
    }
}

// Save/restore filters
if (empty($activefilters)) {
    // Nothing selected: restore last filter selection from the session
    $usersetting = get_user_preferences('facetoface_calendarfilters');
    if (!empty($usersetting)) {
        if (!$activefilters = unserialize($usersetting)) {
            $activefilters = array(); // broken serialized structure
        }
    }
}
else {
    // Save current filter selection in the session
    unset_user_preference('facetoface_calendarfilters');
    set_user_preference('facetoface_calendarfilters', serialize($activefilters));
}

// Page header
$pagetitle = get_string('trainingcalendar', 'block_facetoface');
$navlinks[] = array('name' => $pagetitle);
$navigation = build_navigation($navlinks);
print_header_simple($pagetitle, '', $navigation, '', '', true);

// Custom field filters
$tablecells = array();
foreach ($customfields as $field) {
    if ($html = customfield_chooser($field)) {
        $tablecells[] = $html;
    }
}
if (!empty($tablecells)) {
    $label = get_string('apply', 'block_facetoface');
    $tablecells[] = '<input type="submit" value="'.$label.'" />';

    $table = new object();
    $table->data[] = $tablecells;
    $table->tablealign = 'left';
    $table->summary = get_string('filters:tablesummary', 'block_facetoface');

    print '<form method="get" action="calendar.php">';
    print_box_start('generalbox calendarfilters');
    print '<input type="hidden" name="tab" value="'.$currenttab.'"/>';
    print '<input type="hidden" name="cal_d" value="'.$day.'"/>';
    print '<input type="hidden" name="cal_m" value="'.$month.'"/>';
    print '<input type="hidden" name="cal_y" value="'.$year.'"/>';
    print_table($table);
    print_box_end();
    print '</form>';
}

// Important notices
if ($notice = get_notice($activefilters)) {
    print_box_start();
    print format_text($notice, FORMAT_HTML);
    print_box_end();
}

// Display settings
$courses = true; // display all courses
$groups = false; // don't show group events
$users = $USER->id; // show current user events
$courseid = SITEID;
$displayinfo = get_display_info($day, $month, $year);

get_sessions($displayinfo, $groups, $users, $courses, $activefilters, $events, $sessionids);
$waitlistedsessions = get_matching_waitlisted_sessions($activefilters);

// List of all available sessions
print_box_start('generalbox clearfix');
$row[] = new tabobject('m', "calendar.php?tab=m&amp;$baseparams#sessionlist", get_string('tab:calendar','block_facetoface'));
$row[] = new tabobject('c', "calendar.php?tab=c&amp;$baseparams#sessionlist", get_string('tab:bycourse','block_facetoface'));
$row[] = new tabobject('d', "calendar.php?tab=d&amp;$baseparams#sessionlist", get_string('tab:bydate','block_facetoface'));
$tabs[] = $row;
print '<a name="sessionlist"></a><div>';
print_tabs($tabs, $currenttab);
$sessionsbydate = get_sessions_by_date($sessionids, $displayinfo);
if ('c' == $currenttab) {
    $sessionsbycourse = get_sessions_by_course($sessionids, $displayinfo, $waitlistedsessions);
    print_sessions($sessionsbycourse, $currenttab);
}
elseif ('d' == $currenttab) {
    print_sessions($sessionsbydate, $currenttab);
}
else {
    show_month_detailed($baseparams, $displayinfo, $month, $year, $courses, $groups, $users, $courseid, $activefilters, $waitlistedsessions, $events);
}
print '</div>';
print_box_end();

print_tooltips($sessionsbydate);

print_footer();

function get_display_info($d, $m, $y)
{
    $display = new stdClass;
    $display->minwday = get_user_preferences('calendar_startwday', CALENDAR_STARTING_WEEKDAY);
    $display->maxwday = $display->minwday + 6;

    $thisdate = usergetdate(time()); // Time and day at the user's location
    if($m == $thisdate['mon'] && $y == $thisdate['year']) {
        // Navigated to this month
        $date = $thisdate;
        $display->thismonth = true;
    }
    else {
        // Navigated to other month, let's do a nice trick and save us a lot of work...
        if(!checkdate($m, 1, $y)) {
            $date = array('mday' => 1, 'mon' => $thisdate['mon'], 'year' => $thisdate['year']);
            $display->thismonth = true;
        }
        else {
            $date = array('mday' => 1, 'mon' => $m, 'year' => $y);
            $display->thismonth = false;
        }
    }

    // Fill in the variables we 're going to use, nice and tidy
    list($day, $month, $year) = array($date['mday'], $date['mon'], $date['year']); // This is what we want to display
    $display->maxdays = calendar_days_in_month($m, $y);

    $startwday = 0;
    if (get_user_timezone_offset() < 99) {
        // We 'll keep these values as GMT here, and offset them when the time comes to query the db
        $display->tstart = gmmktime(0, 0, 0, $m, 1, $y); // This is GMT
        $display->tend = gmmktime(23, 59, 59, $m, $display->maxdays, $y); // GMT
        $startwday = gmdate('w', $display->tstart); // $display->tstart is already GMT, so don't use date(): messes with server's TZ
    } else {
        // no timezone info specified
        $display->tstart = mktime(0, 0, 0, $m, 1, $y);
        $display->tend = mktime(23, 59, 59, $m, $display->maxdays, $y);
        $startwday = date('w', $display->tstart); // $display->tstart not necessarily GMT, so use date()
    }

    // Align the starting weekday to fall in our display range
    if($startwday < $display->minwday) {
        $startwday += 7;
    }

    $display->startwday = $startwday;
    return $display;
}


function get_sessions($display, $groups, $users, $courses, $activefilters, &$events, &$sessionids) {
    global $timenow;

    // Get events from database
    $events = calendar_get_events(usertime($display->tstart), usertime($display->tend), $users, $groups, $courses);
    if (!empty($events)) {
        foreach($events as $eventid => $event) {
            if (empty($event->modulename)) {
                continue; // nothing to check
            }

            // Check that facetoface events match all filters
            $sessionid = (int)$event->uuid;
            if ('facetoface' == $event->modulename and $sessionid > 0) {
                $matchesallfilters = true;
                foreach ($activefilters as $fieldid => $fieldvalue) {
                    if (!matches_filter($fieldid, $fieldvalue, $sessionid)) {
                        // Different value => no match
                        $matchesallfilters = false;
                        break;
                    }
                }

                if ($matchesallfilters) {
                    $sessionids[] = $sessionid;
                }
                else {
                    unset($events[$eventid]);
                    continue; // move to next event
                }
            }

            // Group checks
            $cm = get_coursemodule_from_instance($event->modulename, $event->instance);
            if (!groups_course_module_visible($cm)) {
                unset($events[$eventid]);
            }
        }
    }
}

/*
 * Prints calendar view with all session that match current filters and all session that you have created with a grey background
 */
function show_month_detailed($baseparams, $display, $m, $y, $courses, $groups, $users, $courseid, $activefilters, $waitlistedsessions, $events) {
    global $USER, $SESSION, $CALENDARDAYS;
    global $timenow;

    // Extract information: events vs. time
    calendar_events_by_day($events, $m, $y, $eventsbyday, $durationbyday, $typesbyday, $courses);
    echo '<div id="calendarcontainer">';
    print_box_start('generalbox monthlycalendar');
    $text = '';
    echo '<div class="header">'.$text.'</div>';

    echo '<div class="controls">';
    echo top_controls($m, $y);
    echo '</div>';

    // Start calendar display
    echo '<table class="calendarmonth" summary="'.get_string('calendar:tablesummary', 'block_facetoface').'"><tr class="weekdays">'; // Begin table. First row: day names

    // Print out the names of the weekdays
    for($i = $display->minwday; $i <= $display->maxwday; ++$i) {
        // This uses the % operator to get the correct weekday no matter what shift we have
        // applied to the $display->minwday : $display->maxwday range from the default 0 : 6
        echo '<th scope="col">'.get_string($CALENDARDAYS[$i % 7], 'calendar').'</th>';
    }

    echo '</tr><tr>'; // End of day names; prepare for day numbers

    // For the table display. $week is the row; $dayweek is the column.
    $week = 1;
    $dayweek = $display->startwday;

    // Paddding (the first week may have blank days in the beginning)
    for($i = $display->minwday; $i < $display->startwday; ++$i) {
        echo '<td class="nottoday">&nbsp;</td>'."\n";
    }

    // Now display all the calendar
    for($day = 1; $day <= $display->maxdays; ++$day, ++$dayweek) {
        if($dayweek > $display->maxwday) {
            // We need to change week (table row)
            echo "</tr>\n<tr>";
            $dayweek = $display->minwday;
            ++$week;
        }

        // Reset vars
        $cell = '';
        $dayhref = calendar_get_link_href(CALENDAR_URL.'view.php?view=day&amp;course='.$courseid.'&amp;', $day, $m, $y);

        if(CALENDAR_WEEKEND & (1 << ($dayweek % 7))) {
            // Weekend. This is true no matter what the exact range is.
            $class = 'weekend';
        }
        else {
            // Normal working day.
            $class = '';
        }

        // Special visual fx if an event is defined
        if(isset($eventsbyday[$day])) {
            if(count($eventsbyday[$day]) == 1) {
                $title = get_string('oneevent', 'calendar');
            }
            else {
                $title = get_string('manyevents', 'calendar', count($eventsbyday[$day]));
            }
            $cell = '<div class="day"><a href="'.$dayhref.'" title="'.$title.'">'.$day.'</a></div>';
        }
        else {
            $cell = '<div class="day">'.$day.'</div>';
        }

        // Special visual fx if an event spans many days
        if(isset($typesbyday[$day]['durationglobal'])) {
            $class .= ' duration_global';
        }
        else if(isset($typesbyday[$day]['durationcourse'])) {
            $class .= ' duration_course';
        }
        else if(isset($typesbyday[$day]['durationgroup'])) {
            $class .= ' duration_group';
        }
        else if(isset($typesbyday[$day]['durationuser'])) {
            $class .= ' duration_user';
        }

        // Special visual fx for today
        $today = strftime('%d', $timenow);
        if($display->thismonth && $day == $today) {
            $class .= ' today';
        } else {
            $class .= ' nottoday';
        }

        // Just display it
        if(!empty($class)) {
            $class = ' class="'.trim($class).'"';
        }
        $cellid = sprintf('cell%d%02d%02d',$y,$m,$day);// outputs 'cellYYYYMMDD' string as intended
        echo "<td id=\"$cellid\" $class>$cell";

        if(isset($eventsbyday[$day])) {
            echo '<ul>';
            $i=1;
            foreach($eventsbyday[$day] as $eventindex) {
                if ($i < MAX_EVENTS_PER_DAY or count($eventsbyday[$day]) == MAX_EVENTS_PER_DAY) {
                    // If event has a class set then add it to the event <li> tag
                    $eventclass = '';
                    if (!empty($events[$eventindex]->class)) {
                        $eventclass = ' class="'.$events[$eventindex]->class.'"';
                    }

                    echo '<li'.$eventclass.'><a href="'.$dayhref.'#event_'.$events[$eventindex]->id.'">'.format_string($events[$eventindex]->name, true).'</a></li>';
                    $i++;
                }
                else {
                    echo '<li>';
                    print_string('xevents', 'block_facetoface', count($eventsbyday[$day]) - MAX_EVENTS_PER_DAY + 1);
                    echo '</li>';
                    break;
                }
            }
            echo '</ul>';
        }
        echo "</td>\n";
    }

    // Paddding (the last week may have blank days at the end)
    for($i = $dayweek; $i <= $display->maxwday; ++$i) {
        echo '<td class="nottoday">&nbsp;</td>';
    }
    echo "</tr>\n"; // Last row ends

    echo "</table>\n"; // Tabular display of days ends

    print_box_end();
    echo '</div>';

    // Advertising side-bar
    print_box_start('generalbox calendarsidebar');
    print_waitlisted_content($waitlistedsessions);
    print_box_end();
}

function top_controls($month, $year)
{
    global $currenttab;

    $content = '';

    $time = make_timestamp($year, $month, 1);
    $date = usergetdate($time);

    $data['m'] = $date['mon'];
    $data['y'] = $date['year'];

    list($prevmonth, $prevyear) = calendar_sub_month($data['m'], $data['y']);
    list($nextmonth, $nextyear) = calendar_add_month($data['m'], $data['y']);
    $prevdate = make_timestamp($prevyear, $prevmonth, 1);
    $nextdate = make_timestamp($nextyear, $nextmonth, 1);
    $content .= "\n".'<div class="calendar-controls">';
    $content .= '<table summary="" width="100%"><tr><td>';
    $content .= calendar_get_link_previous(userdate($prevdate, get_string('strftimemonthyear')), "calendar.php?tab=$currenttab&amp;", 1, $prevmonth, $prevyear);
    $content .= '</td><td align="center"><span class="hide"> | </span><span class="current">'.userdate($time, get_string('strftimemonthyear'))."</span>\n";
    $content .= '</td><td align="right"><span class="hide"> | </span>'.calendar_get_link_next(userdate($nextdate, get_string('strftimemonthyear')), "calendar.php?tab=$currenttab&amp;", 1, $nextmonth, $nextyear);
    $content .= "<span class=\"clearer\"><!-- --></span></td>";
    $content .= '</tr></table>';
    $content .= "</div>\n";
    return $content;
}

function customfield_chooser($field)
{
    global $activefilters;

    if (empty($field->isfilter)) {
        return false; // not a filter
    }

    $values = array();
    switch ($field->type) {
    case CUSTOMFIELD_TYPE_TEXT:
        if ($records = get_records('facetoface_session_data', 'fieldid', $field->id, 'data', 'id, data')) {
            foreach ($records as $record) {
                $values[$record->data] = $record->data;
            }
        }
        break;

    case CUSTOMFIELD_TYPE_SELECT:
    case CUSTOMFIELD_TYPE_MULTISELECT:
        $values = explode(CUSTOMFIELD_DELIMITTER, $field->possiblevalues);
        break;

    default:
        return false; // invalid type
    }

    // Build up dropdown list of values
    $options = array();
    if (!empty($values)) {
        foreach ($values as $value) {
            $v = clean_param(trim($value), PARAM_TEXT);
            if (!empty($v)) {
                $options[s($v)] = format_string($v);
            }
        }
    }

    $nothing = get_string('all');
    $nothingvalue = 'all';

    $fieldname = "field_$field->shortname";
    $currentvalue = $nothingvalue;
    if (!empty($activefilters[$field->id])) {
        $currentvalue = $activefilters[$field->id];
    }

    $dropdown = choose_from_menu($options, $fieldname, $currentvalue, $nothing, '', $nothingvalue, true);
    return format_string($field->name) . ': ' . $dropdown;
}

/**
 * Whether or not the given session matches the given filter value.
 */
function matches_filter($filterid, $filtervalue, $sessionid)
{
    global $customfields;

    if ('all' == $filtervalue) {
        return true; // Not actually a filter
    }

    // Warning: this get_field doesn't show up in the total number of DB queries, but it's called a lot!
    $sessionvalue = get_field('facetoface_session_data', 'data', 'fieldid', $filterid, 'sessionid', $sessionid);
    if (empty($sessionvalue)) {
        // No value at all => no match
        return false;
    }

    if (CUSTOMFIELD_TYPE_MULTISELECT == $customfields[$filterid]->type) {
        $values = explode(';', $sessionvalue);
        foreach ($values as $value) {
            if (trim($value) == $filtervalue) {
                return true;
            }
        }
        return false;
    }

    return $filtervalue == $sessionvalue;
}

function get_sessions_by_date($sessionids, $displayinfo)
{
    global $CFG;

    if (empty($sessionids)) {
        return array();
    }

    $ids = implode(', ', $sessionids);
    $timestart = usertime($displayinfo->tstart);
    $timeend = usertime($displayinfo->tend);
    $sessions = get_records_sql("SELECT d.id, s.id AS sessionid, f.id AS facetofaceid, f.name, s.datetimeknown, d.timestart, d.timefinish
                                   FROM {$CFG->prefix}facetoface f
                                   JOIN {$CFG->prefix}facetoface_sessions s ON f.id = s.facetoface
                                   JOIN {$CFG->prefix}facetoface_sessions_dates d ON d.sessionid = s.id
                                  WHERE s.id IN ($ids) AND d.timestart >= $timestart AND d.timestart <= $timeend
                               ORDER BY d.timestart");
    if (empty($sessions)) {
        return array();
    }
    return $sessions;
}

// Same as previous function by sorted by activity name and including waitlisted sessions
function get_sessions_by_course($sessionids, $displayinfo, $waitlistedsessions)
{
    global $CFG;

    if (empty($sessionids)) {
        return array();
    }

    $ids = implode(', ', $sessionids);

    // Add IDs of wait-listed sessions
    foreach ($waitlistedsessions as $session) {
        $ids .= ', ' . $session->id;
    }

    $timestart = usertime($displayinfo->tstart);
    $timeend = usertime($displayinfo->tend);
    $sessions = get_records_sql("SELECT d.id, s.id AS sessionid, f.id AS facetofaceid, f.name, s.datetimeknown, d.timestart, d.timefinish
                                   FROM {$CFG->prefix}facetoface f
                                   JOIN {$CFG->prefix}facetoface_sessions s ON f.id = s.facetoface
                                   JOIN {$CFG->prefix}facetoface_sessions_dates d ON d.sessionid = s.id
                                  WHERE s.id IN ($ids) AND ((d.timestart >= $timestart AND d.timestart <= $timeend) OR s.datetimeknown = 0)
                               ORDER BY f.name, d.timestart");
    if (empty($sessions)) {
        return array();
    }
    return $sessions;
}

function print_sessions($sessions, $tab)
{
    global $CFG;
    global $customfields;

    if (empty($sessions)) {
        print_string('nosessions', 'block_facetoface');
        return;
    }

    $currentday = 0;
    $currenttable = new_session_table();
    foreach ($sessions as $session) {
        $sessionlink = '<a href="'.$CFG->wwwroot.'/mod/facetoface/view.php?f='.$session->facetofaceid.'">'.format_string($session->name).'</a>';
        $sessionrow = array($sessionlink);

        $timestart = $session->timestart;
        $timefinish = $session->timefinish;

        $day = 0;
        if ($tab != 'c') {
            $day = strftime('%Y%m%d', $timestart);
        }

        if ($currentday < $day) {
            if ($currentday > 0) {
                print_table($currenttable);
            }
            $currenttable = new_session_table();

            print_heading(strftime(get_string('strftimedate'), $timestart), '', 3);
            $currentday = $day;
        }

        // Custom fields
        $customdata = get_records('facetoface_session_data', 'sessionid', $session->sessionid, '', 'fieldid, data');
        $nbcustomcolumns = 0;
        foreach ($customfields as $field) {
            if (empty($field->showinsummary)) {
                continue;
            }

            $nbcustomcolumns++;
            if (empty($customdata[$field->id])) {
                $sessionrow[] = '&nbsp;';
            }
            else {
                $sessionrow[] = format_string($customdata[$field->id]->data);
            }
        }

        $signuplink = '<a href="'.$CFG->wwwroot.'/mod/facetoface/signup.php?s='.$session->sessionid.'">'.get_string('moreinfo', 'facetoface').'</a>';

        if ($session->datetimeknown) {
            // Scheduled sessions
            if ('c' == $tab) {
                $sessionrow[] = userdate($timestart, get_string('strftimedate'));
            }
            $sessionrow[] = userdate($timestart, get_string('strftimetime'));
            $sessionrow[] = userdate($timefinish, get_string('strftimetime'));
        }
        elseif ('c' == $tab) {
            // Wait-listed sessions
            $sessionrow[] = get_string('wait-listed', 'facetoface');
            $sessionrow[] = '&nbsp;';
            $sessionrow[] = '&nbsp;';
        }
        else {
            // Not supposed to happen, wait-listed sessions are only for the "By Course" tab
            error_log('Warning: F2F Training Calendar found a wait-listed session in "By Date" tab');
            continue;
        }
        $sessionrow[] = $signuplink;
        $currenttable->data[] = $sessionrow;

        // First couple of columns should take most of the space
        $nbcolumns = count($sessionrow);
        $percent = 100.0 / ($nbcolumns - 1);
        $currenttable->size = array('*');
        for ($i=0; $i < $nbcustomcolumns; $i++) {
            $currenttable->size[] = "{$percent}%";
        }
        if ('c' == $tab) {
            $currenttable->size[] = '10em';
        }
        $currenttable->size[] = '6em';
        $currenttable->size[] = '6em';
        $currenttable->size[] = '6em';
    }
    print_table($currenttable);
}

function new_session_table()
{
    $table = new object();
    $table->width = '95%';
    return $table;
}

/**
 * Return a random notice matching the current criteria
 */
function get_notice($activefilters)
{
    global $CFG;
    global $customfields;

    // Get all notices
    if (!$allnotices = get_records('facetoface_notice', '', '', 'id', 'id')) {
        return false; // no matches
    }

    $filterjoins = '';
    $filterwhere = '';

    $filternb = 1;
    foreach ($activefilters as $fieldid => $fieldvalue) {
        if ('all' == $fieldvalue) {
            continue; // Not actually a filter
        }

        $joincondition = "d1.noticeid = n.id";
        if ($filternb > 1) {
            $joincondition = "d{$filternb}.noticeid = d". ($filternb - 1) .'.noticeid';
        }
        $filterjoins .= " JOIN {$CFG->prefix}facetoface_notice_data d$filternb ON $joincondition";

        $value = addslashes($fieldvalue);
        $whereclause = "d{$filternb}.data <> '$value'";
        if (CUSTOMFIELD_TYPE_MULTISELECT == $customfields[$fieldid]->type) {
            $whereclause = "d{$filternb}.data NOT LIKE '%{$value}%'";
        }
        $filterwhere .= " OR (d{$filternb}.fieldid = $fieldid AND $whereclause) ";
        $filternb++;
    }

    // Get notices to filter out
    $sql = "SELECT DISTINCT n.id
                  FROM {$CFG->prefix}facetoface_notice n
                  $filterjoins
                 WHERE 1 = 0
                 $filterwhere
              ORDER BY n.id";
    if (!$nonmatchingnotices = get_records_sql($sql)) {
        $nonmatchingnotices = array();
    }

    // Compute the difference
    $noticeids = array_diff(array_keys($allnotices), array_keys($nonmatchingnotices));
    if (empty($noticeids)) {
        return false;
    }

    // Select a notice at random
    shuffle($noticeids);
    $randomnoticeid = reset($noticeids);
    return get_field('facetoface_notice', 'text', 'id', $randomnoticeid);
}

function get_matching_waitlisted_sessions($activefilters)
{
    global $CFG;
    global $customfields;

    $filterjoins = '';
    $filterwhere = '';

    $filternb = 1;
    foreach ($activefilters as $fieldid => $fieldvalue) {
        if ('all' == $fieldvalue) {
            continue; // Not actually a filter
        }

        $joincondition = "d1.sessionid = s.id";
        if ($filternb > 1) {
            $joincondition = "d{$filternb}.sessionid = d". ($filternb - 1) .'.sessionid';
        }
        $filterjoins .= " JOIN {$CFG->prefix}facetoface_session_data d$filternb ON $joincondition";

        $value = addslashes($fieldvalue);
        $whereclause = "d{$filternb}.data = '$value'";
        if (CUSTOMFIELD_TYPE_MULTISELECT == $customfields[$fieldid]->type) {
            $whereclause = "d{$filternb}.data LIKE '%{$value}%'";
        }
        $filterwhere .= " AND d{$filternb}.fieldid = $fieldid AND $whereclause ";
        $filternb++;
    }

    // Get all waitlisted sessions
    $sessions = get_records_sql("SELECT s.id, s.facetoface, f.name
                                   FROM {$CFG->prefix}facetoface f
                                   JOIN {$CFG->prefix}facetoface_sessions s ON f.id = s.facetoface
                                   $filterjoins
                                  WHERE f.showoncalendar = 1 AND s.datetimeknown = 0
                                  $filterwhere");
    if (empty($sessions)) {
        return array();
    }

    return $sessions;
}

function print_waitlisted_content($waitlistedsessions)
{
    global $CFG;

    if (empty($waitlistedsessions)) {
        print_string('nowaitlistedsessions', 'block_facetoface');;
        return;
    }

    $html = '';

    // Randomly select sessions to show
    if (count($waitlistedsessions) > MAX_WAITLISTED_SESSIONS) {
        $html .= get_string('toomanywaitlistedsessions', 'block_facetoface', MAX_WAITLISTED_SESSIONS);

        shuffle($waitlistedsessions);
        $waitlistedsessions = array_slice($waitlistedsessions, 0, MAX_WAITLISTED_SESSIONS);
    }
    else {
        $html .= get_string('showingallwaitlistedsessions', 'block_facetoface');
    }

    // Show the selected sessions
    foreach ($waitlistedsessions as $session) {
        $html .= '<hr/>';

        $html .= '<div>';
        $sessionurl = "$CFG->wwwroot/mod/facetoface/signup.php?s=$session->id";
        $html .= '<a href="'.$sessionurl.'">'.format_string($session->name).'</a>';
        $html .= '</div>';

        // Getting only the description of the sessions to display in order to save some memory
        $description = get_field('facetoface', 'description', 'id', $session->facetoface);
        if (!empty($description)) {
            $description = format_text($description, FORMAT_HTML);
            $html .= "<div>$description</div>";
        }
    }

    print $html;
}

function print_tooltips($sessions)
{
    print '<script type="text/javascript">'."\n";
    print "//<![CDATA[\n";
    print 'YAHOO.namespace("calendar.container");'."\n";

    $currentday = 0;
    $sessionlist = array();
    foreach ($sessions as $session) {
        $timestart = $session->timestart;
        $day = strftime('%Y%m%d', $timestart);

        if ($currentday < $day) {
            if ($currentday > 0) {
                $html = tooltip_contents($sessionlist);
                print "YAHOO.calendar.container.tt$currentday = new YAHOO.widget.Tooltip('tt$currentday', { context:'cell$currentday', text:'$html' });\n";
            }

            $sessionlist = array();
            $currentday = $day;
        }
        $sessionlist[] = format_string($session->name);
    }

    // Print last tooltip
    $html = tooltip_contents($sessionlist);
    print "YAHOO.calendar.container.tt$currentday = new YAHOO.widget.Tooltip('tt$currentday', { context:'cell$currentday', text:'$html' });\n";

    print "//]]>\n";
    print '</script>';
}

function tooltip_contents($sessionlist)
{
    $html = '<p>'.get_string('tooltipheading', 'block_facetoface');
    $html .= '<ul>';
    foreach ($sessionlist as $session) {
        $sessionname = str_replace('"', '\"', $session);
        $html .= "<li>$sessionname</li>";
    }
    $html .= '</ul></p>';
    return $html;
}

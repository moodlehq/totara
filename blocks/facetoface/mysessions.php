<?php

// Displays sessions for which the current user is a "teacher" (can see attendees' list)
// as well as the ones where the user is signed up (i.e. a "student")

require_once '../../config.php';

require_login();

$timenow = time();
$timelater = $timenow + 3 * WEEKSECS;

$startyear  = optional_param('startyear',  strftime('%Y', $timenow), PARAM_INT);
$startmonth = optional_param('startmonth', strftime('%m', $timenow), PARAM_INT);
$startday   = optional_param('startday',   strftime('%d', $timenow), PARAM_INT);
$endyear    = optional_param('endyear',    strftime('%Y', $timelater), PARAM_INT);
$endmonth   = optional_param('endmonth',   strftime('%m', $timelater), PARAM_INT);
$endday     = optional_param('endday',     strftime('%d', $timelater), PARAM_INT);

$sortby = optional_param('sortby', 'timestart', PARAM_ALPHA); // column to sort by
$action = optional_param('action',          '', PARAM_ALPHA); // one of: '', export
$format = optional_param('format',       'ods', PARAM_ALPHA); // one of: ods, xls

$startdate = make_timestamp($startyear, $startmonth, $startday);
$enddate = make_timestamp($endyear, $endmonth, $endday);

$urlparams = "startyear=$startyear&amp;startmonth=$startmonth&amp;startday=$startday&amp;";
$urlparams .= "endyear=$endyear&amp;endmonth=$endmonth&amp;endday=$endday";
$sortbylink = "mysessions.php?{$urlparams}&amp;sortby=";

// Get all Face-to-face session dates from the DB
$records = get_records_sql("SELECT d.id, cm.id AS cmid, c.id AS courseid, c.fullname AS coursename,
                                   f.name, f.id as facetofaceid, s.id as sessionid, s.location,
                                   d.timestart, d.timefinish, su.nbbookings
                              FROM {$CFG->prefix}facetoface_sessions_dates d
                              JOIN {$CFG->prefix}facetoface_sessions s ON s.id = d.sessionid
                              JOIN {$CFG->prefix}facetoface f ON f.id = s.facetoface
                   LEFT OUTER JOIN (SELECT sessionid, count(sessionid) AS nbbookings
                                      FROM {$CFG->prefix}facetoface_submissions su
                                     WHERE su.timecancelled = 0
                                  GROUP BY sessionid) su ON su.sessionid = d.sessionid
                              JOIN {$CFG->prefix}course c ON f.course = c.id

                              JOIN {$CFG->prefix}course_modules cm ON cm.course = f.course
                                   AND cm.instance = f.id
                              JOIN {$CFG->prefix}modules m ON m.id = cm.module

                             WHERE d.timestart >= $startdate AND d.timefinish <= $enddate
                                   AND m.name = 'facetoface'
                          ORDER BY $sortby");

// Only keep the sessions for which this user can see attendees
$dates = array();
if ($records) {
    $capability = 'mod/facetoface:viewattendees';

    // Check the system context first
    $contextsystem = get_context_instance(CONTEXT_SYSTEM);
    if (has_capability($capability, $contextsystem)) {
        $dates = $records;
    }
    else {
        foreach($records as $record) {
            // Check at course level first
            $contextcourse = get_context_instance(CONTEXT_COURSE, $record->courseid);
            if (has_capability($capability, $contextcourse)) {
                $dates[] = $record;
                continue;
            }

            // Check at module level if the first check failed
            $contextmodule = get_context_instance(CONTEXT_MODULE, $record->cmid);
            if (has_capability($capability, $contextmodule)) {
                $dates[] = $record;
            }
        }
    }
}
$nbdates = count($dates);

/**
 * Export the given session dates into an ODF/Excel spreadsheet
 */
function export_spreadsheet($dates, $format, $includebookings) {
    global $CFG;

    $timenow = time();
    $timeformat = str_replace(' ', '_', get_string('strftimedate'));
    $downloadfilename = clean_filename('facetoface_'.userdate($timenow, $timeformat));

    if ('ods' === $format) {
        // OpenDocument format (ISO/IEC 26300)
        require_once($CFG->dirroot.'/lib/odslib.class.php');
        $downloadfilename .= '.ods';
        $workbook = new MoodleODSWorkbook('-');
    }
    else {
        // Excel format
        require_once($CFG->dirroot.'/lib/excellib.class.php');
        $downloadfilename .= '.xls';
        $workbook = new MoodleExcelWorkbook('-');
    }

    $workbook->send($downloadfilename);
    $worksheet =& $workbook->add_worksheet(get_string('sessionlist', 'block_facetoface'));

    // Heading (first row)
    $worksheet->write_string(0, 0, get_string('course'));
    $worksheet->write_string(0, 1, get_string('name'));
    $worksheet->write_string(0, 2, get_string('location'));
    $worksheet->write_string(0, 3, get_string('timestart', 'facetoface'));
    $worksheet->write_string(0, 4, get_string('timefinish', 'facetoface'));
    if ($includebookings) {
        $worksheet->write_string(0, 5, get_string('nbbookings', 'block_facetoface'));
    }

    if (!empty($dates)) {
        $i = 0;
        foreach ($dates as $date) {
            $i++;

            $worksheet->write_string($i, 0, $date->coursename);
            $worksheet->write_string($i, 1, $date->name);
            $worksheet->write_string($i, 2, $date->location);
            if ('ods' == $format) {
                $worksheet->write_date($i, 3, $date->timestart);
                $worksheet->write_date($i, 4, $date->timefinish);
            }
            else {
                $worksheet->write_string($i, 3, trim(userdate($date->timestart, get_string('strftimedatetime'))));
                $worksheet->write_string($i, 4, trim(userdate($date->timefinish, get_string('strftimedatetime'))));
            }
            if ($includebookings) {
                $worksheet->write_number($i, 5, isset($date->nbbookings) ? $date->nbbookings : 0);
            }
        }
    }

    $workbook->close();
}

/**
 * Print the session dates in a nicely formatted table.
 */
function print_dates($dates, $includebookings) {
    global $sortbylink, $CFG;

    $courselink = $CFG->wwwroot.'/course/view.php?id=';
    $facetofacelink = $CFG->wwwroot.'/mod/facetoface/view.php?f=';
    $attendeelink = $CFG->wwwroot.'/mod/facetoface/attendees.php?s=';

    print '<table border="1" cellpadding="0" summary="'.get_string('sessiondatestable', 'block_facetoface').'"><tr>';
    print '<th><a href="'.$sortbylink.'coursename">'.get_string('course').'</a></th>';
    print '<th><a href="'.$sortbylink.'name">'.get_string('name').'</a></th>';
    print '<th><a href="'.$sortbylink.'location">'.get_string('location').'</a></th>';
    print '<th><a href="'.$sortbylink.'timestart">'.get_string('date').'</a></th>';
    print '<th>'.get_string('time').'</th>';
    if ($includebookings) {
        print '<th><a href="'.$sortbylink.'nbbookings">'.get_string('nbbookings', 'block_facetoface').'</a></th>';
    }
    print '</tr>';

    $even = false; // used to colour rows
    foreach ($dates as $date) {
        if ($even) {
            print '<tr style="background-color: #CCCCCC">';
        }
        else {
            print '<tr>';
        }
        $even = !$even;
        print '<td><a href="'.$courselink.$date->courseid.'">'.format_string($date->coursename).'</a></td>';
        print '<td><a href="'.$facetofacelink.$date->facetofaceid.'">'.format_string($date->name).'</a></td>';
        print '<td>'.format_string($date->location).'</td>';
        if (userdate($date->timestart, '%d %B %Y') != userdate($date->timefinish, '%d %B %Y')) {
            print '<td><font color="#FF0000">'.userdate($date->timestart, '%d %B %Y').' - '.userdate($date->timefinish, '%d %B %Y').'</font></td>';
        }
        else {
            print '<td>'.userdate($date->timestart, '%d %B %Y').'</td>';
        }
        print '<td>'.userdate($date->timestart, '%I:%M %p').' - '.userdate($date->timefinish, '%I:%M %p').'</td>';
        if ($includebookings) {
            print '<td><a href="'.$attendeelink.$date->sessionid.'">'.(isset($date->nbbookings)? format_string($date->nbbookings) : 0).'</a></td>';
        }
        print '</tr>';
    }
    print '</table>';
}

// Process actions if any
if ('export' == $action) {
    export_spreadsheet($dates, $format, true);
    exit;
}


// Get all Face-to-face signups from the DB
$signups = get_records_sql("SELECT d.id, c.id as courseid, c.fullname AS coursename, f.name,
                                   f.id as facetofaceid, s.id as sessionid, s.location,
                                   d.timestart, d.timefinish
                              FROM {$CFG->prefix}facetoface_sessions_dates d
                              JOIN {$CFG->prefix}facetoface_sessions s ON s.id = d.sessionid
                              JOIN {$CFG->prefix}facetoface f ON f.id = s.facetoface
                              JOIN {$CFG->prefix}facetoface_submissions su ON su.sessionid = s.id
                              JOIN {$CFG->prefix}course c ON f.course = c.id
                             WHERE d.timestart >= $startdate AND d.timefinish <= $enddate AND
                                   su.userid = $USER->id AND su.timecancelled = 0
                          ORDER BY $sortby");
$nbsignups = 0;
if ($signups and count($signups) > 0) {
    $nbsignups = count($signups);
}

$pagetitle = format_string(get_string('listsessiondates', 'block_facetoface'));
$navlinks[] = array('name' => $pagetitle, 'link' => '', 'type' => 'activityinstance');
$navigation = build_navigation($navlinks);
print_header_simple($pagetitle, '', $navigation);

// Date range form
print '<h2>'.get_string('daterange', 'block_facetoface').'</h2>';
print '<form method="get" action=""><p>';
print_date_selector('startday', 'startmonth', 'startyear', $startdate);
print ' to ';
print_date_selector('endday', 'endmonth', 'endyear', $enddate);
print ' <input type="submit" value="'.get_string('apply', 'block_facetoface').'" /></p></form>';

// Show all session dates
print '<h2>'.get_string('sessiondatesviewattendees', 'block_facetoface').'</h2>';
if ($nbdates > 0) {
    print_dates($dates, true);

    // Export form
    print '<h3>'.get_string('exportsessiondates', 'block_facetoface').'</h3>';
    print '<form method="post" action=""><p>';
    print '<input type="hidden" name="startyear" value="'.$startyear.'" />';
    print '<input type="hidden" name="startmonth" value="'.$startmonth.'" />';
    print '<input type="hidden" name="startday" value="'.$startday.'" />';
    print '<input type="hidden" name="endyear" value="'.$endyear.'" />';
    print '<input type="hidden" name="endmonth" value="'.$endmonth.'" />';
    print '<input type="hidden" name="endday" value="'.$endday.'" />';
    print '<input type="hidden" name="sortby" value="'.$sortby.'" />';
    print '<input type="hidden" name="action" value="export" />';

    print get_string('format', 'facetoface').':&nbsp;';
    print '<select name="format">';
    print '<option value="excel" selected="selected">'.get_string('excelformat', 'facetoface').'</option>';
    print '<option value="ods">'.get_string('odsformat', 'facetoface').'</option>';
    print '</select>';

    print ' <input type="submit" value="'.get_string('exporttofile', 'facetoface').'" /></p></form>';
}
else {
    print '<p>'.get_string('sessiondatesviewattendeeszero', 'block_facetoface').'</p>';
}

// Show sign-ups
print '<h2>'.get_string('signedupin', 'block_facetoface').'</h2>';
if ($nbsignups > 0) {
    print_dates($signups, false);
}
else{
    print '<p>'.get_string('signedupinzero', 'block_facetoface').'</p>';
}

print_footer();

?>

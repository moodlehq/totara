<?php

require_once '../../config.php';
require_once 'lib.php';

$id = optional_param('id', 0, PARAM_INT); // Course Module ID
$f = optional_param('f', 0, PARAM_INT); // facetoface ID
$location = optional_param('location', '', PARAM_TEXT); // location
$download = optional_param('download', '', PARAM_ALPHA); // download attendance

if ($id) {
    if (!$cm = get_record('course_modules', 'id', $id)) {
        print_error('error:incorrectcoursemoduleid', 'facetoface');
    }
    if (!$course = get_record('course', 'id', $cm->course)) {
        print_error('error:coursemisconfigured', 'facetoface');
    }
    if (!$facetoface = get_record('facetoface', 'id', $cm->instance)) {
        print_error('error:incorrectcoursemodule', 'facetoface');
    }
}
elseif ($f) {
    if (!$facetoface = get_record('facetoface', 'id', $f)) {
        print_error('error:incorrectfacetofaceid', 'facetoface');
    }
    if (!$course = get_record('course', 'id', $facetoface->course)) {
        print_error('error:coursemisconfigured', 'facetoface');
    }
    if (!$cm = get_coursemodule_from_instance('facetoface', $facetoface->id, $course->id)) {
        print_error('error:incorrectcoursemoduleid', 'facetoface');
    }
}
else {
    print_error('error:mustspecifycoursemodulefacetoface', 'facetoface');
}

$context = get_context_instance(CONTEXT_MODULE, $cm->id);

if (!empty($download)) {
    require_capability('mod/facetoface:viewattendees', $context);
    facetoface_download_attendance($facetoface->name, $facetoface->id, $location, $download);
    exit();
}

require_course_login($course);
require_capability('mod/facetoface:view', $context);

add_to_log($course->id, 'facetoface', 'view', "view.php?id=$cm->id", $facetoface->id, $cm->id);

$pagetitle = format_string($facetoface->name);
$navlinks[] = array('name' => get_string('modulenameplural', 'facetoface'), 'link' => "index.php?id=$course->id", 'type' => 'title');
$navlinks[] = array('name' => $pagetitle, 'link' => '', 'type' => 'activityinstance');
$navigation = build_navigation($navlinks);
print_header_simple($pagetitle, '', $navigation, '', '', true,
                    update_module_button($cm->id, $course->id, get_string('modulename', 'facetoface')), navmenu($course, $cm));

if (empty($cm->visible) and !has_capability('mod/facetoface:viewemptyactivities', $context)) {
    notice(get_string('activityiscurrentlyhidden'));
}

print_box_start();
print_heading(get_string('allsessionsin', 'facetoface', $facetoface->name), "center");

if ($facetoface->description) {
    print_box_start('generalbox','description');
    echo format_text($facetoface->description, FORMAT_HTML);
    print_box_end();
}

$locations = get_locations($facetoface->id);
if (count($locations) > 2) {
    echo '<form method="get" action="view.php">';
    echo '<div><input type="hidden" name="f" value="'.$facetoface->id.'"/>';
    choose_from_menu($locations, 'location', $location, '');
    echo '<input type="submit" value="'.get_string('showbylocation','facetoface').'"/>';
    echo '</div></form>';
}

print_session_list($course->id, $facetoface->id, $location);

if (has_capability('mod/facetoface:viewattendees', $context)) {
    print_heading(get_string('exportattendance', 'facetoface'), "center");
    echo '<form method="get" action="view.php">';
    echo '<div><input type="hidden" name="f" value="'.$facetoface->id.'"/>';
    echo get_string('format', 'facetoface') . '&nbsp;';
    $formats = array('excel' => get_string('excelformat', 'facetoface'),
                     'ods' => get_string('odsformat', 'facetoface'));
    choose_from_menu($formats, 'download', 'excel', '');
    echo '<input type="submit" value="'.get_string('exporttofile','facetoface').'"/>';
    echo '</div></form>';
}

print_box_end();
print_footer($course);

function print_session_list($courseid, $facetofaceid, $location)
{
    global $USER;
    global $CFG;

    $timenow = time();

    $context = get_context_instance(CONTEXT_COURSE, $courseid, $USER->id);
    $viewattendees = has_capability('mod/facetoface:viewattendees', $context);
    $editsessions = has_capability('mod/facetoface:editsessions', $context);

    $bookedsession = null;
    if ($submissions = facetoface_get_user_submissions($facetofaceid, $USER->id)) {
        $submission = array_shift($submissions);
        $bookedsession = $submission;
    }

    $customfields = facetoface_get_session_customfields();

    // Table headers
    $tableheader = array();
    foreach ($customfields as $field) {
        if (!empty($field->showinsummary)) {
            $tableheader[] = format_string($field->name);
        }
    }
    $tableheader[] = get_string('date', 'facetoface');
    $tableheader[] = get_string('time', 'facetoface');
    if ($viewattendees) {
        $tableheader[] = get_string('capacity', 'facetoface');
    }
    else {
        $tableheader[] = get_string('seatsavailable', 'facetoface');
    }
    $tableheader[] = get_string('status', 'facetoface');
    $tableheader[] = get_string('options', 'facetoface');

    $upcomingdata = array();
    $upcomingtbddata = array();
    $previousdata = array();
    $upcomingrowclass = array();
    $upcomingtbdrowclass = array();
    $previousrowclass = array();

    if ($sessions = facetoface_get_sessions($facetofaceid, $location) ) {
        foreach($sessions as $session) {
            $sessionrow = array();

            $sessionstarted = false;
            $sessionfull = false;
            $sessionwaitlisted = false;
            $isbookedsession = false;

            // Custom fields
            $customdata = get_records('facetoface_session_data', 'sessionid', $session->id, '', 'fieldid, data');
            foreach ($customfields as $field) {
                if (empty($field->showinsummary)) {
                    continue;
                }

                if (empty($customdata[$field->id])) {
                    $sessionrow[] = '&nbsp;';
                }
                else {
                    $sessionrow[] = format_string($customdata[$field->id]->data);
                }
            }

            // Dates/times
            $allsessiondates = '';
            $allsessiontimes = '';
            if ($session->datetimeknown) {
                foreach ($session->sessiondates as $date) {
                    if (!empty($allsessiondates)) {
                        $allsessiondates .= '<br/>';
                    }
                    $allsessiondates .= userdate($date->timestart, get_string('strftimedate'));
                    if (!empty($allsessiontimes)) {
                        $allsessiontimes .= '<br/>';
                    }
                    $allsessiontimes .= userdate($date->timestart, get_string('strftimetime')).
                        ' - '.userdate($date->timefinish, get_string('strftimetime'));
                }
            }
            else {
                $allsessiondates = get_string('wait-listed', 'facetoface');
                $allsessiontimes = get_string('wait-listed', 'facetoface');
                $sessionwaitlisted = true;
            }
            $sessionrow[] = $allsessiondates;
            $sessionrow[] = $allsessiontimes;

            // Capacity
            $signupcount = facetoface_get_num_attendees($session->id);
            $stats = $session->capacity - $signupcount;
            if ($viewattendees){
                $stats = $signupcount.' / '.$session->capacity;
            }
            else {
                $stats = max(0, $stats);
            }
            $sessionrow[] = $stats;

            // Status
            $status  = get_string('bookingopen', 'facetoface');
            if ($session->datetimeknown && facetoface_has_session_started($session, $timenow) && facetoface_is_session_in_progress($session, $timenow)) {
                $status = get_string('sessioninprogress', 'facetoface');
                $sessionstarted = true;
            }
            elseif ($session->datetimeknown && facetoface_has_session_started($session, $timenow)) {
                $status = get_string('sessionover', 'facetoface');
                $sessionstarted = true;
            }
            elseif ($bookedsession && $session->id == $bookedsession->sessionid) {
                $signupstatus = facetoface_get_status($bookedsession->statuscode);

                $status = get_string('status_'.$signupstatus, 'facetoface');
                $isbookedsession = true;
            }
            elseif ($signupcount >= $session->capacity) {
                $status = get_string('bookingfull', 'facetoface');
                $sessionfull = true;
            }
/*
            // Get status history (temp hack)
            $tmp_signup = get_record('facetoface_signups', 'sessionid', $session->id, 'userid', $USER->id);
            if ($tmp_signup) {
                $tmp_status = get_records('facetoface_signups_status', 'signupid', $tmp_signup->id);

                $status .= '<ul>';
                foreach (array_slice($tmp_status, 0, 5) as $s) {
                    $status .= '<li style="text-align: left;">'.get_string('status_'.facetoface_get_status($s->statuscode), 'facetoface').'</li>';
                }
                $status .= '</ul>';
            }
 */
            $sessionrow[] = $status;

            // Options
            $options = '';
            if ($editsessions) {
                $options .= ' <a href="sessions.php?s='.$session->id.'" title="'.get_string('editsession', 'facetoface').'">'
                    . '<img src="'.$CFG->pixpath.'/t/edit.gif" class="iconsmall" alt="'.get_string('edit', 'facetoface').'" /></a> '
                    . '<a href="sessions.php?s='.$session->id.'&amp;c=1" title="'.get_string('copysession', 'facetoface').'">'
                    . '<img src="'.$CFG->pixpath.'/t/copy.gif" class="iconsmall" alt="'.get_string('copy', 'facetoface').'" /></a> '
                    . '<a href="sessions.php?s='.$session->id.'&amp;d=1" title="'.get_string('deletesession', 'facetoface').'">'
                    . '<img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.get_string('delete').'" /></a><br />';
            }
            if ($viewattendees){
                $options .= '<a href="attendees.php?s='.$session->id.'&amp;backtoallsessions='.$facetofaceid.'" title="'.get_string('seeattendees', 'facetoface').'">'.get_string('attendees', 'facetoface').'</a><br />';
            }
            if ($isbookedsession) {
                $options .= '<a href="signup.php?s='.$session->id.'&amp;backtoallsessions='.$facetofaceid.'" title="'.get_string('moreinfo', 'facetoface').'">'.get_string('moreinfo', 'facetoface').'</a><br />';

                $options .= '<a href="cancelsignup.php?s='.$session->id.'&amp;backtoallsessions='.$facetofaceid.'" title="'.get_string('cancelbooking', 'facetoface').'">'.get_string('cancelbooking', 'facetoface').'</a>';
            }
            elseif (!$sessionstarted and !$bookedsession) {
                $options .= '<a href="signup.php?s='.$session->id.'&amp;backtoallsessions='.$facetofaceid.'">'.get_string('signup', 'facetoface').'</a>';
            }
            if (empty($options)) {
                $options = get_string('none', 'facetoface');
            }
            $sessionrow[] = $options;

            // Set the CSS class for the row
            $rowclass = '';
            if ($sessionstarted) {
                $rowclass = 'dimmed_text';
            }
            elseif ($isbookedsession) {
                $rowclass = 'highlight';
            }
            elseif ($sessionfull) {
                $rowclass = 'dimmed_text';
            }

            // Put the row in the right table
            if ($sessionstarted) {
                $previousrowclass[] = $rowclass;
                $previousdata[] = $sessionrow;
            }
            elseif ($sessionwaitlisted) {
                $upcomingtbdrowclass[] = $rowclass;
                $upcomingtbddata[] = $sessionrow;
            }
            else { // Normal scheduled session
                $upcomingrowclass[] = $rowclass;
                $upcomingdata[] = $sessionrow;
            }
        }
    }

    // Upcoming sessions
    print_heading(get_string('upcomingsessions', 'facetoface'));
    if (empty($upcomingdata) and empty($upcomingtbddata)) {
        print_string('noupcoming', 'facetoface');
    }
    else {
        $upcomingtable = new object();
        $upcomingtable->summary = get_string('upcomingsessionslist', 'facetoface');
        $upcomingtable->head = $tableheader;
        $upcomingtable->rowclass = array_merge($upcomingrowclass, $upcomingtbdrowclass);
        $upcomingtable->width = '100%';
        $upcomingtable->data = array_merge($upcomingdata, $upcomingtbddata);
        print_table($upcomingtable);
    }

    if ($editsessions) {
        echo '<p><a href="sessions.php?f='.$facetofaceid.'">'.get_string('addsession', 'facetoface').'</a></p>';
    }

    // Previous sessions
    if (!empty($previousdata)) {
        print_heading(get_string('previoussessions', 'facetoface'));
        $previoustable = new object();
        $previoustable->summary = get_string('previoussessionslist', 'facetoface');
        $previoustable->head = $tableheader;
        $previoustable->rowclass = $previousrowclass;
        $previoustable->width = '100%';
        $previoustable->data = $previousdata;
        print_table($previoustable);
    }
}

/**
 * Get facetoface locations
 *
 * @param   interger    $facetofaceid
 * @return  array
 */
function get_locations($facetofaceid)
{
    global $CFG;

    $locationfieldid = get_field('facetoface_session_field', 'id', 'shortname', 'location');
    if (!$locationfieldid) {
        return array();
    }

    $sql = "SELECT DISTINCT d.data AS location
              FROM {$CFG->prefix}facetoface f
              JOIN {$CFG->prefix}facetoface_sessions s ON s.facetoface = f.id
              JOIN {$CFG->prefix}facetoface_session_data d ON d.sessionid = s.id
             WHERE f.id = $facetofaceid AND d.fieldid = $locationfieldid";

    if ($records = get_records_sql($sql)) {
        $locationmenu[''] = get_string('alllocations', 'facetoface');

        $i=1;
        foreach ($records as $record) {
            $locationmenu[$record->location] = $record->location;
            $i++;
        }

        return $locationmenu;
    }

    return array();
}

<?php

require_once('../../mod/facetoface/lib.php');
define('TRAINER_CACHE_TIMEOUT',15); // in minutes

/**
 * Print the session dates in a nicely formatted table.
 */
function print_dates($dates, $includebookings, $includegrades=false, $includestatus=false, $includecourseid=false, $includetrainers=false) {
    global $CFG, $USER;

    $courselink = $CFG->wwwroot.'/course/view.php?id=';
    $facetofacelink = $CFG->wwwroot.'/mod/facetoface/view.php?f=';
    $attendeelink = $CFG->wwwroot.'/mod/facetoface/attendees.php?s=';
    $bookinghistorylink = $CFG->wwwroot.'/blocks/facetoface/bookinghistory.php?session=';

    print '<table border="1" cellpadding="5" summary="'.get_string('sessiondatestable', 'block_facetoface').'"><tr>';

    // include the course id in the display
    if ($includecourseid) {
        print '<th>'.get_string('idnumbercourse').'</th>';
    }

    print '<th>'.get_string('course').'</th>';
    print '<th>'.get_string('name').'</th>';
    print '<th>'.get_string('location').'</th>';
    print '<th>'.get_string('date','block_facetoface').'</th>';
    print '<th>'.get_string('time', 'block_facetoface').'</th>';
    if ($includebookings) {
        print '<th>'.get_string('nbbookings', 'block_facetoface').'</th>';
    }

    // include the grades/status in the display
    if ($includegrades || $includestatus) {
        print '<th>'.get_string('status').'</th>';
    }

    print '</tr>';
    $even = false; // used to colour rows
    foreach ($dates as $date) {

        // include the grades in the display
        if ($includegrades) {
            $grade = facetoface_get_grade($date->userid, $date->courseid, $date->facetofaceid);
        }

        if ($even) {
            print '<tr style="background-color: #CCCCCC" valign="top">';
        }
        else {
            print '<tr valign="top">';
        }
        $even = !$even;
        if ($includecourseid) {
            print '<td>'.$date->cidnumber.'</td>';
        }
        print '<td><a href="'.$courselink.$date->courseid.'">'.format_string($date->coursename).'</a></td>';

        print '<td><a href="'.$facetofacelink.$date->facetofaceid.'">'.format_string($date->name).'</a></td>';
        print '<td>'.format_string($date->location).'</td>';
        print '<td>';
        foreach ($date->alldates as $sessiondate) {
            print userdate($sessiondate->timestart, '%d %B %Y').'<br />';
        }
        print '</td>';
        print '<td>';
        foreach ($date->alldates as $sessiondate) {
            print userdate($sessiondate->timestart, '%I:%M %p').' - '.userdate($sessiondate->timefinish, '%I:%M %p').'<br />';
        }
        print '</td>';
        if ($includebookings) {
            print '<td><a href="'.$attendeelink.$date->sessionid.'">'.(isset($date->nbbookings)? format_string($date->nbbookings) : 0).'</a></td>';
        }

        // include the grades/status in the display
        foreach (array($includegrades, $includestatus) as $col) {
            if ($col) {
                print '<td><a href="'.$bookinghistorylink.$date->sessionid.'&amp;userid='.$date->userid.'">'.ucfirst(facetoface_get_status($date->status)).'</a></td>';
            }
        }

        print '</tr>';
    }
    print '</table>';
}

/**
 * Group the Session dates together instead of having separate sessions
 * when it spans multiple days
 * */
function group_session_dates($sessions) {

    $retarray = array();

    foreach ($sessions as $session) {
        if (!array_key_exists($session->sessionid,$retarray)) {
            $alldates = array();

            // clone the session object so we don't override the existing object
            $newsession = clone($session);
            $newsession->timestart = $newsession->timestart;
            $newsession->timefinish = $newsession->timefinish;
            $retarray[$newsession->sessionid] = $newsession;
        } else {
            if ($session->timestart < $retarray[$session->sessionid]->timestart) {
                $retarray[$session->sessionid]->timestart = $session->timestart;
            }

            if ($session->timefinish > $retarray[$session->sessionid]->timefinish) {
                $retarray[$session->sessionid]->timefinish = $session->timefinish;
            }
        }

        // ensure that we have the correct status (enrolled, cancelled) for the submission
        if (isset($session->status) and $session->status == 0) {
           $retarray[$session->sessionid]->status = $session->status;
        }

        $alldates[$session->id]->timestart = $session->timestart;
        $alldates[$session->id]->timefinish = $session->timefinish;
        $retarray[$session->sessionid]->alldates = $alldates;
    }
    return $retarray;
}

/**
 * Separate out the dates from $sessions that finished before the current time
 * */
function past_session_dates($sessions) {

    $retarray = array();
    $timenow = time();

    if (!empty($sessions)) {
        foreach ($sessions as $session) {
            // check if the finish time is before the current time
            if ($session->timefinish < $timenow) {
                $retarray[$session->sessionid] = clone($session);
            }
        }
    }
    return $retarray;
}

/**
 * Separate out the dates from $sessions that finish after the current time
 * */
function future_session_dates($sessions) {

    $retarray = array();
    $timenow = time();

    if (!empty($sessions)) {
        foreach ($sessions as $session) {
            // check if the finish time is after the current time
            if ($session->timefinish >= $timenow) {
                $retarray[$session->sessionid] = clone($session);
            }
        }
    }
    return $retarray;
}

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
 *  Return a list of users who match the given search
 *  Fields searched are:
 *  - username,
 *  - firstname, lastname as fullname,
 *  - email
 */
function get_users_search($search) {
    global $CFG;

    //to allow case-insensitive search for postgesql
    if ($CFG->dbfamily == 'postgres') {
        $LIKE = 'ILIKE';
    } else {
        $LIKE = 'LIKE';
    }

    $usernamesearch = '';
    $emailsearch = '';
    $fullnamesearch = '';
    $firstnamesearch = '';
    $lastnamesearch = '';

    $searchvalues = split(' ',trim($search));
    $sort='firstname, lastname, username, email ASC';

    foreach ($searchvalues as $searchterm) {

        if ($usernamesearch) {
            $usernamesearch .= ' AND ';
        }
        if ($emailsearch) {
            $emailsearch .= ' AND ';
        }
        if (count($searchvalues) >= 2) {
            if ($fullnamesearch) {
                $fullnamesearch .= " $searchterm";
            } else {
                $fullnamesearch .= sql_fullname() ." $LIKE '%$searchterm";
            }
        }
        if (count($searchvalues) < 2) {
            $firstnamesearch .= ' firstname ' . $LIKE .' \'%'. $searchterm .'%\' ';
            $lastnamesearch .= ' lastname ' . $LIKE .' \'%'. $searchterm .'%\' ';
        }

        $usernamesearch .= ' username ' . $LIKE .' \'%'. $searchterm .'%\' ';
        $emailsearch .= ' email ' . $LIKE .' \'%'. $searchterm .'%\' ';
    }

    // if fullnamesearch append the end for the string
    if ($fullnamesearch) {
        $fullnamesearch .= '%\'';
    }

    $sql = "SELECT u.*
            FROM {$CFG->prefix}user u
            WHERE (( $usernamesearch ) OR ( $emailsearch )) ";

    if ($fullnamesearch) {
        $sql .= " OR ( $fullnamesearch ) ";
    }

    if ($firstnamesearch) {
        $sql .= " OR ( $firstnamesearch ) ";
    }

    if ($lastnamesearch) {
        $sql .= " OR ( $lastnamesearch ) ";
    }

    $sql .= " ORDER BY " . $sort;

    if ($records = get_records_sql($sql)) {
        return $records;
    } else {
        return array();
    }
}

/**
 * Add the location info
 */
function add_location_info(&$sessions)
{
    global $CFG;

    if (!$sessions) {
        return;
    }

    $locationfieldid = get_field('facetoface_session_field', 'id', 'shortname', 'location');
    if (!$locationfieldid) {
        return array();
    }

    $alllocations = get_records_sql("SELECT d.sessionid, d.data
              FROM {$CFG->prefix}facetoface_sessions s
              JOIN {$CFG->prefix}facetoface_session_data d ON d.sessionid = s.id
             WHERE d.fieldid = $locationfieldid");

    foreach ($sessions as $session) {
        if (!empty($alllocations[$session->sessionid])) {
            $session->location = $alllocations[$session->sessionid]->data;
        }
        else {
            $session->location = '';
        }
    }
}

/**
 * Prints form items with the names $day, $month and $year
 *
 * @param int $filtername - the name of the filter to set up i.e coursename, courseid, location, trainer
 * @param int $currentvalue
 * @param boolean $return
 */
function print_facetoface_filters($startdate, $enddate, $currentcoursename, $currentcourseid,$currentlocation, $currenttrainer)
{
    global $CFG;

    $coursenames = array();
    $sessions = array();
    $locations = array();
    $courseids = array();
    $trainers = array();

    $results = get_records_sql("SELECT c.id as courseid, c.idnumber, c.fullname, s.id AS sessionid,
                                       f.id AS facetofaceid, cm.id AS cmid
                                    FROM {$CFG->prefix}course c
                                    JOIN {$CFG->prefix}facetoface f ON f.course = c.id
                                    JOIN {$CFG->prefix}facetoface_sessions s ON f.id = s.facetoface
                                    JOIN {$CFG->prefix}course_modules cm ON cm.course = f.course
                                         AND cm.instance = f.id
                                    WHERE c.visible = 1
                                    GROUP BY c.id, c.idnumber, c.fullname, s.id, f.id, cm.id
                                    ORDER BY c.fullname ASC");

    add_location_info($results);

    if (!empty($results)) {
        foreach ($results as $result) {
            // create unique list of coursenames
            if (!array_key_exists($result->fullname, $coursenames)) {
                $coursenames[$result->fullname] = $result->fullname;
            }

            // created unique list of locations
            if (isset($result->location)) {
                if (!array_key_exists($result->location, $locations)) {
                    $locations[$result->location] = $result->location;
                }
            }

            // create unique list of courseids
            if (!array_key_exists($result->idnumber, $courseids) and $result->idnumber) {
                $courseids[$result->idnumber] = $result->idnumber;
            }

            // create unique list of trainers
            // check if $trainers hasn't already been populated by the cached list
            if (empty($trainers)) {
                if (isset($result->trainers)) {
                    foreach ($result->trainers as $trainer) {
                        if (!array_key_exists($trainer,$trainers)) {
                            $trainers[$trainer] = $trainer;
                        }
                    }
                }
            }
        }
    }

    // Build or print result
    $table = new object();
    $table->tablealign = 'left';
    $table->data[] = array('<label for="menustartdate">'.get_string('daterange', 'block_facetoface').'</label>',
                           print_date_selector('startday', 'startmonth', 'startyear', $startdate, true) . ' to ' .
                           print_date_selector('endday', 'endmonth', 'endyear', $enddate, true));
    $table->data[] = array('<label for="menucoursename">'.get_string('coursefullname','block_facetoface').': </label>',
                           choose_from_menu($coursenames, 'coursename', $currentcoursename, get_string('all'), '', '', true));
    $table->data[] = array('<label for="menulocation">'.get_string('location', 'facetoface').': </label>',
                           choose_from_menu($locations, 'location', $currentlocation, get_string('all'), '', '', true));
    print_table($table);
}

/**
 * Add the trainer info
 */
function add_trainer_info(&$sessions)
{
    global $CFG;

    $moduleid = get_field('modules', 'id', 'name','facetoface');
    $alltrainers = array(); // all possible trainers for filter dropdown

    // find role id for trainer
    $trainerroleid = get_field('role','id','shortname','facilitator');

    foreach ($sessions as $session) {
        // individual session trainers
        $sessiontrainers = array();

        // get trainers for this session from session_roles table
        // set to null if trainer role id not found
        $sess_trainers = (isset($trainerroleid)) ? get_records_select('facetoface_session_roles',"sessionid={$session->sessionid} and roleid={$trainerroleid}") : null;

        // check if the module instance has already had trainer info added
        if (!array_key_exists($session->cmid, $alltrainers)) {
            $context = get_context_instance(CONTEXT_MODULE, $session->cmid);

            if($sess_trainers && is_array($sess_trainers)) {
                foreach($sess_trainers as $sess_trainer) {
                    $user = get_record('user','id',$sess_trainer->userid);
                    $fullname = fullname($user);
                    if (!array_key_exists($fullname, $sessiontrainers)) {
                        $sessiontrainers[$fullname] = $fullname;
                    }
                }
                if (!empty($sessiontrainers)) {
                    asort($sessiontrainers);
                    $session->trainers = $sessiontrainers;
                    $alltrainers[$session->cmid] = $sessiontrainers;
                } else {
                    $session->trainers = '';
                    $alltrainers[$session->cmid] = '';
                }
            }
        } else {
            if (!empty($alltrainers[$session->cmid])) {
                $session->trainers = $alltrainers[$session->cmid];
            } else {
                $session->trainers = '';
            }
        }
    }

    // cache the trainerlist with an expiry of 15 minutes to help speed up the db load
    $cachevalue = serialize($alltrainers);
    $expiry = time() + TRAINER_CACHE_TIMEOUT * 60;
    set_cache_flag('blocks/facetoface', 'trainers', $cachevalue, $expiry);

}

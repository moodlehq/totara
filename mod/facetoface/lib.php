<?php

require_once($CFG->libdir.'/gradelib.php');

/**
 * Definitions for setting notification types
 */
/**
 * Utility definitions
 */
define('MDL_F2F_ICAL',			1);
define('MDL_F2F_TEXT',			2);
define('MDL_F2F_BOTH',          3);
define('MDL_F2F_INVITE',		4);
define('MDL_F2F_CANCEL',		8);

/**
 * Definitions for use in forms
 */
define('MDL_F2F_INVITE_BOTH',		7);	    // Send a copy of both 4+1+2
define('MDL_F2F_INVITE_TEXT',		6);	    // Send just a plain email 4+2
define('MDL_F2F_INVITE_ICAL',		5);	    // Send just a combined text/ical message 4+1
define('MDL_F2F_CANCEL_BOTH',		11);	// Send a copy of both 8+2+1
define('MDL_F2F_CANCEL_TEXT',		10);	// Send just a plan email 8+2
define('MDL_F2F_CANCEL_ICAL',		9);	    // Send just a combined text/ical message 8+1

// Name of the custom field where the manager's email address is stored
define('MDL_MANAGERSEMAIL_FIELD', 'managersemail');

/**
 * Prints the cost amount along with the appropriate currency symbol.
 *
 * To set your currency symbol, set the appropriate 'locale' in
 * lang/en_utf8/langconfig.php (or the equivalent file for your
 * language).
 *
 * @param $amount      Numerical amount without currency symbol
 * @param $htmloutput  Whether the output is in HTML or not
 */
function format_cost($amount, $htmloutput=true) {
    setlocale(LC_MONETARY, get_string('locale'));
    $localeinfo = localeconv();

    $symbol = $localeinfo['currency_symbol'];
    if (empty($symbol)) {
        // Cannot get the locale information, default to en_US.UTF-8
        return '$' . $amount;
    }

    // Character between the currency symbol and the amount
    $separator = '';
    if ($localeinfo['p_sep_by_space']) {
        $separator = $htmloutput ? '&nbsp;' : ' ';
    }

    // The symbol can come before or after the amount
    if ($localeinfo['p_cs_precedes']) {
        return $symbol . $separator . $amount;
    }
    else {
        return $amount . $separator . $symbol;
    }
}

/**
 * Returns the effective cost of a session depending on the presence
 * or absence of a discount code.
 *
 * @param class $sessiondata contains the discountcost and normalcost
 */
function facetoface_cost($userid, $sessionid, $sessiondata, $htmloutput=true) {

    global $CFG;

    if (count_records_sql("SELECT COUNT(*)
                               FROM {$CFG->prefix}facetoface_submissions su,
                                    {$CFG->prefix}facetoface_sessions se
                              WHERE su.sessionid=$sessionid
                                AND su.userid=$userid
                                AND su.discountcode IS NOT NULL
                                AND su.sessionid = se.id
                                AND su.timecancelled = 0") > 0) {
        return format_cost($sessiondata->discountcost, $htmloutput);
    } else {
        return format_cost($sessiondata->normalcost, $htmloutput);
    }
}

/**
 * Human-readable version of the duration field used to display it to
 * users
 *
 * @param integer $duration duration in minutes
 */
function facetoface_duration($duration) {

    $minutes = round(($duration - floor($duration)) * 60);
    $hours = floor($duration);

    $string = '';

    if (1 == $hours) {
        $string = get_string('onehour', 'facetoface');
    } elseif ($hours > 1) {
        $string = get_string('xhours', 'facetoface', $hours);
    }

    // Insert separator between hours and minutes
    if ($string != '') {
        $string .= ' ';
    }

    if (1 == $minutes) {
        $string .= get_string('oneminute', 'facetoface');
    } elseif ($minutes > 0) {
        $string .= get_string('xminutes', 'facetoface', $minutes);
    }

    return $string;
}

/**
 * Converts minutes to hours
 */
function facetoface_minutes_to_hours($minutes) {

    return round($minutes / 60.0, 2);
}

/**
 * Converts hours to minutes
 */
function facetoface_hours_to_minutes($hours) {

    return round($hours * 60.0);
}

/**
 * Turn undefined manager messages into empty strings
 */
function facetoface_fix_manager_messages($facetoface) {

    if (empty($facetoface->emailmanagerconfirmation)) {
        $facetoface->confirmationinstrmngr = '';
    }
    if (empty($facetoface->emailmanagerreminder)) {
        $facetoface->reminderinstrmngr = '';
    }
    if (empty($facetoface->emailmanagercancellation)) {
        $facetoface->cancellationinstrmngr = '';
    }
    if (empty($facetoface->thirdpartywaitlist)) {
        $facetoface->thirdpartywaitlist = 0;
    }
}

/**
 * Given an object containing all the necessary data, (defined by the
 * form in mod.html) this function will create a new instance and
 * return the id number of the new instance.
 */
function facetoface_add_instance($facetoface) {

    $facetoface->timemodified = time();

    facetoface_fix_manager_messages($facetoface);
    if ($facetoface->id = insert_record('facetoface', $facetoface)) {
        facetoface_grade_item_update($facetoface);
    }
    return $facetoface->id;
}

/**
 * Given an object containing all the necessary data, (defined by the
 * form in mod.html) this function will update an existing instance
 * with new data.
 */
function facetoface_update_instance($facetoface) {

    $facetoface->id = $facetoface->instance;

    facetoface_fix_manager_messages($facetoface);
    if ($return = update_record('facetoface', $facetoface)) {
        facetoface_grade_item_update($facetoface);
    }
    return $return;
}

/**
 * Given an ID of an instance of this module, this function will
 * permanently delete the instance and any data that depends on it.
 */
function facetoface_delete_instance($id) {

    global $CFG;

    if (!$facetoface = get_record('facetoface', 'id', $id)) {
        return false;
    }

    $result = true;
    begin_sql();

    if (!delete_records('facetoface_submissions', 'facetoface', $facetoface->id)) {
        $result = false;
    }

    if (!delete_records_select('facetoface_sessions_dates', "sessionid in (SELECT id FROM {$CFG->prefix}facetoface_sessions WHERE facetoface = $facetoface->id)")) {
        $result = false;
    }

    if (!delete_records('facetoface_sessions', 'facetoface', $facetoface->id)) {
        $result = false;
    }

    if (!delete_records('facetoface', 'id', $facetoface->id)) {
        $result = false;
    }

    if (!delete_records('event', 'modulename', 'facetoface', 'instance', $facetoface->id)) {
        $result = false;
    }

    if (!facetoface_grade_item_delete($facetoface)) {
        $result = false;
    }

    if ($result) {
        commit_sql();
    } else {
        rollback_sql();
    }

    return $result;
}

/**
 * Prepare the user data to go into the database.
 */
function cleanup_session_data($session) {

    // Convert hours (expressed like "1.75" or "2" or "3.5") to minutes
    $session->duration = facetoface_hours_to_minutes($session->duration);

    // Only numbers allowed here
    $session->capacity = preg_replace('/[^\d]/', '', $session->capacity);
    $MAX_CAPACITY = 100000;
    if ($session->capacity < 1) {
        $session->capacity = 1;
    }
    elseif ($session->capacity > $MAX_CAPACITY) {
        $session->capacity = $MAX_CAPACITY;
    }

    // Get the decimal point separator
    setlocale(LC_MONETARY, get_string('locale'));
    $localeinfo = localeconv();
    $symbol = $localeinfo['decimal_point'];
    if (empty($symbol)) {
        // Cannot get the locale information, default to en_US.UTF-8
        $symbol = '.';
    }

    // Only numbers or decimal separators allowed here
    $session->normalcost = round(preg_replace("/[^\d$symbol]/", '', $session->normalcost));
    $session->discountcost = round(preg_replace("/[^\d$symbol]/", '', $session->discountcost));

    return $session;
}

/**
 * Create a new entry in the facetoface_sessions table
 */
function facetoface_add_session($session, $sessiondates)
{
    global $USER;

    $session->timecreated = time();
    $session = cleanup_session_data($session);

    $eventname = get_field('facetoface', 'name', 'id', $session->facetoface);

    begin_sql();
    if ($session->id = insert_record('facetoface_sessions', $session)) {
        foreach ($sessiondates as $date) {
            $date->sessionid = $session->id;
            if (!insert_record('facetoface_sessions_dates', $date)) {
                rollback_sql();
                return false;
            }
        }

        // Put the sessions in this user's calendar
        // (i.e. we're assuming it's the teacher)
        $session->sessiondates = $sessiondates;
        facetoface_add_session_to_user_calendar($session, $eventname, $USER->id, 'session');

        commit_sql();
        return $session->id;
    } else {
        rollback_sql();
        return false;
    }
}

/**
 * Modify an entry in the facetoface_sessions table
 */
function facetoface_update_session($session, $sessiondates) {

    $session->timemodified = time();
    $session = cleanup_session_data($session);

    begin_sql();
    if (!update_record('facetoface_sessions', $session)) {
        rollback_sql();
        return false;
    }

    if (!delete_records('facetoface_sessions_dates', 'sessionid', $session->id)) {
        rollback_sql();
        return false;
    }
    foreach ($sessiondates as $date) {
        $date->sessionid = $session->id;
        if (!insert_record('facetoface_sessions_dates', $date)) {
            rollback_sql();
            return false;
        }
    }

    // Update Calendar entries for students and teachers
    $session->sessiondates = $sessiondates;
    if (!facetoface_update_calendar_events($session, 'booking')) {
        rollback_sql();
        return false;
    }
    if (!facetoface_update_calendar_events($session, 'session')) {
        rollback_sql();
        return false;
    }

    commit_sql();
    return $session->id;
}

/**
 * Return an array of all facetoface activities in the current course
 */
function facetoface_get_facetoface_menu() {

    global $CFG;
	if ($facetofaces = get_records_sql("SELECT f.id, c.shortname, f.name
                                            FROM {$CFG->prefix}course c, {$CFG->prefix}facetoface f
                                            WHERE c.id = f.course
                                            ORDER BY c.shortname, f.name")) {
        $i=1;
        foreach ($facetofaces as $facetoface) {
            $f = $facetoface->id;
            $facetofacemenu[$f] = $facetoface->shortname.' --- '.$facetoface->name;
            $i++;
        }

        return $facetofacemenu;

    } else {
        
        return '';

    }
}

/**
 * Delete entry from the facetoface_sessions table along with all
 * related details in other tables
 *
 * @param class $formdata Data submitted by the form
 */
function facetoface_delete_session($formdata) {

    global $CFG;

    $session = facetoface_get_session($formdata->s);
    $facetoface = get_record('facetoface', 'id', $session->facetoface);

    // Cancel user signups (and notify users)
    $signedupusers = get_records_sql("SELECT DISTINCT userid
                                        FROM {$CFG->prefix}facetoface_submissions
                                       WHERE sessionid = $formdata->s AND
                                             timecancelled = 0");
    if ($signedupusers and count($signedupusers) > 0) {
        foreach ($signedupusers as $user) {
            if (facetoface_user_cancel($session, $user->userid)) {
                facetoface_send_cancellation_notice($facetoface, $session, $user->userid);
            }
            else {
                return false; // Cannot rollback since we notified users already
            }
        }
    }

    begin_sql();

    // Remove entries from the teacher calendars
    if (!delete_records_select('event', "modulename = 'facetoface' AND
                                         eventtype = 'facetofacesession' AND
                                         instance = $facetoface->id AND
                                         description LIKE '%attendees.php?s=$session->id%'")) {
        rollback_sql();
        return false;
    }

    // Delete session details
    if (!delete_records('facetoface_sessions', 'id', $formdata->s)) {
        rollback_sql();
        return false;
    }
    if (!delete_records('facetoface_sessions_dates', 'sessionid', $formdata->s)) {
        rollback_sql();
        return false;
    }
    if (!delete_records('facetoface_submissions', 'sessionid', $formdata->s)) {
        rollback_sql();
        return false;
    }

    commit_sql();
    return true;
}

/**
 * Subsitute the placeholders in email templates for the actual data
 */
function facetoface_email_substitutions($msg, $facetofacename, $reminderperiod, $user, $session, $sessionid) {

    if ($session->datetimeknown) {
        // Scheduled session
        $sessiondate = userdate($session->sessiondates[0]->timestart, get_string('strftimedate'));
        $starttime = userdate($session->sessiondates[0]->timestart, get_string('strftimetime'));
        $finishtime = userdate($session->sessiondates[0]->timefinish, get_string('strftimetime'));

        $alldates = '';
        foreach ($session->sessiondates as $date) {
            if ($alldates != '') {
                $alldates .= "\n";
            }
            $alldates .= userdate($date->timestart, get_string('strftimedate')).', ';
            $alldates .= userdate($date->timestart, get_string('strftimetime')).
                ' to '.userdate($date->timefinish, get_string('strftimetime'));
        }
    }
    else {
        // Wait-listed session
        $sessiondate = get_string('unknowndate', 'facetoface');
        $alldates    = get_string('unknowndate', 'facetoface');
        $starttime   = get_string('unknowntime', 'facetoface');
        $finishtime  = get_string('unknowntime', 'facetoface');
    }

    $msg = str_replace(get_string('placeholder:facetofacename', 'facetoface'), $facetofacename,$msg);
    $msg = str_replace(get_string('placeholder:firstname', 'facetoface'), $user->firstname,$msg);
    $msg = str_replace(get_string('placeholder:lastname', 'facetoface'), $user->lastname,$msg);
    $msg = str_replace(get_string('placeholder:cost', 'facetoface'), facetoface_cost($user->id, $sessionid, $session, false),$msg);
    $msg = str_replace(get_string('placeholder:alldates', 'facetoface'), $alldates,$msg);
    $msg = str_replace(get_string('placeholder:sessiondate', 'facetoface'), $sessiondate,$msg);
    $msg = str_replace(get_string('placeholder:starttime', 'facetoface'), $starttime,$msg);
    $msg = str_replace(get_string('placeholder:finishtime', 'facetoface'), $finishtime,$msg);
    $msg = str_replace(get_string('placeholder:duration', 'facetoface'), facetoface_duration($session->duration),$msg);
    $msg = str_replace(get_string('placeholder:location', 'facetoface'), $session->location,$msg);
    $msg = str_replace(get_string('placeholder:venue', 'facetoface'), $session->venue,$msg);
    $msg = str_replace(get_string('placeholder:room', 'facetoface'), $session->room,$msg);
    $msg = str_replace(get_string('placeholder:details', 'facetoface'), $session->details,$msg);
    $msg = str_replace(get_string('placeholder:reminderperiod', 'facetoface'), $reminderperiod,$msg);

    return $msg;
}

/**
 * Function to be run periodically according to the moodle cron
 * Finds all facetoface notifications that have yet to be mailed out, and mails them.
 */
function facetoface_cron () {

    global $CFG, $USER;

    if ($submissionsdata = facetoface_get_unmailed_reminders()) {

        $timenow   = time();

        foreach ($submissionsdata as $submissiondata) {

            if (facetoface_has_session_started($submissiondata, $timenow)) {
                // Too late, the session already started
                continue;
            }

            $reminderperiod = $submissiondata->reminderperiod;

            // Convert the period from business days (no weekends) to calendar days
            for ($reminderday = 0; $reminderday < $reminderperiod + 1; $reminderday++ ) {
                $reminderdaytime = $submissiondata->sessiondates[0]->timestart - ($reminderday * 24 * 3600);
                $reminderdaycheck = userdate($reminderdaytime, '%u');
                if ($reminderdaycheck > 5) {
                    // Saturdays and Sundays are not included in the
                    // reminder period as entered by the user, extend
                    // that period by 1
                    $reminderperiod++;
                }
            }

            $remindertime = $submissiondata->sessiondates[0]->timestart - ($reminderperiod * 24 * 3600);

            if ($timenow < $remindertime) {
                // Too early to send reminder
                continue;
            }

            if (! $user = get_record('user', 'id', "$submissiondata->userid")) {
                continue;
            }

            $USER->lang = $user->lang;

            if (! $course = get_record('course', 'id', "$submissiondata->course")) {
                continue;
            }

            if (! $facetoface = get_record('facetoface', 'id', "$submissiondata->facetofaceid")) {
                continue;
            }

            $postsubject = '';
            $posttext = '';
            $posttextmgrheading = '';

            if (empty ($submissiondata->mailedreminder)) {
                $postsubject = $facetoface->remindersubject;
                $posttext = $facetoface->remindermessage;
                $posttextmgrheading = $facetoface->reminderinstrmngr;
            }

            if (! empty($postsubject) && ! empty ($posttext) ) {

                $postsubject = facetoface_email_substitutions($postsubject, $submissiondata->facetofacename, $submissiondata->reminderperiod, $user, $submissiondata, $submissiondata->sessionid);
                $posttext = facetoface_email_substitutions($posttext, $submissiondata->facetofacename, $submissiondata->reminderperiod, $user, $submissiondata, $submissiondata->sessionid);

                if (! empty($posttextmgrheading) ) {
                    $posttextmgrheading = facetoface_email_substitutions($posttextmgrheading, $submissiondata->facetofacename, $submissiondata->reminderperiod, $user, $submissiondata, $submissiondata->sessionid);
                }

                $posthtml = '';
                $fromaddress = get_config(NULL, 'facetoface_fromaddress');
                if (!$fromaddress) {
                    $fromaddress = '';
                }

                require_once($CFG->dirroot.'/lib/adminlib.php');

                if (email_to_user($user, $fromaddress, $postsubject, $posttext, $posthtml)) {

                    echo get_string('sentreminderuser', 'facetoface').": $user->firstname $user->lastname $user->email<BR />\n";

                    $submission = new object;
                    $submission->id = $submissiondata->id;
                    $submission->mailedreminder = $timenow;
                    update_record('facetoface_submissions', $submission);

                    if (!empty($posttextmgrheading)) {
                        $managertext = $posttextmgrheading.$posttext;

                        $usercheck = get_record('user', 'id', $user->id);
                        $manager = $user;
                        $manager->email = facetoface_get_manageremail($user->id);

                        if (!empty($manager->email) && email_to_user($manager, $fromaddress, $postsubject, $managertext, $posthtml)) {

                            echo get_string('sentremindermanager', 'facetoface').": $user->firstname $user->lastname $manager->email<BR />\n";

                        } else {
                            $errormsg = array();
                            $errormsg['submissionid'] = $submissiondata->id;
                            $errormsg['userid'] = $user->id;
                            $errormsg['manageremail'] = $manager->email;
                            echo get_string('error:cronprefix', 'facetoface').' '.get_string('error:cannotemailmanager', 'facetoface', $errormsg)."\n";
                        }
                    }

                } else {
                    $errormsg = array();
                    $errormsg['submissionid'] = $submissiondata->id;
                    $errormsg['userid'] = $user->id;
                    $errormsg['useremail'] = $user->email;
                    echo get_string('error:cronprefix', 'facetoface').' '.get_string('error:cannotemailuser', 'facetoface', $errormsg)."\n";
                }
            }
        }
    } else {
        echo get_string('noremindersneedtobesent', 'facetoface');
    }
    return true;
}

/**
 * Returns true if the session has started, that is if one of the
 * session dates is in the past.
 *
 * @param class $session record from the facetoface_sessions table
 * @param integer $timenow current time
 */
function facetoface_has_session_started($session, $timenow) {

    if (!$session->datetimeknown) {
        return false; // no date set
    }

    foreach ($session->sessiondates as $date) {
        if ($date->timestart < $timenow) {
            return true;
        }
    }
    return false;
}

/**
 * Print the list of all sessions for the given facetoface activity and location
 */
function facetoface_print_sessions($courseid, $facetofaceid, $location) {

    global $CFG, $USER;

    $context = get_context_instance(CONTEXT_COURSE, $courseid, $USER->id);

    $bookedsession = '0';
    $spanclass = '';

    $submissions = facetoface_get_user_submissions($facetofaceid, $USER->id);

    $bookedsession = null;
    if ($submissions) {
        $submission = array_shift($submissions);
        $bookedsession = $submission->sessionid;
    }

    $timenow = time();

    $tableheader = '';

    if (has_capability('mod/facetoface:viewattendees', $context)) {
        $tableheader = '<thead>'
                    . '<tr>'
                    . '<th class="header" align="left">'.get_string('location', 'facetoface').'</th>'
                    . '<th class="header" align="left">'.get_string('venue', 'facetoface').'</th>'
                    . '<th class="header">'.get_string('date', 'facetoface').'</th>'
                    . '<th class="header">'.get_string('time', 'facetoface').'</th>'
                    . '<th class="header">'.get_string('capacity', 'facetoface').'</th>'
                    . '<th class="header">'.get_string('status', 'facetoface').'</th>'
                    . '<th class="header">'.get_string('options', 'facetoface').'</th>'
                    . '</tr>'
                    . '</thead>';
    } else {
        $tableheader = '<thead>'
                    . '<tr>'
                    . '<th class="header" align="left">'.get_string('location', 'facetoface').'</th>'
                    . '<th class="header" align="left">'.get_string('venue', 'facetoface').'</th>'
                    . '<th class="header">'.get_string('date', 'facetoface').'</th>'
                    . '<th class="header">'.get_string('time', 'facetoface').'</th>'
                    . '<th class="header">'.get_string('seatsavailable', 'facetoface').'</th>'
                    . '<th class="header">'.get_string('status', 'facetoface').'</th>'
                    . '<th class="header">'.get_string('options', 'facetoface').'</th>'
                    . '</tr>'
                    . '</thead>';
    }

    $tableupcoming = '';
    $tableupcomingtbd = '';
    $tableprevious = '';

    if ($sessions = facetoface_get_sessions($facetofaceid, $location) ) {

        foreach($sessions as $session) {

            $status  = get_string('bookingopen', 'facetoface');
            $options = '';
            $spanclass = '';

            $signupcount = facetoface_get_num_attendees($session->id);

            if ($signupcount >= $session->capacity) {

                $status = get_string('bookingfull', 'facetoface');

            } elseif ($session->closed) {

                $status = get_string('bookingclosed', 'facetoface');

            }

            $allsessiondates = '';
            $allsessiontimes = '';
            foreach ($session->sessiondates as $date) {
                if (!empty($allsessiondates)) {
                        $allsessiondates .= '<br />';
                }
                $allsessiondates .= userdate($date->timestart, get_string('strftimedate'));
                if (!empty($allsessiontimes)) {
                    $allsessiontimes .= '<br />';
                }
                $allsessiontimes .= userdate($date->timestart, get_string('strftimetime')).
                    ' - '.userdate($date->timefinish, get_string('strftimetime'));
            }

            // Defaults for normal users
            $stats = $session->capacity - $signupcount;
            $options = '';

            if ($session->datetimeknown && facetoface_has_session_started($session, $timenow)) {

                $status = get_string('sessionover', 'facetoface');
                $spanclass = ' class="dimmed_text"';

                if (has_capability('mod/facetoface:editsessions', $context)) {
                    $options .= ' <a href="sessions.php?s='.$session->id.'" title="'.get_string('editsession', 'facetoface').'">'.get_string('edit').'</a> '
                        . '<a href="sessions.php?s='.$session->id.'&amp;c=1" title="'.get_string('copysession', 'facetoface').'">'.get_string('copy', 'facetoface').'</a> '
                        . '<a href="sessions.php?s='.$session->id.'&amp;d=1" title="'.get_string('deletesession', 'facetoface').'">'.get_string('delete').'</a> ';
                }
                if (has_capability('mod/facetoface:viewattendees', $context)){
                    $stats = $signupcount.' / '.$session->capacity;
                    $options .= '<a href="attendees.php?s='.$session->id.'" title="'.get_string('seeattendees', 'facetoface').'">'.get_string('attendees', 'facetoface').'</a> ';
                }

                if (empty($options)) {
                    $options = get_string('none', 'facetoface');
                }

                $tableprevious .= '<tr>'
                            . '<td class="content" style="width: 10%"><span '.$spanclass.'>'.$session->location.'</span></td>'
                            . '<td class="content" style="width: 20%"><span '.$spanclass.'>'.$session->venue.'</span></td>'
                            . '<td class="content" style="width: 10%" align="center"><span '.$spanclass.'>'.$allsessiondates.'</span></td>'
                            . '<td class="content" style="width: 15%" align="center"><span '.$spanclass.'>'.$allsessiontimes.'</span></td>'
                            . '<td class="content" style="width: 15%" align="center"><span '.$spanclass.'>'.$stats.'</span></td>'
                            . '<td class="content" style="width: 10%" align="center"><span '.$spanclass.'>'.$status.'</span></td>'
                            . '<td class="content" style="width: 20%" align="center"><span '.$spanclass.'>'.$options.'</span></td>'
                            . '</tr>';

            } else {

                $trclass = '';
                $spanclass = '';

                if (has_capability('mod/facetoface:editsessions', $context)) {
                    $options .= '<a href="sessions.php?s='.$session->id.'" title="'.get_string('editsession', 'facetoface').'">'.get_string('edit').'</a> '
                        . '<a href="sessions.php?s='.$session->id.'&amp;c=1" title="'.get_string('copysession', 'facetoface').'">'.get_string('copy', 'facetoface').'</a> '
                        . '<a href="sessions.php?s='.$session->id.'&amp;d=1" title="'.get_string('deletesession', 'facetoface').'">'.get_string('delete').'</a> ';
                }
                if ($session->id == $bookedsession) {
                    $trclass = ' class="highlight"';
                    $tableupcoming .= '<tr'.$trclass.'><td class="content" colspan="7"><span style="font-size: 12px; line-height: 12px;"><b>'.get_string('youarebooked', 'facetoface').':</b></span></td></tr>';

                    $options .= '<a href="'.$CFG->wwwroot.'/mod/facetoface/signup.php?s='.$session->id.'&amp;backtoallsessions='.$facetofaceid.'" alt="'.get_string('moreinfo', 'facetoface').'" title="'.get_string('moreinfo', 'facetoface').'">'.get_string('moreinfo', 'facetoface').'</a><br />'
                        . '<a href="'.$CFG->wwwroot.'/mod/facetoface/attendees.php?s='.$session->id.'&amp;backtoallsessions='.$facetofaceid.'" alt="'.get_string('seeattendees', 'facetoface').'" title="'.get_string('seeattendees', 'facetoface').'">'.get_string('seeattendees', 'facetoface').'</a><br />'
                        . '<a href="'.$CFG->wwwroot.'/mod/facetoface/signup.php?s='.$session->id.'&amp;cancelbooking=1&amp;backtoallsessions='.$facetofaceid.'" alt="'.get_string('cancelbooking', 'facetoface').'" title="'.get_string('cancelbooking', 'facetoface').'">'.get_string('cancelbooking', 'facetoface').'</a>';
                } else {
                    if (has_capability('mod/facetoface:viewattendees', $context)) {
                        $stats = $signupcount.' / '.$session->capacity;
                        $options .= ' <a href="attendees.php?s='.$session->id.'&amp;backtoallsessions='.$facetofaceid.'" title="'.get_string('seeattendees', 'facetoface').'">'.get_string('attendees', 'facetoface').'</a> ';
                    }

                    if ($bookedsession || ($status == get_string('bookingfull', 'facetoface'))) {
                        $spanclass = ' class="dimmed_text"';
                    } else {
                        $options .= '<a href="signup.php?s='.$session->id.'&amp;backtoallsessions='.$facetofaceid.'">'.get_string('signup', 'facetoface').'</a>';
                    }
                }

                if (empty($options)) {
                    $options = get_string('none', 'facetoface');
                }

                if ($session->datetimeknown) {

                    $tableupcoming .= '<tr'.$trclass.'>'
                                . '<td class="content" style="width: 10%"><span '.$spanclass.'>'.$session->location.'</span></td>'
                                . '<td class="content" style="width: 20%"><span '.$spanclass.'>'.$session->venue.'</span></td>'
                                . '<td class="content" style="width: 10%" align="center"><span '.$spanclass.'>'.$allsessiondates.'</span></td>'
                                . '<td class="content" style="width: 15%" align="center"><span '.$spanclass.'>'.$allsessiontimes.'</span></td>'
                                . '<td class="content" style="width: 15%" align="center"><span '.$spanclass.'>'.$stats.'</span></td>'
                                . '<td class="content" style="width: 10%" align="center"><span '.$spanclass.'>'.$status.'</span></td>'
                                . '<td class="content" style="width: 20%" align="center"><span '.$spanclass.'>'.$options.'</span></td>'
                                . '</tr>';

                } else {

                    $tableupcomingtbd .= '<tr'.$trclass.'>'
                                . '<td class="content" style="width: 10%"><span '.$spanclass.'>'.$session->location.'</span></td>'
                                . '<td class="content" style="width: 20%"><span '.$spanclass.'>'.$session->venue.'</span></td>'
                                . '<td class="content" style="width: 10%" align="center"><span '.$spanclass.'>'.get_string('wait-listed', 'facetoface').'</span></td>'
                                . '<td class="content" style="width: 15%" align="center"><span '.$spanclass.'>'.get_string('wait-listed', 'facetoface').'</span></td>'
                                . '<td class="content" style="width: 15%" align="center"><span '.$spanclass.'>'.$stats.'</span></td>'
                                . '<td class="content" style="width: 10%" align="center"><span '.$spanclass.'>'.get_string('wait-listed', 'facetoface').'</span></td>'
                                . '<td class="content" style="width: 20%" align="center"><span '.$spanclass.'>'.$options.'</span></td>'
                                . '</tr>';

                }

            }

        }

    }

    print_heading(get_string('upcomingsessions', 'facetoface'), 'center');
        echo '<table align="center" cellpadding="3" cellspacing="0" width="90%" style="border-color:#DDDDDD; border-width:1px 1px 1px 1px; border-style:solid;">';
        echo $tableheader;
        if (empty($tableupcoming) and empty($tableupcomingtbd) ) {
            echo '<tr><td colspan="7" align="center">'.get_string('noupcoming', 'facetoface').'</td></tr>';
        } else {
            echo $tableupcoming;
            echo $tableupcomingtbd;
        }
        if (has_capability('mod/facetoface:editsessions', $context)) {
            echo '<tr><td colspan="7" align="center"><a href="'.$CFG->wwwroot.'/mod/facetoface/sessions.php?f='.$facetofaceid.'" title="'.get_string('addsession', 'facetoface').'">'.get_string('addsession', 'facetoface').'</a></td></tr>';
        }
        echo '</table>';

    if (! empty($tableprevious)) {
        print_heading(get_string('previoussessions', 'facetoface'), 'center');
        echo '<table align="center" cellpadding="3" cellspacing="0" width="90%" style="border-color:#DDDDDD; border-width:1px 1px 1px 1px; border-style:solid;">';
        echo $tableheader;
        echo $tableprevious;
        echo '</table>';
    } 

}

/**
 * Get all of the dates for a given session
 */
function facetoface_get_session_dates($sessionid) {

    $ret = array();

    if ($dates = get_records('facetoface_sessions_dates', 'sessionid', $sessionid)) {
        $i = 0;
        foreach ($dates as $date) {
            $ret[$i++] = $date;
        }
    }

    return $ret;
}

/**
 * Get a record from the facetoface_sessions table
 *
 * @param integer $sessionid ID of the session
 */
function facetoface_get_session($sessionid) {

    $session = get_record('facetoface_sessions', 'id', $sessionid);

    if ($session) {
        $session->sessiondates = facetoface_get_session_dates($sessionid);
        $session->duration = facetoface_minutes_to_hours($session->duration);
    }

    return $session;
}

/**
 * Get all records from facetoface_sessions for a given facetoface activity and location
 *
 * @param integer $facetofaceid ID of the activity
 * @param string $location location filter (optional)
 */
function facetoface_get_sessions($facetofaceid, $location='') {

    global $CFG;
    if (empty($location)) {
        $sessions = get_records_sql("SELECT s.* FROM {$CFG->prefix}facetoface_sessions s,
                                        (SELECT sessionid, min(timestart) AS mintimestart
                                            FROM {$CFG->prefix}facetoface_sessions_dates GROUP BY sessionid) d
                                        WHERE s.facetoface=$facetofaceid AND d.sessionid = s.id
                                        ORDER BY s.datetimeknown, d.mintimestart");

        $brokensessions = get_records_sql("SELECT s.* FROM {$CFG->prefix}facetoface_sessions s
                                               WHERE s.facetoface=$facetofaceid
                                                   AND NOT EXISTS
                                          (SELECT 1 FROM {$CFG->prefix}facetoface_sessions_dates
                                              WHERE sessionid = s.id)");
    } else {
        $sessions = get_records_sql("SELECT s.* FROM {$CFG->prefix}facetoface_sessions s,
                                        (SELECT sessionid, min(timestart) AS mintimestart
                                            FROM {$CFG->prefix}facetoface_sessions_dates GROUP BY sessionid) d
                                        WHERE s.facetoface=$facetofaceid AND d.sessionid = s.id
                                            AND s.location='$location'
                                        ORDER BY s.datetimeknown, d.mintimestart");

        $brokensessions = get_records_sql("SELECT s.* FROM {$CFG->prefix}facetoface_sessions s
                                               WHERE s.facetoface=$facetofaceid
                                                   AND s.location='$location'
                                                   AND NOT EXISTS
                                          (SELECT 1 FROM {$CFG->prefix}facetoface_sessions_dates
                                              WHERE sessionid = s.id)");
    }

    // Broken sessions are sessions which have no dates associated
    // with them, they are only returned so that they are visible and
    // can be fixed by users.  The cause of these broken sessions
    // should be investigated and a bug should be filed.
    if ($brokensessions) {
        $courseid = get_field('facetoface', 'course', 'id', $facetofaceid);
        add_to_log($courseid, 'facetoface', 'broken sessions found', '', "facetofaceid=$facetofaceid");
        $sessions = array_merge($sessions, $brokensessions);
    }

    if ($sessions) {
        foreach ($sessions as $key => $value) {
            $sessions[$key]->duration = facetoface_minutes_to_hours($sessions[$key]->duration);
            $sessions[$key]->sessiondates = facetoface_get_session_dates($value->id);
        }
    }

    return $sessions;
}

/**
 * Get a grade for the given user from the gradebook.
 *
 * @param integer $userid        ID of the user
 * @param integer $courseid      ID of the course
 * @param integer $facetofaceid  ID of the Face-to-face activity
 *
 * @returns object String grade and the time that it was graded
 */
function facetoface_get_grade($userid, $courseid, $facetofaceid) {

    $ret = new object;
    $ret->grade = 0;
    $ret->dategraded = 0;

    $grading_info = grade_get_grades($courseid, 'mod', 'facetoface', $facetofaceid, $userid);
    if (!empty($grading_info->items)) {
        $ret->grade = $grading_info->items[0]->grades[$userid]->str_grade;
        $ret->dategraded = $grading_info->items[0]->grades[$userid]->dategraded;
    }

    return $ret;
}

/**
 * Get list of users attending a given session
 */
function facetoface_get_attendees($sessionid) {
    global $CFG;

    $records = get_records_sql("SELECT u.id, s.id AS submissionid, u.firstname, u.lastname, u.email,
                                       s.discountcode, f.id AS facetofaceid, f.course, 0 AS grade
                                  FROM {$CFG->prefix}facetoface f
                                  JOIN {$CFG->prefix}facetoface_submissions s ON s.facetoface = f.id
                                  JOIN {$CFG->prefix}user u ON u.id = s.userid
                                 WHERE s.sessionid=$sessionid
                                   AND s.timecancelled = 0
                              ORDER BY u.firstname");

    if (!$records) {
        return $records;
    }

    // Get all grades at once
    $userids = array();
    foreach ($records as $record) {
        $userids[] = $record->id;
    }
    $grading_info = grade_get_grades(reset($records)->course, 'mod', 'facetoface',
                                     reset($records)->facetofaceid, $userids);

    // Update the records
    foreach ($records as $record) {
        $record->grade = $grading_info->items[0]->grades[$record->id]->str_grade;
    }

    return $records;
}

/**
 * Download the list of users attending at least one of the sessions
 * for a given facetoface activity
 */
function facetoface_download_attendance($facetofacename, $facetofaceid, $location, $format) {
    global $CFG;

    $timenow = time();
    $timeformat = str_replace(' ', '_', get_string('strftimedate'));
    $downloadfilename = clean_filename($facetofacename.'_'.userdate($timenow, $timeformat));

    require_once $CFG->dirroot.'/grade/lib.php';
    $userfields = array();
    if (function_exists('grade_export_user_fields')) {
        $userfields = grade_export_user_fields();
    }
    else {
        // Set default fields if the grade export patch is not
        // detected (see MDL-17346)
        $fieldnames = array('firstname', 'lastname', 'email', 'city',
                            'idnumber', 'institution', 'department', 'address');
        foreach ($fieldnames as $shortname) {
            $field = new object();
            $field->shortname = $shortname;
            $field->fullname = get_string($shortname);
            $userfields[] = $field;
        }
        $field = new object;
        $field->shortname = 'managersemail';
        $field->fullname = get_string('manageremail', 'facetoface');
        $userfields[] = $field;
    }

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
    $worksheet =& $workbook->add_worksheet('attendance');

    $pos=0;
    $worksheet->write_string(0,$pos++,get_string('location', 'facetoface'));
    $worksheet->write_string(0,$pos++,get_string('venue', 'facetoface'));
    $worksheet->write_string(0,$pos++,get_string('date', 'facetoface'));
    $worksheet->write_string(0,$pos++,get_string('timestart', 'facetoface'));
    $worksheet->write_string(0,$pos++,get_string('timefinish', 'facetoface'));
    $worksheet->write_string(0,$pos++,get_string('status', 'facetoface'));
    foreach ($userfields as $field) {
        $worksheet->write_string(0,$pos++,$field->fullname);
    }
    $worksheet->write_string(0,$pos++,get_string('attendance', 'facetoface'));

    $sessions = facetoface_get_sessions($facetofaceid, $location);
    if (!empty($sessions)) {

        $i = 0;
        foreach ($sessions as $session) {

            if ($session->datetimeknown) {
                // Display only the first date
                $sessiondate = userdate($session->sessiondates[0]->timestart, get_string('strftimedate'));
                $starttime   = userdate($session->sessiondates[0]->timestart, get_string('strftimetime'));
                $finishtime  = userdate($session->sessiondates[0]->timefinish, get_string('strftimetime'));

                if (facetoface_has_session_started($session, $timenow)) {
                    $status = get_string('sessionover', 'facetoface');
                }
                else {
                    $signupcount = facetoface_get_num_attendees($session->id);
                    if ($signupcount >= $session->capacity) {
                        $status = get_string('bookingfull', 'facetoface');
                    } else {
                        $status = get_string('bookingopen', 'facetoface');
                    }
                }
            }
            else {
                $sessiondate = get_string('wait-listed', 'facetoface');
                $starttime   = get_string('wait-listed', 'facetoface');
                $finishtime  = get_string('wait-listed', 'facetoface');
                $status      = get_string('wait-listed', 'facetoface');
            }

            $attendees = facetoface_get_attendees($session->id);

            if (!empty($attendees)) {
                foreach ($attendees as $attendee) {
                    $student = get_complete_user_data('id', $attendee->id);
                    if (!empty($student)) {
                        $i++; $j=0;
                        $worksheet->write_string($i,$j++,$session->location);
                        $worksheet->write_string($i,$j++,$session->venue);
                        $worksheet->write_string($i,$j++,$sessiondate);
                        $worksheet->write_string($i,$j++,$starttime);
                        $worksheet->write_string($i,$j++,$finishtime);
                        $worksheet->write_string($i,$j++,$status);
                        foreach ($userfields as $field) {
                            $worksheet->write_string($i,$j++,$student->{$field->shortname});
                        }
                        $worksheet->write_string($i,$j++,$attendee->grade);
                    }
                }
            }
            else {
                // no one is sign-up, so let's just print the basic info
                $i++; $j=0;
                $worksheet->write_string($i,$j++,$session->location);
                $worksheet->write_string($i,$j++,$session->venue);
                $worksheet->write_string($i,$j++,$sessiondate);
                $worksheet->write_string($i,$j++,$starttime);
                $worksheet->write_string($i,$j++,$finishtime);
                $worksheet->write_string($i,$j++,$status);
                foreach ($userfields as $field) {
                    $worksheet->write_string($i,$j++,'-');
                }
                $worksheet->write_string($i,$j++,'-');
            }
        }
    }

    $workbook->close();
    exit;
}

/**
 * Return an array of all of the locations where the given facetoface
 * activity has sessions
 */
function facetoface_get_locations($facetofaceid) { 
    global $CFG; 
    if ($sessions = get_records_sql("SELECT DISTINCT location, id, venue
                                         FROM {$CFG->prefix}facetoface_sessions
                                         WHERE facetoface = $facetofaceid
                                         ORDER BY location")) {

        $i=1;
        $locationmenu[''] = get_string('alllocations', 'facetoface');
        foreach ($sessions as $session) {
            $f = $session->id;
            $locationmenu[$session->location] = $session->location;
            $i++;
        }

        return $locationmenu;

    } else {
        
        return '';

    }
}

/**
 * Return list of marked submissions that have not been mailed out for currently enrolled students
 */
function facetoface_get_unmailed_reminders() {

    global $CFG;

    $submissions = get_records_sql("SELECT su.*, f.course, f.id as facetofaceid, f.name as facetofacename,
                                           f.reminderperiod, se.duration, se.normalcost, se.discountcost,
                                           se.location, se.venue, se.room, se.details, se.datetimeknown
                                       FROM {$CFG->prefix}facetoface_submissions su,
                                            {$CFG->prefix}facetoface_sessions se,
                                            {$CFG->prefix}facetoface f,
                                            {$CFG->prefix}course c
                                       WHERE su.mailedreminder = 0 AND se.datetimeknown=1 AND
                                             f.course=c.id AND su.sessionid=se.id AND
                                             se.facetoface=f.id AND f.id=su.facetoface AND
                                             su.timecancelled = 0");

    if ($submissions) {
        foreach ($submissions as $key => $value) {
            $submissions[$key]->duration = facetoface_minutes_to_hours($submissions[$key]->duration);
            $submissions[$key]->sessiondates = facetoface_get_session_dates($value->sessionid);
        }
    }

    return $submissions;
}

/**
 * Add a record to the facetoface submissions table and sends out an
 * email confirmation
 *
 * @param class $session record from the facetoface_sessions table
 * @param class $facetoface record from the facetoface table
 * @param class $course record from the course table
 * @param string $discountcode code entered by the user
 * @param integer $notificationtype type of notifications to send to user
 * @see {{MDL_F2F_INVITE}}
 * @param integer $userid user to signup
 * @param bool $notifyuser whether or not to send an email confirmation
 * @param bool $displayerrors whether or not to return an error page on errors
 */
function facetoface_user_signup($session, $facetoface, $course, $discountcode,
                                $notificationtype, $userid=false,
                                $notifyuser=true, $displayerrors=true) {
    if (!$userid) {
        global $USER;
        $userid = $USER->id;
    }

    $return = false;
    $timenow = time();

    $usersignup = new stdclass;
    $usersignup->sessionid = $session->id;
    $usersignup->userid = $userid;
    $usersignup->facetoface = $session->facetoface;
    $usersignup->timecreated = $timenow;
    $usersignup->timemodified = $timenow;
    $usersignup->discountcode = trim(strtoupper($discountcode));
    if (empty($usersignup->discountcode)) {
        $usersignup->discountcode = null;
    }

    $usersignup->notificationtype = $notificationtype;

    begin_sql();
    if ($returnid = insert_record('facetoface_submissions', $usersignup)) {

        $return = $returnid;

        if (!$notifyuser or facetoface_has_session_started($session, $timenow)) {
            // If the session has already started, there's no need to notify the user
            facetoface_add_session_to_user_calendar($session, addslashes($facetoface->name), $userid, 'booking');
            commit_sql();
            return $return;
        }
        else {
            $error = facetoface_send_confirmation_notice($facetoface, $session, $userid, $notificationtype);
            if (empty($error)) {
                $usersignup->id = $returnid;
                $usersignup->mailedconfirmation = $timenow;

                if (update_record('facetoface_submissions', $usersignup)) {
                    facetoface_add_session_to_user_calendar($session, addslashes($facetoface->name), $userid, 'booking');
                    commit_sql();
                    return $return;
                }
            }
            elseif ($displayerrors) {
                error($error);
            }
        }
    }

    rollback_sql();
    return false;
}

/**
 * Cancel a user who signed up earlier
 *
 * @param class $session record from the facetoface_sessions table
 * @param integer $userid ID of the user to remove from the session
 */
function facetoface_user_cancel($session, $userid=false) {

    if (!$userid) {
        global $USER;
        $userid = $USER->id;
    }

    if (facetoface_user_cancel_submission($session->id, $userid)) {
        facetoface_remove_bookings_from_user_calendar($session, $userid);
        return true;
    }

    return false;
}

/**
 * Common code for sending confirmation and cancellation notices
 *
 * @param string $postsubject Subject of the email
 * @param string $posttext Plain text contents of the email
 * @param string $posttextmgrheading Header to prepend to $posttext in manager email
 * @param string $notificationtype The type of notification to send
 * @see {{MDL_F2F_INVITE}}
 * @param class $facetoface record from the facetoface table
 * @param class $session record from the facetoface_sessions table
 * @param integer $userid ID of the recipient of the email
 * @returns string Error message (or empty string if successful)
 */
function facetoface_send_notice($postsubject, $posttext, $posttextmgrheading,
                                $notificationtype, $facetoface, $session, $userid) {
    global $CFG;

    $user = get_record('user', 'id', $userid);
    if (!$user) {
        return get_string('error:invaliduserid', 'facetoface');
    }

    if (empty($postsubject) || empty($posttext)) {
        return '';
    }

    // If no notice type is defined (TEXT or ICAL)
    if (!($notificationtype & MDL_F2F_BOTH)) {
        // If none, make sure they at least get a text email
        $notificationtype |= MDL_F2F_TEXT;
    }

    // If we are cancelling, check if ical cancellations are disabled
    if (($notificationtype & MDL_F2F_CANCEL) &&
        get_config(NULL, 'facetoface_disableicalcancel')) {
        $notificationtype |= MDL_F2F_TEXT; // add a text notification
        $notificationtype &= ~MDL_F2F_ICAL; // remove the iCalendar notification
    }

    // If we are sending an ical attachment, set file name
    if ($notificationtype & MDL_F2F_ICAL) {
        if ($notificationtype & MDL_F2F_INVITE) {
            $attachmentfilename = 'invite.ics';
        }
	    elseif ($notificationtype & MDL_F2F_CANCEL) {
	        $attachmentfilename = 'cancel.ics';
	    }
    }

    // Do iCal attachement stuff
    $icalattachments = array();
    if ($notificationtype & MDL_F2F_ICAL) {
        if (get_config(NULL, 'facetoface_oneemailperday')) {
            // Keep track of all sessiondates
            $sessiondates = $session->sessiondates;

            foreach ($sessiondates as $sessiondate) {
                $session->sessiondates = array($sessiondate); // one day at a time

                $filename = facetoface_get_ical_attachment($notificationtype, $facetoface, $session, $user);
                $subject = facetoface_email_substitutions($postsubject, $facetoface->name, $facetoface->reminderperiod,
                                                          $user, $session, $session->id);
                $body = facetoface_email_substitutions($posttext, $facetoface->name, $facetoface->reminderperiod,
                                                       $user, $session, $session->id);
                $htmlbody = ''; // TODO
                $icalattachments[] = array('filename' => $filename, 'subject' => $subject,
                                           'body' => $body, 'htmlbody' => $htmlbody);
            }

            // Restore session dates
            $session->sessiondates = $sessiondates;
        }
        else {
            $filename = facetoface_get_ical_attachment($notificationtype, $facetoface, $session, $user);
            $subject = facetoface_email_substitutions($postsubject, $facetoface->name, $facetoface->reminderperiod,
                                                      $user, $session, $session->id);
            $body = facetoface_email_substitutions($posttext, $facetoface->name, $facetoface->reminderperiod,
                                                   $user, $session, $session->id);
            $htmlbody = ''; // TODO
            $icalattachments[] = array('filename' => $filename, 'subject' => $subject,
                                       'body' => $body, 'htmlbody' => $htmlbody);
        }
    }

    // Fill-in the email placeholders
    $postsubject = facetoface_email_substitutions($postsubject, $facetoface->name, $facetoface->reminderperiod,
                                                  $user, $session, $session->id);
    $posttext = facetoface_email_substitutions($posttext, $facetoface->name, $facetoface->reminderperiod,
                                               $user, $session, $session->id);

    if (!empty($posttextmgrheading)) {
        $posttextmgrheading = facetoface_email_substitutions($posttextmgrheading, $facetoface->name,
                                                             $facetoface->reminderperiod, $user, $session,
                                                             $session->id);
    }

    $posthtml = ''; // TODO: provide an HTML version of these notices
    $fromaddress = get_config(NULL, 'facetoface_fromaddress');
    if (!$fromaddress) {
        $fromaddress = '';
    }

    $usercheck = get_record('user', 'id', $userid);

	// Send email with iCal attachment
	if ($notificationtype & MDL_F2F_ICAL) {
        foreach ($icalattachments as $attachment) {
            if (!email_to_user($user, $fromaddress, $attachment['subject'], $attachment['body'],
                               $attachment['htmlbody'], $attachment['filename'], $attachmentfilename)) {

                return get_string('error:cannotsendconfirmationuser', 'facetoface');
            }
            unlink($CFG->dataroot . '/' . $attachment['filename']);
        }
	}

    // Send plain text email
	if ($notificationtype & MDL_F2F_TEXT) {
	    if (!email_to_user($user, $fromaddress, $postsubject, $posttext, $posthtml)) {
            return get_string('error:cannotsendconfirmationuser', 'facetoface');
	    }
	}

    // Manager notification
    $manageremail = facetoface_get_manageremail($userid);
    if (!empty($posttextmgrheading) and !empty($manageremail) and $session->datetimeknown) {
	    $managertext = $posttextmgrheading.$posttext;
        $manager = $user;
        $manager->email = $manageremail;

        // Leave out the ical attachments in the managers notification
        if (!email_to_user($manager, $fromaddress, $postsubject, $managertext, $posthtml)) {
            return get_string('error:cannotsendconfirmationmanager', 'facetoface');
        }
	}

    // Third-party notification
    if (!empty($facetoface->thirdparty) &&
        ($session->datetimeknown || !empty($facetoface->thirdpartywaitlist))) {

        $thirdparty = $user;
        $thirdparty->email = $facetoface->thirdparty;

        // Leave out the ical attachments in the 3rd parties notification
        if (!email_to_user($thirdparty, $fromaddress, $postsubject, $posttext, $posthtml)) {
            return get_string('error:cannotsendconfirmationthirdparty', 'facetoface');
        }
    }
}

/**
 * Send a confirmation email to the user and manager
 *
 * @param class $facetoface record from the facetoface table
 * @param class $session record from the facetoface_sessions table
 * @param integer $userid ID of the recipient of the email
 * @param integer $notificationtype Type of notifications to be sent @see {{MDL_F2F_INVITE}}
 * @returns string Error message (or empty string if successful)
 */
function facetoface_send_confirmation_notice($facetoface, $session, $userid, $notificationtype) {

    $posttextmgrheading = $facetoface->confirmationinstrmngr;
    if ($session->datetimeknown) {
        $postsubject = $facetoface->confirmationsubject;
        $posttext = $facetoface->confirmationmessage;
    } else {
        $postsubject = $facetoface->waitlistedsubject;
        $posttext = $facetoface->waitlistedmessage;

        // Don't send an iCal attachement when we don't know the date!
        $notificationtype |= MDL_F2F_TEXT; // add a text notification
        $notificationtype &= ~MDL_F2F_ICAL; // remove the iCalendar notification
    }

    // Set invite bit
    $notificationtype |= MDL_F2F_INVITE;

    return facetoface_send_notice($postsubject, $posttext, $posttextmgrheading,
                                  $notificationtype, $facetoface, $session, $userid);
}

/**
 * Send a confirmation email to the user and manager regarding the
 * cancellation
 *
 * @param class $facetoface record from the facetoface table
 * @param class $session record from the facetoface_sessions table
 * @param integer $userid ID of the recipient of the email
 * @returns string Error message (or empty string if successful)
 */
function facetoface_send_cancellation_notice($facetoface, $session, $userid) {

    $postsubject = $facetoface->cancellationsubject;
    $posttext = $facetoface->cancellationmessage;
    $posttextmgrheading = $facetoface->cancellationinstrmngr;

    // Lookup what type of notification to send
    $notificationtype = get_field('facetoface_submissions', 'notificationtype',
                                  'sessionid', $session->id, 'userid', $userid);

    // Set cancellation bit
    $notificationtype |= MDL_F2F_CANCEL;

    return facetoface_send_notice($postsubject, $posttext, $posttextmgrheading,
                                  $notificationtype, $facetoface, $session, $userid);
}

/**
 * Returns true if the user has registered for a session in the given
 * facetoface activity
 *
 * @global class $USER used to get the current userid
 */
function facetoface_check_signup($facetofaceid) {

    global $USER;

    if ($submissions = facetoface_get_user_submissions($facetofaceid, $USER->id)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Return the email address of the user's manager if it is
 * defined. Otherwise return an empty string.
 *
 * @param integer $userid User ID of the staff member
 */
function facetoface_get_manageremail($userid) {
    $fieldid = get_field('user_info_field', 'id', 'shortname', MDL_MANAGERSEMAIL_FIELD);
    if ($fieldid) {
        return get_field('user_info_data', 'data', 'userid', $userid, 'fieldid', $fieldid);
    }
    else {
        return ''; // No custom field => no manager's email
    }
}

/**
 * Human-readable version of the format of the manager's email address
 */
function facetoface_get_manageremailformat() {

    $addressformat = get_config(NULL, 'facetoface_manageraddressformat');

    if (!empty($addressformat)) {
        $readableformat = get_config(NULL, 'facetoface_manageraddressformatreadable');
        return get_string('manageremailformat', 'facetoface', $readableformat);
    }

    return '';
}

/**
 * Returns true if the given email address follows the format
 * prescribed by the site administrator
 *
 * @param string $manageremail email address as entered by the user
 */
function facetoface_check_manageremail($manageremail) {

    $addressformat = get_config(NULL, 'facetoface_manageraddressformat');

    if (empty($addressformat) || strpos($manageremail, $addressformat)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Set the user's manager email address using a custom field, creating
 * the custom field if it did not exist already.
 *
 * @global class $USER used to get the current userid
 */
function facetoface_set_manageremail($manageremail) {

    global $USER;

    begin_sql();

    if (!$fieldid = get_field('user_info_field', 'id', 'shortname', MDL_MANAGERSEMAIL_FIELD)) {
        // Create the custom field

        $categoryname = clean_param(get_string('modulename', 'facetoface'), PARAM_TEXT);
        if (!$categoryid = get_field('user_info_category', 'id', 'name', $categoryname)) {
            $category = new object();
            $category->name = $categoryname;
            $category->sortorder = 1;

            if (!$categoryid = insert_record('user_info_category', $category)) {
                rollback_sql();
                error_log('F2F: could not create new custom field category');
                return false;
            }
        }

        $record = new stdclass();
        $record->datatype = 'text';
        $record->categoryid = $categoryid;
        $record->shortname = MDL_MANAGERSEMAIL_FIELD;
        $record->name = clean_param(get_string('manageremail', 'facetoface'), PARAM_TEXT);

        if (!$fieldid = insert_record('user_info_field', $record)) {
            rollback_sql();
            error_log('F2F: could not create new custom field');
            return false;
        }
    }

    $data = new stdclass();
    $data->userid = $USER->id;
    $data->fieldid = $fieldid;
    $data->data = $manageremail;

    if ($dataid = get_field('user_info_data', 'id', 'userid', $USER->id, 'fieldid', $fieldid)) {
        $data->id = $dataid;
        if (!update_record('user_info_data', $data)) {
            error_log('F2F: could not update existing custom field data');
            rollback_sql();
            return false;
        }
    }
    else {
        if (!insert_record('user_info_data', $data)) {
            rollback_sql();
            error_log('F2F: could not insert new custom field data');
            return false;
        }
    }

    commit_sql();
    return true;
}

/**
 * Mark the fact that the user attended the facetoface session by
 * giving that user a grade of 100
 *
 * @param array $data array containing the sessionid under the 's' key
 *                    and every submission ID to mark as attended
 *                    under the 'submissionid_XXXX' keys where XXXX is
 *                    the ID of the signup
 */
function facetoface_take_attendance($data) {
    $sessionid = $data->s;
    $submission = new object;
        
    //get a list of the current attendees - we need this to set their grade value to zero to indicate
    //that they have not attended
    $previousattendees = facetoface_get_attendees($sessionid);
    
    // Record the selected attendees from the user interface - the other attendees will need their grades set
    // to zero, to indicate non attendance, but only the ticked attendees come through from the web interface.
    // Hence the need for a diff
    $selectedsubmissionids = array();
    
    foreach ($data as $key => $value) {
        $submissionidcheck = substr($key, 0, 13);
        if ($submissionidcheck == 'submissionid_') {
            $submissionid = substr($key, 13);
            $selectedsubmissionids[$submissionid]=$submissionid;

            // TODO: This is not very efficient, we should do this
            // query outside of the loop to get all submissions for a
            // given Face-to-face ID, then call
            // facetoface_grade_item_update with an array of grade
            // objects.
            if (!facetoface_take_individual_attendance($submissionid, true)) {
                error_log("F2F: could not mark '$submissionid' as attended");
                return false;
            }
        }
    }
    
    
    // Now we need to go through the unticked attendees and set their grades to zero to indicate a lack of attendance
    foreach ($previousattendees as $attendee) {
        $submissionid=$attendee->submissionid;
        if (!array_key_exists($submissionid, $selectedsubmissionids)) {
            if (!facetoface_take_individual_attendance($submissionid, false)) {
                error_log("F2F: could not mark '$submissionid' as non-attended");
                return false;
            }
        }
    }

    return true;
}

/*
 * Set the grading for an individual submission, to either 0 or 100 to indicate attendance
 * @param $submissionid The id of the submission inthe database
 * @param $didattend Set to true to indicate that a user did attend, and false to indicate
 *                   a lack of attendance.  This sets the grade to 100 or 0 respectively
 */
function facetoface_take_individual_attendance($submissionid,$didattend) {
    global $USER, $CFG;
    
    $timenow = time();
    
    // Indicate attendance by setting the grading to 0 (did not attend) or 100 (did attend)
    if ($didattend) {
        $grading = 100;
    }
    else {
        $grading = 0;
    }

    $record = get_record_sql("SELECT f.*, s.userid
                                FROM {$CFG->prefix}facetoface_submissions s
                                JOIN {$CFG->prefix}facetoface f ON f.id = s.facetoface
                                JOIN {$CFG->prefix}course_modules cm ON cm.instance = f.id
                                JOIN {$CFG->prefix}modules m ON m.id = cm.module
                               WHERE s.id = $submissionid AND m.name='facetoface'");

    $grade = new stdclass();
    $grade->userid = $record->userid;
    $grade->rawgrade = $grading;
    $grade->rawgrademin = 0;
    $grade->rawgrademax = 100;
    $grade->timecreated = $timenow;
    $grade->timemodified = $timenow;
    $grade->usermodified = $USER->id;

    return facetoface_grade_item_update($record, $grade);
}

/**
 * Used by course/lib.php to display a few sessions besides the
 * facetoface activity on the course page
 *
 * @global class $USER used to get the current userid
 */
function facetoface_print_coursemodule_info($coursemodule) {

    global $CFG, $USER;

    $info = NULL;
    $table = '';

    $timenow = time();
    $facetofaceid = $coursemodule->instance;

    if ($facetoface = get_record('facetoface', 'id', $facetofaceid)) {

        $context = get_context_instance(CONTEXT_MODULE, $coursemodule->id);
        if (has_capability('mod/facetoface:view', $context)) {

            if ($submissions = facetoface_get_user_submissions($facetofaceid, $USER->id)) {
                // User has signedup for the instance

                $submission = array_shift($submissions);

                if ($session = facetoface_get_session($submission->sessionid)) {

                    if ($session->datetimeknown) {

                        $sessiondate = '';
                        $sessiontime = '';
                        foreach ($session->sessiondates as $date) {
                            if (!empty($sessiondate)) {
                                $sessiondate .= '<br />';
                            }
                            $sessiondate .= userdate($date->timestart, get_string('strftimedate'));
                            if (!empty($sessiontime)) {
                                $sessiontime .= '<br />';
                            }
                            $sessiontime .= userdate($date->timestart, get_string('strftimetime')).
                                ' - '.userdate($date->timefinish, get_string('strftimetime'));
                        }

                    } else {

                        $sessiondate = get_string('wait-listed', 'facetoface');
                        $sessiontime = get_string('wait-listed', 'facetoface');

                    }

                    $table = '<table border="0" cellpadding="1" cellspacing="0" width="90%">'
                            .'<tr>'
                            .'<td colspan="4"><span style="font-size: 11px; font-weight: bold; line-height: 14px;">'.get_string('bookingstatus', 'facetoface').':</span></td>'
                            .'<td><span style="font-size: 11px; font-weight: bold; line-height: 14px;">'.get_string('options', 'facetoface').':</span></td>'
                            .'</tr>'
                            .'<tr>'
                            .'<td>'.$session->location.'</td>' 
                            .'<td>'.$session->venue.'</td>' 
                            .'<td>'.$sessiondate.'</td>' 
                            .'<td>'.$sessiontime.'</td>'
                            .'<td><table border="0"><tr><td><span style="font-size: 11px; font-weight: bold; line-height: 14px;"><a href="'.$CFG->wwwroot.'/mod/facetoface/signup.php?s='.$session->id.'" alt="'.get_string('moreinfo', 'facetoface').'" title="'.get_string('moreinfo', 'facetoface').'">'.get_string('moreinfo', 'facetoface').'</a></span></td>'
                            .'</tr>'
                            .'<tr>'
                            .'<td><span style="font-size: 11px; font-weight: bold; line-height: 14px;"><a href="'.$CFG->wwwroot.'/mod/facetoface/attendees.php?s='.$session->id.'" alt="'.get_string('seeattendees', 'facetoface').'" title="'.get_string('seeattendees', 'facetoface').'">'.get_string('seeattendees', 'facetoface').'</a></span></td>'
                            .'</tr>'
                            .'<tr>'
                            .'<td><span style="font-size: 11px; font-weight: bold; line-height: 14px;"><a href="'.$CFG->wwwroot.'/mod/facetoface/signup.php?s='.$session->id.'&amp;cancelbooking=1" alt="'.get_string('cancelbooking', 'facetoface').'" title="'.get_string('cancelbooking', 'facetoface').'">'.get_string('cancelbooking', 'facetoface').'</a></span></td>'
                            .'</tr>'
                            .'<tr>'
                            .'<td><span style="font-size: 11px; font-weight: bold; line-height: 14px"><a href="'.$CFG->wwwroot.'/mod/facetoface/view.php?f='.$facetofaceid.'" alt="'.get_string('viewallsessions', 'facetoface').'" title="'.get_string('viewallsessions', 'facetoface').'">'.get_string('viewallsessions', 'facetoface').'</a></span></td>'
                            .'</tr>'
                            .'</table></td></tr>'
                            .'</table>';


                }

            } elseif ($sessions = facetoface_get_sessions($facetofaceid)) {

                if ($facetoface->display == 0) {

                    $table .= '<table border="0" cellpadding="1" cellspacing="0" width="100%">'
                            .'   <tr>'
                            .'       <td colspan="2"><span style="font-size: 11px; font-weight: bold; line-height: 14px;">'.get_string('signupforsession', 'facetoface').':</span></td>'
                            .'   </tr>';
                    $table .= '   <tr>'
                            .'     <td colspan="2"><span style="font-size: 11px; font-weight: bold; line-height: 14px"><a href="'.$CFG->wwwroot.'/mod/facetoface/view.php?f='.$facetofaceid.'" alt="'.get_string('viewallsessions', 'facetoface').'" title="'.get_string('viewallsessions', 'facetoface').'">'.get_string('viewallsessions', 'facetoface').'</a></span></td>'
                            .'   </tr>'
                            .'</table>';

                } else {

                    $table = '<table border="0" cellpadding="1" cellspacing="0" width="100%">'
                            .'   <tr>'
                            .'       <td colspan="2"><span style="font-size: 11px; font-weight: bold; line-height: 14px;">'.get_string('signupforsession', 'facetoface').':</span></td>'
                            .'   </tr>';

                    $i=0;

                    foreach($sessions as $session) {

                        if ($session->datetimeknown && (facetoface_has_session_started($session, $timenow))) {
                            continue;
                         }

                        $signupcount = facetoface_get_num_attendees($session->id);
                        if ($signupcount >= $session->capacity) continue;

                        $multiday = '';
                        if ($session->datetimeknown) {

                            if (empty($session->sessiondates)) {
                                $sessiondate = get_string('unknowndate', 'facetoface');
                                $sessiontime = get_string('unknowntime', 'facetoface');
                            } else {
                                $sessiondate = userdate($session->sessiondates[0]->timestart, get_string('strftimedate'));
                                $sessiontime = userdate($session->sessiondates[0]->timestart, get_string('strftimetime')).
                                    ' - '.userdate($session->sessiondates[0]->timefinish, get_string('strftimetime'));
                                if (count($session->sessiondates) > 1) {
                                    $multiday = ' ('.get_string('multiday', 'facetoface').')';
                                }
                            }

                        } else {

                            $sessiondate = get_string('wait-listed', 'facetoface');
                            $sessiontime = "";

                        }

                        if ($i == 0) {
                            $table .= '   <tr>';
                            $i++;
                        } else if ($i++ % 2 == 0) {
                            if ($i > $facetoface->display) {
                                break;
                            }
                            $table .= '   </tr>';
                            $table .= '   <tr>';
                        }
                        $table .= '      <td><span style="font-size: 11px; line-height: 14px;"><a href="'.$CFG->wwwroot.'/mod/facetoface/signup.php?s='.$session->id.'">'.$session->location.', '.$sessiondate.'<br />'.$sessiontime.$multiday.'</a></span></td>';
                    }
                    if ($i++ % 2 == 0) {
                        $table .= '<td><span style="font-size: 11px; line-height: 14px;">&nbsp;</span></td>';
                    }
                    $table .= '   </tr>'
                        .'   <tr>'
                        .'     <td colspan="2"><span style="font-size: 11px; font-weight: bold; line-height: 14px"><a href="'.$CFG->wwwroot.'/mod/facetoface/view.php?f='.$facetofaceid.'" alt="'.get_string('viewallsessions', 'facetoface').'" title="'.get_string('viewallsessions', 'facetoface').'">'.get_string('viewallsessions', 'facetoface').'</a></span></td>'
                        .'   </tr>'
                        .'</table>';
                }

            } else {

                if (has_capability('mod/facetoface:viewemptyactivities', $context)) {

                    $strdimmed = '';

                    if (!$coursemodule->visible) {
                        $strdimmed = ' class="dimmed"';
                    }

                    $table = '<img src="'.$CFG->wwwroot.'/mod/facetoface/icon.gif" class="activityicon" alt="'.get_string('facetoface', 'facetoface').'" /> <a title="'.get_string('facetoface', 'facetoface').'"'.$strdimmed.' href="'.$CFG->wwwroot.'/mod/facetoface/view.php?f='.$facetofaceid.'">'.get_string('facetoface','facetoface').'</a>';

                }

            }

        }

    } 

    return $table;
}

/**
 * Returns the ICAL data for a facetoface meeting.
 *
 * @param integer $method The method, @see {{MDL_F2F_INVITE}}
 * @return string Filename of the attachment in the temp directory
 */
function facetoface_get_ical_attachment($method, $facetoface, $session, $user) {
    global $CFG;

    // First, generate all the VEVENT blocks
    $VEVENTS = '';
    foreach ($session->sessiondates as $date) {
        // Date that this representation of the calendar information was created - 
        // we use the time the session was created
        // http://www.kanzaki.com/docs/ical/dtstamp.html
        $DTSTAMP = facetoface_ical_generate_timestamp($session->timecreated);

        // UIDs should be globally unique
        $urlbits = parse_url($CFG->wwwroot);
        $UID =
            $DTSTAMP .
            '-' . substr(md5($CFG->siteidentifier . $session->id . $date->id), -8) .   // Unique identifier, salted with site identifier
            '@' . $urlbits['host'];                                                    // Hostname for this moodle installation

        $DTSTART = facetoface_ical_generate_timestamp($date->timestart);
        $DTEND   = facetoface_ical_generate_timestamp($date->timefinish);

        // TODO: currently we are not sending updates if the times of the 
        // sesion are changed. This is not ideal!
        $SEQUENCE = ($method & MDL_F2F_CANCEL) ? 1 : 0;

        // TODO: escape these: must wrap at 75 octets and some characters must 
        // be backslash escaped
        $SUMMARY     = facetoface_ical_escape($facetoface->name);
        $DESCRIPTION = facetoface_ical_escape($session->details);

        // NOTE: Newlines are meant to be encoded with the literal sequence 
        // '\n'. But evolution presents a single line text field for location, 
        // and shows the newlines as [0x0A] junk. So we switch it for commas 
        // here. Remember commas need to be escaped too.
        $LOCATION    = str_replace('\n', '\, ', facetoface_ical_escape("{$session->room}\n{$session->venue}\n{$session->location}"));

        $ORGANISEREMAIL = get_config(NULL, 'facetoface_fromaddress');

        $ROLE = 'REQ-PARTICIPANT';
        $CANCELSTATUS = '';
        if ($method & MDL_F2F_CANCEL) {
            $ROLE = 'NON-PARTICIPANT';
            $CANCELSTATUS = "\nSTATUS:CANCELLED";
        }

        $icalmethod = ($method & MDL_F2F_INVITE) ? 'REQUEST' : 'CANCEL';

        // TODO: if the user has input their name in another language, we need 
        // to set the LANGUAGE property parameter here
        $USERNAME = fullname($user);
        $MAILTO   = $user->email;

        // The extra newline at the bottom is so multiple events start on their 
        // own lines. The very last one is trimmed outside the loop
        $VEVENTS .= <<<EOF
BEGIN:VEVENT
UID:{$UID}
DTSTAMP:{$DTSTAMP}
DTSTART:{$DTSTART}
DTEND:{$DTEND}
SEQUENCE:{$SEQUENCE}
SUMMARY:{$SUMMARY}
LOCATION:{$LOCATION}
DESCRIPTION:{$DESCRIPTION}
CLASS:PRIVATE
TRANSP:OPAQUE{$CANCELSTATUS}
ORGANIZER;CN={$ORGANISEREMAIL}:MAILTO:{$ORGANISEREMAIL}
ATTENDEE;CUTYPE=INDIVIDUAL;ROLE={$ROLE};PARTSTAT=NEEDS-ACTION;
 RSVP=FALSE;CN={$USERNAME};LANGUAGE=en:MAILTO:{$MAILTO}
END:VEVENT

EOF;
    }

    $VEVENTS = trim($VEVENTS);

    $template = <<<EOF
BEGIN:VCALENDAR
CALSCALE:GREGORIAN
PRODID:-//Moodle//NONSGML Facetoface//EN
VERSION:2.0
METHOD:{$icalmethod}
BEGIN:VTIMEZONE
TZID:/softwarestudio.org/Tzfile/Pacific/Auckland
X-LIC-LOCATION:Pacific/Auckland
BEGIN:STANDARD
TZNAME:NZST
DTSTART:19700405T020000
RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=1SU;BYMONTH=4
TZOFFSETFROM:+1300
TZOFFSETTO:+1200
END:STANDARD
BEGIN:DAYLIGHT
TZNAME:NZDT
DTSTART:19700928T030000
RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=-1SU;BYMONTH=9
TZOFFSETFROM:+1200
TZOFFSETTO:+1300
END:DAYLIGHT
END:VTIMEZONE
{$VEVENTS}
END:VCALENDAR
EOF;

    $tempfilename = md5($template);
    $tempfilepathname = $CFG->dataroot . '/' . $tempfilename;
    file_put_contents($tempfilepathname, $template);
    return $tempfilename;
}

function facetoface_ical_generate_timestamp($timestamp) {
    return gmdate('Ymd', $timestamp) . 'T' . gmdate('His', $timestamp) . 'Z';
}

/**
 * Escapes data of the text datatype in ICAL documents.
 *
 * See RFC2445 or http://www.kanzaki.com/docs/ical/text.html or a more readable definition
 */
function facetoface_ical_escape($text) {
    $text = str_replace(
        array('\\',   "\n", ';',  ','),
        array('\\\\', '\n', '\;', '\,'),
        $text
    );

    // Text should be wordwrapped at 75 octets, and there should be one 
    // whitespace after the newline that does the wrapping
    $text = wordwrap($text, 75, "\n ", true);

    return $text;
}

/**
 * Update grades by firing grade_updated event
 *
 * @param object $facetoface null means all facetoface activities
 * @param int $userid specific user only, 0 mean all (not used here)
 */
function facetoface_update_grades($facetoface=null, $userid=0) {

    if ($facetoface != null) {
            facetoface_grade_item_update($facetoface);
    }
    else {
        $sql = "SELECT f.*, cm.idnumber as cmidnumber
                  FROM {$CFG->prefix}facetoface f
                  JOIN {$CFG->prefix}course_modules cm ON cm.instance = f.id
                  JOIN {$CFG->prefix}modules m ON m.id = cm.module
                 WHERE m.name='facetoface'";
        if ($rs = get_recordset_sql($sql)) {
            while ($facetoface = rs_fetch_next_record($rs)) {
                facetoface_grade_item_update($facetoface);
            }
            rs_close($rs);
        }
    }
}

/**
 * Create grade item for given Face-to-face session
 *
 * @param int facetoface  Face-to-face activity (not the session) to grade
 * @param mixed grades    grades objects or 'reset' (means reset grades in gradebook)
 * @return int 0 if ok, error code otherwise
 */
function facetoface_grade_item_update($facetoface, $grades=NULL) {
    global $CFG;

    if (!isset($facetoface->cmidnumber)) {

        $sql = "SELECT cm.idnumber as cmidnumber
                  FROM {$CFG->prefix}course_modules cm
                  JOIN {$CFG->prefix}modules m ON m.id = cm.module
                 WHERE m.name='facetoface' AND cm.instance = $facetoface->id";
        $facetoface->cmidnumber = get_field_sql($sql);
    }

    $params = array('itemname'=>$facetoface->name,
                    'idnumber'=>$facetoface->cmidnumber);

    $params['gradetype'] = GRADE_TYPE_VALUE;
    $params['grademin']  = 0;
    $params['gradepass'] = 100;
    $params['grademax']  = 100;

    if ($grades  === 'reset') {
        $params['reset'] = true;
        $grades = NULL;
    }

    $retcode = grade_update('mod/facetoface', $facetoface->course, 'mod', 'facetoface',
                            $facetoface->id, 0, $grades, $params);
    return ($retcode === GRADE_UPDATE_OK);
}

/**
 * Delete grade item for given facetoface
 *
 * @param object $facetoface object
 * @return object facetoface
 */
function facetoface_grade_item_delete($facetoface) {
    $retcode = grade_update('mod/facetoface', $facetoface->course, 'mod', 'facetoface',
                            $facetoface->id, 0, NULL, array('deleted'=>1));
    return ($retcode === GRADE_UPDATE_OK);
}

/**
 * Return number of attendees signed up to a facetoface session
 *
 * @param integer $session_id
 * @return integer
 */
function facetoface_get_num_attendees($session_id) {
    return (int) count_records('facetoface_submissions', 'sessionid', $session_id, 'timecancelled', 0);
}

/**
 * Return all of a users' submissions to a facetoface
 *
 * @param integer $facetofaceid
 * @param integer $userid
 * @param boolean $includecancellations
 * @return array submissions | false No submissions
 */
function facetoface_get_user_submissions($facetofaceid, $userid, $includecancellations=false) {
    global $CFG;

    $whereclause = "facetoface=$facetofaceid AND userid=$userid";
    if (!$includecancellations) {
        $whereclause .= ' AND timecancelled=0';
    }

    return get_records_sql("SELECT *
                              FROM {$CFG->prefix}facetoface_submissions
                             WHERE $whereclause
                          ORDER BY timecreated");
}

/**
 * Cancel users' submission to a facetoface session
 *
 * @param integer $session_id
 * @param integer $user_id
 * @return boolean success
 */
function facetoface_user_cancel_submission($session_id, $user_id) {
    global $CFG;
    $timenow = time();
    return execute_sql("
            UPDATE
                {$CFG->prefix}facetoface_submissions
            SET
                timecancelled = $timenow,
                timemodified = $timenow
            WHERE
                sessionid = $session_id
                AND userid = $user_id
                AND timecancelled = 0
            ",
            false);
}

/**
 * A list of actions in the logs that indicate view activity for participants
 */
function facetoface_get_view_actions() {
    return array('view', 'view all');
}

/**
 * A list of actions in the logs that indicate post activity for participants
 */
function facetoface_get_post_actions() {
    return array('cancel booking', 'signup');
}

/**
 * Get list of users that signed up then cancelled a facetoface session
 *
 * @param integer $session_id
 * @return array users
 */
function facetoface_get_cancellations($session_id) {
    global $CFG;

    $records = get_records_sql("
        SELECT
            s.id AS submissionid,
            u.id,
            u.firstname,
            u.lastname,
            u.email,
            s.timecreated,
            s.timecancelled
        FROM
            {$CFG->prefix}facetoface_submissions s
        JOIN
            {$CFG->prefix}user u ON u.id = s.userid
        WHERE
            s.sessionid = $session_id
            AND s.timecancelled > 0
        ORDER BY
            u.lastname,
            u.firstname,
            s.timecancelled
    ");

    return $records;
}

/**
 * Get number of users that signed up then cancelled a facetoface session
 *
 * @param integer $session_id
 * @return interger
 */
function facetoface_get_num_cancellations($session_id) {
    return (int) count_records_select('facetoface_submissions', "sessionid = $session_id AND timecancelled >  0");
}

/**
 * Return a small object with summary information about what a user
 * has done with a given particular instance of this module (for user
 * activity reports.)
 *
 * $return->time = the time they did it
 * $return->info = a short text description
 */
function facetoface_user_outline($course, $user, $mod, $facetoface) {

    $result = new stdClass;

    $grade = facetoface_get_grade($user->id, $course->id, $facetoface->id);
    if ($grade->grade > 0) {
        $result = new stdClass;
        $result->info = get_string('grade') . ': ' . $grade->grade;
        $result->time = $grade->dategraded;
    }
    elseif ($submissions = facetoface_get_user_submissions($facetoface->id, $user->id)) {
        $result->info = get_string('usersignedup', 'facetoface');
        $result->time = reset($submissions)->timecreated;
    }
    else {
        $result->info = get_string('usernotsignedup', 'facetoface');
    }

    return $result;
}

/**
 * Print a detailed representation of what a user has done with a
 * given particular instance of this module (for user activity
 * reports).
 */
function facetoface_user_complete($course, $user, $mod, $facetoface) {

    $grade = facetoface_get_grade($user->id, $course->id, $facetoface->id);

    if ($submissions = facetoface_get_user_submissions($facetoface->id, $user->id, true)) {
        print get_string('grade').': '.$grade->grade . '<br />';
        if ($grade->dategraded > 0) {
            $timegraded = trim(userdate($grade->dategraded, get_string('strftimedatetime')));
            print '('.format_string($timegraded).')<br />';
        }
        print '<br />';

        foreach ($submissions as $submission) {
            $timesignedup = trim(userdate($submission->timecreated, get_string('strftimedatetime')));
            print get_string('usersignedupon', 'facetoface', format_string($timesignedup)) . '<br />';

            if ($submission->timecancelled > 0) {
                $timecancelled = userdate($submission->timecancelled, get_string('strftimedatetime'));
                print get_string('usercancelledon', 'facetoface', format_string($timecancelled)) . '<br />';
            }
        }
    }
    else {
        print get_string('usernotsignedup', 'facetoface');
    }

    return true;
}

/**
 * Add a link to the session to this user's Moodle calendar.
 *
 * @param class   $session     Record from the facetoface_sessions table
 * @param class   $eventname   Name to display for this event
 * @param integer $userid      ID of the user
 * @param string  $eventtype   Type of the event (booking or session)
 */
function facetoface_add_session_to_user_calendar($session, $eventname, $userid, $eventtype)
{
    global $CFG;

    if (!$session->datetimeknown) {
        // There is no date associated with this session, nothing needs to be done
        return true;
    }

    $detailsurl = $CFG->wwwroot . '/mod/facetoface/';
    $detailsurl .= ('session' == $eventtype) ? 'attendees' : 'signup';
    $detailsurl .= ".php?s=$session->id";

    $result = true;
    foreach ($session->sessiondates as $date) {
        $newevent = new object();
        $newevent->name = $eventname;
        $newevent->description = get_string("calendareventdescription$eventtype", 'facetoface', $detailsurl);
        $newevent->format = FORMAT_HTML;
        $newevent->courseid = 0; // Not a course event
        $newevent->groupid = 0;
        $newevent->userid = $userid;
        $newevent->instance = $session->facetoface;
        $newevent->modulename = 'facetoface';
        $newevent->eventtype = "facetoface$eventtype";
        $newevent->timestart = $date->timestart;
        $newevent->timeduration = $date->timefinish - $date->timestart;
        $newevent->visible = 1;
        $newevent->timemodified = time();

        $result = $result && insert_record('event', $newevent);
    }

    return $result;
}

/**
 * Remove all entries in the student's calendar which relate to this session.
 *
 * @param class $session    Record from the facetoface_sessions table
 * @param integer $userid   ID of the user
 */
function facetoface_remove_bookings_from_user_calendar($session, $userid)
{
    return delete_records_select('event', "modulename = 'facetoface' AND
                                           eventtype = 'facetofacebooking' AND
                                           instance = $session->facetoface AND
                                           userid = $userid");
}

/**
 * Update the date/time of events in the Moodle Calendar when a
 * session's dates are changed.
 *
 * @param class  $session    Record from the facetoface_sessions table
 * @param string $eventtype  Type of the event (booking or session)
 */
function facetoface_update_calendar_events($session, $eventtype)
{
    global $CFG;

    $whereclause = "modulename = 'facetoface' AND
                    eventtype = 'facetoface$eventtype' AND
                    instance = $session->facetoface";

    if ('session' == $eventtype) {
        $whereclause .= " AND description LIKE '%attendees.php?s=$session->id%'";
    }

    // Find all users with this session in their calendar
    $users = get_records_sql("SELECT DISTINCT userid
                                FROM {$CFG->prefix}event
                               WHERE $whereclause");

    $result = true;
    if ($users and count($users) > 0) {
        // Delete the existing events
        $result = $result && delete_records_select('event', $whereclause);

        // Add this session to these users' calendar
        $eventname = get_field('facetoface', 'name', 'id', $session->facetoface);
        foreach($users as $user) {
            $result = $result && facetoface_add_session_to_user_calendar($session, $eventname, $user->userid, $eventtype);
        }
    }

    return $result;
}

/**
 * @param string $feature FEATURE_xx constant for requested feature
 * @return bool True if module supports feature
 */
function facetoface_supports($feature) {
    switch($feature) {
        case FEATURE_GRADE_HAS_GRADE: return true;
        case FEATURE_COMPLETION_TRACKS_VIEWS: return true;
        default: return null;
    }
}

?>

<?php

require_once $CFG->libdir.'/gradelib.php';
require_once $CFG->dirroot.'/grade/lib.php';
require_once $CFG->dirroot.'/lib/adminlib.php';
if (file_exists($CFG->libdir.'/completionlib.php')) {
    require_once $CFG->libdir.'/completionlib.php';
}

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

// Name of the role which should be used to determine a users manager
define('MDL_MANAGER_ROLEID','manager');

// Custom field related constants
define('CUSTOMFIELD_DELIMITTER', ';');
define('CUSTOMFIELD_TYPE_TEXT',        0);
define('CUSTOMFIELD_TYPE_SELECT',      1);
define('CUSTOMFIELD_TYPE_MULTISELECT', 2);

// Calendar-related constants
define('CALENDAR_MAX_NAME_LENGTH', 15);

// Signup status codes (remember to update $MDL_F2F_STATUS)
define('MDL_F2F_STATUS_USER_CANCELLED',     10);
define('MDL_F2F_STATUS_SESSION_CANCELLED',  20);
define('MDL_F2F_STATUS_DECLINED',           30);
define('MDL_F2F_STATUS_REQUESTED',          40);
define('MDL_F2F_STATUS_APPROVED',           50);
define('MDL_F2F_STATUS_WAITLISTED',         60);
define('MDL_F2F_STATUS_BOOKED',             70);
define('MDL_F2F_STATUS_NO_SHOW',            80);
define('MDL_F2F_STATUS_PARTIALLY_ATTENDED', 90);
define('MDL_F2F_STATUS_FULLY_ATTENDED',     100);

// This array must match the status codes above, and the values
// must equal the end of the constant name but in lower case
global $MDL_F2F_STATUS;
$MDL_F2F_STATUS = array(
    MDL_F2F_STATUS_USER_CANCELLED       => 'user_cancelled',
    MDL_F2F_STATUS_SESSION_CANCELLED    => 'session_cancelled',
    MDL_F2F_STATUS_DECLINED             => 'declined',
    MDL_F2F_STATUS_REQUESTED            => 'requested',
    MDL_F2F_STATUS_APPROVED             => 'approved',
    MDL_F2F_STATUS_WAITLISTED           => 'waitlisted',
    MDL_F2F_STATUS_BOOKED               => 'booked',
    MDL_F2F_STATUS_NO_SHOW              => 'no_show',
    MDL_F2F_STATUS_PARTIALLY_ATTENDED   => 'partially_attended',
    MDL_F2F_STATUS_FULLY_ATTENDED       => 'fully_attended',
);

/**
 * Returns the human readable code for a face-to-face status
 *
 * @param int $statuscode One of the MDL_F2F_STATUS* constants
 * @return string Human readable code
 */
function facetoface_get_status($statuscode) {
    global $MDL_F2F_STATUS;
    // Check code exists
    if (!isset($MDL_F2F_STATUS[$statuscode])) {
        error('F2F status code does not exist: '.$statuscode);
    }

    // Get code
    $string = $MDL_F2F_STATUS[$statuscode];

    // Check to make sure the status array looks to be up-to-date
    if (constant('MDL_F2F_STATUS_'.strtoupper($string)) != $statuscode) {
        error('F2F status code array does not appear to be up-to-date: '.$statuscode);
    }

    return $string;
}

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
                               FROM {$CFG->prefix}facetoface_signups su,
                                    {$CFG->prefix}facetoface_sessions se
                              WHERE su.sessionid=$sessionid
                                AND su.userid=$userid
                                AND su.discountcode IS NOT NULL
                                AND su.sessionid = se.id") > 0) {
        return format_cost($sessiondata->discountcost, $htmloutput);
    } else {
        return format_cost($sessiondata->normalcost, $htmloutput);
    }
}

/**
 * Human-readable version of the duration field used to display it to
 * users
 *
 * @param   integer $duration duration in hours
 * @return  string
 */
function format_duration($duration) {

    // Default response
    $string = '';

    // Check for bad characters
    if (trim(preg_match('/[^0-9:\.\s]/', $duration))) {
        return $string;
    }

    $components = explode(':', $duration);

    if ($components and count($components) > 1) {
        // e.g. "1:30" => "1 hour and 30 minutes"
        $hours = round($components[0]);
        $minutes = round($components[1]);
    }
    else {
        // e.g. "1.5" => "1 hour and 30 minutes"
        $hours = floor($duration);
        $minutes = round(($duration - floor($duration)) * 60);
    }

    // Check if either minutes is out of bounds
    if ($minutes >= 60) {
        return $string;
    }

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

    if (!intval($minutes)) {
        return 0;
    }

    if ($minutes > 0) {
        $hours = floor($minutes / 60.0);
        $mins = $minutes - ($hours * 60.0);
        return "$hours:$mins";
    }
    else {
        return $minutes;
    }
}

/**
 * Converts hours to minutes
 */
function facetoface_hours_to_minutes($hours)
{
    $components = explode(':', $hours);
    if ($components and count($components) > 1) {
        // e.g. "1:45" => 105 minutes
        $hours = $components[0];
        $minutes = $components[1];
        return $hours * 60.0 + $minutes;
    }
    else {
        // e.g. "1.75" => 105 minutes
        return round($hours * 60.0);
    }
}

/**
 * Turn undefined manager messages into empty strings and deal with checkboxes
 */
function facetoface_fix_settings($facetoface) {

    if (empty($facetoface->emailmanagerconfirmation)) {
        $facetoface->confirmationinstrmngr = null;
    }
    if (empty($facetoface->emailmanagerreminder)) {
        $facetoface->reminderinstrmngr = null;
    }
    if (empty($facetoface->emailmanagercancellation)) {
        $facetoface->cancellationinstrmngr = null;
    }
    if (empty($facetoface->thirdpartywaitlist)) {
        $facetoface->thirdpartywaitlist = 0;
    }
    if (empty($facetoface->showoncalendar)) {
        $facetoface->showoncalendar = 0;
    }
    if (empty($facetoface->approvalreqd)) {
        $facetoface->approvalreqd = 0;
    }
}

/**
 * Given an object containing all the necessary data, (defined by the
 * form in mod.html) this function will create a new instance and
 * return the id number of the new instance.
 */
function facetoface_add_instance($facetoface) {

    $facetoface->timemodified = time();

    facetoface_fix_settings($facetoface);
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

    facetoface_fix_settings($facetoface);
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

    if (!delete_records_select(
        'facetoface_signups_status',
        "signupid IN
        (
            SELECT
                id
            FROM
                {$CFG->prefix}facetoface_signups
            WHERE
                sessionid IN
                (
                    SELECT
                        id
                    FROM
                        {$CFG->prefix}facetoface_sessions
                    WHERE
                        facetoface = {$facetoface->id}
                )
        )
        ")) {
        $result = false;
    }

    if (!delete_records_select('facetoface_signups', "sessionid IN (SELECT id FROM {$CFG->prefix}facetoface_sessions WHERE facetoface = {$facetoface->id})")) {
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

    if ($session->id = insert_record('facetoface_sessions', $session)) {
        if (empty($sessiondates)) {
            // Insert a dummy date record
            $date = new object();
            $date->sessionid = $session->id;
            $date->timestart = 0;
            $date->timefinish = 0;
            if (!insert_record('facetoface_sessions_dates', $date)) {
                rollback_sql();
                return false;
            }
        }
        else {
            foreach ($sessiondates as $date) {
                $date->sessionid = $session->id;
                if (!insert_record('facetoface_sessions_dates', $date)) {
                    rollback_sql();
                    return false;
                }
            }
        }

        // Put the sessions in this user's calendar
        // (i.e. we're assuming it's the teacher)
        $session->sessiondates = $sessiondates;
        facetoface_add_session_to_user_calendar($session, $eventname, $USER->id, 'session');

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

    if (!update_record('facetoface_sessions', $session)) {
        rollback_sql();
        return false;
    }

    if (!delete_records('facetoface_sessions_dates', 'sessionid', $session->id)) {
        rollback_sql();
        return false;
    }

    if (empty($sessiondates)) {
        // Insert a dummy date record
        $date = new object();
        $date->sessionid = $session->id;
        $date->timestart = 0;
        $date->timefinish = 0;
        if (!insert_record('facetoface_sessions_dates', $date)) {
            rollback_sql();
            return false;
        }
    }
    else {
        foreach ($sessiondates as $date) {
            $date->sessionid = $session->id;
            if (!insert_record('facetoface_sessions_dates', $date)) {
                rollback_sql();
                return false;
            }
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

    return facetoface_update_attendees($session);
}

/**
 * Update attendee list status' on booking size change
 */
function facetoface_update_attendees($session) {
    global $USER;

    // Get facetoface
    if (!$facetoface = get_record('facetoface', 'id', $session->facetoface)) {
        error('Could not load facetoface record');
    }

    // Get course
    if (!$course = get_record('course', 'id', $facetoface->course)) {
        error('Could not load course record');
    }

    // Update user status'
    $users = facetoface_get_attendees($session->id);

    if ($users) {
        // No/deleted session dates
        if (empty($session->datetimeknown)) {

            // Convert any bookings to waitlists
            foreach ($users as $user) {
                if ($user->statuscode == MDL_F2F_STATUS_BOOKED) {

                    if (!facetoface_user_signup($session, $facetoface, $course, $user->discountcode, $user->notificationtype, MDL_F2F_STATUS_WAITLISTED, $user->id)) {
                        rollback_sql();
                        return false;
                    }
                }
            }

        // Session dates exist
        } else {
            // Convert earliest signed up users to booked, and make the rest waitlisted
            $capacity = $session->capacity;

            // Count number of booked users
            $booked = 0;
            foreach ($users as $user) {
                if ($user->statuscode == MDL_F2F_STATUS_BOOKED) {
                    $booked++;
                }
            }

            // If booked less than capacity, book some new users
            if ($booked < $capacity) {
                foreach ($users as $user) {
                    if ($booked >= $capacity) {
                        break;
                    }

                    if ($user->statuscode == MDL_F2F_STATUS_WAITLISTED) {

                        if (!facetoface_user_signup($session, $facetoface, $course, $user->discountcode, $user->notificationtype, MDL_F2F_STATUS_BOOKED, $user->id)) {
                            rollback_sql();
                            return false;
                        }
                        $booked++;
                    }
                }
            }
        }
    }

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
 * @param object $session Record from facetoface_sessions
 */
function facetoface_delete_session($session)
{
    global $CFG;

    $facetoface = get_record('facetoface', 'id', $session->facetoface);

    // Cancel user signups (and notify users)
    $signedupusers = get_records_sql(
        "
            SELECT DISTINCT
                userid
            FROM
                {$CFG->prefix}facetoface_signups s
            LEFT JOIN
                {$CFG->prefix}facetoface_signups_status ss
             ON ss.signupid = s.id
            WHERE
                s.sessionid = $session->id
            AND ss.superceded = 0
            AND ss.statuscode >= ".MDL_F2F_STATUS_REQUESTED."
        "
    );

    if ($signedupusers and count($signedupusers) > 0) {
        foreach ($signedupusers as $user) {
            if (facetoface_user_cancel($session, $user->userid, true)) {
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

    // Remove entry from site-wide calendar
    facetoface_remove_session_from_site_calendar($session);

    // Remove entry from site-wide calendar
    facetoface_remove_session_from_site_calendar($session);

    // Delete session details
    if (!delete_records('facetoface_sessions', 'id', $session->id)) {
        rollback_sql();
        return false;
    }
    if (!delete_records('facetoface_sessions_dates', 'sessionid', $session->id)) {
        rollback_sql();
        return false;
    }

    if (!delete_records_select(
        'facetoface_signups_status',
        "signupid IN
        (
            SELECT
                id
            FROM
                {$CFG->prefix}facetoface_signups
            WHERE
                sessionid = {$session->id}
        )
        ")) {
        $result = false;
    }

    if (!delete_records('facetoface_signups', 'sessionid', $session->id)) {
        rollback_sql();
        return false;
    }

    commit_sql();
    return true;
}

/**
 * Subsitute the placeholders in email templates for the actual data
 */
function facetoface_email_substitutions($msg, $facetofacename, $reminderperiod, $user, $session, $sessionid)
{
    global $CFG;

    if (empty($msg)) {
        return '';
    }

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
    $msg = str_replace(get_string('placeholder:duration', 'facetoface'), format_duration($session->duration),$msg);
    if (empty($session->details)) {
        $msg = str_replace(get_string('placeholder:details', 'facetoface'), '',$msg);
    }
    else {
        $msg = str_replace(get_string('placeholder:details', 'facetoface'), html_to_text($session->details),$msg);
    }
    $msg = str_replace(get_string('placeholder:reminderperiod', 'facetoface'), $reminderperiod,$msg);

    // Replace more meta data
    $msg = str_replace(get_string('placeholder:attendeeslink', 'facetoface'), $CFG->wwwroot.'/mod/facetoface/attendees.php?s='.$session->id, $msg);

    // Custom session fields (they look like "session:shortname" in the templates)
    $customfields = facetoface_get_session_customfields();
    $customdata = get_records('facetoface_session_data', 'sessionid', $session->id, '', 'fieldid, data');
    foreach ($customfields as $field) {
        $placeholder = "[session:{$field->shortname}]";
        $data = '';
        if (!empty($customdata[$field->id])) {
            $data = $customdata[$field->id]->data;
        }

        $msg = str_replace($placeholder, $data, $msg);
    }

    return $msg;
}

/**
 * Function to be run periodically according to the moodle cron
 * Finds all facetoface notifications that have yet to be mailed out, and mails them.
 */
function facetoface_cron()
{
    global $CFG, $USER;

    $signupsdata = facetoface_get_unmailed_reminders();
    if (!$signupsdata) {
        echo "\n".get_string('noremindersneedtobesent', 'facetoface')."\n";
        return true;
    }

    $timenow = time();

    foreach ($signupsdata as $signupdata) {
        if (facetoface_has_session_started($signupdata, $timenow)) {
            // Too late, the session already started
            // Mark the reminder as being sent already
            $newsubmission = new object;
            $newsubmission->id = $signupdata->id;
            $newsubmission->mailedreminder = 1; // magic number to show that it was not actually sent
            if (!update_record('facetoface_signups', $newsubmission)) {
                echo "ERROR: could not update mailedreminder for submission ID $signupdata->id";
            }
            continue;
        }

        $earlieststarttime = $signupdata->sessiondates[0]->timestart;
        foreach ($signupdata->sessiondates as $date) {
            if ($date->timestart < $earlieststarttime) {
                $earlieststarttime = $date->timestart;
            }
        }

        $reminderperiod = $signupdata->reminderperiod;

        // Convert the period from business days (no weekends) to calendar days
        for ($reminderday = 0; $reminderday < $reminderperiod + 1; $reminderday++ ) {
            $reminderdaytime = $earlieststarttime - ($reminderday * 24 * 3600);
            $reminderdaycheck = userdate($reminderdaytime, '%u');
            if ($reminderdaycheck > 5) {
                // Saturdays and Sundays are not included in the
                // reminder period as entered by the user, extend
                // that period by 1
                $reminderperiod++;
            }
        }

        $remindertime = $earlieststarttime - ($reminderperiod * 24 * 3600);
        if ($timenow < $remindertime) {
            // Too early to send reminder
            continue;
        }

        if (!$user = get_record('user', 'id', $signupdata->userid)) {
            continue;
        }

        // Hack to make sure that the timezone and languages are set properly in emails
        // (i.e. it uses the language and timezone of the recipient of the email)
        $USER->lang = $user->lang;
        $USER->timezone = $user->timezone;

        if (!$course = get_record('course', 'id', $signupdata->course)) {
            continue;
        }
        if (!$facetoface = get_record('facetoface', 'id', $signupdata->facetofaceid)) {
            continue;
        }

        $postsubject = '';
        $posttext = '';
        $posttextmgrheading = '';

        if (empty($signupdata->mailedreminder)) {
            $postsubject = $facetoface->remindersubject;
            $posttext = $facetoface->remindermessage;
            $posttextmgrheading = $facetoface->reminderinstrmngr;
        }

        if (empty($posttext)) {
            // The reminder message is not set, don't send anything
            continue;
        }

        $postsubject = facetoface_email_substitutions($postsubject, $signupdata->facetofacename, $signupdata->reminderperiod,
                                                      $user, $signupdata, $signupdata->sessionid);
        $posttext = facetoface_email_substitutions($posttext, $signupdata->facetofacename, $signupdata->reminderperiod,
                                                   $user, $signupdata, $signupdata->sessionid);
        $posttextmgrheading = facetoface_email_substitutions($posttextmgrheading, $signupdata->facetofacename, $signupdata->reminderperiod,
                                                             $user, $signupdata, $signupdata->sessionid);

        $posthtml = ''; // FIXME
        $fromaddress = get_config(NULL, 'facetoface_fromaddress');
        if (!$fromaddress) {
            $fromaddress = '';
        }

        if (email_to_user($user, $fromaddress, $postsubject, $posttext, $posthtml)) {
            echo "\n".get_string('sentreminderuser', 'facetoface').": $user->firstname $user->lastname $user->email";

            $newsubmission = new object;
            $newsubmission->id = $signupdata->id;
            $newsubmission->mailedreminder = $timenow;
            if (!update_record('facetoface_signups', $newsubmission)) {
                echo "ERROR: could not update mailedreminder for submission ID $signupdata->id";
            }

            if (empty($posttextmgrheading)) {
                continue; // no manager message set
            }

            $managertext = $posttextmgrheading.$posttext;
            $manager = $user;
            $manager->email = facetoface_get_manageremail($user->id);

            if (empty($manager->email)) {
                continue; // don't know who the manager is
            }

            // Send email to mamager
            if (email_to_user($manager, $fromaddress, $postsubject, $managertext, $posthtml)) {
                echo "\n".get_string('sentremindermanager', 'facetoface').": $user->firstname $user->lastname $manager->email";
            }
            else {
                $errormsg = array();
                $errormsg['submissionid'] = $signupdata->id;
                $errormsg['userid'] = $user->id;
                $errormsg['manageremail'] = $manager->email;
                echo get_string('error:cronprefix', 'facetoface').' '.get_string('error:cannotemailmanager', 'facetoface', $errormsg)."\n";
            }
        }
        else {
            $errormsg = array();
            $errormsg['submissionid'] = $signupdata->id;
            $errormsg['userid'] = $user->id;
            $errormsg['useremail'] = $user->email;
            echo get_string('error:cronprefix', 'facetoface').' '.get_string('error:cannotemailuser', 'facetoface', $errormsg)."\n";
        }
    }

    print "\n";
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
 * Returns true if the session has started and has not yet finished.
 *
 * @param class $session record from the facetoface_sessions table
 * @param integer $timenow current time
 */
function facetoface_is_session_in_progress($session, $timenow) {
    if (!$session->datetimeknown) {
        return false;
    }
    foreach ($session->sessiondates as $date) {
        if ($date->timefinish > $timenow && $date->timestart < $timenow) {
            return true;
        }
    }
    return false;
}

/**
 * Get all of the dates for a given session
 */
function facetoface_get_session_dates($sessionid) {

    $ret = array();

    if ($dates = get_records('facetoface_sessions_dates', 'sessionid', $sessionid, 'timestart')) {
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
function facetoface_get_sessions($facetofaceid, $location='')
{
    global $CFG;

    $fromclause = "FROM {$CFG->prefix}facetoface_sessions s";
    $locationwhere = '';
    if (!empty($location)) {
        $fromclause = "FROM {$CFG->prefix}facetoface_session_data d
                       JOIN {$CFG->prefix}facetoface_sessions s ON s.id = d.sessionid";
        $locationwhere = " AND d.data = '$location'";
    }

    $sessions = get_records_sql("SELECT s.*
                                   $fromclause
                        LEFT OUTER JOIN (SELECT sessionid, min(timestart) AS mintimestart
                                           FROM {$CFG->prefix}facetoface_sessions_dates GROUP BY sessionid) m ON m.sessionid = s.id
                                  WHERE s.facetoface = $facetofaceid
                                        $locationwhere
                               ORDER BY s.datetimeknown, m.mintimestart");

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
function facetoface_get_attendees($sessionid)
{
    global $CFG;
    $records = get_records_sql("
        SELECT
            u.id,
            su.id AS submissionid,
            u.firstname,
            u.lastname,
            u.email,
            s.discountcost,
            su.discountcode,
            su.notificationtype,
            f.id AS facetofaceid,
            f.course,
            ss.grade,
            ss.statuscode,
            sign.timecreated
        FROM
            {$CFG->prefix}facetoface f
        JOIN
            {$CFG->prefix}facetoface_sessions s
         ON s.facetoface = f.id
        JOIN
            {$CFG->prefix}facetoface_signups su
         ON s.id = su.sessionid
        JOIN
            {$CFG->prefix}facetoface_signups_status ss
         ON su.id = ss.signupid
        LEFT JOIN
            (
            SELECT
                ss.signupid,
                MAX(ss.timecreated) AS timecreated
            FROM
                {$CFG->prefix}facetoface_signups_status ss
            INNER JOIN
                {$CFG->prefix}facetoface_signups s
             ON s.id = ss.signupid
            AND s.sessionid = $sessionid
            WHERE
                ss.statuscode IN (".MDL_F2F_STATUS_BOOKED.",".MDL_F2F_STATUS_WAITLISTED.")
            GROUP BY
                ss.signupid
            ) sign
         ON su.id = sign.signupid
        JOIN
            {$CFG->prefix}user u
         ON u.id = su.userid
        WHERE
            s.id = $sessionid
        AND ss.superceded != 1
        AND ss.statuscode >= ".MDL_F2F_STATUS_APPROVED."
        ORDER BY
            sign.timecreated ASC,
            ss.timecreated ASC
    ");

    return $records;
}

/**
 * Get a single attendee of a session
 */
function facetoface_get_attendee($sessionid, $userid)
{
    global $CFG;
    $record = get_record_sql("
        SELECT
            u.id,
            su.id AS submissionid,
            u.firstname,
            u.lastname,
            u.email,
            s.discountcost,
            su.discountcode,
            su.notificationtype,
            f.id AS facetofaceid,
            f.course,
            ss.grade,
            ss.statuscode
        FROM
            {$CFG->prefix}facetoface f
        JOIN
            {$CFG->prefix}facetoface_sessions s
         ON s.facetoface = f.id
        JOIN
            {$CFG->prefix}facetoface_signups su
         ON s.id = su.sessionid
        JOIN
            {$CFG->prefix}facetoface_signups_status ss
         ON su.id = ss.signupid
        JOIN
            {$CFG->prefix}user u
         ON u.id = su.userid
        WHERE
            s.id = $sessionid
        AND ss.superceded != 1
        AND u.id = $userid
    ");

    if (!$record) {
        return false;
    }

    return $record;
}
/**
 * Return all user fields to include in exports
 */
function facetoface_get_userfields()
{
    global $CFG;

    static $userfields = null;
    if (null == $userfields) {
        $userfields = array();

        if (function_exists('grade_export_user_fields')) {
            $fieldnames = grade_export_user_fields();
            foreach ($fieldnames as $key => $obj) {
                $userfields[$obj->shortname] = $obj->fullname;
            }
        }
        else {
            // Set default fields if the grade export patch is not
            // detected (see MDL-17346)
            $fieldnames = array('firstname', 'lastname', 'email', 'city',
                                'idnumber', 'institution', 'department', 'address');
            foreach ($fieldnames as $shortname) {
                $userfields[$shortname] = get_string($shortname);
            }
            $userfields['managersemail'] = get_string('manageremail', 'facetoface');
        }
    }

    return $userfields;
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

    $dateformat = 0;
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
        $dateformat =& $workbook->add_format();
        $dateformat->set_num_format('d mmm yy'); // TODO: use format specified in language pack
    }

    $workbook->send($downloadfilename);
    $worksheet =& $workbook->add_worksheet('attendance');

    facetoface_write_worksheet_header($worksheet);
    facetoface_write_activity_attendance($worksheet, 1, $facetofaceid, $location, '', '', $dateformat);

    $workbook->close();
    exit;
}

/**
 * Add the appropriate column headers to the given worksheet
 *
 * @param object $worksheet  The worksheet to modify (passed by reference)
 * @returns integer The index of the next column
 */
function facetoface_write_worksheet_header(&$worksheet)
{
    $pos=0;
    $customfields = facetoface_get_session_customfields();
    foreach ($customfields as $field) {
        if (!empty($field->showinsummary)) {
            $worksheet->write_string(0, $pos++, $field->name);
        }
    }
    $worksheet->write_string(0, $pos++, get_string('date', 'facetoface'));
    $worksheet->write_string(0, $pos++, get_string('timestart', 'facetoface'));
    $worksheet->write_string(0, $pos++, get_string('timefinish', 'facetoface'));
    $worksheet->write_string(0, $pos++, get_string('duration', 'facetoface'));
    $worksheet->write_string(0, $pos++, get_string('status', 'facetoface'));

    $trainerroles = facetoface_get_trainer_roles();
    foreach ($trainerroles as $role) {
        $worksheet->write_string(0, $pos++, get_string('role').': '.$role->name);
    }

    $userfields = facetoface_get_userfields();
    foreach ($userfields as $shortname => $fullname) {
        $worksheet->write_string(0, $pos++, $fullname);
    }

    $worksheet->write_string(0, $pos++, get_string('attendance', 'facetoface'));
    return $pos;
}

/**
 * Write in the worksheet the given facetoface attendance information
 * filtered by location.
 *
 * This function includes lots of custom SQL because it's otherwise
 * way too slow.
 *
 * @param object  $worksheet    Currently open worksheet
 * @param integer $startingrow  Index of the starting row (usually 1)
 * @param integer $facetofaceid ID of the facetoface activity
 * @param string  $location     Location to filter by
 * @param string  $coursename   Name of the course (optional)
 * @param string  $activityname Name of the facetoface activity (optional)
 * @param object  $dateformat   Use to write out dates in the spreadsheet
 * @returns integer Index of the last row written
 */
function facetoface_write_activity_attendance(&$worksheet, $startingrow, $facetofaceid, $location,
                                              $coursename, $activityname, $dateformat)
{
    global $CFG;

    $trainerroles = facetoface_get_trainer_roles();
    $userfields = facetoface_get_userfields();
    $customsessionfields = facetoface_get_session_customfields();
    $timenow = time();
    $i = $startingrow;

    $locationcondition = '';
    if (!empty($location)) {
        $locationcondition = "AND s.location='$location'";
    }

    // Fast version of "facetoface_get_attendees()" for all sessions
    $sessionsignups = array();
    $signups = get_records_sql("
        SELECT
            su.id AS submissionid,
            s.id AS sessionid,
            u.*,
            f.course AS courseid,
            ss.grade,
            sign.timecreated
        FROM
            {$CFG->prefix}facetoface f
        JOIN
            {$CFG->prefix}facetoface_sessions s
         ON s.facetoface = f.id
        JOIN
            {$CFG->prefix}facetoface_signups su
         ON s.id = su.sessionid
        JOIN
            {$CFG->prefix}facetoface_signups_status ss
         ON su.id = ss.signupid
        LEFT JOIN
            (
            SELECT
                ss.signupid,
                MAX(ss.timecreated) AS timecreated
            FROM
                {$CFG->prefix}facetoface_signups_status ss
            INNER JOIN
                {$CFG->prefix}facetoface_signups s
             ON s.id = ss.signupid
            INNER JOIN
                {$CFG->prefix}facetoface_sessions se
             ON s.sessionid = se.id
            AND se.facetoface = $facetofaceid
            WHERE
                ss.statuscode IN (".MDL_F2F_STATUS_BOOKED.",".MDL_F2F_STATUS_WAITLISTED.")
            GROUP BY
                ss.signupid
            ) sign
         ON su.id = sign.signupid
        JOIN
            {$CFG->prefix}user u
         ON u.id = su.userid
        WHERE
            f.id = $facetofaceid
        AND ss.superceded != 1
        AND ss.statuscode >= ".MDL_F2F_STATUS_APPROVED."
        ORDER BY
            s.id, u.firstname, u.lastname
    ");

    if ($signups) {
        // Get all grades at once
        $userids = array();
        foreach ($signups as $signup) {
            if ($signup->id > 0) {
                $userids[] = $signup->id;
            }
        }
        $grading_info = grade_get_grades(reset($signups)->courseid, 'mod', 'facetoface',
                                         $facetofaceid, $userids);

        foreach ($signups as $signup) {
            $userid = $signup->id;

            if ($customuserfields = facetoface_get_user_customfields($userid, $userfields)) {
                foreach ($customuserfields as $fieldname => $value) {
                    if (!isset($signup->$fieldname)) {
                        $signup->$fieldname = $value;
                    }
                }
            }

            // Set grade
            if (!empty($grading_info->items) and !empty($grading_info->items[0]->grades[$userid])) {
                $signup->grade = $grading_info->items[0]->grades[$userid]->str_grade;
            }

            $sessionsignups[$signup->sessionid][$signup->id] = $signup;
        }
    }

    // Fast version of "facetoface_get_sessions($facetofaceid, $location)"
    $sql = "SELECT s.id, s.datetimeknown, s.capacity,
                   s.duration, d.timestart, d.timefinish
              FROM {$CFG->prefix}facetoface_sessions s
              JOIN {$CFG->prefix}facetoface_sessions_dates d ON s.id = d.sessionid
             WHERE s.facetoface=$facetofaceid AND d.sessionid = s.id
                   $locationcondition
          ORDER BY s.datetimeknown, d.timestart";

    if ($sessions = get_records_sql($sql)) {
        $i = $i - 1; // will be incremented BEFORE each row is written

        foreach ($sessions as $session) {
            $customdata = get_records('facetoface_session_data', 'sessionid', $session->id, '', 'fieldid, data');

            $sessiondate = false;
            $starttime   = get_string('wait-listed', 'facetoface');
            $finishtime  = get_string('wait-listed', 'facetoface');
            $status      = get_string('wait-listed', 'facetoface');

            $sessiontrainers = facetoface_get_trainers($session->id);

            if ($session->datetimeknown) {
                // Display only the first date
                if (method_exists($worksheet, 'write_date')) {
                    // Needs the patch in MDL-20781
                    $sessiondate = (int)$session->timestart;
                }
                else {
                    $sessiondate = userdate($session->timestart, get_string('strftimedate'));
                }
                $starttime   = userdate($session->timestart, get_string('strftimetime'));
                $finishtime  = userdate($session->timefinish, get_string('strftimetime'));

                if ($session->timestart < $timenow) {
                    $status = get_string('sessionover', 'facetoface');
                }
                else {
                    $signupcount = 0;
                    if (!empty($sessionsignups[$session->id])) {
                        $signupcount = count($sessionsignups[$session->id]);
                    }

                    if ($signupcount >= $session->capacity) {
                        $status = get_string('bookingfull', 'facetoface');
                    } else {
                        $status = get_string('bookingopen', 'facetoface');
                    }
                }
            }

            if (!empty($sessionsignups[$session->id])) {
                foreach ($sessionsignups[$session->id] as $attendee) {
                    $i++; $j=0;

                    // Custom session fields
                    foreach ($customsessionfields as $field) {
                        if (empty($field->showinsummary)) {
                            continue; // skip
                        }

                        $data = '-';
                        if (!empty($customdata[$field->id])) {
                            $data = $customdata[$field->id]->data;
                        }
                        $worksheet->write_string($i, $j++, $data);
                    }

                    if (empty($sessiondate)) {
                        $worksheet->write_string($i, $j++, $status); // session date
                    }
                    else {
                        if (method_exists($worksheet, 'write_date')) {
                            $worksheet->write_date($i, $j++, $sessiondate, $dateformat);
                        }
                        else {
                            $worksheet->write_string($i, $j++, $sessiondate);
                        }
                    }
                    $worksheet->write_string($i,$j++,$starttime);
                    $worksheet->write_string($i,$j++,$finishtime);
                    $worksheet->write_number($i,$j++,(int)$session->duration);
                    $worksheet->write_string($i,$j++,$status);

                    foreach (array_keys($trainerroles) as $roleid) {
                        if (!empty($sessiontrainers[$roleid])) {
                            $trainers = array();
                            foreach ($sessiontrainers[$roleid] as $trainer) {
                                $trainers[] = fullname($trainer);
                            }

                            $trainers = implode(', ', $trainers);
                        }
                        else {
                            $trainers = '-';
                        }

                        $worksheet->write_string($i, $j++, $trainers);
                    }

                    foreach ($userfields as $shortname => $fullname) {
                        $value = '-';
                        if (!empty($attendee->$shortname)) {
                            $value = $attendee->$shortname;
                        }

                        if ('firstaccess' == $shortname or 'lastaccess' == $shortname or
                            'lastlogin' == $shortname or 'currentlogin' == $shortname) {

                            if (method_exists($worksheet, 'write_date')) {
                                $worksheet->write_date($i, $j++, (int)$value, $dateformat);
                            }
                            else {
                                $worksheet->write_string($i, $j++, userdate($value, get_string('strftimedate')));
                            }
                        }
                        else {
                            $worksheet->write_string($i,$j++,$value);
                        }
                    }
                    $worksheet->write_string($i,$j++,$attendee->grade);

                    if (method_exists($worksheet,'write_date')) {
                        $worksheet->write_date($i, $j++, (int)$attendee->timecreated, $dateformat);
                    } else {
                        $signupdate = userdate($attendee->timecreated, get_string('strftimedatetime'));
                        if (empty($signupdate)){
                            $signupdate = '-';
                        }
                        $worksheet->write_string($i,$j++, $signupdate);
                    }

                    if (!empty($coursename)) {
                        $worksheet->write_string($i, $j++, $coursename);
                    }
                    if (!empty($activityname)) {
                        $worksheet->write_string($i, $j++, $activityname);
                    }
                }
            }
            else {
                // no one is sign-up, so let's just print the basic info
                $i++; $j=0;

                // Custom session fields
                foreach ($customsessionfields as $field) {
                    if (empty($field->showinsummary)) {
                        continue; // skip
                    }

                    $data = '-';
                    if (!empty($customdata[$field->id])) {
                        $data = $customdata[$field->id]->data;
                    }
                    $worksheet->write_string($i, $j++, $data);
                }

                if (empty($sessiondate)) {
                    $worksheet->write_string($i, $j++, $status); // session date
                }
                else {
                    if (method_exists($worksheet, 'write_date')) {
                        $worksheet->write_date($i, $j++, $sessiondate, $dateformat);
                    }
                    else {
                        $worksheet->write_string($i, $j++, $sessiondate);
                    }
                }
                $worksheet->write_string($i,$j++,$starttime);
                $worksheet->write_string($i,$j++,$finishtime);
                $worksheet->write_number($i,$j++,(int)$session->duration);
                $worksheet->write_string($i,$j++,$status);
                foreach ($userfields as $unused) {
                    $worksheet->write_string($i,$j++,'-');
                }
                $worksheet->write_string($i,$j++,'-');

                if (!empty($coursename)) {
                    $worksheet->write_string($i, $j++, $coursename);
                }
                if (!empty($activityname)) {
                    $worksheet->write_string($i, $j++, $activityname);
                }
            }
        }
    }

    return $i;
}

/**
 * Return an object with all values for a user's custom fields.
 *
 * This is about 15 times faster than the custom field API.
 *
 * @param array $fieldstoinclude Limit the fields returned/cached to these ones (optional)
 */
function facetoface_get_user_customfields($userid, $fieldstoinclude=false)
{
    global $CFG;

    // Cache all lookup
    static $customfields = null;
    if (null == $customfields) {
        $customfields = array();
    }

    if (!empty($customfields[$userid])) {
        return $customfields[$userid];
    }

    $ret = new object();

    $sql = "SELECT if.shortname, id.data
              FROM {$CFG->prefix}user_info_field if
              JOIN {$CFG->prefix}user_info_data id ON id.fieldid = if.id
             WHERE id.userid = $userid";
    if ($customfields = get_records_sql($sql)) {
        foreach ($customfields as $field) {
            $fieldname = $field->shortname;
            if (false === $fieldstoinclude or !empty($fieldstoinclude[$fieldname])) {
                $ret->$fieldname = $field->data;
            }
        }
    }

    $customfields[$userid] = $ret;
    return $ret;
}

/**
 * Return list of marked submissions that have not been mailed out for currently enrolled students
 */
function facetoface_get_unmailed_reminders()
{
    global $CFG;

    $submissions = get_records_sql("
        SELECT
            su.*,
            f.course,
            f.id as facetofaceid,
            f.name as facetofacename,
            f.reminderperiod,
            se.duration,
            se.normalcost,
            se.discountcost,
            se.details,
            se.datetimeknown
        FROM
            {$CFG->prefix}facetoface_signups su
        INNER JOIN
            {$CFG->prefix}facetoface_signups_status sus
         ON su.id = sus.signupid
        AND sus.superceded = 0
        AND sus.statuscode = ".MDL_F2F_STATUS_BOOKED."
        JOIN
            {$CFG->prefix}facetoface_sessions se
         ON su.sessionid = se.id
        JOIN
            {$CFG->prefix}facetoface f
         ON se.facetoface = f.id
        WHERE
            su.mailedreminder = 0
        AND se.datetimeknown = 1
    ");

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
 * @param integer $statuscode Status code to set
 * @param integer $userid user to signup
 * @param bool $notifyuser whether or not to send an email confirmation
 * @param bool $displayerrors whether or not to return an error page on errors
 */
function facetoface_user_signup($session, $facetoface, $course, $discountcode,
                                $notificationtype, $statuscode, $userid = false,
                                $notifyuser = true) {

    global $CFG;

    // Get user id
    if (!$userid) {
        global $USER;
        $userid = $USER->id;
    }

    $return = false;
    $timenow = time();

    // Check to see if a signup already exists
    if ($existingsignup = get_record('facetoface_signups', 'sessionid', $session->id, 'userid', $userid)) {
        $usersignup = $existingsignup;
    } else {
        // Otherwise, prepare a signup object
        $usersignup = new stdclass;
        $usersignup->sessionid = $session->id;
        $usersignup->userid = $userid;
    }

    $usersignup->mailedreminder = 0;
    $usersignup->notificationtype = $notificationtype;

    $usersignup->discountcode = trim(strtoupper($discountcode));
    if (empty($usersignup->discountcode)) {
        $usersignup->discountcode = null;
    }

    begin_sql();

    // Update/insert the signup record
    if (!empty($usersignup->id)) {
        $success = update_record('facetoface_signups', $usersignup);
    } else {
        $usersignup->id = insert_record('facetoface_signups', $usersignup);
        $success = (bool)$usersignup->id;
    }

    if (!$success) {
        rollback_sql();
        error('Could not update face-to-face signup record in database');
        return false;
    }

    // Work out which status to use

    // If approval not required
    if (!$facetoface->approvalreqd) {
        $new_status = $statuscode;
    } else {
        // If approval required

        // Get current status (if any)
        $current_status = get_field('facetoface_signups_status', 'statuscode', 'signupid', $usersignup->id, 'superceded', 0);

        // If approved, then no problem
        if ($current_status == MDL_F2F_STATUS_APPROVED) {
            $new_status = $statuscode;
        } else {
        // Otherwise, send manager request
            $new_status = MDL_F2F_STATUS_REQUESTED;
        }
    }

    // Update status
    if (!facetoface_update_signup_status($usersignup->id, $new_status, $userid)) {
        rollback_sql();
        error('Face-to-face failed to update the user\'s status');
        return false;
    }

    // Add to calendar
    if (in_array($new_status, array(MDL_F2F_STATUS_BOOKED, MDL_F2F_STATUS_WAITLISTED))) {
        facetoface_add_session_to_user_calendar($session, addslashes($facetoface->name), $userid, 'booking');
    }

    // If session has already started, do not send a notification
    if (facetoface_has_session_started($session, $timenow)) {
        $notifyuser = false;
    }

    // Send notification
    if ($notifyuser) {
        // If booked/waitlisted
        switch ($new_status) {
            case MDL_F2F_STATUS_BOOKED:
                $error = facetoface_send_confirmation_notice($facetoface, $session, $userid, $notificationtype, false);
                break;

            case MDL_F2F_STATUS_WAITLISTED:
                $error = facetoface_send_confirmation_notice($facetoface, $session, $userid, $notificationtype, true);
                break;

            case MDL_F2F_STATUS_REQUESTED:
                $error = facetoface_send_request_notice($facetoface, $session, $userid);
                break;
        }

        if (!empty($error)) {
            rollback_sql();
            error($error);
            return false;
        }

        if (!update_record('facetoface_signups', $usersignup)) {
            rollback_sql();
            error('Face-to-face failed to update the user\'s signup');
            return false;
        }
    }

    // Course completion
    if (in_array($new_status, array(MDL_F2F_STATUS_BOOKED, MDL_F2F_STATUS_WAITLISTED))) {

        if ($CFG->enablecompletion && $course->enablecompletion) {

            $ccdetails = array(
                'course'        => $course->id,
                'userid'        => $userid,
            );

            $cc = new completion_completion($ccdetails);
            $cc->mark_inprogress($timenow);
        }
    }

    commit_sql();

    // Send notification again - this time using Totara not/rem
    if ($notifyuser) {
        // If booked/waitlisted/approval
        $error = facetoface_send_notrem($facetoface, $session, $userid, $new_status);
    }

    return true;
}


/**
 * Send Totara notificaiton/reminder
 *
 * @param   object  $facetoface Facetoface instance
 * @param   object  $session    Session instance
 * @param   int     $userid     ID of user requesting booking
 * @param   int     $nottype    notification type
 * @return  string  Error string, empty on success
 */
function facetoface_send_notrem($facetoface, $session, $userid, $nottype) {
    global $CFG, $USER;

    require_once($CFG->dirroot.'/local/totara_msg/messagelib.php');

    $newevent = new stdClass();
    $newevent->userfrom         = NULL;
    $user = get_record('user', 'id', $userid);
    $userfrom_link = $CFG->wwwroot.'/user/view.php?id='.$userid;
    $fromname = fullname($user);
    $usermsg = "<a href=\"{$userfrom_link}\" title=\"$fromname\">$fromname</a> ";
    $newevent->userto           = $user;
    $newevent->userfrom         = $USER;
    $newevent->roleid           = get_field('role', 'id', 'shortname', 'student');
    $url = $CFG->wwwroot.'/mod/facetoface/view.php?f='.$facetoface->id;
    switch ($nottype) {
        case MDL_F2F_STATUS_BOOKED:
            $newevent->fullmessage      = facetoface_email_substitutions(
                                                        $facetoface->confirmationmessage,
                                                        $facetoface->name,
                                                        $facetoface->reminderperiod,
                                                        $user,
                                                        $session,
                                                        $session->id
                                                );
            $newevent->subject          = 'Booked for session <a href="'.$url.'">'.$facetoface->name.'</a>';
            $newevent->urgency          = TOTARA_MSG_URGENCY_NORMAL;
            tm_notification_send($newevent);
            break;

        case MDL_F2F_STATUS_WAITLISTED:
            $newevent->fullmessage      = facetoface_email_substitutions(
                                                        $facetoface->waitlistedmessage,
                                                        $facetoface->name,
                                                        $facetoface->reminderperiod,
                                                        $user,
                                                        $session,
                                                        $session->id
                                                );
            $newevent->subject          = 'Waitlisted for session <a href="'.$url.'">'.$facetoface->name.'</a>';
            $newevent->urgency          = TOTARA_MSG_URGENCY_NORMAL;
            tm_notification_send($newevent);
            break;

        case MDL_F2F_STATUS_USER_CANCELLED:
            $newevent->subject          = 'Cancelled for session <a href="'.$url.'">'.$facetoface->name.'</a>';
            $newevent->fullmessage      = $newevent->subject;
            $newevent->urgency          = TOTARA_MSG_URGENCY_NORMAL;
            tm_notification_send($newevent);
            $managerid = facetoface_get_manager($userid);
            if ($managerid !== false) {
                $user = get_record('user', 'id', $managerid);
                $newevent->roleid           = get_field('role', 'id', 'shortname', 'manager');
                $newevent->userto           = $user;
                $newevent->subject          = 'Cancelled for '.$usermsg.' session <a href="'.$url.'">'.$facetoface->name.'</a>';
                $newevent->fullmessage      = $newevent->subject;
                tm_notification_send($newevent);
            }
            break;

        case MDL_F2F_STATUS_REQUESTED:
            $managerid = facetoface_get_manager($userid);
            if ($managerid !== false) {
                $user = get_record('user', 'id', $managerid);
                $newevent->roleid           = get_field('role', 'id', 'shortname', 'manager');
                $newevent->userto           = $user;
                $newevent->fullmessage      = facetoface_email_substitutions(
                                                        $facetoface->requestinstrmngr,
                                                        $facetoface->name,
                                                        $facetoface->reminderperiod,
                                                        $user,
                                                        $session,
                                                        $session->id
                                                );
                $newevent->subject          = 'Request for '.$usermsg.'to attend session <a href="'.$CFG->wwwroot.'/mod/facetoface/attendees.php?s='.$session->id.'">'.$facetoface->name.'</a>';
                // do the facetoface workflow event
                $onaccept = new stdClass();
                $onaccept->action = 'facetoface';
                $onaccept->text = 'To approve session registration, press accept';
                $onaccept->data = array('userid' => $userid, 'session' => $session, 'facetoface' => $facetoface);
                $newevent->onaccept = $onaccept;
                $onreject = new stdClass();
                $onreject->action = 'facetoface';
                $onreject->text = 'To reject session registration press reject';
                $onreject->data = array('userid' => $userid, 'session' => $session, 'facetoface' => $facetoface);
                $newevent->onreject = $onreject;
                tm_reminder_send($newevent);
                $newevent = new stdClass();
                $newevent->userfrom         = NULL;
                $user = get_record('user', 'id', $userid);
                $newevent->userto           = $user;
                $newevent->roleid           = get_field('role', 'id', 'shortname', 'student');
                $newevent->subject          = 'Request to attend session <a href="'.$CFG->wwwroot.'/mod/facetoface/view.php?f='.$facetoface->id.'">'.$facetoface->name.'</a> sent to manager';
                $newevent->fullmessage      = $newevent->subject;
                $newevent->urgency          = TOTARA_MSG_URGENCY_NORMAL;
                tm_notification_send($newevent);
            }
            break;
    }

    return true;
}


/**
 * Return the id of the user's manager if it is
 * defined. Otherwise return false.
 *
 * @param integer $userid User ID of the staff member
 */
function facetoface_get_manager($userid) {
    global $CFG;
    $roleid = get_field('role','id','shortname',MDL_MANAGER_ROLEID);

    if ($roleid) {
        $sql = "SELECT ra.userid AS managerid
            FROM {$CFG->prefix}pos_assignment pa
            LEFT JOIN {$CFG->prefix}role_assignments ra ON pa.reportstoid=ra.id
            WHERE pa.userid=$userid AND ra.roleid=$roleid AND pa.type=1"; // just use primary position for now
        $res = get_record_sql($sql);
        if($res && isset($res->managerid)) {
            return $res->managerid;
        } else {
            return false; // No manager set
        }
    }
    else {
        return false; // No manager role, can't do it
    }
}

/**
 * Send booking request notice to user and their manager
 *
 * @param   object  $facetoface Facetoface instance
 * @param   object  $session    Session instance
 * @param   int     $userid     ID of user requesting booking
 * @return  string  Error string, empty on success
 */
function facetoface_send_request_notice($facetoface, $session, $userid) {

    if (!$manageremail = facetoface_get_manageremail($userid)) {
        return get_string('error:nomanagersemailset', 'facetoface');
    }

    $user = get_record('user', 'id', $userid);
    if (!$user) {
        return get_string('error:invaliduserid', 'facetoface');
    }

    $fromaddress = get_config(NULL, 'facetoface_fromaddress');
    if (!$fromaddress) {
        $fromaddress = '';
    }

    $postsubject = facetoface_email_substitutions(
            $facetoface->requestsubject,
            $facetoface->name,
            $facetoface->reminderperiod,
            $user,
            $session,
            $session->id
    );

    $posttext = facetoface_email_substitutions(
            $facetoface->requestmessage,
            $facetoface->name,
            $facetoface->reminderperiod,
            $user,
            $session,
            $session->id
    );

    $posttextmgrheading = facetoface_email_substitutions(
            $facetoface->requestinstrmngr,
            $facetoface->name,
            $facetoface->reminderperiod,
            $user,
            $session,
            $session->id
    );

    // Send to user
    if (!email_to_user($user, $fromaddress, $postsubject, $posttext)) {
        return get_string('error:cannotsendrequestuser', 'facetoface');
    }

    // Send to manager
    $user->email = $manageremail;

    if (!email_to_user($user, $fromaddress, $postsubject, $posttextmgrheading.$posttext)) {
        return get_string('error:cannotsendrequestmanager', 'facetoface');
    }

    return '';
}


/**
 * Update the signup status of a particular signup
 *
 * @param integer $signupid ID of the signup to be updated
 * @param integer $statuscode Status code to be updated to
 * @param integer $createdby User ID of the user causing the status update
 * @param string $note Cancellation reason or other notes
 * @param int $grade Grade
 *
 * @returns integer ID of newly created signup status, or false
 *
 */
function facetoface_update_signup_status($signupid, $statuscode, $createdby, $note='', $grade=NULL) {
    $timenow = time();

    $signupstatus = new stdclass;
    $signupstatus->signupid = $signupid;
    $signupstatus->statuscode = $statuscode;
    $signupstatus->createdby = $createdby;
    $signupstatus->timecreated = $timenow;
    $signupstatus->note = $note;
    $signupstatus->grade = $grade;
    $signupstatus->superceded = 0;
    $signupstatus->mailed = 0;

    begin_sql();
    if ($statusid = insert_record('facetoface_signups_status', $signupstatus)) {
        // mark any previous signup_statuses as superceded
        $where = "signupid = $signupid AND ( superceded = 0 OR superceded IS NULL ) AND id != $statusid";
        if(set_field_select('facetoface_signups_status', 'superceded', 1, $where)) {
            commit_sql();
            return $statusid;
        } else {
            rollback_sql();
            return false;
        }
    } else {
        rollback_sql();
        return false;
    }
}

/**
 * Cancel a user who signed up earlier
 *
 * @param class $session       Record from the facetoface_sessions table
 * @param integer $userid      ID of the user to remove from the session
 * @param bool $forcecancel    Forces cancellation of sessions that have already occurred
 * @param string $errorstr     Passed by reference. For setting error string in calling function
 * @param string $cancelreason Optional justification for cancelling the signup
 */
function facetoface_user_cancel($session, $userid=false, $forcecancel=false, &$errorstr=null, $cancelreason='')
{
    if (!$userid) {
        global $USER;
        $userid = $USER->id;
    }

    // if $forcecancel is set, cancel session even if already occurred
    // used by facetotoface_delete_session()
    if (!$forcecancel) {
        $timenow = time();
        // don't allow user to cancel a session that has already occurred
        if (facetoface_has_session_started($session, $timenow)) {
            $errorstr = get_string('error:eventoccurred', 'facetoface');
            return false;
        }
    }

    if (facetoface_user_cancel_submission($session->id, $userid, $cancelreason)) {
        facetoface_remove_bookings_from_user_calendar($session, $userid);

        facetoface_update_attendees($session);

        return true;
    }

    $errorstr = get_string('error:cancelbooking', 'facetoface');
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
            $htmlbody = ''; // FIXME
            $icalattachments[] = array('filename' => $filename, 'subject' => $subject,
                                       'body' => $body, 'htmlbody' => $htmlbody);
        }
    }

    // Fill-in the email placeholders
    $postsubject = facetoface_email_substitutions($postsubject, $facetoface->name, $facetoface->reminderperiod,
                                                  $user, $session, $session->id);
    $posttext = facetoface_email_substitutions($posttext, $facetoface->name, $facetoface->reminderperiod,
                                               $user, $session, $session->id);

    $posttextmgrheading = facetoface_email_substitutions($posttextmgrheading, $facetoface->name, $facetoface->reminderperiod,
                                                         $user, $session, $session->id);

    $posthtml = ''; // FIXME
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
        $recipients = explode(',', $facetoface->thirdparty);
        foreach ($recipients as $recipient) {
            $thirdparty->email = trim($recipient);

            // Leave out the ical attachments in the 3rd parties notification
            if (!email_to_user($thirdparty, $fromaddress, $postsubject, $posttext, $posthtml)) {
                return get_string('error:cannotsendconfirmationthirdparty', 'facetoface');
            }
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
 * @param boolean $iswaitlisted If the user has been waitlisted
 * @returns string Error message (or empty string if successful)
 */
function facetoface_send_confirmation_notice($facetoface, $session, $userid, $notificationtype, $iswaitlisted) {

    $posttextmgrheading = $facetoface->confirmationinstrmngr;

    if (!$iswaitlisted) {
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
    $notificationtype = get_field('facetoface_signups', 'notificationtype',
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
 * @returns integer The session id that we signed up for, false otherwise
 */
function facetoface_check_signup($facetofaceid) {

    global $USER;

    if ($submissions = facetoface_get_user_submissions($facetofaceid, $USER->id)) {
        return reset($submissions)->sessionid;
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
    global $CFG;
    $roleid = get_field('role','id','shortname',MDL_MANAGER_ROLEID);

    if ($roleid) {
        $sql = "SELECT ra.userid AS managerid
            FROM {$CFG->prefix}pos_assignment pa
            LEFT JOIN {$CFG->prefix}role_assignments ra ON pa.reportstoid=ra.id
            WHERE pa.userid=$userid AND ra.roleid=$roleid AND pa.type=1"; // just use primary position for now
        $res = get_record_sql($sql);
        if($res && isset($res->managerid)) {
            return get_field('user','email','id',$res->managerid);
        } else {
            return ''; // No manager set
        }
    }
    else {
        return ''; // No manager role, can't do it
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

    global $USER;

    $sessionid = $data->s;

    // Load session
    if(!$session = facetoface_get_session($sessionid)) {
        error_log('F2F: Could not load facetoface session');
        return false;
    }

    // Check facetoface has finished
    if ($session->datetimeknown && !facetoface_has_session_started($session, time())) {
        error_log('F2F: Can not take attendance for a session that has not yet started');
        return false;
    }

    // Record the selected attendees from the user interface - the other attendees will need their grades set
    // to zero, to indicate non attendance, but only the ticked attendees come through from the web interface.
    // Hence the need for a diff
    $selectedsubmissionids = array();

    // FIXME: This is not very efficient, we should do the grade
    // query outside of the loop to get all submissions for a
    // given Face-to-face ID, then call
    // facetoface_grade_item_update with an array of grade
    // objects.
    foreach ($data as $key => $value) {

        $submissionidcheck = substr($key, 0, 13);
        if ($submissionidcheck == 'submissionid_') {
            $submissionid = substr($key, 13);
            $selectedsubmissionids[$submissionid]=$submissionid;

            // Update status
            switch ($value) {

                case MDL_F2F_STATUS_NO_SHOW:
                    $grade = 0;
                    break;

                case MDL_F2F_STATUS_PARTIALLY_ATTENDED:
                    $grade = 50;
                    break;

                case MDL_F2F_STATUS_FULLY_ATTENDED:
                    $grade = 100;
                    break;

                default:
                    // This use has not had attendance set
                    // Jump to the next item in the foreach loop
                    continue 2;
            }

            facetoface_update_signup_status($submissionid, $value, $USER->id, '', $grade);

            if (!facetoface_take_individual_attendance($submissionid, $grade)) {
                error_log("F2F: could not mark '$submissionid' as ".$value);
                return false;
            }
        }
    }

    return true;
}

/**
 * Mark users' booking requests as declined or approved
 *
 * @param array $data array containing the sessionid under the 's' key
 *                    and an array of request approval/denies
 */
function facetoface_approve_requests($data) {
    global $USER;

    // Check request data
    if (empty($data->requests) || !is_array($data->requests)) {
        error_log('F2F: No request data supplied');
        return false;
    }

    $sessionid = $data->s;

    // Load session
    if (!$session = facetoface_get_session($sessionid)) {
        error_log('F2F: Could not load facetoface session');
        return false;
    }

    // Load facetoface
    if (!$facetoface = get_record('facetoface', 'id', $session->facetoface)) {
        error_log('F2F: Could not load facetoface instance');
        return false;
    }

    // Load course
    if (!$course = get_record('course', 'id', $facetoface->course)) {
        error_log('F2F: Could nto load course');
        return false;
    }

    // Loop through requests
    foreach ($data->requests as $key => $value) {

        // Check key/value
        if (!is_numeric($key) || !is_numeric($value)) {
            continue;
        }

        // Load user submission
        if (!$attendee = facetoface_get_attendee($sessionid, $key)) {
            error_log('F2F: User '.$key.' not an attendee of this session');
            continue;;
        }

        // Update status
        switch ($value) {

            // Decline
            case 1:
                facetoface_update_signup_status(
                        $attendee->submissionid,
                        MDL_F2F_STATUS_DECLINED,
                        $USER->id
                );

                // Send a cancellation notice to the user
                facetoface_send_cancellation_notice($facetoface, $session, $attendee->id);

                break;

            // Approve
            case 2:
                facetoface_update_signup_status(
                        $attendee->submissionid,
                        MDL_F2F_STATUS_APPROVED,
                        $USER->id
                );

                // Check if there is capacity
                if (facetoface_session_has_capacity($session)) {
                    $status = MDL_F2F_STATUS_BOOKED;
                } else {
                    $status = MDL_F2F_STATUS_WAITLISTED;
                }

                // Signup user
                if (!facetoface_user_signup(
                        $session,
                        $facetoface,
                        $course,
                        $attendee->discountcode,
                        $attendee->notificationtype,
                        $status,
                        $attendee->id
                    )) {
                    continue;
                }

                break;

            case 0:
            default:
                // Change nothing
                continue;
        }
    }

    return true;
}

/*
 * Set the grading for an individual submission, to either 0 or 100 to indicate attendance
 * @param $submissionid The id of the submission in the database
 * @param $grading Grade to set
 */
function facetoface_take_individual_attendance($submissionid, $grading) {
    global $USER, $CFG;

    $timenow = time();

    $record = get_record_sql("SELECT f.*, s.userid
                                FROM {$CFG->prefix}facetoface_signups s
                                JOIN {$CFG->prefix}facetoface_sessions fs ON s.sessionid = fs.id
                                JOIN {$CFG->prefix}facetoface f ON f.id = fs.facetoface
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
 * @global class $CFG used to get the path to the module
 */
function facetoface_print_coursemodule_info($coursemodule)
{
    global $CFG, $USER;

    $contextmodule = get_context_instance(CONTEXT_MODULE, $coursemodule->id);
    if (!has_capability('mod/facetoface:view', $contextmodule)) {
        return ''; // not allowed to view this activity
    }
    $contextcourse = get_context_instance(CONTEXT_COURSE, $coursemodule->course);
    // can view attendees
    $viewattendees = has_capability('mod/facetoface:viewattendees', $contextcourse);

    $table = '';
    $timenow = time();
    $facetofacepath = "$CFG->wwwroot/mod/facetoface";

    $facetofaceid = $coursemodule->instance;
    $facetoface = get_record('facetoface', 'id', $facetofaceid);
    if (!$facetoface) {
        error_log("facetoface: ask to print coursemodule info for a non-existent activity ($facetofaceid)");
        return '';
    }

    $htmlactivitynameonly = '<img src="'.$CFG->pixpath.'/mod/facetoface/icon.gif" class="activityicon" alt="'.$facetoface->name.'" /> '
            .$facetoface->name;
    $strviewallsessions = get_string('viewallsessions', 'facetoface');
    $htmlviewallsessions = '<a class="f2fsessionlinks" href="'.$facetofacepath.'/view.php?f='.$facetofaceid.'" title="'.$strviewallsessions.'">'
        .$strviewallsessions.'</a>';

    if ($submissions = facetoface_get_user_submissions($facetofaceid, $USER->id)) {
        // User has signedup for the instance
        $submission = array_shift($submissions);

        if ($session = facetoface_get_session($submission->sessionid)) {
            $sessiondate = '';
            $sessiontime = '';

            if ($session->datetimeknown) {
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
            }
            else {
                $sessiondate = get_string('wait-listed', 'facetoface');
                $sessiontime = get_string('wait-listed', 'facetoface');
            }

            // don't include the link to cancel a session if it has already occurred
            $cancellink = '';
            if (!facetoface_has_session_started($session, $timenow)) {
                $strcancelbooking = get_string('cancelbooking', 'facetoface');
                $cancellink = "<tr><td><a class=\"f2fsessionlinks\" href=\"$facetofacepath/cancelsignup.php?s={$session->id}\" title=\"$strcancelbooking\">$strcancelbooking</a></td></tr>";
            }

            $strmoreinfo = get_string('moreinfo', 'facetoface');
            $strseeattendees = get_string('seeattendees', 'facetoface');

            $location = '&nbsp;';
            $venue = '&nbsp;';
            $customfielddata = facetoface_get_customfielddata($session->id);
            if (!empty($customfielddata['location'])) {
                $location = $customfielddata['location']->data;
            }
            if (!empty($customfielddata['venue'])) {
                $venue = $customfielddata['venue']->data;
            }

            // don't include the link to view attendees if user is lacking capability
            $attendeeslink = '';
            if ($viewattendees) {
                $attendeeslink = "<tr><td><a class=\"f2fsessionlinks\" href=\"$facetofacepath/attendees.php?s=$session->id\" title=\"$strseeattendees\">$strseeattendees</a></td></tr>";
            }

            $table = '<table border="0" cellpadding="1" cellspacing="0" width="90%" summary="" style="display:inline-table">'
                .'<tr>'
                .'<td class="f2fsessionnotice" colspan="4">'.$htmlactivitynameonly.'</td>'
                .'</tr>'
                .'<tr>'
                .'<td class="f2fsessionnotice" colspan="4">'.get_string('bookingstatus', 'facetoface').':</td>'
                .'<td><span class="f2fsessionnotice" >'.get_string('options', 'facetoface').':</span></td>'
                .'</tr>'
                .'<tr>'
                .'<td>'.$location.'</td>'
                .'<td>'.$venue.'</td>'
                .'<td>'.$sessiondate.'</td>'
                .'<td>'.$sessiontime.'</td>'
                ."<td><table border=\"0\" summary=\"\"><tr><td><a class=\"f2fsessionlinks\" href=\"$facetofacepath/signup.php?s=$session->id\" title=\"$strmoreinfo\">$strmoreinfo</a></td>"
                .'</tr>'
                .$attendeeslink
                .$cancellink
                .'<tr>'
                ."<td>$htmlviewallsessions</td>"
                .'</tr>'
                .'</table></td></tr>'
                .'</table>';
        }
    }
    elseif ($facetoface->display > 0 && $sessions = facetoface_get_sessions($facetofaceid) ) {

        $table = '<table border="0" cellpadding="1" cellspacing="0" width="100%" summary="" style="display:inline-table">'
            .'   <tr>'
            .'       <td class="f2fsessionnotice" colspan="2">'.$htmlactivitynameonly.'</td>'
            .'   </tr>'
            .'   <tr>'
            .'       <td class="f2fsessionnotice" colspan="2">'.get_string('signupforsession', 'facetoface').':</td>'
            .'   </tr>';

        $i=0;
        foreach($sessions as $session) {
            if ($session->datetimeknown && (facetoface_has_session_started($session, $timenow))) {
                continue;
            }

            if (!facetoface_session_has_capacity($session, $contextmodule)) {
                continue;
            }

            $multiday = '';
            $sessiondate = '';
            $sessiontime = '';

            if ($session->datetimeknown) {
                if (empty($session->sessiondates)) {
                    $sessiondate = get_string('unknowndate', 'facetoface');
                    $sessiontime = get_string('unknowntime', 'facetoface');
                }
                else {
                    $sessiondate = userdate($session->sessiondates[0]->timestart, get_string('strftimedate'));
                    $sessiontime = userdate($session->sessiondates[0]->timestart, get_string('strftimetime')).
                        ' - '.userdate($session->sessiondates[0]->timefinish, get_string('strftimetime'));
                    if (count($session->sessiondates) > 1) {
                        $multiday = ' ('.get_string('multiday', 'facetoface').')';
                    }
                }
            }
            else {
                $sessiondate = get_string('wait-listed', 'facetoface');
            }

            if ($i == 0) {
                $table .= '   <tr>';
                $i++;
            }
            else if ($i++ % 2 == 0) {
                if ($i > $facetoface->display) {
                    break;
                }
                $table .= '   </tr>';
                $table .= '   <tr>';
            }

            $locationstring = '';
            $customfielddata = facetoface_get_customfielddata($session->id);
            if (!empty($customfielddata['location']) && trim($customfielddata['location']->data) != '') {
                $locationstring = $customfielddata['location']->data . ', ';
            }

            $table .= "      <td><a href=\"$facetofacepath/signup.php?s=$session->id\">{$locationstring}$sessiondate<br />{$sessiontime}$multiday</a></td>";
        }
        if ($i++ % 2 == 0) {
            $table .= '<td>&nbsp;</td>';
        }

        $table .= '   </tr>'
            .'   <tr>'
            ."     <td colspan=\"2\">$htmlviewallsessions</td>"
            .'   </tr>'
            .'</table>';
    }
    elseif (has_capability('mod/facetoface:viewemptyactivities', $contextmodule)) {
        return '<span class="f2fsessionnotice" style="line-height:1.5">'.$htmlactivitynameonly.'<br />'.$htmlviewallsessions.'</span>';
    }
    else {
        // Nothing to display to this user
    }

    return $table;
}

/**
 * Returns the ICAL data for a facetoface meeting.
 *
 * @param integer $method The method, @see {{MDL_F2F_INVITE}}
 * @return string Filename of the attachment in the temp directory
 */
function facetoface_get_ical_attachment($method, $facetoface, $session, $user)
{
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

        // FIXME: currently we are not sending updates if the times of the
        // sesion are changed. This is not ideal!
        $SEQUENCE = ($method & MDL_F2F_CANCEL) ? 1 : 0;

        $SUMMARY     = facetoface_ical_escape($facetoface->name);
        $DESCRIPTION = facetoface_ical_escape($session->details, true);

        // Get the location data from custom fields if they exist
        $customfielddata = facetoface_get_customfielddata($session->id);
        $locationstring = '';
        if (!empty($customfielddata['room'])) {
            $locationstring .= $customfielddata['room']->data;
        }
        if (!empty($customfielddata['venue'])) {
            if (!empty($locationstring)) {
                $locationstring .= "\n";
            }
            $locationstring .= $customfielddata['venue']->data;
        }
        if (!empty($customfielddata['location'])) {
            if (!empty($locationstring)) {
                $locationstring .= "\n";
            }
            $locationstring .= $customfielddata['location']->data;
        }

        // NOTE: Newlines are meant to be encoded with the literal sequence
        // '\n'. But evolution presents a single line text field for location,
        // and shows the newlines as [0x0A] junk. So we switch it for commas
        // here. Remember commas need to be escaped too.
        $LOCATION    = str_replace('\n', '\, ', facetoface_ical_escape($locationstring));

        $ORGANISEREMAIL = get_config(NULL, 'facetoface_fromaddress');

        $ROLE = 'REQ-PARTICIPANT';
        $CANCELSTATUS = '';
        if ($method & MDL_F2F_CANCEL) {
            $ROLE = 'NON-PARTICIPANT';
            $CANCELSTATUS = "\nSTATUS:CANCELLED";
        }

        $icalmethod = ($method & MDL_F2F_INVITE) ? 'REQUEST' : 'CANCEL';

        // FIXME: if the user has input their name in another language, we need
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

    // TODO: remove the hard-coded timezone!
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
function facetoface_ical_escape($text, $converthtml=false) {
    if (empty($text)) {
        return '';
    }

    if ($converthtml) {
        $text = html_to_text($text);
    }

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
    global $CFG;
    // for the session, pick signups that haven't been superceded, or cancelled
    return (int) count_records_sql("select count(ss.id) from {$CFG->prefix}facetoface_signups su
        JOIN {$CFG->prefix}facetoface_signups_status ss ON su.id = ss.signupid
        WHERE sessionid=$session_id AND ss.superceded=0 AND ss.statuscode >= ".MDL_F2F_STATUS_APPROVED);
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

    $whereclause = "s.facetoface=$facetofaceid AND su.userid=$userid AND ss.superceded != 1";

    // If not show cancelled, only show requested and up status'
    if (!$includecancellations) {
        $whereclause .= ' AND ss.statuscode >= '.MDL_F2F_STATUS_REQUESTED.' AND ss.statuscode < '.MDL_F2F_STATUS_NO_SHOW;
    }

    //TODO fix mailedconfirmation, timegraded, timecancelled, etc
    return get_records_sql("
        SELECT
            su.id,
            s.facetoface,
            s.id as sessionid,
            su.userid,
            0 as mailedconfirmation,
            su.mailedreminder,
            su.discountcode,
            ss.timecreated,
            ss.timecreated as timegraded,
            s.timemodified,
            0 as timecancelled,
            su.notificationtype,
            ss.statuscode
        FROM
            {$CFG->prefix}facetoface_sessions s
        JOIN
            {$CFG->prefix}facetoface_signups su
         ON su.sessionid = s.id
        JOIN
            {$CFG->prefix}facetoface_signups_status ss
         ON su.id = ss.signupid
        WHERE
            $whereclause
        ORDER BY
            s.timecreated
    ");
}

/**
 * Cancel users' submission to a facetoface session
 *
 * @param integer $sessionid   ID of the facetoface_sessions record
 * @param integer $userid      ID of the user record
 * @param string $cancelreason Short justification for cancelling the signup
 * @return boolean success
 */
function facetoface_user_cancel_submission($sessionid, $userid, $cancelreason='')
{
    $signup = get_record('facetoface_signups', 'sessionid', $sessionid, 'userid', $userid);
    if (!$signup) {
        return true; // not signed up, nothing to do
    }

    $result = facetoface_update_signup_status($signup->id, MDL_F2F_STATUS_USER_CANCELLED, $userid, $cancelreason);

    if ($result) {
        // notify cancelled
        if (!$session = facetoface_get_session($sessionid)) {
            error_log('F2F: Could not load facetoface session');
            return false;
        }
        if (!$facetoface = get_record('facetoface', 'id', $session->facetoface)) {
            error_log('F2F: Could not load facetoface instance');
            return false;
        }
        $error = facetoface_send_notrem($facetoface, $session, $userid, MDL_F2F_STATUS_USER_CANCELLED);
    }

    return $result;
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
 * Add a link to the session to the site Calendar
 *
 * @param class   $session     Record from the facetoface_sessions table
 * @param class   $facetoface  Record from the facetoface table
 */
function facetoface_add_session_to_site_calendar($session, $facetoface)
{
    global $CFG;

    if (empty($facetoface->showoncalendar) or empty($session->datetimeknown)) {
        return true; // not meant for the calendar
    }

    $shortname = $facetoface->shortname;
    if (empty($shortname)) {
        $shortname = substr($facetoface->name, 0, CALENDAR_MAX_NAME_LENGTH);
    }

    $description = '';
    if (!empty($facetoface->description)) {
        $description .= '<p>'.clean_param($facetoface->description, FORMAT_HTML).'</p>';
    }
    $description .= facetoface_print_session($session, false, true, true);
    $signupurl = "$CFG->wwwroot/mod/facetoface/signup.php?s=$session->id";
    $description .= '<a href="' . $signupurl . '">' . get_string('signupforthissession', 'facetoface') . '</a>';

    $result = true;
    foreach ($session->sessiondates as $date) {
        $newevent = new object();
        $newevent->name = addslashes($shortname);
        $newevent->description = addslashes($description);
        $newevent->format = FORMAT_HTML;
        $newevent->courseid = SITEID; // site-wide event
        $newevent->groupid = 0;
        $newevent->userid = 0; // not a user event
        $newevent->uuid = "$session->id";
        $newevent->instance = $session->facetoface;
        $newevent->modulename = 'facetoface';
        $newevent->eventtype = "facetofacesession";
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
                                           userid = $userid AND
                                           courseid = 0");
}

/**
 * Remove all entries in the site calendar which relate to this session.
 *
 * @param class $session       Record from the facetoface_sessions table
 */
function facetoface_remove_session_from_site_calendar($session)
{
    return delete_records_select('event', "modulename = 'facetoface' AND
                                           eventtype = 'facetofacesession' AND
                                           instance = $session->facetoface AND
                                           courseid = ". SITEID . " AND
                                           uuid = '$session->id' AND
                                           userid = 0");
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
 * Confirm that a user can be added to a session.
 *
 * @param class  $session Record from the facetoface_sessions table
 * @param object $context (optional) A context object (record from context table)
 * @return bool True if user can be added to session
 **/
function facetoface_session_has_capacity($session, $context = false) {

    if (empty($session)) {
        return false;
    }

    // If allowoverbook enabled
    if ($session->allowoverbook) {
        return true;
    }

    $signupcount = facetoface_get_num_attendees($session->id);
    if ($signupcount >= $session->capacity) {
        // if session is full, check if overbooking is allowed for this user
        if (!$context || !has_capability('mod/facetoface:overbook', $context)) {
            return false;
        }
    }

    return true;
}

/**
 * Print the details of a session
 *
 * @param object $session         Record from facetoface_sessions
 * @param boolean $showcapacity   Show the capacity (true) or only the seats available (false)
 * @param boolean $calendaroutput Whether the output should be formatted for a calendar event
 * @param boolean $return         Whether to return (true) the html or print it directly (true)
 * @param boolean $hidesignup     Hide any messages relating to signing up
 */
function facetoface_print_session($session, $showcapacity, $calendaroutput=false, $return=false, $hidesignup=false)
{
    global $CFG;

    $table = new object();
    $table->summary = get_string('sessionsdetailstablesummary', 'facetoface');
    $table->class = 'f2fsession';
    $table->width = '50%';
    $table->align = array('right', 'left');
    if ($calendaroutput) {
        $table->tablealign = 'left';
    }

    $customfields = facetoface_get_session_customfields();
    $customdata = get_records('facetoface_session_data', 'sessionid', $session->id, '', 'fieldid, data');
    foreach ($customfields as $field) {
        $data = '';
        if (!empty($customdata[$field->id])) {
            if (CUSTOMFIELD_TYPE_MULTISELECT == $field->type) {
                $values = explode(CUSTOMFIELD_DELIMITTER, $customdata[$field->id]->data);
                $data = implode(', ', $values);
            }
            else {
                $data = $customdata[$field->id]->data;
            }
        }
        $table->data[] = array(str_replace(' ', '&nbsp;', format_string($field->name)), format_string($data));
    }

    $strdatetime = str_replace(' ', '&nbsp;', get_string('sessiondatetime', 'facetoface'));
    if ($session->datetimeknown) {
        $html = '';
        foreach($session->sessiondates as $date) {
            if (!empty($html)) {
                $html .= '<br/>';
            }
            $timestart = userdate($date->timestart, get_string('strftimedatetime'));
            $timefinish = userdate($date->timefinish, get_string('strftimedatetime'));
            $html .= "$timestart &ndash; $timefinish";
        }
        $table->data[] = array($strdatetime, $html);
    }
    else {
        $table->data[] = array($strdatetime, '<i>'.get_string('wait-listed', 'facetoface').'</i>');
    }

    $signupcount = facetoface_get_num_attendees($session->id);
    $placesleft = $session->capacity - $signupcount;

    if ($showcapacity) {
        if ($session->allowoverbook) {
            $table->data[] = array(get_string('capacity', 'facetoface'), $session->capacity . ' ('.strtolower(get_string('allowoverbook', 'facetoface')).')');
        } else {
            $table->data[] = array(get_string('capacity', 'facetoface'), $session->capacity);
        }
    }
    elseif (!$calendaroutput) {
        $table->data[] = array(get_string('seatsavailable', 'facetoface'), max(0, $placesleft));
    }

    // Display requires approval notification
    $facetoface = get_record('facetoface', 'id', $session->facetoface);

    if ($facetoface->approvalreqd) {
        $table->data[] = array('', get_string('sessionrequiresmanagerapproval', 'facetoface'));
    }

    // Display waitlist notification
    if (!$hidesignup && $session->allowoverbook && $placesleft < 1) {
        $table->data[] = array('', get_string('userwillbewaitlisted', 'facetoface'));
    }

    if (!empty($session->duration)) {
        $table->data[] = array(get_string('duration', 'facetoface'), format_duration($session->duration));
    }
    if (!empty($session->normalcost)) {
        $table->data[] = array(get_string('normalcost', 'facetoface'), format_cost($session->normalcost));
    }
    if (!empty($session->discountcost)) {
        $table->data[] = array(get_string('discountcost', 'facetoface'), format_cost($session->discountcost));
    }
    if (!empty($session->details)) {
        $details = clean_text($session->details, FORMAT_HTML);
        $table->data[] = array(get_string('details', 'facetoface'), $details);
    }

    // Display trainers
    $trainerroles = facetoface_get_trainer_roles();

    if ($trainerroles) {
        // Get trainers
        $trainers = facetoface_get_trainers($session->id);

        foreach ($trainerroles as $role => $rolename) {
            $rolename = $rolename->name;

            if (empty($trainers[$role])) {
                continue;
            }

            $trainer_names = array();
            foreach ($trainers[$role] as $trainer) {
                $trainer_names[] = '<a href="'.$CFG->wwwroot.'/user/view.php?id='.$trainer->id.'">'.fullname($trainer).'</a>';
            }

            $table->data[] = array($rolename, implode(', ', $trainer_names));
        }
    }

    return print_table($table, $return);
}

/**
 * Update the value of a customfield for the given session/notice.
 *
 * @param integer $fieldid    ID of a record from the facetoface_session_field table
 * @param string  $data       Value for that custom field
 * @param integer $otherid    ID of a record from the facetoface_(sessions|notice) table
 * @param string  $table      'session' or 'notice' (part of the table name)
 * @returns true if it succeeded, false otherwise
 */
function facetoface_save_customfield_value($fieldid, $data, $otherid, $table)
{
    $dbdata = null;
    if (is_array($data)) {
        $dbdata = trim(implode(CUSTOMFIELD_DELIMITTER, $data), ';');
    }
    else {
        $dbdata = trim($data);
    }

    $newrecord = new object();
    $newrecord->data = $dbdata;

    $fieldname = "{$table}id";
    if ($record = get_record("facetoface_{$table}_data", 'fieldid', $fieldid, $fieldname, $otherid)) {
        if (empty($dbdata)) {
            // Clear out the existing value
            return delete_records("facetoface_{$table}_data", 'id', $record->id);
        }

        $newrecord->id = $record->id;
        return update_record("facetoface_{$table}_data", $newrecord);
    }
    else {
        if (empty($dbdata)) {
            return true; // no need to store empty values
        }

        $newrecord->fieldid = $fieldid;
        $newrecord->$fieldname = $otherid;
        return insert_record("facetoface_{$table}_data", $newrecord);
    }
}

/**
 * Return the value of a customfield for the given session/notice.
 *
 * @param object  $field    A record from the facetoface_session_field table
 * @param integer $otherid  ID of a record from the facetoface_(sessions|notice) table
 * @param string  $table    'session' or 'notice' (part of the table name)
 * @returns string The data contained in this custom field (empty string if it doesn't exist)
 */
function facetoface_get_customfield_value($field, $otherid, $table)
{
    if ($record = get_record("facetoface_{$table}_data", 'fieldid', $field->id, "{$table}id", $otherid)) {
        if (!empty($record->data)) {
            if (CUSTOMFIELD_TYPE_MULTISELECT == $field->type) {
                return explode(CUSTOMFIELD_DELIMITTER, $record->data);
            }
            return $record->data;
        }
    }
    return '';
}

/**
 * Return the values stored for all custom fields in the given session.
 *
 * @param integer $sessionid  ID of facetoface_sessions record
 * @returns array Indexed by field shortnames
 */
function facetoface_get_customfielddata($sessionid)
{
    global $CFG;

    $sql = "SELECT f.shortname, d.data
              FROM {$CFG->prefix}facetoface_session_field f
              JOIN {$CFG->prefix}facetoface_session_data d ON f.id = d.fieldid
             WHERE d.sessionid = $sessionid";
    if ($records = get_records_sql($sql)) {
        return $records;
    }
    return array();
}

/**
 * Return a cached copy of all records in facetoface_session_field
 */
function facetoface_get_session_customfields()
{
    static $customfields = null;
    if (null == $customfields) {
        if (!$customfields = get_records('facetoface_session_field')) {
            $customfields = array();
        }
    }
    return $customfields;
}

/**
 * Display the list of custom fields in the site-wide settings page
 */
function facetoface_list_of_customfields()
{
    global $CFG, $USER;

    if ($fields = get_records('facetoface_session_field', '', '', 'name', 'id, name')) {
        $table = new stdClass;
        $table->width = '50%';
        $table->tablealign = 'left';
        $table->data = array();
        $table->size = array('100%');
        foreach ($fields as $field) {
            $fieldname = format_string($field->name);
            $editlink = '<a href="'.$CFG->wwwroot.'/mod/facetoface/customfield.php?id='.$field->id.'">'.
                '<img class="iconsmall" src="'.$CFG->pixpath.'/t/edit.gif" alt="'.get_string('edit').'" /></a>';
            $deletelink = '<a href="'.$CFG->wwwroot.'/mod/facetoface/customfield.php?id='.$field->id.'&amp;d=1&amp;sesskey='.$USER->sesskey.'">'.
                '<img class="iconsmall" src="'.$CFG->pixpath.'/t/delete.gif" alt="'.get_string('delete').'" /></a>';
            $table->data[] = array($fieldname, $editlink, $deletelink);
        }
        return print_table($table, true);
    }

    return get_string('nocustomfields', 'facetoface');
}

function facetoface_update_trainers($sessionid, $form) {

    // If we recieved bad data
    if (!is_array($form)) {
        return false;
    }

    // Load current trainers
    $old_trainers = facetoface_get_trainers($sessionid);

    begin_sql();

    // Loop through form data and add any new trainers
    foreach ($form as $roleid => $trainers) {

        // Loop through trainers in this role
        foreach ($trainers as $trainer) {

            if (!$trainer) {
                continue;
            }

            // If the trainer doesn't exist already, create it
            if (!isset($old_trainers[$roleid][$trainer])) {

                $newtrainer = new object();
                $newtrainer->userid = $trainer;
                $newtrainer->roleid = $roleid;
                $newtrainer->sessionid = $sessionid;

                if (!insert_record('facetoface_session_roles', $newtrainer)) {
                    error('Could not save new face-to-face session trainer');
                    rollback_sql();
                    return false;
                }
            }

            unset($old_trainers[$roleid][$trainer]);
        }
    }

    // Loop through what is left of old trainers, and remove
    // (as they have been deselected)
    if ($old_trainers) {
        foreach ($old_trainers as $roleid => $trainers) {
            // If no trainers left
            if (empty($trainers)) {
                continue;
            }

            // Delete any remaining trainers
            foreach ($trainers as $trainer) {
                if (!delete_records('facetoface_session_roles', 'sessionid', $sessionid, 'roleid', $roleid, 'userid', $trainer->id)) {
                    error('Could not delete a face-to-face session trainer');
                    rollback_sql();
                    return false;
                }
            }
        }
    }

    commit_sql();

    return true;
}


/**
 * Return array of trainer roles configured for face-to-face
 *
 * @return  array
 */
function facetoface_get_trainer_roles() {
    global $CFG;

    // Check that roles have been selected
    if (empty($CFG->facetoface_session_roles)) {
        return false;
    }

    // Parse roles
    $cleanroles = clean_param($CFG->facetoface_session_roles, PARAM_SEQUENCE);

    // Load role names
    $rolenames = get_records_sql("
        SELECT
            r.id,
            r.name
        FROM
            {$CFG->prefix}role r
        WHERE
            r.id IN ({$cleanroles})
        AND r.id <> 0
    ");

    // Return roles and names
    if (!$rolenames) {
        return array();
    }

    return $rolenames;
}


/**
 * Get all trainers associated with a session, optionally
 * restricted to a certain roleid
 *
 * If a roleid is not specified, will return a multi-dimensional
 * array keyed by roleids, with an array of the chosen roles
 * for each role
 *
 * @param   integer     $sessionid
 * @param   integer     $roleid (optional)
 * @return  array
 */
function facetoface_get_trainers($sessionid, $roleid = null) {
    global $CFG;

    $rs = get_recordset_sql("
        SELECT
            u.id,
            u.firstname,
            u.lastname,
            r.roleid
        FROM
            {$CFG->prefix}facetoface_session_roles r
        LEFT JOIN
            {$CFG->prefix}user u
         ON u.id = r.userid
        WHERE
            r.sessionid = {$sessionid}
        ".
        ($roleid ? "AND r.roleid = {$roleid}" : '')
    );

    if (!$rs) {
        return false;
    }

    $return = array();
    while ($record = rs_fetch_next_record($rs)) {
        // Create new array for this role
        if (!isset($return[$record->roleid])) {
            $return[$record->roleid] = array();
        }

        $return[$record->roleid][$record->id] = $record;
    }

    rs_close($rs);

    // If we are only after one roleid
    if ($roleid) {
        if (empty($return[$roleid])) {
            return false;
        }

        return $return[$roleid];
    }

    // If we are after all roles
    if (empty($return)) {
        return false;
    }

    return $return;
}

/**
 * @param string $feature FEATURE_xx constant for requested feature
 * @return bool True if module supports feature
 */
function facetoface_supports($feature) {
    switch($feature) {
        case FEATURE_GRADE_HAS_GRADE: return true;
        default: return null;
    }
}

/**
 * Determines whether an activity requires the user to have a manager (either for
 * manager approval or to send notices to the manager)
 *
 * @param  object $facetoface A database fieldset object for the facetoface activity
 * @return boolean whether a person needs a manager to sign up for that activity
 */
function facetoface_manager_needed($facetoface){
    return $facetoface->approvalreqd
        || $facetoface->confirmationinstrmngr
        || $facetoface->reminderinstrmngr
        || $facetoface->cancellationinstrmngr;
}

/**
 * Display the list of site notices in the site-wide settings page
 */
function facetoface_list_of_sitenotices()
{
    global $CFG, $USER;

    if ($notices = get_records('facetoface_notice', '', '', 'name', 'id, name')) {
        $table = new stdClass;
        $table->width = '50%';
        $table->tablealign = 'left';
        $table->data = array();
        $table->size = array('100%');
        foreach ($notices as $notice) {
            $noticename = format_string($notice->name);
            $editlink = '<a href="'.$CFG->wwwroot.'/mod/facetoface/sitenotice.php?id='.$notice->id.'">'.
                '<img class="iconsmall" src="'.$CFG->pixpath.'/t/edit.gif" alt="'.get_string('edit').'" /></a>';
            $deletelink = '<a href="'.$CFG->wwwroot.'/mod/facetoface/sitenotice.php?id='.$notice->id.'&amp;d=1&amp;sesskey='.$USER->sesskey.'">'.
                '<img class="iconsmall" src="'.$CFG->pixpath.'/t/delete.gif" alt="'.get_string('delete').'" /></a>';
            $table->data[] = array($noticename, $editlink, $deletelink);
        }
        return print_table($table, true);
    }

    return get_string('nositenotices', 'facetoface');
}

/**
 * Add formslib fields for all custom fields defined site-wide.
 * (used by the session add/edit page and the site notices)
 */
function facetoface_add_customfields_to_form(&$mform, $customfields, $alloptional=false)
{
    foreach ($customfields as $field) {
        $fieldname = "custom_$field->shortname";

        $options = array();
        if (!$field->required) {
            $options[''] = get_string('none');
        }
        foreach (explode(CUSTOMFIELD_DELIMITTER, $field->possiblevalues) as $value) {
            $v = trim($value);
            if (!empty($v)) {
                $options[$v] = $v;
            }
        }

        switch ($field->type) {
        case CUSTOMFIELD_TYPE_TEXT:
            $mform->addElement('text', $fieldname, $field->name);
            break;
        case CUSTOMFIELD_TYPE_SELECT:
            $mform->addElement('select', $fieldname, $field->name, $options);
            break;
        case CUSTOMFIELD_TYPE_MULTISELECT:
            $select = &$mform->addElement('select', $fieldname, $field->name, $options);
            $select->setMultiple(true);
            break;
        default:
            error_log("facetoface: invalid field type for custom field ID $field->id");
            continue;
        }

        $mform->setType($fieldname, PARAM_TEXT);
        $mform->setDefault($fieldname, $field->defaultvalue);
        if ($field->required and !$alloptional) {
            $mform->addRule($fieldname, null, 'required', null, 'client');
        }
    }
}

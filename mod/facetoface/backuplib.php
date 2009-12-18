<?php
  //------------------------------------------------------------------
  // This is the "graphical" structure of the Facet-to-face module:
  //
  //          facetoface                  facetoface_sessions
  //         (CL, pk->id)-------------(CL, pk->id, fk->facetoface)
  //              |                          |     |  |
  //              |                          |     |  |
  //              |                          |     |  |
  //              |            +-------------+     |  |
  //              |            |                   |  |
  //          facetoface_submissions               |  |
  //  (UL, pk->id, fk->facetoface, fk->sessionid)  |  |
  //                                               |  |
  //                                               |  |
  //     facetoface_session_field                  |  |
  //          (SL, pk->id)  |                      |  |
  //                        |                      |  |
  //             facetoface_session_data-----------+  |
  //    (CL, pk->id, fk->sessionid, fk->fieldid)      |
  //                                                  |
  //                                    facetoface_sessions_dates
  //                                    (CL, pk->id, fk->session)
  //
  // Meaning: pk->primary key field of the table
  //          fk->foreign key to link with parent
  //          SL->system level info
  //          CL->course level info
  //          UL->user level info
  //
  //------------------------------------------------------------------

/**
 * API function called by the Moodle backup system to backup all of
 * the facetoface activities
 */
function facetoface_backup_mods($bf, $preferences)
{
    $status = true;

    $facetofaces = get_records('facetoface', 'course', $preferences->backup_course, 'id');
    if ($facetofaces) {
        foreach ($facetofaces as $facetoface) {
            if (backup_mod_selected($preferences, 'facetoface', $facetoface->id)) {
                $status &= facetoface_backup_one_mod($bf, $preferences, $facetoface);
            }
        }
    }

    //$status &= facetoface_backup_session_field($bf, $preferences); // DISABLED

    return $status;
}

/**
 * Backup the facetoface_session_field table (all custom session fields)
 *
 * NOTE: NOT CURRENTLY BACKED UP!
 */
function facetoface_backup_session_field($bf, $preferences)
{
    $status = true;

    $sessionfields = get_records('facetoface_session_field');
    if (!$sessionfields) {
        return $status;
    }

    $status = fwrite($bf, start_tag('SESSIONFIELDS', 3, true)) > 0;
    foreach ($sessionfields as $field) {
        $status &= fwrite($bf, start_tag('SESSIONFIELD', 4, true)) > 0;

        // facetoface_session_field table
        $status &= fwrite($bf, full_tag('ID', 5, false, $field->id)) > 0;
        $status &= fwrite($bf, full_tag('NAME', 5, false, $field->name)) > 0;
        $status &= fwrite($bf, full_tag('SHORTNAME', 5, false, $field->shortname)) > 0;
        $status &= fwrite($bf, full_tag('TYPE', 5, false, $field->type)) > 0;
        $status &= fwrite($bf, full_tag('POSSIBLEVALUES', 5, false, $field->possiblevalues)) > 0;
        $status &= fwrite($bf, full_tag('REQUIRED', 5, false, $field->required)) > 0;
        $status &= fwrite($bf, full_tag('DEFAULTVALUE', 5, false, $field->defaultvalue)) > 0;
        $status &= fwrite($bf, full_tag('ISFILTER', 5, false, $field->isfilter)) > 0;
        $status &= fwrite($bf, full_tag('SHOWINSUMMARY', 5, false, $field->showinsummary)) > 0;

        $status &= fwrite($bf, end_tag('SESSIONFIELD', 4, true)) > 0;
    }
    $status = fwrite($bf, end_tag('SESSIONFIELDS', 3, true)) > 0;

    return $status;
}

/**
 * API function called by the Moodle backup system to backup a single
 * facetoface activity
 */
function facetoface_backup_one_mod($bf, $preferences, $facetoface)
{
    if (is_numeric($facetoface)) {
        $facetoface = get_record('facetoface', 'id', $facetoface);
    }

    $status = fwrite($bf, start_tag('MOD', 3, true)) > 0;

    // facetoface table
    $status &= fwrite($bf, full_tag('ID', 4, false, $facetoface->id)) > 0;
    $status &= fwrite($bf, full_tag('MODTYPE', 4, false, 'facetoface')) > 0;
    $status &= fwrite($bf, full_tag('NAME', 4, false, $facetoface->name)) > 0;
    $status &= fwrite($bf, full_tag('THIRDPARTY', 4, false, $facetoface->thirdparty)) > 0;
    $status &= fwrite($bf, full_tag('DISPLAY', 4, false, $facetoface->display)) > 0;
    $status &= fwrite($bf, full_tag('CONFIRMATIONSUBJECT', 4, false, $facetoface->confirmationsubject)) > 0;
    $status &= fwrite($bf, full_tag('CONFIRMATIONINSTRMNGR', 4, false, $facetoface->confirmationinstrmngr)) > 0;
    $status &= fwrite($bf, full_tag('CONFIRMATIONMESSAGE', 4, false, $facetoface->confirmationmessage)) > 0;
    $status &= fwrite($bf, full_tag('WAITLISTEDSUBJECT', 4, false, $facetoface->waitlistedsubject)) > 0;
    $status &= fwrite($bf, full_tag('WAITLISTEDMESSAGE', 4, false, $facetoface->waitlistedmessage)) > 0;
    $status &= fwrite($bf, full_tag('CANCELLATIONSUBJECT', 4, false, $facetoface->cancellationsubject)) > 0;
    $status &= fwrite($bf, full_tag('CANCELLATIONINSTRMNGR', 4, false, $facetoface->cancellationinstrmngr)) > 0;
    $status &= fwrite($bf, full_tag('CANCELLATIONMESSAGE', 4, false, $facetoface->cancellationmessage)) > 0;
    $status &= fwrite($bf, full_tag('REMINDERSUBJECT', 4, false, $facetoface->remindersubject)) > 0;
    $status &= fwrite($bf, full_tag('REMINDERINSTRMNGR', 4, false, $facetoface->reminderinstrmngr)) > 0;
    $status &= fwrite($bf, full_tag('REMINDERMESSAGE', 4, false, $facetoface->remindermessage)) > 0;
    $status &= fwrite($bf, full_tag('REMINDERPERIOD', 4, false, $facetoface->reminderperiod)) > 0;
    $status &= fwrite($bf, full_tag('TIMECREATED', 4, false, $facetoface->timecreated)) > 0;
    $status &= fwrite($bf, full_tag('TIMEMODIFIED', 4, false, $facetoface->timemodified)) > 0;

    $status &= backup_facetoface_sessions($bf, $facetoface->id);

    if (backup_userdata_selected($preferences, 'facetoface', $facetoface->id)) {
        $status &= backup_facetoface_submissions($bf, $facetoface->id);
    }

    $status &= fwrite($bf, end_tag('MOD', 3 , true)) > 0;
    return $status;
}

/**
 * Backup the facetoface_sessions table entries for a given facetoface
 * activity
 */
function backup_facetoface_sessions($bf, $facetofaceid)
{
    $status = true;

    $sessions = get_records('facetoface_sessions', 'facetoface', $facetofaceid, 'id');
    if (!$sessions) {
        return $status;
    }

    $status &= fwrite($bf, start_tag('SESSIONS', 4, true)) > 0;
    foreach ($sessions as $session) {
        $status &= fwrite($bf, start_tag('SESSION', 5, true)) > 0;

        // facetoface_sessions table
        $status &= fwrite($bf, full_tag('ID', 6, false, $session->id)) > 0;
        $status &= fwrite($bf, full_tag('CAPACITY', 6, false, $session->capacity)) > 0;
        $status &= fwrite($bf, full_tag('DETAILS', 6, false, $session->details)) > 0;
        $status &= fwrite($bf, full_tag('DATETIMEKNOWN', 6, false, $session->datetimeknown)) > 0;
        $status &= fwrite($bf, full_tag('DURATION', 6, false, $session->duration)) > 0;
        $status &= fwrite($bf, full_tag('NORMALCOST', 6, false, $session->normalcost)) > 0;
        $status &= fwrite($bf, full_tag('DISCOUNTCOST', 6, false, $session->discountcost)) > 0;
        $status &= fwrite($bf, full_tag('TIMECREATED', 6, false, $session->timecreated)) > 0;
        $status &= fwrite($bf, full_tag('TIMEMODIFIED', 6, false, $session->timemodified)) > 0;

        $status &= backup_facetoface_sessions_dates($bf, $session->id);

        $status &= backup_facetoface_session_data($bf, $session->id);

        $status &= fwrite($bf, end_tag('SESSION', 5, true)) > 0;
    }
    $status &= fwrite($bf, end_tag('SESSIONS', 4, true)) > 0;

    return $status;
}

/**
 * Backup the facetoface_sessions_dates table entries for a given
 * facetoface session
 */
function backup_facetoface_sessions_dates($bf, $sessionid)
{
    $status = true;

    $dates = get_records('facetoface_sessions_dates', 'sessionid', $sessionid, 'id');
    if (!$dates) {
        return $status;
    }

    $status &= fwrite($bf, start_tag('DATES', 6, true)) > 0;
    foreach ($dates as $date) {
        $status &= fwrite($bf, start_tag('DATE', 7, true)) > 0;

        // facetoface_sessions_dates table
        $status &= fwrite($bf, full_tag('ID', 8, false, $date->id)) > 0;
        $status &= fwrite($bf, full_tag('TIMESTART', 8, false, $date->timestart)) > 0;
        $status &= fwrite($bf, full_tag('TIMEFINISH', 8, false, $date->timefinish)) > 0;

        $status &= fwrite($bf, end_tag('DATE', 7, true)) > 0;
    }
    $status &= fwrite($bf, end_tag('DATES', 6, true)) > 0;

    return $status;
}

/**
 * Backup the facetoface_session_data table entries for a given
 * facetoface session
 *
 * NOTE: we keep track of the field shortname so that we can lookup
 * the fieldid when we restore. Custom fields need to be manually
 * recreated on the destination site.
 */
function backup_facetoface_session_data($bf, $sessionid)
{
    global $CFG;
    $status = true;

    $data = get_records_sql("SELECT d.id, f.shortname, d.sessionid, d.data
                               FROM {$CFG->prefix}facetoface_session_field f
                               JOIN {$CFG->prefix}facetoface_session_data d ON f.id = d.fieldid
                              WHERE d.sessionid = $sessionid
                           ORDER BY d.id");
    if (!$data) {
        return $status;
    }

    $status &= fwrite($bf, start_tag('DATA', 6, true)) > 0;
    foreach ($data as $datum) {
        $status &= fwrite($bf, start_tag('DATUM', 7, true)) > 0;

        // facetoface_sessions_dates table
        $status &= fwrite($bf, full_tag('ID', 8, false, $datum->id)) > 0;
        $status &= fwrite($bf, full_tag('FIELDSHORTNAME', 8, false, $datum->shortname)) > 0;
        $status &= fwrite($bf, full_tag('SESSIONID', 8, false, $datum->sessionid)) > 0;
        $status &= fwrite($bf, full_tag('DATA', 8, false, $datum->data)) > 0;

        $status &= fwrite($bf, end_tag('DATUM', 7, true)) > 0;
    }
    $status &= fwrite($bf, end_tag('DATA', 6, true)) > 0;

    return $status;
}

/**
 * Backup the facetoface_submissions table entries for a given
 * facetoface activity
 */
function backup_facetoface_submissions($bf, $facetofaceid)
{
    $status = true;

    $submissions = get_records('facetoface_submissions', 'facetoface', $facetofaceid, 'id');
    if (!$submissions) {
        return $status;
    }

    $status &= fwrite($bf, start_tag('SUBMISSIONS', 4, true)) > 0;
    foreach ($submissions as $submission) {
        $status &= fwrite($bf, start_tag('SUBMISSION', 5, true)) > 0;

        // facetoface_submissions table
        $status &= fwrite($bf, full_tag('ID', 6, false, $submission->id)) > 0;
        $status &= fwrite($bf, full_tag('FACETOFACE', 6, false, $submission->facetoface)) > 0;
        $status &= fwrite($bf, full_tag('SESSIONID', 6, false, $submission->sessionid)) > 0;
        $status &= fwrite($bf, full_tag('USERID', 6, false, $submission->userid)) > 0;
        $status &= fwrite($bf, full_tag('MAILEDCONFIRMATION', 6, false, $submission->mailedconfirmation)) > 0;
        $status &= fwrite($bf, full_tag('MAILEDREMINDER', 6, false, $submission->mailedreminder)) > 0;
        $status &= fwrite($bf, full_tag('DISCOUNTCODE', 6, false, $submission->discountcode)) > 0;
        $status &= fwrite($bf, full_tag('TIMECREATED', 6, false, $submission->timecreated)) > 0;
        $status &= fwrite($bf, full_tag('TIMEMODIFIED', 6, false, $submission->timemodified)) > 0;
        $status &= fwrite($bf, full_tag('TIMECANCELLED', 6, false, $submission->timecancelled)) > 0;
        $status &= fwrite($bf, full_tag('NOTIFICATIONTYPE', 6, false, $submission->notificationtype)) > 0;

        $status &= fwrite($bf, end_tag('SUBMISSION', 5, true)) > 0;
    }
    $status &= fwrite($bf, end_tag('SUBMISSIONS', 4, true)) > 0;

    return $status;
}

/**
 * API function called by the Moodle backup system to describe the
 * contents of the given backup instances
 */
function facetoface_check_backup_mods_instances($instance, $backup_unique_code)
{
    $info[$instance->id.'0'][0] = '<b>'.$instance->name.'</b>';
    $info[$instance->id.'0'][1] = '';

    $info[$instance->id.'1'][0] = get_string('sessions', 'facetoface');
    $info[$instance->id.'1'][1] = count_records('facetoface_sessions', 'facetoface', $instance->id);

    if (!empty($instance->userdata)) {
        $info[$instance->id.'2'][0] = get_string('submissions', 'facetoface');
        $info[$instance->id.'2'][1] = count_records('facetoface_submissions', 'facetoface', $instance->id);
    }

    return $info;
}

/**
 * API function called by the Moodle backup system to describe the
 * contents of backup instances for the given course
 */
function facetoface_check_backup_mods($course, $user_data=false, $backup_unique_code, $instances=null)
{
    global $CFG;

    if (!empty($instances) && is_array($instances) && count($instances)) {
        $info = array();
        foreach ($instances as $id => $instance) {
            $info += facetoface_check_backup_mods_instances($instance, $backup_unique_code);
        }
        return $info;
    }

    $info[0][0] = get_string('modulenameplural', 'facetoface');
    $info[0][1] = count_records('facetoface', 'course', $course);

    $info[1][0] = get_string('sessions', 'facetoface');
    $info[1][1] = count_records_sql("SELECT COUNT(*)
                                         FROM {$CFG->prefix}facetoface f,
                                              {$CFG->prefix}facetoface_sessions s
                                         WHERE f.id = s.facetoface
                                           AND f.course = $course");

    if ($user_data) {
        $info[2][0] = get_string('submissions', 'facetoface');
        $info[2][1] = count_records_sql("SELECT COUNT(*)
                                             FROM {$CFG->prefix}facetoface f,
                                                  {$CFG->prefix}facetoface_submissions s
                                             WHERE f.id = s.facetoface
                                               AND f.course = $course");
    }

    return $info;
}

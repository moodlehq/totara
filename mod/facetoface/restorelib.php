<?php

/**
 * API function called by the Moodle restore system
 */
function facetoface_restore_mods($mod, $restore)
{
    global $CFG;

    $status = true;

    $data = backup_getid($restore->backup_unique_code, $mod->modtype, $mod->id);
    if ($data) {
        $info = $data->info;

        $facetoface->course                = $restore->course_id;
        $facetoface->name                  = backup_todb($info['MOD']['#']['NAME']['0']['#']);
        $facetoface->thirdparty            = backup_todb($info['MOD']['#']['THIRDPARTY']['0']['#']);
        $facetoface->display               = backup_todb($info['MOD']['#']['DISPLAY']['0']['#']);
        $facetoface->confirmationsubject   = backup_todb($info['MOD']['#']['CONFIRMATIONSUBJECT']['0']['#']);
        $facetoface->confirmationinstrmngr = backup_todb($info['MOD']['#']['CONFIRMATIONINSTRMNGR']['0']['#']);
        $facetoface->confirmationmessage   = backup_todb($info['MOD']['#']['CONFIRMATIONMESSAGE']['0']['#']);
        $facetoface->waitlistedsubject     = backup_todb($info['MOD']['#']['WAITLISTEDSUBJECT']['0']['#']);
        $facetoface->waitlistedmessage     = backup_todb($info['MOD']['#']['WAITLISTEDMESSAGE']['0']['#']);
        $facetoface->cancellationsubject   = backup_todb($info['MOD']['#']['CANCELLATIONSUBJECT']['0']['#']);
        $facetoface->cancellationinstrmngr = backup_todb($info['MOD']['#']['CANCELLATIONINSTRMNGR']['0']['#']);
        $facetoface->cancellationmessage   = backup_todb($info['MOD']['#']['CANCELLATIONMESSAGE']['0']['#']);
        $facetoface->remindersubject       = backup_todb($info['MOD']['#']['REMINDERSUBJECT']['0']['#']);
        $facetoface->reminderinstrmngr     = backup_todb($info['MOD']['#']['REMINDERINSTRMNGR']['0']['#']);
        $facetoface->remindermessage       = backup_todb($info['MOD']['#']['REMINDERMESSAGE']['0']['#']);
        $facetoface->reminderperiod        = backup_todb($info['MOD']['#']['REMINDERPERIOD']['0']['#']);
        $facetoface->timecreated           = backup_todb($info['MOD']['#']['TIMECREATED']['0']['#']);
        $facetoface->timemodified          = backup_todb($info['MOD']['#']['TIMEMODIFIED']['0']['#']);

        $newid = insert_record ('facetoface', $facetoface);

        if (!defined('RESTORE_SILENTLY')) {
            echo '<li>'.get_string('modulename','facetoface').' "'.format_string(stripslashes($facetoface->name),true).'"</li>';
        }
        backup_flush(300);

        if ($newid) {
            backup_putid($restore->backup_unique_code, $mod->modtype, $mod->id, $newid);

            // Table: facetoface_sessions
            $status &= restore_facetoface_sessions($newid, $info, $restore);

            if (restore_userdata_selected($restore, 'facetoface', $mod->id)) {
                if (!defined('RESTORE_SILENTLY')) {
                    echo '<br />';
                }

                // Table: facetoface_signups_
                $status &= restore_facetoface_signups($newid, $info, $restore);
            }
        }
        else {
            $status = false;
        }
    }
    else {
        $status = false;
    }

    return $status;
}

/**
 * Restore the facetoface_signups table entries for a given
 * facetoface activity
 *
 * @param integer $newfacetofaceid ID of the facetoface activity we're creating
 */
function restore_facetoface_signups($newfacetofaceid, $info, $restore)
{
    $status = true;

    if (empty($info['MOD']['#']['SIGNUPS'])) {
        return $status; // Nothing to restore
    }

    $signups = $info['MOD']['#']['SIGNUPS']['0']['#']['SIGNUP'];
    foreach ($signups as $signupinfo) {
        $oldid = backup_todb($signupinfo['#']['ID']['0']['#']);

        $signup = new Object();
        $signup->sessionid          = backup_todb($signupinfo['#']['SESSIONID']['0']['#']);
        $signup->userid             = backup_todb($signupinfo['#']['USERID']['0']['#']);
        $signup->mailedreminder     = backup_todb($signupinfo['#']['MAILEDREMINDER']['0']['#']);
        $signup->discountcode       = backup_todb($signupinfo['#']['DISCOUNTCODE']['0']['#']);
        $signup->notificationtype   = backup_todb($signupinfo['#']['NOTIFICATIONTYPE']['0']['#']);

        // Fix the sessionid
        $session = backup_getid($restore->backup_unique_code, 'facetoface_sessions', $signup->sessionid);
        if ($session) {
            $signup->sessionid = $session->new_id;
        }

        // Fix the userid
        $user = backup_getid($restore->backup_unique_code, 'user', $signup->userid);
        if ($user) {
            $signup->userid = $user->new_id;
        }

        // Fix the discount code
        if (empty($signup->discountcode)) {
            $signup->discountcode = null;
        }

        $newid = insert_record('facetoface_signups', $signup);

        // Progress bar
        if (!defined('RESTORE_SILENTLY')) {
            if ($newid) {
                echo '.';
            }
            else {
                echo 'X';
            }
        }
        backup_flush(300);

        if ($newid) {
            backup_putid($restore->backup_unique_code, 'facetoface_signups', $oldid, $newid);
        }
        else {
            $status = false;
        }

        $status &= restore_facetoface_signups_status($signupinfo, $restore);
    }

    return $status;
}

/**
 * Restore the facetoface_signups_status table entries for a given
 * facetoface activity
 */
function restore_facetoface_signups_status($info, $restore) {

    $status = true;

    if (empty($info['#']['SIGNUPS_STATUS'])) {
        return $status; // Nothing to restore
    }

    $signups = $info['#']['SIGNUPS_STATUS']['0']['#']['STATUS'];
    foreach ($signups as $signupinfo) {

        $signup = new Object();
        $signup->signupid           = backup_todb($signupinfo['#']['SIGNUPID']['0']['#']);
        $signup->statuscode         = backup_todb($signupinfo['#']['STATUSCODE']['0']['#']);
        $signup->superceded         = backup_todb($signupinfo['#']['SUPERCEDED']['0']['#']);
        $signup->grade              = backup_todb($signupinfo['#']['GRADE']['0']['#']);
        $signup->note               = backup_todb($signupinfo['#']['NOTE']['0']['#']);
        $signup->advice             = backup_todb($signupinfo['#']['ADVICE']['0']['#']);
        $signup->createdby          = backup_todb($signupinfo['#']['CREATEDBY']['0']['#']);
        $signup->timecreated        = backup_todb($signupinfo['#']['TIMECREATED']['0']['#']);
        $signup->mailed = 0;

        // Fix the signupid
        $signupid = backup_getid($restore->backup_unique_code, 'facetoface_signups', $signup->signupid);
        $signup->signupid = $signupid->new_id;

        $newid = insert_record('facetoface_signups_status', $signup);

        // Progress bar
        if (!defined('RESTORE_SILENTLY')) {
            if ($newid) {
                echo '.';
            } else {
                echo 'X';
            }
        }
        backup_flush(300);

        if (!$newid) {
            $status = false;
        }
    }

    return $status;
}

/**
 * Restore the facetoface_sessions table entries for a given
 * facetoface activity
 *
 * @param integer $newfacetofaceid ID of the facetoface activity we're creating
 */
function restore_facetoface_sessions($newfacetofaceid, $info, $restore)
{
    $status = true;

    if (empty($info['MOD']['#']['SESSIONS'])) {
        return $status; // Nothing to restore
    }

    $sessions = $info['MOD']['#']['SESSIONS']['0']['#']['SESSION'];
    foreach ($sessions as $sessioninfo) {
        $oldid = backup_todb($sessioninfo['#']['ID']['0']['#']);

        $session->facetoface    = $newfacetofaceid;
        $session->capacity      = backup_todb($sessioninfo['#']['CAPACITY']['0']['#']);
        $session->details       = backup_todb($sessioninfo['#']['DETAILS']['0']['#']);
        $session->datetimeknown = backup_todb($sessioninfo['#']['DATETIMEKNOWN']['0']['#']);
        $session->duration      = backup_todb($sessioninfo['#']['DURATION']['0']['#']);
        $session->normalcost    = backup_todb($sessioninfo['#']['NORMALCOST']['0']['#']);
        $session->discountcost  = backup_todb($sessioninfo['#']['DISCOUNTCOST']['0']['#']);
        $session->timecreated   = backup_todb($sessioninfo['#']['TIMECREATED']['0']['#']);
        $session->timemodified  = backup_todb($sessioninfo['#']['TIMEMODIFIED']['0']['#']);

        $newid = insert_record('facetoface_sessions', $session);

        // Progress bar
        if (!defined('RESTORE_SILENTLY')) {
            if ($newid) {
                echo '.';
            }
            else {
                echo 'X';
            }
        }
        backup_flush(300);

        if ($newid) {
            backup_putid($restore->backup_unique_code, 'facetoface_sessions', $oldid, $newid);

            // Table: facetoface_session_roles
            $status &= restore_facetoface_session_roles($newid, $sessioninfo, $restore);

            // Table: facetoface_sessions_dates
            $status &= restore_facetoface_sessions_dates($newid, $sessioninfo, $restore);

            // Table: facetoface_session_data
            $status &= restore_facetoface_session_data($newid, $sessioninfo, $restore);
        }
        else {
            $status = false;
        }
    }

    return $status;
}

/**
 * Restore the facetoface_session_roles table entries for a given
 * facetoface session
 *
 * @param integer $newsessionid ID of the session we are creating
 */
function restore_facetoface_session_roles($newsessionid, $sessioninfo, $restore) {

    $status = true;

    if (empty($sessioninfo['#']['ROLES'])) {
        return $status; // Nothing to restore
    }

    $roles = $sessioninfo['#']['ROLES']['0']['#']['ROLE'];
    foreach ($roles as $roleinfo) {
        $oldid = backup_todb($roleinfo['#']['ID']['0']['#']);

        $role = new Object();
        $role->sessionid  = $newsessionid;
        $role->roleid  = backup_todb($roleinfo['#']['ROLEID']['0']['#']);
        $role->userid = backup_todb($roleinfo['#']['USERID']['0']['#']);

        $newid = insert_record('facetoface_session_roles', $role);

        // Progress bar
        if (!defined('RESTORE_SILENTLY')) {
            if ($newid) {
                echo '.';
            } else {
                echo 'X';
            }
        }
        backup_flush(300);

        if ($newid) {
            backup_putid($restore->backup_unique_code, 'facetoface_session_roles', $oldid, $newid);
        } else {
            $status = false;
        }
    }

    return $status;
}

/**
 * Restore the facetoface_sessions_dates table entries for a given
 * facetoface session
 *
 * @param integer $newsessionid ID of the session we are creating
 */
function restore_facetoface_sessions_dates($newsessionid, $sessioninfo, $restore)
{
    $status = true;

    if (empty($sessioninfo['#']['DATES'])) {
        return $status; // Nothing to restore
    }

    $dates = $sessioninfo['#']['DATES']['0']['#']['DATE'];
    foreach ($dates as $dateinfo) {
        $oldid = backup_todb($dateinfo['#']['ID']['0']['#']);

        $date = new object();
        $date->sessionid  = $newsessionid;
        $date->timestart  = backup_todb($dateinfo['#']['TIMESTART']['0']['#']);
        $date->timefinish = backup_todb($dateinfo['#']['TIMEFINISH']['0']['#']);

        $newid = insert_record('facetoface_sessions_dates', $date);

        // Progress bar
        if (!defined('RESTORE_SILENTLY')) {
            if ($newid) {
                echo '.';
            }
            else {
                echo 'X';
            }
        }
        backup_flush(300);

        if ($newid) {
            backup_putid($restore->backup_unique_code, 'facetoface_sessions_dates', $oldid, $newid);
        }
        else {
            $status = false;
        }
    }

    return $status;
}

/**
 * Restore the facetoface_session_data table entries for a given
 * facetoface session
 *
 * @param integer $newsessionid ID of the session we are creating
 */
function restore_facetoface_session_data($newsessionid, $sessioninfo, $restore)
{
    $status = true;

    if (empty($sessioninfo['#']['DATA'])) {
        return $status; // Nothing to restore
    }

    $fieldids = get_records('facetoface_session_field', '', '', '', 'shortname, id');

    $data = $sessioninfo['#']['DATA']['0']['#']['DATUM'];
    foreach ($data as $datuminfo) {
        $fieldshortname = backup_todb($datuminfo['#']['FIELDSHORTNAME']['0']['#']);

        if (empty($fieldids[$fieldshortname])) {
            // Custom field not defined on destination site
            if (!defined('RESTORE_SILENTLY')) {
                echo 'S';
            }
            continue;
        }

        $oldid = backup_todb($datuminfo['#']['ID']['0']['#']);

        $datum = new object();
        $datum->sessionid = $newsessionid;
        $datum->fieldid   = $fieldids[$fieldshortname]->id;
        $datum->data      = backup_todb($datuminfo['#']['DATA']['0']['#']);

        $newid = insert_record('facetoface_session_data', $datum);

        // Progress bar
        if (!defined('RESTORE_SILENTLY')) {
            if ($newid) {
                echo '.';
            }
            else {
                echo 'X';
            }
        }
        backup_flush(300);

        if ($newid) {
            backup_putid($restore->backup_unique_code, 'facetoface_session_data', $oldid, $newid);
        }
        else {
            $status = false;
        }
    }

    return $status;
}

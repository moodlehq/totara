<?php

require_once($CFG->dirroot . '/local/totara_msg/lib.php');

// how many locked crons to ignore before starting to print errors
define('TOTARA_MSG_CRON_WAIT_NUM', 10);
// how often to print errors (1 for every time, 2 every other time, etc)
define('TOTARA_MSG_CRON_ERROR_FREQ', 10);

// age for expiring undismissed notifications - days
define('TOTARA_MSG_CRON_DISMISS_NOTIFICATIONS', 30);

// age for expiring undismissed reminders - days
define('TOTARA_MSG_CRON_DISMISS_REMINDERS', 30);

// age for purging messages - days
define('TOTARA_MSG_CRON_PURGE', 1);


/**
 * Run the cron functions required by messages20
 *
 * @return boolean True if completes successfully, false otherwise
 */
function totara_msg_cron() {
    global $CFG;

    if(!tm_lock_cron()) {
        // don't run if already in progress
        mtrace('Totara Msg cron locked. Skipping this time.');
        return false;
    }

    // dismiss old notifications
    $time = time() - (TOTARA_MSG_CRON_DISMISS_NOTIFICATIONS * (24 * 60 * 60));
    $msgs = tm_messages_get_by_time('totara_notification', $time);
    foreach ($msgs as $msg) {
        tm_message_dismiss($msg->id);
    }

    // dismiss old reminders
    $time = time() - (TOTARA_MSG_CRON_DISMISS_REMINDERS * (24 * 60 * 60));
    $msgs = tm_messages_get_by_time('totara_reminder', $time);
    foreach ($msgs as $msg) {
        tm_message_dismiss($msg->id);
    }

    // purge old dismissed messages
    $time = time() - (TOTARA_MSG_CRON_PURGE * (24 * 60 * 60));
    delete_records_select('message_metadata', 'messageid IN (SELECT id FROM ' . $CFG->prefix . 'message_read20 WHERE timecreated < '.$time.')');
    delete_records_select('message_read20', 'timecreated < '.$time);

    // clean up orphaned metadata records - shouldn't really need this - may remove later
    $msgs = get_records('message20', '', '', '', 'id');
    $ids = array();
    if ($msgs) {
        foreach ($msgs as $msg) {
            $ids []= $msg->id;
        }
    }
    $msgs = get_records('message_read20', '', '', '', 'id');
    if ($msgs) {
        foreach ($msgs as $msg) {
            $ids []= $msg->id;
        }
    }
    $ids = array_unique($ids, SORT_NUMERIC);
    if (count($ids) > 0) {
        delete_records_select('message_metadata', 'messageid NOT IN ('.implode(',', $ids).')');
    }

    tm_unlock_cron();
    return true;
}


/**
 * get message ids by time
 *
 * @param string $type - message type
 * @param string $time_created - timecreated before
 * @return array of messages
 */
function tm_messages_get_by_time($type, $time_created) {
        global $USER;

        // select only particular type
        $processor = get_record('message_processors20', 'name', $type);
        if (empty($processor)) {
            return false;
        }

        // hunt for messages
        $msgs = get_records_sql("SELECT m.id
                                        FROM (mdl_message20 m INNER JOIN  mdl_message_working20 w ON m.id = w.unreadmessageid)
                                        WHERE w.processorid = ".$processor->id.' AND m.timecreated < '.$time_created);
        return $msgs ? $msgs : array();
}


/**
 * Attempt to lock the totara_msg cron.
 *
 * If it is already locked, track how long for and start printing
 * warnings to the error log if it remains locked for too long.
 *
 * @return boolean True if cron successfully locked
 */
function tm_lock_cron() {

    $cronlock = get_config('local_totara_msg', 'cron_lock');
    // cron is not locked, lock and return true
    if($cronlock === false || $cronlock == 0) {
        set_config('cron_lock', 1, 'local_totara_msg');
        return true;
    }

    // increment cron lock count
    $cronlock++;
    set_config('cron_lock', $cronlock, 'local_totara_msg');

    // report errors every so often after a set delay
    // this is to give time to let a long cron complete
    // and to avoid filling up the error log with too many
    // messages
    if($cronlock >= TOTARA_MSG_CRON_WAIT_NUM) {
        if($cronlock % TOTARA_MSG_CRON_ERROR_FREQ == 0) {
            error_log('Totara Msg cron still locked on attempt '.$cronlock);
        }
    }

    return false;
}

/**
 * Unlock the report builder cron.
 *
 * @return True
 */
function tm_unlock_cron() {
    set_config('cron_lock', 0, 'local_totara_msg');
    return true;
}

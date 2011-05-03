<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 * 
 * This program is free software; you can redistribute it and/or modify  
 * it under the terms of the GNU General Public License as published by  
 * the Free Software Foundation; either version 2 of the License, or     
 * (at your option) any later version.                                   
 *                                                                       
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Piers Harding <piers@catalyst.net.nz>
 * @package totara
 * @subpackage totara_msg 
 */

require_once($CFG->dirroot . '/local/totara_msg/lib.php');

// how many locked crons to ignore before starting to print errors
define('TOTARA_MSG_CRON_WAIT_NUM', 10);
// how often to print errors (1 for every time, 2 every other time, etc)
define('TOTARA_MSG_CRON_ERROR_FREQ', 10);

// age for expiring undismissed alerts - days
define('TOTARA_MSG_CRON_DISMISS_ALERTS', 30);

// age for expiring undismissed tasks - days
define('TOTARA_MSG_CRON_DISMISS_TASKS', 30);

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

    // dismiss old alerts
    $time = time() - (TOTARA_MSG_CRON_DISMISS_ALERTS * (24 * 60 * 60));
    $msgs = tm_messages_get_by_time('totara_alert', $time);
    foreach ($msgs as $msg) {
        tm_message_dismiss($msg->id);
    }

    // dismiss old taskes
    $time = time() - (TOTARA_MSG_CRON_DISMISS_TASKS * (24 * 60 * 60));
    $msgs = tm_messages_get_by_time('totara_task', $time);
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
        global $USER, $CFG;

        // select only particular type
        $processor = get_record('message_processors20', 'name', $type);
        if (empty($processor)) {
            return false;
        }

        // hunt for messages
        $msgs = get_records_sql("SELECT m.id
                                        FROM ({$CFG->prefix}message20 m INNER JOIN  {$CFG->prefix}message_working20 w ON m.id = w.unreadmessageid)
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

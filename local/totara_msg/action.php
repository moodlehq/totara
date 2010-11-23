<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * For listing message histories between any two users
 *
 * @author Piers Harding
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package totara_msg
 */

require_once('../../config.php');
require_once('lib.php');

require_login();

if (isguestuser()) {
    redirect($CFG->wwwroot);
}

if (empty($CFG->messaging)) {
    print_error('disabled', 'message');
}

/// Script parameters
$returnto = optional_param('returnto', $CFG->wwwroot, PARAM_RAW);
$dismiss = optional_param('dismiss', NULL, PARAM_RAW);
$accept = optional_param('accept', NULL, PARAM_RAW);
$reject = optional_param('reject', NULL, PARAM_RAW);
$msgids = explode(',', optional_param('msgids', array(), PARAM_RAW));

// hunt for Message Ids in the POST parameters
foreach ($_POST as $parm => $value) {
    if (preg_match('/^totara\_message\_(\d+)$/', $parm)) {
        $msgid = optional_param($parm, NULL, PARAM_INT);
        if ($msgid) {
            $msgids[]=$msgid;
        }
    }
}

// validate each of the messages
$ids = array();
foreach ($msgids as $msgid) {
    // check message ownership
    if ($msgid) {
        $message = get_record('message20', 'id', $msgid);
        if (!$message || $message->useridto != $USER->id) {
            print_error('notyours', 'local_totara_msg', $msgid);
        }

        $metadata = get_record('message_metadata', 'messageid', $msgid);

        // cannot run reject on message with no onreject
        if ($reject && (!isset($metadata->onreject) || !$metadata->onreject)) {
            continue;
        }

        // cannot run accept on message with no accept
        if ($accept && (!isset($metadata->onaccept) || !$metadata->onaccept)) {
            continue;
        }

        $ids[$msgid] = $message;
    }
}

// process the action
foreach ($ids as $msgid => $message) {

    if ($dismiss) {
        // dismiss the message and then return
        tm_message_dismiss($msgid);
    }
    else if ($accept) {
        // onaccept the message and then return
        tm_message_reminder_accept($msgid);
    }
    else if ($reject) {
        // onreject the message and then return
        tm_message_reminder_reject($msgid);
    }
}

// send them home
redirect($returnto);

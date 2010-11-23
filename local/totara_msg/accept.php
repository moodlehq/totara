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
$msgid = required_param('id', PARAM_INT);
$returnto = optional_param('returnto', NULL, PARAM_RAW);

// check message ownership
$message = get_record('message20', 'id', $msgid);
if (!$message || $message->useridto != $USER->id) {
    print_error('notyours', 'local_totara_msg', null, $msgid);
}

// onaccept the message and then return
tm_message_reminder_accept($msgid);

if ($returnto) {
    redirect($returnto);
}

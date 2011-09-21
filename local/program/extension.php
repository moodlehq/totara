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
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage program
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot . '/local/program/lib.php');

require_login();

$programid = required_param('id', PARAM_INT);
$userid = required_param('userid', PARAM_INT);
$extensionrequest = optional_param('extrequest', false, PARAM_BOOL);
$extensiondate = optional_param('extdate', '', PARAM_TEXT);
$extensionreason = optional_param('extreason', '', PARAM_TEXT);

if ($USER->id != $userid) {
    @header('HTTP/1.0 404 Not Found');
    echo get_string('error:cannotrequestextnotuser', 'local_program');
    return false;
}

$program = new program($programid);

if (!$extensionrequest || !$extensiondate || !$extensionreason) {
    @header('HTTP/1.0 404 Not Found');
    echo get_string('error:processingextrequest', 'local_program');
    return false;
}

if (!$manager = totara_get_manager($userid)) {
    @header('HTTP/1.0 404 Not Found');
    echo get_string('extensionrequestfailed:nomanager', 'local_program');
    return false;
}

$timearray = explode('/', $extensiondate);
$day = $timearray[0];
$month = $timearray[1];
$year = $timearray[2];
$extensiontime = mktime(0, 0, 0, $month, $day, $year);

$extensiondata = array(
    'extensiondate'         => $extensiontime,
    'extensiondatestr'      => $extensiondate,
    'extensionreason'       => $extensionreason,
    'programfullname'       => format_string($program->fullname)
);

$extensiondate_timestamp = dp_convert_userdate($extensiondate);  // convert to timestamp

$extension = new stdClass;
$extension->programid = $program->id;
$extension->userid = $userid;
$extension->extensiondate = $extensiondate_timestamp;

// Validated extension date to make sure it is after
// current due date and not in the past
if ($prog_completion = get_record('prog_completion', 'programid', $program->id, 'userid', $userid, 'coursesetid', 0)) {
    $duedate = empty($prog_completion->timedue) ? 0 : $prog_completion->timedue;

    if ($extensiondate_timestamp < $duedate) {
        @header('HTTP/1.0 404 Not Found');
        echo get_string('extensionearlierthanduedate', 'local_program');
        return false;
    }
} else {
    @header('HTTP/1.0 404 Not Found');
    echo get_string('error:noprogramcompletionfound', 'local_program');
    return false;
}

$now = time();
if ($extensiondate_timestamp < $now) {
    @header('HTTP/1.0 404 Not Found');
    echo get_string('extensionbeforenow', 'local_program');
    return false;
}

$extension->extensionreason = $extensionreason;
$extension->status = 0;

if ($extensionid = insert_record('prog_extension', $extension)) {

    $extension_message = new prog_extension_request_message($program->id, $extension->userid);
    $managermessagedata = $extension_message->get_manager_message_data();
    $managermessagedata->subject = get_string('extensionrequest', 'local_program');
    $managermessagedata->fullmessage = stripslashes(get_string('extensionrequestmessage', 'local_program', (object)$extensiondata));

    // Get user to send message to
    $user = get_record('user', 'id', $userid);

    if ($extension_message->send_message($manager, $user)) {
        // Calcuate the new time and print pending extension text

        echo $program->get_time_allowance_and_extension_text($userid, false);
    } else {
        @header('HTTP/1.0 404 Not Found');
        echo get_string('extensionrequestnotsent', 'local_program');
        return false;
    }

} else {
    @header('HTTP/1.0 404 Not Found');
    echo get_string('extensionrequestfailed', 'local_program');
    return false;
}

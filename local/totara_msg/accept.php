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

/**
 * For listing message histories between any two users
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

// Validate redirect
$return_host = parse_url($returnto);
$site_host = parse_url($CFG->wwwroot);
if($return_host['host'] != $site_host['host']) {
    error(get_string('error:redirecttoexternal', 'local_totara_msg'));
}

// check message ownership
$message = get_record('message20', 'id', $msgid);
if (!$message || $message->useridto != $USER->id) {
    print_error('notyours', 'local_totara_msg', null, $msgid);
}

// onaccept the message and then return
tm_message_task_accept($msgid);

if ($returnto) {
    redirect($returnto);
}

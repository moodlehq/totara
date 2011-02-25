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
 * @subpackage reportbuilder 
 */

/**
 * Page containing column display options, displayed inside show/hide popup dialog
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once($CFG->dirroot.'/local/totara_msg/lib.php');

require_login();

if (isguestuser()) {
    redirect($CFG->wwwroot);
}

if (empty($CFG->messaging)) {
    print_error('disabled', 'message');
}

$id = required_param('id', PARAM_INT);
$msg = get_record('message20', 'id', $id);
if (!$msg || $msg->useridto != $USER->id) {
    print_error('notyours', 'local_totara_msg', $id);
}
$metadata = get_record('message_metadata', 'messageid', $id);

//$display = totara_msg_msgstatus_text($metadata->msgstatus);
//$display = totara_msg_urgency_text($metadata->urgency);
//$urgency = $display['icon'];
//$urgency_alt = $display['text'];
//$display = totara_msg_msgtype_text($metadata->msgtype);
//$type = $display['icon'];
//$type_alt = $display['text'];

$from = get_record('user', 'id', $msg->useridfrom);
$fromlink = '<a href="'.$CFG->wwwroot.'/user/view.php?id='.$from->id.'">'.fullname($from).'</a>';
$subject = format_string($msg->subject);
$icon = '<img class="msgicon" src="' . totara_msg_icon_url($metadata->icon) . '" title="' . format_string($msg->subject) . '" alt="' . format_string($msg->subject) .'" />';
print '<div id="totara-msgs-dismiss"><table>';
if(!empty($msg->subject)) {
    print '<tr><td class="totara-msgs-action-left"><label for="dismiss-type">' . get_string('subject', 'forum').'</label></td>';
    print "<td class=\"totara-msgs-action-right\"><div id='dismiss-type'>{$subject}</div></td></tr>";
}
//print '<tr><td class="totara-msgs-action-left"><label for="dismiss-status">' . get_string('urgency', 'block_totara_alerts').'</label></td>';
//print "<td class=\"totara-msgs-action-right\"><div id='dismiss-status'><img class=\"iconsmall\" src=\"{$urgency}\" title=\"{$urgency_alt}\" alt=\"{$urgency_alt}\" /></div></td></tr>";
print '<tr><td class="totara-msgs-action-left"><label for="dismiss-type">' . get_string('type', 'block_totara_alerts').'</label></td>';
print "<td class=\"totara-msgs-action-right\"><div id='dismiss-type'>{$icon}</div></td></tr>";
print '<tr><td class="totara-msgs-action-left"><label for="dismiss-from">' . get_string('from', 'block_totara_alerts').'</label></td>';
print "<td class=\"totara-msgs-action-right\"><div id='dismiss-from'>{$fromlink}</div></td></tr>";
print '<tr><td class="totara-msgs-action-left"><label for="dismiss-statement">' . get_string('statement', 'block_totara_alerts').'</label>';
print "<td class=\"totara-msgs-action-right\"><div id='dismiss-statement'>{$msg->fullmessagehtml}</div></td></tr>";
if ( $msg->contexturl && $msg->contexturlname ){
    print '<tr><td class="totara-msgs-action-left"><label for="dismiss-context">' . get_string('context', 'block_totara_alerts').'</label>';
    print "<td class=\"totara-msgs-action-right\"><div id=\"dismiss-statement\"><a href=\"{$msg->contexturl}\" >{$msg->contexturlname}</a></div></td></tr>";
}
print '</table></div>';

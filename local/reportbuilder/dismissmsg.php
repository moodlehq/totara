<?php

/**
 * Page containing column display options, displayed inside show/hide popup dialog
 *
 * @copyright Catalyst IT Limited
 * @author Piers Harding
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
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

$display = totara_msg_msgstatus_text($metadata->msgstatus);
$status = $display['icon'];
$status_alt = $display['text'];
$display = totara_msg_msgtype_text($metadata->msgtype);
$type = $display['icon'];
$type_alt = $display['text'];

$from = get_record('user', 'id', $msg->useridfrom);
$fromname = fullname($from);
print '<div id="totara-msgs-dismiss"><table>';
print '<tr><td class="totara-msgs-action-left"><label for="dismiss-status">' . get_string('status', 'block_totara_notify').'</label></td>';
print "<td class=\"totara-msgs-action-right\"><div id='dismiss-status'><img class=\"iconsmall\" src=\"{$status}\" alt=\"{$status_alt}\" /></div></td></tr>";
print '<tr><td class="totara-msgs-action-left"><label for="dismiss-type">' . get_string('type', 'block_totara_notify').'</label></td>';
print "<td class=\"totara-msgs-action-right\"><div id='dismiss-type'><img class=\"iconsmall\" src=\"{$type}\" alt=\"{$type_alt}\" /></div></td></tr>";
print '<tr><td class="totara-msgs-action-left"><label for="dismiss-from">' . get_string('from', 'block_totara_notify').'</label></td>';
print "<td class=\"totara-msgs-action-right\"><div id='dismiss-from'>{$fromname}</div></td></tr>";
print '<tr><td class="totara-msgs-action-left"><label for="dismiss-statement">' . get_string('statement', 'block_totara_notify').'</label>';
print "<td class=\"totara-msgs-action-right\"><div id='dismiss-statement'>{$msg->fullmessage}</div></td></tr>";
print '</table></div>';

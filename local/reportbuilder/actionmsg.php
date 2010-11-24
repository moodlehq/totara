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
        $ids[$msgid] = $message;
    }
}

if ($dismiss) {
    // dismiss the message and then return
    $action = 'dismiss';
}
else if ($accept) {
    // onaccept the message and then return
    $action = 'accept';
}
else if ($reject) {
    // onreject the message and then return
    $action = 'reject';
}
print '<input type="hidden" name="'.$action.'" value="'.$action.'" />';

// process the action
print '<div id="totara-msgs-action"><table>';
//print '<tr><th>'.get_string('status', 'block_totara_notify').'</th><th>'.
print '<tr><th>'.get_string('urgency', 'block_totara_notify').'</th><th>'.
                get_string('type', 'block_totara_notify').'</th><th>'.
                get_string('from', 'block_totara_notify').'</th><th>'.
                get_string('statement', 'block_totara_notify').'</th></tr>';

foreach ($ids as $msgid => $msg) {
    $metadata = get_record('message_metadata', 'messageid', $msgid);

    // cannot run reject on message with no onreject
    if ($reject && (!isset($metadata->onreject) || !$metadata->onreject)) {
        continue;
    }

    // cannot run accept on message with no accept
    if ($accept && (!isset($metadata->onaccept) || !$metadata->onaccept)) {
        continue;
    }

//    $display = isset($metadata->msgstatus) ? totara_msg_msgstatus_text($metadata->msgstatus) : array('icon' => '', 'text' => '');
//    $status = $display['icon'];
//    $status_alt = $display['text'];
    $display = isset($metadata->urgency) ? totara_msg_urgency_text($metadata->urgency) : array('icon' => '', 'text' => '');
    $urgency = $display['icon'];
    $urgency_alt = $display['text'];
    $display = isset($metadata->msgtype) ? totara_msg_msgtype_text($metadata->msgtype) : array('icon' => '', 'text' => '');
    $type = $display['icon'];
    $type_alt = $display['text'];
    $from = get_record('user', 'id', $msg->useridfrom);
    $fromname = fullname($from);
    print '<tr>';
//    print "<td class=\"totara-msgs-action-right\"><div id='dismiss-status'><img class=\"iconsmall\" src=\"{$status}\" alt=\"{$status_alt}\" /></div></td>";
    print "<td class=\"totara-msgs-action-right\"><div id='dismiss-status'><img class=\"iconsmall\" src=\"{$urgency}\" title=\"{$urgency_alt}\" alt=\"{$urgency_alt}\" /></div></td>";
    print "<td class=\"totara-msgs-action-right\"><div id='dismiss-type'><img class=\"iconsmall\" src=\"{$type}\" alt=\"{$type_alt}\" /></div></td>";
    print "<td class=\"totara-msgs-action-right\"><div id='dismiss-from'>{$fromname}</div></td>";
    print "<td class=\"totara-msgs-action-right\"><div id='dismiss-statement'>{$msg->fullmessage}</div></td>";
    print "</tr>";
}
print '</table></div>';

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
 * OAuth library
 * @package   localtotaramessages
 * @copyright 2010 Moodle Pty Ltd (http://moodle.com)
 * @author    Piers Harding
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// block display limits
define('TOTARA_MSG_NOTIFY_LIMIT', 5);
define('TOTARA_MSG_REMINDER_LIMIT', 5);

require_once('messagelib.php');

/**
 * Get the language string  and icon for the message status
 *
 * @param $msgstatus int message status
 * @return array('text' => , 'icon' => '')
 */
function totara_msg_msgstatus_text($msgstatus) {
    global $CFG;

    if ($msgstatus == TOTARA_MSG_STATUS_OK) {
        $status = 'go';
        $text = get_string('statusok', 'block_totara_notify');
    }
    else if ($msgstatus == TOTARA_MSG_STATUS_NOTOK) {
        $status = 'stop';
        $text = get_string('statusnotok', 'block_totara_notify');
    }
    else {
        $status = 'grey_undecided';
        $text = get_string('statusundecided', 'block_totara_notify');
    }
    return array('text' => $text, 'icon' =>  $CFG->wwwroot . '/theme/' . $CFG->theme . '/pix/t/'.$status.'.gif');
}

/**
 * Get the language string  and icon for the message urgency
 *
 * @param $urgency int message urgency
 * @return array('text' => , 'icon' => '')
 */
function totara_msg_urgency_text($urgency) {
    global $CFG;

    if ($urgency == TOTARA_MSG_URGENCY_URGENT) {
        $level = 'stop';
        $text = get_string('urgent', 'block_totara_notify');
    }
    else {
        $level = 'grey_undecided';
        $text = get_string('normal', 'block_totara_notify');
    }
    return array('text' => $text, 'icon' =>  $CFG->wwwroot . '/theme/' . $CFG->theme . '/pix/t/'.$level.'.gif');
}

/**
 * Get the short name of the message type
 *
 * @param $urgency int message urgency
 * @return array('text' => , 'icon' => '')
 */
function totara_msg_cssclass($msgtype) {
    global $TOTARA_MESSAGE_TYPES;

    return $TOTARA_MESSAGE_TYPES[$msgtype];
}

/**
 * Get the language string  and icon for the message type
 *
 * @param $msgtype int message type
 * @return array('text' => , 'icon' => '')
 */
function totara_msg_msgtype_text($msgtype) {
    global $CFG;

    switch ($msgtype) {
//        case :

        default:
            $text = get_string('local_totara_msg', 'unknown');
            $icon = 'unknown';
            break;
    }
    return array('text' => $text, 'icon' =>  $CFG->wwwroot . '/theme/' . $CFG->theme . '/pix/t/'.$icon.'.gif');
}



/**
 * Get the eventdata for a given event type
 * @param $id - message id
 * @param $event - event type
 * @param $metadata - allready read metadata record
 */
function totara_msg_eventdata($id, $event, $metadata=null) {
    if (empty($metadata)) {
        $metadata = get_record('message_metadata', 'messageid', $id);
    }
    error_reporting(E_ALL & !E_NOTICE);
    if ($event == 'onaccept') {
        $eventdata = unserialize($metadata->onaccept);
    }
    else {
        $eventdata = unserialize($metadata->onreject);
    }
    error_reporting(E_ALL);
    return $eventdata;
}


/**
 * construct the dismiss action
 *
 * @param int $id message Id
 * @return string HTML of dismiss button
 */
function totara_msg_dismiss_action($id) {
    global $CFG, $FULLME;

    $str = get_string('dismiss', 'block_totara_notify');
    return
    '<td><script type="text/javascript"> '.
        "var shortname = 'whydoIneedAshortName';" .
    "// bind functionality to page on load
    $(function() {
        // dismiss dialog
        (function() {
            $('#dismissmsg".$id."-dialog').css('display','block');
            var url = '{$CFG->wwwroot}/local/reportbuilder/';
            var handler = new totaraDialog_handler_confirm();
            var name = 'dismissmsg".$id."';
            totaraDialogs[name] = new totaraDialog(
                name,
                name+'-dialog',
                {
                    buttons: {
                        'Cancel': function() { handler._cancel() },
                        'Dismiss': function() { handler._confirm('{$CFG->wwwroot}/local/totara_msg/dismiss.php?id={$id}', '{$FULLME}') }
                    },
                    title: '<h2>{$str}</h2>',
                    width: 600,
                    height: 400
                },
                url+'dismissmsg.php?id=".$id."',
                handler
            );
        })();
    });" .
    '</script>'.
    '<form><input id="dismissmsg'.$id.'-dialog" type="image" name="tm_dismiss_msg" class="iconsmall action"'.
    ' src="' . $CFG->wwwroot . '/theme/' . $CFG->theme . '/pix/t/dismiss.gif" title="'.$str.'"'.
    ' alt="'.$str.'" style="display:none;"/>'.
    '</form>
    <noscript>
    <form action="' . $CFG->wwwroot . '/local/totara_msg/dismiss.php?id=' . $id . '" method="post">
    <input type="hidden" name="id" value="' . $id . '" />
    <input type="hidden" name="returnto" value="' . $FULLME . '" />
    <input type="image" class="iconsmall" src="' . $CFG->wwwroot . '/theme/' . $CFG->theme . '/pix/t/dismiss.gif" title="'.$str.'" alt="'.$str.'" />
    </form>
    </noscript></td>';

}


/**
 * checkbox all/none script
 *
 * @param int $id message Id
 * @return string HTML of dismiss button
 */
function totara_msg_checkbox_all_none() {

    return '<script>
                function jqCheckAll( id, name, flag ) {
                   if (flag == 0) {
                      $("form#" + id + " INPUT[@name=" + name + "][type=\'checkbox\']").attr(\'checked\', false);
                   }
                   else {
                      $("form#" + id + " INPUT[@name=" + name + "][type=\'checkbox\']").attr(\'checked\', true);
                   }
                }
              </script>';
}


/**
 * action buttons
 *
 * @param string $action action to perform
 * @return string HTML of dismiss button
 */
function totara_msg_action_button($action) {
    global $CFG, $FULLME;

    $str = get_string($action, 'local_totara_msg');
    return
    '<script type="text/javascript">
        var shortname = \'whydoIneedAshortName\';
        '.
    "// bind functionality to page on load
    $(function() {
        // dismiss dialog
        (function() {
            $('#totara-{$action}').css('display','block');
            var url = '{$CFG->wwwroot}/local/reportbuilder/';
            var handler = new totaraDialog_handler_confirm();
            var name = '{$action}msg';
            totaraDialogs[name] = new totaraDialog(
                name,
                'totara-{$action}',
                {
                    buttons: {
                        'Cancel': function() { handler._cancel() },
                        '{$str}': function() { handler._confirm('{$CFG->wwwroot}/local/totara_msg/action.php?{$action}={$action}', '{$FULLME}') }
                    },
                    title: '<h2>{$str}</h2>',
                    width: 600,
                    height: 400
                },
                url+'actionmsg.php?{$action}={$action}',
                handler
            );
            // overload the load function so that we add the message ids
            totaraDialogs[name].load = function(url, method, onsuccess) {
                    // Add loading animation
                    this.dialog.html('');
                    this.showLoading();
                    msgids = [];
                    $(\"form#totara_messages INPUT[@name=totara_message][type='checkbox'][checked=true]\").each(
                                function () {
                                    msgids.push($(this).attr('value'));
                                });

                    // Save url
                    this.url = url+'&msgids='+msgids.join(',');

                    // Load page
                    this._request(this.url);
            }
        })();
    });
    " .
    '</script>';
}


/**
 * Construct the accept/reject actions
 *
 * @param int $id message Id
 * @return string HTML of dismiss button
 */
function totara_msg_accept_reject_action($id) {
    global $CFG, $FULLME;

    $msgmeta = get_record('message_metadata', 'messageid', $id);

    $onaccept_str = get_string('onaccept', 'block_totara_reminders');
    $onreject_str = get_string('onreject', 'block_totara_reminders');

    // only give the accept/reject actions if they actually exist
    $accept = '';
    $reject = '';
    $script =
    '<td><script type="text/javascript"> '.
        "var shortname = 'whydoIneedAshortName';" .
    "// bind functionality to page on load
    $(function() {
        // dismiss dialog
        (function() {
            $('#acceptmsg".$id."-dialog').css('display','block');
            $('#rejectmsg".$id."-dialog').css('display','block');
            var url = '{$CFG->wwwroot}/local/reportbuilder/';
            var handler_accept = new totaraDialog_handler_confirm();
            var handler_reject = new totaraDialog_handler_confirm();
            var name_accept = 'acceptmsg".$id."';
            var name_reject = 'rejectmsg".$id."';
            totaraDialogs[name_accept] = new totaraDialog(
                name_accept,
                name_accept+'-dialog',
                {
                    buttons: {
                        'Cancel': function() { handler_accept._cancel() },
                        'Accept': function() { handler_accept._confirm('{$CFG->wwwroot}/local/totara_msg/accept.php?id={$id}', '{$FULLME}') }
                    },
                    title: '<h2>{$onaccept_str}</h2>',
                    width: 600,
                    height: 400
                },
                url+'acceptrejectmsg.php?id=".$id."&event=onaccept',
                handler_accept
            );
            totaraDialogs[name_reject] = new totaraDialog(
                name_reject,
                name_reject+'-dialog',
                {
                    buttons: {
                        'Cancel': function() { handler_reject._cancel() },
                        'Reject': function() { handler_reject._confirm('{$CFG->wwwroot}/local/totara_msg/reject.php?id={$id}', '{$FULLME}') }
                    },
                    title: '<h2>{$onreject_str}</h2>',
                    width: 600,
                    height: 400
                },
                url+'acceptrejectmsg.php?id=".$id."&event=onreject',
                handler_reject
            );
        })();
    });" .
    '</script></td>';
    if (isset($msgmeta->onaccept) && $msgmeta->onaccept) {
        $accept =
            '<td><form><input id="acceptmsg'.$id.'-dialog" type="image" name="tm_accept_msg" class="iconsmall action"'.
            ' src="' . $CFG->wwwroot . '/theme/' . $CFG->theme . '/pix/t/accept.gif" title="'.$onaccept_str.'"'.
            ' alt="'.$onaccept_str.'" style="display:none;"/>'.
            '</form>'.
            '<noscript>
            <form action="' . $CFG->wwwroot . '/local/totara_msg/accept.php?id=' . $id . '" method="post">
            <input type="hidden" name="id" value="' . $id . '" />
            <input type="hidden" name="returnto" value="' . $FULLME . '" />
            <input type="image" class="iconsmall action" src="' . $CFG->wwwroot . '/theme/' . $CFG->theme . '/pix/t/accept.gif" title="'.$onaccept_str.'" alt="'.$onaccept_str.'" />
            </form>
            </noscript></td>';
    }
    if (isset($msgmeta->onreject) && $msgmeta->onreject) {
        $reject =
            '<td><form><input id="rejectmsg'.$id.'-dialog" type="image" name="tm_reject_msg" class="iconsmall action"'.
            ' src="' . $CFG->wwwroot . '/theme/' . $CFG->theme . '/pix/t/delete.gif" title="'.$onreject_str.'"'.
            ' alt="'.$onreject_str.'" style="display:none;"/>'.
            '</form>'.
            '<noscript>
            <form action="' . $CFG->wwwroot . '/local/totara_msg/reject.php?id=' . $id . '" method="post">
            <input type="hidden" name="id" value="' . $id . '" />
            <input type="hidden" name="returnto" value="' . $FULLME . '" />
            <input type="image" class="iconsmall action" src="' . $CFG->wwwroot . '/theme/' . $CFG->theme . '/pix/t/delete.gif" title="'.$onreject_str.'" alt="'.$onreject_str.'" />
            </form>
            </noscript></td>';
    }
    return $script.$accept.$reject;
}


function local_totara_msg_install() {
    global $CFG;

/// Install logging support
//    update_log_display_entry('local_totara_msg', 'add', 'local_totara_msg', 'name');

/// Check all message20 output plugins and upgrade if necessary
/// This is temporary until Totara goes to 2.x - then migrate local/totara_msg/message20 to message
    upgrade_plugins('local','local/totara_msg/message20/output',"$CFG->wwwroot/$CFG->admin/index.php");

    // hack to get cron working via admin/cron.php
    // at some point we should create a local_modules table
    // based on data in version.php
    set_config('local_totara_msg_cron', 60);
        
    return true;
}

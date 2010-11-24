<?php
/**
 *
 * @author  Piers Harding  piers@catalyst.net.nz
 * @version 0.0.1
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package local
 * @subpackage totara_msg
 *
 */

defined('MOODLE_INTERNAL') || die();

/**
* Extend the base plugin class
* This class contains the action for pingpong onaccept/onreject message processing
*/
class totara_msg_workflow_pingpong extends totara_msg_workflow_plugin_base {

    function onaccept($eventdata, $msg) {
        global $USER;

        // can manipulate the language by setting $SESSION->lang temporarily

        $newevent = new stdClass();
        $newevent->userfrom         = $USER;
        $user = get_record('user', 'id', $msg->useridfrom);
        $newevent->userto           = $user;
        $newevent->fullmessage      = 'Pingpong hoorah! We are still playing! with '.$eventdata['cnt'].' goes';
        $newevent->subject          = $newevent->fullmessage;

        // do the pingpong workflow event
        $onaccept = new stdClass();
        $onaccept->action = 'pingpong';
        $onaccept->text = 'To keep playing please press accept';
        $onaccept->data = array('forward_to' => $msg->useridto, 'cnt' => $eventdata['cnt'] + 1);
        $newevent->onaccept = $onaccept;
        $onreject = new stdClass();
        $onreject->action = 'pingpong';
        $onreject->text = 'To stop playing please press reject';
        $onreject->data = array('forward_to' => $msg->useridto, 'cnt' => $eventdata['cnt'] + 1);
        $newevent->onreject = $onreject;

        return tm_reminder_send($newevent);
    }

    function onreject($eventdata, $msg) {
        global $USER;

        // can manipulate the language by setting $SESSION->lang temporarily
        $newevent = new stdClass();
        $newevent->userfrom         = $USER;
        $user = get_record('user', 'id', $msg->useridfrom);
        $newevent->userto           = $user;
        $cnt                        = isset($eventdata['cnt']) ? $eventdata['cnt'] : 0;
        $newevent->fullmessage      = 'You stopped playing :-( after '.$cnt.' goes';
        $newevent->subject          = $newevent->fullmessage;
        $newevent->urgency          = TOTARA_MSG_URGENCY_NORMAL;

        return tm_notification_send($newevent);
    }

}
?>

<?php
    /**
    * Test message sender
    *
    * @package totara_test_msg
    * @category block
    * @subpackage totara
    * @author Piers Harding
    * @date 2010/11/03
    * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
    *
    * action for post
    *
    */

    /**
    * includes and requires
    */

    global $USER, $CFG;

    require_once('../../config.php');
    require_once('../../local/totara_msg/lib.php');

    require_login();

    $msg = stripslashes(optional_param('msg', '', PARAM_CLEAN));
    $subject = stripslashes(optional_param('subject', '', PARAM_CLEAN));
    $type = stripslashes(optional_param('type', '', PARAM_CLEAN));
    $roleid = stripslashes(optional_param('roleid', '', PARAM_CLEAN));

    $eventdata = new stdClass();
    $eventdata->userfrom         = $USER;
    $eventdata->userto           = $USER;
    $eventdata->subject          = $subject;
    $eventdata->fullmessage      = $msg;
    $eventdata->roleid           = $roleid;

    // can manipulate the language by setting $SESSION->lang temporarily

    if ($type == 'reminder') {
        // do the pingpong workflow event
        $onaccept = new stdClass();
        $onaccept->action = 'pingpong';
        $onaccept->text = 'To keep playing please press accept';
        $onaccept->data = array('forward_to' => $eventdata->userfrom->id, 'cnt' => 1);
        $eventdata->onaccept = $onaccept;
        $onreject = new stdClass();
        $onreject->action = 'pingpong';
        $onreject->text = 'To stop playing please press reject';
        $onreject->data = array('forward_to' => $eventdata->userto->id, 'cnt' => 1, 'message' => 'You stopped playing :-(');
        $eventdata->onreject = $onreject;
        $mailresult = tm_reminder_send($eventdata);
    }
    else {
        $mailresult = tm_notification_send($eventdata);
    }

    redirect($CFG->wwwroot);

?>

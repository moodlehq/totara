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
 * messagelib.php - Contains generic messaging functions for the message system
 *
 * @package    core
 * @subpackage message
 * @copyright  Luis Rodrigues and Martin Dougiamas
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once('message20/lib.php');

// message status constants
define('TOTARA_MSG_STATUS_UNDECIDED', 0);
define('TOTARA_MSG_STATUS_OK', 1);
define('TOTARA_MSG_STATUS_NOTOK', 2);

// message type constants
define('TOTARA_MSG_TYPE_UNKNOWN', 0);
define('TOTARA_MSG_TYPE_COURSE', 1);
define('TOTARA_MSG_TYPE_FORUM', 2);
define('TOTARA_MSG_TYPE_GRADING', 3);
define('TOTARA_MSG_TYPE_CHAT', 4);
define('TOTARA_MSG_TYPE_LESSON', 5);
define('TOTARA_MSG_TYPE_QUIZ', 6);
define('TOTARA_MSG_TYPE_FACE2FACE', 7);
define('TOTARA_MSG_TYPE_SURVEY', 8);
define('TOTARA_MSG_TYPE_SCORM', 9);
define('TOTARA_MSG_TYPE_LINK', 10);

// message type shortnames
global $TOTARA_MESSAGE_TYPES;
$TOTARA_MESSAGE_TYPES = array(
    TOTARA_MSG_TYPE_UNKNOWN => 'unknown',
    TOTARA_MSG_TYPE_COURSE => 'course',
    TOTARA_MSG_TYPE_FORUM => 'forum',
    TOTARA_MSG_TYPE_GRADING => 'grading',
    TOTARA_MSG_TYPE_CHAT => 'chat',
    TOTARA_MSG_TYPE_LESSON => 'lesson',
    TOTARA_MSG_TYPE_QUIZ => 'quiz',
    TOTARA_MSG_TYPE_FACE2FACE => 'face2face',
    TOTARA_MSG_TYPE_SURVEY => 'survey',
    TOTARA_MSG_TYPE_SCORM => 'scorm',
);

// message urgency constants
define('TOTARA_MSG_URGENCY_LOW', -4);
define('TOTARA_MSG_URGENCY_NORMAL', 0);
define('TOTARA_MSG_URGENCY_URGENT', 4);



/**
 * Called when a message provider wants to send a message.
 * This functions checks the user's processor configuration to send the given type of message,
 * then tries to send it.
 *
 * Required parameter $eventdata structure:
 *  modulename     -
 *  userfrom object the user sending the message
 *  userto object the message recipient
 *  subject string the message subject
 *  fullmessage - the full message in a given format
 *  fullmessageformat  - the format if the full message (FORMAT_MOODLE, FORMAT_HTML, ..)
 *  fullmessagehtml  - the full version (the message processor will choose with one to use)
 *  smallmessage - the small version of the message
 *  contexturl - if this is a alert then you can specify a url to view the event. For example the forum post the user is being notified of.
 *  contexturlname - the display text for contexturl
 *  msgstatus - int Message Status see TOTARA_MSG_STATUS* constants
 *  msgtype - int Message Type see TOTARA_MSG_TYPE* constants
 *  roleid - the user role - relates to the dashlets view restrictions
 *
 * @param object $eventdata information about the message (modulename, userfrom, userto, ...)
 * @return boolean success
 */
function tm_message_send($eventdata) {
    //global $CFG, $DB;
    global $CFG;

    //TODO: this function is very slow and inefficient, it would be a major bottleneck in cron processing, this has to be improved in 2.0
    //      probably we could add two parameters with user messaging preferences and we could somehow preload/cache them in cron

    //TODO: we need to solve problems with database transactions here somehow, for now we just prevent transactions - sorry
    //$DB->transactions_forbidden();

    if (is_int($eventdata->userto)) {
        mtrace('tm_message_send() userto is a user ID when it should be a user object');
        //$eventdata->userto = $DB->get_record('user', array('id' => $eventdata->useridto));
        $eventdata->userto = get_record('user', 'id', $eventdata->useridto);
    }
    if (is_int($eventdata->userfrom)) {
        mtrace('tm_message_send() userfrom is a user ID when it should be a user object');
        //$eventdata->userfrom = $DB->get_record('user', array('id' => $message->userfrom));
        $eventdata->userfrom = get_record('user', 'id', $message->userfrom);
    }

    // must have msgtype, urgency and msgstatus
    if (!isset($eventdata->msgstatus) || !is_int($eventdata->msgstatus)) {
        debugging('tm_message_send() msgstatus not set');
        return false;
    }
    if (!isset($eventdata->urgency) || !is_int($eventdata->urgency)) {
        debugging('tm_message_send() urgency not set');
        return false;
    }
    if (!isset($eventdata->msgtype) || !is_int($eventdata->msgtype)) {
        debugging('tm_message_send() msgtype not set');
        return false;
    }

    //after how long inactive should the user be considered logged off?
    if (isset($CFG->block_online_users_timetosee)) {
        $timetoshowusers = $CFG->block_online_users_timetosee * 60;
    } else {
        $timetoshowusers = 300;//5 minutes
    }

    // Work out if the user is logged in or not
    if ((time() - $timetoshowusers) < (isset($eventdata->userto->lastaccess)?$eventdata->userto->lastaccess:0)) {
        $userstate = 'loggedin';
    } else {
        $userstate = 'loggedoff';
    }

    // Create the message object
    $savemessage = new stdClass();
    $savemessage->useridfrom        = $eventdata->userfrom->id;
    $savemessage->useridto          = $eventdata->userto->id;
    $savemessage->subject           = addslashes($eventdata->subject);
    $savemessage->fullmessage       = addslashes($eventdata->fullmessage);
    $savemessage->fullmessageformat = $eventdata->fullmessageformat;
    $savemessage->fullmessagehtml   = addslashes($eventdata->fullmessagehtml);

    if (!empty($eventdata->smallmessage)) {
        $savemessage->smallmessage = addslashes($eventdata->smallmessage);
    } else {
        $savemessage->smallmessage = null;
    }

    if (!empty($eventdata->alert)) {
        $savemessage->alert = $eventdata->alert;
    } else {
        $savemessage->alert = 0;
    }

    if (!empty($eventdata->contexturl)) {
        $savemessage->contexturl = $eventdata->contexturl;
    } else {
        $savemessage->contexturl = null;
    }

    if (!empty($eventdata->contexturlname)) {
        $savemessage->contexturlname = addslashes($eventdata->contexturlname);
    } else {
        $savemessage->contexturlname = null;
    }

    $savemessage->timecreated = time();

    // Find out what processors are defined currently
    // When a user doesn't have settings none gets return, if he doesn't want contact "" gets returned
    $preferencename = 'message_provider_'.$eventdata->component.'_'.$eventdata->name.'_'.$userstate;

    $processor = get_user_preferences($preferencename, null, $eventdata->userto->id);
    if ($processor == NULL) { //this user never had a preference, save default
        if (!tm_message_set_default_message_preferences($eventdata->userto)) {
            print_error('cannotsavemessageprefs', 'local_totara_msg');
        }
        $processor = get_user_preferences($preferencename, NULL, $eventdata->userto->id);
    }

    if ($processor=='none' && $savemessage->alert) {
        //if they have deselected all processors and its a alert mark it read. The user doesnt want to be bothered
        $savemessage->timeread = $timeread;
        //$DB->insert_record('message_read', $savemessage);
        insert_record('message_read20', $savemessage);
    } else {                        // Process the message
        // Store unread message just in case we can not send it
        //$savemessage->id = $DB->insert_record('message20', $savemessage);
        $savemessage->id = insert_record('message20', $savemessage);
        if (!$savemessage->id || $savemessage->id == 0) {
            //print_error('cannotsavemessage', 'local_totara_msg');
            debugging('Error inserting message20: '.var_export($savemessage, TRUE));
            return false;
        }
        $eventdata->savedmessageid = $savemessage->id;

        // Try to deliver the message to each processor
        if ($processor!='none') {
            $processorlist = explode(',', $processor);

            foreach ($processorlist as $procname) {
                $processorfile = $CFG->dirroot. '/local/totara_msg/message20/output/'.$procname.'/message_output_'.$procname.'.php';

                if (is_readable($processorfile)) {
                    include_once($processorfile);  // defines $module with version etc
                    $processclass = 'message_output_' . $procname;

                    if (class_exists($processclass)) {
                        $pclass = new $processclass();

                        if (!$pclass->send_message($eventdata)) {
                            debugging('Error calling message processor '.$procname);
                            return false;
                        }
                    }
                } else {
                    debugging('Error calling message processor '.$procname);
                    return false;
                }
            }

            //if there is no more processors that want to process this we can move message to message_read
            if ( count_records('message_working20', 'unreadmessageid', $savemessage->id) == 0){
                require_once($CFG->dirroot. '/local/totara_msg/message20/lib.php');
                tm_message_mark_message_read($savemessage, time(), true);
            }

            // add the metadata record
            $eventdata->onaccept = isset($eventdata->onaccept) ? addslashes(serialize($eventdata->onaccept)) : null;
            $eventdata->onreject = isset($eventdata->onreject) ? addslashes(serialize($eventdata->onreject)) : null;
            $eventdata->oninfo = isset($eventdata->oninfo) ? addslashes(serialize($eventdata->oninfo)) : null;

            // set the default role to student / Learner
            if (!isset($eventdata->roleid)) {
                $role = get_record('role', 'shortname', 'student');
                $eventdata->roleid = $role->id;
            }

            if (isset($eventdata->icon)){
                $eventdata->icon = clean_param($eventdata->icon, PARAM_FILE);
            } else {
                $eventdata->icon = null;
            }

            // pull back the message_working record - we need to know the processorid
            $work = get_record('message_working20', 'unreadmessageid', $eventdata->savedmessageid);

            $metadata = new stdClass();
            $metadata->messageid        = $eventdata->savedmessageid;
            $metadata->msgtype          = $eventdata->msgtype;
            $metadata->msgstatus        = $eventdata->msgstatus;
            $metadata->urgency          = $eventdata->urgency;
            $metadata->processorid      = $work->processorid;
            $metadata->icon             = $eventdata->icon;
            $metadata->onaccept         = $eventdata->onaccept;
            $metadata->onreject         = $eventdata->onreject;
            $metadata->oninfo           = $eventdata->oninfo;
            $metadata->roleid           = $eventdata->roleid;
            insert_record('message_metadata', $metadata);
            return $eventdata->savedmessageid;
        }
    }

    return true;
}


/**
 * send a alert
 *
 * Required parameter $alert structure:
 *  userfrom object the user sending the message - optional
 *  userto object the message recipient
 *  fullmessage
 *  msgtype
 *  msgstatus
 *  urgency
 *
 * @param object $eventdata information about the message (userfrom, userto, ...)
 * @return boolean success
 */
function tm_alert_send($eventdata) {
    global $CFG;
    if (!isset($eventdata->userto)) {
        // cant send without a target user
        debugging('tm_alert_send() userto is not set');
        return false;
    }
    (!isset($eventdata->msgtype)) && $eventdata->msgtype = TOTARA_MSG_TYPE_UNKNOWN;
    (!isset($eventdata->msgstatus)) && $eventdata->msgstatus = TOTARA_MSG_STATUS_UNDECIDED;
    (!isset($eventdata->urgency)) && $eventdata->urgency = TOTARA_MSG_URGENCY_NORMAL;

    $eventdata->component         = 'local/totara_msg';
    $eventdata->name              = 'alrt';
    if (empty($eventdata->userfrom)) {
        $eventdata->userfrom      = $eventdata->userto;
    }

    if (empty($eventdata->subject)) {
        $eventdata->subject       = '';
    }
    $eventdata->fullmessageformat = FORMAT_PLAIN;
    $eventdata->fullmessagehtml   = $eventdata->fullmessage;
    $eventdata->alert      = 1;

    if (!isset($eventdata->contexturl)) {
        $eventdata->contexturl     = $CFG->wwwroot;
        $eventdata->contexturlname = '';
    }

    $result = tm_message_send($eventdata);

    if ($result && get_user_preferences('totara_msg_send_alrt_emails', 1, $eventdata->userto->id)) {
        // Send alert email
        if (empty($eventdata->subject)) {
            $eventdata->subject = strlen($eventdata->fullmessage) > 80 ? substr($eventdata->fullmessage, 0, 78).'...' : $eventdata->fullmessage;
        }
        $result = email_to_user($eventdata->userto, $eventdata->userfrom,
            format_string($eventdata->subject), format_string($eventdata->fullmessage),
            $eventdata->fullmessagehtml.'<br><br>'.get_string('viewdetailshere', 'local_totara_msg', $eventdata->contexturl));
    }

    return $result;
}


/**
 * send a task
 *
 * Required parameter $eventdata structure:
 *  userfrom object the user sending the message - optional
 *  userto object the message recipient
 *  fullmessage
 *
 * @param object $task information about the message (userfrom, userto, ...)
 * @return boolean success
 */
function tm_task_send($eventdata) {
    global $CFG;

    if (!isset($eventdata->userto)) {
        // cant send without a target user
        debugging('tm_task_send() userto is not set');
        return false;
    }
    (!isset($eventdata->msgtype)) && $eventdata->msgtype = TOTARA_MSG_TYPE_UNKNOWN;
    (!isset($eventdata->msgstatus)) && $eventdata->msgstatus = TOTARA_MSG_STATUS_UNDECIDED;
    (!isset($eventdata->urgency)) && $eventdata->urgency = TOTARA_MSG_URGENCY_NORMAL;
    (!isset($eventdata->onaccept)) && $eventdata->onaccept = null;
    (!isset($eventdata->onreject)) && $eventdata->onreject = null;

    $eventdata->component         = 'local/totara_msg';
    $eventdata->name              = 'task';
    if (!isset($eventdata->userfrom) || !$eventdata->userfrom) {
        $eventdata->userfrom      = $eventdata->userto;
    }

    if (!isset($eventdata->subject)) {
        $eventdata->subject       = '';
    }
    $eventdata->fullmessageformat = FORMAT_PLAIN;
    $eventdata->fullmessagehtml   = $eventdata->fullmessage;
    $eventdata->alert      = 1;

    if (!isset($eventdata->contexturl)) {
        $eventdata->contexturl     = $CFG->wwwroot;
        $eventdata->contexturlname = '';
    }

    $result = tm_message_send($eventdata);

    if ($result && get_user_preferences('totara_msg_send_task_emails', 1, $eventdata->userto->id)) {
        // Send task email
        if (empty($eventdata->subject)) {
            $eventdata->subject = strlen($eventdata->fullmessage) > 40 ? substr($eventdata->fullmessage, 0, 40).'...' : $eventdata->fullmessage;
        }
        $result = email_to_user($eventdata->userto, $eventdata->userfrom,
            format_string($eventdata->subject), format_string($eventdata->fullmessage),
            $eventdata->fullmessagehtml.'<br><br>'.get_string('viewdetailshere', 'local_totara_msg', $eventdata->contexturl));
    }

    return $result;
}


/**
 * send a custom task that initiates a workflow based on
 * the contexturl set
 *
 * Required parameter $eventdata structure:
 *  userfrom object the user sending the message - optional
 *  userto object the message recipient
 *  subject
 *  fullmessage
 * Optional parameter $eventdata structure:
 *  acceptbutton - affirmative action button label text
 *  accepttext - text that goes on the affirmative action screen
 *
 *  example from plan approval:
 *          $event = new stdClass;
 *          $event->userfrom = $learner;
 *          $event->contexturl = $this->get_display_url();
 *          $event->contexturlname = $this->name;
 *          $event->roleid = get_field('role','id', 'shortname', 'manager');
 *          $event->icon = 'learningplan-request.png';
 *          $a = new stdClass;
 *          $a->learner = fullname($learner);
 *          $a->plan = s($this->name);
 *          $event->subject = get_string('plan-request-manager-short', 'local_plan', $a);
 *          $event->fullmessage = get_string('plan-request-manager-long', 'local_plan', $a);
 *          $event->acceptbutton = get_string('approve', 'local_plan').' '.get_string('plan', 'local_plan');
 *          $event->accepttext = get_string('approveplantext', 'local_plan');
 *
 *
 * @param object $task information about the message (userfrom, userto, ...)
 * @return boolean success
 */
function tm_workflow_send($eventdata) {
    global $CFG;

    if (!isset($eventdata->userto)) {
        // cant send without a target user
        debugging('tm_task_send() userto is not set');
        return false;
    }
    $eventdata->msgtype = TOTARA_MSG_TYPE_LINK; // tells us how to treat the display
    (!isset($eventdata->msgstatus)) && $eventdata->msgstatus = TOTARA_MSG_STATUS_UNDECIDED;
    (!isset($eventdata->urgency)) && $eventdata->urgency = TOTARA_MSG_URGENCY_NORMAL;

    $eventdata->component         = 'local/totara_msg';
    $eventdata->name              = 'task';
    if (!isset($eventdata->userfrom) || !$eventdata->userfrom) {
        $eventdata->userfrom      = $eventdata->userto;
    }

    if (!isset($eventdata->subject)) {
        $eventdata->subject       = '';
    }
    $eventdata->fullmessageformat = FORMAT_PLAIN;
    $eventdata->fullmessagehtml   = $eventdata->fullmessage;
    $eventdata->alert      = 1;

    if (!isset($eventdata->contexturl)) {
        debugging('tm_message_workflow_send() must have have contexturl');
        return false;
    }
    if (!empty($eventdata->acceptbutton)) {
        $onaccept = new stdClass();
        $onaccept->action = 'plan';
        $onaccept->text = $eventdata->accepttext;
        $onaccept->data = $eventdata->data;
        $onaccept->acceptbutton = $eventdata->acceptbutton;
        $eventdata->onaccept = $onaccept;
    }
    if (!empty($eventdata->rejectbutton)) {
        $onreject = new stdClass();
        $onreject->action = 'plan';
        $onreject->text = $eventdata->rejecttext;
        $onreject->data = $eventdata->data;
        $onreject->rejectbutton = $eventdata->rejectbutton;
        $eventdata->onreject = $onreject;
    }
    if (!empty($eventdata->infobutton)) {
        $oninfo = new stdClass();
        $oninfo->action = 'plan';
        $oninfo->text = $eventdata->infotext;
        $oninfo->data = $eventdata->data;
        $oninfo->data['redirect'] = $eventdata->contexturl;
        $oninfo->infobutton = $eventdata->infobutton;
        $eventdata->oninfo = $oninfo;
    }

    $result = tm_message_send($eventdata);

    if ($result && get_user_preferences('totara_msg_send_task_emails', 1, $eventdata->userto->id)) {
        // Send workflow email
        if (empty($eventdata->subject)) {
            $eventdata->subject = strlen($eventdata->fullmessage) > 40 ? substr($eventdata->fullmessage, 0, 40).'...' : $eventdata->fullmessage;
        }
        $result = email_to_user($eventdata->userto, $eventdata->userfrom,
            format_string($eventdata->subject), format_string($eventdata->fullmessage),
            $eventdata->fullmessagehtml.'<br><br>'.get_string('viewdetailshere', 'local_totara_msg', $eventdata->contexturl));
    }

    return $result;
}


/**
 * Dismiss a message - this will move a message from message_working to message_read
 * without doing any of the workflow processing in message_metadata
 *
 * @param int $id message id
 * @return boolean success
 */
function tm_message_dismiss($id) {
    global $CFG;

    $message = get_record('message20', 'id', $id);
    if ($message) {
        $result = tm_message_mark_message_read($message, time());
        return $result;
    }
    else {
        return false;
    }
}


/**
 * accept a task - this will invoke the task onaccept action
 * saved against this message
 *
 * @param int $id message id
 * @return boolean success
 */
function tm_message_task_accept($id) {
    global $CFG;

    $message = get_record('message20', 'id', $id);
    if ($message) {
        // get the event data
        $eventdata = totara_msg_eventdata($id, 'onaccept');
        // grab the onaccept handler
        if (isset($eventdata->action)) {
            $plugin = tm_message_workflow_object($eventdata->action);
            if (!$plugin) {
                return false;
            }

            // run the onaccept phase
            $result = $plugin->onaccept($eventdata->data, $message);
        }

        // finally - dismiss this message as it has now been processed
        $result = tm_message_mark_message_read($message, time());
        return $result;
    }
    else {
        return false;
    }
}

/**
 * Redirect to a task's context URL
 *
 * @param int $id message id
 * @return boolean success
 */
function tm_message_task_link($id) {
    global $CFG;

    $message = get_record('message20', 'id', $id);
    if ($message) {
        // get the event data
        $eventdata = totara_msg_eventdata($id, 'oninfo');

        // grab the onaccept handler
        if (isset($eventdata->action)) {
            $plugin = tm_message_workflow_object($eventdata->action);
            if (!$plugin) {
                return false;
            }

            // run the onaccept phase
            $result = $plugin->onaccept($eventdata->data, $message);
        }

        // finally - dismiss this message as it has now been processed
        $result = tm_message_mark_message_read($message, time());
        return $result;
    }
    else {
        return false;
    }
}


/**
 * reject a task - this will invoke the task onreject action
 * saved against this message
 *
 * @param int $id message id
 * @return boolean success
 */
function tm_message_task_reject($id) {
    global $CFG;

    $message = get_record('message20', 'id', $id);
    if ($message) {
        // get the event data
        $eventdata = totara_msg_eventdata($id, 'onreject');

        // grab the onaccept handler
        if (isset($eventdata->action)) {
            $plugin = tm_message_workflow_object($eventdata->action);
            if (!$plugin) {
                return false;
            }

            // run the onreject phase
            $result = $plugin->onreject($eventdata->data, $message);
        }

        // finally - dismiss this message as it has now been processed
        $result = tm_message_mark_message_read($message, time());
        return $result;
    }
    else {
        return false;
    }
}


/**
 * instantiate workflow object
 *
 * @param string $action workflow object action name
 * @return object
 */
function tm_message_workflow_object($action) {
    global $CFG;

    require_once($CFG->dirroot.'/local/totara_msg/workflow/lib.php');
    $file = $CFG->dirroot.'/local/totara_msg/workflow/plugins/'.$action.'/workflow_'.$action.'.php';
    if (!file_exists($file)) {
        debugging('tm_message_task_accept() plugin does not exist: '.$action);
        return false;
    }
    require_once($file);

    // create the object
    $ctlclass = 'totara_msg_workflow_'.$action;
    if (class_exists($ctlclass)) {
        $plugin = new $ctlclass();
        return $plugin;
    }
    else {
        debugging('tm_message_task_accept() plugin class does not exist: '.$ctlclass);
        return false;
    }
}

/**
 * get the current list of messages by type - alert/task
 *
 * @param string $type - message type
 * @param string $order_by - order by clause
 * @param object $userto user table record for user required
 * @param bool $limit Apply the block limit
 * @param int $roleid select by roleid
 * @return array of messages
 */
function tm_messages_get($type, $order_by=false, $userto=false, $limit=true, $roleid=false) {
        global $USER;

        // select only particular type
        $processor = get_record('message_processors20', 'name', $type);
        if (empty($processor)) {
            return false;
        }

        // sort out for which user
        if ($userto) {
            $userid = $userto->id;
        }
        else {
            $userid = $USER->id;
        }

        // apply roleid filter?
        $role_filter = '';
        if ($roleid) {
            $role_filter = ' AND d.roleid = '.$roleid.' ';
        }

        // do we sort?
        if ($order_by) {
            $order_by = ' ORDER BY '.$order_by;
        }
        else {
            $order_by = ' ';
        }

        // do we apply a limit?
        if ($limit) {
            $limit = ' LIMIT '.TOTARA_MSG_ALERT_LIMIT;
        }
        else {
            $limit = ' ';
        }
        // hunt for messages
        $msgs = get_records_sql("SELECT m.id, m.useridfrom, m.subject, m.fullmessage, m.timecreated, d.msgstatus, d.msgtype, d.urgency, d.icon, m.contexturl, m.contexturlname
                                        FROM (mdl_message20 m INNER JOIN  mdl_message_working20 w ON m.id = w.unreadmessageid) LEFT JOIN mdl_message_metadata d ON (d.messageid = m.id)
                                        WHERE m.useridto = ".$userid .' AND w.processorid = '.$processor->id.$role_filter.$order_by.$limit);
        return $msgs;
}


/**
 * get the current count of messages by type - alert/task
 *
 * @param string $type - message type
 * @param object $userto user table record for user required
 * @return int count of messages
 */
function tm_messages_count($type, $userto=false, $roleid=false) {
        global $USER;

        // select only particular type
        $processor = get_record('message_processors20', 'name', $type);
        if (empty($processor)) {
            return false;
        }

        // sort out for which user
        if ($userto) {
            $userid = $userto->id;
        }
        else {
            $userid = $USER->id;
        }

        // apply roleid filter?
        $role_filter = '';
        if ($roleid) {
            $role_filter = ' AND d.roleid = '.$roleid.' ';
        }

        // hunt for messages
        $msgs = get_records_sql("SELECT count(m.id) AS count
                                        FROM (mdl_message20 m INNER JOIN  mdl_message_working20 w ON m.id = w.unreadmessageid) LEFT JOIN mdl_message_metadata d ON (d.messageid = m.id)
                                        WHERE m.useridto = ".$userid .' AND w.processorid = '.$processor->id.$role_filter);
        if ($msgs) {
            $msg = array_pop($msgs);
            return $msg->count;
        }
        return 0;
}



/**
 * This code updates the message_providers table with the current set of providers
 * @param $component - examples: 'moodle', 'mod_forum', 'block_quiz_results'
 * @return boolean
 */
function tm_message_update_providers($component='moodle') {
    //global $DB;

    // load message providers from files
    $fileproviders = tm_message_get_providers_from_file($component);

    // load message providers from the database
    $dbproviders = tm_message_get_providers_from_db($component);

    if($fileproviders) {
        foreach ($fileproviders as $messagename => $fileprovider) {

            if (!empty($dbproviders[$messagename])) {   // Already exists in the database

                if ($dbproviders[$messagename]->capability == $fileprovider['capability']) {  // Same, so ignore
                    // exact same message provider already present in db, ignore this entry
                    unset($dbproviders[$messagename]);
                    continue;

                } else {                                // Update existing one
                    $provider = new stdClass();
                    $provider->id         = $dbproviders[$messagename]->id;
                    $provider->capability = $fileprovider['capability'];
                    //$DB->update_record('message_providers', $provider);
                    update_record('message_providers20', $provider);
                    unset($dbproviders[$messagename]);
                    continue;
                }

            } else {             // New message provider, add it

                $provider = new stdClass();
                $provider->name       = $messagename;
                $provider->component  = $component;
                $provider->capability = $fileprovider['capability'];

                //$DB->insert_record('message_providers', $provider);
                insert_record('message_providers20', $provider);
            }
        }
    }

    if($dbproviders) {
        foreach ($dbproviders as $dbprovider) {  // Delete old ones
            //$DB->delete_records('message_providers', array('id' => $dbprovider->id));
            delete_records('message_providers20', 'id', $dbprovider->id);
        }
    }

    return true;
}

/**
 * Returns the active providers for the current user, based on capability
 * @return array of message providers
 */
function tm_message_get_my_providers() {
    //global $DB;

    $systemcontext = get_context_instance(CONTEXT_SYSTEM);

    //$providers = $DB->get_records('message_providers', null, 'name');
    $providers = get_records('message_providers20', null, 'name');

    // Remove all the providers we aren't allowed to see now
    if($providers) {
        foreach ($providers as $providerid => $provider) {
            if (!empty($provider->capability)) {
                if (!has_capability($provider->capability, $systemcontext)) {
                    unset($providers[$providerid]);   // Not allowed to see this
                }
            }
        }
    }

    return $providers;
}

/**
 * Gets the message providers that are in the database for this component.
 * @param $component - examples: 'moodle', 'mod/forum', 'block/quiz_results'
 * @return array of message providers
 *
 * INTERNAL - to be used from messagelib only
 */
function tm_message_get_providers_from_db($component) {
    //global $DB;

    //return $DB->get_records('message_providers', array('component'=>$component), '', 'name, id, component, capability');  // Name is unique per component
    return get_records('message_providers20', 'component', $component, '', 'name, id, component, capability');  // Name is unique per component
}

/**
 * Loads the messages definitions for the component (from file). If no
 * messages are defined for the component, we simply return an empty array.
 * @param $component - examples: 'moodle', 'mod_forum', 'block_quiz_results'
 * @return array of message providerss or empty array if not exists
 *
 * INTERNAL - to be used from messagelib only
 */
function tm_message_get_providers_from_file($component) {
    global $CFG;
    //$defpath = get_component_directory($component).'/db/messages.php';
    $defpath = $CFG->dirroot.'/'.$component.'/db/messages.php';

    $messageproviders = array();

    if (file_exists($defpath)) {
        require($defpath);
    }

    foreach ($messageproviders as $name => $messageprovider) {   // Fix up missing values if required
        if (empty($messageprovider['capability'])) {
            $messageproviders[$name]['capability'] = NULL;
        }
    }

    return $messageproviders;
}

/**
 * Remove all message providers
 * @param $component - examples: 'moodle', 'mod/forum', 'block/quiz_results'
 */
function tm_message_uninstall($component) {
    //global $DB;
    //return $DB->delete_records('message_providers', array('component' => $component));
    return delete_records('message_providers20', 'component', $component);
}

/**
 * Set default message preferences.
 * @param $user - User to set message preferences
 */
function tm_message_set_default_message_preferences($user) {
    //global $DB;

    $defaultonlineprocessor = 'email';
    $defaultofflineprocessor = 'email';
    $offlineprocessortouse = $onlineprocessortouse = null;

    //look for the pre-2.0 preference if it exists
    $oldpreference = get_user_preferences('message_showmessagewindow', -1, $user->id);
    //if they elected to see popups or the preference didnt exist
    $usepopups = (intval($oldpreference)==1 || intval($oldpreference)==-1);

    if ($usepopups) {
        $defaultonlineprocessor = 'popup';
    }

    //$providers = $DB->get_records('message_providers');
    $providers = get_records('message_providers20');
    $preferences = array();
    if (!$providers) {
        $providers = array();
    }

    foreach ($providers as $providerid => $provider) {

        //force some specific defaults for some types of message
        if ($provider->name=='instantmessage') {
            //if old popup preference was set to 1 or is missing use popups for IMs
            if ($usepopups) {
                $onlineprocessortouse = 'popup';
                $offlineprocessortouse = 'email,popup';
            }
        } else if ($provider->name=='posts') { //forum posts
            $offlineprocessortouse = $onlineprocessortouse = 'email';
        } else if ($provider->name=='alrt') { //totara alert
            $offlineprocessortouse = $onlineprocessortouse = 'totara_alert';
        } else if ($provider->name=='task') { //totara task
            $offlineprocessortouse = $onlineprocessortouse = 'totara_task';
        } else {
            $onlineprocessortouse = $defaultonlineprocessor;
            $offlineprocessortouse = $defaultofflineprocessor;
        }

        $preferences['message_provider_'.$provider->component.'_'.$provider->name.'_loggedin'] = $onlineprocessortouse;
        $preferences['message_provider_'.$provider->component.'_'.$provider->name.'_loggedoff'] = $offlineprocessortouse;
    }

    return set_user_preferences($preferences, $user->id);
}

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
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage program
 */

require_once($CFG->dirroot.'/local/totara_msg/messagelib.php');

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

/**
 * This is a simple class representing the data suitable to be passed to the
 * totara_alert_send method which is used extensively by the program
 * messaging functionality
 */
class prog_message_data {

    public $userto, $userfrom, $roleid;
    public $subject, $fullmessage;
    public $contexturl, $contexturlname;
    public $sendemail, $msgtype, $urgency;

    public function __construct($messagedata) {

        (isset($messagedata['userto']))            && ($this->userto = $messagedata['userto']);
        (isset($messagedata['userfrom']))          && ($this->userfrom = $messagedata['userfrom']);
        (isset($messagedata['roleid']))            && ($this->roleid = $messagedata['roleid']);
        (isset($messagedata['subject']))           && ($this->subject = $messagedata['subject']);
        (isset($messagedata['fullmessage']))       && ($this->fullmessage = $messagedata['fullmessage']);
        (isset($messagedata['contexturl']))        && ($this->contexturl = $messagedata['contexturl']);
        (isset($messagedata['contexturlname']))    && ($this->contexturlname = $messagedata['contexturlname']);
        (isset($messagedata['icon']))              && ($this->icon = $messagedata['icon']);

        $this->sendemail = isset($messagedata['sendemail']) ? $messagedata['sendemail'] : TOTARA_MSG_EMAIL_NO;
        $this->msgtype   = isset($messagedata['msgtype']) ? $messagedata['msgtype'] : TOTARA_MSG_TYPE_UNKNOWN;
        $this->urgency   = isset($messagedata['urgency']) ? $messagedata['urgency'] : TOTARA_MSG_URGENCY_NORMAL;

    }
}

abstract class prog_message {

    public $id, $programid, $messagetype, $sortorder, $locked;
    public $messagesubject, $mainmessage;
    public $notifymanager, $managermessage;
    public $triggertime, $triggerperiod, $triggernum;
    public $isfirstmessage, $islastmessage, $isfirstmoveablemessage;
    public $studentrole, $managerrole;
    public $uniqueid;

    protected $fieldsetlegend;
    protected $studentmessagedata, $managermessagedata;
    protected $triggereventstr;

    protected $replacementvars = array();
    protected $helppage = '';

    const messageprefixstr = 'message_';

    public function __construct($programid, $messageob=null, $uniqueid=null) {

        if(is_object($messageob)) {
            $this->id = $messageob->id;
            $this->programid = $messageob->programid;
            $this->sortorder = $messageob->sortorder;
            $this->locked = $messageob->locked;
            $this->messagesubject = $messageob->messagesubject;
            $this->mainmessage = $messageob->mainmessage;
            $this->notifymanager = $messageob->notifymanager;
            $this->managermessage = $messageob->managermessage;
            $this->triggertime = $messageob->triggertime;
        } else {
            $this->id = 0;
            $this->programid = $programid;
            $this->sortorder = 0;
            $this->locked = false;
            $this->messagesubject = '';
            $this->mainmessage = '';
            $this->notifymanager = false;
            $this->managermessage = '';
            $this->triggertime = 0;
        }

        $tiggertime = program_utilities::duration_explode($this->triggertime);
        $this->triggernum = $tiggertime->num;
        $this->triggerperiod = $tiggertime->period;

        $this->fieldsetlegend = '';

        if($uniqueid) {
            $this->uniqueid = $uniqueid;
        } else {
            $this->uniqueid = rand();
        }

	$this->studentrole = get_field('role', 'id', 'shortname', 'student');
	$this->managerrole = get_field('role', 'id', 'shortname', 'manager');

	if (!$this->studentrole) {
	    print_error('error:failedtofindstudentrole', 'local_program');
	}
	if (!$this->managerrole) {
	    print_error('error:failedtofindmanagerrole', 'local_program');
	}

    }

    public function init_form_data($formnameprefix, $formdata) {
        $this->id = $formdata->{$formnameprefix.'id'};
        $this->programid = $formdata->id;
        $this->messagetype = $formdata->{$formnameprefix.'messagetype'};
        $this->sortorder = $formdata->{$formnameprefix.'sortorder'};
        $this->messagesubject = $formdata->{$formnameprefix.'messagesubject'};
        $this->mainmessage = $formdata->{$formnameprefix.'mainmessage'};

        $this->notifymanager = isset($formdata->{$formnameprefix.'notifymanager'}) ? $formdata->{$formnameprefix.'notifymanager'} : false;;
        $this->managermessage = isset($formdata->{$formnameprefix.'managermessage'}) ? $formdata->{$formnameprefix.'managermessage'} : '';
        $this->triggerperiod = isset($formdata->{$formnameprefix.'triggerperiod'}) ? $formdata->{$formnameprefix.'triggerperiod'} : 0;
        $this->triggernum = isset($formdata->{$formnameprefix.'triggernum'}) ? $formdata->{$formnameprefix.'triggernum'} : 0;
        $this->triggertime = program_utilities::duration_implode($this->triggernum, $this->triggerperiod);
    }

    public function get_message_prefix() {
        return $this->uniqueid;
    }

    public function get_student_message_data() {
        return $this->studentmessagedata;
    }

    public function get_manager_message_data() {
        return $this->managermessagedata;
    }

    public function check_message_action($action, $formdata) {
        return false;
    }

    public function save_message() {
        if($this->id > 0) { // if this message already exists in the database
            return update_record('prog_message', $this);
        } else {
            if($id = insert_record('prog_message', $this)) {
                $this->id = $id;
                return true;
            }
            return false;
        }
    }

    public function replacevars($text) {

        if ($programfullname = get_field('prog', 'fullname', 'id', $this->programid)) {
            $this->replacementvars['programfullname'] = $programfullname;
        }

        foreach ($this->replacementvars as $search=>$replace) {
            $text = str_replace("%$search%", $replace, $text);
        }

        return $text;
    }

    /**
     * Sends a generic alert message using the Totara message/alert framework
     *
     * @param object $messagedata See tm_alert_send and tm_message_send for details of what this object should contain
     * @return boole Success status
     */
    public static function send_generic_alert($messagedata) {

        (!isset($messagedata->sendemail))   && $messagedata->sendemail  = TOTARA_MSG_EMAIL_NO;
        (!isset($messagedata->msgtype))     && $messagedata->msgtype    = TOTARA_MSG_TYPE_UNKNOWN;
        (!isset($messagedata->urgency))     && $messagedata->urgency    = TOTARA_MSG_URGENCY_NORMAL;

        if(tm_alert_send($messagedata)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sends the message to the specified recipient
     *
     * @param object $recipient A user record
     * @param object $sender An optional user record
     * @param array $options An optional array containing options for the message
     * @return bool Success
     */
    abstract public function send_message($recipient, $sender=null, $options=array());

    /**
     * Defines the form elements for a message
     *
     * @param <type> $mform
     * @param <type> $template_values
     * @param <type> $formdataobject
     * @param <type> $updateform
     */
    abstract public function get_message_form_template(&$mform, &$template_values, &$formdataobject, $updateform=true);

    /**
     * Defines the hidden form elements that are common to all message types
     *
     * @param <type> $mform
     * @param <type> $template_values
     * @param <type> $formdataobject
     * @param <type> $updateform
     * @return <type>
     */
    public function get_generic_hidden_fields_template(&$mform, &$template_values, &$formdataobject, $updateform=true) {

        $prefix = $this->get_message_prefix();

        $templatehtml = '';

        // Add the message set id
        if($updateform) {
            $mform->addElement('hidden', $prefix.'id', $this->id);
            $mform->setType($prefix.'id', PARAM_INT);
            $mform->setConstant($prefix.'id', $this->id);
            $template_values['%'.$prefix.'id%'] = array('name'=>$prefix.'id', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'id%'."\n";
        $formdataobject->{$prefix.'id'} = $this->id;

        // Add the message sort order
        if($updateform) {
            $mform->addElement('hidden', $prefix.'sortorder', $this->sortorder);
            $mform->setType($prefix.'sortorder', PARAM_INT);
            $mform->setConstant($prefix.'sortorder', $this->sortorder);
            $template_values['%'.$prefix.'sortorder%'] = array('name'=>$prefix.'sortorder', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'sortorder%'."\n";
        $formdataobject->{$prefix.'sortorder'} = $this->sortorder;

        // Add the message type
        if($updateform) {
            $mform->addElement('hidden', $prefix.'messagetype', $this->messagetype);
            $mform->setType($prefix.'messagetype', PARAM_INT);
            $mform->setConstant($prefix.'messagetype', $this->messagetype);
            $template_values['%'.$prefix.'messagetype%'] = array('name'=>$prefix.'messagetype', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'messagetype%'."\n";
        $formdataobject->{$prefix.'messagetype'} = $this->messagetype;

        return $templatehtml;

    }

    /**
     * Defines the default subject and message body form elements that
     * several message types use
     *
     * @param <type> $mform
     * @param <type> $template_values
     * @param <type> $formdataobject
     * @param <type> $updateform
     * @return <type>
     */
    public function get_generic_basic_fields_template(&$mform, &$template_values, &$formdataobject, $updateform=true) {

        $prefix = $this->get_message_prefix();

        $templatehtml = '';

        // Add the message subject
        $safe_messagesubject = format_string($this->messagesubject);
        if($updateform) {
            $mform->addElement('text', $prefix.'messagesubject', '', array('size'=>'50', 'maxlength'=>'255'));
            $mform->setType($prefix.'messagesubject', PARAM_TEXT);
            $template_values['%'.$prefix.'messagesubject%'] = array('name'=>$prefix.'messagesubject', 'value'=>null);
        }
        $helpbutton = helpbutton('messagesubject', get_string('label:subject', 'local_program'), 'local_program', true, false, '', true);
        $templatehtml .= '<div class="fline">';
        $templatehtml .= '<div class="flabel"><label for="'.$prefix.'messagesubject">'.get_string('label:subject', 'local_program').' '.$helpbutton.'</label></div>';
        $templatehtml .= '<div class="fitem">%'.$prefix.'messagesubject%</div>';
        $templatehtml .= '</div>';
        $formdataobject->{$prefix.'messagesubject'} = $safe_messagesubject;

        // Add the main message
        $safe_mainmessage = format_string($this->mainmessage);
        if($updateform) {
            $mform->addElement('textarea', $prefix.'mainmessage', '', array('cols'=>'40', 'rows'=>'5'));
            $mform->setType($prefix.'mainmessage', PARAM_TEXT);
            $template_values['%'.$prefix.'mainmessage%'] = array('name'=>$prefix.'mainmessage', 'value'=>null);
        }
        $helpbutton = helpbutton('mainmessage', get_string('label:message', 'local_program'), 'local_program', true, false, '', true);
        $templatehtml .= '<div class="fline">';
        $templatehtml .= '<div class="flabel"><label for="'.$prefix.'mainmessage">'.get_string('label:message', 'local_program').' '.$helpbutton.'</label></div>';
        $templatehtml .= '<div class="fitem">%'.$prefix.'mainmessage%</div>';
        $templatehtml .= '</div>';
        $formdataobject->{$prefix.'mainmessage'} = $safe_mainmessage;

        return $templatehtml;

    }

    /**
     * Defines the subject and message body form elements along with the
     * manager message field that several message types use
     *
     * @param <type> $mform
     * @param <type> $template_values
     * @param <type> $formdataobject
     * @param <type> $updateform
     * @return <type>
     */
    public function get_generic_manager_fields_template(&$mform, &$template_values, &$formdataobject, $updateform=true) {

        $prefix = $this->get_message_prefix();

        $templatehtml = '';

        // Add the notify manager checkbox
        $attributes = array();
        if(isset($this->notifymanager) && $this->notifymanager==true) $attributes['checked'] = "checked";
        if($updateform) {
            $mform->addElement('checkbox', $prefix.'notifymanager', '', '', $attributes);
            $mform->setType($prefix.'notifymanager', PARAM_BOOL);
            $template_values['%'.$prefix.'notifymanager%'] = array('name'=>$prefix.'notifymanager', 'value'=>null);
        }
        $helpbutton = helpbutton('notifymanager', get_string('label:sendnoticetomanager', 'local_program'), 'local_program', true, false, '', true);
        $templatehtml .= '<div class="fline">';
        $templatehtml .= '<div class="flabel"><label for="'.$prefix.'notifymanager">'.get_string('label:sendnoticetomanager', 'local_program').' '.$helpbutton.'</label></div>';
        $templatehtml .= '<div class="fitem">%'.$prefix.'notifymanager%</div>';
        $templatehtml .= '</div>';
        $formdataobject->{$prefix.'notifymanager'} = (bool)$this->notifymanager;

        // Add the manager message
        $safe_managermessage = format_string($this->managermessage);
        if($updateform) {
            $mform->addElement('textarea', $prefix.'managermessage', $safe_managermessage, array('cols'=>'40', 'rows'=>'5'));
            //$mform->disabledIf($prefix.'managermessage', $prefix.'notifymanager', 'notchecked');
            $mform->setType($prefix.'managermessage', PARAM_TEXT);
            $template_values['%'.$prefix.'managermessage%'] = array('name'=>$prefix.'managermessage', 'value'=>null);
        }
        $helpbutton = helpbutton('managermessage', get_string('label:noticeformanager', 'local_program'), 'local_program', true, false, '', true);
        $templatehtml .= '<div class="fline">';
        $templatehtml .= '<div class="flabel"><label for="'.$prefix.'managermessage">'.get_string('label:noticeformanager', 'local_program').' '.$helpbutton.'</label></div>';
        $templatehtml .= '<div class="fitem">%'.$prefix.'managermessage%</div>';
        $templatehtml .= '</div>';
        $formdataobject->{$prefix.'managermessage'} = $safe_managermessage;

        return $templatehtml;

    }

    /**
     * Defines the time picker form elements that several message types use
     *
     * @param <type> $mform
     * @param <type> $template_values
     * @param <type> $formdataobject
     * @param <type> $updateform
     * @return <type>
     */
    public function get_generic_trigger_fields_template(&$mform, &$template_values, &$formdataobject, $updateform=true) {

        $prefix = $this->get_message_prefix();

        $templatehtml = '';

        // Add the trigger period selection group
        if($updateform) {

            $mform->addElement('text', $prefix.'triggernum', '', array('size'=>4, 'maxlength'=>3));
            $mform->setType($prefix.'triggernum', PARAM_INT);
            $mform->setDefault($prefix.'triggernum', '1');
            //$mform->addRule($prefix.'triggernum', get_string('required'), 'required', null, 'server');

            $timeallowanceoptions = program_utilities::get_standard_time_allowance_options();
            $mform->addElement('select', $prefix.'triggerperiod', '', $timeallowanceoptions);
            $mform->setType($prefix.'triggerperiod', PARAM_INT);

            $template_values['%'.$prefix.'triggernum%'] = array('name'=>$prefix.'triggernum', 'value'=>null);
            $template_values['%'.$prefix.'triggerperiod%'] = array('name'=>$prefix.'triggerperiod', 'value'=>null);
        }
        $helpbutton = helpbutton('trigger', get_string('label:trigger', 'local_program'), 'local_program', true, false, '', true);
        $templatehtml .= '<div class="fline">';
        $templatehtml .= '<div class="flabel"><label for="'.$prefix.'triggernum">'.get_string('label:trigger', 'local_program').' '.$helpbutton.'</label></div>';
        $templatehtml .= '<div class="fitem">%'.$prefix.'triggernum% %'.$prefix.'triggerperiod% '.$this->triggereventstr.'</div>';
        $templatehtml .= '</div>';
        $formdataobject->{$prefix.'triggernum'} = $this->triggernum;
        $formdataobject->{$prefix.'triggerperiod'} = $this->triggerperiod;

        return $templatehtml;

    }

    /**
     * Defines the fieldset button elements that several message types use
     *
     * @param <type> $mform
     * @param <type> $template_values
     * @param <type> $formdataobject
     * @param <type> $updateform
     * @return <type>
     */
    public function get_generic_message_buttons_template(&$mform, &$template_values, &$formdataobject, $updateform=true) {

        $prefix = $this->get_message_prefix();

        $templatehtml = '';

        $templatehtml .= '<div class="messagebuttons">';

        // Add the move up button for this message
        if($updateform) {
            $attributes = array();
            $attributes['class'] = isset($this->isfirstmoveablemessage) ? 'fieldsetbutton disabled' : 'fieldsetbutton';
            if(isset($this->isfirstmoveablemessage)) $attributes['disabled'] = 'disabled';
            $mform->addElement('submit', $prefix.'moveup', get_string('moveup', 'local_program'), $attributes);
            $template_values['%'.$prefix.'moveup%'] = array('name'=>$prefix.'moveup', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'moveup%'."\n";

        // Add the move down button for this message
        if($updateform) {
            $attributes = array();
            $attributes['class'] = isset($this->islastmessage) ? 'fieldsetbutton disabled' : 'fieldsetbutton';
            if(isset($this->islastmessage)) $attributes['disabled'] = 'disabled';
            $mform->addElement('submit', $prefix.'movedown', get_string('movedown', 'local_program'), $attributes);
            $template_values['%'.$prefix.'movedown%'] = array('name'=>$prefix.'movedown', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'movedown%'."\n";

         // Add the delete button for this message
        if($updateform) {
            $mform->addElement('submit', $prefix.'delete', get_string('delete', 'local_program'), array('class'=>"fieldsetbutton deletedmessagebutton"));
            $template_values['%'.$prefix.'delete%'] = array('name'=>$prefix.'delete', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'delete%'."\n";

        $templatehtml .= '</div>';

        return $templatehtml;

    }

}

abstract class prog_noneventbased_message extends prog_message {

    public function __construct($programid, $messageob=null, $uniqueid=null) {
        global $CFG;

        parent::__construct($programid, $messageob, $uniqueid);

        $studentmessagedata = array(
            'roleid'            => $this->studentrole,
            'subject'           => $this->messagesubject,
            'fullmessage'       => $this->mainmessage,
            'contexturl'        => $CFG->wwwroot.'/local/program/view.php?id='.$this->programid,
            'contexturlname'    => get_string('launchprogram', 'local_program'),
        );

        $this->studentmessagedata = new prog_message_data($studentmessagedata);

    }

    /**
     * Sends the message to the specified recipient
     *
     * @param object $recipient A user record
     * @param object $sender An optional user record
     * @param array $options An optional array containing options for the message
     * @return bool Success
     */
    public function send_message($recipient, $sender=null, $options=array()) {
        global $CFG;

        $result = true;

        $coursesetid = isset($options['coursesetid']) ? $options['coursesetid'] : 0;

        // retrieve the course set label if we know the id (this is so that it can be substituted in the message)
        if ($setlabel = get_field('prog_courseset', 'label', 'id', $coursesetid)) {
            $this->replacementvars['setlabel'] = $setlabel;
        }

        $manager = totara_get_manager($recipient->id);

        if($sender == null) {
            if( ! $manager) {
                $sender = $recipient;
            } else {
                $sender = $manager;
            }
        }

        // send the message to the learner
        $this->studentmessagedata->userto = $recipient;
        $this->studentmessagedata->userfrom = $sender;
        $this->studentmessagedata->subject = $this->replacevars($this->studentmessagedata->subject);
        $this->studentmessagedata->fullmessage = $this->replacevars($this->studentmessagedata->fullmessage);
        $result = $result && tm_alert_send($this->studentmessagedata);

        // send the message to the manager
        if($result && $this->notifymanager && $manager) {
            $this->managermessagedata->userto = $manager;
            $this->managermessagedata->userfrom = $recipient;
            $this->managermessagedata->subject = $this->replacevars($this->managermessagedata->subject);
            $this->managermessagedata->fullmessage = $this->replacevars($this->managermessagedata->fullmessage);
            $this->managermessagedata->contexturl = $CFG->wwwroot.'/local/program/view.php?id='.$this->programid.'&amp;userid='.$recipient->id;
            $result = $result && tm_alert_send($this->managermessagedata);
        }

        return $result;
    }

    public function get_message_form_template(&$mform, &$template_values, &$formdataobject, $updateform=true) {

        $prefix = $this->get_message_prefix();

        $helpbutton = helpbutton($this->helppage, $this->fieldsetlegend, 'local_program', true, false, '', true);

        $templatehtml = '';
        $templatehtml .= '<fieldset id="'.$prefix.'" class="message">';
        $templatehtml .= '<legend>'.$this->fieldsetlegend.' '.$helpbutton.'</legend>';

        $templatehtml .= $this->get_generic_hidden_fields_template($mform, $template_values, $formdataobject, $updateform);
        $templatehtml .= $this->get_generic_message_buttons_template($mform, $template_values, $formdataobject, $updateform);
        $templatehtml .= $this->get_generic_basic_fields_template($mform, $template_values, $formdataobject, $updateform);
        $templatehtml .= $this->get_generic_manager_fields_template($mform, $template_values, $formdataobject, $updateform);

        $templatehtml .= '</fieldset>';

        return $templatehtml;
    }

}


/**
 * Abstract class representing a standard message type which allows an event
 * to be specified as a point in time before/after which the message will be
 * sent
 */
abstract class prog_eventbased_message extends prog_message {

    public function __construct($programid, $messageob=null, $uniqueid=null) {
        global $CFG;

        parent::__construct($programid, $messageob, $uniqueid);

        $studentmessagedata = array(
            'roleid'            => $this->studentrole,
            'subject'           => $this->messagesubject,
            'fullmessage'       => $this->mainmessage,
            'contexturl'        => $CFG->wwwroot.'/local/program/view.php?id='.$this->programid,
            'contexturlname'    => get_string('launchprogram', 'local_program'),
        );

        $this->studentmessagedata = new prog_message_data($studentmessagedata);

    }

    public function save_message() {

        // check if the trigger time has changed and delete all message logs for
        // this message if so
        if($this->id > 0) { // if this message already exists in the database
            $triggertime = get_field('prog_message', 'triggertime', 'id', $this->id);
            if($triggertime != $this->triggertime) {
                delete_records('prog_messagelog', 'messageid', $this->id);
            }
        }

        return parent::save_message();
    }

    /**
     * Sends the message to the specified recipient
     *
     * @param object $recipient A user record
     * @param object $sender An optional user record
     * @param array $options An optional array containing options for the message
     * @return bool Success
     */
    public function send_message($recipient, $sender=null, $options=array()) {
        global $CFG;

        $coursesetid = isset($options['coursesetid']) ? $options['coursesetid'] : 0;

        // only send the message if it has not already been sent to the recipient
        // as we don't want the same program due message to be sent more than once
        if($message_log = get_record('prog_messagelog', 'messageid', $this->id, 'userid', $recipient->id, 'coursesetid', $coursesetid)) {
            return true;
        }

        // retrieve the course set label if we know the id (this is so that it can be substituted in the message)
        if ($setlabel = get_field('prog_courseset', 'label', 'id', $coursesetid)) {
            $this->replacementvars['setlabel'] = $setlabel;
        }

        $result = true;

        $manager = totara_get_manager($recipient->id);

        if($sender == null) {
            if( ! $manager) {
                $sender = $recipient;
            } else {
                $sender = $manager;
            }
        }

        // send the message to the learner
        $this->studentmessagedata->userto = $recipient;
        $this->studentmessagedata->userfrom = $sender;
        $this->studentmessagedata->subject = $this->replacevars($this->studentmessagedata->subject);
        $this->studentmessagedata->fullmessage = $this->replacevars($this->studentmessagedata->fullmessage);
        $result = $result && tm_alert_send($this->studentmessagedata);

        // if the message was sent, add a record to the message log to
        // prevent it from being sent again
        if($result) {
            $ob = new stdClass();
            $ob->messageid = $this->id;
            $ob->userid = $recipient->id;
            $ob->coursesetid = $coursesetid;
            $ob->timeissued = time();
            insert_record('prog_messagelog', $ob);
        }

        // send the message to the manager
        if($result && $this->notifymanager && $manager) {
            $this->managermessagedata->userto = $manager;
            $this->managermessagedata->userfrom = $recipient;
            $this->managermessagedata->subject = $this->replacevars($this->managermessagedata->subject);
            $this->managermessagedata->fullmessage = $this->replacevars($this->managermessagedata->fullmessage);
            $this->managermessagedata->contexturl = $CFG->wwwroot.'/local/program/view.php?id='.$this->programid.'&amp;userid='.$recipient->id;
            $result = $result && tm_alert_send($this->managermessagedata);
        }

        return $result;
    }

    public function get_message_form_template(&$mform, &$template_values, &$formdataobject, $updateform=true) {

        $prefix = $this->get_message_prefix();

        $helpbutton = helpbutton($this->helppage, $this->fieldsetlegend, 'local_program', true, false, '', true);

        $templatehtml = '';
        $templatehtml .= '<fieldset id="'.$prefix.'" class="message">';
        $templatehtml .= '<legend>'.$this->fieldsetlegend.' '.$helpbutton.'</legend>';

        $templatehtml .= $this->get_generic_hidden_fields_template($mform, $template_values, $formdataobject, $updateform);
        $templatehtml .= $this->get_generic_message_buttons_template($mform, $template_values, $formdataobject, $updateform);
        $templatehtml .= $this->get_generic_trigger_fields_template($mform, $template_values, $formdataobject, $updateform);
        $templatehtml .= $this->get_generic_basic_fields_template($mform, $template_values, $formdataobject, $updateform);
        $templatehtml .= $this->get_generic_manager_fields_template($mform, $template_values, $formdataobject, $updateform);

        $templatehtml .= '</fieldset>';

        return $templatehtml;
    }
    
}

class prog_enrolment_message extends prog_noneventbased_message {

   public function __construct($programid, $messageob=null, $uniqueid=null) {
        global $CFG;

        parent::__construct($programid, $messageob, $uniqueid);

        $this->messagetype = MESSAGETYPE_ENROLMENT;
        $this->helppage = 'enrolmentmessage';
        $this->locked = true;
        $this->sortorder = 1;
        $this->fieldsetlegend = get_string('legend:enrolmentmessage', 'local_program');

        $managermessagedata = array(
            'roleid'            => $this->managerrole,
            'subject'           => get_string('learnerenrolled', 'local_program'),
            'fullmessage'       => $this->managermessage,
            'contexturl'        => $CFG->wwwroot.'/local/program/view.php?id='.$this->programid,
            'contexturlname'    => get_string('launchprogram', 'local_program'),
        );

        $this->managermessagedata = new prog_message_data($managermessagedata);

    }

    public function get_message_form_template(&$mform, &$template_values, &$formdataobject, $updateform=true) {

        $prefix = $this->get_message_prefix();

        $helpbutton = helpbutton($this->helppage, $this->fieldsetlegend, 'local_program', true, false, '', true);

        $templatehtml = '';
        $templatehtml .= '<fieldset id="'.$prefix.'" class="message">';
        $templatehtml .= '<legend>'.$this->fieldsetlegend.' '.$helpbutton.'</legend>';

        $templatehtml .= $this->get_generic_hidden_fields_template($mform, $template_values, $formdataobject, $updateform);
        $templatehtml .= $this->get_generic_basic_fields_template($mform, $template_values, $formdataobject, $updateform);
        $templatehtml .= $this->get_generic_manager_fields_template($mform, $template_values, $formdataobject, $updateform);

        $templatehtml .= '</fieldset>';

        return $templatehtml;
    }

}

class prog_exception_report_message extends prog_noneventbased_message {

    public function __construct($programid, $messageob=null, $uniqueid=null) {
        global $CFG;

        parent::__construct($programid, $messageob, $uniqueid);

        $this->messagetype = MESSAGETYPE_EXCEPTION_REPORT;
        $this->helppage = 'exceptionreportmessage';
        $this->locked = true;
        $this->sortorder = 2;
        $this->fieldsetlegend = get_string('legend:exceptionreportmessage', 'local_program');

        $studentmessagedata = array(
            'roleid'            => $this->studentrole,
            'subject'           => $this->messagesubject,
            'fullmessage'       => $this->mainmessage,
            'contexturl'        => $CFG->wwwroot.'/local/program/exceptions.php?id='.$this->programid,
            'contexturlname'    => get_string('viewexceptions', 'local_program'),
        );

        $this->studentmessagedata = new prog_message_data($studentmessagedata);

    }

    public function get_message_form_template(&$mform, &$template_values, &$formdataobject, $updateform=true) {

        $prefix = $this->get_message_prefix();

        $helpbutton = helpbutton($this->helppage, $this->fieldsetlegend, 'local_program', true, false, '', true);

        $templatehtml = '';
        $templatehtml .= '<fieldset id="'.$prefix.'" class="message">';
        $templatehtml .= '<legend>'.$this->fieldsetlegend.' '.$helpbutton.'</legend>';

        $templatehtml .= $this->get_generic_hidden_fields_template($mform, $template_values, $formdataobject, $updateform);
        $templatehtml .= $this->get_generic_basic_fields_template($mform, $template_values, $formdataobject, $updateform);

        $templatehtml .= '</fieldset>';

        return $templatehtml;
    }

}

class prog_unenrolment_message extends prog_noneventbased_message {

    public function __construct($programid, $messageob=null, $uniqueid=null) {
        global $CFG;

        parent::__construct($programid, $messageob, $uniqueid);

        $this->messagetype = MESSAGETYPE_UNENROLMENT;
        $this->helppage = 'unenrolmentmessage';
        $this->locked = false;
        $this->fieldsetlegend = get_string('legend:unenrolmentmessage', 'local_program');

        $studentmessagedata = array(
            'roleid'            => $this->studentrole,
            'subject'           => $this->messagesubject,
            'fullmessage'       => $this->mainmessage,
        );

        $this->studentmessagedata = new prog_message_data($studentmessagedata);

        $managermessagedata = array(
            'roleid'            => $this->managerrole,
            'subject'           => get_string('learnerunenrolled', 'local_program'),
            'fullmessage'       => $this->managermessage,
            'contexturl'        => $CFG->wwwroot.'/local/program/view.php?id='.$this->programid,
            'contexturlname'    => get_string('launchprogram', 'local_program'),
        );

        $this->managermessagedata = new prog_message_data($managermessagedata);

    }

}

class prog_program_completed_message extends prog_noneventbased_message {

    public function __construct($programid, $messageob=null, $uniqueid=null) {
        global $CFG;

        parent::__construct($programid, $messageob, $uniqueid);

        $this->messagetype = MESSAGETYPE_PROGRAM_COMPLETED;
        $this->helppage = 'programcompletedmessage';
        $this->locked = false;
        $this->fieldsetlegend = get_string('legend:programcompletedmessage', 'local_program');

        $managermessagedata = array(
            'roleid'            => $this->managerrole,
            'subject'           => get_string('programcompleted', 'local_program'),
            'fullmessage'       => $this->managermessage,
            'contexturl'        => $CFG->wwwroot.'/local/program/view.php?id='.$this->programid,
            'contexturlname'    => get_string('launchprogram', 'local_program'),
        );

        $this->managermessagedata = new prog_message_data($managermessagedata);

    }

}

class prog_courseset_completed_message extends prog_noneventbased_message {

    public function __construct($programid, $messageob=null, $uniqueid=null) {
        global $CFG;

        parent::__construct($programid, $messageob, $uniqueid);

        $this->messagetype = MESSAGETYPE_COURSESET_COMPLETED;
        $this->helppage = 'coursesetcompletedmessage';
        $this->locked = false;
        $this->fieldsetlegend = get_string('legend:coursesetcompletedmessage', 'local_program');

        $managermessagedata = array(
            'roleid'            => $this->managerrole,
            'subject'           => get_string('coursesetcompleted', 'local_program'),
            'fullmessage'       => $this->managermessage,
            'contexturl'        => $CFG->wwwroot.'/local/program/view.php?id='.$this->programid,
            'contexturlname'    => get_string('launchprogram', 'local_program'),
        );

        $this->managermessagedata = new prog_message_data($managermessagedata);

    }

}

class prog_program_due_message extends prog_eventbased_message {

    public function __construct($programid, $messageob=null, $uniqueid=null) {
        global $CFG;

        parent::__construct($programid, $messageob, $uniqueid);

        $this->messagetype = MESSAGETYPE_PROGRAM_DUE;
        $this->helppage = 'programduemessage';
        $this->locked = false;
        $this->fieldsetlegend = get_string('legend:programduemessage', 'local_program');
        $this->triggereventstr = 'Before program is due';
        $this->managermessagedata->subject = get_string('programdue', 'local_program');

        $managermessagedata = array(
            'roleid'            => $this->managerrole,
            'subject'           => get_string('programdue', 'local_program'),
            'fullmessage'       => $this->managermessage,
            'contexturl'        => $CFG->wwwroot.'/local/program/view.php?id='.$this->programid,
            'contexturlname'    => get_string('launchprogram', 'local_program'),
        );

        $this->managermessagedata = new prog_message_data($managermessagedata);

    }

}

class prog_courseset_due_message extends prog_eventbased_message {

    public function __construct($programid, $messageob=null, $uniqueid=null) {
        global $CFG;

        parent::__construct($programid, $messageob, $uniqueid);

        $this->messagetype = MESSAGETYPE_COURSESET_DUE;
        $this->helppage = 'coursesetduemessage';
        $this->locked = false;
        $this->fieldsetlegend = get_string('legend:coursesetduemessage', 'local_program');
        $this->triggereventstr = 'Before set is due';
        $this->managermessagedata->subject = get_string('coursesetdue', 'local_program');

        $managermessagedata = array(
            'roleid'            => $this->managerrole,
            'subject'           => get_string('coursesetdue', 'local_program'),
            'fullmessage'       => $this->managermessage,
            'contexturl'        => $CFG->wwwroot.'/local/program/view.php?id='.$this->programid,
            'contexturlname'    => get_string('launchprogram', 'local_program'),
        );

        $this->managermessagedata = new prog_message_data($managermessagedata);

    }

}

class prog_program_overdue_message extends prog_eventbased_message {

    public function __construct($programid, $messageob=null, $uniqueid=null) {

        parent::__construct($programid, $messageob, $uniqueid);
        global $CFG;

        $this->messagetype = MESSAGETYPE_PROGRAM_OVERDUE;
        $this->helppage = 'programoverduemessage';
        $this->locked = false;
        $this->fieldsetlegend = get_string('legend:programoverduemessage', 'local_program');
        $this->triggereventstr = 'After program is due';
        $this->managermessagedata->subject = get_string('programoverdue', 'local_program');

        $managermessagedata = array(
            'roleid'            => $this->managerrole,
            'subject'           => get_string('programoverdue', 'local_program'),
            'fullmessage'       => $this->managermessage,
            'contexturl'        => $CFG->wwwroot.'/local/program/view.php?id='.$this->programid,
            'contexturlname'    => get_string('launchprogram', 'local_program'),
        );

        $this->managermessagedata = new prog_message_data($managermessagedata);

    }

}

class prog_courseset_overdue_message extends prog_eventbased_message {

    public function __construct($programid, $messageob=null, $uniqueid=null) {

        parent::__construct($programid, $messageob, $uniqueid);
        global $CFG;

        $this->messagetype = MESSAGETYPE_COURSESET_OVERDUE;
        $this->helppage = 'coursesetoverduemessage';
        $this->locked = false;
        $this->fieldsetlegend = get_string('legend:coursesetoverduemessage', 'local_program');
        $this->triggereventstr = 'After set is due';
        $this->managermessagedata->subject = get_string('coursesetoverdue', 'local_program');

        $managermessagedata = array(
            'roleid'            => $this->managerrole,
            'subject'           => get_string('coursesetoverdue', 'local_program'),
            'fullmessage'       => $this->managermessage,
            'contexturl'        => $CFG->wwwroot.'/local/program/view.php?id='.$this->programid,
            'contexturlname'    => get_string('launchprogram', 'local_program'),
        );

        $this->managermessagedata = new prog_message_data($managermessagedata);

    }

}

class prog_learner_followup_message extends prog_eventbased_message {

    public function __construct($programid, $messageob=null, $uniqueid=null) {

        parent::__construct($programid, $messageob, $uniqueid);
        global $CFG;

        $this->messagetype = MESSAGETYPE_LEARNER_FOLLOWUP;
        $this->helppage = 'learnerfollowupmessage';
        $this->locked = false;
        $this->fieldsetlegend = get_string('legend:learnerfollowupmessage', 'local_program');
        $this->triggereventstr = 'After program is completed';
        $this->notifymanager = false;

    }

    public function get_message_form_template(&$mform, &$template_values, &$formdataobject, $updateform=true) {

        $prefix = $this->get_message_prefix();

        $helpbutton = helpbutton($this->helppage, $this->fieldsetlegend, 'local_program', true, false, '', true);

        $templatehtml = '';
        $templatehtml .= '<fieldset id="'.$prefix.'" class="message">';
        $templatehtml .= '<legend>'.$this->fieldsetlegend.' '.$helpbutton.'</legend>';

        $templatehtml .= $this->get_generic_hidden_fields_template($mform, $template_values, $formdataobject, $updateform);
        $templatehtml .= $this->get_generic_message_buttons_template($mform, $template_values, $formdataobject, $updateform);
        $templatehtml .= $this->get_generic_trigger_fields_template($mform, $template_values, $formdataobject, $updateform);
        $templatehtml .= $this->get_generic_basic_fields_template($mform, $template_values, $formdataobject, $updateform);

        $templatehtml .= '</fieldset>';

        return $templatehtml;
    }

}

/**
 * The prog_extension_request_message class is a little different from most
 * messages because it cannot be edited by a program creator. It is a fixed
 * message that gets sent when a learner requests an extension to a program.
 * The message is only sent to the learner's manager.
 */
class prog_extension_request_message extends prog_noneventbased_message {

    public function __construct($programid, $messageob=null, $uniqueid=null) {
        global $CFG;

        parent::__construct($programid, $messageob, $uniqueid);

        $this->messagetype = MESSAGETYPE_EXTENSION_REQUEST;
        $this->helppage = 'extensionrequestmessage';
        $this->locked = false;
        $this->fieldsetlegend = get_string('legend:extensionrequestmessage', 'local_program');

        $managermessagedata = array(
            'roleid'            => $this->managerrole,
            'subject'           => $this->messagesubject,
            'fullmessage'       => $this->mainmessage,
            'contexturl'        => $CFG->wwwroot.'/local/program/exceptions.php?id='.$this->programid,
            'contexturlname'    => get_string('manageextensionrequests', 'local_program'),
        );

        $this->managermessagedata = new prog_message_data($managermessagedata);

    }

    public function send_message($recipient, $sender=null, $options=array()) {
        global $CFG;

        if($sender == null) {
            return false;
        }

        // send the message to the learner
        $this->managermessagedata->userto = $recipient;
        $this->managermessagedata->userfrom = $sender;
        $this->managermessagedata->subject = $this->replacevars($this->managermessagedata->subject);
        $this->managermessagedata->fullmessage = $this->replacevars($this->managermessagedata->fullmessage);
        $result = tm_alert_send($this->managermessagedata);

        return $result;
    }

    public function get_message_form_template(&$mform, &$template_values, &$formdataobject, $updateform=true) {

        $prefix = $this->get_message_prefix();

        $helpbutton = helpbutton($this->helppage, $this->fieldsetlegend, 'local_program', true, false, '', true);

        $templatehtml = '';
        $templatehtml .= '<fieldset id="'.$prefix.'" class="message">';
        $templatehtml .= '<legend>'.$this->fieldsetlegend.' '.$helpbutton.'</legend>';

        $templatehtml .= $this->get_generic_hidden_fields_template($mform, $template_values, $formdataobject, $updateform);
        $templatehtml .= $this->get_generic_message_buttons_template($mform, $template_values, $formdataobject, $updateform);
        $templatehtml .= $this->get_generic_basic_fields_template($mform, $template_values, $formdataobject, $updateform);

        $templatehtml .= '</fieldset>';

        return $templatehtml;
    }


}

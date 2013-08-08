<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2013 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
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
 * @author David Curry <david.curry@totaralms.com>
 * @author Valerii Kuznetsov <valerii.kuznetsov@totaralms.com>
 * @package totara
 * @subpackage feedback360
 */

require_once($CFG->dirroot . '/totara/core/lib.php');
require_once($CFG->dirroot . '/totara/question/lib.php');
require_once($CFG->dirroot . '/totara/feedback360/lib/assign/lib.php');


class feedback360 {
    /**
     * Feedback360 responders restriction flags.
     */
    const RECIPIENT_ANYUSER = 1;
    const RECIPIENT_EMAIL = 2;
    const RECIPIENT_LM = 4;
    const RECIPIENT_MANAGER = 8;
    const RECIPIENT_COHORT = 16;
    const RECIPIENT_POSITION = 32;
    const RECIPIENT_ORGANISATION = 64;

    /**
     * feedback360 status
     */
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_CLOSED = 2;
    const STATUS_COMPLETED = 3;

    /**
     * Feedback360 status
     * @var int
     */
    private $status = self::STATUS_DRAFT;

    /**
     * Feedback360 id
     * @var int
     */
    protected $id = 0;

    /**
     * User->id of the creator of the feedback
     * @var int
     */
    protected $userid = 0;

    /**
     * Feedback360 name
     * @var string
     */
    public $name = '';

    /**
     * Feedback360 description
     * @var string
     */
    public $description = '';

    /**
     * Allowed recipients groups
     * @var int bitmask
     */
    public $recipients = 0;

    /**
     * Create instance of an
     */
    public function __construct($id = 0) {
        global $DB;
        // Set "all" until recipients will be implemented on userend.
        $this->recipients = 127;
        if ($id) {
            $this->id = $id;
            $this->load();
        }
    }

    /**
     * Allow read access to restricted properties
     * @param string $name
     * @return mixed
     */
    public function __get($name) {
        if (in_array($name, array('id', 'status'))) {
            return $this->$name;
        }
    }

    /**
     * Set feedback360 properties
     *
     * @param stdClass $todb
     * @return $this
     */
    public function set(stdClass $todb) {
        if (isset($todb->name)) {
            $this->name = $todb->name;
        }
        if (isset($todb->status)) {
            $this->status = $todb->status;
        }
        if (isset($todb->description)) {
            $this->description = $todb->description;
        }
        if (isset($todb->recipients)) {
            $this->recipients = $todb->recipients;
        }
        if (isset($todb->userid)) {
            $this->userid = $todb->userid;
        }
        return $this;
    }

    /**
     * Get stdClass with feedback360 properties
     *
     * @return stdClass
     */
    public function get() {
        $obj = new stdClass();
        $obj->name = $this->name;
        $obj->description = $this->description;
        $obj->status = $this->status;
        $obj->id = $this->id;
        $obj->recipients = $this->recipients;

        return $obj;
    }

    /**
     * Saves current feedback360 properties
     *
     * @return $this
     */
    public function save() {
        global $DB, $USER;

        $todb = $this->get();

        if ($this->id > 0) {
            $todb->id = $this->id;
            $DB->update_record('feedback360', $todb);
        } else {
            $todb->userid = $USER->id;
            $this->id = $DB->insert_record('feedback360', $todb);
        }
        // Refresh data.
        $this->load($this->id);
        return $this;
    }

    /**
     * Delete a feedback360
     */
    public function delete() {
        global $DB;

        // Delete question data table.
        sql_drop_table_if_exists('{feedback360_quest_data_' . $this->id . '}');

        // Delete questions.
        $DB->delete_records('feedback360_quest_field', array('feedback360id' => $this->id));
        $userassignments = $DB->get_records('feedback360_user_assignment', array('feedback360id' => $this->id));

        // Delete grps, and all user/resp/email assignments.
        $assign = new totara_assign_feedback360('feedback360', $this);
        $assign->delete();

        // Delete the feedback360.
        $DB->delete_records('feedback360', array('id' => $this->id));
    }

    /**
     * Reload feedback360 properties from DB
     *
     * @return $this
     */
    public function load() {
        global $DB;
        $feedback360 = $DB->get_record('feedback360', array('id' => $this->id));
        if (!$feedback360) {
            throw new feedback360_exception(get_string('loadfeedback360failure', 'totara_feedback360'), 1);
        }
        $this->set($feedback360);
        return $this;
    }

    /**
     * Save user answer on feedback
     *
     * @param stdClass $formdata
     * @param feedback360_responder $resp
     * @return bool
     */
    public function save_answers(stdClass $formdata, feedback360_responder $resp) {
        global $DB;
        if ($resp->is_completed()) {
            return false;
        }
        // Get data to save.
        $answers = $this->export_answers($formdata, $resp);

        // Save.
        $questdata = $DB->get_record('feedback360_quest_data_'.$this->id, array('feedback360respassignmentid' => $resp->id));
        if (!$questdata) {
            $answers->feedback360respassignmentid = $resp->id;
            $DB->insert_record('feedback360_quest_data_'.$this->id, $answers);
        } else {
            $answers_array = (array)$answers;
            if (!empty($answers_array)) {
                $answers->id = $questdata->id;
                $answers->timemodified = time();
                // This db call fails if there are no answers found (page with only info, no user input)
                $DB->update_record('feedback360_quest_data_'.$this->id, $answers);
            }
        }
        return true;
    }

    /**
     * Load user answer on feedback
     *
     * @param feedback360_responder $resp
     * @param stdClass
     */
    public function get_answers(feedback360_responder $resp) {
        global $DB;
        $questdata = $DB->get_record('feedback360_quest_data_'.$this->id, array('feedback360respassignmentid' => $resp->id));
        if ($questdata) {
            return $this->import_answers($questdata, $resp);
        }
        return null;
    }


    /**
     * Import answers db data to form data
     * @param stdClass $questdata
     * @param stdClass $roleassignment
     * @return stdClass
     */
    public function import_answers(stdClass $questdata, feedback360_responder $resp) {
        $questionsrs = feedback360_question::get_list($this->id);
        $questionman = feedback360_question::get_manager($resp->subjectid, $resp->id);
        $answers = new stdClass();
        foreach ($questionsrs as $questiondata) {
            $question = $questionman->get_element($questiondata);
            $answers = $question->set_as_db($questdata)->get_as_form($answers, true);
        }
        return $answers;
    }

    /**
     * Export answers form data to db data
     *
     * @param stdClass $questdata
     * @param stdClass $roleassignment
     * @return stdClass
     */
    public function export_answers(stdClass $formdata, feedback360_responder $resp) {
        $questionman = feedback360_question::get_manager($resp->subjectid, $resp->id);
        $questionsrs = feedback360_question::get_list($this->id);
        $answers = new stdClass();
        foreach ($questionsrs as $questiondata) {
            $element = $questionman->get_element($questiondata);
            $answers = $element->set_as_form($formdata)->get_as_db($answers);
        }
        return $answers;
    }

    /*
     * Get an array of all feedback360s (for a particular userid)
     *
     * @param int $userid   Either get all the records or just the records for the userid
     * @return array        The array of feedback360 records
     */
    public static function get_manage_list($userid = 0) {
        global $DB, $USER;

        $context = context_system::instance();
        require_capability('totara/feedback360:managefeedback360', $context);

        $params = ($userid == 0) ? array() : array('userid' => $userid);

        return $DB->get_records('feedback360', $params);
    }

    /**
     * Clone feedback360
     * @param int $feedback360id
     * @param int $daysoffset number of days to add to each stage time due.
     */
    public static function duplicate_feedback360($feedback360id) {
        global $DB;

        // Clone the feedback360 and set it to draft.
        $feedback360 = new feedback360($feedback360id);
        $feedback360->id = 0;
        $feedback360->status = self::STATUS_DRAFT;
        $feedback360->timestarted = null;
        $feedback360->timefinished = null;
        $newfeedback360 = $feedback360->save();

        $question_records = $DB->get_records('feedback360_quest_field', array('feedback360id' => $feedback360id));
        foreach ($question_records as $question_record) {
            $question = new feedback360_question($question_record->id);
            $question->duplicate($newfeedback360->id);
        }

        // Clone assigned groups.
        $assign = new totara_assign_feedback360('feedback360', new feedback360($feedback360id));
        $assign->duplicate($newfeedback360);

        return $newfeedback360->id;
    }

    /**
     * Set current status of a feedback360
     *
     * @param int $status feedback360::STATUS_*
     */
    public function set_status($newstatus) {
        $allowedstatus = array(
            self::STATUS_ACTIVE => array(self::STATUS_CLOSED, self::STATUS_COMPLETED),
            self::STATUS_CLOSED => array(self::STATUS_ACTIVE),
            self::STATUS_DRAFT => array(self::STATUS_ACTIVE),
            self::STATUS_COMPLETED => array()
        );
        if (!in_array($newstatus, $allowedstatus[$this->status])) {
            $a = new stdClass();
            $a->oldstatus = self::display_status($this->status);
            $a->newstatus = self::display_status($newstatus);
            throw new feedback360_exception(get_string('error:cannotchangestatus', 'totara_feedback360', $a));
        } else {
            $this->status = $newstatus;
            if ($newstatus == self::STATUS_COMPLETED || $newstatus == self::STATUS_CLOSED) {
                $this->timefinished = time();
            } else if ($newstatus == self::STATUS_ACTIVE) {
                $this->timefinished = null;
            }
            $this->save();
        }
    }

    public function cancel_requests() {
        global $DB;

        // Get all user assignments for the feedback360 form.
        $user_assignments = $DB->get_records('feedback360_user_assignment', array('feedback360id' => $this->id));

        foreach ($user_assignments as $user_assignment) {

            // Cancel the resp/email assignmenst associated with the user assignment.
            if (self::cancel_user_assignment($user_assignment->id)) {
                // If there is nothing left, remove the user assignment.
                $DB->delete_records('feedback360_user_assignment', array('id' => $user_assignment->id));
            }
        }
    }

    public static function cancel_user_assignment($userassignmentid) {
        global $DB;

        // Remove all unanswered feedback requests.
        $resp_assignments = $DB->get_records('feedback360_resp_assignment', array('feedback360userassignmentid' => $userassignmentid));
        $delete_user_assignment = true;
        foreach ($resp_assignments as $resp_assignment) {
            if (empty($resp_assignment->timecompleted)) {
                self::cancel_resp_assignment($resp_assignment);
            } else {
                $delete_user_assignment = false;
            }
        }
        return $delete_user_assignment;
    }

    /**
     * Cancels a resp_assignment
     *
     * @param int/object $resp_assignment   Either the id of a resp record or the record itself.
     */
    public static function cancel_resp_assignment($resp_assignment) {
        global $CFG, $DB;

        require_once($CFG->dirroot . '/totara/message/messagelib.php');

        // Check if it is an id that has been passed in.
        if (is_int($resp_assignment)) {
            $resp_assignment = $DB->get_record('feedback360_resp_assignment', array('id' => $resp_assignment));
        }

        // Double check that it is now an object.
        if (!is_object($resp_assignment)) {
            print_error('error:unexpectedtype', 'totara_feedback360');
        }

        $stringmanager = get_string_manager();

        $user_assignment = $DB->get_record('feedback360_user_assignment', array('id' => $resp_assignment->feedback360userassignmentid));
        $feedback360 = $DB->get_record('feedback360', array('id' => $user_assignment->feedback360id));
        $userfrom = $DB->get_record('user', array('id' => $user_assignment->userid));
        $userto = $DB->get_record('user', array('id' => $resp_assignment->userid));

        $stringvars = new stdClass();
        $stringvars->userfrom = fullname($userfrom);
        $stringvars->feedbackname = format_string($feedback360->name);


        // Check for related email_assignment.
        if (!empty($resp_assignment->feedback360emailassignmentid)) {
            // Delete email_assignment.
            $param = array('id' => $resp_assignment->feedback360emailassignmentid);
            $email = $DB->get_field('feedback360_email_assignment', 'email', $param);

            $transaction = $DB->start_delegated_transaction();
            $DB->delete_records('feedback360_email_assignment', $param);
            $DB->delete_records('feedback360_resp_assignment', array('id' => $resp_assignment->id));
            $transaction->allow_commit();

            $subject = get_string('cancellationsubject', 'totara_feedback360', $stringvars);
            $message = get_string('cancellationemail', 'totara_feedback360', $stringvars);
            // Send a cancellation email.
            self::email_external_address($email, $userfrom, $subject, $message, $message);
        } else {
            $DB->delete_records('feedback360_resp_assignment', array('id' => $resp_assignment->id));

            $delete_user_assignment = false;
            $event = new stdClass;
            $event->userfrom = $userfrom;
            $event->icon = 'feedback360-cancel';
            $event->userto = $userto;
            $event->subject = $stringmanager->get_string('cancellationsubject', 'totara_feedback360', $stringvars, $userto->lang);
            $event->fullmessage = $stringmanager->get_string('cancellationalert', 'totara_feedback360', $stringvars, $userto->lang);
            $event->fullmessagehtml = $stringmanager->get_string('cancellationalert', 'totara_feedback360', $stringvars, $userto->lang);
            // Send a cancellation alert.
            tm_alert_send($event);
        }
    }

    /**
     * Retrieve the appropriate string for the status
     *
     * @param int $status   An instance of feedback360::STATUS_X
     * @return string       The corresponding string
     */
    public static function display_status($status) {
        switch ($status) {
            case self::STATUS_DRAFT:
                $result = get_string('draft', 'totara_feedback360');
                break;
            case self::STATUS_ACTIVE:
                $result = get_string('active', 'totara_feedback360');
                break;
            case self::STATUS_CLOSED:
                $result = get_string('closed', 'totara_feedback360');
                break;
            case self::STATUS_COMPLETED:
                $result = get_string('completed', 'totara_feedback360');
                break;
        }

        return $result;
    }

    public static function has_feedback360($userid = null) {
        global $USER, $DB;

        $userid = empty($userid) ? $USER->id : $userid;
        if (!$userid) {
            return false;
        }

        $systemcontext = context_system::instance();
        $usercontext = context_user::instance($userid);

        $hasone = has_capability('totara/feedback360:viewownfeedback360', $systemcontext, $userid) && self::count_own($userid)
               || has_capability('totara/feedback360:viewstaffreceivedfeedback360', $usercontext, $userid) && self::count_staff($userid);
        return $hasone;

    }

    public static function count_own($userid = null) {
        global $DB, $USER;

        $userid = empty($userid) ? $USER->id : $userid;

        // Count feedback360 forms assigned to user.
        $forms = $DB->get_fieldset_select('feedback360_user_assignment', 'id', 'userid = ?', array('userid' => $userid));
        $num_forms = count($forms);

        // Count active requests from user.
        $own_requests = 0;
        foreach ($forms as $form) {
            $own_requests += $DB->count_records('feedback360_resp_assignment', array('feedback360userassignmentid' => $form));
        }

        // Count feedbacks requested of user.
        $requests = $DB->count_records('feedback360_resp_assignment', array('userid' => $userid));

        return $num_forms + $own_requests + $requests;
    }

    public static function count_staff($userid = null) {
        global $DB, $USER;

        $userid = empty($userid) ? $USER->id : $userid;

        $fb360s = self::fetch_staff('count(*) AS cnt', $userid);
        return count($fb360s) ? current($fb360s)->cnt : 0;
    }

    /**
     * Get active appraisals assigned to user for answering/reviewing
     *
     * @param string $fields Fields list
     * @param int $userid
     * @return array of stdClass
     */
    public static function fetch_staff($fields = '', $userid = null) {
        global $DB, $USER;

        if (!$userid) {
            $userid = $USER->id;
        }

        if ($fields == '') {
            $fields = 'fb.*';
        }

        $sql = "SELECT {$fields}
                  FROM {feedback360} fb
                  JOIN {feedback360_user_assignment} fua
                    ON fua.feedback360id = fb.id
                 WHERE (fb.status = ? OR fb.status = ?)
                   AND fua.userid = ?";
        $fb360s = $DB->get_records_sql($sql, array(self::STATUS_ACTIVE, self::STATUS_COMPLETED, $userid));
        return $fb360s;
    }


    /**
     * Create table
     */
    private function create_answers_table() {
        global $DB;

        if ($this->id < 1) {
            throw new feedback360_exception(get_string('error:feedbacktablecreation', 'totara_feedback360'), 4);
        }

        $tablename = 'feedback360_quest_data_'.$this->id;
        $table = new xmldb_table($tablename);
        // Feedback360 specific fields/keys/indexes.
        $xmldb = array();
        $xmldb[] = new xmldb_field('id', XMLDB_TYPE_INTEGER, 10, XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE);
        $xmldb[] = new xmldb_field('timecompleted', XMLDB_TYPE_INTEGER, 10, XMLDB_UNSIGNED, null, null, 0);
        $xmldb[] = new xmldb_field('timemodified', XMLDB_TYPE_INTEGER, 10, XMLDB_UNSIGNED, null, null, 0);
        $xmldb[] = new xmldb_field('feedback360respassignmentid', XMLDB_TYPE_INTEGER, 10, XMLDB_UNSIGNED, XMLDB_NOTNULL);
        // feedback360 keys.
        $xmldb[] = new xmldb_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $xmldb[] = new xmldb_key('feedquestdata_feeresass'.$this->id.'_fk', XMLDB_KEY_FOREIGN, array('feedback360respassignmentid'),
            'feedback360_resp_assignment', array('id'));

        // Question specific fields/keys/indexes.
        $questionman = feedback360_question::get_manager();
        $xmldb = $questionman->get_xmldb($this->fetch_questions(), $xmldb);
        $questionman->add_db_table($xmldb, $table);

        $dbman = $DB->get_manager();
        $dbman->create_table($table);
    }

    /**
     * Check if feedback was activated
     *
     * @param int $feedback360id
     */
    public static function was_activated($feedback360id) {
        global $DB;

        $columns = $DB->get_columns('feedback360_quest_data_'.$feedback360id);
        return !empty($columns);
    }

    public function fetch_questions() {
        global $DB;

        return $DB->get_records('feedback360_quest_field', array('feedback360id' => $this->id));
    }

    /**
     * Activate the feedback.
     */
    public function activate() {
        if (!in_array($this->status, array(self::STATUS_DRAFT, self::STATUS_CLOSED))) {
            throw new feedback360_exception(get_string('error:activationstatus', 'totara_feedback360'), 5);
        }

        if ($this->status == self::STATUS_DRAFT) {
            $this->create_answers_table();
        }

        $this->set_status(self::STATUS_ACTIVE);
    }

    /**
     * Check if it is possible to activate the Feedback360
     */
    public function validate() {
        $errors = array();

        // Check it has at least one question.
        $questions = feedback360_question::get_list($this->id);
        $is_question = false;
        if (!empty($questions)) {
            foreach ($questions as $questdata) {
                $question = new feedback360_question($questdata->id);
                if ($question->get_element()->has_editable()) {
                    $is_question = true;
                }
            }
        }
        if (!$is_question) {
            $errors['questions'] = get_string('error:questionsrequired', 'totara_feedback360');
        }

        // Check that some learners are assigned.
        $assign = new totara_assign_feedback360('feedback360', $this);
        $learners = $assign->get_current_users(null, null, null, true);
        if ($learners == 0) {
            $errors['learners'] = get_string('error:learnersrequired', 'totara_feedback360');
        }
        // Check recipients.
        if ($this->recipients < 1) {
            $errors['recipients'] = get_string('error:recipientsrequired', 'totara_feedback360');
        }

        return $errors;
    }

    /**
     * Check if feedback360 is in draft state
     *
     * @param mixed $feedback360 feedback360.id or instance of feedback360
     * @return bool
     */
    public static function is_draft($feedback360) {
        if (is_numeric($feedback360)) {
            $feedback360 = new feedback360($feedback360);
        }
        if (!($feedback360 instanceof feedback360)) {
            throw new feedback360_exception('Feedback360 object not found', 2);
        }
        return ($feedback360->status == self::STATUS_DRAFT);
    }

    public static function has_user_assignment($userid, $feedback360id) {
        global $DB;

        $params = array('feedback360id' => $feedback360id, 'userid' => $userid);
        return $DB->record_exists('feedback360_user_assignment', $params);
    }

    /**
     * Sends an email to a supplied external email address
     *
     * NOTE: Doesn't support attachments.
     *
     * @param string $emailaddress      The email address we will send the message to.
     * @param object $userfrom          The system user sending out the email (needs firstname,lastname,email)
     * @param string $subject           The subject of the email being sent out
     * @param string $message           The message of the email being sent out
     * @param string $messagealt        The non-html version of the message
     * @param bool   $usetrueaddress    Determines whether $userfrom email address should be sent out.
     */
    public static function email_external_address($emailaddress, $userfrom, $subject, $message, $messagealt, $usetrueaddress = true, $wordwrapwidth = 79) {
        global $CFG;

        // Check $emailaddress is !empty and valid format.
        if (empty($emailaddress) || !validate_email($emailaddress)) {
            // we can not send emails to invalid addresses - it might create security issue or confuse the mailer
            $invalidemail = "{$emailaddress} is invalid! Not sending.";
            error_log($invalidemail);
            if (CLI_SCRIPT) {
                mtrace('Error: lib/moodlelib.php email_to_user(): '.$invalidemail);
            }
            return false;
        }

        // Check $userfrom is !empty and is a object.
        if (empty($userfrom) || !is_object($userfrom)) {
            error_log('$userfrom was empty, please make sure you specify who the message is from');
        }

        // Check the message?

        // Check if noemailever is set.
        if (!empty($CFG->noemailever)) {
            // hidden setting for development sites, set in config.php if needed
            $noemail = 'Not sending email due to noemailever config setting';
            error_log($noemail);
            if (CLI_SCRIPT && empty($UNITTEST->running)) {
                mtrace('Error: lib/moodlelib.php email_to_user(): '.$noemail);
            }
            return true;
        }

        // Check if divertallemailsto is set.
        if (!empty($CFG->divertallemailsto)) {
            $subject = "[DIVERTED {$user->email}] $subject";
            $user = clone($user);
            $user->email = $CFG->divertallemailsto;
        }

        $mail = get_mailer();
        $supportuser = generate_email_supportuser();
        $temprecipients = array();
        $tempreplyto = array();

        // handle bounces?
        if (!empty($CFG->handlebounces)) {
            $modargs = 'B'.base64_encode(pack('V',$user->id)).substr(md5($user->email),0,16);
            $mail->Sender = generate_email_processing_address(0,$modargs);
        } else {
            $mail->Sender = $supportuser->email;
        }

        // Set the user from.
        if ($usetrueaddress and !empty($userfrom->maildisplay)) {
            $mail->From     = $userfrom->email;
            $mail->FromName = fullname($userfrom);
        } else {
            $mail->From     = $CFG->noreplyaddress;
            $mail->FromName = fullname($userfrom);
            if (empty($replyto)) {
                $tempreplyto[] = array($CFG->noreplyaddress, get_string('noreplyname'));
            }
        }

        if (!empty($replyto)) {
            $tempreplyto[] = array($replyto, $replytoname);
        }

        $mail->Subject = substr($subject, 0, 900);

        $temprecipients[] = array($emailaddress);

        // Set the word wrap.
        $mail->WordWrap = $wordwrapwidth;

        // Add custom headers.
        if (!empty($userfrom->customheaders)) {
            if (is_array($userfrom->customheaders)) {
                foreach ($userfrom->customheaders as $customheader) {
                    $mail->AddCustomHeader($customheader);
                }
            } else {
                $mail->AddCustomHeader($userfrom->customheaders);
            }
        }

        // Unlikely this will be used but we'll leave it in just in case.
        if (!empty($userfrom->priority)) {
            $mail->Priority = $userfrom->priority;
        }

        // Try to send the message as HTML, should default to messagealt if unable to.
        $mail->IsHTML(true);
        $mail->Encoding = 'quoted-printable';           // Encoding to use
        $mail->Body    =  $message;
        $mail->AltBody =  "\n$messagealt\n";

        // Attachments go here in the email_to_user function from moodlelib.php.

        // Check if the email should be sent in an other charset then the default UTF-8
        if ((!empty($CFG->sitemailcharset) || !empty($CFG->allowusermailcharset))) {

            // use the defined site mail charset or eventually the one preferred by the recipient
            $charset = $CFG->sitemailcharset;
            if (!empty($CFG->allowusermailcharset)) {
                if ($useremailcharset = get_user_preferences('mailcharset', '0', $user->id)) {
                    $charset = $useremailcharset;
                }
            }

            // convert all the necessary strings if the charset is supported
            $charsets = get_list_of_charsets();
            unset($charsets['UTF-8']);
            if (in_array($charset, $charsets)) {
                $mail->CharSet  = $charset;
                $mail->FromName = textlib::convert($mail->FromName, 'utf-8', strtolower($charset));
                $mail->Subject  = textlib::convert($mail->Subject, 'utf-8', strtolower($charset));
                $mail->Body     = textlib::convert($mail->Body, 'utf-8', strtolower($charset));
                $mail->AltBody  = textlib::convert($mail->AltBody, 'utf-8', strtolower($charset));

                foreach ($temprecipients as $key => $values) {
                    $temprecipients[$key][1] = textlib::convert($values[1], 'utf-8', strtolower($charset));
                }
                foreach ($tempreplyto as $key => $values) {
                    $tempreplyto[$key][1] = textlib::convert($values[1], 'utf-8', strtolower($charset));
                }
            }
        }

        foreach ($temprecipients as $values) {
            $mail->AddAddress($values[0]);
        }
        foreach ($tempreplyto as $values) {
            $mail->AddReplyTo($values[0]);
        }

        // Try to send the email.
        if ($mail->Send()) {
            set_send_count($userfrom);
            if (!empty($mail->SMTPDebug)) {
                echo '</pre>';
            }
            return true;
        } else {
            add_to_log(SITEID, 'library', 'mailer', qualified_me(), 'ERROR: '. $mail->ErrorInfo);
            if (CLI_SCRIPT) {
                mtrace('Error: lib/moodlelib.php email_to_user(): '.$mail->ErrorInfo);
            }
            if (!empty($mail->SMTPDebug)) {
                echo '</pre>';
            }
            return false;
        }
    }

    public static function get_available_forms($userid) {
        global $DB;

        $sql = "SELECT f.*, fa.id AS assigid
                FROM {feedback360_user_assignment} fa
                JOIN {feedback360} f
                ON fa.feedback360id = f.id
                WHERE fa.userid = ?
                AND f.status = ?";
        $forms = $DB->get_records_sql($sql, array($userid, self::STATUS_ACTIVE));
        $available_forms = array();
        foreach ($forms as $form) {
            $existingrequests = $DB->count_records('feedback360_resp_assignment', array('feedback360userassignmentid' => $form->assigid));
            if ($existingrequests > 0) {
                continue;
            }
        $available_forms[] = $form;
        }

        return $available_forms;
    }

}

/**
 * Feedback questions definition
 */
class feedback360_question {

    /**
     * Feedback360 id
     * @var int
     */
    protected $id = 0;

    /**
     * Question label
     * @var string
     */
    public $name = '';

    /**
     * Relative postion in feedback form
     * @var int
     */
    public $sortorder = 0;

    /**
     * Feedback
     * @var int
     */
    public $feedback360id = null;

    /**
     * Question is required to answer
     * @var bool
     */
    public $required = false;

    /**
     * Question element instance
     * @var question_base
     */
    protected $element = null;

    /**
     * Create question instance
     *
     * @param int $id
     * @param feedback360_responder $roleassignment
     */
    public function __construct($id = 0, feedback360_responder $respassignment = null) {
        if ($id) {
            $this->id = $id;
            $this->load($respassignment);
        }
    }

    /**
     * Get read-only access to restricted properies
     * @param string $name
     */
    public function __get($name) {
        if (in_array($name, array('id', 'element'))) {
            return $this->$name;
        }
    }

    /**
     * Set question properties from form
     *
     * @param stdClass $todb
     * @return $this
     */
    public function set(stdClass $todb) {
        if (is_null($this->feedback360id) && isset($todb->feedback360id)) {
            $this->feedback360id = $todb->feedback360id;
        }

        if (isset($todb->name)) {
            $this->name = $todb->name;
        }

        if (isset($todb->sortorder)) {
            $this->sortorder = $todb->sortorder;
        }

        if (isset($todb->required)) {
            $this->required = (bool)$todb->required;
        }

        $this->get_element()->define_set($todb);
        $this->get_element()->define_export($todb);
        return $this;
    }

    /**
     * Get stdClass with question properties
     *
     * @param $isform destination is form (otherwise db)
     * @return stdClass
     */
    public function get($isform = false) {
        // Get element settings.

        $obj = new stdClass;
        if ($isform) {
            $this->element->define_get($obj);
        } else {
            $this->element->define_export($obj);
        }
        $obj->id = $this->id;
        $obj->feedback360id = $this->feedback360id;
        $obj->name = $this->name;
        $obj->sortorder = $this->sortorder;
        $obj->required = (int)$this->required;
        return $obj;
    }


    /**
     * Save question to database
     *
     * @return feedback360_question
     */
    public function save() {
        global $DB;

        $todb = $this->get();
        if ($todb->feedback360id < 1) {
            throw new feedback360_exception('Question must belong to an feedback', 32);
        }

        if ($this->id > 0) {
            $todb->id = $this->id;
            $DB->update_record('feedback360_quest_field', $todb);
        } else {
            $sql = 'SELECT sortorder
                    FROM {feedback360_quest_field}
                    WHERE feedback360id = ?
                    ORDER BY sortorder DESC';
            $neworder = $DB->get_record_sql($sql, array($todb->feedback360id), IGNORE_MULTIPLE);
            if (!$neworder) {
                $order = 0;
            } else {
                $order = $neworder->sortorder + 1;
            }
            $todb->sortorder = $order;
            $this->id = $DB->insert_record('feedback360_quest_field', $todb);
        }
        return $this;
    }

    /**
     * Load instance of question
     *
     * @param feedback360_responder $respassignment assignment of question for answer
     */
    public function load(feedback360_responder $respassignment = null) {
        global $DB;

        // Load data.
        $quest = $DB->get_record('feedback360_quest_field', array('id' => $this->id));
        if (!$quest) {
            throw new feedback360_exception('Cannot load quest field', 31);
        }

        $this->id = $quest->id;
        $this->name = $quest->name;
        $this->feedback360id = $quest->feedback360id;
        $this->sortorder = $quest->sortorder;
        $this->required = (bool)$quest->required;

        if ($respassignment) {
            $questionfield = self::get_manager($respassignment->subjectid, $respassignment->id);
        } else {
            $questionfield = self::get_manager();
        }

        $this->attach_element($questionfield->get_element($quest));
    }

    /**
     * Attach question element to question
     *
     * @param question_base $elem
     */
    public function attach_element(question_base $elem) {
        $this->element = $elem;
    }


    /**
     * Get attached element instane
     *
     * @return question_base
     */
    public function get_element() {
        return $this->element;
    }

    /**
     * Duplicate a feedback360 question given a feedbackid to assign it to
     *
     * @param int $feedback360id    The id of the feedback360 to assign the duplicate to
     */
    public function duplicate($feedback360id) {
        $this->feedback360id = $feedback360id;

        $oldelement = $this->get_element();
        $this->id = 0;
        $newquestion = $this->save();

        $element = $newquestion->get_element();
        $element->duplicate($oldelement);

        return $newquestion;

    }

    /**
     * Return instance of question manager
     * @param int $subjectid
     * @param int $respassignmentid response assignment of the user who is answering
     */
    public static function get_manager($subjectid = 0, $respassignmentid = 0) {
        return new question('feedback360', $subjectid, 'feedback360respassignmentid', $respassignmentid);
    }

    /**
     * Get list of questions related to a feedback
     *
     * @param int $feedback360id
     */
    public static function get_list($feedback360id) {
        global $DB;
        return $DB->get_records('feedback360_quest_field', array('feedback360id' => $feedback360id), 'sortorder');
    }

    /**
     * Change relative position of quesiton
     *
     * @param int $qeustionid
     * @param int $pos starts with 0
     */
    public static function reorder($questionid, $pos) {
        db_reorder($questionid, $pos, 'feedback360_quest_field', 'feedback360id');
    }

    /**
     * Delete question
     *
     * @param mixed $question feedback360_question or it's id
     * @param bool delete success
     */
    public static function delete($question) {
        global $DB;
        if (is_numeric($question)) {
            $question = new feedback360_question($question);
        }
        if (!($question instanceof feedback360_question)) {
            throw new feedback360_exception('feedback360_question object not found', 2);
        }

        // We need to be sure that all relations to feedback answers are cleaned.
        if (feedback360::was_activated($question->feedback360id)) {
            return false;
        }
        try {
            $questionman = self::get_manager();
            $element = $questionman->get_element($question);
            $element->delete();
        } catch (Exception $e) {
            // Delete even if element was badly broken.
        }
        $DB->delete_records('feedback360_quest_field', array('id' => $question->id));
        return true;
    }

    /**
     * Check if user can view answer by assignment
     *
     * @param int $assignmentid
     * @param int $userid
     * @return bool
     */
    public function user_can_view($assignmentid, $userid) {
        $resp = new feedback360_responder($assignmentid);
        if (in_array($userid , array((int)$resp->userid, $resp->subjectid))) {
            return true;
        }
        return false;
    }

}

/**
 * Feedback360 response assignments
 */
class feedback360_responder {
    /**
     * Type of assignment: by user or by email
     */
    const TYPE_USER = 0;
    const TYPE_EMAIL = 1;

    /**
     * Response id
     * @var int
     */
    protected $id = 0;

    /**
     * Feedback360 id
     * @var int
     */
    protected $feedback360id = 0;

    /**
     * Feedback360 user assignment id
     * @var int
     */
    protected $feedback360userassignmentid = 0;

    /**
     * Response user id
     * @var int
     */
    protected $userid = 0;

    /**
     * Email assignment email
     * @var string
     */
    protected $email = '';

    /**
     * Email assignment email
     * @var string
     */
    protected $token = '';

    /**
     * Type of assignment
     * @var type
     */
    public $type = self::TYPE_USER;

    /**
     * User that requested feedback
     * @var int
     */
    protected $subjectid = 0;

    /**
     * Is user that requested feedback watched response
     * @var bool
     */
    public $viewed = false;

    /**
     * Time when feedback was requested
     * @var int
     */
    public $timeassigned = 0;

    /**
     * Time when feedback360 response was completed
     *
     * @var int
     */
    public $timecompleted = 0;

    /**
     * When feedback should be completed
     * Read only from user assignment
     * @var int
     */
    protected $timedue = 0;

    /**
     * Fake response - do not save
     * @var bool
     */
    protected $fake = false;

    /**
     * Constructor
     * @param int $id feedback360_resp_assignment.id
     */
    public function __construct($id = 0) {
        if ($id > 0) {
            $this->load($id);
        }
    }

    /**
     * Allow read access to restricted properties
     * @param string $name
     * @return mixed
     */
    public function __get($name) {
        if (isset($this->$name)) {
            return $this->$name;
        }
    }

    /**
     * Factory method to get assignment by email
     *
     * @param string $email
     * @param string $token
     * @return feedback360_responder
     */
    public static function by_email($email, $token) {
        global $DB;

        // Get feedback360_resp_assignment.id by email and token record from feedback360_email_assignment.
        $emailparams = array('email' => $email, 'token' => $token);
        $emailid = $DB->get_field('feedback360_email_assignment', 'id', $emailparams);

        // Instantiate and return feedback360_responder.
        $resp = $DB->get_record('feedback360_resp_assignment', array('feedback360emailassignmentid' => $emailid));
        return new feedback360_responder($resp->id);
    }

    /**
     * Factory method to get assignment by user id's and feedback id
     *
     * @param int $userid that will respond on feedback
     * @param int $feedback360id
     * @param int $subjectid user that requested feedback
     * @return feedback360_responder
     */
    public static function by_user($userid, $feedback360id, $subjectid) {
        global $DB;
        $sql = "SELECT fra.id
                FROM {feedback360_user_assignment} fua
                JOIN {feedback360_resp_assignment} fra ON (fra.feedback360userassignmentid = fua.id)
                WHERE fra.userid = ? AND fua.feedback360id = ? AND fua.userid = ?";

        if (!$data = $DB->get_record_sql($sql, array($userid, $feedback360id, $subjectid))) {
            print_error('error:respassignmentaccess', 'totara_feedback360');
        }


        return new feedback360_responder($data->id);
    }

    /**
     * Factory method to get fake assignment for preview
     *
     * @param int $feedback360id
     * @return feedback360_responder fake instance
     */
    public static function by_preview($feedback360id) {
        global $USER;
        $fakeresp = new feedback360_responder();
        $fakeresp->feedback360id = $feedback360id;
        $fakeresp->type = self::TYPE_USER;
        $fakeresp->userid = $USER->id;
        $fakeresp->subjectid = $USER->id;
        $fakeresp->timeassigned = time();
        $fakeresp->timedue = time() + 3600;
        $fakeresp->fake = true;
        return $fakeresp;
    }

    /**
     * Load object from db
     *
     * @param int $id
     */
    public function load($id) {
        global $DB;
        $sql = "SELECT fra.*, fua.feedback360id, fua.userid as subjectid, fua.timedue, fea.email, fea.token
                FROM {feedback360_resp_assignment} fra
                JOIN {feedback360_user_assignment} fua ON (fua.id = fra.feedback360userassignmentid)
                LEFT JOIN {feedback360_email_assignment} fea ON (fea.id = fra.feedback360emailassignmentid)
                WHERE fra.id = ?";
        $respdata = $DB->get_record_sql($sql, array($id), '*', MUST_EXIST);
        $this->id = $respdata->id;
        $this->feedback360id = $respdata->feedback360id;
        $this->feedback360userassignmentid = $respdata->feedback360userassignmentid;
        $this->subjectid = $respdata->subjectid;
        $this->viewed = $respdata->viewed;
        $this->timeassigned = $respdata->timeassigned;
        $this->timecompleted = $respdata->timecompleted;
        $this->timedue = $respdata->timedue;

        if ($respdata->feedback360emailassignmentid > 0) {
            if (empty($respdata->email) || empty($respdata->token)) {
                throw new feedback360_exception('Cannot load responder', 41);
            }
            $this->type = self::TYPE_EMAIL;
            $this->email = $respdata->email;
            $this->token = $respdata->token;
        } else {
            $this->type = self::TYPE_USER;
            $this->userid = $respdata->userid;
        }
    }

    /**
     * Save response assignment changes
     */
    public function save() {
        global $DB;
        $data = new stdClass();

        $data->id = $this->id;
        $data->feedback360userassignmentid = $this->feedback360userassignmentid;
        $data->timeassigned = $this->timeassigned;
        $data->viewed = $this->viewed;
        $data->timecompleted = $this->timecompleted;
        if ($this->type == self::TYPE_USER) {
            $data->userid = $this->userid;
        } else {
            if ($this->id > 0) {
                // Try to find email assignment
                $email = $DB->get_record('feedback360_email_assignment', array('email' => $this->email, 'token' => $this->token));
                if ($email) {
                    $data->feedback360emailassignmentid = $email->id;
                }
            }
            if (!isset($data->feedback360emailassignmentid) || !$data->feedback360emailassignmentid) {
                $email = new stdClass();
                $email->email = $this->email;
                $email->token = $this->token;
                $data->feedback360emailassignmentid = $DB->insert_record('feedback360_email_assignment', $email);
            }
        }

        if ($this->id > 0) {
            $DB->update_record('feedback360_resp_assignment', $data);
        } else {
            $DB->insert_record('feedback360_resp_assignment', $data);
        }
    }

    /**
     * Mark assignment as completed
     * @param int $time time stamp of completion
     */
    public function complete($time = 0) {
        if (!$time) {
            $time = time();
        }
        $this->timecompleted = $time;
        $this->save();
    }

    /**
     * Is response completed
     *
     * @return bool
     */
    public function is_completed() {
        return (bool)$this->timecompleted;
    }

    /**
     * Fake response assignmnet
     *
     * @return bool
     */
    public function is_fake() {
        return $this->fake;
    }

    /**
     * Is this response assignement to email
     *
     * @return bool
     */
    public function is_email() {
        return $this->type == self::TYPE_EMAIL;
    }

    /**
     * Is this response assignement to user
     *
     * @return bool
     */
    public function is_user() {
        return $this->type == self::TYPE_USER;
    }

    /**
     * Create the records for feedback360_resp_assignment.
     *
     * @param array $new                An array of userids to create assignments for
     * @param array $cancel                An array of existing userids that need to be cancelled
     * @param int $userformid           The id of the linked feedback360_user_assignment
     * @param int $duedate              The date they should submit feedback by, for the notification
     */
    public static function update_system_assignments($new, $cancel, $userformid, $duedate) {
        global $DB, $CFG;

        require_once($CFG->dirroot . '/totara/message/messagelib.php');

        $stringmanager = get_string_manager();

        $sql = "SELECT u.*, ua.feedback360id
                FROM {feedback360_user_assignment} ua
                JOIN {user} u
                ON u.id = ua.userid
                WHERE ua.id = :uaid";
        $userfrom = $DB->get_record_sql($sql, array('uaid' => $userformid));

        // Create all the resp_assignments.
        $resp_assignment = new stdClass();
        $resp_assignment->feedback360userassignmentid = $userformid;
        $resp_assignment->timeassigned = time();

        $taskvars = new stdClass();
        $taskvars->fullname = fullname($userfrom);

        // Loop through the users to add and assign them where appropriate.
        foreach ($new as $userid) {
            $resp_assignment->userid = $userid;
            $DB->insert_record('feedback360_resp_assignment', $resp_assignment);

            $userto = $DB->get_record('user', array('id' => $userid));

            $params = array('userid' => $userfrom->id, 'feedback360id' => $userfrom->feedback360id);
            $url = new moodle_url('/totara/feedback360/feedback.php', $params);
            $taskvars->link = html_writer::link($url, $url->out());
            $taskvars->url = $url->out();

            // Send a task to the requested user.
            $eventdata = new stdClass();
            $eventdata->userto = $userto;
            $eventdata->useridfrom = $userfrom->id;
            $eventdata->icon = 'feedback360-request';
            $eventdata->subject =      $stringmanager->get_string('emailrequestsubject', 'totara_feedback360', $taskvars, $userto->lang);
            $eventdata->fullmessage =  $stringmanager->get_string('emailrequeststr', 'totara_feedback360', $taskvars, $userto->lang);
            tm_task_send($eventdata);
        }

        // Loop through everything in the cancel array and remove their resp_assignment.
        foreach ($cancel as $userid) {
            $resp_params = array('userid' => $userid, 'feedback360userassignmentid' => $userformid);
            $resp_assignment = $DB->get_record('feedback360_resp_assignment', $resp_params);
            feedback360::cancel_resp_assignment($resp_assignment);
        }
    }

    /**
     * Create the records for feedback360_resp_assignment.
     *
     * @param array() $newassignments   An array of email addresses to create feedback360_email_assignment records for
     * @param array() $cancellations    An array of email addresses to cancel existing requests to
     * @param int $userformid           The id of the linked feedback360_user_assignment
     * @param int $duedate              The date they should submit feedback by, for the email
     */
    public static function update_external_assignments($newassignments, $cancellations, $userformid, $duedate) {
        global $DB, $CFG;
        $sql = "SELECT u.*
                FROM {feedback360_user_assignment} ua
                JOIN {user} u
                ON u.id = ua.userid
                WHERE ua.id = :uaid";
        $userfrom = $DB->get_record_sql($sql, array('uaid' => $userformid));

        // Create and link the email and resp assignments.
        $emailvars = new stdClass();
        $emailvars->fullname = fullname($userfrom);

        $resp_assignment = new stdClass();
        $resp_assignment->feedback360userassignmentid = $userformid;
        $resp_assignment->timeassigned = time();
        foreach ($newassignments as $email) {
            // Create the feedback360_email_assignment.
            $email_assignment = new stdClass();
            $email_assignment->email = $email;
            $email_assignment->token = sha1($email . ',' . 'feedback360_user_assignment:' . $userformid . ',' . time());
            $emailid = $DB->insert_record('feedback360_email_assignment', $email_assignment);

            // Create and link the feedback360_resp_assignment.
            $resp_assignment->userid = $CFG->siteguest; // They aren't a user so we'll put them down as guests.
            $resp_assignment->feedback360emailassignmentid = $emailid;
            $DB->insert_record('feedback360_resp_assignment', $resp_assignment);

            // Set up some variables for the email.
            $params = array('token' => $email_assignment->token);
            $url = new moodle_url('/totara/feedback360/feedback.php', $params);
            $emailvars->link = html_writer::link($url, $url->out());
            $emailvars->url = $url->out();
            $emailstr = get_string('emailrequeststr', 'totara_feedback360', $emailvars);
            $emailstralt = get_string('emailrequeststralt', 'totara_feedback360', $emailvars);
            $emailsubject = get_string('emailrequestsubject', 'totara_feedback360', $emailvars);

            // Send the email requesting feedback from external email.
            feedback360::email_external_address($email, $userfrom, $emailsubject, $emailstr, $emailstralt);
        }

        foreach ($cancellations as $email) {
            $sql = "SELECT ra.*, ea.email
                    FROM {feedback360_resp_assignment} ra
                    JOIN {feedback360_email_assignment} ea
                    on ra.feedback360emailassignmentid = ea.id
                    WHERE ra.feedback360userassignmentid = ?
                    and ea.email = ?";
            $params = array($userformid, $email);
            $resp_assign = $DB->get_record_sql($sql, $params);

            feedback360::cancel_resp_assignment($resp_assign);
        }
    }

    public static function update_timedue($duedate, $userformid) {
        global $DB;

        // Update the due date.
        $user_assignment = $DB->get_record('feedback360_user_assignment', array('id' => $userformid));
        $user_assignment->timedue = $duedate;
        $DB->update_record('feedback360_user_assignment', $user_assignment);
    }
}

/**
 * Exceptions related to Feedback360
 */
class feedback360_exception extends Exception {
}


/**
 * Serves the folder files.
 *
 * @package  mod_folder
 * @category files
 * @param stdClass $course course object
 * @param stdClass $cm course module
 * @param stdClass $context context object
 * @param string $filearea file area
 * @param array $args extra arguments
 * @param bool $forcedownload whether or not force download
 * @param array $options additional options affecting the file serving
 * @return bool false if file not found, does not return if found - just send the file
 */
function totara_feedback360_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options=array()) {
    global $USER;

    $questionid = (int)str_replace('quest_', '', $filearea);
    $assignmentid = (int)array_shift($args);
    $filename = array_shift($args);

    $fs = get_file_storage();

    // Check that current user can view this file.
    if (!$question = new feedback360_question($questionid)) {
        send_file_not_found();
    }

    if (!$question->user_can_view($assignmentid, $USER->id)) {
        send_file_not_found();
    }

    if (!$file = $fs->get_file($context->id, 'totara_feedback360', $filearea, $assignmentid, '/', $filename)) {
        send_file_not_found();
    }

    session_get_instance()->write_close();
    send_stored_file($file, 60*60, 0, $forcedownload, array('preview' => $options['preview']));
}

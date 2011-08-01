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

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}


abstract class prog_exception {
    public $id, $programid, $exceptiontype, $userid, $timeraised;
    public function __construct($programid, $exceptionob=null) {

        if(is_object($exceptionob)) {
            $this->id = $exceptionob->id;
            $this->programid = $exceptionob->programid;
            $this->exceptiontype = $exceptionob->exceptiontype;
            $this->userid = $exceptionob->userid;
            $this->timeraised = $exceptionob->timeraised;
        $this->assignmentid = $exceptionob->assignmentid;
        } else {
            $this->id = 0;
            $this->programid = $programid;
            $this->exceptiontype = 0;
            $this->userid = 0;
            $this->timeraised = time();
        $this->assignmentid = 0;
        }

    }

    public static function insert_exception($programid, $exceptiontype, $userid, $assignmentid, $timeraised=null, $exceptiondata=array()) {
        $dataobjects = array();

        if( ! empty($exceptiondata)) {
            foreach($exceptiondata as $dataname=>$datavalue) {
                $ob = new stdClass();
                $ob->dataname = $dataname;
                $ob->datavalue = $datavalue;
                $dataobjects[] = $ob;
            }
        }

        if( ! $timeraised) {
            $timeraised = time();
        }

        $exception = new stdClass();
        $exception->programid = $programid;
        $exception->exceptiontype = $exceptiontype;
        $exception->userid = $userid;
        $exception->timeraised = $timeraised;
    $exception->assignmentid = $assignmentid;

        begin_sql();

        if($exceptionid = insert_record('prog_exception', $exception)) {

            foreach($dataobjects as $dataobject) {
                $dataobject->exceptionid = $exceptionid;
                if( ! insert_record('prog_exception_data', $dataobject)) {
                    rollback_sql();
                    return false;
                }
            }

            commit_sql();
            return $exceptionid;

        } else {
            rollback_sql();
            return false;
        }

    }

    public static function exception_exists($programid, $exceptiontype, $userid) {
        return record_exists_select('prog_exception', "programid = $programid AND exceptiontype = $exceptiontype AND userid = $userid");
    }

    public static function delete_exception($exceptionid) {
        // first delete any data relating to this exception
        if( ! delete_records('prog_exception_data', 'exceptionid', $exceptionid)) {
            return false;
        }
        // then delete the exception itself
        return delete_records('prog_exception', 'id', $exceptionid);
    }

    public function handles($action) {
        switch($action) {
        case SELECTIONACTION_DISMISS_EXCEPTION:
            return true;
            break;
        default:
            return false;
            break;
        }
    }

    public function handle($action=null) {

        if( ! $this->handles($action)) {
            return true;
        }

        switch($action) {
        case SELECTIONACTION_DISMISS_EXCEPTION:
            return $this->dismiss_exception();
            break;
        default:
            return true;
            break;
        }
    }

    protected function override_and_add_program() {

        $program = new program($this->programid);

        $assignment_record = get_record('prog_assignment','id',$this->assignmentid);
    if (!$assignment_record) {
        return false;
    }

    $timedue = $program->make_timedue($this->userid, $assignment_record);

    if( ! $program->assign_learner($this->userid, $timedue, $assignment_record)) {
            return false;
        }

        return prog_exception::delete_exception($this->id);

    }

    /**
     * Work out a viable due date and then proceed with the assignment
     * @return boolean success
     */
    protected function set_auto_time_allowance() {

    $program = new program($this->programid);

    $assignment_record = get_record('prog_assignment','id',$this->assignmentid);
    if (!$assignment_record) {
        return false;
    }

    // Get the total time allowed for the content in the program
    $total_time_allowed = $program->content->get_total_time_allowance();

    // Give the user this much time plus one week (from now!)
    $timedue = time() + $total_time_allowed + 604800;

    if( ! $program->assign_learner($this->userid, $timedue, $assignment_record)) {
            return false;
        }

    return prog_exception::delete_exception($this->id);

    }

    /**
     * Dismiss and ignore this exception
     *
     * @return boolean success
     */
    private function dismiss_exception() {
    return prog_exception::delete_exception($this->id);
    }

}

class time_allowance_exception extends prog_exception {

    public function __construct($programid, $exceptionob=null) {
        parent::__construct($programid, $exceptionob);
        $this->exceptiontype = EXCEPTIONTYPE_TIME_ALLOWANCE;
    }

    public function handles($action) {
        switch($action) {
            case SELECTIONACTION_OVERRIDE_EXCEPTION:
            case SELECTIONACTION_AUTO_TIME_ALLOWANCE:
            case SELECTIONACTION_DISMISS_EXCEPTION:
                return true;
            break;
            default:
                return false;
            break;
        }
    }

    public function handle($action=null) {

        if( ! $this->handles($action)) {
            return true;
        }

        switch($action) {
            case SELECTIONACTION_AUTO_TIME_ALLOWANCE:
                return $this->set_auto_time_allowance();
            break;
            case SELECTIONACTION_OVERRIDE_EXCEPTION:
                return $this->override_and_add_program();
            break;
            default:
                return parent::handle($action);
            break;
        }
    }
}

class already_assigned_exception extends prog_exception {

    public function __construct($programid, $exceptionob=null) {
        parent::__construct($programid, $exceptionob);
        $this->exceptiontype = EXCEPTIONTYPE_ALREADY_ASSIGNED;
    }

    public function handles($action) {
        switch($action) {
            case SELECTIONACTION_OVERRIDE_EXCEPTION:
            case SELECTIONACTION_DISMISS_EXCEPTION:
                return true;
            break;
            default:
                return false;
            break;
        }
    }

    public function handle($action=null) {

        if( ! $this->handles($action)) {
            return true;
        }

        switch($action) {
            case SELECTIONACTION_OVERRIDE_EXCEPTION:
                return $this->override_and_add_program();
            break;
            default:
                return parent::handle($action);;
            break;
        }
    }

}

class extension_request_exception extends prog_exception {

    public $extensiondate, $extensionreason;

    const extensiondate_name = 'extensiondate';
    const extensionreason_name = 'extensionreason';

    public function __construct($programid, $exceptionob=null) {

        parent::__construct($programid, $exceptionob);
        $this->exceptiontype = EXCEPTIONTYPE_EXTENSION_REQUEST;

        if($this->id != 0) {
            if( ! $this->extensiondate = get_field('prog_exception_data', 'datavalue', 'exceptionid', $this->id, 'dataname', self::extensiondate_name)) {
                $this->extensiondate = 0;
            }
            if( ! $this->extensionreason = get_field('prog_exception_data', 'datavalue', 'exceptionid', $this->id, 'dataname', self::extensionreason_name)) {
                $this->extensionreason = '';
            }
        } else {
            $this->extensiondate = 0;
            $this->extensionreason = '';
        }
    }

    public function handles($action) {
        switch($action) {
            case SELECTIONACTION_GRANT_EXTENSION_REQUEST:
            case SELECTIONACTION_DENY_EXTENSION_REQUEST:
            case SELECTIONACTION_DISMISS_EXCEPTION:
                return true;
            break;
            default:
                return false;
            break;
        }
    }

    public function handle($action=null) {

        if( ! $this->handles($action)) {
            return true;
        }

        switch($action) {
            case SELECTIONACTION_GRANT_EXTENSION_REQUEST:
                return $this->grant_extension();
            case SELECTIONACTION_DENY_EXTENSION_REQUEST:
                return $this->deny_extension();
            break;
            default:
                return true;
            break;
        }
    }

    protected function grant_extension() {

        $program = new program($this->programid);

        if( ! $program->set_timedue($this->userid, $this->extensiondate)) {
            return false;
        } else {

            $roleid = get_field('role', 'id', 'shortname', 'student');
        if (!$roleid) {
        print_error('error:failedtofindstudentrole', 'local_program');
        }

            $userto = get_record('user', 'id', $this->userid);
        if (!$userto) {
        print_error('error:failedtofinduser', 'local_program', $this->userid);
        }

            $userfrom = totara_get_manager($this->userid);

            $messagedata = new stdClass();
            $messagedata->userto           = $userto;
            $messagedata->userfrom         = $userfrom;
            $messagedata->roleid           = $roleid;
            $messagedata->subject          = get_string('extensiongranted', 'local_program');
            $messagedata->contexturl       = $CFG->wwwroot.'/local/program/required.php?id='.$this->programid;
            $messagedata->contexturlname   = get_string('launchprogram', 'local_program');
            $messagedata->fullmessage      = get_string('extensiongrantedmessage', 'local_program', userdate($this->extensiondate, '%d/%m/%Y', $CFG->timezone));

            $eventdata = new stdClass();
            //$eventdata->program = $program;
            $eventdata->message = $messagedata;

            // trigger this event for any listening handlers to catch
            events_trigger('program_extension_granted', $eventdata);

            return prog_exception::delete_exception($this->id);

        }

    }

    protected function deny_extension() {

        $roleid = get_field('role', 'id', 'shortname', 'student');
    if (!$roleid) {
        print_error('error:failedtofindstudentrole', 'local_program');
    }

        $userto = get_record('user', 'id', $this->userid);
        $userfrom = totara_get_manager($this->userid);

        $messagedata = new stdClass();
        $messagedata->userto           = $userto;
        $messagedata->userfrom         = $userfrom;
        $messagedata->roleid           = $roleid;
        $messagedata->subject          = get_string('extensiondenied', 'local_program');;
        $messagedata->contexturl       = $CFG->wwwroot.'/local/program/required.php?id='.$this->programid;
        $messagedata->contexturlname   = get_string('launchprogram', 'local_program');
        $messagedata->fullmessage      = get_string('extensiondeniedmessage', 'local_program');

        $eventdata = new stdClass();
        //$eventdata->program = $program;
        $eventdata->message = $messagedata;

        // trigger this event for any listening handlers to catch
        events_trigger('program_extension_denied', $eventdata);

    return prog_exception::delete_exception($this->id);

    }

}

class completion_time_unknown_exception extends prog_exception {
    public function __construct($programid, $exceptionob=null) {
        parent::__construct($programid, $exceptionob);
        $this->exceptiontype = EXCEPTIONTYPE_COMPLETION_TIME_UNKNOWN;
    }

    public function handles($action) {
        switch($action) {
            case SELECTIONACTION_AUTO_TIME_ALLOWANCE:
            case SELECTIONACTION_DISMISS_EXCEPTION:
                return true;
            break;
            default:
                return false;
            break;
        }
    }

    public function handle($action=null) {
        if( ! $this->handles($action)) {
            return true;
        }

        switch($action) {
            case SELECTIONACTION_AUTO_TIME_ALLOWANCE:
                return $this->set_auto_time_allowance();
            break;
            default:
                return parent::handle($action);;
            break;
        }
    }
}

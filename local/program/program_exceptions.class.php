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

define('EXCEPTIONTYPE_TIME_ALLOWANCE', 1);
define('EXCEPTIONTYPE_ALREADY_ASSIGNED', 2);
define('EXCEPTIONTYPE_EXTENSION_REQUEST', 3);
define('EXCEPTIONTYPE_COMPLETION_TIME_UNKNOWN', 4);

define('SELECTIONTYPE_NONE', 0);
define('SELECTIONTYPE_ALL', -1);
define('SELECTIONTYPE_TIME_ALLOWANCE', 1);
define('SELECTIONTYPE_ALREADY_ASSIGNED', 2);
define('SELECTIONTYPE_EXTENSION_REQUEST', 3);
define('SELECTIONTYPE_COMPLETION_TIME_UNKNOWN', 4);

define('SELECTIONACTION_NONE', 0);
define('SELECTIONACTION_AUTO_TIME_ALLOWANCE', 1);
define('SELECTIONACTION_OVERRIDE_EXCEPTION', 2);
define('SELECTIONACTION_DISMISS_EXCEPTION', 3);
define('SELECTIONACTION_GRANT_EXTENSION_REQUEST', 4);
define('SELECTIONACTION_DENY_EXTENSION_REQUEST', 5);

define('RESULTS_PER_PAGE', 50);

class prog_exceptions_manager {

    protected $programid;
    protected $selectedexceptions;

    public $exceptiontype_classnames;
    private $exceptiontype_descriptors;
    private $exception_actions;

    function __construct($programid) {
        $this->programid = $programid;
        $this->selectedexceptions = array();

        $this->exceptiontype_classnames = array(
            EXCEPTIONTYPE_TIME_ALLOWANCE    => 'time_allowance_exception',
            EXCEPTIONTYPE_ALREADY_ASSIGNED  => 'already_assigned_exception',
            EXCEPTIONTYPE_EXTENSION_REQUEST  => 'extension_request_exception',
            EXCEPTIONTYPE_COMPLETION_TIME_UNKNOWN => 'completion_time_unknown_exception',
        );

        $this->exceptiontype_descriptors = array(
            EXCEPTIONTYPE_TIME_ALLOWANCE    => get_string('timeallowance', 'local_program'),
            EXCEPTIONTYPE_ALREADY_ASSIGNED  => get_string('currentlyassigned', 'local_program'),
            EXCEPTIONTYPE_EXTENSION_REQUEST  => get_string('extensionrequest', 'local_program'),
            EXCEPTIONTYPE_COMPLETION_TIME_UNKNOWN  => get_string('completiontimeunknown', 'local_program'),
        );

        $this->exception_actions = array(
            SELECTIONACTION_NONE,
            SELECTIONACTION_AUTO_TIME_ALLOWANCE,
            SELECTIONACTION_OVERRIDE_EXCEPTION,
            SELECTIONACTION_DISMISS_EXCEPTION,
            SELECTIONACTION_GRANT_EXTENSION_REQUEST,
            SELECTIONACTION_DENY_EXTENSION_REQUEST,
        );
    }

    public function get_selected_exceptions() {
        return $this->selectedexceptions;
    }

    /**
     * Adds a new exception.
     *
     * @param int $exceptiontype
     * @param int $userid
     * @param int $assignmentid
     * @param int $timeraised
     * @param array $exceptiondata
     * @return <type>
     */
    public function raise_exception($exceptiontype, $userid, $assignmentid, $timeraised=null, $exceptiondata=array()) {
        if (prog_exception::exception_exists($this->programid, $exceptiontype, $userid)) {
            // Return true if this exception has already been raised
            return true;
        }
        return prog_exception::insert_exception($this->programid, $exceptiontype, $userid, $assignmentid, $timeraised, $exceptiondata);
    }

    /**
     * Deletes an exception from the database
     *
     * @param <type> $exceptionid
     */
    public function delete_exception($exceptionid) {
        return prog_exception::delete_exception($exceptionid);
    }

    /**
     * Deletes all exceptions and exception data relating to a specific assignment
     * from the database
     *
     * @global object $CFG
     * @param int $assignmentid
     * @return bool Success status
     */
    public static function delete_exceptions_by_assignment($assignmentid) {
        global $CFG;

        begin_sql();

        // first delete all exception_data entries for exceptions relating to this assignment
        $subquery = "SELECT DISTINCT(id) FROM {$CFG->prefix}prog_exception WHERE assignmentid = $assignmentid";
        $select = "exceptionid IN ($subquery)";
        if (delete_records_select('prog_exception_data', $select)!==false) {
            if (delete_records('prog_exception', 'assignmentid', $assignmentid)!==false) {
                commit_sql();
                return true;
            }
        }

        rollback_sql();
        return false;

    }

    /**
     * Deletes all exceptions and exception-related data for this program
     *
     * @return bool
     */
    public function delete() {

        $result = true;

        begin_sql();

        if($result) {
            if($exceptions = get_records('prog_exception', 'programid', $this->programid)) {
                foreach($exceptions as $exception) {
                    $result = $result && delete_records('prog_exception_data', 'exceptionid', $exception->id);
                }
            }
        }

        if($result) {
            $result = $result && delete_records('prog_exception', 'programid', $this->programid);
        }

        if ($result) {
            commit_sql();
        }
        else {
            rollback_sql();
        }

        return $result;
    }

    public function handle_exceptions($action, $formdata) {
        foreach($this->selectedexceptions as $selectedexception) {
            return $this->handle_exception($selectedexception->id, $action);
        }
    }

    public function count_exceptions() {
        global $CFG;

        $sql = "SELECT COUNT(ex.id)
        FROM {$CFG->prefix}prog_exception ex
        INNER JOIN {$CFG->prefix}user us ON us.id = ex.userid
        WHERE ex.programid = {$this->programid} AND us.deleted = 0";

        return count_records_sql($sql);
    }

    public function handle_exception($exceptionid, $action) {

        if( ! $exception = get_record('prog_exception', 'id', $exceptionid)) {
            throw new ProgramExceptionException(get_string('exceptionnotfound','local_program'));
        }

        if( ! array_key_exists($exceptiontype, $this->exceptiontype_classnames)) {
            throw new ProgramExceptionException(get_string('exceptiontypenotfound','local_program'));
        }

        $exception_classname = $this->exceptiontype_classnames[$exception->exceptiontype];
        $exceptionob = new $exception_classname($exception);

        return $exceptionob->handle($action);
    }

    /**
     * Creates an array containing the ids of all the exceptions that match a
     * specific selection criteia
     *
     * @param int $selectiontype
     * @return bool
     */
    public function set_selections($selectiontype, $searchterm='') {

        if ($selectiontype == SELECTIONTYPE_ALL) {
            $this->selectedexceptions = $this->search_exceptions('all', $searchterm);
        } else if ($selectiontype == SELECTIONTYPE_NONE) {
            $this->selectedexceptions = array();
        } else {
            switch($selectiontype) {
                case SELECTIONTYPE_TIME_ALLOWANCE:
                    $exceptiontype = EXCEPTIONTYPE_TIME_ALLOWANCE;
                break;
                case SELECTIONTYPE_ALREADY_ASSIGNED:
                    $exceptiontype = EXCEPTIONTYPE_ALREADY_ASSIGNED;
                break;
                case SELECTIONTYPE_EXTENSION_REQUEST:
                    $exceptiontype = EXCEPTIONTYPE_EXTENSION_REQUEST;
                break;
                case SELECTIONTYPE_COMPLETION_TIME_UNKNOWN:
                    $exceptiontype = EXCEPTIONTYPE_COMPLETION_TIME_UNKNOWN;
                break;
            }
            $this->selectedexceptions = $this->search_exceptions('all', $searchterm, $exceptiontype);

        }

        return true;

    }

    public function search_exceptions($page='all', $searchterm='', $exceptiontype='', $count=false) {
        global $CFG;

        $fields = 'ex.*, us.firstname as firstname, us.lastname as lastname, us.id as userid';
        if ($count) {
            $fields = 'COUNT(ex.id)';
        }

        $sql = "SELECT $fields
        FROM {$CFG->prefix}prog_exception ex
        INNER JOIN {$CFG->prefix}user us ON us.id = ex.userid
        WHERE ex.programid = {$this->programid} AND us.deleted = 0";

        if ( ! empty($exceptiontype)) {
            $sql .= " AND ex.exceptiontype = $exceptiontype";
        }

        if (!empty($searchterm)) {
            $searchterm = addslashes($searchterm);
            if (is_numeric($searchterm)) {
                $sql .= " AND us.id = $searchterm";
            }
            else {
                $sql .= " AND " . sql_concat('us.firstname','us.lastname') . " " . sql_ilike() . " '%{$searchterm}%'";
            }
        }

        if ($count) {
            return count_records_sql($sql);
        }

        if (is_int($page)) {
            $sql .= " LIMIT " . RESULTS_PER_PAGE;
            $sql .= " OFFSET " . (($page) * RESULTS_PER_PAGE);
        }

        $exceptions = get_records_sql($sql);

        if (!empty($exceptions)) {
            return $exceptions;
        } else {
            return array();
        }

    }

    private function build_link() {
        global $CFG;
        return $CFG->wwwroot . '/local/program/exceptions.php?id='. $this->programid;
    }

    public function print_search($previoussearch='',$return=false) {
        global $CFG;

        $out = '<form method="get" action="'. $this->build_link() .'">';
        $out .= '<label for="exception_search" >'. get_string('searchforindividual', 'local_program') .' </label>';
        $out .= '<input type="text" id="exception_search" name="search" value="'. $previoussearch .'" />';
        $out .= '<input type="hidden" name="id" value="'. $this->programid .'" />';
        $out .= '<input type="submit" value="'. get_string('search') .'" />';
        $out .= '</form>';

        if ($return) {
            return $out;
        }
        echo $out;
    }

    public function print_exceptions_form($exceptions, $selectedexceptions=null, $selectiontype=SELECTIONTYPE_NONE, $return=false) {
        global $CFG;

        if ($selectedexceptions==null) {
            $selectedexceptions = $this->selectedexceptions;
        }

        $out = '';
        $numexceptions = count($exceptions);
        $numselectedexceptions = count($selectedexceptions);

        if($numexceptions == 0) {
            $out .= '<p>'.get_string('noprogramexceptions', 'local_program').'</p>';
        } else {

            $out .= '<form name="exceptionsform" method="post" action="">';
            $out .= '<input type="hidden" name="id" value="'.$this->programid.'" />';

            $out .= '<div class="exceptionactions">';

            $out .= '<div>';
            $out .= '<select name="selectiontype" id="selectiontype">';
            $out .= '<option value="'.SELECTIONTYPE_NONE.'"'.($selectiontype==SELECTIONTYPE_NONE ? ' selected="selected"' : '').'>'.get_string('select', 'local_program').'</option>';
            $out .= '<option value="'.SELECTIONTYPE_ALL.'"'.($selectiontype==SELECTIONTYPE_ALL ? ' selected="selected"' : '').'>'.get_string('alllearners', 'local_program').'</option>';
            $out .= '<option value="'.SELECTIONTYPE_TIME_ALLOWANCE.'"'.($selectiontype==SELECTIONTYPE_TIME_ALLOWANCE ? ' selected="selected"' : '').'>'.get_string('alltimeallowanceissues', 'local_program').'</option>';
            $out .= '<option value="'.SELECTIONTYPE_ALREADY_ASSIGNED.'"'.($selectiontype==SELECTIONTYPE_ALREADY_ASSIGNED ? ' selected="selected"' : '').'>'.get_string('allcurrentlyassignedissues', 'local_program').'</option>';
            $out .= '<option value="'.SELECTIONTYPE_EXTENSION_REQUEST.'"'.($selectiontype==SELECTIONTYPE_EXTENSION_REQUEST ? ' selected="selected"' : '').'>'.get_string('allextensionrequestissues', 'local_program').'</option>';
            $out .= '<option value="'.SELECTIONTYPE_COMPLETION_TIME_UNKNOWN.'"'.($selectiontype==SELECTIONTYPE_COMPLETION_TIME_UNKNOWN ? ' selected="selected"' : '').'>'.get_string('allcompletiontimeunknownissues', 'local_program').'</option>';
            $out .= '</select>';
            $out .= '</div>';

            $out .= '<div>';
            $out .= '<select name="selectionaction" id="selectionaction">';
            $out .= '<option value="'.SELECTIONACTION_NONE.'">'.get_string('action', 'local_program').'</option>';
            $out .= '<option value="'.SELECTIONACTION_AUTO_TIME_ALLOWANCE.'">'.get_string('setrealistictimeallowance', 'local_program').'</option>';
            $out .= '<option value="'.SELECTIONACTION_OVERRIDE_EXCEPTION.'">'.get_string('overrideandaddprogram', 'local_program').'</option>';
            $out .= '<option value="'.SELECTIONACTION_DISMISS_EXCEPTION.'">'.get_string('dismissandtakenoaction', 'local_program').'</option>';
            $out .= '<option value="'.SELECTIONACTION_GRANT_EXTENSION_REQUEST.'">'.get_string('grantextensionrequest', 'local_program').'</option>';
            $out .= '<option value="'.SELECTIONACTION_DENY_EXTENSION_REQUEST.'">'.get_string('denyextensionrequest', 'local_program').'</option>';
            $out .= '</select>';
            $out .= '</div>';

            $out .= '<div>';
            $out .= '<input id="applyactionbutton" type="submit" name="submit" value="Proceed with this action" />';
            $out .= '</div>';

            $out .= '<div>';
            $out .= '<p><span id="numselectedexceptions">'. $numselectedexceptions .'</span> '.get_string('learnersselected', 'local_program').'</p>';
            $out .= '</div>';

            $out .= '</div>';

            //$table = new flexible_table('exceptions');
            $table = new stdClass();
            $table->id = 'exceptions';

            $table->head = array(
                get_string('header:hash','local_program'),
                get_string('header:learners','local_program'),
                get_string('header:id','local_program'),
                get_string('header:issue','local_program'),
            );

            foreach($exceptions as $exception) {

                $row = array();

                if ($exception->userid != $exception->userid) {
                    $this->delete_exception($exception->id);
                    continue;
                }

                $user = new object();
                $user->id = $exception->userid;
                $user->firstname = $exception->firstname;
                $user->lastname = $exception->lastname;

                $selectedstr = isset($selectedexceptions[$exception->id]) ? ' checked="checked"' : '';

                $row[] = '<input type="checkbox" name="exceptionid" value="'.$exception->id.'"'.$selectedstr.' />';
                $row[] = '<a href="'.$CFG->wwwroot.'/user/view.php?id='.$user->id.'">'.fullname($user).'</a>';
                $row[] = '#'.$exception->id;
                $row[] = $this->exceptiontype_descriptors[$exception->exceptiontype] . '<span class="type" style="display:none;">'.$exception->exceptiontype.'</span>';


                $table->data[] = $row;
                $table->rowclass[] = 'exceptionrow';
            }

            $out .= print_table($table, true);

            $out .= '</form>';
        }

        if($return) {
            return $out;
        } else {
            echo $out;
        }
    }

    /**
     * Get a multidimensional array of the different exception types and the
     * actions that they handle. Can be returned as an array or as a JSON encoded
     * string
     *
     * @param str $returntype
     * @return array|string
     */
    public function get_handled_actions($returntype='array') {
        global $CFG;

        // Build a list of exceptions and their handled actions
        $handledActions = array();
        foreach ($this->exceptiontype_classnames as $exception_class) {
            $exception = new $exception_class($this->programid);
            $handledActions[$exception->exceptiontype] = array();
            foreach ($this->exception_actions as $action) {
                $handledActions[$exception->exceptiontype][$action] = $exception->handles($action);
            }
        }

        if ($returntype=='json') {
            require_once($CFG->dirroot.'/lib/pear/HTML/AJAX/JSON.php');
            return json_encode($handledActions);
        } else {
            return $handledActions;
        }
    }

    /**
     * Get an array specifying which of the defined actions can be handled by
     * the currently selectedexceptions. Can be returned as an array or as a
     * JSON encoded string
     *
     * @param str $returntype
     * @return array|string
     */
    public function get_handled_actions_for_selection($returntype='array', $selectedexceptions=null) {
        global $CFG;

        if ($selectedexceptions==null) {
            $selectedexceptions = $this->selectedexceptions;
        }

        if (empty($selectedexceptions)) {
            $handledActions = array(
                SELECTIONACTION_AUTO_TIME_ALLOWANCE     => false,
                SELECTIONACTION_OVERRIDE_EXCEPTION      => false,
                SELECTIONACTION_DISMISS_EXCEPTION       => false,
                SELECTIONACTION_GRANT_EXTENSION_REQUEST => false,
                SELECTIONACTION_DENY_EXTENSION_REQUEST  => false,
            );
        } else {
            // Build a list of exceptions and their handled actions
            $handledActions = array(
                SELECTIONACTION_AUTO_TIME_ALLOWANCE     => true,
                SELECTIONACTION_OVERRIDE_EXCEPTION      => true,
                SELECTIONACTION_DISMISS_EXCEPTION       => true,
                SELECTIONACTION_GRANT_EXTENSION_REQUEST => true,
                SELECTIONACTION_DENY_EXTENSION_REQUEST  => true,
            );

            foreach ($selectedexceptions as $selectedexception) {
                $classname = $this->exceptiontype_classnames[$selectedexception->exceptiontype];
                $exceptionob = new $classname($this->programid, $selectedexception);

                foreach ($handledActions as $action => $handles) {
                    if ( ! $exceptionob->handles($action)) {
                        $handledActions[$action] = false;
                    }
                }
            }
        }

        if ($returntype=='json') {
            require_once($CFG->dirroot.'/lib/pear/HTML/AJAX/JSON.php');
            return json_encode($handledActions);
        } else {
            return $handledActions;
        }
    }

}

class ProgramExceptionException extends Exception {

}

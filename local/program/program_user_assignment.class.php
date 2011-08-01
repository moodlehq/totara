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

global $USER_ASSIGNMENT_CLASSNAMES;

$USER_ASSIGNMENT_CLASSNAMES = array(
    ASSIGNTYPE_ORGANISATION => 'prog_organisation_assignment',
    ASSIGNTYPE_POSITION     => 'prog_position_assignment',
    ASSIGNTYPE_COHORT       => 'prog_cohort_assignment',
    ASSIGNTYPE_MANAGER      => 'prog_manager_assignment',
    ASSIGNTYPE_INDIVIDUAL   => 'prog_individual_assignment'
);

abstract class prog_user_assignment {

    protected $id, $programid, $userid, $assignmentid, $timeassigned;
    protected $assignment;

    public function __construct($id) {

        // get user assignment db record
        $userassignment = get_record('prog_user_assignment', 'id', $id);

        if(!$userassignment) {
            throw new UserAssignmentException('User assignment record not found');
        }

        // set details about this user assignment
        $this->id = $id;
        $this->programid = $userassignment->programid;
        $this->userid = $userassignment->userid;
        $this->assignmentid = $userassignment->assignmentid;
        $this->timeassigned = $userassignment->timeassigned;

        $this->assignment = get_record('prog_assignment', 'id', $userassignment->assignmentid);
	if (!$this->assignment) {
	    throw new UserAssignmentException('Assignment record not found');
	}
        // $this->completion = get_record('prog_completion', 'programid', $userassignment->programid, 'userid', $userassignment->userid, 'courseset', 0);

    }

    public static function factory($assignmenttype, $assignmentid) {
        global $USER_ASSIGNMENT_CLASSNAMES;

        if( ! array_key_exists($assignmenttype, $USER_ASSIGNMENT_CLASSNAMES)) {
            throw new UserAssignmentException('User assignment type not found');
        }

        if (class_exists($USER_ASSIGNMENT_CLASSNAMES[$assignmenttype])) {
            $classname = $USER_ASSIGNMENT_CLASSNAMES[$assignmenttype];
            return new $classname($assignmentid);
        } else {
            throw new UserAssignmentException('User assignment class not found');
        }
    }

    abstract public function display_criteria();

    /**
     * Display a date as text
     *
     * @param int $mydate
     * @return string
     */
    function display_date_as_text($mydate) {
        global $CFG;

        if(isset($mydate)) {
            if($CFG->ostype == 'WINDOWS') {
                return userdate($mydate, '%#d %b %Y', $CFG->timezone, false);
            } else {
                return userdate($mydate, '%e %h %Y', $CFG->timezone, false);
            }
        } else {
            return '';
        }
    }

    /**
     * Conveinence function to return a list of assignments for a particular
     * program and user
     * @param int $programid
     * @param int $userid
     * @return array of records or false
     */
    public static function get_user_assignments($programid, $userid) {
	return get_records_select('prog_user_assignment', "programid=$programid AND userid=$userid");
    }

}

class prog_organisation_assignment extends prog_user_assignment {

    public function display_criteria() {
        $organisation_name = get_field('org','fullname','id',$this->assignment->assignmenttypeid);
        $out = '';
        $out .= '<li class="assignmentcriteria">';
        $out .= '<span class="criteria">Member of organisation \''.$organisation_name.'\'.</span> ';
        $out .= '</li>';
        return $out;
    }

}

class prog_position_assignment extends prog_user_assignment {

    public function display_criteria() {
        $position_name = get_field('pos','fullname','id',$this->assignment->assignmenttypeid);
        $out = '';
        $out .= '<li class="assignmentcriteria">';
        $out .= '<span class="criteria">Hold position of \''.$position_name.'\'.</span> ';
        $out .= '</li>';
        return $out;
    }

}

class prog_cohort_assignment extends prog_user_assignment {

    public function display_criteria() {
        $cohort_name = get_field('cohort','name','id',$this->assignment->assignmenttypeid);
        $out = '';
        $out .= '<li class="assignmentcriteria">';
        $out .= '<span class="criteria">Member of cohort \''.$cohort_name.'\'.</span> ';
        $out .= '</li>';
        return $out;
    }

}

class prog_manager_assignment extends prog_user_assignment {

    public function display_criteria() {
        $managers_name = get_record_select('user', "id = $this->assignment->assignmenttypeid", sql_fullname() . ' as fullname');#
        $out = '';
        $out .= '<li class="assignmentcriteria">';
        $out .= '<span class="criteria">Part of \''.$managers_name.'\' team.</span> ';
        $out .= '</li>';
        return $out;
    }

}

class prog_individual_assignment extends prog_user_assignment {

    public function display_criteria() {
        $out = '';
        $out .= '<li class="assignmentcriteria">';
        $out .= '<span class="criteria">Assigned as an individual.</span> ';
        $out .= '</li>';
        return $out;
    }
}

class UserAssignmentException extends Exception { }

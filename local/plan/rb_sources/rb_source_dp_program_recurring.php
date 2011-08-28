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
 * @author Ben Lobo <ben@benlobo.co.uk>
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage plan
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

// needed for approval constants etc
require_once($CFG->dirroot . '/local/plan/lib.php');
// needed for instatiating and checking programs
require_once($CFG->dirroot . '/local/program/lib.php');

class rb_source_dp_program_recurring extends rb_base_source {
    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $requiredcolumns, $sourcetitle;

    function __construct() {

        global $CFG;
        $this->base = $CFG->prefix . 'prog';
        $this->joinlist = $this->define_joinlist();
        $this->columnoptions = $this->define_columnoptions();
        $this->filteroptions = $this->define_filteroptions();
        $this->contentoptions = $this->define_contentoptions();
        $this->paramoptions = $this->define_paramoptions();
        $this->defaultcolumns = $this->define_defaultcolumns();
        $this->defaultfilters = $this->define_defaultfilters();
        $this->requiredcolumns = $this->define_requiredcolumns();
        $this->sourcetitle = get_string('recordoflearningprogramsrecurring','local_plan');
        parent::__construct();
    }

    //
    //
    // Methods for defining contents of source
    //
    //

    function define_joinlist() {
        global $CFG;

        $joinlist = array(
            new rb_join(
                'program_completion_history', // table alias
                'INNER', // type of join
                $CFG->prefix . 'prog_completion_history',
                'base.id = program_completion_history.programid AND program_completion_history.coursesetid = 0', //how it is joined
                REPORT_BUILDER_RELATION_ONE_TO_MANY,
                array('base')
            ),
        );

        return $joinlist;
    }

    function define_columnoptions() {
        $columnoptions = array();

    $columnoptions[] = new rb_column_option(
            'program',
            'fullname',
            get_string('programname','local_program'),
            "base.fullname",
            array('joins' => 'base')
        );
    $columnoptions[] = new rb_column_option(
            'program',
            'shortname',
            get_string('programshortname','local_program'),
            "base.shortname",
            array('joins' => 'base')
        );
        $columnoptions[] = new rb_column_option(
            'program',
            'idnumber',
            get_string('programidnumber','local_program'),
            "base.idnumber",
            array('joins' => 'base')
        );
        $columnoptions[] = new rb_column_option(
            'program',
            'id',
            get_string('programid','local_program'),
            "base.id",
            array('joins' => 'base')
        );

    $columnoptions[] = new rb_column_option(
            'program_completion_history',
            'courselink',
            get_string('coursenamelink','local_program'),
            "program_completion_history.recurringcourseid",
            array(
                'joins' => 'program_completion_history',
                'displayfunc' => 'link_course_name',
            )
        );

        $columnoptions[] = new rb_column_option(
            'program_completion_history',
            'status',
            get_string('completionstatus','local_program'),
            "program_completion_history.status",
            array(
                'joins' => array('program_completion_history'),
                'displayfunc' => 'program_completion_status',
                'extrafields' => array(
                    'programid' => "base.id",
                    'userid' => "program_completion_history.userid"
                )
            )
        );

        $columnoptions[] = new rb_column_option(
            'program_completion_history',
            'timecompleted',
            get_string('completiondate','local_program'),
            "program_completion_history.timecompleted",
            array(
                'joins' => 'program_completion_history',
                'displayfunc' => 'completion_date',
            )
        );

        return $columnoptions;
    }

    function rb_display_program_completion_status($status,$row) {
        global $CFG;

        if ($status == STATUS_PROGRAM_COMPLETE){
            return get_string('complete', 'local_program');
        } else if ($status == STATUS_PROGRAM_INCOMPLETE) {
            return '<span class="error">' . get_string('incomplete', 'local_program') . '</span>';
        } else {
            return get_string('unknownstatus', 'local_program');
        }

    }

    function rb_display_completion_date($time) {
        if ($time==0) {
            return '';
        } else {
            return userdate($time, '%d/%m/%Y');
        }
    }

    function rb_display_link_course_name($courseid) {
        global $CFG;

        $html = '';

        if ($course = get_record('course', 'id', $courseid)) {
            $html = '<a href="'.$CFG->wwwroot.'/course/view.php?id='.$course->id.'">'.$course->fullname.'</a>';
        } else {
            $html = 'Course not found';
        }

        return $html;
    }

    function define_filteroptions() {
        $filteroptions = array();
        return $filteroptions;
    }

    function define_contentoptions() {
        $contentoptions = array();
        return $contentoptions;
    }

    function define_paramoptions() {
        $paramoptions = array(
            new rb_param_option(
                'programid',
                'base.id'
            ),
            new rb_param_option(
                'visible',
                'base.visible'
            ),
            new rb_param_option(
                'userid',
                'program_completion_history.userid',
                'program_completion_history'
            ),
        );

        $paramoptions[] = new rb_param_option(
                'programstatus',
                'program_completion_history.status',
                'program_completion_history'
        );

        return $paramoptions;
    }

    function define_defaultcolumns() {
        $defaultcolumns = array(
            array(
                'type' => 'program',
                'value' => 'courselink',
            ),
        );
        return $defaultcolumns;
    }

    function define_defaultfilters() {
        $defaultfilters = array();
        return $defaultfilters;
    }

    function define_requiredcolumns() {
        $requiredcolumns = array();
        return $requiredcolumns;
    }


    //
    //
    // Source specific column display methods
    //
    //


    //
    //
    // Source specific filter display methods
    //
    //



} // end of rb_source_dp_program_recurring class


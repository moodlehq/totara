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
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

// needed for approval constants etc
require_once($CFG->dirroot . '/local/plan/lib.php');
// needed for instatiating and checking programs
require_once($CFG->dirroot . '/local/program/lib.php');

class rb_source_dp_program extends rb_base_source {
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
        $this->sourcetitle = get_string('rolprogramsourcename', 'local_program');
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
                'program_completion', // table alias
                'INNER', // type of join
                $CFG->prefix . 'prog_completion',
                'base.id = program_completion.programid AND program_completion.coursesetid = 0', //how it is joined
                REPORT_BUILDER_RELATION_ONE_TO_MANY,
                array('base')
            ),
            new rb_join(
                'prog_user_assignment', // table alias
                'LEFT', // type of join
                $CFG->prefix . 'prog_user_assignment',
                'program_completion.programid = prog_user_assignment.programid AND program_completion.userid = prog_user_assignment.userid', //how it is joined
                REPORT_BUILDER_RELATION_ONE_TO_MANY,
                array('program_completion')
            ),
            new rb_join(
                'dp_plan', // table alias
                'LEFT', // type of join
                $CFG->prefix . 'dp_plan', // actual table name
                'dp_plan.id = prog_plan_assignment.planid', //how it is joined
                REPORT_BUILDER_RELATION_ONE_TO_MANY,
                array('prog_plan_assignment')
            ),
            new rb_join(
                'prog_plan_assignment', // table alias
                'LEFT', // type of join
                $CFG->prefix . 'dp_plan_program_assignment', // actual table name
                'base.id = prog_plan_assignment.programid = ', //how it is joined
                REPORT_BUILDER_RELATION_ONE_TO_MANY,
                array('base')
            )
        );

    $this->add_course_category_table_to_joinlist($joinlist, 'base', 'category');

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
            'program',
            'proglinkicon',
            get_string('prognamelinkedicon','local_program'),
            "base.fullname",
            array(
                'joins' => 'base',
                'displayfunc' => 'link_program_icon',
                'defaultheading' => 'Program Name',
                'extrafields' => array(
                    'program_id' => "base.id",
                    'program_icon' => "base.icon"
                )
            )
        );

        $columnoptions[] = new rb_column_option(
            'program',
            'timedue',
            get_string('programduedate','local_program'),
            "program_completion.timedue",
            array(
                'joins' => 'program_completion',
                'displayfunc' => 'timedue_date',
                'extrafields' => array(
                    'completionstatus' => "program_completion.status"
                )
            )
        );

        $columnoptions[] = new rb_column_option(
            'program',
            'mandatory',
            get_string('programmandatory','local_program'),
            "prog_user_assignment.id",
            array(
                'joins' => 'prog_user_assignment',
                'displayfunc' => 'mandatory_status',
            )
        );

        $columnoptions[] = new rb_column_option(
            'program_completion',
            'status',
            get_string('completionstatus', 'rb_source_dp_course'),
            "program_completion.status",
            array(
                'joins' => array('program_completion'),
                'displayfunc' => 'program_completion_progress',
                'defaultheading' => get_string('progress', 'rb_source_dp_course'),
                'extrafields' => array(
                    'programid' => "base.id",
                    'userid' => "program_completion.userid"
                )
            )
        );

        // include some standard columns
        $this->add_course_category_fields_to_columns($columnoptions, 'course_category', 'base');

        return $columnoptions;
    }

    function rb_display_program_completion_progress($status,$row) {
        global $CFG;
        $program = new program($row->programid);
        return $program->display_progress($row->userid);
    }

    function rb_display_timedue_date($time,$row) {

        $completionstatus = $row->completionstatus;

        if ($time==0) {
            return get_string('noduedate', 'local_plan');;
        }

        $out = userdate($time, '%d/%m/%Y');

        $days = '';
        if ($completionstatus != STATUS_PROGRAM_COMPLETE) {
            $days_remaining = floor(($time - time()) / 86400);
            if ($days_remaining == 1) {
                $days = get_string('onedayremaining', 'local_program');
            } else if ($days_remaining < 10 && $days_remaining > 0) {
                $days = get_string('daysremaining', 'local_program', $days_remaining);
            } else if ($time < time()) {
                $days = get_string('overdue', 'local_plan');
            }
        }

        if ($days != '') {
            $out .= '<br /><span class="error">' . $days . '</span>';
        }

        return $out;
    }

    function rb_display_mandatory_status($id) {
        global $CFG;
        if (!empty($id)) {
            return '<img src="' . $CFG->pixpath . '/i/tick_green_big.gif" />';
        }
        return get_string('no');
    }

    function rb_display_link_program_icon($programname, $row) {
        global $CFG;
        $programid = $row->program_id;
        $programicon = $row->program_icon;

        $program = new program($programid);

        $iconurl = "<img class=\"course_icon\" src=\"{$CFG->wwwroot}/local/icon/icon.php?icon=".urlencode($programicon)."&amp;id=$programid&amp;size=small&amp;type=program\" alt=\"$programname\" />";

        if ($program->is_accessible()) {
            $html = "<a href=\"{$CFG->wwwroot}/local/program/view.php?id={$programid}\">{$iconurl}{$programname}</a>";
        } else {
            $html = $iconurl.$programname;
        }

        return $html;
    }

    function define_filteroptions() {
        $filteroptions = array(
        new rb_filter_option(
        'program',
        'fullname',
        get_string('programname','local_program'),
        'text'
        )
        );

    $this->add_course_category_fields_to_filters($filteroptions, 'base', 'category');

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
                'category',
                'base.category'
            ),
            new rb_param_option(
                'userid',
                'program_completion.userid',
                'program_completion'
            ),
        );

        $paramoptions[] = new rb_param_option(
                'programstatus',
                'program_completion.status',
                'program_completion'
        );

        return $paramoptions;
    }

    function define_defaultcolumns() {
        $defaultcolumns = array(
            array(
                'type' => 'program',
                'value' => 'proglinkicon',
            ),
        array(
                'type' => 'course_category',
                'value' => 'namelink',
            ),
        );
        return $defaultcolumns;
    }

    function define_defaultfilters() {
        $defaultfilters = array(
            array(
                'type' => 'program',
                'value' => 'fullname',
                'advanced' => 0,
            ),
        array(
                'type' => 'course_category',
                'value' => 'id',
                'advanced' => 0,
            ),
        );
        return $defaultfilters;
    }

    function define_requiredcolumns() {
        $requiredcolumns = array();
        return $requiredcolumns;
    }
} // end of rb_source_courses class

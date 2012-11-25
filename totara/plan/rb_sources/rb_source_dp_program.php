<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2012 Totara Learning Solutions LTD
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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage reportbuilder
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

// needed for approval constants etc
require_once($CFG->dirroot . '/totara/plan/lib.php');
// needed for instatiating and checking programs
require_once($CFG->dirroot . '/totara/program/lib.php');

class rb_source_dp_program extends rb_base_source {
    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $requiredcolumns, $sourcetitle;

    function __construct() {
        $this->base = '{prog}';
        $this->joinlist = $this->define_joinlist();
        $this->columnoptions = $this->define_columnoptions();
        $this->filteroptions = $this->define_filteroptions();
        $this->contentoptions = $this->define_contentoptions();
        $this->paramoptions = $this->define_paramoptions();
        $this->defaultcolumns = $this->define_defaultcolumns();
        $this->defaultfilters = $this->define_defaultfilters();
        $this->requiredcolumns = $this->define_requiredcolumns();
        $this->sourcetitle = get_string('rolprogramsourcename', 'totara_program');
        parent::__construct();
    }

    //
    //
    // Methods for defining contents of source
    //
    //

    protected function define_joinlist() {

        $joinlist = array(
            new rb_join(
                'program_completion', // table alias
                'INNER', // type of join
                '{prog_completion}',
                'base.id = program_completion.programid AND program_completion.coursesetid = 0', //how it is joined
                REPORT_BUILDER_RELATION_ONE_TO_MANY,
                array('base')
            ),
            new rb_join(
                'prog_user_assignment', // table alias
                'LEFT', // type of join
                '{prog_user_assignment}',
                'program_completion.programid = prog_user_assignment.programid AND program_completion.userid = prog_user_assignment.userid', //how it is joined
                REPORT_BUILDER_RELATION_ONE_TO_MANY,
                array('program_completion')
            ),
            new rb_join(
                'dp_plan', // table alias
                'LEFT', // type of join
                '{dp_plan}', // actual table name
                'dp_plan.id = prog_plan_assignment.planid', //how it is joined
                REPORT_BUILDER_RELATION_ONE_TO_MANY,
                array('prog_plan_assignment')
            ),
            new rb_join(
                'prog_plan_assignment', // table alias
                'LEFT', // type of join
                '{dp_plan_program_assignment}', // actual table name
                'base.id = prog_plan_assignment.programid = ', //how it is joined
                REPORT_BUILDER_RELATION_ONE_TO_MANY,
                array('base')
            )
        );

        $this->add_course_category_table_to_joinlist($joinlist, 'base', 'category');
        $this->add_cohort_program_tables_to_joinlist($joinlist, 'base', 'id');

        return $joinlist;
    }

    protected function define_columnoptions() {
        $columnoptions = array();

        $columnoptions[] = new rb_column_option(
            'program',
            'fullname',
            get_string('programname', 'totara_program'),
            "base.fullname",
            array('joins' => 'base')
        );
        $columnoptions[] = new rb_column_option(
            'program',
            'shortname',
            get_string('programshortname', 'totara_program'),
            "base.shortname",
            array('joins' => 'base')
        );
        $columnoptions[] = new rb_column_option(
            'program',
            'idnumber',
           get_string('programidnumber', 'totara_program'),
            "base.idnumber",
            array('joins' => 'base')
        );
        $columnoptions[] = new rb_column_option(
            'program',
            'id',
            get_string('programid', 'totara_program'),
            "base.id",
            array('joins' => 'base')
        );
        $columnoptions[] = new rb_column_option(
            'program',
            'proglinkicon',
            get_string('prognamelinkedicon', 'totara_program'),
            "base.fullname",
            array(
                'joins' => 'base',
                'displayfunc' => 'link_program_icon',
                'defaultheading' => get_string('programname', 'totara_program'),
                'extrafields' => array(
                    'program_id' => "base.id",
                    'program_icon' => "base.icon"
                )
            )
        );

        $columnoptions[] = new rb_column_option(
            'program',
            'timedue',
            get_string('programduedate', 'totara_program'),
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
            get_string('programmandatory', 'totara_program'),
            "prog_user_assignment.id",
            array(
                'joins' => 'prog_user_assignment',
                'displayfunc' => 'mandatory_status',
            )
        );

        $columnoptions[] = new rb_column_option(
            'program',
            'recurring',
            get_string('programrecurring', 'totara_program'),
            "base.id",
            array(
                'joins' => 'program_completion',
                'displayfunc' => 'recurring_status',
                'extrafields' => array(
                    'userid' => "program_completion.userid"
                )
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
        $this->add_cohort_program_fields_to_columns($columnoptions);

        return $columnoptions;
    }

    function rb_display_program_completion_progress($status,$row) {
        $program = new program($row->programid);
        return $program->display_progress($row->userid);
    }

    function rb_display_timedue_date($time,$row) {
        global $OUTPUT;

        $completionstatus = $row->completionstatus;

        if ($time == 0 || $time == COMPLETION_TIME_NOT_SET) {
            return get_string('noduedate', 'totara_plan');;
        }

        $out = userdate($time, get_string('strftimedatefullshort', 'langconfig'));

        $days = '';
        if ($completionstatus != STATUS_PROGRAM_COMPLETE) {
            $days_remaining = floor(($time - time()) / 86400);
            if ($days_remaining == 1) {
                $days = get_string('onedayremaining', 'totara_program');
            } else if ($days_remaining < 10 && $days_remaining > 0) {
                $days = get_string('daysremaining', 'totara_program', $days_remaining);
            } else if ($time < time()) {
                $days = get_string('overdue', 'totara_plan');
            }
        }
        if ($days != '') {
            $out .= html_writer::empty_tag('br') . $OUTPUT->error_text($days);
        }

        return $out;
    }

    function rb_display_mandatory_status($id) {
        global $OUTPUT;
        if (!empty($id)) {
            return $OUTPUT->pix_icon('/i/tick_green_big', get_string('yes'));
        }
        return get_string('no');
    }

    function rb_display_recurring_status($programid, $row) {
        global $OUTPUT;

        $userid = $row->userid;

        $program = new program($programid);
        $program_content = $program->get_content();
        $coursesets = $program_content->get_course_sets();
        if (isset($coursesets[0])) {
            $courseset = $coursesets[0];
            if ($courseset->is_recurring()) {
                $recurringcourse = $courseset->course;
                $link = get_string('yes');
                $link .= $OUTPUT->action_link(new moodle_url('/totara/plan/record/programs_recurring.php', array('programid' => $program->id, 'userid' => $userid)), get_string('viewrecurringprogramhistory', 'totara_program'));
                return $link;
            }
        }
        return get_string('no');
    }

    function rb_display_link_program_icon($programname, $row) {
        global $OUTPUT;
        $programid = $row->program_id;
        $programicon = !empty($row->program_icon) ? $row->program_icon : 'default';

        $program = new program($programid);
        $icon = $OUTPUT->pix_icon('programicons/' . $programicon, $programname, 'totara_core', array('class' => 'course_icon'));

        if ($program->is_accessible()) {
            $html = $OUTPUT->action_link(
                new moodle_url('/totara/program/view.php', array('id' => $programid)),
                $icon . $programname
            );
        } else {
            $html = $icon . $programname;
        }

        return $html;
    }

    protected function define_filteroptions() {
        $filteroptions = array(
            new rb_filter_option(
                'program',
                'fullname',
                get_string('programname', 'totara_program'),
                'text'
            )
        );

        $this->add_course_category_fields_to_filters($filteroptions, 'base', 'category');
        $this->add_cohort_program_fields_to_filters($filteroptions);

        return $filteroptions;
    }

    protected function define_contentoptions() {
        $contentoptions = array();
        return $contentoptions;
    }

    protected function define_paramoptions() {
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

        $paramoptions[] = new rb_param_option(
            'exceptionstatus',
            'CASE WHEN prog_user_assignment.exceptionstatus IN (' . PROGRAM_EXCEPTION_NONE . ',' . PROGRAM_EXCEPTION_RESOLVED .')
                THEN 0 ELSE 1 END',
            'prog_user_assignment',
            'int'
        );

        return $paramoptions;
    }

    protected function define_defaultcolumns() {
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

    protected function define_defaultfilters() {
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

    protected function define_requiredcolumns() {
        $requiredcolumns = array();
        return $requiredcolumns;
    }
} // end of rb_source_courses class

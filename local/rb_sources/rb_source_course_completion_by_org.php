<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 * Copyright (C) 1999 onwards Martin Dougiamas 
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

class rb_source_course_completion_by_org extends rb_base_source {
    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $requiredcolumns, $sourcetitle;

    function __construct() {
        global $CFG;
        $this->base = $CFG->prefix . 'course_completions';
        $this->joinlist = $this->define_joinlist();
        $this->columnoptions = $this->define_columnoptions();
        $this->filteroptions = $this->define_filteroptions();
        $this->contentoptions = $this->define_contentoptions();
        $this->paramoptions = $this->define_paramoptions();
        $this->defaultcolumns = $this->define_defaultcolumns();
        $this->defaultfilters = $this->define_defaultfilters();
        $this->requiredcolumns = $this->define_requiredcolumns();
        $this->sourcetitle = get_string('sourcetitle', 'rb_source_course_completion_by_org');
        parent::__construct();
    }

    //
    //
    // Methods for defining contents of source
    //
    //

    function define_joinlist() {
        global $CFG;

        // joinlist for this source
        $joinlist = array(
            new rb_join(
                'completion_organisation',
                'LEFT',
                $CFG->prefix . 'org',
                'completion_organisation.id = base.organisationid',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
            new rb_join(
                'completion_position',
                'LEFT',
                $CFG->prefix . 'pos',
                'completion_position.id = base.positionid',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
            new rb_join(
                'criteria',
                'LEFT',
                $CFG->prefix . 'course_completion_criteria',
                '(criteria.course = base.course AND ' .
                    'criteria.criteriatype = ' .
                    COMPLETION_CRITERIA_TYPE_GRADE . ')',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
            new rb_join(
                'critcompl',
                'LEFT',
                $CFG->prefix . 'course_completion_crit_compl',
                '(critcompl.userid = base.userid AND ' .
                    'critcompl.criteriaid = criteria.id AND ' .
                    '(critcompl.deleted IS NULL OR critcompl.deleted = 0))',
                REPORT_BUILDER_RELATION_ONE_TO_ONE,
                'criteria'
            ),
        );

        // include some standard joins
        $this->add_user_table_to_joinlist($joinlist, 'base', 'userid');
        $this->add_user_custom_fields_to_joinlist($joinlist, 'base', 'userid');
        $this->add_course_table_to_joinlist($joinlist, 'base', 'course');
        // requires the course join
        $this->add_course_category_table_to_joinlist($joinlist,
            'course', 'category');
        $this->add_position_tables_to_joinlist($joinlist, 'base', 'userid');
        // requires the position_assignment join
        $this->add_manager_tables_to_joinlist($joinlist,
            'position_assignment', 'reportstoid');
        $this->add_course_tags_tables_to_joinlist($joinlist, 'base', 'course');

        return $joinlist;
    }

    function define_columnoptions() {
        $columnoptions = array(
            // none-aggregated columns
            new rb_column_option(
                'course_completion',
                'organisationid',
                get_string('completionorgid', 'rb_source_course_completion_by_org'),
                'base.organisationid'
            ),
            new rb_column_option(
                'course_completion',
                'organisationpath',
                get_string('completionorgpath', 'rb_source_course_completion_by_org'),
                'completion_organisation.path',
                array('joins' => 'completion_organisation')
            ),
            new rb_column_option(
                'course_completion',
                'organisation',
                get_string('completionorgname', 'rb_source_course_completion_by_org'),
                'completion_organisation.fullname',
                array('joins' => 'completion_organisation')
            ),
            // aggregated columns
            new rb_column_option(
                'user',
                'fullname',
                get_string('participants', 'rb_source_course_completion_by_org'),
                sql_fullname('auser.firstname','auser.lastname'),
                array(
                    'joins' => 'auser',
                    'grouping' => 'comma_list_unique'
                )
            ),
            new rb_column_option(
                'course_completion',
                'total',
                get_string('numofrecords', 'rb_source_course_completion_by_org'),
                'base.id',
                array('grouping' => 'count')
            ),
            new rb_column_option(
                'course_completion',
                'completed',
                get_string('numcompleted', 'rb_source_course_completion_by_org'),
                'CASE WHEN base.timecompleted > 0 AND ' .
                    '(base.rpl IS NULL OR ' .
                    sql_isempty('base', 'rpl', false, false) .
                    ') THEN 1 ELSE NULL END',
                array('grouping' => 'count')
            ),
            new rb_column_option(
                'course_completion',
                'perccompleted',
                get_string('percentagecompleted', 'rb_source_course_completion_by_org'),
                'CASE WHEN base.timecompleted > 0 AND ' .
                    '(base.rpl IS NULL OR ' .
                    sql_isempty('base', 'rpl', false, false) .
                    ') THEN 1 ELSE 0 END',
                array('grouping' => 'percent')
            ),
            new rb_column_option(
                'course_completion',
                'completedrpl',
                get_string('numcompletedviarpl', 'rb_source_course_completion_by_org'),
                'CASE WHEN base.timecompleted > 0 AND ' .
                    '(base.rpl IS NOT NULL AND ' .
                    sql_isnotempty('base', 'rpl', false, false) .
                    ') THEN 1 ELSE NULL END',
                array('grouping' => 'count')
            ),
            new rb_column_option(
                'course_completion',
                'inprogress',
                get_string('numinprogress', 'rb_source_course_completion_by_org'),
                'CASE WHEN base.timestarted > 0 AND ' .
                    '(base.timecompleted IS NULL OR ' .
                    'base.timecompleted = 0) ' .
                    'THEN 1 ELSE NULL END',
                array('grouping' => 'count')
            ),
            new rb_column_option(
                'course_completion',
                'notstarted',
                get_string('numnotstarted', 'rb_source_course_completion_by_org'),
                'CASE WHEN base.timeenrolled > 0 AND ' .
                    '(base.timecompleted IS NULL OR ' .
                    'base.timecompleted = 0) AND ' .
                    '(base.timestarted IS NULL OR ' .
                    'base.timestarted = 0) ' .
                    'THEN 1 ELSE NULL END',
                array('grouping' => 'count')
            ),
            new rb_column_option(
                'course_completion',
                'earliest_completeddate',
                get_string('earliestcompletiondate', 'rb_source_course_completion_by_org'),
                'base.timecompleted',
                array(
                    'displayfunc' => 'nice_date',
                    'grouping' => 'min',
                )
            ),
            new rb_column_option(
                'course_completion',
                'latest_completeddate',
                get_string('latestcompletiondate', 'rb_source_course_completion_by_org'),
                'base.timecompleted',
                array(
                    'displayfunc' => 'nice_date',
                    'grouping' => 'max',
                )
            ),
        );

        return $columnoptions;
    }

    function define_filteroptions() {
        $filteroptions = array(
            /*
            // array of rb_filter_option objects, e.g:
            new rb_filter_option(
                '',       // type
                '',       // value
                '',       // label
                '',       // filtertype
                array()   // options
            )
            */
            new rb_filter_option(
                'course_completion',
                'organisationid',
                get_string('officewhencompletedbasic', 'rb_source_course_completion_by_org'),
                'select',
                array(
                    'selectfunc' => 'organisations_list',
                    'selectoptions' => rb_filter_option::select_width_limiter(),
                )
            ),
            new rb_filter_option(
                'course_completion',
                'organisationpath',
                get_string('officewhencompleted', 'rb_source_course_completion_by_org'),
                'org'
            ),
            // aggregated filters
            new rb_filter_option(
                'course_completion',
                'total',
                get_string('totalcompletions', 'rb_source_course_completion_by_org'),
                'number'
            ),
            new rb_filter_option(
                'course_completion',
                'completed',
                get_string('numcompleted', 'rb_source_course_completion_by_org'),
                'number'
            ),
            new rb_filter_option(
                'course_completion',
                'completedrpl',
                get_string('numcompletedviarpl', 'rb_source_course_completion_by_org'),
                'number'
            ),
            new rb_filter_option(
                'course_completion',
                'inprogress',
                get_string('numinprogress', 'rb_source_course_completion_by_org'),
                'number'
            ),
            new rb_filter_option(
                'course_completion',
                'notstarted',
                get_string('numnotstarted', 'rb_source_course_completion_by_org'),
                'number'
            ),
            new rb_filter_option(
                'user',
                'fullname',
                get_string('participants', 'rb_source_course_completion_by_org'),
                'text'
            ),
        );

        return $filteroptions;
    }

    function define_contentoptions() {
        $contentoptions = array(
            new rb_content_option(
                'current_org',                      // class name
                get_string('currentorg', 'rb_source_course_completion_by_org'),  // title
                'base.userid',                      // field
                null                                // joins
            ),
            new rb_content_option(
                'completed_org',
                get_string('orgwhencompleted', 'rb_source_course_completion_by_org'),
                'base.organisationid'
            ),
            new rb_content_option(
                'user',
                get_string('user', 'rb_source_course_completion_by_org'),
                'base.userid'
            ),
            new rb_content_option(
                'date',
                get_string('completiondate', 'rb_source_course_completion_by_org'),
                'base.timemodified'
            ),
        );
        return $contentoptions;
    }

    function define_paramoptions() {
        $paramoptions = array(
            new rb_param_option(
                'userid',       // parameter name
                'base.userid',  // field
                null            // joins
            ),
            new rb_param_option(
                'courseid',
                'course.id',
                'course'
            ),
        );

        return $paramoptions;
    }

    function define_defaultcolumns() {
        $defaultcolumns = array(
            array(
                'type' => 'course_completion',
                'value' => 'organisation',
            ),
            array(
                'type' => 'course_completion',
                'value' => 'completed',
            ),
            array(
                'type' => 'course_completion',
                'value' => 'total',
            ),
            array(
                'type' => 'course_completion',
                'value' => 'earliest_completeddate',
            ),
            array(
                'type' => 'course_completion',
                'value' => 'latest_completeddate',
            ),
        );
        return $defaultcolumns;
    }

    function define_defaultfilters() {
        $defaultfilters = array(
            array(
                'type' => 'course_completion',
                'value' => 'organisationpath',
                'advanced' => 1,
            ),
            /*
            array(
                'type' => 'course_completion',
                'value' => 'completeddate',
                'advanced' => 1,
            ),
            array(
                'type' => 'course_completion',
                'value' => 'status',
                'advanced' => 1,
            ),*/
        );

        return $defaultfilters;
    }

    function define_requiredcolumns() {
        $requiredcolumns = array(
            /*
            // array of rb_column objects, e.g:
            new rb_column(
                '',         // type
                '',         // value
                '',         // heading
                '',         // field
                array(),    // options
            )
            */
        );
        return $requiredcolumns;
    }

    //
    //
    // Source specific column display methods
    //
    //

    // add methods here with [name] matching column option displayfunc
    //function rb_display_[name]($item, $row) {
        // variable $item refers to the current item
        // $row is an object containing the whole row
        // which will include any extrafields
        //
        // should return a string containing what should be displayed
    //}

    //
    //
    // Source specific filter display methods
    //
    //

    function rb_filter_completion_status_list() {
        // TODO obtain this scale from single source - db?
        $proficiencyselect = array();
        $proficiencyselect['Completed'] = 'Completed';
        $proficiencyselect['Not Completed'] = 'Not Completed';

        return $proficiencyselect;
    }

} // end of rb_source_course_completion class


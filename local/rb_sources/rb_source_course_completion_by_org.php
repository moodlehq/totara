<?php

class rb_source_course_completion_by_org extends rb_base_source {
    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $requiredcolumns;

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
            'course' => "LEFT JOIN {$CFG->prefix}course c ON base.course = c.id",
            'course_category' => "LEFT JOIN {$CFG->prefix}course_categories cat ON cat.id = c.category",
            'user' => "LEFT JOIN {$CFG->prefix}user u ON base.userid = u.id",
            'position_assignment' => "LEFT JOIN {$CFG->prefix}pos_assignment pa ON base.userid = pa.userid",
            'organisation' => "LEFT JOIN {$CFG->prefix}org organisation ON organisation.id = pa.organisationid",
            'position' => "LEFT JOIN {$CFG->prefix}pos position ON position.id = pa.positionid",
            'completion_organisation' => "LEFT JOIN {$CFG->prefix}org completion_organisation ON base.organisationid = completion_organisation.id",
            'completion_position' => "LEFT JOIN {$CFG->prefix}pos completion_position ON base.positionid = completion_position.id",
        );

        // only include these joins if the manager role is defined
        if($managerroleid = get_field('role','id','shortname','manager')) {
            $joinlist['manager_role_assignment'] =
                "LEFT JOIN {$CFG->prefix}role_assignments mra
                    ON ( pa.reportstoid = mra.id
                    AND mra.roleid = $managerroleid)";
            $joinlist['manager'] =
                "LEFT JOIN {$CFG->prefix}user manager ON manager.id = mra.userid";
        }

        // include some standard joins
        $this->add_user_custom_fields_to_joinlist($joinlist);

        return $joinlist;
    }

    function define_columnoptions() {
        $columnoptions = array(
            // none-aggregated columns
            new rb_column_option(
                'course_completion',
                'organisationid',
                'Completion Organisation ID',
                'base.organisationid'
            ),
            new rb_column_option(
                'course_completion',
                'organisation',
                'Completion Organisation Name',
                'completion_organisation.fullname',
                array('joins' => 'completion_organisation')
            ),
            // aggregated columns
            new rb_column_option(
                'user',
                'fullname',
                'Participants',
                sql_fullname('u.firstname','u.lastname'),
                array(
                    'joins' => 'user',
                    'grouping' => 'comma_list_unique'
                )
            ),
            new rb_column_option(
                'course_completion',
                'total',
                'Number of Records',
                'base.id',
                array('grouping' => 'count')
            ),
            new rb_column_option(
                'course_completion',
                'completed',
                'Number Completed',
                'CASE WHEN base.timecompleted > 0 AND ' .
                    '(base.rpl IS NULL OR ' .
                    sql_isempty('base', 'rpl', false, false) .
                    ') THEN 1 ELSE NULL END',
                array('grouping' => 'count')
            ),
            new rb_column_option(
                'course_completion',
                'perccompleted',
                'Percentage Completed',
                'CASE WHEN base.timecompleted > 0 AND ' .
                    '(base.rpl IS NULL OR ' .
                    sql_isempty('base', 'rpl', false, false) .
                    ') THEN 1 ELSE 0 END',
                array('grouping' => 'percent')
            ),
            new rb_column_option(
                'course_completion',
                'completedrpl',
                'Number Completed via RPL',
                'CASE WHEN base.timecompleted > 0 AND ' .
                    '(base.rpl IS NOT NULL AND ' .
                    sql_isnotempty('base', 'rpl', false, false) .
                    ') THEN 1 ELSE NULL END',
                array('grouping' => 'count')
            ),
            new rb_column_option(
                'course_completion',
                'inprogress',
                'Number In Progress',
                'CASE WHEN base.timestarted > 0 AND ' .
                    '(base.timecompleted IS NULL OR ' .
                    'base.timecompleted = 0) ' .
                    'THEN 1 ELSE NULL END',
                array('grouping' => 'count')
            ),
            new rb_column_option(
                'course_completion',
                'notstarted',
                'Number Not Yet Started',
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
                'Earliest Completion Date',
                'base.timecompleted',
                array(
                    'displayfunc' => 'nice_date',
                    'grouping' => 'min',
                )
            ),
            new rb_column_option(
                'course_completion',
                'latest_completeddate',
                'Latest Completion Date',
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
                'Office when completed',
                'select',
                array(
                    'selectfunc' => 'organisations_list',
                    'selectoptions' => rb_filter_option::select_width_limiter(),
                )
            ),
            // aggregated filters
            new rb_filter_option(
                'course_completion',
                'total',
                'Total Completions',
                'number'
            ),
            new rb_filter_option(
                'course_completion',
                'completed',
                'Number Completed',
                'number'
            ),
            new rb_filter_option(
                'course_completion',
                'completedrpl',
                'Number Completed via RPL',
                'number'
            ),
            new rb_filter_option(
                'course_completion',
                'inprogress',
                'Number In Progress',
                'number'
            ),
            new rb_filter_option(
                'course_completion',
                'notstarted',
                'Number Not Started',
                'number'
            ),
            new rb_filter_option(
                'user',
                'fullname',
                'Participant',
                'text'
            ),
        );

        return $filteroptions;
    }

    function define_contentoptions() {
        $contentoptions = array(
            new rb_content_option(
                'current_org',                      // class name
                "The user's current organisation",  // title
                'base.userid',                      // field
                null                                // joins
            ),
            new rb_content_option(
                'completed_org',
                "The organisation when completed",
                'base.organisationid'
            ),
            new rb_content_option(
                'user',
                'The user',
                'base.userid'
            ),
            new rb_content_option(
                'date',
                "The completion date",
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
                'c.id',
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
                'value' => 'organisationid',
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


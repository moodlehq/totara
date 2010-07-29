<?php

class rb_source_course_completion extends rb_base_source {
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
            new rb_column_option(
                'course_completion',
                'status',
                'Completion Status',
                "CASE WHEN base.timecompleted IS NOT NULL THEN 'Completed' " .
                    "ELSE 'Not Completed' END"
            ),
            new rb_column_option(
                'course_completion',
                'completeddate',
                'Completion Date',
                'base.timecompleted',
                array('displayfunc' => 'nice_date')
            ),
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
            new rb_column_option(
                'course_completion',
                'positionid',
                'Completion Position ID',
                'base.positionid'
            ),
            new rb_column_option(
                'course_completion',
                'position',
                'Completion Position Name',
                'completion_position.fullname',
                array('joins' => 'completion_position')
            ),
        );

        // include some standard columns
        $this->add_user_fields_to_columns($columnoptions);
        $this->add_user_custom_fields_to_columns($columnoptions);
        $this->add_position_info_to_columns($columnoptions);
        $this->add_course_info_to_columns($columnoptions);
        $this->add_course_category_info_to_columns($columnoptions);

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
                'completeddate',
                'Completed Date',
                'date'
            ),
            new rb_filter_option(
                'course_completion',
                'status',
                'Completion Status',
                'select',
                array(
                    'selectfunc' => 'completion_status_list',
                    'selectoptions' => rb_filter_option::select_width_limiter(),
                )
            ),
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
            new rb_filter_option(
                'course_completion',
                'positionid',
                'Position when completed',
                'select',
                array(
                    'selectfunc' => 'positions_list',
                    'selectoptions' => rb_filter_option::select_width_limiter()
                )
            ),
        );

        // include some standard filters
        $this->add_user_fields_to_filters($filteroptions);
        $this->add_user_custom_fields_to_filters($filteroptions);
        $this->add_position_fields_to_filters($filteroptions);
        $this->add_course_fields_to_filters($filteroptions);
        $this->add_course_category_fields_to_filters($filteroptions);

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
                'current_pos',                      // class name
                "The user's current position",      // title
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
                'base.timecompleted'
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
                'type' => 'user',
                'value' => 'namelink',
            ),
            array(
                'type' => 'course',
                'value' => 'courselink',
            ),
            array(
                'type' => 'user',
                'value' => 'organisation',
            ),
            array(
                'type' => 'course_completion',
                'value' => 'organisation',
            ),
            array(
                'type' => 'user',
                'value' => 'position',
            ),
            array(
                'type' => 'course_completion',
                'value' => 'position',
            ),
            array(
                'type' => 'course_completion',
                'value' => 'status',
            ),
            array(
                'type' => 'course_completion',
                'value' => 'completeddate',
            ),
        );
        return $defaultcolumns;
    }

    function define_defaultfilters() {
        $defaultfilters = array(
            array(
                'type' => 'user',
                'value' => 'fullname',
            ),
            array(
                'type' => 'user',
                'value' => 'organisationid',
                'advanced' => 1,
            ),
            array(
                'type' => 'course_completion',
                'value' => 'organisationid',
                'advanced' => 1,
            ),
            array(
                'type' => 'user',
                'value' => 'positionid',
                'advanced' => 1,
            ),
            array(
                'type' => 'course_completion',
                'value' => 'positionid',
                'advanced' => 1,
            ),
            array(
                'type' => 'course',
                'value' => 'fullname',
                'advanced' => 1,
            ),
            array(
                'type' => 'course_category',
                'value' => 'id',
                'advanced' => 1,
            ),
            array(
                'type' => 'course_completion',
                'value' => 'completeddate',
                'advanced' => 1,
            ),
            array(
                'type' => 'course_completion',
                'value' => 'status',
                'advanced' => 1,
            ),
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
                array()     // options
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


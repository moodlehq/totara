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

        // to get access to constants
        require_once($CFG->libdir . '/completion/completion_criteria.php');

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
                'starteddate',
                'Date Started',
                'base.timestarted',
                array('displayfunc' => 'nice_date')
            ),
            new rb_column_option(
                'course_completion',
                'enrolleddate',
                'Date Enrolled',
                'base.timeenrolled',
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
            new rb_column_option(
                'course_completion',
                'grade',
                'Grade',
                'critcompl.gradefinal',
                array(
                    'joins' => array('criteria', 'critcompl'),
                    'displayfunc' => 'percent',
                )
            ),
            new rb_column_option(
                'course_completion',
                'passgrade',
                'Pass Grade',
                'criteria.gradepass',
                array(
                    'joins' => 'criteria',
                    'displayfunc'=>'percent',
                )
            ),
            new rb_column_option(
                'course_completion',
                'gradestring',
                'Grade and required grade',
                'critcompl.gradefinal',
                array(
                    'joins' => array('criteria', 'critcompl'),
                    'displayfunc' => 'grade_string',
                    'extrafields' => array('gradepass' => 'criteria.gradepass'),
                    'defaultheading' => 'Grade',
                )
            ),
        );

        // include some standard columns
        $this->add_user_fields_to_columns($columnoptions);
        $this->add_user_custom_fields_to_columns($columnoptions);
        $this->add_course_fields_to_columns($columnoptions);
        $this->add_course_category_fields_to_columns($columnoptions);
        $this->add_position_fields_to_columns($columnoptions);
        $this->add_manager_fields_to_columns($columnoptions);
        $this->add_course_tag_fields_to_columns($columnoptions);

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
                'Date Completed',
                'date'
            ),
            new rb_filter_option(
                'course_completion',
                'completeddate',
                'Date Started',
                'date'
            ),
            new rb_filter_option(
                'course_completion',
                'completeddate',
                'Date Enrolled',
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
            new rb_filter_option(
                'course_completion',
                'grade',
                'Grade',
                'number'
            ),
            new rb_filter_option(
                'course_completion',
                'passgrade',
                'Required Grade',
                'number'
            ),
        );

        // include some standard filters
        $this->add_user_fields_to_filters($filteroptions);
        $this->add_user_custom_fields_to_filters($filteroptions);
        $this->add_course_fields_to_filters($filteroptions);
        $this->add_course_category_fields_to_filters($filteroptions);
        $this->add_position_fields_to_filters($filteroptions);
        $this->add_manager_fields_to_filters($filteroptions);
        $this->add_course_tag_fields_to_filters($filteroptions);

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
                'base.course'
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

    // display grade along with passing grade if it is known
    function rb_display_grade_string($item, $row) {
        $passgrade = isset($row->gradepass) ? $row->gradepass : null;

        if($item === null) {
            return '';
        } else if ($passgrade === null) {
            return sprintf('%d%%', $item);
        } else {
            return sprintf('%d%% (%d%% to complete)', $item, $passgrade);
        }
    }

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


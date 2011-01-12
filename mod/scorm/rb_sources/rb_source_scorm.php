<?php

class rb_source_scorm extends rb_base_source {
    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $requiredcolumns;

    function __construct() {
        global $CFG;
        // scorm base table is a sub-query
        $this->base = '(SELECT max(id) as id, userid, scormid, scoid, attempt ' .
            "from {$CFG->prefix}scorm_scoes_track " .
            'GROUP BY userid, scormid, scoid, attempt)';
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

        $joinlist = array(
            new rb_join(
                'scorm',
                'LEFT',
                $CFG->prefix . 'scorm',
                'scorm.id = base.scormid',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
            new rb_join(
                'sco',
                'LEFT',
                $CFG->prefix . 'scorm_scoes',
                'sco.id = base.scoid',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
        );

        // because of SCORMs crazy db design we have to self-join the table every
        // time we want a field - horribly inefficient, but should be okay until
        // scorm gets redesigned
        $elements = array(
            'starttime' => 'x.start.time',
            'totaltime' => 'cmi.core.total_time',
            'status' => 'cmi.core.lesson_status',
            'scoreraw' => 'cmi.core.score.raw',
            'scoremin' => 'cmi.core.score.min',
            'scoremax' => 'cmi.core.score.max',
        );
        foreach ($elements as $name => $element) {
            $key = "sco_$name";
            $joinlist[] = new rb_join(
                $key,
                'LEFT',
                $CFG->prefix . 'scorm_scoes_track',
                "($key.userid = base.userid AND $key.scormid = base.scormid" .
                " AND $key.scoid = base.scoid AND $key.attempt = " .
                " base.attempt AND $key.element = '$element')",
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            );
        }

        // include some standard joins
        $this->add_user_table_to_joinlist($joinlist, 'base', 'userid');
        $this->add_user_custom_fields_to_joinlist($joinlist, 'base', 'userid');
        $this->add_course_table_to_joinlist($joinlist, 'scorm', 'course');
        // requires the course join
        $this->add_course_category_table_to_joinlist($joinlist,
            'course', 'category');
        $this->add_position_tables_to_joinlist($joinlist, 'base', 'userid');
        // requires the position_assignment join
        $this->add_manager_tables_to_joinlist($joinlist,
            'position_assignment', 'reportstoid');
        $this->add_course_tags_tables_to_joinlist($joinlist, 'scorm', 'course');

        return $joinlist;
    }

    function define_columnoptions() {
        $columnoptions = array(
            /*
            // array of rb_column_option objects, e.g:
            new rb_column_option(
                '',         // type
                '',         // value
                '',         // name
                '',         // field
                array()     // options
            )
            */
            new rb_column_option(
                'scorm',
                'title',
                get_string('scormtitle', 'rb_source_scorm'),
                'scorm.name',
                array('joins' => 'scorm')
            ),
            new rb_column_option(
                'sco',
                'title',
                get_string('title', 'rb_source_scorm'),
                'sco.title',
                array('joins' => 'sco')
            ),
            new rb_column_option(
                'sco',
                'starttime',
                get_string('time', 'rb_source_scorm'),
                sql_cast_char2int('sco_starttime.value'),
                array(
                    'joins' => 'sco_starttime',
                    'displayfunc' => 'nice_datetime',
                )
            ),
            new rb_column_option(
                'sco',
                'status',
                get_string('status', 'rb_source_scorm'),
                'sco_status.value',
                array(
                    'joins' => 'sco_status',
                    'displayfunc' => 'ucfirst',
                )
            ),
            new rb_column_option(
                'sco',
                'totaltime',
                get_string('totaltime', 'rb_source_scorm'),
                'sco_totaltime.value',
                array('joins' => 'sco_totaltime')
            ),
            new rb_column_option(
                'sco',
                'scoreraw',
                get_string('score', 'rb_source_scorm'),
                'sco_scoreraw.value',
                array('joins' => 'sco_scoreraw')
            ),
            new rb_column_option(
                'sco',
                'scoremin',
                get_string('minscore', 'rb_source_scorm'),
                'sco_scoremin.value',
                array('joins' => 'sco_scoremin')
            ),
            new rb_column_option(
                'sco',
                'scoremax',
                get_string('maxscore', 'rb_source_scorm'),
                'sco_scoremax.value',
                array('joins' => 'sco_scoremax')
            ),
            new rb_column_option(
                'sco',
                'attempt',
                get_string('attemptnum', 'rb_source_scorm'),
                'base.attempt'
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
                'scorm',
                'title',
                get_string('scormtitle', 'rb_source_scorm'),
                'text'
            ),
            new rb_filter_option(
                'sco',
                'title',
                get_string('title', 'rb_source_scorm'),
                'text'
            ),
            new rb_filter_option(
                'sco',
                'starttime',
                get_string('attemptstart', 'rb_source_scorm'),
                'date'
            ),
            new rb_filter_option(
                'sco',
                'attempt',
                get_string('attemptnum', 'rb_source_scorm'),
                'select',
                array('selectfunc' => 'scorm_attempt_list')
            ),
            new rb_filter_option(
                'sco',
                'status',
                get_string('status', 'rb_source_scorm'),
                'select',
                array('selectfunc' => 'scorm_status_list')
            ),
            new rb_filter_option(
                'sco',
                'scoreraw',
                get_string('rawscore', 'rb_source_scorm'),
                'number'
            ),
            new rb_filter_option(
                'sco',
                'scoremin',
                get_string('minscore', 'rb_source_scorm'),
                'number'
            ),
            new rb_filter_option(
                'sco',
                'scoremax',
                get_string('maxscore', 'rb_source_scorm'),
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
                get_string('currentorg', 'rb_source_scorm'),  // title
                'base.userid',                      // field
                null                                // joins
            ),
            new rb_content_option(
                'user',
                get_string('theuser', 'rb_source_scorm'),
                'base.userid'
            ),
            new rb_content_option(
                'date',
                get_string('thedate', 'rb_source_scorm'),
                sql_cast_char2int('starttime.value'),
                'sco_starttime'
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
                'scorm.course',
                'scorm'
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
                'type' => 'scorm',
                'value' => 'title',
            ),
            array(
                'type' => 'sco',
                'value' => 'title',
            ),
            array(
                'type' => 'sco',
                'value' => 'attempt',
            ),
            array(
                'type' => 'sco',
                'value' => 'starttime',
            ),
            array(
                'type' => 'sco',
                'value' => 'totaltime',
            ),
            array(
                'type' => 'sco',
                'value' => 'status',
            ),
            array(
                'type' => 'sco',
                'value' => 'scoreraw',
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
                'value' => 'positionpath',
                'advanced' => 1,
            ),
            array(
                'type' => 'user',
                'value' => 'organisationpath',
                'advanced' => 1,
            ),
            array(
                'type' => 'sco',
                'value' => 'status',
                'advanced' => 1,
            ),
            array(
                'type' => 'sco',
                'value' => 'starttime',
                'advanced' => 1,
            ),
            array(
                'type' => 'sco',
                'value' => 'attempt',
                'advanced' => 1,
            ),
            array(
                'type' => 'sco',
                'value' => 'scoreraw',
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
    /*
    function rb_display_[name]($item, $row) {
        // variable $item refers to the current item
        // $row is an object containing the whole row
        // which will include any extrafields
        //
        // should return a string containing what should be displayed
    }
    */

    //
    //
    // Source specific filter display methods
    //
    //

    function rb_filter_scorm_attempt_list() {
        global $CFG;
        if (!$max = get_field_sql('SELECT ' . sql_max('attempt') .
            " FROM {$CFG->prefix}scorm_scoes_track")) {
            $max = 10;
        }
        $attemptselect = array();
        foreach( range(1, $max) as $attempt) {
            $attemptselect[$attempt] = $attempt;
        }
        return $attemptselect;
    }

    function rb_filter_scorm_status_list() {
        global $CFG;
        // get all available options
        if($records = get_records_sql("SELECT DISTINCT value FROM " .
            "{$CFG->prefix}scorm_scoes_track " .
            "WHERE element = 'cmi.core.lesson_status'")) {
            $statusselect = array();
            foreach($records as $record) {
                $statusselect[$record->value] = ucfirst($record->value);
            }
        } else {
            // a default set of options
            $statusselect = array(
                'passed' => get_string('passed', 'rb_source_scorm'),
                'completed' => get_string('completed', 'rb_source_scorm'),
                'not attempted' => get_string('notattempted', 'rb_source_scorm'),
                'incomplete' => get_string('incomplete', 'rb_source_scorm'),
                'failed' => get_string('failed', 'rb_source_scorm'),
            );
        }
        return $statusselect;
    }


} // end of rb_source_scorm class


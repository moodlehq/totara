<?php

class rb_source_site_logs extends rb_base_source {
    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $requiredcolumns;

    function __construct() {
        global $CFG;
        $this->base = $CFG->prefix . 'log';
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
            // no none standard joins
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
                'log',
                'time',
                'Time',
                'base.time',
                array('displayfunc' => 'nice_datetime')
            ),
            new rb_column_option(
                'log',
                'ip',
                'IP Address',
                'base.ip',
                array('displayfunc' => 'iplookup')
            ),
            new rb_column_option(
                'log',
                'module',
                'Module',
                'base.module'
            ),
            new rb_column_option(
                'log',
                'cmid',
                'CMID',
                'base.cmid'
            ),
            new rb_column_option(
                'log',
                'action',
                'Action',
                sql_fullname('base.module','base.action')
            ),
            new rb_column_option(
                'log',
                'actionlink',
                'Action (linked to URL)',
                sql_fullname('base.module','base.action'),
                array(
                    'displayfunc' => 'link_action',
                    'defaultheading' => 'Action',
                    'extrafields' => array('log_module' => 'base.module', 'log_url' => 'base.url')
                )
            ),
            new rb_column_option(
                'log',
                'url',
                'URL',
                'base.url'
            ),
            new rb_column_option(
                'log',
                'info',
                'Info',
                'base.info'
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
            new rb_filter_option(
                'log',     // type
                'action',  // value
                'Action',  // label
                'text',    // filtertype
                array()    // options
            )
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
                'user',
                'The user',
                'base.userid'
            ),
            new rb_content_option(
                'date',
                'The date',
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
                'base.course'
            ),
        );

        return $paramoptions;
    }

    function define_defaultcolumns() {
        $defaultcolumns = array(
            array(
                'type' => 'log',
                'value' => 'time',
            ),
            array(
                'type' => 'user',
                'value' => 'namelink',
            ),
            array(
                'type' => 'user',
                'value' => 'position',
            ),
            array(
                'type' => 'user',
                'value' => 'organisation',
            ),
            array(
                'type' => 'course',
                'value' => 'courselink',
            ),
            array(
                'type' => 'log',
                'value' => 'ip',
            ),
            array(
                'type' => 'log',
                'value' => 'actionlink',
            ),
            array(
                'type' => 'log',
                'value' => 'info',
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
                'type' => 'log',
                'value' => 'action',
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
                'type' => 'user',
                'value' => 'positionid',
                'advanced' => 1,
            ),
            array(
                'type' => 'user',
                'value' => 'organisationid',
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

    // convert a site log action into a link to that page
    function rb_display_link_action($action, $row) {
        global $CFG;
        $url = $row->log_url;
        $module = $row->log_module;
        require_once($CFG->dirroot.'/course/lib.php');
        $logurl = make_log_url($module, $url);
        return "<a href=\"{$CFG->wwwroot}$logurl\">{$action}</a>";
    }

    // convert IP address into a link to IP lookup page
    function rb_display_iplookup($ip, $row) {
        global $CFG;
        if(isset($ip) && $ip != '' && isset($row->user_id)) {
            return '<a href="' . $CFG->wwwroot . '/iplookup/index.php?ip=' . $ip .
                '&amp;user=' . $row->user_id . '">' . $ip . '</a>';
        }
        else if ($ip && $ip != '') {
            return '<a href="' . $CFG->wwwroot . '/iplookup/index.php?ip=' . $ip .
                '">' . $ip . '</a>';
        } else {
            return '';
        }
    }


    //
    //
    // Source specific filter display methods
    //
    //

    // add methods here with [name] matching filter option filterfunc
    //function rb_filter_[name]() {
        // should return an associative array
        // suitable for use in a select form element
    //}

} // end of rb_source_site_logs class


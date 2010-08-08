<?php

class rb_source_facetoface_sessions extends rb_base_source {
    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters;

    function __construct() {
        global $CFG;
        $this->base = $CFG->prefix . 'facetoface_sessions';
        $this->joinlist = $this->define_joinlist();
        $this->columnoptions = $this->define_columnoptions();
        $this->filteroptions = $this->define_filteroptions();
        $this->contentoptions = $this->define_contentoptions();
        $this->paramoptions = $this->define_paramoptions();
        $this->defaultcolumns = $this->define_defaultcolumns();
        $this->defaultfilters = $this->define_defaultfilters();
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
                'facetoface',
                'LEFT',
                $CFG->prefix . 'facetoface',
                'facetoface.id = base.facetoface',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
            new rb_join(
                'sessiondate',
                'LEFT',
                $CFG->prefix . 'facetoface_sessions_dates',
                'sessiondate.sessionid = base.id',
                REPORT_BUILDER_RELATION_ONE_TO_MANY
            ),
/*
            'role' => "LEFT JOIN {$CFG->prefix}facetoface_session_roles role ON base.id = role.sessionid",
*/
            new rb_join(
                'signup',
                'INNER',
                $CFG->prefix . 'facetoface_signups',
                'signup.sessionid = base.id',
                REPORT_BUILDER_RELATION_ONE_TO_MANY
            ),
            new rb_join(
                'status',
                'LEFT',
                $CFG->prefix . 'facetoface_signups_status',
                '(status.signupid = signup.id AND status.superceded = 0)',
                REPORT_BUILDER_RELATION_ONE_TO_ONE,
                'signup'
            ),
            new rb_join(
                'attendees',
                'LEFT',
                // subquery as table
                "(SELECT su.sessionid, count(ss.id) AS number
                    FROM {$CFG->prefix}facetoface_signups su
                    JOIN {$CFG->prefix}facetoface_signups_status ss
                        ON su.id = ss.signupid
                    WHERE ss.superceded=0 AND ss.statuscode >= 50
                    GROUP BY su.sessionid)",
                'attendees.sessionid = base.id',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
        );


        // include some standard joins
        $this->add_user_table_to_joinlist($joinlist, 'signup', 'userid');
        $this->add_user_custom_fields_to_joinlist($joinlist, 'signup', 'userid');
        $this->add_course_table_to_joinlist($joinlist, 'facetoface', 'course');
        // requires the course join
        $this->add_course_category_table_to_joinlist($joinlist,
            'course', 'category');
        $this->add_position_tables_to_joinlist($joinlist, 'signup', 'userid');
        // requires the position_assignment join
        $this->add_manager_tables_to_joinlist($joinlist,
            'position_assignment', 'reportstoid');
        $this->add_course_tags_tables_to_joinlist($joinlist, 'facetoface', 'course');

        $this->add_facetoface_session_custom_fields_to_joinlist($joinlist);
        // add joins for session custom fields and session roles
        $this->add_facetoface_session_roles_to_joinlist($joinlist);

        return $joinlist;
    }

    function define_columnoptions() {
        $columnoptions = array(
            new rb_column_option(
                'session',              // type
                'capacity',             // value
                'Session Capacity',     // name
                'base.capacity',        // field
                array()                 // options array
            ),
            new rb_column_option(
                'session',
                'numattendees',
                'Number of Attendees',
                'attendees.number',
                array('joins' => 'attendees')
            ),
            new rb_column_option(
                'session',
                'details',
                'Session Details',
                'base.details'
            ),
            new rb_column_option(
                'session',
                'duration',
                'Session Duration',
                'base.duration',
                array(
                    'displayfunc' => 'hours_minutes',
                )
            ),
            new rb_column_option(
                'status',
                'statuscode',
                'Status',
                'status.statuscode',
                array(
                    'joins' => 'status',
                    'displayfunc' => 'facetoface_status',
                )
            ),
            new rb_column_option(
                'facetoface',
                'name',
                'Face to Face Name',
                'facetoface.name',
                array('joins' => 'facetoface')
            ),
            new rb_column_option(
                'facetoface',
                'namelink',
                'Face to Face Name (linked to activity)',
                "facetoface.name",
                array(
                    'joins' => 'facetoface',
                    'displayfunc' => 'link_f2f',
                    'defaultheading' => 'Face to Face Name',
                    'extrafields' => array('activity_id' => 'base.facetoface'),
                )
            ),
            new rb_column_option(
                'date',
                'sessiondate',
                'Session Date',
                'sessiondate.timestart',
                array('joins' =>'sessiondate', 'displayfunc' => 'nice_date')
            ),
            new rb_column_option(
                'date',
                'sessiondate_link',
                'Session Date (linked to session page)',
                'sessiondate.timestart',
                array(
                    'joins' => 'sessiondate',
                    'displayfunc' => 'link_f2f_session',
                    'defaultheading' => 'Session Date',
                    'extrafields' => array('session_id' => 'base.id')
                )
            ),
            new rb_column_option(
                'date',
                'timestart',
                'Session Start Time',
                'sessiondate.timestart',
                array('joins' => 'sessiondate', 'displayfunc' => 'nice_time')
            ),
            new rb_column_option(
                'date',
                'timefinish',
                'Session Finish Time',
                'sessiondate.timefinish',
                array('joins' => 'sessiondate', 'displayfunc' => 'nice_time')
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

        $this->add_facetoface_session_custom_fields_to_columns(&$columnoptions);
        $this->add_facetoface_session_roles_to_columns(&$columnoptions);

        return $columnoptions;
    }

    function define_filteroptions() {
        $filteroptions = array(
            new rb_filter_option(
                'facetoface',
                'name',
                'Face to face name',
                'text'
            ),
            new rb_filter_option(
                'status',
                'statuscode',
                'Status',
                'select',
                array(
                    'selectfunc' => 'session_status_list',
                    'selectoptions' => rb_filter_option::select_width_limiter(),
                )
            ),
            new rb_filter_option(
                'date',
                'sessiondate',
                'Session Date',
                'date'
            ),
            new rb_filter_option(
                'session',
                'capacity',
                'Session Capacity',
                'number'
            ),
            new rb_filter_option(
                'session',
                'details',
                'Session Details',
                'text'
            ),
            new rb_filter_option(
                'session',
                'duration',
                'Session Duration (minutes)',
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

        // add session custom fields to filters
        $this->add_facetoface_session_custom_fields_to_filters($filteroptions);
        // add session role fields to filters
        $this->add_facetoface_session_role_fields_to_filters($filteroptions);

        return $filteroptions;
    }


    function define_contentoptions() {
        $contentoptions = array(
            new rb_content_option(
                'current_org',                      // class name
                "The user's current organisation",  // title
                'signup.userid',                    // field
                'signup'                            // joins
            ),
            new rb_content_option(
                'current_pos',                      // class name
                "The user's current position",      // title
                'signup.userid',                    // field
                'signup'                            // joins
            ),
            new rb_content_option(
                'user',
                'The user',
                'signup.userid',
                'signup'
            ),
            new rb_content_option(
                'date',
                "The session date",
                'sessiondate.timestart',
                'sessiondate'
            ),
        );
        return $contentoptions;
    }

    function define_paramoptions() {
        $paramoptions = array(
            new rb_param_option(
                'userid',         // parameter name
                'signup.userid',  // field
                'signup'          // joins
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
                'type' => 'user',
                'value' => 'namelink',
            ),
            array(
                'type' => 'course',
                'value' => 'courselink',
            ),
            array(
                'type' => 'session',
                'value' => 'location',
            ),
            array(
                'type' => 'date',
                'value' => 'sessiondate',
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
                'type' => 'course',
                'value' => 'fullname',
                'advanced' => 1,
            ),
            array(
                'type' => 'status',
                'value' => 'statuscode',
                'advanced' => 1,
            ),
            array(
                'type' => 'date',
                'value' => 'sessiondate',
                'advanced' => 1,
            ),
        );

        return $defaultfilters;
    }

    //
    //
    // Methods for adding commonly used data to source definitions
    //
    //

    //
    // Join data
    //

    /*
     * Adds any facetoface session custom fields to the $joinlist array
     *
     * @param array &$joinlist Array of current join options
     *                         Passed by reference and updated if
     *                         any session custom fields exist
     * @return boolean True if session custom fields exist
     */
    function add_facetoface_session_custom_fields_to_joinlist(&$joinlist) {
        global $CFG;
        // add all session custom fields to join list
        if($session_fields =
            get_records('facetoface_session_field','','','','id,shortname')) {
            foreach($session_fields as $session_field) {
                $field = $session_field->shortname;
                $id = $session_field->id;
                $key = "session_$field";
                $joinlist[] = new rb_join(
                    $key,
                    'LEFT',
                    $CFG->prefix . 'facetoface_session_data',
                    "($key.sessionid = base.id AND $key.fieldid = $id)",
                    REPORT_BUILDER_RELATION_ONE_TO_ONE
                );
            }
            return true;
        }
        return false;
    }

    /*
     * Adds any facetoface session roles to the $joinlist array
     *
     * @param array &$joinlist Array of current join options
     *                         Passed by reference and updated if
     *                         any session roles exist
     * @return boolean True if any roles exist
     */
    function add_facetoface_session_roles_to_joinlist(&$joinlist) {
        global $CFG;
        // add joins for the following roles as "session_role_X" and
        // "session_role_user_X"
        $allowedroles = get_config(null, 'facetoface_sessionroles');
        if(!isset($allowedroles) || $allowedroles == '') {
            return false;
        }

        $sessionroles = get_records_sql_menu("SELECT id,shortname FROM {$CFG->prefix}role WHERE id IN ($allowedroles)");
        if(!$sessionroles) {
            return false;
        }

        if($roles = get_records('role','','','','id,shortname')) {
            foreach ($roles as $role) {
                if (in_array($role->shortname, $sessionroles)) {
                    $field = $role->shortname;
                    $id = $role->id;
                    $key = "session_role_$field";
                    $userkey = "session_role_user_$field";
                    $joinlist[] = new rb_join(
                        $key,
                        'LEFT',
                        $CFG->prefix . 'facetoface_session_roles',
                        "($key.sessionid = base.id AND $key.roleid = $id)",
                        REPORT_BUILDER_RELATION_ONE_TO_MANY
                    );
                    $joinlist[] = new rb_join(
                        $userkey,
                        'LEFT',
                        $CFG->prefix . 'user',
                        "$userkey.id = $key.userid",
                        REPORT_BUILDER_RELATION_ONE_TO_ONE,
                        $key
                    );

                }
            }
            return true;
        }

        return false;
    }

    //
    // Column data
    //

    /*
     * Adds any session custom fields to the $columnoptions array
     *
     * @param array &$columnoptions Array of current column options
     *                              Passed by reference and updated if
     *                              any session custom fields exist
     * @return boolean True if session custom fields exist
     */
    function add_facetoface_session_custom_fields_to_columns(&$columnoptions) {
        // add all session custom fields to column options list
        if($session_fields = get_records('facetoface_session_field','','','','id,shortname,name')) {
            foreach($session_fields as $session_field) {
                $field = $session_field->shortname;
                $name = $session_field->name;
                $key = "session_$field";
                $columnoptions[] = new rb_column_option(
                    'session',
                    $field,
                    'Session '.$name,
                    $key.'.data',
                    array('joins' => $key)
                );
            }
            return true;
        }
        return false;
    }


    /*
     * Adds any session role fields to the $columnoptions array
     *
     * @param array &$columnoptions Array of current column options
     *                              Passed by reference and updated if
     *                              any session roles exist
     * @return boolean True if session roles exist
     */
    function add_facetoface_session_roles_to_columns(&$columnoptions) {
        global $CFG;
        $allowedroles = get_config(null, 'facetoface_sessionroles');
        if(!isset($allowedroles) || $allowedroles == '') {
            return false;
        }

        $sessionroles = get_records_sql("SELECT id,name,shortname
            FROM {$CFG->prefix}role
            WHERE id IN ($allowedroles)");
        if(!$sessionroles) {
            return false;
        }

        foreach($sessionroles as $sessionrole) {
            $field = $sessionrole->shortname;
            $name = $sessionrole->name;
            $key = "session_role_$field";
            $userkey = "session_role_user_$field";
            $columnoptions[] = new rb_column_option(
                'role',
                $field . '_name',
                'Session '.$name . ' Name',
                sql_fullname($userkey.'.firstname', $userkey.'.lastname'),
                array(
                    'joins' => $userkey,
                    'grouping' => 'comma_list',
                )
            );
        }
        return true;
    }


    //
    // Filter data
    //


    /*
     * Adds some common user field to the $filteroptions array
     *
     * @param array &$filteroptions Array of current filter options
     *                              Passed by reference and updated by
     *                              this method
     * @return True
     */
    protected function add_facetoface_session_role_fields_to_filters(&$filteroptions) {
        // auto-generate filters for session roles fields
        global $CFG;
        $allowedroles = get_config(null, 'facetoface_sessionroles');
        if(!isset($allowedroles) || $allowedroles == '') {
            return false;
        }

        $sessionroles = get_records_sql("SELECT id,name,shortname
            FROM {$CFG->prefix}role
            WHERE id IN ($allowedroles)");
        if(!$sessionroles) {
            return false;
        }

        foreach($sessionroles as $sessionrole) {
            $field = $sessionrole->shortname;
            $name = $sessionrole->name;
            $key = "session_role_$field";
            $userkey = "session_role_user_$field";
            $filteroptions[] = new rb_filter_option(
                'role',
                $field . '_name',
                'Session ' . $name,
                'text'
            );
        }
        return true;
    }


    /*
     * Adds some common session custom field filters to the $filteroptions array
     *
     * @param array &$filteroptions Array of current filter options
     *                              Passed by reference and updated by
     *                              this method
     * @return True if there are any session custom fields
     */
    protected function add_facetoface_session_custom_fields_to_filters(&$filteroptions) {
        // because session fields can be added/removed by the user
        // check that the custom field exists before making an option
        // available

        // filters to try and add
        $possible_filters = array(
            new rb_filter_option(
                'session',
                'location',
                'Session Location',
                'text'
            ),
            new rb_filter_option(
                'session',
                'venue',
                'Session Venue',
                'text'
            ),
            new rb_filter_option(
                'session',
                'room',
                'Session Room',
                'text'
            ),
            new rb_filter_option(
                'session',
                'pilot',
                'Pilot',
                'select',
                array('selectfunc' => 'yesno_list')
            ),
            new rb_filter_option(
                'session',
                'audit',
                'Audit',
                'select',
                array('selectfunc' => 'yesno_list')
            ),
            new rb_filter_option(
                'session',
                'coursedelivery',
                'Course Delivery',
                'select',
                array(
                    'selectfunc' => 'coursedelivery_list',
                    'selectoptions' => rb_filter_option::select_width_limiter(),
                )
            ),
        );

        // add all valid session custom fields to filter options list
        if($session_fields = get_records('facetoface_session_field')) {
            foreach($possible_filters as $possible_filter) {
                foreach($session_fields as $session_field) {
                    // don't try and add if it's not defined above
                    if($possible_filter->value == $session_field->shortname) {
                        $filteroptions[] = $possible_filter;
                    }
                }
            }
            return true;
        }
        return false;
    }

    //
    //
    // Face-to-face specific display functions
    //
    //

    // convert a f2f status code to a text string
    function rb_display_facetoface_status($status, $row) {
        global $CFG, $MDL_F2F_STATUS;

        include_once($CFG->dirroot.'/mod/facetoface/lib.php');

        // if status doesn't exist just return the status code
        if(!isset($MDL_F2F_STATUS[$status])) {
            return $status;
        }
        // otherwise return the string
        return get_string('status_'.facetoface_get_status($status),'facetoface');
    }

    // convert a f2f activity name into a link to that activity
    function rb_display_link_f2f($name, $row) {
        global $CFG;
        $activityid = $row->activity_id;
        return "<a href=\"{$CFG->wwwroot}/mod/facetoface/view.php?f={$activityid}\">{$name}</a>";
    }

    // convert a f2f date into a link to that session
    function rb_display_link_f2f_session($date, $row) {
        global $CFG;
        $sessionid = $row->session_id;
        return "<a href=\"{$CFG->wwwroot}/mod/facetoface/attendees.php?s={$sessionid}\">".userdate($date,'%d %B %Y')."</a>";
    }


    //
    //
    // Source specific filter display methods
    //
    //

    function rb_filter_session_status_list() {
        global $CFG,$MDL_F2F_STATUS;

        include_once($CFG->dirroot.'/mod/facetoface/lib.php');

        $output = array();
        if(is_array($MDL_F2F_STATUS)) {
            foreach($MDL_F2F_STATUS as $code => $statusitem) {
                $output[$code] = get_string('status_'.$statusitem,'facetoface');
            }
        }
        // show most completed option first in pulldown
        return array_reverse($output, true);

    }

    function rb_filter_coursedelivery_list() {
        $coursedelivery = array();
        $coursedelivery['Internal'] = 'Internal';
        $coursedelivery['External'] = 'External';
        return $coursedelivery;
    }

} // end of rb_source_facetoface_sessions class


<?php

class rb_source_facetoface_sessions extends rb_base_source {
    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $sourcetitle;

    function __construct() {
        global $CFG;
        $this->base = $CFG->prefix . 'facetoface_signups';
        $this->joinlist = $this->define_joinlist();
        $this->columnoptions = $this->define_columnoptions();
        $this->filteroptions = $this->define_filteroptions();
        $this->contentoptions = $this->define_contentoptions();
        $this->paramoptions = $this->define_paramoptions();
        $this->defaultcolumns = $this->define_defaultcolumns();
        $this->defaultfilters = $this->define_defaultfilters();
        $this->sourcetitle = get_string('sourcetitle', 'rb_source_facetoface_sessions');
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
                'sessions',
                'LEFT',
                $CFG->prefix . 'facetoface_sessions',
                'sessions.id = base.sessionid',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
            new rb_join(
                'facetoface',
                'LEFT',
                $CFG->prefix . 'facetoface',
                'facetoface.id = sessions.facetoface',
                REPORT_BUILDER_RELATION_ONE_TO_ONE,
                'sessions'
            ),
            new rb_join(
                'sessiondate',
                'LEFT',
                $CFG->prefix . 'facetoface_sessions_dates',
                'sessiondate.sessionid = base.sessionid',
                REPORT_BUILDER_RELATION_ONE_TO_MANY
            ),
            new rb_join(
                'status',
                'LEFT',
                $CFG->prefix . 'facetoface_signups_status',
                '(status.signupid = base.id AND status.superceded = 0)',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
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
                'attendees.sessionid = base.sessionid',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
        );


        // include some standard joins
        $this->add_user_table_to_joinlist($joinlist, 'base', 'userid');
        $this->add_user_custom_fields_to_joinlist($joinlist, 'base', 'userid');
        $this->add_course_table_to_joinlist($joinlist, 'facetoface', 'course');
        // requires the course join
        $this->add_course_category_table_to_joinlist($joinlist,
            'course', 'category');
        $this->add_position_tables_to_joinlist($joinlist, 'base', 'userid');
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
                get_string('sesscapacity', 'rb_source_facetoface_sessions'),     // name
                'sessions.capacity',        // field
                array('joins' => 'sessions')                 // options array
            ),
            new rb_column_option(
                'session',
                'numattendees',
                get_string('numattendees', 'rb_source_facetoface_sessions'),
                'attendees.number',
                array('joins' => 'attendees')
            ),
            new rb_column_option(
                'session',
                'details',
                get_string('sessdetails', 'rb_source_facetoface_sessions'),
                'sessions.details',
                array('joins' => 'sessions')
            ),
            new rb_column_option(
                'session',
                'duration',
                get_string('sessduration', 'rb_source_facetoface_sessions'),
                'sessions.duration',
                array(
                    'joins' => 'sessions',
                    'displayfunc' => 'hours_minutes',
                )
            ),
            new rb_column_option(
                'status',
                'statuscode',
                get_string('status', 'rb_source_facetoface_sessions'),
                'status.statuscode',
                array(
                    'joins' => 'status',
                    'displayfunc' => 'facetoface_status',
                )
            ),
            new rb_column_option(
                'facetoface',
                'name',
                get_string('ftfname', 'rb_source_facetoface_sessions'),
                'facetoface.name',
                array('joins' => 'facetoface')
            ),
            new rb_column_option(
                'facetoface',
                'namelink',
                get_string('ftfnamelink', 'rb_source_facetoface_sessions'),
                "facetoface.name",
                array(
                    'joins' => array('facetoface','sessions'),
                    'displayfunc' => 'link_f2f',
                    'defaultheading' => get_string('ftfname', 'rb_source_facetoface_sessions'),
                    'extrafields' => array('activity_id' => 'sessions.facetoface'),
                )
            ),
            new rb_column_option(
                'date',
                'sessiondate',
                get_string('sessdate', 'rb_source_facetoface_sessions'),
                'sessiondate.timestart',
                array('joins' =>'sessiondate', 'displayfunc' => 'nice_date')
            ),
            new rb_column_option(
                'date',
                'sessiondate_link',
                get_string('sessdatelink', 'rb_source_facetoface_sessions'),
                'sessiondate.timestart',
                array(
                    'joins' => 'sessiondate',
                    'displayfunc' => 'link_f2f_session',
                    'defaultheading' => get_string('sessdate', 'rb_source_facetoface_sessions'),
                    'extrafields' => array('session_id' => 'base.sessionid')
                )
            ),
            new rb_column_option(
                'date',
                'timestart',
                get_string('sessstart', 'rb_source_facetoface_sessions'),
                'sessiondate.timestart',
                array('joins' => 'sessiondate', 'displayfunc' => 'nice_time')
            ),
            new rb_column_option(
                'date',
                'timefinish',
                get_string('sessfinish', 'rb_source_facetoface_sessions'),
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
                get_string('status', 'rb_source_facetoface_sessions'),
                'select',
                array(
                    'selectfunc' => 'session_status_list',
                    'selectoptions' => rb_filter_option::select_width_limiter(),
                )
            ),
            new rb_filter_option(
                'date',
                'sessiondate',
                get_string('sessdate', 'rb_source_facetoface_sessions'),
                'date'
            ),
            new rb_filter_option(
                'session',
                'capacity',
                get_string('sesscapacity', 'rb_source_facetoface_sessions'),
                'number'
            ),
            new rb_filter_option(
                'session',
                'details',
                get_string('sessdetails', 'rb_source_facetoface_sessions'),
                'text'
            ),
            new rb_filter_option(
                'session',
                'duration',
                get_string('sessduration', 'rb_source_facetoface_sessions'),
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
                get_string('currentorg', 'rb_source_facetoface_sessions'),  // title
                'base.userid'                       // field
            ),
            new rb_content_option(
                'current_pos',                      // class name
                get_string('currentpos', 'rb_source_facetoface_sessions'),      // title
                'base.userid'                       // field
            ),
            new rb_content_option(
                'user',
                get_string('user', 'rb_source_facetoface_sessions'),
                'base.userid'
            ),
            new rb_content_option(
                'date',
                get_string('thedate', 'rb_source_facetoface_sessions'),
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
                'base.userid'     // field
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
            get_records('facetoface_session_field','','','','id')) {
            foreach($session_fields as $session_field) {
                $id = $session_field->id;
                $key = "session_$id";
                $joinlist[] = new rb_join(
                    $key,
                    'LEFT',
                    $CFG->prefix . 'facetoface_session_data',
                    "($key.sessionid = base.sessionid AND $key.fieldid = $id)",
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
                        "($key.sessionid = base.sessionid AND $key.roleid = $id)",
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
        if($session_fields = get_records('facetoface_session_field','','','','id,name')) {
            foreach($session_fields as $session_field) {
                $name = $session_field->name;
                $key = "session_$session_field->id";
                $columnoptions[] = new rb_column_option(
                    'session',
                    $key,
                    get_string('sessionx', 'rb_source_facetoface_sessions', $name),
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
                    'grouping' => 'comma_list_unique',
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
            'pilot' => array(
                'text' => get_string('pilot', 'rb_source_facetoface_sessions'),
                'type' => 'select',
                'options' => array('selectfunc' => 'yesno_list')
            ),
            'audit' => array(
                'text' => get_string('audit', 'rb_source_facetoface_sessions'),
                'type' => 'select',
                'options' => array('selectfunc' => 'yesno_list')
            ),
            'coursedelivery' => array(
                'text' => get_string('coursedelivery', 'rb_source_facetoface_sessions'),
                'type' => 'select',
                'options' => array(
                    'selectfunc' => 'coursedelivery_list',
                    'selectoptions' => rb_filter_option::select_width_limiter(),
                )
            )
        );

        // add all valid session custom fields to filter options list
        if($session_fields = get_records('facetoface_session_field')) {
            foreach($session_fields as $session_field) {
                foreach($possible_filters as $key => $filter_data) {
                    if($key == $session_field->shortname) {
                        $filter = new rb_filter_option(
                            'session',
                            'session_' . $session_field->id,
                            $filter_data['text'],
                            $filter_data['type'],
                            $filter_data['options']
                        );
                        break;
                    } else {
                        $filter = new rb_filter_option(
                            'session',
                            'session_' . $session_field->id,
                            $session_field->name,
                            'text'
                        );
                    }
                }
                $filteroptions[] = $filter;
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


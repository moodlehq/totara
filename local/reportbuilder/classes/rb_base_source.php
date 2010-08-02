<?php
/*
 * Abstract base class to be extended to create report builder sources
 *
 */
abstract class rb_base_source {

/*
 * Class constructor
 *
 * Call from the constructor of all child classes with:
 *
 *  parent::__construct()
 *
 * to ensure child class has implemented everything necessary to work.
 *
 */
    function __construct() {
        // check that child classes implement required properties
        $properties = array(
            'base',
            'joinlist',
            'columnoptions',
            'filteroptions',
        );
        foreach($properties as $property) {
            if(!property_exists($this, $property)) {
                throw new Exception("Property '$property' must be set in class " .
                    get_class($this));
            }
        }

        // set sensible defaults for optional properties
        $defaults = array(
            'paramoptions' => array(),
            'requiredcolumns' => array(),
            'contentoptions' => array(),
            'preproc' => null,
            'grouptype' => 'none',
            'groupid' => null,
        );
        foreach($defaults as $property => $default) {
            if(!property_exists($this, $property)) {
                $this->$property = $default;
            } else if ($this->$property === null) {
                $this->$property = $default;
            }
        }
    }

    //
    //
    // General purpose source specific methods
    //
    //

    /*
     * Returns a new rb_column object based on a column option from this source
     *
     * If $heading is given use it for the heading property, otherwise use
     * the default heading property from the column option
     *
     * @param string $type The type of the column option to use
     * @param string $value The value of the column option to use
     * @param string $heading Heading for the new column
     * @return object A new rb_column object with details copied from this
     *                rb_column_option
     */
    function new_column_from_option($type, $value, $heading=null, $hidden=0) {
        $columnoptions = $this->columnoptions;
        $joinlist = $this->joinlist;

        if($coloption =
            reportbuilder::get_single_item($columnoptions, $type, $value)) {

            // make sure joins are defined before adding column
            if(!reportbuilder::check_joins($joinlist, $coloption->joins)) {
                throw new ReportBuilderException("Joins for column with type '" .
                    $coloption->type . "' and value '" . $coloption->value .
                    "' not found");
            }

            if($heading === null) {
                $heading = ($coloption->defaultheading !== null) ?
                    $coloption->defaultheading : $coloption->name;
            }
            return new rb_column(
                $type,
                $value,
                $heading,
                $coloption->field,
                array(
                    'joins' => $coloption->joins,
                    'displayfunc' => $coloption->displayfunc,
                    'extrafields' => $coloption->extrafields,
                    'required' => false,
                    'capability' => $coloption->capability,
                    'noexport' => $coloption->noexport,
                    'grouping' => $coloption->grouping,
                    'style' => $coloption->style,
                    'hidden' => $hidden,
                )
            );
        } else {
            throw new ReportBuilderException("Column option with type '".
                $type . "' and value '". $value . "' not found");
        }
    }

    function new_filter_from_option($type, $value, $advanced=null) {
        $filteroptions = $this->filteroptions;
        $columnoptions = $this->columnoptions;
        $joinlist = $this->joinlist;

        if(!$filteroption =
            reportbuilder::get_single_item($filteroptions, $type, $value)) {

            throw new ReportBuilderException("Filter option with type '".
                $type . "' and value '" . $value . "' not found");
        }
        if(!$columnoption =
            reportbuilder::get_single_item($columnoptions, $type, $value)) {

            throw new ReportBuilderException("Column option with type '".
                $type . "' and value '" . $value . "' not found");
        }

        // make sure joins are defined before adding column
        if(!reportbuilder::check_joins($joinlist, $columnoption->joins)) {
            throw new ReportBuilderException("Joins for filter with type '" .
                $columnoption->type . "' and value '" . $columnoption->value .
                "' not found");
        }

        if($advanced === null) {
            $advanced = $filteroption->defaultadvanced;
        }
        return new rb_filter(
            $type,
            $value,
            $advanced,
            $filteroption->label,
            $filteroption->filtertype,
            $columnoption->field,
            array(
                'joins' => $columnoption->joins,
                'selectfunc' => $filteroption->selectfunc,
                'selectchoices' => $filteroption->selectchoices,
                'selectoptions' => $filteroption->selectoptions,
                'grouping' => $columnoption->grouping,
                'src' => $this,
            )
        );

    }

    //
    //
    // Generic column display methods
    //
    //

    // reformat a timestamp, showing nothing if invalid or null
    function rb_display_nice_date($date, $row) {
        if($date && $date > 0) {
            return userdate($date, '%d %b %Y');
        } else {
            return '';
        }
    }

    // reformat a timestamp into a time, showing nothing if invalid or null
    function rb_display_nice_time($date, $row) {
        if($date && $date > 0) {
            return userdate($date, '%H:%M');
        } else {
            return '';
        }
    }

    // reformat a timestamp into a date+time, showing nothing if invalid or null
    function rb_display_nice_datetime($date, $row) {
        if($date && $date > 0) {
            return userdate($date, '%d %b %Y at %H:%M');
        } else {
            return '';
        }
    }

    // convert first letters of each word to uppercase
    function rb_display_ucfirst($item, $row) {
        return ucfirst($item);
    }

    // convert floats to 2 decimal places
    function rb_display_round2($item, $row) {
        return $item === null ? null : sprintf('%.2f', $item);
    }

    // converts number to percentage with 1 decimal place
    function rb_display_percent($item, $row) {
        return $item === null ? null : sprintf('%.1f%%', $item);
    }

    // link user's name to profile page
    // requires the user_id extra field
    // in column definition
    function rb_display_link_user($user, $row) {
        global $CFG;
        $userid = $row->user_id;
        return "<a href=\"{$CFG->wwwroot}/user/view.php?id={$userid}\">{$user}</a>";
    }

    // convert a course name into a link to that course
    function rb_display_link_course($course, $row) {
        global $CFG;
        $courseid = $row->course_id;
        return "<a href=\"{$CFG->wwwroot}/course/view.php?id={$courseid}\">{$course}</a>";
    }

    function rb_display_yes_no($item, $row) {
        if ($item === null) {
            return '';
        } else if ($item) {
            return get_string('yes');
        } else {
            return get_string('no');
        }
    }
    //
    //
    // Generic select filter methods
    //
    //

    function rb_filter_yesno_list() {
        $yn = array();
        $yn['Yes'] = 'Yes';
        $yn['No'] = 'No';
        return $yn;
    }

    function rb_filter_organisations_list($contentmode, $contentoptions, $reportid) {
        global $CFG,$USER;
        require_once($CFG->dirroot.'/hierarchy/lib.php');
        require_once($CFG->dirroot.'/hierarchy/type/organisation/lib.php');

        // show all options if no content restrictions set
        if($contentmode == 0) {
            $hierarchy = new organisation();
            $hierarchy->make_hierarchy_list($orgs, null, true, true);
            return $orgs;
        }

        $baseorg = null; // default to top of tree

        $localset = false;
        $nonlocal = false;
        // are enabled content restrictions local or not?
        if(isset($contentoptions) && is_array($contentoptions)) {
            foreach($contentoptions as $option) {
                $name = $option->classname;
                $classname = 'rb_' . $name . '_content';
                if(class_exists($classname)) {
                    if($name == 'completed_org' || $name == 'current_org') {
                        if(reportbuilder::get_setting($reportid, $classname,
                            'enable')) {
                            $localset = true;
                        }
                    } else {
                        if(reportbuilder::get_setting($reportid, $classname,
                            'enable')) {
                        $nonlocal = true;
                        }
                    }
                }
            }
        }

        // 'any' mode
        if($contentmode == 1) {
            if($localset && !$nonlocal) {
                // only restrict the org list if all content restrictions are local ones
                if($orgid = get_field('pos_assignment','organisationid','userid',$USER->id)) {
                    $baseorg = $orgid;
                }
            }
            // 'all' mode
        } else if ($contentmode == 2) {
            if($localset) {
                // restrict the org list if any content restrictions are local ones
                if($orgid = get_field('pos_assignment','organisationid','userid',$USER->id)) {
                    $baseorg = $orgid;
                }
            }
        }

        $hierarchy = new organisation();
        $hierarchy->make_hierarchy_list($orgs, $baseorg, true, true);

        return $orgs;

    }

    function rb_filter_positions_list() {
        global $CFG;
        require_once($CFG->dirroot.'/hierarchy/lib.php');
        require_once($CFG->dirroot.'/hierarchy/type/position/lib.php');

        $hierarchy = new position();
        $hierarchy->make_hierarchy_list($positions, null, true, false);

        return $positions;

    }

    function rb_filter_course_categories_list() {
        global $CFG;
        require_once($CFG->dirroot.'/course/lib.php');
        make_categories_list($cats, $unused);

        return $cats;
    }

    //
    //
    // Generic grouping methods for aggregation
    //
    //

    function rb_group_count($field) {
        return "COUNT($field)";
    }

    function rb_group_unique_count($field) {
        return "COUNT(DISTINCT $field)";
    }

    function rb_group_sum($field) {
        return "SUM($field)";
    }

    function rb_group_average($field) {
        return "AVG($field)";
    }

    function rb_group_max($field) {
        return "MAX($field)";
    }

    function rb_group_min($field) {
        return "MIN($field)";
    }

    function rb_group_stddev($field) {
        return "STDDEV($field)";
    }

    // can be used to 'fake' a percentage, if matching values return 1 and
    // all other values return 0 or null
    function rb_group_percent($field) {
        return "CAST(AVG($field)*100.0 AS integer)";
    }

    // return list as single field, separated by commas
    function rb_group_comma_list($field) {
        return sql_group_concat($field);
    }

    // return unique list items as single field, separated by commas
    function rb_group_comma_list_unique($field) {
        return sql_group_concat($field, ', ', true);
    }

    // return list as single field, one per line
    function rb_group_list($field) {
        return sql_group_concat($field, '<br />');
    }

    // return unique list items as single field, one per line
    function rb_group_list_unique($field) {
        return sql_group_concat($field, '<br />', true);
    }

    // return list as single field, separated by a line with - on (in HTML)
    function rb_group_list_dash($field) {
        return sql_group_concat($field, '<br />-<br />');
    }

    //
    //
    // Methods for adding commonly used data to source definitions
    //
    //

    //
    // Wrapper functions to add columns/fields/joins in one go
    //
    //
    //

    // depends on join user to user table with alias u
    protected function add_user_field_options(&$src, $extrajoins=array()) {
        if(array_key_exists('user', $src->joinlist)) {
            $this->add_user_fields_to_columns($src->columnoptions, $extrajoins);
            $this->add_user_fields_to_filters($src->filteroptions);
        } else {
            throw new ReportBuilderException('Cannot add user options because the
                user join has not yet been defined');
        }
    }

    // depends on join user to user table with alias u
    protected function add_user_custom_field_options(&$src, $extrajoins=array()) {
        if(array_key_exists('user', $src->joinlist)) {
            $this->add_user_custom_fields_to_joinlist($src->joinlist);
            $this->add_user_custom_fields_to_columns($src->columnoptions, $extrajoins);
            $this->add_user_custom_fields_to_filters($src->filteroptions);
        } else {
            throw new ReportBuilderException('Cannot add user custom field options
                because the user join has not yet been defined');
        }
    }

    protected function add_position_field_options(&$src) {
        $this->add_position_info_to_columns($src->columnoptions);
        $this->add_position_fields_to_filters($src->filteroptions);
    }

    // depends on join course to course table with alias c
    protected function add_course_field_options(&$src) {
        if(array_key_exists('course', $src->joinlist)) {
            $this->add_course_info_to_columns($src->columnoptions);
            $this->add_course_fields_to_filters($src->filteroptions);
        } else {
            throw new ReportBuilderException('Cannot add course field options
                because the course join has not yet been defined');
        }
    }

    // depends on join course to course table with alias c
    protected function add_course_category_field_options(&$src) {
        if(array_key_exists('course', $src->joinlist)) {
            $this->add_course_category_to_joinlist($src->joinlist);
            $this->add_course_category_info_to_columns($src->columnoptions);
            $this->add_course_category_fields_to_filters($src->filteroptions);
        } else {
            throw new ReportBuilderException('Cannot add course category field
                options because the course join has not yet been defined');
        }
    }

    //
    // Column data
    //

    /*
     * Adds any user profile fields to the $columnoptions array
     *
     * @param array &$columnoptions Array of current column options
     *                              Passed by reference and updated if
     *                              any user custom fields exist
     * @param array $extrajoins Any additional joins needed to access the user table
     * @return boolean True if user custom fields exist
     */
    protected function add_user_custom_fields_to_columns(&$columnoptions, $extrajoins=array()) {
        // auto-generate columns for each user custom field
        if($custom_fields =
            get_records('user_info_field')) {
            foreach($custom_fields as $custom_field) {
                $field = $custom_field->shortname;
                $name = $custom_field->name;
                $key = "user_$field";
                $joins = array_merge($extrajoins, array('user', $key));
                $columnoptions[] = new rb_column_option(
                    'user_profile',
                    $field,
                    $name,
                    "$key.data",
                    array('joins' => $joins)
                );
            }
            return true;
        }
        return false;
    }

     /*
     * Adds some common user field to the $columnoptions array
     *
     * @param array &$columnoptions Array of current column options
     *                              Passed by reference and updated by
     *                              this method
     * @param array $extrajoins Any additional joins needed to access the user table
     * @return True
     */
    protected function add_user_fields_to_columns(&$columnoptions, $extrajoins=array()) {
        $columnoptions[] = new rb_column_option(
            'user',
            'fullname',
            'User Fullname',
            sql_fullname('u.firstname', 'u.lastname'),
            array('joins' => array_merge($extrajoins, (array) 'user'))
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'namelink',
            'User Fullname (linked to profile)',
            sql_fullname('u.firstname', 'u.lastname'),
            array(
                'joins' => array_merge($extrajoins, (array) 'user'),
                'displayfunc' => 'link_user',
                'defaultheading' => 'User Fullname',
                'extrafields' => array('user_id' => 'u.id'),
            )
        );
        // auto-generate columns for user fields
        $fields = array(
            'firstname' => 'User First Name',
            'lastname' => 'User Last Name',
            'username' => 'Username',
            'idnumber' => 'User ID Number',
            'id' => 'User ID',
        );
        foreach($fields as $field => $name) {
            $columnoptions[] = new rb_column_option(
                'user',
                $field,
                $name,
                "u.$field",
                array('joins' => array_merge($extrajoins, (array) 'user'))
            );
        }
        return true;
    }

    /*
     * Adds some common user position info to the $columnoptions array
     *
     * @param array &$columnoptions Array of current column options
     *                              Passed by reference and updated by
     *                              this method
     * @param array $extrajoins Any additional joins needed to access the user table
     * @return True
     */
    protected function add_position_info_to_columns(&$columnoptions, $extrajoins=array()) {
        $columnoptions[] = new rb_column_option(
            'user',
            'managername',
            "User's Manager Name",
            sql_fullname('manager.firstname','manager.lastname'),
            array(
                'joins' => array_merge($extrajoins, array('user','position_assignment','manager_role_assignment','manager')),
            )
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'organisationid',
            "User's Organisation ID",
            'pa.organisationid',
            array(
                'joins' => array_merge($extrajoins, array('user','position_assignment')),
            )
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'organisation',
            "User's Organisation Name",
            'organisation.fullname',
            array(
                'joins' => array_merge($extrajoins, array('user','position_assignment','organisation')),
            )
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'positionid',
            "User's Position ID",
            'pa.positionid',
            array(
                'joins' => array_merge($extrajoins, array('user','position_assignment')),
            )
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'position',
            "User's Position",
            'position.fullname',
            array(
                'joins' => array_merge($extrajoins, array('user','position_assignment','position')),
            )
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'title',
            "User's Job Title",
            'pa.fullname',
            array(
                'joins' => array_merge($extrajoins, array('user','position_assignment')),
            )
        );
        return true;
    }

    /*
     * Adds some common course info to the $columnoptions array
     *
     * @param array &$columnoptions Array of current column options
     *                              Passed by reference and updated by
     *                              this method
     * @param array $extrajoins Any additional joins needed to access the user table
     * @return True
     */
    protected function add_course_info_to_columns(&$columnoptions, $extrajoins=array()) {
        $columnoptions[] = new rb_column_option(
            'course',
            'fullname',
            'Course Name',
            'c.fullname',
            array('joins' => array_merge($extrajoins, array('course')))
        );
        $columnoptions[] = new rb_column_option(
            'course',
            'courselink',
            'Course Name (linked to course page)',
            'c.fullname',
            array(
                'joins' => array_merge($extrajoins, array('course')),
                'displayfunc' => 'link_course',
                'defaultheading' => 'Course Name',
                'extrafields' => array('course_id' => 'c.id')
            )
        );
        $columnoptions[] = new rb_column_option(
            'course',
            'shortname',
            'Course Shortname',
            'c.shortname',
            array('joins' => array_merge($extrajoins, array('course')))
        );
        $columnoptions[] = new rb_column_option(
            'course',
            'idnumber',
            'Course ID Number',
            'c.idnumber',
            array('joins' => array_merge($extrajoins, array('course')))
        );
        $columnoptions[] = new rb_column_option(
            'course',
            'id',
            'Course ID',
            'c.id',
            array('joins' => array_merge($extrajoins, array('course')))
        );
        $columnoptions[] = new rb_column_option(
            'course',
            'startdate',
            'Course Start Date',
            'c.startdate',
            array(
                'joins' => array_merge($extrajoins, array('course')),
                'displayfunc' => 'nice_date',
            )
        );
        return true;
    }

    /*
     * Adds some common course category info to the $columnoptions array
     *
     * @param array &$columnoptions Array of current column options
     *                              Passed by reference and updated by
     *                              this method
     * @param array $extrajoins Any additional joins needed to access the user table
     * @return True
     */
    protected function add_course_category_info_to_columns(&$columnoptions, $extrajoins=array()) {
        $columnoptions[] = new rb_column_option(
                'course_category',
                'name',
                'Course Category',
                'cat.name',
                array(
                    'joins' => array_merge($extrajoins, array('course','course_category')),
                )
        );
        $columnoptions[] = new rb_column_option(
                'course_category',
                'id',
                'Course Category ID',
                'c.category',
                array(
                    'joins' => array_merge($extrajoins, array('course','course_category')),
                )
        );
        return true;
    }

    //
    // Join list data
    //

    /*
     * Adds any user profile fields to the $joinlist array
     *
     * @param array &$joinlist Array of current join options
     *                         Passed by reference and updated if
     *                         any user custom fields exist
     * @return boolean True if user custom fields exist
     */
    protected function add_user_custom_fields_to_joinlist(&$joinlist) {
        global $CFG;

        // add all user custom fields to join list
        if($custom_fields = get_records('user_info_field')) {
            foreach($custom_fields as $custom_field) {
                $field = $custom_field->shortname;
                $id = $custom_field->id;
                $key = "user_$field";
                $joinlist[$key] = "LEFT JOIN {$CFG->prefix}user_info_data $key ON (u.id = $key.userid AND $key.fieldid = $id )";
            }
            return true;
        }
        return false;
    }


    /*
     * Adds the course_category table to the $joinlist array
     *
     * @param array &$joinlist Array of current join options
     *                         Passed by reference and updated to
     *                         include course_category
     * @return boolean True
     */
    protected function add_course_category_to_joinlist(&$joinlist) {
        global $CFG;

        $joinlist['course_category'] = "LEFT JOIN {$CFG->prefix}course_categories cat
            ON cat.id = c.category";

        return true;
    }

    //
    // Filter data
    //

    /*
     * Adds any user profile fields to the $filteroptions array as text filters
     *
     * @param array &$filteroptions Array of current filter options
     *                              Passed by reference and updated if
     *                              any user custom fields exist
     * @return boolean True if user custom fields exist
     */
    protected function add_user_custom_fields_to_filters(&$filteroptions) {
        if($custom_fields = get_records('user_info_field','','','','id,shortname,name')) {
            foreach($custom_fields as $custom_field) {
                $field = $custom_field->shortname;
                $name = $custom_field->name;
                $key = "user_$field";
                $filteroptions[] = new rb_filter_option(
                    'user_profile',
                    $field,
                    $name,
                    'text'
                );
            }
            return true;
        }
        return false;
    }


    /*
     * Adds some common user field to the $filteroptions array
     *
     * @param array &$filteroptions Array of current filter options
     *                              Passed by reference and updated by
     *                              this method
     * @return True
     */
    protected function add_user_fields_to_filters(&$filteroptions) {
        // auto-generate filters for user fields
        $fields = array(
            'fullname' => "User's Full name",
            'firstname' => get_string('firstname'),
            'lastname' => get_string('lastname'),
            'username' => get_string('username'),
            'idnumber' => 'User ID Number',
        );
        foreach($fields as $field => $name) {
            $filteroptions[] = new rb_filter_option(
                'user',
                $field,
                $name,
                'text'
            );
        }
        return true;
    }

    /*
     * Adds some common user position filters to the $filteroptions array
     *
     * @param array &$columnoptions Array of current filter options
     *                              Passed by reference and updated by
     *                              this method
     * @return True
     */
    protected function add_position_fields_to_filters(&$filteroptions) {
        $filteroptions[] = new rb_filter_option(
            'user',
            'managername',
            "Manager's Name",
            'text'
        );
        $filteroptions[] = new rb_filter_option(
            'user',
            'title',
            "User's Job Title",
            'text'
        );
        $filteroptions[] = new rb_filter_option(
            'user',
            'organisationid',
            "Participant's Current Office",
            'select',
            array(
                'selectfunc' => 'organisations_list',
                'selectoptions' => rb_filter_option::select_width_limiter(),
            )
        );
        $filteroptions[] = new rb_filter_option(
            'user',
            'positionid',
            "Participant's Current Position",
            'select',
            array(
                'selectfunc' => 'positions_list',
                'selectoptions' => rb_filter_option::select_width_limiter(),
            )
        );
        return true;
    }

    /*
     * Adds some common course filters to the $filteroptions array
     *
     * @param array &$columnoptions Array of current filter options
     *                              Passed by reference and updated by
     *                              this method
     * @return True
     */
    protected function add_course_fields_to_filters(&$filteroptions) {
        $filteroptions[] = new rb_filter_option(
            'course',
            'fullname',
            'Course Name',
            'text'
        );
        $filteroptions[] = new rb_filter_option(
            'course',
            'shortname',
            'Course Short Name',
            'text'
        );
        $filteroptions[] = new rb_filter_option(
            'course',
            'idnumber',
            'Course ID Number',
            'text'
        );
        $filteroptions[] = new rb_filter_option(
            'course',
            'startdate',
            'Course Start Date',
            'date'
        );

        return true;
    }

    /*
     * Adds some common course category filters to the $filteroptions array
     *
     * @param array &$columnoptions Array of current filter options
     *                              Passed by reference and updated by
     *                              this method
     * @return True
     */
    protected function add_course_category_fields_to_filters(&$filteroptions) {
        $filteroptions[] = new rb_filter_option(
            'course_category',
            'id',
            'Course Category',
            'select',
            array(
                'selectfunc' => 'course_categories_list',
                'selectoptions' => rb_filter_option::select_width_limiter(),
            )
        );
        return true;
    }


} // end of rb_base_source class




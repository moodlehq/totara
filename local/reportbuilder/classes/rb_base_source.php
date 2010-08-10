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

        // basic sanity checking of joinlist
        $this->validate_joinlist();
    }


    /*
     * Check the joinlist for invalid dependencies and duplicate names
     *
     * @return True or throws exception if problem found
     */
    private function validate_joinlist() {
        $joinlist = $this->joinlist;
        $joins_used = array();

        // don't let source define join with same name as an SQL
        // reserved word
        $reserved_words = explode(', ', 'access, accessible, add, all, alter, analyse, analyze, and, any, array, as, asc, asensitive, asymmetric, audit, authorization, autoincrement, avg, backup, before, begin, between, bigint, binary, blob, both, break, browse, bulk, by, call, cascade, case, cast, change, char, character, check, checkpoint, close, cluster, clustered, coalesce, collate, column, comment, commit, committed, compress, compute, condition, confirm, connect, connection, constraint, contains, containstable, continue, controlrow, convert, count, create, cross, current, current_date, current_role, current_time, current_timestamp, current_user, cursor, database, databases, date, day_hour, day_microsecond, day_minute, day_second, dbcc, deallocate, dec, decimal, declare, default, deferrable, delayed, delete, deny, desc, describe, deterministic, disk, distinct, distinctrow, distributed, div, do, double, drop, dual, dummy, dump, each, else, elseif, enclosed, end, errlvl, errorexit, escape, escaped, except, exclusive, exec, execute, exists, exit, explain, external, false, fetch, file, fillfactor, float, float4, float8, floppy, for, force, foreign, freetext, freetexttable, freeze, from, full, fulltext, function, goto, grant, group, having, high_priority, holdlock, hour_microsecond, hour_minute, hour_second, identified, identity, identity_insert, identitycol, if, ignore, ilike, immediate, in, increment, index, infile, initial, initially, inner, inout, insensitive, insert, int, int1, int2, int3, int4, int8, integer, intersect, interval, into, is, isnull, isolation, iterate, join, key, keys, kill, leading, leave, left, level, like, limit, linear, lineno, lines, load, localtime, localtimestamp, lock, long, longblob, longtext, loop, low_priority, master_heartbeat_period, master_ssl_verify_server_cert, match, max, maxextents, mediumblob, mediumint, mediumtext, middleint, min, minus, minute_microsecond, minute_second, mirrorexit, mlslabel, mod, mode, modifies, modify, national, natural, new,' .
            ' no_write_to_binlog, noaudit, nocheck, nocompress, nonclustered, not, notnull, nowait, null, nullif, number, numeric, of, off, offline, offset, offsets, old, on, once, online, only, open, opendatasource, openquery, openrowset, openxml, optimize, option, optionally, or, order, out, outer, outfile, over, overlaps, overwrite, pctfree, percent, perm, permanent, pipe, pivot, placing, plan, precision, prepare, primary, print, prior, privileges, proc, procedure, processexit, public, purge, raid0, raiserror, range, raw, read, read_only, read_write, reads, readtext, real, reconfigure, references, regexp, release, rename, repeat, repeatable, replace, replication, require, resource, restore, restrict, return, returning, revoke, right, rlike, rollback, row, rowcount, rowguidcol, rowid, rownum, rows, rule, save, schema, schemas, second_microsecond, select, sensitive, separator, serializable, session, session_user, set, setuser, share, show, shutdown, similar, size, smallint, some, soname, spatial, specific, sql, sql_big_result, sql_calc_found_rows, sql_small_result, sqlexception, sqlstate, sqlwarning, ssl, start, starting, statistics, straight_join, successful, sum, symmetric, synonym, sysdate, system_user, table, tape, temp, temporary, terminated, textsize, then, tinyblob, tinyint, tinytext, to, top, trailing, tran, transaction, trigger, true, truncate, tsequal, uid, uncommitted, undo, union, unique, unlock, unsigned, update, updatetext, upgrade, usage, use, user, using, utc_date, utc_time, utc_timestamp, validate, values, varbinary, varchar, varchar2, varcharacter, varying, verbose, view, waitfor, when, whenever, where, while, with, work, write, writetext, x509, xor, year_month, zerofill');

        foreach($joinlist as $item) {
            // check join list for duplicate names
            if(in_array($item->name, $joins_used)) {
                throw new ReportBuilderException("Join name '" .
                    $item->name . "' used more than once in source");
            } else {
                $joins_used[] = $item->name;
            }

            if(in_array($item->name, $reserved_words)) {
                throw new ReportBuilderException("Join name '" .
                    $item->name . "' is an SQL reserved word. " .
                    ' Please rename the join');
            }
        }

        foreach($joinlist as $item) {
            // check that dependencies exist
            if(isset($item->dependencies) &&
                is_array($item->dependencies)) {

                foreach($item->dependencies as $dep) {
                    if($dep == 'base') {
                        continue;
                    }
                    if(!in_array($dep, $joins_used)) {
                        throw new ReportBuilderException("Join name '" .
                            $item->name . "' contains dependency '" .
                            $dep . "' that does not exist in joinlist.");
                    }
                }
            } else if (isset($item->dependencies) &&
                $item->dependencies != 'base') {

                if(!in_array($item->dependencies, $joins_used)) {
                    throw new ReportBuilderException("Join name '" .
                        $item->name . "' contains dependency '" .
                        $item->dependencies .
                        "' that does not exist in joinlist.");
                }
            }
        }
        return true;
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

    // convert an integer number of minutes into a
    // formatted duration (e.g. 90 mins => 1h 30m)
    function rb_display_hours_minutes($mins, $row) {
        if($mins === null) {
            return '';
        } else {
            $minutes = abs((int) $mins);
            $hours = floor($minutes / 60);
            $decimalMinutes = $minutes - floor($minutes/60) * 60;
            return sprintf("%dh %02.0fm", $hours, $decimalMinutes);
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


    /*
     * Adds the user table to the $joinlist array
     *
     * @param array &$joinlist Array of current join options
     *                         Passed by reference and updated to
     *                         include new table joins
     * @param string $join Name of the join that provides the
     *                     'user id' field
     * @param string $field Name of user id field to join on
     * @return boolean True
     */
    protected function add_user_table_to_joinlist(&$joinlist, $join, $field) {
        global $CFG;

        // join uses 'auser' as name because 'user' is a reserved keyword
        $joinlist[] = new rb_join(
            'auser',
            'LEFT',
            $CFG->prefix . 'user',
            "auser.id = $join.$field",
            REPORT_BUILDER_RELATION_ONE_TO_ONE,
            $join
        );
    }


     /*
     * Adds some common user field to the $columnoptions array
     *
     * @param array &$columnoptions Array of current column options
     *                              Passed by reference and updated by
     *                              this method
     * @param string $join Name of the join that provides the 'user' table
     *
     * @return True
     */
    protected function add_user_fields_to_columns(&$columnoptions,
        $join='auser') {

        $columnoptions[] = new rb_column_option(
            'user',
            'fullname',
            'User Fullname',
            sql_fullname("$join.firstname", "$join.lastname"),
            array('joins' => $join)
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'namelink',
            'User Fullname (linked to profile)',
            sql_fullname("$join.firstname", "$join.lastname"),
            array(
                'joins' => $join,
                'displayfunc' => 'link_user',
                'defaultheading' => 'User Fullname',
                'extrafields' => array('user_id' => "$join.id"),
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
                "$join.$field",
                array('joins' => $join)
            );
        }
        return true;
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
     * Adds any user profile fields to the $joinlist array
     *
     * @param array &$joinlist Array of current join options
     *                         Passed by reference and updated if
     *                         any user custom fields exist
     * @param string $join Name of join containing user id to join on
     * @param string $joinfield Name of user id field to join on
     * @return boolean True if user custom fields exist
     */
    protected function add_user_custom_fields_to_joinlist(&$joinlist,
        $join, $joinfield) {
        global $CFG;

        // add all user custom fields to join list
        if($custom_fields = get_records('user_info_field')) {
            foreach($custom_fields as $custom_field) {
                $field = $custom_field->shortname;
                $id = $custom_field->id;
                $key = "user_$field";
                $joinlist[] = new rb_join(
                    $key,
                    'LEFT',
                    $CFG->prefix . 'user_info_data',
                    "$key.userid = $join.$joinfield AND $key.fieldid = $id",
                    REPORT_BUILDER_RELATION_ONE_TO_ONE,
                    $join
                );
            }
            return true;
        }
        return false;
    }


    /*
     * Adds any user profile fields to the $columnoptions array
     *
     * @param array &$columnoptions Array of current column options
     *                              Passed by reference and updated if
     *                              any user custom fields exist
     * @return boolean True if user custom fields exist
     */
    protected function add_user_custom_fields_to_columns(&$columnoptions) {
        // auto-generate columns for each user custom field
        if($custom_fields =
            get_records('user_info_field')) {
            foreach($custom_fields as $custom_field) {
                $field = $custom_field->shortname;
                $name = $custom_field->name;
                $key = "user_$field";
                $columnoptions[] = new rb_column_option(
                    'user_profile',
                    $field,
                    $name,
                    "$key.data",
                    array('joins' => $key)
                );
            }
            return true;
        }
        return false;
    }


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
     * Adds the course table to the $joinlist array
     *
     * @param array &$joinlist Array of current join options
     *                         Passed by reference and updated to
     *                         include new table joins
     * @param string $join Name of the join that provides the
     *                     'course id' field
     * @param string $field Name of course id field to join on
     * @return boolean True
     */
    protected function add_course_table_to_joinlist(&$joinlist, $join, $field) {
        global $CFG;

        $joinlist[] = new rb_join(
            'course',
            'LEFT',
            $CFG->prefix . 'course',
            "course.id = $join.$field",
            REPORT_BUILDER_RELATION_ONE_TO_ONE,
            $join
        );
    }


    /*
     * Adds some common course info to the $columnoptions array
     *
     * @param array &$columnoptions Array of current column options
     *                              Passed by reference and updated by
     *                              this method
     * @param string $join Name of the join that provides the 'course' table
     *
     * @return True
     */
    protected function add_course_fields_to_columns(&$columnoptions, $join='course') {
        $columnoptions[] = new rb_column_option(
            'course',
            'fullname',
            'Course Name',
            "$join.fullname",
            array('joins' => $join)
        );
        $columnoptions[] = new rb_column_option(
            'course',
            'courselink',
            'Course Name (linked to course page)',
            "$join.fullname",
            array(
                'joins' => $join,
                'displayfunc' => 'link_course',
                'defaultheading' => 'Course Name',
                'extrafields' => array('course_id' => "$join.id")
            )
        );
        $columnoptions[] = new rb_column_option(
            'course',
            'shortname',
            'Course Shortname',
            "$join.shortname",
            array('joins' => $join)
        );
        $columnoptions[] = new rb_column_option(
            'course',
            'idnumber',
            'Course ID Number',
            "$join.idnumber",
            array('joins' => $join)
        );
        $columnoptions[] = new rb_column_option(
            'course',
            'id',
            'Course ID',
            "$join.id",
            array('joins' => $join)
        );
        $columnoptions[] = new rb_column_option(
            'course',
            'startdate',
            'Course Start Date',
            "$join.startdate",
            array(
                'joins' => $join,
                'displayfunc' => 'nice_date',
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
     * Adds the course_category table to the $joinlist array
     *
     * @param array &$joinlist Array of current join options
     *                         Passed by reference and updated to
     *                         include course_category
     * @param string $join Name of the join that provides the 'course' table
     * @param string $field Name of category id field to join on
     * @return boolean True
     */
    protected function add_course_category_table_to_joinlist(&$joinlist,
        $join, $field) {

        global $CFG;

        $joinlist[] = new rb_join(
            'course_category',
            'LEFT',
            $CFG->prefix . 'course_categories',
            "course_category.id = $join.$field",
            REPORT_BUILDER_RELATION_ONE_TO_ONE,
            $join
        );

        return true;
    }


    /*
     * Adds some common course category info to the $columnoptions array
     *
     * @param array &$columnoptions Array of current column options
     *                              Passed by reference and updated by
     *                              this method
     * @param string $catjoin Name of the join that provides the
     *                        'course_categories' table
     * @param string $coursejoin Name of the join that provides the
     *                           'course' table
     * @return True
     */
    protected function add_course_category_fields_to_columns(&$columnoptions,
        $catjoin='course_category', $coursejoin='course') {
        $columnoptions[] = new rb_column_option(
                'course_category',
                'name',
                'Course Category',
                "$catjoin.name",
                array('joins' => $catjoin)
        );
        $columnoptions[] = new rb_column_option(
                'course_category',
                'id',
                'Course Category ID',
                "$coursejoin.category",
                array('joins' => $coursejoin)
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


    /*
     * Adds the pos_assignment, pos and org tables to the $joinlist array
     *
     * @param array &$joinlist Array of current join options
     *                         Passed by reference and updated to
     *                         include new table joins
     * @param string $join Name of the join that provides the 'user' table
     * @param string $field Name of user id field to join on
     * @return boolean True
     */
    protected function add_position_tables_to_joinlist(&$joinlist,
        $join, $field) {

        global $CFG;

        // to get access to position type constants
        require_once($CFG->dirroot . '/hierarchy/type/position/lib.php');

        $joinlist[] =new rb_join(
            'position_assignment',
            'LEFT',
            $CFG->prefix . 'pos_assignment',
            "(position_assignment.userid = $join.$field AND " .
            'position_assignment.type = ' . POSITION_TYPE_PRIMARY . ')',
            REPORT_BUILDER_RELATION_ONE_TO_ONE,
            $join
        );

        $joinlist[] = new rb_join(
            'organisation',
            'LEFT',
            $CFG->prefix . 'org',
            'organisation.id = position_assignment.organisationid',
            REPORT_BUILDER_RELATION_ONE_TO_ONE,
            'position_assignment'
        );

        $joinlist[] = new rb_join(
            'position',
            'LEFT',
            $CFG->prefix . 'pos',
            'position.id = position_assignment.positionid',
            REPORT_BUILDER_RELATION_ONE_TO_ONE,
            'position_assignment'
        );

        return true;
    }


    /*
     * Adds some common user position info to the $columnoptions array
     *
     * @param array &$columnoptions Array of current column options
     *                              Passed by reference and updated by
     *                              this method
     * @param string $posassign Name of the join that provides the
     *                          'pos_assignment' table.
     * @param string $org Name of the join that provides the 'org' table.
     * @param string $pos Name of the join that provides the 'pos' table.
     *
     * @return True
     */
    protected function add_position_fields_to_columns(&$columnoptions,
        $posassign='position_assignment',
        $org='organisation', $pos='position') {

        $columnoptions[] = new rb_column_option(
            'user',
            'organisationid',
            "User's Organisation ID",
            "$posassign.organisationid",
            array('joins' => $posassign)
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'organisationpath',
            "User's Organisation Path IDs",
            "$org.path",
            array('joins' => $org)
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'organisation',
            "User's Organisation Name",
            "$org.fullname",
            array('joins' => $org)
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'positionid',
            "User's Position ID",
            "$posassign.positionid",
            array('joins' => $posassign)
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'positionpath',
            "User's Position Path IDs",
            "$pos.path",
            array('joins' => $pos)
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'position',
            "User's Position",
            "$pos.fullname",
            array('joins' => $pos)
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'title',
            "User's Job Title",
            "$posassign.fullname",
            array('joins' => $posassign)
        );
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
            'title',
            "User's Job Title",
            'text'
        );
        $filteroptions[] = new rb_filter_option(
            'user',
            'organisationid',
            "Participant's Current Office (basic)",
            'select',
            array(
                'selectfunc' => 'organisations_list',
                'selectoptions' => rb_filter_option::select_width_limiter(),
            )
        );
        $filteroptions[] = new rb_filter_option(
            'user',
            'organisationpath',
            "Participant's Current Organisation",
            'org'
        );
        $filteroptions[] = new rb_filter_option(
            'user',
            'positionid',
            "Participant's Current Position (basic)",
            'select',
            array(
                'selectfunc' => 'positions_list',
                'selectoptions' => rb_filter_option::select_width_limiter(),
            )
        );
        $filteroptions[] = new rb_filter_option(
            'user',
            'positionpath',
            "Participant's Current Position",
            'pos'
        );
        return true;
    }


    /*
     * Adds the manager_role_assignment and manager tables to the $joinlist
     * array
     *
     * @param array &$joinlist Array of current join options
     *                         Passed by reference and updated to
     *                         include new table joins
     * @param string $join Name of the join that provides the
     *                     'position_assignment' table
     * @param string $field Name of reportstoid field to join on
     * @return boolean True
     */
    protected function add_manager_tables_to_joinlist(&$joinlist,
        $join, $field) {

        global $CFG;

        // only include these joins if the manager role is defined
        if($managerroleid = get_field('role','id','shortname','manager')) {
            $joinlist[] = new rb_join(
                'manager_role_assignment',
                'LEFT',
                $CFG->prefix . 'role_assignments',
                "(manager_role_assignment.id = $join.$field" .
                    ' AND manager_role_assignment.roleid = ' .
                    $managerroleid . ')',
                REPORT_BUILDER_RELATION_ONE_TO_ONE,
                'position_assignment'
            );
            $joinlist[] = new rb_join(
                'manager',
                'LEFT',
                $CFG->prefix . 'user',
                'manager.id = manager_role_assignment.userid',
                REPORT_BUILDER_RELATION_ONE_TO_ONE,
                'manager_role_assignment'
            );
        }

        return true;
    }


    /*
     * Adds some common user manager info to the $columnoptions array
     *
     * @param array &$columnoptions Array of current column options
     *                              Passed by reference and updated by
     *                              this method
     * @param string $manager Name of the join that provides the
     *                          'manager' table.
     * @param string $org Name of the join that provides the 'org' table.
     * @param string $pos Name of the join that provides the 'pos' table.
     *
     * @return True
     */
    protected function add_manager_fields_to_columns(&$columnoptions,
        $manager='manager') {

        $columnoptions[] = new rb_column_option(
            'user',
            'managername',
            "User's Manager Name",
            sql_fullname("$manager.firstname","$manager.lastname"),
            array('joins' => $manager)
        );
        return true;
    }


    /*
     * Adds some common manager filters to the $filteroptions array
     *
     * @param array &$columnoptions Array of current filter options
     *                              Passed by reference and updated by
     *                              this method
     * @return True
     */
    protected function add_manager_fields_to_filters(&$filteroptions) {
        $filteroptions[] = new rb_filter_option(
            'user',
            'managername',
            "Manager's Name",
            'text'
        );
        return true;
    }


    /*
     * Adds the tags tables to the $joinlist array
     *
     * @param array &$joinlist Array of current join options
     *                         Passed by reference and updated to
     *                         include new table joins
     * @param string $join Name of the join that provides the
     *                     'course' table
     * @param string $field Name of course id field to join on
     * @return boolean True
     */
    protected function add_course_tags_tables_to_joinlist(&$joinlist,
        $join, $field) {

        global $CFG;

        $joinlist[] = new rb_join(
            'tagids',
            'LEFT',
            // subquery as table name
            "(SELECT crs.id AS cid, " .
                sql_group_concat('CAST(t.id AS varchar)','|') .
                " AS idlist FROM {$CFG->prefix}course crs
                LEFT JOIN {$CFG->prefix}tag_instance ti
                    ON crs.id=ti.itemid AND ti.itemtype='course'
                LEFT JOIN {$CFG->prefix}tag t
                    ON ti.tagid=t.id AND t.tagtype='official'
                GROUP BY crs.id)",
            "tagids.cid = $join.$field",
            REPORT_BUILDER_RELATION_ONE_TO_ONE,
            $join
        );

        // create a join for each official tag
        if($tags = get_records('tag', 'tagtype', 'official')) {
            foreach($tags as $tag) {
                $tagid = $tag->id;
                $name = "course_tag_$tagid";
                $joinlist[] = new rb_join(
                    $name,
                    'LEFT',
                    $CFG->prefix . 'tag_instance',
                    "($name.itemid = $join.$field AND $name.tagid = $tagid " .
                        "AND $name.itemtype='course')",
                    REPORT_BUILDER_RELATION_ONE_TO_ONE,
                    $join
                );
            }
        }

        return true;
    }

    /*
     * Adds some common course tag info to the $columnoptions array
     *
     * @param array &$columnoptions Array of current column options
     *                              Passed by reference and updated by
     *                              this method
     * @param string $manager Name of the join that provides the
     *                          'tagids' table.
     *
     * @return True
     */
    protected function add_course_tag_fields_to_columns(&$columnoptions,
        $tagids='tagids') {

        $columnoptions[] = new rb_column_option(
            'course',
            'tagids',
            "Course Tag IDs",
            "$tagids.idlist",
            array('joins' => $tagids)
        );

        // create a on/off field for every official tag
        if($tags = get_records('tag', 'tagtype', 'official')) {
            foreach($tags as $tag) {
                $tagid = $tag->id;
                $name = $tag->name;
                $join = "course_tag_$tagid";
                $columnoptions[] = new rb_column_option(
                    'tags',
                    $join,
                    "Tagged '$name'",
                    "CASE WHEN $join.id IS NOT NULL THEN 1 ELSE 0 END",
                    array(
                        'joins' => $join,
                        'displayfunc' => 'yes_no',
                    )
                );
            }
        }
        return true;
    }


    /*
     * Adds some common course tag filters to the $filteroptions array
     *
     * @param array &$columnoptions Array of current filter options
     *                              Passed by reference and updated by
     *                              this method
     * @return True
     */
    protected function add_course_tag_fields_to_filters(&$filteroptions) {

        // create a filter for every official tag
        if($tags = get_records('tag', 'tagtype', 'official')) {
            foreach($tags as $tag) {
                $tagid = $tag->id;
                $name = $tag->name;
                $join = "course_tag_$tagid";
                $filteroptions[] = new rb_filter_option(
                    'tags',
                    $join,
                    "Tagged '$name'",
                    'simpleselect',
                    array('selectchoices' => array(
                        1 => get_string('yes'), 0 => get_string('no'))
                    )
                );
            }
        }
        return true;
    }


} // end of rb_base_source class




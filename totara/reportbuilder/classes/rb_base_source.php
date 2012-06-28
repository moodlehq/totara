<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2012 Totara Learning Solutions LTD
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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage reportbuilder
 */

/**
 * Abstract base class to be extended to create report builder sources
 */
abstract class rb_base_source {

/**
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
        foreach ($properties as $property) {
            if (!property_exists($this, $property)) {
                $a = new stdClass();
                $a->property = $property;
                $a->class = get_class($this);
                throw new Exception(get_string('error:propertyxmustbesetiny', 'totara_reportbuilder', $a));
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
        foreach ($defaults as $property => $default) {
            if (!property_exists($this, $property)) {
                $this->$property = $default;
            } else if ($this->$property === null) {
                $this->$property = $default;
            }
        }

        // basic sanity checking of joinlist
        $this->validate_joinlist();
    }


    /**
     * Check the joinlist for invalid dependencies and duplicate names
     *
     * @return True or throws exception if problem found
     */
    private function validate_joinlist() {
        $joinlist = $this->joinlist;
        $joins_used = array();

        // don't let source define join with same name as an SQL
        // reserved word
        // from http://docs.moodle.org/en/XMLDB_reserved_words
        $reserved_words = explode(', ', 'access, accessible, add, all, alter, analyse, analyze, and, any, array, as, asc, asensitive, asymmetric, audit, authorization, autoincrement, avg, backup, before, begin, between, bigint, binary, blob, both, break, browse, bulk, by, call, cascade, case, cast, change, char, character, check, checkpoint, close, cluster, clustered, coalesce, collate, column, comment, commit, committed, compress, compute, condition, confirm, connect, connection, constraint, contains, containstable, continue, controlrow, convert, count, create, cross, current, current_date, current_role, current_time, current_timestamp, current_user, cursor, database, databases, date, day_hour, day_microsecond, day_minute, day_second, dbcc, deallocate, dec, decimal, declare, default, deferrable, delayed, delete, deny, desc, describe, deterministic, disk, distinct, distinctrow, distributed, div, do, double, drop, dual, dummy, dump, each, else, elseif, enclosed, end, errlvl, errorexit, escape, escaped, except, exclusive, exec, execute, exists, exit, explain, external, false, fetch, file, fillfactor, float, float4, float8, floppy, for, force, foreign, freetext, freetexttable, freeze, from, full, fulltext, function, goto, grant, group, having, high_priority, holdlock, hour_microsecond, hour_minute, hour_second, identified, identity, identity_insert, identitycol, if, ignore, ilike, immediate, in, increment, index, infile, initial, initially, inner, inout, insensitive, insert, int, int1, int2, int3, int4, int8, integer, intersect, interval, into, is, isnull, isolation, iterate, join, key, keys, kill, leading, leave, left, level, like, limit, linear, lineno, lines, load, localtime, localtimestamp, lock, long, longblob, longtext, loop, low_priority, master_heartbeat_period, master_ssl_verify_server_cert, match, max, maxextents, mediumblob, mediumint, mediumtext, middleint, min, minus, minute_microsecond, minute_second, mirrorexit, mlslabel, mod, mode, modifies, modify, national, natural, new,' .
            ' no_write_to_binlog, noaudit, nocheck, nocompress, nonclustered, not, notnull, nowait, null, nullif, number, numeric, of, off, offline, offset, offsets, old, on, once, online, only, open, opendatasource, openquery, openrowset, openxml, optimize, option, optionally, or, order, out, outer, outfile, over, overlaps, overwrite, pctfree, percent, perm, permanent, pipe, pivot, placing, plan, precision, prepare, primary, print, prior, privileges, proc, procedure, processexit, public, purge, raid0, raiserror, range, raw, read, read_only, read_write, reads, readtext, real, reconfigure, references, regexp, release, rename, repeat, repeatable, replace, replication, require, resource, restore, restrict, return, returning, revoke, right, rlike, rollback, row, rowcount, rowguidcol, rowid, rownum, rows, rule, save, schema, schemas, second_microsecond, select, sensitive, separator, serializable, session, session_user, set, setuser, share, show, shutdown, similar, size, smallint, some, soname, spatial, specific, sql, sql_big_result, sql_calc_found_rows, sql_small_result, sqlexception, sqlstate, sqlwarning, ssl, start, starting, statistics, straight_join, successful, sum, symmetric, synonym, sysdate, system_user, table, tape, temp, temporary, terminated, textsize, then, tinyblob, tinyint, tinytext, to, top, trailing, tran, transaction, trigger, true, truncate, tsequal, uid, uncommitted, undo, union, unique, unlock, unsigned, update, updatetext, upgrade, usage, use, user, using, utc_date, utc_time, utc_timestamp, validate, values, varbinary, varchar, varchar2, varcharacter, varying, verbose, view, waitfor, when, whenever, where, while, with, work, write, writetext, x509, xor, year_month, zerofill');

        foreach ($joinlist as $item) {
            // check join list for duplicate names
            if (in_array($item->name, $joins_used)) {
                $a = new stdClass();
                $a->join = $item->name;
                $a->source = get_class($this);
                throw new ReportBuilderException(get_string('error:joinxusedmorethanonceiny', 'totara_reportbuilder', $a));
            } else {
                $joins_used[] = $item->name;
            }

            if (in_array($item->name, $reserved_words)) {
                $a = new stdClass();
                $a->join = $item->name;
                $a->source = get_class($this);
                throw new ReportBuilderException(get_string('error:joinxisreservediny', 'totara_reportbuilder', $a));
            }
        }

        foreach ($joinlist as $item) {
            // check that dependencies exist
            if (isset($item->dependencies) &&
                is_array($item->dependencies)) {

                foreach ($item->dependencies as $dep) {
                    if ($dep == 'base') {
                        continue;
                    }
                    if (!in_array($dep, $joins_used)) {
                        $a = new stdClass();
                        $a->join = $item->name;
                        $a->source = get_class($this);
                        $a->dependency = $dep;
                        throw new ReportBuilderException(get_string('error:joinxhasdependencyyinz', 'totara_reportbuilder', $a));
                    }
                }
            } else if (isset($item->dependencies) &&
                $item->dependencies != 'base') {

                if (!in_array($item->dependencies, $joins_used)) {
                    $a = new stdClass();
                    $a->join = $item->name;
                    $a->source = get_class($this);
                    $a->dependency = $item->dependencies;
                    throw new ReportBuilderException(get_string('error:joinxhasdependencyyinz', 'totara_reportbuilder', $a));
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

    /**
     * Returns a new rb_column object based on a column option from this source
     *
     * If $heading is given use it for the heading property, otherwise use
     * the default heading property from the column option
     *
     * @param string $type The type of the column option to use
     * @param string $value The value of the column option to use
     * @param string $heading Heading for the new column
     * @param boolean $customheading True if the heading has been customised
     * @return object A new rb_column object with details copied from this
     *                rb_column_option
     */
    function new_column_from_option($type, $value, $heading=null, $customheading = true, $hidden=0) {
        $columnoptions = $this->columnoptions;
        $joinlist = $this->joinlist;
        if ($coloption =
            reportbuilder::get_single_item($columnoptions, $type, $value)) {

            // make sure joins are defined before adding column
            if (!reportbuilder::check_joins($joinlist, $coloption->joins)) {
                $a = new stdClass();
                $a->type = $coloption->type;
                $a->value = $coloption->value;
                $a->source = get_class($this);
                throw new ReportBuilderException(get_string('error:joinsfortypexandvalueynotfoundinz', 'totara_reportbuilder', $a));
            }

            if ($heading === null) {
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
                    'nosort' => $coloption->nosort,
                    'style' => $coloption->style,
                    'hidden' => $hidden,
                    'customheading' => $customheading,
                )
            );
        } else {
            $a = new stdClass();
            $a->type = $type;
            $a->value = $value;
            $a->source = get_class($this);
            throw new ReportBuilderException(get_string('error:columnoptiontypexandvalueynotfoundinz', 'totara_reportbuilder', $a));
        }
    }


    /**
     * Returns a new rb_filter object based on a filter option from this source
     *
     * If $advanced is given use it for the advanced property, otherwise use
     * the default advanced property from the filter option
     *
     * @param string $type The type of the filter option to use
     * @param string $value The value of the filter option to use
     * @param string $advanced If the filter should be an advanced option
     * @return object A new rb_filter object with details copied from this
     *                rb_filter_option
     */
    function new_filter_from_option($type, $value, $advanced=null) {
        $filteroptions = $this->filteroptions;
        $columnoptions = $this->columnoptions;
        $joinlist = $this->joinlist;

        if (!$filteroption =
            reportbuilder::get_single_item($filteroptions, $type, $value)) {

            $a = new stdClass();
            $a->type = $type;
            $a->value = $value;
            $a->source = get_class($this);
            throw new ReportBuilderException(get_string('error:filteroptiontypexandvalueynotfoundinz', 'totara_reportbuilder', $a));
        }
        if (!$columnoption =
            reportbuilder::get_single_item($columnoptions, $type, $value)) {

            $a = new stdClass();
            $a->type = $type;
            $a->value = $value;
            $a->source = get_class($this);
            throw new ReportBuilderException(get_string('error:columnoptiontypexandvalueynotfoundinz', 'totara_reportbuilder', $a));
        }

        // make sure joins are defined before adding column
        if (!reportbuilder::check_joins($joinlist, $columnoption->joins)) {
            $a = new stdClass();
            $a->type = $columnoption->type;
            $a->value = $columnoption->value;
            $a->source = get_class($this);
            throw new ReportBuilderException(get_string('error:joinsforfiltertypexandvalueynotfoundinz', 'totara_reportbuilder', $a));

        }

        if ($advanced === null) {
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


    /**
     * Reformat a timestamp into a date, showing nothing if invalid or null
     *
     * @param integer $date Unix timestamp
     * @param object $row Object containing all other fields for this row
     *
     * @return string Date in a nice format
     */
    function rb_display_nice_date($date, $row) {
        if ($date && $date > 0) {
            return userdate($date, get_string('strfdateshortmonth', 'langconfig'));
        } else {
            return '';
        }
    }

    /**
     * Reformat a timestamp into a time, showing nothing if invalid or null
     *
     * @param integer $date Unix timestamp
     * @param object $row Object containing all other fields for this row
     *
     * @return string Time in a nice format
     */
    function rb_display_nice_time($date, $row) {
        if ($date && $date > 0) {
            return userdate($date, get_string('strftimeshort', 'langconfig'));
        } else {
            return '';
        }
    }


    /**
     * Reformat a timestamp into a date and time, showing nothing if invalid or null
     *
     * @param integer $date Unix timestamp
     * @param object $row Object containing all other fields for this row
     *
     * @return string Date and time in a nice format
     */
    function rb_display_nice_datetime($date, $row) {
        if ($date && $date > 0) {
            return userdate($date, get_string('strfdateattime', 'langconfig'));
        } else {
            return '';
        }
    }

    /**
     * Reformat a timestamp into a date and time (including seconds), showing nothing if invalid or null
     *
     * @param integer $date Unix timestamp
     * @param object $row Object containing all other fields for this row
     *
     * @return string Date and time (including seconds) in a nice format
     */
    function rb_display_nice_datetime_seconds($date, $row) {
        if ($date && $date > 0) {
            return userdate($date, get_string('strftimedateseconds', 'langconfig'));
        } else {
            return '';
        }
    }

    /**
     * Convert 1 and 0 to 'Yes' and 'No'
     *
     * @param integer $value input value
     *
     * @return string yes or no, or null for values other than 1 or 0
     */
    function rb_display_yes_or_no($value, $row) {
        if ($value == 1) {
            return get_string('yes');
        } else if ($value == 0) {
            return get_string('no');
        } else {
            return '';
        }
    }


    /**
     * Convert first letters of each word to uppercase
     *
     * @param string $item A string to convert
     * @param object $row Object containing all other fields for this row
     *
     * @return string The string with words capitialized
     */
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
    function rb_display_link_user($user, $row, $isexport = false) {
        if ($isexport) {
            return $user;
        }

        $userid = $row->user_id;
        $url = new moodle_url('/user/view.php', array('id' => $userid));
        return html_writer::link($url, $user);
    }


    function rb_display_link_user_icon($user, $row, $isexport = false) {
        global $OUTPUT;

        if ($isexport) {
            return $user;
        }

        $userid = $row->user_id;
        $url = new moodle_url('/user/view.php', array('id' => $userid));

        $picuser = new stdClass();
        $picuser->id = $userid;
        $picuser->picture = $row->userpic_picture;
        $picuser->imagealt = $row->userpic_imagealt;
        $picuser->firstname = $row->userpic_firstname;
        $picuser->lastname = $row->userpic_lastname;
        $picuser->email = $row->userpic_email;


        return $OUTPUT->user_picture($picuser, array('courseid' => 1)) .
            "&nbsp;" . html_writer::link($url, $user);

    }

    /**
     * A rb_column_options->displayfunc helper function for showing a user's
     * profile picture
     * @param integer $itemid ID of the user
     * @param object $row The rest of the data for the row
     * @param boolean $isexport If the report is being exported or viewed
     * @return string
     */
    function rb_display_user_picture($itemid, $row, $isexport = false) {
        global $OUTPUT;

        $picuser = new stdClass();
        $picuser->id = $itemid;
        $picuser->picture = $row->userpic_picture;
        $picuser->imagealt = $row->userpic_imagealt;
        $picuser->firstname = $row->userpic_firstname;
        $picuser->lastname = $row->userpic_lastname;
        $picuser->email = $row->userpic_email;

        // don't show picture in spreadsheet
        if ($isexport) {
            return '';
        } else {
            return $OUTPUT->user_picture($picuser, array('courseid' => 1));
        }
    }


    // convert a course name into a link to that course
    function rb_display_link_course($course, $row, $isexport = false) {

        if ($isexport) {
            return format_string($course);
        }

        $courseid = $row->course_id;
        $attr = (isset($row->course_visible) && $row->course_visible == 0) ? array('class' => 'dimmed') : array();
        $url = new moodle_url('/course/view.php', array('id' => $courseid));
        return html_writer::link($url, $course, $attr);
    }

    // convert a course name into a link to that course and shows
    // the course icon next to it
    function rb_display_link_course_icon($course, $row, $isexport = false) {
        global $OUTPUT;

        if ($isexport) {
            return format_string($course);
        }

        $courseid = $row->course_id;
        $courseicon = !empty($row->course_icon) ? $row->course_icon : 'default';
        $cssclass = (isset($row->course_visible) && $row->course_visible == 0) ? 'dimmed' : '';
        $icon = $OUTPUT->pix_icon('/courseicons/'.$courseicon, $course, 'totara_core', array('class' => 'course_icon'));
        $link = $OUTPUT->action_link(
            new moodle_url('/course/view.php', array('id' => $courseid)),
            $icon . $course, null, array('class' => $cssclass)
        );
        return $link;
    }

    // display an icon based on the course icon field
    function rb_display_course_icon($icon, $row, $isexport = false) {
        global $OUTPUT;
        $icon = !empty($icon) ? $icon : 'default';

        if ($isexport) {
            return format_string($row->course_name);
        }

        $coursename = format_string($row->course_name);
        return $OUTPUT->pix_icon('/courseicons/' . $icon, $coursename, 'totara_core', array('class' => 'course_icon'));
    }

    // display an icon for the course type
    function rb_display_course_type_icon($type, $row, $isexport = false) {
        global $OUTPUT;

        if ($isexport) {
            // don't return icon if exporting to spreadsheet
            return '';
        }

        switch ($type) {
        case null:
            return null;
            break;
        case 0:
            $image = 'elearning';
            break;
        case 1:
            $image = 'blended';
            break;
        case 2:
            $image = 'facetoface';
            break;
        }
        $alt = get_string($image, 'rb_source_dp_course');
        $icon = $OUTPUT->pix_icon('/msgicons/' . $image . '-regular', $alt, 'totara_core', array('title' => $alt));

        return $icon;
    }

    // convert a course category name into a link to that category's page
    function rb_display_link_course_category($category, $row, $isexport = false) {

        if ($isexport) {
            return format_string($category);
        }

        $catid = $row->cat_id;
        $category = format_string($category);
        if ($catid == 0 || !$catid) {
            return '';
        }
        $attr = (isset($row->cat_visible) && $row->cat_visible == 0) ? array('class' => 'dimmed') : array();
        $url = new moodle_url('/course/category.php', array('id' => $catid));
        return html_writer::link($url, $category, $attr);
    }


    /**
     * Generate the plan title with a link to the plan
     * @param string $planname
     * @param object $row
     * @param boolean $isexport If the report is being exported or viewed
     * @return string
     */
    public function rb_display_planlink($planname, $row, $isexport = false) {

        // no text
        if (strlen($planname) == 0) {
            return '';
        }

        // invalid id - show without a link
        if (empty($row->plan_id)) {
            return $planname;
        }

        if ($isexport) {
            return $planname;
        }
        $url = new moodle_url('/totara/plan/view.php', array('id' => $row->plan_id));
        return html_writer::link($url, $planname);
    }


    /**
     * Display the plan's status (for use as a column displayfunc)
     *
     * @global object $CFG
     * @param int $status
     * @param object $row
     * @return string
     */
    public function rb_display_plan_status($status, $row) {
        global $CFG;
        require_once($CFG->dirroot . '/totara/plan/lib.php');

        switch ($status) {
            case DP_PLAN_STATUS_UNAPPROVED:
                return get_string('unapproved', 'totara_plan');
                break;
            case DP_PLAN_STATUS_APPROVED:
                return get_string('approved', 'totara_plan');
                break;
            case DP_PLAN_STATUS_COMPLETE:
                return get_string('complete', 'totara_plan');
                break;
        }
    }


    /**
     * Column displayfunc to convert a plan item's status to a
     * human-readable string
     *
     * @param int $status
     * @return string
     */
    public function rb_display_plan_item_status($status) {
        global $CFG;
        require_once($CFG->dirroot . '/totara/plan/lib.php');

        switch($status) {
        case DP_APPROVAL_DECLINED:
            return get_string('declined', 'totara_plan');
        case DP_APPROVAL_UNAPPROVED:
            return get_string('unapproved', 'totara_plan');
        case DP_APPROVAL_REQUESTED:
            return get_string('pendingapproval', 'totara_plan');
        case DP_APPROVAL_APPROVED:
            return get_string('approved', 'totara_plan');
        default:
            return '';
        }
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
        if ($mins === null) {
            return '';
        } else {
            $minutes = abs((int) $mins);
            $hours = floor($minutes / 60);
            $decimalMinutes = $minutes - floor($minutes/60) * 60;
            return sprintf("%dh %02.0fm", $hours, $decimalMinutes);
        }
    }

    // convert a 2 digit country code into the country name
    function rb_display_country_code($code, $row) {
        $countries = get_string_manager()->get_list_of_countries();

        if (isset($countries[$code])) {
            return $countries[$code];
        }
        return $code;
    }


    // convert a language code into text
    function rb_display_language_code($code, $row) {
        global $CFG;
        if (empty($code)) {
            return get_string('notspecified', 'totara_reportbuilder');
        }
        $countries = get_string_manager()->get_list_of_languages();
        if (!array_key_exists($code, $countries)) {
            return get_string('unknown', 'totara_reportbuilder');
        }

        return $countries[$code];
    }

    function rb_display_user_email($email, $row, $isexport = false) {
        if (empty($email)) {
            return '';
        }
        $maildisplay = $row->maildisplay;
        $emaildisabled = $row->emailstop;

        // respect users email privacy setting
        // at some point we may want to allow admins to view anyway
        if ($maildisplay != 1) {
            return get_string('useremailprivate', 'totara_reportbuilder');
        }

        if ($isexport) {
            return $email;
        } else {
            // obfuscate email to avoid spam if printing to page
            return obfuscate_mailto($email, '', (bool) $emaildisabled);
        }
    }


    function rb_display_link_program_icon($program, $row) {
        global $OUTPUT;
        $programid = $row->program_id;
        $programicon = $row->program_icon;
        $icon = $OUTPUT->pix_icon('/programicons/' . $programicon, $program, 'totara_core', array('class' => 'course_icon'));
        $link = $OUTPUT->action_link(
            new moodle_url('/totara/program/view.php', array('id' => $programid)),
            $icon . $program, null, array('class' => 'course_icon')
        );
        return $link;
    }


    // display grade along with passing grade if it is known
    function rb_display_grade_string($item, $row) {
        $passgrade = isset($row->gradepass) ? sprintf('%d', $row->gradepass) : null;
        $usergrade = sprintf('%d', $item);

        if ($item === null) {
            return '';
        } else if ($passgrade === null) {
            return "{$usergrade}%";
        } else {
            $a = new stdClass();
            $a->grade = $usergrade;
            $a->pass = $passgrade;
            return get_string('gradeandgradetocomplete', 'totara_reportbuilder', $a);
        }
    }

    //
    //
    // Generic select filter methods
    //
    //

    function rb_filter_yesno_list() {
        $yn = array();
        $yn['Yes'] = get_string('yes');
        $yn['No'] = get_string('no');
        return $yn;
    }

    function rb_filter_modules_list() {
        global $DB, $OUTPUT, $CFG;

        $out = array();
        $mods = $DB->get_records('modules', array('visible' => 1), 'id', 'id, name');
        foreach ($mods as $mod) {
            $modname = (get_string_manager()->string_exists('pluginname', $mod->name)) ?
                get_string('pluginname', $mod->name) : ucfirst($mod->name);

            if (file_exists($CFG->dirroot . '/mod/' . $mod->name . '/pix/icon.gif') ||
                file_exists($CFG->dirroot . '/mod/' . $mod->name . '/pix/icon.png')) {
                $icon = $OUTPUT->pix_icon('icon', $modname, $mod->name) . '&nbsp;';
            } else {
                $icon = '';
            }

            $out[$mod->name] = $icon . $modname;
        }
        return $out;
    }

    function rb_filter_organisations_list($contentmode, $contentoptions, $reportid) {
        global $CFG, $USER, $DB;

        require_once($CFG->dirroot . '/totara/hierarchy/lib.php');
        require_once($CFG->dirroot . '/totara/hierarchy/prefix/organisation/lib.php');

        // show all options if no content restrictions set
        if ($contentmode == REPORT_BUILDER_CONTENT_MODE_NONE) {
            $hierarchy = new organisation();
            $hierarchy->make_hierarchy_list($orgs, null, true, false);
            return $orgs;
        }

        $baseorg = null; // default to top of tree

        $localset = false;
        $nonlocal = false;
        // are enabled content restrictions local or not?
        if (isset($contentoptions) && is_array($contentoptions)) {
            foreach ($contentoptions as $option) {
                $name = $option->classname;
                $classname = 'rb_' . $name . '_content';
                if (class_exists($classname)) {
                    if ($name == 'completed_org' || $name == 'current_org') {
                        if (reportbuilder::get_setting($reportid, $classname,
                            'enable')) {
                            $localset = true;
                        }
                    } else {
                        if (reportbuilder::get_setting($reportid, $classname,
                            'enable')) {
                        $nonlocal = true;
                        }
                    }
                }
            }
        }

        if ($contentmode == REPORT_BUILDER_CONTENT_MODE_ANY) {
            if ($localset && !$nonlocal) {
                // only restrict the org list if all content restrictions are local ones
                if ($orgid = $DB->get_field('pos_assignment', 'organisationid', array('userid' => $USER->id))) {
                    $baseorg = $orgid;
                }
            }
        } else if ($contentmode == REPORT_BUILDER_CONTENT_MODE_ALL) {
            if ($localset) {
                // restrict the org list if any content restrictions are local ones
                if ($orgid = $DB->get_field('pos_assignment', 'organisationid', array('userid' => $USER->id))) {
                    $baseorg = $orgid;
                }
            }
        }

        $hierarchy = new organisation();
        $hierarchy->make_hierarchy_list($orgs, $baseorg, true, false);

        return $orgs;

    }

    function rb_filter_positions_list() {
        global $CFG;
        require_once($CFG->dirroot . '/totara/hierarchy/lib.php');
        require_once($CFG->dirroot . '/totara/hierarchy/prefix/position/lib.php');

        $hierarchy = new position();
        $hierarchy->make_hierarchy_list($positions, null, true, false);

        return $positions;

    }

    function rb_filter_course_categories_list() {
        global $CFG;
        require_once($CFG->dirroot . '/course/lib.php');
        make_categories_list($cats, $unused);

        return $cats;
    }


    function rb_filter_competency_type_list() {
        global $CFG;
        require_once($CFG->dirroot . '/totara/hierarchy/prefix/competency/lib.php');

        $competencyhierarchy = new competency();
        $unclassified_option = array(0 => get_string('unclassified', 'totara_hierarchy'));
        $typelist = $unclassified_option + $competencyhierarchy->get_types_list();

        return $typelist;
    }


    function rb_filter_position_type_list() {
        global $CFG;
        require_once($CFG->dirroot . '/totara/hierarchy/prefix/position/lib.php');

        $positionhierarchy = new position();
        $unclassified_option = array(0 => get_string('unclassified', 'totara_hierarchy'));
        $typelist = $unclassified_option + $positionhierarchy->get_types_list();

        return $typelist;
    }


    function rb_filter_organisation_type_list() {
        global $CFG;
        require_once($CFG->dirroot . '/totara/hierarchy/prefix/organisation/lib.php');

        $organisationhierarchy = new organisation();
        $unclassified_option = array(0 => get_string('unclassified', 'totara_hierarchy'));
        $typelist = $unclassified_option + $organisationhierarchy->get_types_list();

        return $typelist;
    }

    function rb_filter_course_languages() {
        global $DB;
        $out = array();
        $langs = $DB->get_records_sql("SELECT DISTINCT lang
            FROM {course} ORDER BY lang");
        foreach ($langs as $row) {
            $out[$row->lang] = $this->rb_display_language_code($row->lang, array());
        }

        return $out;
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
        global $DB;

        return $DB->sql_cast_char2int("AVG($field)*100.0");
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
        return sql_group_concat($field, html_writer::empty_tag('br'));
    }

    // return unique list items as single field, one per line
    function rb_group_list_unique($field) {
        return sql_group_concat($field, html_writer::empty_tag('br'), true);
    }

    // return list as single field, separated by a line with - on (in HTML)
    function rb_group_list_dash($field) {
        return sql_group_concat($field, html_writer::empty_tag('br') . '-' . html_writer::empty_tag('br'));
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


    /**
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

        // join uses 'auser' as name because 'user' is a reserved keyword
        $joinlist[] = new rb_join(
            'auser',
            'LEFT',
            '{user}',
            "auser.id = $join.$field",
            REPORT_BUILDER_RELATION_ONE_TO_ONE,
            $join
        );
    }


     /**
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
        global $DB;

        $columnoptions[] = new rb_column_option(
            'user',
            'fullname',
            get_string('userfullname', 'totara_reportbuilder'),
            $DB->sql_fullname("$join.firstname", "$join.lastname"),
            array('joins' => $join)
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'namelink',
            get_string('usernamelink', 'totara_reportbuilder'),
            $DB->sql_fullname("$join.firstname", "$join.lastname"),
            array(
                'joins' => $join,
                'displayfunc' => 'link_user',
                'defaultheading' => get_string('userfullname', 'totara_reportbuilder'),
                'extrafields' => array('user_id' => "$join.id"),
            )
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'namelinkicon',
            get_string('usernamelinkicon', 'totara_reportbuilder'),
            $DB->sql_fullname("$join.firstname", "$join.lastname"),
            array(
                'joins' => $join,
                'displayfunc' => 'link_user_icon',
                'defaultheading' => get_string('userfullname', 'totara_reportbuilder'),
                'extrafields' => array(
                    'user_id' => "$join.id",
                    'userpic_picture' => "$join.picture",
                    'userpic_firstname' => "$join.firstname",
                    'userpic_lastname' => "$join.lastname",
                    'userpic_email' => "$join.email",
                    'userpic_imagealt' => "$join.imagealt"
                ),
                'style' => array('white-space' => 'nowrap'),
            )
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'email',
            get_string('useremail', 'totara_reportbuilder'),
            // use CASE to include/exclude email in SQL
            // so search won't reveal hidden results
            "CASE WHEN $join.maildisplay <> 1 THEN '-' ELSE $join.email END",
            array(
                'joins' => $join,
                'displayfunc' => 'user_email',
                'extrafields' => array(
                    'emailstop' => "$join.emailstop",
                    'maildisplay' => "$join.maildisplay",
                )
            )
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'lastlogin',
            get_string('userlastlogin', 'totara_reportbuilder'),
            // See MDL-22481 for why currentlogin is used instead of lastlogin
            "$join.currentlogin",
            array(
                'joins' => $join,
                'displayfunc' => 'nice_date',
            )
        );
        // auto-generate columns for user fields
        $fields = array(
            'firstname' => get_string('userfirstname', 'totara_reportbuilder'),
            'lastname' => get_string('userlastname', 'totara_reportbuilder'),
            'username' => get_string('username', 'totara_reportbuilder'),
            'idnumber' => get_string('useridnumber', 'totara_reportbuilder'),
            'id' => get_string('userid', 'totara_reportbuilder'),
            'phone1' => get_string('userphone', 'totara_reportbuilder'),
            'institution' => get_string('userinstitution', 'totara_reportbuilder'),
            'department' => get_string('userdepartment', 'totara_reportbuilder'),
            'address' => get_string('useraddress', 'totara_reportbuilder'),
            'city' => get_string('usercity', 'totara_reportbuilder'),
        );
        foreach ($fields as $field => $name) {
            $columnoptions[] = new rb_column_option(
                'user',
                $field,
                $name,
                "$join.$field",
                array('joins' => $join)
            );
        }

        // add country option
        $columnoptions[] = new rb_column_option(
            'user',
            'country',
            get_string('usercountry', 'totara_reportbuilder'),
            "$join.country",
            array(
                'joins' => $join,
                'displayfunc' => 'country_code'
            )
        );

        return true;
    }


    /**
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
            'fullname' => get_string('userfullname', 'totara_reportbuilder'),
            'firstname' => get_string('firstname'),
            'lastname' => get_string('lastname'),
            'username' => get_string('username'),
            'idnumber' => get_string('useridnumber', 'totara_reportbuilder'),
            'phone1' => get_string('userphone', 'totara_reportbuilder'),
            'institution' => get_string('userinstitution', 'totara_reportbuilder'),
            'department' => get_string('userdepartment', 'totara_reportbuilder'),
            'address' => get_string('useraddress', 'totara_reportbuilder'),
            'city' => get_string('usercity', 'totara_reportbuilder'),
            'email' => get_string('useremail', 'totara_reportbuilder'),
        );
        foreach ($fields as $field => $name) {
            $filteroptions[] = new rb_filter_option(
                'user',
                $field,
                $name,
                'text'
            );
        }

        // pulldown with list of countries
        $select_width_options = rb_filter_option::select_width_limiter();
        $filteroptions[] = new rb_filter_option(
            'user',
            'country',
            get_string('usercountry', 'totara_reportbuilder'),
            'simpleselect',
            array(
                'selectchoices' => get_string_manager()->get_list_of_countries(),
                'selectoptions' => array_merge($select_width_options, array('datatype' => 'text')),
            )
        );

        return true;
    }


    /**
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
        global $DB;

        // add all user custom fields to join list
        $custom_fields = $DB->get_records('user_info_field');
        if (!empty($custom_fields)) {
            foreach ($custom_fields as $custom_field) {
                $id = $custom_field->id;
                $key = "user_$id";
                $joinlist[] = new rb_join(
                    $key,
                    'LEFT',
                    '{user_info_data}',
                    "$key.userid = $join.$joinfield AND $key.fieldid = $id",
                    REPORT_BUILDER_RELATION_ONE_TO_ONE,
                    $join
                );
            }
            return true;
        }
        return false;
    }


    /**
     * Adds any user profile fields to the $columnoptions array
     *
     * @param array &$columnoptions Array of current column options
     *                              Passed by reference and updated if
     *                              any user custom fields exist
     * @return boolean True if user custom fields exist
     */
    protected function add_user_custom_fields_to_columns(&$columnoptions) {
        global $DB;

        // auto-generate columns for each user custom field
        $custom_fields = $DB->get_records('user_info_field');
        if (!empty($custom_fields)) {
            foreach ($custom_fields as $custom_field) {
                $name = $custom_field->name;
                $key = "user_$custom_field->id";
                $columnoptions[] = new rb_column_option(
                    'user_profile',
                    $key,
                    $name,
                    "$key.data",
                    array('joins' => $key)
                );
            }
            return true;
        }
        return false;
    }


    /**
     * Adds any user profile fields to the $filteroptions array as text filters
     *
     * @param array &$filteroptions Array of current filter options
     *                              Passed by reference and updated if
     *                              any user custom fields exist
     * @return boolean True if user custom fields exist
     */
    protected function add_user_custom_fields_to_filters(&$filteroptions) {
        global $DB;

        $custom_fields = $DB->get_records('user_info_field', null, '', 'id, shortname, name');
        if (!empty($custom_fields)) {
            foreach ($custom_fields as $custom_field) {
                $name = $custom_field->name;
                $key = "user_$custom_field->id";
                $filteroptions[] = new rb_filter_option(
                    'user_profile',
                    $key,
                    $name,
                    'text'
                );
            }
            return true;
        }
        return false;
    }

    /**
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

        $joinlist[] = new rb_join(
            'course',
            'LEFT',
            '{course}',
            "course.id = $join.$field",
            REPORT_BUILDER_RELATION_ONE_TO_ONE,
            $join
        );
    }


    /**
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
        global $DB;

        $columnoptions[] = new rb_column_option(
            'course',
            'fullname',
            get_string('coursename', 'totara_reportbuilder'),
            "$join.fullname",
            array('joins' => $join)
        );
        $columnoptions[] = new rb_column_option(
            'course',
            'courselink',
            get_string('coursenamelinked', 'totara_reportbuilder'),
            "$join.fullname",
            array(
                'joins' => $join,
                'displayfunc' => 'link_course',
                'defaultheading' => get_string('coursename', 'totara_reportbuilder'),
                'extrafields' => array('course_id' => "$join.id", 'course_visible' => "$join.visible")
            )
        );
        $columnoptions[] = new rb_column_option(
            'course',
            'courselinkicon',
            get_string('coursenamelinkedicon', 'totara_reportbuilder'),
            "$join.fullname",
            array(
                'joins' => $join,
                'displayfunc' => 'link_course_icon',
                'defaultheading' => get_string('coursename', 'totara_reportbuilder'),
                'extrafields' => array(
                    'course_id' => "$join.id",
                    'course_icon' => "$join.icon",
                    'course_visible' => "$join.visible"
                )
            )
        );
        $columnoptions[] = new rb_column_option(
            'course',
            'icon',
            get_string('courseicon', 'totara_reportbuilder'),
            "$join.icon",
            array(
                'joins' => $join,
                'displayfunc' => 'course_icon',
                'defaultheading' => get_string('courseicon', 'totara_reportbuilder'),
                'extrafields' => array(
                    'course_name' => "$join.fullname",
                    'course_id' => "$join.id",
                )
            )
        );
        $columnoptions[] = new rb_column_option(
            'course',
            'shortname',
            get_string('courseshortname', 'totara_reportbuilder'),
            "$join.shortname",
            array('joins' => $join)
        );
        $columnoptions[] = new rb_column_option(
            'course',
            'idnumber',
            get_string('courseidnumber', 'totara_reportbuilder'),
            "$join.idnumber",
            array('joins' => $join)
        );
        $columnoptions[] = new rb_column_option(
            'course',
            'id',
            get_string('courseid', 'totara_reportbuilder'),
            "$join.id",
            array('joins' => $join)
        );
        $columnoptions[] = new rb_column_option(
            'course',
            'startdate',
            get_string('coursestartdate', 'totara_reportbuilder'),
            "$join.startdate",
            array(
                'joins' => $join,
                'displayfunc' => 'nice_date',
            )
        );
        $columnoptions[] = new rb_column_option(
            'course',
            'name_and_summary',
            get_string('coursenameandsummary', 'totara_reportbuilder'),
            // case used to merge even if one value is null
            "CASE WHEN $join.fullname IS NULL THEN $join.summary
                WHEN $join.summary IS NULL THEN $join.fullname
                ELSE " . $DB->sql_concat("$join.fullname", "'" . html_writer::empty_tag('br') . "'",
                    "$join.summary") . ' END',
            array(
                'joins' => $join,
            )
        );

        $columnoptions[] = new rb_column_option(
            'course',
            'coursetypeicon',
            get_string('coursetypeicon', 'totara_reportbuilder'),
            "$join.coursetype",
            array(
                'joins' => $join,
                'displayfunc' => 'course_type_icon',
                'defaultheading' => get_string('coursetypeicon', 'totara_reportbuilder'),
            )
        );
        // add language option
        $columnoptions[] = new rb_column_option(
            'course',
            'language',
            get_string('courselanguage', 'totara_reportbuilder'),
            "$join.lang",
            array(
                'joins' => $join,
                'displayfunc' => 'language_code'
            )
        );

        return true;
    }


    /**
     * Adds some common course filters to the $filteroptions array
     *
     * @param array &$filteroptions Array of current filter options
     *                              Passed by reference and updated by
     *                              this method
     * @return True
     */
    protected function add_course_fields_to_filters(&$filteroptions) {
        $filteroptions[] = new rb_filter_option(
            'course',
            'fullname',
            get_string('coursename', 'totara_reportbuilder'),
            'text'
        );
        $filteroptions[] = new rb_filter_option(
            'course',
            'shortname',
            get_string('courseshortname', 'totara_reportbuilder'),
            'text'
        );
        $filteroptions[] = new rb_filter_option(
            'course',
            'idnumber',
            get_string('courseidnumber', 'totara_reportbuilder'),
            'text'
        );
        $filteroptions[] = new rb_filter_option(
            'course',
            'startdate',
            get_string('coursestartdate', 'totara_reportbuilder'),
            'date'
        );
        $filteroptions[] = new rb_filter_option(
            'course',
            'name_and_summary',
            get_string('coursenameandsummary', 'totara_reportbuilder'),
            'textarea'
        );
        $filteroptions[] = new rb_filter_option(
            'course',
            'language',
            get_string('courselanguage', 'totara_reportbuilder'),
            'select',
            array(
                'selectfunc' => 'course_languages',
                'selectoptions' => rb_filter_option::select_width_limiter(),
            )
        );
        return true;
    }



    /**
     * Adds the program table to the $joinlist array
     *
     * @param array &$joinlist Array of current join options
     *                         Passed by reference and updated to
     *                         include new table joins
     * @param string $join Name of the join that provides the
     *                     'program id' field
     * @param string $field Name of table containing program id field to join on
     * @return boolean True
     */
    protected function add_program_table_to_joinlist(&$joinlist, $join, $field) {

        $joinlist[] = new rb_join(
            'program',
            'LEFT',
            '{prog}',
            "program.id = $join.$field",
            REPORT_BUILDER_RELATION_ONE_TO_ONE,
            $join
        );
    }


    /**
     * Adds some common program info to the $columnoptions array
     *
     * @param array &$columnoptions Array of current column options
     *                              Passed by reference and updated by
     *                              this method
     * @param string $join Name of the join that provides the 'program' table
     *
     * @return True
     */
    protected function add_program_fields_to_columns(&$columnoptions, $join='program') {
        global $DB;

        $columnoptions[] = new rb_column_option(
            'prog',
            'fullname',
            get_string('programname', 'totara_program'),
            "$join.fullname",
            array('joins' => $join)
        );
        $columnoptions[] = new rb_column_option(
            'prog',
            'shortname',
            get_string('programshortname', 'totara_program'),
            "$join.shortname",
            array('joins' => $join)
        );
        $columnoptions[] = new rb_column_option(
            'prog',
            'idnumber',
            get_string('programidnumber', 'totara_program'),
            "$join.idnumber",
            array('joins' => $join)
        );
        $columnoptions[] = new rb_column_option(
            'prog',
            'id',
            get_string('programid', 'totara_program'),
            "$join.id",
            array('joins' => $join)
        );
        $columnoptions[] = new rb_column_option(
            'prog',
            'summary',
            get_string('programsummary', 'totara_program'),
            $DB->sql_compare_text("$join.summary"),
            array('joins' => $join)
        );
        $columnoptions[] = new rb_column_option(
            'prog',
            'availablefrom',
            get_string('availablefrom', 'totara_program'),
            $DB->sql_compare_text("$join.availablefrom"),
            array(
                'joins' => $join,
                'displayfunc' => 'nice_date'
            )
        );
        $columnoptions[] = new rb_column_option(
            'prog',
            'availableuntil',
            get_string('availableuntil', 'totara_program'),
            $DB->sql_compare_text("$join.availableuntil"),
            array(
                'joins' => $join,
                'displayfunc' => 'nice_date'
            )
        );
        $columnoptions[] = new rb_column_option(
            'prog',
            'proglinkicon',
            get_string('prognamelinkedicon', 'totara_program'),
            "$join.fullname",
            array(
                'joins' => $join,
                'displayfunc' => 'link_program_icon',
                'defaultheading' => get_string('programname', 'totara_program'),
                'extrafields' => array(
                    'program_id' => "$join.id",
                    'program_icon' => "$join.icon"
                )
            )
        );
        return true;
    }

    /**
     * Adds some common program filters to the $filteroptions array
     *
     * @param array &$filteroptions Array of current filter options
     *                              Passed by reference and updated by
     *                              this method
     * @return True
     */
    protected function add_program_fields_to_filters(&$filteroptions) {
        $filteroptions[] = new rb_filter_option(
            'prog',
            'fullname',
            get_string('programname', 'totara_program'),
            'text'
        );
        $filteroptions[] = new rb_filter_option(
            'prog',
            'shortname',
            get_string('programshortname', 'totara_program'),
            'text'
        );
        $filteroptions[] = new rb_filter_option(
            'prog',
            'idnumber',
            get_string('programidnumber', 'totara_program'),
            'text'
        );
        $filteroptions[] = new rb_filter_option(
            'prog',
            'summary',
            get_string('programsummary', 'totara_program'),
            'textarea'
        );
        $filteroptions[] = new rb_filter_option(
            'prog',
            'availablefrom',
            get_string('availablefrom', 'totara_program'),
            'date'
        );
        $filteroptions[] = new rb_filter_option(
            'prog',
            'availableuntil',
            get_string('availableuntil', 'totara_program'),
            'date'
        );
        return true;
    }

    /**
     * Adds any course custom fields to the $joinlist array
     *
     * @param array &$joinlist Array of current join options
     *                         Passed by reference and updated if
     *                         any course custom fields exist
     * @param string $join Name of join containing course id to join on
     * @param string $joinfield Name of course id field to join on
     * @return boolean True if course custom fields exist
     */
    protected function add_course_custom_fields_to_joinlist(&$joinlist,
        $join, $joinfield) {
        global $DB;

        // add all course custom fields to join list
        $custom_fields = $DB->get_records('course_info_field');
        if (!empty($custom_fields)) {
            foreach ($custom_fields as $custom_field) {
                $id = $custom_field->id;
                $key = "course_$custom_field->id";
                $joinlist[] = new rb_join(
                    $key,
                    'LEFT',
                    '{course_info_data}',
                    "$key.courseid = $join.$joinfield AND $key.fieldid = $id",
                    REPORT_BUILDER_RELATION_ONE_TO_ONE,
                    $join
                );
            }
            return true;
        }
        return false;
    }


    /**
     * Adds any course custom fields to the $columnoptions array
     *
     * @param array &$columnoptions Array of current column options
     *                              Passed by reference and updated if
     *                              any course custom fields exist
     * @return boolean True if course custom fields exist
     */
    protected function add_course_custom_fields_to_columns(&$columnoptions) {
        global $DB;

        // auto-generate columns for each course custom field
        $custom_fields = $DB->get_records('course_info_field');
        if (!empty($custom_fields)) {
            foreach ($custom_fields as $custom_field) {
                $name = $custom_field->fullname;
                $key = "course_$custom_field->id";
                $columnoptions[] = new rb_column_option(
                    'course_custom_fields',
                    $key,
                    $name,
                    "$key.data",
                    array('joins' => $key)
                );
            }
            return true;
        }
        return false;
    }


    /**
     * Adds any course custom fields to the $filteroptions array as text filters
     *
     * @param array &$filteroptions Array of current filter options
     *                              Passed by reference and updated if
     *                              any course custom fields exist
     * @return boolean True if course custom fields exist
     */
    protected function add_course_custom_fields_to_filters(&$filteroptions) {
        global $DB;

        $custom_fields = $DB->get_records('course_info_field', null, '', 'id, shortname, fullname');
        if (!empty($custom_fields)) {
            foreach ($custom_fields as $custom_field) {
                $name = $custom_field->fullname;
                $key = "course_$custom_field->id";
                $filteroptions[] = new rb_filter_option(
                    'course_custom_fields',
                    $key,
                    $name,
                    'text'
                );
            }
            return true;
        }
        return false;
    }



    /**
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

        $joinlist[] = new rb_join(
            'course_category',
            'LEFT',
            '{course_categories}',
            "course_category.id = $join.$field",
            REPORT_BUILDER_RELATION_MANY_TO_ONE,
            $join
        );

        return true;
    }


    /**
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
                get_string('coursecategory', 'totara_reportbuilder'),
                "$catjoin.name",
                array('joins' => $catjoin)
        );
        $columnoptions[] = new rb_column_option(
                'course_category',
                'namelink',
                get_string('coursecategorylinked', 'totara_reportbuilder'),
                "$catjoin.name",
                array(
                    'joins' => $catjoin,
                    'displayfunc' => 'link_course_category',
                    'defaultheading' => get_string('category', 'totara_reportbuilder'),
                    'extrafields' => array('cat_id' => "$catjoin.id", 'cat_visible' => "$catjoin.visible")
                )
        );
        $columnoptions[] = new rb_column_option(
                'course_category',
                'id',
                get_string('coursecategoryid', 'totara_reportbuilder'),
                "$coursejoin.category",
                array('joins' => $coursejoin)
        );
        return true;
    }


    /**
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
            get_string('coursecategory', 'totara_reportbuilder'),
            'select',
            array(
                'selectfunc' => 'course_categories_list',
                'selectoptions' => rb_filter_option::select_width_limiter(),
            )
        );
        return true;
    }


    /**
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
        require_once($CFG->dirroot . '/totara/hierarchy/prefix/position/lib.php');

        $joinlist[] =new rb_join(
            'position_assignment',
            'LEFT',
            '{pos_assignment}',
            "(position_assignment.userid = $join.$field AND " .
            'position_assignment.type = ' . POSITION_TYPE_PRIMARY . ')',
            REPORT_BUILDER_RELATION_ONE_TO_ONE,
            $join
        );

        $joinlist[] = new rb_join(
            'organisation',
            'LEFT',
            '{org}',
            'organisation.id = position_assignment.organisationid',
            REPORT_BUILDER_RELATION_ONE_TO_ONE,
            'position_assignment'
        );

        $joinlist[] = new rb_join(
            'position',
            'LEFT',
            '{pos}',
            'position.id = position_assignment.positionid',
            REPORT_BUILDER_RELATION_ONE_TO_ONE,
            'position_assignment'
        );

        $joinlist[] = new rb_join(
                'pos_type',
                'LEFT',
                '{pos_type}',
                'position.typeid = pos_type.id',
                REPORT_BUILDER_RELATION_ONE_TO_ONE,
                'position'
        );

        $joinlist[] = new rb_join(
                'org_type',
                'LEFT',
                '{org_type}',
                'organisation.typeid = org_type.id',
                REPORT_BUILDER_RELATION_ONE_TO_ONE,
                'organisation'
        );

        return true;
    }


    /**
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
            get_string('usersorgid', 'totara_reportbuilder'),
            "$posassign.organisationid",
            array('joins' => $posassign, 'selectable' => false)
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'organisationpath',
            get_string('usersorgpathids', 'totara_reportbuilder'),
            "$org.path",
            array('joins' => $org, 'selectable' => false)
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'organisation',
            get_string('usersorgname', 'totara_reportbuilder'),
            "$org.fullname",
            array('joins' => $org)
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'org_type',
            get_string('organisationtype', 'totara_reportbuilder'),
            'org_type.fullname',
            array(
                'joins' => 'org_type'
            )
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'org_type_id',
            get_string('organisationtypeid', 'totara_reportbuilder'),
            'organisation.typeid',
            array('joins' => $org, 'selectable' => false)
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'positionid',
            get_string('usersposid', 'totara_reportbuilder'),
            "$posassign.positionid",
            array('joins' => $posassign, 'selectable' => false)
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'positionpath',
            get_string('userspospathids', 'totara_reportbuilder'),
            "$pos.path",
            array('joins' => $pos, 'selectable' => false)
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'position',
            get_string('userspos', 'totara_reportbuilder'),
            "$pos.fullname",
            array('joins' => $pos)
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'pos_type',
            get_string('positiontype', 'totara_reportbuilder'),
            'pos_type.fullname',
            array(
                'joins' => 'pos_type'
            )
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'pos_type_id',
            get_string('positiontypeid', 'totara_reportbuilder'),
            'position.typeid',
            array('joins' => $pos, 'selectable' => false)
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'title',
            get_string('usersjobtitle', 'totara_reportbuilder'),
            "$posassign.fullname",
            array('joins' => $posassign)
        );
        return true;
    }


    /**
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
            get_string('usersjobtitle', 'totara_reportbuilder'),
            'text'
        );
        $filteroptions[] = new rb_filter_option(
            'user',
            'organisationid',
            get_string('participantscurrentorgbasic', 'totara_reportbuilder'),
            'select',
            array(
                'selectfunc' => 'organisations_list',
                'selectoptions' => rb_filter_option::select_width_limiter(),
            )
        );
        $filteroptions[] = new rb_filter_option(
            'user',
            'organisationpath',
            get_string('participantscurrentorg', 'totara_reportbuilder'),
            'org'
        );
        $filteroptions[] = new rb_filter_option(
            'user',
            'positionid',
            get_string('participantscurrentposbasic', 'totara_reportbuilder'),
            'select',
            array(
                'selectfunc' => 'positions_list',
                'selectoptions' => rb_filter_option::select_width_limiter(),
            )
        );
        $filteroptions[] = new rb_filter_option(
            'user',
            'positionpath',
            get_string('participantscurrentpos', 'totara_reportbuilder'),
            'pos'
        );
        $filteroptions[] = new rb_filter_option(
                'user',
                'pos_type_id',
                get_string('positiontype', 'totara_reportbuilder'),
                'select',
                array(
                    'selectfunc' => 'position_type_list',
                    'selectoptions' => rb_filter_option::select_width_limiter(),
                )
        );
        $filteroptions[] = new rb_filter_option(
                'user',
                'org_type_id',
                get_string('organisationtype', 'totara_reportbuilder'),
                'select',
                array(
                    'selectfunc' => 'organisation_type_list',
                    'selectoptions' => rb_filter_option::select_width_limiter(),
                )
        );

        return true;
    }

    /**
     * Converts a list to an array given a list and a separator
     * duplicate values are ignored
     *
     * Example;
     * list_to_array('some-thing-some', '-'); =>
     * array('some' => 'some', 'thing' => 'thing');
     *
     * @param string $list List of items
     * @param string $sep Symbol or string that separates list items
     * @return array $result array of list items
     */
    function list_to_array($list, $sep) {
        $result = array();
        $base = explode($sep, $list);
        if (!empty($base)) {
            $result = array_combine($base, $base);
        }
        return $result;
    }

    /**
     * Generic function for adding custom hierarchy fields to the reports
     * Intentionally optimized into one function to reduce number of db queries
     *
     * @param string $cf_prefix - prefix for custom field table e.g. everything before '_info_field' or '_info_data'
     * @param string $join - join table in joinlist used as a link to main query
     * @param string $joinfield - joinfield in data table used to link with main table
     * @param array $joinlist - array of joins passed by reference
     * @param array $columnoptions - array of columnoptions, passed by reference
     * @param array $filteroptions - array of filters, passed by reference
     */
    protected function add_custom_fields_for($cf_prefix, $join, $joinfield,
        array &$joinlist, array &$columnoptions, array &$filteroptions) {

        global $DB;

        $seek = false;
        foreach ($joinlist as $object) {
            $seek = ($object->name == $join);
            if ($seek) {
                break;
            }
        }
        if (!$seek) {
            throw new ReportBuilderException("Missing dependency table in joinlist: {$join}!");
        }

        // build the table names for this sort of custom field data
        $fieldtable = $cf_prefix.'_info_field';
        $datatable = $cf_prefix.'_info_data';

        // check if there are any visible custom fields of this type
        $items = $DB->get_recordset($fieldtable, array('hidden' => '0'));
        if (empty($items)) {
            $items->close();
            return false;
        }

        $selfunc = rb_filter_option::select_width_limiter();
        foreach ($items as $record) {
            $id   = $record->id;
            $joinname = "{$cf_prefix}_{$id}";
            $value = "custom_field_{$id}";
            $name = $record->fullname;
            $column_options = array('joins' => $joinname);
            $datatype = 'text';
            $filter_options = array();

            if ($record->datatype == 'menu') {
                $datatype = 'simpleselect';
                $filter_options['selectchoices'] = $this->list_to_array($record->param1, "\n");
                $filter_options['selectoptions'] = array('datatype' => 'text');
            }

            if ($record->datatype == 'checkbox') {
                $datatype = 'simpleselect';
                $filter_options['selectchoices'] = array(0 => get_string('no'), 1 => get_string('yes'));
                $filter_options['selectoptions'] = array('datatype' => 'text');
                $column_options['displayfunc'  ] = 'yes_no';
            }

            $joinlist[] = new rb_join($joinname,
                                      'LEFT',
                                      "{{$datatable}}",
                                      "{$joinname}.{$joinfield} = {$join}.id AND {$joinname}.fieldid = {$id}",
                                      REPORT_BUILDER_RELATION_ONE_TO_ONE,
                                      $join
                                      );
            $columnoptions[] = new rb_column_option($cf_prefix,
                                                     $value,
                                                     $name,
                                                     "{$joinname}.data",
                                                     $column_options
                                                     );
            $filteroptions[] = new rb_filter_option( $cf_prefix,
                                                     $value,
                                                     $name,
                                                     $datatype,
                                                     $filter_options
                                                     );

        }

        $items->close();

        return true;

    }

    /**
     *
     * Add's custom organisation fields to the report
     *
     * @param array $joinlist
     * @param array $columnoptions
     * @param array $filteroptions
     * @return boolean
     */
    protected function add_custom_organisation_fields(array &$joinlist, array &$columnoptions,
        array &$filteroptions) {
        return $this->add_custom_fields_for('org_type',
                                            'organisation',
                                            'organisationid',
                                            $joinlist,
                                            $columnoptions,
                                            $filteroptions);
    }

    /**
     *
     * Add's custom position fields to the report
     *
     * @param array $joinlist
     * @param array $columnoptions
     * @param array $filteroptions
     * @return boolean
     */
    protected function add_custom_position_fields(array &$joinlist, array &$columnoptions,
        array &$filteroptions) {
        return $this->add_custom_fields_for('pos_type',
                                            'position',
                                            'positionid',
                                            $joinlist,
                                            $columnoptions,
                                            $filteroptions);

    }

    /**
     *
     * Add's custom competency fields to the report
     *
     * @param array $joinlist
     * @param array $columnoptions
     * @param array $filteroptions
     * @return boolean
     */
    protected function add_custom_competency_fields(array &$joinlist, array &$columnoptions,
        array &$filteroptions) {
        return $this->add_custom_fields_for('comp_type',
                                            'competency',
                                            'competencyid',
                                            $joinlist,
                                            $columnoptions,
                                            $filteroptions);

    }

    /**
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
        if ($managerroleid = $CFG->managerroleid) {
            $joinlist[] = new rb_join(
                'manager_role_assignment',
                'LEFT',
                '{role_assignments}',
                "(manager_role_assignment.id = $join.$field" .
                    ' AND manager_role_assignment.roleid = ' .
                    $managerroleid . ')',
                REPORT_BUILDER_RELATION_ONE_TO_ONE,
                'position_assignment'
            );
            $joinlist[] = new rb_join(
                'manager',
                'LEFT',
                '{user}',
                'manager.id = manager_role_assignment.userid',
                REPORT_BUILDER_RELATION_ONE_TO_ONE,
                'manager_role_assignment'
            );
        }

        return true;
    }


    /**
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
        global $DB;

        $columnoptions[] = new rb_column_option(
            'user',
            'managername',
            get_string('usersmanagername', 'totara_reportbuilder'),
            $DB->sql_fullname("$manager.firstname", "$manager.lastname"),
            array('joins' => $manager)
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'managerid',
            get_string('usersmanagerid', 'totara_reportbuilder'),
            "$manager.id",
            array('joins' => $manager)
        );
        $columnoptions[] = new rb_column_option(
            'user',
            'manageridnumber',
            get_string('usersmanageridnumber', 'totara_reportbuilder'),
            "$manager.idnumber",
            array('joins' => $manager)
        );
        return true;
    }


    /**
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
            get_string('managername', 'totara_reportbuilder'),
            'text'
        );
        $filteroptions[] = new rb_filter_option(
            'user',
            'managerid',
            get_string('usersmanagerid', 'totara_reportbuilder'),
            'number'
        );
        $filteroptions[] = new rb_filter_option(
            'user',
            'manageridnumber',
            get_string('usersmanageridnumber', 'totara_reportbuilder'),
            'text'
        );
        return true;
    }


    /**
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

        global $DB;

        $joinlist[] = new rb_join(
            'tagids',
            'LEFT',
            // subquery as table name
            "(SELECT crs.id AS cid, " .
                sql_group_concat(sql_cast2char('t.id'), '|') .
                " AS idlist FROM {course} crs
                LEFT JOIN {tag_instance} ti
                    ON crs.id = ti.itemid AND ti.itemtype = 'course'
                LEFT JOIN {tag} t
                    ON ti.tagid = t.id AND t.tagtype = 'official'
                GROUP BY crs.id)",
            "tagids.cid = $join.$field",
            REPORT_BUILDER_RELATION_ONE_TO_ONE,
            $join
        );

        // create a join for each official tag
        $tags = $DB->get_records('tag', array('tagtype' => 'official'));
        foreach ($tags as $tag) {
            $tagid = $tag->id;
            $name = "course_tag_$tagid";
            $joinlist[] = new rb_join(
                $name,
                'LEFT',
                '{tag_instance}',
                "($name.itemid = $join.$field AND $name.tagid = $tagid " .
                    "AND $name.itemtype = 'course')",
                REPORT_BUILDER_RELATION_ONE_TO_ONE,
                $join
            );
        }

        return true;
    }

    /**
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
        global $DB;

        $columnoptions[] = new rb_column_option(
            'course',
            'tagids',
            get_string('coursetagids', 'totara_reportbuilder'),
            "$tagids.idlist",
            array('joins' => $tagids, 'selectable' => false)
        );

        // create a on/off field for every official tag
        $tags = $DB->get_records('tag', array('tagtype' => 'official'));
        foreach ($tags as $tag) {
            $tagid = $tag->id;
            $name = $tag->name;
            $join = "course_tag_$tagid";
            $columnoptions[] = new rb_column_option(
                'tags',
                $join,
                get_string('taggedx', 'totara_reportbuilder', $name),
                "CASE WHEN $join.id IS NOT NULL THEN 1 ELSE 0 END",
                array(
                    'joins' => $join,
                    'displayfunc' => 'yes_no',
                )
            );
        }
        return true;
    }


    /**
     * Adds some common course tag filters to the $filteroptions array
     *
     * @param array &$columnoptions Array of current filter options
     *                              Passed by reference and updated by
     *                              this method
     * @return True
     */
    protected function add_course_tag_fields_to_filters(&$filteroptions) {
        global $DB;

        // create a filter for every official tag
        $tags = $DB->get_records('tag', array('tagtype' => 'official'));
        foreach ($tags as $tag) {
            $tagid = $tag->id;
            $name = $tag->name;
            $join = "course_tag_{$tagid}";
            $filteroptions[] = new rb_filter_option(
                'tags',
                $join,
                get_string('taggedx', 'totara_reportbuilder', $name),
                'simpleselect',
                array('selectchoices' => array(
                    1 => get_string('yes'), 0 => get_string('no'))
                )
            );
        }
        return true;
    }


} // end of rb_base_source class




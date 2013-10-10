<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2013 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
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
 * @author Russell England <russell.england@catalyst-eu.net>
 * @package totara
 * @subpackage completionimpot
 */

defined('MOODLE_INTERNAL') || die;

// TCI = Totara Completion Import
define('TCI_SOURCE_EXTERNAL', 0);
define('TCI_SOURCE_UPLOAD', 1);

define('TCI_CSV_DELIMITER', '"'); // Default for fgetcsv() although the naming in fgetcsv is the wrong way around IMHO
define('TCI_CSV_SEPARATOR', 'comma'); // Default for fgetcsv() although the naming in fgetcsv is the wrong way around IMHO
define('TCI_CSV_DATE_FORMAT', 'Y-m-d'); // Default date format
define('TCI_CSV_ENCODING', 'UTF8'); // Default file encoding

/**
 * Returns a 3 character prefix for a temporary file name
 *
 * @param string $importname
 * @return string 3 character prefix
 */
function get_tempprefix($importname) {
    $prefix = array(
        'course' => 'cou',
        'certification'  => 'cer'
    );
    return $prefix[$importname];
}

/**
 * Returns an array of column names for the specific import
 *
 * @param string $importname
 * @return array column names
 */
function get_columnnames($importname) {
    $columns = array();
    $columns['course'] = array(
        'username',
        'courseshortname',
        'courseidnumber',
        'completiondate',
        'grade'
    );
    $columns['certification'] = array(
        'username',
        'certificationshortname',
        'certificationidnumber',
        'completiondate'
    );
    return $columns[$importname];
}

/**
 * Returns the import table name for a specific import
 *
 * @param string $importname
 * @return string tablename
 */
function get_tablename($importname) {
    $tablenames = array(
        'course' => 'totara_compl_import_course',
        'certification' => 'totara_compl_import_cert'
    );
    return $tablenames[$importname];
}

/**
 * Returns the standard filter for the import table and related parameters
 *
 * @global object $USER
 * @param int $importtime time() of the import
 * @param string $alias alias to use
 * @return array array($sql, $params)
 */
function get_importsqlwhere($importtime, $alias = 'i.') {
    global $USER;
    $sql = "WHERE {$alias}importuserid = :userid
            AND {$alias}timecreated = :timecreated
            AND {$alias}importerror = 0
            AND {$alias}timeupdated = 0
            AND {$alias}importevidence = 0 ";
    $params = array('userid' => $USER->id, 'timecreated' => $importtime);
    return array($sql, $params);
}

/**
 * Gets the config value, sets the value if it doesn't exist
 *
 * @param string $pluginname name of plugin
 * @param string $configname name of config value
 * @param mixed $default config value
 * @return mixed either the current config value or the default
 */
function get_default_config($pluginname, $configname, $default) {
    $configvalue = get_config($pluginname, $configname);
    if ($configvalue == null) {
        $configvalue = $default;
        set_config($configname, $configvalue, $pluginname);
    }
    return $configvalue;
}

/**
 * Checks the fields in the first line of the csv file, for required columns or unknown columns
 *
 * @global object $CFG
 * @param string $filename name of file to open
 * @param string $importname name of import
 * @param array $columnnames column names to check
 * @return array of errors, blank if no errors
 */
function check_fields_exist($filename, $importname) {
    global $CFG;

    require_once($CFG->libdir . '/csvlib.class.php');
    require_once($CFG->libdir . '/textlib.class.php');

    $errors = array();
    $pluginname = 'totara_completionimport_' . $importname;
    $columnnames = get_columnnames($importname);

    $csvdelimiter = get_default_config($pluginname, 'csvdelimiter', TCI_CSV_DELIMITER);
    $csvseparator = csv_import_reader::get_delimiter(get_default_config($pluginname, 'csvseparator', TCI_CSV_SEPARATOR));
    $csvencoding = get_default_config($pluginname, 'csvencoding', TCI_CSV_ENCODING);

    if (!is_readable($filename)) {
        $errors[] = get_string('unreadablefile', 'totara_completionimport', $filename);
    } else if (!$handle = fopen($filename, 'r')) {
        $errors[] = get_string('erroropeningfile', 'totara_completionimport', $filename);
    } else {
        // Read the first line
        $csvfields = fgetcsv($handle, 0, $csvseparator, $csvdelimiter);
        if (empty($csvfields)) {
            $errors[] = get_string('emptyfile', 'totara_completionimport', $filename);
        } else {
            // Clean and convert to UTF-8 and check for unknown field
            foreach ($csvfields as $key => $value) {
                $csvfields[$key] = clean_param(trim($value), PARAM_TEXT);
                $csvfields[$key] = textlib::convert($value, $csvencoding, 'utf-8');
                if (!in_array($value, $columnnames)) {
                    $field = new stdClass();
                    $field->filename = $filename;
                    $field->columnname = $value;
                    $errors[] = get_string('unknownfield', 'totara_completionimport', $field);
                }
            }

            // Check for required fields
            foreach ($columnnames as $columnname) {
                if (!in_array($columnname, $csvfields)) {
                    $field = new stdClass();
                    $field->filename = $filename;
                    $field->columnname = $columnname;
                    $errors[] = get_string('missingfield', 'totara_completionimport', $field);
                }
            }
        }
        fclose($handle);
    }
    return $errors;
}

/**
 * Imports csv data into the relevant import table
 *
 * Doesn't do any sanity checking of data at the stage, its a simple import
 *
 * @global object $CFG
 * @global object $DB
 * @param string $tempfilename full name of csv file to open
 * @param string $importname name of import
 * @param int $importtime time of run
 */
function import_csv($tempfilename, $importname, $importtime) {
    global $CFG, $DB, $USER;

    require_once($CFG->libdir . '/csvlib.class.php');
    require_once($CFG->dirroot . '/totara/completionimport/csv_iterator.php');

    $tablename = get_tablename($importname);
    $columnnames = get_columnnames($importname);

    $pluginname = 'totara_completionimport_' . $importname;
    $csvdelimiter = get_default_config($pluginname, 'csvdelimiter', TCI_CSV_DELIMITER);
    $csvseparator = csv_import_reader::get_delimiter(get_default_config($pluginname, 'csvseparator', TCI_CSV_SEPARATOR));
    $csvencoding = get_default_config($pluginname, 'csvencoding', TCI_CSV_ENCODING);

    // Assume that file checks and column name checks have already been done
    $importcsv = new csv_iterator($tempfilename, $csvseparator, $csvdelimiter, $csvencoding, $columnnames, $importtime);
    $DB->insert_records_via_batch($tablename, $importcsv);

    // Remove any empty rows at the end of the import file
    // But leave empty rows in the middle for error reporting
    // Here mainly because of a PHP bug in csv_iterator
    // but also to remove any unneccessary empty lines at the end of the csv file
    $sql = "SELECT id, rownumber
            FROM {{$tablename}}
            WHERE importuserid = :userid
            AND timecreated = :timecreated
            AND " . $DB->sql_compare_text('importerrormsg') . " = :importerrormsg
            ORDER BY id DESC";
    $params = array('userid' => $USER->id, 'timecreated' => $importtime, 'importerrormsg' => 'emptyrow;');
    $emptyrows = $DB->get_records_sql($sql, $params);
    $rownumber = 0;
    $deleteids = array();
    foreach ($emptyrows as $emptyrow) {
        if ($rownumber == 0) {
            $rownumber = $emptyrow->rownumber;
        } else if (--$rownumber != $emptyrow->rownumber) {
            // Not at the end any more
            break;
        }
        $deleteids[] = $emptyrow->id;
    }

    if (!empty($deleteids)) {
        list($deletewhere, $deleteparams) = $DB->get_in_or_equal($deleteids);
        $DB->delete_records_select($tablename, 'id ' . $deletewhere, $deleteparams);
    }
}

/**
 * Sanity check on data imported from the csv file
 *
 * @global object $DB
 * @param string $importname name of import
 * @param int $importtime time of this import
 */
function import_data_checks($importname, $importtime) {
    global $DB;

    list($sqlwhere, $stdparams) = get_importsqlwhere($importtime, '');

    $shortnamefield = $importname . 'shortname';
    $idnumberfield = $importname . 'idnumber';

    $tablename = get_tablename($importname);
    $columnnames = get_columnnames($importname);
    $pluginname = 'totara_completionimport_' . $importname;
    $csvdateformat = get_default_config($pluginname, 'csvdateformat', TCI_CSV_DATE_FORMAT);

    if (in_array('username', $columnnames)) {
        // Blank User names
        $params = array_merge($stdparams, array('errorstring' => 'blankusername;'));
        $sql = "UPDATE {{$tablename}}
                SET importerrormsg = " . $DB->sql_concat('importerrormsg', ':errorstring') . "
                {$sqlwhere}
                AND " . $DB->sql_isempty($tablename, 'username', true, false);
        $DB->execute($sql, $params);

        // Missing User names
        $params = array_merge($stdparams, array('errorstring' => 'usernamenotfound;'));
        $sql = "UPDATE {{$tablename}}
                SET importerrormsg = " . $DB->sql_concat('importerrormsg', ':errorstring') . "
                {$sqlwhere}
                AND " . $DB->sql_isnotempty($tablename, 'username', true, false) . "
                AND NOT EXISTS (SELECT {user}.id FROM {user} WHERE {user}.username = {{$tablename}}.username)";
        $DB->execute($sql, $params);
    }

    if (in_array('completiondate', $columnnames)) {
        // Blank completion date
        $params = array_merge($stdparams, array('errorstring' => 'blankcompletiondate;'));
        $sql = "UPDATE {{$tablename}}
                SET importerrormsg = " . $DB->sql_concat('importerrormsg', ':errorstring') . "
                {$sqlwhere}
                AND " . $DB->sql_isempty($tablename, 'completiondate', true, false);
        $DB->execute($sql, $params);

        // Check for invalid completion date
        if (!empty($csvdateformat)) {
            // There is a date format so check it
            $sql = "SELECT id, completiondate
                    FROM {{$tablename}}
                    {$sqlwhere}
                    AND " . $DB->sql_isnotempty($tablename, 'completiondate', true, false);

            $timecompleteds = $DB->get_recordset_sql($sql, $stdparams);
            if ($timecompleteds->valid()) {
                foreach ($timecompleteds as $timecompleted) {
                    if (!totara_date_parse_from_format($csvdateformat, $timecompleted->completiondate)) {
                        $sql = "UPDATE {{$tablename}}
                                SET importerrormsg = " . $DB->sql_concat('importerrormsg', ':errorstring') . "
                                WHERE id = :importid";
                        $DB->execute($sql, array('errorstring' => 'invalidcompletiondate;', 'importid' => $timecompleted->id));
                    }
                }
            }
            $timecompleteds->close();
        }
    }

    if (in_array('grade', $columnnames)) {
        /**
         * @todo - not sure if the grade is mandatory? Can it be blank?
         */
        // Blank grade
        $params = array_merge($stdparams, array('errorstring' => 'blankgrade;'));
        $sql = "UPDATE {{$tablename}}
                SET importerrormsg = " . $DB->sql_concat('importerrormsg', ':errorstring') . "
                {$sqlwhere}
                AND " . $DB->sql_isempty($tablename, 'grade', true, false);
        $DB->execute($sql, $params);
    }

    // Duplicates
    if (in_array($importname . 'username', $columnnames) && in_array($shortnamefield, $columnnames)
            && in_array($idnumberfield, $columnnames)) {
        $sql = "SELECT " . $DB->sql_concat('username', $shortnamefield, $idnumberfield) . " AS uniqueid,
                    username,
                    {$shortnamefield},
                    {$idnumberfield},
                    COUNT(*) AS count
                FROM {{$tablename}}
                {$sqlwhere}
                GROUP BY username, {$shortnamefield}, {$idnumberfield}
                HAVING COUNT(*) > 1";
        $duplicategroups = $DB->get_recordset_sql($sql, $stdparams);
        if ($duplicategroups->valid()) {
            foreach ($duplicategroups as $duplicategroup) {
                // Keep the first record, consider the others as duplicates
                $sql = "SELECT id
                        FROM {{$tablename}}
                        {$sqlwhere}
                        AND username = :username
                        AND {$shortnamefield} = :shortname
                        AND {$idnumberfield} = :idnumber
                        ORDER BY id";
                $params = array(
                        'username' => $duplicategroup->username,
                        'shortname' => $duplicategroup->$shortnamefield,
                        'idnumber' => $duplicategroup->$idnumberfield
                    );
                $params = array_merge($stdparams, $params);
                $keepid = $DB->get_field_sql($sql, $params, IGNORE_MULTIPLE);

                $params['keepid'] = $keepid;
                $params['errorstring'] = 'duplicate;';
                $sql = "UPDATE {{$tablename}}
                        SET importerrormsg = " . $DB->sql_concat('importerrormsg', ':errorstring') . "
                        {$sqlwhere}
                        AND id <> :keepid
                        AND username = :username
                        AND {$shortnamefield} = :shortname
                        AND {$idnumberfield} = :idnumber";
                $DB->execute($sql, $params);
            }
        }
        $duplicategroups->close();
    }

    if (in_array($shortnamefield, $columnnames) && in_array($idnumberfield, $columnnames)) {
        // Blank shortname and id number
        $params = array_merge($stdparams, array('errorstring' => $importname . 'blankrefs;'));
        $sql = "UPDATE {{$tablename}}
                SET importerrormsg = " . $DB->sql_concat('importerrormsg', ':errorstring') . "
                {$sqlwhere}
                AND " . $DB->sql_isempty($tablename, $shortnamefield, true, false) . "
                AND " . $DB->sql_isempty($tablename, $idnumberfield, true, false);
        $DB->execute($sql, $params);

        if (in_array($importname, array('course'))) {
            // Course exists but there is no manual enrol record
            $params = array('enrolname' => 'manual', 'errorstring' => 'nomanualenrol;');
            $params = array_merge($stdparams, $params);
            $notemptyshortname = $DB->sql_isnotempty($tablename, "{{$tablename}}.{$shortnamefield}", true, false);
            $sql = "UPDATE {{$tablename}}
                    SET importerrormsg = " . $DB->sql_concat('importerrormsg', ':errorstring') . "
                    {$sqlwhere}
                    AND EXISTS (SELECT {course}.id
                                FROM {course}
                                WHERE (CASE WHEN {$notemptyshortname}
                                        THEN {course}.shortname = {{$tablename}}.{$shortnamefield}
                                        ELSE {course}.idnumber = {{$tablename}}.{$idnumberfield}
                                    END))
                    AND NOT EXISTS (SELECT {enrol}.id
                                FROM {enrol}
                                JOIN {course} ON {course}.id = {enrol}.courseid
                                WHERE {enrol}.enrol = :enrolname
                                AND (CASE WHEN {$notemptyshortname}
                                        THEN {course}.shortname = {{$tablename}}.{$shortnamefield}
                                        ELSE {course}.idnumber = {{$tablename}}.{$idnumberfield}
                                    END))";
            $DB->execute($sql, $params);
        }

    }

    // Set import error so we ignore any records that have an error message from above
    $params = array_merge($stdparams, array('importerror' => 1));
    $sql = "UPDATE {{$tablename}}
            SET importerror = :importerror
            {$sqlwhere}
            AND " . $DB->sql_isnotempty($tablename, 'importerrormsg', true, true); // Note text = true
    $DB->execute($sql, $params);

}

/**
 * Generic function for creating evidence from mismatched courses / certifications.
 *
 * @global object $DB
 * @global object $USER
 * @param string $importname name of import
 * @param int $importtime time of import
 */
function create_evidence($importname, $importtime) {
    global $DB;

    list($sqlwhere, $params) = get_importsqlwhere($importtime);

    $tablename = get_tablename($importname);
    $shortnamefield = $importname . 'shortname';
    $idnumberfield = $importname . 'idnumber';

    if ($importname == 'course') {
        // Add any missing courses to other training (evidence)
        $sql = "SELECT i.id as importid, u.id userid, i.{$shortnamefield}, i.{$idnumberfield}, i.completiondate, i.grade
                FROM {{$tablename}} i
                JOIN {user} u ON u.username = i.username
                {$sqlwhere}
                  AND NOT EXISTS (SELECT c.id
                                FROM {course} c
                                WHERE (CASE WHEN " . $DB->sql_isnotempty($tablename, "i." . $shortnamefield, true, false) . "
                                            THEN c.shortname = i.{$shortnamefield}
                                            ELSE c.idnumber = i.{$idnumberfield}
                                        END))";
    } else if ($importname == 'certification') {
        // Add any missing certifications to other training (evidence)
        $sql = "SELECT i.id as importid, u.id userid, i.{$shortnamefield},  i.{$idnumberfield}, i.completiondate
                FROM {{$tablename}} i
                JOIN {user} u ON u.username = i.username
                LEFT JOIN {prog} p ON
                        (CASE WHEN " . $DB->sql_isnotempty($tablename, "i." . $shortnamefield, true, false) . "
                            THEN p.shortname = i.{$shortnamefield}
                            ELSE p.idnumber = i.{$idnumberfield}
                        END)
                        AND p.certifid IS NOT NULL
                {$sqlwhere}
                AND p.id IS NULL";
    }

    $extraparams = array();
    $pluginname = 'totara_completionimport_' . $importname;
    // Note the order of these must match the order of parameters in create_evidence_item()
    $extraparams['evidencetype'] = get_default_config($pluginname, 'evidencetype', null);
    $extraparams['csvdateformat'] = get_default_config($pluginname, 'csvdateformat', TCI_CSV_DATE_FORMAT);
    $extraparams['tablename'] = $tablename;
    $extraparams['shortnamefield'] = $shortnamefield;
    $extraparams['idnumberfield'] = $idnumberfield;
    $extraparams['importname'] = $importname;

    $evidences = $DB->get_recordset_sql($sql, $params);
    $DB->insert_records_via_batch('dp_plan_evidence', $evidences, 'create_evidence_item', $extraparams);
    $evidences->close();
}

/**
 * Processor for insert batch iterator
 *
 * @global object $USER
 * @global object $DB
 * @param object $item record object
 * @param int $evidencetype default evidence type
 * @param string $csvdateformat csv date format
 * @param string $tablename name of import table
 * @param string $shortnamefield name of short name field, either certificationshortname or courseshortname
 * @param string $idnumberfield name of id number, either certificationidnumber or courseidnumber
 * @return object $data record to insert
 */
function create_evidence_item($item, $evidencetype, $csvdateformat, $tablename, $shortnamefield, $idnumberfield, $importname) {
    global $USER, $DB;

    $timecompleted = null;
    $timestamp = totara_date_parse_from_format($csvdateformat, $item->completiondate);
    if (!empty($timestamp)) {
        $timecompleted = $timestamp;
    }

    $itemname = '';
    if (!empty($item->$shortnamefield)) {
        $itemname = get_string('evidence_shortname_' . $importname, 'totara_completionimport', $item->$shortnamefield);
    } else if (!empty($item->$idnumberfield)) {
        $itemname = get_string('evidence_idnumber_' . $importname, 'totara_completionimport', $item->$idnumberfield);
    }

    $description = '';
    foreach ($item as $field => $value) {
        if (!in_array($field, array('userid'))) {
            $description .= html_writer::tag('p', get_string('evidence_' . $field, 'totara_completionimport', $value));
        }
    }

    $data = new stdClass();
    $data->name = $itemname;
    $data->description = $description;
    $data->datecompleted = $timecompleted;
    $data->evidencetypeid = $evidencetype;
    $data->timemodified = time();
    $data->userid = $item->userid;
    $data->timecreated = $data->timemodified;
    $data->usermodified = $USER->id;
    $data->readonly = 1;

    $update = new stdClass();
    $update->id = $item->importid;
    $update->timeupdated = time();
    $update->importevidence = 1;
    $DB->update_record($tablename, $update, true);

    return $data;
}

/**
 * Import the course completion data
 *
 * 1. Gets records from the import table that have no errors or haven't gone to evidence
 * 2. Bulk enrol users - used enrol_cohort_sync() in /enrol/cohort/locallib.php as a reference
 * 3. Course completion stuff copied from process_course_completion_crit_compl()
 *    and process_course_completions() both in /backup/moodle2/restore_stepslib.php
 * @global object $DB
 * @global object $CFG
 * @param string $importname name of import
 * @param int $importtime time of import
 * @return array
 */
function import_course($importname, $importtime) {
    global $DB, $CFG;

    require_once($CFG->libdir . '/enrollib.php'); // Used for enroling users on courses

    $errors = array();
    $updateids = array();
    $users = array();
    $completions = array();
    $completion_history = array();

    $pluginname = 'totara_completionimport_' . $importname;
    $csvdateformat = get_default_config($pluginname, 'csvdateformat', TCI_CSV_DATE_FORMAT);

    list($sqlwhere, $params) = get_importsqlwhere($importtime);
    $params['enrolname'] = 'manual';

    $tablename = get_tablename($importname);

    $sql = "SELECT i.id as importid,
                    i.completiondate,
                    i.grade,
                    c.id as courseid,
                    u.id as userid,
                    e.id as enrolid,
                    ue.id as userenrolid,
                    ue.status as userenrolstatus,
                    cc.id as coursecompletionid,
                    cc.timestarted,
                    cc.timeenrolled
            FROM {{$tablename}} i
            JOIN {user} u ON u.username = i.username
            JOIN {course} c ON
                (CASE WHEN " . $DB->sql_isnotempty($tablename, 'i.courseshortname', true, false) . "
                    THEN c.shortname = i.courseshortname
                    ELSE c.idnumber = i.courseidnumber
                END)
            JOIN {enrol} e ON e.courseid = c.id AND e.enrol = :enrolname
            LEFT JOIN {user_enrolments} ue ON (ue.enrolid = e.id AND ue.userid = u.id)
            LEFT JOIN {course_completions} cc ON cc.userid = u.id AND cc.course = c.id
            {$sqlwhere}
            ORDER BY e.id, i.rownumber"; // Note order by enrolid

    $courses = $DB->get_recordset_sql($sql, $params);
    if ($courses->valid()) {
        $plugin = enrol_get_plugin('manual');
        $timestart = mktime(date('Y', $importtime), date('m', $importtime), date('d', $importtime), 0, 0, 0);
        $timeend = 0;
        $enrolcount = 1;
        $enrolid = 0;

        foreach ($courses as $course) {
            if (empty($enrolid) || ($enrolid != $course->enrolid) || (($enrolcount++ % BATCH_INSERT_MAX_ROW_COUNT) == 0)) {
                // New enrol record or reached the next batch insert
                if (!empty($users)) {
                    // Batch enrol users
                    $plugin->enrol_user_bulk($instance, $users, $instance->roleid, $timestart, $timeend);
                    $enrolcount = 0;
                    unset($users);
                    $users = array();
                }

                if (!empty($completions)) {
                    // Batch import completions
                    $DB->insert_records_via_batch('course_completions', $completions);
                    unset($completions);
                    $completions = array();
                }

                if (!empty($completion_history)) {
                    // Batch import completions.
                    $DB->insert_records_via_batch('course_completion_history', $completion_history);
                    unset($completion_history);
                    $completion_history = array();
                }

                if (!empty($updateids)) {
                    // Update the timeupdated
                    list($insql, $params) = $DB->get_in_or_equal($updateids, SQL_PARAMS_NAMED, 'param');
                    $params['timeupdated'] = $importtime;
                    $sql = "UPDATE {{$tablename}}
                            SET timeupdated = :timeupdated
                            WHERE id {$insql}";
                    $DB->execute($sql, $params);
                    unset($updateids);
                    $updateids = array();
                }

                // Reset enrol instance after enroling the users
                $enrolid = $course->enrolid;
                $instance = $DB->get_record('enrol', array('id' => $enrolid));
            }

            $timecompleted = null;
            $timestamp = totara_date_parse_from_format($csvdateformat, $course->completiondate);
            if (!empty($timestamp)) {
                $timecompleted = $timestamp;
            }

            $timeenrolled = $course->timeenrolled;
            $timestarted = $course->timestarted;

            if (empty($course->userenrolid) || ($course->userenrolstatus == ENROL_USER_SUSPENDED)) {
                // User isn't already enrolled or has been suspended, so add them to the enrol list
                $user = new stdClass();
                $user->userid = $course->userid;
                $users[] = $user;
                $timeenrolled = $timecompleted;
                $timestarted = $timecompleted;
            } else if (!empty($timecompleted)) {
                // Best guess at enrollment times
                if (($timeenrolled > $timecompleted) || (empty($timeenrolled))) {
                    $timeenrolled = $timecompleted;
                }
                if (($timestarted > $timecompleted) || (empty($timestarted))) {
                    $timestarted = $timecompleted;
                }
            }

            if (empty($course->coursecompletionid)) {
                // New record
                $completion = new stdClass();
                $completion->rpl = get_string('rpl', 'totara_completionimport', $course->grade);
                $completion->rplgrade = $course->grade;
                $completion->status = COMPLETION_STATUS_COMPLETEVIARPL;
                $completion->timeenrolled = $timeenrolled;
                $completion->timestarted = $timestarted;
                $completion->timecompleted = $timecompleted;
                $completion->reaggregate = 0;
                $completion->userid = $course->userid;
                $completion->course = $course->courseid;
                $completions[] = $completion;
            } else {
                // Existing record - put it into history.
                $history = new StdClass();
                $history->courseid = $course->courseid;
                $history->userid = $course->userid;
                $history->timecompleted = $timecompleted;
                $history->grade = $course->grade;
                $completion_history[] = $history;
            }

            $updateids[] = $course->importid;

        }
    }
    $courses->close();

    // Add any remaining records
    if (!empty($users)) {
        // Batch enrol users
        $plugin->enrol_user_bulk($instance, $users, $instance->roleid, $timestart, $timeend);
        $enrolcount = 0;
        unset($users);
        $users = array();
    }

    if (!empty($completions)) {
        // Batch import completions
        $DB->insert_records_via_batch('course_completions', $completions);
        unset($completions);
        $completions = array();
    }

    if (!empty($completion_history)) {
        // Batch import completions.
        $DB->insert_records_via_batch('course_completion_history', $completion_history);
        unset($completion_history);
        $completion_history = array();
    }

    if (!empty($updateids)) {
        // Update the timeupdated
        list($insql, $params) = $DB->get_in_or_equal($updateids, SQL_PARAMS_NAMED, 'param');
        $params['timeupdated'] = $importtime;
        $sql = "UPDATE {{$tablename}}
                SET timeupdated = :timeupdated
                WHERE id {$insql}";
        $DB->execute($sql, $params);
        unset($updateids);
        $updateids = array();
    }

    return $errors;
}

/**
 * Assign users to certifications and complete them
 *
 * Doesn't seem to be a bulk function for this so inserting directly into the tables
 *
 * @global object $DB
 * @global object $CFG
 * @param string $importname name of import
 * @param int $importtime time of import
 * @return array of errors if any
 */
function import_certification($importname, $importtime) {
    global $DB, $CFG;
    require_once($CFG->dirroot . '/totara/program/program.class.php');

    $errors = array();
    $updateids = array();
    $cc = array();
    $pc = array();
    $pchistory = array();
    $cchistory = array();
    $pua = array();
    $users = array();

    $pluginname = 'totara_completionimport_' . $importname;
    $csvdateformat = get_default_config($pluginname, 'csvdateformat', TCI_CSV_DATE_FORMAT);

    list($sqlwhere, $stdparams) = get_importsqlwhere($importtime);
    $params = array();
    $params['assignmenttype2'] = ASSIGNTYPE_INDIVIDUAL;
    $params = array_merge($params, $stdparams);

    $tablename = get_tablename($importname);

    // Create missing program assignments for individuals, in a form that will work for insert_records_via_batch()
    // Note: Postgres objects to manifest constants being used as parameters where they are the left hand
    // of an SQL clause (eg 5 AS assignmenttype) so manifest constants are placed in the query directly (better anyway!)
    $sql = "SELECT p.id AS programid,
            ".ASSIGNTYPE_INDIVIDUAL." AS assignmenttype,
            u.id AS assignmenttypeid,
            0 AS includechildren,
            ".COMPLETION_TIME_NOT_SET." AS completiontime,
            ".COMPLETION_EVENT_NONE." AS completionevent,
            0 AS completioninstance
            FROM {{$tablename}} i
            JOIN {user} u ON u.username = i.username
            JOIN {prog} p ON (CASE WHEN " . $DB->sql_isnotempty($tablename, 'i.certificationshortname', true, false) . "
                                    THEN p.shortname = i.certificationshortname
                                    ELSE p.idnumber = i.certificationidnumber
                                END)
            LEFT JOIN {prog_assignment} pa ON pa.programid = p.id
                                              AND pa.assignmenttype = :assignmenttype2
                                              AND pa.assignmenttypeid = u.id
            {$sqlwhere}
            AND pa.id IS NULL";

    $assignments = $DB->get_recordset_sql($sql, $params);
    $DB->insert_records_via_batch('prog_assignment', $assignments);
    $assignments->close();

    // Now get the records to import
    $params = array_merge(array('assignmenttype' => ASSIGNTYPE_INDIVIDUAL), $stdparams);
    $sql = "SELECT i.id as importid,
                    i.completiondate,
                    p.id AS progid,
                    c.id AS certifid,
                    c.recertifydatetype,
                    c.activeperiod,
                    c.windowperiod,
                    cc.timeexpires,
                    u.id AS userid,
                    pa.id AS paid,
                    pa.id AS assignmentid,
                    cc.id AS ccid,
                    pc.id AS pcid,
                    pua.id AS puaid
            FROM {{$tablename}} i
            JOIN {prog} p ON (CASE WHEN " . $DB->sql_isnotempty($tablename, 'i.certificationshortname', true, false) . "
                                    THEN p.shortname = i.certificationshortname
                                    ELSE p.idnumber = i.certificationidnumber
                                END)
            JOIN {certif} c ON c.id = p.certifid
            JOIN {user} u ON u.username = i.username
            JOIN {prog_assignment} pa ON pa.programid = p.id
                                        AND pa.assignmenttype = :assignmenttype
                                        AND pa.assignmenttypeid = u.id
            LEFT JOIN {certif_completion} cc ON cc.certifid = c.id AND cc.userid = u.id
            LEFT JOIN {prog_completion} pc ON pc.programid = p.id AND pc.userid = u.id AND pc.coursesetid = 0
            LEFT JOIN {prog_user_assignment} pua ON pua.programid = p.id AND pua.userid = u.id AND pua.assignmentid = pa.id
            {$sqlwhere}
            ORDER BY p.id";

    $insertcount = 1;
    $programid = 0;

    $programs = $DB->get_recordset_sql($sql, $params);
    if ($programs->valid()) {
        foreach ($programs as $program) {
            if (empty($programid) || ($programid != $program->progid) || (($insertcount++ % BATCH_INSERT_MAX_ROW_COUNT) == 0)) {
                // Insert a batch for a given programid (as need to insert user roles with program context)
                if (!empty($cc)) {
                    $DB->insert_records_via_batch('certif_completion', $cc);
                    unset($cc);
                    $cc = array();
                }
                if (!empty($cchistory)) {
                    $DB->insert_records_via_batch('certif_completion_history', $cchistory);
                    unset($cchistory);
                    $cchistory = array();
                }
                if (!empty($pc)) {
                    $DB->insert_records_via_batch('prog_completion', $pc);
                    unset($pc);
                    $pc = array();
                }
                if (!empty($pchistory)) {
                    $DB->insert_records_via_batch('prog_completion_history', $pchistory);
                    unset($pchistory);
                    $pchistory = array();
                }
                if (!empty($pua)) {
                    $DB->insert_records_via_batch('prog_user_assignment', $pua);
                    unset($pua);
                    $pua = array();
                }
                if (!empty($users)) {
                    $context = context_program::instance($programid);
                    role_assign_bulk($CFG->learnerroleid, $users, $context->id);
                    unset($users);
                    $users = array();
                }
                if (!empty($updateids)) {
                    // Update the timeupdated
                    list($updateinsql, $params) = $DB->get_in_or_equal($updateids, SQL_PARAMS_NAMED, 'param');
                    $params['timeupdated'] = $importtime;
                    $sql = "UPDATE {{$tablename}}
                            SET timeupdated = :timeupdated
                            WHERE id {$updateinsql}";
                    $DB->execute($sql, $params);
                    unset($updateids);
                    $updateids = array();
                }

                $programid = $program->progid;
            }

            // Create Certification completion record
            $ccdata = new stdClass();
            $ccdata->certifid = $program->certifid;
            $ccdata->userid = $program->userid;
            $ccdata->certifpath = CERTIFPATH_RECERT;
            $ccdata->status = CERTIFSTATUS_COMPLETED;
            $ccdata->renewalstatus = CERTIFRENEWALSTATUS_NOTDUE;

            // do recert times
            $timecompleted = totara_date_parse_from_format($csvdateformat, $program->completiondate);
            if (!$timecompleted) {
                $timecompleted = now();
            }
            $base = get_certiftimebase($program->recertifydatetype, $program->timeexpires, $timecompleted);
            $ccdata->timeexpires = get_timeexpires($base, $program->activeperiod);
            $ccdata->timewindowopens = get_timewindowopens($ccdata->timeexpires, $program->windowperiod);

            $ccdata->timecompleted = $timecompleted;
            $ccdata->timemodified = time();

            // overwrite completion if already exists, else add TODO should overwrite?
            if (empty($program->ccid)) {
                $cc[] = $ccdata;
            } else {
                // Already exists so out into history.
                $cchistory[] = $ccdata;
            }

            // Program completion
            $pcdata = new stdClass();
            $pcdata->programid = $program->progid;
            $pcdata->userid = $program->userid;
            $pcdata->coursesetid = 0;
            $pcdata->status = STATUS_PROGRAM_COMPLETE; // assume complete
            $pcdata->timestarted = $timecompleted;
            $pcdata->timedue = $timecompleted;
            $pcdata->timecompleted = $timecompleted;

            if (empty($program->pcid)) {
                // New record completion record.
                $pc[] = $pcdata;
            } else {
                // There is an existing record so put into history.
                $pchistory[] = $pcdata;
            }

            // Program user assignment
            $puadata = new stdClass();
            $puadata->programid = $program->progid;
            $puadata->userid = $program->userid;
            $puadata->assignmentid = $program->assignmentid;
            $puadata->timeassigned = time();
            $puadata->exceptionstatus = PROGRAM_EXCEPTION_RESOLVED;

            if (empty($program->puaid)) {
                $pua[] = $puadata;
            } else {
                $puadata->id = $program->puaid;
                $DB->update_record('prog_user_assignment', $puadata);
            }

            // user array for role addition
            $users[] = $program->userid;

            // totara_compl_import_cert ids
            $updateids[] = $program->importid;

        }
    }
    $programs->close();

    if (!empty($cc)) {
        $DB->insert_records_via_batch('certif_completion', $cc);
        unset($cc);
        $cc = array();
    }
    if (!empty($cchistory)) {
        $DB->insert_records_via_batch('certif_completion_history', $cchistory);
        unset($cchistory);
        $cchistory = array();
    }
    if (!empty($pc)) {
        $DB->insert_records_via_batch('prog_completion', $pc);
        unset($pc);
        $pc = array();
    }
    if (!empty($pchistory)) {
        $DB->insert_records_via_batch('prog_completion_history', $pchistory);
        unset($pchistory);
        $pchistory = array();
    }
    if (!empty($pua)) {
        $DB->insert_records_via_batch('prog_user_assignment', $pua);
        unset($pua);
        $pua = array();
    }
    if (!empty($users)) {
        $context = context_program::instance($programid);
        role_assign_bulk($CFG->learnerroleid, $users, $context->id);
        unset($users);
        $users = array();
    }
    if (!empty($updateids)) {
        // Update the timeupdated
        list($insql, $params) = $DB->get_in_or_equal($updateids, SQL_PARAMS_NAMED, 'param');
        $params['timeupdated'] = $importtime;
        $sql = "UPDATE {{$tablename}}
                SET timeupdated = :timeupdated
                WHERE id {$insql}";
        $DB->execute($sql, $params);
        unset($updateids);
        $updateids = array();
    }

    return $errors;
}

/**
 * Returns a list of possible date formats
 * Based on the list at http://en.wikipedia.org/wiki/Date_format_by_country
 *
 * @return array
 */
function get_dateformats() {
    $separators = array('-', '/', '.', ' ');
    $endians = array('yyyy~mm~dd', 'yy~mm~dd', 'dd~mm~yyyy', 'dd~mm~yy', 'mm~dd~yyyy', 'mm~dd~yy');
    $formats = array();
    foreach ($endians as $endian) {
        foreach ($separators as $separator) {
            $display = str_replace( '~', $separator, $endian);
            $format = str_replace('yyyy', 'Y', $display);
            $format = str_replace('yy', 'y', $format); // Don't think 2 digit years should be allowed
            $format = str_replace('mm', 'm', $format);
            $format = str_replace('dd', 'd', $format);
            $formats[$format] = $display;
        }
    }
    return $formats;
}

/**
 * Displays import results and a link to view the import errors
 *
 * @global object $OUTPUT
 * @global object $DB
 * @global object $USER
 * @param string $importname name of import
 * @param int $importtime time of import
 */
function display_report_link($importname, $importtime) {
    global $OUTPUT, $DB, $USER;

    $tablename = get_tablename($importname);

    $sql = "SELECT COUNT(*) AS totalrows,
            COALESCE(SUM(importerror), 0) AS totalerrors,
            COALESCE(SUM(importevidence), 0) AS totalevidence
            FROM {{$tablename}}
            WHERE timecreated = :timecreated
            AND importuserid = :userid";
    $totals = $DB->get_record_sql($sql, array('timecreated' => $importtime, 'userid' => $USER->id));

    echo $OUTPUT->heading(get_string('importresults', 'totara_completionimport'));
    if ($totals->totalrows) {
        echo html_writer::tag('p', get_string('importerrors', 'totara_completionimport', $totals->totalerrors));
        echo html_writer::tag('p', get_string('importevidence', 'totara_completionimport', $totals->totalevidence));
        echo html_writer::tag('p', get_string('import' . $importname, 'totara_completionimport',
                $totals->totalrows - $totals->totalerrors - $totals->totalevidence));
        echo html_writer::tag('p', get_string('importtotal', 'totara_completionimport', $totals->totalrows));

        if (($totals->totalerrors + $totals->totalevidence) > 0) {
            $viewurl = new moodle_url('/totara/completionimport/viewreport.php',
                    array('importname' => $importname, 'timecreated' => $importtime, 'importuserid' => $USER->id));
            $viewlink = html_writer::link($viewurl, format_string(get_string('report_' . $importname, 'totara_completionimport')));
            echo html_writer::tag('p', $viewlink);
        } else {
            echo html_writer::tag('p', get_string('importsuccess', 'totara_completionimport'));
        }
    } else {
        echo html_writer::tag('p', get_string('importnone', 'totara_completionimport'));
    }

}

/**
 * Returns the temporary path for for the temporary file - creates the directory if it doesn't exist
 *
 * @global object $CFG
 * @global object $OUTPUT
 * @return boolean|string false if fails or full name of path
 */
function get_temppath() {
    global $CFG, $OUTPUT;
    // Create the temporary path if it doesn't already exist
    $temppath = $CFG->dataroot . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . 'totara_completionimport';
    if (!file_exists($temppath)) {
        if (!mkdir($temppath, $CFG->directorypermissions, true)) {
            echo $OUTPUT->notification(get_string('cannotcreatetemppath', 'totara_completionimport', $temppath), 'notifyproblem');
            return false;
        }
    }
    $temppath .= DIRECTORY_SEPARATOR;
    return $temppath;
}

/**
 * Returns the config data for the upload form
 *
 * Each upload form has its own set of data
 *
 * @param int $filesource Method of upload, either upload via form or external directory
 * @param type $importname
 * @return stdClass $data
 */
function get_config_data($filesource, $importname) {
    $pluginname = 'totara_completionimport_' . $importname;
    $data = new stdClass();
    $data->filesource = $filesource;
    $data->sourcefile = get_config($pluginname, 'sourcefile');
    $data->evidencetype = get_default_config($pluginname, 'evidencetype', null);
    $data->csvdateformat = get_default_config($pluginname, 'csvdateformat', TCI_CSV_DATE_FORMAT);
    $data->csvdelimiter = get_default_config($pluginname, 'csvdelimiter', TCI_CSV_DELIMITER);
    $data->csvseparator = get_default_config($pluginname, 'csvseparator', TCI_CSV_SEPARATOR);
    $data->csvencoding = get_default_config($pluginname, 'csvencoding', TCI_CSV_ENCODING);
    return $data;
}

/**
 * Saves the data from the upload form
 *
 * @param object $data
 * @param string $importname name of import
 */
function set_config_data($data, $importname) {
    $pluginname = 'totara_completionimport_' . $importname;
    set_config('evidencetype', $data->evidencetype, $pluginname);
    if ($data->filesource == TCI_SOURCE_EXTERNAL) {
        set_config('sourcefile', $data->sourcefile, $pluginname);
    }
    set_config('csvdateformat', $data->csvdateformat, $pluginname);
    set_config('csvdelimiter', $data->csvdelimiter, $pluginname);
    set_config('csvseparator', $data->csvseparator, $pluginname);
    set_config('csvencoding', $data->csvencoding, $pluginname);
}

/**
 * Moves the external source file to the temporary directory
 *
 * @global object $OUTPUT
 * @param string $filename source file
 * @param string $tempfilename destination file
 * @return boolean true if successful, false if fails
 */
function move_sourcefile($filename, $tempfilename) {
    global $OUTPUT;
    // Check if file is accessible
    $handle = false;
    if (!is_readable($filename)) {
        echo $OUTPUT->notification(get_string('unreadablefile', 'totara_completionimport', $filename), 'notifyproblem');
        return false;
    } else if (!$handle = fopen($filename, 'r')) {
        echo $OUTPUT->notification(get_string('erroropeningfile', 'totara_completionimport', $filename), 'notifyproblem');
        return false;
    } else if (!flock($handle, LOCK_EX | LOCK_NB)) {
        echo $OUTPUT->notification(get_string('fileisinuse', 'totara_completionimport', $filename), 'notifyproblem');
        fclose($handle);
        return false;
    }
    // Don't need the handle any more so close it
    fclose($handle);

    if (!rename($filename, $tempfilename)) {
        $a = new stdClass();
        $a->fromfile = $filename;
        $a->tofile = $tempfilename;
        echo $OUTPUT->notification(get_string('cannotmovefiles', 'totara_completionimport', $a), 'notifyproblem');
        return false;
    }

    return true;
}

/**
 * Main import of completions
 *
 * 1. Check the required columns exist in the csv file
 * 2. Import the csv file into the import table
 * 3. Run data checks on the import table
 * 4. Any missing courses / certifications are created as evidence in the record of learning
 * 5. Anything left over is imported into courses or certifications
 *
 * @global object $OUTPUT
 * @global object $DB
 * @param string $tempfilename name of temporary csv file
 * @param string $importname name of import
 * @param int $importtime time of import
 * @param bool $quiet If true, suppress outputting messages (for tests).
 * @return boolean
 */
function import_completions($tempfilename, $importname, $importtime, $quiet = false) {
    global $OUTPUT, $DB;

    // Increase memory limit
    raise_memory_limit(MEMORY_EXTRA);

    // Stop time outs, this might take a while
    set_time_limit(0);

    if ($errors = check_fields_exist($tempfilename, $importname)) {
        // Source file header doesn't have the required fields
        if (!$quiet) {
            echo $OUTPUT->notification(get_string('missingfields', 'totara_completionimport'), 'notifyproblem');
            echo html_writer::alist($errors);
        }
        unlink($tempfilename);
        return false;
    }

    if ($errors = import_csv($tempfilename, $importname, $importtime)) {
        // Something went wrong with import
        if (!$quiet) {
            echo $OUTPUT->notification(get_string('csvimportfailed', 'totara_completionimport'), 'notifyproblem');
            echo html_writer::alist($errors);
        }
        unlink($tempfilename);
        return false;
    }
    // Don't need the temporary file any more
    unlink($tempfilename);
    if (!$quiet) {
        echo $OUTPUT->notification(get_string('csvimportdone', 'totara_completionimport'), 'notifysuccess');
    }

    // Data checks - no errors returned, it adds errors to each row in the import table
    import_data_checks($importname, $importtime);

    // Start transaction, we are dealing with live data now...
    $transaction = $DB->start_delegated_transaction();

    // Put into evidence any courses / certifications not found
    create_evidence($importname, $importtime);

    // Run the specific course enrolment / certification assignment
    $functionname = 'import_' . $importname;
    $errors = $functionname($importname, $importtime);
    if (!empty($errors)) {
        if (!$quiet) {
            echo $OUTPUT->notification(get_string('error:' . $functionname, 'totara_completionimport'), 'notifyproblem');
            echo html_writer::alist($errors);
        }
        return false;
    }
    if (!$quiet) {
        echo $OUTPUT->notification(get_string('dataimportdone', 'totara_completionimport', $importname), 'notifysuccess');
    }

    // End the transaction
    $transaction->allow_commit();

    return true;
}

/**
 * Deletes the import data from the import table
 *
 * @param string $importname name of import
 */
function reset_import($importname) {
    global $DB, $OUTPUT, $USER;
    $tablename = get_tablename($importname);
    if ($DB->delete_records($tablename, array('importuserid' => $USER->id))) {
        echo $OUTPUT->notification(get_string('resetcomplete', 'totara_completionimport', $importname), 'notifysuccess');
    } else {
        echo $OUTPUT->notification(get_string('resetfailed', 'totara_completionimport', $importname), 'notifyproblem');
    }
}

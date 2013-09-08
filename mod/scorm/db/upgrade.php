<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Upgrade script for the scorm module.
 *
 * @package    mod
 * @subpackage scorm
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


/**
 * @global moodle_database $DB
 * @param int $oldversion
 * @return bool
 */
function xmldb_scorm_upgrade($oldversion) {
    global $CFG, $DB;

    $dbman = $DB->get_manager();


    // Moodle v2.2.0 release upgrade line
    // Put any upgrade step following this

    if ($oldversion < 2012032100) {
        unset_config('updatetime', 'scorm');
        upgrade_mod_savepoint(true, 2012032100, 'scorm');
    }

    // Adding completion fields to scorm table
    if ($oldversion < 2012032101) {
        $table = new xmldb_table('scorm');

        $field = new xmldb_field('completionstatusrequired', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, null, null, null, 'timemodified');
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        $field = new xmldb_field('completionscorerequired', XMLDB_TYPE_INTEGER, '2', XMLDB_UNSIGNED, null, null, null, 'completionstatusrequired');
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        upgrade_mod_savepoint(true, 2012032101, 'scorm');
    }

    // Moodle v2.3.0 release upgrade line
    // Put any upgrade step following this


    // Adding completion fields to scorm table
    if ($oldversion < 2011041402) {
        $table = new xmldb_table('scorm');
        $field = new xmldb_field('completionstatusrequired', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, null, null, null, null, null, 'timemodified');
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('completionscorerequired', XMLDB_TYPE_INTEGER, '2', XMLDB_UNSIGNED, null, null, null, null, null, 'completionstatusrequired');
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        upgrade_mod_savepoint(true, 2011041402, 'scorm');
    }

    if ($oldversion < 2011073100) {
        // change field type of objectiveid
        $table = new xmldb_table('scorm_seq_objective');
        $field = new xmldb_field('objectiveid', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null, 'primaryobj');
        $dbman->change_field_type($table, $field);
        upgrade_mod_savepoint(true, 2011073100, 'scorm');
    }


    if ($oldversion < 2011112902) {
        require_once($CFG->libdir . '/completionlib.php');
        // a bug in scorm activity completion means that there may be users who have
        // met the criteria but are not marked as complete. This upgrade finds any
        // incomplete scorm activities and reruns the activity completion check to
        // fix the records

        // get activity completion details for all incomplete scorm activities
        $sql = "SELECT cmc.id, cmc.userid, cmc.coursemoduleid, cm.course as courseid
            FROM {course_modules_completion} cmc
            JOIN {course_modules} cm ON cmc.coursemoduleid = cm.id
            WHERE cmc.completionstate = ?
            AND cm.module = (SELECT id FROM {modules} WHERE name = ?)";
        $incomplete_scorm_records = $DB->get_recordset_sql($sql, array(COMPLETION_INCOMPLETE, 'scorm'));
        $cms = array();
        $courses = array();
        foreach ($incomplete_scorm_records as $incomplete_scorm) {
            $cmid = $incomplete_scorm->coursemoduleid;
            $courseid = $incomplete_scorm->courseid;
            // cache course module records for speed
            if (!array_key_exists($cmid, $cms)) {
                $cms[$cmid] = $DB->get_record('course_modules', array('id' => $cmid));
            }
            // cache course records for speed
            if (!array_key_exists($courseid, $courses)) {
                $courses[$courseid] = $DB->get_record('course', array('id' => $courseid));
            }

            // recheck the completion record for each user
            $completion = new completion_info($courses[$courseid]);
            $completion->update_state($cms[$cmid], COMPLETION_UNKNOWN, $incomplete_scorm->userid);
        }
        $incomplete_scorm_records->close();

    }

    //rename config var from maxattempts to maxattempt
    if ($oldversion < 2012061701) {
        $maxattempts = get_config('scorm', 'maxattempts');
        $maxattempts_adv = get_config('scorm', 'maxattempts_adv');
        set_config('maxattempt', $maxattempts, 'scorm');
        set_config('maxattempt_adv', $maxattempts_adv, 'scorm');
        unset_config('maxattempts', 'scorm'); //remove old setting.
        unset_config('maxattempts_adv', 'scorm'); //remove old setting.
        upgrade_mod_savepoint(true, 2012061701, 'scorm');
    }


    // Moodle v2.4.0 release upgrade line
    // Put any upgrade step following this.

    // Moodle v2.5.0 release upgrade line.
    // Put any upgrade step following this.

    // Fix AICC parent/child relationships (MDL-37394).
    if ($oldversion < 2013050101) {
        // Get all AICC packages.
        $aiccpackages = $DB->get_recordset('scorm', array('version' => 'AICC'), '', 'id');
        foreach ($aiccpackages as $aicc) {
            $sql = "UPDATE {scorm_scoes}
                       SET parent = organization
                     WHERE scorm = ?
                       AND " . $DB->sql_isempty('scorm_scoes', 'manifest', false, false) . "
                       AND " . $DB->sql_isnotempty('scorm_scoes', 'organization', false, false) . "
                       AND parent = '/'";
            $DB->execute($sql, array($aicc->id));
        }
        $aiccpackages->close();
        upgrade_mod_savepoint(true, 2013050101, 'scorm');
    }

    return true;
}



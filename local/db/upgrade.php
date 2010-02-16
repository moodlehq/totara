<?php
/*
 * Moodle - Modular Object-Oriented Dynamic Learning Environment
 *          http://moodle.org
 * Copyright (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
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
 * @package    moodle
 * @subpackage local
 * @author     Jonathan Newman <jonathan.newman@catalyst.net.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 */

function xmldb_local_upgrade($oldversion) {
    global $CFG;

    $result = true;

    if ($result && $oldversion < 2010021500) {

    /// Define field enablecompletion to be added to course
        $table = new XMLDBTable('course');
        $field = new XMLDBField('enablecompletion');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'defaultrole');

    /// Launch add field enablecompletion
        $result = $result && add_field($table, $field);
    }

    if ($result && $oldversion < 2010021501) {

    /// Define field completion to be added to course_modules
        $table = new XMLDBTable('course_modules');
        $field = new XMLDBField('completion');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'groupmembersonly');

    /// Launch add field completion
        $result = $result && add_field($table, $field);

    /// Define field completiongradeitemnumber to be added to course_modules
        $field = new XMLDBField('completiongradeitemnumber');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, null, null, 'completion');

    /// Launch add field completiongradeitemnumber
        $result = $result && add_field($table, $field);

    /// Define field completionview to be added to course_modules
        $field = new XMLDBField('completionview');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'completiongradeitemnumber');

    /// Launch add field completionview
        $result = $result && add_field($table, $field);

    /// Define field completionexpected to be added to course_modules
        $field = new XMLDBField('completionexpected');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'completionview');

    /// Launch add field completionexpected
        $result = $result && add_field($table, $field);

   /// Define table course_modules_completion to be created
        $table = new XMLDBTable('course_modules_completion');

    /// Adding fields to table course_modules_completion
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->addFieldInfo('coursemoduleid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('userid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('completionstate', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('viewed', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, null, null, null, null, null);
        $table->addFieldInfo('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);

    /// Adding keys to table course_modules_completion
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));

    /// Adding indexes to table course_modules_completion
        $table->addIndexInfo('coursemoduleid', XMLDB_INDEX_NOTUNIQUE, array('coursemoduleid'));
        $table->addIndexInfo('userid', XMLDB_INDEX_NOTUNIQUE, array('userid'));

    /// Launch create table for course_modules_completion
        $result = $result && create_table($table);
    }

    if ($result && $oldversion < 2010021503) {

    /// Define field completiondiscussions to be added to forum
        $table = new XMLDBTable('forum');
        $field = new XMLDBField('completiondiscussions');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '9', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'draft');

    /// Launch add field completiondiscussions
        if(!field_exists($table,$field)) {
            add_field($table, $field);
        }

        $field = new XMLDBField('completionreplies');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '9', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'completiondiscussions');

    /// Launch add field completionreplies
        if(!field_exists($table,$field)) {
            add_field($table, $field);
        }

    /// Define field completionposts to be added to forum
        $field = new XMLDBField('completionposts');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '9', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'completionreplies');

    /// Launch add field completionposts
        if(!field_exists($table,$field)) {
            add_field($table, $field);
        }
    }

    if ($result && $oldversion < 2010021504) {

    /// Define field availablefrom to be added to course_modules
        $table = new XMLDBTable('course_modules');
        $field = new XMLDBField('availablefrom');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'completionexpected');

    /// Conditionally launch add field availablefrom
        $result = $result && add_field($table, $field);

    /// Define field availableuntil to be added to course_modules
        $field = new XMLDBField('availableuntil');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'availablefrom');

    /// Conditionally launch add field availableuntil
        $result = $result && add_field($table, $field);

    /// Define field showavailability to be added to course_modules
        $field = new XMLDBField('showavailability');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'availableuntil');

    /// Conditionally launch add field showavailability
        $result = $result && add_field($table, $field);

    /// Define table course_modules_availability to be created
        $table = new XMLDBTable('course_modules_availability');

    /// Adding fields to table course_modules_availability
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->addFieldInfo('coursemoduleid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('sourcecmid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, null, null);
        $table->addFieldInfo('requiredcompletion', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, null, null, null, null, null);
        $table->addFieldInfo('gradeitemid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, null, null);
        $table->addFieldInfo('grademin', XMLDB_TYPE_NUMBER, '10, 5', null, null, null, null, null, null);
        $table->addFieldInfo('grademax', XMLDB_TYPE_NUMBER, '10, 5', null, null, null, null, null, null);

    /// Adding keys to table course_modules_availability
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->addKeyInfo('coursemoduleid', XMLDB_KEY_FOREIGN, array('coursemoduleid'), 'course_modules', array('id'));
        $table->addKeyInfo('sourcecmid', XMLDB_KEY_FOREIGN, array('sourcecmid'), 'course_modules', array('id'));
        $table->addKeyInfo('gradeitemid', XMLDB_KEY_FOREIGN, array('gradeitemid'), 'grade_items', array('id'));

    /// Conditionally launch create table for course_modules_availability
        if (!table_exists($table)) {
            create_table($table);
        }

    /// Changes to modinfo mean we need to rebuild course cache
        rebuild_course_cache(0,true);
    }

    if ($result && $oldversion < 2010021505) {

    /// Add course completion tables
    /// Define table course_completion_aggr_methd to be created
        $table = new XMLDBTable('course_completion_aggr_methd');

    /// Adding fields to table course_completion_aggr_methd
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('course', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
        $table->addFieldInfo('criteriatype', XMLDB_TYPE_INTEGER, '20', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('method', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
        $table->addFieldInfo('value', XMLDB_TYPE_NUMBER, '10, 5', null, null, null, null);

    /// Adding keys to table course_completion_aggr_methd
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));

    /// Adding indexes to table course_completion_aggr_methd
        $table->addIndexInfo('course', XMLDB_INDEX_NOTUNIQUE, array('course'));
        $table->addIndexInfo('criteriatype', XMLDB_INDEX_NOTUNIQUE, array('criteriatype'));

    /// Conditionally launch create table for course_completion_aggr_methd
        if (!table_exists($table)) {
            create_table($table);
        }


    /// Define table course_completion_criteria to be created
        $table = new XMLDBTable('course_completion_criteria');

    /// Adding fields to table course_completion_criteria
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('course', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
        $table->addFieldInfo('criteriatype', XMLDB_TYPE_INTEGER, '20', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
        $table->addFieldInfo('module', XMLDB_TYPE_CHAR, '100', null, null, null, null);
        $table->addFieldInfo('moduleinstance', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('enrolperiod', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('date', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('gradepass', XMLDB_TYPE_NUMBER, '10, 5', null, null, null, null);
        $table->addFieldInfo('role', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('lock', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null);

    /// Adding keys to table course_completion_criteria
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));

    /// Adding indexes to table course_completion_criteria
        $table->addIndexInfo('course', XMLDB_INDEX_NOTUNIQUE, array('course'));
        $table->addIndexInfo('lock', XMLDB_INDEX_NOTUNIQUE, array('lock'));

    /// Conditionally launch create table for course_completion_criteria
        if (!table_exists($table)) {
            create_table($table);
        }


    /// Define table course_completion_crit_compl to be created
        $table = new XMLDBTable('course_completion_crit_compl');

    /// Adding fields to table course_completion_crit_compl
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('userid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
        $table->addFieldInfo('course', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
        $table->addFieldInfo('criteriaid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
        $table->addFieldInfo('gradefinal', XMLDB_TYPE_NUMBER, '10, 5', null, null, null, null);
        $table->addFieldInfo('unenroled', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('deleted', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('timecompleted', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null);

    /// Adding keys to table course_completion_crit_compl
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));

    /// Adding indexes to table course_completion_crit_compl
        $table->addIndexInfo('userid', XMLDB_INDEX_NOTUNIQUE, array('userid'));
        $table->addIndexInfo('course', XMLDB_INDEX_NOTUNIQUE, array('course'));
        $table->addIndexInfo('criteriaid', XMLDB_INDEX_NOTUNIQUE, array('criteriaid'));
        $table->addIndexInfo('timecompleted', XMLDB_INDEX_NOTUNIQUE, array('timecompleted'));

    /// Conditionally launch create table for course_completion_crit_compl
        if (!table_exists($table)) {
            create_table($table);
        }


    /// Define table course_completion_notify to be created
        $table = new XMLDBTable('course_completion_notify');

    /// Adding fields to table course_completion_notify
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('course', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
        $table->addFieldInfo('role', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
        $table->addFieldInfo('message', XMLDB_TYPE_TEXT, 'small', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timesent', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');

    /// Adding keys to table course_completion_notify
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));

    /// Adding indexes to table course_completion_notify
        $table->addIndexInfo('course', XMLDB_INDEX_NOTUNIQUE, array('course'));

    /// Conditionally launch create table for course_completion_notify
        if (!table_exists($table)) {
            create_table($table);
        }

    /// Define table course_completions to be created
        $table = new XMLDBTable('course_completions');

    /// Adding fields to table course_completions
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('userid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
        $table->addFieldInfo('course', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
        $table->addFieldInfo('deleted', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('timenotified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('timeenroled', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
        $table->addFieldInfo('timecompleted', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null);

    /// Adding keys to table course_completions
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));

    /// Adding indexes to table course_completions
        $table->addIndexInfo('userid', XMLDB_INDEX_NOTUNIQUE, array('userid'));
        $table->addIndexInfo('course', XMLDB_INDEX_NOTUNIQUE, array('course'));
        $table->addIndexInfo('timecompleted', XMLDB_INDEX_NOTUNIQUE, array('timecompleted'));

    /// Conditionally launch create table for course_completions
        if (!table_exists($table)) {
            create_table($table);
        }


    /// Add cols to course table
    /// Define field enablecompletion to be added to course
        $table = new XMLDBTable('course');
        $field = new XMLDBField('enablecompletion');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'defaultrole');

    /// Conditionally launch add field enablecompletion
        if (!field_exists($table, $field)) {
            add_field($table, $field);
        }

    /// Define field completionnotify to be added to course
        $field = new XMLDBField('completionnotify');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'enablecompletion');

    /// Conditionally launch add field completionnotify
        if (!field_exists($table, $field)) {
            add_field($table, $field);
        }
    }

    if ($result && $oldversion < 2010021507) {

    /// Add cols to course completion criteria table
        $table = new XMLDBTable('course_completion_criteria');
        $field = new XMLDBField('courseinstance');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, null, '0', 'moduleinstance');

        if (!field_exists($table, $field)) {
            add_field($table, $field);
        }
    }

    if ($result && $oldversion < 2010021508) {
        // Add completion setting to course table

        $table = new XMLDBTable('course');
        $field = new XMLDBField('completionstartonenrol');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'enablecompletion');

        if (!field_exists($table, $field)) {
            add_field($table, $field);
        }

        // Add completion setting to course table

        $table = new XMLDBTable('course_completions');
        $field = new XMLDBField('timestarted');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, null, null, 'timeenrolled');

        if (!field_exists($table, $field)) {
            add_field($table, $field);
        }
    }

    if ($result && $oldversion < 2010021509) {
        // Rename timeenroled to timeenrolled

        $table = new XMLDBTable('course_completions');
        $field = new XMLDBField('timeenroled');

        if (field_exists($table, $field)) {
            drop_field($table, $field);
        }

        $field = new XMLDBField('timeenrolled');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, null, null, 'deleted');

        if (!field_exists($table, $field)) {
            add_field($table, $field);
        }
    }

    return $result;
}

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
 *
 * local db upgrades for MITMS 
 */
function xmldb_local_upgrade($oldversion) {
    global $CFG, $db;

    $result = true;
    if ($result && $oldversion < 2009091000) {

    /// Define field enablecompletion to be added to course
        $table = new XMLDBTable('course');
        $field = new XMLDBField('enablecompletion');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'defaultrole');

    /// Launch add field enablecompletion
        $result = $result && add_field($table, $field);

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
        if(!table_exists($table)) {

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
            create_table($table);
        }

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
        $field->setAttributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0', 'defaultrole');

    /// Conditionally launch add field enablecompletion
        if (!field_exists($table, $field)) {
            add_field($table, $field);
        }

    /// Add cols to course completion criteria table
        $table = new XMLDBTable('course_completion_criteria');
        $field = new XMLDBField('courseinstance');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, '0', 'moduleinstance');

        if (!field_exists($table, $field)) {
            add_field($table, $field);
        }

        set_config('theme', 'mitms');
        set_config('defaulthtmleditor', 'tinymce');

    /// Create table competency_framework
        $table = new XMLDBTable('competency_framework');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('fullname', XMLDB_TYPE_TEXT, 'medium', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('shortname', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('idnumber', XMLDB_TYPE_CHAR, '100', null, null, null, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('isdefault', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('sortorder', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('visible', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('hidecustomfields', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('showitemfullname', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('showdepthfullname', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('usermodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->addIndexInfo('sortorder', XMLDB_INDEX_UNIQUE, array('sortorder'));
        $result = $result && create_table($table);

    /// Create table competency_depth
        $table = new XMLDBTable('competency_depth');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('fullname', XMLDB_TYPE_TEXT, 'medium', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('shortname', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('depthlevel', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('frameworkid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('usermodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table competency_depth_info_category
        $table = new XMLDBTable('competency_depth_info_category');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('name', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('sortorder', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('depthid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table competency_depth_info_field
        $table = new XMLDBTable('competency_depth_info_field');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('fullname', XMLDB_TYPE_TEXT, 'medium', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('shortname', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('depthid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('datatype', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('sortorder', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('categoryid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('hidden', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('locked', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('required', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('forceunique', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('defaultdata', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('param1', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('param2', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('param3', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('param4', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('param5', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table competency
        $table = new XMLDBTable('competency');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('fullname', XMLDB_TYPE_TEXT, 'medium', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('shortname', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('idnumber', XMLDB_TYPE_CHAR, '100', null, null, null, null);
        $table->addFieldInfo('frameworkid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('path', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('depthid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('parentid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('sortorder', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('visible', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('aggregationmethod', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('scaleid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('proficiencyexpected', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('evidencecount', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('usermodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table competency_depth_info_data
        $table = new XMLDBTable('competency_depth_info_data');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('fieldid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('competencyid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('data', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table competency_relations
        $table = new XMLDBTable('competency_relations');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('id1', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('id2', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table competency_evidence_items
        $table = new XMLDBTable('competency_evidence_items');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('competencyid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('itemtype', XMLDB_TYPE_CHAR, '30', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('itemmodule', XMLDB_TYPE_CHAR, '30', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('iteminstance', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('usermodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table competency_scale
        $table = new XMLDBTable('competency_scale');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->addFieldInfo('name', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'small', null, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('usermodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table competency_scale_values
        $table = new XMLDBTable('competency_scale_values');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('name', XMLDB_TYPE_TEXT, 'medium', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('idnumber', XMLDB_TYPE_CHAR, '100', null, null, null, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('scaleid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('numeric', XMLDB_TYPE_NUMBER, '10, 5', null, null, null, null);
        $table->addFieldInfo('sortorder', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('usermodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table competency_scale_assignments
        $table = new XMLDBTable('competency_scale_assignments');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->addFieldInfo('scaleid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('frameworkid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('usermodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table competency_template
        $table = new XMLDBTable('competency_template');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('frameworkid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('fullname', XMLDB_TYPE_TEXT, 'medium', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('shortname', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('visible', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('competencycount', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('usermodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table competency_template_assignment
        $table = new XMLDBTable('competency_template_assignment');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('templateid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('type', XMLDB_TYPE_INTEGER, '2', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('instanceid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('usermodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table competency_template_competencies
        $table = new XMLDBTable('competency_template_competencies');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('templateid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('competencyid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('priority', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('proficiencyexpected', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('hidden', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('usermodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table organisation_framework
        $table = new XMLDBTable('organisation_framework');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('fullname', XMLDB_TYPE_TEXT, 'medium', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('shortname', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('idnumber', XMLDB_TYPE_CHAR, '100', null, null, null, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('isdefault', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('sortorder', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('visible', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('hidecustomfields', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('showitemfullname', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('showdepthfullname', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('usermodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->addIndexInfo('sortorder', XMLDB_INDEX_UNIQUE, array('sortorder'));
        $result = $result && create_table($table);

    /// Create table organisation_depth
        $table = new XMLDBTable('organisation_depth');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('fullname', XMLDB_TYPE_TEXT, 'medium', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('shortname', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('depthlevel', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('frameworkid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('usermodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table organisation_depth_info_category
        $table = new XMLDBTable('organisation_depth_info_category');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('name', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('sortorder', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('depthid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table organisation_depth_info_field
        $table = new XMLDBTable('organisation_depth_info_field');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('fullname', XMLDB_TYPE_TEXT, 'medium', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('shortname', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('depthid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('datatype', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('sortorder', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('categoryid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('hidden', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('locked', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('required', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('forceunique', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('defaultdata', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('param1', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('param2', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('param3', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('param4', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('param5', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table organisation
        $table = new XMLDBTable('organisation');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('fullname', XMLDB_TYPE_TEXT, 'medium', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('shortname', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('idnumber', XMLDB_TYPE_CHAR, '100', null, null, null, null);
        $table->addFieldInfo('frameworkid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('path', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('depthid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('parentid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('sortorder', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('visible', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('usermodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table organisation_depth_info_data
        $table = new XMLDBTable('organisation_depth_info_data');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('fieldid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('organisationid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('data', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table organisation_relations
        $table = new XMLDBTable('organisation_relations');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('id1', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('id2', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table position_framework
        $table = new XMLDBTable('position_framework');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('fullname', XMLDB_TYPE_TEXT, 'medium', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('shortname', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('idnumber', XMLDB_TYPE_CHAR, '100', null, null, null, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('isdefault', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('sortorder', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('usermodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('visible', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('hidecustomfields', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('showitemfullname', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('showdepthfullname', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->addIndexInfo('sortorder', XMLDB_INDEX_UNIQUE, array('sortorder'));
        $result = $result && create_table($table);

    /// Create table position_depth
        $table = new XMLDBTable('position_depth');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('fullname', XMLDB_TYPE_TEXT, 'medium', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('shortname', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('depthlevel', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('frameworkid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('usermodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table position_depth_info_category
        $table = new XMLDBTable('position_depth_info_category');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('name', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('sortorder', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('depthid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table position_depth_info_field
        $table = new XMLDBTable('position_depth_info_field');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('fullname', XMLDB_TYPE_TEXT, 'medium', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('shortname', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('depthid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('datatype', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('sortorder', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('categoryid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('hidden', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('locked', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('required', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('forceunique', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('defaultdata', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('param1', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('param2', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('param3', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('param4', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('param5', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table position
        $table = new XMLDBTable('position');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('fullname', XMLDB_TYPE_TEXT, 'medium', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('shortname', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('idnumber', XMLDB_TYPE_CHAR, '100', null, null, null, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('frameworkid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('path', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('depthid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('parentid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('sortorder', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('visible', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timevalidfrom', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('timevalidto', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('usermodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table position_depth_info_data
        $table = new XMLDBTable('position_depth_info_data');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('fieldid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('positionid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('data', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table position_relations
        $table = new XMLDBTable('position_relations');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('id1', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('id2', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table position_assignment
        $table = new XMLDBTable('position_assignment');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('fullname', XMLDB_TYPE_TEXT, 'medium', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('shortname', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('idnumber', XMLDB_TYPE_CHAR, '100', null, null, null, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('userid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('positionid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('reportstoid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('type', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('timevalidfrom', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('timevalidto', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('usermodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Create table position_assignment_history
        $table = new XMLDBTable('position_assignment_history');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('fullname', XMLDB_TYPE_TEXT, 'medium', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('shortname', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('idnumber', XMLDB_TYPE_CHAR, '100', null, null, null, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'big', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('userid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('positionid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('reportstoid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('type', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('timevalidfrom', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('timevalidto', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null);
        $table->addFieldInfo('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('timefinished', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table);

    /// Bootstrap custom roles and change sort order of both custom and legacy roles
        $roles = array(
            'guest' => array(
                'name'        => 'Guest',
                'description' => 'Guests have minimal privileges and usually can not enter text anywhere.',
                'legacy'      => 'guest',
                'sortorder'   => '9',
            ),
            'user' => array(
                'name'        => 'Authenticated User',
                'description' => 'All logged in users.',
                'legacy'      => 'user',
                'sortorder'   => '8',
            ),
            'learner' => array(
                'name'        => 'Learner',
                'description' => 'User acquiring knowledge, comprehension, or mastery through learning',
                'legacy'      => 'student',
                'sortorder'   => '7',
            ),
            'manager' => array(
                'name'        => 'Manager',
                'description' => 'User tasked with managing the performance of a learner or team',
                'sortorder'   => '6',
            ),
            'regionalmananger' => array(
                'name'        => 'Regional Manager',
                'description' => 'User who is responsible for the performance of a region and has access to regional reports',
                'sortorder'   => '5',
            ),
            'noneditingtrainer' => array(
                'name'        => 'Trainer',
                'description' => 'Responsible for delivering training of learners, but may not alter activities.',
                'legacy'      => 'teacher',
                'sortorder'   => '4',
            ),
            'trainer' => array(
                'name'        => 'Editing Trainer',
                'description' => 'Responsible for delivering training of learners, and can alter activities',
                'legacy'      => 'editingteacher',
                'sortorder'   => '3',
            ),
            'regionaltrainer' => array(
                'name'        => 'Regional Trainer',
                'description' => 'User who oversees the delivery of training within a region',
                'sortorder'   => '2',
            ),
        );
        foreach ($roles as $shortname => $roledata) {
            if (array_key_exists('legacy', $roledata)) {
                if ($oldrole = get_record_select('role', "shortname='".$roledata['legacy']."'")) {
                    $oldrole->name        = $roledata['name'];
                    $oldrole->description = $roledata['description'];
                    $oldrole->sortorder   = $roledata['sortorder'];
                    update_record('role', $oldrole);
                }
            } else {
                $roledata['shortname'] = $shortname;
                $roledata['legacy'] = '';
                insert_record('role', $roledata);
            }
            $oldrole = get_record_select('role', "name='".$roledata['name']."'");
        }

        $timenow = time();

        // Insert default competency_framework
        $default_framework = (object) array(
            'fullname'      => 'General competencies',
            'shortname'     => 'general',
            'timecreated'   => $timenow,
            'timemodified'  => $timenow,
            'usermodified'  => 1,
            'isdefault'     => 1,
            'visible'       => 1,
            'hidecustomfields' => 0,
            'showitemfullname' => 1,
            'showdepthfullname' => 1,
            'sortorder'     => 1
        );
        $default_framework->id = insert_record('competency_framework', $default_framework);

        // Insert default competency_depth
        $default_depth = (object) array(
            'fullname'      => 'Competencies',
            'shortname'     => 'Competencies',
            'depthlevel'    => 1,
            'frameworkid'   => $default_framework->id,
            'timecreated'   => $timenow,
            'timemodified'  => $timenow,
            'usermodified'  => 2,
        );
        insert_record('competency_depth', $default_depth);

        // Insert default competency
        $default_competency = array(
            'id'                  => 1,
            'fullname'            => 'Reading comprehension',
            'shortname'           => 'Reading comprehension',
            'idnumber'            => '',
            'frameworkid'         => 1,
            'parentid'            => 0,
            'sortorder'           => 1,
            'depthid'             => 1,
            'path'                => '/1',
            'description'         => '',
            'aggregationmethod'   => 1,
            'scaleid'             => 1,
            'proficiencyexpected' => 1,
            'evidencecount'       => 0,
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
            'usermodified'        => 2,
            'visible'             => 1,
        );
        insert_record('competency', $default_competency);

        // Insert default position_framework
        $default_framework = (object) array(
            'fullname'      => 'General positions',
            'shortname'     => 'general',
            'timecreated'   => $timenow,
            'timemodified'  => $timenow,
            'usermodified'  => 1,
            'isdefault'     => 1,
            'sortorder'     => 1,
            'visible'       => 1,
            'timecreated'   => $timenow,
            'timemodified'  => $timenow,
            'usermodified'  => 2,
            'hidecustomfields' => 0,
            'showitemfullname' => 1,
            'showdepthfullname' => 1,
        );
        $default_framework->id = insert_record('position_framework', $default_framework);
/* import via hierarchy restore instead
        // Insert default organisation_framework
        $default_framework = (object) array(
            'fullname'      => 'General offices',
            'shortname'     => 'general',
            'timecreated'   => $timenow,
            'timemodified'  => $timenow,
            'usermodified'  => 1,
            'isdefault'     => 1,
            'sortorder'     => 1,
            'visible'       => 1,
            'timecreated'   => $timenow,
            'timemodified'  => $timenow,
            'usermodified'  => 2,
            'hidecustomfields' => 0,
            'showitemfullname' => 1,
            'showdepthfullname' => 1,
        );
        $default_framework->id = insert_record('organisation_framework', $default_framework);
 */

        // install mitms demo data
        //include('demo.php');
        include('doc_custom_profile_fields.php');
    }

    return $result;

}

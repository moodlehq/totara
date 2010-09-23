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
 * @copyright  Totara Learning Solutions Limited
 * @author     Simon Coggins <simonc@catalyst.net.nz>
 * @author     Aaron Barnes <aaronb@catalyst.net.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package    totara
 * @subpackage local
 *
 * Utility functions for performing Totara local db upgrades
 */

/*
 * Function to update old report builder db entries to match new schema
 * Designed to be called from local/db/upgrade.php only
 *
 * @param   &$result Current result status, updated depending on results
 * @return  void
 */
function totara_migrate_old_report_builder_reports(&$result) {

    $table = new XMLDBTable('report_builder_access');
    if(!table_exists($table)) {

    /// Adding fields to table report_builder_access
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->addFieldInfo('reportid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('accesstype', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('typeid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);

    /// Adding keys to table report_builder_access
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));

    /// Launch create table for report_builder_access
        create_table($table);
    }


    /// Define fields access and content to be added to report_builder
    $table = new XMLDBTable('report_builder');
    $field = new XMLDBField('accessmode');
    $field->setAttributes(XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
    // add access field to report_builder
    $result = $result && add_field($table, $field);

    $field = new XMLDBField('contentmode');
    $field->setAttributes(XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
    // add content field to report_builder
    $result = $result && add_field($table, $field);

    $field = new XMLDBField('contentsettings');
    $field->setAttributes(XMLDB_TYPE_TEXT, 'medium', XMLDB_UNSIGNED, null, null, null);
    // add content settings field to report builder
    $result = $result && add_field($table, $field);

    // not used at the moment but might use later
    $field = new XMLDBField('accesssettings');
    $field->setAttributes(XMLDB_TYPE_TEXT, 'medium', XMLDB_UNSIGNED, null, null, null);
    // add access settings field to report builder
    $result = $result && add_field($table, $field);

    $field = new XMLDBField('embeddedurl');
    $field->setAttributes(XMLDB_TYPE_CHAR, '255', null, null, null, null);
    // add embeddedurl field to report builder
    $result = $result && add_field($table, $field);


    // create tables for columns
    $table = new XMLDBTable('report_builder_columns');
    if(!table_exists($table)) {

    /// Adding fields to table report_builder_columns
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->addFieldInfo('reportid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('type', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('value', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('heading', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('sortorder', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);

    /// Adding keys to table report_builder_columns
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));

    /// Launch create table for report_builder_columns
        create_table($table);
    }


    // create tables for filters
    $table = new XMLDBTable('report_builder_filters');
    if(!table_exists($table)) {

    /// Adding fields to table report_builder_filters
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->addFieldInfo('reportid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('type', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('value', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('advanced', XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('sortorder', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);

    /// Adding keys to table report_builder_filters
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));

    /// Launch create table for report_builder_filters
        create_table($table);
    }



    // migration to new db layout for filters, columns and restrictions
    if($reports = get_records('report_builder')) {
        foreach($reports as $report) {
            $columns = unserialize($report->columns);
            $filters = unserialize($report->filters);
            $restrictions = unserialize($report->restriction);

            // move columns to separate table
            $so = 1;
            if(is_array($columns)) {
                foreach($columns as $column) {
                    $todb = new object();
                    $todb->reportid = $report->id;
                    $todb->type = $column['type'];
                    $todb->value = $column['value'];
                    $todb->heading = isset($column['heading']) ? $column['heading'] : '';
                    $todb->sortorder = $so;
                    $result = $result && insert_record('report_builder_columns', $todb);
                    $so++;
                }
            }

            // move filters to separate table
            $so = 1;
            if(is_array($filters)) {
                foreach($filters as $filter) {
                    $todb = new object();
                    $todb->reportid = $report->id;
                    $todb->type = $filter['type'];
                    $todb->value = $filter['value'];
                    $todb->advanced = isset($filter['advanced']) ? $filter['advanced'] : 0;
                    $todb->sortorder = $so;
                    $result = $result && insert_record('report_builder_filters', $todb);
                    $so++;
                }
            }

            // split restrictions into access and content
            if(is_array($restrictions)) {
                $contentsettings = $accesscaps = $accessroles = array();
                $ownset = $reportsset = false;
                foreach($restrictions as $restriction) {
                    if(is_array($restriction)) {
                        // old-style entry - use the function name element
                        $restriction = $restriction['funcname'];
                    }

                    switch ($restriction) {
                    case 'all':
                    case '':
                        // no content or access restrictions
                        // skip any other settings and allow all
                        $todb = new object();
                        $todb->id = $report->id;
                        $todb->accessmode = 1;
                        $todb->contentmode = 0;
                        $result = $result && update_record('report_builder', $todb);
                        // make it admin only
                        $todb = new object();
                        $todb->reportid = $report->id;
                        $todb->accesstype = 'role';
                        $todb->typeid = get_field('role', 'id', 'shortname', 'administrator');
                        $result = $result && insert_record('report_builder_access', $todb);
                        continue 3;
                    case 'local_completed_records':
                    case 'local_completed':
                        $accesscaps['moodle/local:viewlocalreports'] = 1;
                        $contentsettings['completed_org'] = array('enable' => 1, 'recursive' => 1);
                        break;
                    case 'local_records':
                    case 'local':
                        $accesscaps['moodle/local:viewlocalreports'] = 1;
                        $contentsettings['current_org'] = array('enable' => 1, 'recursive' => 1);
                        break;
                    case 'staff_records':
                    case 'staff':
                        $accesscaps['moodle/local:viewstaffreports'] = 1;
                        $who = ($ownset) ? 'ownandreports' : 'reports';
                        $contentsettings['user'] = array('enable' => 1, 'who' => $who);
                        $reportsset = true;
                        break;
                    case 'own':
                        $accesscaps['moodle/local:viewownreports'] = 1;
                        $who = ($reportsset) ? 'ownandreports' : 'own';
                        $contentsettings['user'] = array('enable' => 1, 'who' => $who);
                        $ownset = true;
                        break;
                    default:
                        // do nothing - report will not show any content or assign any roles
                    }

                }

                foreach(array_keys($accesscaps) as $cap) {
                    // get roles with that capability
                    $roles = get_roles_with_capability($cap, CAP_ALLOW);
                    // save a list of roles
                    foreach($roles as $role) {
                        $accessroles[$role->id] = 1;
                    }
                }

                // set access mode to restricted
                $todb = new object();
                $todb->id = $report->id;
                $todb->accessmode = 1;
                $result = $result && update_record('report_builder', $todb);

                // assign roles to this report
                foreach(array_keys($accessroles) as $role) {
                    $todb = new object();
                    $todb->reportid = $report->id;
                    $todb->accesstype = 'role';
                    $todb->typeid = $role;
                    $result = $result && insert_record('report_builder_access', $todb);
                }

                // set the content settings
                $todb = new object();
                $todb->id = $report->id;
                $todb->contentmode = 1; // 'any' mode
                $todb->contentsettings = serialize($contentsettings);
                $result = $result && update_record('report_builder', $todb);
            }
        }
    }



    // drop the old restriction, columns and filters fields
    $table = new XMLDBTable('report_builder');
    $field = new XMLDBField('columns');
    $result = $result && drop_field($table, $field);

    $field = new XMLDBField('filters');
    $result = $result && drop_field($table, $field);

    $field = new XMLDBField('restriction');
    $result = $result && drop_field($table, $field);
}

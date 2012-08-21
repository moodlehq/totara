<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
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
 * @author Jonathan Newman <jonathan.newman@catalyst.net.nz>
 * @author Ciaran Irvine <ciaran.irvine@totaralms.com>
 * @package totara
 * @subpackage totara_core
 */

/**
 * Local db upgrades for Totara Core
 */

require_once($CFG->dirroot.'/totara/core/db/utils.php');


/**
 * Local database upgrade script
 *
 * @param   integer $oldversion Current (pre-upgrade) local db version timestamp
 * @return  boolean $result
 */
function xmldb_totara_hierarchy_upgrade($oldversion) {
    global $CFG, $DB, $OUTPUT;
    $dbman = $DB->get_manager();

    if ($oldversion < 2012071000) {
        $table = new xmldb_table('pos_type_info_field');
        $field = new xmldb_field('defaultdata', XMLDB_TYPE_TEXT, 'big', null, null, null, null, 'forceunique');
        if ($dbman->field_exists($table, $field)) {
            $dbman->change_field_notnull($table, $field);
        }
        totara_upgrade_mod_savepoint(true, 2012071000, 'totara_hierarchy');
    }

    //Update to set default proficient value in competency scale
    if ($oldversion < 2012071200) {
        $scaleid = $DB->get_field('comp_scale', 'id', array('name' => get_string('competencyscale', 'totara_hierarchy')));
        if (!$DB->record_exists('comp_scale_values', array('scaleid' => $scaleid, 'proficient' => 1))) {
            $scalevalueid = $DB->get_field_sql("
                    SELECT id
                    FROM {comp_scale_values}
                    WHERE scaleid = ?
                    ORDER BY sortorder ASC", array($scaleid), IGNORE_MULTIPLE);
            $todb = new stdClass();
            $todb->id = $scalevalueid;
            $todb->proficient = 1;
            $DB->update_record('comp_scale_values', $todb);
        }
        totara_upgrade_mod_savepoint(true, 2012071200, 'totara_hierarchy');
    }

    //Update to make position assignments table schema more robust
    if ($oldversion < 2012092600) {
        //Remove potential duplicates
        upgrade_course_completion_remove_duplicates(
            'pos_assignment',
            array('userid', 'type')
        );

        //Cleaning table 'pos_assignment': remove records where userid is NULL or type is NULL
        $nullrecords = $DB->count_records_select('pos_assignment', 'userid IS NULL OR type IS NULL');
        if ($nullrecords > 0) {
            $DB->delete_records_select('pos_assignment', 'userid IS NULL OR type IS NULL');
            echo $OUTPUT->heading("Cleaning up data in 'pos_assignment' table ({$nullrecords} records with NULL values found and removed)");
        }

        $table = new xmldb_table('pos_assignment');
        $field1 = new xmldb_field('userid', XMLDB_TYPE_INTEGER, '20', null, XMLDB_NOTNULL, null, null, 'organisationid');
        $field2 = new xmldb_field('type', XMLDB_TYPE_INTEGER, '20', null, XMLDB_NOTNULL, null, '1', 'reportstoid');
        $index1 = new xmldb_index('usetyp', XMLDB_INDEX_UNIQUE, array('userid', 'type'));
        $index2 = new xmldb_index('use', XMLDB_INDEX_NOTUNIQUE, array('userid'));
        if ($dbman->field_exists($table, $field1) && $dbman->field_exists($table, $field2)) {
            //Dropping indexes to update fields
            $dbman->drop_index($table, $index1);
            $dbman->drop_index($table, $index2);
            $dbman->change_field_notnull($table, $field1);
            $dbman->change_field_notnull($table, $field2);
            $dbman->change_field_default($table, $field2);
            //Recreating dropped indexes
            $dbman->add_index($table, $index1);
            $dbman->add_index($table, $index2);
        }

        //Cleaning table 'pos_assignment_history': remove records where userid is NULL or type is NULL
        $nullrecords = $DB->count_records_select('pos_assignment_history', 'userid IS NULL OR type IS NULL');
        if ($nullrecords > 0) {
            $DB->delete_records_select('pos_assignment_history', 'userid IS NULL OR type IS NULL');
            echo $OUTPUT->heading("Cleaning up data in 'pos_assignment_history' table ({$nullrecords} records with NULL values found and removed)");
        }

        $table = new xmldb_table('pos_assignment_history');
        $field1 = new xmldb_field('userid', XMLDB_TYPE_INTEGER, '20', null, XMLDB_NOTNULL, null, null, 'organisationid');
        $field2 = new xmldb_field('type', XMLDB_TYPE_INTEGER, '20', null, XMLDB_NOTNULL, null, '1', 'reportstoid');
        if ($dbman->field_exists($table, $field1) && $dbman->field_exists($table, $field2)) {
            $dbman->change_field_notnull($table, $field1);
            $dbman->change_field_notnull($table, $field2);
            $dbman->change_field_default($table, $field2);
        }
        totara_upgrade_mod_savepoint(true, 2012092600, 'totara_hierarchy');
    }

    if ($oldversion < 2012110500) {
        // set positionsenabled default config
        if (get_config('totara_hierarchy', 'positionsenabled') === false) {
            set_config('positionsenabled', '1,2,3', 'totara_hierarchy');
        }

        totara_upgrade_mod_savepoint(true, 2012110500, 'totara_hierarchy');
    }

    return true;
}

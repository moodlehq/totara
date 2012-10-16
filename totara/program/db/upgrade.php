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
 * @author Ciaran Irvine <ciaran.irvine@totaralms.com>
 * @package totara
 * @subpackage program
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
function xmldb_totara_program_upgrade($oldversion) {
    global $CFG, $DB;
    $dbman = $DB->get_manager(); // loads ddl manager and xmldb classes

    if ($oldversion < 2012070600) {
        //doublecheck organisationid and positionid tables exist in prog_completion tables (T-9752)
        $table = new xmldb_table('prog_completion');
        $field = new xmldb_field('organisationid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, 'timecompleted');
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('positionid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, 'organisationid');
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        $table = new xmldb_table('prog_completion_history');
        $field = new xmldb_field('organisationid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, 'recurringcourseid');
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        $field = new xmldb_field('positionid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, 'organisationid');
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        totara_upgrade_mod_savepoint(true, 2012070600, 'totara_program');
    }

    if ($oldversion < 2012072700) {

        // a bug in the lang strings would have resulted in too many % symbols being stored in
        // the program messages - update any incorrect messages
        $sql = "UPDATE {prog_message} SET messagesubject = REPLACE(messagesubject, '%%programfullname%%', '%programfullname%'),
                mainmessage = REPLACE(" . $DB->sql_compare_text('mainmessage', 1024) . ", '%%programfullname%%', '%programfullname%')";
        $DB->execute($sql);
        totara_upgrade_mod_savepoint(true, 2012072700, 'totara_program');
    }

    if ($oldversion < 2012072701) {
        // Fix context levels on program capabilities
        $like_sql = $DB->sql_like('name', '?');
        $params = array(CONTEXT_PROGRAM, 'totara/program%');
        $DB->execute("UPDATE {capabilities} SET contextlevel = ? WHERE $like_sql", $params);
        totara_upgrade_mod_savepoint(true, 2012072701, 'totara_program');
    }

    if ($oldversion < 2012080300) {
        //get program enrolment plugin
        $program_plugin = enrol_get_plugin('totara_program');

        // add enrollment plugin to all courses associated with programs
        $program_courses = prog_get_courses_associated_with_programs();
        foreach ($program_courses as $course) {
            //add plugin
            $program_plugin->add_instance($course);
        }
        totara_upgrade_mod_savepoint(true, 2012080300, 'totara_program');
    }

    if ($oldversion < 2012080301) {
        //set up role assignment levels
        //allow all roles except guest, frontpage and authenticateduser to be assigned at Program level
        $roles = $DB->get_records('role', array(), '', 'id, archetype');
        $rcl = new stdClass();
        foreach ($roles as $role) {
            if (isset($role->archetype) && ($role->archetype != 'guest' && $role->archetype != 'user' && $role->archetype != 'frontpage')) {
                $rolecontextlevels[$role->id] = CONTEXT_PROGRAM;
                $rcl->roleid = $role->id;
                $rcl->contextlevel = CONTEXT_PROGRAM;
                $DB->insert_record('role_context_levels', $rcl, false);
            }
        }
        totara_upgrade_mod_savepoint(true, 2012080301, 'totara_program');
    }

    if ($oldversion < 2012081500) {
        // update completion fields to support signed values
        // as no completion date set uses -1
        $table = new xmldb_table('prog_assignment');
        $field = new xmldb_field('completiontime', XMLDB_TYPE_INTEGER, 10, false, XMLDB_NOTNULL, null, '0', 'includechildren');
        $dbman->change_field_unsigned($table, $field);

        $table = new xmldb_table('prog_completion');
        $field = new xmldb_field('timedue', XMLDB_TYPE_INTEGER, 10, false, XMLDB_NOTNULL, null, '0', 'timestarted');
        $dbman->change_field_unsigned($table, $field);

        $table = new xmldb_table('prog_completion_history');
        $field = new xmldb_field('timedue', XMLDB_TYPE_INTEGER, 10, false, XMLDB_NOTNULL, null, '0', 'timestarted');
        $dbman->change_field_unsigned($table, $field);

        totara_upgrade_mod_savepoint(true, 2012081500, 'totara_program');
    }
    return true;
}

<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
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
                mainmessage = REPLACE(mainmessage, '%%programfullname%%', '%programfullname%')";
        $DB->execute($sql);
        totara_upgrade_mod_savepoint(true, 2012072700, 'totara_program');
    }
    return true;
}

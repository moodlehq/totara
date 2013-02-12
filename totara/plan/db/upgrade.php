<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2013 Totara Learning Solutions LTD
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
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage plan
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
function xmldb_totara_plan_upgrade($oldversion) {
    global $CFG, $DB;
    $dbman = $DB->get_manager(); // loads ddl manager and xmldb classes


    if ($oldversion < 2013021400) {
        $table = new xmldb_table('dp_template');
        $field = new xmldb_field('isdefault', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, 0);

        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Make the first record on the list default to keep current
        // default
        $record = $DB->get_record_select('dp_template', 'sortorder = (SELECT MIN(sortorder) FROM {dp_template})');
        $todb = new stdClass();
        $todb->id = $record->id;
        $todb->isdefault = 1;
        $DB->update_record('dp_template', $todb);


        // Add column to plan table to record how a plan was created
        $table = new xmldb_table('dp_plan');
        $field = new xmldb_field('createdby', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, 0);

        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Add template foreign key
        $key = new xmldb_key('templateid', XMLDB_KEY_FOREIGN, array('templateid'), 'dp_template', array('id'));
        $dbman->add_key($table, $key);

        // Add user foreign key
        $key = new xmldb_key('userid', XMLDB_KEY_FOREIGN, array('userid'), 'user', array('id'));
        $dbman->add_key($table, $key);

        totara_upgrade_mod_savepoint(true, 2013021400, 'totara_plan');
    }

    return true;
}

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
    global $CFG, $DB;
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

    return true;
}
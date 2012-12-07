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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @package totara
 * @subpackage cohort
 */

/**
 * DB upgrades for Totara Sync
 */

function xmldb_tool_totara_sync_upgrade($oldversion) {

    global $CFG, $DB;

    $dbman = $DB->get_manager();

    // Totara 2.2+ upgrade

    if ($oldversion < 2012101100) {
        // Rename to deleted
        $sql = "UPDATE {config_plugins}
            SET name = 'fieldmapping_deleted'
            WHERE plugin = 'totara_sync_source_user_csv'
            AND name = 'fieldmapping_delete' ";
        $DB->execute($sql);

        // Rename to deleted
        $sql = "UPDATE {config_plugins}
            SET name = 'import_deleted'
            WHERE plugin = 'totara_sync_source_user_csv'
            AND name = 'import_delete' ";
        $DB->execute($sql);

        // Set "delete" as the default source name if no field mapping already exists
        // This will allow the existing sources to remain unchanged.
        $sql = "UPDATE {config_plugins}
            SET value = 'delete'
            WHERE plugin = 'totara_sync_source_user_csv'
            AND name = 'fieldmapping_deleted'
            AND " . $DB->sql_compare_text('value') . " = ''";
        $DB->execute($sql);

        upgrade_plugin_savepoint(true, 2012101100, 'tool', 'totara_sync');
    }

    //manual modifying permissions in $DB to retain any existing permissions
    if ($oldversion < 2012121200) {
        $oldname = 'tool/totara_sync:setfilesdirectory';
        $newname = 'tool/totara_sync:setfileaccess';

        $sql_capability = "UPDATE {capabilities} SET name = ? WHERE name = ?";
        $DB->execute($sql_capability, array($newname, $oldname));

        $sql_role_capability = "UPDATE {role_capabilities} SET capability = ? WHERE capability = ?";
        $DB->execute($sql_role_capability, array($newname, $oldname));

        upgrade_plugin_savepoint(true, 2012121200, 'tool', 'totara_sync');
    }

    return true;

}

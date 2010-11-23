<?php
///////////////////////////////////////////////////////////////////////////
//                                                                       //
// This file is part of Moodle - http://moodle.org/                      //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//                                                                       //
// Moodle is free software: you can redistribute it and/or modify        //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation, either version 3 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// Moodle is distributed in the hope that it will be useful,             //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details.                          //
//                                                                       //
// You should have received a copy of the GNU General Public License     //
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.       //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

/**
 * Upgrade code for the oauth plugin
 * @package   local_totara_msg
 * @copyright 2010 Moodle Pty Ltd (http://moodle.com)
 * @author    Piers Harding
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function xmldb_local_totara_msg_upgrade($oldversion) {
    global $CFG;

    $result = true;

    if ($result && $oldversion < 2010110102) {

        $table = new XMLDBTable('message_metadata');

        // drop the existing message index
        $index = new XMLDBIndex('message');
        $index->setUnique(true);
        $index->setFields(array('messageid'));
        drop_index($table, $index);

        // add the roleid
        $field = new XMLDBField('roleid');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'urgency');
        $result = $result && add_field($table, $field);

        // rebuild index to include the roleid
        $index->setFields(array('messageid', 'roleid'));
        $result = $result && add_index($table, $index);
    }

    if ($result && $oldversion < 2010110103) {
        // hack to get cron working via admin/cron.php
        // at some point we should create a local_modules table
        // based on data in version.php
        set_config('local_totara_msg_cron', 60);
    }

    // totaramessage report source - delete all
    if ($result && $oldversion < 2010110105) {
        $reports = get_records('report_builder', 'source', 'totaramessages');
        if ($reports) {
            foreach ($reports as $report) {
                totara_msg_delete_report($report->id);
            }
        }
    }

    // ensure unique indexes
    if ($result && $oldversion < 2010110106) {
        // drop the existing message index
        $table = new XMLDBTable('message_metadata');
        $index = new XMLDBIndex('message');
        $index->setUnique(true);
        $index->setFields(array('messageid', 'roleid'));
        drop_index($table, $index);
        // recreate with messageid only
        $index->setFields(array('messageid'));
        $result = $result && add_index($table, $index);

        // create new index based on roleid
        $index = new XMLDBIndex('role');
        $index->setUnique(true);
        $index->setFields(array('roleid', 'messageid'));
        $result = $result && add_index($table, $index);
    }

    /// Check all message20 output plugins and upgrade if necessary
/// This is temporary until Totara goes to 2.x - then migrate local/totara_msg/message20 to message
    upgrade_plugins('local','local/totara_msg/message20/output',"$CFG->wwwroot/$CFG->admin/index.php");

    return $result;
}

/**
 * Deletes a report and any associated data
 *
 * @param integer $id ID of the report to delete
 *
 * @return boolean True if report was successfully deleted
 */
function totara_msg_delete_report($id) {

    if(!$id) {
        return false;
    }

    begin_sql();
    // delete the report
    if(!delete_records('report_builder','id',$id)) {
        rollback_sql();
        return false;
    }
    // delete any columns
    if(!delete_records('report_builder_columns','reportid',$id)) {
        rollback_sql();
        return false;
    }
    // delete any filters
    if(!delete_records('report_builder_filters','reportid',$id)) {
        rollback_sql();
        return false;
    }
    // delete any content and access settings
    if(!delete_records('report_builder_settings','reportid',$id)) {
        rollback_sql();
        return false;
    }
    // delete any saved searches
    if(!delete_records('report_builder_saved','reportid',$id)) {
        rollback_sql();
        return false;
    }

    // all okay commit changes
    commit_sql();
    return true;

}

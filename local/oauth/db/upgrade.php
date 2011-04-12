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
 * @package   localoauth
 * @copyright 2010 Moodle Pty Ltd (http://moodle.com)
 * @author    Piers Harding
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function xmldb_local_oauth_upgrade($oldversion) {
    global $CFG, $USER, $db, $OUTPUT;

    $result = true;

    // tables for scheduled reports
    if ($result && $oldversion < 2010060903) {
        $table = new XMLDBTable('oauth_access_token');
        if(!table_exists($table)) {
            $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
            $table->addFieldInfo('siteid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
            $table->addFieldInfo('userid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
            $table->addFieldInfo('access_token', XMLDB_TYPE_CHAR, '255', null, null, null, null, null, null);
            $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
            $table->addKeyInfo('siteid', XMLDB_INDEX_NOTUNIQUE, array('siteid'));
            $table->addKeyInfo('userid', XMLDB_INDEX_NOTUNIQUE, array('userid'));
            $result = $result && create_table($table);
        }
    }

    return $result;
}

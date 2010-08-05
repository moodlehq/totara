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
    global $CFG, $USER, $DB, $OUTPUT;

    require_once($CFG->libdir.'/db/upgradelib.php'); // Core Upgrade-related functions

    $result = true;

    $dbman = $DB->get_manager(); // loads ddl manager and xmldb classes


/*
    if ($result && $oldversion < 2010031610) {

    /// Define field sitecourseid to be added to oauth_site_directory
        $table = new xmldb_table('oauth_site_directory');
        $field = new xmldb_field('sitecourseid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, 0, 'siteid');

    /// Conditionally launch add field sitecourseid
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

    /// oauth savepoint reached
        upgrade_plugin_savepoint($result, 2010031610, 'local', 'oauth');
    }
    */

    return $result;
}

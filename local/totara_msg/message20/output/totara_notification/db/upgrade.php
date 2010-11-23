<?php

///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT                                                   //
//                                                                       //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//          http://moodle.com                                            //
//                                                                       //
// Copyright (C) 1999 onwards  Martin Dougiamas  http://moodle.com       //
//                                                                       //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

/**
 * Upgrade code for popup message processor
 *
 * @author Luis Rodrigues
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package
 */

function xmldb_local_totara_notification_upgrade($oldversion) {
    //global $CFG, $DB;
    global $CFG;

    //$dbman = $DB->get_manager();

    if ($oldversion < 2010110101) {
        $processor = new stdClass();
        $processor->name  = 'totara_notification';
        if (! record_exists('message_processors20', array('name' => $processor->name))){
            insert_record('message_processors20', $processor);
        }

    /// popup savepoint reached
        upgrade_plugin_savepoint(true, 2010110101, 'message', 'totara_notification');
    }

    return true;
}

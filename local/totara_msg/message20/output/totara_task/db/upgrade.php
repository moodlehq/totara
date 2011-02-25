<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 * Copyright (C) 1999 onwards Martin Dougiamas 
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
 * @author Piers Harding <piers@catalyst.net.nz>
 * @author Luis Rodrigues
 * @package totara
 * @subpackage totara_msg 
 */

/**
 * Upgrade code for popup message processor
 */

function xmldb_local_totara_task_upgrade($oldversion) {
    //global $CFG, $DB;
    global $CFG;

    //$dbman = $DB->get_manager();

    if ($oldversion < 2010110101) {
        $processor = new stdClass();
        $processor->name  = 'totara_task';
        if (! record_exists('message_processors20', array('name' => $processor->name))){
            insert_record('message_processors20', $processor);
        }

    /// popup savepoint reached
        upgrade_plugin_savepoint(true, 2010110101, 'message', 'totara_task');
    }

    return true;
}

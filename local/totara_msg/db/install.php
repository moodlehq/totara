<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
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
 * @package totara
 * @subpackage totara_msg 
 */

// This file replaces:
//   * STATEMENTS section in db/install.xml
//   * lib.php/modulename_install() post installation hook
//   * partially defaults.php

function xmldb_local_totara_msg_install() {
    global $CFG;

/// Install logging support
//    update_log_display_entry('local_totara_msg', 'add', 'local_totara_msg', 'name');

/// Check all message20 output plugins and upgrade if necessary
/// This is temporary until Totara goes to 2.x - then migrate local/totara_msg/message20 to message
    upgrade_plugins('local','local/totara_msg/message20/output',"$CFG->wwwroot/$CFG->admin/index.php");

    // hack to get cron working via admin/cron.php
    // at some point we should create a local_modules table
    // based on data in version.php
    set_config('local_totara_msg_cron', 60);

    return true;
}

<?php
/*
* This file is part of Totara LMS
*
* Copyright (C) 2010, 2011 Totara Learning Solutions LTD
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
* @subpackage totara_sync
*/

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot . '/admin/tool/totara_sync/lib.php');

/**
* Run the cron for syncing Totara elements with external sources
*
* This is run separately from the main cron via run_cron.php
*
* @access public
* @return void
*/
function totara_sync_cron() {
    global $CFG;

    // Get enabled sync element objects
    $elements = totara_sync_get_elements($onlyenabled=true);

    foreach ($elements as $element) {
        if (!method_exists($element, 'sync')) {
            // Skip if no sync() method exists
            continue;
        }

        // Finally, start element syncing
        $element->sync();
    }

    return true;
}


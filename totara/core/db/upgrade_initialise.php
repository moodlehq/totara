<?php
/*
* This file is part of Totara LMS
*
* Copyright (C) 2012 - 2013 Totara Learning Solutions LTD
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
* @package totara
* @subpackage totara_core
*/

defined('MOODLE_INTERNAL') || die();

global $OUTPUT, $DB;
require_once ("$CFG->dirroot/totara/core/db/utils.php");

// switch to default theme in 2.4
set_config('theme', 'standardtotara');

$dbman = $DB->get_manager(); // loads ddl manager and xmldb classes
$success = get_string('success');

//example of an upgrade output item
//echo $OUTPUT->heading('Disable Moodle autoupdates in Totara');
//echo $OUTPUT->notification($success, 'notifysuccess');
//print_upgrade_separator();

?>

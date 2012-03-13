<?php
/*
* This file is part of Totara LMS
*
* Copyright (C) 2012 Totara Learning Solutions LTD
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
* @author Ciaran Irvine <ciaran.irvine@totaralms.com>
* @package totara
* @subpackage totara_core
*/

defined('MOODLE_INTERNAL') || die();

global $OUTPUT, $DB;

require_once ("$CFG->dirroot/totara/core/db/utils.php");

//fix 1.1-series capabilities
$result = totara_upgrade_capabilities();
if ($result) {
    upgrade_log(UPGRADE_LOG_NORMAL, 'totara/core', 'Capabilities upgraded from 1.1');
    echo $OUTPUT->notification(get_string('success'), 'notifysuccess');
    print_upgrade_separator();
} else {
    throw new upgrade_exception("Totara Upgrade Capabilities Failed", '1.1 to 2.2 upgrade');
}
//fix blocks where name has changed
$sql = "UPDATE {block} SET name=? WHERE name=?";
$params = array('totara_guides', 'guides');
$result = $result && $DB->execute($sql, $params);
$sql = "UPDATE {block} SET name=? WHERE name=?";
$params = array('totara_quicklinks', 'quicklinks');
$result = $result && $DB->execute($sql, $params);
if ($result) {
    upgrade_log(UPGRADE_LOG_NORMAL, 'totara/core', 'Totara Blocks renamed');
    echo $OUTPUT->notification(get_string('success'), 'notifysuccess');
    print_upgrade_separator();
} else {
    throw new upgrade_exception("Totara Set Block Names Failed", '1.1 to 2.2 upgrade');
}

//remove extensions from icons in database - 5 possible tables
$tables = array('course', 'prog', 'pos_type', 'org_type', 'comp_type');
foreach ($tables as $table) {
    $sql = "SELECT id, icon FROM
                                {".$table."}
                                WHERE (icon LIKE '%.gif' OR icon LIKE '%.png')";
    $rs = $DB->get_records_sql($sql);
    foreach ($rs as $r) {
        $r->icon = str_replace(".png", "", $r->icon);
        $r->icon = str_replace(".gif", "", $r->icon);
        $DB->update_record($table, $r);
        upgrade_set_timeout();
    }
}
upgrade_log(UPGRADE_LOG_NORMAL, 'totara/core', 'Totara icon extensions fixed');
echo $OUTPUT->notification(get_string('success'), 'notifysuccess');
print_upgrade_separator();

// Changing nullability of char fields
totara_fix_nullable_charfield('course_info_category', 'name', 'id', '255');
totara_fix_nullable_charfield('course_info_field', 'shortname', 'fullname', '100');
totara_fix_nullable_charfield('course_info_field', 'datatype', 'shortname', '255');
totara_fix_nullable_charfield('oldpassword', 'hash', 'uid', '100');

$idx = array();
$idx[] = new xmldb_index('remi_typ_ix', XMLDB_INDEX_NOTUNIQUE, array('type'));
totara_fix_nullable_charfield('reminder', 'type', 'title', '10', null, null, $idx);

$idx = array();
$idx[] = new xmldb_index('remimess_typ_ix', XMLDB_INDEX_NOTUNIQUE, array('type'));
totara_fix_nullable_charfield('reminder_message', 'type', 'reminderid', '10', null, null, $idx);

totara_fix_nullable_charfield('errorlog', 'version', 'timeoccured', '255');
totara_fix_nullable_charfield('errorlog', 'build', 'version', '255');
totara_fix_nullable_charfield('errorlog', 'hash', 'details', '32');
upgrade_log(UPGRADE_LOG_NORMAL, 'totara/core', 'Change nullable character fields');
echo $OUTPUT->notification(get_string('success'), 'notifysuccess');
print_upgrade_separator();
?>

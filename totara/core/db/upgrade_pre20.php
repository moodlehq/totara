<?php
/*
* This file is part of Totara LMS
*
* Copyright (C) 2012 Totara Learning Solutions LTD
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

// switch to new default theme in 2.2
set_config('theme', 'standardtotara');

$dbman = $DB->get_manager(); // loads ddl manager and xmldb classes
$success = get_string('success');

if ($DB->record_exists('role', array('shortname' => 'staffmanager'))) {
    echo $OUTPUT->notification(get_string('error:staffmanagerroleexists', 'totara_core'));
    upgrade_log(UPGRADE_LOG_ERROR, 'totara/core', get_string('error:staffmanagerroleexists', 'totara_core'));
    die();
}

//fix 1.1-series capabilities
totara_upgrade_capabilities();
upgrade_log(UPGRADE_LOG_NORMAL, 'totara/core', 'Capabilities upgraded from 1.1');
echo $OUTPUT->heading('Capabilities upgraded from 1.1');
echo $OUTPUT->notification($success, 'notifysuccess');
print_upgrade_separator();

//fix blocks where name has changed
$sql = "UPDATE {block} SET name=? WHERE name=?";
$params = array('totara_quicklinks', 'quicklinks');
$DB->execute($sql, $params);

upgrade_log(UPGRADE_LOG_NORMAL, 'totara/core', 'Totara Blocks renamed');
echo $OUTPUT->heading('Totara Blocks renamed');
echo $OUTPUT->notification($success, 'notifysuccess');
print_upgrade_separator();


//rename manager to staff_manager to avoid breaking roles
$mgrrole = $DB->get_record('role', array('shortname' => 'manager'));
if ($mgrrole) {
    $mgrrole->shortname = 'staffmanager';
    $mgrrole->name = get_string('staffmanager', 'totara_core');
    $DB->update_record('role', $mgrrole);
    //remove legacy/manager capability: this is used later during upgrade_core to add archetype='manager',
    //which in turn then means this role would get lots of module capabilities during the upgrade_non_core module upgrade process
    $params = array('capability' => 'moodle/legacy:manager', 'roleid' => $mgrrole->id);
    $DB->delete_records('role_capabilities', $params);
    upgrade_log(UPGRADE_LOG_NORMAL, 'totara/core', 'Totara Manager Role renamed');
    echo $OUTPUT->heading('Totara Manager Role renamed');
    echo $OUTPUT->notification(get_string('success'), 'notifysuccess');
    print_upgrade_separator();
}

//remove extensions and spaces from icons in database - 5 possible tables
$tables = array('course', 'prog', 'pos_type', 'org_type', 'comp_type');
foreach ($tables as $table) {
    $like_sql = $DB->sql_like('icon', '?');
    $sql = "SELECT id, icon FROM {{$table}}
        WHERE ($like_sql OR $like_sql)";
    $rs = $DB->get_records_sql($sql, array('%.gif', '%.png'));
    foreach ($rs as $r) {
        $r->icon = str_replace(" ", "-", $r->icon);
        $r->icon = str_replace(".png", "", $r->icon);
        $r->icon = str_replace(".gif", "", $r->icon);
        $DB->update_record($table, $r);
        upgrade_set_timeout();
    }
}

// Fix program icons that are set to "none"
$DB->execute("UPDATE {prog} SET icon = '' WHERE icon = 'none'");

upgrade_log(UPGRADE_LOG_NORMAL, 'totara/core', 'Totara icon extensions fixed');
echo $OUTPUT->heading('Totara icon extensions fixed');
echo $OUTPUT->notification($success, 'notifysuccess');
print_upgrade_separator();

// Changing nullability of char fields
totara_fix_nullable_charfield('comp_type', 'description', 'shortname', 'medium', null, null, null, XMLDB_TYPE_TEXT);
totara_fix_nullable_charfield('comp_scale', 'description', 'name', 'medium', null, null, null, XMLDB_TYPE_TEXT);
totara_fix_nullable_charfield('course_info_field', 'shortname', 'fullname', '100');
totara_fix_nullable_charfield('course_info_field', 'datatype', 'shortname', '255');
totara_fix_nullable_charfield('oldpassword', 'hash', 'uid', '100');

$idx = array(new xmldb_index('remi_typ_ix', XMLDB_INDEX_NOTUNIQUE, array('type')));
totara_fix_nullable_charfield('reminder', 'type', 'title', '10', null, null, $idx);

$idx = array(new xmldb_index('remimess_typ_ix', XMLDB_INDEX_NOTUNIQUE, array('type')));
totara_fix_nullable_charfield('reminder_message', 'type', 'reminderid', '10', null, null, $idx);

totara_fix_nullable_charfield('errorlog', 'version', 'timeoccured', '255');
totara_fix_nullable_charfield('errorlog', 'build', 'version', '255');
totara_fix_nullable_charfield('errorlog', 'hash', 'details', '32');

//plans
totara_fix_nullable_charfield('dp_template', 'fullname', 'id', '255');
totara_fix_nullable_charfield('dp_template', 'workflow', 'visible', '255');
totara_fix_nullable_charfield('dp_permissions', 'role', 'templateid', '255');
totara_fix_nullable_charfield('dp_permissions', 'component', 'role', '255');
totara_fix_nullable_charfield('dp_permissions', 'action', 'component', '255');
totara_fix_nullable_charfield('dp_priority_scale', 'name', 'id', '255');
totara_fix_nullable_charfield('dp_priority_scale_value', 'name', 'id', '255');
totara_fix_nullable_charfield('dp_objective_scale', 'name', 'id', '255');
totara_fix_nullable_charfield('dp_objective_scale_value', 'name', 'objscaleid', '255');
totara_fix_nullable_charfield('dp_plan_component_relation', 'component1', 'id', '255');
totara_fix_nullable_charfield('dp_plan_component_relation', 'component2', 'itemid1', '255');
totara_fix_nullable_charfield('dp_plan_evidence', 'name', 'planid', '255');
totara_fix_nullable_charfield('dp_plan_objective', 'fullname', 'planid', '255');

//program management
totara_fix_nullable_charfield('prog', 'fullname', 'sortorder', '254');
$idx = array(new xmldb_index('prog_idn_ix', XMLDB_INDEX_NOTUNIQUE, array('idnumber')));
totara_fix_nullable_charfield('prog', 'idnumber', 'shortname', '100', null, null, $idx);
totara_fix_nullable_charfield('prog', 'icon', 'usermodified', '100');
$idx = array(new xmldb_index('prog_sho_ix', XMLDB_INDEX_NOTUNIQUE, array('shortname')));
totara_fix_nullable_charfield('prog', 'shortname', 'fullname', '100', null, null, $idx);
totara_fix_nullable_charfield('prog_courseset', 'label', 'contenttype', '255');
totara_fix_nullable_charfield('prog_exception_data', 'dataname', 'exceptionid', '50');
totara_fix_nullable_charfield('prog_message', 'messagesubject', 'locked', '255');

upgrade_log(UPGRADE_LOG_NORMAL, 'totara/core', 'Change nullable character fields');

// remove obsolete scorm fields
$table = new xmldb_table('scorm');
$field = new xmldb_field('directview');
if ($dbman->field_exists($table, $field)) {
    $dbman->drop_field($table, $field);
}
$field = new xmldb_field('unpackmethod');
if ($dbman->field_exists($table, $field)) {
    $dbman->drop_field($table, $field);
}

//Remove obsolete report heading table
$table = new xmldb_table('report_heading_items');
if ($dbman->table_exists($table)) {
    $dbman->drop_table($table);
}

//remove obsolete category database tables
$removetables = array('course', 'comp_type', 'org_type', 'pos_type');
foreach ($removetables as $prefix) {
    $table = new xmldb_table($prefix . '_info_category');
    if ($dbman->table_exists($table)) {
        $dbman->drop_table($table);
    }
}

//ensure course and course category paths are correct before upgrade
fix_course_sortorder();

// rename 'completedate' field to 'timeend' in 'course_completion_criteria'
$table = new xmldb_table('course_completion_criteria');
$field = new xmldb_field('completedate', XMLDB_TYPE_INTEGER, 10, XMLDB_UNSIGNED, null, null, null, 'enrolperiod');
if ($dbman->field_exists($table, $field)) {
    $dbman->rename_field($table, $field, 'timeend');
}

//ensure oninfo field exists T-9963
$table = new xmldb_table('message_metadata');
$field = new xmldb_field('oninfo', XMLDB_TYPE_TEXT, 'small', null, null, null, null, 'onreject');
if (!$dbman->field_exists($table, $field)) {
    $dbman->add_field($table, $field);
}

upgrade_log(UPGRADE_LOG_NORMAL, 'totara/core', 'Totara database schema updates');
echo $OUTPUT->heading('Totara database schema updates');
echo $OUTPUT->notification($success, 'notifysuccess');
print_upgrade_separator();

//Fix urls for legacy Site Policy files
if ($sitepolicy = get_config(null, 'sitepolicy')) {
    if (strpos($sitepolicy, '/file.php/1/') !== false) {
        //using a site file, syntax has changed slightly
        $sitepolicy = str_replace('/file.php/1/', '/file.php?file=/1/', $sitepolicy);
        set_config('sitepolicy', $sitepolicy);
        upgrade_log(UPGRADE_LOG_NORMAL, 'totara/core', 'Site Policy URL updated');
        echo $OUTPUT->heading('Site Policy URL updated');
        echo $OUTPUT->notification($success, 'notifysuccess');
        print_upgrade_separator();
    }
}

// Comments
// update commentareas of plan comments to comply with PARAM_AREA
$areas = array('plan-overview' => 'plan_overview',
    'plan-course-item' => 'plan_course_item',
    'plan-competency-item' => 'plan_competency_item',
    'plan-objective-item' => 'plan_objective_item',
    'plan-program-item' => 'plan_program_item');
foreach ($areas as $from => $to) {
    $sql = 'UPDATE {comments}
        SET commentarea = ?
        WHERE commentarea = ?';
    $params = array($to, $from);
    $DB->execute($sql, $params);
}
unset($areas);
upgrade_log(UPGRADE_LOG_NORMAL, 'totara/core', 'Fixed commentarea identifiers');
echo $OUTPUT->heading('Comments - Fixed commentarea identifiers');
echo $OUTPUT->notification($success, 'notifysuccess');
print_upgrade_separator();

// Fix version for feedback module
// The version was accidentally bumpped to the current date in Totara 1.1
// We need to put it back so we dont miss any db updates for the module
$DB->execute('UPDATE {modules} set version = 2008073002 WHERE name = ?', array('feedback'));
// Fix version for scorm module
// The version was accidentally bumpped to an advanced version in Totara 1.1
// We need to put it back so we dont miss any db updates for the module
$DB->execute('UPDATE {modules} set version = 2008073000 WHERE name = ?', array('scorm'));

upgrade_log(UPGRADE_LOG_NORMAL, 'totara/core', 'Fixed version number for feedback module');
echo $OUTPUT->heading('Feedback module - Fixed version number for feedback module');
echo $OUTPUT->notification($success, 'notifysuccess');
print_upgrade_separator();

//turn off forceunique for any filepicker totara custom fields
$tables = array('course', 'pos_type', 'org_type', 'comp_type');
foreach ($tables as $table) {
    $DB->execute("UPDATE {{$table}_info_field} SET forceunique = ? WHERE datatype = ?",
    array(0, 'file'));
}

//Remove customfield data that is no longer associated with a course
$customfield_ids = $DB->get_records_sql('SELECT DISTINCT cid.id from {course_info_data} cid LEFT JOIN {course} c ON cid.courseid = c.id WHERE c.id IS NULL');
if (($num_records = count($customfield_ids)) > 0) {
    $DB->delete_records_list('course_info_data', 'id', array_keys($customfield_ids));

    upgrade_log(UPGRADE_LOG_NORMAL, 'totara/core', "Removed redundant customfield data ({$num_records} records)");
    echo $OUTPUT->heading("Custom Fields - Cleaning up redundant data ({$num_records} records removed)");
    echo $OUTPUT->notification($success, 'notifysuccess');
    print_upgrade_separator();
}

// migrate devplan plugin version and other references to new location "totara_learningplan"
// must be done before moodle 2 migrates enrollment data
$DB->execute('UPDATE {config_plugins} SET plugin = ? WHERE plugin = ?',
    array('enrol_totara_learningplan', 'enrol_totara_devplan'));
$DB->execute('UPDATE {course} SET enrol = ? WHERE enrol = ?',
    array('totara_learningplan', 'devplan'));

// enable totara_learningplan if devplan was enabled before
$enabledplugins = $CFG->enrol_plugins_enabled;
$enabledplugins = explode(',', $enabledplugins);
$newenabled = array();
foreach ($enabledplugins as $plugin) {
    if ($plugin == 'devplan') {
        $newenabled[] = 'totara_learningplan';
    } else {
        $newenabled[] = $plugin;
    }
}
set_config('enrol_plugins_enabled', implode(',', $newenabled));

upgrade_log(UPGRADE_LOG_NORMAL, 'enrol/totara_learningplan', 'Migrated devplan enrolment plugin to totara_learningplan');
echo $OUTPUT->heading('Rename old devplan enrolment plugin to "Learning Plan"');
echo $OUTPUT->notification($success, 'notifysuccess');
print_upgrade_separator();

?>

<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @author Aaron Barnes <aaron.barnes@totaralms.com>
 * @author Ciaran Irvine <ciaran.irvine@totaralms.com>
 * @package totara
 * @subpackage totara_core
 */

/**
* Totara Module upgrade savepoint, marks end of Totara module upgrade blocks
* It stores module version, resets upgrade timeout
*
* @global object $DB
* @param bool $result false if upgrade step failed, true if completed
* @param string or float $version main version
* @param string $modname name of module
* @return void
*/
function totara_upgrade_mod_savepoint($result, $version, $modname) {
    global $DB;

    if (!$result) {
        throw new upgrade_exception($modname, $version);
    }

    if (!$module = $DB->get_record('config_plugins', array('plugin'=>$modname, 'name'=>'version'))) {
        print_error('modulenotexist', 'debug', '', $modname);
    }

    if ($module->value >= $version) {
        // something really wrong is going on in upgrade script
        throw new downgrade_exception($modname, $module->version, $version);
    }
    $module->value = $version;
    $DB->update_record('config_plugins', $module);
    upgrade_log(UPGRADE_LOG_NORMAL, $modname, 'Upgrade savepoint reached');

    // reset upgrade timeout to default
    upgrade_set_timeout();
}

/**
 * Utility functions for performing Totara local db upgrades
 */


/**
* totara_get_capability_upgrade_map, returns map of 1.1 capabilities to 2.2 capabilities
*
* array in form array[oldcapname] = array(['newcap']=newcapname, ['component']=newcomponent)
* @return array
*/
function totara_get_capability_upgrade_map() {
    $upgrade_caps = array (
    'moodle/local:markcomplete' => array('newcap'=>'moodle/course:markcomplete', 'component' => 'moodle'),
    'local/comment:delete' => array('newcap'=>'moodle/comment:delete', 'component' => 'moodle'),
    'local/comment:post' => array('newcap'=>'moodle/comment:post', 'component' => 'moodle'),
    'local/comment:view' => array('newcap'=>'moodle/comment:view', 'component' => 'moodle'),
    'moodle/local:createcoursecustomfield' => array('newcap'=>'totara/core:createcoursecustomfield', 'component' => 'totara/core'),
    'moodle/local:deletecoursecustomfield' => array('newcap'=>'totara/core:deletecoursecustomfield', 'component' => 'totara/core'),
    'moodle/local:updatecoursecustomfield' => array('newcap'=>'totara/core:updatecoursecustomfield', 'component' => 'totara/core'),
    'local/cohort:assign' => array('newcap'=>'totara/cohort:assign', 'component' => 'totara/cohort'),
    'local/cohort:manage' => array('newcap'=>'totara/cohort:manage', 'component' => 'totara/cohort'),
    'local/cohort:view' => array('newcap'=>'totara/cohort:view', 'component' => 'totara/cohort'),
    'local/dashboard:admin' => array('newcap'=>'totara/dashboard:admin', 'component' => 'totara/dashboard'),
    'local/dashboard:edit' => array('newcap'=>'totara/dashboard:edit', 'component' => 'totara/dashboard'),
    'local/dashboard:view' => array('newcap'=>'totara/dashboard:view', 'component' => 'totara/dashboard'),
    'local/oauth:negotiate' => array('newcap'=>'totara/oauth:negotiate', 'component' => 'totara/oauth'),
    'local/plan:accessanyplan' => array('newcap'=>'totara/plan:accessanyplan', 'component' => 'totara/plan'),
    'local/plan:accessplan' => array('newcap'=>'totara/plan:accessplan', 'component' => 'totara/plan'),
    'local/plan:configureplans' => array('newcap'=>'totara/plan:configureplans', 'component' => 'totara/plan'),
    'local/plan:manageobjectivescales' => array('newcap'=>'totara/plan:manageobjectivescales', 'component' => 'totara/plan'),
    'local/plan:managepriorityscales' => array('newcap'=>'totara/plan:managepriorityscales', 'component' => 'totara/plan'),
    'local/program:accessanyprogram' => array('newcap'=>'totara/program:accessanyprogram', 'component' => 'totara/program'),
    'local/program:configureassignments' => array('newcap'=>'totara/program:configureassignments', 'component' => 'totara/program'),
    'local/program:configurecontent' => array('newcap'=>'totara/program:configurecontent', 'component' => 'totara/program'),
    'local/program:configuremessages' => array('newcap'=>'totara/program:configuremessages', 'component' => 'totara/program'),
    'local/program:configureprogram' => array('newcap'=>'totara/program:configureprogram', 'component' => 'totara/program'),
    'local/program:createprogram' => array('newcap'=>'totara/program:createprogram', 'component' => 'totara/program'),
    'local/program:handleexceptions' => array('newcap'=>'totara/program:handleexception', 'component' => 'totara/program'),
    'local/program:viewhiddenprograms' => array('newcap'=>'totara/program:viewhiddenprograms', 'component' => 'totara/program'),
    'local/program:viewprogram' => array('newcap'=>'totara/program:viewprogram', 'component' => 'totara/program'),
    'local/reportbuilder:managereports' => array('newcap'=>'totara/reportbuilder:managereports', 'component' => 'totara/reportbuilder'),
    'moodle/local:assignselfposition' => array('newcap'=>'totara/hierarchy:assignselfposition', 'component' => 'totara/hierarchy'),
    'moodle/local:assignuserposition' => array('newcap'=>'totara/hierarchy:assignuserposition', 'component' => 'totara/hierarchy'),
    'moodle/local:createcompetency' => array('newcap'=>'totara/hierarchy:createcompetency', 'component' => 'totara/hierarchy'),
    'moodle/local:createcompetencycustomfield' => array('newcap'=>'totara/hierarchy:createcompetencycustomfield', 'component' => 'totara/hierarchy'),
    'moodle/local:createcompetencyframeworks' => array('newcap'=>'totara/hierarchy:createcompetencyframeworks', 'component' => 'totara/hierarchy'),
    'moodle/local:createcompetencytemplate' => array('newcap'=>'totara/hierarchy:createcompetencytemplate', 'component' => 'totara/hierarchy'),
    'moodle/local:createcompetencytype' => array('newcap'=>'totara/hierarchy:createcompetencytype', 'component' => 'totara/hierarchy'),
    'moodle/local:createorganisation' => array('newcap'=>'totara/hierarchy:createorganisation', 'component' => 'totara/hierarchy'),
    'moodle/local:createorganisationcustomfield' => array('newcap'=>'totara/hierarchy:createorganisationcustomfield', 'component' => 'totara/hierarchy'),
    'moodle/local:createorganisationframeworks' => array('newcap'=>'totara/hierarchy:createorganisationframeworks', 'component' => 'totara/hierarchy'),
    'moodle/local:createorganisationtype' => array('newcap'=>'totara/hierarchy:createorganisationtype', 'component' => 'totara/hierarchy'),
    'moodle/local:createposition' => array('newcap'=>'totara/hierarchy:createposition', 'component' => 'totara/hierarchy'),
    'moodle/local:createpositioncustomfield' => array('newcap'=>'totara/hierarchy:createpositioncustomfield', 'component' => 'totara/hierarchy'),
    'moodle/local:createpositionframeworks' => array('newcap'=>'totara/hierarchy:createpositionframeworks', 'component' => 'totara/hierarchy'),
    'moodle/local:createpositiontype' => array('newcap'=>'totara/hierarchy:createpositiontype', 'component' => 'totara/hierarchy'),
    'moodle/local:deletecompetency' => array('newcap'=>'totara/hierarchy:deletecompetency', 'component' => 'totara/hierarchy'),
    'moodle/local:deletecompetencycustomfield' => array('newcap'=>'totara/hierarchy:deletecompetencycustomfield', 'component' => 'totara/hierarchy'),
    'moodle/local:deletecompetencyframeworks' => array('newcap'=>'totara/hierarchy:deletecompetencyframeworks', 'component' => 'totara/hierarchy'),
    'moodle/local:deletecompetencytemplate' => array('newcap'=>'totara/hierarchy:deletecompetencytemplate', 'component' => 'totara/hierarchy'),
    'moodle/local:deletecompetencytype' => array('newcap'=>'totara/hierarchy:deletecompetencytype', 'component' => 'totara/hierarchy'),
    'moodle/local:deleteorganisation' => array('newcap'=>'totara/hierarchy:deleteorganisation', 'component' => 'totara/hierarchy'),
    'moodle/local:deleteorganisationcustomfield' => array('newcap'=>'totara/hierarchy:deleteorganisationcustomfield', 'component' => 'totara/hierarchy'),
    'moodle/local:deleteorganisationframeworks' => array('newcap'=>'totara/hierarchy:deleteorganisationframeworks', 'component' => 'totara/hierarchy'),
    'moodle/local:deleteorganisationtype' => array('newcap'=>'totara/hierarchy:deleteorganisationtype', 'component' => 'totara/hierarchy'),
    'moodle/local:deleteposition' => array('newcap'=>'totara/hierarchy:deleteposition', 'component' => 'totara/hierarchy'),
    'moodle/local:deletepositioncustomfield' => array('newcap'=>'totara/hierarchy:deletepositioncustomfield', 'component' => 'totara/hierarchy'),
    'moodle/local:deletepositionframeworks' => array('newcap'=>'totara/hierarchy:deletepositionframeworks', 'component' => 'totara/hierarchy'),
    'moodle/local:deletepositiontype' => array('newcap'=>'totara/hierarchy:deletepositiontyp', 'component' => 'totara/hierarchy'),
    'moodle/local:updatecompetency' => array('newcap'=>'totara/hierarchy:updatecompetency', 'component' => 'totara/hierarchy'),
    'moodle/local:updatecompetencycustomfield' => array('newcap'=>'totara/hierarchy:updatecompetencycustomfield', 'component' => 'totara/hierarchy'),
    'moodle/local:updatecompetencyframeworks' => array('newcap'=>'totara/hierarchy:updatecompetencyframeworks', 'component' => 'totara/hierarchy'),
    'moodle/local:updatecompetencytemplate' => array('newcap'=>'totara/hierarchy:updatecompetencytemplate', 'component' => 'totara/hierarchy'),
    'moodle/local:updatecompetencytype' => array('newcap'=>'totara/hierarchy:updatecompetencytype', 'component' => 'totara/hierarchy'),
    'moodle/local:updateorganisation' => array('newcap'=>'totara/hierarchy:updateorganisation', 'component' => 'totara/hierarchy'),
    'moodle/local:updateorganisationcustomfield' => array('newcap'=>'totara/hierarchy:updateorganisationcustomfield', 'component' => 'totara/hierarchy'),
    'moodle/local:updateorganisationframeworks' => array('newcap'=>'totara/hierarchy:updateorganisationframeworks', 'component' => 'totara/hierarchy'),
    'moodle/local:updateorganisationtype' => array('newcap'=>'totara/hierarchy:updateorganisationtype', 'component' => 'totara/hierarchy'),
    'moodle/local:updateposition' => array('newcap'=>'totara/hierarchy:updateposition', 'component' => 'totara/hierarchy'),
    'moodle/local:updatepositioncustomfield' => array('newcap'=>'totara/hierarchy:updatepositioncustomfield', 'component' => 'totara/hierarchy'),
    'moodle/local:updatepositionframeworks' => array('newcap'=>'totara/hierarchy:updatepositionframeworks', 'component' => 'totara/hierarchy'),
    'moodle/local:updatepositiontype' => array('newcap'=>'totara/hierarchy:updatepositiontype', 'component' => 'totara/hierarchy'),
    'moodle/local:viewcompetency' => array('newcap'=>'totara/hierarchy:viewcompetency', 'component' => 'totara/hierarchy'),
    'moodle/local:vieworganisation' => array('newcap'=>'totara/hierarchy:vieworganisation', 'component' => 'totara/hierarchy'),
    'moodle/local:viewposition' => array('newcap'=>'totara/hierarchy:viewposition', 'component' => 'totara/hierarchy'));

    return $upgrade_caps;
}
/**
* totara_upgrade_capabilities, for fixing 1.1 capabilities when upgrading to 2.2
*
* @global object $DB
* @return bool $status
*/
function totara_upgrade_capabilities() {
    global $DB;
    $status = true;
    $upgrade_caps = totara_get_capability_upgrade_map();
    foreach ($upgrade_caps as $oldcap => $val) {
        $sql = "UPDATE {capabilities} SET name=?, component=? WHERE name=?";
        $params = array($val['newcap'], $val['component'], $oldcap);
        $status = $status && $DB->execute($sql, $params);
        $sql = "UPDATE {role_capabilities} SET capability=? WHERE capability=?";
        $params = array($val['newcap'], $oldcap);
        $status = $status && $DB->execute($sql, $params);
    }
    return $status;
}
/**
* totara_set_charfield_nullable, for fixing 1.9 char fields where old definition was ISNULL=true and DEFAULT=""
*
* @global object $DB
* @param string $table the table name
* @param string $field the field name
* @param string $previous the field immediately previous to the char field in the table definition
* @param string $length length of the char field NB: pass as a string, not an int!
* @param bool or null $notnull null or false if CAN be null, XMLDB_NOTNULL if CANNOT be null
* * @param string or null $default either remove the default (null) or force a sane non-empty default
* @param array $indexes array of xmldb_index objects for all indexes on tables that contain the char field
* @return void
*/
function totara_fix_nullable_charfield($table, $field, $previous, $length='255', $notnull=null, $default=null, $indexes=array()) {
    global $DB, $CFG;
    $dbman = $DB->get_manager();

    //sanity check
    if ($notnull == XMLDB_NOTNULL && empty($default)) {
        throw new upgrade_exception("$table $field set as NOT NULL with an empty default value!", '1.1 to 2.2 upgrade');
    }
    $xtable = new xmldb_table($table);
    if (count($indexes>0)) {
        foreach ($indexes as $index) {
            $dbman->drop_index($xtable, $index);
        }
    }

    $xfield = new xmldb_field($field);
    $xfield->set_attributes(XMLDB_TYPE_CHAR, $length, null, $notnull, null, $default, $previous);
    $dbman->change_field_notnull($xtable, $xfield);
    $dbman->change_field_default($xtable, $xfield);

    if (count($indexes>0)) {
        foreach ($indexes as $index) {
            $dbman->add_index($xtable, $index);
        }
    }
}
/**
 * Function for fixing records in the database caused by a bug that
 * introduced duplicates
 *
 * @param string $tablename Name of the table to fix (without prefix)
 * @param string $where_sql SQL snippet restricting which records are fixed
 *
 * @return boolean True if the operation completed successfully or there
 *                 was nothing to do
 */
function totara_data_object_duplicate_fix($tablename, $where_sql) {
    global $DB, $OUTPUT;

    // Check for duplicates
    $count_sql = "
        SELECT
            COUNT(*)
        FROM
            {$tablename}
        WHERE
            id NOT IN
            (
                {$where_sql}
            )
    ";

    // If any duplicates, keep correct version of record
    if (!$count = $DB->count_records_sql($count_sql)) {
        return true;
    }

    $a = new stdClass();
    $a->count = $count;
    $a->tablename = $tablename;
    echo $OUTPUT->notification(get_string('error:duplicaterecordsfound', 'totara_core', $a));

    $select_sql = "
        SELECT
            *
        FROM
            {$tablename}
        WHERE
            id NOT IN
            (
                {$where_sql}
            )
    ";

    // Select rows to be deleted, and dump their contents to the error log
    $duplicates = $DB->get_records_sql($select_sql);
    $ids = array();
    foreach ($duplicates as $dup) {
        error_log(get_string('error:duplicaterecordsdeleted', 'totara_core', $tablename) . var_export((array)$dup, true));
        $ids[] = $dup->id;
    }

    // Delete duplicate rows
    list($usql, $params) = $DB->get_in_or_equal($ids);
    $delete_sql = "
        DELETE FROM
            {$tablename}
        WHERE
            WHERE id $usql";

    if (!$DB->execute($delete_sql, $params)) {
        return false;
    }

    return true;
}

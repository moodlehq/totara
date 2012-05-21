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

function xmldb_totara_core_install() {
    global $CFG, $DB, $SITE;

    $dbman = $DB->get_manager(); // loads ddl manager and xmldb classes

    // add coursetype and icon fields to course table

    $table = new xmldb_table('course');

    $field = new xmldb_field('coursetype');
    if (!$dbman->field_exists($table, $field)) {
        $field->set_attributes(XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, null, null, null, null);
        $dbman->add_field($table, $field);
    }

    $field = new xmldb_field('icon');
    if (!$dbman->field_exists($table, $field)) {
        $field->set_attributes(XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $dbman->add_field($table, $field);
    }

    // TODO: SCANMSG Need to look at the stuff below and figure out what is still needed

    //fix role_allow_assign
    $roles = $DB->get_records('role');
    // find administrator role (either admin or administrator)
    // Get admin role(s)
    if ($adminroles = get_roles_with_capability('moodle/site:doanything', CAP_ALLOW, context_system::instance())) {
        foreach ($adminroles as $adminrole) {
            foreach ($roles as $role) {
                $assign = $DB->get_record('role_allow_assign', array('roleid' => $adminrole->id, 'allowassign' => $role->id));
                if (!$assign) {
                    $role_assign = new stdClass();
                    $role_assign->roleid = $adminrole->id;
                    $role_assign->allowassign = $role->id;
                    $DB->insert_record('role_allow_assign', $role_assign);
                }
            }
        }
    }
    //code from old postinst function:
    set_config('theme', 'totara');
    set_config("langmenu", 0);
    /// Insert default records
    $defaultdir = $CFG->dirroot.'/totara/core/db/default';
    $includes = array();
    if (is_dir($defaultdir)) {
        // files installed in alphabetical order so use
        // number prefix to set desired order
        foreach (scandir($defaultdir) as $file) {
            // exclude dot directories
            if ($file == '.' || $file == '..') {
                continue;
            }
            // not a php file
            if (substr($file, -4) != '.php') {
                continue;
            }
            // include default data file
            $includes[] = $CFG->dirroot.'/totara/core/db/default/'.$file;
        }
    }
    // sort so order of includes is known
    sort($includes);
    foreach ($includes as $include) {
        include($include);
    }

    totara_reset_frontpage_blocks();

    // set up frontpage
    set_config('frontpage', '');
    set_config('frontpageloggedin', '');
    set_config('allowvisiblecoursesinhiddencategories', '1');

    rebuild_course_cache($SITE->id);

    // ensure page scrolls right to bottom when debugging on
    print "<div></div>";
    return true;
}

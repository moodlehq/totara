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
* @author Jon Sharp <jon.sharp@catalyst-eu.net>
* @package totara
* @subpackage certification
* */

defined('MOODLE_INTERNAL') || die();

function xmldb_totara_certification_install() {
    global $DB;
    $dbman = $DB->get_manager();

    // Certification id - if null then its a normal program, if not null then its a certification.
    $table = new xmldb_table('prog');
    $field = new xmldb_field('certifid', XMLDB_TYPE_INTEGER, '10');
    if (!$dbman->field_exists($table, $field)) {
        $dbman->add_field($table, $field);
    }

    // Define key cerifid (foreign) to be added to prog.
    $table = new xmldb_table('prog');
    $key = new xmldb_key('cerifid', XMLDB_KEY_FOREIGN, array('certifid'), 'certif', array('id'));

    // Launch add key certifid.
    if (!$dbman->find_key_name($table, $key)) {
        $dbman->add_key($table, $key);
    }

    // Define field certifpath to be added to prog_courseset. Default is CERTIFPATH_STD.
    $table = new xmldb_table('prog_courseset');
    $field = new xmldb_field('certifpath', XMLDB_TYPE_INTEGER, '2', null, null, null, '1', 'label');

    // Conditionally launch add field certifpath.
    if (!$dbman->field_exists($table, $field)) {
        $dbman->add_field($table, $field);
    }

    // Define field certifcount to be added to course_categories.
    $table = new xmldb_table('course_categories');
    $field = new xmldb_field('certifcount', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'programcount');
    if (!$dbman->field_exists($table, $field)) {
        $dbman->add_field($table, $field);
    }

    // Update counts - can't use an update query because databases handle update differently when using a join/from.
    // eg: Mysql uses JOIN, Postgresql uses FROM.
    // Joining on category ensures the category exists.
    $sql = 'SELECT cat.id,
                    SUM(CASE WHEN p.certifid IS NULL THEN 1 ELSE 0 END) AS programcount,
                    SUM(CASE WHEN p.certifid IS NULL THEN 0 ELSE 1 END) AS certifcount
            FROM {prog} p
            JOIN {course_categories} cat ON cat.id = p.category
            GROUP BY cat.id';
    $cats = $DB->get_records_sql($sql);
    foreach ($cats as $cat) {
        $DB->update_record('course_categories', $cat, true);
    }

}
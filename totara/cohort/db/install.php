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
 * @author Piers Harding <piers@catalyst.net.nz>
 * @package totara
 * @subpackage cohort
 */

// This file replaces:
//   * STATEMENTS section in db/install.xml
//   * lib.php/modulename_install() post installation hook
//   * partially defaults.php

function xmldb_totara_cohort_install() {
    global $CFG, $DB;

    $dbman = $DB->get_manager();

    $result = true;

    // hack to get cron working via admin/cron.php
    // at some point we should create a local_modules table
    // based on data in version.php
    if (!isset($CFG->totara_cohort_cron)) {
        set_config('totara_cohort_cron', 60);
    }

    /// Define field cohorttype to be added to cohort
    $table = new xmldb_table('cohort');
    $field = new xmldb_field('cohorttype');
    $field->set_attributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0', 'timemodified');

    /// Launch add field cohorttype
    if (!$dbman->field_exists($table, $field)) {
        $result = $result && $dbman->add_field($table, $field);
    }

    return $result;
}

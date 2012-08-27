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

require_once($CFG->dirroot.'/admin/tool/totara_sync/sources/classes/source.class.php');

abstract class totara_sync_source_org extends totara_sync_source {
    protected $fields = array(
        'idnumber',
        'fullname',
        'shortname',
        'description',
        'frameworkidnumber',
        'parentidnumber',
        'typeidnumber',
        'timemodified'
    );

    /**
     * Implement in child classes
     *
     * Populate the temp table to be used by the sync element
     */
    abstract function import_data($temptable);

    function get_element_name() {
        return 'org';
    }

    function has_config() {
        return true;
    }

    /**
     * Override in child classes
     */
    function uses_files() {
        return true;
    }

    /**
     * Override in child classes
     */
    function get_filepath() {}


    function config_form(&$mform) {
        $mform->addElement('header', 'dbfieldmappings', get_string('fieldmappings', 'tool_totara_sync'));

        foreach ($this->fields as $f) {
            $mform->addElement('text', "fieldmapping_{$f}", $f);
            $mform->setType("fieldmapping_{$f}", PARAM_ALPHANUM);
        }
    }

    function config_save($data) {
        foreach ($this->fields as $f) {
            $this->set_config("fieldmapping_{$f}", trim($data->{'fieldmapping_'.$f}));
        }
    }

    function get_sync_table() {

        if (!$temptable = $this->prepare_temp_table()) {
            $this->addlog(get_string('temptableprepfail', 'tool_totara_sync'), 'error', 'importdata');
            return false;
        }

        if (!$this->import_data($temptable)) {
            $this->addlog(get_string('dataimportaborted', 'tool_totara_sync'), 'error', 'importdata');
            return false;
        }

        return $temptable;
    }

    /**
     * Define and create the temporary table necessary for element syncing
     */
    function prepare_temp_table() {
        global $CFG, $DB;

        require_once($CFG->dirroot . '/lib/ddllib.php');

        /// Instantiate table
        $this->temptable = 'totara_sync_org';
        $dbman = $DB->get_manager();
        $table = new xmldb_table($this->temptable);

        /// Add fields
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->add_field('idnumber', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null, null, null);
        $table->add_field('fullname', XMLDB_TYPE_CHAR, '255', null, null, null, null, null, null);
        $table->add_field('shortname', XMLDB_TYPE_CHAR, '100', null, null, null, null, null, null);
        $table->add_field('description', XMLDB_TYPE_TEXT, 'medium', null, null, null, null, null, null);
        $table->add_field('frameworkidnumber', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null, null, null);
        $table->add_field('parentidnumber', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL, null, null, null, null);
        $table->add_field('typeidnumber', XMLDB_TYPE_CHAR, '100', null, null, null, null, null, null);
        $table->add_field('customfields', XMLDB_TYPE_TEXT, 'big', null, null, null, null, null, null);
        $table->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, null, null);

        /// Add keys
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

        /// Add indexes
        $table->add_index('idnumber', XMLDB_INDEX_NOTUNIQUE, array('idnumber'));
        $table->add_index('frameworkidnumber', XMLDB_INDEX_NOTUNIQUE, array('frameworkidnumber'));
        $table->add_index('parentidnumber', XMLDB_INDEX_NOTUNIQUE, array('parentidnumber'));
        $table->add_index('typeidnumber', XMLDB_INDEX_NOTUNIQUE, array('typeidnumber'));

        /// Create and truncate the table
        $dbman->create_temp_table($table, false, false);
        $DB->execute("TRUNCATE {{$this->temptable}}");

        return $this->temptable;
    }
}

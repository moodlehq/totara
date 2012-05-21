<?php

defined('MOODLE_INTERNAL') || die;

function xmldb_totara_hierarchy_install() {
    global $CFG, $DB;

    $dbman = $DB->get_manager(); // loads ddl manager and xmldb classes

    // add organisationid and positionid fields to course completion table

    $table = new xmldb_table('course_completions');

    $field = new xmldb_field('organisationid');
    if (!$dbman->field_exists($table, $field)) {
        $field->set_attributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, null);
        $dbman->add_field($table, $field);
    }

    $field = new xmldb_field('positionid');
    if (!$dbman->field_exists($table, $field)) {
        $field->set_attributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, null);
        $dbman->add_field($table, $field);
    }

}

<?php

defined('MOODLE_INTERNAL') || die;

function xmldb_totara_hierarchy_install() {
    global $CFG, $DB;

    $dbman = $DB->get_manager(); // loads ddl manager and xmldb classes

    // add organisationid and positionid fields to course completion table

    $table = new xmldb_table('course_completions');

    $field = new xmldb_field('organisationid');
    if (!$dbman->field_exists($table, $field)) {
        $field->set_attributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, 'course');
        $dbman->add_field($table, $field);
    }

    $field = new xmldb_field('positionid');
    if (!$dbman->field_exists($table, $field)) {
        $field->set_attributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, 'organisationid');
        $dbman->add_field($table, $field);
    }

    totara_hierarchy_install_default_comp_scale();
    // set positionsenabled default config
    if (get_config('totara_hierarchy', 'positionsenabled') === false) {
        set_config('positionsenabled', '1,2,3', 'totara_hierarchy');
    }
    return true;
}

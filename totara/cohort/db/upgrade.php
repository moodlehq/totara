<?php

// This file keeps track of upgrades to
// the local cohort module
//
// Sometimes, changes between versions involve
// alterations to database structures and other
// major things that may break installations.
//
// The upgrade function in this file will attempt
// to perform all the necessary actions to upgrade
// your older installtion to the current version.
//
// If there's something it cannot do itself, it
// will tell you what you need to do.
//
// The commands in here will all be database-neutral,
// using the functions defined in lib/ddllib.php

function xmldb_totara_cohort_upgrade($oldversion=0) {

    global $CFG, $DB, $OUTPUT;

    $dbman = $DB->get_manager();

    $result = true;

    /// Totara 1.1 upgrade
    if ($result && $oldversion < 2011091200) {
        // hack to get cron working via admin/cron.php
        set_config('totara_cohort_cron', 60);

    // delete capabilities that have changed and should be removed
        delete_records('capabilities', 'name', 'moodle/cohort:manage');
        delete_records('capabilities', 'name', 'moodle/cohort:assign');
        delete_records('capabilities', 'name', 'moodle/cohort:view');
    }

    // Totara 2.2+ upgrade
    if ($result && $oldversion < 2012051601) {
        // hack to get cron working via admin/cron.php
        if (!isset($CFG->totara_cohort_cron)) {
            set_config('totara_cohort_cron', 60);
        }

        /// Define field icon to be added to message_metadata
        $table = new xmldb_table('cohort');
        $field = new xmldb_field('cohorttype');
        $field->set_attributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0', 'timemodified');

        /// Launch add field cohorttype
        if (!$dbman->field_exists($table, $field)) {
            $result = $result && $dbman->add_field($table, $field);
        }
    }

    return $result;
}

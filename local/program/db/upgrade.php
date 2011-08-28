<?php

// This file keeps track of upgrades to
// the program module
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

function xmldb_local_program_upgrade($oldversion=0) {

    global $CFG, $db;

    $result = true;

    if ($result && $oldversion < 2011050701) {
        // hack to get cron working via admin/cron.php
        set_config('local_program_cron', 60);
    }

    if ($result && $oldversion < 2011050701) {

    /// Define field programcount to be added to course_categories
        $table = new XMLDBTable('course_categories');
        $field = new XMLDBField('programcount');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'theme');

    /// Launch add field programcount
        $result = $result && add_field($table, $field);
    }

    if ($result && $oldversion < 2011051000) {

    /// Define field completed to be dropped from prog_completion
        $table = new XMLDBTable('prog_completion');
        $field = new XMLDBField('completed');

    /// Launch drop field completed
        $result = $result && drop_field($table, $field);

        if ($result) {

        /// Define field status to be added to prog_completion
            $table = new XMLDBTable('prog_completion');
            $field = new XMLDBField('status');
            $field->setAttributes(XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'coursesetid');

        /// Launch add field status
            $result = $result && add_field($table, $field);
        }

    }

    if ($result && $oldversion < 2011051300) {

    /// Define key nextprogid (foreign) to be dropped form prog
        $table = new XMLDBTable('prog');
        $key = new XMLDBKey('nextprogid');
        $key->setAttributes(XMLDB_KEY_FOREIGN, array('nextprogid'), 'prog', array('id'));

    /// Launch drop key nextprogid
        $result = $result && drop_key($table, $key);

        if ($result) {

        /// Define field nextprogid to be dropped from prog
            $table = new XMLDBTable('prog');
            $field = new XMLDBField('nextprogid');

        /// Launch drop field nextprogid
            $result = $result && drop_field($table, $field);
        }

        if ($result) {

        /// Define field nextprogtime to be dropped from prog
            $table = new XMLDBTable('prog');
            $field = new XMLDBField('nextprogtime');

        /// Launch drop field nextprogtime
            $result = $result && drop_field($table, $field);
        }

    }

    if ($result && $oldversion < 2011051301) {

    /// Define field recurrencetime to be added to prog_courseset
        $table = new XMLDBTable('prog_courseset');
        $field = new XMLDBField('recurrencetime');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'timeallowed');

    /// Launch add field recurrencetime
        $result = $result && add_field($table, $field);
    }

    if ($result && $oldversion < 2011051301) {

    /// Define field recurcreatetime to be added to prog_courseset
        $table = new XMLDBTable('prog_courseset');
        $field = new XMLDBField('recurcreatetime');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'recurrencetime');

    /// Launch add field recurcreatetime
        $result = $result && add_field($table, $field);
    }

    if ($result && $oldversion < 2011052000) {

    /// Define field label to be added to prog_courseset
        $table = new XMLDBTable('prog_courseset');
        $field = new XMLDBField('label');
        $field->setAttributes(XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null, null, null, 'recurcreatetime');

    /// Launch add field label
        $result = $result && add_field($table, $field);
    }

    if ($result && $oldversion < 2011052400) {

    /// Define field timedue to be added to prog_completion
        $table = new XMLDBTable('prog_completion');
        $field = new XMLDBField('timedue');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'status');

    /// Launch add field timedue
        $result = $result && add_field($table, $field);
    }

    if ($result && $oldversion < 2011052500) {

    /// Define field contenttype to be added to prog_courseset
        $table = new XMLDBTable('prog_courseset');
        $field = new XMLDBField('contenttype');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'recurcreatetime');

    /// Launch add field contenttype
        $result = $result && add_field($table, $field);
    }

    if ($result && $oldversion < 2011060200) {

    /// Define field assignmmentid to be added to prog_exception
        $table = new XMLDBTable('prog_exception');
        $field = new XMLDBField('assignmentid');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'timeraised');

    /// Launch add field assignmmentid
        $result = $result && add_field($table, $field);
    }

    if ($result && $oldversion < 2011060201) {

    /// Define field timestarted to be added to prog_completion
        $table = new XMLDBTable('prog_completion');
        $field = new XMLDBField('timestarted');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'status');

    /// Launch add field timestarted
        $result = $result && add_field($table, $field);
    }

    if ($result && $oldversion < 2011060204) {

    /// Define table prog_user_assignment to be created
        $table = new XMLDBTable('prog_user_assignment');

    /// Adding fields to table prog_user_assignment
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->addFieldInfo('programid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->addFieldInfo('userid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->addFieldInfo('assignmentid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->addFieldInfo('timeassigned', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');

    /// Adding keys to table prog_user_assignment
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));

    /// Launch create table for prog_user_assignment
        $result = $result && create_table($table);
    }

    if ($result && $oldversion < 2011060800) {

    /// Define key programid (foreign) to be added to prog_user_assignment
        $table = new XMLDBTable('prog_user_assignment');
        $key = new XMLDBKey('programid');
        $key->setAttributes(XMLDB_KEY_FOREIGN, array('programid'), 'prog', array('id'));

    /// Launch add key programid
        $result = $result && add_key($table, $key);
    }

    if ($result && $oldversion < 2011060800) {

    /// Define key userid (foreign) to be added to prog_user_assignment
        $table = new XMLDBTable('prog_user_assignment');
        $key = new XMLDBKey('userid');
        $key->setAttributes(XMLDB_KEY_FOREIGN, array('userid'), 'user', array('id'));

    /// Launch add key userid
        $result = $result && add_key($table, $key);
    }

    if ($result && $oldversion < 2011060800) {

    /// Define key assignmentid (foreign) to be added to prog_user_assignment
        $table = new XMLDBTable('prog_user_assignment');
        $key = new XMLDBKey('assignmentid');
        $key->setAttributes(XMLDB_KEY_FOREIGN, array('assignmentid'), 'prog_assignment', array('id'));

    /// Launch add key assignmentid
        $result = $result && add_key($table, $key);
    }


    if ($result && $oldversion < 2011060800) {

    /// Define table prog_exception_data to be created
        $table = new XMLDBTable('prog_exception_data');

    /// Adding fields to table prog_exception_data
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->addFieldInfo('exceptionid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->addFieldInfo('dataname', XMLDB_TYPE_CHAR, '50', null, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('datavalue', XMLDB_TYPE_TEXT, 'small', null, null, null, null, null, null);

    /// Adding keys to table prog_exception_data
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->addKeyInfo('exceptionid', XMLDB_KEY_FOREIGN, array('exceptionid'), 'prog_exception', array('id'));

    /// Launch create table for prog_exception_data
        $result = $result && create_table($table);
    }

   if ($result && $oldversion < 2011062301) {
        /// Define field completioninstance to be added to prog_assignment
        $table = new XMLDBTable('prog_assignment');
        $field = new XMLDBField('completioninstance');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'completionevent');

        /// Launch add field completioninstance
        $result = $result && add_field($table, $field);
    }

    if ($result && $oldversion < 2011062702) {

        /// Define table prog_pos_assignment to be created
        $table = new XMLDBTable('prog_pos_assignment');

        /// Adding fields to table prog_pos_assignment
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->addFieldInfo('userid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('positionid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('type', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '1');
        $table->addFieldInfo('timeassigned', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);

        /// Adding keys to table prog_pos_assignment
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));

        /// Launch create table for prog_pos_assignment
        $result = $result && create_table($table);
    }

    if ($result && $oldversion < 2011062800) {

    /// Define table prog_completion_history to be created
        $table = new XMLDBTable('prog_completion_history');

    /// Adding fields to table prog_completion_history
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->addFieldInfo('programid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->addFieldInfo('userid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->addFieldInfo('coursesetid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->addFieldInfo('status', XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->addFieldInfo('timestarted', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->addFieldInfo('timedue', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->addFieldInfo('timecompleted', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');

    /// Adding keys to table prog_completion_history
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->addKeyInfo('programid', XMLDB_KEY_FOREIGN, array('programid'), 'prog', array('id'));
        $table->addKeyInfo('userid', XMLDB_KEY_FOREIGN, array('userid'), 'user', array('id'));
        $table->addKeyInfo('coursesetid', XMLDB_KEY_FOREIGN, array('coursesetid'), 'prog_courseset', array('id'));

    /// Launch create table for prog_completion_history
        $result = $result && create_table($table);
    }

    if ($result && $oldversion < 2011063000) {

    /// Define table prog_recurrence to be created
        $table = new XMLDBTable('prog_recurrence');

    /// Adding fields to table prog_recurrence
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->addFieldInfo('programid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->addFieldInfo('currentcourseid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->addFieldInfo('nextcourseid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');

    /// Adding keys to table prog_recurrence
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->addKeyInfo('programid', XMLDB_KEY_FOREIGN, array('programid'), 'prog', array('id'));
        $table->addKeyInfo('currentcourseid', XMLDB_KEY_FOREIGN, array('currentcourseid'), 'course', array('id'));
        $table->addKeyInfo('nextcourseid', XMLDB_KEY_FOREIGN, array('nextcourseid'), 'course', array('id'));

    /// Launch create table for prog_recurrence
        $result = $result && create_table($table);
    }


    // Migrate program context instances to new contentlevel
    if ($result && $oldversion < 2011071800) {

        // Update old contextlevels
        $sql = "
            UPDATE
                {$CFG->prefix}context
            SET
                contextlevel = ".CONTEXT_PROGRAM."
            WHERE
                contextlevel = 60
        ";

        $result = $result && execute_sql($sql);
    }

    if ($result && $oldversion < 2011072200) {

    /// Define field completionstatus to be dropped from dp_plan_program_assign
        $table = new XMLDBTable('dp_plan_program_assign');
        $field = new XMLDBField('completionstatus');

    /// Launch drop field completionstatus
        $result = $result && drop_field($table, $field);
    }

    if ($result && $oldversion < 2011080100) {

    /// Define field recurringcourseid to be added to prog_completion_history
        $table = new XMLDBTable('prog_completion_history');
        $field = new XMLDBField('recurringcourseid');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'timecompleted');

    /// Launch add field recurringcourseid
        if (!field_exists($table, $field)) {
            $result = $result && add_field($table, $field);
        }
    }

    if ($result && $oldversion < 2011080100) {

    /// Define key recurringcourseid (foreign) to be added to prog_completion_history
        $table = new XMLDBTable('prog_completion_history');
        $key = new XMLDBKey('recurringcourseid');
        $key->setAttributes(XMLDB_KEY_FOREIGN, array('recurringcourseid'), 'course', array('id'));

    /// Launch add key recurringcourseid
        $result = $result && add_key($table, $key);
    }

    return $result;
}

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

    if ($result && $oldversion < 2011091200) {
        // hack to get cron working via admin/cron.php
        set_config('local_program_cron', 60);
    }

    if ($result && $oldversion < 2011091201) {
        $table = new XMLDBTable('prog_extension');

        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->addFieldInfo('programid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, 0);
        $table->addFieldInfo('userid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, 0);
        $table->addFieldInfo('extensiondate', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, 0);
        $table->addFieldInfo('extensionreason', XMLDB_TYPE_TEXT, 'medium', null, null, null, null, null, null);
        $table->addFieldInfo('status', XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');

        //Add keys to table prog_extensions
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->addKeyInfo('programid', XMLDB_KEY_FOREIGN, array('programid'), 'prog', array('id'));
        $table->addKeyInfo('userid', XMLDB_KEY_FOREIGN, array('userid'), 'user', array('id'));

        //Create table
        $result = $result && create_table($table);

        //Migrate extensions from exceptions
        if ($extensions = get_records('prog_exception', 'exceptiontype', 3)) {
            $new_extension = new stdClass;

            foreach ($extensions as $extension) {
                $new_extension->userid = $extension->userid;
                $new_extension->programid = $extension->programid;
                $new_extension->status = 0;

                if ($extensiondetails = get_records('prog_exception_data', 'exceptionid', $extension->id)) {
                    foreach ($extensiondetails as $detail) {
                        switch($detail->dataname) {
                            case 'extensiondate':
                                $new_extension->extensiondate = $detail->datavalue;
                                break;
                            case 'extensionreason':
                                $new_extension->extensionreason = $detail->datavalue;
                                break;
                        }
                    }
                }

                //Insert new records for extension
                if ($result = $result && insert_record('prog_extension', $new_extension)) {
                    //Created new extension successfully, delete data from exceptions tables
                    $result = $result && delete_records('prog_exception_data', 'exceptionid', $extension->id);
                    $result = $result && delete_records('prog_exception', 'id', $extension->id);
                }
            }
        }

        // Update any alerts that link to exceptions page
        $newurl = $CFG->wwwroot . '/local/program/manageextensions.php';
        $sql = "UPDATE {$CFG->prefix}message20 SET contexturl='{$newurl}' WHERE subject = 'Extension request'";
        $result = $result && execute_sql($sql);


    }

    if ($result && $oldversion < 2011091202) {
        $table = new XMLDBTable('prog');
        $field = new XMLDBField('availablerole');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        if (field_exists($table, $field)) {
            $result = $result && rename_field($table, $field, 'available');
        }
    }

    if ($result && $oldversion < 2011091203) {
        $table = new XMLDBTable('prog');
        $field = new XMLDBField('exceptionssent');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        if (!field_exists($table, $field)) {
            $result = $result && add_field($table, $field);
        }
    }

    return $result;
}

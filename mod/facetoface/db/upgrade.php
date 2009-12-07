<?php  //$Id: upgrade.php,v 1.4 2008/08/05 02:54:06 fmarier Exp $

// This file keeps track of upgrades to
// the facetoface module
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

function xmldb_facetoface_upgrade($oldversion=0) {

    global $CFG, $THEME, $db;

    $result = true;

    if ($result && $oldversion < 2008050500) {
        $table = new XMLDBTable('facetoface');
        $field = new XMLDBField('thirdpartywaitlist');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'thirdparty');
        $result = $result && add_field($table, $field);
    }

    if ($result && $oldversion < 2008061000) {
        $table = new XMLDBTable('facetoface_submissions');
        $field = new XMLDBField('notificationtype');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'timemodified');
        $result = $result && add_field($table, $field);
    }

    if ($result && $oldversion < 2008080100) {
        notify('Processing Face-to-face grades, this may take a while if there are many sessions...', 'notifysuccess');
        require_once $CFG->dirroot.'/mod/facetoface/lib.php';

        begin_sql();
        $db->debug = false; // too much debug output

        // Migrate the grades to the gradebook
        $sql = "SELECT f.id, f.name, f.course, s.grade, s.timegraded, s.userid,
                       cm.idnumber as cmidnumber
                  FROM {$CFG->prefix}facetoface_submissions s
                  JOIN {$CFG->prefix}facetoface f ON s.facetoface = f.id
                  JOIN {$CFG->prefix}course_modules cm ON cm.instance = f.id
                  JOIN {$CFG->prefix}modules m ON m.id = cm.module
                 WHERE m.name='facetoface'";
        if ($rs = get_recordset_sql($sql)) {
            while ($result and $facetoface = rs_fetch_next_record($rs)) {
                $grade = new stdclass();
                $grade->userid = $facetoface->userid;
                $grade->rawgrade = $facetoface->grade;
                $grade->rawgrademin = 0;
                $grade->rawgrademax = 100;
                $grade->timecreated = $facetoface->timegraded;
                $grade->timemodified = $facetoface->timegraded;

                $result = $result && (GRADE_UPDATE_OK == facetoface_grade_item_update($facetoface, $grade));
            }
            rs_close($rs);
        }
        $db->debug = true;

        // Remove the grade and timegraded fields from mdl_facetoface_submissions
        if ($result) {
            $table = new XMLDBTable('facetoface_submissions');
            $field1 = new XMLDBField('grade');
            $field2 = new XMLDBField('timegraded');
            $result = $result && drop_field($table, $field1, false, true);
            $result = $result && drop_field($table, $field2, false, true);
        }

        if ($result) {
            commit_sql();
        } else {
            rollback_sql();
        }
    }

    if ($result && $oldversion < 2008090800) {

        // Define field timemodified to be added to facetoface_submissions
        $table = new XMLDBTable('facetoface_submissions');
        $field = new XMLDBField('timecancelled');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '20', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, 0, 'timemodified');

        // Launch add field
        $result = $result && add_field($table, $field);
    }

    if ($result && $oldversion < 2008100301) {

    /// Create table facetoface_session_roles
        $table = new XMLDBTable('facetoface_session_roles');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('sessionid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('roleid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('userid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->addKeyInfo('sessionid', XMLDB_KEY_FOREIGN, array('sessionid'), 'facetoface_sessions', array('id'));
        $result = $result && create_table($table);
    }

    if ($result && $oldversion < 2008100302) {

    /// Create table facetoface_signups
        $table = new XMLDBTable('facetoface_signups');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('sessionid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('userid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('mailedreminder', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('discountcode', XMLDB_TYPE_TEXT, 'small', null, null, null, null);
        $table->addFieldInfo('notificationtype', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->addKeyInfo('sessionid', XMLDB_KEY_FOREIGN, array('sessionid'), 'facetoface_sessions', array('id'));
        $result = $result && create_table($table);

    /// Create table facetoface_signups_status
        $table = new XMLDBTable('facetoface_signups_status');
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->addFieldInfo('signupid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('statuscode', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('superceded', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('grade', XMLDB_TYPE_NUMBER, '10, 5', null, null, null, null);
        $table->addFieldInfo('createdby', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('note', XMLDB_TYPE_TEXT, 'small', null, null, null, null);
        $table->addFieldInfo('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->addKeyInfo('signupid', XMLDB_KEY_FOREIGN, array('signupid'), 'facetoface_signups', array('id'));
        $result = $result && create_table($table);
    }

    if ($result && $oldversion < 2008100303) {

    /// Drop table facetoface_submissions
        $table = new XMLDBTable('facetoface_submissions');
        $result = $result && drop_table($table);
    }

    return $result;
}

?>

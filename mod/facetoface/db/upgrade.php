<?php

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

    global $CFG, $db;

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

    if ($result && $oldversion < 2009111300) {
        // New fields necessary for the training calendar
        $table = new XMLDBTable('facetoface');
        $field1 = new XMLDBField('shortname');
        $field1->setAttributes(XMLDB_TYPE_CHAR, '32', null, null, null, null, null, null, 'timemodified');
        $result = $result && add_field($table, $field1);

        $field2 = new XMLDBField('description');
        $field2->setAttributes(XMLDB_TYPE_TEXT, 'medium', null, null, null, null, null, null, 'shortname');
        $result = $result && add_field($table, $field2);

        $field3 = new XMLDBField('showoncalendar');
        $field3->setAttributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '1', 'description');
        $result = $result && add_field($table, $field3);
    }

    if ($result && $oldversion < 2009111600) {

        $table1 = new XMLDBTable('facetoface_session_field');
        $table1->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table1->addFieldInfo('name', XMLDB_TYPE_CHAR, '255', null, null, null, null, null, null);
        $table1->addFieldInfo('shortname', XMLDB_TYPE_CHAR, '255', null, null, null, null, null, null);
        $table1->addFieldInfo('type', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table1->addFieldInfo('possiblevalues', XMLDB_TYPE_TEXT, 'medium', null, null, null, null, null, null);
        $table1->addFieldInfo('required', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table1->addFieldInfo('defaultvalue', XMLDB_TYPE_CHAR, '255', null, null, null, null, null, null);
        $table1->addFieldInfo('isfilter', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '1');
        $table1->addFieldInfo('showinsummary', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '1');
        $table1->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table1);

        $table2 = new XMLDBTable('facetoface_session_data');
        $table2->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table2->addFieldInfo('fieldid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table2->addFieldInfo('sessionid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table2->addFieldInfo('data', XMLDB_TYPE_CHAR, '255', null, null, null, null, null, null);
        $table2->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table2);
    }

    if ($result && $oldversion < 2009111900) {
        // Remove unused field
        $table = new XMLDBTable('facetoface_sessions');
        $field = new XMLDBField('closed');
        $result = $result && drop_field($table, $field);
    }

    // Migration of old Location, Venue and Room fields
    if ($result && $oldversion < 2009112300) {
        // Create three new custom fields
        $newfield1 = new object();
        $newfield1->name = 'Location';
        $newfield1->shortname = 'location';
        $newfield1->type = 0; // free text
        $newfield1->required = 1;
        if (!$locationfieldid = insert_record('facetoface_session_field', $newfield1)) {
            $result = false;
        }

        $newfield2 = new object();
        $newfield2->name = 'Venue';
        $newfield2->shortname = 'venue';
        $newfield2->type = 0; // free text
        $newfield2->required = 1;
        if (!$venuefieldid = insert_record('facetoface_session_field', $newfield2)) {
            $result = false;
        }

        $newfield3 = new object();
        $newfield3->name = 'Room';
        $newfield3->shortname = 'room';
        $newfield3->type = 0; // free text
        $newfield3->required = 1;
        $newfield3->showinsummary = 0;
        if (!$roomfieldid = insert_record('facetoface_session_field', $newfield3)) {
            $result = false;
        }

        // Migrate data into the new fields
        $olddebug = $db->debug;
        $db->debug = false; // too much debug output

        if ($rs = get_recordset('facetoface_sessions', '', '', '', 'id, location, venue, room')) {
            while ($result and $session = rs_fetch_next_record($rs)) {
                $locationdata = new object();
                $locationdata->sessionid = $session->id;
                $locationdata->fieldid = $locationfieldid;
                $locationdata->data = addslashes($session->location);
                $result = $result && insert_record('facetoface_session_data', $locationdata);

                $venuedata = new object();
                $venuedata->sessionid = $session->id;
                $venuedata->fieldid = $venuefieldid;
                $venuedata->data = addslashes($session->venue);
                $result = $result && insert_record('facetoface_session_data', $venuedata);

                $roomdata = new object();
                $roomdata->sessionid = $session->id;
                $roomdata->fieldid = $roomfieldid;
                $roomdata->data = addslashes($session->room);
                $result = $result && insert_record('facetoface_session_data', $roomdata);
            }
            rs_close($rs);
        }

        $db->debug = $olddebug;

        // Drop the old fields
        $table = new XMLDBTable('facetoface_sessions');
        $oldfield1 = new XMLDBField('location');
        $result = $result && drop_field($table, $oldfield1);
        $oldfield2 = new XMLDBField('venue');
        $result = $result && drop_field($table, $oldfield2);
        $oldfield3 = new XMLDBField('room');
        $result = $result && drop_field($table, $oldfield3);

        if ($result) {
            commit_sql();
        }
        else {
            rollback_sql();
        }
    }

    // Migration of old Location, Venue and Room placeholders in email templates
    if ($result && $oldversion < 2009112400) {
        begin_sql();

        $olddebug = $db->debug;
        $db->debug = false; // too much debug output

        $templatedfields = array('confirmationsubject', 'confirmationinstrmngr', 'confirmationmessage',
                                 'cancellationsubject', 'cancellationinstrmngr', 'cancellationmessage',
                                 'remindersubject', 'reminderinstrmngr', 'remindermessage',
                                 'waitlistedsubject', 'waitlistedmessage');

        if ($rs = get_recordset('facetoface', '', '', '', 'id, ' . implode(', ', $templatedfields))) {
            while ($result and $activity = rs_fetch_next_record($rs)) {
                $todb = new object();
                $todb->id = $activity->id;

                foreach ($templatedfields as $fieldname) {
                    $s = $activity->$fieldname;
                    $s = str_replace('[location]', '[session:location]', $s);
                    $s = str_replace('[venue]', '[session:venue]', $s);
                    $s = str_replace('[room]', '[session:room]', $s);
                    $todb->$fieldname = addslashes($s);
                }

                $result = $result && update_record('facetoface', $todb);
            }
            rs_close($rs);
        }

        $db->debug = $olddebug;

        if ($result) {
            commit_sql();
        }
        else {
            rollback_sql();
        }
    }

    if ($result && $oldversion < 2009120900) {
        // Create Calendar events for all existing Face-to-face sessions
        begin_sql();

        if ($records = get_records('facetoface_sessions', '', '', '', 'id, facetoface')) {
            // Remove all exising site-wide events (there shouldn't be any)
            foreach ($records as $record) {
                if (!facetoface_remove_session_from_site_calendar($record)) {
                    $result = false;
                    rollback_sql();
                    break;
                }
            }

            // Add new site-wide events
            foreach ($records as $record) {
                $session = facetoface_get_session($record->id);
                $facetoface = get_record('facetoface', 'id', $record->facetoface);

                if (!facetoface_add_session_to_site_calendar($session, $facetoface)) {
                    $result = false;
                    rollback_sql();
                    break;
                }
            }
        }

        commit_sql();
    }

    if ($result && $oldversion < 2009121701) {

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

    if ($result && $oldversion < 2009121702) {

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
        $table->addFieldInfo('createdby', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addFieldInfo('grade', XMLDB_TYPE_NUMBER, '10, 5', null, null, null, '0');
        $table->addFieldInfo('note', XMLDB_TYPE_TEXT, 'small', null, null, null, null);
        $table->addFieldInfo('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->addKeyInfo('signupid', XMLDB_KEY_FOREIGN, array('signupid'), 'facetoface_signups', array('id'));
        $result = $result && create_table($table);
    }

    if ($result && $oldversion < 2009121703) {
        global $USER, $CFG;

    /// Migrate submissions to signups
        require_once $CFG->dirroot.'/mod/facetoface/lib.php';

        begin_sql();

        // Get all submissions and loop through
        $rs = get_recordset('facetoface_submissions');

        while ($submission = rs_fetch_next_record($rs)) {

            // Insert signup
            $signup = new stdClass();
            $signup->sessionid = $submission->sessionid;
            $signup->userid = $submission->userid;
            $signup->mailedreminder = $submission->mailedreminder;
            $signup->discountcode = $submission->discountcode;
            $signup->notificationtype = $submission->notificationtype;

            if (!$id = insert_record('facetoface_signups', $signup)) {
                rollback_sql();
                error('Could not insert facetoface signup');
            }

            $signup->id = $id;

            // Check facetoface still exists (some of them are missing)
            // Also, we need the course id so we can load the grade
            $facetoface = get_record('facetoface', 'id', $submission->facetoface);
            if (!$facetoface) {
                // If facetoface delete, ignore as it's of no use to us now
                mtrace('Could not find facetoface instance '.$submission->facetoface);
                continue;
            }

            // Get grade
            $grade = facetoface_get_grade($submission->userid, $facetoface->course, $facetoface->id);

            // Create initial "booked" signup status
            $status = new stdClass();
            $status->signupid = $signup->id;
            $status->statuscode = MDL_F2F_STATUS_BOOKED;
            $status->superceded = ($grade->grade > 0 || $submission->timecancelled) ? 1 : 0;
            $status->createdby = $USER->id;
            $status->timecreated = $submission->timecreated;
            $status->mailed = 0;

            if (!insert_record('facetoface_signups_status', $status)) {
                rollback_sql();
                error('Could not insert facetoface booked status');
            }

            // Create attended signup status
            if ($grade->grade > 0) {
                $status->statuscode = MDL_F2F_STATUS_FULLY_ATTENDED;
                $status->grade = $grade->grade;
                $status->timecreated = $grade->dategraded;
                $status->superceded = $submission->timecancelled ? 1 : 0;

                if (!insert_record('facetoface_signups_status', $status)) {
                    rollback_sql();
                    error('Could not insert facetoface attended status');
                }
            }

            // If cancelled, create status
            if ($submission->timecancelled) {
                $status->statuscode = MDL_F2F_STATUS_USER_CANCELLED;
                $status->timecreated = $submission->timecancelled;
                $status->superceded = 0;

                if (!insert_record('facetoface_signups_status', $status)) {
                    rollback_sql();
                    error('Could not insert facetoface booked status');
                }
            }
        }

        rs_close($rs);
        commit_sql();

    /// Drop table facetoface_submissions
        $table = new XMLDBTable('facetoface_submissions');
        $result = $result && drop_table($table);
    }

    if ($result && $oldversion < 2009121704) {
        // New field necessary for overbooking
        $table = new XMLDBTable('facetoface_sessions');
        $field1 = new XMLDBField('allowoverbook');
        $field1->setAttributes(XMLDB_TYPE_INTEGER, 'small', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, 0, 'capacity');
        $result = $result && add_field($table, $field1);
    }

    if ($result && $oldversion < 2010012000) {
        // New field for storing recommendations/advice
        $table = new XMLDBTable('facetoface_signups_status');
        $field1 = new XMLDBField('advice');
        $field1->setAttributes(XMLDB_TYPE_TEXT, 'small', null, null, null, null);
        $result = $result && add_field($table, $field1);
    }

    if ($result && $oldversion < 2010012001) {
        // New field for storing manager approval requirement
        $table = new XMLDBTable('facetoface');
        $field = new XMLDBField('approvalreqd');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, 0, 'showoncalendar');
        $result = $result && add_field($table, $field);
    }

    if ($result && $oldversion < 2010012700) {
        // New fields for storing request emails
        $table = new XMLDBTable('facetoface');
        $field = new XMLDBField('requestsubject');
        $field->setAttributes(XMLDB_TYPE_TEXT, 'small', null, null, null, null, null, null, 'reminderperiod');
        $result = $result && add_field($table, $field);

        $field = new XMLDBField('requestinstrmngr');
        $field->setAttributes(XMLDB_TYPE_TEXT, 'medium', null, null, null, null, null, null, 'requestsubject');
        $result = $result && add_field($table, $field);

        $field = new XMLDBField('requestmessage');
        $field->setAttributes(XMLDB_TYPE_TEXT, 'medium', null, null, null, null, null, null, 'requestinstrmngr');
        $result = $result && add_field($table, $field);
    }

    if ($result && $oldversion < 2010051000) {
        // Create Calendar events for all existing Face-to-face sessions
        begin_sql();

        if ($records = get_records('facetoface_sessions', '', '', '', 'id, facetoface')) {
            // Remove all exising site-wide events (there shouldn't be any)
            foreach ($records as $record) {
                if (!facetoface_remove_session_from_site_calendar($record)) {
                    $result = false;
                    rollback_sql();
                    break;
                }
            }

            // Add new site-wide events
            foreach ($records as $record) {
                $session = facetoface_get_session($record->id);
                $facetoface = get_record('facetoface', 'id', $record->facetoface);

                if (!facetoface_add_session_to_site_calendar($session, $facetoface)) {
                    $result = false;
                    rollback_sql();
                    break;
                }
            }
        }

        commit_sql();

        // Add tables required for site notices
        $table1 = new XMLDBTable('facetoface_notice');
        $table1->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table1->addFieldInfo('name', XMLDB_TYPE_CHAR, '255', null, null, null, null, null, null);
        $table1->addFieldInfo('text', XMLDB_TYPE_TEXT, 'medium', null, null, null, null, null, null);
        $table1->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && create_table($table1);

        $table2 = new XMLDBTable('facetoface_notice_data');
        $table2->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table2->addFieldInfo('fieldid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table2->addFieldInfo('noticeid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table2->addFieldInfo('data', XMLDB_TYPE_CHAR, '255', null, null, null, null, null, null);
        $table2->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table2->addIndexInfo('facetoface_notice_date_fieldid', XMLDB_INDEX_NOTUNIQUE, array('fieldid'));
        $result = $result && create_table($table2);
    }

    if ($result && $oldversion < 2010100400) {
        // Remove unused mailed field
        $table = new XMLDBTable('facetoface_signups_status');
        $field = new XMLDBField('mailed');
        $result = $result && drop_field($table, $field, false, true);
    }

    return $result;
}

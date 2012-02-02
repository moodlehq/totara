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

/**
 *
 * Sends message to administrator listing all updated
 * duplicate custom fields
 * @param array $data
 */
function facetoface_send_admin_upgrade_msg($data) {
    global $SITE;
    //No data - no need to send email
    if (empty($data)) {
        return;
    }

    $table = new html_table();
    $table->head = array('Custom field ID',
                         'Custom field original shortname',
                         'Custom field new shortname');
    $table->data = $data;
    $table->align = array ('center', 'center', 'center');

    $title    = "$SITE->fullname: Face to Face upgrade info";
    $note = 'During the last site upgrade the face-to-face module has been modified. It now
requires session custom fields to have unique shortnames. Since some of your
custom fields had duplicate shortnames, they have been renamed to remove
duplicates (see table below). This could impact on your email messages if you
reference those custom fields in the message templates.';
    $message  = html_writer::start_tag('html') . html_writer::start_tag('head') . html_writer::tag('title', $title) . html_writer::end_tag('head');
    $message .= html_writer::start_tag('body') . html_writer::tag('p', $note). html_writer::table($table,true) . html_writer::end_tag('body') . html_writer::end_tag('html');

    $admin = get_admin();

    email_to_user($admin,
                  $admin,
                  $title,
                  '',
                  $message);

}

function xmldb_facetoface_upgrade($oldversion=0) {
    global $CFG, $USER, $DB;

    $dbman = $DB->get_manager(); // loads ddl manager and xmldb classes

    require_once($CFG->dirroot . '/mod/facetoface/lib.php');

    $result = true;

    if ($result && $oldversion < 2008050500) {
        $table = new xmldb_table('facetoface');
        $field = new xmldb_field('thirdpartywaitlist');
        $field->set_attributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0', 'thirdparty');
        $result = $result && $dbman->add_field($table, $field);
    }

    if ($result && $oldversion < 2008061000) {
        $table = new xmldb_table('facetoface_submissions');
        $field = new xmldb_field('notificationtype');
        $field->set_attributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0', 'timemodified');
        $result = $result && $dbman->add_field($table, $field);
    }

    if ($result && $oldversion < 2008080100) {
        echo $OUTPUT->notification(get_string('upgradeprocessinggrades', 'facetoface'), 'notifysuccess');
        require_once $CFG->dirroot.'/mod/facetoface/lib.php';

        $transaction = $DB->start_delegated_transaction();
        $DB->debug = false; // too much debug output

        // Migrate the grades to the gradebook
        $sql = "SELECT f.id, f.name, f.course, s.grade, s.timegraded, s.userid,
            cm.idnumber as cmidnumber
            FROM {facetoface_submissions} s
            JOIN {facetoface} f ON s.facetoface = f.id
            JOIN {course_modules} cm ON cm.instance = f.id
            JOIN {modules} m ON m.id = cm.module
            WHERE m.name='facetoface'";
        if ($rs = $DB->get_recordset_sql($sql)) {
            foreach ($rs as $facetoface) {
                $grade = new stdclass();
                $grade->userid = $facetoface->userid;
                $grade->rawgrade = $facetoface->grade;
                $grade->rawgrademin = 0;
                $grade->rawgrademax = 100;
                $grade->timecreated = $facetoface->timegraded;
                $grade->timemodified = $facetoface->timegraded;

                $result = $result && (GRADE_UPDATE_OK == facetoface_grade_item_update($facetoface, $grade));
            }
            $rs->close();
        }
        $DB->debug = true;

        // Remove the grade and timegraded fields from facetoface_submissions
        if ($result) {
            $table = new xmldb_table('facetoface_submissions');
            $field1 = new xmldb_field('grade');
            $field2 = new xmldb_field('timegraded');
            $result = $result && $dbman->drop_field($table, $field1, false, true);
            $result = $result && $dbman->drop_field($table, $field2, false, true);
        }

        $transaction->allow_commit();
    }

    if ($result && $oldversion < 2008090800) {

        // Define field timemodified to be added to facetoface_submissions
        $table = new xmldb_table('facetoface_submissions');
        $field = new xmldb_field('timecancelled');
        $field->set_attributes(XMLDB_TYPE_INTEGER, '20', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, 0, 'timemodified');

        // Launch add field
        $result = $result && $dbman->add_field($table, $field);
    }

    if ($result && $oldversion < 2009111300) {
        // New fields necessary for the training calendar
        $table = new xmldb_table('facetoface');
        $field1 = new xmldb_field('shortname');
        $field1->set_attributes(XMLDB_TYPE_CHAR, '32', null, null, null, null, 'timemodified');
        $result = $result && $dbman->add_field($table, $field1);

        $field2 = new xmldb_field('description');
        $field2->set_attributes(XMLDB_TYPE_TEXT, 'medium', null, null, null, null, 'shortname');
        $result = $result && $dbman->add_field($table, $field2);

        $field3 = new xmldb_field('showoncalendar');
        $field3->set_attributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '1', 'description');
        $result = $result && $dbman->add_field($table, $field3);
    }

    if ($result && $oldversion < 2009111600) {

        $table1 = new xmldb_table('facetoface_session_field');
        $table1->add_field('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table1->add_field('name', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table1->add_field('shortname', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table1->add_field('type', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
        $table1->add_field('possiblevalues', XMLDB_TYPE_TEXT, 'medium', null, null, null, null);
        $table1->add_field('required', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
        $table1->add_field('defaultvalue', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table1->add_field('isfilter', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '1');
        $table1->add_field('showinsummary', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '1');
        $table1->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && $dbman->create_table($table1);

        $table2 = new xmldb_table('facetoface_session_data');
        $table2->add_field('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table2->add_field('fieldid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
        $table2->add_field('sessionid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
        $table2->add_field('data', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table2->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && $dbman->create_table($table2);
    }

    if ($result && $oldversion < 2009111900) {
        // Remove unused field
        $table = new xmldb_table('facetoface_sessions');
        $field = new xmldb_field('closed');
        $result = $result && $dbman->drop_field($table, $field);
    }

    // Migration of old Location, Venue and Room fields
    if ($result && $oldversion < 2009112300) {
        // Create three new custom fields
        $newfield1 = new stdClass();
        $newfield1->name = 'Location';
        $newfield1->shortname = 'location';
        $newfield1->type = 0; // free text
        $newfield1->required = 1;
        if (!$locationfieldid = $DB->insert_record('facetoface_session_field', $newfield1)) {
            $result = false;
        }

        $newfield2 = new stdClass();
        $newfield2->name = 'Venue';
        $newfield2->shortname = 'venue';
        $newfield2->type = 0; // free text
        $newfield2->required = 1;
        if (!$venuefieldid = $DB->insert_record('facetoface_session_field', $newfield2)) {
            $result = false;
        }

        $newfield3 = new stdClass();
        $newfield3->name = 'Room';
        $newfield3->shortname = 'room';
        $newfield3->type = 0; // free text
        $newfield3->required = 1;
        $newfield3->showinsummary = 0;
        if (!$roomfieldid = $DB->insert_record('facetoface_session_field', $newfield3)) {
            $result = false;
        }

        // Migrate data into the new fields
        $olddebug = $DB->debug;
        $DB->debug = false; // too much debug output

        if ($rs = $DB->get_recordset('facetoface_sessions', array(), '', 'id, location, venue, room')) {
            foreach ($rs as $session) {
                $locationdata = new stdClass();
                $locationdata->sessionid = $session->id;
                $locationdata->fieldid = $locationfieldid;
                $locationdata->data = $session->location;
                $result = $result && $DB->insert_record('facetoface_session_data', $locationdata);

                $venuedata = new stdClass();
                $venuedata->sessionid = $session->id;
                $venuedata->fieldid = $venuefieldid;
                $venuedata->data = $session->venue;
                $result = $result && $DB->insert_record('facetoface_session_data', $venuedata);

                $roomdata = new stdClass();
                $roomdata->sessionid = $session->id;
                $roomdata->fieldid = $roomfieldid;
                $roomdata->data = $session->room;
                $result = $result && $DB->insert_record('facetoface_session_data', $roomdata);
            }
            $rs->close();
        }

        $DB->debug = $olddebug;

        // Drop the old fields
        $table = new xmldb_table('facetoface_sessions');
        $oldfield1 = new xmldb_field('location');
        $result = $result && $dbman->drop_field($table, $oldfield1);
        $oldfield2 = new xmldb_field('venue');
        $result = $result && $dbman->drop_field($table, $oldfield2);
        $oldfield3 = new xmldb_field('room');
        $result = $result && $dbman->drop_field($table, $oldfield3);
    }

    // Migration of old Location, Venue and Room placeholders in email templates
    if ($result && $oldversion < 2009112400) {
        $transaction = $DB->start_delegated_transaction();

        $olddebug = $DB->debug;
        $DB->debug = false; // too much debug output

        $templatedfields = array('confirmationsubject', 'confirmationinstrmngr', 'confirmationmessage',
            'cancellationsubject', 'cancellationinstrmngr', 'cancellationmessage',
            'remindersubject', 'reminderinstrmngr', 'remindermessage',
            'waitlistedsubject', 'waitlistedmessage');

        if ($rs = $DB->get_recordset('facetoface', array(), '', 'id, ' . implode(', ', $templatedfields))) {
            foreach ($rs as $activity) {
                $todb = new stdClass();
                $todb->id = $activity->id;

                foreach ($templatedfields as $fieldname) {
                    $s = $activity->$fieldname;
                    $s = str_replace('[location]', '[session:location]', $s);
                    $s = str_replace('[venue]', '[session:venue]', $s);
                    $s = str_replace('[room]', '[session:room]', $s);
                    $todb->$fieldname = $s;
                }

                $result = $result && $DB->update_record('facetoface', $todb);
            }
            $rs->close();
        }

        $DB->debug = $olddebug;

        $transaction->allow_commit();
    }

    if ($result && $oldversion < 2009120900) {
        // Create Calendar events for all existing Face-to-face sessions
        try {
            $transaction = $DB->start_delegated_transaction();

            if ($records = $DB->get_records('facetoface_sessions', '', '', '', 'id, facetoface')) {
                // Remove all exising site-wide events (there shouldn't be any)
                foreach ($records as $record) {
                    if (!facetoface_remove_session_from_site_calendar($record)) {
                        $result = false;
                        throw new Exception('Could not remove session from site calendar');
                        break;
                    }
                }

                // Add new site-wide events
                foreach ($records as $record) {
                    $session = facetoface_get_session($record->id);
                    $facetoface = $DB->get_record('facetoface', 'id', $record->facetoface);

                    if (!facetoface_add_session_to_site_calendar($session, $facetoface)) {
                        $result = false;
                        throw new Exception('Could not add session to site calendar');
                        break;
                    }
                }
            }
            $transaction->allow_commit();
        } catch (Exception $e) {
            $transaction->rollback($e);
        }

    }

    if ($result && $oldversion < 2009122901) {

    /// Create table facetoface_session_roles
        $table = new xmldb_table('facetoface_session_roles');
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('sessionid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->add_field('roleid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->add_key('sessionid', XMLDB_KEY_FOREIGN, array('sessionid'), 'facetoface_sessions', array('id'));
        $result = $result && $dbman->create_table($table);

    /// Create table facetoface_signups
        $table = new xmldb_table('facetoface_signups');
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('sessionid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->add_field('mailedreminder', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->add_field('discountcode', XMLDB_TYPE_TEXT, 'small', null, null, null, null);
        $table->add_field('notificationtype', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->add_key('sessionid', XMLDB_KEY_FOREIGN, array('sessionid'), 'facetoface_sessions', array('id'));
        $result = $result && $dbman->create_table($table);

    /// Create table facetoface_signups_status
        $table = new xmldb_table('facetoface_signups_status');
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('signupid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->add_field('statuscode', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->add_field('superceded', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->add_field('createdby', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->add_field('grade', XMLDB_TYPE_NUMBER, '10, 5', null, null, null, '0');
        $table->add_field('note', XMLDB_TYPE_TEXT, 'small', null, null, null, null);
        $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->add_key('signupid', XMLDB_KEY_FOREIGN, array('signupid'), 'facetoface_signups', array('id'));
        $result = $result && $dbman->create_table($table);

    /// Migrate submissions to signups
        $table = new xmldb_table('facetoface_submissions');
        if ($dbman->table_exists($table)) {
            require_once $CFG->dirroot.'/mod/facetoface/lib.php';

            $transaction = $DB->start_delegated_transaction();

            // Get all submissions and loop through
            $rs = $DB->get_recordset('facetoface_submissions');

            foreach ($rs as $submission) {

                // Insert signup
                $signup = new stdClass();
                $signup->sessionid = $submission->sessionid;
                $signup->userid = $submission->userid;
                $signup->mailedreminder = $submission->mailedreminder;
                $signup->discountcode = $submission->discountcode;
                $signup->notificationtype = $submission->notificationtype;

                $id = $DB->insert_record('facetoface_signups', $signup);

                $signup->id = $id;

                // Check facetoface still exists (some of them are missing)
                // Also, we need the course id so we can load the grade
                $facetoface = $DB->get_record('facetoface', 'id', $submission->facetoface);
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

                $DB->insert_record('facetoface_signups_status', $status);

                // Create attended signup status
                if ($grade->grade > 0) {
                    $status->statuscode = MDL_F2F_STATUS_FULLY_ATTENDED;
                    $status->grade = $grade->grade;
                    $status->timecreated = $grade->dategraded;
                    $status->superceded = $submission->timecancelled ? 1 : 0;

                    $DB->insert_record('facetoface_signups_status', $status);
                }

                // If cancelled, create status
                if ($submission->timecancelled) {
                    $status->statuscode = MDL_F2F_STATUS_USER_CANCELLED;
                    $status->timecreated = $submission->timecancelled;
                    $status->superceded = 0;

                    $DB->insert_record('facetoface_signups_status', $status);
                }
            }

            $rs->close();
            $transaction->allow_commit();

            /// Drop table facetoface_submissions
            $table = new xmldb_table('facetoface_submissions');
            $result = $result && $dbman->drop_table($table);
        }

    // New field necessary for overbooking
        $table = new xmldb_table('facetoface_sessions');
        $field1 = new xmldb_field('allowoverbook');
        $field1->set_attributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, 0, 'capacity');
        $result = $result && $dbman->add_field($table, $field1);
    }

    if ($result && $oldversion < 2010012000) {
        // New field for storing recommendations/advice
        $table = new xmldb_table('facetoface_signups_status');
        $field1 = new xmldb_field('advice');
        $field1->set_attributes(XMLDB_TYPE_TEXT, 'small', null, null, null);
        $result = $result && $dbman->add_field($table, $field1);
    }

    if ($result && $oldversion < 2010012001) {
        // New field for storing manager approval requirement
        $table = new xmldb_table('facetoface');
        $field = new xmldb_field('approvalreqd');
        $field->set_attributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, 0, 'showoncalendar');
        $result = $result && $dbman->add_field($table, $field);
    }

    if ($result && $oldversion < 2010012700) {
        // New fields for storing request emails
        $table = new xmldb_table('facetoface');
        $field = new xmldb_field('requestsubject');
        $field->set_attributes(XMLDB_TYPE_TEXT, 'small', null, null, null, null, 'reminderperiod');
        $result = $result && $dbman->add_field($table, $field);

        $field = new xmldb_field('requestinstrmngr');
        $field->set_attributes(XMLDB_TYPE_TEXT, 'medium', null, null, null, null, 'requestsubject');
        $result = $result && $dbman->add_field($table, $field);

        $field = new xmldb_field('requestmessage');
        $field->set_attributes(XMLDB_TYPE_TEXT, 'medium', null, null, null, null, 'requestinstrmngr');
        $result = $result && $dbman->add_field($table, $field);
    }

    if ($result && $oldversion < 2010051000) {
        // Create Calendar events for all existing Face-to-face sessions
        $transaction = $DB->start_delegated_transaction();

        if ($records = $DB->get_records('facetoface_sessions', '', '', '', 'id, facetoface')) {
            // Remove all exising site-wide events (there shouldn't be any)
            foreach ($records as $record) {
                facetoface_remove_session_from_site_calendar($record);
            }

            // Add new site-wide events
            foreach ($records as $record) {
                $session = facetoface_get_session($record->id);
                $facetoface = $DB->get_record('facetoface', 'id', $record->facetoface);

                facetoface_add_session_to_site_calendar($session, $facetoface);
            }
        }

        $transaction->allow_commit();

        // Add tables required for site notices
        $table1 = new xmldb_table('facetoface_notice');
        $table1->add_field('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table1->add_field('name', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table1->add_field('text', XMLDB_TYPE_TEXT, 'medium', null, null, null, null);
        $table1->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $result = $result && $dbman->create_table($table1);

        $table2 = new xmldb_table('facetoface_notice_data');
        $table2->add_field('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table2->add_field('fieldid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
        $table2->add_field('noticeid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0');
        $table2->add_field('data', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table2->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table2->add_index('facetoface_notice_date_fieldid', XMLDB_INDEX_NOTUNIQUE, array('fieldid'));
        $result = $result && $dbman->create_table($table2);
    }

    if ($result && $oldversion < 2010100400) {
        // Remove unused mailed field
        $table = new xmldb_table('facetoface_signups_status');
        $field = new xmldb_field('mailed');
        if ($dbman->field_exists($table, $field)) {
            $result = $result && $dbman->drop_field($table, $field, false, true);
        }

    }

    // 2.0 upgrade line -----------------------------------

    if ($oldversion < 2011120701) {
        // Update existing select fields to use new seperator
        $badrows = $DB->get_records_sql(
            "
                SELECT
                    *
                FROM
                    {facetoface_session_field}
                WHERE
                    possiblevalues LIKE '%;%'
                AND possiblevalues NOT LIKE '%" . CUSTOMFIELD_DELIMITER . "%'
                AND type IN (".CUSTOMFIELD_TYPE_SELECT.",".CUSTOMFIELD_TYPE_MULTISELECT.")
            "
        );

        if ($badrows) {
            $transaction = $DB->start_delegated_transaction();

            foreach ($badrows as $bad) {
                $fixedrow = new stdClass();
                $fixedrow->id = $bad->id;
                $fixedrow->possiblevalues = str_replace(';', CUSTOMFIELD_DELIMITER, $bad->possiblevalues);
                $DB->update_record('facetoface_session_field', $fixedrow);
            }

            $transaction->allow_commit();
        }

        $bad_data_rows = $DB->get_records_sql(
            "
                SELECT
                    sd.id, sd.data
                FROM
                    {facetoface_session_field} sf
                JOIN
                    {facetoface_session_data} sd
                  ON
                    sd.fieldid=sf.id
                WHERE
                    sd.data LIKE '%;%'
                AND sd.data NOT LIKE '%". CUSTOMFIELD_DELIMITER ."%'
                AND sf.type = ".CUSTOMFIELD_TYPE_MULTISELECT
        );

        if ($bad_data_rows) {
            $transaction = $DB->start_delegated_transaction();

            foreach ($bad_data_rows as $bad) {
                $fixedrow = new stdClass();
                $fixedrow->id = $bad->id;
                $fixedrow->data = str_replace(';', CUSTOMFIELD_DELIMITER, $bad->data);
                $DB->update_record('facetoface_session_data', $fixedrow);
            }

            $transaction->allow_commit();
        }

        upgrade_mod_savepoint(true, 2011120701, 'facetoface');
    }

    if ($oldversion < 2011120702) {
        $table = new xmldb_table('facetoface_session_field');
        $index = new xmldb_index('ind_session_field_unique');
        $index->set_attributes(XMLDB_INDEX_UNIQUE, array('shortname'));

        if ($dbman->table_exists($table)) {
            //do we need to check for duplicates?
            if (!$dbman->index_exists($table, $index)) {

                //check for duplicate records and make them unique
                $replacements = array();

                $transaction = $DB->start_delegated_transaction();

                $sql = 'SELECT
                            l.id,
                            l.shortname
                        FROM
                            {facetoface_session_field} l,
                            ( SELECT
                                    MIN(id) AS id,
                                    shortname
                              FROM
                                    {facetoface_session_field}
                              GROUP BY
                                    shortname
                              HAVING COUNT(*)>1
                             ) a
                        WHERE
                            l.id<>a.id
                        AND l.shortname = a.shortname
                ';

                $rs = $DB->get_recordset_sql($sql, null);

                //$rs = facetoface_tbl_duplicate_values('facetoface_session_field','shortname');
                if ($rs !== false) {
                    foreach ($rs as $item) {
                        $data = (object)$item;
                        //randomize the value
                        $data->shortname = $DB->escape($data->shortname.'_'.$data->id);
                        $DB->update_record('facetoface_session_field', $data);
                        $replacements[]=array($item['id'], $item['shortname'], $data->shortname);
                    }
                }

                $transaction->allow_commit();
                facetoface_send_admin_upgrade_msg($replacements);

                //Apply the index
                $dbman->add_index($table, $index);
            }
        }

        upgrade_mod_savepoint(true, 2011120702, 'facetoface');
    }

    if ($oldversion < 2011120703) {

        $table = new xmldb_table('facetoface');
        $field = new xmldb_field('intro', XMLDB_TYPE_TEXT, 'big', null, null, null, null, 'name');

        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Add the introformat field
        $field = new xmldb_field('introformat', XMLDB_TYPE_INTEGER, '2', null, XMLDB_NOTNULL, null, '0', 'intro');

        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        $field = new xmldb_field('description');
        if ($dbman->field_exists($table, $field)) {

            // Move all data from description to intro
            $facetofaces = $DB->get_records('facetoface');
            foreach ($facetofaces as $facetoface) {
                $facetoface->intro = $facetoface->description;
                $facetoface->introformat = FORMAT_HTML;
                $DB->update_record('facetoface', $facetoface);
            }

            // Remove the old description field
            $dbman->drop_field($table, $field);
        }

        // facetoface savepoint reached
        upgrade_mod_savepoint(true, 2011120703, 'facetoface');
    }

    return $result;
}

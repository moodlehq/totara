<?php

// This file keeps track of upgrades to
// the reportbuilder module
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

function xmldb_local_reportbuilder_upgrade($oldversion=0) {

    global $CFG, $db;

    $result = true;

    if ($result && $oldversion < 2010081901) {
        // hack to get cron working via admin/cron.php
        // at some point we should create a local_modules table
        // based on data in version.php
        set_config('local_reportbuilder_cron', 60);
    }

    if ($result && $oldversion < 2010090200) {
        if($reports = get_records_select('report_builder', 'embeddedurl IS NOT NULL')) {
            foreach($reports as $report) {
                $url = $report->embeddedurl;
                // remove the wwwroot from the url
                if($CFG->wwwroot == substr($url, 0, strlen($CFG->wwwroot))) {
                    $url = substr($url, strlen($CFG->wwwroot));
                }
                // check to fix embedded urls with wrong host
                // this should fix all historical cases as up to now all embedded reports
                // have been in the /my/ directory
                // this does nothing if '/my/' not in url or
                // url already without wwwroot
                $url = substr($url, strpos($url, '/my/'));

                // do the update if needed
                if($report->embeddedurl != $url) {
                    $todb = new object();
                    $todb->id = $report->id;
                    $todb->embeddedurl = addslashes($url);
                    $result = $result && update_record('report_builder', $todb);
                }
            }
        }
    }

    // add various table settings to report_builder table
    if ($result && $oldversion < 2010090900) {
        /// Define field recordsperpage to be added to report_builder
        $table = new XMLDBTable('report_builder');
        $field = new XMLDBField('recordsperpage');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '40', 'description');
        /// Launch add field recordsperpage
        $result = $result && add_field($table, $field);

        /// Define field defaultsortcolumn to be added to report_builder
        $field = new XMLDBField('defaultsortcolumn');
        $field->setAttributes(XMLDB_TYPE_CHAR, '255', null, null, null, null, null, null, 'recordsperpage');
        /// Launch add field defaultsortcolumn
        $result = $result && add_field($table, $field);

        $field = new XMLDBField('defaultsortorder');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null, null, 4, 'defaultsortcolumn');
        /// Launch add field defaultsortorder
        $result = $result && add_field($table, $field);

    }

    // tables for scheduled reports
    if ($result && $oldversion < 2010101200) {
        $table = new XMLDBTable('report_builder_schedule');
        if(!table_exists($table)) {
            $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
            $table->addFieldInfo('reportid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
            $table->addFieldInfo('userid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
            $table->addFieldInfo('savedsearchid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
            $table->addFieldInfo('format', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
            $table->addFieldInfo('frequency', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
            $table->addFieldInfo('schedule', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
            $table->addFieldInfo('nextreport', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, null, null);

            /// Adding keys to table report_builder_group
            $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));

            create_table($table);
        }
    }

    if ($result && $oldversion < 2010122300) {

        /// Define field embedded to be added to report_builder
        $table = new XMLDBTable('report_builder');
        $field = new XMLDBField('embedded');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'description');

        /// Launch add field embedded
        $result = $result && add_field($table, $field);

        // update for existing records
        $sql = "UPDATE {$CFG->prefix}report_builder SET embedded=1 WHERE embeddedurl IS NOT NULL";
        $result = $result && execute_sql($sql);

        // now drop embeddedurl column
        $field = new XMLDBField('embeddedurl');
         /// Launch drop field embeddedurl
        $result = $result && drop_field($table, $field);
    }

    if ($result && $oldversion < 2011011800) {

        /// Remove urgency column from Notifications and Reminders embedded reports
        $sql = "DELETE FROM {$CFG->prefix}report_builder_columns
            WHERE value = 'urgency' AND reportid IN (SELECT id FROM {$CFG->prefix}report_builder
                WHERE shortname IN ('notifications', 'reminders'))";
        $result = $result && execute_sql($sql);

        /// Remove urgency filter from Notifications and Reminders embedded reports
        $sql = "DELETE FROM {$CFG->prefix}report_builder_filters
            WHERE value = 'urgency' AND reportid IN (SELECT id FROM {$CFG->prefix}report_builder
                WHERE shortname IN ('notifications', 'reminders'))";
        $result = $result && execute_sql($sql);

        /// Give msgid col heading value (Notifications and Reminders)
        $sql = "Update {$CFG->prefix}report_builder_columns
            SET heading = 'Id'
            WHERE value = 'msgid' AND reportid IN (SELECT id FROM {$CFG->prefix}report_builder
                WHERE shortname IN ('notifications', 'reminders'))";
        $result = $result && execute_sql($sql);
    }

    if ($result && $oldversion < 2011011801) {

        /// Remove 'Plan' and 'Plan Status' cols from 'ROL courses' report
        $sql = "DELETE FROM {$CFG->prefix}report_builder_columns
            WHERE (value = 'planlink' OR value='status')
            AND reportid IN (SELECT id FROM {$CFG->prefix}report_builder
                WHERE shortname IN ('plan_courses'))";
        $result = $result && execute_sql($sql);

        /// Add 'Type' col to 'ROL courses' report
        $todb = new object();
        $todb->reportid = get_field('report_builder', 'id', 'shortname', 'plan_courses');
        $todb->type = 'course_info_data';
        $todb->value = 'coursetypeicon';
        $todb->heading = 'Type';
        $todb->sortorder = get_field('report_builder_columns', sql_max('sortorder'), 'reportid', $todb->reportid);
        $result = $result && insert_record('report_builder_columns', $todb);
    }

    return $result;
}

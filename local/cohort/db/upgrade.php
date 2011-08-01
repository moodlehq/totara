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

function xmldb_local_cohort_upgrade($oldversion=0) {

    global $CFG, $db;

    $result = true;

    if ($result && $oldversion < 2011072700) {
        // hack to get cron working via admin/cron.php
        set_config('local_cohort_cron', 60);
    }

    // delete capabilities that have changed and should be removed
    if ($result && $oldversion < 2011072704) {
        delete_records('capabilities', 'name', 'moodle/cohort:manage');
        delete_records('capabilities', 'name', 'moodle/cohort:assign');
        delete_records('capabilities', 'name', 'moodle/cohort:view');
    }

    return $result;
}

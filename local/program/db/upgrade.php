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

    return $result;
}

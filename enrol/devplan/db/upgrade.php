<?php  //$Id$

// This file keeps track of upgrades to 
// the devplan enrol plugin
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

function xmldb_enrol_devplan_upgrade($oldversion=0) {

    global $CFG, $THEME, $db;

    $result = true;

/// And upgrade begins here. For each one, you'll need one 
/// block of code similar to the next one. Please, delete 
/// this comment lines once this file start handling proper
/// upgrade code.

    if ($result && $oldversion < 2010120700) {
        $enrolconfig = get_record('config', 'name', 'enrol_plugins_enabled');
        $enrolplugins = explode(',', $enrolconfig->value);
        if (!in_array('devplan', $enrolplugins)) {
            array_push($enrolplugins, 'devplan');
            $enrolconfig->value = implode(',', $enrolplugins);
            $result = $result && update_record('config', addslashes_object($enrolconfig));
        }
    }
    return $result;
}

?>

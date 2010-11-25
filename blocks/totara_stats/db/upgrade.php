<?php

// This file keeps track of upgrades to
// the totara_stats block
//

function xmldb_block_totara_stats_upgrade($oldversion=0) {

    global $CFG, $THEME, $db;

    $result = true;

/// And upgrade begins here. For each one, you'll need one
/// block of code similar to the next one. Please, delete
/// this comment lines once this file start handling proper
/// upgrade code.

    if ($result && $oldversion < 2010112500) { //New version in version.php
        $table = new XMLDBTable('block_totara_stats');

        $field = new XMLDBField('eventtype');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null);
        $result = $result && change_field_type($table, $field);
    }

    return $result;
}

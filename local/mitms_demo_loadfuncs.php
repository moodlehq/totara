<?php

// code to include with load demo scripts

function bump_sequence($table, $prefix, $maxid) {
    global $CFG;
    $newseq = $maxid + 1;
    switch($CFG->dbfamily) {
    // TODO this has not actually been tested with mysql but is based on
    // some other code that (presumably) was tested so it should work!
    case 'mysql':
        execute_sql("ALTER TABLE $table auto_increment = ".$newseq, false);
        break;
    case 'postgres':
        $xmldbtable = new XMLDBTable($table);
        $sequencename = find_sequence_name($xmldbtable);
        execute_sql("SELECT setval('$sequencename', $newseq)", false);
        break;
    default:
        $currmax = get_field_sql('SELECT '.sql_max('id')." FROM $prefix$table");
        // get last record
        $lastrecord = get_record($table, 'id', $currmax);
        quote_record($lastrecord);
        while($res = insert_delete_record($table, $lastrecord) <= $maxid) {
            // keep doing loop until last inserted record id is higher than max
            // or insert_delete_record fails
            if(!$res) {
                print "insert_delete_record failed!";
                break;
            }
        }
        break;
    }
    return;
}

function quote_record($record) {
    global $db, $CFG;

    $recordarray = (array)$record;
    foreach ($recordarray as $key => $value) {
        if ($value === null) continue; // preserve NULLs

        $quotedvalue = $db->qstr($value, false);

        // Remove the single quotes added around the string
        $quotedvalue = substr($quotedvalue, 1, strlen($quotedvalue) - 2);

        // Undo the dirty Oracle hack necessary for nullable text fields
        if ($CFG->dbfamily != 'oracle' and ' ' === $quotedvalue) {
            $quotedvalue = '';
        }

        $record->{$key} = $quotedvalue;
    }
}

// Insert a record, get its ID and then delete it, a number of times
function insert_delete_record($tablename, $quotedrecord, $numberoftimes=1) {
    global $CFG;

    if (!$quotedrecord) {
        return 0;
    }

    // If the original ID is 0, we won't delete and restore the
    // original record because the record that's passed in doesn't
    // already exist
    $originalid = $quotedrecord->id;

    begin_sql();

    // Delete original record to avoid conflicts on unique fields
    if ($originalid and !delete_records($tablename, 'id', $originalid)) {

        print "Failed to delete record (id=$originalid) in $tablename\n";
        rollback_sql();
        return false;
    }

    // Insert and delete a number of times to bump the sequence
    $id = 0;
    for ($i = 0; $i < $numberoftimes; $i += 1) {

        $id = insert_record($tablename, $quotedrecord);
        if (!$id) {
            print "Failed to insert record in $tablename\n";
            rollback_sql();
            return false;
        }
        if (!delete_records($tablename, 'id', $id)) {
            print "Failed to delete record (id=$id) in $tablename\n";
            rollback_sql();
            return false;
        }
    }

    if ($originalid) {
        // Re-insert original record with new ID
        $id = insert_record($tablename, $quotedrecord);
        if (!$id) {
            print "Failed to re-insert original record in $tablename\n";
            rollback_sql();
            return false;
        }

        // Restore the original ID on the record
        if (!execute_sql("UPDATE {$CFG->prefix}$tablename SET id = $originalid WHERE id = $id", false)) {
            print "Failed to restore the original ID ($id => $originalid) in $tablename\n";
            rollback_sql();
            return false;
        }
    }

    commit_sql();
    return $id; // the last ID that was added
}

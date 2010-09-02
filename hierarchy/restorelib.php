<?php

/**
 *
 * To restore a hierarchy the following files must be in place:
 *
 * 1- See the list in hierarchy/backuplib.php, Some of the backup functions are
 *    also used in the restore process so probably best to have all that stuff
 *    for restore too. In particular hierarchy/type/[hname]/backuplib.php is
 *    required.
 *
 * 2- Must have a file called hierarchy/type/[hname]/restorelib.php
 *
 * 3- restorelib.php must include a function called [hname]_restore(), which
 *    is the function that performs the restore for that hierarchy
 *
 *    [hname]_restore() must have the following arguments:
 *    - $info
 *      Contains the XMLized data for the restore process
 *    - $fwtobackup
 *      Array of frameworks to be backed up. Keys are framework IDs, values
 *      are 1 if framework is to be included or 0 otherwise.
 *    - $options
 *      Array of options for this restore. Keys are specified in
 *      [hname]_options(), values are set by user
 *    - $backup_unique_code
 *      Is the unique code associated with this restore (used to track
 *      old and new ids during the process)
**/

/**
 * Get list of possible files to restore from hierarchy backup folder
 *
 * @param string $dir Directory that contains the hierarchy backup files
 * @return mixed Array of possible backup files. If no files returns an
 *               empty array. If $dir is not a directory returns false
**/
function hierarchyrestore_get_backup_files($dir) {
    if(!is_dir($dir)) {
        return false;
    }
    $filelist = array();
    $dir = opendir($dir);
    while (false !== ($file = readdir($dir))) {
        if ($file == "." || $file == ".." || substr($file, -4) != ".zip") {
            continue;
        }
        $filelist[$file] = $file;
    }
    closedir($dir);

    return $filelist;

}


/**
 * Unpacks the zip file ready for restore and does some basic checks 
 * to make sure file looks okay
 * Returns the contents of the XML file as an xmlized PHP array
 *
 * @param string $file Name of the file to be restored
 * @param int $backup_unique_code Unique code used to track ids during
 *            the restore process
 * @param string &$errorstr Passed by reference. Error string that can
 *                          be set in this function which is displayed
 *                          if function returns false
 * @return mixed XMLized array based on file contents or false if checks
 *               fail.
**/
function hierarchyrestore_precheck($file, $backup_unique_code, &$errorstr) {
    global $CFG, $SESSION;

    //Prepend dataroot to variable to have the absolute path
    $file = $CFG->dataroot."/hierarchies/".$file;

    //Start the progress ul
    echo "<ul>";

    //Check the file exists
    if (!is_file($file)) {
        $errorstr = "File does not exist ($file)";
        return false;
    }

    //Check the file name ends with .zip
    if (!substr($file,-4) == ".zip") {
        $errorstr = 'File has an incorrect extension';
        return false;
    }

    //Now check and create the backup dir (if it doesn't exist)
    echo "<li>".get_string("creatingtemporarystructures").'</li>';
    $status = check_and_create_backup_dir($backup_unique_code);

    //Empty dir
    if ($status) {
        $status = clear_backup_dir($backup_unique_code);
    }

    //Now delete old data and directories under dataroot/temp/backup
    if ($status) {
        echo "<li>".get_string("deletingolddata").'</li>';
        $status = backup_delete_old_data();
    }

    //Now copy he zip file to dataroot/temp/backup/backup_unique_code
    if ($status) {
        echo "<li>".get_string("copyingzipfile").'</li>';
        if (! $status = backup_copy_file($file,$CFG->dataroot."/temp/backup/".$backup_unique_code."/".basename($file))) {
            $errorstr = "Error copying backup file. Invalid name or bad perms";
            return false;
        }
    }

    //Now unzip the file
    if ($status) {
        echo "<li>".get_string("unzippingbackup").'</li>';
        if (! $status = restore_unzip ($CFG->dataroot."/temp/backup/".$backup_unique_code."/".basename($file))) {
            $errorstr = "Error unzipping backup file. Invalid zip file.";
            return false;
        }
    }

    //Now check for the moodle.xml file
    if ($status) {
        $xml_file  = $CFG->dataroot."/temp/backup/".$backup_unique_code."/moodle.xml";
        echo "<li>".get_string("checkingbackup").'</li>';
        if (! $status = restore_check_moodle_file ($xml_file)) {
            if (!is_file($xml_file)) {
                $errorstr = 'Error checking backup file. moodle.xml not found at root level of zip file.';
            } else {
                $errorstr = 'Error checking backup file. moodle.xml is incorrect or corrupted.';
            }
            return false;
        }
    }

    $info = "";

    //Now read the whole xml file into a big array
    if ($status) {
        echo "<li>".get_string("readinginfofrombackup").'</li>';
        //Reading info from file
        $xml = file_get_contents($xml_file);
        $info = xmlize($xml);

   }

    //End the progress ul
    echo "</ul>\n";

    /*
    // debugging xml array
    traverse_xmlize($info);
    print_object($GLOBALS['traverse_array']);
    $GLOBALS['traverse_array'] ='';
     */

    if (!$status) {
        $errorstr = "An error has occured"; // helpful! :P
        return false;
    }
    return $info;

}

/*
 * Recursive version of array_key_exists() used to search XMLize data
 * for particular tags
 *
 * @param string $needle Array key to look for
 * @param array $haystack Nested array to search for key
 * @return boolean True if key exists, false otherwise
**/
function array_key_exists_r($needle, $haystack) {
    $result = array_key_exists($needle, $haystack);
    if ($result) {
        return $result;
    }

    foreach ($haystack as $v) {
        if (is_array($v)) {
            $result = array_key_exists_r($needle, $v);
        }
        if ($result) return $result;
    }
    return $result;
}

/**
 * Examines the backup file to look for specific tags, returning an object
 * that provides information about the file contents. This is used to 
 * display the select options form (hierarchyrestore_chooseitems_form).
 *
 * @param array $info XMLized array containing parsed XML file
 * @param int $backup_unique_code Unique code used to track ids during restore
 *                                process.
 * @param string $errorstr Passed by reference. Error string which is displayed
 *                         if this function returns false
 * @return array $contents Array used by forms to display form options to user
 *                         Structure of this array is:
 *
 *    $contents->options->usercount   Number of users in XML file
 *    $contents->[hierarchyname]      Object for each hierarchy in file
 *
 *    Each hiearchy object (above) contains:
 *
 *    ->frameworks[]               Array of frameworks with key = framework ID
 *    ->frameworks[]->fullname     Name of a particular framework
 *    ->frameworks[]->itemcount    Number of items within this framework
 *
 *    ->options->[optionname]      Option as defined by [hname]_options()
 *    ->options->[optionname]->exists   If the option is set
 *                           ->label    Label for displaying the option
 *                           ->default  Default option value
**/
function get_backup_contents($info, $backup_unique_code, &$errorstr) {
    global $CFG;

    // check for hierarchies
    if(isset($info['MOODLE_BACKUP']['#']['HIERARCHIES']['0']['#']['HIERARCHY'])) {
        $hierarchies = $info['MOODLE_BACKUP']['#']['HIERARCHIES']['0']['#']['HIERARCHY'];
    } else {
        $errorstr = 'No hierarchies found';
        return false;
    }

    $contents = new object();

    // include the unique code for this restore
    $contents->backup_unique_code = $backup_unique_code;

    // check if backup includes user data and count number of users
    if(isset($info['MOODLE_BACKUP']['#']['COURSE']['0']['#']['USERS']['0']['#']['USER'])) {
        $users = $info['MOODLE_BACKUP']['#']['COURSE']['0']['#']['USERS']['0']['#']['USER'];
        $contents->options->usercount = count($users);
    }
    else {
        $contents->options->usercount = 0;
    }

    // loop through XML and create array of hierarchies, frameworks and item counts
    // to be used to build the selection form
    // We only extract the info we need for the form
    foreach($hierarchies as $hierarchy) {
        $name = $hierarchy['#']['NAME']['0']['#'];
        $contents->$name = new object();

        $hbackupfile = "$CFG->dirroot/hierarchy/type/$name/backuplib.php";
        if(file_exists($hbackupfile)) {
            include_once($hbackupfile);
        }

        // get the name of the tag for this hierarchy
        $getitemtagfunc = $name.'_get_item_tag';
        if(function_exists($getitemtagfunc)) {
            $itemnameplural = $getitemtagfunc(true);
            $itemname = $getitemtagfunc();
        } else {
            // try to guess tag name using name
            $itemname = strtoupper($name);
            $itemnameplural = strtoupper($name.'s');
        }

        if(isset($hierarchy['#']['FRAMEWORKS']['0']['#']['FRAMEWORK'])) {
            $frameworks = $hierarchy['#']['FRAMEWORKS']['0']['#']['FRAMEWORK'];
            $contents->$name->frameworks = array();
            foreach($frameworks AS $framework) {
                $fullname = addslashes($framework['#']['FULLNAME']['0']['#']);
                $id = addslashes($framework['#']['ID']['0']['#']);
                $contents->$name->frameworks[$id] = new object();
                $contents->$name->frameworks[$id]->fullname = $fullname;

                if(isset($framework['#'][$itemnameplural]['0']['#'][$itemname])) {
                    $items = $framework['#'][$itemnameplural]['0']['#'][$itemname];
                    $contents->$name->frameworks[$id]->itemcount = count($items);
                } else {
                    $contents->$name->frameworks[$id]->itemcount = 0;
                }

            }
        }

        // the rest of this function is hierarchy specific. We look for 
        // specific tags based on the options set by [hierarchy-type]_options()
        // in the file /hierarchy/type/[hierarchytype]/backuplib.php

        // check to see if backup contains optional tags for this hierarchy
        $optionsfunc = $name.'_options';
        if(function_exists($optionsfunc)) {
            $options = $optionsfunc();
            foreach ($options AS $option) {
                $opname = $option['name'];
                $optag = $option['tag'];
                $oplabel = $option['label'];
                $opdefault = $option['default'];
                // if optag is an array key, this option was included in backup
                $contents->$name->options->$opname->exists = array_key_exists_r($optag, $hierarchy);
                $contents->$name->options->$opname->label = $oplabel;
                $contents->$name->options->$opname->default = $opdefault;
            }
        }
    }

    return $contents;
}

/**
 * Creates a temporary table used for matching backed up users to existing users
 *
 * TODO this should be obsolete as job done by user backup scripts
 *
**/
function create_temp_user_table($tname) {
    global $CFG;
    require_once("$CFG->libdir/ddllib.php");
    require_once("$CFG->libdir/xmldb/classes/XMLDBTable.class.php");

    $table = new XMLDBTable($tname);
    $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED,
                         XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
    $table->addFieldInfo('oid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED,
                         XMLDB_NOTNULL, null, null, null, null);
    $table->addFieldInfo('username', XMLDB_TYPE_CHAR, '100', null,
                         XMLDB_NOTNULL, null, null, null, null);
    $table->addFieldInfo('email', XMLDB_TYPE_CHAR, '100', null, 
                         XMLDB_NOTNULL, null, null, null, null);
    $table->addFieldInfo('backup_unique_code', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED,
                         XMLDB_NOTNULL, null, null, null, null);
    /// Adding keys
    $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
    if(table_exists($table)) {
        return true;
    }
    
    return create_table($table, true, false);
    
}

function match_users($info, $backup_unique_code) {
    $tempusers = 'hbackup_temp_user';
    $status = create_temp_user_table($tempusers);

    // delete entries with same unique code to avoid duplicates
    delete_records($tempusers, 'backup_unique_code', $backup_unique_code);
    // write users from XML file to temporary table
    if(isset($info['MOODLE_BACKUP']['#']['COURSE']['0']['#']['USERS']['0']['#']['USER'])) {
        $users = $info['MOODLE_BACKUP']['#']['COURSE']['0']['#']['USERS']['0']['#']['USER'];
        foreach($users as $user) {
            $todb = new object();
            $todb->oid = addslashes($user['#']['ID']['0']['#']);
            $todb->username = addslashes($user['#']['USERNAME']['0']['#']);
            $todb->email = addslashes($user['#']['EMAIL']['0']['#']);
            $todb->backup_unique_code = $backup_unique_code;
            insert_record($tempusers,$todb); 
        }
    } else {
        return false;
    }

    // compare users in temporary table to users in database. Find and count matches by field
    $sql = "SELECT b.oid, SUM(CASE WHEN b.oid=u.id THEN 1 ELSE 0 END) AS idmatch,
                SUM(CASE WHEN b.username=u.username THEN 1 ELSE 0 END) AS usernamematch,
                SUM(CASE WHEN b.email=u.email THEN 1 ELSE 0 END) AS emailmatch 
                FROM {$CFG->prefix}user u, {$CFG->prefix}hbackup_temp_user b
                WHERE b.backup_unique_code = $backup_unique_code 
                GROUP BY b.oid ORDER BY oid;";
    $matches = get_records_sql($sql);

    $total = $idmatch = $usernamematch = $emailmatch = $unmatched = 0;
    // TODO consider providing stats on multiple matches - at the moment they are treated
    // as unmatched, which is not ideal
    foreach ($matches AS $match) {
        $total++;
        if ($match->idmatch == 1) {
            $idmatch++;
            continue;
        }
        if ($match->usernamematch == 1) {
            $usernamematch++;
            continue;
        }
        if ($match->emailmatch == 1) {
            $emailmatch++;
            continue;
        }
        $unmatched++;
    } 
    return "Users: TOTAL: $total | ID: $idmatch | USERNAME: $usernamematch | EMAIL: $emailmatch | UNMATCHED: $unmatched";

}

function match_items($frameworkinfo, $hname, $fwid, $tempitems, $backup_unique_code) {
    global $CFG;
    $hbackupfile = "$CFG->dirroot/hierarchy/type/$hname/backuplib.php";
    if(file_exists($hbackupfile)) {
        include_once($hbackupfile);
    }
    $getitemtagfunc = $hname.'_get_item_tag';
    if(function_exists($getitemtagfunc)) {
        $itemplural = $getitemtagfunc(true);
        $itemsingle = $getitemtagfunc();
    } else {
        // try to guess tag name using name
        $itemplural = strtoupper($hname.'s');
        $itemsingle = strtoupper($hname);
    }
    // figure out the table name based on the hierarchy
    include_once($CFG->dirroot.'/hierarchy/type/'.$hname.'/lib.php');
    $hierarchy = new $hname();
    $shorthname = $hierarchy->shortprefix;

    // write items from XML file to temporary table
    if (isset($frameworkinfo['#'][$itemplural]['0']['#'][$itemsingle])) {
        $items = $frameworkinfo['#'][$itemplural]['0']['#'][$itemsingle];
        //print_object($items);
        foreach ($items AS $item) {
            $todb = new object();
            $todb->oid = addslashes($item['#']['ID']['0']['#']);
            $todb->idnumber = addslashes($item['#']['IDNUMBER']['0']['#']);
            $todb->frameworkid = addslashes($item['#']['FRAMEWORKID']['0']['#']);
            $todb->shortname = addslashes($item['#']['SHORTNAME']['0']['#']);
            $todb->fullname = addslashes($item['#']['FULLNAME']['0']['#']);
            $todb->backup_unique_code = $backup_unique_code;
            $res = insert_record($tempitems, $todb);
        }
    } else {
        return false;
    }

    $sql = "SELECT b.oid, SUM(CASE WHEN b.idnumber=i.idnumber THEN 1 ELSE 0 END) AS idnumbermatch,
                SUM(CASE WHEN b.shortname = i.shortname THEN 1 ELSE 0 END) AS shortnamematch,
                SUM(CASE WHEN b.fullname = i.fullname THEN 1 ELSE 0 END) AS fullnamematch
                FROM {$CFG->prefix}$shorthname i, {$CFG->prefix}hbackup_temp_items b
                WHERE b.frameworkid=$fwid AND backup_unique_code=$backup_unique_code
                GROUP BY b.oid ORDER BY b.oid;";
    $matches = get_records_sql($sql);

    $total = $idnumbermatch = $shortnamematch = $fullnamematch = $unmatched = 0;
    foreach ($matches AS $match) {
        $total++;
        if($match->idnumbermatch == 1) {
            $idnumbermatch++;
            continue;
        }
        if($match->shortnamematch == 1) {
            $shortnamematch++;
            continue;
        }
        if ($match->fullnamematch == 1) {
            $fullnamematch++;
            continue;
        }
        $unmatched++;
    }
    return "Items: TOTAL $total | ID number: $idnumbermatch | SHORTNAME: $shortnamematch | FULLNAME: $fullnamematch | UNMATCHED: $unmatched<br />";

}



function create_temp_items_table($tname) {
    global $CFG;
    require_once("$CFG->libdir/ddllib.php");
    require_once("$CFG->libdir/xmldb/classes/XMLDBTable.class.php");

    $table = new XMLDBTable($tname);
    $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED,
                          XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
    $table->addFieldInfo('oid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED,
                          XMLDB_NOTNULL, null, null, null, null);
    $table->addFieldInfo('frameworkid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED,
                          XMLDB_NOTNULL, null, null, null, null);
    $table->addFieldInfo('idnumber', XMLDB_TYPE_CHAR, '100', null,
                         null, null, null, null, null);
    $table->addFieldInfo('shortname', XMLDB_TYPE_CHAR, '100', null,
                         XMLDB_NOTNULL, null, null, null, null);
    $table->addFieldInfo('fullname', XMLDB_TYPE_TEXT, 'medium', null,
                         XMLDB_NOTNULL, null, null, null, null);
    $table->addFieldInfo('backup_unique_code', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED,
                         XMLDB_NOTNULL, null, null, null, null);
    /// Adding keys
    $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
    if(table_exists($table)) {
        return true;
    }

    return create_table($table, true, false);

}



/**
 *
 * HELPER FUNCTIONS
 *
 * Extra functions for helping with restore process
 *
**/



/**
 * Updates the path of a row in the specified table
 * Must be called after the new row is inserted as current row ID is required
 *
 * @param string $path Path string to be updated
 * @param int $id ID of the table row to update with the new path
 * @param string $pathtable Table to use to get new ids for the path elements from
 * @param string $desttable Table to update the path in
 * @param int $backup_unique_code Backup code, used to find new path element ids
 * @return mixed The new path (with updated IDs) or false if update failed
**/
function update_path($path, $id, $pathtable, $desttable, $backup_unique_code) {
    $pathelements = explode('/', $path);
    $out = array();
    foreach($pathelements AS $element) {
        if(trim($element) == '') {
            $out[]='';
            continue;
        }
        $comp = backup_getid($backup_unique_code, $pathtable, $element);
        if($comp) {
            $out[] = $comp->new_id;
        } else {
            $out[] = $element;
        }
    }
    $newpath = implode('/', $out);
    $pathupdate = new object();
    $pathupdate->id = $id;
    $pathupdate->path = $newpath;
    if(update_record($desttable, $pathupdate)) {
        return $newpath;
    } else {
        return false;
    }
}

/*
 * Given an array of XMLized data representing a particular branch of the backup
 * file, and a list of fields to match, and a db table to match to, this function
 * returns an array detailing if branch members matched existing db entries
 * and which fields they matched on. The match can be further restricted with an
 * optional SQL WHERE fragment.
*/
function get_matches($xmlinfo, $matchfields, $tablename, $where=null) {
    global $CFG;
    $queries = array();
    if(!empty($where)) {
        $where = " WHERE $where ";
    } else {
        $where = '';
    }
    // first build a result table for each matchfield
    // do this way to avoid running one query per item
    foreach ($matchfields AS $matchfield) {
        $data = array();
        foreach ($xmlinfo AS $row) {
            $data[] =  '\''.$row['#'][strtoupper($matchfield)]['0']['#'].'\'';
        }
        // build the in statement
        $instr = implode(', ',$data);
        // run the query
        $sql  = "SELECT $matchfield,count(id) FROM {$CFG->prefix}$tablename
            $where
            GROUP BY $matchfield
            HAVING $matchfield IN ($instr)";
        $queries[$matchfield] = get_records_sql($sql);
    }

    // now rerun through each line of input data, and create output array
    // of IDs and fields that matched (false for no match)
    // TODO what if matchfields have quotes or other special chars that
    // can't be used as array keys?
    $out = array();
    foreach($xmlinfo AS $row) {
        $match = false;
        $id = $row['#']['ID']['0']['#'];
        foreach ($matchfields AS $matchfield) {
            $data = $row['#'][strtoupper($matchfield)]['0']['#'];
            if(isset($queries[$matchfield][$data]->count) && $queries[$matchfield][$data]->count == 1) {
                $match = $matchfield;
                break;
            }
        }
        $out[$id] = $match;

    }
    // returns an array, where keys are the ID from the backup file
    // and value is either:
    // - the name of the field that matched exactly once
    // - false if no fields matched
    return $out;

}

/**
 * Given a table and a sortorder ID, returns the sortorder to use for a new
 * record. This is either the next available ID or the current one if unused
 *
 * @param string $table Name of the database table to check, without moodle prefix
 * @param int $sortorder Current setting for this row from backup file
 * @return int New value for the specified row, taking into account existing
 *             values in db.
**/
function get_sortorder($table, $sortorder) {
    global $CFG;
    $matches = count_records($table, 'sortorder', $sortorder);
    if($matches) {
        $sql = "SELECT max(sortorder)+1 AS sortorder from {$CFG->prefix}$table";
        $res = get_record_sql($sql);
        return $res->sortorder;
    } else {
        return $sortorder;
    }
}



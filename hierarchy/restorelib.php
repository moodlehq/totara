<?php

/**
 * Get list of possible files to restore from hierarchy backup folder
 *
**/
function hierarchyrestore_get_backup_list($dir) {
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
 * Unpacks the zip file ready for restore and looks at contents
 * to determine restore options
 * TODO move second half (get_backup_contents) out of this function
**/
function hierarchyrestore_precheck($file, &$contents, &$errorstr) {
    global $CFG, $SESSION;

    //Prepend dataroot to variable to have the absolute path
    $file = $CFG->dataroot."/hierarchies/".$file;

    if (!defined('RESTORE_SILENTLY')) {
        //Start the main table
        echo "<table cellpadding=\"5\">";
        echo "<tr><td>";

        //Start the mail ul
        echo "<ul>";
    }

    //Check the file exists
    if (!is_file($file)) {
        if (!defined('RESTORE_SILENTLY')) {
            error ("File not exists ($file)");
        } else {
            $errorstr = "File not exists ($file)";
            return false;
        }
    }

    //Check the file name ends with .zip
    if (!substr($file,-4) == ".zip") {
        if (!defined('RESTORE_SILENTLY')) {
            error ("File has an incorrect extension");
        } else {
            $errorstr = 'File has an incorrect extension';
            return false;
        }
    }

    //Now calculate the unique_code for this restore
    $backup_unique_code = time();

    //Now check and create the backup dir (if it doesn't exist)
    if (!defined('RESTORE_SILENTLY')) {
        echo "<li>".get_string("creatingtemporarystructures").'</li>';
    }
    $status = check_and_create_backup_dir($backup_unique_code);
    //Empty dir
    if ($status) {
        $status = clear_backup_dir($backup_unique_code);
    }

    //Now delete old data and directories under dataroot/temp/backup
    if ($status) {
        if (!defined('RESTORE_SILENTLY')) {
            echo "<li>".get_string("deletingolddata").'</li>';
        }
        $status = backup_delete_old_data();
    }

    //Now copy he zip file to dataroot/temp/backup/backup_unique_code
    if ($status) {
        if (!defined('RESTORE_SILENTLY')) {
            echo "<li>".get_string("copyingzipfile").'</li>';
        }
        if (! $status = backup_copy_file($file,$CFG->dataroot."/temp/backup/".$backup_unique_code."/".basename($file))) {
            if (!defined('RESTORE_SILENTLY')) {
                notify("Error copying backup file. Invalid name or bad perms.");
            } else {
                $errorstr = "Error copying backup file. Invalid name or bad perms";
                return false;
            }
        }
    }

    //Now unzip the file
    if ($status) {
        if (!defined('RESTORE_SILENTLY')) {
            echo "<li>".get_string("unzippingbackup").'</li>';
        }
        if (! $status = restore_unzip ($CFG->dataroot."/temp/backup/".$backup_unique_code."/".basename($file))) {
            if (!defined('RESTORE_SILENTLY')) {
                notify("Error unzipping backup file. Invalid zip file.");
            } else {
                $errorstr = "Error unzipping backup file. Invalid zip file.";
                return false;
            }
        }
    }

    //Now check for the moodle.xml file
    if ($status) {
        $xml_file  = $CFG->dataroot."/temp/backup/".$backup_unique_code."/moodle.xml";
        if (!defined('RESTORE_SILENTLY')) {
            echo "<li>".get_string("checkingbackup").'</li>';
        }
        if (! $status = restore_check_moodle_file ($xml_file)) {
            if (!is_file($xml_file)) {
                $errorstr = 'Error checking backup file. moodle.xml not found at root level of zip file.';
            } else {
                $errorstr = 'Error checking backup file. moodle.xml is incorrect or corrupted.';
            }
            if (!defined('RESTORE_SILENTLY')) {
                notify($errorstr);
            } else {
                return false;
            }
        }
    }

    $info = "";

    //Now read the whole xml file into a big array
    if ($status) {
        if (!defined('RESTORE_SILENTLY')) {
            echo "<li>".get_string("readinginfofrombackup").'</li>';
        }
        //Reading info from file
        $xml = file_get_contents($xml_file);
        $info = xmlize($xml);

   }

    if (!defined('RESTORE_SILENTLY')) {
        //End the main ul
        echo "</ul>\n";

        //End the main table
        echo "</td></tr>";
        echo "</table>";
    }

    /*
    // debugging xml array
    traverse_xmlize($info); 
    print_object($GLOBALS['traverse_array']);
    $GLOBALS['traverse_array'] ='';
     */

    // Now we have the backup as an array, look through for content
    // to determine how to display the form
    $contents = get_backup_contents($info, $backup_unique_code, $errorstr);
    if($contents === false) {
        return false;
    }

    if (!$status) {
        if (!defined('RESTORE_SILENTLY')) {
            error ("An error has ocurred");
        } else {
            $errorstr = "An error has occured"; // helpful! :P
            return false;
        }
    }
    return true;
}

/*
 * Recursive version of array_key_exists() used to search XMLize data
 * for particular tags
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
    // check if backup includes user data
    if(isset($info['MOODLE_BACKUP']['#']['USERS']['0']['#']['USER'])) {
        $users = $info['MOODLE_BACKUP']['#']['USERS']['0']['#']['USER'];
        $contents->options->usercount = count($users);
    }
    else {
        $contents->options->usercount = 0;
    }

    $contents->backup_unique_code = $backup_unique_code;

    // loop through XML and create array of hierarchies, frameworks and item counts
    // to be used to build the selection form
    foreach($hierarchies as $hierarchy) {
        $name = $hierarchy['#']['NAME']['0']['#'];
        $contents->$name = new object();
        if(isset($hierarchy['#']['FRAMEWORKS']['0']['#']['FRAMEWORK'])) {
            $frameworks = $hierarchy['#']['FRAMEWORKS']['0']['#']['FRAMEWORK'];
            $contents->$name->frameworks = array();
            foreach($frameworks AS $framework) {
                $fullname = $framework['#']['FULLNAME']['0']['#'];
                $id = $framework['#']['ID']['0']['#'];
                $contents->$name->frameworks[$id] = new object();
                $contents->$name->frameworks[$id]->fullname = $fullname;
                $itemnameplural = strtoupper(get_string($name.'plural',$name));
                $itemname = strtoupper(get_string($name, $name));
                if(isset($framework['#'][$itemnameplural]['0']['#'][$itemname])) {
                    $items = $framework['#'][$itemnameplural]['0']['#'][$itemname];
                    $contents->$name->frameworks[$id]->itemcount = count($items);
                } else {
                    $contents->$name->frameworks[$id]->itemcount = 0;
                }

            }
        }

        // check to see if backup contains optional tags for this hierarchy
        $hbackupfile = "$CFG->dirroot/hierarchy/type/$name/backuplib.php";
        $optionsfunc = $name.'_options';
        if(file_exists($hbackupfile)) {
            include_once($hbackupfile);
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
    }

    return $contents;
}


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
    if(isset($info['MOODLE_BACKUP']['#']['USERS']['0']['#']['USER'])) {
        $users = $info['MOODLE_BACKUP']['#']['USERS']['0']['#']['USER'];
        foreach($users as $user) {
            $todb = new object();
            $todb->oid = $user['#']['ID']['0']['#'];
            $todb->username = $user['#']['USERNAME']['0']['#'];
            $todb->email = $user['#']['EMAIL']['0']['#'];
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
                FROM mdl_user u, mdl_hbackup_temp_user b
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
    $itemplural = strtoupper(get_string($hname.'plural',$hname));
    $itemsingle = strtoupper(get_string($hname, $hname));

    // write items from XML file to temporary table
    if (isset($frameworkinfo['#'][$itemplural]['0']['#'][$itemsingle])) {
        $items = $frameworkinfo['#'][$itemplural]['0']['#'][$itemsingle];
        //print_object($items);
        foreach ($items AS $item) {
            $todb = new object();
            $todb->oid = $item['#']['ID']['0']['#'];
            $todb->idnumber = $item['#']['IDNUMBER']['0']['#'];
            $todb->frameworkid = $item['#']['FRAMEWORKID']['0']['#'];
            $todb->shortname = $item['#']['SHORTNAME']['0']['#'];
            $todb->fullname = $item['#']['FULLNAME']['0']['#'];
            $todb->backup_unique_code = $backup_unique_code;
            $res = insert_record($tempitems, $todb);
        }
    } else {
        return false;
    }

    $sql = "SELECT b.oid, SUM(CASE WHEN b.idnumber=i.idnumber THEN 1 ELSE 0 END) AS idnumbermatch,
                SUM(CASE WHEN b.shortname = i.shortname THEN 1 ELSE 0 END) AS shortnamematch,
                SUM(CASE WHEN b.fullname = i.fullname THEN 1 ELSE 0 END) AS fullnamematch 
                FROM mdl_$hname i, mdl_hbackup_temp_items b
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



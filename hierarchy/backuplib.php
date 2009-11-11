<?php

/**
 * Functions required for hierarchy backup and restore functionality
 *
**/


/**
 * Return array of hierarchy names to be backed up based on existence of the
 * required files and functions
 *
 * @return array Array of hierarchy prefixes that can be backed up
 **/
//TODO remove include() from this function and do seperately when called??
function get_backup_list() {
    global $CFG;

    // get list of hierarchies from directories in hierarchy/type/
    $typedir = "$CFG->dirroot/hierarchy/type";
    $hierarchies = array();
    $dir = opendir($typedir);
    while (false !== ($file = readdir($dir))) {
        if ($file == "." || $file == ".." || !is_dir($typedir."/".$file)) {
            continue;
        }
        $hierarchies[] = $file;
    }

    if(!is_array($hierarchies) || count($hierarchies) < 1) {
        return false;
    }

    // exclude hierarchy directories without a backuplib.php
    $hlist = array();
    foreach($hierarchies AS $hname) {
        $hbackupfile = "$CFG->dirroot/hierarchy/type/$hname/backuplib.php";
        $hbackup = $hname."_backup";

        if(file_exists($hbackupfile)) {
            include_once($hbackupfile);
            if(function_exists($hbackup)) {
                $hlist[] = $hname;
            }
        }
    }
    return $hlist;

}

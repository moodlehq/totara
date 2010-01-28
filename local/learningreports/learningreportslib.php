<?php

// returns an associative array to be used as an options list
// of the directories within a learningreports subdirectory
function learningreports_get_options_from_dir($source) {
    global $CFG;

    $ret = array();
    $dir = "{$CFG->dirroot}/local/learningreports/$source/";
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if(filetype($dir.$file)!='dir' || // exclude non-directories
                    $file=='.' || $file=='..' || // exclude current and parent
                    $file=='shared') { // exclude shared as this may be used in future for shared code
                    continue;
                }
                $desc = ucwords(str_replace(array('-','_'),' ',$file));
                $ret[$file] = $desc;
            }
            closedir($dh);
        }
    }
    return $ret;
}




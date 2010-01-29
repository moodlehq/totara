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

// get a particular type of data from the specified source
function get_source_data($source, $datatype) {
    global $CFG;
    $file = "{$CFG->dirroot}/local/learningreports/sources/$source/$datatype.php";
    if(file_exists($file)) {
        include($file);
    }
    if(isset($$datatype)) {
        return $$datatype;
    } else {
        return null;
    }
}

function get_filters_select($source) {
    $filters = get_source_data($source,'queryoptions');
    $ret = array();
    foreach($filters as $filter) {
            $key = "{$filter['type']}-{$filter['value']}";
            $text = $filter['name'];
            $ret[$key] = $text;
    }
    return $ret;
}

// parses the column options data structure to return an array suitable
// for use as a select pulldown
function get_columns_select($source) {
    $columns = get_source_data($source,'columnoptions');
    $ret = array();
    foreach($columns as $type => $info) {
        foreach ($info as $value => $info2) {
            $key = "{$type}-{$value}";
            $text = $info2['name'];
            $ret[$key] = $text;
        }
    }
    return $ret;
}


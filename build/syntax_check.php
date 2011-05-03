<?php

/**
 * Script to check the code for miscellaneous bad syntax
 *
 * Currently just looks for use of static method calls on
 * dynamic classes (allowed in PHP5.3 but not 5.2)
 */
scan_directory();

function scan_directory($start_dir='.') {
    $files = array();
    if (is_dir($start_dir)) {
        $fh = opendir($start_dir);
        while (($file = readdir($fh)) !== false) {
            # loop through the files, skipping . and .., and recursing if necessary
            if (strcmp($file, '.')==0 || strcmp($file, '..')==0 || strcmp($file, '.git')==0){
                continue;
            }
            $filepath = $start_dir . '/' . $file;
            if ( is_dir($filepath) ){
                scan_directory($filepath);
            } else {
                scan_file($filepath);
            }
        }
        closedir($fh);
    }
}

function scan_file($filepath){

    // Scan file for lang strings
    $file = fopen($filepath, 'r');
    $line_number = 0;
    while ( !feof($file) ){
        $line = fgets($file);
        $line_number++;
        if (preg_match('|^(.*)//.*$|', $line, $matches)) {
            // remove comment part of lines
            $line = $matches[1];
        }
        if (preg_match('|^\s*\*|', $line)) {
            // probably a multi-line comment, skip
            continue;
        }
        $matches = array();
        if (preg_match(
            // match $var::method(
            '/(\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*::[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]* *\()/',
            $line,
            $matches
        )) {
            print "ERROR: static method called on dynamic class:\n";
            print '    '.trim($line)."\n";
            print "File '$filepath', line $line_number\n\n";
        }

        // don't check for mdl_ in:
        // - the build/ directory
        // - the blocks/search directory (as this block uses mdl_
        //   in the index names and it's too hard to exclude)
        if (preg_match('|blocks/search|', $filepath) ||
           preg_match('|build/|', $filepath)) {
            continue;
        }

        // search for hard-coded mdl_[something]
        // ignore references to $mdl_[something]
        if (preg_match('/[^$]mdl_[a-zA-Z]/',
            $line,
            $matches
        )) {
            print "ERROR: hard-coded reference to 'mdl_':\n";
            print '    '.trim($line)."\n";
            print "File '$filepath', line $line_number\n\n";
        }

    }
}


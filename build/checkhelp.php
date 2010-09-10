#!/usr/bin/php
<?php

// see checklang for syntax
$exclude = array(
    // doesn't like help files in subdirectories because of
    // clash with module regexp
    'hierarchy/type/competency/scale/edit_form.php' => array(
        'competency/scale/scalename', 'competency/scale/scalevalues'
    ),
);

if ( $argc > 1 ){

	if ( $argv[1] == '--help' || $argv[1] == '-h' ){
		echo "\ncheckhelp.php [moodlerootdir [dir1 dir2 dir3]]\n\n";
		echo "Will scan the specified subdirectories of the moodle instance at 'moodlerootdir'.\n";
		echo "If subdirectories are left off, scans entirety of 'moodlerootdir'. If no arguments\n";
		echo "provided, scans the current directory as if it were a Moodle root directory.\n\n";
	}

	$scandirs = array();
    $rootdir = rtrim($argv[1], '/');
    chdir($rootdir);
	if ( $argc > 2 ){
		foreach( array_slice($argv, 2) as $arg ){
			$scandirs[] = trim($arg, '/');
		}
	} else {
		$scandirs[] = $rootdir;
	}
} else {
	$scandirs = array('.');
}

// get array of existing help files
$validhelpfiles = array();
find_help_files('.', $validhelpfiles);

$langs = array('en_utf8');
foreach( $scandirs as $dir ){
    scan_directory($dir, $langs);
}

/**
 * Based on the listdir function from http://www.php.net/manual/en/function.readdir.php#75156
 */
function scan_directory($start_dir='.', $langs) {
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
				scan_directory($filepath, $langs);
			} else {
				scan_file($filepath, $langs);
			}
		}
		closedir($fh);
	}
}

function scan_file($filepath, $langs){
    global $exclude;
    global $validhelpfiles;

    $excludevalues = array();
    foreach($exclude as $key => $value){
        if((substr($filepath,0,strlen($key))==$key)) {
            if($value=='*') {
                return;
            }
            if(!is_array($value)) {
                $excludevalues[] = $value;
            } else {
                foreach($value as $item) {
                    $excludevalues[] = $item;
                }
            }

        }
    }

	// Scan file for module and block locations
	if ( !($file = fopen($filepath, 'r')) ){
		return;
	}

	// Scan file for lang strings
    $file = fopen($filepath, 'r');
	while ( !feof($file) ){
		$line = fgets($file);
		$matches = array();
        // only match the first argument then see if any help file exists
        // doesn't check that the help file is the one referenced because
        // it's too hard to parse
		preg_match_all(
			'/setHelpButton\s*\(\s*[^,]*\s*,\s*array\s*\(([^,]*),/mi',
			$line,
			$matches,
			PREG_SET_ORDER
        );

        foreach($matches as $match) {
			$filename = preg_replace('/^\\s*(["\'])(.*)(\\1)\\s*$/','\\2',$match[1]);
            // skip excluded matches and
			// Bale if PHP variables, brackets, or concatenation used.
			// too hard!
            if( preg_match( '/[$().]/', $filename ) || preg_match ( '/\\$/', $filename ) || in_array($filename, $excludevalues) || $filename == 'false') {
                continue;
            }
            foreach($langs as $lang) {
                $found = false;
                foreach($validhelpfiles[$lang] as $mods) {
                    if(in_array($filename, $mods)) {
                        $found = true;
                    }
                }
                if(!$found) {
                    print "Help file '$filename' not found from reference in $filepath\n";
                }
            }
        }

    }
}

/*
 * Recurse through tree finding help files
 *
 * Returns them as a multi-dimensional array containing:
 * - language
 * - module
 * - file name reference
 */
function find_help_files($dir, &$out) {
    $lang = 'en_utf8';
	if (is_dir($dir)) {
		$fh = opendir($dir);
		while (($file = readdir($fh)) !== false) {
			# loop through the files, skipping . and .., and recursing if necessary
			if (strcmp($file, '.')==0 || strcmp($file, '..')==0){
				continue;
			}
			$filepath = $dir . '/' . $file;
			if ( is_dir($filepath) ){
                find_help_files($filepath, $out);
			} else {
                if (preg_match('|local/([^/]+)/lang/([^/]+)/help/([^.]+)\.html|', $filepath, $matches)) {
                    $mod = $matches[1];
                    $lang = $matches[2];
                    $file = $matches[3];
                    $out[$lang][$mod][] = $file;
                } else if(preg_match('|mod/([^/]+)/lang/([^/]+)/help/\\1/([^.]+)\.html|', $filepath, $matches)) {
                    $mod = $matches[1];
                    $lang = $matches[2];
                    $file = $matches[3];
                    $out[$lang][$mod][] = $file;
                } else if(preg_match('|lang/([^/]+)/help/([^/]+)/([^.]+)\.html|', $filepath, $matches)) {
                    $lang = $matches[1];
                    $mod = $matches[2];
                    $file = $matches[3];
                    $out[$lang][$mod][] = $file;
                } else if(preg_match('|lang/([^/]+)/help/([^.]+)\.html|', $filepath, $matches)) {
                    $lang = $matches[1];
                    $mod = 'moodle';
                    $file = $matches[2];
                    $out[$lang][$mod][] = $file;
                }
			}
		}
		closedir($fh);
	}
}

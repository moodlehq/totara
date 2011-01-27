#!/usr/bin/php
<?php
require_once(dirname(dirname(__FILE__)).'/config.php');

// Check for missing lang strings by parsing the code for calls to get_string,
// then executing and searching for missing strings

// @todo check that it can still be called from any directory now that we
// use config.php
if ( $argc > 1 ){

	if ( $argv[1] == '--help' || $argv[1] == '-h' ){
		echo "\nlangscan.php [moodlerootdir [dir1 dir2 dir3]]\n\n";
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

	// Scan file for lang strings
    $file = fopen($filepath, 'r');
    $line_number = 0;
	while ( !feof($file) ){
		$line = fgets($file);
        $line_number++;
		$matches = array();
		preg_match_all(
			'/(get|print)_string\\s*\\(\\s*([^,\\)]+)(\\s*,\\s*([^,\\)]*))?(\\s*,\\s*([^,\\)]*))?\\s*\\)/m',
			$line,
			$matches,
			PREG_SET_ORDER
		);


		foreach( $matches as $match ){
			$str = preg_replace('/^\\s*(["\'])(.*)(\\1)\\s*$/','\\2',$match[2]);
            if (isset($match[4])){
                $loc = preg_replace('/^\\s*(["\'])(.*)(\\1)\\s*$/','\\2',$match[4]);
            }
            else{
                $loc = '';
            }

			// Bale if PHP variables, brackets, or concatenation used.
			// too hard!
			if ( preg_match( '/[$().]/', $str ) || preg_match ( '/\\$/', $loc )) {
				continue;
			}

            // run getstring and check output
            // hide errors to avoid warnings as we're not passing an object
            // as a third argument
            $result = @get_string($str, $loc);
            if(preg_match('/^\\[\\[([^]]+)\\]\\]$/', $result, $match2)) {
                // returned string contains [[ and ]]
                // probably a bad lang string
                print 'Missing lang string: "' . $str . '" in file "' . $loc . '" called from file "' . $filepath . '" on line ' . $line_number . "\n";
            }
		}
	}
}
?>


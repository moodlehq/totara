#!/usr/bin/php
<?php
// PHP version of Simon's missing lang string ruby script

//Array of what to exclude from the search
$exclude = array(
    'idp' => array('delfavouritebutton','additionalobjectives'),
    'local/libs' => '*',
    'local/reportbuilder/groups.php' => 'type',
);


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
    global $exclude;

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
	$modfiles = array();
	$langfiles = array();

    // Check modules and blocks for local help files
    $modfiles = array();
    if ( preg_match( '/mod\\/([^\\/]*)\\//', $filepath, $modmatch )){
        $mod = trim($modmatch[1]);
        foreach( $langs as $lang ){
            $modfiles[] = "./mod/{$mod}/lang/{$lang}/{$mod}.php";
        }
    }
    $blockfiles = array();
    if ( preg_match( '/blocks\\/([^\\/]*)\\//', $filepath, $blockmatch )){
        $block = trim($blockmatch[1]);
        foreach( $langs as $lang ){
            $blockfiles[] = "./blocks/{$block}/lang/{$lang}/block_{$block}.php";
            $blockfiles[] = "./mod/{$block}/lang/{$lang}/{$block}.php";
        }
    }

    $localfiles = array();
    if ( preg_match( '/local\\/([^\\/]*)\\//', $filepath, $localmatch )){
        $localmod = trim($localmatch[1]);
        foreach( $langs as $lang ){
            $localfiles[] = "./local/{$localmod}/lang/{$lang}/local_{$localmod}.php";
        }
    }

	// Scan file for lang strings
    $file = fopen($filepath, 'r');
	while ( !feof($file) ){
		$line = fgets($file);
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
			if ( preg_match( '/[$().]/', $str ) || preg_match ( '/\\$/', $loc ) || in_array($str,$excludevalues)) {
				continue;
			}

			$found = false;
			foreach( $langs as $lang ){
                $langfiles = array_merge_recursive($modfiles, $blockfiles, $localfiles);
				if ( $loc != '' ){
					// default location
                    $langfiles[] = "./lang/{$lang}/{$loc}.php";
				} else {
					// try some possible files if nothing set
					$langfiles[] = "./lang/{$lang}/moodle.php";
					$langfiles[] = "./lang/{$lang}/langconfig.php";
					$langfiles[] = "./lang/{$lang}/admin.php";
					$langfiles[] = "./lang/{$lang}/install.php";
				}
				
				foreach( $langfiles as $langfile ){
					// Look for reference to string in lang file
                    if ( file_exists($langfile) ){

                        foreach( file($langfile) as $line ){

							// Escape loop if a match is found
							//echo "re: ".'/\\$string\\s*\\[\\s*([\\\'"])' . preg_quote($str) . '\\1\\s*\\]/'."\n";
							if ( preg_match( '/\\$string\\s*\\[\\s*([\\\'"])' . str_replace( '/', '\\/', preg_quote($str)) . '\\1\\s*\\]/', $line )){
								$found = true;
								continue 3;
							}
						}
					}
				}
			}
			if ( !$found ){
				echo "String '{$str}' missing from langfile referenced in '{$filepath}'\n";
			}
		}
	}
}
?>


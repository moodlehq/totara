<?php

/**
 * Recursively check all PHP files for syntax errors
 *
 * Scans the current work directory, and outputs errors
 * in a way that is both machine and human readable
 *
 * @copyright Totara Learning Solutions Limited
 * @author Aaron Barnes <aaronb@catalyst.net.nz>
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage testframework
 */


// Keep intruders OUT!!!
if (!empty($_SERVER['GATEWAY_INTERFACE'])){
    error_log("lint-checker should not be called from apache!");
    echo 'This script is not accessible from the webserver';
    exit;
}

// Total file checked
$count  = 0;

// Total number of errors found
$errors = 0;

// Extensions to check
$check = array('php', 'html');

// Scan path
$path = $_SERVER['PWD']; // Current working directory

// Scan files
scan_directory($path);

echo "\n$count files checked, $errors errors.";


/**
 * Recursively called function for checking all files in a
 * directory
 *
 * @param   string  $path   Directory to scan
 * @return  void
 */
function scan_directory($path) {

	$contents = scandir($path);
	foreach($contents as $content) {
		if ($content == '.' || $content == '..') {
			continue;
		}

		$filepath = "$path/$content";

		// Recurse into directories
		if (is_dir($filepath)) {
			scan_directory($filepath);
		}
		elseif (is_file($filepath) && is_readable($filepath)) {
			check_file($filepath);
		}
	}
}


/**
 * Php lint check a file and print any errors found
 *
 * @param   string  $path   File to scan
 * @return  void
 */
function check_file($path) {
	global $check, $errors, $count;

    // Skip non-php files
    $phpfile = false;

    foreach ($check as $ext) {
        $ext = '.'.$ext;

        if (substr($path, 0 - strlen($ext)) == $ext) {
            $phpfile = true;
            break;
        }
    }

    if (!$phpfile) {
        return;
    }

    // Check file
    $error = exec(
        'php -l "'.$path.'"',
        $output,
        $return_var
    );

	if ($return_var) {
		++$errors;
        echo "[SYNTAX ERROR] {$path}\n";
        echo "{$output[1]}\n\n";
	}

	++$count;
}

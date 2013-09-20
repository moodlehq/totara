<?php
define('CLI_SCRIPT', true);
//setup moodle constants etc
require_once(dirname(dirname(__FILE__)).'/config.php');
require_once($CFG->libdir.'/clilib.php');

list($options, $unrecognized) = cli_get_params(array('filepath' => '', 'remote' => '', 'branch' => ''));

$filepath = clean_param($options['filepath'], PARAM_TEXT);
$remote = clean_param($options['remote'], PARAM_ALPHANUM);
$branch = clean_param($options['branch'], PARAM_TEXT);

if (empty($filepath) || empty($remote) || empty($branch)) {
    echo "ERROR: version_check has received empty parameters";
    die();
}

if (!preg_match('/t[0-9]-release-[0-9]\.[0-9]$/', $branch)) {
    echo "INFO: '{$branch}' is not a stable release branch. Skipping checks.\n";
    die;
}

echo "Checking version file {$filepath}\n";

// Dummy some Moodle objects
$plugin = new stdClass();
$module = new stdClass();

// Get all release branches on specified remote.
$gitresult = array();
$branches = array();
exec("git ls-remote --heads $remote", $gitresult);
foreach ($gitresult as $result) {
    if (preg_match('/(t([0-9])-release-([0-9]\.[0-9]))$/', $result, $matches)) {
        $branches[$matches[1]] = $matches[3];
    }
}

// Sort oldest to newest.
asort($branches);
end($branches);
$latestbranch = key($branches);
reset($branches);

// Check the branch passed in url is known.
if (!isset($branches[$branch])) {
    echo "ERROR: Invalid remote branch '{$branch}' passed to version_check - known branches in remote '{$remote}':\n" . implode("\n", array_flip($branches)) . "\n";
    die();
}

// Some version.php do not actually set a plugin/module component, have a list here of known ones to skip tests on them
$badversions = array('search/version.php',
'question/type/randomsamatch/version.php',
'admin/report/unittest/version.php',
'admin/report/courseoverview/version.php',
'admin/report/security/version.php',
'mod/scorm/report/basic/version.php'
);

//get the Totara version this patch is for (should be a bumped version number)
require_once($CFG->dirroot . '/version.php');
if (!isset($TOTARA)) {
    //some sort of problem
    echo "ERROR: cannot determine site branch version number\n";
}

// Check the TOTARA build variable
if (!isset($TOTARA->build)) {
    echo "ERROR: TOTARA->build not set in version.php\n";
} else {
    //build should be of the format yyyymmdd.xx
    $bld = $TOTARA->build;
    $blddate = substr($bld, 0, 8);
    $bldbump = substr($bld, 9, 2);
    if (strlen($bld) != 11 || substr($bld, 8, 1) !== "."
       || !ctype_digit($blddate) || !ctype_digit($bldbump)) {
            echo "ERROR: TOTARA->build {$bld} incorrect format in version.php\n";
    }
    test_date_format("TOTARA->build", $blddate . $bldbump);
}
// Check the TOTARA version variable
if (!isset($TOTARA->version)) {
    echo "ERROR: TOTARA->version not set in version.php\n";
} else {
    //Warn if version does not have a bump
    if (strpos($TOTARA->version, '+') === false) {
        echo "WARNING: TOTARA->version is not bumped!\n";
    }
    if (!(version_compare($TOTARA->version, "2.4.0", ">=") && version_compare("2.5.0", $TOTARA->version, ">"))) {
        echo "ERROR: TOTARA->version is for a different branch!\n";
    }
}

if ($filepath == 'version.php') {
    // Do not continue with rest of tests
    die();
}

// Strip out '+', 'a', 'b', etc. leaving just numbers and dots.
$tversion = preg_replace('/[^0-9\.]/', '', $TOTARA->version);

//get the version in this patch
$file_array = file($CFG->dirroot . '/' . $filepath);
$versiondata = get_version_number_from_file_array($file_array);
if ($versiondata === false) {
    // Check if it is a known $badversion
    if (in_array($filepath, $badversions)) {
        //We know this is a bad one
        echo "WARNING: {$filepath} is a known file that does not properly set a plugin component\n";
    } else {
        echo "WARNING: no patch plugin version number found in $filepath\n";
    }
    echo "INFO: plugin info missing, skipping rest of tests\n";
    die();
}
$component = $versiondata['component'];
$thisversion = $versiondata['version'];

//get the plugin version in the preceeding release codebase
//e.g. if tversion is 2.4.2+ then the last release was 2.4.2 and this patch is planned for 2.4.3
$gitresult = array();
exec("git show totara-$tversion:$filepath", $gitresult);
if (empty($gitresult)){
    die("WARNING: no release plugin version number found in totara-$tversion:$filepath\n");
}
$versiondata = get_version_number_from_file_array($gitresult);
if ($versiondata === false) {
    echo "WARNING: no release plugin version number found in totara-$tversion:$filepath\n";
    die();
}
$releaseversion = $versiondata['version'];

//now the actual tests!

// TEST 1. make sure the new version number is yyyymmddxx format
test_date_format($component, $thisversion);

// TEST 2. make sure the number is actually incrementing from the existing version
if ($thisversion < $releaseversion) {
    echo "ERROR: $component version $thisversion is LOWER then the version in the $tversion release ($releaseversion)\n";
}

// TEST 3. if on an old branch, make sure it is a minor bump
if ($branch != $latestbranch && ($thisversion-$releaseversion) > 99) {
    //we have sometimes in the past had multiple patches all bumping the version on the same component during a release cycle
    echo "ERROR: Major version bump on old branch! $component version $thisversion\n";
}

// TEST 4. check number across all branches that it increments properly
$lastnumber = 0; $lastbranch = '';
foreach ($branches as $branch => $series) {
    $gitresult = array();
    $gitreturn = "";

    exec("git show {$remote}/{$branch}:{$filepath} 2>&1", $gitresult);
    if (empty($gitresult) || strpos($gitresult[0], "fatal: Path '{$filepath}' exists on disk, but not in '{$remote}/{$branch}'.") !== false) {
        //plugin may not exist in this branch, not necessarily an error
        echo "INFO: {$remote}/{$branch}:{$filepath} does not exist!\n";
        $lastbranch = $branch;
        continue;
    }

    $versiondata = get_version_number_from_file_array($gitresult);
    if ($versiondata === false) {
        echo "WARNING: no branch plugin version number found in $branch:$filepath\n";
        die();
    }
    $component = $versiondata['component'];
    $branchversion = $versiondata['version'];

    //if we have something to compare, compare the branch version AND this patch version
    //make sure thisversion is greater than branchversion and both are higher than lastbranch version
    if (!empty($lastbranch) && !empty($lastnumber) && (
            intval($branchversion) > intval($thisversion) ||
            intval($lastnumber) > intval($branchversion)
                                                      )) {
        echo "ERROR: $branch DOWNGRADES version number on $component ($branchversion) from $lastbranch ($lastnumber)\n";
    }
    $lastnumber = $branchversion;
    $lastbranch = $branch;
}

/**
 * Given the contents of a version.php file as an array (one line per element),
 * returns the component and version number (as an array), or false if none found.
 */
function get_version_number_from_file_array($file_array) {
    $version_str = '';
    foreach ($file_array as $line) {
        // Skip the PHP tags since we're going to eval this.
        if (strpos($line, '<?php') !== false) {
            continue;
        }
        $version_str .= $line . "\n";
    }
    eval($version_str);

    if (isset($plugin->component)) {
        return array('component' => $plugin->component, 'version' => $plugin->version);
    } else if (isset($module->component)) {
        return array('component' => $module->component, 'version' => $module->version);
    } else {
        return false;
    }
}

/**
 * Test version is yyyymmddxx format - can always run this test even if plugin info is missing.
 *
 * Errors are output to the screen.
 */
function test_date_format($component, $thisversion) {

    if (strlen($thisversion) != 10) {
        echo "ERROR: $component version number $thisversion is not in yyyymmddxx format\n";
    }
    $year = substr($thisversion, 0, 4);
    $thisyear = intval(date('Y'));
    //year could theoretically be anywhere from 1999 to the present
    if ($year > $thisyear || $year < 1999) {
        echo "ERROR: $component version $thisversion - year $year is incorrect\n";
    }
    $month = substr($thisversion, 4, 2);
    if ($month < 1 || $month > 12) {
        echo "ERROR: $component version $thisversion - month $month is incorrect\n";
    }
    $day = substr($thisversion, 6, 2);
    if ($day < 1 || $day > 31) {
        echo "ERROR: $component version $thisversion - day $day is incorrect\n";
    }
    //after sanity checking the individual numbers, finally run through checkdate()
    if (!checkdate($month, $day, $year)) {
        echo "ERROR: $component version $thisversion - {$year}{$month}{$day} is not a valid date\n";
    }
    $bump = substr($thisversion, 8, 2);
    if ($bump < 0 || $bump > 99) {
        echo "ERROR: $component version $thisversion - bump $bump is incorrect\n";
    }
}
?>

<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * CLI simpletest unittests execution
 *
 * This script executes all the (simpletest) tests available in all the
 * Moodle code base, reporting results in different formats. Useful for
 * quick runs or integration into any ci tool able to process Junit
 * XML result files
 *
 * TODO: Some day, add support for clover files and code coverage (not for now)
 * TODO: Some day, decide to move to PHPUnit
 *
 * @package    core
 * @subpackage ci
 * @copyright  2011 Eloy Lafuente (http://stronk7.com)
 * @author     Aaron Barnes <aaron.barnes@hbcosmo.com> (Totara modifications)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('CLI_SCRIPT', true);
define('NO_OUTPUT_BUFFERING', true);

require(dirname(dirname(__FILE__)).'/config.php');
require_once($CFG->libdir.'/clilib.php');      // cli only functions
require_once($CFG->libdir.'/cronlib.php');
require_once($CFG->libdir.'/adminlib.php');

require_once($CFG->dirroot.'/'.$CFG->admin.'/tool/unittest/simpletestcoveragelib.php');
require_once($CFG->dirroot.'/'.$CFG->admin.'/tool/unittest/ex_simple_test.php');
require_once($CFG->dirroot.'/'.$CFG->admin.'/tool/unittest/ex_reporter.php');
require_once($CFG->dirroot.'/build/simpletests_lib.php');

// now get cli options
list($options, $unrecognized) = cli_get_params(array(
                                                   'help'   => false,
                                                   'format' => 'txt',
                                                   'path'   => ''),
                                               array(
                                                   'h' => 'help',
                                                   'f' => 'format',
                                                   'p' => 'path'));

if ($unrecognized) {
    $unrecognized = implode("\n  ", $unrecognized);
    cli_error(get_string('cliunknowoption', 'admin', $unrecognized));
}

if ($options['help']) {
    $help =
"Execute available simpletest unit tests, generating information in different formats

Options:
-h, --help            Print out this help
-f, --format          Select the output format (txt, html, xml, xunit), defaults to txt
-p, --path            Restrict tests to the ones available under path, defaults to all

Example:
\$sudo -u www-data /usr/bin/php admin/cli/citests.php --format=txt --path=lib/simpletest
";

    echo $help;
    exit(0);
}

$format = $options['format'];
$path = $options['path'];

raise_memory_limit(MEMORY_EXTRA);

// Global for own storage / informing codebase
global $UNITTEST;
$UNITTEST = new stdClass();

$CFG->unittestprefix='t_'; // Need this to run all them

// This limit is the time allowed per individual test function. Please do not
// increase this value. If you get a PHP time limit when running unit tests,
// find the unit test which is running slowly, and either make it faster,
// split it into multiple tests, or call set_time_limit within that test.
define('TIME_ALLOWED_PER_UNIT_TEST', 60);

// Create the group of tests.
$test = new cli_group_test(false, 'Moodle simpletest Unit Tests');

// Pick a format (simpletest reporter)
if ($format == 'txt') {
    $reporter = new cli_text_reporter(false);
} else if ($format == 'html') {
    $reporter = new cli_html_reporter(false);
} else if ($format == 'xml') {
    $reporter = new cli_xml_reporter(false);
} else if ($format == 'xunit') {
    $reporter = new cli_xunit_reporter(false);
} else {
    cli_error("Incorrect format specified: $format");
}

// Work out what to test.
if (substr($path, 0, 1) == '/') {
    $path = substr($path, 1);
}
$path = $CFG->dirroot . '/' . $path;
if (substr($path, -1) == '/') {
    $path = substr($path, 0, -1);
}
if (is_file($path)) {
    $test->addTestFile($path);
} else if (is_dir($path)){
    $test->findTestFiles($path);
} else {
    cli_error("Incorrect path specified: $path");
}

// Prepare various stuff
cron_setup_user(); // Nasty hack to set current user

$SCRIPT='admin/tool/unittest/index.php'; // Need to hack this to pass all

$source = $CFG->dirroot.'/lib/timezone.txt'; // Load timezones
if (is_readable($source)) {
    if ($timezones = get_records_csv($source, 'timezone')) {
        update_timezone_records($timezones);
    }
}

// And run the tests
if ($format == 'xunit') {
    // Capture and transform the xml format to xunit one
    ob_start();
    $test->run($reporter);
    $xmlcontents = ob_get_contents();
    ob_end_clean();
    // We need to clean the information in some passes. Not valid UTF-8
    $xmlcontents = iconv('UTF-8', 'UTF-8//IGNORE', $xmlcontents);
    // And also some horrible control chars
    $xmlcontents = preg_replace('/[\x-\x8\xb-\xc\xe-\x1f\x7f]/is','', $xmlcontents);
    // Finally, clean absolute paths
    $xmlcontents = preg_replace("!{$CFG->dirroot}!", '', $xmlcontents);
    // One more thing, clean here, by hand, the horrible mess
    // caused @ test_get_field() by the capture of display_errors,
    // Moodle's inabilitites to proper handling logs and Simpletest
    // straight-to-output reporting architecture. Blame all them!
    // We are not going to modify those tests right now (heading to
    // have them under phpunit asap)
    $xmlcontents = preg_replace('!<fail>Identical expectation .*;pass.*;/pass.* and \[\] at .*?</fail>!s', '', $xmlcontents);
    // Let's transform it now
    $xslt = new XSLTProcessor();
    $xslt->importStylesheet(new SimpleXMLElement($reporter->simpletest2xunit));
    $junitresults = $xslt->transformToXML(new SimpleXMLElement($xmlcontents));
    echo $junitresults;
    // Calculate the final result
    if ($moodle22stableandup) {
        // On 22 stable and upwards, require all (fail, error, skipped to pass)
        $check = '!0 failed, 0 exceptions, 0 skipped!';
    } else {
        // We don't look for skipped in 20 and 21 stables (no cli generator there)
        $check = '!0 failed, 0 exceptions,!';
    }
    if (preg_match($check, $junitresults)) {
        exit(0);
    } else {
        exit(1);
    }
} else {
    $test->run($reporter);
}

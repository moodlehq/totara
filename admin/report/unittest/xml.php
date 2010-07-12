<?php
/**
 * Run the unit tests.
 *
 * @copyright &copy; 2006 The Open University
 * @author N.D.Freear@open.ac.uk, T.J.Hunt@open.ac.uk
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @version $Id$
 * @package SimpleTestEx
 */

/** */
require_once(dirname(__FILE__).'/../../../config.php');
require_once($CFG->libdir.'/simpletestlib.php');
require_once('ex_simple_test.php');
require_once($CFG->libdir.'/simpletestlib/xml.php');

error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors', 0);

// Setup
$path = '';
$showpasses = true;
$showsearch = false;
$thorough = true;

/* The UNITTEST constant can be checked elsewhere if you need to know
 * when your code is being run as part of a unit test. */
define('UNITTEST', true);
$langfile = 'simpletest';

// Create the group of tests.
$test =& new AutoGroupTest($showsearch, $thorough);

// OU specific. We use the _nonproject folder for stuff we want to
// keep in CVS, but which is not really relevant. It does no harm
// to leave this here.
$test->addIgnoreFolder($CFG->dirroot . '/.git/');

// Make the reporter, which is what displays the results.
$reporter = new XmlReporter();

// Work out what to test.
$paths = explode(',', $path);

foreach ($paths as $path) {
    if (substr($path, 0, 1) == '/') {
        $path = substr($path, 1);
    }
    $path = $CFG->dirroot . '/' . $path;
    if (substr($path, -1) == '/') {
        $path = substr($path, 0, -1);
    }

    $ok = true;
    if (is_file($path)) {
        $test->addTestFile($path);
    } else if (is_dir($path)){
        $test->findTestFiles($path);
    } else {
        die(get_string('pathdoesnotexist', $langfile, $path));
        $ok = false;
    }
}

// If we have something to test, do it.
if ($ok) {
    $test->run($reporter);
}

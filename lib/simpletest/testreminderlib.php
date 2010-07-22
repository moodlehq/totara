<?php
/**
 * Unit tests for (some of) lib/reminderlib.php.
 *
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package question
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); //  It must be included from a Moodle page
}

// Make sure the code being tested is accessible.
require_once($CFG->libdir . '/reminderlib.php'); // Include the code to test

/** This class contains the test cases for the functions in reminderlib.php. */
class reminderlib_test extends UnitTestCase {

    /**
     * Test for reminder_check_businessdays()
     *
     * Check if works correctly with out weekends during period
     */
    function test_reminder_check_businessdays_midweek() {

        $timestamp = strtotime('2010-07-05 03:00'); // Monday
        $period = 4;
        $check = strtotime('2010-07-09 03:00'); // Friday

        $this->assertTrue(reminder_check_businessdays($timestamp, $period, $check));
    }

    /**
     * Test for reminder_check_businessdays()
     *
     * Check it correctly returns false if the period hasn't finished because
     * of a weekend during
     */
    function test_reminder_check_businessdays_weekend_false() {

        $timestamp = strtotime('2010-07-01 03:00'); // Thursday
        $period = 4;
        $check = strtotime('2010-07-06 03:00'); // Tuesday

        $this->assertFalse(reminder_check_businessdays($timestamp, $period, $check));
    }

    /**
     * Test for reminder_check_businessdays()
     *
     * Check if works correctly by skipping the weekend, but returning true when the
     * time passed is finally long enough
     */
    function test_reminder_check_businessdays_weekend_true() {

        $timestamp = strtotime('2010-07-01 03:00'); // Thursday
        $period = 4;
        $check = strtotime('2010-07-07 03:00'); // Wednesday

        $this->assertTrue(reminder_check_businessdays($timestamp, $period, $check));
    }
}

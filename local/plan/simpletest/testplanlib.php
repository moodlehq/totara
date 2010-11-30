<?php // $Id$
/*
**
 * Unit tests for local/plan/lib.php
 *
 * @author Simon Coggins <simonc@catalyst.net.nz>
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot . '/local/plan/lib.php');
require_once($CFG->libdir . '/simpletestlib.php');

class testplanlib_test extends prefix_changing_test_case {
    // test data for database

    // reduced version of user table
    var $user_data = array(
        array('id', 'username', 'firstname', 'lastname'),
        array(1, 'guest', 'Guest', 'User'),
        array(2, 'admin', 'Admin', 'User'),
    );

    function setUp() {
        global $db,$CFG;
        parent::setup();

        load_test_table($CFG->prefix . 'user', $this->user_data, $db);

    }

    function tearDown() {
        global $db,$CFG;

        remove_test_table($CFG->prefix . 'user', $db);

        parent::tearDown();
    }

    /*
    function test_reportbuilder_get_filters() {
        $rb = $this->rb;
        $filters = $rb->get_filters();
        // should return the current filters for this report
        $this->assertTrue(is_array($filters));
        $this->assertEqual(count($filters), 8);
        $this->assertEqual(current($filters)->type, 'user');
        $this->assertEqual(current($filters)->value, 'fullname');
        $this->assertEqual(current($filters)->advanced, '0');
        $this->assertEqual(current($filters)->label, 'User\'s Full name');
        $this->assertEqual(current($filters)->selectfunc, null);
    }
    */

}

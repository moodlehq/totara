<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Brett Wilkins <brett@catalyst.net.nz>
 * @package totara
 * @subpackage totara/core
 * Unit tests for totara/core/totara.php
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot . '/totara/core/totara.php');

//Need constants for one of the tests...
require_once($CFG->dirroot . '/totara/hierarchy/prefix/position/lib.php');
require_once($CFG->dirroot . '/admin/tool/unittest/simpletestlib.php');

class totaralib_session_test extends UnitTestCase {

    var $queue_key_data = array("key0", "key1");

    var $queue_data = array(
                           "key0" => "data0",
                           "key1" => array("data1","data2"),
                          );

    var $notification_data = array(
                                    array(
                                            "message" => "message",
                                         ),
                                    array(
                                            "option" => "option1",
                                         ),
                                    "expected_result" => array(
                                            "message" => "message",
                                            "option" => "option1",
                                         ),
                                  );

    //Clear moodle's $SESSION before testing
    function setUp() {
        global $SESSION;
        parent::setUp();
        $SESSION = new Object;
    }

    //Restore moodle's $SESSION after testing
    function tearDown() {
        global $SESSION;
        $SESSION = &$_SESSION['SESSION'];
    }

    function test_totara_queue() {
        global $SESSION;

        //Test totara_queue_append
        $key = $this->queue_key_data[0];
        totara_queue_append($key, $this->queue_data[$key]);
        $this->assertEqual($SESSION->totara_queue[$key][0], $this->queue_data[$key]);

        $key = $this->queue_key_data[1];
        totara_queue_append($key, $this->queue_data[$key][0]);
        totara_queue_append($key, $this->queue_data[$key][1]);
        $this->assertClone($SESSION->totara_queue[$key], $this->queue_data[$key]);
        //Test totara_queue_shift
        $key = $this->queue_key_data[0];
        $this->assertEqual(totara_queue_shift($key), $this->queue_data[$key]);
        $this->assertNull(totara_queue_shift($key));

        $key = $this->queue_key_data[1];
        $this->assertClone(totara_queue_shift($key, true), $this->queue_data[$key]);
        $this->assertEqual(totara_queue_shift($key, true), array()); //Lacking an assertEmpty.
    }

    function test_totara_notifications() {
        global $SESSION;

        /**************************************
            Test notifications without options
        **************************************/

        //Test totara_set_notification
        totara_set_notification($this->notification_data[0]['message']);
        $this->assertEqual($SESSION->totara_queue['notifications'][0], $this->notification_data[0]);

        //Test totara_get_notifications
        $this->assertEqual(totara_get_notifications(), array($this->notification_data[0]));
        $this->assertEqual(totara_get_notifications(), array()); //Lacking an assertEmpty.

        /**************************************
            Test notifications with options
        **************************************/

        //Test totara_set_notification
        totara_set_notification($this->notification_data[0]['message'], null, $this->notification_data[1]);
        $this->assertEqual($SESSION->totara_queue['notifications'][0]['message'], $this->notification_data['expected_result']['message']);
        $this->assertEqual($SESSION->totara_queue['notifications'][0]['option'], $this->notification_data['expected_result']['option']);

        //Test totara_get_notifications
        $this->assertEqual(totara_get_notifications(), array($this->notification_data['expected_result']));
        $this->assertEqual(totara_get_notifications(), array()); //Lacking an assertEmpty.
    }

}

class totaralib_db_test extends UnitTestCaseUsingDatabase {

    var $userid = 1;
    var $managerid = 2;
    var $invaliduserid = 3;

    //Left out columns not needed for this test (and kept a few for code readability)
    var $user_table_data = array(
                                    array('id', 'username', 'firstname', 'lastname', 'deleted'),
                                    array(1, 'user1', 'user', 'one', 0),
                                    array(2, 'manager1', 'manager', 'one', 0),
                                );

    //Left out columns not needed for this test
    var $role_assignments_table_data = array(
                                                array('id', 'roleid', 'contextid', 'userid'),
                                                array(1, 1, 1, 2),
                                            );

    //Left out columns not needed for this test
    var $role_table_data = array(
                                    array('id', 'name', 'shortname', 'description'),
                                    array(1, 'Manager', 'manager', 'Manager Role'),
                                );

    //Left out columns not needed for this test
    var $context_table_data = array(
                                        array('id', 'contextlevel', 'instanceid'),
                                        array('1', CONTEXT_USER, 1),
                                   );

    //Left out columns not needed for this test
    var $pos_assignment_table_data = array(
                                                array('id', 'fullname', 'userid', 'managerid', 'reportstoid', 'type', 'timecreated', 'timemodified', 'usermodified'),
                                                array(1, 'pos_fullname', 1, 2, 1, POSITION_TYPE_PRIMARY, '0', '0', '1'),
                                            );

    function load_test_table($table, $location, $data){
        $this->create_test_table($table, $location);
        $this->load_test_data($table, $data[0], array_slice($data, 1));
    }

    function setUp() {
        global $db, $CFG;
        parent::setUp();
        $this->load_test_table('context', 'lib', $this->context_table_data);
        $this->load_test_table('user', 'lib', $this->user_table_data);
        $this->load_test_table('role', 'lib', $this->role_table_data);
        $this->load_test_table('role_assignments', 'lib', $this->role_assignments_table_data);
        $this->load_test_table('pos_assignment', 'totara/hierarchy', $this->pos_assignment_table_data);

        $this->switch_to_test_db();
    }

    function tearDown() {
        global $db, $CFG;
        $this->drop_test_table('context');
        $this->drop_test_table('role');
        $this->drop_test_table('role_assignments');
        $this->drop_test_table('user');
        $this->drop_test_table('pos_assignment');

        $this->revert_to_real_db();

        parent::tearDown();
    }

    function test_totara_is_manager() {
        //totara_is_manager should return true when there is a role assignment for managerid at the user context for userid
        $this->assertTrue(totara_is_manager($this->userid, $this->managerid));

        //totara_is_manager should return false when there is not role assignment record for managerid on userid's user context
        $this->assertFalse(totara_is_manager($this->userid, $this->invaliduserid));
    }

    function test_totara_get_manager() {
        //Return value should be user object
        $this->assertEqual(totara_get_manager($this->userid)->id,$this->managerid);

        //totara_get_manager returns get_record_sql. expecting false here.
        $this->assertFalse(totara_get_manager($this->managerid));
    }

    function test_totara_get_staff() {
        //Expect array of id numbers
        $this->assertEqual(totara_get_staff($this->managerid),array($this->userid));

        //Expect false when the 'managerid' being inspected has no staff
        $this->assertFalse(totara_get_staff($this->userid));
    }
}
?>

<?php
/*
 *
 * Unit tests for local/totara.php
 *
 * @author Brett Wilkins <brett@catalyst.net.nz>
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot . '/local/totara.php');

//Need constants for one of the tests...
require_once($CFG->dirroot.'/hierarchy/type/position/lib.php');
require_once($CFG->libdir . '/simpletestlib.php');

class totaralib_session_test extends UnitTestCase {

    var $queue_key_data = array(
                                "key0",
                                "key1",
                              );

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

class totaralib_db_test extends prefix_changing_test_case {

    var $userid = 1;
    var $managerid = 2;
    var $invaliduserid = 3;

    //Left out columns not needed for this test (and kept a few for code readability)
    var $user_table_data = array(
                                    array('id','username','firstname','lastname'),
                                    array(1,'user1','user','one'),
                                    array(2,'manager1','manager','one'),
                                );

    //Left out columns not needed for this test
    var $role_assignments_table_data = array(
                                                array('id','roleid','contextid','userid'),
                                                array(1,1,1,2),
                                            );

    //Left out columns not needed for this test
    var $role_table_data = array(
                                    array('id','name','shortname','description'),
                                    array(1,'Manager','manager','Manager Role'),
                                );

    //Left out columns not needed for this test
    var $context_table_data = array(
                                        array('id','contextlevel','instanceid'),
                                        array('1', CONTEXT_USER, 1),
                                   );

    //Left out columns not needed for this test
    var $pos_assignment_table_data = array(
                                                array('id','userid','reportstoid','type'),
                                                array(1,1,1,POSITION_TYPE_PRIMARY),
                                          );

    function setUp() {
        global $db, $CFG;
        parent::setUp();
        load_test_table($CFG->prefix.'context', $this->context_table_data, $db);
        load_test_table($CFG->prefix.'role', $this->role_table_data, $db);
        load_test_table($CFG->prefix.'role_assignments', $this->role_assignments_table_data, $db);
        load_test_table($CFG->prefix.'user', $this->user_table_data, $db);
        load_test_table($CFG->prefix.'pos_assignment', $this->pos_assignment_table_data, $db);
    }

    function tearDown() {
        global $db, $CFG;
        remove_test_table($CFG->prefix.'context',$db);
        remove_test_table($CFG->prefix.'role',$db);
        remove_test_table($CFG->prefix.'role_assignments',$db);
        remove_test_table($CFG->prefix.'user',$db);
        remove_test_table($CFG->prefix.'pos_assignment',$db);
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

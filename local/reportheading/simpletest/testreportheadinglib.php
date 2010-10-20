<?php // $Id$
/*
**
 * Unit tests for local/reportheading/lib.php
 *
 * @author Simon Coggins <simonc@catalyst.net.nz>
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot . '/local/reportheading/lib.php');
require_once($CFG->libdir . '/simpletestlib.php');

class reportheadinglib_test extends prefix_changing_test_case {
    // test data for database

    var $reportheading_items_data = array(
        array('id', 'type', 'heading', 'defaultvalue', 'sortorder'),
        array(1, 'user-firstname', 'First Name', 'Not Found', 1),
        array(2, 'user-lastname', 'Last Name', 'Not Found', 2),
        array(3, 'user-email', 'Email', 'Not Found', 3),
    );

    // reduced version of user table
    var $user_data = array(
        array('id', 'username', 'firstname', 'lastname','idnumber','email','icq','institution','department','address','city','country','url'),
        array(1, 'guest', 'Guest', 'User','TEST1','test@example.com','testuser','Test institution', 'Test Department', 'Test Address', 'Test City', 'Test Country', 'http://www.example.com/'),
        array(2, 'admin', 'Admin', 'User','ADM1','admin@example.com','adminuser','Test institution', 'Test Department', 'Test Address', 'Test City', 'Test Country', 'http://www.example.com/'),
    );

    var $user_info_field_data = array(
        array('id', 'shortname', 'name', 'datatype', 'description', 'categoryid', 'sortorder', 'required', 'locked', 'visible', 'forceunique', 'signup', 'defaultdata', 'param1', 'param2', 'param3', 'param4', 'param5'),
        array(1, 'datejoined', 'Date Joined', 'text', '', 1, 1, 0, 0, 1, 0, 0, '', 30, 2048, 0, '', ''),
    );

    var $user_info_data_data = array(
        array('id', 'userid', 'fieldid', 'data'),
        array(1, 2, 1, '06/05/1977'),
    );

    var $org_data = array(
        array('id', 'fullname', 'shortname', 'description', 'idnumber', 'frameworkid', 'path', 'depthid', 'parentid', 'sortorder', 'visible', 'timecreated', 'timemodified', 'usermodified'),
        array(1, 'District Office', 'DO', '', '', 1, '/1', 1, 0, 1, 1, 0, 0, 2),
        array(2, 'Area Office', 'AO', '', '', 1, '/1/2', 2, 1, 2, 1, 0, 0, 2),
    );

    var $pos_data = array(
        array('id', 'fullname', 'shortname', 'idnumber', 'description', 'frameworkid', 'path', 'depthid', 'parentid', 'sortorder', 'visible', 'timevalidfrom', 'timevalidto', 'timecreated', 'timemodified', 'usermodified'),
        array(1, 'Data Analyst', 'Data Analyst', '', '', 1, '/1', 1, 0, 1, 1, 0, 0, 0, 0, 2),
    );

    var $org_depth_data = array(
        array('id', 'fullname', 'shortname', 'description', 'depthlevel', 'frameworkid', 'timecreated', 'timemodified', 'usermodified'),
        array(1, 'Org Depth Level 1', 'orgdepth1', 'Org Depth Level 1 Description', 1, 1, 0, 0, 2),
        array(2, 'Org Depth Level 2', 'orgdepth2', 'Org Depth Level 2 Description', 2, 1, 0, 0, 2),
    );

    var $pos_depth_data = array(
        array('id', 'fullname', 'shortname', 'description', 'depthlevel', 'frameworkid', 'timecreated', 'timemodified', 'usermodified'),
        array(1, 'Pos Depth Level 1', 'posdepth1', 'Pos Depth Level 1 Description', 1, 1, 0, 0, 2),
    );

    // reduced version of pos_assignment table
    var $pos_assignment_data = array(
        array('id', 'fullname','shortname','organisationid','positionid','userid','type','reportstoid'),
        array(1, 'Title', 'Title', 2, 1, 2, 1, 1),
    );

    var $role_assignments_data = array(
        array('id', 'roleid', 'contextid', 'userid', 'hidden', 'timestart', 'timeend', 'timemodified', 'modifierid', 'enrol', 'sortorder'),
        array(1, 1, 1, 1, 0, 0, 0, 0, 2, 'manual', 0),
    );

    var $context_data = array(
        array('id','contextlevel','instanceid','path','depth'),
        array(1, 10, 0, '/1', 1),
        array(2, 30, 2, '/1/2', 2),
    );

    var $role_data = array(
        array('id', 'name', 'shortname', 'description', 'sortorder'),
        array(1, 'manager', 'manager', '', 1),
    );

    function setUp() {
        global $db,$CFG;
        parent::setup();
        load_test_table($CFG->prefix . 'report_heading_items', $this->reportheading_items_data, $db);
        load_test_table($CFG->prefix . 'user', $this->user_data, $db);
        load_test_table($CFG->prefix . 'user_info_field', $this->user_info_field_data, $db);
        load_test_table($CFG->prefix . 'user_info_data', $this->user_info_data_data, $db);
        load_test_table($CFG->prefix . 'org', $this->org_data, $db);
        load_test_table($CFG->prefix . 'pos', $this->pos_data, $db);
        load_test_table($CFG->prefix . 'org_depth', $this->org_depth_data, $db);
        load_test_table($CFG->prefix . 'pos_depth', $this->pos_depth_data, $db);
        load_test_table($CFG->prefix . 'pos_assignment', $this->pos_assignment_data, $db);
        load_test_table($CFG->prefix . 'role_assignments', $this->role_assignments_data, $db);
        load_test_table($CFG->prefix . 'context', $this->context_data, $db);
        load_test_table($CFG->prefix . 'role', $this->role_data, $db);

        $this->heading = new reportheading();
    }

    function tearDown() {
        global $db,$CFG;
        remove_test_table($CFG->prefix . 'role', $db);
        remove_test_table($CFG->prefix . 'context', $db);
        remove_test_table($CFG->prefix . 'role_assignments', $db);
        remove_test_table($CFG->prefix . 'pos_assignment', $db);
        remove_test_table($CFG->prefix . 'org_depth', $db);
        remove_test_table($CFG->prefix . 'pos_depth', $db);
        remove_test_table($CFG->prefix . 'org', $db);
        remove_test_table($CFG->prefix . 'pos', $db);
        remove_test_table($CFG->prefix . 'user_info_data', $db);
        remove_test_table($CFG->prefix . 'user_info_field', $db);
        remove_test_table($CFG->prefix . 'user', $db);
        remove_test_table($CFG->prefix . 'report_heading_items', $db);
        parent::tearDown();
    }

    function test_reportheading_initialize_db_instance() {
        $heading = new reportheading();
        // should create report heading object with the correct default properties
        $items = $heading->items;
        // items should be an array
        $this->assertTrue(is_array($items));
        // it should have the right number of elements
        $this->assertEqual(count($items), 3);
        // it should contain the expected values
        $this->assertEqual(current($items), (object)array('type'=>'user-firstname','heading'=>'First Name','defaultvalue'=>'Not Found','sortorder'=>'1','id'=>1));

        $columnoptions = $heading->columnoptions;
        // column options should be an array
        $this->assertTrue(is_array($columnoptions));
        // it should have the right number of elements
        $this->assertEqual(count($columnoptions), 42);
        // it should contain the expected values
        $this->assertEqual(current($columnoptions), 'Fullname');
    }

    function test_reportheading_initialize_fresh_db_instance() {
        // empty items database
        delete_records('report_heading_items');
        // create new instance
        $heading = new reportheading();
        $items = $heading->items;
        // it should have created two elements
        $this->assertEqual(count($items), 2);
        // they should contain the expected values
        $this->assertEqual(current($items), (object)array('type'=>'user-firstname','heading'=>'First Name','defaultvalue'=>'Not Found','sortorder'=>'1','id'=>4));
        $this->assertEqual(next($items), (object)array('type'=>'user-lastname','heading'=>'Last Name','defaultvalue'=>'Not Found','sortorder'=>'2','id'=>5));
    }

    function test_reportheading_get_column_options() {
        $heading = $this->heading;
        $columnoptions = $heading->get_column_options();
        // column options should be an array
        $this->assertTrue(is_array($columnoptions));
        // it should have the right number of elements
        $this->assertEqual(count($columnoptions), 42);
        // it should contain the expected values
        $this->assertEqual(current($columnoptions), 'Fullname');
    }

    function test_reportheading_delete_column() {
        $heading = $this->heading;
        $before = count($heading->items);
        // should not be able to delete invalid column
        $this->assertFalse($heading->delete_column(999));
        $afterfail = count($heading->items);
        // should not delete column if cid doesn't match
        $this->assertEqual($before - $afterfail, 0);
        // should return true if successful
        $this->assertTrue($heading->delete_column(1));
        $after = count($heading->items);
        // should be one less column after successful delete operation
        $this->assertEqual($before - $after, 1);
    }

    function test_reportheading_move_column() {
        $heading = $this->heading;
        $items = $heading->items;
        $firstbefore = $items[1]->sortorder;
        $secondbefore = $items[2]->sortorder;
        $thirdbefore = $items[3]->sortorder;
        // should not be able to move first column up
        $this->assertFalse($heading->move_column(1, 'up'));
        $items = $heading->items;
        $firstafter = $items[1]->sortorder;
        $secondafter = $items[2]->sortorder;
        $thirdafter = $items[3]->sortorder;
        // columns should not change if trying to do a bad column move
        $this->assertEqual($firstbefore, $firstafter);
        $this->assertEqual($secondbefore, $secondafter);
        // should be able to move first column down
        $this->assertTrue($heading->move_column(1, 'down'));
        $items = $heading->items;
        $firstafter = $items[1]->sortorder;
        $secondafter = $items[2]->sortorder;
        $thirdafter = $items[3]->sortorder;
        // columns should change if move is valid
        $this->assertNotEqual($firstbefore, $firstafter);
        // moved columns should have swapped
        $this->assertEqual($firstbefore, $secondafter);
        $this->assertEqual($secondbefore, $firstafter);
        // unmoved columns should stay the same
        $this->assertEqual($thirdbefore, $thirdafter);
    }

    function test_reportheading_display() {
        $heading = $this->heading;
        // it should display a single column by default
        $this->assertPattern('|<tr><th>[^<]+</th><td>[^<]+</td></tr>|', $heading->display());
        // it should display the right number of columns if specified
        $this->assertPattern('|<tr>(<th>[^<]+</th><td>[^<]+</td>){2}</tr>|', $heading->display(2));
        // it should include the reporting date by default
        $this->assertPattern('/Reported at/', $heading->display());
        // it should not include the reporting date if hidden
        $this->assertNoPattern('/Reported at/', $heading->display(1, false));
    }

    function test_reportheading_get_user_field() {
        $heading = $this->heading;
        // it should return an empty string for bad field arguments
        $this->assertEqual($heading->get_user_field('badfield'), '');
        // it should return the correct values
        $this->assertEqual($heading->get_user_field('firstname'),'Admin');
        $this->assertEqual($heading->get_user_field('lastname'),'User');
        // it should return the correct values for other users too
        $this->assertEqual($heading->get_user_field('firstname', 1), 'Guest');
        // it should treat certain fields in a special way
        $this->assertPattern('|<a href="http://.*/user/view\.php\?id=2">Admin User</a>|', $heading->get_user_field('fullname'));
        $this->assertEqual($heading->get_user_field('url'),'<a href="http://www.example.com/">http://www.example.com/</a>');
    }

    function test_reportheading_get_manager_field() {
        $heading = $this->heading;
        // it should return an empty string for bad field arguments
        $this->assertEqual($heading->get_manager_field('badfield'), '');
        // it should return the correct values for the manager
        $this->assertEqual($heading->get_manager_field('firstname'),'Guest');
        // get rid of manager assignment
        $todb = new object();
        $todb->id = 1;
        $todb->reportstoid = null;
        update_record('pos_assignment', $todb);
        // it should return an empty string if no manager exists
        $this->assertEqual($heading->get_manager_field('firstname'), '');
    }

    function test_reportheading_get_profile_field() {
        $heading = $this->heading;
        // it should return the correct value for valid custom fields
        $this->assertEqual($heading->get_profile_field('datejoined'),'06/05/1977');
        // it should return an empty string for invalid custom fields
        $this->assertEqual($heading->get_profile_field('badcustomfield'), '');

    }

    function test_reportheading_get_hierarchy_depth() {
        $heading = $this->heading;
        // it should return the correct value for valid depth levels
        $this->assertEqual($heading->get_hierarchy_depth('position','posdepth1'), 'Data Analyst');
        $this->assertEqual($heading->get_hierarchy_depth('organisation','orgdepth2'), 'Area Office');
        // it should return the correct value when finding an assigned items parent
        $this->assertEqual($heading->get_hierarchy_depth('organisation','orgdepth1'), 'District Office');
        // it should return an empty string for invalid depth levels
        $this->assertEqual($heading->get_hierarchy_depth('position','baddepth'), '');
    }

    // tests for wrapper functions not required:
    // test_reportheading_get_position_depth()
    // test_reportheading_get_organisation_depth()
}


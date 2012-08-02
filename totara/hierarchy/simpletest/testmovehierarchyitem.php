<?php // $Id$
/*
**
 * Unit tests for move_hierarchy_item()
 *
 * @author Simon Coggins <simonc@catalyst.net.nz>
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot . '/totara/hierarchy/lib.php');
require_once($CFG->dirroot . '/totara/hierarchy/prefix/organisation/lib.php');
require_once($CFG->dirroot . '/admin/tool/unittest/simpletestlib.php');

class movehierarchyitem_test extends UnitTestCaseUsingDatabase {
//TODO: add tests for moving hierarchy items between frameworks

    var $org_data = array(
        array('id', 'fullname', 'shortname', 'description', 'idnumber', 'frameworkid',
        'path', 'parentid', 'sortthread', 'depthlevel',
        'visible', 'timecreated', 'timemodified', 'usermodified', 'typeid'),
        array(1, 'Organisation A', 'Org A', 'Org Description A', 'OA', 1,
        '/1', 0, '01', 1, 1, 1234567890, 1234567890, 2, 0),
        array(2, 'Organisation B', 'Org B', 'Org Description B', 'OB', 1,
        '/1/2', 1, '01.01', 2, 1, 1234567890, 1234567890, 2, 0),
        array(3, 'Organisation C', 'Org C', 'Org Description C', 'OC', 1,
        '/1/2/3', 2, '01.01.01', 3, 1, 1234567890, 1234567890, 2, 0),
        array(4, 'Organisation D', 'Org D', 'Org Description D', 'OD', 1,
        '/1/2/4', 2, '01.01.02', 3, 1, 1234567890, 1234567890, 2, 0),
        array(5, 'Organisation E', 'Org E', 'Org Description E', 'OE', 1,
        '/5', 0, '02', 1, 1, 1234567890, 1234567890, 2, 0),
        array(6, 'Organisation F', 'Org F', 'Org Description F', 'OF', 1,
        '/5/6', 5, '02.01', 2, 1, 1234567890, 1234567890, 2, 0),
        array(7, 'Organisation G', 'Org G', 'Org Description G', 'OG', 1,
        '/5/6/7', 6, '02.01.01', 3, 1, 1234567890, 1234567890, 2, 0),
        array(8, 'Organisation H', 'Org H', 'Org Description H', 'OH', 1,
        '/5/6/8', 6, '02.01.02', 3, 1, 1234567890, 1234567890, 2, 0),
        array(9, 'Organisation I', 'Org I', 'Org Description I', 'OI', 1,
        '/5/6/8/9', 8, '02.01.02.01', 4, 1, 1234567890, 1234567890, 2, 0),
        array(10, 'Organisation J', 'Org J', 'Org Description J', 'OJ', 1,
        '/10', 0, '03', 1, 1, 1234567890, 1234567890, 2, 0),
        array(11, 'Org 1', 'Org 1', 'Org Description 1', 'O1', 2,
        '/11', 0, '01', 1, 1, 1234567890, 1234567890, 2, 0),
        array(12, 'Org 2', 'Org 2', 'Org Description 2', 'O2', 2,
        '/11/12', 11, '01.01', 2, 1, 1234567890, 1234567890, 2, 0),
        array(13, 'Org 3', 'Org 3', 'Org Description 3', 'O3', 2,
        '/11/12/13', 12, '01.01.01', 3, 1, 1234567890, 1234567890, 2, 0),
        array(14, 'Org 4', 'Org 4', 'Org Description 4', 'O4', 2,
        '/11/14', 11, '01.02', 2, 1, 1234567890, 1234567890, 2, 0),
        array(15, 'Org 5', 'Org 5', 'Org Description 5', 'O5', 2,
        '/11/15', 11, '01.03', 2, 1, 1234567890, 1234567890, 2, 0),
        array(16, 'Org 6', 'Org 6', 'Org Description 6', 'O6', 2,
        '/11/16', 11, '01.04', 2, 1, 1234567890, 1234567890, 2, 0)
    );

    var $org_fw_data = array(
        array('id', 'fullname', 'shortname', 'description', 'idnumber',
        'visible', 'timecreated', 'timemodified', 'usermodified', 'sortorder', 'hidecustomfields'),
        array(1, 'Framework A', 'FW A', 'Org Framework Description A', 'FA',
        1, 1234567890, 1234567890, 2, 1, 1),
        array(2, 'Framework B', 'FW B', 'Org Framework Description B', 'FB',
        1, 1234567890, 1234567890, 2, 2, 1),
    );

    function setUp() {
        global $CFG;
        parent::setup();

        //set up the test database
        $this->create_test_table('org', 'totara/hierarchy');
        $this->load_test_data('org', $this->org_data[0], array_slice($this->org_data, 1));
        $this->create_test_table('org_framework', 'totara/hierarchy');
        $this->load_test_data('org_framework', $this->org_fw_data[0], array_slice($this->org_fw_data, 1));
        $this->switch_to_test_db();
    }

    function tearDown() {
        global $db,$CFG;
        $this->drop_test_tables(array('org', 'org_framework'));
        $this->revert_to_real_db();
        parent::tearDown();
   }

/*
 * Testing hierarchy:
 *
 * FRAMEWORK 1:
 * A
 * |_B
 * | |_C
 * | |_D
 * E
 * |_F
 * | |_G
 * | |_H
 * |   |_I
 * J
 *
 * FRAMEWORK 2:
 * 1
 * |_2
 * | |_3
 * |
 * |_4
 * |
 * |_5
 * |
 * |_6
 *
 */
    function test_new_parent_id() {
        $org = new organisation();

        $item = $this->testdb->get_records('org', array('id' => 6));
        $newparent = 3;
        $newframework = '1';

        $before = $this->testdb->get_records_menu('org', array('frameworkid' => '1'), 'sortthread', 'id,parentid');
        $this->assertTrue($org->move_hierarchy_item($item[6], $newframework, $newparent));
        $after = $this->testdb->get_records_menu('org', array('frameworkid' => '1'), 'sortthread', 'id,parentid');

        // all that should have changed is item 6 should now have 3 as a parentid
        // others should stay the same
        $before[6] = 3;
        $this->assertEqual($before, $after);

        // now test moving to the top level
        $item = $this->testdb->get_records('org', array('id' => 6));
        $newparent = 0;

        $before = $after;
        $this->assertTrue($org->move_hierarchy_item($item[6], $newframework, $newparent));
        $after = $this->testdb->get_records_menu('org', array('frameworkid' => '1'), 'sortthread', 'id,parentid');
        $before[6] = 0;
        $this->assertEqual($before, $after);

        // now test moving from the top level
        $item = $this->testdb->get_records('org', array('id' => 1));
        $newparent = 6;

        $before = $after;
        $this->assertTrue($org->move_hierarchy_item($item[1], $newframework, $newparent));
        $after = $this->testdb->get_records_menu('org', array('frameworkid' => '1'), 'sortthread', 'id,parentid');
    }

    function test_new_depthlevel() {
        $org = new organisation();

        $item = $this->testdb->get_records('org', array('id' => 6));
        $newparent = 3;
        $newframework = 1;

        $before = $this->testdb->get_records_menu('org', array('frameworkid' => '1'), 'sortthread', 'id,depthlevel');
        $this->assertTrue($org->move_hierarchy_item($item[6], $newframework, $newparent));
        $after = $this->testdb->get_records_menu('org', array('frameworkid' => '1'), 'sortthread', 'id,depthlevel');
        // item and all it's children should have changed
        $before[6] = 4;
        $before[7] = 5;
        $before[8] = 5;
        $before[9] = 6;
        // everything else stays the same
        $this->assertEqual($before, $after);

        // now try attaching to top level
        $item = $this->testdb->get_records('org', array('id' => 6));
        $newparent = 0;

        $before = $after;
        $this->assertTrue($org->move_hierarchy_item($item[6], $newframework, $newparent));
        $after = $this->testdb->get_records_menu('org', array('frameworkid' => '1'), 'sortthread', 'id,depthlevel');
        // item and all it's children should have changed
        $before[6] = 1;
        $before[7] = 2;
        $before[8] = 2;
        $before[9] = 3;
        // everything else stays the same
        $this->assertEqual($before, $after);

        // now try moving from the top level
        $item = $this->testdb->get_records('org', array('id' => 1));
        $newparent = 10;
        $before = $after;
        $this->assertTrue($org->move_hierarchy_item($item[1], $newframework, $newparent));
        $after = $this->testdb->get_records_menu('org', array('frameworkid' => '1'), 'sortthread', 'id,depthlevel');
        // item and all it's children should have changed
        $before[1] = 2;
        $before[2] = 3;
        $before[3] = 4;
        $before[4] = 4;
        // everything else stays the same
        $this->assertEqual($before, $after);

    }

    function test_new_path() {

        $org = new organisation();

        $item = $this->testdb->get_records('org', array('id' => 6));
        $newparent = 3;
        $newframework = 1;

        $before = $this->testdb->get_records_menu('org', array('frameworkid' => '1'), 'sortthread', 'id,path');
        $this->assertTrue($org->move_hierarchy_item($item[6], $newframework, $newparent));
        $after = $this->testdb->get_records_menu('org', array('frameworkid' => '1'), 'sortthread', 'id,path');
        // item and all it's children should have changed
        $before[6] = '/1/2/3/6';
        $before[7] = '/1/2/3/6/7';
        $before[8] = '/1/2/3/6/8';
        $before[9] = '/1/2/3/6/8/9';
        // everything else stays the same
        $this->assertEqual($before, $after);

        // now try attaching to top level
        $item = $this->testdb->get_records('org', array('id' => 6));
        $newparent = 0;

        $before = $after;
        $this->assertTrue($org->move_hierarchy_item($item[6], $newframework, $newparent));
        $after = $this->testdb->get_records_menu('org', array('frameworkid' => '1'), 'sortthread', 'id,path');
        // item and all it's children should have changed
        $before[6] = '/6';
        $before[7] = '/6/7';
        $before[8] = '/6/8';
        $before[9] = '/6/8/9';
        // everything else stays the same
        $this->assertEqual($before, $after);

        // now try moving from the top level
        $item = $this->testdb->get_records('org', array('id' => 1));
        $newparent = 10;
        $before = $after;
        $this->assertTrue($org->move_hierarchy_item($item[1], $newframework, $newparent));
        $after = $this->testdb->get_records_menu('org', array('frameworkid' => '1'), 'sortthread', 'id,path');
        // item and all it's children should have changed
        $before[1] = '/10/1';
        $before[2] = '/10/1/2';
        $before[3] = '/10/1/2/3';
        $before[4] = '/10/1/2/4';
        $this->assertEqual($before, $after);
        // everything else stays the same
    }

    function test_new_sortorder() {
        $org = new organisation();

        $item = $this->testdb->get_records('org', array('id' => 6));
        $newparent = 3;
        $newframework = 1;

        $before = $this->testdb->get_records_menu('org', array('frameworkid' => '1'), 'sortthread', 'id,sortthread');
        $this->assertTrue($org->move_hierarchy_item($item[6], $newframework, $newparent));
        $after = $this->testdb->get_records_menu('org', array('frameworkid' => '1'), 'sortthread', 'id,sortthread');
        // item and all it's children should have changed
        $before[6] = '01.01.01.01';
        $before[7] = '01.01.01.01.01';
        $before[8] = '01.01.01.01.02';
        $before[9] = '01.01.01.01.02.01';
        // displaced items and everything else stays the same
        $this->assertEqual($before, $after);


        // now try attaching to top level
        $item = $this->testdb->get_records('org', array('id' =>  6));
        $newparent = 0;

        $before = $after;
        $this->assertTrue($org->move_hierarchy_item($item[6], $newframework, $newparent));
        $after = $this->testdb->get_records_menu('org', array('frameworkid' => '1'), 'sortthread', 'id,sortthread');
        // item and all it's children should have changed
        $before[6] = '04';
        $before[7] = '04.01';
        $before[8] = '04.02';
        $before[9] = '04.02.01';
        // displaced items and everything else stays the same
        $this->assertEqual($before, $after);

        // now try moving from the top level
        $item = $this->testdb->get_records('org', array('id' => 1));
        $newparent = 10;
        $before = $after;
        $this->assertTrue($org->move_hierarchy_item($item[1], $newframework, $newparent));
        $after = $this->testdb->get_records_menu('org', array('frameworkid' => '1'), 'sortthread', 'id,sortthread');
        // item and all it's children should have changed
        $before[1] = '03.01';
        $before[2] = '03.01.01';
        $before[3] = '03.01.01.01';
        $before[4] = '03.01.01.02';
        // displayed items and everything else stays the same
        $this->assertEqual($before, $after);
    }

    function test_moving_subtree() {

        $org = new organisation();

        $item = $this->testdb->get_records('org', array('id' => 12));
        $newparent = 14;
        $newframework = 2;

        $before = $this->testdb->get_records_menu('org', array('frameworkid' => '2'), 'sortthread', 'id,sortthread');
        $this->assertTrue($org->move_hierarchy_item($item[12], $newframework, $newparent));
        $after = $this->testdb->get_records_menu('org', array('frameworkid' => '2'), 'sortthread', 'id,sortthread');

        // item and all it's children should have changed
        $before[12] = '01.02.01';
        $before[13] = '01.02.01.01';
        // displaced items and everything else stays the same
        $this->assertEqual($before, $after);
    }

    // these moves should fail and nothing should change
    function test_bad_moves() {

        $org = new organisation();

        // you shouldn't be able to move an item into it's own child
        $item = $this->testdb->get_records('org', array('id' => 12));
        $newparent = 13;
        $newframework = 2;

        $before = $this->testdb->get_records_menu('org', array('frameworkid' => '2'), 'sortthread', 'id,sortthread');
        // this should fail
        $this->assertFalse($org->move_hierarchy_item($item[12], $newframework, $newparent));
        $after = $this->testdb->get_records_menu('org', array('frameworkid' => '2'), 'sortthread', 'id,sortthread');
        // everything stays the same
        $this->assertEqual($before, $after);


        // you shouldn't be able move to parent that doesn't exist
        $newparent = 999;

        $before = $this->testdb->get_records_menu('org', array('frameworkid' => '2'), 'sortthread', 'id,sortthread');
        // this should fail
        $this->assertFalse($org->move_hierarchy_item($item[12], $newframework, $newparent));
        $after = $this->testdb->get_records_menu('org', array('frameworkid' => '2'), 'sortthread', 'id,sortthread');
        // everything stays the same
        $this->assertEqual($before, $after);


        // item must be an object
        $item = 1234;
        $newparent = 0;

        $before = $this->testdb->get_records_menu('org', array('frameworkid' => '2'), 'sortthread', 'id,sortthread');
        // this should fail
        $this->assertFalse($org->move_hierarchy_item($item, $item, $newparent));
        $after = $this->testdb->get_records_menu('org', array('frameworkid' => '2'), 'sortthread', 'id,sortthread');
        // everything stays the same
        $this->assertEqual($before, $after);
    }
}

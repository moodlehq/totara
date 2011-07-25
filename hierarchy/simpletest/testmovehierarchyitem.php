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

require_once($CFG->dirroot . '/hierarchy/lib.php');
require_once($CFG->dirroot . '/hierarchy/prefix/organisation/lib.php');
require_once($CFG->libdir . '/simpletestlib.php');

class movehierarchyitem_test extends prefix_changing_test_case {

    var $org_data = array(
        array('id', 'fullname', 'shortname', 'description', 'idnumber', 'frameworkid',
        'path', 'parentid', 'sortorder', 'depthlevel',
        'visible', 'timecreated', 'timemodified', 'usermodified', 'typeid'),
        array(1, 'Organisation A', 'Org A', 'Org Description A', 'OA', 1,
        '/1', 0, 1, 1,
        1, 1234567890, 1234567890, 2, null),
        array(2, 'Organisation B', 'Org B', 'Org Description B', 'OB', 1,
        '/1/2', 1, 2, 2,
        1, 1234567890, 1234567890, 2, null),
        array(3, 'Organisation C', 'Org C', 'Org Description C', 'OC', 1,
        '/1/2/3', 2, 3, 3,
        1, 1234567890, 1234567890, 2, null),
        array(4, 'Organisation D', 'Org D', 'Org Description D', 'OD', 1,
        '/1/2/4', 2, 4, 3,
        1, 1234567890, 1234567890, 2, null),
        array(5, 'Organisation E', 'Org E', 'Org Description E', 'OE', 1,
        '/5', 0, 5, 1,
        1, 1234567890, 1234567890, 2, null),
        array(6, 'Organisation F', 'Org F', 'Org Description F', 'OF', 1,
        '/5/6', 5, 6, 2,
        1, 1234567890, 1234567890, 2, null),
        array(7, 'Organisation G', 'Org G', 'Org Description G', 'OG', 1,
        '/5/6/7', 6, 7, 3,
        1, 1234567890, 1234567890, 2, null),
        array(8, 'Organisation H', 'Org H', 'Org Description H', 'OH', 1,
        '/5/6/8', 6, 8, 3,
        1, 1234567890, 1234567890, 2, null),
        array(9, 'Organisation I', 'Org I', 'Org Description I', 'OI', 1,
        '/5/6/8/9', 8, 9, 4,
        1, 1234567890, 1234567890, 2, null),
        array(10, 'Organisation J', 'Org J', 'Org Description J', 'OJ', 1,
        '/10', 0, 10, 1,
        1, 1234567890, 1234567890, 2, null),
        array(11, 'Org 1', 'Org 1', 'Org Description 1', 'O1', 2,
        '/11', 0, 1, 1,
        1, 1234567890, 1234567890, 2, null),
        array(12, 'Org 2', 'Org 2', 'Org Description 2', 'O2', 2,
        '/11/12', 11, 2, 2,
        1, 1234567890, 1234567890, 2, null),
        array(13, 'Org 3', 'Org 3', 'Org Description 3', 'O3', 2,
        '/11/12/13', 12, 3, 3,
        1, 1234567890, 1234567890, 2, null),
        array(14, 'Org 4', 'Org 4', 'Org Description 4', 'O4', 2,
        '/11/14', 11, 4, 2,
        1, 1234567890, 1234567890, 2, null),
        array(15, 'Org 5', 'Org 5', 'Org Description 5', 'O5', 2,
        '/11/15', 11, 5, 2,
        1, 1234567890, 1234567890, 2, null),
        array(16, 'Org 6', 'Org 6', 'Org Description 6', 'O6', 2,
        '/11/16', 11, 6, 2,
        1, 1234567890, 1234567890, 2, null),
    );


    function setUp() {
        global $db,$CFG;
        parent::setup();
        load_test_table($CFG->prefix . 'org', $this->org_data, $db);
    }

    function tearDown() {
        global $db,$CFG;
        remove_test_table($CFG->prefix . 'org', $db);
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
 */
    function test_new_parent_id() {
        $org = new organisation();

        $item = get_record('org', 'id', 6);
        $newparent = 3;

        $before = get_records_menu('org', 'frameworkid', '1', 'sortorder', 'id,parentid');
        $this->assertTrue($org->move_hierarchy_item($item, $newparent));
        $after = get_records_menu('org', 'frameworkid', '1', 'sortorder', 'id,parentid');

        // all that should have changed is item 6 should now have 3 as a parentid
        // others should stay the same
        $before[6] = 3;
        $this->assertEqual($before, $after);

        // now test moving to the top level
        $item = get_record('org', 'id', 6);
        $newparent = 0;

        $before = $after;
        $this->assertTrue($org->move_hierarchy_item($item, $newparent));
        $after = get_records_menu('org', 'frameworkid', '1', 'sortorder', 'id,parentid');
        $before[6] = 0;
        $this->assertEqual($before, $after);

        // now test moving from the top level
        $item = get_record('org', 'id', 1);
        $newparent = 6;

        $before = $after;
        $this->assertTrue($org->move_hierarchy_item($item, $newparent));
        $after = get_records_menu('org', 'frameworkid', '1', 'sortorder', 'id,parentid');
        $before[1] = 6;

    }

    function test_new_depthlevel() {
        $org = new organisation();

        $item = get_record('org', 'id', 6);
        $newparent = 3;

        $before = get_records_menu('org', 'frameworkid', '1', 'sortorder', 'id,depthlevel');
        $this->assertTrue($org->move_hierarchy_item($item, $newparent));
        $after = get_records_menu('org', 'frameworkid', '1', 'sortorder', 'id,depthlevel');
        // item and all it's children should have changed
        $before[6] = 4;
        $before[7] = 5;
        $before[8] = 5;
        $before[9] = 6;
        // everything else stays the same
        $this->assertEqual($before, $after);

        // now try attaching to top level
        $item = get_record('org', 'id', 6);
        $newparent = 0;

        $before = $after;
        $this->assertTrue($org->move_hierarchy_item($item, $newparent));
        $after = get_records_menu('org', 'frameworkid', '1', 'sortorder', 'id,depthlevel');
        // item and all it's children should have changed
        $before[6] = 1;
        $before[7] = 2;
        $before[8] = 2;
        $before[9] = 3;
        // everything else stays the same
        $this->assertEqual($before, $after);

        // now try moving from the top level
        $item = get_record('org', 'id', 1);
        $newparent = 10;
        $before = $after;
        $this->assertTrue($org->move_hierarchy_item($item, $newparent));
        $after = get_records_menu('org', 'frameworkid', '1', 'sortorder', 'id,depthlevel');
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

        $item = get_record('org', 'id', 6);
        $newparent = 3;

        $before = get_records_menu('org', 'frameworkid', '1', 'sortorder', 'id,path');
        $this->assertTrue($org->move_hierarchy_item($item, $newparent));
        $after = get_records_menu('org', 'frameworkid', '1', 'sortorder', 'id,path');
        // item and all it's children should have changed
        $before[6] = '/1/2/3/6';
        $before[7] = '/1/2/3/6/7';
        $before[8] = '/1/2/3/6/8';
        $before[9] = '/1/2/3/6/8/9';
        // everything else stays the same
        $this->assertEqual($before, $after);

        // now try attaching to top level
        $item = get_record('org', 'id', 6);
        $newparent = 0;

        $before = $after;
        $this->assertTrue($org->move_hierarchy_item($item, $newparent));
        $after = get_records_menu('org', 'frameworkid', '1', 'sortorder', 'id,path');
        // item and all it's children should have changed
        $before[6] = '/6';
        $before[7] = '/6/7';
        $before[8] = '/6/8';
        $before[9] = '/6/8/9';
        // everything else stays the same
        $this->assertEqual($before, $after);

        // now try moving from the top level
        $item = get_record('org', 'id', 1);
        $newparent = 10;
        $before = $after;
        $this->assertTrue($org->move_hierarchy_item($item, $newparent));
        $after = get_records_menu('org', 'frameworkid', '1', 'sortorder', 'id,path');
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

        $item = get_record('org', 'id', 6);
        $newparent = 3;

        $before = get_records_menu('org', 'frameworkid', '1', 'sortorder', 'id,sortorder');
        $this->assertTrue($org->move_hierarchy_item($item, $newparent));
        $after = get_records_menu('org', 'frameworkid', '1', 'sortorder', 'id,sortorder');
        // item and all it's children should have changed
        $before[6] = 4;
        $before[7] = 5;
        $before[8] = 6;
        $before[9] = 7;
        // displaced items should have changed too
        $before[4] = 8;
        $before[5] = 9;
        // everything else stays the same
        $this->assertEqual($before, $after);


        // now try attaching to top level
        $item = get_record('org', 'id', 6);
        $newparent = 0;

        $before = $after;
        $this->assertTrue($org->move_hierarchy_item($item, $newparent));
        $after = get_records_menu('org', 'frameworkid', '1', 'sortorder', 'id,sortorder');
        // item and all it's children should have changed
        $before[6] = 1;
        $before[7] = 2;
        $before[8] = 3;
        $before[9] = 4;
        // displaced items should have changed too
        $before[1] = 5;
        $before[2] = 6;
        $before[3] = 7;
        // everything else stays the same
        $this->assertEqual($before, $after);

        // now try moving from the top level
        $item = get_record('org', 'id', 1);
        $newparent = 10;
        $before = $after;
        $this->assertTrue($org->move_hierarchy_item($item, $newparent));
        $after = get_records_menu('org', 'frameworkid', '1', 'sortorder', 'id,sortorder');
        // item and all it's children should have changed
        $before[1] = 7;
        $before[2] = 8;
        $before[3] = 9;
        $before[4] = 10;
        // displayed items should have changed too
        $before[5] = 5;
        $before[10] = 6;
        $this->assertEqual($before, $after);
        // everything else stays the same
    }

    function test_moving_subtree() {

        $org = new organisation();

        $item = get_record('org', 'id', 12);
        $newparent = 14;

        $before = get_records_menu('org', 'frameworkid', '2', 'sortorder', 'id,sortorder');
        $this->assertTrue($org->move_hierarchy_item($item, $newparent));
        $after = get_records_menu('org', 'frameworkid', '2', 'sortorder', 'id,sortorder');

        // item and all it's children should have changed
        $before[12] = 3;
        $before[13] = 4;
        // displaced items should have changed too
        $before[14] = 2;
        // everything else stays the same
        $this->assertEqual($before, $after);
    }

    // these moves should fail and nothing should change
    function test_bad_moves() {

        $org = new organisation();

        // you shouldn't be able to move an item into it's own child
        $item = get_record('org', 'id', 12);
        $newparent = 13;

        $before = get_records_menu('org', 'frameworkid', '2', 'sortorder', 'id,sortorder');
        // this should fail
        $this->assertFalse($org->move_hierarchy_item($item, $newparent));
        $after = get_records_menu('org', 'frameworkid', '2', 'sortorder', 'id,sortorder');
        // everything stays the same
        $this->assertEqual($before, $after);


        // you shouldn't be able move to parent that doesn't exist
        $newparent = 999;

        $before = get_records_menu('org', 'frameworkid', '2', 'sortorder', 'id,sortorder');
        // this should fail
        $this->assertFalse($org->move_hierarchy_item($item, $newparent));
        $after = get_records_menu('org', 'frameworkid', '2', 'sortorder', 'id,sortorder');
        // everything stays the same
        $this->assertEqual($before, $after);


        // item must be an object
        $item = 1234;
        $newparent = 0;

        $before = get_records_menu('org', 'frameworkid', '2', 'sortorder', 'id,sortorder');
        // this should fail
        $this->assertFalse($org->move_hierarchy_item($item, $newparent));
        $after = get_records_menu('org', 'frameworkid', '2', 'sortorder', 'id,sortorder');
        // everything stays the same
        $this->assertEqual($before, $after);
    }
}

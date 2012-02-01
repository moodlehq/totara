<?php
/**
 * Unit tests for add_multiple_hierarchy_items()
 *
 * Testing hierarchy:
 *
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
 * We add two items in several places:
 * 1. To the root level
 * 2. Attached in the middle of hierarchy (to F)
 * 3. Attached to tip of hierarchy (to D)
 * 4. Attached to the end of the hierarchy (to J)
 *
 * @author Simon Coggins <simonc@catalyst.net.nz>
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot . '/hierarchy/lib.php');
require_once($CFG->dirroot . '/hierarchy/prefix/organisation/lib.php');
require_once($CFG->libdir . '/simpletestlib.php');

class bulkaddhierarchyitems_test extends prefix_changing_test_case {

    var $org_data = array(
        array('id', 'fullname', 'shortname', 'description', 'idnumber', 'frameworkid',
        'path', 'parentid', 'sortthread', 'depthlevel',
        'visible', 'timecreated', 'timemodified', 'usermodified', 'typeid'),
        array(1, 'Organisation A', 'Org A', 'Org Description A', 'OA', 1,
        '/1', 0, '01', 1,
        1, 1234567890, 1234567890, 2, null),
        array(2, 'Organisation B', 'Org B', 'Org Description B', 'OB', 1,
        '/1/2', 1, '01.01', 2,
        1, 1234567890, 1234567890, 2, null),
        array(3, 'Organisation C', 'Org C', 'Org Description C', 'OC', 1,
        '/1/2/3', 2, '01.01.01', 3,
        1, 1234567890, 1234567890, 2, null),
        array(4, 'Organisation D', 'Org D', 'Org Description D', 'OD', 1,
        '/1/2/4', 2, '01.01.02', 3,
        1, 1234567890, 1234567890, 2, null),
        array(5, 'Organisation E', 'Org E', 'Org Description E', 'OE', 1,
        '/5', 0, '02', 1,
        1, 1234567890, 1234567890, 2, null),
        array(6, 'Organisation F', 'Org F', 'Org Description F', 'OF', 1,
        '/5/6', 5, '02.01', 2,
        1, 1234567890, 1234567890, 2, null),
        array(7, 'Organisation G', 'Org G', 'Org Description G', 'OG', 1,
        '/5/6/7', 6, '02.01.01', 3,
        1, 1234567890, 1234567890, 2, null),
        array(8, 'Organisation H', 'Org H', 'Org Description H', 'OH', 1,
        '/5/6/8', 6, '02.01.02', 3,
        1, 1234567890, 1234567890, 2, null),
        array(9, 'Organisation I', 'Org I', 'Org Description I', 'OI', 1,
        '/5/6/8/9', 8, '02.01.02.01', 4,
        1, 1234567890, 1234567890, 2, null),
        array(10, 'Organisation J', 'Org J', 'Org Description J', 'OJ', 1,
        '/10', 0, '03', 1,
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

    // test adding to the top level of a hierarchy
    function test_add_multiple_hierarchy_items_to_root() {
        $org = new organisation();

        // test items to insert
        $item1 = new object();
        $item1->fullname = 'Item 1';
        $item1->shortname = 'I1';
        $item1->description= 'Description Item 1';
        $item1->typeid = 0;
        $item2 = new object();
        $item2->fullname = 'Item 2';
        $item2->shortname = 'I2';
        $item2->description= 'Description Item 2';
        $item2->typeid = 1;

        $items = array($item1, $item2);
        $parent = 0;

        // check items are added in the right place
        $before = get_records_menu('org', '', '', 'sortthread', 'id,sortthread');
        $this->assertTrue($org->add_multiple_hierarchy_items($parent, $items, 1, true, false));
        $after = get_records_menu('org', '', '', 'sortthread', 'id,sortthread');

        // new items should have been added to the end
        // all others should stay the same
        $before[11] = '04';
        $before[12] = '05';
        $this->assertEqual($before, $after);

        // get the items
        $this->assertTrue($item1 = get_record('org', 'id', 11));
        $this->assertTrue($item2 = get_record('org', 'id', 12));

        // check depthlevel set right
        $this->assertEqual($item1->depthlevel, 1);
        $this->assertEqual($item2->depthlevel, 1);

        // check path set right
        $this->assertEqual($item1->path, '/11');
        $this->assertEqual($item2->path, '/12');

        // check parentid set right
        $this->assertEqual($item1->parentid, 0);
        $this->assertEqual($item2->parentid, 0);

        // check the typeid set right
        $this->assertEqual($item1->typeid, 0);
        $this->assertEqual($item2->typeid, 1);
    }

    // test adding to an item in the middle of a hierarchy
    function test_add_multiple_hierarchy_items_to_branch() {
        $org = new organisation();

        // test items to insert
        $item1 = new object();
        $item1->fullname = 'Item 1';
        $item1->shortname = 'I1';
        $item1->description= 'Description Item 1';
        $item1->typeid = 0;
        $item2 = new object();
        $item2->fullname = 'Item 2';
        $item2->shortname = 'I2';
        $item2->description= 'Description Item 2';
        $item2->typeid = 1;

        $items = array($item1, $item2);
        $parent = 6;

        // check items are added in the right place
        $before = get_records_menu('org', '', '', 'sortthread', 'id,sortthread');
        $this->assertTrue($org->add_multiple_hierarchy_items($parent, $items, 1, true, false));
        $after = get_records_menu('org', '', '', 'sortthread', 'id,sortthread');

        // new items should have been inserted after parent's last child
        $before[11] = '02.01.03';
        $before[12] = '02.01.04';
        // all others should have stayed the same
        $this->assertEqual($before, $after);

        // get the items
        $this->assertTrue($item1 = get_record('org', 'id', 11));
        $this->assertTrue($item2 = get_record('org', 'id', 12));

        // check depthlevel set right
        $this->assertEqual($item1->depthlevel, 3);
        $this->assertEqual($item2->depthlevel, 3);

        // check path set right
        $this->assertEqual($item1->path, '/5/6/11');
        $this->assertEqual($item2->path, '/5/6/12');

        // check parentid set right
        $this->assertEqual($item1->parentid, 6);
        $this->assertEqual($item2->parentid, 6);

        // check the typeid set right
        $this->assertEqual($item1->typeid, 0);
        $this->assertEqual($item2->typeid, 1);
    }

    // test adding to an item at the tip of a hierarchy
    function test_add_multiple_hierarchy_items_to_leaf() {
        $org = new organisation();

        // test items to insert
        $item1 = new object();
        $item1->fullname = 'Item 1';
        $item1->shortname = 'I1';
        $item1->description= 'Description Item 1';
        $item1->typeid = 0;
        $item2 = new object();
        $item2->fullname = 'Item 2';
        $item2->shortname = 'I2';
        $item2->description= 'Description Item 2';
        $item2->typeid = 1;

        $items = array($item1, $item2);
        $parent = 4;

        // check items are added in the right place
        $before = get_records_menu('org', '', '', 'sortthread', 'id,sortthread');
        $this->assertTrue($org->add_multiple_hierarchy_items($parent, $items, 1, true, false));
        $after = get_records_menu('org', '', '', 'sortthread', 'id,sortthread');

        // new items should have been inserted directly after parent
        $before[11] = '01.01.02.01';
        $before[12] = '01.01.02.02';
        // all others should stay the same
        $this->assertEqual($before, $after);

        // get the items
        $this->assertTrue($item1 = get_record('org', 'id', 11));
        $this->assertTrue($item2 = get_record('org', 'id', 12));

        // check depthlevel set right
        $this->assertEqual($item1->depthlevel, 4);
        $this->assertEqual($item2->depthlevel, 4);

        // check path set right
        $this->assertEqual($item1->path, '/1/2/4/11');
        $this->assertEqual($item2->path, '/1/2/4/12');

        // check parentid set right
        $this->assertEqual($item1->parentid, 4);
        $this->assertEqual($item2->parentid, 4);

        // check the typeid set right
        $this->assertEqual($item1->typeid, 0);
        $this->assertEqual($item2->typeid, 1);
    }


    // test adding to the end of a hierarchy
    function test_add_multiple_hierarchy_items_to_end() {
        $org = new organisation();

        // test items to insert
        $item1 = new object();
        $item1->fullname = 'Item 1';
        $item1->shortname = 'I1';
        $item1->description= 'Description Item 1';
        $item1->typeid = 0;
        $item2 = new object();
        $item2->fullname = 'Item 2';
        $item2->shortname = 'I2';
        $item2->description= 'Description Item 2';
        $item2->typeid = 1;

        $items = array($item1, $item2);
        $parent = 10;

        // check items are added in the right place
        $before = get_records_menu('org', '', '', 'sortthread', 'id,sortthread');
        $this->assertTrue($org->add_multiple_hierarchy_items($parent, $items, 1, true, false));
        $after = get_records_menu('org', '', '', 'sortthread', 'id,sortthread');

        // new items should have been added to the end
        // all others should stay the same
        $before[11] = '03.01';
        $before[12] = '03.02';
        $this->assertEqual($before, $after);

        // get the items
        $this->assertTrue($item1 = get_record('org', 'id', 11));
        $this->assertTrue($item2 = get_record('org', 'id', 12));

        // check depthlevel set right
        $this->assertEqual($item1->depthlevel, 2);
        $this->assertEqual($item2->depthlevel, 2);

        // check path set right
        $this->assertEqual($item1->path, '/10/11');
        $this->assertEqual($item2->path, '/10/12');

        // check parentid set right
        $this->assertEqual($item1->parentid, 10);
        $this->assertEqual($item2->parentid, 10);

        // check the typeid set right
        $this->assertEqual($item1->typeid, 0);
        $this->assertEqual($item2->typeid, 1);
    }
}


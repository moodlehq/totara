<?php // $Id$
/*
**
 * Unit tests for hierarchy/lib.php
 *
 * @author Simon Coggins <simonc@catalyst.net.nz>
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot . '/hierarchy/lib.php');
require_once($CFG->dirroot . '/hierarchy/type/competency/lib.php');

require_once($CFG->libdir . '/simpletestlib.php');

class hierarchylib_test extends prefix_changing_test_case {
    // test data for database
    var $framework_data = array(
        array('id', 'fullname', 'shortname', 'idnumber','description','sortorder','visible',
            'hidecustomfields','showitemfullname','showdepthfullname','timecreated','timemodified','usermodified'),
        array(1, 'Framework 1', 'FW1', 'ID1','Description 1', 1, 1, 0, 1, 1, 1265963591, 1265963591, 2),
        array(2, 'Framework 2', 'FW2', 'ID2','Description 2', 2, 1, 0, 1, 1, 1265963591, 1265963591, 2),
    );

    var $depth_data = array(
        array('id', 'fullname', 'shortname', 'description', 'depthlevel', 'frameworkid', 'timecreated', 'timemodified',
            'usermodified'),
        array(1, 'Depth Level 1', 'Depth 1', 'Description 1', 1, 1, 1265963591, 1265963591, 2),
        array(2, 'Depth Level 2', 'Depth 2', 'Description 2', 2, 1, 1265963591, 1265963591, 2),
        array(3, 'F2 Depth Level 1', 'F2 Depth 1', 'F2 Description 1', 1, 2, 1265963591, 1265963591, 2),
    );

    var $competency_data = array(
        array('id', 'fullname', 'shortname', 'description', 'idnumber', 'frameworkid', 'path', 'depthid', 'parentid',
            'sortorder', 'visible', 'aggregationmethod', 'scaleid', 'proficencyexpected', 'evidencecount', 'timecreated',
            'timemodified', 'usermodified'),
        array(1, 'Competency 1', 'Comp 1', 'Competency Description 1', 'C1', 1, '/1', 1, 0, 1, 1, 1, -1, 1, 0,
            1265963591, 1265963591, 2),
        array(2, 'Competency 2', 'Comp 2', 'Competency Description 2', 'C2', 1, '/1/2', 2, 1, 2, 1, 1, -1, 1, 0,
            1265963591, 1265963591, 2),
        array(3, 'F2 Competency 1', 'F2 Comp 1', 'F2 Competency Description 1', 'F2 C1', 2, '/3', 3, 0, 1, 1, 1, -1, 1, 0,
            1265963591, 1265963591, 2),
        array(4, 'Competency 3', 'Comp 3', 'Competency Description 3', 'C3', 1, '/1/4', 2, 1, 3, 1, 1, -1, 1, 0,
            1265963591, 1265963591, 2),
        array(5, 'Competency 4', 'Comp 4', 'Competency Description 4', 'C4', 1, '/5', 1, 0, 4, 1, 1, -1, 1, 0,
            1265963591, 1265963591, 2),
    );

    var $depth_category_data = array(
        array('id', 'name', 'sortorder', 'depthid'),
        array(1, 'Custom Field Category 1', 1, 2),
    );

    var $depth_field_data = array(
        array('id', 'fullname', 'shortname', 'depthid', 'datatype', 'description', 'sortorder', 'categoryid', 'hidden',
            'locked', 'required', 'forceunique', 'defaultdata', 'param1', 'param2', 'param3', 'param4', 'param5'),
        array(1, 'Custom Field 1', 'CF1', 2, 'checkbox', 'Custom Field Description 1', 1, 1, 0, 0, 0, 0, 0, null, null,
            null, null, null),
    );

    var $depth_data_data = array(
        array('id', 'data', 'fieldid', 'competencyid'),
        array(1, 1, 1, 2),
    );

    var $dummy_data = array(
        array('id', 'competency', 'competencyid','competencycount','instanceid','templateid','id1','id2'),
        array(1, 1, 1, 1, 1, 1, 1, 2),
    );

    var $comp_scale_assignments_data = array(
        array('id', 'scaleid', 'frameworkid', 'timemodified', 'usermodified'),
        array(1,1,1,1,1),
    );

    function setUp() {
        global $db,$CFG;
        parent::setup();
        load_test_table($CFG->prefix . 'comp_framework', $this->framework_data, $db);
        load_test_table($CFG->prefix . 'comp_depth', $this->depth_data, $db);
        load_test_table($CFG->prefix . 'comp', $this->competency_data, $db);
        load_test_table($CFG->prefix . 'comp_depth_info_category', $this->depth_category_data, $db);
        load_test_table($CFG->prefix . 'comp_depth_info_field', $this->depth_field_data, $db);
        load_test_table($CFG->prefix . 'comp_depth_info_data', $this->depth_data_data, $db);
        load_test_table($CFG->prefix . 'idp_revision_competency', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'idp_competency_eval', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'comp_evidence', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'comp_evidence_items', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'comp_evidence_items_evidence', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'comp_template_competencies', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'comp_template', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'comp_template_assignment', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'pos_competencies', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'comp_relations', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'comp_scale_assignments', $this->comp_scale_assignments_data, $db);

        // create the competency object
        $this->competency = new competency();
        $this->competency->frameworkid = 1;
        // create 2nd competency object with no frameworkid specified
        $this->nofwid = new competency();

        // create some sample objects
        // framework
        $this->fw1 = new stdClass();
        $this->fw1->fullname = 'Framework 1';
        $this->fw1->shortname = 'FW1';
        $this->fw1->idnumber = 'ID1';
        $this->fw1->description = 'Description 1';
        $this->fw1->sortorder = '1';
        $this->fw1->visible = '1';
        $this->fw1->hidecustomfields = '0';
        $this->fw1->showitemfullname = '1';
        $this->fw1->showdepthfullname = '1';
        $this->fw1->timecreated = '1265963591';
        $this->fw1->timemodified = '1265963591';
        $this->fw1->usermodified = '2';
        $this->fw1->id = 1;
        // depth level
        $this->d1 = new stdClass();
        $this->d1->id = 1;
        $this->d1->fullname = 'Depth Level 1';
        $this->d1->shortname = 'Depth 1';
        $this->d1->description = 'Description 1';
        $this->d1->depthlevel = '1';
        $this->d1->frameworkid = '1';
        $this->d1->timecreated = '1265963591';
        $this->d1->timemodified = '1265963591';
        $this->d1->usermodified = '2';
        // competency
        $this->c1 = new stdClass();
        $this->c1->id = '1';
        $this->c1->fullname = 'Competency 1';
        $this->c1->shortname = 'Comp 1';
        $this->c1->description = 'Competency Description 1';
        $this->c1->idnumber = 'C1';
        $this->c1->frameworkid = '1';
        $this->c1->path = '/1';
        $this->c1->depthid = '1';
        $this->c1->parentid = '0';
        $this->c1->sortorder = '1';
        $this->c1->visible = '1';
        $this->c1->aggregationmethod = '1';
        $this->c1->scaleid = '-1';
        $this->c1->evidencecount = '0';
        $this->c1->proficencyexpected = '1';
        $this->c1->timecreated = '1265963591';
        $this->c1->timemodified = '1265963591';
        $this->c1->usermodified = '2';
        // another competency
        $this->c2 = new stdClass();
        $this->c2->id = '1';
        $this->c2->fullname = 'Competency 2';
        $this->c2->shortname = 'Comp 2';
        $this->c2->description = 'Competency Description 2';
        $this->c2->idnumber = 'C2';
        $this->c2->frameworkid = '1';
        $this->c2->path = '/1/2';
        $this->c2->depthid = '2';
        $this->c2->parentid = '1';
        $this->c2->sortorder = '2';
        $this->c2->visible = '1';
        $this->c2->aggregationmethod = '1';
        $this->c2->scaleid = '-1';
        $this->c2->evidencecount = '0';
        $this->c2->proficencyexpected = '1';
        $this->c2->timecreated = '1265963591';
        $this->c2->timemodified = '1265963591';
        $this->c2->usermodified = '2';
    }

    function tearDown() {
        global $db,$CFG;
        remove_test_table('mdl_unittest_comp_relations', $db);
        remove_test_table('mdl_unittest_pos_competencies', $db);
        remove_test_table('mdl_unittest_comp_template_assignment', $db);
        remove_test_table('mdl_unittest_comp_template', $db);
        remove_test_table('mdl_unittest_comp_template_competencies', $db);
        remove_test_table('mdl_unittest_comp_evidence_items_evidence', $db);
        remove_test_table('mdl_unittest_comp_evidence_items', $db);
        remove_test_table('mdl_unittest_comp_evidence', $db);
        remove_test_table('mdl_unittest_idp_competency_eval', $db);
        remove_test_table('mdl_unittest_idp_revision_competency', $db);
        remove_test_table('mdl_unittest_comp_depth_info_data', $db);
        remove_test_table('mdl_unittest_comp_depth_info_field', $db);
        remove_test_table('mdl_unittest_comp_depth_info_category', $db);
        remove_test_table('mdl_unittest_comp', $db);
        remove_test_table('mdl_unittest_comp_depth', $db);
        remove_test_table('mdl_unittest_comp_framework', $db);
        remove_test_table('mdl_unittest_comp_scale_assignments', $db);
        parent::tearDown();
    }

    function test_hierarchy_get_framework() {
        $competency = $this->competency;
        $fw1 = $this->fw1;

        // specifying id should get that framework
        $this->assertEqual($competency->get_framework(2)->fullname, 'Framework 2');
        // not specifying id should get first framework (by sort order)
        $this->assertEqual($competency->get_framework()->fullname,$fw1->fullname);
        // the framework returned should contain all the necessary fields
        $this->assertEqual($competency->get_framework(1), $fw1);
        // clear all frameworks
        delete_records('comp_framework');
        // if no frameworks exist should return false
        $this->assertFalse($competency->get_framework(0, true));
    }

    function test_hierarchy_get_depth_by_id() {
        $competency = $this->competency;
        $d1 = $this->d1;

        // the depth level returned should contain all the necessary fields
        $this->assertEqual($competency->get_depth_by_id(1), $d1);
        // the depth level with the correct id should be returned
        $this->assertEqual($competency->get_depth_by_id(2)->fullname, 'Depth Level 2');
        // false should be returned if the depth level doesn't exist
        $this->assertFalse($competency->get_depth_by_id(999));
    }

    function test_hierarchy_get_frameworks() {
        $competency = $this->competency;
        $fw1 = $this->fw1;
        // should return an array of frameworks
        $this->assertTrue(is_array($competency->get_frameworks()));
        // the array should include all frameworks
        $this->assertEqual(count($competency->get_frameworks()), 2);
        // each array element should contain a framework
        $this->assertEqual(current($competency->get_frameworks()), $fw1);
        // clear out the framework
        delete_records('comp_framework');
        // if no frameworks exist should return false
        $this->assertFalse($competency->get_frameworks());
    }

    function test_hierarchy_get_depths() {
        $competency = $this->competency;
        $d1 = $this->d1;
        // should return an array of depth levels
        $this->assertTrue(is_array($competency->get_depths()));
        // the array should include all depth levels (in this framework)
        $this->assertEqual(count($competency->get_depths()), 2);
        // each array element should contain a depth level
        $this->assertEqual(current($competency->get_depths()), $d1);
        // clear out the depth levels
        delete_records('comp_depth');
        // if no depth levels exist should return false
        $this->assertFalse($competency->get_depths());
    }

    function test_hierarchy_get_item() {
        $competency = $this->competency;
        $c1 = $this->c1;
        // the item returned should contain all the necessary fields
        $this->assertEqual($competency->get_item(1), $c1);
        // the item should match the id requested
        $this->assertEqual($competency->get_item(2)->fullname, 'Competency 2');
        // should return false if the item doesn't exist
        $this->assertFalse($competency->get_item(999));
    }

    function test_hierarchy_get_items() {
        $competency = $this->competency;
        $c1 = $this->c1;
        // should return an array of items
        $this->assertTrue(is_array($competency->get_items()));
        // the array should include all items
        $this->assertEqual(count($competency->get_items()), 4);
        // each array element should contain an item object
        $this->assertEqual(current($competency->get_items()), $c1);
        // clear out the items
        delete_records('comp');
        // if no items exist should return false
        $this->assertFalse($competency->get_items());
    }

    function test_hierarchy_get_items_by_parent() {
        $competency = $this->competency;
        $c1 = $this->c1;
        // should return an array of items belonging to specified parent
        $this->assertTrue(is_array($competency->get_items_by_parent(1)));
        // should return one element per item
        $this->assertEqual(count($competency->get_items_by_parent(1)), 2);
        // each array element should contain an item
        $this->assertEqual(current($competency->get_items_by_parent(1))->fullname, 'Competency 2');
        // if no parent specified should return root level items
        $this->assertEqual(current($competency->get_items_by_parent()), $c1);
        // clear out the items
        delete_records('comp');
        // if no items exist should return false for root items and parents
        $this->assertFalse($competency->get_items_by_parent());
        $this->assertFalse($competency->get_items_by_parent(1));
    }

    function test_hierarchy_get_all_root_items() {
        $competency = $this->competency;
        $nofwid = $this->nofwid;
        $c1 = $this->c1;
        // should return root items for framework where id specified
        $this->assertEqual(current($competency->get_all_root_items()), $c1);
        // should return all root items (cross framework) if no fwid given
        $this->assertEqual(count($nofwid->get_all_root_items()), 3);
        // should return all root items, even if fwid given, if $all set to true
        $this->assertEqual(count($competency->get_all_root_items(true)), 3);
        // clear out the items
        delete_records('comp');
        // if no items exist should return false
        $this->assertFalse($competency->get_all_root_items());
        $this->assertFalse($nofwid->get_all_root_items());
    }

    function test_hierarchy_get_item_descendants() {
        $competency = $this->competency;
        $c1 = $this->c1;
        $nofwid = $this->nofwid;

        // create an object of the expected format
        $obj = new StdClass();
        $obj->fullname = $c1->fullname;
        $obj->parentid = $c1->parentid;
        $obj->path = $c1->path;
        $obj->sortorder = $c1->sortorder;
        $obj->id = $c1->id;

        // should return an array of items
        $this->assertTrue(is_array($competency->get_item_descendants(1)));
        // array elements should match an expected format
        $this->assertEqual(current($competency->get_item_descendants(1)), $obj);
        // should return the item with the specified ID and all its descendants
        $this->assertEqual(count($competency->get_item_descendants(1)), 3);
        // should still return itself if an item has no descendants
        $this->assertEqual(count($competency->get_item_descendants(2)), 1);
        // should work the same for different frameworks
        $this->assertEqual(count($nofwid->get_item_descendants(3)), 1);
    }

    function test_hierarchy_get_item_adjacent_peer() {
        $competency = $this->competency;
        $c1 = $this->c1;
        $c2 = $this->c2;

        // if an adjacent peer exists, should return its id
        $this->assertEqual($competency->get_item_adjacent_peer($c2, false), 4);
        // should return false if no adjacent peer exists in the direction specified
        $this->assertFalse($competency->get_item_adjacent_peer($c2, true));
        $this->assertFalse($competency->get_item_adjacent_peer($c1, true));
        // should return false if item is not valid
        $this->assertFalse($competency->get_item_adjacent_peer(null));
    }

    function test_hierarchy_make_hierarchy_list() {
        $competency = $this->competency;
        $c1 = $this->c1;

        // standard list with default options
        $competency->make_hierarchy_list($list);
        // list with other options
        $competency->make_hierarchy_list($list2, null, true, true);

        // value should be fullname by default
        $this->assertEqual($list[1], $c1->fullname);
        // value should be shortname if required
        $this->assertEqual($list2[1], $c1->shortname);
        // should include all children unless specified
        $this->assertFalse(array_search('Comp 1 (and all children)', $list));
        // should include all children row if required
        $this->assertEqual(array_search('Comp 1 (and all children)', $list2),'1,2,4');

        // clear out the items
        delete_records('comp');
        // if no items exist should return false
        $competency->make_hierarchy_list($list3);
        // should return empty list if no items found
        $this->assertEqual($list3, array());
    }

    function test_hierarchy_get_item_lineage() {
        $competency = $this->competency;
        $c1 = $this->c1;
        $nofwid = $this->nofwid;

        // expected format of result
        $obj = new stdClass();
        $obj->fullname = $c1->fullname;
        $obj->parentid = $c1->parentid;
        $obj->depthlevel = get_field('comp_depth','depthlevel','id', $c1->depthid);
        $obj->id = (int) $c1->id;

        // should return an array of items
        $this->assertTrue(is_array($competency->get_item_lineage(2)));
        // array elements should match an expected format
        $this->assertEqual(current($competency->get_item_lineage(2)), $obj);
        // should return the item with the specified ID and all its parents
        $this->assertEqual(count($competency->get_item_lineage(2)), 2);
        // should still return itself if an item has no parents
        $this->assertEqual(count($competency->get_item_lineage(1)), 1);
        $this->assertEqual(current($competency->get_item_lineage(1))->fullname, 'Competency 1');
        // should work the same for different frameworks
        $this->assertEqual(count($nofwid->get_item_lineage(3)), 1);
        // NOTE function ignores fwid of current hierarchy object
        // not sure that this is correct behaviour
        $this->assertEqual(current($competency->get_item_lineage(3))->fullname, 'F2 Competency 1');
    }

    // skipped tests for the following display functions:
    // get_editing_button()
    // display_framework_selector()
    // display_add_item_button()
    // display_add_depth_button()
    // validate_sortorder() (not implemented at hierarchy level)

    function test_hierarchy_get_item_sortorder_offset() {
        $competency = $this->competency;
        $this->assertEqual($competency->get_item_sortorder_offset(), 1004);
    }

    function test_hierarchy_move_item() {
        $competency = $this->competency;
        $item1_before = get_field('comp','sortorder','id',4);
        $item2_before = get_field('comp','sortorder','id',2);
        // should return if item is successfully moved
        $this->assertTrue($competency->move_item(4, true));
        $item1_after = get_field('comp','sortorder','id',4);
        $item2_after = get_field('comp','sortorder','id',2);
        // adjacent items should have swapped sort order after move
        $this->assertEqual($item1_before, $item2_after);
        $this->assertEqual($item2_before, $item1_after);

        // sort orders before move
        $p_before = get_field('comp','sortorder', 'id', 1);
        $c1_before = get_field('comp','sortorder', 'id', 2);
        $c2_before = get_field('comp','sortorder', 'id', 4);
        $c1_diff_before = $c1_before - $p_before;
        $c2_diff_before = $c2_before - $p_before;

        // should be possible to swap items even if they have children
        $this->assertTrue($competency->move_item(1, false));

        // sort orders after move
        $p_after = get_field('comp','sortorder', 'id', 1);
        $c1_after = get_field('comp','sortorder', 'id', 2);
        $c2_after = get_field('comp','sortorder', 'id', 4);
        $c1_diff_after = $c1_after - $p_after;
        $c2_diff_after = $c2_after - $p_after;

        // the parent's and child's sort order should have changed
        $this->assertNotEqual($p_before, $p_after);
        $this->assertNotEqual($c1_before, $c1_after);
        $this->assertNotEqual($c2_before, $c2_after);

        // children's sort order should move the same amount as their parents
        $this->assertEqual($c1_diff_before, $c1_diff_after);
        $this->assertEqual($c2_diff_before, $c2_diff_after);
    }

    function test_hierarchy_hide_item() {
        $competency = $this->competency;
        $competency->hide_item(1);
        $visible = get_field('comp', 'visible', 'id', 1);
        // item should not be visible
        $this->assertEqual($visible, 0);
        // also test show item
        $competency->show_item(1);
        $visible = get_field('comp', 'visible', 'id', 1);
        // item should be visible again
        $this->assertEqual($visible, 1);
    }

    function test_hierarchy_hide_framework() {
        $competency = $this->competency;
        $competency->hide_framework(1);
        $visible = get_field('comp_framework', 'visible', 'id', 1);
        // framework should not be visible
        $this->assertEqual($visible, 0);
        // also test show framework
        $competency->show_framework(1);
        $visible = get_field('comp_framework', 'visible', 'id', 1);
        // framework should be visible again
        $this->assertEqual($visible, 1);
    }

    function test_hierarchy_framework_sortorder_offset() {
        $competency = $this->competency;
        $this->assertEqual($competency->get_framework_sortorder_offset(), 1002);
    }

    function test_hierarchy_move_framework() {
        $competency = $this->competency;
        $f1_before = get_field('comp_framework', 'sortorder', 'id', 1);
        $f2_before = get_field('comp_framework', 'sortorder', 'id', 2);
        // a successful move should return true
        $this->assertTrue($competency->move_framework(2, true));
        $f1_after = get_field('comp_framework', 'sortorder', 'id', 1);
        $f2_after = get_field('comp_framework', 'sortorder', 'id', 2);
        // frameworks should have swapped sort orders
        $this->assertEqual($f1_before, $f2_after);
        $this->assertEqual($f2_before, $f1_after);
        // a failed move should return false
        $this->assertFalse($competency->move_framework(2, true));
    }

    function test_hierarchy_delete_framework_item() {
        $competency = $this->competency;
        // function should return true
        $this->assertTrue($competency->delete_framework_item(1));
        // the item should have be deleted
        $this->assertFalse($competency->get_item(1));
        // the item's children should also have been deleted
        $this->assertFalse($competency->get_items_by_parent(1));
        // custom field data for items and children should also be deleted
        $this->assertFalse(get_records('comp_depth_info_data','competencyid', 2));
        // non descendants in same framework should not be deleted
        $this->assertEqual(count($competency->get_items()), 1);
    }

    function test_hierarchy_delete_framework() {
        $competency = $this->competency;
        // function should return null
        $this->assertEqual($competency->delete_framework(), null);
        // items should have been deleted
        $this->assertFalse($competency->get_items());
        // depth levels should have been deleted
        $this->assertFalse($competency->get_depths());
        // the framework should have been deleted
        $this->assertFalse(get_record('comp_framework', 'id', 1));
    }

    function test_hierarchy_is_safe_to_delete_depth() {
        $competency = $this->competency;
        $nofwid = $this->nofwid;
        // should return error if attempt to delete non-existant depth level
        $this->assertEqual($competency->is_safe_to_delete_depth(999),'deletedepthnosuchdepth');
        // should return error if attempt to delete depth level with children
        $this->assertEqual($competency->is_safe_to_delete_depth(1),'deletedepthhaschildren');

        // delete all items so depth levels don't have any children
        delete_records('comp');

        // should return error if attempt to delete depth level that isn't lowest in framework
        $this->assertEqual($competency->is_safe_to_delete_depth(1), 'deletedepthnotdeepest');
        // should return true if depth level is allowed to be deleted
        $this->assertTrue($competency->is_safe_to_delete_depth(2));
    }

    function test_hierarchy_delete_depth() {
        $competency = $this->competency;

        // delete all items to make deleting depth levels possible
        delete_records('comp');

        // shouldn't be able to delete depth level if it is not the lowest
        $this->assertEqual($competency->delete_depth(1),'deletedepthnotdeepest');
        $before = count($competency->get_depths());
        // should return true if depth level is deleted
        $this->assertTrue($competency->delete_depth(2));
        $after = count($competency->get_depths());
        // should have deleted the depth level
        $this->assertNotEqual($before, $after);
    }

    function test_hierarchy_delete_depth_metadata() {
        $competency = $this->competency;

        // function should return null
        $this->assertEqual($competency->delete_depth_metadata(2), null);
        // should have deleted all categories for the depth level
        $this->assertFalse(get_records('comp_depth_info_category', 'depthid', 2));
        // should have deleted all fields for the depth level
        $this->assertFalse(get_records('comp_depth_info_field', 'depthid', 2));

    }

    function test_hierarchy_get_item_data() {
        $competency = $this->competency;
        $c1 = $this->c1;
        // should return an array of info
        $this->assertTrue(is_array($competency->get_item_data($c1)));
        // if no params requested, should return default ones
        $this->assertEqual(count($competency->get_item_data($c1)), 5);
        // should return the correct number of fields requested
        $this->assertEqual(count($competency->get_item_data($c1, array('sortorder', 'description'))), 3);
        // should return the correct information based on fields requested
        $result = current($competency->get_item_data($c1, array('description')));
        $this->assertEqual($result['title'], 'Depth Level 1 description');
        $this->assertEqual($result['value'], 'Competency Description 1');
    }

    function test_hierarchy_get_max_depth() {
        $competency = $this->competency;
        $nofwid = $this->nofwid;
        $nofwid->frameworkid = 999;
        // should return the correct maximum depth level if there are depth levels
        $this->assertEqual($competency->get_max_depth(), 2);
        // should return null for framework with no depth levels
        $this->assertEqual($nofwid->get_max_depth(), null);
    }

    function test_hierarchy_get_all_parents() {
        $competency = $this->competency;
        $nofwid = $this->nofwid;
        // should return an array containing all items that have children
        // array should contain an item that has children
        $this->assertTrue(array_key_exists(1, $competency->get_all_parents()));
        // array should not contain an item if it does not have children
        $this->assertFalse(array_key_exists(2, $competency->get_all_parents()));
        // should work even if frameworkid not set
        $this->assertFalse(array_key_exists(3, $nofwid->get_all_parents()));

        // clear out all items
        delete_records('comp');
        // should return an empty array if no parents found
        $this->assertEqual($competency->get_all_parents(), array());
    }

    function test_get_short_prefix(){
        $shortprefix = hierarchy::get_short_prefix('competency');
        $this->assertEqual('comp', $shortprefix);
    }
}

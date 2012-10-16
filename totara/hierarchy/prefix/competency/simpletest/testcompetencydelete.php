<?php // $Id$
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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage hierarchy
 */

/**
 * Unit tests for delete_hierarchy_item()
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot . '/totara/hierarchy/lib.php');
require_once($CFG->dirroot . '/totara/hierarchy/prefix/competency/lib.php');
require_once($CFG->dirroot . '/admin/tool/unittest/simpletestlib.php');

class competencydelete_test extends UnitTestCaseUsingDatabase {
    // test data for database
    var $framework_data = array(
        array('id', 'fullname', 'shortname', 'idnumber','description','sortorder','visible',
            'hidecustomfields','timecreated','timemodified','usermodified'),
        array(1, 'Framework 1', 'FW1', 'ID1','Description 1', 1, 1, 0, 1265963591, 1265963591, 2),
    );

    var $competency_data = array(
        array('id', 'fullname', 'shortname', 'description', 'idnumber', 'frameworkid', 'path', 'depthlevel', 'typeid', 'parentid',
            'sortthread', 'visible', 'aggregationmethod', 'proficencyexpected', 'evidencecount', 'timecreated',
            'timemodified', 'usermodified', 'proficiencyexpected'),
        array(1, 'Competency 1', 'Comp 1', 'Competency Description 1', 'C1', 1, '/1', 1, 0, 0, '01', 1, 1, 1, 0,
            1265963591, 1265963591, 2, 1),
        array(2, 'Competency 2', 'Comp 2', 'Competency Description 2', 'C2', 1, '/1/2', 2, 0, 1, '01.01', 1, 1, 1, 0,
            1265963591, 1265963591, 2, 1),
        array(3, 'Competency 3', 'Comp 3', 'Competency Description 3', 'C3', 1, '/1/2/3', 3, 0, 2, '01.01.01', 1, 1, 1, 0,
            1265963591, 1265963591, 2, 1),
        array(4, 'Competency 4', 'Comp 4', 'Competency Description 4', 'C4', 1, '/1/2/4', 3, 0, 2, '01.01.02', 1, 1, 1, 0,
            1265963591, 1265963591, 2, 1),
        array(5, 'Competency 5', 'Comp 5', 'Competency Description 5', 'C5', 1, '/5', 1, 0, 0, '02', 1, 1, 1, 0,
            1265963591, 1265963591, 2, 1),
        array(6, 'Competency 6', 'Comp 6', 'Competency Description 6', 'C6', 1, '/5/6', 2, 0, 5, '02.01', 1, 1, 1, 0,
            1265963591, 1265963591, 2, 1),
        array(7, 'Competency 7', 'Comp 7', 'Competency Description 7', 'C7', 1, '/5/6/7', 3, 0, 6, '02.01.01', 1, 1, 1, 0,
            1265963591, 1265963591, 2, 1),
        array(8, 'Competency 8', 'Comp 8', 'Competency Description 8', 'C8', 1, '/5/6/8', 3, 0, 6, '02.01.02', 1, 1, 1, 0,
            1265963591, 1265963591, 2, 1),
        array(9, 'Competency 9', 'Comp 9', 'Competency Description 9', 'C9', 1, '/5/6/8/9', 4, 0, 8, '02.01.02.01', 1, 1, 1, 0,
            1265963591, 1265963591, 2, 1),
        array(10, 'Competency 10', 'Comp 10', 'Competency Description 10', 'C10', 1, '/10', 1, 0, 0, '03', 1, 1, 1, 0,
            1265963591, 1265963591, 2, 1),
    );

    var $template_data = array(
        array('id', 'frameworkid', 'fullname', 'shortname', 'description', 'visible', 'competencycount',
            'timecreated', 'timemodified', 'usermodified'),
        array(1, 1, 'Competency Template', 'CompTemp', 'Competency Template Description', 1, 3,
            1265963591, 1265963591, 2),
        array(2, 1, 'Competency Template 2', 'CompTemp2', 'Competency Template Description 2', 1, 1,
            1265963591, 1265963591, 2),
        array(2, 1, 'Competency Template 3', 'CompTemp3', 'Competency Template Description 3', 1, 1,
            1265963591, 1265963591, 2),
    );

    var $template_assignment_data = array(
        array('id', 'templateid', 'type', 'instanceid', 'timecreated', 'usermodified'),
        array(1, 1, 1, 1, 126596391, 2),
        array(2, 1, 1, 5, 126596391, 2),
        array(3, 1, 1, 6, 126596391, 2),
        array(4, 2, 1, 10, 126596391, 2),
    );

    var $type_data_data = array(
        array('id', 'data', 'fieldid', 'competencyid'),
        array(1, 1, 1, 2),
    );

    var $evidence_data = array(
        array('id', 'userid', 'competencyid', 'timecreated', 'timemodified', 'usermodified', 'iteminstance', 'itemid'),
        array(99999, 99999, 99999, 99999, 99999, 99999, 99999, 99999)
    );

    var $org_pos_data = array(
        array('positionid', 'organisationid', 'timecreated', 'usermodified'),
        array('99999', '99999', '99999', '99999')
    );

    var $dummy_data = array(
        array('id', 'planid', 'competencyid','id1','id2'),
        array(99999, 99999, 99999, 99999, 99999),
    );

    function load_test_table($table, $filelocation, array $data) {
        $this->create_test_table($table, $filelocation);
        $this->load_test_data($table, $data[0], array_slice($data, 1));
    }

    function setUp() {
        global $db,$CFG;
        parent::setup();
        $this->load_test_table('comp_framework', 'totara/hierarchy', $this->framework_data);
        $this->load_test_table('comp', 'totara/hierarchy', $this->competency_data);
        $this->load_test_table('comp_template', 'totara/hierarchy', $this->template_data);
        $this->load_test_table('comp_template_assignment', 'totara/hierarchy', $this->template_assignment_data);
        $this->load_test_table('comp_type_info_data', 'totara/hierarchy', $this->type_data_data);
        $this->load_test_table('comp_evidence', 'totara/hierarchy', $this->evidence_data);
        $this->load_test_table('comp_evidence_items', 'totara/hierarchy', $this->evidence_data);
        $this->load_test_table('comp_evidence_items_evidence', 'totara/hierarchy', $this->evidence_data);
        $this->load_test_table('comp_relations', 'totara/hierarchy', $this->dummy_data);
        $this->load_test_table('pos_competencies', 'totara/hierarchy', $this->org_pos_data);
        $this->load_test_table('org_competencies', 'totara/hierarchy', $this->org_pos_data);
        $this->load_test_table('dp_plan_competency_assign', 'totara/plan', $this->dummy_data);
        $this->switch_to_test_db();
    }

    function tearDown() {
        global $db,$CFG;
        $this->drop_test_table('dp_plan_competency_assign');
        $this->drop_test_table('org_competencies');
        $this->drop_test_table('pos_competencies');
        $this->drop_test_table('comp_relations');
        $this->drop_test_table('comp_evidence_items_evidence');
        $this->drop_test_table('comp_evidence_items');
        $this->drop_test_table('comp_evidence');
        $this->drop_test_table('comp_type_info_data');
        $this->drop_test_table('comp_template_assignment');
        $this->drop_test_table('comp_template');
        $this->drop_test_table('comp');
        $this->drop_test_table('comp_framework');
        $this->revert_to_real_db();
        parent::tearDown();
    }

/*
 * Testing hierarchy:
 *
 * 1
 * |_2
 * | |_3
 * | |_4
 * 5
 * |_6
 * | |_7
 * | |_8
 * |   |_9
 * 10
 *
 */
    function test_delete_competency_from_template() {
        $hierarchy = new competency();

        // removing 1 item from template 1 should leave 2 left
        $this->assertTrue($hierarchy->delete_hierarchy_item(1, false));
        $count = $this->testdb->get_field('comp_template', 'competencycount', array('id' => 1));
        $this->assertEqual($count, 2);

        // removing an item from a different template should have no effect
        // on a template's count
        $this->assertTrue($hierarchy->delete_hierarchy_item(6, false));
        $count = $this->testdb->get_field('comp_template', 'competencycount', array('id' => 2));
        $this->assertEqual($count, 1);

        // removing 1 item from template 2 should leave 0 left
        $this->assertTrue($hierarchy->delete_hierarchy_item(10, false));
        $count = $this->testdb->get_field('comp_template', 'competencycount', array('id' => 2));
        $this->assertEqual($count, 0);

    }

    function test_ordering_after_delete() {
        $hierarchy = new competency();

        $before = $this->testdb->get_records_menu('comp', null, 'sortthread', 'id,sortthread');
        $this->assertTrue($hierarchy->delete_hierarchy_item(1, false));
        $after = $this->testdb->get_records_menu('comp', null, 'sortthread', 'id,sortthread');

        // items 1-4 should have been deleted (all children of item 1)
        unset($before[1]);
        unset($before[2]);
        unset($before[3]);
        unset($before[4]);
        $this->assertEqual($before, $after);
    }

    function test_ordering_after_delete2() {
        $hierarchy = new competency();

        $before = $this->testdb->get_records_menu('comp', null, 'sortthread', 'id,sortthread');
        $this->assertTrue($hierarchy->delete_hierarchy_item(2, false));
        $after = $this->testdb->get_records_menu('comp', null, 'sortthread', 'id,sortthread');

        // items 2-4 should have been deleted (all children of item 2)
        unset($before[2]);
        unset($before[3]);
        unset($before[4]);
        $this->assertEqual($before, $after);
    }


    function test_ordering_after_delete3() {
        $hierarchy = new competency();

        $before = $this->testdb->get_records_menu('comp', null, 'sortthread', 'id,sortthread');
        $this->assertTrue($hierarchy->delete_hierarchy_item(9, false));
        $after = $this->testdb->get_records_menu('comp', null, 'sortthread', 'id,sortthread');

        // items 9 should have been deleted (no children)
        unset($before[9]);
        $this->assertEqual($before, $after);
    }


    function test_ordering_after_delete4() {
        $hierarchy = new competency();

        $before = $this->testdb->get_records_menu('comp', null, 'sortthread', 'id,sortthread');
        $this->assertTrue($hierarchy->delete_hierarchy_item(10, false));
        $after = $this->testdb->get_records_menu('comp', null, 'sortthread', 'id,sortthread');

        // items 10 should have been deleted (no children)
        unset($before[10]);
        // no sort changes expected
        $this->assertEqual($before, $after);
    }

}

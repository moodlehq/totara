<?php // $Id$
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
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
 * Unit tests for delete_framework_item()
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot . '/hierarchy/lib.php');
require_once($CFG->dirroot . '/hierarchy/prefix/competency/lib.php');

require_once($CFG->libdir . '/simpletestlib.php');

class competencydelete_test extends prefix_changing_test_case {
    // test data for database
    var $framework_data = array(
        array('id', 'fullname', 'shortname', 'idnumber','description','sortorder','visible',
            'hidecustomfields','timecreated','timemodified','usermodified'),
        array(1, 'Framework 1', 'FW1', 'ID1','Description 1', 1, 1, 0, 1265963591, 1265963591, 2),
    );

    var $competency_data = array(
        array('id', 'fullname', 'shortname', 'description', 'idnumber', 'frameworkid', 'path', 'depthlevel', 'typeid', 'parentid',
            'sortorder', 'visible', 'aggregationmethod', 'proficencyexpected', 'evidencecount', 'timecreated',
            'timemodified', 'usermodified'),
        array(1, 'Competency 1', 'Comp 1', 'Competency Description 1', 'C1', 1, '/1', 1, 0, 0, 1, 1, 1, 1, 0,
            1265963591, 1265963591, 2),
        array(2, 'Competency 2', 'Comp 2', 'Competency Description 2', 'C2', 1, '/1/2', 2, 0, 1, 2, 1, 1, 1, 0,
            1265963591, 1265963591, 2),
        array(3, 'Competency 3', 'Comp 3', 'Competency Description 3', 'C3', 1, '/1/2/3', 3, 0, 2, 3, 1, 1, 1, 0,
            1265963591, 1265963591, 2),
        array(4, 'Competency 4', 'Comp 4', 'Competency Description 4', 'C4', 1, '/1/2/4', 3, 0, 2, 4, 1, 1, 1, 0,
            1265963591, 1265963591, 2),
        array(5, 'Competency 5', 'Comp 5', 'Competency Description 5', 'C5', 1, '/5', 1, 0, 0, 5, 1, 1, 1, 0,
            1265963591, 1265963591, 2),
        array(6, 'Competency 6', 'Comp 6', 'Competency Description 6', 'C6', 1, '/5/6', 2, 0, 5, 6, 1, 1, 1, 0,
            1265963591, 1265963591, 2),
        array(7, 'Competency 7', 'Comp 7', 'Competency Description 7', 'C7', 1, '/5/6/7', 3, 0, 6, 7, 1, 1, 1, 0,
            1265963591, 1265963591, 2),
        array(8, 'Competency 8', 'Comp 8', 'Competency Description 8', 'C8', 1, '/5/6/8', 3, 0, 6, 8, 1, 1, 1, 0,
            1265963591, 1265963591, 2),
        array(9, 'Competency 9', 'Comp 9', 'Competency Description 9', 'C9', 1, '/5/6/8/9', 4, 0, 8, 9, 1, 1, 1, 0,
            1265963591, 1265963591, 2),
        array(10, 'Competency 10', 'Comp 10', 'Competency Description 10', 'C10', 1, '/10', 1, 0, 0, 10, 1, 1, 1, 0,
            1265963591, 1265963591, 2),
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

    var $dummy_data = array(
        array('id', 'competencyid','id1','id2'),
        array(99999, 99999, 99999, 99999),
    );

    function setUp() {
        global $db,$CFG;
        parent::setup();
        load_test_table($CFG->prefix . 'comp_framework', $this->framework_data, $db);
        load_test_table($CFG->prefix . 'comp', $this->competency_data, $db);
        load_test_table($CFG->prefix . 'comp_template', $this->template_data, $db);
        load_test_table($CFG->prefix . 'comp_template_assignment', $this->template_assignment_data, $db);
        load_test_table($CFG->prefix . 'comp_type_info_data', $this->type_data_data, $db);
        load_test_table($CFG->prefix . 'comp_evidence', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'comp_evidence_items', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'comp_evidence_items_evidence', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'comp_relations', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'pos_competencies', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'org_competencies', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'dp_plan_competency_assign', $this->dummy_data, $db);
    }

    function tearDown() {
        global $db,$CFG;
        remove_test_table($CFG->prefix . 'dp_plan_competency_assign', $db);
        remove_test_table($CFG->prefix . 'org_competencies', $db);
        remove_test_table($CFG->prefix . 'pos_competencies', $db);
        remove_test_table($CFG->prefix . 'comp_relations', $db);
        remove_test_table($CFG->prefix . 'comp_evidence_items_evidence', $db);
        remove_test_table($CFG->prefix . 'comp_evidence_items', $db);
        remove_test_table($CFG->prefix . 'comp_evidence', $db);
        remove_test_table($CFG->prefix . 'comp_type_info_data', $db);
        remove_test_table($CFG->prefix . 'comp_template_assignment', $db);
        remove_test_table($CFG->prefix . 'comp_template', $db);
        remove_test_table($CFG->prefix . 'comp', $db);
        remove_test_table($CFG->prefix . 'comp_framework', $db);
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
        $this->assertTrue($hierarchy->delete_framework_item(1));
        $count = get_field('comp_template', 'competencycount', 'id', 1);
        $this->assertEqual($count, 2);

        // removing an item from a different template should have no effect
        // on a template's count
        $this->assertTrue($hierarchy->delete_framework_item(6));
        $count = get_field('comp_template', 'competencycount', 'id', 2);
        $this->assertEqual($count, 1);

        // removing 1 item from template 2 should leave 0 left
        $this->assertTrue($hierarchy->delete_framework_item(10));
        $count = get_field('comp_template', 'competencycount', 'id', 2);
        $this->assertEqual($count, 0);

    }

    function test_ordering_after_delete() {
        $hierarchy = new competency();

        $before = get_records_menu('comp', '', '', 'sortorder', 'id,sortorder');
        $this->assertTrue($hierarchy->delete_framework_item(1));
        $after = get_records_menu('comp', '', '', 'sortorder', 'id,sortorder');

        // items 1-4 should have been deleted (all children of item 1)
        unset($before[1]);
        unset($before[2]);
        unset($before[3]);
        unset($before[4]);
        // items 5-10 should now be sorted as 1-6
        $before[5] = 1;
        $before[6] = 2;
        $before[7] = 3;
        $before[8] = 4;
        $before[9] = 5;
        $before[10] = 6;
        $this->assertEqual($before, $after);
    }

    function test_ordering_after_delete2() {
        $hierarchy = new competency();

        $before = get_records_menu('comp', '', '', 'sortorder', 'id,sortorder');
        $this->assertTrue($hierarchy->delete_framework_item(2));
        $after = get_records_menu('comp', '', '', 'sortorder', 'id,sortorder');

        // items 2-4 should have been deleted (all children of item 2)
        unset($before[2]);
        unset($before[3]);
        unset($before[4]);
        // items 5-10 should now be sorted as 2-7
        $before[5] = 2;
        $before[6] = 3;
        $before[7] = 4;
        $before[8] = 5;
        $before[9] = 6;
        $before[10] = 7;
        $this->assertEqual($before, $after);
    }


    function test_ordering_after_delete3() {
        $hierarchy = new competency();

        $before = get_records_menu('comp', '', '', 'sortorder', 'id,sortorder');
        $this->assertTrue($hierarchy->delete_framework_item(9));
        $after = get_records_menu('comp', '', '', 'sortorder', 'id,sortorder');

        // items 9 should have been deleted (no children)
        unset($before[9]);
        // item 10 should still have moved up one
        $before[10] = 9;
        $this->assertEqual($before, $after);
    }


    function test_ordering_after_delete4() {
        $hierarchy = new competency();

        $before = get_records_menu('comp', '', '', 'sortorder', 'id,sortorder');
        $this->assertTrue($hierarchy->delete_framework_item(10));
        $after = get_records_menu('comp', '', '', 'sortorder', 'id,sortorder');

        // items 10 should have been deleted (no children)
        unset($before[10]);
        // last item so no sort changes expected
        $this->assertEqual($before, $after);
    }

}

<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2013 Totara Learning Solutions LTD
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
 * @subpackage appraisal
 *
 * Unit tests for totara/appraisal/lib.php
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); //  It must be included from a Moodle page.
}

global $CFG;
require_once($CFG->dirroot . '/totara/core/tests/mockery_advanced_testcase.php');
require_once($CFG->dirroot . '/totara/appraisal/lib.php');

use \Mockery as m;

class appraisallib_test extends /*mockery_*/advanced_testcase {

    /**
     * Prepare test case appraisal, stages, pages, questions according given array
     *
     * @param array $definition
     * @return appraisal
     */
    protected function prepare_test_case(array $definition) {
        return appraisal::build($definition);
    }

    /**
     * NOTE: This is not a good example, because we are not actually
     * testing anything, since the function just returns the result
     * from the DB call. However it does show how you can mock a database
     * call inside another function to allow you to test the function
     * without having to create db records.
     */
    public function skip_test_get_role_assignment() {
        global $DB;
        $appraisal = new appraisal();

        $return1 = (object)array(
            'id' => 1,
            'appraisaluserassignmentid' => 2,
            'userid' => 3,
            'appraisalrole' => 4,
            'activepageid' => 5,
            'subjectid' => 6
        );
        $DB->shouldReceive('get_record_sql')->once()->andReturn($return1);
        $this->assertEquals($appraisal->get_role_assignment(6, 3, 4), $return1);

        $return2 = (object)array(
            'id' => 0,
            'appraisaluserassignmentid' => 0,
            'userid' => 3,
            'appraisalrole' => 4,
            'activepageid' => 0,
            'subjectid' => 6

        );
        $this->assertEquals($appraisal->get_role_assignment(6, 3, 4, true), $return2);
    }


    public function skip_test_set_status() {
        $appraisal = m::mock('appraisal')->makePartial();
        $appraisal->shouldReceive('save');

        $this->setExpectedException('appraisal_exception');
        $appraisal->set_status($appraisal::STATUS_CLOSED);

        $appraisal->set_status($appraisal::STATUS_ACTIVE);
        $this->assertNull($appraisal->timefinished);

        $appraisal->set_status($appraisal::STATUS_COMPLETED);
        $this->assertNotNull($appraisal->timefinished);
    }

    public function test_appraisal_create() {
        $this->resetAfterTest();
        $appraisal = new appraisal();
        $data = new stdClass();
        $data->name = 'Appraisal 1';
        $data->description = 'description';
        $appraisal->set($data);
        $appraisal->save();
        $id = $appraisal->id;
        unset($appraisal);

        $check = new appraisal($id);
        $this->assertEquals($check->id, $id);
        $this->assertEquals($check->name, 'Appraisal 1');
        $this->assertEquals($check->description, 'description');
    }

    public function test_appraisal_edit() {
        $this->resetAfterTest();
        $def = array('name' => 'Appraisal', 'description' => 'Description');
        $appraisal = $this->prepare_test_case($def);

        $this->assertEquals($appraisal->name, 'Appraisal');
        $this->assertEquals($appraisal->description, 'Description');

        $data = new stdClass();
        $data->name = 'New Appraisal';
        $data->description = 'New Description';
        $appraisal->set($data)->save();
        $check = new appraisal($appraisal->id);
        unset($appraisal);
        $this->assertEquals($check->name, $data->name);
        $this->assertEquals($check->description, $data->description);
    }

    public function test_appraisal_delete() {
        $this->markTestIncomplete();
    }

    public function test_appraisal_duplicate() {
        $this->markTestIncomplete();
    }

    public function test_appraisal_activate() {
        // Need user generation and assignement via org or pos or cohort (any of them as we test activate, not assignments).
        $this->markTestIncomplete();
    }

    public function test_appraisal_validate() {
        // Need user generation and assignement via org or pos or cohort (any of them as we test validation, not assignments).
        // Different fail scenarios of validation.
        $this->markTestIncomplete();
    }

    public function test_appraisal_answers() {
        // Need Activation.
        // Check setting and getting answers.
        $this->markTestIncomplete();
    }

    public function test_appraisal_complete_user() {
        $this->markTestIncomplete();
    }

    public function test_appraisal_complete() {
        $this->markTestIncomplete();
    }

    public function test_appraisal_role_involved() {
        $this->markTestIncomplete();
    }

    public function test_appraisal_has_appraisal() {
        $this->markTestIncomplete();
    }

    public function test_stage_add() {
        $this->markTestIncomplete();
    }

    public function test_stage_edit() {
        $this->markTestIncomplete();
    }

    public function test_stage_delete() {
        $this->markTestIncomplete();
    }

    public function test_stage_duplicate() {
        $this->markTestIncomplete();
    }

    public function test_stage_locks() {
        // Needs activation and completion.
        // Check that stage is locked or not locked for appropriate roles after completion.
        $this->markTestIncomplete();
    }

    public function test_stage_complete_role() {
        $this->markTestIncomplete();
    }

    public function test_stage_complete_user() {
        $this->markTestIncomplete();
    }

    public function test_stage_complete() {
        $this->markTestIncomplete();
    }

    public function test_stage_is_complete() {
        $this->markTestIncomplete();
    }

    public function test_stage_user_completion() {
        $this->markTestIncomplete();
    }

    public function test_stage_get_active() {
        $this->markTestIncomplete();
    }

    public function test_stage_get_list() {
        $this->markTestIncomplete();
    }

    public function test_stage_get_stages_for_roles() {
        $this->markTestIncomplete();
    }

    public function test_stage_fetch_appraisal() {
        $this->markTestIncomplete();
    }

    public function test_stage_is_locked() {
        $this->markTestIncomplete();
    }

    public function test_stage_is_overdue() {
        $this->markTestIncomplete();
    }

    public function test_stage_get_must_answer() {
        $this->markTestIncomplete();
    }

    public function test_page_add() {
        $this->markTestIncomplete();
    }

    public function test_page_edit() {
        $this->markTestIncomplete();
    }

    public function test_page_delete() {
        $this->markTestIncomplete();
    }

    public function test_page_reorder() {
        $this->markTestIncomplete();
    }

    public function test_page_move() {
        $this->markTestIncomplete();
    }

    public function test_page_duplicate() {
        $this->markTestIncomplete();
    }

    public function test_page_answer() {
        $this->markTestIncomplete();
    }

    public function test_page_complete_role() {
        $this->markTestIncomplete();
    }

    public function test_page_get_pages_for_role() {
        $this->markTestIncomplete();
    }

    public function test_question_create() {
        $this->markTestIncomplete();
    }

    public function test_question_edit() {
        $this->markTestIncomplete();
    }

    public function test_question_delete() {
        $this->markTestIncomplete();
    }

    public function test_question_duplicate() {
        $this->markTestIncomplete();
    }

    public function test_question_reorder() {
        $this->markTestIncomplete();
    }

    public function test_question_element() {
        $this->markTestIncomplete();
    }

    public function test_question_fetch_page_role() {
        $this->markTestIncomplete();
    }

    public function test_question_fetch_appraisal() {
        $this->markTestIncomplete();
    }

    public function test_question_get_list() {
        $this->markTestIncomplete();
    }
}

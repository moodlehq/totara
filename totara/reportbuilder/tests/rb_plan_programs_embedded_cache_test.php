<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2013 Totara Learning Solutions LTD
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
 * @author Valerii Kuznetsov <valerii.kuznetsov@totaralms.com>
 * @package totara
 * @subpackage reportbuilder
 *
 * Unit/functional tests to check Record of Learning: Programs reports caching
 */
if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}
global $CFG;
require_once($CFG->dirroot . '/totara/reportbuilder/tests/reportcache_advanced_testcase.php');
require_once($CFG->dirroot . '/totara/program/program_assignments.class.php');

class rb_plan_programs_embedded_cache_test extends reportcache_advanced_testcase {
    // testcase data
    protected $report_builder_data = array('id' => 13, 'fullname' => 'Record of Learning: Programs', 'shortname' => 'plan_programs',
                                           'source' => 'dp_program', 'hidden' => 1, 'embedded' => 1);


    protected $report_builder_columns_data = array(
                        array('id' => 61, 'reportid' => 13, 'type' => 'program', 'value' => 'proglinkicon',
                              'heading' => 'A', 'sortorder' => 1),
                        array('id' => 62, 'reportid' => 13, 'type' => 'program', 'value' => 'mandatory',
                              'heading' => 'B', 'sortorder' => 2),
                        array('id' => 63, 'reportid' => 13, 'type' => 'program', 'value' => 'recurring',
                              'heading' => 'C', 'sortorder' => 3),
                        array('id' => 64, 'reportid' => 13, 'type' => 'program', 'value' => 'timedue',
                              'heading' => 'D', 'sortorder' => 4),
                        array('id' => 65, 'reportid' => 13, 'type' => 'program_completion', 'value' => 'status',
                              'heading' => 'E', 'sortorder' => 5));

    protected $report_builder_filters_data = array(
                        array('id' => 29, 'reportid' => 13, 'type' => 'program', 'value' => 'fullname',
                              'sortorder' => 2, 'advanced' => 1),
                        array('id' => 30, 'reportid' => 13, 'type' => 'course_category', 'value' => 'id',
                              'sortorder' => 3, 'advanced' => 1));

    // Work data
    protected $user1 = null;
    protected $user2 = null;
    protected $user3 = null;
    protected $program1 = null;
    protected $program2 = null;
    protected $program3 = null;
    protected $program4 = null;

    /**
     * Prepare mock data for testing
     *
     * Common part of all test cases:
     * - Add 3 users
     * - Create 4 programs
     * - Enrol user1 to program1,3
     * - Enrol user2 to program2,3,4
     * - User3 is not added to any programs
     *
     */
    protected function setUp() {
        parent::setup();
        $this->resetAfterTest(false);
        $this->preventResetByRollback();
        $this->cleanup();

        $this->getDataGenerator()->reset();
        // Common parts of test cases:
        // Create report record in database
        $this->loadDataSet($this->createArrayDataSet(array('report_builder' => array($this->report_builder_data),
                                                           'report_builder_columns' => $this->report_builder_columns_data,
                                                           'report_builder_filters' => $this->report_builder_filters_data)));
        $this->user1 = $this->getDataGenerator()->create_user();
        $this->user2 = $this->getDataGenerator()->create_user();
        $this->user3 = $this->getDataGenerator()->create_user();

        $this->program1 = $this->getDataGenerator()->create_program();
        $this->program2 = $this->getDataGenerator()->create_program();
        $this->program3 = $this->getDataGenerator()->create_program();
        $this->program4 = $this->getDataGenerator()->create_program();

        $this->getDataGenerator()->assign_program($this->program1->id, array($this->user1->id));
        $this->assertDebuggingCalled();
        $this->getDataGenerator()->assign_program($this->program2->id, array($this->user2->id));
        $this->assertDebuggingCalled();
        $this->getDataGenerator()->assign_program($this->program3->id, array($this->user1->id, $this->user2->id));
        $this->assertDebuggingCalled(null, null, '', 2);
        $this->getDataGenerator()->assign_program($this->program4->id, array($this->user2->id));
        $this->assertDebuggingCalled(); // Caused by sending of message.
    }

    protected function tearDown() {
        global $DB;
        $DB->execute('DELETE FROM {user} WHERE id='.$this->user1->id);
        $DB->execute('DELETE FROM {user} WHERE id='.$this->user2->id);
        $DB->execute('DELETE FROM {user} WHERE id='.$this->user3->id);
        $this->cleanup();
    }

    protected function cleanup() {
        global $DB;
        $DB->execute('DELETE FROM {report_builder} WHERE 1=1');
        $DB->execute('DELETE FROM {report_builder_columns} WHERE 1=1');
        $DB->execute('DELETE FROM {report_builder_filters} WHERE 1=1');
        $DB->execute('DELETE FROM {prog_assignment} WHERE 1=1');
        $DB->execute('DELETE FROM {prog_user_assignment} WHERE 1=1');
        $DB->execute('DELETE FROM {prog_completion} WHERE 1=1');
        $DB->execute('DELETE FROM {prog} WHERE 1=1');
    }

    /**
     * Test courses report
     * Test case:
     * - Common part (@see: self::setUp() )
     * - Check that user1 has two courses (1 and 3)
     * - Check that user2 has three course (2,3,4)
     * - Check that user3 doesn't have any courses
     *
     * @param int Use cache or not (1/0)
     * @dataProvider provider_use_cache
     */
    public function test_plan_programs($usecache) {
        $this->resetAfterTest(false);
        $this->preventResetByRollback();
        if ($usecache) {
            $this->enable_caching($this->report_builder_data['id']);
        }
        $result = $this->get_report_result($this->report_builder_data['shortname'], array('userid' => $this->user1->id,), $usecache);
        $this->assertCount(2, $result);
        $was = array();
        foreach($result as $r) {
            $this->assertContains($r->program_id, array($this->program1->id, $this->program3->id));
            $this->assertNotContains($r->program_proglinkicon, $was);
            $was[] = $r->program_proglinkicon;
        }

        $result = $this->get_report_result($this->report_builder_data['shortname'], array('userid' => $this->user2->id,), $usecache);
        $this->assertCount(3, $result);
        $was = array();
        foreach($result as $r) {
            $this->assertContains($r->program_id, array($this->program2->id, $this->program3->id, $this->program4->id));
            $this->assertNotContains($r->program_proglinkicon, $was);
            $was[] = $r->program_proglinkicon;
        }

        $result = $this->get_report_result($this->report_builder_data['shortname'], array('userid' => $this->user3->id,), $usecache);
        $this->assertCount(0, $result);
    }
}
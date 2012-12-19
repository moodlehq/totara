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
 * Unit/functional tests to check Record of Learning: Recurring programs reports caching
 */
if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}
global $CFG;
require_once($CFG->dirroot . '/totara/reportbuilder/tests/reportcache_advanced_testcase.php');

class rb_plan_programs_recurring_embedded_cache_test extends reportcache_advanced_testcase {
    // testcase data
    protected $report_builder_data = array('id' => 14, 'fullname' => 'Record of Learning: Recurring programs', 'shortname' => 'plan_programs_recurring',
                                           'source' => 'dp_program_recurring', 'hidden' => 1, 'embedded' => 1);

    protected $report_builder_columns_data = array(
                        array('id' => 66, 'reportid' => 14, 'type' => 'program_completion_history', 'value' => 'courselink',
                              'heading' => 'A', 'sortorder' => 1),
                        array('id' => 67, 'reportid' => 14, 'type' => 'program_completion_history', 'value' => 'status',
                              'heading' => 'B', 'sortorder' => 2),
                        array('id' => 68, 'reportid' => 14, 'type' => 'program_completion_history', 'value' => 'timecompleted',
                              'heading' => 'C', 'sortorder' => 3));

    // Work data
    protected $user1 = null;
    protected $user2 = null;
    protected $user3 = null;
    protected $program1 = null;
    protected $program2 = null;
    protected $course1 = null;
    protected $course2 = null;


    /**
     * Prepare mock data for testing
     *
     * Common part of all test cases:
     * - Add 3 users
     * - Add 2 courses
     * - Add 2 programs
     * - Add user1 to program1
     * - Add user2 to program1 and program2
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
                                                           'report_builder_columns' => $this->report_builder_columns_data)));
        $this->user1 = $this->getDataGenerator()->create_user();
        $this->user2 = $this->getDataGenerator()->create_user();
        $this->user3 = $this->getDataGenerator()->create_user();

        $this->program1 = $this->getDataGenerator()->create_program();
        $this->program2 = $this->getDataGenerator()->create_program();

        $this->getDataGenerator()->assign_program($this->program1->id, array($this->user1->id, $this->user1->id));
        $this->assertDebuggingCalled();
        $this->getDataGenerator()->assign_program($this->program2->id, array($this->user2->id));
        $this->assertDebuggingCalled();

        $this->course1 = $this->getDataGenerator()->create_course();
        $this->course2 = $this->getDataGenerator()->create_course();

        $this->create_recurring_program($this->program1->id, $this->user1->id, $this->course1->id);
        $this->create_recurring_program($this->program1->id, $this->user2->id, $this->course1->id);
        $this->create_recurring_program($this->program2->id, $this->user2->id, $this->course2->id);

        //No need to enroll users to courses and add courses to program as report doesn't check this.
        //However, it might be needed in future
    }

    protected function tearDown() {
        global $DB;
        $DB->execute('DELETE FROM {user} WHERE id='.$this->user1->id);
        $DB->execute('DELETE FROM {user} WHERE id='.$this->user2->id);
        $DB->execute('DELETE FROM {course} WHERE id='.$this->course1->id);
        $DB->execute('DELETE FROM {course} WHERE id='.$this->course2->id);
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
        $DB->execute('DELETE FROM {prog_completion_history} WHERE 1=1');
    }

    /**
     * Test courses report
     * Test case:
     * - Common part (@see: self::setUp() )
     * - Check that user1 has recurring program1
     * - Check that user2 has recurring program1 and program2
     * - Check that user3 has no recurring programs
     *
     * @param int Use cache or not (1/0)
     * @dataProvider provider_use_cache
     */
    public function test_plan_programs_reccuring($usecache) {
        $this->resetAfterTest(false);
        $this->preventResetByRollback();
        if ($usecache) {
            $this->enable_caching($this->report_builder_data['id']);
        }
        $result = $this->get_report_result($this->report_builder_data['shortname'],
                array('userid' => $this->user1->id), $usecache);
        $this->assertCount(1, $result);
        $res = array_shift($result);
        $this->assertContains($res->program_completion_history_courselink, array($this->course1->id));

        $result = $this->get_report_result($this->report_builder_data['shortname'],
                array('userid' => $this->user2->id), $usecache);
        $this->assertCount(2, $result);
        $was = array('');
        foreach($result as $res) {
            $this->assertContains($res->program_completion_history_courselink, array($this->course1->id, $this->course2->id));
            $this->assertNotContains($res->programid, $was);
            $was[] = $res->programid;
        }

        $result = $this->get_report_result($this->report_builder_data['shortname'],
                array('userid' => $this->user3->id), $usecache);
        $this->assertCount(0, $result);

    }

    /**
     * Create mock recurring program
     *
     * @param int $programid Program id
     * @param int $userid User id
     * @param int $courseid Course id
     */
    public function create_recurring_program($programid, $userid, $courseid) {
        global $DB;
        $todb = new stdClass();
        $todb->programid = $programid;
        $todb->userid = $userid;
        $todb->coursesetid = 0;
        $todb->status = 0;
        $todb->recurringcourseid = $courseid;

        $DB->insert_record('prog_completion_history', $todb);
    }
}
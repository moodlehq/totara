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
 * Unit/functional tests to check Record of Learning: Objectives reports caching
 */
if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}
global $CFG;
require_once($CFG->dirroot . '/totara/reportbuilder/tests/reportcache_advanced_testcase.php');


class rb_plan_objectives_embedded_cache_test extends reportcache_advanced_testcase {
    // testcase data
    protected $report_builder_data = array('id' => 12, 'fullname' => 'Record of Learning: Objectives', 'shortname' => 'plan_objectives',
                                           'source' => 'dp_objective', 'hidden' => 1, 'embedded' => 1);

    protected $report_builder_columns_data = array(
                        array('id' => 54, 'reportid' => 12, 'type' => 'plan', 'value' => 'planlink',
                              'heading' => 'A', 'sortorder' => 1),
                        array('id' => 55, 'reportid' => 12, 'type' => 'plan', 'value' => 'status',
                              'heading' => 'B', 'sortorder' => 2),
                        array('id' => 56, 'reportid' => 12, 'type' => 'objective', 'value' => 'fullnamelink',
                              'heading' => 'C', 'sortorder' => 3),
                        array('id' => 57, 'reportid' => 12, 'type' => 'objective', 'value' => 'description',
                              'heading' => 'D', 'sortorder' => 4),
                        array('id' => 58, 'reportid' => 12, 'type' => 'objective', 'value' => 'priority',
                              'heading' => 'E', 'sortorder' => 5),
                        array('id' => 59, 'reportid' => 12, 'type' => 'objective', 'value' => 'duedate',
                              'heading' => 'F', 'sortorder' => 6),
                        array('id' => 60, 'reportid' => 12, 'type' => 'objective', 'value' => 'proficiencyandapproval',
                              'heading' => 'G', 'sortorder' => 7));

    protected $report_builder_filters_data = array(
                        array('id' => 25, 'reportid' => 12, 'type' => 'objective', 'value' => 'fullname',
                              'sortorder' => 1, 'advanced' => 0),
                        array('id' => 26, 'reportid' => 12, 'type' => 'objective', 'value' => 'priority',
                              'sortorder' => 2, 'advanced' => 1),
                        array('id' => 27, 'reportid' => 12, 'type' => 'objective', 'value' => 'duedate',
                              'sortorder' => 3, 'advanced' => 1),
                        array('id' => 28, 'reportid' => 12, 'type' => 'plan', 'value' => 'name',
                              'sortorder' => 4, 'advanced' => 1));

    // Work data
    public static $ind = 0;
    protected $user1 = null;
    protected $user2 = null;
    protected $user3 = null;
    protected $plan1 = null;
    protected $plan2 = null;
    protected $plan3 = null;
    protected $objectives = array();

    /**
     * Prepare mock data for testing
     *
     * Common part of all test cases:
     * - Create 3 users
     * - Create plan1 by user1
     * - Create plan2 and plan3 by user2
     * - Add 2 objectives to each plan
     */
    protected function setUp() {
        parent::setup();
        $this->getDataGenerator()->reset();
        // Common parts of test cases:
        // Create report record in database
        $this->loadDataSet($this->createArrayDataSet(array('report_builder' => array($this->report_builder_data),
                                                           'report_builder_columns' => $this->report_builder_columns_data,
                                                           'report_builder_filters' => $this->report_builder_filters_data)));
        $this->user1 = $this->getDataGenerator()->create_user();
        $this->user2 = $this->getDataGenerator()->create_user();
        $this->user3 = $this->getDataGenerator()->create_user();
        $this->plan1 = $this->getDataGenerator()->create_plan($this->user1->id);
        $this->plan2 = $this->getDataGenerator()->create_plan($this->user2->id);
        $this->plan3 = $this->getDataGenerator()->create_plan($this->user2->id);
        $this->objectives[] = $this->create_objective($this->plan1->id);
        $this->objectives[] = $this->create_objective($this->plan1->id);
        $this->objectives[] = $this->create_objective($this->plan2->id);
        $this->objectives[] = $this->create_objective($this->plan2->id);
        $this->objectives[] = $this->create_objective($this->plan3->id);
        $this->objectives[] = $this->create_objective($this->plan3->id);
    }

    /**
     * Test courses report
     * Test case:
     * - Common part (@see: self::setUp() )
     * - Check that user1 has objectives of plan1
     * - Check that user2 has objectives of plan2 and plan3
     * - Check that user3 has no plans
     *
     * @param int Use cache or not (1/0)
     * @dataProvider provider_use_cache
     */
    public function test_plan_objectives($usecache) {
        $this->resetAfterTest();
        if ($usecache) {
            $this->enable_caching($this->report_builder_data['id']);
        }
        $result = $this->get_report_result($this->report_builder_data['shortname'],
                            array('userid' => $this->user1->id), $usecache);
        $this->assertCount(2, $result);
        $was = array('');
        foreach($result as $r) {
            $this->assertContains($r->objective_id, array($this->objectives[0]->id, $this->objectives[1]->id));
            $this->assertNotContains($r->objective_fullnamelink, $was);
            $was[] = $r->objective_fullnamelink;
        }

        $result = $this->get_report_result($this->report_builder_data['shortname'],
                            array('userid' => $this->user2->id), $usecache);
        $this->assertCount(4, $result);
        $was = array('');
        foreach($result as $r) {
            $this->assertContains($r->objective_id, array($this->objectives[2]->id,
                $this->objectives[3]->id, $this->objectives[4]->id, $this->objectives[5]->id));
            $this->assertNotContains($r->objective_fullnamelink, $was);
            $was[] = $r->objective_fullnamelink;
        }

        $result = $this->get_report_result($this->report_builder_data['shortname'],
                            array('userid' => $this->user3->id), $usecache);
        $this->assertCount(0, $result);
    }

    /**
     * Create mock objective for plan
     * @param int $planid
     * @param stdClass|array $record
     */
    public function create_objective($planid, $record = array()) {
        global $DB;
        self::$ind++;
        $plan = new development_plan($planid);
        $component = $plan->get_component('objective');

        $default = array(
            'planid' => $planid,
            'fullname' => 'Learning plan ' . self::$ind,
            'description' => 'Description plan' . self::$ind,
            'priority' => 1,
            'duedate' => time() + 23328000,
            'scalevalueid' => $DB->get_field('dp_objective_scale', 'defaultid',
                    array('id' => $component->get_setting('objectivescale'))),
            'approved' => DP_APPROVAL_APPROVED
        );
        $properties = array_merge($default, $record);
        $newid = $DB->insert_record('dp_plan_objective', (object)$properties);
        dp_plan_item_updated(2, 'objective', $newid);

        $result = $DB->get_record('dp_plan_objective', array('id' => $newid));
        return $result;
    }
}
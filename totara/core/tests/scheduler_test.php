<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2013 Totara Learning Solutions LTD
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
 * @author Valerii Kuznetsov <valerii.kuznetsov@totaralms.com>
 * @package totara
 * @subpackage reportbuilder
 */
if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}
global $CFG;
require_once($CFG->dirroot . '/totara/core/lib/scheduler.php');

/**
 * Test report scheduler class
 */
class scheduler_test extends PHPUnit_Framework_TestCase {
    /**
     * Test basic scheduler functionality
     */
    public function test_scheduler_basic() {
        $row = new stdClass();
        $row->data = 'Some data';
        $row->schedule = 0;
        $row->frequency = scheduler::DAILY;
        $row->nextevent = 100;

        $scheduler = new scheduler($row);
        $this->assertFalse($scheduler->is_changed());

        $scheduler->do_asap();
        $this->assertLessThan(time(), $scheduler->get_scheduled_time());
        $this->assertTrue($scheduler->is_changed());
        $this->assertTrue($scheduler->is_time());

        $scheduler->next();
        $this->assertGreaterThan(time(), $scheduler->get_scheduled_time());
        $this->assertTrue($scheduler->is_changed());
        $this->assertFalse($scheduler->is_time());
    }

    /**
     * Test plan for schedule estimations
     */
    public function schedule_plan() {
        $data = array(
            array(scheduler::DAILY, 10, 534815999, 534816000, 534938400),
            array(scheduler::WEEKLY, 5, 534815999, 534816000, 535334400),
            array(scheduler::MONTHLY, 6, 534815999, 534816000, 536889600),
        );
        return $data;
    }
    /**
     * Test scheduler calculations
     * @dataProvider schedule_plan
     */
    public function test_scheduler_timing($frequency, $schedule, $currentevent, $currenttime, $expectedevent) {
        $tz = date_default_timezone_get();
        date_default_timezone_set('UTC');
        $row = new stdClass();
        $row->data = 'Some data';
        $row->schedule = $schedule;
        $row->frequency = $frequency;
        $row->nextevent = $currentevent;

        $scheduler = new scheduler($row);
        $scheduler->set_time($currenttime);
        $scheduler->next();
        $time = $scheduler->get_scheduled_time();
        $this->assertEquals($expectedevent, $time, "\n".$time.' = '.date('r ', $time)."\n");
        date_default_timezone_set($tz);
    }

    /**
     * Test scheduler mapping to db object row
     */
    public function test_scheduler_map() {
        $map = array(
            'nextevent' => 'test_event',
            'frequency' => 'test_frequency',
            'schedule' => 'test_schedule'
        );
        $row = new stdClass();
        $row->data = 'Some data';
        $row->test_schedule = 0;
        $row->test_frequency = 0;
        $row->test_event = 0;
        $row->test_event = 0;

        $scheduler = new scheduler($row, $map);
        $scheduler->from_array(array(
            'frequency' => scheduler::DAILY,
            'schedule' => 10,
            'initschedule' => false
        ));

        $this->assertTrue($scheduler->is_changed());
        $this->assertEquals(10, $row->test_schedule);
        $this->assertEquals(scheduler::DAILY, $row->test_frequency);
        $this->assertEquals($scheduler->get_scheduled_time(), $row->test_event);
    }
}
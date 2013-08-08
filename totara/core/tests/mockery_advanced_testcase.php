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
 * @subpackage core
 *
 * Test case that makes use of Mockery to allow DB mocking
 *
 * NOTE: Since this testcase overrides the global DB object, no real DB calls
 * will work when using this testcase.
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); //  It must be included from a Moodle page.
}

use \Mockery as m;

class mockery_advanced_testcase extends advanced_testcase {

    protected function setUp() {
        global $DB;
        $DB = m::mock('moodle_database');
        $DB->shouldReceive('dispose');
        parent::setup();
    }

}


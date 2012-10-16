<?php
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
 * @subpackage totara_plan
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

// tab bar
$tabs = array();
$row = array();

// overview tab
$row[] = new tabobject(
    'courses',
    $CFG->wwwroot . '/totara/plan/record/courses.php?' . $userstr .
    'status=' . $rolstatus,
    get_string($rolstatus.'courses', 'totara_plan')
);
$row[] = new tabobject(
    'competencies',
    $CFG->wwwroot . '/totara/plan/record/competencies.php?' . $userstr .
    'status=' . $rolstatus,
    get_string($rolstatus.'competencies', 'totara_plan')
);
$row[] = new tabobject(
    'objectives',
    $CFG->wwwroot . '/totara/plan/record/objectives.php?' . $userstr .
    'status=' . $rolstatus,
    get_string($rolstatus.'objectives', 'totara_plan')
);
$row[] = new tabobject(
    'programs',
    $CFG->wwwroot . '/totara/plan/record/programs.php?' . $userstr .
    'status=' . $rolstatus,
    get_string($rolstatus.'programs', 'totara_plan')
);
$tabs[] = $row;

echo print_tabs($tabs, $currenttab, null, null, true);

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
 * @author David Curry <david.curry@totaralms.com>
 * @package totara
 * @subpackage totara_feedback360
 */

/**
 * Display tabs on feedback360 settings pages
 *
 * Included in each settings page
 *
 * TODO can we move this into a function in renderer.php?
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');
}

// Assumes the feedback360 id variable has been set in the page.
if (!isset($currenttab)) {
    $currenttab = 'general';
}

$tabs = array();
$row = array();
$activated = array();
$inactive = array();
if ($feedback360->id < 1) {
    $inactive = array('content', 'assignments', 'recipients');
}
$systemcontext = context_system::instance();
if (has_capability('totara/feedback360:managefeedback360', $systemcontext)) {
    $row[] = new tabobject('general', $CFG->wwwroot . '/totara/feedback360/general.php?id='
            . $feedback360->id, get_string('general'));
}
if (has_capability('totara/feedback360:managepageelements', $systemcontext)) {
    $row[] = new tabobject('content', $CFG->wwwroot . '/totara/feedback360/content.php?feedback360id='
            . $feedback360->id, get_string('content', 'totara_feedback360'));
}
// Hide recipients tab until it implemented on userend.
//if (has_capability('totara/feedback360:managenotifications', $systemcontext)) {
//    $row[] = new tabobject('recipients', $CFG->wwwroot . '/totara/feedback360/recipients.php?id='
//            . $feedback360->id, get_string('recipients', 'totara_feedback360'));
//}
if (has_any_capability(array('totara/feedback360:viewassignedusers', 'totara/feedback360:assignfeedback360togroup'), $systemcontext)) {
    $row[] = new tabobject('assignments', $CFG->wwwroot . '/totara/feedback360/assignments.php?id='
            . $feedback360->id, get_string('assignments', 'totara_feedback360'));
}

$tabs[] = $row;
$activated[] = $currenttab;

print_tabs($tabs, $currenttab, $inactive, $activated);

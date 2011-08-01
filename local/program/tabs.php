<?php
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
 * @author Alastair Munro <alastair@catalyst.net.nz>
 * @package totara
 * @subpackage plan
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

$id = optional_param('id', 0, PARAM_INT);
$edit = optional_param('edit', 'off', PARAM_TEXT);

if (!isset($currenttab)) {
    $currenttab = 'competencies';
}

if(!isset($context)) {
    $context = $program->get_context();
}

$toprow = array();
$secondrow = array();
$activated = array();
$inactive = array();

// Overview Tab
$toprow[] = new tabobject('overview', $CFG->wwwroot.'/local/program/edit.php?id='.$id, get_string('overview', 'local_program'));
if (substr($currenttab, 0, 7) == 'overview'){
    $activated[] = 'overview';
}

// Details Tab
$toprow[] = new tabobject('details', $CFG->wwwroot.'/local/program/edit.php?id='.$id.'&amp;action=edit', get_string('details', 'local_program'));
if (substr($currenttab, 0, 7) == 'details'){
    $activated[] = 'details';
}

// Content Tab
if (has_capability('local/program:configurecontent', $context)) {
    $toprow[] = new tabobject('content', $CFG->wwwroot.'/local/program/edit_content.php?id='.$id, get_string('content', 'local_program'));
    if (substr($currenttab, 0, 7) == 'content'){
        $activated[] = 'content';
    }
}

// Assignments Tab
if (has_capability('local/program:configureassignments', $context)) {
    $toprow[] = new tabobject('assignments', $CFG->wwwroot.'/local/program/edit_assignments.php?id='.$id, get_string('assignments', 'local_program'));
    if (substr($currenttab, 0, 11) == 'assignments'){
        $activated[] = 'assignments';
    }
}

// Messages Tab
if (has_capability('local/program:configuremessages', $context)) {
    $toprow[] = new tabobject('messages', $CFG->wwwroot.'/local/program/edit_messages.php?id='.$id, get_string('messages', 'local_program'));
    if (substr($currenttab, 0, 8) == 'messages'){
        $activated[] = 'messages';
    }
}

// Exceptions Report Tab
// Only show if there are exceptions or you are on the exceptions tab already
if ($exceptions || (substr($currenttab, 0, 10) == 'exceptions')) {
    $exceptioncount = $exceptions ? $exceptions : '0';
    $toprow[] = new tabobject('exceptions', $CFG->wwwroot.'/local/program/exceptions.php?id='.$id, get_string('exceptions', 'local_program', $exceptioncount));
    if (substr($currenttab, 0, 10) == 'exceptions'){
        $activated[] = 'exceptions';
    }
}

if (!$id) {
    $inactive += array('overview', 'content', 'assignments', 'messages');
}

$tabs = array($toprow);

// print out tabs
print_tabs($tabs, $currenttab, $inactive, $activated);

?>

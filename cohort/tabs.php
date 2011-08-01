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
 * @author Jake Salmon <jake.salmon@kineo.com>
 * @package totara
 * @subpackage cohort
 */

/// This file to be included so we can assume config.php has already been included.
/// We also assume that $user, $course, $currenttab, $cohort have been set

// Setup the top row of tabs
$inactive = NULL;
$activetwo = NULL;
$toprow = array();

$toprow[] = new tabobject('view', $CFG->wwwroot.'/cohort/view.php?id='.$cohort->id,
            get_string('overview','local_cohort'));

$toprow[] = new tabobject('edit', $CFG->wwwroot.'/cohort/edit.php?id='.$cohort->id,
            get_string('editdetails','local_cohort'));


$toprow[] = new tabobject('viewmembers', $CFG->wwwroot.'/cohort/members.php?id='.$cohort->id,
    get_string('viewmembers','local_cohort'));

if ($cohort->cohorttype == cohort::TYPE_STATIC) {
    $toprow[] = new tabobject('editmembers', $CFG->wwwroot.'/cohort/assign.php?id='.$cohort->id,
        get_string('editmembers','local_cohort'));
}


$tabs = array($toprow);
print_tabs($tabs, $currenttab, $inactive, $activetwo);

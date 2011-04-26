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
 * @author Aaron Wells <aaronw@catalyst.net.nz>
 * @package totara
 * @subpackage local
 */

/**
 * Default database records for local/plan
 *
 * Specifically, create a default priority scale of "High, Medium, Low"
 * and a default objective scale of "Completed, In Progress, Not Started" and a default plan template
 */

// Set up a default priority scale
// (only if there are none)
if(!count_records('dp_priority_scale')) {
    $ps = new stdClass();
    $ps->name = 'High, Medium, Low';
    $ps->description = 'High priority, medium priority, or low priority.';
    $ps->sortorder = 1;
    $ps->timemodified = time();
    $ps->usermodified = 0;

    $psid = insert_record('dp_priority_scale', $ps);

    // Add values to that default priority scale
    $psv = new stdClass();
    $psv->name = 'High';
    $psv->priorityscaleid = $psid;
    $psv->sortorder = 1;
    $psv->timemodified = time();
    $psv->usermodified = 0;
    insert_record('dp_priority_scale_value', $psv);

    $psv = new stdClass();
    $psv->name = 'Medium';
    $psv->priorityscaleid = $psid;
    $psv->sortorder = 2;
    $psv->timemodified = time();
    $psv->usermodified = 0;
    insert_record('dp_priority_scale_value', $psv);

    $psv = new stdClass();
    $psv->name = 'Low';
    $psv->priorityscaleid = $psid;
    $psv->sortorder = 3;
    $psv->timemodified = time();
    $psv->usermodified = 0;
    $psvid = insert_record('dp_priority_scale_value', $psv);

    // Add the low value as the default to the priority scale
    $ps->id = $psid;
    $ps->defaultid = $psvid;
    update_record('dp_priority_scale', $ps);
}


// Create a default objective scale
// (only if there are none)
if(!count_records('dp_objective_scale')) {
    $os = new stdClass();
    $os->name = 'Completed, In Progress, Not Started';
    $os->timemodified = time();
    $os->usermodified = 0;
    $os->sortorder = 1;
    $osid = insert_record('dp_objective_scale', $os);

    // Add scale values
    $osv = new stdClass();
    $osv->name = 'Completed';
    $osv->objscaleid = $osid;
    $osv->achieved = 1;
    $osv->sortorder = 1;
    $osv->timemodified = time();
    $osv->usermodified = 0;
    insert_record('dp_objective_scale_value', $osv);

    $osv = new stdClass();
    $osv->name = 'In Progress';
    $osv->objscaleid = $osid;
    $osv->achieved = 0;
    $osv->sortorder = 2;
    $osv->timemodified = time();
    $osv->usermodified = 0;
    insert_record('dp_objective_scale_value', $osv);

    $osv = new stdClass();
    $osv->name = 'Not Started';
    $osv->achieved = 0;
    $osv->objscaleid = $osid;
    $osv->sortorder = 3;
    $osv->timemodified = time();
    $osv->usermodified = 0;
    $osvid = insert_record('dp_objective_scale_value', $osv);

    // Add "not met" as the default for the objective scale
    $os->id = $osid;
    $os->defaultid = $osvid;
    update_record('dp_objective_scale', $os);
}

// create a default template
// (as long as the other scales got created okay
// and there are none)
if(count_records('dp_priority_scale') &&
    count_records('dp_objective_scale') &&
    !count_records('dp_template')) {

    require_once($CFG->dirroot . '/local/plan/lib.php');
    $templatename = get_string('learningplan', 'local_plan');
    $enddate = strftime('%d/%m/%Y', time() + 60*60*24*365); // one year from now
    $error = '';
    if(!dp_create_template($templatename, $enddate, $error)) {
        error_log($error);
    }
}


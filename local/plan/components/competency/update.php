<?php

///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT                                                   //
//                                                                       //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//          http://moodle.com                                            //
//                                                                       //
// Copyright (C) 1999 onwards Martin Dougiamas  http://dougiamas.com     //
//                                                                       //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

require_once('../../../../config.php');
require_once($CFG->dirroot.'/local/plan/lib.php');

require_login();

///
/// Setup / loading data
///

// Plan id
$id = required_param('id', PARAM_INT);
$linkedcourses = optional_param('linkedcourses', array(), PARAM_INT);

// Updated course lists
$idlist = optional_param('update', null, PARAM_SEQUENCE);
if ($idlist == null) {
    $idlist = array();
}
else {
    $idlist = explode(',', $idlist);
}

// Basic access control checks
/*
if ($id) { // plan being edited

    if($id == SITEID){
        // don't allow editing of  'site course' using this from
        print_error('cannoteditsiteform');
    }

    if (!$course = get_record('course', 'id', $id)) {
        print_error('invalidcourseid');
    }

    require_login($course->id);
    require_capability('moodle/course:update', get_context_instance(CONTEXT_COURSE, $course->id));

} else {
    require_login();
    print_error('needcourseid');
}
 */

$plan = new development_plan($id);
$componentname = 'competency';
$component = $plan->get_component($componentname);

$status = true;
begin_sql();
$component->update_assigned_items($idlist);
// now assign the linked courses
if(count($linkedcourses) != 0) {
    foreach($linkedcourses as $compid => $courses) {
        foreach($courses as $course => $unused) {

            // add course if it's not already in this plan
            // @todo what if course is assigned but not approved?
            if(!$plan->get_component('course')->is_item_assigned($course)) {
                $plan->get_component('course')->assign_new_item($course);
            }
            // now we need to grab the assignment ID
            $assignmentid = get_field('dp_plan_course_assign',
                'id', 'planid', $plan->id, 'courseid', $course);
            if(!$assignmentid) {
                // something went wrong trying to assign the course
                // don't attempt to create a relation
                $status = false;
                continue;
            }

            // get the competency assignment ID from the competency
            $compassignid = get_field('dp_plan_competency_assign',
                'id', 'competencyid', $compid, 'planid', $plan->id);
            if(!$compassignid) {
                $status = false;
                continue;
            }

            // create relation
            $plan->add_component_relation('competency', $compassignid, 'course', $assignmentid);

        }
    }
}
if($status) {
    // only make dialog changes if everything worked
    commit_sql();
} else {
    rollback_sql();
}


echo $component->display_list();
echo $plan->display_plan_message_box();

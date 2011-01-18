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

///
/// Setup / loading data
///

// Plan id
$id = required_param('id', PARAM_INT);

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

// get array of competencies already assigned
$assigned = $component->get_assigned_items();
$assigned_ids = array();
foreach($assigned as $item) {
    $assigned_ids[] = $item->competencyid;
}

// see what's changed
$comps_added = array_diff($idlist, $assigned_ids);
$comps_removed = array_diff($assigned_ids, $idlist);

// get linked courses for newly added competencies
$evidence = $component->get_course_evidence_items($comps_added);

// if no linked courses in new competencies, skip this page and
// move directly on to handling them
if(count($evidence) == 0) {
    print 'NOCOURSES:'.implode(',', $idlist);
    die;
}

// get names of competencies with linked courses
$compnames = get_records_select_menu('comp', 'id IN (' . implode(',', $idlist) . ')', 'id', 'id,fullname');

// display a form to allow the user to select required linked courses
print '<h2>' . get_string('confirmlinkedcourses', 'local_plan') . '</h2>';
print '<p>' . get_string('confirmlinkedcoursesdesc', 'local_plan') . '</p>';
print '<form>';
print '<input type="hidden" name="id" value="' . $id . '" />';
print '<input type="hidden" name="update" value="' . implode(',', $idlist) . '" />';
foreach($evidence as $compid => $linkedcourses) {
    print 'Competency "'. $compnames[$compid] . '":<br />';
    foreach($linkedcourses as $linkedcourse) {
        print '<input type="checkbox" checked="checked" name="linkedcourses[' . $compid . '][' . $linkedcourse->courseid . ']" value="1"> ' .
                        $linkedcourse->fullname . '<br />';
    }
}
print '</form>';

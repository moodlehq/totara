<?php

// This file provides an array of SQL fragments that join additional tables to the base table or
// each other. This allows you to build up a set of available tables for displaying or filtering by

// joinlist is an array of key value pairs with the key corresponding to the name of the join (used
// in the join array in columnoptions), and the value being an SQL fragment to perform that join.
//
// The order of the elements is critical - the earlier elements will be joined in the order in this
// list so make sure that any dependent joins are done after the dependancy.


// joinlist for this source

$managerroleid = get_field('role','id','shortname','manager');

$joinlist = array(
    'user' => "LEFT JOIN {$CFG->prefix}user u ON u.id=base.userid",
    'scorm' => "LEFT JOIN {$CFG->prefix}scorm scorm ON scorm.id=base.scormid",
    'sco' => "LEFT JOIN {$CFG->prefix}scorm_scoes sco ON sco.id=base.scoid",
    'course' => "LEFT JOIN {$CFG->prefix}course c ON c.id=scorm.course",
    'course_category' => "LEFT JOIN {$CFG->prefix}course_categories cat ON cat.id=c.category",
    'position_assignment' => "LEFT JOIN {$CFG->prefix}pos_assignment pa ON base.userid = pa.userid",
    'manager_role_assignment' => "LEFT JOIN {$CFG->prefix}role_assignments mra ON ( pa.reportstoid = mra.id AND mra.roleid = $managerroleid)",
    'manager' => "LEFT JOIN {$CFG->prefix}user manager ON manager.id = mra.userid",
    'organisation' => "LEFT JOIN {$CFG->prefix}org organisation ON organisation.id = pa.organisationid",
    'position' => "LEFT JOIN {$CFG->prefix}pos position ON position.id = pa.positionid",
);


// because of SCORMs crazy db design we have to self-join the table every time
// we want a field - horribly inefficient, but should be okay until scorm gets redesigned
$elements = array(
    'starttime' => 'x.start.time',
    'totaltime' => 'cmi.core.total_time',
    'status' => 'cmi.core.lesson_status',
    'scoreraw' => 'cmi.core.score.raw',
    'scoremin' => 'cmi.core.score.min',
    'scoremax' => 'cmi.core.score.max',
);
foreach ($elements as $name => $element) {
    $key = "sco_$name";
    $joinlist[$key] = "LEFT JOIN {$CFG->prefix}scorm_scoes_track $name ON $name.userid = base.userid AND $name.scormid = base.scormid AND $name.scoid = base.scoid AND $name.attempt = base.attempt AND $name.element = '$element'";
}


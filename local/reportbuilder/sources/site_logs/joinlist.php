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
    'course' => "LEFT JOIN {$CFG->prefix}course c ON c.id=base.course",
    'course_category' => "LEFT JOIN {$CFG->prefix}course_categories cat ON cat.id=c.category",
    'user' => "LEFT JOIN {$CFG->prefix}user u ON u.id=base.userid",
    'position_assignment' => "LEFT JOIN {$CFG->prefix}position_assignment pa ON base.userid = pa.userid",
    'manager_role_assignment' => "LEFT JOIN {$CFG->prefix}role_assignments mra ON ( pa.reportstoid = mra.id AND mra.roleid = $managerroleid)",
    'manager' => "LEFT JOIN {$CFG->prefix}user manager ON manager.id = mra.userid",
    'organisation' => "LEFT JOIN {$CFG->prefix}organisation organisation ON organisation.id = pa.organisationid",
    'position' => "LEFT JOIN {$CFG->prefix}position position ON position.id = pa.positionid",
);



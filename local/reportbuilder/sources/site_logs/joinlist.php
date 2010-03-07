<?php

// This file provides an array of SQL fragments that join additional tables to the base table or
// each other. This allows you to build up a set of available tables for displaying or filtering by

// joinlist is an array of key value pairs with the key corresponding to the name of the join (used
// in the join array in columnoptions), and the value being an SQL fragment to perform that join.
//
// The order of the elements is critical - the earlier elements will be joined in the order in this
// list so make sure that any dependent joins are done after the dependancy.


// joinlist for this source
$joinlist = array(
    'course' => "LEFT JOIN {$CFG->prefix}course c ON c.id=base.course",
    'course_category' => "LEFT JOIN {$CFG->prefix}course_categories cat ON cat.id=c.category",
    'user' => "LEFT JOIN {$CFG->prefix}user u ON u.id=base.userid",
);



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
    'competency' => "LEFT JOIN {$CFG->prefix}comp competency ON base.competencyid = competency.id",
    'scale_values' => "LEFT JOIN {$CFG->prefix}comp_scale_values scale_values ON scale_values.id = base.proficiency",
    'user' => "LEFT JOIN {$CFG->prefix}user u ON base.userid = u.id",
    'position_assignment' => "LEFT JOIN {$CFG->prefix}pos_assignment pa ON base.userid = pa.userid",
    'manager_role_assignment' => "LEFT JOIN {$CFG->prefix}role_assignments mra ON ( pa.reportstoid = mra.id AND mra.roleid = $managerroleid)",
    'manager' => "LEFT JOIN {$CFG->prefix}user manager ON manager.id = mra.userid",
    'organisation' => "LEFT JOIN {$CFG->prefix}org organisation ON organisation.id = pa.organisationid",
    'position' => "LEFT JOIN {$CFG->prefix}pos position ON position.id = pa.positionid",
    'completion_organisation' => "LEFT JOIN {$CFG->prefix}org completion_organisation ON base.organisationid = completion_organisation.id",
    'completion_position' => "LEFT JOIN {$CFG->prefix}pos completion_position ON base.positionid = completion_position.id",
    'assessor' => "LEFT JOIN {$CFG->prefix}user assessor ON assessor.id = base.assessorid",
);

// add all user custom fields to join list
if($custom_fields = get_records('user_info_field','','','','id,shortname')) {
    foreach($custom_fields as $custom_field) {
        $field = $custom_field->shortname;
        $id = $custom_field->id;
        $key = "user_$field";
        $joinlist[$key] = "LEFT JOIN {$CFG->prefix}user_info_data $key ON (u.id = $key.userid AND $key.fieldid = $id )";

    }
}
// add more joins that require custom field data here


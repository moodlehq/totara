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
    'competency' => "LEFT JOIN {$CFG->prefix}competency competency ON base.competencyid = competency.id",
    'user' => "LEFT JOIN {$CFG->prefix}user u ON base.userid = u.id",
);

// add all user custom fields to join list
$custom_fields = get_records('user_info_field','','','','id,shortname');
foreach($custom_fields as $custom_field) {
    $field = $custom_field->shortname;
    $id = $custom_field->id;
    $key = "user_$field";
    $joinlist[$key] = "LEFT JOIN {$CFG->prefix}user_info_data $key ON (u.id = $key.userid AND $key.fieldid = $id )";

}

// add more joins that require custom field data
$joinlist['manager'] = "LEFT JOIN {$CFG->prefix}user manager ON (CAST(manager.id AS varchar) = user_managerid.data)";
$joinlist['organisation'] = "LEFT JOIN {$CFG->prefix}organisation organisation ON (CAST(organisation.id AS varchar) = user_organisationid.data)";
$joinlist['position'] = "LEFT JOIN {$CFG->prefix}position position ON (CAST(position.id AS varchar) = user_positionid.data)";

$joinlist['completion_organisation'] = "LEFT JOIN {$CFG->prefix}organisation completion_organisation ON base.organisationid = completion_organisation.id";
$joinlist['completion_position'] = "LEFT JOIN {$CFG->prefix}position completion_position ON base.positionid = completion_position.id";


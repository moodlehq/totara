<?php

// called with competency_scale.json.php?competencyid=x
//
// returns JSON containing select options for the scale
// used by that competency, e.g.:
//
// {[ {'name': 0, 'value' : 'Select a proficiency...'},
//    {'name': 1, 'value' : 'Not Competent'},
//    {'name': 2, 'value' : 'Competent with Supervison'},
//    {'name': 3, 'value' : 'Competent'} ]}

require_once('../../../../config.php');

$competencyid = required_param('competencyid',PARAM_INT);

$scaleid = get_field('competency','scaleid','id',$competencyid);

$sql = "SELECT id AS name, name AS value from {$CFG->prefix}competency_scale_values
    WHERE scaleid = $scaleid";
if($scale_values = get_records_sql($sql)) {
    // append initial pulldown option
    $picker = new object();
    $picker->name = '0';
    $picker->value = get_string('selectaproficiency','local');
    print json_encode(array($picker)+$scale_values);
} else {
    // return no data
    print json_encode(array());
}

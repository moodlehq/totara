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
require_once($CFG->dirroot . '/lib/pear/HTML/AJAX/JSON.php'); // needed for PHP5.2 JSON support

$competencyid = required_param('competencyid',PARAM_INT);

$frameworkid = get_field('comp','frameworkid','id',$competencyid);
if(!$frameworkid) {
    error('Could not find competency framework');
}

$scaleid = get_field('comp_scale_assignments','scaleid','frameworkid',$frameworkid);
if(!$scaleid) {
    error('Could not find framework scale id');
}

$sql = "SELECT id AS name, name AS value from {$CFG->prefix}comp_scale_values
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

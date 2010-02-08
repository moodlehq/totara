<?php
// This file defines which of the columnoptions appear by default when a new
// report from this source is created
//
// Each array element is one column
// Each column contains an array with:
// - type (used to get column info from columnoptions)
// - value (used to get column info from columnoptions)
// - heading (default heading given when new report is created)

// default columns for this source
$defaultcolumns = array(
    array(
        'type' => 'user',
        'value' => 'namelink',
        'heading' => 'Participant',
    ),
    array(
        'type' => 'course',
        'value' => 'courselink',
        'heading' => 'Course Name',
    ),
    array(
        'type' => 'session',
        'value' => 'location',
        'heading' => 'Location',
    ),
    array(
        'type' => 'session',
        'value' => 'audit',
        'heading' => 'Audit',
    ),
    array(
        'type' => 'session',
        'value' => 'pilot',
        'heading' => 'Pilot',
    ),
    array(
        'type' => 'session',
        'value' => 'coursedelivery',
        'heading' => 'Course Delivery',
    ),
    array(
        'type' => 'date',
        'value' => 'sessiondate',
        'heading' => 'Session Date',
    ),
);


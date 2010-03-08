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
        'type' => 'log',
        'value' => 'time',
        'heading' => 'Time',
    ),
    array(
        'type' => 'user',
        'value' => 'namelink',
        'heading' => 'User',
    ),
    array(
        'type' => 'user',
        'value' => 'position',
        'heading' => 'Position',
    ),
    array(
        'type' => 'user',
        'value' => 'organisation',
        'heading' => 'Organisation',
    ),
    array(
        'type' => 'course',
        'value' => 'courselink',
        'heading' => 'Course',
    ),
    array(
        'type' => 'log',
        'value' => 'ip',
        'heading' => 'IP Address',
    ),
    array(
        'type' => 'log',
        'value' => 'actionlink',
        'heading' => 'Action',
    ),
    array(
        'type' => 'log',
        'value' => 'info',
        'heading' => 'Info',
    ),
);


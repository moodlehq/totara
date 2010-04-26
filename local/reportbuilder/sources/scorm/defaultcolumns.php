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
        'heading' => 'User',
    ),
    array(
        'type' => 'scorm',
        'value' => 'title',
        'heading' => 'SCORM Title',
    ),
    array(
        'type' => 'sco',
        'value' => 'title',
        'heading' => 'SCO Title',
    ),
    array(
        'type' => 'sco',
        'value' => 'attempt',
        'heading' => 'Attempt',
    ),
    array(
        'type' => 'sco',
        'value' => 'starttime',
        'heading' => 'Start Time',
    ),
    array(
        'type' => 'sco',
        'value' => 'totaltime',
        'heading' => 'Total Time',
    ),
    array(
        'type' => 'sco',
        'value' => 'status',
        'heading' => 'Status',
    ),
    array(
        'type' => 'sco',
        'value' => 'scoreraw',
        'heading' => 'Score',
    ),

);


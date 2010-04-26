<?php

// This file defines which of the filteroptions appear by default when a new
// report from this source is created
//
// Each array element is one filter
// Each filter contains an array with:
// - type (used to get filter info from filteroptions)
// - value (used to get filter info from filteroptions)
// - advanced (determines if the default filter is marked as an advanced
//            option when first set up)

// default filters for this source
$defaultfilters = array(

    array(
        'type' => 'user',
        'value' => 'fullname',
        'advanced' => 0,
    ),
    array(
        'type' => 'user',
        'value' => 'positionid',
        'advanced' => 1,
    ),
    array(
        'type' => 'user',
        'value' => 'organisationid',
        'advanced' => 1,
    ),
    array(
        'type' => 'sco',
        'value' => 'status',
        'advanced' => 1,
    ),
    array(
        'type' => 'sco',
        'value' => 'starttime',
        'advanced' => 1,
    ),
    array(
        'type' => 'sco',
        'value' => 'attempt',
        'advanced' => 1,
    ),
    array(
        'type' => 'sco',
        'value' => 'scoreraw',
        'advanced' => 1,
    ),
);



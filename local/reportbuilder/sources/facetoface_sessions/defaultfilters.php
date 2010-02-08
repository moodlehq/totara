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
//
// default filters for this source
$defaultfilters = array(
    array(
        'type' => 'user',
        'value' => 'fullname',
        'advanced' => 0,
    ),
    array(
        'type' => 'course',
        'value' => 'fullname',
        'advanced' => 0,
    ),
    array(
        'type' => 'status',
        'value' => 'statuscode',
        'advanced' => 0,
    ),
    array(
        'type' => 'date',
        'value' => 'sessiondate',
        'advanced' => 0,
    ),
);



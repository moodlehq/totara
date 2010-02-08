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
        'value' => 'organisationid',
        'advanced' => 0,
    ),
    array(
        'type' => 'course_completion',
        'value' => 'organisationid',
        'advanced' => 0,
    ),
    array(
        'type' => 'user',
        'value' => 'positionid',
        'advanced' => 0,
    ),
    array(
        'type' => 'course_completion',
        'value' => 'positionid',
        'advanced' => 0,
    ),
    array(
        'type' => 'course',
        'value' => 'fullname',
        'advanced' => 0,
    ),
    array(
        'type' => 'course_category',
        'value' => 'id',
        'advanced' => 0,
    ),
    array(
        'type' => 'course_completion',
        'value' => 'completeddate',
        'advanced' => 0,
    ),
    array(
        'type' => 'course_completion',
        'value' => 'status',
        'advanced' => 0,
    ),
);



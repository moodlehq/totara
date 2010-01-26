<?php

////////// DEFINED PARAMETERS /////////////

// which base table to start from - see query_snippets.php
$source = 'course_completion';

// specify columns to be retrieved and displayed
// if the heading key is blank, field will be retrieved
// from DB but not displayed in table (useful to get IDs for linking)
$columns = array(
    array(
        'type'    => 'course',
        'value'   => 'fullname',
        'heading' => 'Course Name',
    ),
    // get course id but don't display column
    array(
        'type'    => 'course',
        'value'   => 'id',
    ),
    array(
        'type'    => 'user',
        'value'   => 'fullname',
        'heading' => 'Participant',
    ),
    // get user id but don't display column
    array(
        'type'    => 'user',
        'value'   => 'id',
    ),
    array(
        'type'    => 'user',
        'value'   => 'organisation',
        'heading' => 'Office',
    ),
    array(
        'type'    => 'user_profile',
        'value'   => 'dob',
        'heading' => 'DOB',
    ),
    array(
        'type'    => 'user',
        'value'   => 'position',
        'heading' => 'Role',
    ),
    array(
        'type'    => 'course_completion',
        'value'   => 'status',
        'heading' => 'Completion Status',
    ),
    array(
        'type'    => 'course_completion',
        'value'   => 'completeddate',
        'heading' => 'Completion Date',
    ),
    array(
        'type'    => 'user',
        'value'   => 'area_office',
        'heading' => 'AO',
        'level'   => '3',
    ),
    array(
        'type'    => 'user',
        'value'   => 'conservancy_office',
        'heading' => 'CO',
        'level'   => '2',
    ),
    array(
        'type'    => 'user',
        'value'   => 'regional_office',
        'heading' => 'RO',
        'level'   => '1',
    ),
);

// specify filter options to show
// must have matching entries in filter/lib.php
$fieldinfo = array(
    array(
        'type' => 'user',
        'value' => 'fullname',
        'advanced' => 0,
    ),
    array(
        'type' => 'user',
        'value' => 'firstname',
        'advanced' => 1,
    ),
    array(
        'type' => 'user',
        'value' => 'lastname',
        'advanced' => 1,
    ),
    array(
        'type' => 'user',
        'value' => 'organisationid',
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
        'advanced' => 1,
    ),
    array(
        'type' => 'course_completion',
        'value' => 'completeddate',
        'advanced' => 1,
    ),
);
// display SQL query
$debug = false;

$tableid = "report-table-course-completions";  // flexible table unique ID
$report_title = "Course Completion Records";

/////////////////////////////////////

require_once('report_base.php');


<?php

////////// DEFINED PARAMETERS /////////////

// which base table to start from - see query_snippets.php
$source = 'competency_evidence';

// specify columns to be retrieved and displayed
// if the heading key is blank, field will be retrieved
// from DB but not displayed in table (useful to get IDs for linking)
$columns = array(
    array(
        'type'    => 'competency_evidence',
        'value'   => 'proficiency',
        'heading' => 'Proficiency',
    ),
    array(
        'type'    => 'competency_evidence',
        'value'   => 'completeddate',
        'heading' => 'Completed Date',
    ),
    array(
        'type'    => 'user',
        'value'   => 'fullname',
        'heading' => 'Participant',
    ),
);

// specify filter options to show
// must have matching entries in filter/lib.php
$fieldinfo = array(
    array(
        'type' => 'competency_evidence',
        'value' => 'proficiency',
        'advanced' => 0,
    ),
    /*
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
    ),*/
);
// display SQL query
$debug = false;

$tableid = "report-table-$source";  // flexible table unique ID
$report_title = "Competency Evidence Records";

/////////////////////////////////////

require_once('report_base.php');


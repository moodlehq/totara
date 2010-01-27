<?php

////////// DEFINED PARAMETERS /////////////

// which base table to start from - see query_snippets.php
$source = 'competency_evidence';

// specify columns to be retrieved and displayed
// if the heading key is blank, field will be retrieved
// from DB but not displayed in table (useful to get IDs for linking)
$columns = array(
    array(
        'type'    => 'user',
        'value'   => 'fullname',
        'heading' => 'Participant',
    ),
    array(
        'type'    => 'competency',
        'value'   => 'fullname',
        'heading' => 'Competency',
    ),
    array(
        'type'    => 'competency',
        'value'   => 'idnumber',
        'heading' => 'ID',
    ),
    array(
        'type'    => 'user',
        'value'   => 'organisation',
        'heading' => 'Office',
    ),
    array(
        'type'    => 'competency_evidence',
        'value'   => 'organisation',
        'heading' => 'Completion Office',
    ),
    array(
        'type'    => 'user',
        'value'   => 'position',
        'heading' => 'Role',
    ),
    array(
        'type'    => 'competency_evidence',
        'value'   => 'position',
        'heading' => 'Completion Role',
    ),
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
        'value' => 'organisationid',
        'advanced' => 0,
    ),
    array(
        'type' => 'competency_evidence',
        'value' => 'organisationid',
        'advanced' => 0,
    ),
    array(
        'type' => 'user',
        'value' => 'positionid',
        'advanced' => 0,
    ),
    array(
        'type' => 'competency_evidence',
        'value' => 'positionid',
        'advanced' => 0,
    ),
    array(
        'type' => 'competency',
        'value' => 'fullname',
        'advanced' => 0,
    ),
    array(
        'type' => 'competency',
        'value' => 'idnumber',
        'advanced' => 0,
    ),
    array(
        'type' => 'competency_evidence',
        'value' => 'completeddate',
        'advanced' => 0,
    ),
    array(
        'type' => 'competency_evidence',
        'value' => 'proficiency',
        'advanced' => 0,
    ),
);
// display SQL query
$debug = false;

$tableid = "report-table-$source";  // flexible table unique ID
$report_title = "Competency Evidence Records";

/////////////////////////////////////

require_once('report_base.php');


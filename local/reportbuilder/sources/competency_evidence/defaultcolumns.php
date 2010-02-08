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
        'type' => 'competency',
        'value' => 'competencylink',
        'heading' => 'Competency',
    ),
    array(
        'type' => 'user',
        'value' => 'organisation',
        'heading' => 'Office',
    ),
    array(
        'type' => 'competency_evidence',
        'value' => 'organisation',
        'heading' => 'Completion Office',
    ),
    array(
        'type' => 'user',
        'value' => 'position',
        'heading' => 'Position',
    ),
    array(
        'type' => 'competency_evidence',
        'value' => 'position',
        'heading' => 'Completion Position',
    ),
    array(
        'type' => 'competency_evidence',
        'value' => 'proficiency',
        'heading' => 'Proficiency',
    ),
    array(
        'type' => 'competency_evidence',
        'value' => 'completeddate',
        'heading' => 'Completion Date',
    ),
);


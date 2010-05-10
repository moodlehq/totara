<?php

// name - name of content restriction to include
// title - used for human readable description of this restriction
// field - which to compare
// joins - any joins needed to access field

$contentoptions = array(
    array(
        'name' => 'current_org',
        'title' => 'The user\'s current organisation',
        'field' => 'base.userid',
        'joins' => array(),
    ),
    array(
        'name' => 'completed_org',
        'title' => 'The organisation when completed',
        'field' => 'base.organisationid',
        'joins' => array(),
    ),
    array(
        'name' => 'user',
        'title' => 'The user',
        'field' => 'base.userid',
        'joins' => array(),
    ),
    array(
        'name' => 'thedate',
        'title' => 'The completion date',
        'field' => 'base.timemodified',
        'joins' => array(),
    ),
);

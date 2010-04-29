<?php

// name - name of content restriction to include
// field - which to compare
// joins - any joins needed to access field

$contentoptions = array(
    array(
        'name' => 'current_org',
        'field' => 'base.userid',
        'joins' => array('signup'),
    ),
    array(
        'name' => 'completed_org',
        'field' => 'pa.organisationid',
        'joins' => array('position_assignment'),
    ),
    array(
        'name' => 'user',
        'field' => 'base.userid',
        'joins' => array(),
    ),
    array(
        'name' => 'date',
        'field' => 'base.time',
        'joins' => array(),
    ),
);

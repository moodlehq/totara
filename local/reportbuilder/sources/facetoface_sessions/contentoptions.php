<?php

// name - name of content restriction to include
// field - which to compare
// joins - any joins needed to access field

$contentoptions = array(
    array(
        'name' => 'current_org',
        'field' => 'signup.userid',
        'joins' => array('signup'),
    ),
    array(
        'name' => 'completed_org',
        'field' => 'pa.organisationid',
        'joins' => array('signup','user','position_assignment'),
    ),
    array(
        'name' => 'user',
        'field' => 'signup.userid',
        'joins' => array('signup'),
    ),
    array(
        'name' => 'date',
        'field' => 'date.timestart',
        'joins' => array('date'),
    ),
);

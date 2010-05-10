<?php

// name - name of content restriction to include
// title - used for human readable description of this restriction
// field - which to compare
// joins - any joins needed to access field

$contentoptions = array(
    array(
        'name' => 'current_org',
        'title' => 'The user\'s current organisation',
        'field' => 'signup.userid',
        'joins' => array('signup'),
    ),
    array(
        'name' => 'user',
        'title' => 'The user',
        'field' => 'signup.userid',
        'joins' => array('signup'),
    ),
    array(
        'name' => 'thedate',
        'title' => 'The session date',
        'field' => 'date.timestart',
        'joins' => array('date'),
    ),
);

<?php

// name - name of content restriction to include
// title - used for human readable description of this restriction
// field - which to compare
// joins - any joins needed to access field

$contentoptions = array(
    array(
        'name' => 'current_org',
        'title' => 'The completion date',
        'field' => 'base.userid',
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
        'title' => 'The date',
        'field' => 'base.time',
        'joins' => array(),
    ),
);

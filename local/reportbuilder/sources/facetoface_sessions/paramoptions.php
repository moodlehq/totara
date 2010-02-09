<?php
//
// this file contains an array of possible url parameter to provide additional filtering for
// reports using this source.
//
// The array elements are as follows:
//
// 'param' key => The first key defines the URL parameter to be looked for. Do not use
// a value of 'id', or 'ssort' or 'spage' as that would clash with other URL parameters
// used by report builder
// 'field' key => The SQL fragment used to match against, same as in columnoptions.
// 'joins' key => An array of join names which are required to allow the field defined
//                above to be obtained, same as in columnoptions.
//
// params for this source
$paramoptions = array(
    'userid' => array(
        'field' => 'signup.userid',
        'joins' => array('signup'),
    ),
    'courseid' => array(
        'field' => 'course.id',
        'joins' => array('facetoface','course'),
    ),
);


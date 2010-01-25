<?php

// list of join SQL snippets that may be needed to obtain data fields
// make sure the alias here matches the prefix used in field SQL snippets
// if you need a field from one of these tables, include the key in the joins array
//
// NOTE: the order of this array matters - earlier elements will be joined first
// so when you add joins make sure any joins they require are added first
$joinlist = array(
    'course' => "LEFT JOIN {$CFG->prefix}course c ON base.course = c.id",
    'course_category' => "LEFT JOIN {$CFG->prefix}course_categories cat ON cat.id = c.category",
    'user' => "LEFT JOIN {$CFG->prefix}user u ON base.userid = u.id",
);

// add all user custom fields to join list
$custom_fields = get_records('user_info_field','','','','id,shortname');
foreach($custom_fields as $custom_field) {
    $field = $custom_field->shortname;
    $id = $custom_field->id;
    $key = "user_$field";
    $joinlist[$key] = "LEFT JOIN {$CFG->prefix}user_info_data $key ON (u.id = $key.userid AND $key.fieldid = $id )";

}

// add more joins that require custom field data
// TODO check that CAST(.. AS varchar) is DB independent
$joinlist['manager'] = "LEFT JOIN {$CFG->prefix}user manager ON (CAST(manager.id AS varchar) = user_managerid.data)";
$joinlist['organisation'] = "LEFT JOIN {$CFG->prefix}organisation organisation ON (CAST(organisation.id AS varchar) = user_organisationid.data)";
$joinlist['position'] = "LEFT JOIN {$CFG->prefix}position position ON (CAST(position.id AS varchar) = user_positionid.data)";

// array keys match 'type' and 'value' keys in $columns array, and provide details of what
// SQL snippets to add to query to get the required data
// NOTE: don't use a dash (-) in keys as this is used as a separator in the filtering code!
$snippets = array();

// Course Completion
$snippets['course_completion'] = array(
    'base' => "{$CFG->prefix}course_completions base",
    'course_completion' => array(
        'status' => array(
            // Assume CASE is DB independent:
            // http://tracker.moodle.org/browse/MDL-15198#action_52620
            'field' => "CASE WHEN base.timecompleted IS NOT NULL THEN 'Completed' ELSE 'Not Completed' END",
            'joins' => array(),
        ),
        'completeddate' => array(
            'field' => "base.timecompleted",
            'joins' => array(),
        ),
    ),
    'course' => array(
        'fullname' => array(
            'field' => "c.fullname",
            'joins' => array('course'),
        ),
        'shortname' => array(
            'field' => "c.shortname",
            'joins' => array('course'),
        ),
        'idnumber' => array(
            'field' => "c.idnumber",
            'joins' => array('course'),
        ),
        'id' => array(
            'field' => "c.id",
            'joins' => array('course'),
        ),
        'startdate' => array(
            'field' => "c.startdate",
            'joins' => array('course'),
        ),
    ),
    'course_category' => array(
        'name' => array(
            'field' => "cat.name",
            'joins' => array('course','course_category'),
        ),
        'id' => array(
            'field' => "c.category",
            'joins' => array('course'),
        ),
    ),
    'user' => array(
        'firstname' => array(
            'field' => 'u.firstname',
            'joins' => array('user'),
        ),
        'lastname' => array(
            'field' => 'u.lastname',
            'joins' => array('user'),
        ),
        'username' => array(
            'field' => 'u.username',
            'joins' => array('user'),
        ),
        'idnumber' => array(
            'field' => 'u.idnumber',
            'joins' => array('user'),
        ),
        'fullname' => array(
            'field' => sql_fullname("u.firstname","u.lastname"),
            'joins' => array('user'),
        ),
        'id' => array(
            'field' => "u.id",
            'joins' => array('user'),
        ),
        'manager_name' => array(
            'field' => sql_fullname("manager.firstname","manager.lastname"),
            'joins' => array('user','user_managerid','manager'),
        ),
        'organisation' => array(
            'field' => "organisation.fullname",
            'joins' => array('user','user_organisationid','organisation'),
        ),
        'position' => array(
            'field' => "position.fullname",
            'joins' => array('user','user_positionid','position'),
        ),
        // just get org id for these, convert to correct depth level in table
        'area_office' => array(
            'field' => "user_organisationid.data",
            'joins' => array('user','user_organisationid'),
        ),
        'conservancy_office' => array(
            'field' => "user_organisationid.data",
            'joins' => array('user','user_organisationid'),
        ),
        'regional_office' => array(
            'field' => "user_organisationid.data",
            'joins' => array('user','user_organisationid'),
        ),
    ),
);

// add custom fields to course_completion snippet
foreach($custom_fields as $custom_field) {
    $field = $custom_field->shortname;
    $id = $custom_field->id;
    $key = "user_$field";
    $snippets['course_completion']['user_profile'][$field] = array(
            'field' => "$key.data",
            'joins' => array('user',$key),
    );
}

// End of course_completion snippet


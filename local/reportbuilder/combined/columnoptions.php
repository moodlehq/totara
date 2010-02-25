<?php
// all available course completion columns
$columnoptions = array(
    'type' => array(
        'type' => array(
            'name' => 'Type',
            'field' => "'Course'",
            'union' => "'Competency'",
            'joins' => array(),
        ),
    ),
    'course_completion' => array(
        'status' => array(
            'name'  => 'Completion Status',
            'field' => "CASE WHEN base.timecompleted IS NOT NULL THEN 'Completed' ELSE 'Not Completed' END",
            'union' => 'proficiency',
            'joins' => array(),
        ),
        'completeddate' => array(
            'name' => 'Completion Date',
            'field' => "base.timecompleted",
            'union' => 'timecreated',
            'joins' => array(),
            'displayfunc' => 'reportbuilder_nice_date',
        ),
        'organisationid' => array(
            'name' => 'Completion Organisation ID',
            'field' => 'base.organisationid',
            'union' => 'organisationid',
            'joins' => array(),
        ),
        'organisation' => array(
            'name' => 'Completion Organisation Name',
            'field' => "completion_organisation.fullname",
            'joins' => array('completion_organisation'),
        ),
        'positionid' => array(
            'name' => 'Completion Position ID',
            'field' => 'base.positionid',
            'joins' => array(),
        ),
        'position' => array(
            'name' => 'Completion Position Name',
            'field' => "completion_position.fullname",
            'joins' => array('completion_position'),
        ),
   ),
    'course' => array(
        'fullname' => array(
            'name' => 'Name',
            'field' => "c.fullname",
            'joins' => array('course'),
        ),
        'shortname' => array(
            'name' => 'Shortname',
            'field' => "c.shortname",
            'joins' => array('course'),
        ),
        'idnumber' => array(
            'name' => 'ID Number',
            'field' => "c.idnumber",
            'joins' => array('course'),
        ),
        // hack to display course link, use only for column, not for filter
        'courselink' => array(
            'name' => 'Name (linked to course/competency page)',
            'field' => 'c.id AS course_id, c.fullname',
            'joins' => array('course'),
            'displayfunc' => 'reportbuilder_link_course_or_comp',
        ),
        'id' => array(
            'name' => 'ID',
            'field' => "c.id",
            'joins' => array('course'),
        ),
        'startdate' => array(
            'name' => 'Start Date',
            'field' => "c.startdate",
            'joins' => array('course'),
            'displayfunc' => 'reportbuilder_nice_date',
        ),
    ),
    'course_category' => array(
        'name' => array(
            'name' => 'Course Category',
            'field' => "cat.name",
            'joins' => array('course','course_category'),
        ),
        'id' => array(
            'name' => 'Course Category ID',
            'field' => "c.category",
            'joins' => array('course'),
        ),
    ),
    'user' => array(
        'firstname' => array(
            'name' => 'User First Name',
            'field' => 'u.firstname',
            'joins' => array('user'),
        ),
        'lastname' => array(
            'name' => 'User Last Name',
            'field' => 'u.lastname',
            'joins' => array('user'),
        ),
        'username' => array(
            'name' => 'Username',
            'field' => 'u.username',
            'joins' => array('user'),
        ),
        'idnumber' => array(
            'name' => 'User ID Number',
            'field' => 'u.idnumber',
            'joins' => array('user'),
        ),
        'fullname' => array(
            'name' => 'User Fullname',
            'field' => sql_fullname("u.firstname","u.lastname"),
            'joins' => array('user'),
        ),
        // hack to display user link - only user for column, not filter
        'namelink' => array(
            'name' => 'User Fullname (linked to profile)',
            'field' => 'u.id AS user_id, '.sql_fullname('u.firstname','u.lastname'),
            'joins' => array('user'),
            'displayfunc' => 'reportbuilder_link_user',
        ),
        'id' => array(
            'name' => 'User ID',
            'field' => "u.id",
            'joins' => array('user'),
        ),
        'manager_name' => array(
            'name' => 'User\'s Manager Name',
            'field' => sql_fullname("manager.firstname","manager.lastname"),
            'joins' => array('user','user_managerid','manager'),
        ),
        'organisationid' => array(
            'name' => 'User\'s Organisation ID',
            'field' => "user_organisationid.data",
            'joins' => array('user','user_organisationid'),
        ),
        'organisation' => array(
            'name' => 'User\'s Organisation Name',
            'field' => "organisation.fullname",
            'joins' => array('user','user_organisationid','organisation'),
        ),
        'positionid' => array(
            'name' => 'User\'s Position ID',
            'field' => 'user_positionid.data',
            'joins' => array('user','user_positionid'),
        ),
        'position' => array(
            'name' => 'User\'s Position',
            'field' => "position.fullname",
            'joins' => array('user','user_positionid','position'),
        ),
        /*
        // just get org id for these, convert to correct depth level in table
        // need a displayfunc to do this
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
         */
    ),
);

$custom_fields = get_records('user_info_field','','','','id,shortname,name');
foreach($custom_fields as $custom_field) {
    $field = $custom_field->shortname;
    $name = $custom_field->name;
    $id = $custom_field->id;
    $key = "user_$field";
    $columnoptions['user_profile'][$field] = array(
        'name' => $name,
        'field' => "$key.data",
        'joins' => array('user',$key),
    );
}


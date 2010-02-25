<?php
// all available course completion columns
$columnoptions = array(
    'session' => array(
        'capacity' => array(
            'name'  => 'Session Capacity',
            'field' => "base.capacity",
            'joins' => array(),
        ),
        'location' => array(
            'name' => 'Session Location',
            'field' => 'session_location.data',
            'joins' => array('session_location'),
        ),
        'venue' => array(
            'name' => 'Session Venue',
            'field' => 'session_venue.data',
            'joins' => array('session_venue'),
        ),
        'room' => array(
            'name' => 'Session Room',
            'field' => 'session_room.data',
            'joins' => array('session_room'),
        ),
        'audit' => array(
            'name' => 'Audit',
            'field' => 'session_audit.data',
            'joins' => array('session_audit'),
        ),
        'pilot' => array(
            'name' => 'Pilot',
            'field' => 'session_pilot.data',
            'joins' => array('session_pilot'),
        ),
        'coursedelivery' => array(
            'name' => 'Course Delivery Method',
            'field' => 'session_coursedelivery.data',
            'joins' => array('session_coursedelivery'),
        ),
    ),
    'status' => array(
        'statuscode' => array(
            'name' => 'Status',
            'field' => 'status.statuscode',
            'joins' => array('signup','status'),
            'displayfunc' => 'reportbuilder_facetoface_status',
        ),
    ),
    'facetoface' => array(
        'name' => array(
            'name' => 'Face to Face Name',
            'field' => "facetoface.name",
            'joins' => array('facetoface'),
        ),
    ),
    'course' => array(
        'fullname' => array(
            'name' => 'Course Name',
            'field' => 'course.fullname',
            'joins' => array('facetoface','course'),
        ),
        // hack to display course link, use in column but not as filter
        'courselink' => array(
            'name' => 'Course Name (linked to course page)',
            'field' => 'course.id AS course_id, course.fullname',
            'joins' => array('facetoface','course'),
            'displayfunc' => 'reportbuilder_link_course',
        ),
    ),
    'date' => array(
        'sessiondate' => array(
            'name' => 'Session Date',
            'field' => 'date.timestart',
            'joins' => array('date'),
            'displayfunc' => 'reportbuilder_nice_date',
        ),
        'timestart' => array(
            'name' => 'Session Start Time',
            'field' => "date.timestart",
            'joins' => array('date'),
            'displayfunc' => 'reportbuilder_nice_time',
        ),
        'timefinish' => array(
            'name' => 'Session Finish Time',
            'field' => "date.timefinish",
            'joins' => array('date'),
            'displayfunc' => 'reportbuilder_nice_time',
        ),
    ),
    'user' => array(
        'firstname' => array(
            'name' => 'User First Name',
            'field' => 'u.firstname',
            'joins' => array('signup','user'),
        ),
        'lastname' => array(
            'name' => 'User Last Name',
            'field' => 'u.lastname',
            'joins' => array('signup','user'),
        ),
        'username' => array(
            'name' => 'Username',
            'field' => 'u.username',
            'joins' => array('signup','user'),
        ),
        'idnumber' => array(
            'name' => 'User ID Number',
            'field' => 'u.idnumber',
            'joins' => array('signup','user'),
        ),
        'fullname' => array(
            'name' => 'User Fullname',
            'field' => sql_fullname("u.firstname","u.lastname"),
            'joins' => array('signup','user'),
        ),
        // hack to display user link - only user for column, not filter
        'namelink' => array(
            'name' => 'User Fullname (linked to profile)',
            'field' => 'u.id AS user_id, '.sql_fullname('u.firstname','u.lastname'),
            'joins' => array('signup','user'),
            'displayfunc' => 'reportbuilder_link_user',
        ),
        'id' => array(
            'name' => 'User ID',
            'field' => "u.id",
            'joins' => array('signup','user'),
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
        'joins' => array('signup','user',$key),
    );
}


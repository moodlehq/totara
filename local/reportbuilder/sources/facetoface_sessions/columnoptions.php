<?php
//
// This file defines the possible columns that can be included in reports
// from this source
//
// The format of this file is a multidimensional array:
//
// outer key => 'type' of field
// inner key => 'value' of field
// 'name' key => Description of column, used in report builder pulldown
// 'field' key => SQL fragment used as a SELECT field to pick a column for display
//                and also optionally in the WHERE clause if a filter is defined
//                with the same 'type' and 'value' in filteroptions.php
//                You can abuse this slightly to pull back two SQL columns for 
//                a single table column by providing multiple comma separate fields,
//                but don't define a filter based on that column or you'll get an
//                SQL error
// 'joins' key => Array of join names which are required to be made to allow the 
//                field defined above to be obtained. The join names are the same
//                as the keys in the joinlist.php file. The order the joins are 
//                provided is unimportant as this is determined from the order in the
//                joinlist.
// 'displayfunc' key => Normally the contents of a field is obtained from the database
//                      and output in the column. If you want to do some additional
//                      formatting before display, include a 'displayfunc' key with the
//                      name of a function to be found in local/reportbuilder/displayfuncs.php
//                      The value will be passed to the function and the return value 
//                      displayed instead. The whole row will also be passed to the 
//                      function in case you want to make use of other data (see
//                      reportbuilder_link_* funcs for an example).
//
//
// define all columns available for this source
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
            'joins' => array('signup','user','position_assignment','manager_role_assignment','manager'),
        ),
        'organisationid' => array(
            'name' => 'User\'s Organisation ID',
            'field' => "pa.organisationid",
            'joins' => array('signup','user','position_assignment'),
        ),
        'organisation' => array(
            'name' => 'User\'s Organisation Name',
            'field' => "organisation.fullname",
            'joins' => array('signup','user','position_assignment','organisation'),
        ),
        'positionid' => array(
            'name' => 'User\'s Position ID',
            'field' => 'pa.positionid',
            'joins' => array('signup','user','position_assignment'),
        ),
        'position' => array(
            'name' => 'User\'s Position',
            'field' => "position.fullname",
            'joins' => array('signup','user','position_assignment','position'),
        ),
    ),
    // be careful using these - they will generate extra results rows
    // if same role is assigned to a session multiple times
    'role' => array(
        'trainer' => array(
            'name' => 'Trainer',
            'field' => sql_fullname("session_role_user_trainer.firstname",
                "session_role_user_trainer.lastname"),
            'joins' => array('session_role_trainer','session_role_user_trainer'),
        ),
        /*
        // the problem with this is that it generates extra table rows for multiple assistant trainers
        'assistanttrainer' => array(
            'name' => 'Assistant Trainer',
            'field' => sql_fullname("session_role_user_assistanttrainer.firstname",
                "session_role_user_assistanttrainer.lastname"),
            'joins' => array('session_role_assistanttrainer','session_role_user_assistanttrainer'),
        ),
         */
        'auditor' => array(
            'name' => 'Auditor',
            'field' => sql_fullname('session_role_user_auditor.firstname',
                'session_role_user_auditor.lastname'),
            'joins' => array('session_role_auditor','session_role_user_auditor'),
        ),
        'assessor' => array(
            'name' => 'Assessor',
            'field' => sql_fullname('session_role_user_assessor.firstname',
                'session_role_user_assessor.lastname'),
            'joins' => array('session_role_assessor','session_role_user_assessor'),
        ),
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


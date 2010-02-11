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
    'course_completion' => array(
        'status' => array(
            'name'  => 'Completion Status',
            'field' => "CASE WHEN base.timecompleted IS NOT NULL THEN 'Completed' ELSE 'Not Completed' END",
            'joins' => array(),
        ),
        'completeddate' => array(
            'name' => 'Completion Date',
            'field' => "base.timecompleted",
            'joins' => array(),
            'displayfunc' => 'reportbuilder_nice_date',
        ),
        'organisationid' => array(
            'name' => 'Completion Organisation ID',
            'field' => 'base.organisationid',
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
            'name' => 'Course Name',
            'field' => "c.fullname",
            'joins' => array('course'),
        ),
        'shortname' => array(
            'name' => 'Course Shortname',
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
            'name' => 'Course Name (linked to course page)',
            'field' => 'c.id AS course_id, c.fullname',
            'joins' => array('course'),
            'displayfunc' => 'reportbuilder_link_course',
        ),
        'id' => array(
            'name' => 'Course ID',
            'field' => "c.id",
            'joins' => array('course'),
        ),
        'startdate' => array(
            'name' => 'Course Start Date',
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
            'joins' => array('user','position_assignment','manager_role_assignment','manager'),
        ),
        'organisationid' => array(
            'name' => 'User\'s Organisation ID',
            'field' => "pa.organisationid",
            'joins' => array('position_assignment'),
        ),
        'organisation' => array(
            'name' => 'User\'s Organisation Name',
            'field' => "organisation.fullname",
            'joins' => array('user','position_assignment','organisation'),
        ),
        'positionid' => array(
            'name' => 'User\'s Position ID',
            'field' => 'pa.positionid',
            'joins' => array('position_assignment'),
        ),
        'position' => array(
            'name' => 'User\'s Position',
            'field' => "position.fullname",
            'joins' => array('user','position_assignment','position'),
        ),
    ),
);

// add all user custom fields to a type of 'user_profile'
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


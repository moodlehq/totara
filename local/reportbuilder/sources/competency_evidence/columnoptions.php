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
    'competency_evidence' => array(
        'proficiency' => array(
            'name'  => 'Proficiency',
            'field' => "base.proficiency",
            'joins' => array(),
            'displayfunc' => 'reportbuilder_proficiency',
        ),
        'completeddate' => array(
            'name' => 'Completion Date',
            'field' => "base.timemodified",
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
    'competency' => array(
        'fullname' => array(
            'name' => 'Competency Name',
            'field' => "competency.fullname",
            'joins' => array('competency'),
        ),
        'shortname' => array(
            'name' => 'Competency Shortname',
            'field' => "competency.shortname",
            'joins' => array('competency'),
        ),
        'idnumber' => array(
            'name' => 'Competency ID Number',
            'field' => "competency.idnumber",
            'joins' => array('competency'),
        ),
        // hack to display competency link, use only for column, not for filter
        'competencylink' => array(
            'name' => 'Competency Name (linked to competency page)',
            'field' => 'competency.id AS competency_id, competency.fullname',
            'joins' => array('competency'),
            'displayfunc' => 'reportbuilder_link_competency',
        ),
        'id' => array(
            'name' => 'Competency ID',
            'field' => "competency.id",
            'joins' => array('competency'),
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



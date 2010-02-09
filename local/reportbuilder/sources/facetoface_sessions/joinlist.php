<?php
// This file provides an array of SQL fragments that join additional tables to the base table or
// each other. This allows you to build up a set of available tables for displaying or filtering by

// joinlist is an array of key value pairs with the key corresponding to the name of the join (used
// in the join array in columnoptions), and the value being an SQL fragment to perform that join.
//
// The order of the elements is critical - the earlier elements will be joined in the order in this
// list so make sure that any dependent joins are done after the dependancy.

// joinlist for this source
$joinlist = array(
    'facetoface' => "LEFT JOIN {$CFG->prefix}facetoface facetoface ON base.facetoface = facetoface.id",
    'course' => "LEFT JOIN {$CFG->prefix}course course ON course.id = facetoface.course",
    'date' => "LEFT JOIN {$CFG->prefix}facetoface_sessions_dates date ON base.id = date.sessionid",
    'role' => "LEFT JOIN {$CFG->prefix}facetoface_session_roles role ON base.id = role.sessionid",
    'signup' => "LEFT JOIN {$CFG->prefix}facetoface_signups signup ON base.id = signup.sessionid",
    'status' => "LEFT JOIN {$CFG->prefix}facetoface_signups_status status ON ( signup.id = status.signupid AND status.superceded = 0 )",
    'user' => "LEFT JOIN {$CFG->prefix}user u ON u.id = signup.userid",
);

// add all user custom fields to join list
$custom_fields = get_records('user_info_field','','','','id,shortname');
foreach($custom_fields as $custom_field) {
    $field = $custom_field->shortname;
    $id = $custom_field->id;
    $key = "user_$field";
    $joinlist[$key] = "LEFT JOIN {$CFG->prefix}user_info_data $key ON (u.id = $key.userid AND $key.fieldid = $id )";

}

// add all session custom fields to join list
$session_fields = get_records('facetoface_session_field','','','','id,shortname');
foreach($session_fields as $session_field) {
    $field = $session_field->shortname;
    $id = $session_field->id;
    $key = "session_$field";
    $joinlist[$key] = "LEFT JOIN {$CFG->prefix}facetoface_session_data $key ON (base.id = $key.sessionid AND $key.fieldid = $id )";
}

// add joins for the following roles as "session_role_X" and "session_role_user_X"
$sessionroles = array('trainer','auditor','assessor','assistanttrainer');
$roles = get_records('role','','','','id,shortname');
foreach ($roles as $role) {
    if (in_array($role->shortname,$sessionroles)) {
        $field = $role->shortname;
        $id = $role->id;
        $key = "session_role_$field";
        $userkey = "session_role_user_$field";
        // join to session roles to get userid of role
        // we have a problem here because there can be more than one assigned user per session per role
        // two ways to handle, the first includes one row per user (increasing the total number of results):
        $joinlist[$key] = "LEFT JOIN {$CFG->prefix}facetoface_session_roles $key ON (base.id = $key.sessionid AND $key.roleid = $id )";
        // the second method only shows one record, in this case the first user found by id, but requires MIN() which is postgres only
        // TODO come up with a better approach? would be nice to merge results
        //$joinlist[$key] = "LEFT JOIN ( SELECT sessionid,roleid,min(userid) as userid FROM {$CFG->prefix}facetoface_session_roles GROUP BY sessionid,roleid) AS $key ON (base.id = $key.sessionid AND $key.roleid = $id )";

        // join again to user table to get role's info
        $joinlist[$userkey] = "LEFT JOIN {$CFG->prefix}user $userkey ON $key.userid = $userkey.id";
    }
}





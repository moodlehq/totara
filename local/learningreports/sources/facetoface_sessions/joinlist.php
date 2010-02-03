<?php

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

// add more joins that require custom field data
// TODO check that CAST(.. AS varchar) is DB independent
/*
$joinlist['manager'] = "LEFT JOIN {$CFG->prefix}user manager ON (CAST(manager.id AS varchar) = user_managerid.data)";
$joinlist['organisation'] = "LEFT JOIN {$CFG->prefix}organisation organisation ON (CAST(organisation.id AS varchar) = user_organisationid.data)";
$joinlist['position'] = "LEFT JOIN {$CFG->prefix}position position ON (CAST(position.id AS varchar) = user_positionid.data)";

$joinlist['completion_organisation'] = "LEFT JOIN {$CFG->prefix}organisation completion_organisation ON base.organisationid = completion_organisation.id";
$joinlist['completion_position'] = "LEFT JOIN {$CFG->prefix}position completion_position ON base.positionid = completion_position.id";
 */
/*
$joinlist['competency'] = "LEFT JOIN {$CFG->prefix}competency competency ON base.competencyid = competency.id";
/
 */

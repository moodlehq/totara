<?php

// functions used to reformat report columns prior to display or export
//
// These functions are assigned to columns in columnoptions.php in the
// 'displayfunc' key of the array. The data returned from the database
// is passed in as the first parameter, with the whole row being 
// passed as the second parameter. The return value will be displayed
// in place of the column value.

// convert a course name into a link to that course
function reportbuilder_link_course($course, $row) {
    global $CFG;
    $courseid = $row->course_id;
    return "<a href=\"{$CFG->wwwroot}/course/view.php?id={$courseid}\">{$course}</a>";
}

// convert a users name into a link to their profile
function reportbuilder_link_user($user, $row) {
    global $CFG;
    $userid = $row->user_id;
    return "<a href=\"{$CFG->wwwroot}/user/view.php?id={$userid}\">{$user}</a>";
}

// convert a competency name into a link to that competency
function reportbuilder_link_competency($comp, $row) {
    global $CFG;
    $compid = $row->competency_id;
    return "<a href=\"{$CFG->wwwroot}/hierarchy/item/view.php?type=competency&id={$compid}\">{$comp}</a>";
}

// print the appropriate link depending on record type
function reportbuilder_link_course_or_comp($name, $row) {
    global $CFG;
    $type = $row->type_type;
    if($type=='Course') {
        return reportbuilder_link_course($name, $row);
    } else {
        return reportbuilder_link_competency($name, $row);
    }
}

// reformat a timestamp, showing nothing if invalid or null
function reportbuilder_nice_date($date, $row) {
    if($date && $date > 0) {
        return userdate($date, '%d %B %Y');
    } else {
        return '';
    }
}

// reformat a timestamp into a time, showing nothing if invalid or null
function reportbuilder_nice_time($date, $row) {
    if($date && $date > 0) {
        return userdate($date, '%H:%M');
    } else {
        return '';
    }
}

// reformat a timestamp into a date+time, showing nothing if invalid or null
function reportbuilder_nice_datetime($date, $row) {
    if($date && $date > 0) {
        return userdate($date, '%d %B %Y at %H:%M');
    } else {
        return '';
    }
}

// convert proficiency code into text
function reportbuilder_proficiency($proficiency, $row) {
    switch ($proficiency) {
        case '1':
            return 'Not Competent';
        case '2':
            return 'Competent with Supervison';
        case '3':
            return 'Competent';
        default:
            return $proficiency;
    }
}

// convert status code into text
function reportbuilder_facetoface_status($status, $row) {
    switch ($status) {
        case '10':
            return 'User Cancelled';
        case '20':
            return 'Session Cancelled';
        case '30':
            return 'Request Denied';
        case '40':
            return 'Requested';
        case '50':
            return 'Approved';
        case '60':
            return 'Waitlisted';
        case '70':
            return 'Booked';
        case '80':
            return 'No Show';
        case '90':
            return 'Partially Attended';
        case '100':
            return 'Fully Attended';
        default:
            return $status;
    }

}


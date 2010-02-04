<?php

function learningreport_link_course($course, $row) {
    global $CFG;
    $courseid = $row->course_id;
    return "<a href=\"{$CFG->wwwroot}/course/view.php?id={$courseid}\">{$course}</a>";
}

function learningreport_link_user($user, $row) {
    global $CFG;
    $userid = $row->user_id;
    return "<a href=\"{$CFG->wwwroot}/user/view.php?id={$userid}\">{$user}</a>";
}

function learningreport_link_competency($comp, $row) {
    global $CFG;
    $compid = $row->competency_id;
    return "<a href=\"{$CFG->wwwroot}/hierarchy/item/view.php?type=competency&id={$compid}\">{$comp}</a>";
}

function learningreport_link_course_or_comp($name, $row) {
    global $CFG;
    $type = $row->type_type;
    if($type=='Course') {
        return learningreport_link_course($name, $row);
    } else {
        return learningreport_link_competency($name, $row);
    }
}

function learningreport_nice_date($date, $row) {
    if($date && $date > 0) {
        return userdate($date, '%d %B %Y');
    } else {
        return '';
    }
}

function learningreport_nice_time($date, $row) {
    if($date && $date > 0) {
        return userdate($date, '%d %B %Y at %H:%M');
    } else {
        return '';
    }
}

function learningreport_proficiency($proficiency, $row) {
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

function learningreport_facetoface_status($status, $row) {
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

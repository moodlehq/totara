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


// convert a site log action into a link to that page
function reportbuilder_link_action($action, $row) {
    global $CFG;
    $url = $row->log_url;
    $module = $row->log_module;
    require_once($CFG->dirroot.'/course/lib.php');
    $logurl = make_log_url($module, $url);
    return "<a href=\"{$CFG->wwwroot}$logurl\">{$action}</a>";
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

function reportbuilder_iplookup($ip, $row) {
    global $CFG;
    if(isset($ip) && $ip != '' && isset($row->user_id)) {
        return '<a href="'.$CFG->wwwroot.'/iplookup/index.php?ip='.$ip.'&amp;user='.$row->user_id.'">'.$ip.'</a>';
    }
    else if ($ip && $ip != '') {
        return '<a href="'.$CFG->wwwroot.'/iplookup/index.php?ip='.$ip.'">'.$ip.'</a>';
    } else {
        return '';
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

///////////////////////////////////////////

// Functions for use by adminoptions.php only

// Displays links to admin functions for competency evidence
function reportbuilder_ce_admin_options($row) {
    global $CFG;
    $userid = $row->settings_user;
    $ceid = $row->settings_id;
    $addstr = get_string('addforthisuser','local');
    $editstr = get_string('edit');
    $deletestr = get_string('delete');
    $addlink = '<a href="'.$CFG->wwwroot.'/hierarchy/type/competency/evidence/add.php?userid='.$userid.'&amp;s='.sesskey().
        '&amp;returnurl='.urlencode(qualified_me()).'" title="'.$addstr.
        '"><img src="'.$CFG->pixpath.'/t/add.gif" class="iconsmall" alt='.$addstr.'" /></a>';
    $editlink = '<a href="'.$CFG->wwwroot.'/hierarchy/type/competency/evidence/edit.php?id='.$ceid.'&amp;s='.sesskey().
        '&amp;returnurl='.urlencode(qualified_me()).'" title="'.$editstr.
        '"><img src="'.$CFG->pixpath.'/t/edit.gif" class="iconsmall" alt='.$editstr.'" /></a>';
    $deletelink = '<a href="'.$CFG->wwwroot.'/hierarchy/type/competency/evidence/delete.php?id='.$ceid.'&amp;s='.sesskey().
        '&amp;returnurl='.urlencode(qualified_me()).'" title="'.$deletestr.
        '"><img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt='.$deletestr.'" /></a>';
    return $addlink.' '.$editlink .' '.$deletelink;
}



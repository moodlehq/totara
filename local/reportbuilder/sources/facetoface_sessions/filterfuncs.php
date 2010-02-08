<?php
// functions to return list of options for filter select elements
// specified in filteroptions.php

function get_session_status_list() {
    $status = array();
    $status[100] = 'Fully Attended';
    $status[90] = 'Partially Attended';
    $status[80] = 'No Show';
    $status[70] = 'Booked';
    $status[60] = 'Waitlisted';
    $status[50] = 'Approved';
    $status[40] = 'Requested';
    $status[30] = 'Request Denied';
    $status[20] = 'Session Cancelled';
    $status[10] = 'User Cancelled';
    return $status;
}

function get_yesno_list() {
    $yn = array();
    $yn['Yes'] = 'Yes';
    $yn['No'] = 'No';
    return $yn;
}

function get_coursedelivery_list() {
    $coursedelivery = array();
    $coursedelivery['Internal'] = 'Internal';
    $coursedelivery['External'] = 'External';
    return $coursedelivery;
}

function get_organisations_list() {
    global $CFG;
    require_once($CFG->dirroot.'/hierarchy/lib.php');

    $hierarchy = new hierarchy();
    $hierarchy->prefix = 'organisation';
    $hierarchy->make_hierarchy_list($orgs, null, true, true);

    return $orgs;

}

function get_positions_list() {
    global $CFG;
    require_once($CFG->dirroot.'/hierarchy/lib.php');

    $hierarchy = new hierarchy();
    $hierarchy->prefix = 'position';
    $hierarchy->make_hierarchy_list($positions, null, false, false);

    return $positions;


}



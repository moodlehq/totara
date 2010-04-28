<?php

// functions to return list of options for filter select elements
// specified in filteroptions.php
function get_organisations_list($restrictions) {
    global $CFG,$USER;
    require_once($CFG->dirroot.'/hierarchy/lib.php');
    require_once($CFG->dirroot.'/hierarchy/type/organisation/lib.php');

    //TODO fix this to use only available options
    $restrictions = null;

    $baseorg = null; // default to top of tree

    $localset = false;
    $nonlocal = false;
    // go through restrictions, to see if only local
    // restrictions are set
    if(isset($restrictions) && is_array($restrictions)) {
        foreach ($restrictions as $restriction) {
            if($restriction['funcname']=='local_records' ||
                $restriction['funcname']=='local_completed_records') {
                $localset = true;
                } else {
                $nonlocal = true;
            }
        }
    }
    // only local restrictions set - limit pulldown options
    if($localset && !$nonlocal) {
        $orgid = get_field('pos_assignment','organisationid','userid',$USER->id);
        // set to use users org id if it's set
        if(isset($orgid)) {
            $baseorg = $orgid;
        }
    }

    $hierarchy = new organisation();
    $hierarchy->make_hierarchy_list($orgs, $baseorg, true, true);

    return $orgs;

}

function get_positions_list() {
    global $CFG;
    require_once($CFG->dirroot.'/hierarchy/lib.php');
    require_once($CFG->dirroot.'/hierarchy/type/position/lib.php');

    $hierarchy = new position();
    $hierarchy->make_hierarchy_list($positions, null, false, false);

    return $positions;

}

function get_proficiency_list() {
    // use all possible scale values
    $scale_values = get_records('comp_scale_values', '', '', 'scaleid, sortorder');

    $proficiencies = array();
    foreach($scale_values as $scale_value) {
        $id = $scale_value->id;
        $name = $scale_value->name;
        $proficiencies[$id] = $name;
    }

    return $proficiencies;
}

// functions to return list of options for filter select elements
// specified in filteroptions.php

function get_course_categories_list() {
    global $CFG;
    require_once($CFG->dirroot.'/course/lib.php');
    make_categories_list($cats, $unused);

    return $cats;
}

function get_completion_status_list() {
    // TODO obtain this scale from single source - db?
    $proficiencyselect = array();
    $proficiencyselect['Completed'] = 'Completed';
    $proficiencyselect['Not Completed'] = 'Not Completed';

    return $proficiencyselect;
}

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

function get_scorm_attempt_list() {
    global $CFG;
    if (!$max = get_field_sql('SELECT '.sql_max('attempt')." FROM {$CFG->prefix}scorm_scoes_track")) {
        $max = 10;
    }
    $attemptselect = array();
    foreach( range(1, $max) as $attempt) {
        $attemptselect[$attempt] = $attempt;
    }
    return $attemptselect;
}

function get_scorm_status_list() {
    global $CFG;
    // get all available options
    if($records = get_records_sql("SELECT DISTINCT value FROM {$CFG->prefix}scorm_scoes_track WHERE element = 'cmi.core.lesson_status'")) {
        $statusselect = array();
        foreach($records as $record) {
            $statusselect[$record->value] = ucfirst($record->value);
        }
    } else {
        // a default set of options
        $statusselect = array(
            'passed' => 'Passed',
            'completed' => 'Completed',
            'not attempted' => 'Not Attempted',
            'incomplete' => 'Incomplete',
            'failed' => 'Failed',
        );
    }
    return $statusselect;
}


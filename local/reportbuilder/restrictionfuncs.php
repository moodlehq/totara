<?php

// file containing restriction functions called by get_restrictions
// should return an element or array of elements to be allowed or null
// if no elements should be allowed
//
// these will be matched to the 'field' defined in sources/*/restrictions.php
//
// these functions are assigned by the 'name' defined in sources/*/restrictions.php

// match current user
function reportbuilder_restriction_own_records() {
    global $USER;
    return $USER->id;
}

// match users who have current user as their manager
function reportbuilder_restriction_staff_records() {
    // returns an array of ids belonging to the current
    // user's staff
    if($staff = mitms_get_staff()) {
        return $staff;
    } else {
        // if $staff is false return null
        return null;
    }
}

// match users who are in an organisation at or below the current
// user's organisation
function reportbuilder_restriction_local_records() {
    global $CFG,$USER;
    require_once($CFG->dirroot.'/hierarchy/lib.php');
    require_once($CFG->dirroot.'/hierarchy/type/organisation/lib.php');

    $userid = $USER->id;
    // get the user's organisationid (for primary position)
    $orgid = get_field('pos_assignment','organisationid','userid',$userid, 'type', 1);
    // no results if they don't have one
    if(empty($orgid)) {
        return null;
    }

    // get list of organisations to find users for
    $hierarchy = new organisation();
    $children = $hierarchy->get_item_descendants($orgid);
    $olist = array();
    foreach($children as $child) {
        $olist[] = "'{$child->id}'";
    }

    // return users who are in an organisation in that list
    $users = get_records_select('pos_assignment',"organisationid IN (".implode(',',$olist).")",'','userid');
    $ulist = array();
    foreach ($users as $user) {
        $ulist[] = $user->userid;
    }
    return $ulist;
}

// match records which were completed at or below the current user's organisation
function reportbuilder_restriction_local_completed_records() {
    global $CFG,$USER;
    require_once($CFG->dirroot.'/hierarchy/lib.php');
    require_once($CFG->dirroot.'/hierarchy/type/organisation/lib.php');

    $userid = $USER->id;
    // get the user's organisationid (for primary position)
    $orgid = get_field('pos_assignment','organisationid','userid',$userid, 'type', 1);
    // no results if they don't have one
    if(empty($orgid)) {
        return null;
    }
    // get list of organisations to find users for
    $hierarchy = new organisation();
    $children = $hierarchy->get_item_descendants($orgid);
    $olist = array();
    foreach($children as $child) {
        $olist[] = "'{$child->id}'";
    }
    return $olist;

}


<?php

function reportbuilder_content_current_org($field, $options) {
    global $CFG,$USER;
    require_once($CFG->dirroot.'/hierarchy/lib.php');
    require_once($CFG->dirroot.'/hierarchy/type/organisation/lib.php');

    $userid = $USER->id;
    // get the user's organisationid (for primary position)
    $orgid = get_field('pos_assignment','organisationid','userid',$userid, 'type', 1);
    // no results if they don't have one
    if(empty($orgid)) {
        return 'FALSE';
    }

    if($options['recursive']) {
        // get list of organisations to find users for
        $hierarchy = new organisation();
        $children = $hierarchy->get_item_descendants($orgid);
        $olist = array();
        foreach($children as $child) {
            $olist[] = "'{$child->id}'";
        }
    } else {
        $olist = array($orgid);
    }

    // return users who are in an organisation in that list
    $users = get_records_select('pos_assignment',"organisationid IN (".implode(',',$olist).")",'','userid');
    $ulist = array();
    foreach ($users as $user) {
        $ulist[] = $user->userid;
    }
    return $field.' IN ('. implode(',',$ulist). ')';

}

function reportbuilder_content_completed_org($field, $options) {
    global $CFG,$USER;
    require_once($CFG->dirroot.'/hierarchy/lib.php');
    require_once($CFG->dirroot.'/hierarchy/type/organisation/lib.php');

    $userid = $USER->id;
    // get the user's organisationid (for primary position)
    $orgid = get_field('pos_assignment','organisationid','userid',$userid, 'type', 1);
    // no results if they don't have one
    if(empty($orgid)) {
        return 'FALSE';
    }
    if($options['recursive']) {
        // get list of organisations to match against
        $hierarchy = new organisation();
        $children = $hierarchy->get_item_descendants($orgid);
        $olist = array();
        foreach($children as $child) {
            $olist[] = "'{$child->id}'";
        }
        return $field.' IN ('. implode(',',$olist).')';
    } else {
        // just the users organisation
        return $field.' = '. $orgid;
    }
}

function reportbuilder_content_user($field, $options) {
    global $USER;
    if($options['who'] == 'own') {
        // show own records
        return $field.' = '.$USER->id;
    } else if ($options['who'] == 'reports') {
        // show staff records
        if($staff = mitms_get_staff()) {
            return $field.' IN ('. implode(',', $staff).')';
        } else {
            return 'FALSE';
        }
    } else if ($options['who'] == 'ownandreports') {
        // show own and staff records
        if($staff = mitms_get_staff()) {
            return $field.' IN ('. $USER->id.','. implode(',', $staff).')';
        } else {
            return $field.' = '.$USER->id;
        }
    } else {
        // anything unexpected
        return 'FALSE';
    }
}

function reportbuilder_content_date($field, $options) {
    $now = time();
    switch ($options['when']) {
    case 'past':
        return $field.' < '. $now;
    case 'future':
        return $field.' > '. $now;
    case 'last30days':
        return '(' . $field . ' < ' . $now . ' AND ' . $field. ' > '. ($now - 60*60*24*30) . ')';
    case 'next30days':
        return '(' . $field . ' > '. $now . ' AND ' . $field. ' < '. ($now + 60*60*24*30) . ')';
    default:
        // no match
        return 'FALSE';
    }

}

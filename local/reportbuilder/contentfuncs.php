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

function reportbuilder_content_desc_current_org($title, $options) {
    global $USER;
    $userid = $USER->id;
    $orgid = get_field('pos_assignment', 'organisationid', 'userid', $userid, 'type', 1);
    $orgname = get_field('org','fullname','id', $orgid);
    $children = $options['recursive'] ? ' '.get_string('orsuborg','local') : '';
    return $title . ' ' . get_string('is','local') .' "'.$orgname.'"'.$children;
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

function reportbuilder_content_desc_completed_org($title, $options) {
    global $USER;
    $userid = $USER->id;
    $orgid = get_field('pos_assignment', 'organisationid','userid',$userid,'type', 1);
    if(empty($orgid)) {
        return $title .' '. get_string('is','local') . ' "UNASSIGNED"';
    }
    $orgname = get_field('org','fullname','id',$orgid);
    $children = $options['recursive'] ? ' '.get_string('orsuborg','local') : '';
    return $title . ' '. get_string('is','local') . ' "'. $orgname.'"'.$children;
}


function reportbuilder_content_user($field, $options) {
    global $USER;
    $who = isset($options['who']) ? $options['who'] : null;
    if($who == 'own') {
        // show own records
        return $field.' = '.$USER->id;
    } else if ($who == 'reports') {
        // show staff records
        if($staff = mitms_get_staff()) {
            return $field.' IN ('. implode(',', $staff).')';
        } else {
            return 'FALSE';
        }
    } else if ($who == 'ownandreports') {
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

function reportbuilder_content_desc_user($title, $options) {
    global $USER;
    $user = get_record('user','id',$USER->id);
    switch ($options['who']) {
    case 'own':
        return $title.' '.get_string('is','local').' "'.fullname($user).'"';
    case 'reports':
        return $title.' '.get_string('reportsto','local').' "'.fullname($user).'"';
    case 'ownandreports':
        return $title.' '.get_string('is','local').' "'.fullname($user).'"'.get_string('or','local').get_string('reportsto','local').' "'.fullname($user).'"';
    default:
        return $title.' is NOT FOUND';
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

function reportbuilder_content_desc_date($title, $options) {
    switch ($options['when']) {
    case 'past':
        return $title.' '.get_string('occurredbefore','local').' '.userdate(time(), '%c');
    case 'future':
        return $title.' '.get_string('occurredafter','local').' '.userdate(time(), '%c');
    case 'last30days':
        return $title.' '.get_string('occurredafter','local').' '.userdate(time() - 60*60*24*30, '%c'). get_string('and','local') . get_string('occurredbefore','local') . userdate(time(),'%c');

    case 'next30days':
        return $title.' '.get_string('occurredafter','local').' '.userdate(time(), '%c'). get_string('and','local') . get_string('occurredbefore','local') . userdate(time() + 60*60*24*30,'%c');
    default:
        return 'Error with date content restriction';
    }
}

<?php

// functions to return list of options for filter select elements
// specified in filteroptions.php

function get_organisations_list($restrictions) {
    global $CFG,$USER;
    require_once($CFG->dirroot.'/hierarchy/lib.php');
    require_once($CFG->dirroot.'/hierarchy/type/organisation/lib.php');

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

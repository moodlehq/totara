<?php

// functions to return list of options for filter select elements
// specified in filteroptions.php

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

function get_proficiency_list() {
    // TODO populate
    $proficiencies = array();
    return $proficiencies;
}

<?php

// functions to return list of options for filter select elements
// specified in filteroptions.php

function get_course_categories_list() {
    global $CFG;
    require_once($CFG->dirroot.'/course/lib.php');
    make_categories_list($cats, $unused);

    return $cats;
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

function get_completion_status_list() {
    // TODO obtain this scale from single source - db?
    $proficiencyselect = array();
    $proficiencyselect['Completed'] = 'Completed';
    $proficiencyselect['Not Completed'] = 'Not Completed';

    return $proficiencyselect;
}

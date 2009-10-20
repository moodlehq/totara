<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/hierarchylib.php');

// depth level id; 0 if creating a new depth level
$id = optional_param('id', 0, PARAM_INT);
// framework id; required if creating a new depth level
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);
$spage       = optional_param('spage', 0, PARAM_INT);

$hierarchy         = new hierarchy();
$hierarchy->prefix = 'competency';

require_once($CFG->dirroot.'/'.$hierarchy->prefix.'/depth/edit_form.php');

// We require either an id for editing, or a framework for creating
if (!$id && !$frameworkid) {
    error('Incorrect parameters');
}

// Make this page appear under the manage hierachy items admin menu
admin_externalpage_setup($hierarchy->prefix.'manage', '', array(), '', $CFG->wwwroot.'/competency/depthlevel.php');

$context = get_context_instance(CONTEXT_SYSTEM);

if ($id == 0) {
    // creating new depth level
    require_capability('moodle/local:createcompetencydepth', $context);

    $depth = new object();
    $depth->id = 0;
    $depth->frameworkid = $frameworkid;

    // Calculate next depth level
    $depth->depthlevel = get_field($hierarchy->prefix.'_depth', 'MAX(depthlevel) + 1', 'frameworkid', $frameworkid);
    if (!$depth->depthlevel) {
        $depth->depthlevel = 1;
    }

} else {
    // editing existing depth level
    require_capability('moodle/local:updatecompetencydepth', $context);
    if (!$depth = $hierarchy->get_depth_by_id($id)) {
        error('Depth level ID was incorrect');
    }
}

// Load framework
if (!$framework = get_record($hierarchy->prefix.'_framework', 'id', $depth->frameworkid)) {
    error('Framework ID was incorrect');
}

// create form
$datatosend = array('prefix' => $hierarchy->prefix, 'spage' => $spage);
$depthform  = new depth_edit_form(null, $datatosend);
$depthform->set_data($depth);

// cancelled
if ($depthform->is_cancelled()){

    redirect("$CFG->wwwroot/competency/index.php?frameworkid=$framework->id&spage=$spage");

// update data
} else if ($depthnew = $depthform->get_data()) {

    $depthnew->timemodified = time();
    $depthnew->usermodified = $USER->id;

    // new depth level
    if ($depthnew->id == 0) {
        unset($depthnew->id);

        $depthnew->timecreated = time();

        if (!$depthnew->id = insert_record($hierarchy->prefix.'_depth', $depthnew)) {
            error('Error creating '.$hierarchy->prefix.' depth level record');
        }

    // Existing depth level
    } else {
        if (!update_record($hierarchy->prefix.'_depth', $depthnew)) {
            error('Error updating '.$hierarchy->prefix.' depth level record');
        }
    }

    // Reload from db
    $depthnew = get_record($hierarchy->prefix.'_depth', 'id', $depthnew->id);

    // Log
    add_to_log(SITEID, 'competency', 'update depth level', "depth/edit.php?id=$depthnew->id", '');

    redirect("$CFG->wwwroot/competency/index.php?frameworkid=$depthnew->frameworkid&spage=$spage");
    //never reached
}


/// Display page header
admin_externalpage_print_header();

if ($depth->id == 0) {
    print_heading(get_string('adddepthlevel', 'competency'));
} else {
    print_heading(get_string('editdepthlevel', 'competency'));
}

/// Finally display the form
$depthform->display();

print_footer();

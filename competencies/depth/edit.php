<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/competencies/depth/edit_form.php');

// depth level id; 0 if creating a new depth level
$id = optional_param('id', 0, PARAM_INT);
// framework id; required if creating a new depth level
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);

// We require either an id for editing, or a framework for creating
if (!$id && !$frameworkid) {
    error('Incorrect parameters');
}

// Make this page appear under the manage competencies admin item
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competencies/depthlevel.php');

$context = get_context_instance(CONTEXT_SYSTEM);

if ($id == 0) {
    // creating new depth level
    require_capability('moodle/local:createcompetencydepth', $context);

    $depth = new object();
    $depth->id = 0;
    $depth->frameworkid = $frameworkid;

    // Calculate next depth level
    $depth->depthlevel = get_field('competency_depth', 'MAX(depthlevel) + 1', 'frameworkid', $frameworkid);
    if (!$depth->depthlevel) {
        $depth->depthlevel = 1;
    }

} else {
    // editing existing depth level
    require_capability('moodle/local:updatecompetencydepth', $context);

    if (!$depth = get_record('competency_depth', 'id', $id)) {
        error('Competency depth level ID was incorrect');
    }
}

// Load framework
if (!$framework = get_record('competency_framework', 'id', $depth->frameworkid)) {
    error('Competency framework ID was incorrect');
}

// create form
$depthform = new competencydepth_edit_form();
$depthform->set_data($depth);

// cancelled
if ($depthform->is_cancelled()){

    redirect("$CFG->wwwroot/competencies/index.php?frameworkid=$framework->id");

// update data
} else if ($depthnew = $depthform->get_data()) {

    $competencynew->timemodified = time();
    $competencynew->usermodified = $USER->id;

    // new depth level
    if ($depthnew->id == 0) {
        unset($depthnew->id);

        $depthnew->timecreated = time();

        if (!$depthnew->id = insert_record('competency_depth', $depthnew)) {
            error('Error creating competency depth level record');
        }

    // Existing depth level
    } else {
        if (!update_record('competency_depth', $depthnew)) {
            error('Error updating competency depth level record');
        }
    }

    // Reload from db
    $depthnew = get_record('competency_depth', 'id', $depthnew->id);

    // Log
    add_to_log(SITEID, 'competencies', 'update depth level', "depth/edit.php?id=$depthnew->id", '');

    redirect("$CFG->wwwroot/competencies/index.php?frameworkid=$depthnew->frameworkid");
    //never reached
}


/// Display page header
admin_externalpage_print_header();

if ($depth->id == 0) {
    print_heading(get_string('adddepthlevel', 'competencies'));
} else {
    print_heading(get_string('editdepthlevel', 'competencies'));
}

/// Finally display the form
$depthform->display();

print_footer();

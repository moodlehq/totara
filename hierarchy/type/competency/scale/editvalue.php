<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('editvalue_form.php');


///
/// Setup / loading data
///

// Scale value id; 0 if inserting
$id = optional_param('id', 0, PARAM_INT);
// Competency scale id
$scaleid = optional_param('scaleid', 0, PARAM_INT);

// Make sure we have at least one or the other
if (!$id && !$scaleid) {
    error('Incorrect parameters');
}

// Page setup and check permissions
admin_externalpage_setup('competencyscales');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

if ($id == 0) {
    // Creating new scale value
    require_capability('moodle/local:createcompetency', $sitecontext);

    $value = new object();
    $value->id = 0;
    $value->scaleid = $scaleid;
    $value->sortorder = get_field('competency_scale_values', 'MAX(sortorder) + 1', 'scaleid', $value->scaleid);
    if (!$value->sortorder) {
        $value->sortorder = 1;
    }

} else {
    // Editing scale value
    require_capability('moodle/local:updatecompetency', $sitecontext);

    if (!$value = get_record('competency_scale_values', 'id', $id)) {
        error('Scale value ID was incorrect');
    }
}

if (!$scale = get_record('competency_scale', 'id', $value->scaleid)) {
    error('Competency scale ID was incorrect');
}

// Save scale name for display in the form
$value->scalename = $scale->name;


///
/// Display page
///

// Create form
$valueform = new competencyscalevalue_edit_form();
$valueform->set_data($value);

// cancelled
if ($valueform->is_cancelled()) {

    redirect("$CFG->wwwroot/competency/scale/view.php?id={$value->scaleid}");

// Update data
} else if ($valuenew = $valueform->get_data()) {

    $valuenew->timemodified = time();
    $valuenew->usermodified = $USER->id;

    if (!strlen($valuenew->numeric)) {
        $valuenew->numeric = null;
    }

    // Save
    // New scale value
    if ($valuenew->id == 0) {
        unset($valuenew->id);

        if (!$valuenew->id = insert_record('competency_scale_values', $valuenew)) {
            error('Error creating scale value record');
        }

    // Updating scale value
    } else {
        if (!update_record('competency_scale_values', $valuenew)) {
            error('Error updating scale value record');
        }
    }

    // Reload from database
    $valuenew = get_record('competency_scale_values', 'id', $valuenew->id);

    // Log
    add_to_log(SITEID, 'competencyscalevalue', 'update', "view.php?id={$valuenew->scaleid}");

    redirect("$CFG->wwwroot/competency/scale/view.php?id={$valuenew->scaleid}");
    // never reached
}

// Display page header
admin_externalpage_print_header();

if ($id == 0) {
    print_heading(get_string('addnewscalevalue', 'competency'));
} else {
    print_heading(get_string('editscalevalue', 'competency'));
}

$valueform->display();

/// and proper footer
print_footer();

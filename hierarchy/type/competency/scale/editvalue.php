<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('editvalue_form.php');
require_once($CFG->dirroot . '/hierarchy/type/competency/scale/lib.php');


///
/// Setup / loading data
///

// Scale value id; 0 if inserting
$id = optional_param('id', 0, PARAM_INT);
$type = required_param('type', PARAM_TEXT);
// Competency scale id
$scaleid = optional_param('scaleid', 0, PARAM_INT);

// Make sure we have at least one or the other
if (!$id && !$scaleid) {
    error('Incorrect parameters');
}


// Page setup and check permissions
admin_externalpage_setup($type.'frameworkmanage');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

if ($id == 0) {
    // Creating new scale value
    require_capability('moodle/local:createcompetency', $sitecontext);

    $value = new object();
    $value->id = 0;
    $value->scaleid = $scaleid;
    $value->sortorder = get_field('comp_scale_values', 'MAX(sortorder) + 1', 'scaleid', $value->scaleid);
    if (!$value->sortorder) {
        $value->sortorder = 1;
    }

} else {
    // Editing scale value
    require_capability('moodle/local:updatecompetency', $sitecontext);

    if (!$value = get_record('comp_scale_values', 'id', $id)) {
        error('Scale value ID was incorrect');
    }
}

if (!$scale = get_record('comp_scale', 'id', $value->scaleid)) {
    error('Competency scale ID was incorrect');
}

$scale_used = competency_scale_is_used($scale->id);

// Save scale name for display in the form
$value->scalename = $scale->name;

// check scale isn't being used when adding new scale values
if($value->id == 0 && $scale_used) {
    error('You cannot add a scale value to a scale that is in use.');
}

///
/// Display page
///

// Create form
$valueform = new competencyscalevalue_edit_form(null, array('scaleid' => $scale->id, 'id' => $id));
$valueform->set_data($value);

// cancelled
if ($valueform->is_cancelled()) {

    redirect("$CFG->wwwroot/hierarchy/type/competency/scale/view.php?id={$value->scaleid}&amp;type=competency");

// Update data
} else if ($valuenew = $valueform->get_data()) {

    $valuenew->timemodified = time();
    $valuenew->usermodified = $USER->id;

    if (!strlen($valuenew->numericscore)) {
        $valuenew->numericscore = null;
    }

    // Save
    // New scale value
    if ($valuenew->id == 0) {
        unset($valuenew->id);

        if ($valuenew->id = insert_record('comp_scale_values', $valuenew)) {
            // Log
            add_to_log(SITEID, 'competencyscalevalue', 'added', "view.php?id={$valuenew->scaleid}&amp;type=competency");

            totara_set_notification(get_string('scalevalueadded', 'competency', format_string(stripslashes($valuenew->name))),"$CFG->wwwroot/hierarchy/type/competency/scale/view.php?id={$valuenew->scaleid}&amp;type=competency", array('style' => 'notifysuccess'));
        } else {
            error('Error creating scale value record');
        }

    // Updating scale value
    } else {
        if (update_record('comp_scale_values', $valuenew)) {
            // Log
            add_to_log(SITEID, 'competencyscalevalue', 'update', "view.php?id={$valuenew->scaleid}&amp;type=competency");

            totara_set_notification(get_string('scalevalueupdated', 'competency', format_string(stripslashes($valuenew->name))),"$CFG->wwwroot/hierarchy/type/competency/scale/view.php?id={$valuenew->scaleid}&amp;type=competency", array('style' => 'notifysuccess'));
        } else {
            error('Error updating scale value record');
        }
    }
}

// Display page header
admin_externalpage_print_header();

if ($id == 0) {
    print_heading(get_string('addnewscalevalue', 'competency'));
} else {
    print_heading(get_string('editscalevalue', 'competency'));
}

// Display warning if scale is in use
if($scale_used) {
    print_container(get_string('competencyscaleinuse', 'competency'), true, 'notifysuccess');
}

$valueform->display();

/// and proper footer
print_footer();

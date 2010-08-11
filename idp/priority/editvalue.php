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
$priorityscaleid = optional_param('priorityscaleid', 0, PARAM_INT);

// Make sure we have at least one or the other
if (!$id && !$priorityscaleid) {
    error('Incorrect parameters');
}

// Page setup and check permissions
admin_externalpage_setup('idppriorities');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

if ($id == 0) {
    // Creating new scale value
    require_capability('moodle/local:manageidppriorities', $sitecontext);

    $value = new stdClass();
    $value->id = 0;
    $value->priorityscaleid = $priorityscaleid;
    $value->sortorder = get_field('idp_tmpl_priority_scal_val', 'MAX(sortorder) + 1', 'priorityscaleid', $value->priorityscaleid);
    if (!$value->sortorder) {
        $value->sortorder = 1;
    }

} else {
    // Editing scale value
    require_capability('moodle/local:manageidppriorities', $sitecontext);

    if (!$value = get_record('idp_tmpl_priority_scal_val', 'id', $id)) {
        error('Scale value ID was incorrect');
    }
}
if (!$scale = get_record('idp_tmpl_priority_scale', 'id', $value->priorityscaleid)) {
    error('Priority scale ID was incorrect');
}

// Save priority scale name for display in the form
$value->scalename = format_string($scale->name);


///
/// Display page
///

// Create form
$valueform = new idp_priority_scale_value_edit_form();
$valueform->set_data($value);

// cancelled
if ($valueform->is_cancelled()) {

    redirect("$CFG->wwwroot/idp/priority/view.php?id={$value->priorityscaleid}");

// Update data
} else if ($valuenew = $valueform->get_data()) {

    $valuenew->timemodified = time();
    $valuenew->usermodified = $USER->id;

    if (!strlen($valuenew->numericscore)) {
        $valuenew->numericscore = null;
    }

    // Save
    // New priority scale value
    if ($valuenew->id == 0) {
        unset($valuenew->id);

        if (!$valuenew->id = insert_record('idp_tmpl_priority_scal_val', $valuenew)) {
            error('Error creating priority scale value record');
        }

    // Updating priority scale value
    } else {
        if (!update_record('idp_tmpl_priority_scal_val', $valuenew)) {
            error('Error updating priority scale value record');
        }
    }

    // Reload from database
    $valuenew = get_record('idp_tmpl_priority_scal_val', 'id', $valuenew->id);

    // Log
    add_to_log(SITEID, 'priorityscalevalue', 'update', "view.php?id={$valuenew->priorityscaleid}");

    redirect("$CFG->wwwroot/idp/priority/view.php?id={$valuenew->priorityscaleid}");
    // never reached
}

// Display page header
admin_externalpage_print_header();

if ($id == 0) {
    print_heading(get_string('addnewpriorityvalue', 'idp'));
} else {
    print_heading(get_string('editpriorityvalue', 'idp'));
}

$valueform->display();

/// and proper footer
print_footer();

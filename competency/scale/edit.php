<?php

require_once '../../config.php';
require_once $CFG->libdir.'/adminlib.php';
require_once 'edit_form.php';


///
/// Setup / loading data
///

// Get paramters
// Scale id; 0 if creating a new scale
$id = optional_param('id', 0, PARAM_INT);

admin_externalpage_setup('competencyscales');
$sitecontext = get_context_instance(CONTEXT_SYSTEM);

if ($id == 0) {
    // creating new competency scale
    require_capability('moodle/local:createcompetency', $sitecontext);

    $scale = new object();
    $scale->id = 0;
    $scale->sortorder = get_field('competency_framework', 'MAX(sortorder) + 1', '', '');
    if (!$scale->sortorder) {
        $scale->sortorder = 1;
    }

} else {
    // editing existing competency scale
    require_capability('moodle/local:updatecompetency', $sitecontext);

    if (!$scale = get_record('competency_scale', 'id', $id)) {
        error('Competency scale ID was incorrect');
    }
}


///
/// Handle form data
///

$mform = new edit_scale_form();
$mform->set_data($scale);

// If cancelled
if ($mform->is_cancelled()) {

    redirect("$CFG->wwwroot/competency/scale/index.php");

// Update data
} else if ($scalenew = $mform->get_data()) {

    $scalenew->timemodified = time();
    $scalenew->usermodified = $USER->id;

    if (empty($scalenew->id)) {
        unset($scalenew->id);

        if (!$scalenew->id = insert_record('competency_scale', $scalenew)) {
            error('Error creating new competency scale');
        }

    } else {
        if (!update_record('competency_scale', $scalenew)) {
            error('Error updating competency scale');
        }
    }

    // Reload from db
    $scalenew = get_record('competency_scale', 'id', $scalenew->id);

    // Log
    add_to_log(SITEID, 'competencyscales', 'update', "view.php?id=$scalenew->id", '');

    redirect("$CFG->wwwroot/competency/scale/view.php?id={$scalenew->id}");
}

admin_externalpage_print_header();
print_heading(get_string('scalescustomcreate'));
$mform->display();

admin_externalpage_print_footer();

<?php

// Make this page appear under the manage 'hierarchy' admin menu
admin_externalpage_setup($type.'frameworkmanage', '', array(), '', $CFG->wwwroot.'/hierarchy/type/competency/framework/edit.php?type='.$type);

if ($id == 0) {
    // Creating new framework
    require_capability('moodle/local:create'.$type.'frameworks', $context);

    $framework = new object();
    $framework->id = 0;
    $framework->visible = 1;
    $framework->isdefault = 0;
    $framework->sortorder = get_field($type.'_framework', 'MAX(sortorder) + 1', '', '');
    $framework->hidecustomfields = 0;
    $framework->showitemfullname = 0;
    $framework->showdepthfullname = 0;
    if (!$framework->sortorder) {
        $framework->sortorder = 1;
    }
    $framework->scale = array();

} else {
    // Editing existing framework
    require_capability('moodle/local:update'.$type.'frameworks', $context);

    if (!$framework = get_record($type.'_framework', 'id', $id)) {
        error($type.' framework ID was incorrect');
    }

    // Load scale assignments
    $scales = get_records($type.'_scale_assignments', 'frameworkid', $framework->id);
    $framework->scale = array();
    if ($scales) {
        foreach ($scales as $scale) {
            $framework->scale[] = $scale->scaleid;
        }
    }
}

// create form
$frameworkform = new framework_edit_form();
$frameworkform->set_data($framework);

// cancelled
if ($frameworkform->is_cancelled()) {

    redirect("$CFG->wwwroot/hierarchy/framework/index.php?type=$type");

// Update data
} else if ($frameworknew = $frameworkform->get_data()) {

    $time = time();

    $frameworknew->timemodified = $time;
    $frameworknew->usermodified = $USER->id;

    // Save
    // New framework
    if ($frameworknew->id == 0) {
        unset($frameworknew->id);

        $frameworknew->timecreated = $time;

        if (!$frameworknew->id = insert_record($type.'_framework', $frameworknew)) {
            error('Error creating '.$type.' framework record');
        }

    // Existing framework
    } else {
        if (!update_record($type.'_framework', $frameworknew)) {
            error('Error updating '.$type.' framework record');
        }
    }

    // Handle scale assignments
    // Get new assignments
    $scales_new = array_diff($frameworknew->scale, $framework->scale);
    foreach ($scales_new as $key) {
        $assignment = new object();
        $assignment->scaleid = $key;
        $assignment->frameworkid = $frameworknew->id;
        $assignment->timemodified = $time;
        $assignment->usermodified = $USER->id;
        if (!insert_record($type.'_scale_assignments', $assignment)) {
            error('Could not add scale assignment');
        }
    }

    // Get removed assignments
    $scales_removed = array_diff($framework->scale, $frameworknew->scale);
    foreach ($scales_removed as $key) {
        if (!delete_records($type.'_scale_assignments', 'scaleid', $key, 'frameworkid', $frameworknew->id)) {
            error('Could not delete scale assignment');
        }
    }


    // Reload from db
    $frameworknew = get_record($type.'_framework', 'id', $frameworknew->id);

    // Log
    add_to_log(SITEID, $type.'frameworks', 'update', "view.php?id=$frameworknew->id", '');

    redirect("$CFG->wwwroot/hierarchy/framework/index.php?type=$type");
    //never reached
}


/// Display page header
admin_externalpage_print_header();

if ($framework->id == 0) {
    print_heading(get_string('addnewframework', $type));
} else {
    print_heading(get_string('editframework', $type));
}

/// Finally display THE form
$frameworkform->display();

/// and proper footer
print_footer();

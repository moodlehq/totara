<?php
require_once($CFG->dirroot.'/hierarchy/lib.php');
require_once($CFG->dirroot.'/hierarchy/prefix/competency/scale/lib.php');

$shortprefix = hierarchy::get_short_prefix($prefix);
// Make this page appear under the manage 'hierarchy' admin menu
admin_externalpage_setup($prefix.'manage', '', array(), '', $CFG->wwwroot.'/hierarchy/prefix/competency/framework/edit.php?prefix='.$prefix);

if ($id == 0) {
    // Creating new framework
    require_capability('moodle/local:create'.$prefix.'frameworks', $context);

    // Don't show the page if there are no scales
    if (!competency_scales_available()) {

        /// Display page header
        admin_externalpage_print_header();
        notice(get_string('nocompetencyscales','competency'), "{$CFG->wwwroot}/hierarchy/framework/index.php?prefix=competency" );
        print_footer();
        die();
    }

    $framework = new object();
    $framework->id = 0;
    $framework->visible = 1;
    $framework->sortorder = get_field($shortprefix.'_framework', 'MAX(sortorder) + 1', '', '');
    $framework->hidecustomfields = 0;
    if (!$framework->sortorder) {
        $framework->sortorder = 1;
    }
    $framework->scale = array();

} else {
    // Editing existing framework
    require_capability('moodle/local:update'.$prefix.'frameworks', $context);

    if (!$framework = get_record($shortprefix.'_framework', 'id', $id)) {
        error($prefix.' framework ID was incorrect');
    }

    // Load scale assignments
    $scales = get_records($shortprefix.'_scale_assignments', 'frameworkid', $framework->id);
    $framework->scale = array();
    if ($scales) {
        foreach ($scales as $scale) {
            $framework->scale[] = $scale->scaleid;
        }
    }
}

// create form
$frameworkform = new framework_edit_form(null, array('frameworkid'=>$id));
$frameworkform->set_data($framework);

// cancelled
if ($frameworkform->is_cancelled()) {

    redirect("$CFG->wwwroot/hierarchy/framework/index.php?prefix=$prefix");

// Update data
} else if ($frameworknew = $frameworkform->get_data()) {

    // Validate that the selected framework contains at least one framework value
    if ( !isset($frameworknew->scale) || 0 == count_records('comp_scale_values','scaleid',$frameworknew->scale) ){
        error("Can't assign a scale that contains no scale values.");
    }

    $time = time();

    $frameworknew->timemodified = $time;
    $frameworknew->usermodified = $USER->id;

    // Save
    // New framework
    if ($frameworknew->id == 0) {
        unset($frameworknew->id);

        $frameworknew->timecreated = $time;

        if (!$frameworknew->id = insert_record($shortprefix.'_framework', $frameworknew)) {
            error('Error creating '.$prefix.' framework record');
        }

    // Existing framework
    } else {
        if (!update_record($shortprefix.'_framework', $frameworknew)) {
            error('Error updating '.$prefix.' framework record');
        }
    }

    // Handle scale assignments
    // Get new assignments
    if (isset($frameworknew->scale)) {
        $scales_new = array_diff(array($frameworknew->scale), $framework->scale);
        foreach ($scales_new as $key) {
            $assignment = new object();
            $assignment->scaleid = $key;
            $assignment->frameworkid = $frameworknew->id;
            $assignment->timemodified = $time;
            $assignment->usermodified = $USER->id;
            if (!insert_record($shortprefix.'_scale_assignments', $assignment)) {
                error('Could not add scale assignment');
            }
        }

        // Get removed assignments
        $scales_removed = array_diff($framework->scale, array($frameworknew->scale));
    }
    else {
        $scales_removed = $framework->scale;
    }

    foreach ($scales_removed as $key) {
        if (!delete_records($shortprefix.'_scale_assignments', 'scaleid', $key, 'frameworkid', $frameworknew->id)) {
            error('Could not delete scale assignment');
        }
    }


    // Reload from db
    $frameworknew = get_record($shortprefix.'_framework', 'id', $frameworknew->id);

    // Log
    // New framework
    if ($framework->id == 0) {
        add_to_log(SITEID, $prefix, 'framework create', "framework/view.php?prefix={$prefix}&amp;frameworkid={$frameworknew->id}", "$frameworknew->fullname (ID $frameworknew->id)");
    } else {
        add_to_log(SITEID, $prefix, 'framework update', "framework/view.php?prefix={$prefix}&amp;frameworkid={$frameworknew->id}", "$framework->fullname (ID $framework->id)");
    }

    redirect("$CFG->wwwroot/hierarchy/framework/index.php?prefix=$prefix");
    //never reached
}


/// Display page header
$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("{$prefix}frameworks", $prefix),
                    'link'=>"{$CFG->wwwroot}/hierarchy/framework/index.php?prefix={$prefix}",
                    'type'=>'misc');
if ($id == 0) {
    $navlinks[] = array('name'=>get_string('addnewframework', $prefix), 'link'=>'', 'type'=>'misc');
} else {
    $navlinks[] = array('name'=>format_string($framework->fullname), 'link'=>'', 'type'=>'misc');
}

admin_externalpage_print_header('', $navlinks);

if ($framework->id == 0) {
    print_heading(get_string('addnewframework', $prefix));
} else {
    print_heading(format_string($framework->fullname), '', 1);
}

/// Finally display THE form
$frameworkform->display();

/// and proper footer
print_footer();

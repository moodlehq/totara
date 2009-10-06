<?php

require_once('../config.php');
require_once('./lib.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/competencies/edit_form.php');
require_once($CFG->dirroot.'/lib/customfield/lib.php');


///
/// Setup / loading data
///

// competency id; 0 if creating new competency
$id = optional_param('id', 0, PARAM_INT);
// framework id; required when creating a new competency
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);

// We require either an id for editing, or a framework for creating
if (!$id && !$frameworkid) {
    error('Incorrect parameters');
}

// Make this page appear under the manage competencies admin item
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competencies/edit.php');

$context = get_context_instance(CONTEXT_SYSTEM);

if ($id == 0) {
    // creating new competency
    require_capability('moodle/local:createcompetencies', $context);

    $competency = new object();
    $competency->id = 0;
    $competency->frameworkid = $frameworkid;
    $competency->visible = 1;
    $competency->sortorder = 1;
    $competency->aggregationmethod = $COMP_AGGREGATION['ALL'];

} else {
    // editing existing competency
    require_capability('moodle/local:updatecompetencies', $context);

    if (!$competency = get_record('competency', 'id', $id)) {
        error('Competency ID was incorrect');
    }
}

// Load framework
if (!$framework = get_record('competency_framework', 'id', $competency->frameworkid)) {
    error('Competency framework ID was incorrect');
}
$competency->framework = $framework->fullname;


///
/// Display page
///

// create form
$competencyform = new competency_edit_form(null, compact('competency'));
$competencyform->set_data($competency);

// cancelled
if ($competencyform->is_cancelled()) {

    redirect("$CFG->wwwroot/competencies/index.php?frameworkid=$competency->frameworkid");

// Update data
} else if ($competencynew = $competencyform->get_data()) {

    $competencynew->timemodified = time();
    $competencynew->usermodified = $USER->id;

    $competencynew->scaleid = 1;
    $competencynew->proficiencyexpected = 1;

    // Load parent competency if set
    if ($competencynew->parentid) {
        if (!$parent = get_record('competency', 'id', $competencynew->parentid)) {
            error('Parent competency ID was incorrect');
        }
        $parent_depth = get_field('competency_depth', 'depthlevel', 'id', $parent->depthid);

    } else {
        $parent_depth = 0;
    }

    $competencynew->depthid = get_field('competency_depth', 'id', 'frameworkid', $competencynew->frameworkid, 'depthlevel', $parent_depth + 1);

    // Start db operations
    begin_sql();

    // Sort order
    // Need to update if parent changed or new
    if (!isset($competency->parentid) || $competencynew->parentid != $competency->parentid) {

        // Find highest sortorder of siblings
        $path = $competencynew->parentid ? $parent->path : '';
        $sql = "SELECT MAX(sortorder) FROM {$CFG->prefix}competency WHERE frameworkid = {$competencynew->frameworkid}";
        if ($path) {
            $sql .= " AND path LIKE '{$path}%'";
        }

        $sortorder = (int) get_field_sql($sql);

        // Find the next sortorder
        $competencynew->sortorder = $sortorder + 1;

        // Increment all following competencies
        execute_sql("UPDATE {$CFG->prefix}competency SET sortorder = sortorder + 1 WHERE sortorder > $sortorder AND frameworkid = {$competencynew->frameworkid}", false);
    }

    // Create path for finding ancestors
    $competencynew->path = ($competencynew->parentid ? $parent->path : '') . '/' . ($competencynew->id != 0 ? $competencynew->id : '');

    // Save
    // New competency
    if ($competencynew->id == 0) {
        unset($competencynew->id);

        $competencynew->timecreated = time();

        if (!$competencynew->id = insert_record('competency', $competencynew)) {
            error('Error creating competency record');
        }

        // Can't set the full path till we know the id!
        set_field('competency', 'path', $competencynew->path.$competencynew->id, 'id', $competencynew->id);

    // Existing competency
    } else {
        if (!update_record('competency', $competencynew)) {
            error('Error updating competency record');
        }
    }

    // Commit db operations
    commit_sql();

    // Reload from db
    $competencynew = get_record('competency', 'id', $competencynew->id);

    // Log
    add_to_log(SITEID, 'competencies', 'update', "view.php?id=$competencynew->id", '');

    redirect("$CFG->wwwroot/competencies/index.php?frameworkid=$competencynew->frameworkid");
    //never reached
}


/// Display page header
admin_externalpage_print_header();

if ($competency->id == 0) {
    print_heading(get_string('addnewcompetency', 'competencies'));
} else {
    print_heading(get_string('editcompetency', 'competencies'));
}

/// Finally display THE form
$competencyform->display();

/// and proper footer
print_footer();

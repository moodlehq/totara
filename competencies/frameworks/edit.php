<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/competencies/frameworks/edit_form.php');

// capability id; 0 if creating new framework
$id = optional_param('id', 0, PARAM_INT);

// Make this page appear under the manage competencies admin item
admin_externalpage_setup('competencyframeworkmanage', '', array(), '', $CFG->wwwroot.'/competencies/framework/edit.php');

$context = get_context_instance(CONTEXT_SYSTEM);

if ($id == 0) {
    // creating new competency framework
    require_capability('moodle/local:createcompetencyframeworks', $context);

    $framework = new object();
    $framework->id = 0;
    $framework->visible = 1;
    $framework->isdefault = 0;
    $framework->sortorder = get_field('competency_framework', 'MAX(sortorder) + 1', '', '');

} else {
    // editing existing competency framework
    require_capability('moodle/local:updatecompetencyframeworks', $context);

    if (!$framework = get_record('competency_framework', 'id', $id)) {
        error('Competency framework ID was incorrect');
    }
}

// create form
$competencyform = new competencyframework_edit_form();
$competencyform->set_data($framework);

// cancelled
if ($competencyform->is_cancelled()) {

    redirect("$CFG->wwwroot/competencies/frameworks/index.php");

// Update data
} else if ($frameworknew = $competencyform->get_data()) {

    $frameworknew->timemodified = time();
    $frameworknew->usermodified = $USER->id;

    // Save
    // New framework
    if ($frameworknew->id == 0) {
        unset($frameworknew->id);

        $frameworknew->timecreated = time();

        if (!$frameworknew->id = insert_record('competency_framework', $frameworknew)) {
            error('Error creating competency framework record');
        }

    // Existing framework
    } else {
        if (!update_record('competency_framework', $frameworknew)) {
            error('Error updating competency framework record');
        }
    }

    // Reload from db
    $frameworknew = get_record('competency_framework', 'id', $frameworknew->id);

    // Log
    add_to_log(SITEID, 'competencyframeworks', 'update', "view.php?id=$frameworknew->id", '');

    redirect("$CFG->wwwroot/competencies/frameworks/index.php");
    //never reached
}


/// Display page header
admin_externalpage_print_header();

if ($framework->id == 0) {
    print_heading(get_string('addnewframework', 'competencies'));
} else {
    print_heading(get_string('editframework', 'competencies'));
}

/// Finally display THE form
$competencyform->display();

/// and proper footer
print_footer();

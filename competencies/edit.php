<?php

require_once('../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/competencies/edit_form.php');

// capability id; 0 if creating new user
$id = optional_param('id', 0, PARAM_INT);

// Make this page appear under the manage competencies admin item
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competencies/edit.php');

$context = get_context_instance(CONTEXT_SYSTEM);

if ($id == 0) {
    // creating new competency
    require_capability('moodle/local:createcompetencies', $context);

    $competency = new object();
    $competency->id = 0;
    $competency->deleted = 0;
    $competency->frameworkid = 1;
    $competency->parentid    = 0;
    $competency->sortorder   = 1;
    $competency->aggregationmethod = 1;
    $competency->scaleid = 1;
    $competency->proficiencyexpected = 1;

} else {
    // editing existing competency
    require_capability('moodle/local:updatecompetencies', $context);

    if (!$competency = get_record('competency', 'id', $id)) {
        error('Competency ID was incorrect');
    }
}

// create form
$competencyform = new competency_edit_form();
$competencyform->set_data($competency);

// cancelled
if ($competencyform->is_cancelled()){

    if ($id == 0) {
        redirect("$CFG->wwwroot/competencies/index.php");
    } else {
        redirect("$CFG->wwwroot/competencies/view.php?id=$id");
    }

// update data
} else if ($competencynew = $competencyform->get_data()) {

    $competencynew->timemodified = time();
    $competencynew->usermodified = $USER->id;

    $competencynew->frameworkid = 1;
    $competencynew->parentid    = 0;
    $competencynew->sortorder   = 1;
    $competencynew->aggregationmethod = 1;
    $competencynew->scaleid = 1;
    $competencynew->proficiencyexpected = 1;
    $competencynew->depthid = 1;
    $competencynew->visible = 1;

    // new competency
    if ($competencynew->id == 0) {
        unset($competencynew->id);

        $competencynew->timecreated = time();

        if (!$competencynew->id = insert_record('competency', $competencynew)) {
            error('Error creating competency record');
        }

    // existing competency
    } else {
        if (!update_record('competency', $competencynew)) {
            error('Error updating competency record');
        }
    }

    // reload from db
    $competencynew = get_record('competency', 'id', $competencynew->id);

    // log
    add_to_log(1, 'competencies', 'update', "view.php?id=$competencynew->id", '');

    redirect("$CFG->wwwroot/competencies/view.php?id=$competencynew->id");
    //never reached
}


/// Display page header
admin_externalpage_print_header();

if ($competency->id == 0 {
    print_heading(get_string('addnewcompetency', 'competencies'));
} else {
    print_heading(get_string('editcompetency', 'competencies'));
}

/// Finally display THE form
$competencyform->display();

/// and proper footer
print_footer('none');

<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/template/edit_form.php');


///
/// Setup / loading data
///

// Template id; 0 if creating new template
$id = optional_param('id', 0, PARAM_INT);
// framework id; required when creating a new template
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);

// We require either an id for editing, or a framework for creating
if (!$id && !$frameworkid) {
    error('Incorrect parameters');
}

// Make this page appear under the manage templates admin item
admin_externalpage_setup('competencyframeworkmanage', '', array(), '', $CFG->wwwroot.'/competency/template/edit.php');

$context = get_context_instance(CONTEXT_SYSTEM);

if ($id == 0) {
    // Creating new competency template
    require_capability('moodle/local:createcompetencytemplate', $context);

    $template = new object();
    $template->id = 0;
    $template->visible = 1;
    $template->frameworkid = $frameworkid;

} else {
    // Editing existing competency template
    require_capability('moodle/local:updatecompetencytemplate', $context);

    if (!$template = get_record('comp_template', 'id', $id)) {
        error('Competency template ID was incorrect');
    }
}

// Load framework
if (!$framework = get_record('comp_framework', 'id', $template->frameworkid)) {
    error('Competency framework ID was incorrect');
}

// create form
$form = new competencytemplate_edit_form();
$form->set_data($template);

// cancelled
if ($form->is_cancelled()) {

    redirect("$CFG->wwwroot/hierarchy/framework/view.php?type=competency&frameworkid=".$framework->id);

// Update data
} else if ($templatenew = $form->get_data()) {

    $time = time();

    $templatenew->timemodified = $time;
    $templatenew->usermodified = $USER->id;

    // Save
    // New template
    if ($templatenew->id == 0) {
        unset($templatenew->id);

        $templatenew->timecreated = $time;
        $templatenew->competencycount = 0;

        if (!$frameworknew->id = insert_record('comp_template', $templatenew)) {
            error('Error creating competency template record');
        }

    // Existing template
    } else {
        if (!update_record('comp_template', $templatenew)) {
            error('Error updating competency template record');
        }
    }

    // Reload from db
    $templatenew = get_record('comp_template', 'id', $templatenew->id);

    // Log
    add_to_log(SITEID, 'competencytemplate', 'update', "view.php?id=$templatenew->id", '');

    redirect("$CFG->wwwroot/hierarchy/framework/view.php?type=competency&frameworkid=".$framework->id);
    //never reached
}


/// Display page header
$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("competencyframeworks", 'competency'), 
                    'link'=>"{$CFG->wwwroot}/hierarchy/framework/index.php?type=competency", 
                    'type'=>'misc');
$navlinks[] = array('name'=>format_string($framework->fullname), 
                    'link'=>"{$CFG->wwwroot}/hierarchy/framework/view.php?type=competency&frameworkid={$framework->id}", 
                    'type'=>'misc');    // Framework View    
if ($template->id == 0) {
    $heading = get_string('addnewtemplate', 'competency');
    $navlinks[] = array('name'=>$heading, 'link'=>'', 'type'=>'misc');
} else {
    $heading = get_string('editgeneric', 'competency', format_string($template->fullname));
    $navlinks[] = array('name'=>format_string($template->fullname), 'link'=>'', 'type'=>'misc');
}

admin_externalpage_print_header('', $navlinks);

print_heading($heading);

/// Finally display THE form
$form->display();

/// and proper footer
print_footer();

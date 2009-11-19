<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');

$type    = required_param('type', PARAM_SAFEDIR); // hierarchy type
$id      = optional_param('id', 0, PARAM_INT);    // 0 if creating a new framework
$context = get_context_instance(CONTEXT_SYSTEM);

// If the hierarchy type has framework editing files use them else use the generic files
if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/framework/edit.php')) {
    require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/framework/edit_form.php');
    require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/framework/edit.php');
    die;
} else {
    require_once($CFG->dirroot.'/hierarchy/framework/edit_form.php');
}

// Make this page appear under the manage 'hierarchy' admin menu
admin_externalpage_setup($type.'frameworkmanage', '', array(), '', $CFG->wwwroot.'/hierarchy/framework/edit.php?type='.$type);

if ($id == 0) {
    // Creating new framework
    require_capability('moodle/local:create'.$type.'frameworks', $context);

    $framework = new object();
    $framework->id = 0;
    $framework->visible = 1;
    $framework->isdefault = 0;
    $framework->sortorder = get_field($type.'_framework', 'MAX(sortorder) + 1', '', '');
    if (!$framework->sortorder) {
        $framework->sortorder = 1;
    }
    $framework->hidecustomfields = 0;
    $framework->showitemfullname = 0;
    $framework->showdepthfullname = 0;

} else {
    // Editing existing framework
    require_capability('moodle/local:update'.$type.'frameworks', $context);

    if (!$framework = get_record($type.'_framework', 'id', $id)) {
        error($type.' framework ID was incorrect');
    }
}

// create form
$frameworkform = new framework_edit_form(null, array('type'=>$type));
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

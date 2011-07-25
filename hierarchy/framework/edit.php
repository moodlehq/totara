<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');

hierarchy::support_old_url_syntax();

$prefix    = required_param('prefix', PARAM_ALPHA); // hierarchy prefix
$shortprefix = hierarchy::get_short_prefix($prefix);
$id      = optional_param('id', 0, PARAM_INT);    // 0 if creating a new framework
$context = get_context_instance(CONTEXT_SYSTEM);

$hierarchy = hierarchy::load_hierarchy($prefix);

// If the hierarchy prefix has framework editing files use them else use the generic files
if (file_exists($CFG->dirroot.'/hierarchy/prefix/'.$prefix.'/framework/edit.php')) {
    require_once($CFG->dirroot.'/hierarchy/prefix/'.$prefix.'/framework/edit_form.php');
    require_once($CFG->dirroot.'/hierarchy/prefix/'.$prefix.'/framework/edit.php');
    die;
} else {
    require_once($CFG->dirroot.'/hierarchy/framework/edit_form.php');
}

// Make this page appear under the manage 'hierarchy' admin menu
admin_externalpage_setup($prefix.'manage', '', array('prefix'=>$prefix, 'id' => $id), $CFG->wwwroot.'/hierarchy/framework/edit.php');

if ($id == 0) {
    // Creating new framework
    require_capability('moodle/local:create'.$prefix.'frameworks', $context);

    $framework = new object();
    $framework->id = 0;
    $framework->visible = 1;

    $framework->sortorder = get_field($shortprefix.'_framework', 'MAX(sortorder) + 1', '', '');
    if (!$framework->sortorder) {
        $framework->sortorder = 1;
    }
    $framework->hidecustomfields = 0;

} else {
    // Editing existing framework
    require_capability('moodle/local:update'.$prefix.'frameworks', $context);

    if (!$framework = get_record($shortprefix.'_framework', 'id', $id)) {
        error($prefix.' framework ID was incorrect');
    }
}

// create form
$frameworkform = new framework_edit_form(null, array('prefix'=>$prefix));
$frameworkform->set_data($framework);

// cancelled
if ($frameworkform->is_cancelled()) {

    redirect("$CFG->wwwroot/hierarchy/framework/index.php?prefix=$prefix");

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

        if (!$frameworknew->id = insert_record($shortprefix.'_framework', $frameworknew)) {
            error('Error creating '.$prefix.' framework record');
        }

        // Log
        add_to_log(SITEID, $prefix, 'framework create', "index.php?prefix={$prefix}&amp;frameworkid={$frameworknew->id}", "$frameworknew->fullname (ID $frameworknew->id)");

        totara_set_notification(get_string('addedframework', $prefix, format_string(stripslashes($frameworknew->fullname))), "$CFG->wwwroot/hierarchy/framework/index.php?prefix=$prefix", array('style' => 'notifysuccess'));
    // Existing framework
    } else {
        if (!update_record($shortprefix.'_framework', $frameworknew)) {
            error('Error updating '.$prefix.' framework record');
        }

        // Log
        add_to_log(SITEID, $prefix, 'framework update', "framework/view.php?prefix={$prefix}&amp;frameworkid={$frameworknew->id}", "$framework->fullname (ID $framework->id)");

        totara_set_notification(get_string('updatedframework', $prefix, format_string(stripslashes($frameworknew->fullname))), "$CFG->wwwroot/hierarchy/framework/index.php?prefix=$prefix", array('style' => 'notifysuccess'));
    }

    // Reload from db
    $frameworknew = get_record($shortprefix.'_framework', 'id', $frameworknew->id);

    redirect("$CFG->wwwroot/hierarchy/framework/index.php?prefix=$prefix");
    //never reached
}


/// Display page header
$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("{$prefix}frameworks", $prefix),
                    'link'=>"{$CFG->wwwroot}/hierarchy/framework/index.php?prefix={$prefix}",
                    'type'=>'misc');
if ($framework->id == 0) {
    $navlinks[] = array('name'=>get_string('addnewframework', $prefix), 'link'=>'', 'type'=>'misc');
} else {
    $navlinks[] = array('name'=>get_string('editgeneric', $prefix, $framework->fullname), 'link'=>'', 'type'=>'misc');
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

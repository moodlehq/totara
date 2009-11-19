<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');

// depth level id; 0 if creating a new depth level
$type    = required_param('type', PARAM_SAFEDIR); // hierarchy type
$id      = optional_param('id', 0, PARAM_INT);    // depth level id; 0 if creating a new depth level

// framework id; required if creating a new depth level
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);
$spage       = optional_param('spage', 0, PARAM_INT);

if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php')) {
    require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php');
    $hierarchy = new $type();
} else {
    error('error:hierarchytypenotfound', 'hierarchy', $type);
}   

// If the hierarchy type has depth editing files use them else use the generic files
if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/depth/edit.php')) {
    require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/depth/edit_form.php');
    require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/depth/edit.php');
    die;
} else {
    require_once($CFG->dirroot.'/hierarchy/depth/edit_form.php');
}

// We require either an id for editing, or a framework for creating
if (!$id && !$frameworkid) {
    error('Incorrect parameters');
}

// Make this page appear under the manage hierachy items admin menu
admin_externalpage_setup($type.'manage', '', array(), '', $CFG->wwwroot.'/'.$type.'/depthlevel.php');

$context = get_context_instance(CONTEXT_SYSTEM);

if ($id == 0) {
    // creating new depth level
    require_capability('moodle/local:create'.$type.'depth', $context);

    $depth = new object();
    $depth->id = 0;
    $depth->frameworkid = $frameworkid;

    // Calculate next depth level
    $depth->depthlevel = get_field($type.'_depth', 'MAX(depthlevel) + 1', 'frameworkid', $frameworkid);
    if (!$depth->depthlevel) {
        $depth->depthlevel = 1;
    }

} else {
    // editing existing depth level
    require_capability('moodle/local:update'.$type.'depth', $context);
    if (!$depth = $hierarchy->get_depth_by_id($id)) {
        error('Depth level ID was incorrect');
    }
}

// Load framework
if (!$framework = get_record($type.'_framework', 'id', $depth->frameworkid)) {
    error('Framework ID was incorrect');
}

// create form
$datatosend = array('type'=>$type, 'spage' => $spage);
$depthform  = new depth_edit_form(null, $datatosend);
$depthform->set_data($depth);

// cancelled
if ($depthform->is_cancelled()){

    redirect("$CFG->wwwroot/$type/index.php?frameworkid=$framework->id&spage=$spage");

// update data
} else if ($depthnew = $depthform->get_data()) {

    $depthnew->timemodified = time();
    $depthnew->usermodified = $USER->id;

    // new depth level
    if ($depthnew->id == 0) {
        unset($depthnew->id);

        $depthnew->timecreated = time();

        if (!$depthnew->id = insert_record($type.'_depth', $depthnew)) {
            error('Error creating '.$type.' depth level record');
        }

        // add a default custom field category for the depth
        $depthinfocategorynew            = new object();
        $depthinfocategorynew->name      = get_string('misc', 'admin');
        $depthinfocategorynew->sortorder = 1;
        $depthinfocategorynew->depthid   = $depthnew->id;

        if (!$depthnew->id = insert_record($type.'_depth_info_category', $depthinfocategorynew)) {
            error('Error creating '.$type.' depth info category record');
        }

    // Existing depth level
    } else {
        if (!update_record($type.'_depth', $depthnew)) {
            error('Error updating '.$type.' depth level record');
        }
    }

    // Reload from db
    $depthnew = get_record($type.'_depth', 'id', $depthnew->id);

    // Log
    add_to_log(SITEID, $type, 'update depth level', "depth/edit.php?id=$depthnew->id", '');

    redirect("$CFG->wwwroot/hierarchy/index.php?type=$type&frameworkid=$framework->id&spage=$spage");
    //never reached
}


/// Display page header
admin_externalpage_print_header();

if ($depth->id == 0) {
    print_heading(get_string('adddepthlevel', $type));
} else {
    print_heading(get_string('editdepthlevel', $type));
}

/// Finally display the form
$depthform->display();

print_footer();

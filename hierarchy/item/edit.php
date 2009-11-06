<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/customfield/fieldlib.php');

///
/// Setup / loading data
///

$type = required_param('type', PARAM_SAFEDIR);

// item id; 0 if creating new item
$id   = optional_param('id', 0, PARAM_INT);

// framework id; required when creating a new framework item 
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);
$spage       = optional_param('spage', 0, PARAM_INT);

if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/item/edit.php')) {
    if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php')) {
        require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php');
    }
    require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/item/edit_form.php');
    require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/item/edit.php');
    die;
} else {
    require_once('./edit_form.php');
}

// We require either an id for editing, or a framework for creating
if (!$id && !$frameworkid) {
    error('Incorrect parameters');
}

// Make this page appear under the manage competencies admin item
admin_externalpage_setup($type.'manage', '', array(), '', $CFG->wwwroot.'/'.$type.'/edit.php');

$context = get_context_instance(CONTEXT_SYSTEM);

if ($id == 0) {
    // creating new item
    require_capability('moodle/local:create'.$type, $context);

    $item = new object();
    $item->id = 0;
    $item->frameworkid = $frameworkid;
    $item->visible = 1;
    $item->sortorder = 1;
    $item->depthid = null;

} else {
    // editing existing item
    require_capability('moodle/local:update'.$type, $context);

    if (!$item = get_record($type, 'id', $id)) {
        error($type.' ID was incorrect');
    }

    // load custom fields data
    if ($id != 0) {
        customfield_load_data($item, $type, $type.'_depth');
    }
}

// Load framework
if (!$framework = get_record($type.'_framework', 'id', $frameworkid)) {
    error($type.' framework ID was incorrect');
}
$item->framework = $framework->fullname;


///
/// Display page
///

// create form
$datatosend = array('type' => $type, 'item' => $item, 'spage' => $spage);
$itemform = new item_edit_form(null, $datatosend);
$itemform->set_data($item);

// cancelled
if ($itemform->is_cancelled()) {

    redirect("$CFG->wwwroot/hierarchy/index.php?type=$item&frameworkid=$item->frameworkid&spage=$spage");

// Update data
} else if ($itemnew = $itemform->get_data()) {

    $itemnew->timemodified = time();
    $itemnew->usermodified = $USER->id;

    $itemnew->scaleid = 1;
    $itemnew->proficiencyexpected = 1;
    $itemnew->evidencecount = 0;

    // Load parent item if set
    if ($itemnew->parentid) {
        if (!$parent = get_record($type, 'id', $itemnew->parentid)) {
            error('Parent '.$type.' ID was incorrect');
        }
        $parent_depth = get_field($type.'_depth', 'depthlevel', 'id', $parent->depthid);

    } else {
        $parent_depth = 0;
    }

    $itemnew->depthid = get_field($type.'_depth', 'id', 'frameworkid', $itemnew->frameworkid, 'depthlevel', $parent_depth + 1);

    // Start db operations
    begin_sql();

    // Sort order
    // Need to update if parent changed or new
    if (!isset($item->parentid) || $itemnew->parentid != $item->parentid) {

        // Find highest sortorder of siblings
        $path = $itemnew->parentid ? $parent->path : '';
        $sql = "SELECT MAX(sortorder) FROM {$CFG->prefix}{$type} WHERE frameworkid = {$itemnew->frameworkid}";
        if ($path) {
            $sql .= " AND path LIKE '{$path}%'";
        }

        $sortorder = (int) get_field_sql($sql);

        // Find the next sortorder
        $itemnew->sortorder = $sortorder + 1;

        // Increment all following items
        execute_sql("UPDATE {$CFG->prefix}{$type} SET sortorder = sortorder + 1 WHERE sortorder > $sortorder AND frameworkid = {$itemnew->frameworkid}", false);
    }

    // Create path for finding ancestors
    $itemnew->path = ($itemnew->parentid ? $parent->path : '') . '/' . ($itemnew->id != 0 ? $itemnew->id : '');

    // Save
    // New item
    if ($itemnew->id == 0) {
        unset($itemnew->id);

        $itemnew->timecreated = time();

        if (!$itemnew->id = insert_record($type, $itemnew)) {
            error('Error creating '.$type.' record');
        }

        // Can't set the full path till we know the id!
        set_field($type, 'path', $itemnew->path.$itemnew->id, 'id', $itemnew->id);

    // Existing item
    } else {
        if (update_record($type, $itemnew)) {
            customfield_save_data($itemnew, $type, $type.'_depth');
        } else {
            error('Error updating '.$type.' record');
        }
    }

    // Commit db operations
    commit_sql();

    // Reload from db
    $itemnew = get_record($type, 'id', $itemnew->id);

    // Log
    add_to_log(SITEID, $type, 'update', "view.php?id=$frameworkid", '');

    redirect("$CFG->wwwroot/hierarchy/index.php?type=$type&frameworkid=$frameworkid&spage=$spage");
    //never reached
}


/// Display page header
admin_externalpage_print_header();

if ($item->id == 0) {
    print_heading(get_string('addnew'.$type, $type));
} else {
    print_heading(get_string('edit'.$type, $type));
}

/// Finally display THE form
$itemform->display();

/// and proper footer
print_footer();

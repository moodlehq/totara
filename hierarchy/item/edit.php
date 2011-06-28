<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/customfield/fieldlib.php');
require_once($CFG->dirroot.'/hierarchy/item/edit_form.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');

///
/// Setup / loading data
///

$type = required_param('type', PARAM_SAFEDIR);
$shortprefix = hierarchy::get_short_prefix($type);

// item id; 0 if creating new item
$id   = optional_param('id', 0, PARAM_INT);

// framework id; required when creating a new framework item
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);
$spage       = optional_param('spage', 0, PARAM_INT);

// Confirm the type exists
if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php')) {
    require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php');
} else {
    error('Hierarchy type '.$type.' does not exist');
}

// Load any type specific code
if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/item/edit_form.php')) {
    require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/item/edit_form.php');
    $formname = $type.'_edit_form';
}
else {
    $formname = 'item_edit_form';
}

// We require either an id for editing, or a framework for creating
if (!$id && !$frameworkid) {
    error('Incorrect parameters');
}

// Make this page appear under the manage competencies admin item
admin_externalpage_setup($type.'manage', '', array('type'=>$type));

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

    if (!$item = get_record($shortprefix, 'id', $id)) {
        error($type.' ID was incorrect');
    }

    // load custom fields data
    if ($id != 0) {
        customfield_load_data($item, $type, $shortprefix.'_depth');
    }
}

// Load framework
if (!$framework = get_record($shortprefix.'_framework', 'id', $frameworkid)) {
    error($type.' framework ID was incorrect');
}
$item->framework = $framework->fullname;


///
/// Display page
///

// create form
$datatosend = array('type' => $type, 'item' => $item, 'spage' => $spage);
$itemform = new $formname(null, $datatosend);
$itemform->set_data($item);

// cancelled
if ($itemform->is_cancelled()) {

    redirect("{$CFG->wwwroot}/hierarchy/index.php?type={$type}&frameworkid={$item->frameworkid}");

// Update data
} else if ($itemnew = $itemform->get_data()) {

    $itemnew->timemodified = time();
    $itemnew->usermodified = $USER->id;

    if (!isset($itemnew->proficiencyexpected)) {
        $itemnew->proficiencyexpected = 1;
    }
    if (!isset($itemnew->evidencecount)) {
        $itemnew->evidencecount = 0;
    }

    // Load parent item if set
    if ($itemnew->parentid) {
        if (!$parent = get_record($shortprefix, 'id', $itemnew->parentid)) {
            error('Parent '.$type.' ID was incorrect');
        }
        $parent_depth = get_field($shortprefix.'_depth', 'depthlevel', 'id', $parent->depthid);

    } else {
        $parent_depth = 0;
    }

    $itemnew->depthid = get_field($shortprefix.'_depth', 'id', 'frameworkid', $itemnew->frameworkid, 'depthlevel', $parent_depth + 1);

    // Start db operations
    begin_sql();

    // Sort order
    // Need to update if parent changed or new
    if (!isset($item->parentid) || $itemnew->parentid != $item->parentid) {

        // Find highest sortorder of siblings
        $path = $itemnew->parentid ? $parent->path : '';
        $sql = "SELECT MAX(sortorder) FROM {$CFG->prefix}{$shortprefix} WHERE frameworkid = {$itemnew->frameworkid}";
        if ($path) {
            $sql .= " AND path LIKE '{$path}%'";
        }

        $sortorder = (int) get_field_sql($sql);

        // Find the next sortorder
        $itemnew->sortorder = $sortorder + 1;

        // Increment all following items
        execute_sql("UPDATE {$CFG->prefix}{$shortprefix} SET sortorder = sortorder + 1 WHERE sortorder > $sortorder AND frameworkid = {$itemnew->frameworkid}", false);
    }

    // Create path for finding ancestors
    $itemnew->path = ($itemnew->parentid ? $parent->path : '') . '/' . ($itemnew->id != 0 ? $itemnew->id : '');

    // Save
    // New item
    if ($itemnew->id == 0) {
        unset($itemnew->id);

        $itemnew->timecreated = time();

        if (!$itemnew->id = insert_record($shortprefix, $itemnew)) {
            error('Error creating '.$type.' record');
        }

        // Can't set the full path till we know the id!
        set_field($shortprefix, 'path', $itemnew->path.$itemnew->id, 'id', $itemnew->id);

    // Existing item
    } else {
        if (update_record($shortprefix, $itemnew)) {
            customfield_save_data($itemnew, $type, $shortprefix.'_depth');
        } else {
            error('Error updating '.$type.' record');
        }
    }

    // Commit db operations
    commit_sql();

    // Reload from db
    $itemnew = get_record($shortprefix, 'id', $itemnew->id);

    // Log
    add_to_log(SITEID, $type, 'update', "view.php?id=$frameworkid", '');

    redirect("{$CFG->wwwroot}/hierarchy/item/view.php?type={$type}&id={$itemnew->id}");
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

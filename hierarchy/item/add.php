<?php

// this page lets the user create a new hierarchy item from inside a lightbox
// first they must choose a framework, then a create form is displayed
// finally, the id of the newly created item is returned

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/customfield/fieldlib.php');
require_once($CFG->dirroot.'/hierarchy/item/edit_form.php');


///
/// Setup / loading data
///
$_POST = $_GET;
$type = required_param('type', PARAM_SAFEDIR);

$id   = 0; //new item

// framework id; required when creating a new framework item
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);

// Confirm the type exists
if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php')) {
    include($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php');
} else {
    error('Hierarchy type '.$type.' does not exist');
}


if(!$frameworkid) {
    // let the user pick the framework from a list
    if($frameworks = get_records($type.'_framework')) {
        print "<h2>Select a $type framework</h2>";
        foreach ($frameworks as $framework) {
            print '<p><a href="'.qualified_me().'&amp;frameworkid='.$framework->id.'">'.$framework->fullname.'</a></p>';
        }
    } else {
        print "<h2>No $type frameworks found</h2>";
    }
    exit;
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

// creating new item
require_capability('moodle/local:create'.$type, $context);

$item = new object();
$item->id = 0;
$item->frameworkid = $frameworkid;
$item->visible = 1;
$item->sortorder = 1;
$item->depthid = null;

// Load framework
if (!$framework = get_record($type.'_framework', 'id', $frameworkid)) {
    error($type.' framework ID was incorrect');
}
$item->framework = $framework->fullname;


///
/// Display page
///

// create form
$datatosend = array('type' => $type, 'item' => $item, 'spage' => 0);
$itemform = new $formname(null, $datatosend);
$itemform->set_data($item);

if ($itemnew = $itemform->get_data()) {

    $itemnew->timemodified = time();
    $itemnew->usermodified = $USER->id;

    if (isset($itemnew->scaleid)) {
        $itemnew->scaleid = $itemnew->scaleid;
    }

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

    // Save New item
    unset($itemnew->id);

    $itemnew->timecreated = time();

    if (!$itemnew->id = insert_record($type, $itemnew)) {
        error('Error creating '.$type.' record');
    }

    // Can't set the full path till we know the id!
    set_field($type, 'path', $itemnew->path.$itemnew->id, 'id', $itemnew->id);


    // Commit db operations
    commit_sql();

    // Reload from db
    $itemnew = get_record($type, 'id', $itemnew->id);

    // Log
    add_to_log(SITEID, $type, 'update', "view.php?id=$frameworkid", '');

    // if it succeeds, send back the new item ID and fullname for populating the evidence form
    print "newcomp:{$itemnew->id}:{$itemnew->fullname}";
    exit;
}

print_heading(get_string('addnew'.$type, $type));

/// Finally display THE form
$itemform->display();

<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage hierarchy
 */

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/customfield/fieldlib.php');
require_once($CFG->dirroot.'/hierarchy/item/edit_form.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');

hierarchy::support_old_url_syntax();

///
/// Setup / loading data
///

$prefix = required_param('prefix', PARAM_ALPHA);
$shortprefix = hierarchy::get_short_prefix($prefix);

// item id; 0 if creating new item
$id   = optional_param('id', 0, PARAM_INT);

// framework id; required when creating a new framework item
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);
$page       = optional_param('page', 0, PARAM_INT);

$hierarchy = hierarchy::load_hierarchy($prefix);

// We require either an id for editing, or a framework for creating
if (!$id && !$frameworkid) {
    error('Incorrect parameters');
}

// Make this page appear under the manage competencies admin item
admin_externalpage_setup($prefix.'manage', '', array('prefix'=>$prefix));

$context = get_context_instance(CONTEXT_SYSTEM);

if ($id == 0) {
    // creating new item
    require_capability('moodle/local:create'.$prefix, $context);

    $item = new object();
    $item->id = 0;
    $item->frameworkid = $frameworkid;
    $item->visible = 1;
    $item->sortorder = 1;
    $item->typeid = 0;

} else {
    // editing existing item
    require_capability('moodle/local:update'.$prefix, $context);

    if (!$item = get_record($shortprefix, 'id', $id)) {
        error($prefix.' ID was incorrect');
    }
    $frameworkid = $item->frameworkid;

    // load custom fields data
    if ($id != 0) {
        customfield_load_data($item, $prefix, $shortprefix.'_type');
    }
}

// Load framework
if (!$framework = get_record($shortprefix.'_framework', 'id', $frameworkid)) {
    error($prefix.' framework ID was incorrect');
}
$item->framework = $framework->fullname;


///
/// Display page
///

// create form
$datatosend = array('prefix' => $prefix, 'item' => $item, 'page' => $page);
$itemform = new item_edit_form(null, $datatosend);
$itemform->set_data($item);

// cancelled
if ($itemform->is_cancelled()) {

    redirect("{$CFG->wwwroot}/hierarchy/index.php?prefix={$prefix}&amp;frameworkid={$item->frameworkid}&amp;page=$page");

// Update data
} else if ($itemnew = $itemform->get_data()) {

    if (isset($itemnew->changetype)) {
        redirect($CFG->wwwroot . "/hierarchy/type/change.php?prefix={$prefix}&amp;frameworkid={$item->frameworkid}&amp;page={$page}&typeid={$itemnew->typeid}&amp;itemid={$itemnew->id}");
    }
    $itemnew->timemodified = time();
    $itemnew->usermodified = $USER->id;

    if (!isset($itemnew->proficiencyexpected)) {
        $itemnew->proficiencyexpected = 1;
    }
    if (!isset($itemnew->evidencecount)) {
        $itemnew->evidencecount = 0;
    }

    // Start db operations
    begin_sql();

    // Save
    // New item
    if ($itemnew->id == 0) {

        // Load parent item if set
        if ($itemnew->parentid) {
            if (!$parent = get_record($shortprefix, 'id', $itemnew->parentid)) {
                rollback_sql();
                error('Parent '.$prefix.' ID was incorrect');
            }
            $parent_depth = $parent->depthlevel;
            // put new children directly below the parent
            $parent_sort = $parent->sortorder;

        } else {
            $parent_depth = 0;
            // put new top level elements at the end of the list
            $parent_sort = get_field($shortprefix, 'MAX(sortorder)', 'frameworkid', $itemnew->frameworkid);
            // handle zero items in framework
            if (!$parent_sort) {
                $parent_sort = 0;
            }
        }

        $itemnew->depthlevel = $parent_depth + 1;
        $itemnew->sortorder = $parent_sort + 1;

        // update the sort order of all subsequent items
        // adds 1 to all items with a later sort order to make space for the new item
        if (!$hierarchy->reorder_remaining_items(1, $parent_sort, $itemnew->frameworkid)) {
            rollback_sql();
            error('Could not re-order other items in hierarchy');
        }

        // Create path for finding ancestors
        $itemnew->path = ($itemnew->parentid ? $parent->path : '') . '/' . ($itemnew->id != 0 ? $itemnew->id : '');

        unset($itemnew->id);

        $itemnew->timecreated = time();

        if (!$itemnew->id = insert_record($shortprefix, $itemnew)) {
            rollback_sql();
            error('Error creating '.$prefix.' record');
        }

        // Can't set the full path till we know the id!
        if (!set_field($shortprefix, 'path', $itemnew->path.$itemnew->id, 'id', $itemnew->id)) {
            rollback_sql();
            error('Error setting the item\'s path');
        }
        $add_or_update = 'added';

    // Existing item
    } else {
        // if parent has changed, save item with old parent, then move afterwards
        if ($item->parentid != $itemnew->parentid) {
            $newparentid = $itemnew->parentid;
            $oldparentid = $item->parentid;
            $itemnew->parentid = $oldparentid;
        }
        if (update_record($shortprefix, $itemnew)) {
            customfield_save_data($itemnew, $prefix, $shortprefix.'_type');

            if (isset($newparentid) && $updateditem = get_record($shortprefix, 'id', $itemnew->id)) {
                $updateditem->parentid = $oldparentid;
                if (!$hierarchy->move_hierarchy_item($updateditem, $newparentid, false)) {
                    rollback_sql();
                    error('Error moving item to new position in hierarchy');
                }
            }
            $add_or_update = 'updated';
        } else {
            rollback_sql();
            error('Error updating '.$prefix.' record');
        }
    }

    // Commit db operations
    commit_sql();

    // Reload from db
    $itemnew = get_record($shortprefix, 'id', $itemnew->id);

    // Log
    add_to_log(SITEID, $prefix, $add_or_update.' item', "item/view.php?id={$itemnew->id}&amp;prefix={$prefix}", "{$itemnew->fullname} (ID {$itemnew->id})");

    // Raise an event to let other parts of the system know
    if ($itemnew->path != $item->path) {
        $itemnew->oldpath = $item->path;
    }
    events_trigger("{$prefix}_updated", $itemnew);

    redirect("{$CFG->wwwroot}/hierarchy/item/view.php?prefix={$prefix}&id={$itemnew->id}");
    //never reached
}

$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("{$prefix}frameworks", $prefix), 'link'=>$CFG->wwwroot . '/hierarchy/framework/index.php?prefix='.$prefix, 'type'=>'misc');
$navlinks[] = array('name'=>format_string($framework->fullname), 'link'=>$CFG->wwwroot . '/hierarchy/index.php?prefix='.$prefix.'&amp;frameworkid='.$framework->id, 'type'=>'misc');
if($item->id) {
    $navlinks[] = array('name'=>format_string($item->fullname), 'link'=>$CFG->wwwroot . '/hierarchy/item/view.php?prefix='.$prefix.'&amp;id='.$item->id, 'type'=>'misc');
    $navlinks[] = array('name'=>get_string('edit'.$prefix, $prefix), 'link'=>'', 'type'=>'title');
} else {
    $navlinks[] = array('name'=>get_string('addnew'.$prefix, $prefix), 'link'=>'', 'type'=>'title');
}

/// Display page header
admin_externalpage_print_header('' ,$navlinks);

if ($item->id == 0) {
    print_heading(get_string('addnew'.$prefix, $prefix));
} else {
    print_heading(get_string('edit'.$prefix, $prefix));
}

/// Finally display THE form
$itemform->display();

/// and proper footer
print_footer();

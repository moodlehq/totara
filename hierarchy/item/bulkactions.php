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
require_once($CFG->dirroot.'/hierarchy/item/bulkactions_form.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');
require_once($CFG->dirroot.'/local/utils.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');

local_js(array(TOTARA_JS_PLACEHOLDER));

///
/// Setup / loading data
///

$prefix = required_param('prefix', PARAM_ALPHA);
$shortprefix = hierarchy::get_short_prefix($prefix);

$frameworkid = required_param('frameworkid', PARAM_INT);
$action      = required_param('action', PARAM_ALPHA);
$apage       = optional_param('apage', 0, PARAM_INT);
$spage       = optional_param('spage', 0, PARAM_INT);
$confirmdelete = optional_param('confirmdelete', 0, PARAM_INT);
$confirmmove = optional_param('confirmmove', 0, PARAM_INT);
$newparent   = optional_param('newparent', false, PARAM_INT);

$hierarchy = hierarchy::load_hierarchy($prefix);

define('HIERARCHY_BULK_SELECTED_PER_PAGE', 1000);
define('HIERARCHY_BULK_AVAILABLE_PER_PAGE', 1000);

$soffset = $spage * HIERARCHY_BULK_SELECTED_PER_PAGE;
$aoffset = $apage * HIERARCHY_BULK_AVAILABLE_PER_PAGE;

// Make this page appear under the manage competencies admin item
admin_externalpage_setup($prefix.'manage', '', array('prefix'=>$prefix));

$context = get_context_instance(CONTEXT_SYSTEM);

if ($action == 'delete') {
    require_capability('moodle/local:delete'.$prefix, $context);
} else {
    require_capability('moodle/local:update'.$prefix, $context);
}

// Load framework
$framework = $hierarchy->get_framework($frameworkid);

// Load selected data from the session for this form
$all_selected_item_ids =
    isset($SESSION->hierarchy_bulk_items[$action][$prefix][$frameworkid]) ?
    $SESSION->hierarchy_bulk_items[$action][$prefix][$frameworkid] : array();

// same as selected, plus all their children
if ($paths = get_fieldset_select($shortprefix, 'path', sql_sequence('id', $all_selected_item_ids))) {
    $where = array();
    foreach ($paths as $path) {
        $where[] = "path LIKE '${path}%'";
    }
    $all_disabled_item_ids = get_fieldset_select($shortprefix, 'id', implode(' OR ', $where));
}
if (!isset($all_disabled_item_ids) || !$all_disabled_item_ids) {
    $all_disabled_item_ids = array();
}

$count_selected_items = count($all_selected_item_ids);

// Load current search from the session
$searchterm = isset($SESSION->hierarchy_bulk_search[$action][$prefix][$frameworkid]) ?
    $SESSION->hierarchy_bulk_search[$action][$prefix][$frameworkid] : '';
$searchquery = $searchterm ? ' AND fullname ' .sql_ilike() . " '%{$searchterm}%'" :
    '';

$count_available_items = count_records_select($shortprefix, 'frameworkid=' . $frameworkid . $searchquery);

// if page has no results, show last page that did have results
// this is required in the case where a user removes all items
// from the last page of selected list
// without this, it will show the empty page with no pagination
if ($count_available_items > 0 && $aoffset >= $count_available_items) {
    $apage = (int) floor($count_available_items / HIERARCHY_BULK_AVAILABLE_PER_PAGE) - 1;
    $aoffset = $apage * HIERARCHY_BULK_AVAILABLE_PER_PAGE;
}
if ($count_selected_items > 0 && $soffset >= $count_selected_items) {
    $spage = (int) floor($count_selected_items / HIERARCHY_BULK_SELECTED_PER_PAGE) - 1;
    $soffset = $spage * HIERARCHY_BULK_SELECTED_PER_PAGE;
}

// display the selected items, including any children they have
if ($selected_items = get_records_sql("SELECT h.id, h.fullname, count(hh.id) AS children
    FROM {$CFG->prefix}{$shortprefix} h LEFT JOIN {$CFG->prefix}{$shortprefix} hh ON hh.path LIKE h.path||'/%'
    WHERE " . sql_sequence('h.id', $all_selected_item_ids) . "GROUP BY h.id, h.fullname",
    $soffset, HIERARCHY_BULK_SELECTED_PER_PAGE)) {

    $displayed_selected_items = array();
    foreach ($selected_items as $id => $item) {
        if ($item->children == 0) {
            $displayed_selected_items[$id] = $item->fullname;
        } else {
            $a = new object();
            $a->item = $item->fullname;
            $a->num = $item->children;
            $langstr = $item->children == 1 ? 'xandychild' : 'xandychildren';
            $displayed_selected_items[$id] = get_string($langstr, 'hierarchy', $a);
        }
    }
} else {
    $displayed_selected_items = array();
}


$available_items = get_records_select($shortprefix,
    'frameworkid='.$frameworkid . $searchquery, 'sortorder', 'id,fullname,depthlevel',
    $aoffset, HIERARCHY_BULK_AVAILABLE_PER_PAGE);
$available_items = ($available_items) ?
    $available_items : array();

// indent based on item depthlevel
$displayed_available_items = array();
foreach ($available_items as $item) {
    $displayed_available_items[$item->id] = (strlen(trim($searchterm)) == 0) ?
        str_repeat('&nbsp;', 4 * ($item->depthlevel - 1)) . $item->fullname : $item->fullname;
}


///
/// Display page
///

// create form
$mform = new item_bulkaction_form(null, compact('prefix', 'action', 'frameworkid',
    'apage', 'spage', 'displayed_available_items', 'displayed_selected_items',
    'all_selected_item_ids', 'count_available_items', 'count_selected_items',
    'searchterm', 'framework', 'all_disabled_item_ids'));

// return to the bulk actions form (when still working on form)
$formurl = "{$CFG->wwwroot}/hierarchy/item/bulkactions.php?prefix={$prefix}&amp;action={$action}&amp;frameworkid={$frameworkid}&amp;apage={$apage}&amp;spage={$spage}";
// return to the hierarchy index page (when form is done)
$returnurl = "{$CFG->wwwroot}/hierarchy/index.php?prefix={$prefix}&amp;frameworkid={$frameworkid}";


// confirm item deletion
if ($confirmdelete) {
    if (!confirm_sesskey()) {
        print_error('confirmsesskeybad', 'error');
    }

    $unique_ids = $hierarchy->get_items_excluding_children($all_selected_item_ids);
    $status = true;
    $deleted = array();
    foreach ($unique_ids as $item_to_delete) {
        if ($hierarchy->delete_framework_item($item_to_delete)) {
            $deleted[] = $item_to_delete;
        } else {
            $status = false;
        }
    }
    $deletecount = count($deleted);

    // empty form SESSION data
    $SESSION->hierarchy_bulk_items[$action][$prefix][$frameworkid] = array();
    $SESSION->hierarchy_bulk_search[$action][$prefix][$frameworkid] = '';

    $items = (count($unique_ids) == 1) ?
        strtolower(get_string($prefix, $prefix)) :
        strtolower(get_string($prefix . 'plural', $prefix));
    if ($status) {
        add_to_log(SITEID, $prefix, 'bulk delete', "item/bulkactions.php?action=delete&amp;frameworkid={$framework->id}&amp;prefix={$prefix}", 'Deleted IDs: '.implode(',', $deleted));
        $a = new object();
        $a->num = count($unique_ids);
        $a->items = $items;
        $message = get_string('xitemsdeleted', 'hierarchy', $a);
        totara_set_notification($message, $returnurl,
            array('style' => 'notifysuccess'));
    } else if ($deletecount == 0) {
        $message = get_string('error:nonedeleted', 'hierarchy', $items);
        totara_set_notification($message, $formurl);
    } else {
        $a = new object();
        $a->actually_deleted = $deletecount;
        $a->marked_for_deletion = count($unique_ids);
        $a->items = $items;
        $message = get_string('error:somedeleted', 'hierarchy', $a);
        totara_set_notification($message, $returnurl);
    }

}


// confirm item move
if ($confirmmove && $newparent !== false) {
    if (!confirm_sesskey()) {
        print_error('confirmsesskeybad', 'error');
    }
    $unique_ids = $hierarchy->get_items_excluding_children($all_selected_item_ids);

    $status = true;
    begin_sql();
    if ($items_to_move = get_records_select($shortprefix, sql_sequence('id', $unique_ids))) {
        foreach ($items_to_move as $item_to_move) {
            $status = $status && $hierarchy->move_hierarchy_item($item_to_move, $newparent, false);
        }
    }

    if (!$status) {
        rollback_sql();
        totara_set_notification(get_string('error:failedbulkmove', 'hierarchy'), $formurl);
    }

    commit_sql();

    // empty form SESSION data
    $SESSION->hierarchy_bulk_items[$action][$prefix][$frameworkid] = array();
    $SESSION->hierarchy_bulk_search[$action][$prefix][$frameworkid] = '';

    add_to_log(SITEID, $prefix, 'bulk move', "item/bulkactions.php?action=move&amp;frameworkid={$framework->id}&amp;prefix={$prefix}", 'Moved IDs: '.implode(',', $unique_ids));

    $a = new object();
    $a->num = count($unique_ids);
    $a->items = ($a->num == 1) ? strtolower(get_string($prefix, $prefix)) :
        strtolower(get_string($prefix . 'plural', $prefix));

    totara_set_notification(get_string('xitemsmoved', 'hierarchy', $a),
        $returnurl, array('style' => 'notifysuccess'));
}

$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("{$prefix}frameworks", $prefix), 'link'=>$CFG->wwwroot . '/hierarchy/framework/index.php?prefix='.$prefix, 'type'=>'misc');
$navlinks[] = array('name'=>format_string($framework->fullname), 'link'=>$CFG->wwwroot . '/hierarchy/index.php?prefix='.$prefix.'&amp;frameworkid='.$framework->id, 'type'=>'misc');
$navlinks[] = array('name'=>get_string('bulk'.$action.$prefix, $prefix), 'link'=>'', 'type'=>'title');

// Handling actions from the main form

// cancelled
if ($mform->is_cancelled()) {

    redirect($returnurl);

// Update data
} else if ($formdata = $mform->get_data()) {

    // items added
    if (isset($formdata->add_items)) {
        if (!isset($formdata->available)) {

            totara_set_notification(get_string('error:noitemsselected', 'hierarchy'), $formurl);
        }
        // add selected items to the SESSION, and redirect back to page
        // only include the parent as all children are automatically included
        $to_be_added = $hierarchy->get_items_excluding_children($formdata->available);
        foreach ($to_be_added as $added_item) {
            if (!in_array($added_item, $all_selected_item_ids)) {
                $SESSION->hierarchy_bulk_items[$action][$prefix][$frameworkid][] = $added_item;
            }
        }
    }

    // items removed
    if (isset($formdata->remove_items)) {
        if (!isset($formdata->selected)) {
            totara_set_notification(get_string('error:noitemsselected', 'hierarchy'), $formurl);
        }
        // remove selected items to the SESSION, and redirect back to page
        foreach ($formdata->selected as $removed_item) {
            if (($key = array_search($removed_item, $all_selected_item_ids)) !== false) {
                unset($SESSION->hierarchy_bulk_items[$action][$prefix][$frameworkid][$key]);
            }
        }
    }

    // remove all
    if (isset($formdata->remove_all_items)) {
        $SESSION->hierarchy_bulk_items[$action][$prefix][$frameworkid] = array();
    }

    // add all
    if (isset($formdata->add_all_items)) {
        if ($all_records = get_records($shortprefix, 'frameworkid', $frameworkid,
            'sortorder', 'id')) {

            $SESSION->hierarchy_bulk_items[$action][$prefix][$frameworkid] =
                array_keys($all_records);
        }

    }

    // search
    if (isset($formdata->search)) {
        $SESSION->hierarchy_bulk_search[$action][$prefix][$frameworkid] = $formdata->search;
    }

    // clear search (show all button)
    if (isset($formdata->clearsearch)) {
        $SESSION->hierarchy_bulk_search[$action][$prefix][$frameworkid] = '';
    }

    // delete button - confirm step
    if (isset($formdata->deletebutton)) {
        $unique_ids = $hierarchy->get_items_excluding_children($all_selected_item_ids);

        if ((count($unique_ids) > 0)) {
            admin_externalpage_print_header('', $navlinks);
            $strdelete = $hierarchy->get_delete_message($unique_ids);
            notice_yesno($strdelete,
                "{$formurl}&amp;confirmdelete=1&amp;sesskey={$USER->sesskey}",
                $formurl);
        } else {
            totara_set_notification(get_string('error:noitemsselected', 'hierarchy'), $formurl);
        }

        print_footer();
        exit;
    }

    // move button - confirm step
    if (isset($formdata->movebutton) && isset($formdata->newparent)) {
        $unique_ids = $hierarchy->get_items_excluding_children($all_selected_item_ids);

        if (count($unique_ids) <= 0) {
            totara_set_notification(get_string('error:noitemsselected', 'hierarchy'), $formurl);
        }

        $invalidmove = false;

        if ($formdata->newparent != 0) {
            // make sure parent is valid
            if (!$parentitem = get_record($shortprefix, 'id', $formdata->newparent)) {
                $invalidmove = true;
                $message = get_string('error:invalidparentformove', 'hierarchy');
            }

            // check that the new parent isn't a child of any of the items being
            // moved. {@link is_child_of()} accepts an array, but we'll loop
            // through so we know which one failed
            foreach ($unique_ids as $itemid) {
                if ($hierarchy->is_child_of($parentitem, $itemid)) {
                    $invalidmove = true;
                    $a = new object();
                    $a->item = format_string(get_field($shortprefix, 'fullname', 'id', $itemid));
                    $a->newparent = format_string($parentitem->fullname);
                    $message = get_string('error:cannotmoveparentintochild', 'hierarchy', $a);
                }
            }
        }

        if ($invalidmove) {
            totara_set_notification($message, $formurl);
        } else {
            admin_externalpage_print_header('', $navlinks);
            $strmove = $hierarchy->get_move_message($unique_ids, $newparent);
            notice_yesno($strmove,
                     "{$formurl}&amp;newparent={$newparent}&amp;confirmmove=1&amp;sesskey={$USER->sesskey}",
                     $formurl);
            print_footer();
        }
        exit;
    }

    redirect($formurl);
}


/// Display page header
admin_externalpage_print_header('' ,$navlinks);

print_heading(get_string('bulk'.$action.$prefix, $prefix));

/// Finally display the form
$mform->display();

print_footer();

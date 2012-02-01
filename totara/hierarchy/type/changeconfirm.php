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

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');
require_once($CFG->dirroot.'/hierarchy/type/change_form.php');
require_once($CFG->dirroot.'/hierarchy/type/changelib.php');

hierarchy::support_old_url_syntax();

///
/// Setup / loading data
///

// Get params
$prefix        = required_param('prefix', PARAM_ALPHA);
$typeid     = required_param('typeid', PARAM_INT);
$newtypeid  = required_param('newtypeid', PARAM_INT);
$itemid      = optional_param('itemid', 0, PARAM_INT);
$page        = optional_param('page', 0, PARAM_INT);
$shortprefix = hierarchy::get_short_prefix($prefix);

$hierarchy = hierarchy::load_hierarchy($prefix);

// the form can be used to modify individual items and all items in a type
// set some variables to manage the differences in behaviours between
// the two cases
if ($itemid) {
    $item = get_record($shortprefix, 'id', $itemid);
    $affected_item_sql = "AND d.{$prefix}id = {$itemid}";
    $cf_data_sql = " AND {$prefix}id = {$itemid}";
    $item_sql = " AND id = {$itemid}";
    $returnurl = $CFG->wwwroot . '/hierarchy/item/edit.php?prefix=' .
        $prefix . '&amp;id=' . $itemid . '&amp;page=' . $page;
    $optype = 'item'; // used for switching lang strings
    $adminpage = $prefix . 'manage';
} else {
    $affected_item_sql = $cf_data_sql = $item_sql = '';
    $returnurl = $CFG->wwwroot . '/hierarchy/type/index.php?prefix=' . $prefix .
        '&amp;page=' . $page;
    $optype = 'bulk';
    $adminpage = $prefix . 'typemanage';
}

// Setup page and check permissions
admin_externalpage_setup($adminpage, null, array('prefix'=>$prefix));

// make sure the itemid is valid (if provided)
if ($itemid && !$item) {
    print_error('error:invaliditemid', 'hierarchy');
}

// how many items in the being changed?
$select = "typeid={$typeid} {$item_sql}";
$affected_item_count = count_records_select($shortprefix, $select);

// redirect with a message if there are no items of the type to be changed
if ($affected_item_count == 0) {
    totara_set_notification(get_string('error:nonefound'. $optype, 'hierarchy'), $returnurl);
}

// lists the number of items with one or more custom field data record
// belonging to each type
$sql = "SELECT d.fieldid, COUNT(DISTINCT d.{$prefix}id)
    FROM {$CFG->prefix}{$shortprefix}_type_info_data d
    LEFT JOIN {$CFG->prefix}{$shortprefix}_type_info_field f
    ON f.id = d.fieldid
    WHERE f.typeid = {$typeid}
    {$affected_item_sql}
    GROUP BY d.fieldid";
$affected_data_count = get_records_sql_menu($sql);

///
/// Load data for type details
///

$current_type_cfs = get_records($shortprefix . '_type_info_field', 'typeid', $typeid, 'typeid');
$new_type_cfs = get_records($shortprefix . '_type_info_field', 'typeid', $newtypeid, 'typeid');

// moodle form
$changeform = new type_change_form(null, compact('prefix', 'typeid', 'newtypeid', 'itemid', 'current_type_cfs', 'new_type_cfs', 'affected_data_count', 'page'), 'post', '', array('class' => 'hierarchy-bulk-type-form'));

// process the form
if ($changeform->is_cancelled()) {
    redirect($returnurl);
} else if ($data = $changeform->get_data()) {
    // process

    $status = true;
    begin_sql();

    // reassign data from old type (if there is any)
    if (isset($data->field)) {
        foreach ($data->field as $oldfieldid => $newfieldid) {
            if ($newfieldid == 0) {
                // delete the data from all items, or just itemid (if specified)
                $sql = "DELETE FROM {$CFG->prefix}{$shortprefix}_type_info_data
                    WHERE fieldid={$oldfieldid} {$cf_data_sql}";
                $status = $status && execute_sql($sql, false);
                continue;
            }
            // modify the fields of all the item's data, or just itemid (if specified)
            $sql = "UPDATE {$CFG->prefix}{$shortprefix}_type_info_data
                SET fieldid={$newfieldid}
                WHERE fieldid={$oldfieldid} {$cf_data_sql}";
            $status = $status && execute_sql($sql, false);
        }
    }

    // update the type of all the items...
    $sql = "UPDATE {$CFG->prefix}{$shortprefix}
        SET typeid={$newtypeid}
        WHERE typeid={$typeid}";
    // ...or just itemid (if specified)
    if ($itemid) {
        $sql .= " AND id = {$itemid}";
    }
    $status = $status && execute_sql($sql, false);

    if (!$status) {
        rollback_sql();

        $a = new object();
        $a->from = hierarchy_get_type_name($typeid, $shortprefix);
        $a->to = hierarchy_get_type_name($newtypeid, $shortprefix);
        totara_set_notification(get_string('error:couldnotreclassify' . $optype,
            'hierarchy', $a),
            "$CFG->wwwroot/hierarchy/type/index.php?prefix={$prefix}");
    }

    commit_sql();

    $logmessage = ($itemid) ?
        "Item {$itemid} from ID{$typeid} to ID{$newtypeid}" :
        "{$affected_item_count} items from ID{$typeid} to ID{$newtypeid}";
    $url = substr($returnurl, strlen($CFG->wwwroot . '/hierarchy/'));
    add_to_log(SITEID, $prefix, 'change type', $url, $logmessage);

    $a = new object();
    if ($itemid) {
        $a->name = format_string($item->fullname);
    } else {
        $a->num = $affected_item_count;
        $a->items = ($affected_item_count == 1) ?
            strtolower(get_string($prefix, $prefix)) :
            strtolower(get_string($prefix . 'plural', $prefix));
    }
    $a->from = hierarchy_get_type_name($typeid, $shortprefix);
    $a->to = hierarchy_get_type_name($newtypeid, $shortprefix);

    totara_set_notification(get_string('reclassifysuccess' . $optype, 'hierarchy', $a),
        $returnurl, array('style' => 'notifysuccess'));

}

///
/// Generate / display page
///

// Breadcrumbs (different if changing a single item vs. all items in a type)
$navlinks = array();
if ($itemid) {
    $framework = get_record($shortprefix.'_framework', 'id', $item->frameworkid);
    $navlinks[] = array('name'=>get_string("{$prefix}frameworks", $prefix), 'link'=>$CFG->wwwroot . '/hierarchy/framework/index.php?prefix='.$prefix, 'type'=>'misc');
    $navlinks[] = array('name'=>format_string($framework->fullname), 'link'=>$CFG->wwwroot . '/hierarchy/index.php?prefix='.$prefix.'&amp;frameworkid='.$framework->id, 'type'=>'misc');
    $navlinks[] = array('name'=>format_string($item->fullname), 'link'=>$CFG->wwwroot . '/hierarchy/item/view.php?prefix='.$prefix.'&amp;id='.$item->id, 'type'=>'misc');
    $navlinks[] = array('name'=>get_string('edit'.$prefix, $prefix), 'link'=>$CFG->wwwroot . '/hierarchy/item/edit.php?prefix='.$prefix.'&amp;id='.$itemid, 'type'=>'misc');
    $navlinks[] = array('name'=>get_string('changetype', 'hierarchy'), 'link'=>'', 'type'=>'title');

} else {
    $navlinks[] = array('name'=>get_string($prefix.'types', $prefix), 'link'=>$CFG->wwwroot . '/hierarchy/type/index.php?prefix='.$prefix, 'type'=>'misc');
    $navlinks[] = array('name'=>get_string('bulktypechanges', 'hierarchy'), 'link'=>'', 'type'=>'misc');
}

admin_externalpage_print_header('', $navlinks);

// step 2 of 2
// confirm how to handle custom field data

$a = new object();
$a->from = hierarchy_get_type_name($typeid, $shortprefix);
$a->to = hierarchy_get_type_name($newtypeid, $shortprefix);
if ($itemid) {
    $a->name = format_string($item->fullname);
} else {
    $itemstr = ($affected_item_count == 1) ?
        strtolower(get_string($prefix, $prefix)) :
        strtolower(get_string($prefix.'plural', $prefix));
    $a->num = $affected_item_count;
    $a->items = $itemstr;
}

print_heading(get_string('reclassifyingfromxtoy' . $optype, 'hierarchy', $a), '', 1);


// How we proceed depends on which types have custom fields:
//
// If the old type *doesn't* have any custom fields, there's nothing to do,
// just confirm the change
//
// If the new type *doesn't* have any custom fields, there's nowhere for the data
// to go, just warn that it will be deleted
//
// If both types have custom fields, display the form for transferring the data
//
// All of these possibilities are handled inside the form

$changeform->display();

print_footer();




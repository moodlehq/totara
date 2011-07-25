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
require_once($CFG->dirroot.'/hierarchy/type/changelib.php');

hierarchy::support_old_url_syntax();

///
/// Setup / loading data
///

// Get params
$prefix        = required_param('prefix', PARAM_SAFEDIR);
$typeid     = required_param('typeid', PARAM_INT);
$itemid      = optional_param('itemid', null, PARAM_INT);
$page        = optional_param('page', 0, PARAM_INT);
$shortprefix = hierarchy::get_short_prefix($prefix);

// work around issue with default selection in popup_form()
// we want unclassified to have a typeid of 0, but it seems that if you
// use 0, that option will get selected in preference to 'Choose', even if you
// set $selected to ''. So we use -1 instead and switch it back here
$typeid = ($typeid == -1) ? 0 : $typeid;

$hierarchy = hierarchy::load_hierarchy($prefix);

// the form can be used to modify individual items and whole types
// set some variables to manage the differences in behaviours between
// the two cases
if ($itemid) {
    $item = get_record($shortprefix, 'id', $itemid);
    $item_sql = "AND id = {$itemid}";
    $returnurl = $CFG->wwwroot . '/hierarchy/item/edit.php?prefix=' .
        $prefix . '&amp;id=' . $itemid. '&amp;page=' . $page;
    $returnparams = array('prefix' => $prefix, 'id' => $itemid, 'page' => $page);
    $optype = 'item'; // used for switching lang strings
    $adminpage = $prefix . 'manage';
} else {
    $item_sql = '';
    $returnurl = $CFG->wwwroot . '/hierarchy/type/index.php?prefix=' . $prefix . '&amp;page=' . $page;
    $returnparams = array('prefix' => $prefix, 'page' => $page);
    $optype = 'bulk';
    $adminpage = $prefix . 'typemanage';
}

// Setup page and check permissions
admin_externalpage_setup($adminpage, null, array('prefix'=>$prefix));

// make sure the itemid is valid (if provided)
if ($itemid && !$item) {
    print_error('error:invaliditemid', 'hierarchy');
}

// how many items in the type being changed?
$select = "typeid={$typeid} {$item_sql}";
$affected_item_count = count_records_select($shortprefix, $select);

// redirect with a message if there are no items in that type
if ($affected_item_count == 0) {
    totara_set_notification(get_string('error:nonefound' . $optype, 'hierarchy'), $returnurl);
}

///
/// Load data for type details
///

// Get types for this page
$types = $hierarchy->get_types(array('item_count'=>1));

// get custom fields for this hierarchy, and re-group by typeid
$rs = get_recordset($shortprefix . '_type_info_field', '', '', 'typeid');
$cfs_by_type = totara_group_records($rs, 'typeid');
$cfs_by_type = ($cfs_by_type) ? $cfs_by_type : array();

// take out the custom field info for the type being changed
if (array_key_exists($typeid, $cfs_by_type)) {
    $current_type_cfs = $cfs_by_type[$typeid];
    unset($cfs_by_type[$typeid]);
} else {
    $current_type_cfs = null;
}

///
/// Generate / display page
///

// Breadcrumbs (different if changing a single item vs. whole type)
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

print_single_button($returnurl, $returnparams, get_string('cancel'));

// step 1 of 2
// form for picking the new type
// only show if newtype is not yet specified

$a = new object();
if ($itemid) {
    $a->name = format_string($item->fullname);
} else {
    $itemstr = ($affected_item_count == 1) ? strtolower(get_string($prefix, $prefix)) :
        strtolower(get_string($prefix.'plural', $prefix));
    $a->num = $affected_item_count;
    $a->items = $itemstr;
}
print_heading(get_string('reclassify1of2' . $optype, 'hierarchy', $a), '', 1);

print_container_start();
echo '<p>' . get_string('reclassify1of2desc', 'hierarchy');
// if there's data to transfer, let people know they'll get the chance to move it
// in step 2
if ($current_type_cfs) {
    echo ' ' . get_string('reclassifytransferdata', 'hierarchy');
}
echo '</p>';
print_container_end();

print_heading(get_string('currenttype', 'hierarchy'), '', 3, 'hierarchy-bulk-type');

$table = new stdclass();
$table->class = 'generaltable hierarchy-bulk-type-table';
$table->width = '100%';

// Setup column headers
$table->head = array('',
    get_string('name'),
    get_string('customfields', 'customfields'));

$table->size = array('10%', '45%', '45%');

$row = array();
$row[] = '&nbsp;';
$row[] = hierarchy_get_type_name($typeid, $shortprefix);
$row[] = ($cfs = hierarchy_get_formatted_custom_fields($current_type_cfs)) ?
    implode('<br />', $cfs) :
    get_string('nocustomfields', 'hierarchy');
$table->data[] = $row;

print_table($table);

// empty table data ready for the list of new type
$table->data = array();

foreach ($types as $type) {
    // don't show current type
    if ($type->id == $typeid) {
        continue;
    }

    $row = array();

    // button to pick this type
    $row[] = print_single_button($CFG->wwwroot . '/hierarchy/type/changeconfirm.php', array('prefix' => $prefix, 'typeid' => $typeid, 'newtypeid' => $type->id, 'itemid' => $itemid, 'page' => $page), get_string('choose'), 'get', '_self', true);

    // type name
    $row[] = format_string($type->fullname);

    // custom fields in this type
    $cfdata = (array_key_exists($type->id, $cfs_by_type)) ? $cfs_by_type[$type->id] : null;
    $row[] = ($cfs = hierarchy_get_formatted_custom_fields($cfdata)) ?
        implode('<br />', $cfs) :
        get_string('nocustomfields', 'hierarchy');

    $table->data[] = $row;
}

// add 'unclassified' as an option (unless that's the old type)
if ($typeid != 0) {
    $row = array();
    $row[] = print_single_button($CFG->wwwroot . '/hierarchy/type/changeconfirm.php', array('prefix' => $prefix, 'typeid' => $typeid, 'newtypeid' => 0, 'itemid' => $itemid), get_string('choose'), 'get', '_self', true);
    $row[] = get_string('unclassified', 'hierarchy');
    $row[] = get_string('nocustomfields', 'hierarchy');
    $table->data[] = $row;
}


print_heading(get_string('newtype', 'hierarchy'), '', 3, 'hierarchy-bulk-type');

print_table($table);

print_footer();


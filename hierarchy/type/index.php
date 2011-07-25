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

hierarchy::support_old_url_syntax();

///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$prefix        = required_param('prefix', PARAM_ALPHA);
$edit        = optional_param('edit', -1, PARAM_BOOL);
$shortprefix = hierarchy::get_short_prefix($prefix);

$hierarchy = hierarchy::load_hierarchy($prefix);

// @todo add capabilities
    // Cache user capabilities
    $can_add = has_capability('moodle/local:create'.$prefix.'type', $sitecontext);
    $can_edit = has_capability('moodle/local:update'.$prefix.'type', $sitecontext);
    $can_delete = has_capability('moodle/local:delete'.$prefix.'type', $sitecontext);
    $can_edit_custom_fields = has_capability('moodle/local:update'.$prefix.'customfield', $sitecontext);

    // Setup page and check permissions
    admin_externalpage_setup($prefix.'typemanage', null, array('prefix'=>$prefix));

///
/// Load data for type details
///

// Get types for this page
$types = $hierarchy->get_types(array('custom_field_count' => 1, 'item_count'=>1));

// Get count of unclassified items
$unclassified = $hierarchy->get_unclassified_items(true);

///
/// Generate / display page
///
$str_edit     = get_string('edit');
$str_delete   = get_string('delete');


if ($types) {
    // Create display table
    $table = new stdclass();
    $table->class = 'generaltable edit'.$prefix;
    $table->width = '95%';

    // Setup column headers
    $table->head = array(get_string('name', $prefix),
        get_string($prefix . 'plural', $prefix),
        get_string("{$prefix}customfields", $prefix));
    $table->align = array('left', 'center');

    // Add edit column
    if ($can_edit) {
        $table->head[] = get_string('actions');
        $table->align[] = 'left';
    }

    // Add type rows to table
    foreach ($types as $type) {
        $row = array();

        $cssclass = '';

        if ($can_edit_custom_fields) {
            $row[] = "<a $cssclass href=\"{$CFG->wwwroot}/customfield/index.php?prefix={$prefix}&amp;typeid={$type->id}\">" . format_string($type->fullname) . "</a>";
        } else {
            $row[] = format_string($type->fullname);
        }
        $row[] = $type->item_count;
        $row[] = $type->custom_field_count;

        // Add edit link
        $buttons = array();
        if ($can_edit) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/type/edit.php?prefix={$prefix}&amp;id={$type->id}\" title=\"$str_edit\">".
                "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";
        }
        if ($can_delete) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/type/delete.php?prefix={$prefix}&amp;id={$type->id}\" title=\"$str_delete\">".
                "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_delete\" /></a>";
        }
        if ($buttons) {
            $row[] = implode($buttons, ' ');
        }

        $table->data[] = $row;
    }

    // Add a row for unclassified items
    if ($unclassified) {
        $row = array();
        $row[] = get_string('unclassified', 'hierarchy');
        $row[] = $unclassified;
        $row[] = '&nbsp;';
        $row[] = '&nbsp;';
        $table->data[] = $row;
    }

}

$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string($prefix.'types', $prefix), 'link'=>'', 'type'=>'misc');

admin_externalpage_print_header('', $navlinks);

print_heading(get_string($prefix.'types', $prefix) . ' ' . helpbutton('types', get_string('type', $prefix), 'moodle', true, false, '', true), 'left', 1);

// Add type button
if ($can_add) {
    echo '<div class="add-type-button">';

    // Print button for creating new type
    $hierarchy->display_add_type_button();

    echo '</div>';
}

$options = array();

if ($types) {
    print_table($table);

    foreach ($types as $type) {
        // only let user select type that contain items
        if ($type->item_count > 0) {
            $options[$type->id] = format_string($type->fullname);
        }
    }
} else {
    echo "<p>".get_string('notypes', $prefix)."</p>";
}

// only show bulk re-classify form if there is at least one type with items
// (otherwise there's nothing to re-classify)
$showbulkform = (count($options) > 0);

// add an option to change all unclassified items to a new type (if there are any)
if ($unclassified) {
    // work around issue with default selection in popup_form()
    // we want unclassified to have a typeid of 0, but it seems that if you
    // use 0, that option will get selected in preference to 'Choose', even if you
    // set $selected to ''. So we'll use -1 instead and switch it on the next page
    $options[-1] = get_string('unclassified', 'hierarchy');
}

if ($showbulkform) {
    echo '<br />';
    print_heading(get_string('bulktypechanges', 'hierarchy'), 'left', 1);

    print_container(get_string('bulktypechangesdesc', 'hierarchy'));

    popup_form($CFG->wwwroot.'/hierarchy/type/change.php?prefix='.$prefix.'&amp;typeid=', $options, 'changetype', null);
}

// Display templates
/*if (file_exists($CFG->dirroot.'/hierarchy/prefix/'.$prefix.'/template/lib.php')) {
    include($CFG->dirroot.'/hierarchy/prefix/'.$prefix.'/template/lib.php');
    $templates = $hierarchy->get_templates();

    call_user_func("{$prefix}_template_display_table", $templates, $frameworkid);
}*/

add_to_log(SITEID, $prefix, 'view type list', "type/index.php?prefix=$prefix", '');
print_footer();

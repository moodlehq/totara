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
 * @author Aaron Barnes <aaron.barnes@totaralms.com>
 * @package totara
 * @subpackage plan
 */

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');
require_once($CFG->dirroot.'/customfield/fieldlib.php');
require($CFG->libdir.'/filelib.php');

hierarchy::support_old_url_syntax();

// Get data
$prefix        = required_param('prefix', PARAM_ALPHA);
$id          = required_param('id', PARAM_INT);
$edit        = optional_param('edit', -1, PARAM_BOOL);
$frameworkid = optional_param('framework', 0, PARAM_INT);
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
$shortprefix = hierarchy::get_short_prefix($prefix);

$hierarchy = hierarchy::load_hierarchy($prefix);

///
/// Setup / loading data
///

if (!$item = $hierarchy->get_item($id)) {
    error('This ' . $prefix . ' item does not exist');
}
$framework = $hierarchy->get_framework($item->frameworkid);

// Cache user capabilities
$can_add_item    = has_capability('moodle/local:create'.$prefix, $sitecontext);
$can_edit_item   = has_capability('moodle/local:update'.$prefix, $sitecontext);
$can_delete_item = has_capability('moodle/local:delete'.$prefix, $sitecontext);

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:view'.$prefix, $sitecontext);

// Cache user capabilities
$can_edit = has_capability('moodle/local:update'.$prefix, $sitecontext);
$can_manage_fw = has_capability('moodle/local:update'.$prefix.'frameworks', $sitecontext);

///
/// Display page
///

// Run any hierarchy prefix specific code
$compfw = optional_param('framework', 0, PARAM_INT);
$setupitem = new stdClass;
$setupitem->id = $item->id;
$setupitem->frameworkid = $compfw;

$hierarchy->hierarchy_page_setup('item/view', $setupitem);

unset($setupitem);

// Display page header
$pagetitle = format_string($framework->fullname.' - '.$item->fullname);

$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("{$prefix}frameworks", $prefix), 'link'=>$CFG->wwwroot . '/hierarchy/framework/index.php?prefix='.$prefix, 'type'=>'misc');

if ($can_manage_fw) {
    $navlinks[] = array('name' => get_string('manage'.$prefix,$prefix), 'link'=> $CFG->wwwroot.'/hierarchy/index.php?prefix='.$prefix.'&amp;frameworkid='.$framework->id, 'type'=>'title');
} else {
    $navlinks[] = array('name' => get_string('manage'.$prefix,$prefix), 'link'=> '', 'type'=>'title');
}
$navlinks[] = array('name'=>format_string($item->fullname), 'link'=>'', 'type'=>'title');
$navigation = build_navigation($navlinks);

print_header_simple($pagetitle, '', $navigation, '', null, true);

$heading = "{$framework->fullname} - {$item->fullname}";

// add editing icon
$str_edit = get_string('edit');
$str_remove = get_string('remove');

$heading .= " <a href=\"{$CFG->wwwroot}/hierarchy/item/edit.php?prefix={$prefix}&amp;frameworkid=$framework->id&id={$item->id}\" title=\"$str_edit\">".
    "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";

print_heading($heading);
$data = $hierarchy->get_item_data($item);
$cfdata = $hierarchy->get_custom_fields($item->id);
if ($cfdata) {
    foreach ($cfdata as $cf) {
        // don't show hidden custom fields
        if($cf->hidden) {
            continue;
        }
        $cf_class = "customfield_{$cf->datatype}";
        require_once($CFG->dirroot.'/customfield/field/'.$cf->datatype.'/field.class.php');
        $data[] = array(
            'title' => $cf->fullname,
            'value' => call_user_func(array($cf_class, 'display_item_data'), $cf->data)
        );
    }
}
?>
<table class="generalbox viewhierarchyitem">
<tbody>
<?php

$oddeven = 1;

foreach ($data as $ditem) {

    // Check if empty
    if (!strlen($ditem['value'])) {
        continue;
    }

    $oddeven = ++$oddeven % 2;

    echo '<tr class="r'.$oddeven.'">';
    echo '<th class="header">'.format_string($ditem['title']).'</th>';
    echo '<td class="cell">'.$ditem['value'].'</td>';
    echo '</tr>'.PHP_EOL;
}

?>
</tbody>
</table>
<?php

// Print extra info
$hierarchy->display_extra_view_info($item, $frameworkid);

if ($can_edit) {
    echo '<div class="buttons">';

    $options = array('prefix'=>$prefix,'frameworkid' => $framework->id);
    print_single_button(
        $CFG->wwwroot.'/hierarchy/index.php',
        $options,
        get_string('returntoframework', $prefix),
        'get'
    );

    echo '</div>';
}
/// and proper footer
add_to_log(SITEID, $prefix, 'view item', "item/view.php?prefix={$prefix}&amp;framework={$framework->id}&amp;id={$item->id}", "{$item->fullname} (ID {$item->id})");
print_footer();

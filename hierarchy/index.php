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
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @package totara
 * @subpackage hierarchy
 */

require_once(dirname(dirname(__FILE__)) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/tablelib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');
require_once($CFG->dirroot.'/local/searchlib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');

hierarchy::support_old_url_syntax();

local_js(array(TOTARA_JS_PLACEHOLDER));

define('DEFAULT_PAGE_SIZE', 50);
define('SHOW_ALL_PAGE_SIZE', 5000);

$sitecontext    = get_context_instance(CONTEXT_SYSTEM);
$prefix         = required_param('prefix', PARAM_ALPHA);
$shortprefix = hierarchy::get_short_prefix($prefix);
$frameworkid    = optional_param('frameworkid', 0, PARAM_INT);
$perpage        = optional_param('perpage', DEFAULT_PAGE_SIZE, PARAM_INT);  // how many per page
$page           = optional_param('page', 0, PARAM_INT);
$hide        = optional_param('hide', 0, PARAM_INT);
$show        = optional_param('show', 0, PARAM_INT);
$setdisplay  = optional_param('setdisplay', -1, PARAM_INT);
$moveup      = optional_param('moveup', 0, PARAM_INT);
$movedown    = optional_param('movedown', 0, PARAM_INT);
$query       = optional_param('query', '', PARAM_TEXT);
$format      = optional_param('format', '', PARAM_TEXT);

$searchactive = (strlen(trim($query)) > 0);
// hide move arrows when a search active because the hierarchy
// is no longer properly represented
$can_move_item = (!$searchactive);

$hierarchy = hierarchy::load_hierarchy($prefix);

// Load framework
$framework   = $hierarchy->get_framework($frameworkid, true);

// If no frameworks exist
if (!$framework) {
    // Redirect to frameworks page
    redirect($CFG->wwwroot.'/hierarchy/framework/index.php?prefix='.$prefix);
    exit();
}

// Cache user capabilities
$can_add_item    = has_capability('moodle/local:create'.$prefix, $sitecontext);
$can_edit_item   = has_capability('moodle/local:update'.$prefix, $sitecontext);
$can_delete_item = has_capability('moodle/local:delete'.$prefix, $sitecontext);
$can_manage_type = has_capability('moodle/local:update'.$prefix.'type', $sitecontext);

// process actions
if ($can_edit_item) {
    require_capability('moodle/local:update'.$prefix, $sitecontext);
    if ($hide && confirm_sesskey()) {
        $hierarchy->hide_item($hide);
    } elseif ($show && confirm_sesskey()) {
        $hierarchy->show_item($show);
    } elseif ($moveup && confirm_sesskey()) {
        $hierarchy->move_item($moveup, true);
    } elseif ($movedown && confirm_sesskey()) {
        $hierarchy->move_item($movedown, false);
    }
}

if ($format!='') {
    add_to_log(SITEID, $prefix, 'export framework', "index.php?id={$framework->id}&amp;prefix={$prefix}", $framework->fullname);
    $hierarchy->export_data($format);
    die;
}

// if setdisplay parameter set, update the displaymode
if ($setdisplay != -1) {
    set_field($shortprefix.'_framework', 'hidecustomfields',
        $setdisplay, 'id', $framework->id);
    $displaymode = $setdisplay;
} else {
    $displaymode = $framework->hidecustomfields;
}

$frameworkid = $framework->id;


// Setup page and check permissions
admin_externalpage_setup($prefix.'manage', null, array('prefix'=>$prefix, 'frameworkid' => $frameworkid), $CFG->wwwroot.'/hierarchy/index.php');

// build query now as we need the count for flexible tables
$select = "SELECT hierarchy.*";
$count = "SELECT COUNT(hierarchy.id)";
$from   = " FROM {$CFG->prefix}{$shortprefix} hierarchy";
$where  = " WHERE frameworkid={$framework->id}";
$order  = " ORDER BY sortorder";
// if a search is happening, or custom fields are being displayed,
// also join to get custom field data
if ($searchactive || !$displaymode) {
    if ($custom_fields = get_records($shortprefix.'_type_info_field')) {
        foreach ($custom_fields as $custom_field) {
            // add one join per custom field
            $fieldid = $custom_field->id;
            $select .= ", cf_{$fieldid}.data AS cf_{$fieldid}";
            $from .= " LEFT JOIN {$CFG->prefix}{$shortprefix}_type_info_data cf_{$fieldid}
                ON hierarchy.id = cf_{$fieldid}.{$prefix}id AND cf_{$fieldid}.fieldid = {$fieldid}";
        }
    }
}

$matchcount = count_records_sql($count.$from.$where);

// include search terms if any set
if ($searchactive) {
    // extract quoted strings from query
    $keywords = local_search_parse_keywords($query);
    // match search terms against the following fields
    $dbfields = array('fullname', 'shortname', 'description', 'idnumber');
    if (is_array($custom_fields)) {
        foreach ($custom_fields as $cf) {
            $dbfields[] = "cf_{$cf->id}.data";
        }
    }
    $where .= ' AND (' . local_search_get_keyword_where_clause($keywords, $dbfields). ')';
}

$filteredcount = count_records_sql($count.$from.$where);

$table = new flexible_table($prefix.'-framework-index-'.$frameworkid);

$headerdata = array();

$row = new object();
$row->type = 'name';
$row->value->fullname = get_string('name');
$headerdata[] = $row;

if ($extrafields = $hierarchy->get_extrafields()) {
    foreach ($extrafields as $extrafield) {
        $row = new object();
        $row->type = 'extrafield';
        $row->extrafield = $extrafield;
        $row->value->fullname = get_string($extrafield, $prefix);
        $headerdata[] = $row;
    }
}

$row = new object();
$row->type = 'actions';
$row->value->fullname = get_string('actions');
$headerdata[] = $row;

$columns = array();
$headers = array();

foreach ($headerdata as $key => $head) {
    $columns[] = $head->type.$key;
    $headers[] = $head->value->fullname;
}
$table->define_headers($headers);
$table->define_columns($columns);

$table->column_style('actions','width','80px');
$table->set_attribute('cellspacing', '0');
$table->set_attribute('class', 'generaltable generalbox hierarchy-index');
$table->set_attribute('width', '100%');
$table->setup();
$table->pagesize($perpage, $filteredcount);

$records = get_recordset_sql($select.$from.$where.$order, $table->get_page_start(), $table->get_page_size());

$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("{$prefix}frameworks", $prefix), 'link'=>$CFG->wwwroot . '/hierarchy/framework/index.php?prefix='.$prefix, 'type'=>'misc');
$navlinks[] = array('name'=>format_string($framework->fullname), 'link'=>'', 'type'=>'misc');

admin_externalpage_print_header('', $navlinks);

echo '<div class="back-link"><a href="'.$CFG->wwwroot . '/hierarchy/framework/index.php?prefix='.$prefix.'">&laquo; '. get_string('backtoallframeworks', $prefix) . '</a></div>';

print_heading(format_string($framework->fullname));
print_container(format_string($framework->description));
echo '<br clear="all" />';

$placeholder = get_string('search') . ' ' . format_string($framework->fullname);
$hierarchy->display_action_buttons($can_add_item, $page);
$hierarchy->display_bulk_actions_picker($can_add_item, $can_edit_item, $can_delete_item, $can_manage_type, $page);
echo $hierarchy->display_showhide_detail_button($displaymode, $query, $page);
echo $hierarchy->display_search_box($query, $placeholder);

echo '<br clear="all" />';

if($searchactive) {
    if($filteredcount > 0) {
        $a = new object();
        $a->filteredcount = $filteredcount;
        $a->allcount = $matchcount;
        $a->query = stripslashes($query);
        echo '<p><strong>' . get_string('showingxofyforsearchz', 'hierarchy', $a);
    } else {
        echo '<p><strong>' . get_string('noresultsforsearchx', 'hierarchy', stripslashes($query));
    }
    echo ' <a href="' . $CFG->wwwroot . '/hierarchy/index.php?prefix='.$prefix.'&amp;frameworkid='.$frameworkid . '">';
    echo get_string('clearsearch', 'hierarchy') . '</a></strong></p>';

}
$num_on_page = 0;
if ($matchcount > 0) {
    if ($records) {

        $params = array();
        if ($page) {
            $params[] = 'page='.$page;
        }
        if ($searchactive) {
            $params[] = 'query='.urlencode($query);
        }
        $extraparams = (count($params)) ? implode($params, '&amp;') : '';

        // cache this hierarchies types
        $types = $hierarchy->get_types();

        // figure out which custom fields are used by which types
        $cfields = get_records($shortprefix.'_type_info_field');

        while ($record = rs_fetch_next_record($records)) {
            $row = array();
            // don't display items indented by depth if it's a search
            $showdepth = !$searchactive;

            $include_custom_fields = !$displaymode;
            $row[] = $hierarchy->display_hierarchy_item($record, $include_custom_fields,
                $showdepth, $cfields, $types);
            if ($extrafields) {
                foreach ($extrafields as $extrafield) {
                    $row[] = $hierarchy->display_hierarchy_item_extrafield($record, $extrafield);
                }
            }
            $row[] = $hierarchy->display_hierarchy_item_actions($record, $can_edit_item,
                $can_delete_item, $can_move_item, $extraparams);
            $table->add_data($row);
            ++$num_on_page;
        }
        if ($filteredcount > 0) {
            $table->hide_empty_cols();
            $table->print_html();
        }

    }
} else {
    echo '<p>' .get_string('no'.$prefix, $prefix) . '</p>';
}

// print another set of buttons at the bottom of the list
// (unless the list is too short)
if ($num_on_page > 10) {
    $hierarchy->display_action_buttons($can_add_item, $page);

    $hierarchy->display_bulk_actions_picker($can_add_item, $can_edit_item, $can_delete_item, $can_manage_type, $page);
}

if ($num_on_page > 0) {
    $hierarchy->export_select();
}

print_footer();


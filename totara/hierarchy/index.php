<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
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
 * @subpackage totara_hierarchy
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/totaratablelib.php');
require_once($CFG->dirroot.'/totara/hierarchy/lib.php');
require_once($CFG->dirroot.'/totara/core/searchlib.php');
require_once($CFG->dirroot.'/totara/core/js/lib/setup.php');

local_js(array(TOTARA_JS_PLACEHOLDER));

define('DEFAULT_PAGE_SIZE', 50);
define('SHOW_ALL_PAGE_SIZE', 5000);

$sitecontext    = context_system::instance();
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
$search      = optional_param('search', '', PARAM_TEXT);
$format      = optional_param('format', '', PARAM_TEXT);

$searchactive = (strlen(trim($search)) > 0);
// hide move arrows when a search active because the hierarchy
// is no longer properly represented
$can_move_item = (!$searchactive);

$hierarchy = hierarchy::load_hierarchy($prefix);

// Load framework
$framework   = $hierarchy->get_framework($frameworkid, true);

// If no frameworks exist
if (!$framework) {
    // Redirect to frameworks page
    redirect(new moodle_url('index.php', array('prefix' => $prefix)));
    exit();
}

// Check if custom types exist
$types = $hierarchy->get_types();
// Cache user capabilities
$can_add_item    = has_capability('totara/hierarchy:create'.$prefix, $sitecontext);
$can_edit_item   = has_capability('totara/hierarchy:update'.$prefix, $sitecontext);
$can_delete_item = has_capability('totara/hierarchy:delete'.$prefix, $sitecontext);
$can_manage_type = (count($types) > 0) && has_capability('totara/hierarchy:update'.$prefix.'type', $sitecontext);

// process actions
if ($can_edit_item) {
    require_capability('totara/hierarchy:update'.$prefix, $sitecontext);
    if ($hide && confirm_sesskey()) {
        $hierarchy->hide_item($hide);
    } elseif ($show && confirm_sesskey()) {
        $hierarchy->show_item($show);
    } elseif ($moveup && confirm_sesskey()) {
        $hierarchy->reorder_hierarchy_item($moveup, HIERARCHY_ITEM_ABOVE);
    } elseif ($movedown && confirm_sesskey()) {
        $hierarchy->reorder_hierarchy_item($movedown, HIERARCHY_ITEM_BELOW);
    }
}

if ($format!='') {
    add_to_log(SITEID, $prefix, 'export framework', "index.php?id={$framework->id}&amp;prefix={$prefix}", $framework->fullname);
    $hierarchy->export_data($format);
    die;
}

// if setdisplay parameter set, update the displaymode
if ($setdisplay != -1) {
    $DB->set_field($shortprefix.'_framework', 'hidecustomfields', $setdisplay, array('id' => $framework->id));
    $displaymode = $setdisplay;
} else {
    $displaymode = $framework->hidecustomfields;
}

$frameworkid = $framework->id;


// Setup page and check permissions
admin_externalpage_setup($prefix.'manage', null, array('prefix' => $prefix, 'frameworkid' => $frameworkid));
$PAGE->navbar->add(format_string($framework->fullname));
echo $OUTPUT->header();
// build query now as we need the count for flexible tables
$select = "SELECT hierarchy.*";
$count = "SELECT COUNT(hierarchy.id)";
$from   = " FROM {{$shortprefix}} hierarchy";
$where  = " WHERE frameworkid = ?";
$params = array($framework->id);
$order  = " ORDER BY sortthread";
// if a search is happening, or custom fields are being displayed,
// also join to get custom field data
if ($searchactive || !$displaymode) {
    $custom_fields = $DB->get_records($shortprefix.'_type_info_field');
    foreach ($custom_fields as $custom_field) {
        // add one join per custom field
        $fieldid = $custom_field->id;
        $select .= ", cf_{$fieldid}.id AS cf_{$fieldid}_itemid, cf_{$fieldid}.data AS cf_{$fieldid}";
        $from .= " LEFT JOIN {{$shortprefix}_type_info_data} cf_{$fieldid}
            ON hierarchy.id = cf_{$fieldid}.{$prefix}id AND cf_{$fieldid}.fieldid = {$fieldid}";
    }
}

$matchcount = $DB->count_records_sql($count.$from.$where, $params);

// include search terms if any set
if ($searchactive) {
    // extract quoted strings from query
    $keywords = totara_search_parse_keywords($search);
    // match search terms against the following fields
    $dbfields = array('fullname', 'shortname', 'description', 'idnumber');
    if (is_array($custom_fields)) {
        foreach ($custom_fields as $cf) {
            $dbfields[] = "cf_{$cf->id}.data";
        }
    }
    list($searchsql, $searchparams) = totara_search_get_keyword_where_clause($keywords, $dbfields);
    $where .= ' AND (' . $searchsql . ')';
    $params = array_merge($params, $searchparams);
}
$filteredcount = $DB->count_records_sql($count.$from.$where, $params);

$table = new totara_table($prefix.'-framework-index-'.$frameworkid);
$table->define_baseurl(new moodle_url('index.php', array('prefix' => $prefix, 'frameworkid' => $frameworkid)));

$headerdata = array();

$row = new stdClass();
$row->type = 'name';
$row->value = new stdClass();
$row->value->fullname = get_string('name');
$headerdata[] = $row;

if ($extrafields = $hierarchy->get_extrafields()) {
    foreach ($extrafields as $extrafield) {
        $row = new stdClass();
        $row->type = 'extrafield';
        $row->extrafield = $extrafield;
        $row->value = new stdClass();
        $row->value->fullname = get_string($prefix . $extrafield, 'totara_hierarchy');
        $headerdata[] = $row;
    }
}

$row = new stdClass();
$row->type = 'actions';
$row->value = new stdClass();
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

$urlparams = array('prefix' => $prefix, 'frameworkid' => $frameworkid);
if ($searchactive) {
    $urlparams['search'] = $search;
}
$table->define_baseurl(new moodle_url('index.php', $urlparams));
$table->set_attribute('class', 'hierarchy-index fullwidth');
$table->setup();
$table->pagesize($perpage, $filteredcount);

$records = $DB->get_recordset_sql($select.$from.$where.$order, $params, $table->get_page_start(), $table->get_page_size());


echo $OUTPUT->container($OUTPUT->action_link(
    new moodle_url('/totara/hierarchy/framework/index.php', array('prefix' => $prefix)), '&laquo; ' . get_string($prefix.'backtoallframeworks', 'totara_hierarchy')), 'back-link'
);
echo $OUTPUT->heading(format_string($framework->fullname));

$framework->description = file_rewrite_pluginfile_urls($framework->description, 'pluginfile.php', $sitecontext->id, 'totara_hierarchy', $shortprefix.'_framework', $frameworkid);
echo $OUTPUT->container($framework->description);
echo html_writer::tag('div', '', array('class' => 'clearfix'));

$table->add_toolbar_content($hierarchy->display_action_buttons($can_add_item, $page), 'right');
$table->add_toolbar_content($hierarchy->display_bulk_actions_picker($can_add_item, $can_edit_item, $can_delete_item, $can_manage_type, $page), 'left' , 'top', 1);
$table->add_toolbar_content($hierarchy->display_showhide_detail_button($displaymode, $search, $page), 'right', 'top', 1);
$placeholder = get_string('search') . ' ' . format_string($framework->fullname);
$table->add_toolbar_content($hierarchy->display_search_box($search, $placeholder), 'left');

$table->add_toolbar_pagination('right', 'top', 1);
$table->add_toolbar_pagination('left', 'bottom');
$table->set_no_records_message(get_string('no'.$prefix, 'totara_hierarchy'));

echo html_writer::tag('div', '', array('class' => 'clearfix'));

if ($searchactive) {
    if ($filteredcount > 0) {
        $a = new stdClass();
        $a->filteredcount = $filteredcount;
        $a->allcount = $matchcount;
        $a->query = $search;
        echo html_writer::start_tag('p');
        echo html_writer::tag('strong', get_string('showingxofyforsearchz', 'totara_hierarchy', $a));
    } else {
        echo html_writer::start_tag('p');
        echo html_writer::tag('strong', get_string('noresultsforsearchx', 'totara_hierarchy', $search));
    }
    echo $OUTPUT->action_link(new moodle_url('index.php', array('prefix' => $prefix, 'frameworkid' => $frameworkid)), get_string('clearsearch', 'totara_hierarchy'));
    echo html_writer::end_tag('p');
}

$num_on_page = 0;
if ($matchcount > 0) {
    if ($records) {

        $params = array();
        if ($page) {
            $params[] = 'page='.$page;
        }
        if ($searchactive) {
            $params[] = 'query='.urlencode($search);
        }
        $extraparams = (count($params)) ? implode($params, '&amp;') : '';

        // cache this hierarchies types
        $types = $hierarchy->get_types();

        // figure out which custom fields are used by which types
        $cfields = $DB->get_records($shortprefix.'_type_info_field');
        foreach ($records as $record) {
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

    }
}
$table->finish_html();

$records->close();

if ($num_on_page > 0) {
    $hierarchy->export_select();
}

echo $OUTPUT->footer();

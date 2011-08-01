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
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage program
 */

/**
 * Program progress view page
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once('lib.php');
require_once($CFG->dirroot . '/local/js/lib/setup.php');

require_login();

$id = required_param('id', PARAM_INT); // program id

$program = new program($id);
if (!$program->is_accessible()) {
    $program->display_access_error();
}

add_to_log(SITEID, 'program', 'view', "view.php?id={$program->id}&amp;userid={$USER->id}", $program->fullname);

///
/// Display
///

$adminediting = !empty($USER->categoryedit);

// Construct breadcrumbs using category path
$category = get_record('course_categories', 'id', $program->category);
$bread = explode('/', $category->path);
$bread_ids = substr(implode(',', $bread), 1);
$sql = "SELECT id, name FROM {$CFG->prefix}course_categories WHERE id IN ({$bread_ids}) ORDER BY depth";
$cat_bread = array();
if($bread_info = get_records_sql($sql)) {
    foreach($bread_info as $b) {
        $cat_bread[] = array('name' => format_string($b->name), 'link' => $CFG->wwwroot . '/course/category.php?id='.$b->id, 'type' => 'misc');
    }
}

$category_breadcrumbs = get_category_breadcrumbs($program->category);

$heading = $program->fullname;
$pagetitle = format_string(get_string('program', 'local_program').': '.$heading);
$navlinks = array();
if ($adminediting) {
    $navlinks[] = array('name' => get_string('manageprograms', 'admin'), 'link' => $CFG->wwwroot . '/course/categorylist.php?viewtype=program', 'type' => 'misc');
    $navlinks = array_merge($navlinks, $category_breadcrumbs);
} else {
    $navlinks[] = array('name' => get_string('findprograms', 'local_program'), 'link' => $CFG->wwwroot . '/course/categorylist.php?viewtype=program', 'type'=>'misc');
    $navlinks = array_merge($navlinks, $category_breadcrumbs);
}

$navlinks[] = array('name' => $heading, 'link'=> '', 'type'=>'title');

$navigation = build_navigation($navlinks);

print_header_simple($pagetitle, '', $navigation, '', null, true, '');

// Program page content
print_container_start(false, '', 'view-program-content');

print_heading($heading);

echo $program->display(null);

print_container_end();

print_footer();

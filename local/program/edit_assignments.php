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
 * @author Jake Salmon <jake.salmon@kineo.com>
 * @package totara
 * @subpackage program
 */

/**
 * Program view page
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('lib.php');
require_once($CFG->dirroot . '/local/js/lib/setup.php');

$id = required_param('id', PARAM_INT); // program id

admin_externalpage_setup('manageprograms', '', array('id' => $id), $CFG->wwwroot.'/local/program/edit_assignments.php');

$program = new program($id);

// Additional permissions check
if (!has_capability('local/program:configureassignments', $program->get_context())) {
    print_error('error:nopermissions', 'local_program');
}

// Define the categorys to appear on the page
$categories = prog_assignment_category::get_categories();

if($data = data_submitted()) {

    // Check the session key
    confirm_sesskey();

    // Update each category
    foreach ($categories as $category) {
    $category->update_assignments($data);
    }

    // reset the assignments property to ensure it only contains the current
    // assignments.
    $assignments = $program->get_assignments();
    $assignments->init_assignments($program->id);

    // Update the user assignments
    $program->update_learner_assignments($categories);

    // log this request
    add_to_log(SITEID, 'program', 'update assignments', "edit_assignments.php?id={$program->id}", $program->fullname);

    if(isset($data->savechanges)) {
        totara_set_notification(get_string('programassignmentssaved', 'local_program'), 'edit_assignments.php?id='.$id, array('style' => 'notifysuccess'));
    }

}

//Javascript include
local_js(array(
    TOTARA_JS_DIALOG,
    TOTARA_JS_TREEVIEW
));

// Get item pickers
require_js(array(
    $CFG->wwwroot . '/local/program/assignment/program_assignment.js.php?id=' . $program->id
));

$currenturl = qualified_me();
$currenturl_noquerystring = strip_querystring($currenturl);
$viewurl = $currenturl_noquerystring."?id={$id}&action=view";

// log this request
add_to_log(SITEID, 'program', 'view assignments', "edit_assignments.php?id={$program->id}", $program->fullname);

///
/// Display
///

$category_breadcrumbs = get_category_breadcrumbs($program->category);

$heading = format_string($program->fullname);
$pagetitle = format_string(get_string('program', 'local_program').': '.$heading);
$navlinks = array();
$navlinks[] = array('name' => get_string('manageprograms', 'admin'), 'link'=> $CFG->wwwroot . '/course/categorylist.php?viewtype=program', 'type'=>'title');
$navlinks = array_merge($navlinks, $category_breadcrumbs);

$navlinks[] = array('name' => format_string($program->shortname), 'link'=> $viewurl, 'type'=>'title');
$navlinks[] = array('name' => get_string('editprogramassignments', 'local_program'), 'link'=> '', 'type'=>'title');

admin_externalpage_print_header('', $navlinks);

print_container_start(false, 'program assignments', 'program-assignments');

print_heading($heading);

// Display the current status
echo $program->display_current_status();
$exceptions = $program->get_exception_count();
$currenttab = 'assignments';
require('tabs.php');

$dropdown_options = array();
$available_categories = array();

foreach ($categories as $category) {
    $category->build_table($CFG->prefix,$program->id);
    if (!$category->has_items()) {
    $dropdown_options[$category->id] = $category->name;
    }
}

echo '<form name="form_prog_assignments" method="post">';

echo '<fieldset id="programassignments">';
echo '<legend class="ftoggler">'.get_string('programassignments', 'local_program').'</legend>';
echo '<p>'.get_string('instructions:programassignments', 'local_program').'</p>';

echo '<div id="assignment_categories">';
// Display the categories!
foreach ($categories as $category) {
    if ($category->has_items()) {
        echo $category->display(true);
        echo '<script type="text/javascript">' . $category->get_js($id) . '</script>';
    }
}
echo '</div>';

echo '</fieldset>';

// Display the drop-down if there's any categories that aren't yet being used
if (!empty($dropdown_options)) {
    $html = '<div id="category_select">';
    $html .= get_string('addnew','local_program');
    $html .= ' <select>';
    foreach ($dropdown_options as $value => $name) {
    $html .= '<option value="'.$value.'">'.$name.'</option>';
    }
    $html .= '</select> ';
    $html .= get_string('toprogram','local_program');
    $html .= '<button>'.get_string('add').'</button>';
    $html .= '</div>';
    echo $html;
}

$helpbutton = helpbutton('totalassignments', get_string('totalassignments', 'local_program'), 'local_program', true, false, '', true);
echo '<div class="overall_total">'.$helpbutton.' '.get_string('totalassignments','local_program').': <span class="total">0</span></div>';

echo '<input type="hidden" name="id" value="'.$id.'" />';
echo '<input type="hidden" name="sesskey" value="'.sesskey().'"/>';
echo '<input type="submit" name="savechanges" value="'.get_string('savechanges').'"  class="savechanges-overview program-savechanges" />';
echo '</form>';

echo $program->get_cancel_button();

print_container_end();

admin_externalpage_print_footer();


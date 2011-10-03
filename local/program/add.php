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
 * Page for adding a program
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('lib.php');
require_once('edit_form.php');
require_once($CFG->dirroot . '/local/js/lib/setup.php');

admin_externalpage_setup('manageprograms');

$categoryid = optional_param('category', 0, PARAM_INT); // course category - can be changed in edit form

//Javascript include
local_js(array(
    TOTARA_JS_DATEPICKER
));

if ($categoryid) { // creating new program in this category
    if (!$category = get_record('course_categories', 'id', $categoryid)) {
        print_error('Category ID was incorrect');
    }
    require_capability('local/program:createprogram', get_context_instance(CONTEXT_COURSECAT, $category->id));
} else {
    print_error('Program category must be specified');
}

///
/// Data and actions
///

$currenturl = qualified_me();
$progindexurl = "{$CFG->wwwroot}/course/index.php?viewtype=program";

$form = new program_edit_form($currenturl, array('action'=>'add', 'category'=>$category));

if ($form->is_cancelled()) {
    redirect($progindexurl);
}

// Handle form submit
if ($data = $form->get_data()) {
    if (isset($data->savechanges)) {

        $data->availablefrom = prog_date_to_time($data->availablefromselector);
        $data->availableuntil = prog_date_to_time($data->availableuntilselector);

        $now = time();
        $data->timecreated = $now;
        $data->timemodified = $now;
        $data->usermodified = $USER->id;

        if (!isset($data->visible)) {
            $data->visible = 0;
        }

        begin_sql();

        // Set up the program
        if (!$newid = insert_record('prog', $data)) {
            rollback_sql();
            totara_set_notification(get_string('programcreatefail', 'local_program', get_string('couldnotinsertnewrecord', 'local_program')), $currenturl);
        }

        $program = new program($newid);

        commit_sql();

        add_to_log(SITEID, 'program', 'created', "edit.php?id={$newid}", $program->fullname);

        $viewurl = "{$CFG->wwwroot}/local/program/edit.php?id={$newid}&amp;action=edit";

        totara_set_notification(get_string('programcreatesuccess', 'local_program'), $viewurl, array('style' => 'notifysuccess'));

    }
}

///
/// Display
///
$heading = get_string('createnewprogram', 'local_program');
$pagetitle = format_string(get_string('program', 'local_program').': '.$heading);
$navlinks = array();
prog_get_base_navlinks($navlinks);
$navlinks[] = array('name' => $heading, 'link'=> '', 'type'=>'title');

admin_externalpage_print_header('', $navlinks);

print_container_start(false, 'program add', 'program-add');

//$id = $program->id;
$context = get_context_instance(CONTEXT_COURSECAT, $category->id);
$exceptions = 0;
print_heading($heading);

require('tabs.php');

$form->display();

print_container_end();

print <<<HEREDOC
<script type="text/javascript">

    $(function() {
        $('input[name="availablefromselector"]').datepicker(
            {
                dateFormat: 'dd/mm/yy',
                showOn: 'both',
                buttonImage: '{$CFG->wwwroot}/local/js/images/calendar.gif',
                buttonImageOnly: true,
                constrainInput: true
            }
        );
    });

    $(function() {
        $('input[name="availableuntilselector"]').datepicker(
            {
                dateFormat: 'dd/mm/yy',
                showOn: 'both',
                buttonImage: '{$CFG->wwwroot}/local/js/images/calendar.gif',
                buttonImageOnly: true,
                constrainInput: true
            }
        );
    });

</script>
HEREDOC;

admin_externalpage_print_footer();


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
 * Program view page
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('lib.php');
require_once('edit_form.php');

$id = required_param('id', PARAM_INT); // program id
$action = optional_param('action', 'view', PARAM_TEXT);

admin_externalpage_setup('manageprograms', '', array('id' => $id, 'action' => $action), $CFG->wwwroot.'/local/program/edit.php');

if ($action == 'edit') {
    require_once($CFG->dirroot . '/local/js/lib/setup.php');

    //Javascript include
    local_js(array(
        TOTARA_JS_DATEPICKER
    ));
    require_js(array(
        "{$CFG->wwwroot}/local/program/program.edit.js",
    ));
}

$program = new program($id);

if (!has_capability('local/program:configureprogram', $program->get_context())) {
    print_error('error:nopermissions', 'local_program');
}


if (!$category = get_record('course_categories', 'id', $program->category)) {
    print_error('Unable to determine the program\'s category');
}

$currenturl = qualified_me();
$currenturl_noquerystring = strip_querystring($currenturl);
$viewurl = $currenturl_noquerystring."?id={$id}&action=view";
$editurl = $currenturl_noquerystring."?id={$id}&action=edit";
$categoryindexurl = "{$CFG->wwwroot}/course/category.php?id={$category->id}&amp;viewtype=program";
$editcontenturl = "{$CFG->wwwroot}/local/program/edit_content.php?id={$program->id}";
$editassignmentsurl = "{$CFG->wwwroot}/local/program/edit_assignments.php?id={$program->id}";
$editmessagesurl = "{$CFG->wwwroot}/local/program/edit_messages.php?id={$program->id}";

$detailsform = new program_edit_form($currenturl, array('program'=>$program, 'action'=>$action, 'category'=>$category), 'post', '', array('name'=>'form_prog_details'));

if ($detailsform->is_cancelled()) {
    totara_set_notification(get_string('programupdatecancelled', 'local_program'), $viewurl, array('style' => 'notifysuccess'));
}

// Redirect to delete page if deleting
if ($action == 'delete') {
    redirect("{$CFG->wwwroot}/local/program/delete.php?id={$id}");
}

// Handle form submits
if ($data = $detailsform->get_data()) {
    if (isset($data->edit)) {
        redirect($editurl);
    } else if(isset($data->savechanges)) {

        // Preprocess to convert string dates e.g. '23/11/2012' to a unix timestamp
        $data->availablefrom = prog_date_to_time($data->availablefromselector);
        $data->availableuntil = prog_date_to_time($data->availableuntilselector);

        // Save program data
        if (!update_record('prog', $data)) {
            totara_set_notification(get_string('programupdatefail', 'local_program'), $editurl);
        } else {
            if(isset($data->savechanges)) {
                $nexturl = $viewurl;
            }
            totara_set_notification(get_string('programdetailssaved', 'local_program'), $nexturl, array('style' => 'notifysuccess'));
        }
    }

    // Reload program to reflect any changes
    $program = new program($id);
}

// log this request
add_to_log(SITEID, 'program', 'view', "edit.php?id={$program->id}", $program->fullname);

///
/// Display
///

$programpagelinks = '';
$pageid = 'program-overview';

if($action=='edit') {
    $currenttab = 'details';
    $heading = $program->fullname;
    $pageid = 'program-overview-details';
} else {
    $currenttab = 'overview';
    $heading = $program->fullname;
}


$pagetitle = format_string(get_string('program', 'local_program').': '.$heading);
$navlinks = array();

$category_breadcrumbs = get_category_breadcrumbs($program->category);

if($action=='edit') {
    $navlinks[] = array('name' => get_string('manageprograms', 'admin'), 'link'=> $CFG->wwwroot . '/course/categorylist.php?viewtype=program', 'type'=>'title');
    $navlinks = array_merge($navlinks, $category_breadcrumbs);
    $navlinks[] = array('name' => $program->shortname, 'link'=> $viewurl, 'type'=>'title');
    $navlinks[] = array('name' => ucwords($action), 'link'=> '', 'type'=>'title');
} else {
    $navlinks[] = array('name' => get_string('manageprograms', 'admin'), 'link'=> $CFG->wwwroot . '/course/categorylist.php?viewtype=program', 'type'=>'title');
    $navlinks = array_merge($navlinks, $category_breadcrumbs);
    $navlinks[] = array('name' => $program->shortname, 'link'=> '', 'type'=>'title');
}

admin_externalpage_print_header('', $navlinks);

/// Print link to roles
if (has_capability('moodle/role:assign', $program->get_context())) {
    echo '<div class="rolelink"><a href="'.$CFG->wwwroot.'/'.$CFG->admin.'/roles/assign.php?contextid='.
        $program->get_context()->id.'">'.get_string('assignroles','role').'</a></div>';
}

print_container_start(false, 'program overview', $pageid);

print_heading($heading);

// Display the current status
echo $program->display_current_status();
$exceptions = $program->get_exception_count();
require('tabs.php');


// Program details
$program->availablefromselector = $program->availablefrom>0 ? prog_time_to_date($program->availablefrom) : '';
$program->availableuntilselector = $program->availableuntil>0 ? prog_time_to_date($program->availableuntil) : '';

$detailsform->set_data($program);
$detailsform->display();

// display content, assignments and messages if in view mode
if($action=='view') {

    // display the content form
    $contentform = new program_content_nonedit_form($editcontenturl, array('program'=>$program), 'get');
    $contentform->set_data($program);
    $contentform->display();

    // display the assignments form
    $assignmentform = new program_assignments_nonedit_form($editassignmentsurl, array('program'=>$program), 'get');
    $assignmentform->set_data($program);
    $assignmentform->display();

    // display the messages form
    $messagesform = new program_messages_nonedit_form($editmessagesurl, array('program'=>$program), 'get');
    $messagesform->set_data($program);
    $messagesform->display();

    // display the delete button form
    $deleteform = new program_delete_form($currenturl, array('program'=>$program));
    $deleteform->set_data($program);
    $deleteform->display();

}

echo $program->get_cancel_button();

print_container_end();

if ($action == 'edit') {

$unsavedchangesstr = get_string('youhaveunsavedchanges','local_program');

print <<<HEREDOC
<script type="text/javascript">

    $(function() {

        // attach a function to the page to prevent unsaved changes from being lost
        // when navigating away
        window.onbeforeunload = function(e) {

            var modified = isFormModified();

            if(modified==true) {

                // For IE and Firefox
                if (e) {
                    e.returnValue = "{$unsavedchangesstr}";
                }

                // For Safari
                return "{$unsavedchangesstr}";

            }
        };

        // remove the 'unsaved changes' confirmation when submitting the form
        $('form[name="form_prog_details"]').submit(function(){
            window.onbeforeunload = null;
        });

        // Remove the 'unsaved changes' confirmation when clicking th 'Cancel program management' link
        $('#cancelprogramedits').click(function(){
            window.onbeforeunload = null;
            return true;
        });

        // attach a date picker to the available from field
        $('input[name="availablefromselector"]').datepicker(
            {
                dateFormat: 'dd/mm/yy',
                showOn: 'both',
                buttonImage: '{$CFG->wwwroot}/local/js/images/calendar.gif',
                buttonImageOnly: true,
                constrainInput: true
            }
        );

        // attach a date picker to the available until field
        $('input[name="availableuntilselector"]').datepicker(
            {
                dateFormat: 'dd/mm/yy',
                showOn: 'both',
                buttonImage: '{$CFG->wwwroot}/local/js/images/calendar.gif',
                buttonImageOnly: true,
                constrainInput: true
            }
        );

        storeInitialFormValues();
    });

    // Stores the initial values of the form when the page is loaded
    function storeInitialFormValues() {
        var form = $('form[name="form_prog_details"]');
        $('input[type="text"], textarea, select', form).each(function() {
            $(this).attr('initialValue', $(this).val());
        });

        $('input[type="checkbox"]', form).each(function() {
            var checked = $(this).attr('checked') ? 1 : 0;
            $(this).attr('initialValue', checked);
        });
    }

    // Checks if the form is modified by comparing the initial and current values
    function isFormModified() {
        var form = $('form[name="form_prog_details"]');
        var isModified = false;

        // Check if text inputs or selects have been changed
        $('input[type="text"], select', form).each(function() {
            if ($(this).attr('initialValue') != $(this).val()) {
                isModified = true;
            }
        });

        // Check if check boxes have changed
        $('input[type="checkbox"]', form).each(function() {
            var checked = $(this).attr('checked') ? 1 : 0;
            if ($(this).attr('initialValue') != checked) {
                isModified = true;
            }
        });

        // Check if textareas have been changed
        $('textarea', form).each(function() {
            // See if there's a tiny MCE instance for this text area
            var instance = tinyMCE.getInstanceById($(this).attr('id'));
            if (instance != undefined) {
                if (instance.isDirty()) {
                    isModified = true;
                }
            } else {
                // normal textarea (not tinyMCE)
                if ($(this).attr('initialValue') != $(this).val()) {
                    isModified = true;
                }
            }
        });

        return isModified;
    }

</script>
HEREDOC;
}

admin_externalpage_print_footer();

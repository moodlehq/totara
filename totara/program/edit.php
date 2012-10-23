<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
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
require_once($CFG->dirroot . '/totara/core/js/lib/setup.php');
require_once('edit_form.php');

$id = required_param('id', PARAM_INT); // program id
$action = optional_param('action', 'view', PARAM_TEXT);
$category = optional_param('category', '', PARAM_INT);
$nojs = optional_param('nojs', 0, PARAM_INT);

require_login();

$systemcontext = context_system::instance();
$program = new program($id);
$programcontext = $program->get_context();

// Integrate into the admin tree only if the user can edit programs at the top level,
// otherwise the admin block does not appear to this user, and you get an error.
if (has_capability('totara/program:configureprogram', $systemcontext)) {
    admin_externalpage_setup('manageprograms', '', array('id' => $id, 'action' => $action), $CFG->wwwroot.'/totara/program/edit.php', array('context' => $programcontext));
} else {
    $PAGE->set_url(new moodle_url('/totara/program/edit.php', array('id' => $id)));
    $PAGE->set_context($programcontext);
    $PAGE->set_title($program->fullname);
    $PAGE->set_heading($program->fullname);
}

if ($action == 'edit') {
    require_once($CFG->dirroot . '/totara/core/js/lib/setup.php');

    //Javascript include
    local_js(array(
        TOTARA_JS_DIALOG,
        TOTARA_JS_UI,
        TOTARA_JS_DATEPICKER,
        TOTARA_JS_ICON_PREVIEW,
        TOTARA_JS_PLACEHOLDER
    ));

    $PAGE->requires->string_for_js('youhaveunsavedchanges', 'totara_program');
    $args = array('args'=>'{"id":'.$id.'}');
    $jsmodule = array(
            'name' => 'totara_programedit',
            'fullpath' => '/totara/program/program_edit.js',
            'requires' => array('json'));
    $PAGE->requires->js_init_call('M.totara_programedit.init',$args, false, $jsmodule);

    // attach a date picker to the available until/from fields
    build_datepicker_js(
        'input[name="availablefromselector"], input[name="availableuntilselector"]'
    );

    $PAGE->requires->string_for_js('chooseicon', 'totara_program');
    $iconjsmodule = array(
            'name' => 'totara_iconpicker',
            'fullpath' => '/totara/core/js/icon.picker.js',
            'requires' => array('json'));

    $iconargs = array('args' => '{"selected_icon":"' . $program->icon . '",
                            "type":"program"}');

    $PAGE->requires->js_init_call('M.totara_iconpicker.init', $iconargs, false, $iconjsmodule);
}

if (!$progcategory = $DB->get_record('course_categories', array('id' => $program->category))) {
    print_error('error:determineprogcat', 'totara_program');
}

$currenturl = qualified_me();
$currenturl_noquerystring = strip_querystring($currenturl);
$viewurl = $currenturl_noquerystring."?id={$id}&action=view";
$editurl = $currenturl_noquerystring."?id={$id}&action=edit";

$editcontenturl = "{$CFG->wwwroot}/totara/program/edit_content.php?id={$program->id}";
$editassignmentsurl = "{$CFG->wwwroot}/totara/program/edit_assignments.php?id={$program->id}";
$editmessagesurl = "{$CFG->wwwroot}/totara/program/edit_messages.php?id={$program->id}";
//set up textareas
$program->endnoteformat = FORMAT_HTML;
$program->summaryformat = FORMAT_HTML;
$program = file_prepare_standard_editor($program, 'summary', $TEXTAREA_OPTIONS, $TEXTAREA_OPTIONS['context'],
                                          'totara_program', 'progsummary', $id);

$program = file_prepare_standard_editor($program, 'endnote', $TEXTAREA_OPTIONS, $TEXTAREA_OPTIONS['context'],
                                          'totara_program', 'progendnote', $id);
$detailsform = new program_edit_form($currenturl, array('program' => $program, 'action' => $action, 'category' => $progcategory, 'editoroptions' => $TEXTAREA_OPTIONS, 'nojs' => $nojs), 'post', '', array('name'=>'form_prog_details'));

if ($detailsform->is_cancelled()) {
    totara_set_notification(get_string('programupdatecancelled', 'totara_program'), $viewurl, array('class' => 'notifysuccess'));
}

// Redirect to delete page if deleting
if ($action == 'delete') {
    redirect("{$CFG->wwwroot}/totara/program/delete.php?id={$id}&amp;category={$category}");
}

// Handle form submits
if ($data = $detailsform->get_data()) {
    if (isset($data->edit)) {
        redirect($editurl);
    } else if (isset($data->savechanges)) {

        // Preprocess to convert string dates e.g. '23/11/2012' to a unix timestamp
        $data->availablefrom = ($data->availablefromselector) ? totara_date_parse_from_format(get_string('datepickerparseformat', 'totara_core'),$data->availablefromselector) : 0;
        $data->availableuntil = ($data->availableuntilselector) ? totara_date_parse_from_format(get_string('datepickerparseformat', 'totara_core'),$data->availableuntilselector) : 0;

        $data->timemodified = time();
        $data->usermodified = $USER->id;

        // Program has moved categories
        if ($data->category != $program->category) {
            prog_move_programs(array($program->id), $data->category);
        }

        // Save program data
        $DB->update_record('prog', $data);

        if (isset($data->savechanges)) {
            $nexturl = $viewurl;
        }

        file_postupdate_standard_editor($data, 'summary', $TEXTAREA_OPTIONS, $TEXTAREA_OPTIONS['context'], 'program', 'prog', $data->id);
        $DB->set_field('prog', 'summary', $data->summary, array('id' => $data->id));

        file_postupdate_standard_editor($data, 'endnote', $TEXTAREA_OPTIONS, $TEXTAREA_OPTIONS['context'], 'program', 'prog', $data->id);
        $DB->set_field('prog', 'endnote', $data->endnote, array('id' => $data->id));

        totara_set_notification(get_string('programdetailssaved', 'totara_program'), $nexturl, array('class' => 'notifysuccess'));
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

if ($action == 'edit') {
    $currenttab = 'details';
    $heading = $program->fullname;
    $pageid = 'program-overview-details';
} else {
    $currenttab = 'overview';
    $heading = $program->fullname;
}

$pagetitle = format_string(get_string('program', 'totara_program').': '.$heading);
$category_breadcrumbs = get_category_breadcrumbs($program->category);

foreach ($category_breadcrumbs as $crumb) {
        $PAGE->navbar->add($crumb['name'], $crumb['link']);
}

$PAGE->navbar->add($program->shortname, new moodle_url('/totara/program/view.php', array('id' => $id)));

if ($action == 'edit') {
    $PAGE->navbar->add(ucwords($action));
}

echo $OUTPUT->header();

echo $OUTPUT->container_start('program overview', $pageid);

echo $OUTPUT->heading($heading);

$renderer = $PAGE->get_renderer('totara_program');
// Display the current status
echo $program->display_current_status();
$exceptions = $program->get_exception_count();
require('tabs.php');

// Program details
$program->availablefromselector = $program->availablefrom > 0 ? userdate($program->availablefrom, get_string('strftimedatefullshort', 'langconfig'), $CFG->timezone, false) : '';
$program->availableuntilselector = $program->availableuntil > 0 ? userdate($program->availableuntil, get_string('strftimedatefullshort', 'langconfig'), $CFG->timezone, false) : '';

$detailsform->set_data($program);
$detailsform->display();

// display content, assignments and messages if in view mode
if ($action == 'view') {

    // display the content form
    $contentform = new program_content_nonedit_form($editcontenturl, array('program' => $program), 'get');
    $contentform->set_data($program);
    $contentform->display();

    // display the assignments form
    $assignmentform = new program_assignments_nonedit_form($editassignmentsurl, array('program' => $program), 'get');
    $assignmentform->set_data($program);
    $assignmentform->display();

    // display the messages form
    $messagesform = new program_messages_nonedit_form($editmessagesurl, array('program' => $program), 'get');
    $messagesform->set_data($program);
    $messagesform->display();

    // display the delete button form
    if (has_capability('totara/program:deleteprogram', $program->get_context())) {
        $deleteform = new program_delete_form($currenturl, array('program' => $program));
        $deleteform->set_data($program);
        $deleteform->display();
    }

}

if ($action == 'edit') {
    echo $renderer->get_cancel_button(array('id' => $program->id));
}

echo $OUTPUT->container_end();
echo $OUTPUT->footer();

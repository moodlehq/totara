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
 * Page for adding a program
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('lib.php');
require_once($CFG->dirroot . '/totara/core/js/lib/setup.php');
require_once('edit_form.php');


$categoryid = optional_param('category', 0, PARAM_INT); // course category - can be changed in edit form

$systemcontext = context_system::instance();

// Integrate into the admin tree only if the user can create programs at the top level,
// otherwise the admin block does not appear to this user, and you get an error.
if (has_capability('totara/program:createprogram', $systemcontext)) {
    admin_externalpage_setup('manageprograms');
} else {
    $PAGE->set_context($systemcontext);
    $PAGE->set_url(new moodle_url('/totara/program/add.php', array('category' => $categoryid)));
    $PAGE->set_title(get_string('createnewprogram', 'totara_program'));
    $PAGE->set_heading(get_string('createnewprogram', 'totara_program'));
}
//Javascript include
local_js(array(
    TOTARA_JS_DIALOG,
    TOTARA_JS_UI,
    TOTARA_JS_DATEPICKER,
    TOTARA_JS_PLACEHOLDER,
    TOTARA_JS_ICON_PREVIEW
));

$PAGE->requires->string_for_js('chooseicon', 'totara_program');
$iconjsmodule = array(
        'name' => 'totara_iconpicker',
        'fullpath' => '/totara/core/js/icon.picker.js',
        'requires' => array('json'));

$iconargs = array('args' => '{"selected_icon":"default",
                              "type":"program"}');

$PAGE->requires->js_init_call('M.totara_iconpicker.init', $iconargs, false, $iconjsmodule);

if ($categoryid) { // creating new program in this category
    if (!$category = $DB->get_record('course_categories', array('id' => $categoryid))) {
        print_error('Category ID was incorrect');
    }
    require_capability('totara/program:createprogram', context_coursecat::instance($category->id));
} else {
    print_error('Program category must be specified');
}
///
/// Data and actions
///

$item = new stdClass();
$item->id = 0;
$item->endnote = '';
$item->endnoteformat = FORMAT_HTML;
$item->summary = '';
$item->summaryformat = FORMAT_HTML;

$currenturl = qualified_me();
$progindexurl = "{$CFG->wwwroot}/course/index.php?viewtype=program";

$item = file_prepare_standard_editor($item, 'summary', $TEXTAREA_OPTIONS, $TEXTAREA_OPTIONS['context'],
                                          'totara_program', 'progsummary', 0);

$item = file_prepare_standard_editor($item, 'endnote', $TEXTAREA_OPTIONS, $TEXTAREA_OPTIONS['context'],
                                          'totara_program', 'progendnote', 0);
$form = new program_edit_form($currenturl, array('action' => 'add', 'category' => $category, 'editoroptions' => $TEXTAREA_OPTIONS));

if ($form->is_cancelled()) {
    redirect($progindexurl);
}

// Handle form submit
if ($data = $form->get_data()) {
    if (isset($data->savechanges)) {

        $program_todb = new stdClass;

        $program_todb->availablefrom = ($data->availablefromselector) ? totara_date_parse_from_format(get_string('datepickerparseformat', 'totara_core'),$data->availablefromselector) : 0;
        $program_todb->availableuntil = ($data->availableuntilselector) ? totara_date_parse_from_format(get_string('datepickerparseformat', 'totara_core'),$data->availableuntilselector) : 0;
        //Calcuate sortorder
        $sortorder = $DB->get_field('prog', 'MAX(sortorder) + 1', array());

        $now = time();
        $program_todb->timecreated = $now;
        $program_todb->timemodified = $now;
        $program_todb->usermodified = $USER->id;
        $program_todb->category = $data->category;
        $program_todb->shortname = $data->shortname;
        $program_todb->fullname = $data->fullname;
        $program_todb->idnumber = $data->idnumber;
        $program_todb->available = $data->available;
        $program_todb->sortorder = !empty($sortorder) ? $sortorder : 0;
        $program_todb->icon = $data->icon;
        $program_todb->exceptionssent = 0;
        $program_todb->visible = $data->visible;
        //text editor fields will be updated later
        $program_todb->summary = '';
        $program_todb->endnote ='';
        $newid = 0;

        $transaction = $DB->start_delegated_transaction();
        // Set up the program
        $newid = $DB->insert_record('prog', $program_todb);
        $program = new program($newid);
        $transaction->allow_commit();

        $data = file_postupdate_standard_editor($data, 'summary', $TEXTAREA_OPTIONS, $TEXTAREA_OPTIONS['context'], 'totara_program', 'progsummary', $newid);
        $data = file_postupdate_standard_editor($data, 'endnote', $TEXTAREA_OPTIONS, $TEXTAREA_OPTIONS['context'], 'totara_program', 'progendnote', $newid);
        $DB->set_field('prog', 'summary', $data->summary, array('id' => $newid));
        $DB->set_field('prog', 'endnote', $data->endnote, array('id' => $newid));

        add_to_log(SITEID, 'program', 'created', "edit.php?id={$newid}", $program->fullname);

        // take them straight to edit page if they have permissions,
        // otherwise view the program
        $programcontext = context_program::instance($newid);
        if (has_capability('totara/program:configuredetails', $programcontext)) {
            $viewurl = "{$CFG->wwwroot}/totara/program/edit.php?id={$newid}&amp;action=edit";
        } else {
            $viewurl = "{$CFG->wwwroot}/totara/program/view.php?id={$newid}";
        }
        //call prog_fix_program_sortorder to ensure new program is displayed properly and category->programcount is updated
        prog_fix_program_sortorder($data->category);
        totara_set_notification(get_string('programcreatesuccess', 'totara_program'), $viewurl, array('class' => 'notifysuccess'));
    }
}

///
/// Display
///
$heading = get_string('createnewprogram', 'totara_program');
$pagetitle = format_string(get_string('program', 'totara_program').': '.$heading);
prog_add_base_navlinks();
$PAGE->navbar->add($heading);

echo $OUTPUT->header();

echo $OUTPUT->container_start('program add', 'program-add');

//$id = $program->id;
$context = context_coursecat::instance($category->id);
$exceptions = 0;
echo $OUTPUT->heading($heading);

require('tabs.php');

$form->display();

echo $OUTPUT->container_end();

echo build_datepicker_js(
    'input[name="availablefromselector"], input[name="availableuntilselector"]'
);

echo $OUTPUT->footer();


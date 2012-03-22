<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
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
 * @subpackage totara_customfield
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/totara/customfield/indexlib.php');
require_once($CFG->dirroot.'/totara/customfield/fieldlib.php');
require_once($CFG->dirroot.'/totara/customfield/definelib.php');
require_once($CFG->dirroot.'/totara/hierarchy/lib.php');

require_login();

$prefix         = required_param('prefix', PARAM_ALPHA);        // hierarchy name or mod name
$typeid         = optional_param('typeid', '0', PARAM_INT);    // typeid if hierarchy
$action         = optional_param('action', '', PARAM_ALPHA);    // param for some action
$id             = optional_param('id', 0, PARAM_INT); // id of a custom field

// use $prefix to determine where to get custom field data from
if ($prefix == 'course') {
    $shortprefix = 'course';
    $adminpagename = 'coursecustomfields';
    $tableprefix = $shortprefix;
} else {
    // Confirm the hierarchy prefix exists
    $hierarchy = hierarchy::load_hierarchy($prefix);
    $shortprefix = hierarchy::get_short_prefix($prefix);
    $adminpagename = $prefix . 'typemanage';
    $tableprefix = $shortprefix.'_type';
}

$redirectoptions = array('prefix' => $prefix);
$redirect = new moodle_url('/totara/customfield/index.php', $redirectoptions);
if ($typeid) {
    $redirectoptions['typeid'] = $typeid;
}
if ($id) {
    $redirectoptions['id'] = $id;
}

// get some relevant data
if ($typeid) {
    $type = $hierarchy->get_type_by_id($typeid);
}

// set up breadcrumbs trail
if ($typeid) {
    $pagetitle = format_string(get_string($prefix.'depthcustomfields', 'totara_hierarchy'));

    $PAGE->navbar->add(get_string($prefix.'types', 'totara_hierarchy'),
                        new moodle_url('/totara/hierarchy/type/index.php', array('prefix' => $prefix)));

    $PAGE->navbar->add(format_string($type->fullname));

} else if ($prefix == 'course') {
    $pagetitle = format_string(get_string('coursecustomfields', 'totara_customfield'));
    $PAGE->navbar->add(get_string('administration'));
    $PAGE->navbar->add(get_string('courses'));
    $PAGE->navbar->add(get_string('coursecustomfields', 'totara_customfield'));
}

$navlinks = $PAGE->navbar->has_items();

$sitecontext = context_system::instance();
require_capability('totara/hierarchy:update'.$prefix.'customfield', $sitecontext);
admin_externalpage_setup($adminpagename, '', array('prefix' => $prefix));

// check if any actions need to be performed
switch ($action) {
   case 'movefield':
        require_capability('totara/hierarchy:update'.$prefix.'customfield', $sitecontext);
        $id  = required_param('id', PARAM_INT);
        $dir = required_param('dir', PARAM_ALPHA);

        if (confirm_sesskey()) {
            customfield_move_field($id, $dir, $tableprefix);
        }
        redirect($redirect);
        break;
    case 'deletefield':
        require_capability('totara/hierarchy:delete'.$prefix.'customfield', $sitecontext);
        $id      = required_param('id', PARAM_INT);
        $confirm = optional_param('confirm', 0, PARAM_BOOL);

        if (data_submitted() and $confirm and confirm_sesskey()) {
            customfield_delete_field($id, $tableprefix);
            redirect($redirect);
        }

        //ask for confirmation
        $optionsyes = array ('id'=>$id, 'confirm'=>1, 'action'=>'deletefield', 'sesskey'=>sesskey());
        echo $OUTPUT->header();
        echo $OUTPUT->heading(get_string('deletefield', 'totara_customfield'), '1');
        $formcontinue = html_form::make_button($redirect, $optionsyes, get_string('yes'), 'post');
        $formcancel = html_form::make_button($redirect, $redirectoptions, get_string('no'), 'get');
        echo $OUTPUT->confirm(get_string('confirmfielddeletion', 'totara_customfield', $datacount), $formcontinue, $formcancel);
        echo $OUTPUT->footer();
        die;
        break;
    case 'editfield':
        require_capability('totara/hierarchy:update'.$prefix.'customfield', $sitecontext);
        $id       = optional_param('id', 0, PARAM_INT);
        $datatype = optional_param('datatype', '', PARAM_ALPHA);

        customfield_edit_field($id, $datatype, $typeid, $redirect, $tableprefix, $prefix, $navlinks);
        die;
        break;
    default:
}
// Display page header

echo $OUTPUT->header();

// Print return to type link
if ($prefix != 'course') {
    $url = $OUTPUT->action_link(new moodle_url('/totara/hierarchy/type/index.php', array('prefix' => $prefix, 'typeid' => $typeid)),
                                "&laquo;" . get_string('alltypes', 'totara_hierarchy'));
    echo html_writer::tag('p', $url);
}

if ($prefix == 'course') {
    $heading = get_string('coursecustomfields', 'totara_customfield');
    echo $OUTPUT->heading($heading, 1);
} else {
    echo $OUTPUT->heading(format_string($type->fullname), 1);
}

// show custom fields for the given type
$table = new html_table();
$table->head  = array(get_string('customfield', 'totara_customfield'), get_string('edit'));
$table->align = array('left', 'right');
$table->width = '95%';
$table->class = 'generaltable customfields';
if ($prefix == 'course') {
    $table->id = 'customfields_course';
} else {
    $table->id = 'customfields_'.$hierarchy->prefix;
}
$table->data = array();

if ($typeid) {
    $field = 'typeid';
    $value = $typeid;
} else {
    $field = '';
    $value = '';
}

if ($fields = $DB->get_records($tableprefix.'_info_field', array($field => $value), 'sortorder ASC')) {

    $fieldcount = count($fields);

    foreach ($fields as $field) {
        $table->data[] = array($field->fullname, customfield_edit_icons($field, $fieldcount, $typeid, $prefix));
    }
}
if (count($table->data)) {
    echo $OUTPUT->table($table);
} else {
    echo $OUTPUT->notification(get_string('nocustomfieldsdefined', 'totara_customfield'));
}
echo html_writer::empty_tag('br');
// Create a new custom field dropdown menu
$options = customfield_list_datatypes();

if ($prefix == 'course') {
    $select = $OUTPUT->single_select(new moodle_url('index.php', array('prefix' => $prefix, 'id' => 0, 'action' => 'editfield', 'datatype' => '')), 'datatype', $options);
    $select->formid = 'newfieldform';
    echo $OUTPUT->render($select);
} else {
    $select = $OUTPUT->single_select(new moodle_url('index.php', array('prefix' => $prefix, 'id' => 0, 'action' => 'editfield', 'typeid' => $typeid, 'datatype' => '')), 'datatype', $options);
    $select->formid = 'newfieldform';
    echo $OUTPUT->render($select);
}

echo $OUTPUT->footer();

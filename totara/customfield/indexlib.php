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
 * @author Jonathan Newman
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage totara_customfield
 */

/**
 * customfieldslib.php
 *
 * Library file of custom field functions
 * Based on the custom user profile field functionality
 */

/**
 * Create a string containing the editing icons for custom fields
 * @param   object   the field object
 * @param   object   the fieldcount object
 * @param   object   the typeid of the object if used
 * @return  string   the icon string
 */
function customfield_edit_icons($field, $fieldcount, $typeid=0, $prefix) {
    global $OUTPUT;

    if (empty($str)) {
        $strdelete   = get_string('delete');
        $strmoveup   = get_string('moveup');
        $strmovedown = get_string('movedown');
        $stredit     = get_string('edit');
    }

    /// Edit
    $params = array('prefix' => $prefix, 'id' => $field->id, 'action' => 'editfield');
    if ($typeid != null) {
        $params['typeid'] = $typeid;
    }
    $editstr = $OUTPUT->action_icon(new moodle_url('index.php', $params), new pix_icon('t/edit', $stredit), null, array('title' => $stredit));

    /// Delete
    $params['action'] = 'deletefield';
    $deletestr = $OUTPUT->action_icon(new moodle_url('index.php', $params), new pix_icon('t/delete', $strdelete), null, array('title' => $strdelete));

    /// Move up
    if ($field->sortorder > 1) {
        $params['action'] = 'movefield';
        $params['dir'] = 'up';
        $params['sesskey'] = sesskey();
        $upstr = $OUTPUT->action_icon(new moodle_url('index.php', $params), new pix_icon('t/up', $strmoveup), null, array('title' => $strmoveup));
    } else {
        $upstr = $OUTPUT->spacer(array('class' => 'iconsmall'));
    }

    /// Move down
    if ($field->sortorder < $fieldcount) {
        $params['action'] = 'movefield';
        $params['dir'] = 'down';
        $params['sesskey'] = sesskey();
        $downstr = $OUTPUT->action_icon(new moodle_url('index.php', $params), new pix_icon('t/down', $strmovedown), null, array('title' => $strmovedown));
    } else {
        $downstr = $OUTPUT->spacer(array());
    }

    return $editstr . $deletestr . $upstr . $downstr;
}


function customfield_delete_field($id, $tableprefix) {
    global $DB;
    /// Remove any user data associated with this field
    $DB->delete_records($tableprefix.'_info_data', array('fieldid' => $id));

    /// Try to remove the record from the database
    $DB->delete_records($tableprefix.'_info_field', array('id' => $id));

    /// Reorder the remaining fields
    customfield_reorder_fields($tableprefix);
}

/**
 * Change the sortorder of a field
 * @param   integer   id of the field
 * @param   string    direction of move
 * @return  boolean   success of operation
 */
function customfield_move_field($id, $move, $tableprefix) {
    global $DB;
    /// Get the field object
    $field = $DB->get_record($tableprefix.'_info_field', array('id' => $id), 'id, sortorder');

    /// Count the number of fields
    $fieldcount = $DB->count_records($tableprefix.'_info_field');

    /// Calculate the new sortorder
    if (($move == 'up') and ($field->sortorder > 1)) {
        $neworder = $field->sortorder - 1;
    } elseif (($move == 'down') and ($field->sortorder < $fieldcount)) {
        $neworder = $field->sortorder + 1;
    } else {
        return false;
    }

    /// Retrieve the field object that is currently residing in the new position
    $swapfield = $DB->get_record($tableprefix.'_info_field', array('sortorder' => $neworder));

    /// Swap the sortorders
    $swapfield->sortorder = $field->sortorder;
    $field->sortorder     = $neworder;

    /// Update the field records
    $DB->update_record($tableprefix.'_info_field', $field);
    $DB->update_record($tableprefix.'_info_field', $swapfield);

    customfield_reorder_fields($tableprefix);
}


/**
 * Retrieve a list of all the available data types
 * @return   array   a list of the datatypes suitable to use in a select statement
 */
function customfield_list_datatypes() {
    global $CFG;

    $datatypes = array();

    if ($dirlist = get_directory_list($CFG->dirroot.'/totara/customfield/field', '', false, true, false)) {
        foreach ($dirlist as $type) {
            $datatypes[$type] = get_string('customfieldtype'.$type, 'totara_customfield');
            if (strpos($datatypes[$type], '[[') !== false) {
                $datatypes[$type] = get_string('customfieldtype'.$type, 'admin');
            }
        }
    }
    asort($datatypes);

    return $datatypes;
}


function customfield_edit_field($id, $datatype, $typeid=0, $redirect, $tableprefix, $prefix, $navlinks=false) {
    global $CFG, $DB, $OUTPUT, $PAGE;

    if (!$field = $DB->get_record($tableprefix.'_info_field', array('id' => $id))) {
        $field = new stdClass();
        $field->datatype = $datatype;
    }

    $displayadminheader = $prefix == 'type' ? 1 : 0;

    require_once($CFG->dirroot.'/totara/customfield/index_field_form.php');
    $datatosend = array('datatype' => $field->datatype, 'prefix' => $prefix,
                        'typeid' => $typeid, 'tableprefix' => $tableprefix);
    $fieldform = new field_form(null, $datatosend);
    $fieldform->set_data($field);

    if ($fieldform->is_cancelled()) {
        redirect($redirect);

    } else {
        if ($data = $fieldform->get_data()) {
            require_once($CFG->dirroot.'/totara/customfield/field/'.$datatype.'/define.class.php');
            $newfield = 'customfield_define_'.$datatype;
            $formfield = new $newfield();
            $formfield->define_save($data, $tableprefix);
            customfield_reorder_fields($tableprefix);
            redirect($redirect);
        }

        $datatypes = customfield_list_datatypes();

        if (empty($id)) {
            $strheading = get_string('createnewfield', 'totara_customfield', $datatypes[$datatype]);
        } else {
            $strheading = get_string('editfield', 'totara_customfield', $field->fullname);
        }

        /// Print the page
        // Display page header
        $pagetitle = format_string($DB->get_field($tableprefix, 'fullname', array('id' => $typeid)));
        if ($navlinks == false) {
            $PAGE->navbar->add(get_string('administration'));
            $PAGE->navbar->add(get_string($prefix.'plural', 'totara_customfield'));
            $PAGE->navbar->add(get_string($prefix.'depthcustomfields', 'totara_customfield'));
        }

        if ($displayadminheader) {
            admin_externalpage_setup($prefix.'typemanage', '', array('prefix'=>$prefix));
            echo $OUTPUT->header();
        } else {
            $PAGE->set_title($pagetitle);
            $PAGE->set_heading('');
            $PAGE->set_focuscontrol('');
            $PAGE->set_cacheable(true);
            echo $OUTPUT->header();
        }
        echo $OUTPUT->heading($strheading, '1');
        $fieldform->display();
        echo $OUTPUT->footer();
        die;
    }
}


/**
 * Reorder the custom fields starting
 * at the field at the given startorder
 */
function customfield_reorder_fields($tableprefix) {
    global $DB;
    $i = 1;
    $fields = $DB->get_records($tableprefix.'_info_field', array(), 'sortorder ASC');
    foreach ($fields as $field) {
        $f = new stdClass();
        $f->id = $field->id;
        $f->sortorder = $i++;
        $DB->update_record($tableprefix.'_info_field', $f);
    }
}

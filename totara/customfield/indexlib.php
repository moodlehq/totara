<?php
///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT                                                   //
//                                                                       //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//          http://moodle.org                                            //
//                                                                       //
// Copyright (C) 1999 onwards Martin Dougiamas  http://dougiamas.com     //
//                                                                       //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

/**
 * customfieldslib.php
 *
 * Library file of custom field functions
 * Based on the custom user profile field functionality
 * @copyright Catalyst IT Limited
 * @author Jonathan Newman 
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 */

/**
 * Create a string containing the editing icons for custom fields
 * @param   object   the field object
 * @param   object   the fieldcount object
 * @param   object   the typeid of the object if used
 * @return  string   the icon string
 */
function customfield_edit_icons($field, $fieldcount, $typeid=0, $prefix) {
    global $CFG;

    if (empty($str)) {
        $strdelete   = get_string('delete');
        $strmoveup   = get_string('moveup');
        $strmovedown = get_string('movedown');
        $stredit     = get_string('edit');
    }

    $prefixstr = 'prefix=' . $prefix;
    $typeidstr = ($typeid) ? '&amp;typeid=' . $typeid : '';

    /// Edit
    $editstr = '<a title="' . $stredit . '" href="index.php?' .
        $prefixstr . '&id=' . $field->id .
        $typeidstr . '&amp;action=editfield"><img src="' .
        $CFG->pixpath . '/t/edit.gif" alt="' . $stredit .
        '" class="iconsmall" /></a> ';

    /// Delete
    $editstr .= '<a title="' . $strdelete . '" href="index.php?' .
        $prefixstr . '&id=' . $field->id .
        $typeidstr . '&amp;action=deletefield';
    $editstr .= '"><img src="' . $CFG->pixpath.'/t/delete.gif" alt="' .
        $strdelete.'" class="iconsmall" /></a> ';

    /// Move up
    if ($field->sortorder > 1) {
        $editstr .= '<a title="' . $strmoveup . '" href="index.php?' .
            $prefixstr . '&id='.$field->id .
            $typeidstr .
            '&amp;action=movefield&amp;dir=up&amp;sesskey=' . sesskey() .
            '"><img src="' . $CFG->pixpath . '/t/up.gif" alt="' . $strmoveup .
            '" class="iconsmall" /></a> ';
     } else {
         $editstr .= '<img src="' . $CFG->pixpath .
             '/spacer.gif" alt="" class="iconsmall" /> ';
    }

    /// Move down
    if ($field->sortorder < $fieldcount) {
        $editstr .= '<a title="' . $strmovedown . '" href="index.php?' .
            $prefixstr . '&id=' . $field->id .
            $typeidstr .
            '&amp;action=movefield&amp;dir=down&amp;sesskey=' . sesskey() .
            '"><img src="' . $CFG->pixpath . '/t/down.gif" alt="' .
            $strmovedown . '" class="iconsmall" /></a> ';
    } else {
        $editstr .= '<img src="' . $CFG->pixpath .
            '/spacer.gif" alt="" class="iconsmall" /> ';
    }

    return $editstr;
}


function customfield_delete_field($id, $tableprefix) {

    /// Remove any user data associated with this field
    if (!delete_records($tableprefix.'_info_data', 'fieldid', $id)) {
        error('Error deleting custom field data');
    }

    /// Try to remove the record from the database
    delete_records($tableprefix.'_info_field', 'id', $id);

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
    /// Get the field object
    if (!$field = get_record($tableprefix.'_info_field', 'id', $id, '', '', '', '', 'id, sortorder')) {
        return false;
    }
    /// Count the number of fields
    $fieldcount = count_records($tableprefix.'_info_field');

    /// Calculate the new sortorder
    if ( ($move == 'up') and ($field->sortorder > 1)) {
        $neworder = $field->sortorder - 1;
    } elseif ( ($move == 'down') and ($field->sortorder < $fieldcount)) {
        $neworder = $field->sortorder + 1;
    } else {
        return false;
    }

    /// Retrieve the field object that is currently residing in the new position
    if ($swapfield = get_record($tableprefix.'_info_field', 'sortorder', $neworder, '', '', 'id, sortorder')) {

        /// Swap the sortorders
        $swapfield->sortorder = $field->sortorder;
        $field->sortorder     = $neworder;

        /// Update the field records
        update_record($tableprefix.'_info_field', $field);
        update_record($tableprefix.'_info_field', $swapfield);
    }

    customfield_reorder_fields($tableprefix);
}


/**
 * Retrieve a list of all the available data types
 * @return   array   a list of the datatypes suitable to use in a select statement
 */
function customfield_list_datatypes() {
    global $CFG;

    $datatypes = array();

    if ($dirlist = get_directory_list($CFG->dirroot.'/customfield/field', '', false, true, false)) {
        foreach ($dirlist as $type) {
            $datatypes[$type] = get_string('customfieldtype'.$type, 'customfields');
            if (strpos($datatypes[$type], '[[') !== false) {
                $datatypes[$type] = get_string('customfieldtype'.$type, 'admin');
            }
        }
    }
    asort($datatypes);

    return $datatypes;
}


function customfield_edit_field($id, $datatype, $typeid=0, $redirect, $tableprefix, $prefix, $navlinks=array()) {
    global $CFG;

    if (!$field = get_record($tableprefix.'_info_field', 'id', $id)) {
        $field = new object();
        $field->datatype = $datatype;
    }

    $displayadminheader = $prefix == 'type' ? 1 : 0;

    require_once($CFG->dirroot.'/customfield/index_field_form.php');
    $datatosend = array('datatype' => $field->datatype, 'prefix' => $prefix,
                        'typeid' => $typeid, 'tableprefix' => $tableprefix);
    $fieldform = new field_form(null, $datatosend);
    $fieldform->set_data($field);

    if ($fieldform->is_cancelled()) {
        redirect($redirect);

    } else {
        if ($data = $fieldform->get_data()) {
            require_once($CFG->dirroot.'/customfield/field/'.$datatype.'/define.class.php');
            $newfield = 'customfield_define_'.$datatype;
            $formfield = new $newfield();
            $formfield->define_save($data, $tableprefix);
            customfield_reorder_fields($tableprefix);
            redirect($redirect);
        }

        $datatypes = customfield_list_datatypes();

        if (empty($id)) {
            $strheading = get_string('createnewfield', 'customfields', $datatypes[$datatype]);
        } else {
            $strheading = get_string('editfield', 'customfields', $field->fullname);
        }

        /// Print the page
        // Display page header
        $pagetitle = format_string(get_field($tableprefix, 'fullname', 'id', $typeid));
        if (!count($navlinks)) {
            $navlinks[] = array('name' => get_string('administration'), 'link'=> '', 'type'=>'title');
            $navlinks[] = array('name' => get_string($prefix.'plural',$prefix), 'link'=> '', 'type'=>'title');
            $navlinks[] = array('name' => get_string($prefix.'depthcustomfields',$prefix), 'link'=> '', 'type'=>'title');
        }

        $navigation = build_navigation($navlinks);

        if ($displayadminheader) {
            admin_externalpage_setup($prefix.'typemanage', '', array('prefix'=>$prefix));
            admin_externalpage_print_header('', $navlinks);
        } else {
            print_header_simple($pagetitle, '', $navigation, '', null, true);
        }
        print_heading($strheading, '', '1');
        $fieldform->display();
        print_footer();
        die;
    }
}


/**
 * Reorder the custom fields starting
 * at the field at the given startorder
 */
function customfield_reorder_fields($tableprefix) {

    $i = 1;
    if ($fields = get_records($tableprefix.'_info_field', '', '', 'sortorder ASC')) {
        foreach ($fields as $field) {
            $f = new object();
            $f->id = $field->id;
            $f->sortorder = $i++;
            update_record($tableprefix.'_info_field', $f);
        }   
    }   
}


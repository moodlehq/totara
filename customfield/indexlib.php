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
 * @param   object   the depthid of the object if used
 * @return  string   the icon string
 */
function customfield_edit_icons($field, $fieldcount, $depthid=0, $type, $subtype=0, $frameworkid=0, $categoryid=0) {
    global $CFG;

    if (empty($str)) {
        $strdelete   = get_string('delete');
        $strmoveup   = get_string('moveup');
        $strmovedown = get_string('movedown');
        $stredit     = get_string('edit');
    }

    $typestr = 'type=' . $type;
    $subtypestr = ($subtype) ? '&amp;subtype=' . $subtype : '';
    $depthidstr = ($depthid) ? '&amp;depthid=' . $depthid : '';
    $frameworkidstr = ($frameworkid) ? '&amp;frameworkid=' . $frameworkid : '';
    $categoryidstr = ($categoryid) ? '&amp;categoryid=' . $categoryid : '';

    /// Edit
    $editstr = '<a title="' . $stredit . '" href="index.php?' .
        $typestr . $subtypestr . '&id=' . $field->id . $frameworkidstr .
        $categoryidstr . $depthidstr . '&amp;action=editfield"><img src="' .
        $CFG->pixpath . '/t/edit.gif" alt="' . $stredit .
        '" class="iconsmall" /></a> ';

    /// Delete
    $editstr .= '<a title="' . $strdelete . '" href="index.php?' .
        $typestr . $subtypestr . '&id=' . $field->id . $frameworkidstr .
        $categoryidstr . $depthidstr . '&amp;action=deletefield';
    $editstr .= '"><img src="' . $CFG->pixpath.'/t/delete.gif" alt="' .
        $strdelete.'" class="iconsmall" /></a> ';

    /// Move up
    if ($field->sortorder > 1) {
        $editstr .= '<a title="' . $strmoveup . '" href="index.php?' .
            $typestr . $subtypestr . '&id='.$field->id . $frameworkidstr .
            $categoryidstr . $depthidstr .
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
            $typestr . $subtypestr . '&id=' . $field->id . $frameworkidstr .
            $categoryidstr . $depthidstr .
            '&amp;action=movefield&amp;dir=down&amp;sesskey=' . sesskey() .
            '"><img src="' . $CFG->pixpath . '/t/down.gif" alt="' .
            $strmovedown . '" class="iconsmall" /></a> ';
    } else {
        $editstr .= '<img src="' . $CFG->pixpath .
            '/spacer.gif" alt="" class="iconsmall" /> ';
    }

    return $editstr;
}

/**
 * Create a string containing the editing icons for the custom field categories
 * @param   object   the category object
 * @param   int      the number of categories
 * @param   int      the number of fields in the category
 * @param   object   the depthid of the object if used
 * @return  string   the icon string
 */
function customfield_category_icons($category, $categorycount, $fieldcount, $depthid=0, $type, $subtype) {
    global $CFG;

    $strdelete   = get_string('delete');
    $strmoveup   = get_string('moveup');
    $strmovedown = get_string('movedown');
    $stredit     = get_string('edit');

    /// Edit
    $editstr = '<a title="'.$stredit.'" href="index.php?type='.$type.'&subtype='.$subtype.'&id='.$category->id.'&amp;depthid='.$depthid.'&amp;action=editcategory"><img src="'.$CFG->pixpath.'/t/edit.gif" alt="'.$stredit.'" class="iconsmall" /></a> ';

    /// Delete
    /// Can only delete the last category if there are no fields in it
    if ( ($categorycount > 1) or ($fieldcount == 0) ) {
        $editstr .= '<a title="'.$strdelete.'" href="index.php?type='.$type.'&subtype='.$subtype.'&id='.$category->id.'&amp;depthid='.$depthid.'&amp;action=deletecategory';
        $editstr .= '"><img src="'.$CFG->pixpath.'/t/delete.gif" alt="'.$strdelete.'" class="iconsmall" /></a> ';
    } else {
        $editstr .= '<img src="'.$CFG->pixpath.'/spacer.gif" alt="" class="iconsmall" /> ';
    }

    /// Move up
    if ($category->sortorder > 1) {
        $editstr .= '<a title="'.$strmoveup.'" href="index.php?type='.$type.'&subtype='.$subtype.'&id='.$category->id.'&amp;depthid='.$depthid.'&amp;action=movecategory&amp;dir=up&amp;sesskey='.sesskey().'"><img src="'.$CFG->pixpath.'/t/up.gif" alt="'.$strmoveup.'" class="iconsmall" /></a> ';
    } else {
        $editstr .= '<img src="'.$CFG->pixpath.'/spacer.gif" alt="" class="iconsmall" /> ';
    }

    /// Move down
    if ($category->sortorder < $categorycount) {
        $editstr .= '<a title="'.$strmovedown.'" href="index.php?type='.$type.'&subtype='.$subtype.'&id='.$category->id.'&amp;depthid='.$depthid.'&amp;action=movecategory&amp;dir=down&amp;sesskey='.sesskey().'"><img src="'.$CFG->pixpath.'/t/down.gif" alt="'.$strmovedown.'" class="iconsmall" /></a> ';
    } else {
        $editstr .= '<img src="'.$CFG->pixpath.'/spacer.gif" alt="" class="iconsmall" /> ';
    }

    return $editstr;
}

/**
 * Delete a custom field category
 * @param   integer   id of the category to be deleted
 * @param   integer   depthid of the category to be deleted
 * @param   string    table prefix for the type the category belongs to
 * @return  boolean   success of operation
 */
function customfield_delete_category($id, $depthid=0, $tableprefix) {
    /// Retrieve the category
    if (!$category = get_record($tableprefix.'_info_category', 'id', $id)) {
        error('Incorrect category id');
    }

    if($depthid) {
        // get other categories at same depth level
        // get sortorder as first field so array keys will be sortorder
        if (!$categories = get_records($tableprefix.'_info_category', 'depthid', $category->depthid, 'sortorder ASC','sortorder,id')) {
            error('Error no categories!?!?');
        }
    } else {
        // get all other categories
        // get sortorder as first field so array keys will be sortorder
        if (!$categories = get_records($tableprefix.'_info_category', 1, 1, 'sortorder ASC','sortorder,id')) {
            error('Error no categories!?!?');
        }
    }

    $fieldcount = count_records($tableprefix.'_info_field', 'categoryid', $id);
    if ( $fieldcount > 0 && count($categories) == 1 ){
        error('Can\'t delete the last custom field category if it contains at least one field.');
    }

    unset($categories[$category->sortorder]);

    /// Does the category contain any fields
    if ( $fieldcount ) {
        if (array_key_exists($category->sortorder-1, $categories)) {
            $newcategory = $categories[$category->sortorder-1];
        } else if (array_key_exists($category->sortorder+1, $categories)) {
            $newcategory = $categories[$category->sortorder+1];
        } else {
            $newcategory = reset($categories); // get first category if sortorder broken
        }   

        $sortorder = count_records($tableprefix.'_info_field', 'categoryid', $newcategory->id) + 1;

        if ($fields = get_records_select($tableprefix.'_info_field', 'categoryid='.$category->id, 'sortorder ASC')) {
            foreach ($fields as $field) {
                $f = new object();
                $f->id = $field->id;
                $f->sortorder = $sortorder++;
                $f->categoryid = $newcategory->id;
                update_record($tableprefix.'_info_field', $f);
            }   
        }   
    }   

    /// Finally we get to delete the category
    if (!delete_records($tableprefix.'_info_category', 'id', $category->id)) {
        error('Error while deleting category');
    }   
    customfield_reorder_categories($depthid, $tableprefix);
    return true;
}

function customfield_delete_field($id, $tableprefix) {

    /// Remove any user data associated with this field
    if (!delete_records($tableprefix.'_info_data', 'fieldid', $id)) {
        error('Error deleting custom field data');
    }

    /// Try to remove the record from the database
    delete_records($tableprefix.'_info_field', 'id', $id);

    /// Reorder the remaining fields in the same category
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
    if (!$field = get_record($tableprefix.'_info_field', 'id', $id, '', '', '', '', 'id, sortorder, categoryid')) {
        return false;
    }
    /// Count the number of fields in this category
    $fieldcount = count_records_select($tableprefix.'_info_field', 'categoryid='.$field->categoryid);

    /// Calculate the new sortorder
    if ( ($move == 'up') and ($field->sortorder > 1)) {
        $neworder = $field->sortorder - 1;
    } elseif ( ($move == 'down') and ($field->sortorder < $fieldcount)) {
        $neworder = $field->sortorder + 1;
    } else {
        return false;
    }

    /// Retrieve the field object that is currently residing in the new position
    if ($swapfield = get_record($tableprefix.'_info_field', 'categoryid', $field->categoryid, 'sortorder', $neworder, '', '', 'id, sortorder')) {

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
 * Change the sortorder of a category
 * @param   integer   id of the category
 * @param   string    direction of move
 * @return  boolean   success of operation
 */
function customfield_move_category($id, $move, $depthid=0, $tableprefix) {
    /// Get the category object
    if (!($category = get_record($tableprefix.'_info_category', 'id', $id, '', '', '', '', 'id, sortorder'))) {
        return false;
    }

    /// Count the number of categories
    if ($depthid) {
        $categorycount = count_records($tableprefix.'_info_category', 'depthid', $depthid);
    } else {
        $categorycount = count_records($tableprefix.'_info_category');
    }

    /// Calculate the new sortorder
    if ( ($move == 'up') and ($category->sortorder > 1)) {
        $neworder = $category->sortorder - 1;
    } elseif ( ($move == 'down') and ($category->sortorder < $categorycount)) {
        $neworder = $category->sortorder + 1;
    } else {
        return false;
    }

    /// Retrieve the category object that is currently residing in the new position
    if ($depthid) {

        if ($swapcategory = get_record($tableprefix.'_info_category', 'sortorder', $neworder, 'depthid', $depthid, '', '', 'id, sortorder')) {

            /// Swap the sortorders
            $swapcategory->sortorder = $category->sortorder;
            $category->sortorder     = $neworder;

            /// Update the category records
            if (update_record($tableprefix.'_info_category', $category) and update_record($tableprefix.'_info_category', $swapcategory)) {
                return true;
            }
        }

    } else {

        if ($swapcategory = get_record($tableprefix.'_info_category', 'sortorder', $neworder, '', '', '', '', 'id, sortorder')) {

            /// Swap the sortorders
            $swapcategory->sortorder = $category->sortorder;
            $category->sortorder     = $neworder;

            /// Update the category records
            if (update_record($tableprefix.'_info_category', $category) and update_record($tableprefix.'_info_category', $swapcategory)) {
                return true;
            }
        }
    }

    return false;
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

/**
 * Retrieve a list of categories and ids suitable for use in a form
 * @return   array
 */
function customfield_list_categories($depthid=0, $tableprefix) {
    $depthstr = '';
    if ($depthid) {
        $depthstr = "depthid = '$depthid'";
    }
    if (!$categories = get_records_select_menu($tableprefix.'_info_category', $depthstr, 'sortorder ASC', 'id, name')) {
        $categories = array();
    }
    return $categories;
}

function customfield_edit_category($id, $depthid=0, $redirect, $tableprefix, $type, $subtype, $frameworkid=0, $navlinks=array()) {
    global $CFG;

    require_once($CFG->dirroot.'/customfield/index_category_form.php');

    $displayadminheader = $frameworkid ? 1 : 0;

    $datatosend = array('type' => $type, 
                        'subtype' => $subtype,
                        'frameworkid' => $frameworkid,
                        'depthid' => $depthid, 
                        'categoryid' => $id, 
                        'tableprefix' => $tableprefix);
    $categoryform = new category_form(null, $datatosend);

    if ($category = get_record($tableprefix.'_info_category', 'id', $id)) {
        $categoryform->set_data($category);
    }

    if ($categoryform->is_cancelled()) {
        redirect($redirect);
    } else {
        if ($data = $categoryform->get_data()) {

            // new record
            if ($data->categoryid == 0) {

                $depthstr = '';
                if ($data->depthid) {
                    $depthid = $data->depthid;
                    $depthstr = "depthid='$data->depthid'";
                }

                $categorycount = count_records_select($tableprefix.'_info_category', $depthstr);
                $data->sortorder = $categorycount + 1;

                if (!insert_record($tableprefix.'_info_category', $data, false)) {
                    error('There was a problem adding the record to the database');
                }
            } else {
                $data->id = $data->categoryid;
                if (!update_record($tableprefix.'_info_category', $data)) {
                    error('There was a problem updating the record in the database');
                }
            }
            customfield_reorder_categories($depthid, $tableprefix);

            if ($data->depthid && !$displayadminheader) {  // Redirect to the right place (customfield/index.php or admin)
                $redirect .= '?depthid='.$data->depthid;
            }

            redirect($redirect);

        }

        if (empty($id)) {
            $strheading = get_string('createnewcategory', 'customfields');
        } else {
            $strheading = get_string('editcategory', 'customfields', format_string($category->name));
        }

        /// Print the page
        // Display page header
        $pagetitle = format_string(get_string($type.'depthcustomfields',$type));
        
        if (!count($navlinks)) {    
            // Use default breadcrumbs
            $navlinks[] = array('name' => get_string('administration'), 'link'=> '', 'type'=>'title');
            $navlinks[] = array('name' => get_string($type.'plural',$type), 'link'=> '', 'type'=>'title');
            $navlinks[] = array('name' => get_string($type.'depthcustomfields',$type), 'link'=> '', 'type'=>'title');
        }

        $navigation = build_navigation($navlinks);
        
        if ($displayadminheader) {
            admin_externalpage_setup($type.'frameworkmanage', '', array('type'=>$type));
            admin_externalpage_print_header('', $navlinks);
        } else {
            print_header_simple($pagetitle, '', $navigation, '', null, true, null);
        }
        print_heading($strheading, 'left', 1);
        $categoryform->display();
        print_footer();
        die;
    }

}

function customfield_edit_field($id, $datatype, $depthid=0, $redirect, $tableprefix, $type, $subtype, $frameworkid=0, $categoryid=0, $navlinks=array()) {
    global $CFG;

    if (!$field = get_record($tableprefix.'_info_field', 'id', $id)) {
        $field = new object();
        $field->datatype = $datatype;
    }

    $displayadminheader = $frameworkid ? 1 : 0;

    require_once($CFG->dirroot.'/customfield/index_field_form.php');
    $datatosend = array('datatype' => $field->datatype, 'type' => $type, 'subtype' => $subtype, 
                        'frameworkid' => $frameworkid, 'depthid' => $depthid, 'categoryid' => $categoryid, 'tableprefix' => $tableprefix);
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
            customfield_reorder_categories($depthid, $tableprefix);
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
        $pagetitle = format_string(get_field($tableprefix, 'fullname', 'id', $depthid));
        if (!count($navlinks)) {
            $navlinks[] = array('name' => get_string('administration'), 'link'=> '', 'type'=>'title');
            $navlinks[] = array('name' => get_string($type.'plural',$type), 'link'=> '', 'type'=>'title');
            $navlinks[] = array('name' => get_string($type.'depthcustomfields',$type), 'link'=> '', 'type'=>'title');
        }

        $navigation = build_navigation($navlinks);
    
        if ($displayadminheader) {
            admin_externalpage_setup($type.'frameworkmanage', '', array('type'=>$type));
            admin_externalpage_print_header('', $navlinks);
        } else {
            print_header_simple($pagetitle, '', $navigation, '', null, true);
        }
        print_heading($strheading, 'left', '1');
        $fieldform->display();
        print_footer();
        die;
    }
}

/**
 * Reorder the custom field categories starting at the category
 * at the given startorder
 */
function customfield_reorder_categories($depthid=0, $tableprefix) {
    $i = 1;
    $depthstr = '';
    if ($depthid) {
        $depthstr = 'depthid = '.$depthid;
    }

    if ($categories = get_records_select($tableprefix.'_info_category', $depthstr, 'sortorder ASC')) {
        foreach ($categories as $cat) {
            $c = new object();
            $c->id = $cat->id;
            $c->sortorder = $i++;
            update_record($tableprefix.'_info_category', $c);
        }
    }
}

/**
 * Reorder the custom fields within a given category starting
 * at the field at the given startorder
 */
function customfield_reorder_fields($tableprefix) {
    if ($categories = get_records_select($tableprefix.'_info_category')) {
        foreach ($categories as $category) {
            $i = 1;
            if ($fields = get_records_select($tableprefix.'_info_field', 'categoryid='.$category->id, 'sortorder ASC')) {
                foreach ($fields as $field) {
                    $f = new object();
                    $f->id = $field->id;
                    $f->sortorder = $i++;
                    update_record($tableprefix.'_info_field', $f);
                }   
            }   
        }   
    }   
}

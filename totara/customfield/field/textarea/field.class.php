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

class customfield_textarea extends customfield_base {

    function edit_field_add(&$mform) {
        global $TEXTAREA_OPTIONS;
        $cols = $this->field->param1;
        $rows = $this->field->param2;
        /// Create the form field
        $mform->addElement('editor', $this->inputname, format_string($this->field->fullname), array('cols'=>$cols, 'rows'=>$rows), $TEXTAREA_OPTIONS);
        $mform->setType($this->inputname, PARAM_RAW);
    }

    /// Overwrite base class method, data in this field type is potentially too large to be
    /// included in the item object
    function is_item_object_data() {
        return false;
    }

    /**
    * Accessor method: Load the field record and prefix data and tableprefix associated with the prefix
    * object's fieldid and itemid
    */
    function load_data($itemid, $prefix, $tableprefix) {
        parent::load_data($itemid, $prefix, $tableprefix);
        if ($this->inputname != '' && substr($this->inputname, strlen($this->inputname)-6) != '_editor') {
            $this->inputname = $this->inputname . '_editor';
        }
    }
    /**
    * Saves the data coming from form
    * @param   mixed   data coming from the form
    * @param   string  name of the prefix (ie, competency)
    * @return  mixed   returns data id if success of db insert/update, false on fail, 0 if not permitted
    */
    function edit_save_data($itemnew, $prefix, $tableprefix) {
        global $DB, $TEXTAREA_OPTIONS;

        //get short form by removing trailing '_editor' from $this->inputname;
        $shortinputname = substr($this->inputname, 0, strlen($this->inputname)-7);
        if (!isset($itemnew->{$this->inputname})) {
            // field not present in form, probably locked and invisible - skip it
            return;
        }
        $shortprefix = substr($tableprefix, 0 , strlen($tableprefix)-5);
        $itemnew = file_postupdate_standard_editor($itemnew, $shortinputname, $TEXTAREA_OPTIONS, $TEXTAREA_OPTIONS['context'], 'totara_customfield', $shortprefix, $itemnew->id);
        $data = new stdClass();
        $data->{$prefix.'id'} = $itemnew->id;
        $data->fieldid      = $this->field->id;
        $data->data = $itemnew->{$shortinputname};
        if ($dataid = $DB->get_field($tableprefix.'_info_data', 'id', array($prefix.'id' => $itemnew->id, 'fieldid' => $data->fieldid))) {
            $data->id = $dataid;
            if (!$DB->update_record($tableprefix.'_info_data', $data)) {
                print_error('error:updatecustomfield', 'totara_customfield');
            }
        } else {
            $data->id = $DB->insert_record($tableprefix.'_info_data', $data);
        }
    }

    /**
    * Validate the form field from edit page
    * @return  string  contains error message otherwise NULL
    **/
    function edit_validate_field($itemnew, $prefix, $tableprefix) {
        global $DB;

        $errors = array();
        /// Check for uniqueness of data if required
        if ($this->is_unique()) {
            if ($prefix == 'course') {
                // anywhere across the site
                $data = $itemnew->{$this->inputname}['text'];
                // check value, not key for menu items
                if ($this->field->datatype == 'menu') {
                    $data = $this->options[$data];
                }
                if ($data != '' && $DB->record_exists_select($tableprefix.'_info_data',
                        "fieldid = ? AND " .
                        $DB->sql_compare_text('data', 255) . ' = ' . $DB->sql_compare_text('?', 255) . ' AND ' .
                        "courseid != ?", array($this->field->id, $data, $itemnew->id))) {

                    $errors["{$this->inputname}"] = get_string('valuealreadyused');
                }
            } else {
                // within same depth level
                //may not exist if we have just set a type on an item
                if (!isset($itemnew->{$this->inputname})) {
                    return $errors;
                }
                if ($itemid = $DB->get_field_select($tableprefix.'_info_data', $prefix.'id',
                        "fieldid = ? AND " . $DB->sql_compare_text('data', 255) . ' = ' . $DB->sql_compare_text('?', 255),
                        array($this->field->id, $itemnew->{$this->inputname}['text']))) {
                    if ($itemid != $itemnew->id) {
                        $errors["{$this->inputname}"] = get_string('valuealreadyused');
                    }
                }
            }
        }
        return $errors;
    }

    /**
    * Loads an object with data for this field ready for the edit form
     * form
    * @param   object a object
    */
    function edit_load_item_data(&$item) {
        //get short form by removing trailing '_editor' from $this->inputname;
        $shortinputname = substr($this->inputname, 0, strlen($this->inputname)-7);
        if ($this->data !== NULL) {
            $item->{$shortinputname} = $this->data;
        }
    }
    /**
    * Display the data for this field
     */
    static function display_item_data($data, $prefix=null, $itemid=null) {
        global $OUTPUT;
        if (empty($data)) {
            return $data;
        }
        $context = context_system::instance();
        $shortprefix = hierarchy::get_short_prefix($prefix);
        $data = file_rewrite_pluginfile_urls($data, 'pluginfile.php', $context->id, 'totara_customfield', $shortprefix, $itemid);
        return $data;
    }
}

?>

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

class customfield_file extends customfield_base {
    function edit_field_add(&$mform) {
        $size = $this->field->param1;
        $maxlength = $this->field->param2;
        $fieldtype = ($this->field->param3 == 1 ? 'password' : 'text');

        /// Create the file picker
        $mform->addElement('choosecoursefileorimsrepo', $this->inputname, format_string($this->field->fullname));
        $mform->setType($this->inputname, PARAM_RAW);  // We need to find a better PARAM
    }

    function edit_field_set_locked(&$mform) {
        if (!$mform->elementExists($this->inputname)) {
            return;
        }
        if ($this->is_locked()) {
            $mform->hardFreeze($this->inputname);
            $mform->disabledif($this->inputname, 1);
            $mform->setConstant($this->inputname, $this->data);
        }
    }

    /**
     * Display the data for this field
     */
    static function display_item_data($data) {
        global $OUTPUT;
        if (empty($data)) {
            return $data;
        }
        $strfile = get_string('file');
        $icon = mimeinfo("icon", $data);
        return $OUTPUT->action_icon(new moodle_url("/file.php/1/{$data}"), new pix_icon("f/{$icon}", $strfile), null, array('class' => "icon"));
    }
}
?>

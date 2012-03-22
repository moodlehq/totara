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

require_once($CFG->dirroot.'/lib/formslib.php');

class field_form extends moodleform {

    var $field;

/// Define the form
    function definition () {
        global $CFG;

        $mform =& $this->_form;
        $datasent = $this->_customdata;

        $prefix      = $datasent['prefix'];
        $typeid      = $datasent['typeid'];
        $tableprefix = $datasent['tableprefix'];

        require_once($CFG->dirroot.'/totara/customfield/field/'.$datasent['datatype'].'/define.class.php');
        $newfield = 'customfield_define_'.$datasent['datatype'];
        $this->field = new $newfield();

        $strrequired = get_string('customfieldrequired', 'totara_customfield');

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->addElement('hidden', 'action', 'editfield');
        $mform->addElement('hidden', 'datatype', $datasent['datatype']);
        $mform->addElement('hidden', 'prefix', $datasent['prefix']);
        $mform->addElement('hidden', 'typeid', $datasent['typeid']);
        $mform->addElement('hidden', 'tableprefix', $datasent['tableprefix']);

        $this->field->define_form($mform, $typeid, $tableprefix);

        $this->add_action_buttons(true);
    }


/// alter definition based on existing or submitted data
    function definition_after_data () {
        $mform =& $this->_form;
        $this->field->define_after_data($mform);
    }


/// perform some moodle validation
    function validation($data, $files) {
        return $this->field->define_validate($data, $files, $data['typeid'], $data['tableprefix']);
    }
}

?>

<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2012 Totara Learning Solutions LTD
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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder
 */

require_once($CFG->libdir.'/formslib.php');

class add_filter_form extends moodleform {

    function definition() {
        global $SESSION;
        $mform       =& $this->_form;
        $fields      = $this->_customdata['fields'];
        $extraparams = $this->_customdata['extraparams'];
        $shortname      = $this->_customdata['shortname'];
        $filtername = 'filtering_'.$shortname;

        if ($fields && is_array($fields) && count($fields) > 0) {
            $mform->addElement('header', 'newfilter', get_string('searchby', 'totara_reportbuilder'));

            foreach ($fields as $ft) {
                $ft->setupForm($mform);
            }

            // in case we want to track some page params
            if ($extraparams) {
                foreach ($extraparams as $key => $value) {
                    $mform->addElement('hidden', $key, $value);
                    $mform->setType($key, PARAM_RAW);
                }
            }

            $submitgroup = array();
            // Add button
            $submitgroup[] =& $mform->createElement('html', '&nbsp;', html_writer::empty_tag('br'));
            $submitgroup[] =& $mform->createElement('submit', 'addfilter', get_string('search', 'totara_reportbuilder'));
            // clear form button
            $submitgroup[] =& $mform->createElement('submit', 'clearfilter', get_string('clearform', 'totara_reportbuilder'));
            $mform->addGroup($submitgroup, 'submitgroup', '&nbsp;', ' &nbsp; ');

            // Don't use last advanced state
            $mform->setShowAdvanced(false);
        }
    }

    function definition_after_data() {
        $mform       =& $this->_form;
        $fields      = $this->_customdata['fields'];

        if ($fields && is_array($fields) && count($fields) > 0) {

            foreach ($fields as $ft) {
                if (method_exists($ft, 'definition_after_data')) {
                    $ft->definition_after_data($mform);
                }
            }
        }
    }
}

/*
 * This form is no longer used as the filter behaves more like
 * a search form now. Left in in-case someone decides they would
 * prefer a filter interface
 */
class active_filter_form extends moodleform {

    function definition() {
        global $SESSION; // this is very hacky :-(

        $mform       =& $this->_form;
        $fields      = $this->_customdata['fields'];
        $extraparams = $this->_customdata['extraparams'];
        $shortname      = $this->_customdata['shortname'];
        $filtername = 'filtering_'.$shortname;

        if (!empty($SESSION->{$filtername})) {
            // add controls for each active filter in the active filters group
            $mform->addElement('header', 'actfilterhdr', get_string('actfilterhdr', 'filters'));

            foreach ($SESSION->{$filtername} as $fname => $datas) {
                if (!array_key_exists($fname, $fields)) {
                    continue; // filter not used
                }
                $field = $fields[$fname];
                foreach ($datas as $i => $data) {
                    $description = $field->get_label($data);
                    $mform->addElement('checkbox', 'filter['.$fname.']['.$i.']', null, $description);
                }
            }

            $mform->addElement('hidden', 'shortname', $shortname);
            $mform->setType('shortname', PARAM_TEXT);

            if ($extraparams) {
                foreach ($extraparams as $key => $value) {
                    $mform->addElement('hidden', $key, $value);
                    $mform->setType($key, PARAM_RAW);
                }
            }

            $objs = array();
            $objs[] = &$mform->createElement('submit', 'removeselected', get_string('removeselected', 'filters'));
            $objs[] = &$mform->createElement('submit', 'removeall', get_string('removeall', 'filters'));
            $mform->addElement('group', 'actfiltergrp', '', $objs, ' ', false);
        }
    }
}

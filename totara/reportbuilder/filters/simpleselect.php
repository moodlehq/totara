<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2012 Totara Learning Solutions LTD
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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder
 */

require_once($CFG->dirroot . '/totara/reportbuilder/filters/lib.php');

/**
 * Generic filter based on a list of values.
 */
class filter_simpleselect extends filter_type {
    /**
     * options for the list values
     */
    var $_options;

    /**
     * Constructor
     * @param string $name the name of the filter instance
     * @param string $label the label of the filter instance
     * @param boolean $advanced advanced form element flag
     * @param string $field user table filed name
     * @param array $options select options
     */
    function filter_simpleselect($filter, $sessionname, $selectoptions, $attributes=null) {
        parent::filter_type($filter, $sessionname);
        $this->_options = $selectoptions;
        $this->_attributes = $attributes;
    }


    /**
     * Adds controls specific to this filter in the form.
     * @param object $mform a MoodleForm object to setup
     */
    function setupForm(&$mform) {
        global $SESSION;
        $sessionname = $this->_sessionname;
        $label = $this->_filter->label;
        $advanced = $this->_filter->advanced;
        $options = $this->_options;
        $attr = $this->_attributes;

        $choices = array('' => get_string('anyvalue', 'filters')) + $options;
        $mform->addElement('select', $this->_name, $label, $choices, $attr);
        $mform->addHelpButton($this->_name, 'filtersimpleselect', 'filters');
        if ($advanced) {
            $mform->setAdvanced($this->_name);
        }

        // set default values
        if (array_key_exists($this->_name, $SESSION->{$sessionname})) {
            $defaults = $SESSION->{$sessionname}[$this->_name];
        }
        //TODO get rid of need for [0]
        if (isset($defaults[0]['value'])) {
            $mform->setDefault($this->_name, $defaults[0]['value']);
        }

    }

    /**
     * Retrieves data from the form data
     * @param object $formdata data submited with the form
     * @return mixed array filter data or false when filter not set
     */
    function check_data($formdata) {
        $field    = $this->_name;

        if (array_key_exists($field, $formdata) && $formdata->$field !== '') {
            return array('value'    => (string)$formdata->$field);
        }

        return false;
    }

    /**
     * Returns the condition to be used with SQL where
     * @param array $data filter settings
     * @return array containing filtering condition SQL clause and params
     */
    function get_sql_filter($data) {
        $value    = $data['value'];
        $query    = $this->_filter->get_field();

        if ($value == '') {
            // return 1=1 instead of TRUE for MSSQL support
            return array(' 1=1 ', array());
        }

        $uniqueparam = rb_unique_param('fss');
        $sql = "$query = :{$uniqueparam}";
        $params = array($uniqueparam => $value);

        return array($sql, $params);
    }

    /**
     * Returns a human friendly description of the filter used as label.
     * @param array $data filter settings
     * @return string active filter label
     */
    function get_label($data) {
        $value     = $data['value'];
        $label = $this->_filter->label;

        if ($value == '') {
            return '';
        }

        $a = new stdClass();
        $a->label    = $label;
        $a->value    = '"' . s($this->_options[$value]) . '"';
        $a->operator = get_string('isequalto', 'filters');

        return get_string('selectlabel', 'filters', $a);
    }
}


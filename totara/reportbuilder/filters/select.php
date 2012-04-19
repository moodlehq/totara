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
class filter_select extends filter_type {
    /**
     * options for the list values
     */
    var $_options;
    var $_default;

    /**
     * Constructor
     * @param string $name the name of the filter instance
     * @param string $label the label of the filter instance
     * @param boolean $advanced advanced form element flag
     * @param string $field user table filed name
     * @param array $options select options
     * @param mixed $default option
     */
    function filter_select($filter, $sessionname, $selectoptions, $default=null, $attributes=null) {
        parent::filter_type($filter, $sessionname);
        $this->_options = $selectoptions;
        $this->_default = $default;
        $this->_attributes = $attributes;
    }

    /**
     * Returns an array of comparison operators
     * @return array of comparison operators
     */
    function get_operators() {
        return array(0 => get_string('isanyvalue', 'filters'),
                     1 => get_string('isequalto', 'filters'),
                     2 => get_string('isnotequalto', 'filters'));
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

        $objs = array();
        $objs[] =& $mform->createElement('select', $this->_name . '_op', null, $this->get_operators());
        $objs[] =& $mform->createElement('select', $this->_name, null, $this->_options, $this->_attributes);
        $grp =& $mform->addElement('group', $this->_name . '_grp', $label, $objs, '', false);
        $mform->addHelpButton($grp->_name, 'filterselect', 'filters');
        $mform->disabledIf($this->_name, $this->_name . '_op', 'eq', 0);
        if (!is_null($this->_default)) {
            $mform->setDefault($this->_name, $this->_default);
        }
        if ($advanced) {
            $mform->setAdvanced($this->_name . '_grp');
        }

        // set default values
        if (array_key_exists($this->_name, $SESSION->{$sessionname})) {
            $defaults = $SESSION->{$sessionname}[$this->_name];
        }
        //TODO get rid of need for [0]
        if (isset($defaults[0]['operator'])) {
            $mform->setDefault($this->_name . '_op', $defaults[0]['operator']);
        }
        if (isset($defaults[0]['value'])) {
            $mform->setDefault($this->_name, $defaults[0]['value']);
        }
                // check for null case if

    }

    /**
     * Retrieves data from the form data
     * @param object $formdata data submited with the form
     * @return mixed array filter data or false when filter not set
     */
    function check_data($formdata) {
        $field    = $this->_name;
        $operator = $field . '_op';

        if (array_key_exists($field, $formdata) ) {
            return array('operator' => (int)$formdata->$operator,
                         'value'    => (string)$formdata->$field);
        }

        return false;
    }

    /**
     * Returns the condition to be used with SQL where
     * @param array $data filter settings
     * @return array containing filtering condition SQL clause and params
     */
    function get_sql_filter($data) {
        $operator = $data['operator'];
        $value    = $data['value'];
        $query    = $this->_filter->get_field();

        switch($operator) {
            case 1:
                $token = ' = ';
                $glue = ' OR ';
                break;
            case 2:
                $token = ' <> ';
                $glue = ' AND ';
                break;
            default:
                // return 1=1 instead of TRUE for MSSQL support
                return array(' 1=1 ', array());
        }

        // split by comma and look for any items
        // within list
        $items = explode(',', $value);
        $res = array();
        $params = array();
        $count = 1;
        foreach ($items as $item) {
            if ($operator == 2) {
                $uniqueparam = rb_unique_param("fsnotequal_{$count}_");
                // check for null case for is not operator
                $res[] = '(' . $query . $token . ":{$uniqueparam} OR " . $query . ' IS NULL)';
            } else {
                // equal
                $uniqueparam = rb_unique_param("fsequal_{$count}_");
                $res[] = $query . $token . ":{$uniqueparam}";
            }
            $params[$uniqueparam] = $item;
            $count++;
        }
        return array('(' . implode($glue, $res) . ')', $params);
    }

    /**
     * Returns a human friendly description of the filter used as label.
     * @param array $data filter settings
     * @return string active filter label
     */
    function get_label($data) {
        $operators = $this->get_operators();
        $operator  = $data['operator'];
        $value     = $data['value'];
        $label = $this->_filter->label;

        if (empty($operator)) {
            return '';
        }

        $a = new stdClass();
        $a->label    = $label;
        $a->value    = '"' . s($this->_options[$value]) . '"';
        $a->operator = $operators[$operator];

        return get_string('selectlabel', 'filters', $a);
    }
}


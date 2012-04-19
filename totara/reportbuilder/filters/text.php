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
 * Generic filter for text fields.
 */
class filter_text extends filter_type {

    /**
     * Constructor
     * @param object $filter rb_filter object for this filter
     * @param string $sessionname Unique name for the report for storing sessions
     */
    function filter_text($filter, $sessionname) {
        parent::filter_type($filter, $sessionname);
    }

    /**
     * Returns an array of comparison operators
     * @return array of comparison operators
     */
    function getOperators() {
        return array(0 => get_string('contains', 'filters'),
                     1 => get_string('doesnotcontain', 'filters'),
                     2 => get_string('isequalto', 'filters'),
                     3 => get_string('startswith', 'filters'),
                     4 => get_string('endswith', 'filters'),
                     5 => get_string('isempty', 'filters'));
    }

    /**
     * Adds controls specific to this filter in the form.
     * @param object $mform a MoodleForm object to setup
     */
    function setupForm(&$mform) {
        global $SESSION;
        $sessionname=$this->_sessionname;
        $label = $this->_filter->label;
        $advanced = $this->_filter->advanced;

        $objs = array();
        $objs[] =& $mform->createElement('select', $this->_name . '_op', null, $this->getOperators());
        $objs[] =& $mform->createElement('text', $this->_name, null);
        $mform->setType($this->_name, PARAM_TEXT);
        $grp =& $mform->addElement('group', $this->_name . '_grp', $label, $objs, '', false);
        $mform->addHelpButton($grp->_name, 'filtertext', 'filters');
        $mform->disabledIf($this->_name, $this->_name . '_op', 'eq', 5);
        if ($advanced) {
            $mform->setAdvanced($this->_name . '_grp');
        }

        // set default values
        if (array_key_exists($this->_name, $SESSION->{$sessionname})) {
            $defaults = $SESSION->{$sessionname}[$this->_name];
        }
        // TODO get rid of need for [0]
        if (isset($defaults[0]['operator'])) {
            $mform->setDefault($this->_name . '_op', $defaults[0]['operator']);
        }
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
        $operator = $field . '_op';
        $value = (isset($formdata->$field)) ? $formdata->$field : '';
        if (array_key_exists($operator, $formdata)) {
            if ($formdata->$operator != 5 and $value == '') {
                // no data - no change except for empty filter
                return false;
            }
            return array('operator' => (int)$formdata->$operator, 'value' => $value);
        }

        return false;
    }

    /**
     * Returns the condition to be used with SQL where
     * @param array $data filter settings
     * @return array containing filtering condition SQL clause and params
     */
    function get_sql_filter($data) {
        global $CFG, $DB;
        require_once($CFG->dirroot . '/totara/core/searchlib.php');

        $operator = $data['operator'];
        $value    = $data['value'];
        $query    = $this->_filter->get_field();

        if ($operator != 5 and $value === '') {
            return '';
        }

        switch($operator) {
            case 0: // contains
                $keywords = totara_search_parse_keywords($value);
                return search_get_keyword_where_clause($query, $keywords);
            case 1: // does not contain
                $keywords = totara_search_parse_keywords($value);
                return search_get_keyword_where_clause($query, $keywords, true);
            case 2: // equal to
                return search_get_keyword_where_clause($query, array($value), false, 'equal');
            case 3: // starts with
                return search_get_keyword_where_clause($query, array($value), false, 'startswith');
            case 4: // ends with
                return search_get_keyword_where_clause($query, array($value), false, 'endswith');
            case 5: // empty - may also be null
                return array("({$query} = '' OR ({$query}) IS NULL)", array());
            default:
                return array('', array());
        }
    }

    /**
     * Returns a human friendly description of the filter used as label.
     * @param array $data filter settings
     * @return string active filter label
     */
    function get_label($data) {
        $operator  = $data['operator'];
        $value     = $data['value'];
        $operators = $this->getOperators();
        $label     = $this->_filter->label;

        $a = new stdClass();
        $a->label    = $label;
        $a->value    = '"' . s($value) . '"';
        $a->operator = $operators[$operator];


        switch ($operator) {
            case 0: // contains
            case 1: // doesn't contain
            case 2: // equal to
            case 3: // starts with
            case 4: // ends with
                return get_string('textlabel', 'filters', $a);
            case 5: // empty
                return get_string('textlabelnovalue', 'filters', $a);
        }

        return '';
    }
}

<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2013 Totara Learning Solutions LTD
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

/**
 * Generic filter based on a multiple checkboxes
 */
class rb_filter_multicheck extends rb_filter_type {

    /**
     * Constructor
     *
     * @param string $type The filter type (from the db or embedded source)
     * @param string $value The filter value (from the db or embedded source)
     * @param integer $advanced If the filter should be shown by default (0) or only
     *                          when advanced options are shown (1)
     * @param reportbuilder object $report The report this filter is for
     *
     * @return rb_filter_multicheck object
     */
    function __construct($type, $value, $advanced, $report) {
        parent::__construct($type, $value, $advanced, $report);

        if (!isset($this->options['selectfunc'])) {
            if (!isset($this->options['selectchoices'])) {
                debugging("No selectchoices provided for filter '{$this->name}' in source '" . get_class($report->src) . "'");
                $this->options['selectchoices'] = array();
            }
        }
        if (!isset($this->options['attributes'])) {
            $this->options['attributes'] = array();
        }

        if (!isset($this->options['concat'])) {
            $this->options['concat'] = false;
        }
    }

    /**
     * Returns an array of comparison operators
     * @return array of comparison operators
     */
    function get_operators() {
        return array(0 => get_string('isanyvalue', 'filters'),
                     1 => get_string('matchesanyselected', 'filters'),
                     2 => get_string('matchesallselected', 'filters'));
    }

    /**
     * Adds controls specific to this filter in the form.
     * @param object $mform a MoodleForm object to setup
     */
    function setupForm(&$mform) {
        global $OUTPUT, $SESSION;
        $label = $this->label;
        $advanced = $this->advanced;
        $options = $this->options['selectchoices'];
        $attr = $this->options['attributes'];

        // don't display the filter if there are no options
        if (count($options) == 0) {
            $mform->addElement('static', $this->name, $label, get_string('nofilteroptions', 'totara_reportbuilder'));
            if ($advanced) {
                $mform->setAdvanced($this->name);
            }
            return;
        }

        $mform->addElement('select', $this->name . '_op', $label, $this->get_operators());
        $mform->setType($this->name . '_op', PARAM_INT);
        $mform->addHelpButton($this->name . '_op', 'filtercheckbox', 'filters');

        // this class is used by the CSS to arrange the checkboxes nicely
        $mform->addElement('html', $OUTPUT->container_start('multicheck-items'));
        $objs = array();
        foreach ($options as $id => $name) {
            $objs[] =& $mform->createElement('advcheckbox', $this->name . '[' . $id . ']', null, $name, array_merge(array('group' => 1), $attr));
            $mform->setType($this->name . '[' . $id . ']', PARAM_TEXT);
            $mform->disabledIf($this->name . '[' . $id . ']', $this->name . '_op', 'eq', 0);
        }
        $mform->addGroup($objs, $this->name . '_grp', '&nbsp;', '', false);
        $mform->addElement('html', $OUTPUT->container_end());

        if ($advanced) {
            $mform->setAdvanced($this->name . '_op');
            $mform->setAdvanced($this->name . '_grp');
        }

        // set default values
        if (isset($SESSION->reportbuilder[$this->report->_id][$this->name])) {
            $defaults = $SESSION->reportbuilder[$this->report->_id][$this->name];
        }
        if (isset($defaults['operator'])) {
            $mform->setDefault($this->name . '_op', $defaults['operator']);
        }
        // contains an array which will set multiple checkboxes
        if (isset($defaults['value'])) {
            $mform->setDefault($this->name, $defaults['value']);
        }

    }

    /**
     * Retrieves data from the form data
     * @param object $formdata data submited with the form
     * @return mixed array filter data or false when filter not set
     */
    function check_data($formdata) {
        $field    = $this->name;
        $operator = $field . '_op';

        if (isset($formdata->$operator) && $formdata->$operator != 0) {
            return array('operator' => (int)$formdata->$operator,
                         'value'    => (array)$formdata->$field);
        }

        return false;
    }

    /**
     * Returns the condition to be used with SQL where
     *
     * @param array $data filter settings
     * @return array containing filtering condition SQL clause and params
     */
    function get_sql_filter($data) {
        global $DB;

        $operator = $data['operator'];
        $items    = $data['value'];
        $query    = $this->field;

        switch($operator) {
            case 1:
                $glue = ' OR ';
                break;
            case 2:
                $glue = ' AND ';
                break;
            default:
                // return 1=1 instead of TRUE for MSSQL support
                return array(' 1=1 ', array());
        }

        // split by comma and look for any items
        // within list
        $res = array();
        $params = array();
        if (is_array($items)) {
            $count = 1;
            foreach ($items as $id => $selected) {
                if ($selected) {
                    $uniqueparam = rb_unique_param("fmcequal_{$count}_");
                    $filter = "( {$query} = :{$uniqueparam}";
                    $params[$uniqueparam] = $id;
                    if ($this->options['concat']) {
                        $uniqueparam = rb_unique_param("fmcendswith_{$count}_");
                        $filter .=  " OR \n " . $DB->sql_like($query, ":{$uniqueparam}");
                        $params[$uniqueparam] = '%|' . $DB->sql_like_escape($id);

                        $uniqueparam = rb_unique_param("fmcstartswith_{$count}_");
                        $filter .= " OR \n " . $DB->sql_like($query, ":{$uniqueparam}");
                        $params[$uniqueparam] = $DB->sql_like_escape($id) . '|%';

                        $uniqueparam = rb_unique_param("fmccontains{$count}_");
                        $filter .= " OR \n " . $DB->sql_like($query, ":{$uniqueparam}");
                        $params[$uniqueparam] = '%|' . $DB->sql_like_escape($id) . '|%';
                    }

                    $filter .= " )\n";

                    $res[] = $filter;

                    $count++;
                }
            }
        }
        // none selected
        if (count($res) == 0) {
            // using 1=0 instead of FALSE for MSSQL support
            return array(' 1=0 ', array());
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
        $label = $this->label;
        $selectchoices = $this->options['selectchoices'];

        if (empty($operator)) {
            return '';
        }

        $a = new stdClass();
        $a->label    = $label;
        $checked = array();
        foreach ($value as $key => $selected) {
            if ($selected) {
                $name = array_key_exists($key, $selectchoices) ?
                $selectchoices[$key] : $key;
                $formatname = trim(html_entity_decode(strip_tags($name)), chr(0xC2).chr(0xA0)); // chr(0xC2).chr(0xA0) = &nbsp;
                $checked[] = '"' . $formatname . '"';
            }
        }
        $a->value    = implode(', ', $checked);
        $a->operator = $operators[$operator];

        return get_string('selectlabel', 'filters', $a);
    }
}


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
 * @package totara
 * @subpackage reportbuilder
 */

/**
 * Special filter for checking course enrolment
 *
 * This filter is unusual in that it requires *two* fields (userid and course)
 * instead of just a single field.
 *
 * To handle this the field property is passed as an array:
 *
 * field = array('course' => 'base.course', 'user' => 'base.userid')
 *
 * instead of just a string:
 *
 * field = 'base.course'
 *
 * The reason the filter has been handled as a sub-query in the WHERE
 * clause instead of a join is that mysql fails to apply indexes when
 * using a subquery in the join, so the query is very slow for large
 * sites unless structured this way
 */
class rb_filter_enrol extends rb_filter_type {

    /**
     * Constructor
     *
     * @param string $type The filter type (from the db or embedded source)
     * @param string $value The filter value (from the db or embedded source)
     * @param integer $advanced If the filter should be shown by default (0) or only
     *                          when advanced options are shown (1)
     * @param reportbuilder object $report The report this filter is for
     *
     * @return rb_filter_text object
     */
    function __construct($type, $value, $advanced, $report) {
        parent::__construct($type, $value, $advanced, $report);
    }

    /**
     * Adds controls specific to this filter in the form.
     * @param object $mform a MoodleForm object to setup
     */
    function setupForm(&$mform) {
        global $SESSION;
        $label = $this->label;
        $advanced = $this->advanced;

        $options = array(
            1 => get_string('yes'),
            0 => get_string('no'),
        );
        $choices = array('' => get_string('anyvalue', 'filters')) + $options;
        $mform->addElement('select', $this->name, $label, $choices);
        $mform->addHelpButton($this->name, 'filterenrol', 'filters');
        if ($advanced) {
            $mform->setAdvanced($this->name);
        }

        // set default values
        if (isset($SESSION->reportbuilder[$this->report->_id][$this->name])) {
            $defaults = $SESSION->reportbuilder[$this->report->_id][$this->name];
        }
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
        $field = $this->name;

        if (isset($formdata->$field) && $formdata->$field !== '') {
            return array('value' => (string)$formdata->$field);
        }

        return false;
    }

    /**
     * Returns the condition to be used with SQL where
     * @param array $data filter settings
     * @return array containing filtering condition SQL clause and params
     */
    function get_sql_filter($data) {
        global $CFG;
        require_once($CFG->dirroot . '/totara/core/searchlib.php');

        $value = $data['value'];

        // throw an error if a source doesn't define the field correctly
        if (!isset($this->field['course']) || !isset($this->field['user'])) {
            throw new ReportBuilderException('Invalid field passed to enrol filter, field must be an array with course and user elements.');
        }
        // split out composite field into parts
        $coursefield = $this->field['course'];
        $userfield = $this->field['user'];

        if ($value == '') {
            // return 1=1 instead of TRUE for MSSQL support
            return array(' 1=1 ', array());
        }

        $not = $value ? '' : ' NOT';
        $where = " {$not} EXISTS (SELECT 1 FROM {user_enrolments} ue
            LEFT JOIN {enrol} e ON (e.id = ue.enrolid AND e.status = 0)
            WHERE ue.userid = {$userfield} AND e.courseid = {$coursefield}) ";

        return array($where, array());
    }

    /**
     * Returns a human friendly description of the filter used as label.
     * @param array $data filter settings
     * @return string active filter label
     */
    function get_label($data) {
        $value = $data['value'];
        $label = $this->label;

        $a = new stdClass();
        $a->label = $label;
        $a->value = '"' . s($value) . '"';

        if ($value == 1) {
            return get_string('isenrolled', 'filters');
        } else if ($value == 0) {
            return get_string('isnotenrolled', 'filters');
        }

        return '';
    }
}

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
require_once($CFG->dirroot . '/totara/reportbuilder/filters/filter_forms.php');

/**
 * The base filter class. All abstract classes must be implemented.
 */
class rb_filter_type {
    public $type;
    public $value;
    public $advanced;
    public $filtertype;
    protected $label;
    protected $field;
    protected $joins;
    protected $options;
    protected $report;
    public $grouping;
    public $name;

    /**
     * Constructor
     *
     * @param string $type The filter type (from the db or embedded source)
     * @param string $value The filter value (from the db or embedded source)
     * @param integer $advanced If the filter should be shown by default (0) or only
     *                          when advanced options are shown (1)
     * @param reportbuilder object $report The report this filter is for
     *
     * @return filter_* object
     */
    function __construct($type, $value, $advanced, $report) {
        $this->type = $type;
        $this->value = $value;
        $this->advanced = $advanced;
        $this->report = $report;
        $this->name = "{$type}-{$value}";

        // get this filter's settings based on the option from the report's source
        $filteroption = reportbuilder::get_single_item($report->src->filteroptions, $type, $value);
        $columnoption = reportbuilder::get_single_item($report->src->columnoptions, $type, $value);

        $this->label = $filteroption->label;
        $this->filtertype = $filteroption->filtertype;
        $this->grouping = isset($columnoption->grouping) ? $columnoption->grouping : 'none';
        $this->field = $this->get_field($columnoption->field);
        $this->joins = isset($columnoption->joins) ? $columnoption->joins : array();
        $this->options = isset($filteroption->filteroptions) ? $filteroption->filteroptions : array();

        // if the filter defines a selectfunc option, call the function
        // and save the return value to selectchoices
        if (isset($this->options['selectfunc'])) {
            $this->options['selectchoices'] = $this->get_select_choices($this->options['selectfunc']);
        }

    }

    /**
     * Call the named function from the report source and return the choices returned
     *
     * @param string $selectfunc Name of the function to call
     * @return array Array representing a set of choices for the filter
     */
    private function get_select_choices($selectfunc) {
            $selectfunc = 'rb_filter_' . $selectfunc;
            if (method_exists($this->report->src, $selectfunc)) {
                $selectchoices = $this->report->src->$selectfunc($this->report);
            } else {
                debugging("Filter function '{$selectfunc}' not found for filter '{$name}}' in source '" . get_class($report->src) . "'");
                $selectchoices = array();
            }
            return $selectchoices;
    }

    /**
     * Return an SQL snippet describing field information for this filter
     *
     * Includes any aggregation/grouping function that the filter is using
     *
     * @return string SQL snippet to use in WHERE or HAVING clause
     */
    private function get_field($field) {
        $grouping = $this->grouping;
        $src = $this->report->src;
        $type = $this->type;
        $value = $this->value;
        if ($grouping == 'none') {
            return $field;
        } else {
            $groupfunc = "rb_group_{$grouping}";
            if (!method_exists($src, $groupfunc)) {
                throw new ReportBuilderException(get_string('groupingfuncnotinfieldoftypeandvalue',
                    'totara_reportbuilder',
                    (object)array('groupfunc' => $groupfunc, 'type' => $type, 'value' => $value)));
            }
            return $src->$groupfunc($field);
        }
    }

    /**
     * Factory method for creating a filter object
     *
     * @param string $type The filter type (from the db or embedded source)
     * @param string $value The filter value (from the db or embedded source)
     * @param integer $advanced If the filter should be shown by default (0) or only
     *                          when advanced options are shown (1)
     * @param reportbuilder object $report The report this filter is for
     *
     * @return @object A filter_[type] object or false
     */
    static function get_filter($type, $value, $advanced, $report) {
        global $CFG;

        // do some basic checks to ensure its a valid filter
        if (!self::validate_filter($type, $value, $report)) {
            return false;
        }

        // figure out what sort of filter it is
        if (!$filtertype = self::get_filter_type($type, $value, $report)) {
            return false;
        }

        $filename = "{$CFG->dirroot}/totara/reportbuilder/filters/{$filtertype}.php";
        if (!is_readable($filename)) {
            return false;
        }
        require_once($filename);
        $classname = "rb_filter_{$filtertype}";
        if (!class_exists($classname)) {
            return false;
        }

        return new $classname($type, $value, $advanced, $report);
    }

    /**
     * Check a filter to ensure it is supported by this report's source
     *
     * @param string $type The type of filter
     * @param string $value The filter value
     * @return bool True if the filter is supported, false (and prints debugging messages) otherwise
     */
    static function validate_filter($type, $value, $report) {
        $filteroptions = $report->src->filteroptions;
        $columnoptions = $report->src->columnoptions;
        $joinlist = $report->src->joinlist;
        $sourcename = get_class($report->src);

        if (!reportbuilder::get_single_item($filteroptions, $type, $value)) {

            $a = new stdClass();
            $a->type = $type;
            $a->value = $value;
            $a->source = $sourcename;
            debugging(get_string('error:filteroptiontypexandvalueynotfoundinz', 'totara_reportbuilder', $a));
            return false;
        }
        if (!$columnoption = reportbuilder::get_single_item($columnoptions, $type, $value)) {

            $a = new stdClass();
            $a->type = $type;
            $a->value = $value;
            $a->source = $sourcename;
            debugging(get_string('error:columnoptiontypexandvalueynotfoundinz', 'totara_reportbuilder', $a));
            return false;
        }

        // make sure joins are defined before adding column
        if (!reportbuilder::check_joins($joinlist, $columnoption->joins)) {
            $a = new stdClass();
            $a->type = $columnoption->type;
            $a->value = $columnoption->value;
            $a->source = $sourcename;
            debugging(get_string('error:joinsforfiltertypexandvalueynotfoundinz', 'totara_reportbuilder', $a));
            return false;

        }

        return true;
    }


    /**
     * Get a filter's filtertype by looking up from the filteroption in the report's source
     *
     * @param string $type The type of filter
     * @param string $value The filter value
     * @param object $report The report object
     *
     * @return string|false The filtertype of the filter from this report's source, if found
     */
    static function get_filter_type($type, $value, $report) {
        $filteroptions = $report->src->filteroptions;
        if (!$filteroption = reportbuilder::get_single_item($filteroptions, $type, $value)) {
            return false;
        }

        if (!isset($filteroption->filtertype)) {
            return false;
        }

        return $filteroption->filtertype;
    }

    /**
     * Returns the condition to be used with SQL where
     * @param array $data filter settings
     * @return array containing the filtering condition SQL clause and params
     */
    function get_sql_filter($data) {
        print_error('abstractmethodcalled', 'totara_reportbuilder', '', 'get_sql_filter()');
    }

    /**
     * Retrieves data from the form data
     * @param object $formdata data submited with the form
     * @return mixed array filter data or false when filter not set
     */
    function check_data($formdata) {
        print_error('abstractmethodcalled', 'totara_reportbuilder', '', 'check_data()');
    }

    /**
     * Adds controls specific to this filter in the form.
     * @param object $mform a MoodleForm object to setup
     */
    function setupForm(&$mform) {
        print_error('abstractmethodcalled', 'totara_reportbuilder', '', 'setupForm()');
    }

    /**
     * Returns a human friendly description of the filter used as label.
     * @param array $data filter settings
     * @return string active filter label
     */
    function get_label($data) {
        print_error('abstractmethodcalled', 'totara_reportbuilder', '', 'get_label()');
    }
}


/**
 * Return an SQL snippet to search for the given keywords
 *
 * @param string $field the field to search in
 * @param array $keywords Array of strings to search for
 * @param boolean $negate negate the conditions
 * @param string $operator can be 'contains', 'equal', 'startswith', 'endswith'
 *
 * @return array containing SQL clause and params
 */
function search_get_keyword_where_clause($field, $keywords, $negate=false, $operator='contains') {
    global $DB;

    if ($negate) {
        $not = true;
        $token = ' OR ';
    } else {
        $not = false;
        $token = ' AND ';
    }

    $presign = '';
    $postsign = '';
    switch ($operator) {
        case 'contains':
            $presign = $postsign = '%';
            break;
        case 'startswith':
            $presign = '';
            $postsign = '%';
            break;
        case 'endswith':
            $presign = '%';
            $postsign = '';
            break;
        default:
            break;
    }

    $queries = array();
    $params = array();
    $count = 1;
    foreach ($keywords as $keyword) {
        $uniqueparam = rb_unique_param("skww{$operator}_{$count}_");
        $queries[] = $DB->sql_like($field, ":{$uniqueparam}", false, true, $not);
        $params[$uniqueparam] = $presign.$DB->sql_like_escape($keyword).$postsign;

        $count++;
    }

    $sql = '(' . implode($token, $queries) . ')';

    return array($sql, $params);
}


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
require_once($CFG->dirroot . '/totara/reportbuilder/filters/text.php');
require_once($CFG->dirroot . '/totara/reportbuilder/filters/textarea.php');
require_once($CFG->dirroot . '/totara/reportbuilder/filters/number.php');
require_once($CFG->dirroot . '/totara/reportbuilder/filters/simpleselect.php');
require_once($CFG->dirroot . '/totara/reportbuilder/filters/select.php');
require_once($CFG->dirroot . '/totara/reportbuilder/filters/date.php');
require_once($CFG->dirroot . '/totara/reportbuilder/filters/datetime.php');
require_once($CFG->dirroot . '/totara/reportbuilder/filters/hierarchy.php');
require_once($CFG->dirroot . '/totara/reportbuilder/filters/hierarchy_multi.php');
require_once($CFG->dirroot . '/totara/reportbuilder/filters/multicheck.php');
require_once($CFG->dirroot . '/totara/reportbuilder/filters/filter_forms.php');

/**
 * Filtering wrapper class.
 */
class filtering {
    var $_fields;
    var $_addform;
    var $_activeform;
    var $_filter;
    var $_shortname;
    var $_sessionname;

    /**
     * Contructor
     * @param array array of visible fields
     * @param string base url used for submission/return, null if the same of current page
     * @param array extra page parameters
     */
    function filtering($report=null, $baseurl=null, $extraparams=null) {
        global $SESSION;

        if ($report == null) {
            print_error('reportmustbedefined', 'totara_reportbuilder');
        }

        $this->_report = $report;

        $shortname = $report->shortname;

        if ($shortname == null) {
            print_error('reportshortnamemustbedefined', 'totara_reportbuilder');
        }

        // initialise session var based on unique shortname
        $filtername = "filtering_$shortname";
        $this->_sessionname = $filtername;
        if (!isset($SESSION->{$filtername})) {
            $SESSION->{$filtername} = array();
        }

        // generate arrays of field names and queries based on input array
        $this->_fields  = array();
        if ($report->filters) {
            foreach ($report->filters as $filter) {
                $type = $filter->type;
                $value = $filter->value;
                $fieldname = "{$type}-{$value}";
                if ($field = $this->get_field($filter)) {
                    $this->_fields[$fieldname] = $field;
                }
            }
        }

        // the new filter form
        $this->_addform = new add_filter_form($baseurl, array('fields' => $this->_fields, 'extraparams' => $extraparams, 'shortname' => $shortname));

        if ($adddata = $this->_addform->get_data(false)) {

            if (isset($adddata->submitgroup['clearfilter'])) {
                    $SESSION->{$filtername} = array();
                    $_POST = array();
                    $this->_addform = new add_filter_form($baseurl, array('fields' => $this->_fields, 'extraparams' => $extraparams, 'shortname' => $shortname));

            } else {

                foreach ($this->_fields as $fname => $field) {
                    $data = $field->check_data($adddata);
                    if ($data === false) {
                        // unset existing result if field has been set back to "not set" position
                        if (array_key_exists($fname, $SESSION->{$filtername})) {
                            unset($SESSION->{$filtername}[$fname]);
                        }
                        continue;
                    }
                    if (!array_key_exists($fname, $SESSION->{$filtername})) {
                        $SESSION->{$filtername}[$fname] = array();
                    }
                    // TODO stop using array index 0 (no longer needed as only one filter per field)
                    $SESSION->{$filtername}[$fname][0] = $data;
                }
            }
        }
    }

    /**
     * Creates known filter if present
     * @param object $filter rb_filter object from report builder
     * @return object filter
     */
    function get_field($filter) {
        global $USER, $CFG, $SITE;

        $type = $filter->type;
        $value = $filter->value;
        $sessionname = $this->_sessionname;

        if (isset($filter->filtertype)) {
            $filtertype = $filter->filtertype;
            $filtername = "filter_{$filtertype}";

            switch($filtertype) {
            case 'text':
            case 'textarea':
            case 'number':
            case 'date':
            case 'datetime':
                return new $filtername($filter, $sessionname);
            case 'org':
            case 'comp':
            case 'pos':
                return new filter_hierarchy($filter, $sessionname, $filtertype);
            case 'orgmulti':
            case 'compmulti':
            case 'posmulti':
                return new filter_hierarchy_multi($filter, $sessionname, $filtertype);
            case 'simpleselect':
                $choices = $filter->selectchoices;
                $options = isset($filter->selectoptions) ?
                    $filter->selectoptions : null;
                return new $filtername($filter, $sessionname, $choices, $options);
            case 'select':
            case 'multicheck':
                $selectfunc = 'rb_filter_'.$filter->selectfunc;
                $options = $filter->selectoptions;
                if (method_exists($this->_report->src, $selectfunc)) {
                    $selectfield = $this->_report->src->$selectfunc(
                        $this->_report->contentmode,
                        $this->_report->contentoptions,
                        $this->_report->_id
                    );
                } else {
                    trigger_error("Filter function '{$selectfunc}' not found", E_USER_WARNING);
                    $selectfield = array();
                }
                return new $filtername($filter, $sessionname, $selectfield, null, $options);
            default:
                trigger_error("No filter found for filter type '$filtertype'.", E_USER_WARNING);
                return null;
            }

        } else {
            print_error('nofiltersetfortypewithvalue', 'totara_reportbuilder', '', (object)array('type' => $type, 'value' => $value));
        }
    }

    /**
     * Returns sql where statement based on active filters
     * @param string $extrasql
     * @param array $extraparams for the extra sql clause (named params)
     * @return array containing one array of SQL clauses and one array of params
     */
    function get_sql_filter($extrasql='', $extraparams=array()) {
        global $SESSION;

        $shortname = $this->_report->shortname;
        $filtername = 'filtering_'.$shortname;

        $where_sqls = array();
        $having_sqls = array();
        $filterparams = array();

        if ($extrasql != '') {
            if (strpos($extrasql, '?')) {
                print_error('extrasqlshouldusenamedparams', 'totara_reportbuilder');
            }
            $where_sqls[] = $extra;
        }


        if (!empty($SESSION->{$filtername})) {
            foreach ($SESSION->{$filtername} as $fname => $datas) {
                if (!array_key_exists($fname, $this->_fields)) {
                    continue; // filter not used
                }
                $field = $this->_fields[$fname];
                foreach ($datas as $i => $data) {
                    if ($field->_filter->is_grouped()) {
                        list($having_sqls[], $params) = $field->get_sql_filter($data);
                    } else {
                        list($where_sqls[], $params) = $field->get_sql_filter($data);
                    }
                    $filterparams = array_merge($filterparams, $params);
                }
            }
        }

        $out = array();
        if (!empty($having_sqls)) {
            $out['having'] = implode(' AND ', $having_sqls);
        }
        if (!empty($where_sqls)) {
            $out['where'] = implode(' AND ', $where_sqls);
        }

        return array($out, array_merge($filterparams, $extraparams));
    }

    /**
     * Print the add filter form.
     */
    function display_add() {
        $this->_addform->display();
    }

    /**
     * Print the active filter form.
     */
    function display_active() {
        $this->_activeform->display();
    }

    /**
     * Same as display_active() but returns array of strings describing active
     * filters instead of form
     */
    function return_active() {
        global $SESSION;
        $shortname = $this->_report->shortname;
        $filtername = 'filtering_'.$shortname;
        $fields = $this->_fields;
        $out = array();
        if (!empty($SESSION->{$filtername})) {
            foreach ($SESSION->{$filtername} as $fname => $datas) {
                if (!array_key_exists($fname, $fields)) {
                    continue; // filter not used
                }
                $field = $fields[$fname];
                foreach ($datas as $i => $data) {
                    $out[] = $field->get_label($data);
                }
            }
        }
        return $out;
    }

}

/**
 * The base filter class. All abstract classes must be implemented.
 */
class filter_type {
    var $_name;
    var $_sessionname;
    var $_filter;
    /**
     * Constructor
     * @param object $filter rb_filter object for this filter
     * @param string $sessionname Unique name for the report for storing sessions
     */
    function filter_type($filter, $sessionname) {
        $this->_filter = $filter;
        $this->_name     = $filter->type . '-' . $filter->value;
        $this->_sessionname = $sessionname;
    }

    /**
     * Returns the condition to be used with SQL where
     * @param array $data filter settings
     * @return string the filtering condition or null if the filter is disabled
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


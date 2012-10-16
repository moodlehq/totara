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

/**
 * Generic filter based on a date.
 */
class rb_filter_date extends rb_filter_type {
    /**
     * the fields available for comparisson
     */

    /**
     * Constructor
     *
     * @param string $type The filter type (from the db or embedded source)
     * @param string $value The filter value (from the db or embedded source)
     * @param integer $advanced If the filter should be shown by default (0) or only
     *                          when advanced options are shown (1)
     * @param reportbuilder object $report The report this filter is for
     *
     * @return rb_filter_date object
     */
    function __construct($type, $value, $advanced, $report) {
        parent::__construct($type, $value, $advanced, $report);

        if (!isset($this->options['includetime'])) {
            $this->options['includetime'] = false;
        }
    }

    /**
     * Adds controls specific to this filter in the form.
     * @param object $mform a MoodleForm object to setup
     */
    function setupForm(&$mform) {
        global $SESSION;
        $label = $this->label;
        $advanced = $this->advanced;
        $includetime = $this->options['includetime'];

        $objs = array();

        $objs[] =& $mform->createElement('checkbox', $this->name.'_sck', null, get_string('isafter', 'filters'));
        if ($includetime) {
            $objs[] =& $mform->createElement('date_time_selector', $this->name.'_sdt', null, array('step' => 1, 'optional' => false));
            $objs[] =& $mform->createElement('static', null, null, html_writer::empty_tag('br'));
        } else {
            $objs[] =& $mform->createElement('date_selector', $this->name.'_sdt', null);
        }
        $objs[] =& $mform->createElement('checkbox', $this->name.'_eck', null, get_string('isbefore', 'filters'));
        if ($includetime) {
            $objs[] =& $mform->createElement('date_time_selector', $this->name.'_edt', null, array('step' => 1, 'optional' => false));
        } else {
            $objs[] =& $mform->createElement('date_selector', $this->name.'_edt', null);
        }
        $grp =& $mform->addElement('group', $this->name.'_grp', $label, $objs, '', false);
        $mform->addHelpButton($grp->_name, 'filterdate', 'filters');

        if ($advanced) {
            $mform->setAdvanced($this->name.'_grp');
        }

        $mform->disabledIf($this->name.'_sdt[day]', $this->name.'_sck', 'notchecked');
        $mform->disabledIf($this->name.'_sdt[month]', $this->name.'_sck', 'notchecked');
        $mform->disabledIf($this->name.'_sdt[year]', $this->name.'_sck', 'notchecked');
        $mform->disabledIf($this->name.'_edt[day]', $this->name.'_eck', 'notchecked');
        $mform->disabledIf($this->name.'_edt[month]', $this->name.'_eck', 'notchecked');
        $mform->disabledIf($this->name.'_edt[year]', $this->name.'_eck', 'notchecked');
        if ($includetime) {
            $mform->disabledIf($this->name.'_sdt[hour]', $this->name.'_sck', 'notchecked');
            $mform->disabledIf($this->name.'_sdt[minute]', $this->name.'_sck', 'notchecked');
            $mform->disabledIf($this->name.'_edt[hour]', $this->name.'_eck', 'notchecked');
            $mform->disabledIf($this->name.'_edt[minute]', $this->name.'_eck', 'notchecked');
        }

        // set default values
        if (isset($SESSION->reportbuilder[$this->report->_id][$this->name])) {
            $defaults = $SESSION->reportbuilder[$this->report->_id][$this->name];
        }
        if (isset($defaults['after']) && $defaults['after'] != 0) {
            $mform->setDefault($this->name.'_sck', 1);
            $mform->setDefault($this->name.'_sdt', $defaults['after']);
        }
        if (isset($defaults['before']) && $defaults['before'] != 0) {
            $mform->setDefault($this->name.'_eck', 1);
            $mform->setDefault($this->name.'_edt', $defaults['before']);
        }
    }

    /**
     * Retrieves data from the form data
     * @param object $formdata data submited with the form
     * @return mixed array filter data or false when filter not set
     */
    function check_data($formdata) {
        $sck = $this->name.'_sck';
        $sdt = $this->name.'_sdt';
        $eck = $this->name.'_eck';
        $edt = $this->name.'_edt';

        if (!isset($formdata->$sck) and !isset($formdata->$eck)) {
            return false;
        }

        $data = array();
        if (isset($formdata->$sck)) {
            $data['after'] = $formdata->$sdt;
        } else {
            $data['after'] = 0;
        }
        if (isset($formdata->$eck)) {
            $data['before'] = $formdata->$edt;
        } else {
            $data['before'] = 0;
        }
        return $data;
    }

    /**
     * Returns the condition to be used with SQL where
     * @param array $data filter settings
     * @return array containing filtering condition SQL clause and params
     */
    function get_sql_filter($data) {
        $after  = $data['after'];
        $before = $data['before'];
        $query  = $this->field;

        if (empty($after) and empty($before)) {
            return array('', array());
        }

        $params = array();
        $res = "$query > 0" ;

        if ($after) {
            $uniqueparam = rb_unique_param('fdafter');
            $res .= " AND {$query} >= :{$uniqueparam}";
            $params[$uniqueparam] = $after;
        }
        if ($before) {
            $uniqueparam = rb_unique_param('fdbefore');
            $res .= " AND {$query} <= :{$uniqueparam}";
            $params[$uniqueparam] = $before;
        }
        return array($res, $params);
    }

    /**
     * Returns a human friendly description of the filter used as label.
     * @param array $data filter settings
     * @return string active filter label
     */
    function get_label($data) {
        $after  = $data['after'];
        $before = $data['before'];
        $label  = $this->label;

        $a = new stdClass();
        $a->label  = $label;
        $a->after  = userdate($after);
        $a->before = userdate($before);

        if ($after and $before) {
            return get_string('datelabelisbetween', 'filters', $a);

        } else if ($after) {
            return get_string('datelabelisafter', 'filters', $a);

        } else if ($before) {
            return get_string('datelabelisbefore', 'filters', $a);
        }
        return '';
    }
}
?>

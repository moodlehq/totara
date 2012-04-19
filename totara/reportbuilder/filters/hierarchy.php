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
 * Generic filter based on a hierarchy.
 */
class filter_hierarchy extends filter_type {

    /**
     * Hierarchy type
     * Refers to the name of the main table e.g. 'pos', 'org' or 'comp'
     */
    var $_type;

    /**
     * Constructor
     * @param object $filter rb_filter object for this filter
     * @param string $sessionname Unique name for the report for storing sessions
     */
    function filter_hierarchy($filter, $sessionname, $type) {
        // hierarchy type
        $this->_type = $type;
        parent::filter_type($filter, $sessionname);
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
        $type = $this->_type;

        // manually disable buttons - can't use disabledIf because
        // button isn't created using form element
        $attr = "onChange=\"if (this.value == 0) {
            $('input[name=" . $this->_name . "_rec]').attr('disabled', true);
            $('#show-" . $this->_name . "-dialog').attr('disabled', true);
        } else {
            $('input[name=" . $this->_name . "_rec]').removeAttr('disabled');
            $('#show-" . $this->_name . "-dialog').removeAttr('disabled');
        }\"";
        $objs = array();
        $objs[] =& $mform->createElement('select', $this->_name.'_op', null, $this->get_operators(), $attr);
        $objs[] =& $mform->createElement('static', 'title'.$this->_name, '',
            html_writer::tag('span', '', array('id' => $this->_name . 'title', 'class' => 'dialog-result-title')));
        // can't use a button because id must be 'show-*-dialog' and
        // formslib appends 'id_' to ID
        // TODO change dialogs to bind to any id
        $objs[] =& $mform->createElement('static', 'selectorbutton',
            '',
            html_writer::empty_tag('input', array('type' => 'button',
                'class' => 'rb-filter-choose-' . $this->_type,
                'value' => get_string('choose' . $this->_type, 'totara_reportbuilder'),
                'id' => 'show-' . $this->_name . '-dialog')));
        $objs[] =& $mform->createElement('checkbox', $this->_name . '_rec', '', get_string('includesubcategories', 'filters'));

        $grp =& $mform->addElement('group', $this->_name.'_grp', $label, $objs, '', false);
        $mform->addHelpButton($grp->_name, 'reportbuilderdialogfilter', 'totara_reportbuilder');
        if ($advanced) {
            $mform->setAdvanced($this->_name.'_grp');
        }

        $mform->addElement('hidden', $this->_name);

        if (array_key_exists($this->_name, $SESSION->{$sessionname})) {
            $defaults = $SESSION->{$sessionname}[$this->_name];
        }
        if (isset($defaults[0]['value'])) {
            $mform->setDefault($this->_name, $defaults[0]['value']);
        }

        // set other default values
        //TODO get rid of need for [0]
        if (isset($defaults[0]['operator'])) {
            $mform->setDefault($this->_name.'_op', $defaults[0]['operator']);
        }
        if (isset($defaults[0]['recursive'])) {
            $mform->setDefault($this->_name.'_rec', $defaults[0]['recursive']);
        }
    }

    function definition_after_data(&$mform) {
        global $DB;

        if ($id = $mform->getElementValue($this->_name)) {
            if ($title = $DB->get_field($this->_type, 'fullname', array('id' => $id))) {
                $mform->setDefault('title'.$this->_name,
                html_writer::tag('span', $title, array('id' => $this->_name . 'title', 'class' => 'dialog-result-title')));
            }
        }
    }


    /**
     * Retrieves data from the form data
     * @param object $formdata data submited with the form
     * @return mixed array filter data or false when filter not set
     */
    function check_data($formdata) {
        $field    = $this->_name;
        $operator = $field.'_op';
        $recursive = $field.'_rec';

        if (array_key_exists($field, $formdata) &&
            $formdata->$field != '') {
            $data = array('operator' => (int)$formdata->$operator,
                          'value'    => (string)$formdata->$field);
            if (isset($formdata->$recursive)) {
                $data['recursive'] = (int)$formdata->$recursive;
            } else {
                $data['recursive'] = 0;
            }

            return $data;
        }

        return false;
    }

    /**
     * Returns the condition to be used with SQL where
     * @param array $data filter settings
     * @return array containing filtering condition SQL clause and params
     */
    function get_sql_filter($data) {
        global $DB;

        $operator = $data['operator'];
        $recursive = (isset($data['recursive'])
            && $data['recursive']) ? '%' : '';
        $value    = $data['value'];
        $query    = $this->_filter->get_field();

        switch($operator) {
            case 1:
                $not = false;
                break;
            case 2:
                $not = true;
                break;
            default:
                // return 1=1 instead of TRUE for MSSQL support
                return array(' 1=1 ', array());
        }

        $path = $DB->get_field($this->_type, 'path', array('id' => $value));
        $params = array();
        $uniqueparam = rb_unique_param("fh{$operator}_");
        if ($operator == 2) {
            // check for null case for is not operator
            $sql = '(' . $DB->sql_like($query, ":{$uniqueparam}", true, true, $not) . " OR {$query} IS NULL)";
            $params[$uniqueparam] = $DB->sql_like_escape($path) . $recursive;
        } else {
            $sql = $DB->sql_like($query, ":{$uniqueparam}", true, true, $not);
            $params[$uniqueparam] = $DB->sql_like_escape($path) . $recursive;
        }

        return array($sql, $params);
    }

    /**
     * Returns a human friendly description of the filter used as label.
     * @param array $data filter settings
     * @return string active filter label
     */
    function get_label($data) {
        global $DB;

        $operators = $this->get_operators();
        $operator  = $data['operator'];
        $recursive = $data['recursive'];
        $value     = $data['value'];
        $label = $this->_filter->label;

        if (empty($operator) || $value == '') {
            return '';
        }

        $itemname = $DB->get_field($this->_type, 'fullname', array('id' => $value));

        $a = new stdClass();
        $a->label    = $label;
        $a->value    = '"'.s($itemname).'"';
        if ($recursive) {
            $a->value .= ' (and children)';
        }
        $a->operator = $operators[$operator];

        return get_string('selectlabel', 'filters', $a);
    }
}


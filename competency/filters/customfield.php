<?php //$Id$

/**
 * Competency filter based on values of custom fields.
 */
class competency_filter_customfield extends competency_filter_type {

    /**
     * Constructor
     * @param string $name the name of the filter instance
     * @param string $label the label of the filter instance
     * @param boolean $advanced advanced form element flag
     */
    function competency_filter_customfield($name, $label, $advanced) {
        parent::competency_filter_type($name, $label, $advanced);
    }

    /**
     * Returns an array of comparison operators
     * @return array of comparison operators
     */
    function get_operators() {
        return array(0 => get_string('contains', 'filters'),
                     1 => get_string('doesnotcontain','filters'),
                     2 => get_string('isequalto','filters'),
                     3 => get_string('startswith','filters'),
                     4 => get_string('endswith','filters'),
                     5 => get_string('isempty','filters'),
                     6 => get_string('isnotdefined','filters'),
                     7 => get_string('isdefined','filters'));
    }

    /**
     * Returns an array of custom fields
     * @return array of fields
     */
    // TODO abstract this for organisation/position
    // TODO show level in pulldown box?
    function get_custom_fields() {
        if (!$fields = get_records_select('competency_depth_info_field', '', 'shortname', 'id,shortname')) {
            return null;
        }
        $res = array(0 => get_string('anyfield', 'filters'));
        foreach($fields as $k=>$v) {
            $res[$k] = $v->shortname;
        }
        return $res;
    }

    /**
     * Adds controls specific to this filter in the form.
     * @param object $mform a MoodleForm object to setup
     */
    function setupForm(&$mform) {
        $custom_fields = $this->get_custom_fields();
        if (empty($custom_fields)) {
            return;
        }
        $objs = array();
        $objs[] =& $mform->createElement('select', $this->_name.'_fld', null, $custom_fields);
        $objs[] =& $mform->createElement('select', $this->_name.'_op', null, $this->get_operators());
        $objs[] =& $mform->createElement('text', $this->_name, null);
        $grp =& $mform->addElement('group', $this->_name.'_grp', $this->_label, $objs, '', false);
        $grp->setHelpButton(array('customfield',$this->_label,'filters')); //TODO help file?
        if ($this->_advanced) {
            $mform->setAdvanced($this->_name.'_grp');
        }
    }

    /**
     * Retrieves data from the form data
     * @param object $formdata data submited with the form
     * @return mixed array filter data or false when filter not set
     */
    function check_data($formdata) {
        $custom_fields = $this->get_custom_fields();

        if (empty($custom_fields)) {
            return false;
        }

        $field    = $this->_name;
        $operator = $field.'_op';
        $custom  = $field.'_fld';

        if (array_key_exists($custom, $formdata)) {
            if ($formdata->$operator < 5 and $formdata->$field === '') {
                return false;
            }

            return array('value'    => (string)$formdata->$field,
                         'operator' => (int)$formdata->$operator,
                         'custom'  => (int)$formdata->$custom);
        }
    }

    /**
     * Returns the condition to be used with SQL where
     * @param array $data filter settings
     * @return string the filtering condition or null if the filter is disabled
     */
    function get_sql_filter($data) {
        global $CFG;

        $custom_fields = $this->get_custom_fields();
        if (empty($custom_fields)) {
            return '';
        }

        $custom  = $data['custom'];
        $operator = $data['operator'];
        $value    = addslashes($data['value']);

        if (!array_key_exists($custom, $custom_fields)) {
            return '';
        } 

        $where = "";
        $op = " IN ";
        $ilike = sql_ilike();

        if ($operator < 5 and $value === '') {
            return '';
        }

        switch($operator) {
            case 0: // contains
                $where = "data $ilike '%$value%'"; break;
            case 1: // does not contain
                $where = "data NOT $ilike '%$value%'"; break;
            case 2: // equal to
                $where = "data $ilike '$value'"; break;
            case 3: // starts with
                $where = "data $ilike '$value%'"; break;
            case 4: // ends with
                $where = "data $ilike '%$value'"; break;
            case 5: // empty
                $where = "data=''"; break;
            case 6: // is not defined
                $op = " NOT IN "; break;
            case 7: // is defined
                break;
        }
        if ($custom) {
            if ($where !== '') {
                $where = " AND $where";
            }
            $where = "fieldid=$custom $where";
        }
        if ($where !== '') {
            $where = "WHERE $where";
        }
        //TODO should this be id, fieldid, competencyid or something else
        //TODO check this is working as expected
        return "id $op (SELECT fieldid FROM {$CFG->prefix}competency_depth_info_data $where)";
    }

    /**
     * Returns a human friendly description of the filter used as label.
     * @param array $data filter settings
     * @return string active filter label
     */
    function get_label($data) {
        $operators      = $this->get_operators();
        $custom_fields = $this->get_custom_fields();

        if (empty($custom_fields)) {
            return '';
        }

        $custom  = $data['custom'];
        $operator = $data['operator'];
        $value    = $data['value'];

        if (!array_key_exists($custom, $custom_fields)) {
            return '';
        } 

        $a = new object();
        $a->label    = $this->_label;
        $a->value    = $value;
        $a->custom  = $custom_fields[$custom];
        $a->operator = $operators[$operator];

        switch($operator) {
            case 0: // contains
            case 1: // doesn't contain
            case 2: // equal to
            case 3: // starts with
            case 4: // ends with
                return get_string('customlabel', 'filters', $a);
            case 5: // empty
            case 6: // is not defined
            case 7: // is defined
                return get_string('customlabelnovalue', 'filters', $a);
        }
        return '';
    }
}

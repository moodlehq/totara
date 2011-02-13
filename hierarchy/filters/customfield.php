<?php //$Id$

require_once($CFG->dirroot . '/hierarchy/lib.php');

/**
 * Hierarchy filter based on values of custom fields.
 */
class hierarchy_filter_customfield extends hierarchy_filter_type {

    /**
     * Constructor
     * @param string $name the name of the filter instance
     * @param string $label the label of the filter instance
     * @param boolean $advanced advanced form element flag
     */
    function hierarchy_filter_customfield($name, $label, $advanced) {
        parent::hierarchy_filter_type($name, $label, $advanced);
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
    function get_custom_fields($type) {
        global $CFG;
        $shortprefix = hierarchy::get_short_prefix($type);
        $sql = "SELECT f.id, f.fullname AS fieldname, d.fullname AS depthname FROM
                {$CFG->prefix}{$shortprefix}_depth_info_field f JOIN
                {$CFG->prefix}{$shortprefix}_depth d ON f.depthid = d.id
                WHERE hidden = 0 ORDER BY f.depthid, f.sortorder";
        if (!$fields = get_records_sql($sql)) {
            return null;
        }
        $res = array(0 => get_string('anyfield', 'filters'));
        foreach($fields as $k=>$v) {
            $res[$k] = $v->depthname . ' > ' . $v->fieldname;
        }
        return $res;
    }

    /**
     * Adds controls specific to this filter in the form.
     * @param object $mform a MoodleForm object to setup
     */
    function setupForm(&$mform, $type=null) {
        $custom_fields = $this->get_custom_fields($type);
        if (empty($custom_fields)) {
            return;
        }
        $objs = array();
        $objs[] =& $mform->createElement('select', $this->_name.'_fld', null, $custom_fields);
        $objs[] =& $mform->createElement('select', $this->_name.'_op', null, $this->get_operators());
        $objs[] =& $mform->createElement('text', $this->_name, null);
        $mform->setType($this->_name, PARAM_TEXT);
        $grp =& $mform->addElement('group', $this->_name.'_grp', $this->_label, $objs, '', false);
        $grp->setHelpButton(array('customfield',$this->_label,'filters'));
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
        $type = $formdata->type;
        $custom_fields = $this->get_custom_fields($type);

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
    function get_sql_filter($data, $type) {
        global $CFG;

        $custom_fields = $this->get_custom_fields($type);
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
                $where = "data $ilike ''"; break;
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
        $shortprefix = hierarchy::get_short_prefix($type);
        return "id $op (SELECT {$type}id FROM {$CFG->prefix}{$shortprefix}_depth_info_data $where)";
    }

    /**
     * Returns a human friendly description of the filter used as label.
     * @param array $data filter settings
     * @return string active filter label
     */
    function get_label($data, $type) {
        $operators      = $this->get_operators();
        $custom_fields = $this->get_custom_fields($type);

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

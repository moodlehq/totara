<?php //$Id$

require_once($CFG->dirroot.'/local/reportbuilder/filters/lib.php');

/**
 * Generic filter based on a multiple checkboxes
 */
class filter_multicheck extends filter_type {
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
    function filter_multicheck($filter, $sessionname, $checkoptions, $default=null, $attributes=null) {
        parent::filter_type($filter, $sessionname);
        $this->_options = $checkoptions;
        $this->_default = $default;
        $this->_attributes = $attributes;
    }

    /**
     * Returns an array of comparison operators
     * @return array of comparison operators
     */
    function get_operators() {
        return array(0 => get_string('isanyvalue','filters'),
                     1 => get_string('matchesanyselected','filters'),
                     2 => get_string('matchesallselected','filters'));
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

        $mform->addElement('select', $this->_name.'_op', $label, $this->get_operators());
        $mform->setHelpButton($this->_name.'_op', array('checkbox', $label, 'filters'));

        // this class is used by the CSS to arrange the checkboxes nicely
        $mform->addElement('html', '<div class="multicheck-items">');
        $objs = array();
        foreach($this->_options as $id => $name) {
            $objs[] =& $mform->createElement('advcheckbox', $this->_name.'['. $id .']', null, $name, array('group' => 1));
            $mform->disabledIf($this->_name.'['.$id.']', $this->_name.'_op', 'eq', 0);
        }
        $grp =& $mform->addElement('group', $this->_name.'_grp', null, $objs, '', false);
        $mform->addElement('html', '</div>');
        if (!is_null($this->_default)) {
            $mform->setDefault($this->_name, $this->_default);
        }
        if ($advanced) {
            $mform->setAdvanced($this->_name.'_op');
            $mform->setAdvanced($this->_name.'_grp');
        }

        // set default values
        if(array_key_exists($this->_name, $SESSION->{$sessionname})) {
            $defaults = $SESSION->{$sessionname}[$this->_name];
        }
        //TODO get rid of need for [0]
        if(isset($defaults[0]['operator'])) {
            $mform->setDefault($this->_name.'_op', $defaults[0]['operator']);
        }
        if(isset($defaults[0]['value'])) {
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
        $operator = $field.'_op';

        if (array_key_exists($field, $formdata) ) {
            return array('operator' => (int)$formdata->$operator,
                         'value'    => (array)$formdata->$field);
        }

        return false;
    }

    /**
     * Returns the condition to be used with SQL where
     * @param array $data filter settings
     * @return string the filtering condition or null if the filter is disabled
     */
    function get_sql_filter($data) {
        $operator = $data['operator'];
        $items    = $data['value'];
        $query    = $this->_filter->get_field();

        switch($operator) {
            case 1:
                $glue = ' OR ';
                break;
            case 2:
                $glue = ' AND ';
                break;
            default:
                return ' TRUE ';
        }

        // split by comma and look for any items
        // within list
        $res = array();
        foreach($items as $id => $selected) {
            if($selected) {
                $res[] = "( $query LIKE '$id' OR " .
                    "$query LIKE '%|$id' OR " .
                    "$query LIKE '$id|%' OR " .
                    "$query LIKE '%|$id|%' )\n";
            }
        }
        // none selected
        if(count($res) == 0) {
            return ' FALSE ';
        }
        return '('.implode($glue,$res).')';
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

        $a = new object();
        $a->label    = $label;
        $checked = array();
        foreach($value as $name => $selected) {
            if($selected) {
                $checked[] = '"'.s($name).'"';
            }
        }
        $a->value    = implode(', ', $checked);
            //'"'.s($this->_options[$value]).'"';
        $a->operator = $operators[$operator];

        return get_string('selectlabel', 'filters', $a);
    }
}


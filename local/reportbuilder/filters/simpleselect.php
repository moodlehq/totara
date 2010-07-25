<?php //$Id$

require_once($CFG->dirroot.'/local/reportbuilder/filters/lib.php');

/**
 * Generic filter based on a list of values.
 */
class filter_simpleselect extends filter_type {
    /**
     * options for the list values
     */
    var $_options;

    /**
     * Constructor
     * @param string $name the name of the filter instance
     * @param string $label the label of the filter instance
     * @param boolean $advanced advanced form element flag
     * @param string $field user table filed name
     * @param array $options select options
     */
    function filter_simpleselect($filter, $sessionname, $selectoptions, $attributes=null) {
        parent::filter_type($filter, $sessionname);
        $this->_options = $selectoptions;
        $this->_attributes = $attributes;
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
        $options = $this->_options;
        $attr = $this->_attributes;

        $choices = array(''=>get_string('anyvalue','filters')) + $options;
        $mform->addElement('select', $this->_name, $label, $choices, $attr);
        $mform->setHelpButton($this->_name, array('simpleselect', $label, 'filters'));
        if ($advanced) {
            $mform->setAdvanced($this->_name);
        }

        // set default values
        if(array_key_exists($this->_name, $SESSION->{$sessionname})) {
            $defaults = $SESSION->{$sessionname}[$this->_name];
        }
        //TODO get rid of need for [0]
        if(isset($defaults[0]['value'])) {
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

        if (array_key_exists($field, $formdata) && $formdata->$field !== '') {
            return array('value'    => (string)$formdata->$field);
        }

        return false;
    }

    /**
     * Returns the condition to be used with SQL where
     * @param array $data filter settings
     * @return string the filtering condition or null if the filter is disabled
     */
    function get_sql_filter($data) {
        $value    = addslashes($data['value']);
        $query    = $this->_filter->get_field();

        if ($value == '') {
            return ' TRUE ';
        }

        return "$query = $value";
    }

    /**
     * Returns a human friendly description of the filter used as label.
     * @param array $data filter settings
     * @return string active filter label
     */
    function get_label($data) {
        $value     = $data['value'];
        $label = $this->_filter->label;

        if($value == '') {
            return '';
        }

        $a = new object();
        $a->label    = $label;
        $a->value    = '"'.s($this->_options[$value]).'"';
        $a->operator = get_string('isequalto','filters');

        return get_string('selectlabel', 'filters', $a);
    }
}


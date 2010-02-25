<?php //$Id$

require_once($CFG->dirroot.'/local/reportbuilder/filters/lib.php');

/**
 * Generic filter based on a date.
 */
class filter_date extends filter_type {
    /**
     * the fields available for comparisson
     */
    var $_field;
    var $_query;

    /**
     * Constructor
     * @param string $name the name of the filter instance
     * @param string $label the label of the filter instance
     * @param boolean $advanced advanced form element flag
     * @param string $field user table filed name
     */
    function filter_date($name, $label, $advanced, $field, $query) {
        parent::filter_type($name, $label, $advanced);
        $this->_field = $field;
        $this->_query = $query;
    }

    /**
     * Adds controls specific to this filter in the form.
     * @param object $mform a MoodleForm object to setup
     */
    function setupForm(&$mform) {
        $objs = array();

        $objs[] =& $mform->createElement('checkbox', $this->_name.'_sck', null, get_string('isafter', 'filters'));
        $objs[] =& $mform->createElement('date_selector', $this->_name.'_sdt', null);
        $objs[] =& $mform->createElement('checkbox', $this->_name.'_eck', null, get_string('isbefore', 'filters'));
        $objs[] =& $mform->createElement('date_selector', $this->_name.'_edt', null);
        $grp =& $mform->addElement('group', $this->_name.'_grp', $this->_label, $objs, '', false);
        $grp->setHelpButton(array('date',$this->_label,'filters'));

        if ($this->_advanced) {
            $mform->setAdvanced($this->_name.'_grp');
        }

        $mform->disabledIf($this->_name.'_sdt[day]', $this->_name.'_sck', 'notchecked');
        $mform->disabledIf($this->_name.'_sdt[month]', $this->_name.'_sck', 'notchecked');
        $mform->disabledIf($this->_name.'_sdt[year]', $this->_name.'_sck', 'notchecked');
        $mform->disabledIf($this->_name.'_edt[day]', $this->_name.'_eck', 'notchecked');
        $mform->disabledIf($this->_name.'_edt[month]', $this->_name.'_eck', 'notchecked');
        $mform->disabledIf($this->_name.'_edt[year]', $this->_name.'_eck', 'notchecked');
    }

    /**
     * Retrieves data from the form data
     * @param object $formdata data submited with the form
     * @return mixed array filter data or false when filter not set
     */
    function check_data($formdata) {
        $sck = $this->_name.'_sck';
        $sdt = $this->_name.'_sdt';
        $eck = $this->_name.'_eck';
        $edt = $this->_name.'_edt';

        if (!array_key_exists($sck, $formdata) and !array_key_exists($eck, $formdata)) {
            return false;
        }

        $data = array();
        if (array_key_exists($sck, $formdata)) {
            $data['after'] = $formdata->$sdt;
        } else {
            $data['after'] = 0;
        }
        if (array_key_exists($eck, $formdata)) {
            $data['before'] = $formdata->$edt;
        } else {
            $data['before'] = 0;
        }
        return $data;
    }

    /**
     * Returns the condition to be used with SQL where
     * @param array $data filter settings
     * @return string the filtering condition or null if the filter is disabled
     */
    function get_sql_filter($data) {
        $after  = $data['after'];
        $before = $data['before'];
        $field  = $this->_field;
        $query  = $this->_query;

        if (empty($after) and empty($before)) {
            return '';
        }

        $res = "$query > 0" ;

        if ($after) {
            $res .= " AND $query >= $after";
        }
        if ($before) {
            $res .= " AND $query <= $before";
        }
        return $res;
    }

    /**
     * Returns a human friendly description of the filter used as label.
     * @param array $data filter settings
     * @return string active filter label
     */
    function get_label($data) {
        $after  = $data['after'];
        $before = $data['before'];
        $field  = $this->_field;

        $a = new object();
        $a->label  = $this->_label;
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

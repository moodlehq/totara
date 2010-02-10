<?php //$Id$
//TODO change to relative path
require_once($CFG->dirroot.'/local/reportbuilder/filters/text.php');
require_once($CFG->dirroot.'/local/reportbuilder/filters/select.php');
require_once($CFG->dirroot.'/local/reportbuilder/filters/date.php');
require_once($CFG->dirroot.'/local/reportbuilder/filters/filter_forms.php');

/**
 * Filtering wrapper class.
 */
class filtering {
    var $_fields;
    var $_addform;
    var $_activeform;
    var $_filter;
    var $_shortname;

    /**
     * Contructor
     * @param array array of visible fields
     * @param string base url used for submission/return, null if the same of current page
     * @param array extra page parameters
     */
    function filtering($report=null, $baseurl=null, $extraparams=null) {
        global $SESSION;

        if($report == null) {
            error('Report must be defined');
        }

        $this->_report = $report;

        $shortname = $report->_shortname;

        if($shortname == null) {
            error('Report shortname must be defined');
        }

        // initialise session var based on unique shortname
        $filtername = "filtering_$shortname";
        if (!isset($SESSION->{$filtername})) {
            $SESSION->{$filtername} = array();
        }

        // generate arrays of field names and queries based on input array
        $this->_fields  = array();
        if($report->_filters) {
            foreach ($report->_filters as $filter) {
                $type = $filter['type'];
                $value = $filter['value'];
                $advanced = $filter['advanced'];
                $fieldname = "{$type}-{$value}";
                if ($field = $this->get_field($type, $value, $advanced)) {
                    $this->_fields[$fieldname] = $field;
                }

            }
        }

        // first the new filter form
        $this->_addform = new add_filter_form($baseurl, array('fields'=>$this->_fields, 'extraparams'=>$extraparams, 'shortname' => $shortname));
        if ($adddata = $this->_addform->get_data(false)) {
            foreach($this->_fields as $fname=>$field) {
                $data = $field->check_data($adddata);
                if ($data === false) {
                    continue; // nothing new
                }
                if (!array_key_exists($fname, $SESSION->{$filtername})) {
                    $SESSION->{$filtername}[$fname] = array();
                }
                $SESSION->{$filtername}[$fname][] = $data;
            }
            // clear the form
            $_POST = array();
            $this->_addform = new add_filter_form($baseurl, array('fields'=>$this->_fields, 'extraparams'=>$extraparams, 'shortname' => $shortname));
        }

        // now the active filters
        $this->_activeform = new active_filter_form($baseurl, array('fields'=>$this->_fields, 'extraparams'=>$extraparams,'shortname'=>$shortname));
        if ($adddata = $this->_activeform->get_data(false)) {
            if (!empty($adddata->removeall)) {
                $SESSION->{$filtername} = array();

            } else if (!empty($adddata->removeselected) and !empty($adddata->filter)) {
                foreach($adddata->filter as $fname=>$instances) {
                    foreach ($instances as $i=>$val) {
                        if (empty($val)) {
                            continue;
                        }
                        unset($SESSION->{$filtername}[$fname][$i]);
                    }
                    if (empty($SESSION->{$filtername}[$fname])) {
                        unset($SESSION->{$filtername}[$fname]);
                    }
                }
            }
            // clear+reload the form
            $_POST = array();
            $this->_activeform = new active_filter_form($baseurl, array('fields'=>$this->_fields, 'extraparams'=>$extraparams, 'shortname'=>$shortname));
        }

    }

    /**
     * Creates known filter if present
     * @param string $fieldname
     * @param boolean $advanced
     * @return object filter
     */
    function get_field($type, $value, $advanced) {
        global $USER, $CFG, $SITE;

        $filteroptions = $this->_report->_filteroptions;
        $columnoptions = $this->_report->_columnoptions;
        $source = $this->_report->_source;

        $fieldname = "{$type}-{$value}";
        $fieldquery = $columnoptions[$type][$value]['field'];

        $filtersfile = "{$CFG->dirroot}/local/reportbuilder/sources/$source/filterfuncs.php";
        if(file_exists($filtersfile)) {
            include_once($filtersfile);
        }

        if(isset($filteroptions[$type][$value]['filtertype'])) {
            $filtertype = $filteroptions[$type][$value]['filtertype'];
            $filtername = "filter_{$filtertype}";
            $label = $filteroptions[$type][$value]['label'];
            switch($filtertype) {
                case 'text':
                case 'date':
                    return new $filtername($fieldname, $label, $advanced, $fieldname, $fieldquery);
                case 'select':
                    $selectfunc = $filteroptions[$type][$value]['selectfunc'];
                    $options = (isset($filteroptions[$type][$value]['options'])) ? $filteroptions[$type][$value]['options'] : null ;
                    $selectfield = $selectfunc();
                    return new $filtername($fieldname, $label, $advanced, $fieldname, $fieldquery, $selectfield, null, $options);
                default:
                    trigger_error("No filter found for filter type '$filtertype'.",E_USER_WARNING);
                    return null;
            }

        } else {
            error("get_field(): no filter set in filteroptions for type '$type' with value '$value'");
        }
    }

    /**
     * Returns sql where statement based on active filters
     * @param string $extra sql
     * @return string
     */
    function get_sql_filter($extra='') {
        global $SESSION;

        $shortname = $this->_report->_shortname;
        $filtername = 'filtering_'.$shortname;

        $sqls = array();
        if ($extra != '') {
            $sqls[] = $extra;
        }


        if (!empty($SESSION->{$filtername})) {
            foreach ($SESSION->{$filtername} as $fname=>$datas) {
                if (!array_key_exists($fname, $this->_fields)) {
                    continue; // filter not used
                }
                $field = $this->_fields[$fname];
                foreach($datas as $i=>$data) {
                    $sqls[] = $field->get_sql_filter($data);
                }
            }
        }

        if (empty($sqls)) {
            return '';
        } else {
            return implode(' AND ', $sqls);
        }
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

}

/**
 * The base filter class. All abstract classes must be implemented.
 */
class filter_type {
    /**
     * The name of this filter instance.
     */
    var $_name;

    /**
     * The label of this filter instance.
     */
    var $_label;

    /**
     * Advanced form element flag
     */
    var $_advanced;

    /**
     * Constructor
     * @param string $name the name of the filter instance
     * @param string $label the label of the filter instance
     * @param boolean $advanced advanced form element flag
     */
    function filter_type($name, $label, $advanced) {
        $this->_name     = $name;
        $this->_label    = $label;
        $this->_advanced = $advanced;
    }

    /**
     * Returns the condition to be used with SQL where
     * @param array $data filter settings
     * @return string the filtering condition or null if the filter is disabled
     */
    function get_sql_filter($data) {
        error('Abstract method get_sql_filter() called - must be implemented');
    }

    /**
     * Retrieves data from the form data
     * @param object $formdata data submited with the form
     * @return mixed array filter data or false when filter not set
     */
    function check_data($formdata) {
        error('Abstract method check_data() called - must be implemented');
    }

    /**
     * Adds controls specific to this filter in the form.
     * @param object $mform a MoodleForm object to setup
     */
    function setupForm(&$mform) {
        error('Abstract method setupForm() called - must be implemented');
    }

    /**
     * Returns a human friendly description of the filter used as label.
     * @param array $data filter settings
     * @return string active filter label
     */
    function get_label($data) {
        error('Abstract method get_label() called - must be implemented');
    }
}

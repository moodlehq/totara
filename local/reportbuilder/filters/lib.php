<?php //$Id$
require_once($CFG->dirroot.'/local/reportbuilder/filters/text.php');
require_once($CFG->dirroot.'/local/reportbuilder/filters/number.php');
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
    var $_sessionname;

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

        $shortname = $report->shortname;

        if($shortname == null) {
            error('Report shortname must be defined');
        }

        // initialise session var based on unique shortname
        $filtername = "filtering_$shortname";
        $this->_sessionname = $filtername;
        if (!isset($SESSION->{$filtername})) {
            $SESSION->{$filtername} = array();
        }

        // generate arrays of field names and queries based on input array
        $this->_fields  = array();
        if($report->filters) {
            foreach ($report->filters as $filter) {
                $type = $filter['type'];
                $value = $filter['value'];
                $advanced = $filter['advanced'];
                // check filter exists in available options
                if(array_key_exists($type, $report->filteroptions) && array_key_exists($value, $report->filteroptions[$type])) {
                    $fieldname = "{$type}-{$value}";
                    if ($field = $this->get_field($type, $value, $advanced)) {
                        $this->_fields[$fieldname] = $field;
                    }
                } else {
                    trigger_error("Filter with type of '$type' and value of '$value' not found in filter options.",E_USER_WARNING);
                }

            }
        }

        // the new filter form
        $this->_addform = new add_filter_form($baseurl, array('fields'=>$this->_fields, 'extraparams'=>$extraparams, 'shortname' => $shortname));

        if ($adddata = $this->_addform->get_data(false)) {

            if(isset($adddata->clearfilter)) {
                    $SESSION->{$filtername} = array();
                    $_POST = array();
                    $this->_addform = new add_filter_form($baseurl, array('fields'=>$this->_fields, 'extraparams'=>$extraparams, 'shortname' => $shortname));

            } else {

                foreach($this->_fields as $fname=>$field) {
                    $data = $field->check_data($adddata);
                    if ($data === false) {
                        // unset existing result if field has been set back to "not set" position
                        if(array_key_exists($fname, $SESSION->{$filtername})){
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
     * @param string $fieldname
     * @param boolean $advanced
     * @return object filter
     */
    function get_field($type, $value, $advanced) {
        global $USER, $CFG, $SITE;

        $filteroptions = $this->_report->filteroptions;
        $columnoptions = $this->_report->columnoptions;
        $source = $this->_report->source;
        $sessionname = $this->_sessionname;
        $fieldname = "{$type}-{$value}";
        $fieldquery = $columnoptions[$type][$value]['field'];

        $filtersfile = "{$CFG->dirroot}/local/reportbuilder/filterfuncs.php";
        if(file_exists($filtersfile)) {
            include_once($filtersfile);
        }

        if(isset($filteroptions[$type][$value]['filtertype'])) {
            $filtertype = $filteroptions[$type][$value]['filtertype'];
            $filtername = "filter_{$filtertype}";
            $label = $filteroptions[$type][$value]['label'];
            switch($filtertype) {
                case 'text':
                case 'number':
                case 'date':
                    return new $filtername($fieldname, $label, $advanced, $sessionname, $fieldname, $fieldquery);
                case 'select':
                    $selectfunc = $filteroptions[$type][$value]['selectfunc'];
                    $options = (isset($filteroptions[$type][$value]['options'])) ? $filteroptions[$type][$value]['options'] : null ;
                    $selectfield = $selectfunc($this->_report->contentmode, $this->_report->contentsettings);
                    return new $filtername($fieldname, $label, $advanced, $sessionname, $fieldname, $fieldquery, $selectfield, null, $options);
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

        $shortname = $this->_report->shortname;
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
        if(!empty($SESSION->{$filtername})) {
            foreach($SESSION->{$filtername} as $fname => $datas) {
                if(!array_key_exists($fname, $fields)) {
                    continue; // filter not used
                }
                $field = $fields[$fname];
                foreach($datas as $i => $data) {
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

    var $_filtername;
    /**
     * Constructor
     * @param string $name the name of the filter instance
     * @param string $label the label of the filter instance
     * @param boolean $advanced advanced form element flag
     */
    function filter_type($name, $label, $advanced, $filtername) {
        $this->_name     = $name;
        $this->_label    = $label;
        $this->_advanced = $advanced;
        $this->_filtername = $filtername;
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

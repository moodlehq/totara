<?php //$Id$

require_once($CFG->dirroot.'/competency/filters/text.php');
require_once($CFG->dirroot.'/competency/filters/customfield.php');
require_once($CFG->dirroot.'/competency/filters/competency_filter_forms.php');


/**
 * Competency filtering wrapper class.
 */
class competency_filtering {
    var $_fields;
    var $_addform;
    var $_activeform;

    /**
     * Contructor
     * @param array array of visible competency fields
     * @param string base url used for submission/return, null if the same of current page
     * @param array extra page parameters
     */
    function competency_filtering($fieldnames=null, $baseurl=null, $extraparams=null) {
        global $SESSION;

        if (!isset($SESSION->competency_filtering)) {
            $SESSION->competency_filtering = array();
        }

        if (empty($fieldnames)) {
            $fieldnames = array('fullname'=>0, 'shortname'=>1, 'idnumber'=>1, 'description'=>1, 'custom'=>1);
        }

        $this->_fields  = array();

        foreach ($fieldnames as $fieldname=>$advanced) {
            if ($field = $this->get_field($fieldname, $advanced)) {
                $this->_fields[$fieldname] = $field;
            }
        }

        // first the new filter form
        $this->_addform = new competency_add_filter_form($baseurl, array('fields'=>$this->_fields, 'extraparams'=>$extraparams));
        if ($adddata = $this->_addform->get_data(false)) {
            foreach($this->_fields as $fname=>$field) {
                $data = $field->check_data($adddata);
                if ($data === false) {
                    continue; // nothing new
                }
                if (!array_key_exists($fname, $SESSION->competency_filtering)) {
                    $SESSION->competency_filtering[$fname] = array();
                }
                $SESSION->competency_filtering[$fname][] = $data;
            }
            // clear the form
            $_POST = array();
            $this->_addform = new competency_add_filter_form($baseurl, array('fields'=>$this->_fields, 'extraparams'=>$extraparams));
        }

        // now the active filters
        $this->_activeform = new competency_active_filter_form($baseurl, array('fields'=>$this->_fields, 'extraparams'=>$extraparams));
        if ($adddata = $this->_activeform->get_data(false)) {
            if (!empty($adddata->removeall)) {
                $SESSION->competency_filtering = array();

            } else if (!empty($adddata->removeselected) and !empty($adddata->filter)) {
                foreach($adddata->filter as $fname=>$instances) {
                    foreach ($instances as $i=>$val) {
                        if (empty($val)) {
                            continue;
                        }
                        unset($SESSION->competency_filtering[$fname][$i]);
                    }
                    if (empty($SESSION->competency_filtering[$fname])) {
                        unset($SESSION->competency_filtering[$fname]);
                    } 
                }
            }
            // clear+reload the form
            $_POST = array();
            $this->_activeform = new competency_active_filter_form($baseurl, array('fields'=>$this->_fields, 'extraparams'=>$extraparams));
        }
    }

    /**
     * Creates known competency filter if present
     * @param string $fieldname
     * @param boolean $advanced
     * @return object filter
     */
    function get_field($fieldname, $advanced) {
        global $USER, $CFG, $SITE;

        switch ($fieldname) {
            case 'fullname':    return new competency_filter_text('fullname', get_string('fullname'), $advanced, 'fullname');
            case 'shortname':    return new competency_filter_text('shortname', get_string('shortname'), $advanced, 'shortname');
            case 'idnumber':    return new competency_filter_text('idnumber', get_string('idnumber'), $advanced, 'idnumber');
            case 'description':       return new competency_filter_text('description', get_string('description'), $advanced, 'description');
            case 'custom':      return new competency_filter_customfield('custom', get_string('customfield'), $advanced);
            default:            return null;
        }
    }

    /**
     * Returns sql where statement based on active competency filters
     * @param string $extra sql
     * @return string
     */
    function get_sql_filter($extra='') {
        global $SESSION;

        $sqls = array();
        if ($extra != '') {
            $sqls[] = $extra;
        }

        if (!empty($SESSION->competency_filtering)) {
            foreach ($SESSION->competency_filtering as $fname=>$datas) {
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
 * The base competency filter class. All abstract classes must be implemented.
 */
class competency_filter_type {
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
    function competency_filter_type($name, $label, $advanced) {
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

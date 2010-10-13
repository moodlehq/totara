<?php //$Id$
require_once($CFG->dirroot.'/local/reportbuilder/filters/text.php');
require_once($CFG->dirroot.'/local/reportbuilder/filters/textarea.php');
require_once($CFG->dirroot.'/local/reportbuilder/filters/number.php');
require_once($CFG->dirroot.'/local/reportbuilder/filters/simpleselect.php');
require_once($CFG->dirroot.'/local/reportbuilder/filters/select.php');
require_once($CFG->dirroot.'/local/reportbuilder/filters/date.php');
require_once($CFG->dirroot.'/local/reportbuilder/filters/hierarchy.php');
require_once($CFG->dirroot.'/local/reportbuilder/filters/multicheck.php');
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
                $type = $filter->type;
                $value = $filter->value;
                $fieldname = "{$type}-{$value}";
                if ($field = $this->get_field($filter)) {
                    $this->_fields[$fieldname] = $field;
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
     * @param object $filter rb_filter object from report builder
     * @return object filter
     */
    function get_field($filter) {
        global $USER, $CFG, $SITE;

        $type = $filter->type;
        $value = $filter->value;
        $sessionname = $this->_sessionname;

        if(isset($filter->filtertype)) {
            $filtertype = $filter->filtertype;
            $filtername = "filter_{$filtertype}";

            switch($filtertype) {
            case 'text':
            case 'textarea':
            case 'number':
            case 'date':
                return new $filtername($filter, $sessionname);
            case 'org':
            case 'comp':
            case 'pos':
                return new filter_hierarchy($filter, $sessionname, $filtertype);
            case 'simpleselect':
                $choices = $filter->selectchoices;
                $options = isset($filter->selectoptions) ?
                    $filter->selectoptions : null;
                return new $filtername($filter, $sessionname, $choices, $options);
            case 'select':
            case 'multicheck':
                $selectfunc = 'rb_filter_'.$filter->selectfunc;
                $options = $filter->selectoptions;
                if(method_exists($this->_report->src, $selectfunc)) {
                    $selectfield = $this->_report->src->$selectfunc(
                        $this->_report->contentmode,
                        $this->_report->contentoptions,
                        $this->_report->_id
                    );
                } else {
                    trigger_error("Filter function '{$selectfunc}' not found", E_USER_WARNING);
                    $selectfield = array();
                }
                return new $filtername($filter, $sessionname, $selectfield, null, $options);
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
     * @return array Associative array containing 'where' and 'having' strings
     */
    function get_sql_filter($extra='') {
        global $SESSION;

        $shortname = $this->_report->shortname;
        $filtername = 'filtering_'.$shortname;

        $where_sqls = array();
        $having_sqls = array();

        if ($extra != '') {
            $where_sqls[] = $extra;
        }


        if (!empty($SESSION->{$filtername})) {
            foreach ($SESSION->{$filtername} as $fname=>$datas) {
                if (!array_key_exists($fname, $this->_fields)) {
                    continue; // filter not used
                }
                $field = $this->_fields[$fname];
                foreach($datas as $i=>$data) {
                    if($field->_filter->is_grouped()) {
                        $having_sqls[] = $field->get_sql_filter($data);
                    } else {
                        $where_sqls[] = $field->get_sql_filter($data);
                    }
                }
            }
        }

        $out = array();
        if(!empty($having_sqls)) {
            $out['having'] = implode(' AND ', $having_sqls);
        }
        if(!empty($where_sqls)) {
            $out['where'] = implode(' AND ', $where_sqls);
        }
        return $out;
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
    var $_name;
    var $_sessionname;
    var $_filter;
    /**
     * Constructor
     * @param object $filter rb_filter object for this filter
     * @param string $sessionname Unique name for the report for storing sessions
     */
    function filter_type($filter, $sessionname) {
        $this->_filter = $filter;
        $this->_name     = $filter->type . '-' . $filter->value;
        $this->_sessionname = $sessionname;
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


/**
 * Parse a query into individual keywords, treating quoted phrases one item
 *
 * Pairs of matching double or single quotes are treated as a single keyword.
 *
 * @param string $query Text from user search field
 *
 * @return array Array of individual keywords parsed from input string
 */
function search_parse_keywords($query) {
    // query arrives with quotes escaped, but quotes have special meaning
    // within a query. Strip out slashes, then re-add any that are left
    // after parsing done (to protect against SQL injection)
    $query = stripslashes($query);

    $out = array();
    // break query down into quoted and unquoted sections
    $split_quoted = preg_split('/(\'[^\']+\')|("[^"]+")/', $query, 0,
        PREG_SPLIT_DELIM_CAPTURE);
    foreach($split_quoted as $item) {
        // strip quotes from quoted strings but leave spaces
        if(preg_match('/^(["\'])(.*)\\1$/', trim($item), $matches)) {
            $out[] = addslashes($matches[2]);
        } else {
            // split unquoted text on whitespace
            $keyword = addslashes_recursive(preg_split('/\s/', $item, 0,
                PREG_SPLIT_NO_EMPTY));
            $out = array_merge($out, $keyword);
        }
    }
    return $out;
}


/**
 * Return an SQL snippet to search for the given keywords
 *
 * @param array $keywords Array of strings to search for
 *
 * @return string SQL WHERE clause to match the keywords provided
 */
function search_get_keyword_where_clause($field, $keywords, $negate=false) {
    if($negate) {
        $not = ' NOT ';
        $token = ' OR ';
    } else {
        $not = '';
        $token = ' AND ';
    }

    // fields to search
    $fields = array('fullname', 'shortname', 'idnumber', 'description');

    $queries = array();
    foreach($keywords as $keyword) {
        $queries[] = $field . ' ' . $not . sql_ilike() . " '%" . $keyword . "%'";
    }
    // all keywords must be found in at least one field
    return '(' . implode($token, $queries) . ')';
}


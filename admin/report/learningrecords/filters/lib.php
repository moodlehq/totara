<?php //$Id$
//TODO change to relative path
require_once($CFG->dirroot.'/admin/report/learningrecords/filters/text.php');
require_once($CFG->dirroot.'/admin/report/learningrecords/filters/select.php');
require_once($CFG->dirroot.'/admin/report/learningrecords/filters/date.php');
/*
require_once($CFG->dirroot.'/admin/report/learningrecords/filters/simpleselect.php');
require_once($CFG->dirroot.'/admin/report/learningrecords/filters/courserole.php');
require_once($CFG->dirroot.'/admin/report/learningrecords/filters/globalrole.php');
require_once($CFG->dirroot.'/admin/report/learningrecords/filters/profilefield.php');
require_once($CFG->dirroot.'/admin/report/learningrecords/filters/yesno.php');
 */
require_once($CFG->dirroot.'/admin/report/learningrecords/filters/filter_forms.php');


/**
 * Filtering wrapper class.
 */
class filtering {
    var $_fields;
    var $_addform;
    var $_activeform;
    var $_filter;

    /**
     * Contructor
     * @param array array of visible fields
     * @param string base url used for submission/return, null if the same of current page
     * @param array extra page parameters
     */
    function filtering($source=null, $fieldinfo=null, $snippets=null, $baseurl=null, $extraparams=null) {
        global $SESSION;

        if($source == null) {
            error('Filter source must be defined');
        }
        if($fieldinfo == null) {
            error('Field info must be defined');
        }
        if($snippets == null) {
            error('Snippets must be defined');
        }

        // generate arrays of field names and queries based on input array
        foreach ($fieldinfo as $info) {
            $type = $info['type'];
            $value = $info['value'];
            $fieldname = "{$type}-{$value}";
            $fieldnames[$fieldname] = $info['advanced'];
            if(isset($snippets[$source][$type][$value]['field'])) {
                $fieldqueries[$fieldname] = $snippets[$source][$type][$value]['field'];
            } else {
                trigger_error("Missing snippet in filtering(): snippets[$source][$type][$value]['field']",E_USER_ERROR);
            }
        }

        $filtername = "filtering_$source";
        $this->_source = $source;

        if (!isset($SESSION->{$filtername})) {
            $SESSION->{$filtername} = array();
        }

        if (empty($fieldnames)) {
            error('Field names must be defined');
            /*
            $fieldnames = array('realname'=>0, 'lastname'=>1, 'firstname'=>1, 'email'=>1, 'city'=>1, 'country'=>1,
                                'confirmed'=>1, 'profile'=>1, 'courserole'=>1, 'systemrole'=>1,
                                'firstaccess'=>1, 'lastaccess'=>1, 'lastlogin'=>1, 'username'=>1, 'auth'=>1, 'mnethostid'=>1);
             */
        }

        $this->_fields  = array();

        foreach ($fieldnames as $fieldname=>$advanced) {
            if ($field = $this->get_field($fieldname, $fieldqueries[$fieldname], $advanced)) {
                $this->_fields[$fieldname] = $field;
            }
        }

        // first the new filter form
        $this->_addform = new add_filter_form($baseurl, array('fields'=>$this->_fields, 'extraparams'=>$extraparams, 'source'=>$source));
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
            $this->_addform = new add_filter_form($baseurl, array('fields'=>$this->_fields, 'extraparams'=>$extraparams, 'source' =>$source));
        }

        // now the active filters
        $this->_activeform = new active_filter_form($baseurl, array('fields'=>$this->_fields, 'extraparams'=>$extraparams, 'source' =>$source));
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
            $this->_activeform = new active_filter_form($baseurl, array('fields'=>$this->_fields, 'extraparams'=>$extraparams, 'source'=>$source));
        }
        // now the active filters
    }

    /**
     * Creates known filter if present
     * @param string $fieldname
     * @param boolean $advanced
     * @return object filter
     */
    function get_field($fieldname, $fieldquery, $advanced) {
        global $USER, $CFG, $SITE;
        require_once($CFG->dirroot.'/course/lib.php');

        switch ($fieldname) {
            //TODO finish adding field query to arguments
            case 'user-lastname':    return new filter_text($fieldname, get_string('lastname'), $advanced, $fieldname, $fieldquery);
            case 'user-firstname':    return new filter_text($fieldname, get_string('firstname'), $advanced, $fieldname, $fieldquery);
            case 'user-fullname':    return new filter_text($fieldname, get_string('fullname'), $advanced, $fieldname, $fieldquery);
            case 'course-fullname':       return new filter_text($fieldname, 'Course name', $advanced, $fieldname, $fieldquery);
            case 'course_category-id':
                //TODO available categories should be limited to users capabilities - is possible with this function
                make_categories_list($cats, $unused);
                return new filter_select($fieldname, 'Course category', $advanced, $fieldname, $fieldquery, $cats);
            case 'course_completion-completeddate': return new filter_date($fieldname, 'Completed Date', $advanced, $fieldname, $fieldquery);
                /*
            case 'user_profile':     return new filter_profilefield($fieldname, get_string('profile'), $fieldquery, $advanced);
            case 'confirmed':   return new filter_yesno('confirmed', get_string('confirmed', 'admin'), $advanced, 'confirmed');
            case 'courserole':  return new filter_courserole('courserole', get_string('courserole', 'filters'), $advanced);
            case 'systemrole':  return new filter_globalrole('systemrole', get_string('globalrole', 'role'), $advanced);
            case 'lastaccess':  return new filter_date('lastaccess', get_string('lastaccess'), $advanced, 'lastaccess');
            case 'lastlogin':   return new filter_date('lastlogin', get_string('lastlogin'), $advanced, 'lastlogin');
            case 'auth':
                $plugins = get_list_of_plugins('auth');
                $choices = array();
                foreach ($plugins as $auth) {
                    $choices[$auth] = auth_get_plugin_title ($auth);
                }
                return new filter_simpleselect('auth', get_string('authentication'), $advanced, 'auth', $choices);

            case 'mnethostid':
                // include all hosts even those deleted or otherwise problematic
                if (!$hosts = get_records('mnet_host', '', '', 'id', 'id, wwwroot, name')) {
                    $hosts = array();
                }
                $choices = array();
                foreach ($hosts as $host) {
                    if ($host->id == $CFG->mnet_localhost_id) {
                        $choices[$host->id] =  format_string($SITE->fullname).' ('.get_string('local').')';
                    } else if (empty($host->wwwroot)) {
                        // All hosts
                        continue;
                    } else {
                        $choices[$host->id] = $host->name.' ('.$host->wwwroot.')';
                    }
                }
                if ($usedhosts = get_fieldset_sql("SELECT DISTINCT mnethostid FROM {$CFG->prefix}user WHERE deleted=0")) {
                    foreach ($usedhosts as $hostid) {
                        if (empty($hosts[$hostid])) {
                            $choices[$hostid] = 'id: '.$hostid.' ('.get_string('error').')';
                        }
                    }
                }
                if (count($choices) < 2) {
                    return null; // filter not needed
                }
                return new filter_simpleselect('mnethostid', 'mnethostid', $advanced, 'mnethostid', $choices);
                 */
            default:            return null;
        }
    }

    /**
     * Returns sql where statement based on active filters
     * @param string $extra sql
     * @return string
     */
    function get_sql_filter($extra='') {
        global $SESSION;

        $sqls = array();
        if ($extra != '') {
            $sqls[] = $extra;
        }

        $filtername = 'filtering_'.$this->_source;

        if (!empty($SESSION->{$filtername})) {
            foreach ($SESSION->{$filtername} as $fname=>$datas) {
                if (!array_key_exists($fname, $this->_fields)) {
                    continue; // filter not used
                }
                $field = $this->_fields[$fname];
                foreach($datas as $i=>$data) {
                    $sqls[] = $field->get_sql_filter($data, $this->_source);
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

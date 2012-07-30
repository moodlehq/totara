<?php //$Id$

require_once($CFG->dirroot.'/totara/reportbuilder/filters/lib.php');

/**
 * Filter based on selecting multiple cohorts via a dialog
 */
class filter_cohort extends filter_type {

    /**
     * Constructor
     * @param object $filter rb_filter object for this filter
     * @param string $sessionname Unique name for the report for storing sessions
     */
    function filter_cohort($filter, $sessionname) {
        parent::filter_type($filter, $sessionname);
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

        $mform->addElement('static', $this->_name.'_list', $label,
            // container for currently selected cohorts
            '<div class="list-' . $this->_name . '">' .
            '</div>' . display_add_cohort_link($this->_name));

        if ($advanced) {
            $mform->setAdvanced($this->_name.'_list');
        }

        $mform->addElement('hidden', $this->_name, '');
        $mform->setType($this->_name, PARAM_SEQUENCE);

        if (array_key_exists($this->_name, $SESSION->{$sessionname})) {
            $defaults = $SESSION->{$sessionname}[$this->_name];
        }

        if (isset($defaults[0]['value'])) {
            $mform->setDefault($this->_name, $defaults[0]['value']);
        }

    }

    function definition_after_data(&$mform) {
        global $DB;
        if ($ids = $mform->getElementValue($this->_name)) {

            if ($cohorts = $DB->get_records_select('cohort', "id IN ($ids)")) {
                $out = html_writer::start_tag('div', array('class' => "list-".$this->_name));
                foreach ($cohorts as $cohort) {
                    $out .= display_selected_cohort_item($cohort, $this->_name);
                }
                $out .= html_writer::end_tag('div');

                // link to add cohorts
                $out .= display_add_cohort_link($this->_name);

                $mform->setDefault($this->_name.'_list', $out);
            }
        }
    }

    /**
     * Retrieves data from the form data
     * @param object $formdata data submited with the form
     * @return mixed array filter data or false when filter not set
     */
    function check_data($formdata) {
        $field    = $this->_name;

        if (array_key_exists($field, $formdata) && !empty($formdata->$field) ) {
            return array('value'    => $formdata->$field);
        }

        return false;
    }

    /**
     * Returns the condition to be used with SQL where
     * @param array $data filter settings
     * @return string the filtering condition or null if the filter is disabled
     */
    function get_sql_filter($data) {
        $items    = $data['value'];
        $items    = explode(',', $items);
        $query    = $this->_filter->get_field();

        // don't filter if none selected
        if (empty($items)) {
            // return 1=1 instead of TRUE for MSSQL support
            return array(' 1=1 ', array());
        }

        // split by comma and look for any items
        // within list
        $res = array();
        if (is_array($items)) {
            foreach ($items as $id) {
                $res[] = "( $query = '$id' OR " .
                    "$query LIKE '%|$id' OR " .
                    "$query LIKE '$id|%' OR " .
                    "$query LIKE '%|$id|%' )\n";
            }
        }

        // none selected - match everything
        if (count($res) == 0) {
            // using 1=1 instead of TRUE for MSSQL support
            return array(' 1=1 ', array());;
        }

        // combine with OR logic (match any cohort)
        return array('(' . implode(' OR ', $res) . ')', array());
    }

    /**
     * Returns a human friendly description of the filter used as label.
     * @param array $data filter settings
     * @return string active filter label
     */
    function get_label($data) {
        global $DB;
        $value     = $data['value'];
        $label = $this->_filter->label;

        if (empty($value)) {
            return '';
        }

        $a = new object();
        $a->label    = $label;

        $selected = array();
        if ($cohorts = $DB->get_records_select('cohort', "id IN ($value)")) {
            foreach ($cohorts as $cohort) {
                $selected[] = '"' . format_string($cohort->name) . '"';
            }
        }

        $orstring = get_string('or', 'totara_reportbuilder');
        $a->value    = implode($orstring, $selected);

        return get_string('selectlabelnoop', 'filters', $a);
    }
}

/**
 * Given a cohort object returns the HTML to display it as a filter selection
 *
 * @param object $cohort A cohort object containing id and name properties
 * @param string $filtername The identifying name of the current filter
 *
 * @return string HTML to display a selected item
 */
function display_selected_cohort_item($cohort, $filtername) {
    global $OUTPUT;
    $strdelete = get_string('delete');
    $out = html_writer::start_tag('div', array('data-filtername' => $filtername,
                                               'data-id' => $cohort->id,
                                               'class' => 'multiselect-selected-item'));
    $out .= format_string($cohort->name);
    $out .= html_writer::link('#', html_writer::empty_tag('img', array('src' => $OUTPUT->pix_url('t/delete'),
                                                          'alt' => $strdelete,
                                                          'class' => 'delete-icon')), array('title' => $strdelete));
    $out .= html_writer::end_tag('div');
    return $out;
}

/**
 * Helper function to display the 'add cohorts' link to the filter
 *
 * @param string $filtername Name of the form element
 *
 * @return string HTML to display the link
 */
function display_add_cohort_link($filtername) {
    return html_writer::start_tag('div', array('class' => 'rb-cohort-add-link')) .
           html_writer::link('#', get_string('addcohorts', 'totara_reportbuilder'), array('id' => 'show-'.$filtername.'-dialog')) .
           html_writer::end_tag('div');
}

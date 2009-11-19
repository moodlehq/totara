<?php // $Id$

class customfield_checkbox extends customfield_base {

    /**
     * Constructor method.
     * Pulls out the options for the checkbox from the database and sets the
     * the corresponding key for the data if it exists
     */
    function customfield_checkbox($fieldid=0, $itemid=0, $type, $tableprefix) {
        //first call parent constructor
        $this->customfield_base($fieldid, $itemid, $type, $tableprefix);

        if (!empty($this->field)) {
            $datafield = get_field($tableprefix.'_info_data', 'data', $type.'id', $itemid, 'fieldid', $this->fieldid);
            if ($datafield !== false) {
                $this->data = $datafield;
            } else {
                $this->data = $this->field->defaultdata;
            }
        }
    }

    function edit_field_add(&$mform) {
        /// Create the form field
        $checkbox = &$mform->addElement('advcheckbox', $this->inputname, format_string($this->field->fullname));
        if ($this->data == '1') {
            $checkbox->setChecked(true);
        }        
        $mform->setType($this->inputname, PARAM_BOOL);
        if ($this->is_required()) {
            $mform->addRule($this->inputname, get_string('required'), 'nonzero', null, 'client');
        }
    }

    /**
     * Display the data for this field
     */
    function display_data() {
        $options->para = false;
        $checked = intval($this->data) === 1 ? 'checked="checked"' : '';
        return '<input disabled="disabled" type="checkbox" name="'.$this->inputname.'" '.$checked.' />';
    }

}

?>

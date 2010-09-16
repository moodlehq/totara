<?php //$Id$

class customfield_file extends customfield_base {
    function edit_field_add(&$mform) {
        $size = $this->field->param1;
        $maxlength = $this->field->param2;
        $fieldtype = ($this->field->param3 == 1 ? 'password' : 'text');

        /// Create the file picker
        $mform->addElement('choosecoursefileorimsrepo', $this->inputname, format_string($this->field->fullname));
        $mform->setType($this->inputname, PARAM_RAW);  // We need to find a better PARAM
    }

    function edit_field_set_locked(&$mform) {
        if (!$mform->elementExists($this->inputname)) {
            return;
        }
        if ($this->is_locked()) {
            $mform->hardFreeze($this->inputname);
            $mform->disabledif($this->inputname, 1);
            $mform->setConstant($this->inputname, $this->data);
        }
    }
}
?>

<?php //$Id$

class customfield_text extends customfield_base {

    function edit_field_add(&$mform) {
        $size = $this->field->param1;
        $maxlength = $this->field->param2;
        $fieldtype = ($this->field->param3 == 1 ? 'password' : 'text');

        /// Create the form field
        $mform->addElement($fieldtype, $this->inputname, format_string($this->field->fullname), 'maxlength="'.$maxlength.'" size="'.$size.'" ');
        $mform->setType($this->inputname, PARAM_MULTILANG);
    }

}

?>

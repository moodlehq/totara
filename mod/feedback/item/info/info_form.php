<?php

require_once $CFG->libdir.'/formslib.php';

class feedback_info_form extends moodleform {
    var $type = "info";
    var $requiredcheck;
    var $itemname;
    var $infotype;
    
    function definition() {
        $mform =& $this->_form;
        
        $mform->addElement('header', 'general', get_string($this->type, 'feedback'));
        $this->requiredcheck = &$mform->addElement('hidden', 'required');
        
        $this->itemname = &$mform->addElement('text', 'itemname', get_string('item_name', 'feedback'), array('size="80"','maxlength="255"'));
        
        $options=array();
        $options[1]  = get_string('responsetime', 'feedback');
        $options[2]  = get_string('coursename', 'feedback');
        $options[3]  = get_string('coursecategory', 'feedback');
        $this->infotype = &$mform->addElement('select', 'infotype', get_string('infotype', 'feedback'), $options);

    }
}
?>

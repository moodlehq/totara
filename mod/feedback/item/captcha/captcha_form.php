<?php

require_once $CFG->libdir.'/formslib.php';

class feedback_captcha_form extends moodleform {
    var $type = "captcha";
    var $requiredcheck;
    var $itemname;
    var $select;
    
    function definition() {
        $mform =& $this->_form;
        
        $mform->addElement('header', 'general', get_string($this->type, 'feedback'));
        $this->requiredcheck = &$mform->addElement('checkbox', 'required', get_string('required', 'feedback'));
        
        $this->itemname = &$mform->addElement('text', 'itemname', get_string('item_name', 'feedback'), array('size="80"','maxlength="255"'));
        
    
        $numlist = array();
        for($i = 3; $i <= 10; $i++) {
            $numlist[$i] = $i;
        }
        $this->select = &$mform->addElement('select',
                                            'count_of_nums', 
                                            get_string('count_of_nums', 'feedback').'&nbsp;', 
                                            $numlist);
        
    }
}
?>

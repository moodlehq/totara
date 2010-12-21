<?php

require_once $CFG->libdir.'/formslib.php';

class feedback_textarea_form extends moodleform {
    var $type = "textarea";
    var $requiredcheck;
    var $itemname;
    var $selectwith;
    var $selectheight;
    
    function definition() {
        $mform =& $this->_form;

        $numlist = array();
        
        $mform->addElement('header', 'general', get_string($this->type, 'feedback'));
        $this->requiredcheck = &$mform->addElement('checkbox', 'required', get_string('required', 'feedback'));
        
        $this->itemname = &$mform->addElement('text', 'itemname', get_string('item_name', 'feedback'), array('size="80"','maxlength="255"'));
        
        for($i = 5; $i <= 80; $i++) {
            $numlist[$i] = $i;
        }
        $this->selectwith = &$mform->addElement('select',
                                            'itemwidth', 
                                            get_string('textarea_width', 'feedback').'&nbsp;', 
                                            $numlist);

        for($i = 5; $i <= 40; $i++) {
            $numlist[$i] = $i;
        }
        $this->selectheight = &$mform->addElement('select',
                                            'itemheight', 
                                            get_string('textarea_height', 'feedback').'&nbsp;', 
                                            $numlist);

    }
}
?>

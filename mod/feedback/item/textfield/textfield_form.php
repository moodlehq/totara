<?php

require_once $CFG->libdir.'/formslib.php';

class feedback_textfield_form extends moodleform {
    var $type = "textfield";
    var $requiredcheck;
    var $itemname;
    var $selectwith;
    var $selectheight;
    
    function definition() {
        $mform =& $this->_form;
        
        $mform->addElement('header', 'general', get_string($this->type, 'feedback'));
        $this->requiredcheck = &$mform->addElement('checkbox', 'required', get_string('required', 'feedback'));
        
        $this->itemname = &$mform->addElement('text', 'itemname', get_string('item_name', 'feedback'), array('size="80"','maxlength="255"'));
        
    
        $numlist = array();
        for($i = 5; $i <= 255; $i++) {
            $numlist[$i] = $i;
        }
        $this->selectwith = &$mform->addElement('select',
                                            'itemsize', 
                                            get_string('textfield_size', 'feedback').'&nbsp;', 
                                            $numlist);

        $numlist = array();
        for($i = 5; $i <= 255; $i++) {
            $numlist[$i] = $i;
        }
        $this->selectheight = &$mform->addElement('select',
                                            'itemmaxlength', 
                                            get_string('textfield_maxlength', 'feedback').'&nbsp;', 
                                            $numlist);

    }
}
?>

<?php
require_once($CFG->libdir.'/formslib.php');

class hierarchyrestore_pickfile_form extends moodleform {

    function definition() {
        $mform =& $this->_form;
        $filelist = $this->_customdata['filelist'];

        if(count($filelist) == 1) {
            $file = array_shift($filelist);
            $mform->addElement('hidden', 'file', $file);
            $mform->addElement('html', "Would you like to restore the file $file ?");
            $this->add_action_buttons(false, 'Confirm');
        } else if (count($filelist) > 0) {
            $mform->addElement('select', 'file', 'Pick a file to restore', $filelist);
            $this->add_action_buttons(false, 'Confirm');
        }
    }
}

class hierarchyrestore_chooseitems_form extends moodleform {

    function definition() {
        $mform =& $this->_form;
        $contents = $this->_customdata['contents'];

        foreach ($contents AS $hname => $hierarchy) {
            $mform->addElement('header', $hname.'restore', get_string($hname, $hname).' Restore');
            foreach ($hierarchy AS $fwid => $framework) {
                $fwfield = "framework$fwid";
                $itemcount = $framework->itemcount;
                $fwname = $framework->fullname;
                $label = "$fwname ($itemcount ".get_string("{$hname}plural",$hname).")";
                $mform->addElement('checkbox',"framework[$hname][$fwid]", '', $label);
                $mform->setDefault("framework[$hname][$fwid]",1);
            }
        } 
    }



}

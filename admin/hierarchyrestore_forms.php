<?php
require_once($CFG->libdir.'/formslib.php');

class hierarchyrestore_pickfile_form extends moodleform {

    function definition() {
        global $CFG;

        $mform =& $this->_form;
        $filelist = $this->_customdata['filelist'];

        if(count($filelist) == 1) {
            $file = array_shift($filelist);
            $mform->addElement('hidden', 'file', $file);
            $mform->addElement('html', get_string('pickfilehelp','hierarchy', "$CFG->dataroot/hierarchies"));
            $mform->addElement('html', "<br /><br />One file found. Would you like to restore the file $file ?");
            $this->add_action_buttons(false, 'Confirm');
        } else if (count($filelist) > 0) {
            $mform->addElement('html', get_string('pickfilehelp', 'hierarchy', "$CFG->dataroot/hierarchies"));
            $mform->addElement('select', 'file', 'Pick a file to restore', $filelist);
            $this->add_action_buttons(false, 'Confirm');
        }
    }
}

class hierarchyrestore_chooseitems_form extends moodleform {

    function definition() {
        $mform =& $this->_form;
        $contents = $this->_customdata['contents'];
        $usercount = $this->_customdata['usercount'];

        // general hierarchy restore options go here
        // TODO if no options other than usercount, only show header if section required
        $mform->addElement('header', 'hierarchyrestore', 'Hierarchy Restore');
        if($usercount > 0) {
            $mform->addElement('static','usercount', '', "$usercount Users found to restore.");
            $mform->addElement('selectyesno','inc_users','Restore users and user data');
        }
        else {
            $mform->addElement('static','usercount', '', 'No users found to restore.');
        }
        foreach ($contents AS $hname => $hierarchy) {
            $mform->addElement('header', $hname.'restore', get_string($hname, $hname).' Restore');
            $mform->addElement('static','message','Select which frameworks to restore','[Put checkbox controller here]');
            foreach ($hierarchy AS $fwid => $framework) {
                $fwfield = "framework$fwid";
                $itemcount = $framework->itemcount;
                $fwname = $framework->fullname;
                $label = "$fwname ($itemcount ".get_string("{$hname}plural",$hname).")";
                $mform->addElement('checkbox',"framework[$hname][$fwid]", '', $label);
                $mform->setDefault("framework[$hname][$fwid]",1);
            }
        }
        $this->add_action_buttons();
    }



}

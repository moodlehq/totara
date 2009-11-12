<?php
require_once($CFG->libdir.'/formslib.php');

class hierarchyrestore_pickfile_form extends moodleform {

    function definition() {
        global $CFG;

        $mform =& $this->_form;
        $filelist = $this->_customdata['filelist'];

        // action for next page
        $mform->addElement('hidden','action','selectoptions');

        if(count($filelist) == 1) {
            // only one file available
            $file = array_shift($filelist);
            $mform->addElement('hidden', 'file', $file);
            $mform->addElement('html', '<p>' . get_string('pickfileone', 'hierarchy', $file) . '</p>');
            $mform->addElement('html','<p>' . get_string('pickfilehelp','hierarchy', "$CFG->dataroot/hierarchies") . '</p>');
        } else if (count($filelist) > 0) {
            // multiple possible files - choose with select box
            $mform->addElement('html', get_string('pickfilehelp', 'hierarchy', "$CFG->dataroot/hierarchies"));
            $mform->addElement('select', 'file', get_string('pickfilemultiple','hierarchy'), $filelist);
        }
        $this->add_action_buttons(false, get_string('continue'));

    }
}

class hierarchyrestore_chooseitems_form extends moodleform {

    function definition() {
        $mform =& $this->_form;
        $contents = $this->_customdata['contents'];

        $mform->addElement('hidden','action','execute');
        // general hierarchy restore options go here
        // TODO if no options other than usercount, only show header if section required
        $mform->addElement('header', 'hierarchyrestore', 'Hierarchy Restore');
        if($contents->options->usercount > 0) {
            $mform->addElement('static','usercount', '', "{$contents->options->usercount} Users found to restore.");
            $mform->addElement('selectyesno','inc_users','Restore users and user data');
        }
        else {
            $mform->addElement('static','usercount', '', 'No users found to restore.');
        }
        $hierarchies = get_backup_list();
        foreach ($hierarchies as $hname) {
            if(!isset($contents->$hname)) {
                // TODO put in as a developer debug message?
                //print "Hierarchy $hname not found in zip";
                continue;
            }

            $mform->addElement('header', $hname.'restore', get_string($hname, $hname).' Restore');
            $mform->addElement('static','message','Select which frameworks to restore','[Put checkbox controller here]');
            foreach ($contents->$hname->frameworks AS $fwid => $framework) {
                $itemcount = $framework->itemcount;
                $fwname = $framework->fullname;
                $label = "$fwname ($itemcount ".get_string("{$hname}plural",$hname).")";
                $mform->addElement('checkbox',"hierarchy[$hname][$fwid]", '', $label);
                $mform->setDefault("hierarchy[$hname][$fwid]",1);
            }
            if(isset($contents->$hname->options)) {
                $options = $contents->$hname->options;
                $mform->addElement('header', $hname.'restoreoptions', get_string($hname, $hname).' Restore Additional Options');
                foreach ($options AS $opname => $option) {
                    if ($option->exists) {
                        $mform->addElement('selectyesno',"options[$hname][$opname]", $option->label);
                        $mform->setDefault("options[$hname][$opname]", $option->default);
                        // matching options go here?
                    }
                }
            }
            $mform->addElement('hidden','backup_unique_code',$contents->backup_unique_code);

        }
        $this->add_action_buttons();
    }



}

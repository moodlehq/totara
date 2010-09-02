<?php
require_once($CFG->libdir.'/formslib.php');

class hierarchybackup_select_form extends moodleform {
//TODO help buttons for all forms
    function definition() {
        $mform =& $this->_form;
        $hlist = $this->_customdata['hlist'];
        $frameworks = $this->_customdata['frameworks'];
        $items = $this->_customdata['items'];

        $mform->addElement('header','hierarchybackup','Hierarchy Backup');
        $mform->addElement('text','backupfilename','Name',array('size'=>'40'));
        $mform->setType('backupfilename', PARAM_TEXT);
        $backup_filename = 'hierarchy-backup-'.userdate(time(),"%Y%m%d-%H%M",99,false).'.zip';
        $mform->setDefault('backupfilename',$backup_filename);
        $mform->addElement('selectyesno', 'userdata', 'Include users and user data');
        //$mform->setDefault('userdata', 1);

        if(!empty($hlist)) {
            $i = 0;
            foreach($hlist AS $hname) {
                $i++;

                // skip this hierarchy if no frameworks found
                if(!$frameworks->$hname) {
                    continue;
                }

                $mform->addElement('header',$hname.'backup', get_string($hname, $hname).' Backup');
                $first = true;
                $mform->addElement('static','message','Select which frameworks to backup','');
                $this->add_checkbox_controller($i,'',array(),1);
                foreach($frameworks->$hname AS $fwid => $framework) {
                    $fwname = "framework$fwid";
                    $itemcount = $items->$hname->$fwname->items_count;
                    $label = "{$framework->fullname} ({$itemcount} ".get_string("{$hname}plural",$hname).")";
                    $mform->addElement('advcheckbox',"frameworks[$hname][$framework->id]", '', $label, array('group'=>$i));
                    $mform->setDefault("frameworks[$hname][$framework->id]",1);
                }

               $setoptionsfunc = $hname.'_options';
                if(function_exists($setoptionsfunc)) {
                    $mform->addElement('header',$hname.'extraoptions',get_string($hname, $hname).' Additional Options');
                    $options = $setoptionsfunc();
                    foreach ($options AS $option) {
                        $mform->addElement($option['type'], $option['name'], $option['label']);
                        $mform->setType($option['name'], PARAM_RAW);
                        $mform->setDefault($option['name'], $option['default']);
                    }
                }
            }
        }
        $this->add_action_buttons();
    }

}
class hierarchybackup_check_form extends moodleform {

    function definition() {
        $mform =& $this->_form;
        $mform->addElement('header','hierarchybackup','Hierarchy Backup');
        $mform->addElement('submit','check','Submit Check');
    }
}


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
        $backup_filename = 'hierarchy-backup-'.userdate(time(),"%Y%m%d-%H%M",99,false).'.zip';
        $mform->setDefault('backupfilename',$backup_filename);
        $mform->addElement('selectyesno', 'userdata', 'Include users and user data');
        //$mform->setDefault('userdata', 1);

        if(!empty($hlist)) {
            foreach($hlist AS $hname) {
                $mform->addElement('header',$hname.'backup', get_string($hname, $hname).' Backup');
                //TODO add checkbox controller
                $first = true;
                $mform->addElement('static','message','Select which frameworks to backup','[Put checkbox controller here]');
                foreach($frameworks->$hname AS $fwid => $framework) {
                    $fwname = "framework$fwid";
                    $itemcount = $items->$hname->$fwname->items_count;
                    //$mform->addElement('html','<table class="hierarchyform">');
                    //$mform->addElement('html','<tr><td>');
                    $label = "{$framework->fullname} ({$itemcount} ".get_string("{$hname}plural",$hname).")";
                    $mform->addElement('checkbox',"frameworks[$hname][$framework->id]", '', $label);
                    $mform->setDefault("frameworks[$hname][$framework->id]",1);
                    //$mform->addElement('html','</td></tr>');

                //$mform->addElement('html','</table>');
                }

                $setoptionsfunc = $hname.'_set_extra_options';
                if(function_exists($setoptionsfunc)) {
                    $mform->addElement('header',$hname.'extraoptions',get_string($hname, $hname).' Additional Options');
                    $setoptionsfunc($mform);
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


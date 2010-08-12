<?php

require_once "$CFG->dirroot/lib/formslib.php";

class report_builder_export_form extends moodleform {

    function definition() {
        global $REPORT_BUILDER_EXPORT_OPTIONS;
        $mform =& $this->_form;

        $exportoptions = get_config('reportbuilder', 'exportoptions');
        $select = array();
        foreach($REPORT_BUILDER_EXPORT_OPTIONS as $option => $code) {
            // bitwise operator to see if option bit is set
            if(($exportoptions & $code) == $code) {
                $select[$option] = get_string('export'.$option,'local');
            }
        }
        if(count($select) == 0) {
            // no export options - don't show form
            return false;
        } else if (count($select) == 1) {
            // no options - show a button
            $mform->addElement('hidden', 'format', key($select));
            $mform->addElement('submit', 'export', current($select));
        } else {
            // show pulldown menu
            $group=array();
            $group[] =& $mform->createElement('select','format', null, $select);
            $group[] =& $mform->createElement('submit', 'export', get_string('export','local'));
            $mform->addGroup($group, 'exportgroup', '', array(' '), false);
        }


    }

}



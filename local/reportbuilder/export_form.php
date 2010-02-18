<?php

require_once "$CFG->dirroot/lib/formslib.php";

class report_builder_export_form extends moodleform {

    function definition() {

        $mform =& $this->_form;

        $select = array('xls' => get_string('exportxls','local'), 'csv' => get_string('exportcsv','local'), 'ods' => get_string('exportods','local'));
        $group=array();
        $group[] =& $mform->createElement('select','format', null, $select);
        $group[] =& $mform->createElement('submit', 'export', get_string('export','local'));
        $mform->addGroup($group, 'exportgroup', '', array(' '), false);

    }

}



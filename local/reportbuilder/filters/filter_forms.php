<?php //$Id$

require_once($CFG->libdir.'/formslib.php');

class add_filter_form extends moodleform {

    function definition() {
        global $SESSION;
        $mform       =& $this->_form;
        $fields      = $this->_customdata['fields'];
        $extraparams = $this->_customdata['extraparams'];
        $shortname      = $this->_customdata['shortname'];
        $filtername = 'filtering_'.$shortname;

        if($fields && is_array($fields) && count($fields) > 0) {
            $mform->addElement('header', 'newfilter', get_string('searchby','local'));

            foreach($fields as $ft) {
                $ft->setupForm($mform);
            }

            // in case we wasnt to track some page params
            if ($extraparams) {
                foreach ($extraparams as $key=>$value) {
                    $mform->addElement('hidden', $key, $value);
                    $mform->setType($key, PARAM_RAW);
                }
            }

            $mform->addElement('html','<br />');
            $mform->addElement('html','<table align="center"><tr><td align="left">');

            // Add button
            $mform->addElement('submit', 'addfilter', get_string('search','local'));

            $mform->addElement('html','</td><td align="right">');

            // clear form button
            $mform->addElement('submit', 'clearfilter', get_string('clearform','local'));

            $mform->addElement('html','</td></tr></table>');

            // Don't use last advanced state
            $mform->setShowAdvanced(false);
        }
    }

    function definition_after_data() {
        $mform       =& $this->_form;
        $fields      = $this->_customdata['fields'];

        if($fields && is_array($fields) && count($fields) > 0) {

            foreach($fields as $ft) {
                if(method_exists($ft, 'definition_after_data')) {
                    $ft->definition_after_data($mform);
                }
            }
        }
    }
}

/*
 * This form is no longer used as the filter behaves more like 
 * a search form now. Left in in-case someone decides they would
 * prefer a filter interface
 */
class active_filter_form extends moodleform {

    function definition() {
        global $SESSION; // this is very hacky :-(

        $mform       =& $this->_form;
        $fields      = $this->_customdata['fields'];
        $extraparams = $this->_customdata['extraparams'];
        $shortname      = $this->_customdata['shortname'];
        $filtername = 'filtering_'.$shortname;

        if (!empty($SESSION->{$filtername})) {
            // add controls for each active filter in the active filters group
            $mform->addElement('header', 'actfilterhdr', get_string('actfilterhdr','filters'));

            foreach ($SESSION->{$filtername} as $fname=>$datas) {
                if (!array_key_exists($fname, $fields)) {
                    continue; // filter not used
                }
                $field = $fields[$fname];
                foreach($datas as $i=>$data) {
                    $description = $field->get_label($data);
                    $mform->addElement('checkbox', 'filter['.$fname.']['.$i.']', null, $description);
                }
            }

            $mform->addElement('hidden','shortname',$shortname);
            $mform->setType('shortname', PARAM_TEXT);

            if ($extraparams) {
                foreach ($extraparams as $key=>$value) {
                    $mform->addElement('hidden', $key, $value);
                    $mform->setType($key, PARAM_RAW);
                }
            }

            $objs = array();
            $objs[] = &$mform->createElement('submit', 'removeselected', get_string('removeselected','filters'));
            $objs[] = &$mform->createElement('submit', 'removeall', get_string('removeall','filters'));
            $mform->addElement('group', 'actfiltergrp', '', $objs, ' ', false);
        }
    }
}

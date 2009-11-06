<?php //$Id$

require_once($CFG->libdir.'/formslib.php');

class hierarchy_add_filter_form extends moodleform {

    function definition() {
        $mform       =& $this->_form;
        $fields      = $this->_customdata['fields'];
        $extraparams = $this->_customdata['extraparams'];
        $type        = $this->_customdata['type'];

        $mform->addElement('header', 'newfilter', get_string('newfilter','filters'));

        foreach($fields as $ft) {
            $ft->setupForm($mform, $type);
        }

        // in case we wasnt to track some page params
        if ($extraparams) {
            foreach ($extraparams as $key=>$value) {
                $mform->addElement('hidden', $key, $value);
            }
        }

        // Add the hierarchy prefix and type
        $mform->addElement('hidden', 'type', $type);

        // Add button
        $mform->addElement('submit', 'addfilter', get_string('addfilter','filters'));

        // Don't use last advanced state
        $mform->setShowAdvanced(false);
    }
}

class hierarchy_active_filter_form extends moodleform {

    function definition() {
        global $SESSION; // this is very hacky :-(

        $mform       =& $this->_form;
        $fields      = $this->_customdata['fields'];
        $extraparams = $this->_customdata['extraparams'];
        $type        = $this->_customdata['type'];
        $filtername  = $type.'_filtering';

        if (!empty($SESSION->{$filtername})) {
            // add controls for each active filter in the active filters group
            $mform->addElement('header', 'actfilterhdr', get_string('actfilterhdr','filters'));

            foreach ($SESSION->{$filtername} as $fname=>$datas) {
                if (!array_key_exists($fname, $fields)) {
                    continue; // filter not used
                }
                $field = $fields[$fname];
                foreach($datas as $i=>$data) {
                    $description = $field->get_label($data, $type);
                    $mform->addElement('checkbox', 'filter['.$fname.']['.$i.']', null, $description);
                }
            }

            if ($extraparams) {
                foreach ($extraparams as $key=>$value) {
                    $mform->addElement('hidden', $key, $value);
                }
            }

            // Add the hierarchy prefix and type
            $mform->addElement('hidden', 'type', $type);

            $objs = array();
            $objs[] = &$mform->createElement('submit', 'removeselected', get_string('removeselected','filters'));
            $objs[] = &$mform->createElement('submit', 'removeall', get_string('removeall','filters'));
            $mform->addElement('group', 'actfiltergrp', '', $objs, ' ', false);
        }
    }
}

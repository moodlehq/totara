<?php

require_once "$CFG->dirroot/lib/formslib.php";

class learning_reports_new_form extends moodleform {

    function definition() {

        $mform =& $this->_form;

        $mform->addElement('header', 'general', get_string('newreport', 'local'));
        $sources = learningreports_get_options_from_dir('sources');
        if(count($sources)>0) {

            $mform->addElement('text', 'fullname', get_string('reportname', 'local'), 'maxlength="255"');
            $mform->setType('fullname', PARAM_TEXT);

            $mform->addElement('text', 'shortname', get_string('reportshortname', 'local'), 'maxlength="255"');
            $mform->setType('shortname', PARAM_TEXT);

            $pick = array(0 => 'Select a source...');
            $select = array_merge($pick, $sources);
            $mform->addElement('select','source', get_string('source','local'), $select);
            // TODO invalid if not set
            //$mform->addRule('source', get_string('error:mustselectsource','local'), 'nonzero');

            $restrictions = learningreports_get_options_from_dir('restrictions');
            if(count($restrictions)>0) {
                $pick = array(0 => 'Select a restriction...');
                $select = array_merge($pick, $restrictions);
                $mform->addElement('select','restriction', get_string('restriction','local'), $select);
            } else {
                $mform->addElement('static','restriction', get_string('restriction','local'), get_string('error:norestrictions','local'));
            }
            $this->add_action_buttons();

        } else {
            $mform->addElement('html', get_string('error:nosources','local'));
        }
    }
}

class learning_reports_edit_form extends moodleform {
    function definition() {
        global $CFG;
        $mform =& $this->_form;
        $report = $this->_customdata['report'];
        $mform->addElement('header', 'general', get_string('filterfields', 'local'));

        $mform->addElement('html', '<table><tr><th>Filter</th><th>Advanced?</th><th>Options</th><tr>');
        $filtersselect = get_filters_select($report->source);

        if(isset($report->filters)) {
            $filters = unserialize($report->filters);
            if(is_array($filters)) {

                foreach($filters as $index => $filter) {
                    $row = array();
                    $type = $filter['type'];
                    $value = $filter['value'];
                    $field = "{$type}-{$value}";
                    $advanced = $filter['advanced'];
                    $filterid = $index;
                    $mform->addElement('html','<tr><td>');
                    $mform->addElement('select',"filter{$filterid}",'',$filtersselect);
                    $mform->setDefault("filter{$filterid}", $field);
                    $mform->addElement('html','</td><td>');
                    $mform->addElement('checkbox',"advanced{$filterid}",'');
                    $mform->setDefault("advanced{$filterid}",$advanced);
                    $mform->addElement('html','</td><td>');
                    $mform->addElement('html', '<a href="'.$CFG->wwwroot.'/local/learningreports/deletefilter.php?filterid='.$filterid.'">Delete</a>');
                    $mform->addElement('html','</td></tr>');
                }

            }
        }

        $mform->addElement('html','<tr><td>');
        $newfilterselect = array_merge(array(0=>'Add another filter...'),$filtersselect);
        $mform->addElement('select','newfilter','',$newfilterselect);
        $mform->addElement('html','</td><td>');
        $mform->addElement('checkbox','newadvanced','');
        $mform->disabledIf('newadvanced','newfilter', 'eq', 0);
        $mform->addElement('html','</td><td>');
        $mform->addElement('html','</td><td>&nbsp;</td></tr>');
        $mform->addElement('html','</table>');



        $mform->addElement('header', 'general', get_string('reportcolumns', 'local'));

        $mform->addElement('html', '<table><tr><th>Column</th><th>Heading</th><th>Options</th><tr>');
        $columnsselect = get_columns_select($report->source);

        if(isset($report->columns)) {
            $columns = unserialize($report->columns);
            if(is_array($columns)) {

                foreach($columns as $index => $column) {
                    $row = array();
                    $type = $column['type'];
                    $value = $column['value'];
                    $field = "{$type}-{$value}";
                    $heading = $column['heading'];
                    $columnid = $index;
                    $mform->addElement('html','<tr><td>');
                    $mform->addElement('select',"column{$columnid}",'',$columnsselect);
                    $mform->setDefault("column{$columnid}", $field);
                    $mform->addElement('html','</td><td>');
                    $mform->addElement('text',"heading{$columnid}",'');
                    $mform->setDefault("heading{$columnid}",$heading);
                    $mform->addElement('html','</td><td>');
                    $mform->addElement('html', '<a href="'.$CFG->wwwroot.'/local/learningreports/deletecolumn.php?columnid='.$columnid.'">Delete</a>');
                    $mform->addElement('html','</td></tr>');
                }

            }
        }

        $mform->addElement('html','<tr><td>');
        $newcolumnsselect = array_merge(array(0=>'Add another column...'),$columnsselect);
        $mform->addElement('select','newcolumns','',$newcolumnsselect);
        $mform->addElement('html','</td><td>');
        $mform->addElement('text','newheading','');
        $mform->disabledIf('newheading','newcolumns', 'eq', 0);
        $mform->addElement('html','</td><td>');
        $mform->addElement('html','</td><td>&nbsp;</td></tr>');
        $mform->addElement('html','</table>');


        $mform->addElement('hidden','id',$this->_customdata['id']);
        $this->add_action_buttons();
    }
}




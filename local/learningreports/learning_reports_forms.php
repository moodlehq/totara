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
            $mform->addRule('fullname',null,'required');

            $mform->addElement('text', 'shortname', get_string('reportshortname', 'local'), 'maxlength="255"');
            $mform->setType('shortname', PARAM_TEXT);
            $mform->addRule('shortname',null,'required');

            $pick = array(0 => get_string('selectsource','local'));
            $select = array_merge($pick, $sources);
            $mform->addElement('select','source', get_string('source','local'), $select);
            // TODO invalid if not set
            $mform->addRule('source', get_string('error:mustselectsource','local'), 'regex','/^[^0]*$/');

            $this->add_action_buttons();

        } else {
            $mform->addElement('html', get_string('error:nosources','local'));
        }
    }

    function validation($data) {
        return validate_shortname($data);
    }
}


class learning_reports_edit_form extends moodleform {
    function definition() {
        global $CFG;
        $mform =& $this->_form;
        $report = $this->_customdata['report'];
        $id = $this->_customdata['id'];

        $mform->addElement('header', 'general', get_string('reportsettings', 'local'));

        $mform->addElement('text', 'fullname', get_string('reporttitle','local'), array('size'=>'30'));
        $mform->setDefault('fullname', $report->_fullname);
        $mform->addRule('fullname',null,'required');
        $mform->addElement('text', 'shortname', get_string('uniquename','local'), array('size'=>'30'));
        $mform->setDefault('shortname', $report->_shortname);
        $mform->addRule('shortname',null,'required');
        $mform->addElement('static', 'reportsource', get_string('source','local'), $report->_source);

        $mform->addElement('header', 'general', get_string('filterfields', 'local'));

        $mform->addElement('html', '<div class="learningreportsform"><table><tr><th>'.get_string('filter','local').
            '</th><th>'.get_string('advanced','local').'</th><th>'.get_string('options','local').'</th><tr>');

        $filtersselect = $report->get_filters_select();

        $strmovedown = get_string('movedown','local');
        $strmoveup = get_string('moveup','local');
        $strdelete = get_string('delete','local');
        $spacer = '<img src="'.$CFG->wwwroot.'/pix/spacer.gif" class="iconsmall" alt="" />';

        if(isset($report->_filters)) {
            $filters = $report->_filters;
            if(is_array($filters)) {
                $filtercount = count($filters);
                $i = 1;
                foreach($filters as $index => $filter) {
                    $row = array();
                    $type = $filter['type'];
                    $value = $filter['value'];
                    $field = "{$type}-{$value}";
                    $advanced = $filter['advanced'];
                    $fid = $index;
                    $mform->addElement('html','<tr><td>');
                    $mform->addElement('select',"filter{$fid}",'',$filtersselect);
                    $mform->setDefault("filter{$fid}", $field);
                    $mform->addElement('html','</td><td>');
                    $mform->addElement('checkbox',"advanced{$fid}",'');
                    $mform->setDefault("advanced{$fid}",$advanced);
                    $mform->addElement('html','</td><td>');
                    $mform->addElement('html', '<a href="'.$CFG->wwwroot.'/local/learningreports/settings.php?d=1&amp;id='.$id.'&amp;fid='.$fid.'" title="'.$strdelete.'"><img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$strdelete.'" /></a>');
                    if($i != 1) {
                        $mform->addElement('html', '<a href="'.$CFG->wwwroot.'/local/learningreports/settings.php?m=up&amp;id='.$id.'&amp;fid='.$fid.'" title="'.$strmoveup.'"><img src="'.$CFG->pixpath.'/t/up.gif" class="iconsmall" alt="'.$strmoveup.'" /></a>');
                    } else {
                        $mform->addElement('html', $spacer);
                    }
                    if($i != $filtercount) {
                        $mform->addElement('html', '<a href="'.$CFG->wwwroot.'/local/learningreports/settings.php?m=down&amp;id='.$id.'&amp;fid='.$fid.'" title="'.$strmovedown.'"><img src="'.$CFG->pixpath.'/t/down.gif" class="iconsmall" alt="'.$strmovedown.'" /></a>');
                    } else {
                        $mform->addElement('html', $spacer);
                    }
                    $mform->addElement('html','</td></tr>');
                    $i++;
                }

            }
        }

        $mform->addElement('html','<tr><td>');
        $newfilterselect = array_merge(array(0=>get_string('addanotherfilter','local')),$filtersselect);
        $mform->addElement('select','newfilter','',$newfilterselect);
        $mform->addElement('html','</td><td>');
        $mform->addElement('checkbox','newadvanced','');
        $mform->disabledIf('newadvanced','newfilter', 'eq', 0);
        $mform->addElement('html','</td><td>');
        $mform->addElement('html','</td><td>&nbsp;</td></tr>');
        $mform->addElement('html','</table></div>');

        $mform->addElement('header', 'general', get_string('reportcolumns', 'local'));

        $mform->addElement('html', '<div class="learningreportsform"><table><tr><th>'.get_string('column','local').
            '</th><th>'.get_string('heading','local').'</th><th>'.get_string('options','local').'</th><tr>');

        $columnsselect = $report->get_columns_select();

        if(isset($report->_columns)) {
            $columns = $report->_columns;

            if(is_array($columns)) {
                $colcount = count($columns);
                $i = 1;
                foreach($columns as $index => $column) {
                    $row = array();
                    $type = $column['type'];
                    $value = $column['value'];
                    $field = "{$type}-{$value}";
                    $heading = $column['heading'];
                    $cid = $index;
                    $mform->addElement('html','<tr><td>');
                    $mform->addElement('select',"column{$cid}",'',$columnsselect);
                    $mform->setDefault("column{$cid}", $field);
                    $mform->addElement('html','</td><td>');
                    $mform->addElement('text',"heading{$cid}",'');
                    $mform->setDefault("heading{$cid}",$heading);
                    $mform->addElement('html','</td><td>');
                    // delete link
                    $mform->addElement('html', '<a href="'.$CFG->wwwroot.'/local/learningreports/settings.php?d=1&amp;id='.$id.'&amp;cid='.$cid.'" title="'.$strdelete.'"><img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$strdelete.'" /></a>');
                    // move up link
                    if($i != 1) {
                        $mform->addElement('html', '<a href="'.$CFG->wwwroot.'/local/learningreports/settings.php?m=up&amp;id='.$id.'&amp;cid='.$cid.'" title="'.$strmoveup.'"><img src="'.$CFG->pixpath.'/t/up.gif" class="iconsmall" alt="'.$strmoveup.'" /></a>');
                    } else {
                        $mform->addElement('html', $spacer);
                    }

                    // move down link
                    if($i != $filtercount) {
                        $mform->addElement('html', '<a href="'.$CFG->wwwroot.'/local/learningreports/settings.php?m=down&amp;id='.$id.'&amp;cid='.$cid.'" title="'.$strmovedown.'"><img src="'.$CFG->pixpath.'/t/down.gif" class="iconsmall" alt="'.$strmovedown.'" /></a>');
                    } else {
                        $mform->addElement('html', $spacer);
                    }

                    $mform->addElement('html','</td></tr>');
                    $i++;
                }

            }
        }

        $mform->addElement('html','<tr><td>');
        $newcolumnsselect = array_merge(array(0=>get_string('addanothercolumn','local')),$columnsselect);
        $mform->addElement('select','newcolumns','',$newcolumnsselect);
        $mform->addElement('html','</td><td>');
        $mform->addElement('text','newheading','');
        $mform->disabledIf('newheading','newcolumns', 'eq', 0);
        $mform->addElement('html','</td><td>');
        $mform->addElement('html','</td><td>&nbsp;</td></tr>');
        $mform->addElement('html','</table></div>');


        $mform->addElement('header', 'general', get_string('onlydisplayrecordsfor', 'local'));
        if(isset($report->_restrictionoptions) && is_array($report->_restrictionoptions)) {
            $restrictions = $report->_restrictionoptions;

            foreach($restrictions as $index => $restriction) {
                $mform->addElement('advcheckbox',"restriction$index",$restriction['title'],null,null,array(0,$restriction['funcname']));
                if($report->_restriction) {
                    foreach($report->_restriction as $res) {
                        if($restriction['funcname'] == $res['funcname']) {
                            $mform->setDefault("restriction$index",$res['funcname']);
                        }
                    }
                }
            }
            $mform->addElement('html',get_string('restrictionswarning','local'));
        } else {
            $mform->addElement('html',get_string('norestrictionsfound','local',$report->_source));
        }

        $mform->addElement('hidden','id',$this->_customdata['id']);
        $mform->addElement('hidden','source',$report->_source);
        $this->add_action_buttons();
    }


    function validation($data) {
        $err = array();
        $err += validate_shortname($data);
        $err += validate_unique_columns($data);
        return $err;
    }


}

// check shortname is unique in db
function validate_shortname($data) {
    $errors = array();

    if($foundreports = get_records('learning_report','shortname',$data['shortname'])) {
        if(!empty($data['id'])) {
            unset($foundreports[$data['id']]);
        }
        if(!empty($foundreports)) {
            $errors['shortname'] = get_string('shortnametaken','local');
        }
    }
    return $errors;

}

// check each column is only included once
// (breaks flexible table otherwise)
function validate_unique_columns($data) {
    $errors = array();
    $i = 0;
    $field = "column$i";
    $used_cols = array();
    while(isset($data[$field])) {
        if(array_key_exists($data[$field], $used_cols)) {
            $errors[$field] = get_string('norepeatcols','local');
        } else {
            $used_cols[$data[$field]] = 1;
        }
        $i++;
        $field = "column$i";
    }
    return $errors;
}



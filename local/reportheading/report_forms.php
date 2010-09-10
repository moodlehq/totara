<?php

require_once "$CFG->dirroot/lib/formslib.php";

class report_heading_columns_form extends moodleform {
    function definition() {
        global $CFG;
        $mform =& $this->_form;
        $heading = $this->_customdata['heading'];

        $strmovedown = get_string('movedown','local');
        $strmoveup = get_string('moveup','local');
        $strdelete = get_string('delete','local');
        $spacer = '<img src="'.$CFG->wwwroot.'/pix/spacer.gif" class="iconsmall" alt="" />';

        // javascript to update the heading columns.
        $onchange = array(
            'onChange' => "
                currentoption = this.options[this.selectedIndex].text;
                headid = 'id_heading'+this.name.substr(6);
                document.getElementById(headid).value = currentoption;
            ",
        );
        $newonchange = array(
            'onChange' => "
                heading = document.getElementById('id_newheading');
                defaultvalue = document.getElementById('id_newdefaultvalue');
                currentvalue = this.options[this.selectedIndex].value;
                if(currentvalue == 0) {
                    heading.value = '';
                    heading.disabled=true;
                    defaultvalue.disabled=true;
                } else {
                    heading.disabled=false;
                    defaultvalue.disabled=false;
                    heading.value = this.options[this.selectedIndex].text;
                }
            ",
        );

        $mform->addElement('header', 'reportheading', get_string('general'));
        $mform->setHelpButton('reportheading', array('reportheadinggeneral',get_string('reportheading','local'),'moodle'));

        $columnoptions = $heading->columnoptions;
        $items = $heading->items;
        $i = 1;
        $colcount = count($items);
        $mform->addElement('html', '<div class="reportheadingform"><table>');
        $mform->addElement('html','<tr><td colspan="4"><p>'.get_string('headingcolumnsdescription','local').'</p></td></tr>');
        if(count($items) <= 0) {
            $mform->addElement('html','<tr><td colspan="4"><p>'.get_string('noheadingcolumnsdefined','local_reportbuilder').'</p></td></tr>');
        }
        $mform->addElement('html','<tr><th>'.get_string('column','local').
            '</th><th>'.get_string('heading','local').'</th><th>'.get_string('headingmissingvalue','local').
            '</th><th>'.get_string('options','local').'</th></tr>');
        if(count($items) > 0) {

            foreach($items as $item) {
                $cid = $item->id;
                $type = $item->type;
                $heading = $item->heading;
                $defaultvalue = $item->defaultvalue;
                if(array_key_exists($type, $columnoptions)) {
                    $mform->addElement('html','<tr><td>');
                    $mform->addElement('select',"column{$cid}",'',$columnoptions, $onchange);
                    $mform->setDefault("column{$cid}", $type);
                    $mform->addElement('html','</td><td>');
                    $mform->addElement('text',"heading{$cid}",'');
                    $mform->setType("heading{$cid}", PARAM_TEXT);
                    $mform->addRule("heading{$cid}", null, 'required');
                    $mform->setDefault("heading{$cid}",$heading);
                    $mform->addElement('html','</td><td>');
                    $mform->addElement('text',"defaultvalue{$cid}",'');
                    $mform->setType("defaultvalue{$cid}", PARAM_TEXT);
                    $mform->setDefault("defaultvalue{$cid}",$defaultvalue);
                    $mform->addElement('html','</td>');
                } else {
                    $mform->addElement('hidden',"column{$cid}", $type);
                    $mform->setType("column{$cid}", PARAM_TEXT);
                    $mform->addElement('html','<tr><td colspan="3" style="color:red;padding:10px;">' . get_string('error:columntypenotfound','local',$type).'</td>');
                }

                $mform->addElement('html','<td>');
                // delete link
                $mform->addElement('html', '<a href="'.$CFG->wwwroot.'/local/reportheading/index.php?d=1&amp;cid='.$cid.'" title="'.$strdelete.'"><img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$strdelete.'" /></a>');
                // move up link
                if($i != 1) {
                    $mform->addElement('html', '<a href="'.$CFG->wwwroot.'/local/reportheading/index.php?m=up&amp;cid='.$cid.'" title="'.$strmoveup.'"><img src="'.$CFG->pixpath.'/t/up.gif" class="iconsmall" alt="'.$strmoveup.'" /></a>');
                } else {
                    $mform->addElement('html', $spacer);
                }

                // move down link
                if($i != $colcount) {
                    $mform->addElement('html', '<a href="'.$CFG->wwwroot.'/local/reportheading/index.php?m=down&amp;cid='.$cid.'" title="'.$strmovedown.'"><img src="'.$CFG->pixpath.'/t/down.gif" class="iconsmall" alt="'.$strmovedown.'" /></a>');
                } else {
                    $mform->addElement('html', $spacer);
                }

                $mform->addElement('html','</td></tr>');
                $i++;
            }
        }
            $mform->addElement('html','<tr><td>');
            $newcolumnsselect = array_merge(array(0=>get_string('addanothercolumn','local')),$columnoptions);
            $mform->addElement('select','newcolumns','',$newcolumnsselect, $newonchange);
            $mform->addElement('html','</td><td>');
            $mform->addElement('text','newheading','');
            $mform->setType('newheading', PARAM_TEXT);
            // do manually as disabledIf doesn't play nicely with using JS to update heading values
            // $mform->disabledIf('newheading','newcolumns', 'eq', 0);
            $mform->addElement('html','</td><td>');
            $mform->addElement('text','newdefaultvalue','');
            $mform->setType('newdefaultvalue', PARAM_TEXT);
            // do manually as disabledIf doesn't play nicely with using JS to update heading values
            // $mform->disabledIf('newdefaultvalue','newcolumns', 'eq', 0);
            $mform->setDefault("newdefaultvalue", get_string('notfound','local'));
            $mform->addElement('html','</td><td>');
            $mform->addElement('html','</td><td>&nbsp;</td></tr>');
        $mform->addElement('html','</table></div>');

        $this->add_action_buttons();
    }

    function validation($data) {
        $err = array();
        $err = validate_new_column_heading($data);
        return $err;
    }

}

function validate_new_column_heading($data) {
    $errors = array();
    if($data['newcolumns'] != '0' && trim($data['newheading']) == '') {
        $errors['newheading'] = get_string('err_required','form');
    }
    return $errors;
}


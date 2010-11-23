<?php

/**
 * Moodle Formslib templates for report builder settings forms
 *
 * @copyright Catalyst IT Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */

require_once "$CFG->dirroot/lib/formslib.php";
include_once($CFG->dirroot.'/local/reportbuilder/classes/rb_base_content.php');

/**
 * Formslib template for the new report form
 */
class report_builder_new_form extends moodleform {

    function definition() {

        $mform =& $this->_form;

        $mform->addElement('header', 'general', get_string('newreport', 'local_reportbuilder'));
        $sources = reportbuilder::get_source_list();
        if(count($sources)>0) {

            $mform->addElement('text', 'fullname', get_string('reportname', 'local_reportbuilder'), 'maxlength="255"');
            $mform->setType('fullname', PARAM_TEXT);
            $mform->addRule('fullname',null,'required');
            $mform->setHelpButton('fullname', array('reportbuilderfullname',get_string('reportname','local_reportbuilder'),'local_reportbuilder'));

            $pick = array(0 => get_string('selectsource','local_reportbuilder'));
            $select = array_merge($pick, $sources);
            $mform->addElement('select','source', get_string('source','local_reportbuilder'), $select);
            // invalid if not set
            $mform->addRule('source', get_string('error:mustselectsource','local_reportbuilder'), 'regex','/[^0]+/');
            $mform->setHelpButton('source', array('reportbuildersource',get_string('source','local_reportbuilder'),'local_reportbuilder'));

            $mform->addElement('advcheckbox','hidden', get_string('hidden','local_reportbuilder'), '', null, array(0,1));
            $mform->setHelpButton('hidden', array('reportbuilderhidden',get_string('hidden','local_reportbuilder'),'local_reportbuilder'));
            $this->add_action_buttons();

        } else {
            $mform->addElement('html', get_string('error:nosources','local_reportbuilder'));
        }
    }

}


/**
 * Formslib tempalte for the edit report form
 */
class report_builder_edit_form extends moodleform {
    function definition() {
        global $CFG;
        $mform =& $this->_form;
        $report = $this->_customdata['report'];
        $id = $this->_customdata['id'];

        $mform->addElement('header', 'general', get_string('reportsettings', 'local_reportbuilder'));

        $mform->addElement('text', 'fullname', get_string('reporttitle','local_reportbuilder'), array('size'=>'30'));
        $mform->setDefault('fullname', $report->fullname);
        $mform->setType('fullname', PARAM_TEXT);
        $mform->addRule('fullname',null,'required');
        $mform->setHelpButton('fullname', array('reportbuilderfullname',get_string('reporttitle','local_reportbuilder'),'local_reportbuilder'));

        $mform->addElement('htmleditor', 'description', get_string('description'));
        $mform->setDefault('description', $report->description);
        $mform->setType('description', PARAM_CLEAN);
        $mform->setHelpButton('description', array('reportbuilderdescription', get_string('description'),'local_reportbuilder'));

        $mform->addElement('static', 'reportsource', get_string('source','local_reportbuilder'), $report->source);
        $mform->setHelpButton('reportsource', array('reportbuildersource',get_string('source','local_reportbuilder'),'local_reportbuilder'));

        $mform->addElement('advcheckbox', 'hidden', get_string('hidden','local_reportbuilder'), '', null, array(0,1));
        $mform->setType('hidden', PARAM_INT);
        $mform->setDefault('hidden', $report->hidden);
        $mform->setHelpButton('hidden', array('reportbuilderhidden',get_string('hidden','local_reportbuilder'),'local_reportbuilder'));

        $mform->addElement('text', 'recordsperpage', get_string('recordsperpage','local_reportbuilder'), array('size'=>'6'));
        $mform->setDefault('recordsperpage', $report->recordsperpage);
        $mform->setType('recordsperpage', PARAM_INT);
        $mform->addRule('recordsperpage',null,'numeric');
        $mform->setHelpButton('recordsperpage', array('reportbuilderrecordsperpage',get_string('recordsperpage','local_reportbuilder'),'local_reportbuilder'));

        $reporttype = ($report->embeddedurl === null) ? get_string('usergenerated','local_reportbuilder') :
            get_string('embedded', 'local_reportbuilder');

        $mform->addElement('static', 'reporttype', get_string('reporttype', 'local_reportbuilder'), $reporttype);

        $mform->addElement('hidden','id',$id);
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden','source',$report->source);
        $mform->setType('source', PARAM_TEXT);
        $this->add_action_buttons();
    }

}


/**
 * Formslib template for the global settings form
 */
class report_builder_global_settings_form extends moodleform {
    function definition() {
        global $CFG, $REPORT_BUILDER_EXPORT_OPTIONS;
        $mform =& $this->_form;

        $mform->addElement('header', 'settings', get_string('globalsettings', 'local_reportbuilder'));

        $exportoptions = get_config('reportbuilder', 'exportoptions');

        $group = array();
        foreach($REPORT_BUILDER_EXPORT_OPTIONS as $option => $code) {
            $group[] =& $mform->createElement('checkbox', 'export'.$option, '', get_string('export'.$option,'local_reportbuilder'));
            if($exportoptions) {
                // bitwise operation to see if bit for this export
                // option is set
                if(($exportoptions & $code) == $code) {
                    $mform->setDefault('export'.$option, 1);
                } else {
                    $mform->setDefault('export'.$option, 0);
                }
            }
        }
        $mform->addGroup($group, 'exportoptions', get_string('exportoptions','local_reportbuilder'), '<br />', false);
        $mform->setHelpButton('exportoptions', array('reportbuilderexportoptions',get_string('exportoptions','local_reportbuilder'),'local_reportbuilder'));

        $this->add_action_buttons();
    }

}


/**
 * Formslib template for edit filters form
 */
class report_builder_edit_filters_form extends moodleform {
    function definition() {
        global $CFG;
        $mform =& $this->_form;
        $report = $this->_customdata['report'];
        $id = $this->_customdata['id'];

        $mform->addElement('header', 'searchoptions', get_string('searchoptions', 'local_reportbuilder'));

        $mform->setHelpButton('searchoptions', array('reportbuilderfilters',get_string('filters','local_reportbuilder'),'local_reportbuilder'));

        $strmovedown = get_string('movedown','local_reportbuilder');
        $strmoveup = get_string('moveup','local_reportbuilder');
        $strdelete = get_string('delete','local_reportbuilder');
        $spacer = '<img src="'.$CFG->wwwroot.'/pix/spacer.gif" class="iconsmall" alt="" />';

        if(isset($report->filteroptions) && is_array($report->filteroptions) && count($report->filteroptions)>0) {
            $mform->addElement('html','<div>'.get_string('help:searchdesc','local_reportbuilder').'</div><br />');

            $mform->addElement('html', '<div class="reportbuilderform"><table><tr><th>'.get_string('searchfield','local_reportbuilder').
                '</th><th>'.get_string('advanced','local_reportbuilder').'</th><th>'.get_string('options','local_reportbuilder').'</th><tr>');

            $filtersselect = $report->get_filters_select();

            if(isset($report->filters) && is_array($report->filters) && count($report->filters)>0) {
                $filters = $report->filters;
                $filtercount = count($filters);
                $i = 1;
                foreach($filters as $index => $filter) {
                    $row = array();
                    $type = $filter->type;
                    $value = $filter->value;
                    $field = "{$type}-{$value}";
                    $advanced = $filter->advanced;
                    $fid = $index;

                    $mform->addElement('html','<tr><td>');
                    $mform->addElement('selectgroups',"filter{$fid}",'',$filtersselect);
                    $mform->setDefault("filter{$fid}", $field);
                    $mform->addElement('html','</td><td>');
                    $mform->addElement('checkbox',"advanced{$fid}",'');
                    $mform->setDefault("advanced{$fid}",$advanced);

                    $mform->addElement('html','</td><td>');
                    $mform->addElement('html', '<a href="'.$CFG->wwwroot.'/local/reportbuilder/filters.php?d=1&amp;id='.$id.'&amp;fid='.$fid.'" title="'.$strdelete.'"><img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$strdelete.'" /></a>');
                    if($i != 1) {
                        $mform->addElement('html', '<a href="'.$CFG->wwwroot.'/local/reportbuilder/filters.php?m=up&amp;id='.$id.'&amp;fid='.$fid.'" title="'.$strmoveup.'"><img src="'.$CFG->pixpath.'/t/up.gif" class="iconsmall" alt="'.$strmoveup.'" /></a>');
                    } else {
                        $mform->addElement('html', $spacer);
                    }
                    if($i != $filtercount) {
                        $mform->addElement('html', '<a href="'.$CFG->wwwroot.'/local/reportbuilder/filters.php?m=down&amp;id='.$id.'&amp;fid='.$fid.'" title="'.$strmovedown.'"><img src="'.$CFG->pixpath.'/t/down.gif" class="iconsmall" alt="'.$strmovedown.'" /></a>');
                    } else {
                        $mform->addElement('html', $spacer);
                    }
                    $mform->addElement('html','</td></tr>');
                    $i++;
                }
            } else {
                $mform->addElement('html','<p>'. get_string('nofiltersyet','local_reportbuilder').'</p>');
            }


            $mform->addElement('html','<tr><td>');
            $newfilterselect = array_merge(
                array(
                    get_string('new') => array(0 => get_string('addanotherfilter','local_reportbuilder'))
                ),
                $filtersselect);
            $mform->addElement('selectgroups','newfilter','',$newfilterselect);
            $mform->addElement('html','</td><td>');
            $mform->addElement('checkbox','newadvanced','');
            $mform->disabledIf('newadvanced','newfilter', 'eq', 0);
            $mform->addElement('html','</td><td>');
            $mform->addElement('html','</td><td>&nbsp;</td></tr>');
            $mform->addElement('html','</table></div>');
        } else {
            $mform->addElement('html',"No filters found. Ask your developer to add filter options to the '{$report->source}' source.");
        }

        $mform->addElement('hidden','id',$id);
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden','source',$report->source);
        $mform->setType('source', PARAM_TEXT);
        $this->add_action_buttons();
    }
}


/**
 * Formslib template for edit columns form
 */
class report_builder_edit_columns_form extends moodleform {
    function definition() {
        global $CFG;
        $mform =& $this->_form;
        $report = $this->_customdata['report'];
        $id = $this->_customdata['id'];

        $strmovedown = get_string('movedown','local_reportbuilder');
        $strmoveup = get_string('moveup','local_reportbuilder');
        $strdelete = get_string('delete','local_reportbuilder');
        $strhide = get_string('hide');
        $strshow = get_string('show');
        $spacer = '<img src="'.$CFG->wwwroot.'/pix/spacer.gif" class="iconsmall" alt="" />';

        // javascript to update the heading columns.
        $onchange = array(
            'onChange' => "
                var currentoption = this.options[this.selectedIndex].text;
                var headid = 'id_heading'+this.name.substr(6);
                document.getElementById(headid).value = currentoption;
            ",
        );
        $newonchange = array(
            'onChange' => "
                var heading = document.getElementById('id_newheading');
                var currentvalue = this.options[this.selectedIndex].value;
                if(currentvalue == 0) {
                    heading.value = '';
                    heading.disabled=true;
                } else {
                    heading.disabled=false;
                    heading.value = this.options[this.selectedIndex].text;
                }
            ",
        );

        $mform->addElement('header', 'reportcolumns', get_string('reportcolumns', 'local_reportbuilder'));

        $mform->setHelpButton('reportcolumns', array('reportbuildercolumns',get_string('columns','local_reportbuilder'),'local_reportbuilder'));

        if(isset($report->columnoptions) && is_array($report->columnoptions) && count($report->columnoptions)>0) {


            $mform->addElement('html','<div>'.get_string('help:columnsdesc','local_reportbuilder').'</div><br />');


            $mform->addElement('html', '<div class="reportbuilderform"><table><tr><th>'.get_string('column','local_reportbuilder').
                '</th><th>'.get_string('heading','local_reportbuilder').'</th><th>'.get_string('options','local_reportbuilder').'</th><tr>');

            $columnsselect = $report->get_columns_select();
            $columnoptions = array();

            if(isset($report->columns) && is_array($report->columns) && count($report->columns)>0) {
                $columns = $report->columns;
                $colcount = count($columns);
                $i = 1;
                foreach($columns as $index => $column) {
                    $columnoptions["{$column->type}_{$column->value}"] = $column->heading;
                    if(!isset($column->required) || !$column->required) {
                        $row = array();
                        $type = $column->type;
                        $value = $column->value;
                        $field = "{$column->type}-{$column->value}";
                        $heading = $column->heading;
                        $cid = $index;
                        $mform->addElement('html','<tr><td>');
                        $mform->addElement('selectgroups',"column{$cid}",'',$columnsselect, $onchange);
                        $mform->setDefault("column{$cid}", $field);
                        $mform->addElement('html','</td><td>');
                        $mform->addElement('text',"heading{$cid}",'');
                        $mform->setType("heading{$cid}", PARAM_TEXT);
                        $mform->setDefault("heading{$cid}",$heading);
                        $mform->addElement('html','</td><td>');
                        // show/hide link
                        if($column->hidden == 0) {
                            $mform->addElement('html', '<a href="'.$CFG->wwwroot.'/local/reportbuilder/columns.php?h=1&amp;id='.$id.'&amp;cid='.$cid.'" title="'.$strhide.'"><img src="'.$CFG->pixpath.'/t/hide.gif" class="iconsmall" alt="'.$strhide.'" /></a>');
                        } else {
                            $mform->addElement('html', '<a href="'.$CFG->wwwroot.'/local/reportbuilder/columns.php?h=0&amp;id='.$id.'&amp;cid='.$cid.'" title="'.$strshow.'"><img src="'.$CFG->pixpath.'/t/show.gif" class="iconsmall" alt="'.$strshow.'" /></a>');
                        }
                        // delete link
                        $mform->addElement('html', '<a href="'.$CFG->wwwroot.'/local/reportbuilder/columns.php?d=1&amp;id='.$id.'&amp;cid='.$cid.'" title="'.$strdelete.'"><img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$strdelete.'" /></a>');
                        // move up link
                        if($i != 1) {
                            $mform->addElement('html', '<a href="'.$CFG->wwwroot.'/local/reportbuilder/columns.php?m=up&amp;id='.$id.'&amp;cid='.$cid.'" title="'.$strmoveup.'"><img src="'.$CFG->pixpath.'/t/up.gif" class="iconsmall" alt="'.$strmoveup.'" /></a>');
                        } else {
                            $mform->addElement('html', $spacer);
                        }

                        // move down link
                        if($i != $colcount) {
                            $mform->addElement('html', '<a href="'.$CFG->wwwroot.'/local/reportbuilder/columns.php?m=down&amp;id='.$id.'&amp;cid='.$cid.'" title="'.$strmovedown.'"><img src="'.$CFG->pixpath.'/t/down.gif" class="iconsmall" alt="'.$strmovedown.'" /></a>');
                        } else {
                            $mform->addElement('html', $spacer);
                        }

                        $mform->addElement('html','</td></tr>');
                        $i++;
                    }
                }
            } else {
                $mform->addElement('html','<p>'.get_string('nocolumnsyet','local_reportbuilder').'</p>');
            }

            $mform->addElement('html','<tr><td>');
            $newcolumnsselect = array_merge(
                array(
                    get_string('new') => array(0 => get_string('addanothercolumn','local_reportbuilder'))
                ),
                $columnsselect);
            $mform->addElement('selectgroups','newcolumns','',$newcolumnsselect, $newonchange);
            $mform->addElement('html','</td><td>');
            $mform->addElement('text','newheading','');
            $mform->setType('newheading', PARAM_TEXT);
            // do manually as disabledIf doesn't play nicely with using JS to update heading values
            // $mform->disabledIf('newheading','newcolumns', 'eq', 0);
            $mform->addElement('html','</td><td>');
            $mform->addElement('html','</td><td>&nbsp;</td></tr>');
            $mform->addElement('html','</table></div>');

            $mform->addElement('header','sorting',get_string('sorting','local_reportbuilder'));
            $mform->setHelpButton('sorting', array('reportbuildersorting',get_string('sorting','local_reportbuilder'),'local_reportbuilder'));

            $pick = array('' => get_string('noneselected','local_reportbuilder'));
            $select = array_merge($pick, $columnoptions);
            $mform->addElement('select','defaultsortcolumn', get_string('defaultsortcolumn','local_reportbuilder'), $select);
            $mform->setDefault('defaultsortcolumn', $report->defaultsortcolumn);


            $radiogroup = array();
            $radiogroup[] =& $mform->createElement('radio', 'defaultsortorder', '', get_string('ascending','local_reportbuilder'), SORT_ASC);
            $radiogroup[] =& $mform->createElement('radio', 'defaultsortorder', '', get_string('descending','local_reportbuilder'), SORT_DESC);
            $mform->addGroup($radiogroup, 'radiogroup', get_string('defaultsortorder','local_reportbuilder'), '<br />', false);
            $mform->setDefault('defaultsortorder', $report->defaultsortorder);
        } else {

                $mform->addElement('html',"No columns found. Ask your developer to add column options to the '{$report->source}' source");
            }

        $mform->addElement('hidden','id',$id);
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden','source',$report->source);
        $mform->setType('source', PARAM_TEXT);
        $this->add_action_buttons();
    }


    function validation($data) {
        $err = array();
        $err += validate_unique_columns($data);
        return $err;
    }


}


/**
 * Formslib template for content restrictions form
 */
class report_builder_edit_content_form extends moodleform {
    function definition() {
        global $CFG;
        $mform =& $this->_form;
        $report = $this->_customdata['report'];
        $id = $this->_customdata['id'];

        $mform->addElement('header', 'contentheader', get_string('contentcontrols', 'local_reportbuilder'));

        if($report->embeddedurl !== null) {
            $mform->addElement('html','<p>'.get_string('embeddedcontentnotes','local_reportbuilder').'</p>');
        }

        $radiogroup = array();
        $radiogroup[] =& $mform->createElement('radio', 'contentenabled', '', get_string('nocontentrestriction','local_reportbuilder'), 0);
        $radiogroup[] =& $mform->createElement('radio', 'contentenabled', '', get_string('withcontentrestrictionany','local_reportbuilder'), 1);
        $radiogroup[] =& $mform->createElement('radio', 'contentenabled', '', get_string('withcontentrestrictionall','local_reportbuilder'), 2);
        $mform->addGroup($radiogroup, 'radiogroup', get_string('restrictcontent','local_reportbuilder'), '<br />', false);
        $mform->setHelpButton('radiogroup', array('reportbuildercontentmode',get_string('restrictcontent','local_reportbuilder'),'local_reportbuilder'));
        $mform->setDefault('contentenabled', get_field('report_builder', 'contentmode', 'id', $id));

        // get array of content options
        $contentoptions = isset($report->contentoptions) ?
            $report->contentoptions : array();

        // display any content restriction form sections that are enabled for
        // this source
        foreach($contentoptions as $option) {
            $classname = 'rb_' . $option->classname.'_content';
            if(class_exists($classname)) {
                $obj = new $classname();
                $obj->form_template($mform, $id);
            }
        }

        $mform->addElement('hidden','id',$id);
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden','source',$report->source);
        $mform->setType('source', PARAM_TEXT);
        $this->add_action_buttons();
    }
}

/**
 * Formslib template for access restrictions form
 */
class report_builder_edit_access_form extends moodleform {
    function definition() {
        global $CFG;
        $mform =& $this->_form;
        $report = $this->_customdata['report'];
        $id = $this->_customdata['id'];

        $mform->addElement('header', 'access', get_string('accesscontrols', 'local_reportbuilder'));

        if($report->embeddedurl !== null) {
            $mform->addElement('html','<p>'. get_string('embeddedaccessnotes','local_reportbuilder').'</p>');
        }
        $radiogroup = array();
        $radiogroup[] =& $mform->createElement('radio', 'accessenabled', '', get_string('norestriction','local_reportbuilder'), 0);
        $radiogroup[] =& $mform->createElement('radio', 'accessenabled', '', get_string('withrestriction','local_reportbuilder'), 1);
        $mform->addGroup($radiogroup, 'radiogroup', get_string('restrictaccess','local_reportbuilder'), '<br />', false);
        $mform->setDefault('accessenabled', get_field('report_builder', 'accessmode', 'id', $id));
        $mform->setHelpButton('radiogroup', array('reportbuilderaccessmode',get_string('restrictaccess','local_reportbuilder'),'local_reportbuilder'));

        // loop round classes, only considering classes that extend rb_base_access
        foreach(get_declared_classes() as $class) {
            if(is_subclass_of($class, 'rb_base_access')) {
                $obj = new $class();
                // add any form elements for this access option
                $obj->form_template($mform, $id);
            }
        }

        $mform->addElement('hidden','id',$id);
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden','source',$report->source);
        $mform->setType('source', PARAM_TEXT);
        $this->add_action_buttons();
    }

}


/**
 * Method to check a shortname is unique in database
 *
 * @param array $data Array of data from the form
 *
 * @return array Array of errors to display on failure
 */
function validate_shortname($data) {
    $errors = array();

    if($foundreports = get_records('report_builder','shortname',$data['shortname'])) {
        if(!empty($data['id'])) {
            unset($foundreports[$data['id']]);
        }
        if(!empty($foundreports)) {
            $errors['shortname'] = get_string('shortnametaken','local_reportbuilder');
        }
    }
    return $errors;

}

/**
 * Method to check each column is only included once
 *
 * Flexible table breaks if not used as headers must be distinct
 *
 * @param array $data Array of data from the form
 *
 * @return array Array of errors to display on failure
 */
function validate_unique_columns($data) {
    $errors = array();

    $id = $data['id'];
    $used_cols = array();
    if($currentcols = get_records('report_builder_columns','reportid', $id)) {
        foreach($currentcols as $col) {
            $field = "column{$col->id}";
            if(isset($data[$field])) {
                if(array_key_exists($data[$field], $used_cols)) {
                    $errors[$field] = get_string('norepeatcols','local_reportbuilder');
                } else {
                    $used_cols[$data[$field]] = 1;
                }
            }
        }
    }

    // also check new column if set
    if(isset($data['newcolumns'])) {
        if(array_key_exists($data['newcolumns'], $used_cols)) {
            $errors['newcolumns'] = get_string('norepeatcols','local_reportbuilder');
        }
    }
    return $errors;
}


/**
 * Formslib template for saved searches form
 */
class report_builder_save_form extends moodleform {
    function definition() {
        global $CFG,$USER,$SESSION;
        $mform =& $this->_form;
        $report = $this->_customdata['report'];
        $id = $this->_customdata['id'];
        $filterparams = $report->get_restriction_descriptions('filter');
        $shortname = $report->shortname;
        $filtername = 'filtering_'.$shortname;
        $searchsettings = serialize($SESSION->$filtername);
        $params = implode('<br />',$filterparams);

        $mform->addElement('header', 'savesearch', get_string('createasavedsearch', 'local_reportbuilder'));
        $mform->addElement('static', 'description', '', get_string('savedsearchdesc','local_reportbuilder'));
        $mform->addElement('static', 'params', get_string('currentsearchparams','local_reportbuilder'), $params);
        $mform->addElement('text','name', get_string('searchname','local_reportbuilder'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addElement('advcheckbox', 'public', get_string('publicallyavailable','local_reportbuilder'), '', null, array(0,1));
        $mform->addElement('hidden','id',$id);
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'search', $searchsettings);
        $mform->setType('search', PARAM_TEXT);
        $mform->addElement('hidden', 'userid', $USER->id);
        $mform->setType('userid', PARAM_INT);

        $this->add_action_buttons();
    }
}



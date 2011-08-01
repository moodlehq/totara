<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 * Copyright (C) 1999 onwards Martin Dougiamas 
 * 
 * This program is free software; you can redistribute it and/or modify  
 * it under the terms of the GNU General Public License as published by  
 * the Free Software Foundation; either version 2 of the License, or     
 * (at your option) any later version.                                   
 *                                                                       
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Alastair Munro <alastair@catalyst.net.nz>
 * @package totara
 * @subpackage plan 
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once "$CFG->dirroot/lib/formslib.php";
require_once("$CFG->libdir/tablelib.php");

class dp_template_general_settings_form extends moodleform {
    function definition(){
        global $CFG;
        $mform =& $this->_form;

        $id = $this->_customdata['id'];
        $template = get_record('dp_template', 'id', $id);
        $templatename = $template->fullname;
        $enddate = $template->enddate==0 ? '' : date('d/m/Y', $template->enddate);

        $mform->addElement('hidden', 'id', $id);

        $mform->addElement('header', 'generalsettings', get_string('generalsettings', 'local_plan'));

        $mform->addElement('text', 'templatename', get_string('name', 'local_plan'), 'maxlength="255"');
        $mform->setType('templatename', PARAM_TEXT);
        $mform->setDefault('templatename', $templatename);
        $mform->addRule('templatename',null,'required');

        $mform->addElement('text', 'enddate', get_string('enddate', 'local_plan'));

        $mform->addRule('enddate',get_string('error:dateformat','local_plan'),'regex', '/^(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](19|20)\d\d$/');

        $mform->setType('enddate', PARAM_TEXT);

        $mform->setDefault('enddate', $enddate);
        $mform->setHelpButton('enddate', array('templateenddate', get_string('enddate', 'local_plan'), 'local_plan'), true);

        $this->add_action_buttons();
    }


    function validation($data, $files) {
        $mform =& $this->_form;
        $result = array();

        $enddatestr = isset($data['enddate'])?$data['enddate']:'';
        $enddate = dp_convert_userdate( $enddatestr );

        // Enforce valid dates
        if ( false === $enddate && $enddatestr !== 'dd/mm/yyyy' && $enddatestr !== '' ){
            $result['enddate'] = get_string('error:dateformat','local_plan');
        }

        return $result;
    }
}


class dp_template_new_form extends moodleform {
    function definition(){
        global $CFG;
        $mform =& $this->_form;

        $mform->addElement('header', 'newtemplate', get_string('newtemplate', 'local_plan'));

        $mform->addElement('text', 'templatename', get_string('name', 'local_plan'), 'maxlength="255"');
        $mform->setType('templatename', PARAM_TEXT);
        $mform->addRule('templatename',null,'required');

        $mform->addElement('text', 'enddate', get_string('enddate', 'local_plan'));

        $mform->addRule('enddate',get_string('error:dateformat','local_plan'),'regex', '/^(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](19|20)\d\d$/');

        $mform->setType('enddate', PARAM_TEXT);

        $mform->setDefault('enddate','dd/mm/yyyy');
        $mform->setHelpButton('enddate', array('templateenddate', get_string('enddate', 'local_plan'), 'local_plan'), true);

        $this->add_action_buttons();
    }


    function validation($data, $files) {
        $mform =& $this->_form;
        $result = array();

        $enddatestr = isset($data['enddate'])?$data['enddate']:'';
        $enddate = dp_convert_userdate( $enddatestr );

        // Enforce valid dates
        if ( false === $enddate && $enddatestr !== 'dd/mm/yyyy' && $enddatestr !== '' ){
            $result['enddate'] = get_string('error:dateformat','local_plan');
        }

        return $result;
    }
}



class dp_template_workflow_form extends moodleform {
    function definition(){
        global $CFG, $DP_AVAILABLE_WORKFLOWS;
        $mform =& $this->_form;
        $id = $this->_customdata['id'];
        $defaultworkflow = $this->_customdata['workflow'];

        $mform->addElement('header', 'workflowsettings', get_string('workflowsettings', 'local_plan'));

        $radiogroup = array();

        foreach($DP_AVAILABLE_WORKFLOWS as $workflow) {
            $classfile = $CFG->dirroot . "/local/plan/workflows/$workflow/$workflow.class.php";
            if(!is_readable($classfile)) {
                $string_parameters = new object();
                $string_parameters->classfile = $classfile;
                $string_parameters->workflow = $workflow;
                throw new PlanException(get_string('noclassfileforworkflow', 'local_plan', $string_parameters));
            }
            include_once($classfile);

            $classname = "dp_{$workflow}_workflow";
            if(!class_exists($classname)) {
                $string_parameters = new object();
                $string_parameters->class = $classfile;
                $string_parameters->workflow = $workflow;
                throw new PlanException(get_string('noclassforworkflow', 'local_plan', $string_parameters));
            }
            $wf = new $classname();
            $radiogroup[] =& $mform->createElement('radio', 'workflow', '', '<b>' .$wf->name . '</b><br />' . $wf->description, $wf->classname);

        }

        $radiogroup[] =& $mform->createElement('radio', 'workflow', '', '<b>' .get_string('customworkflowname', 'local_plan') . '</b><br />' . get_string('customworkflowdesc', 'local_plan'), 'custom');
        $mform->addGroup($radiogroup, 'radiogroup', '', '<br /><br />', false);
        $mform->setDefault('workflow', $defaultworkflow);

        $mform->registerNoSubmitButton('advancedsubmitbutton');
        $mform->addElement('submit', 'advancedsubmitbutton', get_string('advancedworkflow', 'local_plan'));
        $mform->disabledIf('advancedsubmitbutton', 'workflow', 'neq', 'custom');

        $mform->addElement('hidden', 'id', $id);

        $this->add_action_buttons();
    }
}

class dp_template_advanced_workflow_form extends moodleform {
    function definition() {
        global $CFG;
        $mform =& $this->_form;
        $id = $this->_customdata['id'];
        $component = $this->_customdata['component'];
        $templateinuse = $this->_customdata['templateinuse'];

        if($component == 'plan') {
            $class = 'development_plan';
            require_once("{$CFG->dirroot}/local/plan/settings_form.php");
        } else {
            // Include each components form file
            // Component path
            $cpath = "{$CFG->dirroot}/local/plan/components/{$component}";
            $formfile  = "{$cpath}/settings_form.php";

            if(!is_readable($formfile)) {
                $string_parameters = new object();
                $string_parameters->classfile = $classfile;
                $string_parameters->component = $component;
                throw new PlanException(get_string('noclassfileforcomponent', 'local_plan', $string_parameters));
            }
            include_once($formfile);

            // check class exists
            $class = "dp_{$component}_component";
            if(!class_exists($class)) {
                $string_parameters = new object();
                $string_parameters->class = $class;
                $string_parameters->component = $component;
                throw new PlanException(get_string('noclassforcomponent', 'local_plan', $string_parameters));
            }
        }
        $build_form = "{$class}_build_settings_form";
        $build_form($mform, $this->_customdata);

        $mform->addElement('hidden', 'id', $id);
        $mform->addElement('hidden', 'component', $component);
        $this->add_action_buttons();
    }
}


class dp_components_form extends moodleform {
    function definition() {
        global $CFG;

        $mform =& $this->_form;
        $templateid = $this->_customdata['id'];

        $mform->addElement('header', 'componentsettings', get_string('componentsettings', 'local_plan'));
        $mform->setHelpButton('componentsettings', array('templatecomponentsettings', get_string('componentsettings', 'local_plan'), 'local_plan'), true);

        $components = get_records('dp_component_settings', 'templateid', $templateid, 'sortorder');

        if($components) {

            $str_disable = get_string('disable');
            $str_enable = get_string('enable');
            $str_moveup = get_string('moveup');
            $str_movedown = get_string('movedown');

            $columns[] = 'component';
            $headers[] = get_string('component', 'local_plan');
            $columns[] = 'options';
            $headers[] = get_string('options', 'local_plan');

            $table = new flexible_table('components');
            $table->define_columns($columns);
            $table->define_headers($headers);
            $table->set_attribute('id', 'dpcomponents');
            $table->column_class('component', 'component');
            $table->column_class('options', 'options');

            $table->setup();
            $spacer = "<img src=\"{$CFG->wwwroot}/pix/spacer.gif\" class=\"iconsmall\" alt=\"\" />";
            $count=0;
            $numvalues = count($components);
            foreach($components as $component) {
                $count++;
                $tablerow = array();
                $configsetting = get_config(null, 'dp_'.$component->component);
                $cssclass = !$component->enabled ? 'class="dimmed"' : '';
                $compname = $configsetting ? $configsetting : get_string($component->component.'plural', 'local_plan');
                $tablerow[] = '<span '.$cssclass.'>' . $compname . '</span>';

                $buttons = array();

                if ($component->enabled) {
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/template/components.php?id={$templateid}&amp;hide={$component->id}\" title=\"$str_disable\">".
                        "<img src=\"{$CFG->pixpath}/t/hide.gif\" class=\"iconsmall\" alt=\"$str_disable\" /></a>";
                } else {
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/template/components.php?id={$templateid}&amp;show={$component->id}\" title=\"$str_enable\">".
                        "<img src=\"{$CFG->pixpath}/t/show.gif\" class=\"iconsmall\" alt=\"$str_enable\" /></a>";
                }

                if ($count > 1) {
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/template/components.php?id={$templateid}&amp;moveup={$component->id}\" title=\"$str_moveup\">".
                        "<img src=\"{$CFG->pixpath}/t/up.gif\" class=\"iconsmall\" alt=\"$str_moveup\" /></a>";
                } else {
                    $buttons[] = $spacer;
                }

                // If value can be moved down
                if ($count < $numvalues) {
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/template/components.php?id={$templateid}&amp;movedown={$component->id}\" title=\"$str_movedown\">".
                        "<img src=\"{$CFG->pixpath}/t/down.gif\" class=\"iconsmall\" alt=\"$str_movedown\" /></a>";
                } else {
                    $buttons[] = $spacer;
                }

                $tablerow[] = implode($buttons, ' ');
                $table->add_data($tablerow);
            }
            ob_start();
            $table->print_html();
            $html = ob_get_contents();
            ob_end_clean();

            $mform->addElement('html', '<center>'.$html.'</center>');
        }
    }

}

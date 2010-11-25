<?php

require_once "$CFG->dirroot/lib/formslib.php";
require_once("$CFG->libdir/tablelib.php");

class dp_template_general_settings_form extends moodleform {
    function definition(){
        global $CFG;
        $mform =& $this->_form;

        $id = $this->_customdata['id'];
        $template = get_record('dp_template', 'id', $id);
        $templatename = $template->fullname;
        $startdate = $template->startdate==0 ? '' : date('d/m/Y', $template->startdate);
        $enddate = $template->enddate==0 ? '' : date('d/m/Y', $template->enddate);

        $mform->addElement('hidden', 'id', $id);

        $mform->addElement('header', 'generalsettings', get_string('generalsettings', 'local_plan'));

        $mform->addElement('text', 'templatename', get_string('name', 'local_plan'), 'maxlength="255"');
        $mform->setType('templatename', PARAM_TEXT);
        $mform->setDefault('templatename', $templatename);
        $mform->addRule('templatename',null,'required');

        $mform->addElement('text', 'startdate', get_string('startdate', 'local_plan'));
        $mform->addElement('text', 'enddate', get_string('enddate', 'local_plan'));

        $mform->addRule('startdate',get_string('error:dateformat','idp'),'regex', '/^(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](19|20)\d\d$/');
        $mform->addRule('enddate',get_string('error:dateformat','idp'),'regex', '/^(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](19|20)\d\d$/');

        $mform->setType('startdate', PARAM_TEXT);
        $mform->setType('enddate', PARAM_TEXT);

        $mform->setDefault('startdate', $startdate);
        $mform->setHelpButton('startdate', array('userpositionstartdate', get_string('startdate', 'position')), true);

        $mform->setDefault('enddate', $enddate);
        $mform->setHelpButton('enddate', array('userpositionstartdate', get_string('startdate', 'position')), true);

        //$this->add_action_buttons(true, get_string($action.'plan', 'idp'));
        $this->add_action_buttons();
    }


    function validation($data, $files) {
        $mform =& $this->_form;
        $result = array();

        $startdatestr = isset($data['startdate'])?$data['startdate']:'';
        $startdate = dp_convert_userdate( $startdatestr );
        $enddatestr = isset($data['enddate'])?$data['enddate']:'';
        $enddate = dp_convert_userdate( $enddatestr );

        // Enforce valid dates
        if ( false === $startdate && $startdatestr !== 'dd/mm/yyyy' && $startdatestr !== '' ){
            $result['startdate'] = get_string('error:dateformat','idp');
        }
        if ( false === $enddate && $enddatestr !== 'dd/mm/yyyy' && $enddatestr !== '' ){
            $result['enddate'] = get_string('error:dateformat','idp');
        }

        // Enforce start date before finish date
        if ( $startdate > $enddate && $startdate !== false && $enddate !== false ){
            $errstr = get_string('error:startafterfinish','idp');
            $result['startdate'] = $errstr;
            $result['enddate'] = $errstr;
            unset($errstr);
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

        $mform->addElement('text', 'startdate', get_string('startdate', 'local_plan'));
        $mform->addElement('text', 'enddate', get_string('enddate', 'local_plan'));

        $mform->addRule('startdate',get_string('error:dateformat','idp'),'regex', '/^(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](19|20)\d\d$/');
        $mform->addRule('enddate',get_string('error:dateformat','idp'),'regex', '/^(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](19|20)\d\d$/');

        $mform->setType('startdate', PARAM_TEXT);
        $mform->setType('enddate', PARAM_TEXT);

        $mform->setDefault('startdate','dd/mm/yyyy');
        $mform->setHelpButton('startdate', array('userpositionstartdate', get_string('startdate', 'position')), true);

        $mform->setDefault('enddate','dd/mm/yyyy');
        $mform->setHelpButton('enddate', array('userpositionstartdate', get_string('startdate', 'position')), true);

        //$this->add_action_buttons(true, get_string($action.'plan', 'idp'));
        $this->add_action_buttons();
    }


    function validation($data, $files) {
        $mform =& $this->_form;
        $result = array();

        $startdatestr = isset($data['startdate'])?$data['startdate']:'';
        $startdate = dp_convert_userdate( $startdatestr );
        $enddatestr = isset($data['enddate'])?$data['enddate']:'';
        $enddate = dp_convert_userdate( $enddatestr );

        // Enforce valid dates
        if ( false === $startdate && $startdatestr !== 'dd/mm/yyyy' && $startdatestr !== '' ){
            $result['startdate'] = get_string('error:dateformat','idp');
        }
        if ( false === $enddate && $enddatestr !== 'dd/mm/yyyy' && $enddatestr !== '' ){
            $result['enddate'] = get_string('error:dateformat','idp');
        }

        // Enforce start date before finish date
        if ( $startdate > $enddate && $startdate !== false && $enddate !== false ){
            $errstr = get_string('error:startafterfinish','idp');
            $result['startdate'] = $errstr;
            $result['enddate'] = $errstr;
            unset($errstr);
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
                throw new PlanException("Class file '$classfile' could not be found for workflow of '$workflow'.");
            }
            include_once($classfile);

            $classname = "dp_{$workflow}_workflow";
            if(!class_exists($classname)) {
                throw new PlanException("Class '$class' does not exist for workflow '$workflow'.");
            }
            $wf = new $classname();
            $radiogroup[] =& $mform->createElement('radio', 'workflow', '', $wf->name . '<br />' . $wf->description, $wf->classname);

        }

        $radiogroup[] =& $mform->createElement('radio', 'workflow', '', get_string('customworkflowname', 'local_plan') . '<br />' . get_string('customworkflowdesc', 'local_plan'), 'custom');
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

        if($component == 'plan') {
            $class = 'development_plan';
        } else {
            // include each class file
            $classfile = $CFG->dirroot .
                "/local/plan/components/{$component}/{$component}.class.php";
            if(!is_readable($classfile)) {
                throw new PlanException("Class file '$classfile' could not be found for component '$component'.");
            }
            include_once($classfile);

            // check class exists
            $class = "dp_{$component}_component";
            if(!class_exists($class)) {
                throw new PlanException("Class '$class' does not exist for component '$component'.");
            }
        }
        $class::add_settings_form($mform, $id);
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

        $components = get_records('dp_component_settings', 'templateid', $templateid, 'sortorder');

        if($components) {

            $str_hide = get_string('hide');
            $str_show = get_string('show');
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
                $compname = $configsetting ? $configsetting : get_string($component->component.'_defaultname', 'local_plan');
                $tablerow[] = '<span '.$cssclass.'>' . $compname . '</span>';

                $buttons = array();

                if ($component->enabled) {
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/template/components.php?id={$templateid}&amp;hide={$component->id}\" title=\"$str_hide\">".
                        "<img src=\"{$CFG->pixpath}/t/hide.gif\" class=\"iconsmall\" alt=\"$str_hide\" /></a>";
                } else {
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/template/components.php?id={$templateid}&amp;show={$component->id}\" title=\"$str_show\">".
                        "<img src=\"{$CFG->pixpath}/t/show.gif\" class=\"iconsmall\" alt=\"$str_show\" /></a>";
                }

                if ($count > 1) {
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/template/components.php?id={$templateid}&moveup={$component->id}\" title=\"$str_moveup\">".
                        "<img src=\"{$CFG->pixpath}/t/up.gif\" class=\"iconsmall\" alt=\"$str_moveup\" /></a>";
                } else {
                    $buttons[] = $spacer;
                }

                // If value can be moved down
                if ($count < $numvalues) {
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/template/components.php?id={$templateid}&movedown={$component->id}\" title=\"$str_movedown\">".
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

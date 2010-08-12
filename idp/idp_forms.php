<?php

require_once "$CFG->dirroot/lib/formslib.php";

class idp_new_competency_area_form extends moodleform {
    function definition() {
        $templateid = $this->_customdata['templateid'];

        $mform =& $this->_form;

        $mform->addElement('hidden', 'id', 0);
        $mform->addElement('hidden', 'sortorder', 0);
        $mform->addElement('hidden', 'templateid', $templateid);
        $mform->addElement('header', 'general', get_string('compareasettings', 'idp'));

        $mform->addElement('text', 'fullname', get_string('compareafull', 'idp'), 'maxlength="255"');
        $mform->setType('fullname', PARAM_TEXT);
        $mform->addRule('fullname',null,'required');
        $mform->setHelpButton('fullname', array('compareafullname',get_string('fullname','idp'),'moodle'));

        $mform->addElement('text', 'shortname', get_string('compareashort', 'idp'), 'maxlength="255"');
        $mform->setType('shortname', PARAM_TEXT);
        $mform->addRule('shortname',null,'required');
        $mform->setHelpButton('shortname', array('compareashortname',get_string('shortname','idp'),'moodle'));

        $this->add_action_buttons();
    }
}

class idp_edit_population_form extends moodleform {
    function definition() {
        global $CFG;
        $mform =& $this->_form;
        $id = $this->_customdata['id'];

        $mform->addElement('header', 'population', get_string('populationsettings', 'idp'));

        $competenciesgroup = array();
        $competenciesgroup[] =& $mform->createElement('advcheckbox', 'accessenabled', '', get_string('primarypos', 'idp'));
        $competenciesgroup[] =& $mform->createElement('advcheckbox', 'accessenabled', '', get_string('organisation', 'idp'));
        $mform->addGroup($competenciesgroup, 'maps', get_string('populationauto','idp'), '<br />', false);

        if ($roles = get_records('role','','','sortorder')) {
            $rolesgroup = array();
            foreach($roles as $role) {
                $rolesgroup[] =& $mform->createElement('advcheckbox', "role_activeroles[{$role->id}]", '', $role->name, array('group' => 1), array(0, 1));
                if(in_array($role->id, $activeroles)) {
                    $mform->setDefault("role_activeroles[{$role->id}]", 1);
                }
            }
            $mform->addGroup($rolesgroup, 'roles', get_string('populationmanual','idp'), '<br />', false);
            $mform->setHelpButton('roles', array('reportbuilderrolesaccess',get_string('roleswithaccess','local'),'moodle'));
        } else {
            $mform->addElement('html', '<p>'.get_string('error:norolesfound','local').'</p>');
        }

        $this->add_checkbox_controller(1);

        $mform->addElement('hidden','id',$id);
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden','source',$report->source);
        $mform->setType('source', PARAM_TEXT);
        $this->add_action_buttons();
    }
}

class idp_edit_role_checkboxes_form extends moodleform {
    function definition(){
        global $CFG;
        $mform =& $this->_form;
        $id = $this->_customdata['id'];
        $header = $this->_customdata['header'];

        $mform->addElement('header', $header, get_string($header, 'idp'));

        if ($roles = get_records('role','','','sortorder')) {
            $rolesgroup = array();
            foreach($roles as $role) {
                $rolesgroup[] =& $mform->createElement('advcheckbox', "role_activeroles[{$role->id}]", '', $role->name, array('group' => 1), array(0, 1));
                if(in_array($role->id, $activeroles)) {
                    $mform->setDefault("role_activeroles[{$role->id}]", 1);
                }
            }
            $mform->addGroup($rolesgroup, 'roles', get_string('populationmanual','idp'), '<br />', false);
            $mform->setHelpButton('roles', array('reportbuilderrolesaccess',get_string('roleswithaccess','local'),'moodle'));
        } else {
            $mform->addElement('html', '<p>'.get_string('error:norolesfound','local').'</p>');
        }

        $this->add_checkbox_controller(1);

        $mform->addElement('hidden','id',$id);
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden','source',$report->source);
        $mform->setType('source', PARAM_TEXT);
        $this->add_action_buttons();
    }
}


class idp_edit_due_dates_form extends moodleform {
    function definition(){
        global $CFG;
        $mform =& $this->_form;

        $mform->addElement('header', 'duedates', get_string('duedates', 'idp'));

        $radiogroup = array();
        $radiogroup[] =& $mform->createElement('radio', 'accessenabled', '', 'No', 0);
        $radiogroup[] =& $mform->createElement('radio', 'accessenabled', '', 'Optional', 1);
        $radiogroup[] =& $mform->createElement('radio', 'accessenabled', '', 'Required', 2);
        $mform->addGroup($radiogroup, 'duedatesgrp', get_string('itemduedates', 'idp'), '', false);

        $renderer =& $mform->defaultRenderer();
        $template = '<label class="test" style="vertical-align:top">{label}</label> {element}';
        $renderer->setGroupElementTemplate($template, 'duedatesgrp');

        $this->add_action_buttons();
    }
}


class idp_edit_priority_form extends moodleform {
    function definition(){
        global $CFG;
        $mform =& $this->_form;

        $id = $this->_customdata['id'];
        $templateid = $this->_customdata['templateid'];
        $mform->addElement('hidden', 'id', $id);
        $mform->addElement('hidden', 'templateid', $templateid);

        $list = array();
        if ($priorities = get_records('idp_tmpl_priority_scale','','','')) {
            $count=0;
            foreach($priorities as $priority){
                $list[$priority->id] = $priority->name;
            }
            $pick = array(0 => get_string('selectpriorityscale','idp'));
            $select = array_merge($pick, $list);

            $mform->addElement('select', 'prioritytype', get_string('usepriority', 'idp'), $select, null);
            $mform->setHelpButton('prioritytype', array('idppriorityselect',get_string('priorityselect','idp'),'moodle'));
        } else {
            $mform->addElement('html', '<p>'.get_string('error:noprioritiesfound','idp').'</p>');
        }

        $this->add_action_buttons();
    }
}


class create_new_idp_form extends moodleform {
    function definition(){
        global $CFG;
        $mform =& $this->_form;

        $planid = $this->_customdata['planid'];
        $action = $this->_customdata['action'];
        $templateid = $this->_customdata['templateid'];

        $mform->addElement('hidden', 'planid', $planid);
        $mform->addElement('hidden', 'action', $action);
        $mform->addElement('hidden', 'templateid', $templateid);

        $mform->addElement('text', 'planname', get_string('planname', 'idp'), 'maxlength="255"');
        $mform->setType('planname', PARAM_TEXT);
        $mform->addRule('planname',null,'required');

        $mform->addElement('text', 'startdate', get_string('startdate', 'idp'));
        $mform->addElement('text', 'enddate', get_string('enddate', 'idp'));

        $mform->setType('startdate', PARAM_TEXT);
        $mform->setType('enddate', PARAM_TEXT);

        $mform->setDefault('startdate','dd/mm/yy');
        $mform->setHelpButton('startdate', array('userpositionstartdate', get_string('startdate', 'position')), true);

        $mform->setDefault('enddate','dd/mm/yy');
        $mform->setHelpButton('enddate', array('userpositionstartdate', get_string('startdate', 'position')), true);

        $renderer =& $mform->defaultRenderer();
        $template = '<label class="test" style="vertical-align:top">{label}</label> {element}';
        $renderer->setGroupElementTemplate($template, 'datesgroup');

        $this->add_action_buttons(true, get_string($action.'plan', 'idp'));
    }

    function definition_after_data() {
        $mform =& $this->_form;

        // Fix odd date values
        // Check if form is frozen
        if ($mform->elementExists('datesgroup')) {

            $startdate = $mform->getElement('startdate');
            echo '<br>';
            $date = $startdate->getValue();
            $startdateint = (int)$date["startdate"];

            if (!$startdateint) {
                $mform->setDefault('startdate', '');
            }
            else {
                $mform->setDefault('startdate', date('d/m/Y', $startdateint));
            }

            $enddate = $mform->getElement('enddate');
            $date2 = $enddate->getValue();
            $enddateint = (int)$date2["enddate"];

            if (!$enddateint) {
                $mform->setDefault('enddate', '');
            }
            else {
                $mform->setDefault('enddate', date('d/m/Y', $editdateint));
            }
        }
    }

    function validation($data, $files) {
        $mform =& $this->_form;
        $result = array();

        $startdatestr = isset($data['startdate'])?$data['startdate']:'';
        $startdate = convert_userdate( $startdatestr );
        $enddatestr = isset($data['enddate'])?$data['enddate']:'';
        $enddate = convert_userdate( $enddatestr );

        // Enforce valid dates
        if ( false === $startdate && $startdatestr !== 'dd/mm/yy' && $startdatestr !== '' ){
            $result['startdate'] = get_string('error:dateformat','idp');
        }
        if ( false === $enddate && $enddatestr !== 'dd/mm/yy' && $enddatestr !== '' ){
            $result['enddate'] = get_string('error:dateformat','idp');
        }

        // Enforce start date before finish date
        if ( $startdate > $enddate && $startdate !== false && $enddate !== false ){
            $errstr = get_string('error:startafterfinish','idp');
            $result['startdate'] = $errstr;
            $result['enddate'] = $errstr;
            unset($errstr);
        }
    }
}
?>

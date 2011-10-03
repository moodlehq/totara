<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
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
 * @author Aaron Barnes <aaronb@catalyst.net.nz>
 * @author Alastair Munro <alastair@catalyst.net.nz>
 * @package totara
 * @subpackage plan
 */

/**
 * Functions for creating/processing the settings form for this component
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

// Include main component class
require_once($CFG->dirroot.'/local/plan/components/competency/competency.class.php');


/**
 * Build settings form for configurating this component
 *
 * @access  public
 * @param   object  $mform  Moodle form object
 * @param   array $customdata mform customdata
 * @return  void
 */
function dp_competency_component_build_settings_form(&$mform, $customdata) {
    global $CFG, $DP_AVAILABLE_ROLES;

    $mform->addElement('header', 'competencysettings', get_string('competencysettings', 'local_plan'));
    $mform->setHelpButton('competencysettings', array('advancedsettingscompetencysettings', get_string('competencysettings', 'local_plan'), 'local_plan'), true);

    if ($templatesettings = get_record('dp_competency_settings', 'templateid', $customdata['id'])) {
        $defaultduedatesmode = $templatesettings->duedatemode;
        $defaultprioritymode = $templatesettings->prioritymode;
        $defaultpriorityscale = $templatesettings->priorityscale;
        $defaultautoassignpos = $templatesettings->autoassignpos;
        $defaultautoassignorg = $templatesettings->autoassignorg;
        $defaultincludecompleted = $templatesettings->includecompleted;
        $defaultautoassigncourses = $templatesettings->autoassigncourses;
        $defaultautoadddefaultevidence = $templatesettings->autoadddefaultevidence;
    } else {
        $defaultduedatesmode = null;
        $defaultprioritymode = null;
        $defaultpriorityscale = null;
        $defaultautoassignpos = null;
        $defaultautoassignorg = null;
        $defaultincludecompleted = 1;
        $defaultautoassigncourses = null;
        $defaultautoadddefaultevidence = null;
    }
    // due date mode options
    $radiogroup = array();
    $radiogroup[] =& $mform->createElement('radio', 'duedatemode', '', get_string('none', 'local_plan'), DP_DUEDATES_NONE);
    $radiogroup[] =& $mform->createElement('radio', 'duedatemode', '', get_string('optional', 'local_plan'), DP_DUEDATES_OPTIONAL);
    $radiogroup[] =& $mform->createElement('radio', 'duedatemode', '', get_string('required', 'local_plan'), DP_DUEDATES_REQUIRED);
    $mform->addGroup($radiogroup, 'duedategroup', get_string('duedates','local_plan'), '<br />', false);
    $mform->setDefault('duedatemode', $defaultduedatesmode);

    // priorities mode options
    $radiogroup = array();
    $radiogroup[] =& $mform->createElement('radio', 'prioritymode', '', get_string('none', 'local_plan'), DP_PRIORITY_NONE);
    $radiogroup[] =& $mform->createElement('radio', 'prioritymode', '', get_string('optional', 'local_plan'), DP_PRIORITY_OPTIONAL);
    $radiogroup[] =& $mform->createElement('radio', 'prioritymode', '', get_string('required', 'local_plan'), DP_PRIORITY_REQUIRED);
    $mform->addGroup($radiogroup, 'prioritygroup', get_string('priorities','local_plan'), '<br />', false);
    $mform->setDefault('prioritymode', $defaultprioritymode);

    // priority scale selector
    $prioritymenu = array();
    if($priorities = dp_get_priorities()) {
        foreach($priorities as $priority) {
            $prioritymenu[$priority->id] = $priority->name;
        }
    } else {
        $mform->addElement('static', 'nopriorityscales', null, get_string('nopriorityscales', 'local_plan'));
        $mform->addElement('hidden', 'disabled', 'yes');
    }

    $mform->disabledIf('prioritygroup', 'disabled', 'eq', 'yes');
    $mform->disabledIf('priorityscale', 'disabled', 'eq', 'yes');

    $mform->addElement('select', 'priorityscale', get_string('priorityscale', 'local_plan'), $prioritymenu);
    $mform->disabledIf('priorityscale', 'prioritymode', 'eq', DP_PRIORITY_NONE);
    if (!empty($customdata['templateinuse'])) {
        $mform->addElement('static', 'priorityscalesdisabledtemplateinuse', null, get_string('priorityscalesdisabledtemplateinuse', 'local_plan'));
        $mform->disabledIf('priorityscale', 'prioritymode', 'neq', -777);
    }
    $mform->setDefault('priorityscale', $defaultpriorityscale);

    // auto assign options
    $autoassigngroup = array();
    $autoassigngroup[] =& $mform->createElement('advcheckbox', 'autoassignpos', null, get_string('autoassignpos', 'local_plan'));
    $autoassigngroup[] =& $mform->createElement('advcheckbox', 'autoassignorg', null, get_string('autoassignorg', 'local_plan'));
    $autoassigngroup[] =& $mform->createElement('advcheckbox', 'includecompleted', null, get_string('includecompleted', 'local_plan'));
    $autoassigngroup[] =& $mform->createElement('advcheckbox', 'autoassigncourses', null, get_string('autoassigncourses', 'local_plan'));

    $mform->addGroup($autoassigngroup, 'autoassign', get_string('autoassign', 'local_plan'), array('<br />'), false);
    $mform->setDefault('autoassignpos', $defaultautoassignpos);
    $mform->setDefault('autoassignorg', $defaultautoassignorg);
    $mform->setDefault('includecompleted', $defaultincludecompleted);
    $mform->setDefault('autoassigncourses', $defaultautoassigncourses);

    $mform->addElement('advcheckbox', 'autoadddefaultevidence', get_string('defaultstatus', 'local_plan'), get_string('setdefaultstatus', 'local_plan'), null, array(0,1));
    $mform->setDefault('autoadddefaultevidence', $defaultautoadddefaultevidence);


    //Permissions
    $mform->addElement('header', 'competencypermissions', get_string('competencypermissions', 'local_plan'));
    $mform->setHelpButton('competencypermissions', array('advancedsettingscompetencypermissions', get_string('competencypermissions', 'local_plan'), 'local_plan'), true);

    $mform->addElement('html', '<div class="coursepermissionsform"><table><tr>'.
        '<th>'.get_string('action', 'local_plan').'</th>'.
        '<th>'.get_string('learner', 'local_plan').'</th>'.
        '<th>'.get_string('manager', 'local_plan').'</th></tr>');

    foreach(dp_competency_component::$permissions as $action => $requestable) {
        dp_add_permissions_table_row($mform, $action, get_string($action, 'local_plan'), $requestable);
    }

    foreach(dp_competency_component::$permissions as $action => $requestable) {
        foreach($DP_AVAILABLE_ROLES as $role){
            $sql = "SELECT value FROM {$CFG->prefix}dp_permissions WHERE role='$role' AND component='competency' AND action='{$action}' AND templateid='{$customdata['id']}'";
            $defaultvalue = get_field_sql($sql);
            $mform->setDefault($action.$role, $defaultvalue);
        }
    }
    $mform->addElement('html', '</table></div>');
}


/**
 * Process settings form for configurating this component
 *
 * @access  public
 * @param   object  $fromform   Submitted form's content
 * @param   integer $id         Template ID
 * @return  void
 */
function dp_competency_component_process_settings_form($fromform, $id) {
    global $CFG, $DP_AVAILABLE_ROLES;

    $currenturl = $CFG->wwwroot .
        '/local/plan/template/advancedworkflow.php?id=' . $id .
        '&amp;component=competency';

    begin_sql();
    $currentworkflow = get_field('dp_template', 'workflow', 'id', $id);
    if($currentworkflow != 'custom') {
        $template_update = new object();
        $template_update->id = $id;
        $template_update->workflow = 'custom';
        if(!update_record('dp_template', $template_update)){
            rollback_sql();
            totara_set_notification(get_string('error:update_competency_settings','local_plan'), $currenturl);
        }
    }

    $todb = new object();
    $todb->templateid = $id;
    $todb->duedatemode = $fromform->duedatemode;
    $todb->prioritymode = $fromform->prioritymode;
    if (($fromform->prioritymode != DP_PRIORITY_NONE) && isset($fromform->priorityscale)) {
        $todb->priorityscale = $fromform->priorityscale;
    }
    $todb->autoassignorg = $fromform->autoassignorg;
    $todb->autoassignpos = $fromform->autoassignpos;
    $todb->includecompleted = $fromform->includecompleted;
    $todb->autoassigncourses = $fromform->autoassigncourses;
    $todb->autoadddefaultevidence = $fromform->autoadddefaultevidence;

    if($competencysettings = get_record('dp_competency_settings', 'templateid', $id)) {
        // update
        $todb->id = $competencysettings->id;
        if(!update_record('dp_competency_settings', $todb)) {
            rollback_sql();
            totara_set_notification(get_string('error:update_competency_settings','local_plan'), $currenturl);
        }
    } else {
        // insert
        if(!insert_record('dp_competency_settings', $todb)) {
            rollback_sql();
            totara_set_notification(get_string('error:update_competency_settings','local_plan'), $currenturl);
        }
    }


    foreach(dp_competency_component::$permissions as $action => $requestable) {
        foreach($DP_AVAILABLE_ROLES as $role) {
            $permission_todb = new object();
            $permission_todb->templateid = $id;
            $permission_todb->component = 'competency';
            $permission_todb->action = $action;
            $permission_todb->role = $role;
            $temp = $action . $role;
            $permission_todb->value = $fromform->$temp;

            $sql = "SELECT * FROM {$CFG->prefix}dp_permissions WHERE templateid={$id} AND component='competency' AND action='{$action}' AND role='{$role}'";

            if($permission_setting = get_record_sql($sql)){
                //update
                $permission_todb->id = $permission_setting->id;
                if(!update_record('dp_permissions', $permission_todb)) {
                    rollback_sql();
                    totara_set_notification(get_string('error:update_competency_settings','local_plan'), $currenturl);
                }
            } else {
                //insert
                if(!insert_record('dp_permissions', $permission_todb)) {
                    rollback_sql();
                    totara_set_notification(get_string('error:update_competency_settings','local_plan'), $currenturl);
                }
            }
        }
    }

    commit_sql();
    add_to_log(SITEID, 'plan', 'changed workflow', "template/workflow.php?id={$id}", "Template ID:{$id}");
    totara_set_notification(get_string('update_competency_settings','local_plan'), $currenturl, array('style' => 'notifysuccess'));
}

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
 * @author Aaron Barnes <aaronb@catalyst.net.nz>
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
require_once($CFG->dirroot.'/local/plan/components/objective/objective.class.php');


/**
 * Build settings form for configurating this component
 *
 * @access  public
 * @param   object  $mform  Moodle form object
 * @param   array $customdata mform customdata
 * @return  void
 */
function dp_objective_component_build_settings_form(&$mform, $customdata) {
    global $CFG, $DP_AVAILABLE_ROLES;

    $mform->addElement('header', 'objectivesettings', get_string('objectivesettings', 'local_plan'));
    $mform->setHelpButton('objectivesettings', array('advancedsettingsobjectivesettings', get_string('objectivesettings', 'local_plan'), 'local_plan'), true);

    if ($templatesettings = get_record('dp_objective_settings', 'templateid', $customdata['id'])) {
        $defaultduedatesmode = $templatesettings->duedatemode;
        $defaultprioritymode = $templatesettings->prioritymode;
        $defaultpriorityscale = $templatesettings->priorityscale;
        $defaultobjectivescale = $templatesettings->objectivescale;
    } else {
        $defaultduedatesmode = null;
        $defaultprioritymode = null;
        $defaultpriorityscale = null;
        $defaultobjectivescale = $templatesettings->objectivescale;
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
    }
    $mform->addElement('select', 'priorityscale', get_string('priorityscale', 'local_plan'), $prioritymenu);
    $mform->disabledIf('priorityscale', 'prioritymode', 'eq', DP_PRIORITY_NONE);
    if (!empty($customdata['templateinuse'])) {
        $mform->disabledIf('priorityscale', 'prioritymode', 'neq', -777);
        $mform->addElement('static', 'priorityscalesdisabledtemplateinuse', null, get_string('priorityscalesdisabledtemplateinuse', 'local_plan'));
    }
    $mform->setDefault('priorityscale', $defaultpriorityscale);

    // objective scale selector
    $objectivemenu = array();
    if ($objectives = dp_get_objectives()){
        foreach ($objectives as $objective){
            $objectivemenu[$objective->id] = $objective->name;
        }
    }
    $mform->addElement('select', 'objectivescale', get_string('objectivescale', 'local_plan'), $objectivemenu);
    if (!empty($customdata['templateinuse'])) {
        $mform->disabledIf('objectivescale', 'prioritymode', 'neq', -777);  // bogus check that will always be false, just so we can get the element disabled
        $mform->addElement('static', 'objectivescalesdisabledtemplateinuse', null, get_string('objectivescalesdisabledtemplateinuse', 'local_plan'));
    }

    $mform->setDefault('objectivescale', $defaultobjectivescale);

    //Permissions
    $mform->addElement('header', 'objectivepermissions', get_string('objectivepermissions', 'local_plan'));
    $mform->setHelpButton('objectivepermissions', array('advancedsettingsobjectivepermissions', get_string('objectivepermissions', 'local_plan'), 'local_plan'), true);

    $mform->addElement('html', '<div class="coursepermissionsform"><table><tr>'.
        '<th>'.get_string('action', 'local_plan').'</th>'.
        '<th>'.get_string('learner', 'local_plan').'</th>'.
        '<th>'.get_string('manager', 'local_plan').'</th></tr>');

    foreach(dp_objective_component::$permissions as $action => $requestable) {
        dp_add_permissions_table_row($mform, $action, get_string($action, 'local_plan'), $requestable);
    }

    foreach(dp_objective_component::$permissions as $action => $requestable) {
        foreach($DP_AVAILABLE_ROLES as $role){
            $sql = "SELECT value FROM {$CFG->prefix}dp_permissions WHERE role='$role' AND component='objective' AND action='{$action}' AND templateid='{$customdata['id']}'";
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
function dp_objective_component_process_settings_form($fromform, $id) {
    global $CFG, $DP_AVAILABLE_ROLES;

    $currenturl = $CFG->wwwroot .
        '/local/plan/template/advancedworkflow.php?id=' . $id .
        '&amp;component=objective';

    begin_sql();
    $currentworkflow = get_field('dp_template', 'workflow', 'id', $id);
    if($currentworkflow != 'custom') {
        $template_update = new object();
        $template_update->id = $id;
        $template_update->workflow = 'custom';
        if(!update_record('dp_template', $template_update)){
            rollback_sql();
            totara_set_notification(get_string('error:update_objective_settings','local_plan'), $currenturl);
        }
    }

    $todb = new object();
    $todb->templateid = $id;
    $todb->duedatemode = $fromform->duedatemode;
    $todb->prioritymode = $fromform->prioritymode;
    $todb->objectivescale = $fromform->objectivescale;
    if (($fromform->prioritymode != DP_PRIORITY_NONE) && isset($fromform->priorityscale)){
        $todb->priorityscale = $fromform->priorityscale;
    }
    // @todo add scale info
    if($objectivesettings = get_record('dp_objective_settings', 'templateid', $id)) {
        // update
        begin_sql();
        $todb->id = $objectivesettings->id;
        if(!update_record('dp_objective_settings', $todb)) {
            rollback_sql();
            totara_set_notification(get_string('error:update_objective_settings','local_plan'), $currenturl);
        }
    } else {
        // insert
        begin_sql();
        if(!insert_record('dp_objective_settings', $todb)) {
            rollback_sql();
            totara_set_notification(get_string('error:update_objective_settings','local_plan'), $currenturl);
        }
    }


    foreach(dp_objective_component::$permissions as $action => $requestable) {
        foreach($DP_AVAILABLE_ROLES as $role) {
            $permission_todb = new object();
            $permission_todb->templateid = $id;
            $permission_todb->component = 'objective';
            $permission_todb->action = $action;
            $permission_todb->role = $role;
            $temp = $action . $role;
            $permission_todb->value = $fromform->$temp;

            $sql = "SELECT * FROM {$CFG->prefix}dp_permissions WHERE templateid={$id} AND component='objective' AND action='{$action}' AND role='{$role}'";

            if($permission_setting = get_record_sql($sql)){
                //update
                $permission_todb->id = $permission_setting->id;
                if(!update_record('dp_permissions', $permission_todb)) {
                    rollback_sql();
                    totara_set_notification(get_string('error:update_objective_settings','local_plan'), $currenturl);
                }
            } else {
                //insert
                if(!insert_record('dp_permissions', $permission_todb)) {
                    rollback_sql();
                    totara_set_notification(get_string('error:update_objective_settings','local_plan'), $currenturl);
                }
            }
        }
    }

    commit_sql();
    totara_set_notification(get_string('update_objective_settings','local_plan'), $currenturl, array('style' => 'notifysuccess'));
}

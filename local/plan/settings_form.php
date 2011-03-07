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
 * Functions for creating/processing the settings form for a development plan
 */

/**
 * Build settings form for configurating this component
 *
 * @access  public
 * @param   object  $mform  Moodle form object
 * @param   array $customdata mform customdata
 * @return  void
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

function development_plan_build_settings_form(&$mform, $customdata) {
    global $CFG, $DP_AVAILABLE_ROLES;

    //Permissions
    $mform->addElement('header', 'planpermissions', get_string('planpermissions', 'local_plan'));
    $mform->setHelpButton('planpermissions', array('advancedsettingsplanpermissions', get_string('planpermissions', 'local_plan'), 'local_plan'), true);

    $mform->addElement('html', '<div class="planpermissionsform"><table class="planpermissions"><tr>'.
        '<th>'.get_string('action', 'local_plan').'</th>'.
        '<th>'.get_string('learner', 'local_plan').'</th>'.
        '<th>'.get_string('manager', 'local_plan').'</th></tr>');

    foreach(development_plan::$permissions as $action => $requestable) {
        dp_add_permissions_table_row($mform, $action, get_string($action, 'local_plan'), $requestable);
    }

    foreach(development_plan::$permissions as $action => $requestable) {
        foreach($DP_AVAILABLE_ROLES as $role){
            $sql = "SELECT value FROM {$CFG->prefix}dp_permissions WHERE role='$role' AND component='plan' AND action='{$action}' AND templateid='{$customdata['id']}'";
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
function development_plan_process_settings_form($fromform, $id) {
    global $CFG, $DP_AVAILABLE_ROLES;

    // process plan settings here
    begin_sql();

    $currenturl = qualified_me() . '?id='.$id.'&amp;component=plan';
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

    foreach(development_plan::$permissions as $action => $requestable) {
        foreach($DP_AVAILABLE_ROLES as $role) {
            $permission_todb = new object();
            $permission_todb->templateid = $id;
            $permission_todb->component = 'plan';
            $permission_todb->action = $action;
            $permission_todb->role = $role;
            $temp = $action . $role;
            $permission_todb->value = $fromform->$temp;

            $sql = "SELECT * FROM {$CFG->prefix}dp_permissions WHERE templateid={$id} AND component='plan' AND action='{$action}' AND role='{$role}'";

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
    add_to_log(SITEID, 'plan', 'workflow setting change', "template/workflow.php?id={$id}", "Template ID:{$id}" );
    totara_set_notification(get_string('update_plan_settings','local_plan'), $currenturl, array('style' => 'notifysuccess'));
}

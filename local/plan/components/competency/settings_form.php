<?php

/**
 * Functions for creating/processing the settings form for this component
 *
 * @copyright Totara Learning Solutions Limited
 * @author Alastair Munroe <alastair@catalyst.net.nz>
 * @author Aaron Barnes <aaronb@catalyst.net.nz>
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage developmentplan
 */


// Include main component class
require_once($CFG->dirroot.'/local/plan/components/competency/competency.class.php');


/**
 * Build settings form for configurating this component
 *
 * @access  public
 * @param   object  $mform  Moodle form object
 * @param   integer $id     Template ID
 * @return  void
 */
function dp_competency_component_build_settings_form(&$mform, $id) {
    global $CFG, $DP_AVAILABLE_ROLES;

    $mform->addElement('header', 'competencysettings', get_string('competencysettings', 'local_plan'));

    if ($templatesettings = get_record('dp_competency_settings', 'templateid', $id)) {
        $defaultduedatesmode = $templatesettings->duedatemode;
        $defaultprioritymode = $templatesettings->prioritymode;
        $defaultpriorityscale = $templatesettings->priorityscale;
        $defaultautoassignpos = $templatesettings->autoassignpos;
        $defaultautoassignorg = $templatesettings->autoassignorg;
    } else {
        $defaultduedatesmode = null;
        $defaultprioritymode = null;
        $defaultpriorityscale = null;
        $defaultautoassignpos = null;
        $defaultautoassignorg = null;
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
    $mform->setDefault('priorityscale', $defaultpriorityscale);

    // auto assign options
    $autoassigngroup = array();
    $autoassigngroup[] =& $mform->createElement('advcheckbox', 'autoassignpos', null, get_string('autoassignpos', 'local_plan'));
    $autoassigngroup[] =& $mform->createElement('advcheckbox', 'autoassignorg', null, get_string('autoassignorg', 'local_plan'));

    $mform->addGroup($autoassigngroup, 'autoassign', get_string('autoassign', 'local_plan'), array('<br />'), false);
    $mform->setDefault('autoassignpos', $defaultautoassignpos);
    $mform->setDefault('autoassignorg', $defaultautoassignorg);

    //Permissions
    $mform->addElement('header', 'competencypermissions', get_string('competencypermissions', 'local_plan'));

    $mform->addElement('html', '<div class="coursepermissionsform"><table><tr>'.
        '<th>'.get_string('action', 'local_plan').'</th>'.
        '<th>'.get_string('learner', 'local_plan').'</th>'.
        '<th>'.get_string('manager', 'local_plan').'</th></tr>');

    foreach(dp_competency_component::$permissions as $action => $requestable) {
        dp_add_permissions_table_row($mform, $action, get_string($action, 'local_plan'), $requestable);
    }

    foreach(dp_competency_component::$permissions as $action => $requestable) {
        foreach($DP_AVAILABLE_ROLES as $role){
            $sql = "SELECT value FROM {$CFG->prefix}dp_permissions WHERE role='$role' AND component='competency' AND action='{$action}'";
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
    // @todo add scale info
    if($competencysettings = get_record('dp_competency_settings', 'templateid', $id)) {
        // update
        begin_sql();
        $todb->id = $competencysettings->id;
        if(!update_record('dp_competency_settings', $todb)) {
            rollback_sql();
            totara_set_notification(get_string('error:update_competency_settings','local_plan'), $currenturl);
        }
    } else {
        // insert
        begin_sql();
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
    totara_set_notification(get_string('update_competency_settings','local_plan'), $currenturl, array('style' => 'notifysuccess'));
}

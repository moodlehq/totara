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

/**
 * Workflow settings page for development plan templates
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/plan/lib.php');
require_once('template_forms.php');

$id = optional_param('id', null, PARAM_INT);
$confirm = optional_param('confirm', null, PARAM_ALPHA); // notice flag

admin_externalpage_setup('managetemplates');

if(!$template = get_record('dp_template', 'id', $id)){
    error(get_string('error:invalidtemplateid', 'local_plan'));
}

if($confirm) {
    $workflow = $confirm;
    $returnurl = $CFG->wwwroot . '/local/plan/template/workflow.php?id=' . $id;

    $classfile = $CFG->dirroot .
        "/local/plan/workflows/{$workflow}/{$workflow}.class.php";
    if(!is_readable($classfile)) {
        $string_parameters = new object();
        $string_parameters->classfile = $classfile;
        $string_parameters->workflow = $workflow;
        throw new PlanException(get_string('noclassfileforworkflow', 'local_plan', $string_parameters));
    }
    include_once($classfile);

    // check class exists
    $class = "dp_{$workflow}_workflow";
    if(!class_exists($class)) {
        $string_parameters = new object();
        $string_parameters->class = $class;
        $string_parameters->workflow = $workflow;
        throw new PlanException(get_string('noclassforworkflow', 'local_plan', $string_parameters));
    }

    // create an instance and save as a property for easy access
    $wf = new $class();

    if(!$wf->copy_to_db($template->id)) {
        totara_set_notification(get_string('error:update_workflow_settings','local_plan'), $returnurl);
    }

    // Add checking to this method
    begin_sql();
    if(!set_field('dp_template', 'workflow', $workflow, 'id', $id)){
        rollback_sql();
        totara_set_notification(get_string('error:update_workflow_settings','local_plan'), $returnurl);
    }

    commit_sql();
    totara_set_notification(get_string('update_workflow_settings','local_plan'), $returnurl, array('style' => 'notifysuccess'));

}

$mform = new dp_template_workflow_form(null,
    array('id' => $id, 'workflow' => $template->workflow));

if ($mform->is_cancelled()){
    // user cancelled form
}
elseif ($mform->no_submit_button_pressed()) {
    // user pressed advanced options button
    redirect($CFG->wwwroot . '/local/plan/template/advancedworkflow.php?id='.$id);
}

if ($fromform = $mform->get_data()) {
    $workflow = $fromform->workflow;
    $returnurl = $CFG->wwwroot . '/local/plan/template/workflow.php?id=' . $id;
    $changeurl = $CFG->wwwroot . '/local/plan/template/workflow.php?id=' . $id . '&amp;confirm=' . $workflow;
    if($workflow != 'custom') {
        // handle form submission
        if($template->workflow != $workflow) {
            admin_externalpage_print_header();
            print_heading($template->fullname);
            $classfile = $CFG->dirroot .
                "/local/plan/workflows/{$workflow}/{$workflow}.class.php";
            if(!is_readable($classfile)) {
                $string_parameters = new object();
                $string_parameters->classfile = $classfile;
                $string_parameters->workflow = $workflow;
                throw new PlanException(get_string('noclassfileforworkflow', 'local_plan', $string_parameters));
            }
            include_once($classfile);

            // check class exists
            $class = "dp_{$workflow}_workflow";
            if(!class_exists($class)) {
                $string_parameters = new object();
                $string_parameters->class = $class;
                $string_parameters->workflow = $workflow;
                throw new PlanException(get_string('noclassforworkflow', 'local_plan', $string_parameters));
            }

            // create an instance and save as a property for easy access
            $wf = new $class();
            $diff = $wf->list_differences($template->id);
            if(!$diff) {
                $differences = '<p>' . get_string('nochanges', 'local_plan') . '</p>';
            } else {
                $differences = dp_print_workflow_diff($diff);
            }

            $template_in_use = count_records('dp_plan', 'templateid', $template->id) > 0;
            $scales_locked = '';
            if($template_in_use){
                $scales_locked = '<p><b>' . get_string('scaleslocked','local_plan') . '</b></p>';
            }

            $changeworkflowconfirm = get_string('changeworkflowconfirm', 'local_plan', get_string($fromform->workflow.'workflowname', 'local_plan')) . $scales_locked . $differences;

            notice_yesno(
                $changeworkflowconfirm,
                $changeurl,
                $returnurl
            );
        } else {
            //If no change and saving just show notification with no processing
            totara_set_notification(get_string('update_workflow_settings','local_plan'), $returnurl, array('style' => 'notifysuccess'));
        }
    } else {
        // Add checking to this method
        set_field('dp_template', 'workflow', $workflow, 'id', $id);
        add_to_log(SITEID, 'plan', 'workflow setting change', "template/workflow.php?id={$id}", "Template ID:{$id}");
        totara_set_notification(get_string('update_workflow_settings','local_plan'), $returnurl, array('style' => 'notifysuccess'));
    }

} else {
    $navlinks = array();    // Breadcrumbs
    $navlinks[] = array('name'=>get_string("managetemplates", "local_plan"),
        'link'=>"{$CFG->wwwroot}/local/plan/template/index.php",
        'type'=>'misc');
    $navlinks[] = array('name'=>format_string($template->fullname), 'link'=>'', 'type'=>'misc');

    admin_externalpage_print_header('', $navlinks);

    print_heading($template->fullname);

    $currenttab = 'workflow';
    require('tabs.php');

    $mform->display();
}

admin_externalpage_print_footer();

?>

<?php // $Id$

/**
 * Workflow settings page for development plan templates
 *
 * @copyright Catalyst IT Limited
 * @author Alastair Munro
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage plan
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
        admin_externalpage_print_header();
        print_heading($template->fullname);
        // handle form submission
        if($template->workflow != $workflow) {
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
            $changeworkflowconfirm = get_string('changeworkflowconfirm', 'local_plan', get_string($fromform->workflow.'workflowname', 'local_plan')) . $differences;

            notice_yesno(
                $changeworkflowconfirm,
                $changeurl,
                $returnurl
            );
        }
    } else {
        // Add checking to this method
        set_field('dp_template', 'workflow', $workflow, 'id', $id);

        totara_set_notification(get_string('update_workflow_settings','local_plan'), $returnurl, array('style' => 'notifysuccess'));
    }

} else {
    $navlinks = array();    // Breadcrumbs
    $navlinks[] = array('name'=>get_string("managetemplates", "local_plan"),
        'link'=>"{$CFG->wwwroot}/local/plan/index.php",
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

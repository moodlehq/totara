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

$id = required_param('id', PARAM_INT);
$notice = optional_param('notice', 0, PARAM_INT); // notice flag
$component = optional_param('component', 'plan', PARAM_TEXT);


admin_externalpage_setup('managetemplates');

if(!$template = get_record('dp_template', 'id', $id)){
    error(get_string('error:invalidtemplateid', 'local_plan'));
}

$components = get_records('dp_component_settings', 'templateid', $id, 'sortorder');
$plans = count_records('dp_plan', 'templateid', $id);
if (!empty($plans)) {
    $templateinuse = true;
} else {
    $templateinuse = false;
}

$mform = new dp_template_advanced_workflow_form(null,
    array('id' => $id, 'component' => $component, 'templateinuse' => $templateinuse));

if ($mform->is_cancelled()){
    // user cancelled form
}
if ($fromform = $mform->get_data()) {

    if($component == 'plan') {
        $class = 'development_plan';
        require_once("{$CFG->dirroot}/local/plan/settings_form.php");
    } else {
        // Include each components form file
        // Component path
        $cpath = "{$CFG->dirroot}/local/plan/components/{$component}";
        $formfile  = "{$cpath}/settings_form.php";

        if(!is_readable($formfile)) {
            $string_properties = new object();
            $string_properties->classfile = $classfile;
            $string_properties->component = $component;
            throw new PlanException(get_string('noclassfileforcomponent', 'local_plan', $string_properties));
        }
        require_once($formfile);

        // Check class exists
        $class = "dp_{$component}_component";
        if(!class_exists($class)) {
            $string_properties = new object();
            $string_properties->class = $class;
            $string_properties->component = $component;
            throw new PlanException(get_string('noclassforcomponent', 'local_plan', $string_properties));
        }
    }
    if ($templateinuse) {
        unset($fromform->priorityscale);
    }

    $process_form = "{$class}_process_settings_form";
    $process_form(&$fromform, $id);

    redirect($CFG->wwwroot . '/local/plan/template/advancedworkflow.php?id='.$id.'&amp;component='.$component);
}

$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("managetemplates", "local_plan"),
    'link'=>"{$CFG->wwwroot}/local/plan/index.php",
    'type'=>'misc');
$navlinks[] = array('name'=>format_string($template->fullname), 'link'=>'', 'type'=>'misc');

admin_externalpage_print_header('', $navlinks);

if($template){
    print_heading($template->fullname);
} else {
    print_heading(get_string('newtemplate', 'local_plan'));
}

$currenttab = 'workflowplan';
require('tabs.php');

print_single_button($CFG->wwwroot.'/local/plan/template/workflow.php', array('id' => $id), get_string('simpleworkflow', 'local_plan'));

$mform->display();

admin_externalpage_print_footer();

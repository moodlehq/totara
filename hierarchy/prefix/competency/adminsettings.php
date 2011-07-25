<?php // $Id$
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/prefix/competency/adminsettings_form.php');

require_login();

global $USER;

require_capability('moodle/local:updatecompetency', get_context_instance(CONTEXT_SYSTEM));

admin_externalpage_setup('competencyglobalsettings');
admin_externalpage_print_header();

print_heading(get_string('globalsettings', 'competency'));

$form = new competency_global_settings_form();

if ($data = $form->get_data()) {
    // Save settings
    set_config('competencyuseresourcelevelevidence', empty($data->competencyuseresourcelevelevidence) ? 0 : $data->competencyuseresourcelevelevidence);
}

$data = new object();
$data->competencyuseresourcelevelevidence = get_config(null, 'competencyuseresourcelevelevidence');

$form->set_data($data);

$form->display();

admin_externalpage_print_footer();

?>

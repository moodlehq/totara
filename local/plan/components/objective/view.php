<?php

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');
require_once($CFG->dirroot . '/local/plan/lib.php');
require_once($CFG->dirroot . '/local/plan/components/objective/edit_form.php');

$id = required_param('id', PARAM_INT); // plan id
$caid = required_param('itemid', PARAM_INT); // objective assignment id

$plan = new development_plan($id);
$componentname = 'objective';
$component = $plan->get_component($componentname);

$mform = $component->objective_form($caid, 'view');
if ($data = $mform->get_data()){
    if (isset($data->edit)){
        redirect("{$CFG->wwwroot}/local/plan/components/objective/edit.php?id={$id}&itemid={$caid}");
    } elseif (isset($data->delete)){
        redirect("{$CFG->wwwroot}/local/plan/components/objective/edit.php?id={$id}&itemid={$caid}&d=1");
    }
}
//$mform = new moodleform();

$fullname = $plan->name;
$pagetitle = format_string(get_string('developmentplan','local_plan').': '.$fullname);
$navlinks = array();
$plan->get_plan_base_navlinks($navlinks);
$navlinks[] = array('name' => $fullname, 'link'=> $CFG->wwwroot . '/local/plan/view.php?id='.$id, 'type'=>'title');
$navlinks[] = array('name' => $component->get_setting('name'), 'link' => $CFG->wwwroot . '/local/plan/components/objective/index.php?id='.$id, 'type' => 'title');
$navlinks[] = array('name' => get_string('viewitem','local_plan'), 'link' => '', 'type' => 'title');

$navigation = build_navigation($navlinks);
print_header_simple($pagetitle, '', $navigation, '', null, true, '');
print $plan->display_plan_message_box();
print_heading($fullname);
print $plan->display_tabs($componentname);

print $component->display_back_to_index_link();
$mform->display();

print $component->display_linked_courses($caid);
print '<input type="submit" name="submitbutton" value="'.get_string('addremovecourses', 'local_plan').'" />';

print_footer();


?>

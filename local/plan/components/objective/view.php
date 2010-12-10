<?php

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');
require_once($CFG->dirroot . '/local/plan/lib.php');
require_once($CFG->dirroot . '/local/plan/components/objective/edit_form.php');

$id = required_param('id', PARAM_INT); // plan id
$caid = required_param('itemid', PARAM_INT); // objective assignment id

$plan = new development_plan($id);
$componentname = 'objective';
$component = $plan->get_component($componentname);

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
$component->print_objective_detail($caid, true);
if ( $canupdate = $component->can_update_items() ){

    if ( $canupdate == DP_PERMISSION_REQUEST && $component->get_approval($caid) != DP_APPROVAL_UNAPPROVED ){
        $buttonlabel = 'Edit details (will require approval)';
    } else {
        $buttonlabel = get_string('editdetails', 'local_plan');
    }
    print_single_button(
            "{$CFG->wwwroot}/local/plan/components/objective/edit.php",
            array('id'=>$id, 'itemid'=>$caid),
            $buttonlabel
    );
}
print '<br/><input type="submit" name="submitbutton" value="'.get_string('addremovecourses', 'local_plan').'" />';

print_footer();


?>

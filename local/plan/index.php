<?php

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot . '/local/plan/lib.php');

$planuser = optional_param('userid', null, PARAM_INT); // show plans for this user

if(!isset($planuser)) {
    $planuser = $USER->id;
}

require_login();

// @todo: capabilities

print_header(get_string('plans', 'local_plan'), get_string('plans', 'local_plans'));

// Plan menu
echo dp_display_plans_menu($planuser);

// Plan page content
print_container_start(false, '', 'dp-plan-content');

if($planuser != $USER->id) {
    echo dp_display_user_message_box($planuser);
}

print_heading(get_string('plans', 'local_plan'));

print_container_start(false, '', 'dp-plans-description');
echo get_string('plansinstructions', 'local_plan');
echo dp_display_add_plan_icon($planuser);
print_container_end();

print_heading(get_string('activeplans', 'local_plan'), 'left');
echo "<br>";

echo dp_display_plans($planuser, array(DP_PLAN_STATUS_APPROVED, DP_PLAN_STATUS_UNAPPROVED, DP_PLAN_STATUS_DECLINED), array('duedate', 'progress'));

print_heading(get_string('completedplans', 'local_plan'), 'left');
echo "<br>";

echo dp_display_plans($planuser, DP_PLAN_STATUS_COMPLETE, array('completed'));

print_container_end();

print_footer();

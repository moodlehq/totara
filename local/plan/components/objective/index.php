<?php

require_once('../../../../config.php');
require_once($CFG->dirroot . '/local/plan/lib.php');
require_once($CFG->dirroot . '/local/js/lib/setup.php');


///
/// Load parameters
///
$id = required_param('id', PARAM_INT); // plan id
$submitted = optional_param('submitbutton', null, PARAM_TEXT); // form submitted
$action = optional_param('action', null, PARAM_ALPHANUM); // other actions

///
/// Permissions check
///
require_capability('local/plan:accessplan', get_system_context());


///
/// Load data
///
$plan = new development_plan($id);
$componentname = 'objective';
$component = $plan->get_component($componentname);
$currenturl = $CFG->wwwroot . '/local/plan/components/objective/index.php?id='.$id;
$plancompleted = $plan->status == DP_PLAN_STATUS_COMPLETE;
$cansetduedate = ($component->get_setting('setduedate') == DP_PERMISSION_ALLOW);
$cansetpriority = ($component->get_setting('setpriority') == DP_PERMISSION_ALLOW);
$cansetprof = ($component->get_setting('setproficiency') == DP_PERMISSION_ALLOW);

if($submitted && confirm_sesskey()) {
    $component->process_objective_settings_update();
} elseif ($action && confirm_sesskey()) {
    $component->process_action($action);
}

$fullname = $plan->name;
$pagetitle = format_string(get_string('developmentplan','local_plan').': '.$fullname);
$navlinks = array();
$plan->get_plan_base_navlinks($navlinks);
$navlinks[] = array('name' => $fullname, 'link'=> $CFG->wwwroot . '/local/plan/view.php?id='.$id, 'type'=>'title');
$navlinks[] = array('name' => $component->get_setting('name'), 'link' => '', 'type' => 'title');

$navigation = build_navigation($navlinks);

///
/// Javascript stuff
///

// If we are showing dialog
if ($component->can_update_items()) {
    // Setup lightbox
    local_js(array(
        TOTARA_JS_DIALOG,
        TOTARA_JS_TREEVIEW
    ));

}

// Load datepicker JS
local_js(array(TOTARA_JS_DATEPICKER));


///
/// Display page
///
print_header_simple($pagetitle, '', $navigation, '', null, true, '');

// Plan menu
echo dp_display_plans_menu($plan->userid,$plan->id,$plan->role);

// Plan page content
print_container_start(false, '', 'dp-plan-content');

print $plan->display_plan_message_box();

print_heading($fullname);
print $plan->display_tabs($componentname);

$objective_instructions = '<div class="objective_instructions">';
if($plan->role == 'manager') {
    $objective_instructions .= get_string('objective_instructions_manager', 'local_plan');
} else {
    $objective_instructions .= get_string('objective_instructions_learner', 'local_plan');
}

$objective_instructions .= get_string('objective_instructions_detail', 'local_plan');

if ($component->get_setting('updateobjective') > DP_PERMISSION_REQUEST) {
    $objective_instructions .= get_string('objective_instructions_add', 'local_plan');
}
if ($component->get_setting('updateobjective') == DP_PERMISSION_REQUEST) {
    $objective_instructions .= get_string('objective_instructions_request', 'local_plan');
}

$objective_instructions .= '</div>';

print $objective_instructions;

if ( !$plancompleted ){
    print $component->display_picker();
}

print '<form id="dp-component-update" action="' . $currenturl . '" method="POST">';
print '<input type="hidden" id="sesskey" name="sesskey" value="'.sesskey().'" />';
print $component->display_objective_list();

if(!$plancompleted && ($cansetduedate || $cansetpriority || $cansetprof) && ($component->get_assigned_items_count()>0)) {
    print '<input type="submit" name="submitbutton" value="'.get_string('updatesettings', 'local_plan').'" />';
}

print '</form>';
print_container_end();
print_footer();

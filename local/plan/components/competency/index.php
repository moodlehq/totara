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
$delete = optional_param('d', 0, PARAM_INT); // competency assignment id to delete
$confirm = optional_param('confirm', 0, PARAM_INT); // confirm delete

///
/// Permissions check
///
require_capability('local/plan:accessplan', get_system_context());


///
/// Load data
///
$plan = new development_plan($id);
$componentname = 'competency';
$component = $plan->get_component($componentname);
$currenturl = $CFG->wwwroot . '/local/plan/components/competency/index.php?id='.$id;
$plancompleted = $plan->status == DP_PLAN_STATUS_COMPLETE;
$cansetduedate = ($component->get_setting('setduedate') == DP_PERMISSION_ALLOW);
$cansetpriority = ($component->get_setting('setpriority') == DP_PERMISSION_ALLOW);

if($submitted && confirm_sesskey()) {
    $component->process_competency_settings_update();
} elseif ($action && confirm_sesskey()) {
    $component->process_action($action);
}

if($delete && $confirm) {
    if(!confirm_sesskey()) {
        totara_set_notification(get_string('confirmsesskeybad', 'error'), $currenturl);
    }
    if($component->remove_competency_assignment($delete)) {
        $plan->set_status_unapproved_if_declined();
        totara_set_notification(get_string('canremoveitem','local_plan'), $currenturl, array('style' => 'notifysuccess'));
    } else {
        totara_set_notification(get_string('cannotremoveitem', 'local_plan'), $currenturl);
    }
}

$fullname = $plan->name;
$pagetitle = format_string(get_string('learningplan','local_plan').': '.$fullname);
$navlinks = array();
dp_get_plan_base_navlinks($navlinks, $plan->userid);
$navlinks[] = array('name' => $fullname, 'link'=> $CFG->wwwroot . '/local/plan/view.php?id='.$id, 'type'=>'title');
$navlinks[] = array('name' => $component->get_setting('name'), 'link' => '', 'type' => 'title');

$navigation = build_navigation($navlinks);

if($delete) {
    print_header_simple($pagetitle, '', $navigation, '', null, true, '');
    notice_yesno(get_string('confirmitemdelete','local_plan'), $currenturl.'&amp;d='.$delete.'&amp;confirm=1&amp;sesskey='.sesskey(), $currenturl);
    print_footer();
    die();
}


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

    // Get course picker
    require_js(array(
        $CFG->wwwroot.'/local/plan/components/competency/find.js.php'
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

$competency_instructions = '<div class="instructional_text">';

if($plan->role == 'manager') {
    $competency_instructions .= get_string('competency_instructions_manager', 'local_plan');
} else {
    $competency_instructions .= get_string('competency_instructions_learner', 'local_plan');
}

$competency_instructions .= get_string('competency_instructions_detail', 'local_plan');

if ($component->get_setting('updatecompetency') > DP_PERMISSION_REQUEST) {
    $competency_instructions .= get_string('competency_instructions_add', 'local_plan');
}
if ($component->get_setting('updatecompetency') == DP_PERMISSION_REQUEST) {
    $competency_instructions .= get_string('competency_instructions_request', 'local_plan');
}

$competency_instructions .= '</div>';

print $competency_instructions;

print '<form id="dp-component-update" action="' . $currenturl . '" method="POST">';
print '<input type="hidden" id="sesskey" name="sesskey" value="'.sesskey().'" />';

print $component->display_picker();

print $component->display_competency_list();

if((!$plancompleted && ($cansetduedate || $cansetpriority)) && $component->get_assigned_items_count()>0) {
    print '<input type="submit" name="submitbutton" value="'.get_string('updatesettings', 'local_plan').'" />';
}

print '</form>';
print_container_end();
print_footer();

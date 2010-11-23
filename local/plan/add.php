<?php

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot . '/local/plan/lib.php');

$userid = required_param('userid', PARAM_INT); // user id

require_login();

// START PERMISSION HACK
if ($userid != $USER->id) {
    // Make sure user is manager
    if (totara_is_manager($USER->id) || isadmin()) {
        $role = 'manager';
    } else {
        print_error('error:nopermissions', 'local_plan');
    }
} else {
    $role = 'learner';
}

if (dp_get_template_permission('plan', 'create', $role, null) != DP_PERMISSION_ALLOW) {
    print_error('error:nopermissions', 'local_plan');
}
// END HACK

$currenturl = qualified_me();
$allplansurl = "{$CFG->wwwroot}/local/plan/index.php?userid={$userid}";

require_once('edit_form.php');
$form = new plan_edit_form($currenturl, array('action'=>'add'));

if ($form->is_cancelled()) {
    redirect($allplansurl);
}

// Handle form submit
if ($data = $form->get_data()) {
    if (isset($data->submitbutton)) {
        // Set up the plan
        begin_sql();
        if (!$newid = insert_record('dp_plan', $data)) {
            rollback_sql();
            totara_set_notification(get_string('plancreatefail', 'local_plan'), $currenturl);
        }
        $plan = new development_plan($newid);

        // Update plan status adn plan history
        $plan->set_status(DP_PLAN_STATUS_UNAPPROVED);

        if ($plan->get_component('competency')->get_setting('enabled')) {
            // Auto-assign competencies
            $competencycomponent = $plan->get_component('competency');
            if ($competencycomponent->get_setting('autoassignorg')) {
                // From organisation
                if (!$competencycomponent->assign_from_org()) {
                    rollback_sql();
                    totara_set_notification(get_string('plancreatefail', 'local_plan'), $currenturl);
                }
            }
            if ($competencycomponent->get_setting('autoassignpos')) {
                // From position
                if (!$competencycomponent->assign_from_pos()) {
                    rollback_sql();
                    totara_set_notification(get_string('plancreatefail', 'local_plan'), $currenturl);
                }
            }
            unset($competencycomponent);
        }

        //rollback_sql();
        commit_sql();

        $viewurl = "{$CFG->wwwroot}/local/plan/view.php?id={$newid}";
        totara_set_notification(get_string('plancreatesuccess', 'local_plan'), $viewurl, array('style' => 'notifysuccess'));
    }
}

$heading = get_string('addplan', 'local_plan');
$pagetitle = format_string(get_string('developmentplan','local_plan').': '.$heading);
$navlinks = array();
$navlinks[] = array('name' => get_string('developmentplans', 'local_plan'), 'link'=> "{$CFG->wwwroot}/local/plan/index.php?userid={$userid}", 'type'=>'title');
$navlinks[] = array('name' => $heading, 'link'=> '', 'type'=>'title');

$navigation = build_navigation($navlinks);

print_header_simple($pagetitle, '', $navigation, '', null, true, '');

print_heading($heading);

$form->set_data((object)array('userid'=>$userid));
$form->display();

print_footer();

<?php

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');
require_once($CFG->dirroot . '/local/plan/lib.php');

$id = required_param('id', PARAM_INT); // plan id
$caid = required_param('itemid', PARAM_INT); // objective assignment id
$action = required_param('action', PARAM_TEXT); // what to do
$confirm = optional_param('confirm', 0, PARAM_INT); // confirm the action

$plan = new development_plan($id);
$componentname = 'objective';
$component = $plan->get_component($componentname);
$currenturl = $CFG->wwwroot . '/local/plan/components/objective/approval.php?id='.$id.'&amp;itemid='.$caid.'&amp;action='.$action;
$returnurl = $CFG->wwwroot . '/local/plan/components/objective/index.php?id='.$id;
$canapproveobjective = $component->get_setting('updateobjective') == DP_PERMISSION_APPROVE;

if($confirm) {
    if(!confirm_sesskey()) {
        totara_set_notification(get_string('confirmsesskeybad','error'), $returnurl);
    }
    if(!$canapproveobjective) {
        // no permission to complete the action
        totara_set_notification(get_string('nopermission', 'local_plan'),
            $returnurl);
        die();
    }

    $todb = new object();
    $todb->id = $caid;
    if($action=='decline') {
        $todb->approved = DP_APPROVAL_DECLINED;
    } else if ($action == 'approve') {
        $todb->approved = DP_APPROVAL_APPROVED;
    }

    if(update_record('dp_plan_objective', $todb)) {
        //@todo send notifications/emails
        totara_set_notification(get_string('request'.$action,'local_plan'), $returnurl, array('style' => 'notifysuccess'));
    } else {
        //@todo send notifications/emails
        totara_set_notification(get_string('requestnot'.$action, 'local_plan'), $returnurl);
    }

}

$fullname = $plan->name;
$pagetitle = format_string(get_string('developmentplan','local_plan').': '.$fullname);
$navlinks = array();
dp_get_plan_base_navlinks($navlinks, $plan->userid);
$navlinks[] = array('name' => $fullname, 'link'=> $CFG->wwwroot . '/local/plan/view.php?id='.$id, 'type'=>'title');
$navlinks[] = array('name' => $component->get_setting('name'), 'link' => $CFG->wwwroot . '/local/plan/components/objective/index.php?id='.$id, 'type' => 'title');
$navlinks[] = array('name' => get_string('itemapproval','local_plan'), 'link' => '', 'type' => 'title');

$navigation = build_navigation($navlinks);

print_header_simple($pagetitle, '', $navigation, '', null, true, '');

print_heading($fullname);

notice_yesno(get_string('confirmrequest'.$action, 'local_plan'),
    $currenturl.'&amp;confirm=1&amp;sesskey='.sesskey(),
    $returnurl
);

$component->print_objective_detail($caid);


print_footer();


?>

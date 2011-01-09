<?php

require_once('../../../../config.php');
require_once($CFG->dirroot . '/local/plan/lib.php');
require_once($CFG->dirroot . '/local/plan/components/course/rpl_form.php');

$planid = required_param('planid', PARAM_INT);
$courseid = required_param('courseid', PARAM_INT);

$plan = new development_plan($planid);

$userid = $plan->userid;
$componentname = 'course';
$component = $plan->get_component($componentname);

if($component->get_setting('setcompletionstatus') != DP_PERMISSION_ALLOW) {
    error(get_string('error:coursecompletionpermission', 'local_plan'));
}

$rpl = get_record('course_completions', 'userid', $userid, 'course', $courseid);

$mform = new totara_course_rpl_form(null, compact('planid','courseid','userid'));
$mform->set_data($rpl);

$returnurl = $CFG->wwwroot.'/local/plan/components/course?id='.$planid;

if ($mform->is_cancelled()) {
    redirect($returnurl);
}
if ($fromform = $mform->get_data()) {
    if(empty($fromform->submitbutton)) {
        totara_set_notification(get_string('error:unknownbuttonclicked', 'local_plan'), $returnurl);
    }

    $course = new object();
    $course->id = $courseid;
    $info = new completion_info($course);
    $rpl = $fromform->rpl;

    // Get completion object
    $params = array(
        'userid'    => $fromform->userid,
        'course'    => $fromform->courseid
    );

    // Completion
    // Load course completion
    $completion = new completion_completion($params);

    /// Complete user
    if (strlen($rpl)) {
        $completion->rpl = addslashes($rpl);
        $completion->mark_complete();

        // If no RPL, uncomplete user, and let aggregation do its thing
    } else {
        $completion->delete();
    }

    totara_set_notification(get_string('rplupdated', 'local_plan'),
        $CFG->wwwroot.'/local/plan/components/course/index.php?id='.$planid, array('style'=>'notifysuccess'));
}


$fullname = $plan->name;
$pagetitle = format_string(get_string('learningplan','local_plan').': '.$fullname);
$navlinks = array();
dp_get_plan_base_navlinks($navlinks, $plan->userid);
$navlinks[] = array('name' => $fullname, 'link'=> $CFG->wwwroot . '/local/plan/view.php?id='.$planid, 'type'=>'title');
$navlinks[] = array('name' => $component->get_setting('name'), 'link' => '', 'type' => 'title');

$navigation = build_navigation($navlinks);

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

$mform->display();

print_container_end();
print_footer();

?>

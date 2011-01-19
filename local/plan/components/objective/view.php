<?php

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');
require_once($CFG->dirroot . '/local/plan/lib.php');
require_once($CFG->dirroot . '/local/plan/components/objective/edit_form.php');
require_once($CFG->dirroot . '/local/js/lib/setup.php');

$id = required_param('id', PARAM_INT); // plan id
$caid = required_param('itemid', PARAM_INT); // objective assignment id

$plan = new development_plan($id);
$plancompleted = $plan->status == DP_PLAN_STATUS_COMPLETE;
$componentname = 'objective';
$component = $plan->get_component($componentname);
$objectivename = get_string($componentname, 'local_plan');
$coursename = get_string('courseplural', 'local_plan');

/// Javascript stuff
// If we are showing dialog
if ($component->can_update_items()) {
    // Setup lightbox
    local_js(array(
        TOTARA_JS_DIALOG,
        TOTARA_JS_TREEVIEW
    ));

    // Get course picker
    require_js(array(
        $CFG->wwwroot.'/local/plan/components/objective/find-course.js.php'
    ));
}

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
$pagetitle = format_string(get_string('learningplan','local_plan').': '.$fullname);
$navlinks = array();
dp_get_plan_base_navlinks($navlinks, $plan->userid);
$navlinks[] = array('name' => $fullname, 'link'=> $CFG->wwwroot . '/local/plan/view.php?id='.$id, 'type'=>'title');
$navlinks[] = array('name' => get_string($component->component, 'local_plan'), 'link' => $component->get_url(), 'type' => 'title');
$navlinks[] = array('name' => get_string('viewitem','local_plan'), 'link' => '', 'type' => 'title');

$navigation = build_navigation($navlinks);

$plan->print_header($componentname, $navlinks, false);

print $component->display_back_to_index_link();
if ( !$plancompleted && ($canupdate = $component->can_update_items()) ){

    if ( $component->will_an_update_revoke_approval( $caid ) ){
        $buttonlabel = get_string('editdetailswithapproval', 'local_plan');
    } else {
        $buttonlabel = get_string('editdetails', 'local_plan');
    }
    print_single_button(
            "{$CFG->wwwroot}/local/plan/components/objective/edit.php",
            array('id'=>$id, 'itemid'=>$caid),
            $buttonlabel
    );
}
$component->display_objective_detail($caid, true);

if ( !$plancompleted ){
    print $component->display_course_picker($caid);
}

if ( $plan->get_component('course')->get_setting('enabled') ){
    print '<h3>' . get_string('linkedx', 'local_plan', $coursename) . '</h3>';
    print '<div id="dp-objective-courses-container">';
    if($linkedcourses =
        $component->get_linked_components($caid, 'course')) {
        print $plan->get_component('course')->display_linked_courses($linkedcourses);
    } else {
        print '<p class="noitems-assigncourses">' . get_string('nolinkedx', 'local_plan', $coursename). '</p>';
    }
    print '</div>';

}

print_container_end();

print_footer();


?>

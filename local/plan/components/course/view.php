<?php

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');
require_once($CFG->dirroot . '/local/plan/lib.php');

$id = required_param('id', PARAM_INT); // plan id
$caid = required_param('itemid', PARAM_INT); // course assignment id

$plan = new development_plan($id);
$componentname = 'course';
$component = $plan->get_component($componentname);
$currenturl = $CFG->wwwroot . '/local/plan/components/course/view.php?id='.$id.'&amp;itemid='.$caid;
$competenciesenabled = $plan->get_component('competency')->get_setting('enabled');
$competencyname = $plan->get_component('competency')->get_setting('name');
$objectivesenabled = $plan->get_component('objective')->get_setting('enabled');
$objectivename = $plan->get_component('objective')->get_setting('name');

$fullname = $plan->name;
$pagetitle = format_string(get_string('learningplan','local_plan').': '.$fullname);
$navlinks = array();
dp_get_plan_base_navlinks($navlinks, $plan->userid);
$navlinks[] = array('name' => $fullname, 'link'=> $CFG->wwwroot . '/local/plan/view.php?id='.$id, 'type'=>'title');
$navlinks[] = array('name' => $component->get_setting('name'), 'link' => $CFG->wwwroot . '/local/plan/components/course/index.php?id='.$id, 'type' => 'title');
$navlinks[] = array('name' => get_string('viewitem','local_plan'), 'link' => '', 'type' => 'title');

$navigation = build_navigation($navlinks);

print_header_simple($pagetitle, '', $navigation, '', null, true, '');

print $plan->display_plan_message_box();

print_heading($fullname);

print $plan->display_tabs($componentname);

print $component->display_back_to_index_link();

print $component->display_course_detail($caid);

if($competenciesenabled) {
    print '<h3>' . get_string('linkedx', 'local_plan', $competencyname) . '</h3>';
    if($linkedcomps = $component->get_linked_components($caid, 'competency')) {
        print $plan->get_component('competency')->display_linked_competencies($linkedcomps);
    } else {
        print '<p>' . get_string('nolinkedx', 'local_plan', $competencyname). '</p>';
    }
}

if ($objectivesenabled){
    print '<h3>' . get_string('linkedx', 'local_plan', $objectivename) . '</h3>';
    if ( $linkedobjectives = $component->get_linked_components( $caid, 'objective' )){
        print $plan->get_component('objective')->display_linked_objectives($linkedobjectives);
    } else {
        print '<p>' . get_string('nolinkedx', 'local_plan', $objectivename) . '</p>';
    }
}

print_footer();


?>

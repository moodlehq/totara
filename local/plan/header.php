<?php

/**
 * Generate header including plan details
 *
 * Expects the following variables to be set:
 *
 * - $plan              Plan instance
 * - $currenttab        Current tab
 * - $is_component      Optional
 */

defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot.'/local/js/lib/setup.php');


$fullname = $plan->name;
$pagetitle = format_string(get_string('learningplan', 'local_plan').': '.$fullname);
$navlinks = array();

dp_get_plan_base_navlinks($navlinks, $plan->userid);

$navlinks[] = array('name' => $fullname, 'link'=> '', 'type'=>'title');

if (isset($navlink)) {
    $navlinks[] = $navlink;
}

$navigation = build_navigation($navlinks);

//Javascript include
local_js(array(
    TOTARA_JS_DATEPICKER,
    $CFG->wwwroot.'/local/js/plan.form.datepick.js'
));


print_header_simple($pagetitle, '', $navigation, '', null, true, '');


// Run post header hook (if this is a component)
if (isset($is_component)) {
    $component->post_header_hook();
}


// Plan menu
echo dp_display_plans_menu($plan->userid, $plan->id, $plan->role);

// Plan page content
print_container_start(false, '', 'dp-plan-content');

echo $plan->display_plan_message_box();

print_heading($fullname);


//
// Display tabs
//
function lp_display_tabs($plan, $currenttab) {
    global $CFG;

    $tabs = array();
    $row = array();
    $activated = array();
    $inactive = array();

    // Overview tab
    $row[] = new tabobject(
            'plan',
            "{$CFG->wwwroot}/local/plan/view.php?id={$plan->id}",
            get_string('overview', 'local_plan')
    );

    // get active components in correct order
    $components = $plan->get_setting('components');

    if ($components) {
        foreach ($components as $component) {
            // don't show tabs for disabled components
            if (!$component->enabled) {
                continue;
            }
            $componentname = get_string("{$component->component}plural", 'local_plan');

            $row[] = new tabobject(
                $component->component,
                $plan->get_component($component->component)->get_url(),
                $componentname
            );
        }
    }

    // requested items tabs
    if ($pitems = $plan->num_pendingitems()) {
        $row[] = new tabobject(
            'pendingitems',
            "{$CFG->wwwroot}/local/plan/approve.php?id={$plan->id}",
            get_string('pendingitems', 'local_plan').' ('.$pitems.')'
        );
    }

    $tabs[] = $row;
    $activated[] = $currenttab;

    return print_tabs($tabs, $currenttab, $inactive, $activated, true);
}


echo lp_display_tabs($plan, $currenttab);


//
// Display instructions
//
$instructions = '<div class="instructional_text">';
if ($plan->role == 'manager') {
    $instructions .= get_string($currenttab.'_instructions_manager', 'local_plan');
} else {
    $instructions .= get_string($currenttab.'_instructions_learner', 'local_plan');
}

// If this a component
if (isset($is_component)) {

    $instructions .= get_string($currenttab.'_instructions_detail', 'local_plan');

    if ($component->get_setting('update'.$currenttab) > DP_PERMISSION_REQUEST) {
        $instructions .= get_string($currenttab.'_instructions_add', 'local_plan');
    }
    if ($component->get_setting('update'.$currenttab) == DP_PERMISSION_REQUEST) {
        $instructions .= get_string($currenttab.'_instructions_request', 'local_plan');
    }
}

$instructions .= '</div>';

print $instructions;

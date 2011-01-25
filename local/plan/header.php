<?php

/**
 * Generate header including plan details
 *
 * Only included via development_plan::print_header()
 *
 * The following variables will be set:
 *
 * - $this              Plan instance
 * - $CFG               Config global
 * - $currenttab        Current tab
 * - $navlinks          Additional breadcrumbs (optional)
 */

(defined('MOODLE_INTERNAL') && isset($this)) || die();
require_once($CFG->dirroot.'/local/js/lib/setup.php');

// Check if this is a component
if (array_key_exists($currenttab, $this->get_components())) {
    $component = $this->get_component($currenttab);
    $is_component = true;
}
else {
    $is_component = false;
}

$fullname = $this->name;
$pagetitle = format_string(get_string('learningplan', 'local_plan').': '.$fullname);
$breadcrumbs = array();

dp_get_plan_base_navlinks($breadcrumbs, $this->userid);

$breadcrumbs[] = array('name' => $fullname, 'link'=> '', 'type'=> 'title');

if (!empty($navlinks)) {
    $breadcrumbs += $navlinks;
}

$navigation = build_navigation($breadcrumbs);

//Javascript include
local_js(array(
    TOTARA_JS_DATEPICKER,
    $CFG->wwwroot.'/local/js/plan.form.datepick.js'
));


print_header_simple($pagetitle, '', $navigation, '', null, true, '');


// Run post header hook (if this is a component)
if ($is_component) {
    $component->post_header_hook();
}


// Plan menu
echo dp_display_plans_menu($this->userid, $this->id, $this->role);

// Plan page content
print_container_start(false, '', 'dp-plan-content');

// Display the managers view if appropriate
if ($this->role == 'manager') {
    echo dp_display_manager_overview($this->userid);
}

echo $this->display_plan_message_box();

print_heading('<span class="dp-plan-prefix">'.get_string('plan','local_plan') . ':</span> ' . $fullname);

print $this->display_tabs($currenttab);

if ($printinstructions) {
    //
    // Display instructions
    //
    $instructions = '<div class="instructional_text">';
    if ($this->role == 'manager') {
        $instructions .= get_string($currenttab.'_instructions_manager', 'local_plan');
    } else {
        $instructions .= get_string($currenttab.'_instructions_learner', 'local_plan');
    }

    // If this a component
    if ($is_component) {
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
}

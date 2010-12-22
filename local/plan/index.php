<?php
/**
 * Learning plans overview page
 *
 * @copyright Catalyst IT Limited
 * @author Eugene Venter
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage plan
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot . '/local/plan/lib.php');

$planuser = optional_param('userid', $USER->id, PARAM_INT); // show plans for this user


//
/// Permission checks
//
require_login();
require_capability('local/plan:accessplan', get_system_context());

// Check if we are viewing these plans as a manager or a learner
if ($planuser != $USER->id) {
    // Make sure user is manager
    if (totara_is_manager($planuser) || isadmin()) {
        $role = 'manager';
    } else {
        print_error('error:nopermissions', 'local_plan');
    }
} else {
    $role = 'learner';
}

if (!$template = dp_get_first_template()) {
    print_error('notemplatesetup', 'local_plan');
}

// Check if we can view these plans
if (dp_get_template_permission($template->id, 'plan', 'view', $role) != DP_PERMISSION_ALLOW) {
    print_error('error:nopermissions', 'local_plan');
}
$canaddplan = (dp_get_template_permission($template->id, 'plan', 'create', $role) == DP_PERMISSION_ALLOW);



//
// Display plan list
//
$heading = get_string('learningplans', 'local_plan');
$pagetitle = format_string(get_string('learningplans','local_plan'));
$navlinks = array();

dp_get_plan_base_navlinks($navlinks, $planuser);

$navigation = build_navigation($navlinks);
print_header($heading, $pagetitle, $navigation);

// Plan menu
echo dp_display_plans_menu($planuser,0,$role);

// Plan page content
print_container_start(false, '', 'dp-plan-content');

if($planuser != $USER->id) {
    echo dp_display_user_message_box($planuser);
}

print_heading($heading);

print_container_start(false, '', 'dp-plans-description');
$planinstructions = '<div class="instructional_text">' . get_string('planinstructions', 'local_plan');
if($canaddplan) {
    $planinstructions .= get_string('planinstructions_add', 'local_plan');
}
$planinstructions .= '</div>';

echo $planinstructions;

if ($canaddplan) {
    echo dp_display_add_plan_icon($planuser);
}
echo '<div style="clear:both;"></div>';
print_container_end();

print_container_start(false, '', 'dp-plans-list-active-plans');
echo dp_display_plans($planuser, array(DP_PLAN_STATUS_APPROVED, DP_PLAN_STATUS_UNAPPROVED, DP_PLAN_STATUS_DECLINED), array('activeplans', 'duedate', 'progress'));
print_container_end();

print_container_start(false, '', 'dp-plans-list-completed-plans');
echo dp_display_plans($planuser, DP_PLAN_STATUS_COMPLETE, array('completedplans','completed'));
print_container_end();

print_container_end();

print_footer();

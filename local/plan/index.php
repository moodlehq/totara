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

require_login();
require_capability('local/plan:accessplan', get_system_context());

// START PERMISSION HACK
if ($planuser != $USER->id) {
    // Make sure user is manager
    if (totara_is_manager($USER->id) || isadmin()) {
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

if (dp_get_template_permission($template->id, 'plan', 'view', $role) != DP_PERMISSION_ALLOW) {
    print_error('error:nopermissions', 'local_plan');
}
$canaddplan = (dp_get_template_permission($template->id, 'plan', 'create', $role) == DP_PERMISSION_ALLOW);
// END HACK

print_header(get_string('plans', 'local_plan'), get_string('plans', 'local_plans'));

// Plan menu
echo dp_display_plans_menu($planuser);

// Plan page content
print_container_start(false, '', 'dp-plan-content');

if($planuser != $USER->id) {
    echo dp_display_user_message_box($planuser);
}

print_heading(get_string('plans', 'local_plan'));

print_container_start(false, '', 'dp-plans-description');
echo get_string('plansinstructions', 'local_plan');
if ($canaddplan) {
    echo dp_display_add_plan_icon($planuser);
}
print_container_end();

print_heading(get_string('activeplans', 'local_plan'), 'left');
echo "<br>";

echo dp_display_plans($planuser, array(DP_PLAN_STATUS_APPROVED, DP_PLAN_STATUS_UNAPPROVED, DP_PLAN_STATUS_DECLINED), array('duedate', 'progress'));

print_heading(get_string('completedplans', 'local_plan'), 'left');
echo "<br>";

echo dp_display_plans($planuser, DP_PLAN_STATUS_COMPLETE, array('completed'));

print_container_end();

print_footer();

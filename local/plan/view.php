<?php
/**
 * Plan view page
 *
 * @copyright Catalyst IT Limited
 * @author Eugene Venter
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage plan
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot . '/local/plan/lib.php');

$id = required_param('id', PARAM_INT); // plan id
$action = optional_param('action', 'view', PARAM_TEXT);

$componentname = 'plan';

$currenturl = qualified_me();
$viewurl = strip_querystring(qualified_me())."?id={$id}&action=view";
$editurl = strip_querystring(qualified_me())."?id={$id}&action=edit";

$plan = new development_plan($id);

require_once('edit_form.php');
$form = new plan_edit_form($currenturl, array('plan'=>$plan, 'action'=>$action));

if ($form->is_cancelled()) {
    totara_set_notification(get_string('planupdatecancelled', 'local_plan'), $viewurl);
}

if ($plan->get_setting('view') != DP_PERMISSION_ALLOW) {
    print_error('error:nopermissions', 'local_plan');
}

// Handle form submits
if ($data = $form->get_data()) {
    if (isset($data->edit)) {
        if ($plan->get_setting('update') < DP_PERMISSION_ALLOW) {
            print_error('error:nopermissions', 'local_plan');
        }
        redirect($editurl);
    } elseif (isset($data->delete)) {
        if ($plan->get_setting('delete') < DP_PERMISSION_ALLOW) {
            print_error('error:nopermissions', 'local_plan');
        }
        redirect(strip_querystring(qualified_me())."?id={$id}&action=delete");
    } elseif (isset($data->deleteyes)) {
        if ($plan->get_setting('delete') < DP_PERMISSION_ALLOW) {
            print_error('error:nopermissions', 'local_plan');
        }
        if ($plan->delete()) {
            totara_set_notification(get_string('plandeletesuccess', 'local_plan'), "{$CFG->wwwroot}/local/plan/index.php?userid={$plan->userid}", array('style' => 'notifysuccess'));
        } else {
            totara_set_notification(get_string('plandeletefail', 'local_plan'), $viewurl);
        }
    } elseif (isset($data->deleteno)) {
        redirect($viewurl);
    } elseif (isset($data->submitbutton)) {
        if ($plan->get_setting('update') < DP_PERMISSION_ALLOW) {
            print_error('error:nopermissions', 'local_plan');
        }
        // Save plan data
        if (!update_record('dp_plan', $data)) {
            totara_set_notification(get_string('planupdatefail', 'local_plan'), $editurl);
        }
        totara_set_notification(get_string('planupdatesuccess', 'local_plan'), $viewurl, array('style' => 'notifysuccess'));
    }

    // Reload plan to reflect any changes
    $plan = new development_plan($id);
}


$fullname = $plan->name;
$pagetitle = format_string(get_string('developmentplan','local_plan').': '.$fullname);
$navlinks = array();
$plan->get_plan_base_navlinks($navlinks);
$navlinks[] = array('name' => $fullname, 'link'=> '', 'type'=>'title');

$navigation = build_navigation($navlinks);

print_header_simple($pagetitle, '', $navigation, '', null, true, '');

echo $plan->display_plan_message_box();

print_heading($fullname);

echo $plan->display_tabs($componentname);

// Plan details
$form->set_data($plan);
$form->display();

// Comments
// @todo!!

print_footer();

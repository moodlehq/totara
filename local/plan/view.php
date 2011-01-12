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

if ($action == 'edit') {
    require_once($CFG->dirroot . '/local/js/lib/setup.php');

    //Javascript include
    local_js(array(
        TOTARA_JS_DATEPICKER
    ));
}

$componentname = 'plan';

$currenturl = qualified_me();
$viewurl = strip_querystring(qualified_me())."?id={$id}&action=view";
$editurl = strip_querystring(qualified_me())."?id={$id}&action=edit";

$plan = new development_plan($id);

if (!dp_can_view_users_plans($plan->userid)) {
    print_error('error:nopermissions', 'local_plan');
}

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
            totara_set_notification(get_string('plandeletesuccess', 'local_plan', $plan->name), "{$CFG->wwwroot}/local/plan/index.php?userid={$plan->userid}", array('style' => 'notifysuccess'));
        } else {
            totara_set_notification(get_string('plandeletefail', 'local_plan', $plan->name), $viewurl);
        }
    } elseif (isset($data->deleteno)) {
        redirect($viewurl);
    } elseif (isset($data->signoff)) {
        if ($plan->get_setting('signoff') < DP_PERMISSION_ALLOW) {
            print_error('error:nopermissions', 'local_plan');
        }
        redirect(strip_querystring(qualified_me())."?id={$id}&action=signoff");
    } elseif (isset($data->signoffyes)) {
        if ($plan->get_setting('signoff') < DP_PERMISSION_ALLOW) {
            print_error('error:nopermissions', 'local_plan');
        }
        if ($plan->set_status(DP_PLAN_STATUS_COMPLETE)) {
            $plan->send_completion_notification();
            totara_set_notification(get_string('plancompletesuccess', 'local_plan', $plan->name), $viewurl, array('style' => 'notifysuccess'));
        } else {
            totara_set_notification(get_string('plancompletefail', 'local_plan', $plan->name), $viewurl);
        }
    } elseif (isset($data->signoffno)) {
        redirect($viewurl);
    } elseif (isset($data->submitbutton)) {
        if ($plan->get_setting('update') < DP_PERMISSION_ALLOW) {
            print_error('error:nopermissions', 'local_plan');
        }
        // Save plan data
        unset($data->startdate);
        $data->enddate = dp_convert_userdate($data->enddate);  // convert to timestamp
        if (!update_record('dp_plan', $data)) {
            totara_set_notification(get_string('planupdatefail', 'local_plan'), $editurl);
        }

        totara_set_notification(get_string('planupdatesuccess', 'local_plan'), $viewurl, array('style' => 'notifysuccess'));
    }

    // Reload plan to reflect any changes
    $plan = new development_plan($id);
}


/**
 * Display header
 */
$currenttab = 'plan';
include($CFG->dirroot.'/local/plan/header.php');


// Plan details
$plan->enddate = userdate($plan->enddate, '%d/%m/%Y', $CFG->timezone, false);
$form->set_data($plan);
$form->display();

print_container_end();

if ($action == 'edit') {
print <<<HEREDOC
<script type="text/javascript">

    $(function() {
        $('input[name="enddate"]').datepicker(
            {
                dateFormat: 'dd/mm/yy',
                showOn: 'button',
                buttonImage: '{$CFG->wwwroot}/local/js/images/calendar.gif',
                buttonImageOnly: true
            }
        );
    });
</script>
HEREDOC;
}

print_footer();

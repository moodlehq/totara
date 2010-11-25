<?php
/**
 * This script will perform general plan actions that can be posted from a number of pages
 * This script can also later be used by AJAX requests
 *
 * @copyright Catalyst IT Limited
 * @author Eugene Venter
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage plan
 */

require_once('../../config.php');
require_once('lib.php');

require_login();
require_capability('local/plan:accessplan', get_system_context());

$id = required_param('id', PARAM_INT);      // the plan id
// Action params
$approve = optional_param('approve', 0, PARAM_BOOL);
$decline = optional_param('decline', 0, PARAM_BOOL);
$approvalrequest = optional_param('approvalrequest', 0, PARAM_BOOL);
$delete = optional_param('delete', 0, PARAM_BOOL);
$signoff = optional_param('signoff', 0, PARAM_BOOL);

// Is this an ajax call?
$ajax = optional_param('ajax', 0, PARAM_BOOL);


$referer = optional_param('referer', get_referer(false), PARAM_URL);

if (!confirm_sesskey()) {
    if (empty($ajax)) {
        redirect($referer);
    } else {
        return;
    }
}


$plan = new development_plan($id);

if (!empty($approve)) {
    if (in_array($plan->get_setting('confirm'), array(DP_PERMISSION_ALLOW, DP_PERMISSION_APPROVE))) {
       $plan->set_status(DP_PLAN_STATUS_APPROVED);
    }
    if (empty($ajax)) {
        totara_set_notification(get_string('planapproved', 'local_plan', $plan->name), $referer, array('style' => 'notifysuccess'));
    }

} elseif (!empty($decline)) {
    if (in_array($plan->get_setting('confirm'), array(DP_PERMISSION_ALLOW, DP_PERMISSION_APPROVE))) {
        $plan->set_status(DP_PLAN_STATUS_DECLINED);
    }

   if (empty($ajax)) {
        totara_set_notification(get_string('plandeclined', 'local_plan', $plan->name), $referer, array('style' => 'notifysuccess'));
    }
} elseif (!empty($approvalrequest)) {
    if ($plan->get_setting('confirm') == DP_PERMISSION_REQUEST) {
        /*
        require_once($CFG->dirroot.'/local/totara_msg/messagelib.php');
        $event = new stdClass;
        $user = get_record('user', 'id', 2);
        $event->userto = $user;
        $event->fullmessage = "Approve my plan!!";
        tm_reminder_send($event);
        */
        // @todo: send approval request email to relevant parties
    }
    if (empty($ajax)) {
        totara_set_notification(get_string('approvalrequestsent', 'local_plan', $plan->name), $referer, array('style' => 'notifysuccess'));
    }

} elseif (!empty($delete)) {
    if ($plan->get_setting('delete') == DP_PERMISSION_ALLOW) {
        $confirm = optional_param('confirm', 0, PARAM_BOOL);

        if (!$confirm && empty($ajax)) {
            // Show confirmation message
            print_header_simple();
            $confirmurl = new moodle_url(qualified_me());
            $confirmurl->param('confirm', 'true');
            $confirmurl->param('referer', $referer);
            $strdelete = get_string('checkplandelete', 'local_plan', $plan->name);
            notice_yesno(
                "{$strdelete}<br /><br />".format_string($plan->name),
                $confirmurl->out(),
                $referer
            );

            print_footer();
            exit;
        } else {
            // Delete the plan
            $plan->delete();
        }
    }
    if (empty($ajax)) {
        totara_set_notification(get_string('plandeletesuccess', 'local_plan', $plan->name), $referer, array('style' => 'notifysuccess'));
    }
} elseif (!empty($signoff)) {
    if ($plan->get_setting('signoff') == DP_PERMISSION_ALLOW) {
        $confirm = optional_param('confirm', 0, PARAM_BOOL);

        if (!$confirm && empty($ajax)) {
            // Show confirmation message
            print_header_simple();
            $confirmurl = new moodle_url(qualified_me());
            $confirmurl->param('confirm', 'true');
            $confirmurl->param('referer', $referer);
            $strdelete = get_string('checkplancomplete', 'local_plan', $plan->name);
            notice_yesno(
                "{$strdelete}<br /><br />".format_string($plan->name),
                $confirmurl->out(),
                $referer
            );

            print_footer();
            exit;
        } else {
            // Set plan status to complete
            $plan->set_status(DP_PLAN_STATUS_COMPLETE);
        }
    }
    if (empty($ajax)) {
        totara_set_notification(get_string('plancompletesuccess', 'local_plan', $plan->name), $referer, array('style' => 'notifysuccess'));
    }
}

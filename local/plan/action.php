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

$referer = get_referer(false);

if (!confirm_sesskey()) {
    redirect($referer);
}

$id = required_param('id', PARAM_INT);
$approve = optional_param('approve', 0, PARAM_ALPHANUM);
$decline = optional_param('decline', 0, PARAM_ALPHANUM);
$approvalrequest = optional_param('approvalrequest', 0, PARAM_ALPHANUM);
$redirect = optional_param('redirect', 1, PARAM_BOOL);

$plan = new development_plan($id);

if (!empty($approve)) {
    if ($plan->get_setting('confirm') == DP_PERMISSION_APPROVE) {
        $plan->set_status(DP_PLAN_STATUS_APPROVED);
       if (!empty($redirect)) {
            totara_set_notification(get_string('planapproved', 'local_plan'), $referer, array('style' => 'notifysuccess'));
        }
    }
} elseif (!empty($decline)) {
    if ($plan->get_setting('confirm') == DP_PERMISSION_APPROVE) {
        $plan->set_status(DP_PLAN_STATUS_DECLINED);
       if (!empty($redirect)) {
            totara_set_notification(get_string('plandeclined', 'local_plan'), $referer, array('style' => 'notifysuccess'));
        }

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
        if (!empty($redirect)) {
            totara_set_notification(get_string('approvalrequestsent', 'local_plan'), $referer, array('style' => 'notifysuccess'));
        }
    }
}

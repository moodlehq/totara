<?php
/**
 *
 * @author  Piers Harding  piers@catalyst.net.nz
 * @version 0.0.1
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package local
 * @subpackage totara_msg
 *
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/local/plan/lib.php');

/**
* Extend the base plugin class
* This class contains the action for IDP plan onaccept/onreject message processing
*/
class totara_msg_workflow_plan extends totara_msg_workflow_plugin_base {

    /**
     * Action called on accept for plan action
     *
     * @param array $eventdata
     * @param object $msg
     */
    function onaccept($eventdata, $msg) {
        global $USER, $CFG;

        // Load course
        $userid = $eventdata['userid'];
        $planid = $eventdata['planid'];
        $plan = new development_plan($planid);
        if (!$plan) {
            print_error('planidnotfound', 'local_plan', $planid);
        }

        if (!in_array($plan->get_setting('confirm'), array(DP_PERMISSION_ALLOW, DP_PERMISSION_APPROVE))) {
            return false;
        }
        $plan->set_status(DP_PLAN_STATUS_APPROVED);
        return $plan->send_approved_notification();
    }


    /**
     * Action called on reject of a plan action
     *
     * @param array $eventdata
     * @param object $msg
     */
    function onreject($eventdata, $msg) {
        global $USER, $CFG;

        // can manipulate the language by setting $SESSION->lang temporarily
        // Load course
        $userid = $eventdata['userid'];
        $planid = $eventdata['planid'];
        $plan = new development_plan($planid);
        if (!$plan) {
            print_error('planidnotfound', 'local_plan', $planid);
        }

        if (!in_array($plan->get_setting('confirm'), array(DP_PERMISSION_ALLOW, DP_PERMISSION_APPROVE))) {
            return false;
        }
        $plan->set_status(DP_PLAN_STATUS_DECLINED);
        return $plan->send_declined_notification();
    }
}

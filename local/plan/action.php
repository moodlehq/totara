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
require_once($CFG->dirroot.'/local/totara_msg/messagelib.php');

///
/// Params
///

// Plan param
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



///
/// Load plan
///
$plan = new development_plan($id);


///
/// Permissions check
///
if (!dp_can_view_users_plans($plan->userid)) {
    print_error('error:nopermissions', 'local_plan');
}


// @todo: handle action failure notifications
///
/// Approve
///
if (!empty($approve)) {
    if (in_array($plan->get_setting('confirm'), array(DP_PERMISSION_ALLOW, DP_PERMISSION_APPROVE))) {
       $plan->set_status(DP_PLAN_STATUS_APPROVED);
       $plan->send_approved_notification();
       totara_set_notification(get_string('planapproved', 'local_plan', $plan->name), $referer, array('style' => 'notifysuccess'));
    } else {
        if (empty($ajax)) {
            totara_set_notification(get_string('nopermission', 'local_plan'), $referer, array('style' => 'notifysuccess'));
        }
    }
}


///
/// Decline
///
if (!empty($decline)) {
    if (in_array($plan->get_setting('confirm'), array(DP_PERMISSION_ALLOW, DP_PERMISSION_APPROVE))) {
        $plan->send_declined_notification();
        totara_set_notification(get_string('plandeclined', 'local_plan', $plan->name), $referer, array('style' => 'notifysuccess'));
    } else {
        if (empty($ajax)) {
            totara_set_notification(get_string('nopermission', 'local_plan'), $referer);
        }
    }
}


///
/// Approval request
///
if (!empty($approvalrequest)) {

    // If plan is a draft, must be asking for plan approval
    if ($plan->status == DP_PLAN_STATUS_UNAPPROVED) {
        if ($plan->get_setting('confirm') == DP_PERMISSION_REQUEST) {
            // If a learner is updating their plan and now needs approval, notify manager
            if ($USER->id == $plan->userid) {
                if ($plan->get_manager()) {
                    $plan->send_manager_plan_approval_request();
                }
                else {
                    totara_set_notification(get_string('nomanager', 'local_plan'), $referer);
                }
            }
            totara_set_notification(get_string('approvalrequestsent', 'local_plan', $plan->name), $referer, array('style' => 'notifysuccess'));
            // @todo: send approval request email to relevant user(s)
        } else {
            if (empty($ajax)) {
                totara_set_notification(get_string('nopermission', 'local_plan'), $referer);
            }
        }
    }
    // If plan is active, must be asking for item approval
    else if ($plan->status == DP_PLAN_STATUS_APPROVED) {

        // Check this is the owner of the plan
        if ($plan->role !== 'learner') {
            if (empty($ajax)) {
                totara_set_notification(get_string('nopermission', 'local_plan'), $referer);
            }
        }

        // Get unapproved items
        $unapproved = $plan->get_unapproved_items();
        if ($unapproved) {
            if ($plan->get_manager()) {
                $plan->send_manager_item_approval_request($unapproved);
            }
            else {
                totara_set_notification(get_string('nomanager', 'local_plan'), $referer);
            }

            if (empty($ajax)) {
                totara_set_notification(get_string('approvalrequestsent', 'local_plan', $plan->name), $referer, array('style' => 'notifysuccess'));
            }

        }
    }
}


///
/// Delete
///
if (!empty($delete)) {
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
            $is_active = $plan->is_active();
            $plan->delete();

            if ( $plan->userid == $USER->id ){
                // don't bother unless the plan was active
                if ($is_active) {
                    // User was deleting their own plan, notify their manager
                    $plan->send_alert(false,'learningplan-remove.png','plan-remove-manager-short','plan-remove-manager-long');
                }
            } else {
                // Someone else was deleting the learner's plan, notify the learner
                $plan->send_alert(true,'learningplan-remove.png','plan-remove-learner-short','plan-remove-learner-long');
            }
            totara_set_notification(get_string('plandeletesuccess', 'local_plan', $plan->name), $referer, array('style' => 'notifysuccess'));
        }
    } else {
        if (empty($ajax)) {
            totara_set_notification(get_string('nopermission', 'local_plan'), $referer);
        }
    }
}


///
/// Signoff
///
if (!empty($signoff)) {
    if ($plan->get_setting('signoff') >= DP_PERMISSION_ALLOW) {
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
            $plan->send_completion_notification();
            totara_set_notification(get_string('plancompletesuccess', 'local_plan', $plan->name), $referer, array('style' => 'notifysuccess'));
        }
    } else {
        if (empty($ajax)) {
            totara_set_notification(get_string('nopermission', 'local_plan'), $referer);
        }
    }
}

if (empty($ajax)) {
    totara_set_notification(get_string('error:incorrectparameters', 'local_plan'), $referer);
}

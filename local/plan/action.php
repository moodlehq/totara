<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage plan
 */

/**
 * This script will perform general plan actions that can be posted from a number of pages
 * This script can also later be used by AJAX requests
 */

require_once('../../config.php');
require_once('lib.php');
require_once($CFG->dirroot.'/local/totara_msg/messagelib.php');

require_login();

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
$complete = optional_param('complete', 0, PARAM_BOOL);
$reactivate = optional_param('reactivate', 0, PARAM_BOOL);

// Is this an ajax call?
$ajax = optional_param('ajax', 0, PARAM_BOOL);
$referer = optional_param('referer', get_referer(false), PARAM_URL);
//making sure that we redirect to somewhere inside platform
//in case passed param is invalid or even HTTP_REFERER is bogus
$referer = clean_param($referer, PARAM_LOCALURL);

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


// @todo: handle action failure alerts
///
/// Approve
///
if (!empty($approve)) {
    if (in_array($plan->get_setting('approve'), array(DP_PERMISSION_ALLOW, DP_PERMISSION_APPROVE))) {
       $plan->set_status(DP_PLAN_STATUS_APPROVED, DP_PLAN_REASON_MANUAL_APPROVE);
       $plan->send_approved_alert();
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
    if (in_array($plan->get_setting('approve'), array(DP_PERMISSION_ALLOW, DP_PERMISSION_APPROVE))) {
        $plan->send_declined_alert();
        add_to_log(SITEID, 'plan', 'declined', "view.php?id={$plan->id}", $plan->name);
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
        if ($plan->get_setting('approve') == DP_PERMISSION_REQUEST) {
            // If a learner is updating their plan and now needs approval, notify manager
            if ($USER->id == $plan->userid) {
                if ($plan->get_manager()) {
                    $plan->send_manager_plan_approval_request();
                    add_to_log(SITEID, 'plan', 'requested approval', "view.php?id={$plan->id}", $plan->name);
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
            add_to_log(SITEID, 'plan', 'deleted', "index.php?userid={$plan->userid}", "{$plan->name} (ID:{$plan->id})");
            totara_set_notification(get_string('plandeletesuccess', 'local_plan', $plan->name), $referer, array('style' => 'notifysuccess'));
        }
    } else {
        if (empty($ajax)) {
            totara_set_notification(get_string('nopermission', 'local_plan'), $referer);
        }
    }
}


///
/// Complete
///
if (!empty($complete)) {
    if ($plan->get_setting('completereactivate') >= DP_PERMISSION_ALLOW) {
        $confirm = optional_param('confirm', 0, PARAM_BOOL);

        if (!$confirm && empty($ajax)) {
            // Show confirmation message
            print_header_simple();
            $confirmurl = new moodle_url(qualified_me());
            $confirmurl->param('confirm', 'true');
            $confirmurl->param('referer', $referer);
            $strcomplete = get_string('checkplancomplete', 'local_plan', $plan->name);
            notice_yesno(
                "{$strcomplete}<br><br>",
                $confirmurl->out(),
                $referer
            );

            print_footer();
            exit;
        } else {
            // Set plan status to complete
            $plan->set_status(DP_PLAN_STATUS_COMPLETE, DP_PLAN_REASON_MANUAL_COMPLETE);
            $plan->send_completion_alert();
            add_to_log(SITEID, 'plan', 'completed', "view.php?id={$plan->id}", $plan->name);
            totara_set_notification(get_string('plancompletesuccess', 'local_plan', $plan->name), $referer, array('style' => 'notifysuccess'));
        }
    } else {
        if (empty($ajax)) {
            totara_set_notification(get_string('nopermission', 'local_plan'), $referer);
        }
    }
}

///
/// Reactivate
///
if (!empty($reactivate)) {
    require_once($CFG->dirroot.'/local/plan/reactivate_form.php');
    require_once($CFG->dirroot . '/local/js/lib/setup.php');

    local_js(array(
        TOTARA_JS_DATEPICKER
    ));

    if ($plan->get_setting('completereactivate') >= DP_PERMISSION_ALLOW) {
        $form = new plan_reactivate_form(null, compact('id','referer'));

        if ($form->is_cancelled()) {
            redirect($referer);
        }

        if ($data = $form->get_data()) {

            $new_date = (isset($data->enddate)) ? dp_convert_userdate($data->enddate) : null;

            $referer = $data->referer;

            // Reactivate plan
            if (!$plan->reactivate_plan($new_date)) {
                totara_set_notification(get_string('planreactivatefail', 'local_plan', $plan->name), $referer);
            } else {
                add_to_log(SITEID, 'plan', 'reactivated', "view.php?id={$plan->id}", $plan->name);
                totara_set_notification(get_string('planreactivatesuccess', 'local_plan', $plan->name), $referer, array('style' => 'notifysuccess'));
            }
        }

        print_header_simple();
        print_heading(get_string('planreactivate', 'local_plan'), '', 2, 'reactivateheading');

        $form->display();

        print <<<HEREDOC
                <script type="text/javascript">

                $(function() {
                    $('#id_enddate').datepicker(
                        {
                            dateFormat: 'dd/mm/yy',
                            showOn: 'both',
                            buttonImage: '{$CFG->wwwroot}/local/js/images/calendar.gif',
                            buttonImageOnly: true,
                            constrainInput: true
                        }
                    );
                });
                </script>
HEREDOC;

        print_footer();
        exit;

    } else {
        if (empty($ajax)) {
            totara_set_notification(get_string('nopermission', 'local_plan'), $referer);
        }
    }
}

if (empty($ajax)) {
    totara_set_notification(get_string('error:incorrectparameters', 'local_plan'), $referer);
}

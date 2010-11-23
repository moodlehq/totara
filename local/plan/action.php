<?php
/*
    This script will perform general plan actions that can be posted from a number of pages
    This script can also later be used by AJAX requests
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
    }
} elseif (!empty($decline)) {
    if ($plan->get_setting('confirm') == DP_PERMISSION_APPROVE) {
        $plan->set_status(DP_PLAN_STATUS_DECLINED);
    }
} elseif (!empty($approvalrequest)) {
    if ($plan->get_setting('confirm') == DP_PERMISSION_REQUEST) {
        // @todo: send approval request email to relevant parties
    }
}

if (!empty($redirect)) {
    redirect($referer);
}

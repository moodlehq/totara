<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2013 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
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
 * @author David Curry <david.curry@totaralms.com>
 * @package totara
 * @subpackage totara_feedback360
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->dirroot.'/totara/core/dialogs/dialog_content.class.php');

$userid = required_param('userid', PARAM_INT);
$selected = optional_param('selected', null, PARAM_SEQUENCE);

$context = context_system::instance();

// Check user has permission to request feedback.
require_capability('totara/feedback360:requestfeedback360', $context);

$PAGE->set_context($context);

// Setup page.
require_login();

// Get guest user for exclusion purposes.
$guest = guest_user();

// Exclude anyone already requested from the list of available users.
if (!empty($selected)) {

    $selectedids = explode(',', $selected);

    // Set up some things to disable unassignable users.
    list($disable_insql, $disable_params) = $DB->get_in_or_equal($selectedids);
    $disable_sql = "SELECT u.*,
                    ".$DB->sql_fullname('u.firstname', 'u.lastname')." AS fullname
                    FROM {user} u
                    WHERE id {$disable_insql}";
    $disable = $DB->get_records_sql($disable_sql, $disable_params);

    // Set up some things to get the assignable users.
    list($selectedsql, $selectedparams) = $DB->get_in_or_equal($selectedids, SQL_PARAMS_QM, 'param', false);
    $notalreadyrequested = "AND u.id $selectedsql";
    $params = array($guest->id, $userid);
} else {
    $notalreadyrequested = '';
    $params = array($guest->id, $userid);
    $disable = array();
}

// Load potential managers for this user.
$availableusers = $DB->get_records_sql(
   "
        SELECT
            u.id,
            ".$DB->sql_fullname('u.firstname', 'u.lastname')." AS fullname,
            u.email
        FROM
            {user} u
        WHERE
            u.deleted = 0
        AND u.id != ?
        AND u.id != ?
        ORDER BY
            u.firstname,
            u.lastname
    ",
    $params, 0, TOTARA_DIALOG_MAXITEMS + 1);
// Limit results to 1 more than the maximum number that might be displayed.
// there is no point returning any more as we will never show them.

// Display page.
$dialog = new totara_dialog_content();
$dialog->selected_items = $disable;
$dialog->type = totara_dialog_content::TYPE_CHOICE_MULTI;
$dialog->searchtype = 'user';
$dialog->items = $availableusers;
$dialog->customdata['current_user'] = $userid;
$dialog->urlparams['userid'] = $userid;

if (!empty($selected)) {
    $selected_users = explode(',', $selected);
    $disable = array();
    foreach ($selected_users as $selected_user) {
        $disable[$selected_user] = $DB->get_record('user', array('id' => $selected_user));
    }
    $dialog->disabled_items = $disable;
}

echo $dialog->generate_markup();

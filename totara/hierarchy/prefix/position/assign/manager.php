<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2012 Totara Learning Solutions LTD
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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage totara_hierarchy
 */

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');
require_once($CFG->dirroot.'/totara/core/dialogs/dialog_content_hierarchy.class.php');

$userid = required_param('userid', PARAM_INT);

///
/// Setup / loading data
///

// Setup page
require_login();

//get guest user for exclusion purposes
$guest = guest_user();

// Load potential managers for this user
$managers = $DB->get_records_sql(
    "
        SELECT
            u.id,
            ".$DB->sql_fullname('u.firstname', 'u.lastname')." AS fullname
        FROM
            {user} u
        WHERE
            u.deleted = 0
        AND u.id != ?
        AND u.id != ?
        ORDER BY
            u.firstname,
            u.lastname
    "
, array($guest->id, $userid));


///
/// Display page
///

$dialog = new totara_dialog_content();
$dialog->search_code = '/totara/hierarchy/prefix/position/assign/manager_search.php';
$dialog->items = $managers;
$dialog->lang_file = 'manager';
$dialog->customdata['current_user'] = $userid;

echo $dialog->generate_markup();

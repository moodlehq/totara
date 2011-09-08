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
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage program
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->dirroot.'/local/dialogs/dialog_content.class.php');
require_once("{$CFG->dirroot}/local/program/lib.php");

require_login();

// Get program id and check capabilities
$programid = required_param('programid', PARAM_INT);
require_capability('local/program:configureassignments', program_get_context($programid));

// Already selected items
$selected = optional_param('selected', array(), PARAM_SEQUENCE);
if ($selected != false) {
    $selected = get_records_select('user',"id IN ($selected)",'','id, ' . sql_fullname('firstname', 'lastname') . ' as fullname');
    if (!$selected) {
        $selected = array();
    }
}

// Get all users that are managers
$items = get_records_sql("
    SELECT
    DISTINCT pos_assignment.reportstoid as id,
    " . sql_fullname('manager.firstname', 'manager.lastname') . " as fullname
    FROM
    {$CFG->prefix}pos_assignment pos_assignment
    INNER JOIN
    {$CFG->prefix}user manager ON manager.id = pos_assignment.reportstoid
    WHERE
    pos_assignment.reportstoid IS NOT NULL
    ");
if (!$items) {
    $items = array();
}


// Don't let them remove the currently selected ones
$unremovable = $selected;

///
/// Setup dialog
///

// Load dialog content generator; skip access, since it's checked above
$dialog = new totara_dialog_content();

$dialog->type = totara_dialog_content::TYPE_CHOICE_MULTI;

$dialog->items = $items;

// Set disabled/selected items
$dialog->selected_items = $selected;

// Set unremovable items
$dialog->unremovable_items = $unremovable;

// Set title
$dialog->selected_title = 'currentselection';

// Display
echo $dialog->generate_markup();

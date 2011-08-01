<?php

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
$items = get_records_select('user', 'username <> \'guest\' AND deleted = 0', '', 'id, ' . sql_fullname('firstname', 'lastname') . ' as fullname');
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
$dialog->selected_title = 'currentlyselected';

$dialog->search_code = '/local/program/assignment/find_individual_search.php';

// Display
echo $dialog->generate_markup();

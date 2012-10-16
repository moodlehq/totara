<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->dirroot.'/totara/core/dialogs/dialog_content.class.php');
require_once($CFG->dirroot .'/cohort/lib.php');

require_login();
$context = context_system::instance();

// Get program id and check capabilities
require_capability('moodle/cohort:view', $context);

$PAGE->set_context($context);

$items = $DB->get_records('cohort', null, 'name');

///
/// Setup dialog
///

// Load dialog content generator; skip access, since it's checked above
$dialog = new totara_dialog_content();
$dialog->type = totara_dialog_content::TYPE_CHOICE_MULTI;
$dialog->items = $items;

// Set title
$dialog->selected_title = 'itemstoadd';

// Setup search
$dialog->searchtype = 'cohort';

// Display
echo $dialog->generate_markup();

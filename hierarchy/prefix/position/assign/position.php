<?php

require_once('../../../../config.php');
require_once($CFG->dirroot.'/local/dialogs/dialog_content_hierarchy.class.php');


///
/// Load parameters
///

// Parent id
$parentid = optional_param('parentid', 0, PARAM_INT);

// Framework id
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);

// Only return generated tree html
$treeonly = optional_param('treeonly', false, PARAM_BOOL);


///
/// Display page
///

// Load dialog content generator
$dialog = new totara_dialog_content_hierarchy('position', $frameworkid);

// Toggle treeview only display
$dialog->show_treeview_only = $treeonly;

// Load items to display
$dialog->load_items($parentid);

// Display page
echo $dialog->generate_markup();

<?php

require_once('../config.php');
require_once('./lib.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/hierarchylib.php');


///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$id     = required_param('id', PARAM_INT);
// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);
$spage  = optional_param('spage', 0, PARAM_INT);

$hierarchy         = new hierarchy();
$hierarchy->prefix = 'competency';
$item              = $hierarchy->get_item_by_id($id);

require_capability('moodle/local:delete'.$hierarchy->prefix, $sitecontext);

// Setup page and check permissions
admin_externalpage_setup($hierarchy->prefix.'manage');

///
/// Display page
///

admin_externalpage_print_header();

if (!$delete) {
    $strdelete = get_string('deletecheck', $hierarchy->prefix);

    notice_yesno("$strdelete<br /><br />" . format_string($item->fullname),
                 "{$CFG->wwwroot}/{$hierarchy->prefix}/delete.php?id={$item->id}&amp;delete=".md5($item->timemodified)."&amp;sesskey={$USER->sesskey}&amp;spage={$spage}",
                 "{$CFG->wwwroot}/{$hierarchy->prefix}/index.php?frameworkid={$item->frameworkid}");

    print_footer();
    exit;
}


///
/// Delete
///

if ($delete != md5($item->timemodified)) {
    error("The check variable was wrong - try again");
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

$hierarchy->delete_framework_item($item->id);

add_to_log(SITEID, $hierarchy->prefix, 'delete', "view.php?id=$item->id", "$item->fullname (ID $item->id)");

print_heading(get_string('deleted'.$hierarchy->prefix, $hierarchy->prefix, format_string($item->fullname)));
print_continue("{$CFG->wwwroot}/{$hierarchy->prefix}/index.php?frameworkid={$item->frameworkid}&spage={$spage}");
print_footer();

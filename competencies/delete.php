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

require_capability('moodle/local:deletecompetencies', $sitecontext);

$hierarchy         = new hierarchy();
$hierarchy->prefix = 'competency';
$item              = $hierarchy->get_item_by_id($id);

// Setup page and check permissions
admin_externalpage_setup($hierarchy->prefix.'manage');

///
/// Display page
///

admin_externalpage_print_header();

if (!$delete) {
    $strdelete = get_string('deletecheck', 'competencies');

    notice_yesno("$strdelete<br /><br />" . format_string($item->fullname),
                 "{$CFG->wwwroot}/competencies/delete.php?id={$item->id}&amp;delete=".md5($item->timemodified)."&amp;sesskey={$USER->sesskey}&amp;spage={$spage}",
                 "{$CFG->wwwroot}/competencies/index.php?frameworkid={$item->frameworkid}");

    print_footer();
    exit;
}


///
/// Delete competency
///

if ($delete != md5($item->timemodified)) {
    error("The check variable was wrong - try again");
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

$hierarchy->delete_framework_item($item->id);

add_to_log(SITEID, 'competencies', 'delete', "view.php?id=$item->id", "$item->fullname (ID $item->id)");

print_heading(get_string('deletedcompetency', 'competencies', format_string($item->fullname)));
print_continue("{$CFG->wwwroot}/competencies/index.php?frameworkid={$item->frameworkid}&spage={$spage}");
print_footer();

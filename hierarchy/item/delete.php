<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');


///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$type   = required_param('type', PARAM_SAFEDIR);
$id     = required_param('id', PARAM_INT);
// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);
$spage  = optional_param('spage', 0, PARAM_INT);

if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php')) {
    require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php');
    $hierarchy = new $type();
} else {
    $hierarchy = new hierarchy();
    $hierarchy->prefix = $type;
}

$item = $hierarchy->get_item($id);
if ( !$item ){
    add_to_log(SITEID,$type,'delete','',"invalid hierarchy item id (ID $id)");
    error('No item with that ID.');
}

require_capability('moodle/local:delete'.$type, $sitecontext);

// Setup page and check permissions
admin_externalpage_setup($type.'manage','',array('type'=>$type));

///
/// Display page
///

admin_externalpage_print_header();

if (!$delete) {
    $strdelete = get_string('deletecheck', $type);

    notice_yesno("$strdelete<br /><br />" . format_string($item->fullname),
                 "{$CFG->wwwroot}/hierarchy/item/delete.php?type={$type}&id={$item->id}&amp;delete=".md5($item->timemodified)."&amp;sesskey={$USER->sesskey}&amp;spage={$spage}",
                 "{$CFG->wwwroot}/hierarchy/index.php?type={$type}&frameworkid={$item->frameworkid}");

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

add_to_log(SITEID, $type, 'delete', "view.php?id=$item->id", "$item->fullname (ID $item->id)");

notice(get_string('deleted'.$type, $type, format_string($item->fullname)), "{$CFG->wwwroot}/hierarchy/index.php?type={$type}&frameworkid={$item->frameworkid}&spage={$spage}");
